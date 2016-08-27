# Learning-ThinkPHP 项目部署规范

ThinkPHP 官方手册：http://document.thinkphp.cn/manual_3_2.html

本项目只是ThinkPHP项目使用规范，仅供参考。

# 规范

一般情况下，我们不希望轻易的被看出来的使用什么框架，所以对ThinkPHP做一些简单的修改调整。

## 框架调整：

```
# 修改默认提示信息、关闭应用目录自动创建、强制调整等很多默认参数
* Conf/convention.php

# 去除默认的 X-Power-By Header 头
* Library/Think/View.class.php

# 扩展自定义函数库 functions_extend.php，主要为了避免修改functions.php
* Library/Behavior/BuildLiteBehavior.class.php
* Mode/common.php
* Mode/sae.php

# 1. 修复 CHECK_APP_DIR 关闭以后Runtime也无法创建了，这是不对的；
# 2. 模块、路由、方法、控制器异常信息输出404，其他异常修改为503，并在HEADER头输出错误信息（非调试模式仅在HEADER输出错误）
* Library/Think/Think.class.php

# 修复框架一处NOTICE错误
* Library/Think/Build.class.php

# 增强，Hacker了源码，可传入Redis prefix机制
* Library/Think/Cache.class.php

# 增强，修改框架Redis扩展，增加auth认证，数据库index配置
* Library/Think/Cache/Driver/Redis.class.php

# 修改默认跳转模板
* Tpl/dispatch_jump.tpl

# 修改默认异常模板
* Tpl/think_exception.tpl
```

## 主要约定

### 目录约定

开发环境与线上环境检出 `thinkphp-3.2.3` 到目录 ThinkPHP，应当在项目中引用作为公共框架目录，比如可以这样：

```
Project1/
    ProjectSVN/
    ThinkPHP-> ../ThinkPHP/
Project2/
    ProjectSVN/
    ThinkPHP-> ../ThinkPHP/
ThinkPHP/
```

### 配置约定

应当在公共配置中定义以下约定，如果没有公共配置，则在应用配置中定义：

PS: ThinkPHP的默认模块Home，为何要起这个名字，为何不用Default，因为Default是关键字...

既然默认的控制器和方法都是Index，所以我们强制规定在多模块场景，默认模块同样为：Index

```
<?php
return array(
    /* 应用设定 */
    'ACTION_SUFFIX'   => 'Action',  // 操作方法后缀

    /* 默认设定 */
    'DEFAULT_FILTER'  => 'trim,htmlspecialchars', // 默认参数过滤方法 用于I函数
    'DEFAULT_MODULE'        => 'Index',   // 多模块默认模块

    /* URL设置 */
    'URL_MODEL'       => 2, // 一般采用这种方式，除非对URL没有要求，比如后台
);
```

### LOAD_EXT_CONFIG 约定

ThinkPHP 提供`LOAD_EXT_CONFIG`可以加载额外的配置文件，并且同时会加载公共模块和当前模块的额外配置文件，默认会合并到默认数组中，为避免污染，请使用数组定义形式：

* 公共模块额外配置，COMMON_前缀区分

```
Common/Conf/config.php
Common/Conf/user.php

    'LOAD_EXT_CONFIG' => array(
        'COMMON_USER' => 'user',
    ),
```

* 模块额外配置

```
Index/Common/Conf/config.php
Index/Common/Conf/user.php

    'LOAD_EXT_CONFIG' => array(
        'USER' => 'user',
    ),
```


## 单应用单模块

单应用单模块的应用场景，比如一个独立的API服务

这种情况下实际不需要公共的Common目录，直接到应用目录，不过需要在入口文件指定 BIND_MODULE，所以目录结构看起来是这样：

```
ThinkPHP/
Simple/
├── Application  # 默认应用目录，其实这级目录都应该略去，但是好像做不到
│   ├── Common
│   │   └── function.php
│   ├── Conf
│   │   └── config.php
│   ├── Controller
│   │   ├── IndexController.class.php
│   │   └── TestController.class.php
│   ├── Model
│   └── View
├── Public
│   ├── assets
│   │   ├── css
│   │   ├── images
│   │   └── js
│   ├── crossdomain.xml
│   ├── index.php
│   └── robots.txt
└── Runtime  # Linux需要可写
```

Simple 应当作为一个独立的SVN

未定义路由规则时默认访问示例：

```
http://simple.thinkphp.loc/  (c=index&a=index)
http://simple.thinkphp.loc/index/  (c=index&a=index)
http://simple.thinkphp.loc/test/  (c=test&a=index)
http://simple.thinkphp.loc/index/test  (c=index&a=test)
http://simple.thinkphp.loc/test/test  (c=test&a=test)
```

## 单应用多模块

单应用多模块的应用场景，比如管理后台

这种情况下有一个公共的Common目录，放一些全局配置和函数，所以目录结构看起来是这样：

```
ThinkPHP/
Single/
├── Common # 公共模块
│   ├── Common
│   │   └── function.php
│   └── Conf
│       └── config.php
├── Index # 默认模块
│   ├── Common
│   │   └── function.php
│   ├── Conf
│   │   └── config.php
│   ├── Controller
│   │   ├── IndexController.class.php
│   │   └── TestController.class.php
│   ├── Model
│   └── View
├── Public  # 入口
│   ├── assets
│   │   ├── css
│   │   ├── images
│   │   └── js
│   ├── crossdomain.xml
│   ├── index.php
│   └── robots.txt
├── Runtime
└── Test   # Test 模块
    ├── Common
    ├── Conf
    ├── Controller
    │   ├── IndexController.class.php
    │   └── TestController.class.php
    ├── Model
    └── View
```

