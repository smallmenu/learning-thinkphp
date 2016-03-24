<?php
namespace Application\Controller;

use Think\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        echo U('test/index');
    }

    public function testAction()
    {
        echo U('test/test');
    }
}