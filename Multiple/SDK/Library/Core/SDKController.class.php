<?php
namespace SDK\Library\Core;

use Think\Controller;

class SDKController extends Controller
{
    /**
     * initialize
     */
    public function _initialize()
    {
    }

    /**
     * @param $message
     * @param $type
     */
    protected function ajaxSuccess($message = '', $type = 'json')
    {
        $ajax = array(
            'message' => $message,
            'status'  => true,
        );
        $this->ajaxReturn($ajax, $type);
    }

    /**
     * @param $message
     * @param $type
     */
    protected function ajaxError($message = '', $type = 'json')
    {
        $ajax = array(
            'message' => $message,
            'status'  => false
        );
        $this->ajaxReturn($ajax, $type);
    }
}