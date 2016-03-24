<?php
namespace Index\Controller;

use Think\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        echo 'Default Index Module';
        echo PHP_EOL;
        echo U('index/test/index');
    }

    public function testAction()
    {
        echo 'Default Index Module';
        echo PHP_EOL;
        echo U('index/test/test');
    }
}