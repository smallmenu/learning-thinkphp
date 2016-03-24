<?php
// 调试模式
define('APP_DEBUG', true);
// 关闭目录安全文件
define('BUILD_DIR_SECURE', false);

// 时间相关
define('STAMP', time());
define('DATE', date('Y-m-d', STAMP));
define('TIME', date('H:i:s', STAMP));
define('DATE_TIME', date('Y-m-d H:i:s', STAMP));
define('RUNTIME_START_TIME', microtime(true));

// 入口目录
define('ROOT_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/');
// 应用目录
define('APP_PATH', ROOT_PATH . '../');
// 公共目录
define('COMMON_PATH', ROOT_PATH . '../../Common/');
// 运行时目录
define('RUNTIME_PATH', ROOT_PATH . '../Runtime/');
// 框架目录
define('THINK_PATH', ROOT_PATH . '../../../ThinkPHP/');
// 启动
require THINK_PATH . 'ThinkPHP.php';