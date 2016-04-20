<?php
namespace Index\Controller;

use SDK\Library\SDKLibrary;
use Think\Controller;
use Index\Library\ModuleLibrary;
use Common\Library\CommonLibrary;

class IndexController extends Controller
{
    public function indexAction()
    {
        echo 'Www APP';
        echo PHP_EOL;
        echo 'Default Index Module';
        echo PHP_EOL;
        echo U('index/index/index');
    }

    public function testAction()
    {
        echo 'Www APP';
        echo PHP_EOL;
        echo 'Default Index Module';
        echo PHP_EOL;
        echo U('index/index/test');
    }

    public function functionAction()
    {
        echo 'sdk function:';
        echo sdkCommon();
        echo PHP_EOL;
        echo 'Common function:';
        echo appCommon();
        echo PHP_EOL;
        echo 'module function:';
        echo moduleCommon();
    }

    public function libraryAction()
    {
        $sdkClass = new SDKLibrary();
        $commonClass = new CommonLibrary();
        $moduleClass = new ModuleLibrary();
    }

    public function configAction()
    {
        print_r(C('COMMON_USER'));
        print_r(C('USER'));
    }
}