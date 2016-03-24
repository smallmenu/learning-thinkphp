<?php
namespace Index\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        echo 'Default Index Module';
        echo PHP_EOL;
        echo U('index/index/index');
    }

    public function testAction()
    {
        echo 'Default Index Module';
        echo PHP_EOL;
        echo U('index/index/test');
    }
}