<?php
namespace Test\Controller;

use Think\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        echo 'Test Module';
        echo PHP_EOL;
        echo U('test/test/index');
    }

    public function testAction()
    {
        echo 'Test Module';
        echo PHP_EOL;
        echo U('test/test/test');
    }
}