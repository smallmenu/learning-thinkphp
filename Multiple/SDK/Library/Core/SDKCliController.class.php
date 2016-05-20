<?php
namespace SDK\Library\Core;

use Think\Controller;

class SDKCliController extends Controller
{
    /**
     * @var null
     */
    protected $tmpDir = null;

    /**
     * initialize
     */
    public function _initialize()
    {
        if (PHP_SAPI !== 'cli') {
            send_http_status(404); exit;
        }

        set_time_limit(0);
        error_reporting(E_ALL);
        ini_set('display_errors', 'on');

        $this->tmpDir = sys_get_temp_dir();
    }

    /**
     * @param $msg
     * @param bool $exit
     */
    protected function println($msg, $exit = true)
    {
        $time = date('[Y-m-d H:i:s] ');
        echo $time . $msg;
        echo PHP_EOL;
        if ($exit) {
            exit;
        }
    }
}