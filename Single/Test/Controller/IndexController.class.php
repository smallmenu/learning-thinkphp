<?php
namespace Test\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        echo 'Test Module';
        echo PHP_EOL;
        echo U('test/index/index');
    }

    public function testAction()
    {
        echo 'Test Module';
        echo PHP_EOL;
        echo U('test/index/test');
    }
}