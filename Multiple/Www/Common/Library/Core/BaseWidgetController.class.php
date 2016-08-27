<?php
namespace Common\Library\Core;

use SDK\Library\Core\SDKController;

class BaseWidgetController extends SDKController
{
    /**
     * @var null
     */
    protected $cache = null;

    /**
     * initialize
     */
    public function _initialize()
    {
        parent::_initialize();

        $this->_init();
    }

    /**
     * 初始化
     */
    private function _init()
    {
        // 初始化 cache
        if ($cache = config('cache')) {
            $this->cache = cache($cache);
        }
    }
}