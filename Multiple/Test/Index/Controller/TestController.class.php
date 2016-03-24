<?php
namespace Index\Controller;

use Think\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        echo 'Test APP';
        echo PHP_EOL;
        echo 'Index Module';
        echo PHP_EOL;
        echo U('index/test/index');
    }

    public function testAction()
    {
        echo 'Test APP';
        echo PHP_EOL;
        echo 'Index Module';
        echo PHP_EOL;
        echo U('index/test/test');
    }
}