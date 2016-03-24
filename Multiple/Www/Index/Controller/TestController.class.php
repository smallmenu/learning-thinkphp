<?php
namespace Index\Controller;

use Think\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        echo 'Www APP';
        echo PHP_EOL;
        echo 'Default Index Module';
        echo PHP_EOL;
        echo U('index/test/index');
    }

    public function testAction()
    {
        echo 'Www APP';
        echo PHP_EOL;
        echo 'Default Index Module';
        echo PHP_EOL;
        echo U('index/test/test');
    }
}