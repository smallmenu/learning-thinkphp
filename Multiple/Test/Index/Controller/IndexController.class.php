<?php
namespace Index\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        echo 'Test APP';
        echo PHP_EOL;
        echo 'Index Module';
        echo PHP_EOL;
        echo U('index/index/index');
    }

    public function testAction()
    {
        echo 'Test APP';
        echo PHP_EOL;
        echo 'Index Module';
        echo PHP_EOL;
        echo U('index/index/test');
    }
}