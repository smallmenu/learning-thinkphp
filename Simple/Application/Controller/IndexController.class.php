<?php
namespace Application\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        echo U('index/index');
    }

    public function testAction()
    {
        echo U('index/test');
    }
}