Single 应当作为一个独立的SVN地址

未定义路由规则时默认访问示例：

```
http://single.thinkphp.loc/  (m=index&c=index&a=index)
http://single.thinkphp.loc/index  (m=index&c=index&a=index)
http://single.thinkphp.loc/test  (m=test&c=index&a=index)
http://single.thinkphp.loc/test/test  (m=test&c=test&a=index)
http://single.thinkphp.loc/test/test/test  (m=test&c=test&a=test)
```

## 多应用多(单)模块

多应用多(单)模块，未来可能很大的项目，不同应用需要独立域名，不同应用未来还会有不同的模块，ThinkPHP 有个独立子域名部署功能，我觉得有点不靠谱。所以还是直接采用多应用部署。

假想需求：

1. 多个应用应当可以拆分到不同web节点运行，不同应用之间应当是解耦的，即不应当跨应用调用（但是可以跨模块调用）。

2. 需要一个项目级别的多应用共享的配置、函数、类库（ThinkPHP同一应用的多模块有公共模块机制，但多应用无法共享）。

解决方案：

1. 引入SDK，作为项目公共SDK目录，放置项目级别的公共配置、函数、类库

2. 应用分离部署，只需要部署SDK目录与应用目录

这种情况下我们应当对每个应用建立SVN，同时建立一个公共的SDK SVN，以项目举例，看起来是这样：

```
svn:project-www
svn:project-test
svn:project-sdk
```

同时需要在入口文件自定义 SDK_PATH 作为多个应用的公共目录，所以整个目录应该是这样：

```
Multiple/
├── SDK # 项目公共SDK目录 （所有应用都可以使用）
│   ├── Common  # 项目公共SDK函数库
│   │   └── function.php
│   ├── Conf  # 项目公共SDK配置
│   │   └── config.php
│   └── Library  # 项目公共SDK类库
│       └── SDKLibrary.class.php
├── Test
│   ├── Common
│   │   ├── Common
│   │   │   └── function.php
│   │   └── Conf
│   │       └── config.php
│   ├── Index
│   │   ├── Common
│   │   │   └── function.php
│   │   ├── Conf
│   │   │   └── config.php
│   │   ├── Controller
│   │   │   ├── IndexController.class.php
│   │   │   └── TestController.class.php
│   │   ├── Model
│   │   └── View
│   ├── Public
│   │   ├── assets
│   │   │   ├── css
│   │   │   ├── images
│   │   │   └── js
│   │   ├── crossdomain.xml
│   │   ├── index.php
│   │   └── robots.txt
│   └── Runtime
└── Www   # Www 应用目录
    ├── Common （公共Common模块，所有模块都可以使用）
    │   ├── Common  # Www 应用函数库
    │   │   └── function.php
    │   ├── Conf  # Www 应用配置
    │   │   ├── config.php
    │   │   └── user.php
    │   └── Library  # Www 应用类库
    │       └── ApplicationLibrary.class.php
    ├── Index  # Www 应用默认 Index 模块
    │   ├── Common
    │   │   └── function.php   # Index 模块函数库
    │   ├── Conf   # Index 模块配置
    │   │   ├── config.php
    │   │   └── user.php
    │   ├── Controller
    │   │   ├── IndexController.class.php
    │   │   └── TestController.class.php
    │   ├── Library  # Index 模块类库
    │   │   └── ModuleLibrary.class.php
    │   ├── Model
    │   └── View
    ├── Public  # Www 应用入口
    │   ├── assets
    │   │   ├── css
    │   │   ├── images
    │   │   └── js
    │   ├── crossdomain.xml
    │   ├── index.php
    │   └── robots.txt
    ├── Runtime
    └── Test   # Www 应用 Test 模块
        ├── Common
        ├── Conf
        ├── Controller
        │   ├── IndexController.class.php
        │   └── TestController.class.php
        ├── Model
        └── View
```

未定义路由规则时默认访问示例：

```
http://www.thinkphp.loc/  (www|m=index&c=index&a=index)
http://www.thinkphp.loc/index  (www|m=index&c=index&a=index)
http://www.thinkphp.loc/test  (www|m=test&c=index&a=index)
http://www.thinkphp.loc/test/test  (www|m=test&c=test&a=index)
http://www.thinkphp.loc/test/test/test  (www|m=test&c=test&a=test)
http://test.thinkphp.loc/  (test|m=index&c=index&a=index)
http://test.thinkphp.loc/index  (test|m=index&c=index&a=index)
http://test.thinkphp.loc/index/test  (test|m=index&c=test&a=index)
http://test.thinkphp.loc/index/test/test  (test|m=index&c=test&a=test)
```

说明：

可以在控制器中调用项目公共类库、应用公共类库、模块专用类库，他们分别位于不同的命名空间，如下所示：

```
use SDK\Library\SDKLibrary
use Common\Library\CommonLibrary
use Index\Library\ModuleLibrary
```

但是：

公共配置与公共函数，可能会有污染的问题，函数污染会报错，配置可以通过规范来解决：


# 演变

设想一下我们一个项目的演变过程

1. 最初的时候项目很小，是一个独立的SVN，单应用单模块结构
2. 项目变大，演变成单应用多模块结构，这时候只需要一个公共的模块就可以满足，SVN不需要变动
3. 项目继续变大，要演变成多应用多模块结构，这时候我们需要将公共的部分抽出来作为一个独立的SVN，然后对多个应用建立SVN

看起来应该能满足。



