<?php
namespace Common\Library\Core;

use SDK\Library\Core\SDKController;

class BaseController extends SDKController
{
    /**
     * @var null
     */
    protected $setting = null;

    /**
     * @var null
     */
    protected $define = null;

    /**
     * @var null
     */
    protected $cache = null;

    /**
     * @var null
     */
    protected $seo = null;

    /**
     * @var null
     */
    protected $seos = null;

    /**
     * @var int
     */
    protected $pagesize = 10;

    /**
     * @var array
     */
    protected $crumbs = array();

    /**
     * initialize
     */
    public function _initialize()
    {
        parent::_initialize();

        $this->define = config('define');

        header("Content-type: text/html; charset=utf-8");

        $this->_init();
        $this->_assign();
    }

    /**
     * @param $text
     * @param string $url
     */
    protected function addCrumb($text, $url = '')
    {
        $this->crumbs[] = array('text' => $text, 'url' => $url);
    }

    /**
     *
     */
    protected function clearCrumb()
    {
        $this->crumbs = array();
    }

    /**
     * @param $index
     */
    protected function delCrumb($index)
    {
        if (isset($this->crumbs[$index])) {
            unset($this->crumbs[$index]);
        }
    }

    /**
     * 初始化
     */
    private function _init()
    {
        // 初始化 cache
        if ($cache = config('cache')) {
            $domain = $this->define['DOMAIN'];
            $module = strtolower(MODULE_NAME);
            $cache['prefix'] = $domain. ':'. $cache['prefix'] . $module . ':';
            config('cache.prefix', $cache['prefix']);
            $this->cache = cache($cache);
        }

        // 面包屑
        $this->addCrumb('首页', $this->define['WWW_URL']);
    }

    /**
     * 自动注入模板信息
     */
    private function _assign()
    {
        if ($this->define) {
            $this->assign($this->define);
        }

        // Setting SEO
        $seoConfig = $this->setting['seo'];
        $module = strtolower(MODULE_NAME);
        $controller = strtolower(CONTROLLER_NAME);
        $action = strtolower(ACTION_NAME);

        $seos = $this->seos = isset($seoConfig[$module][$controller][$action]) ? $seoConfig[$module][$controller][$action] : null;


        if ($seos && isset($seos['default'])) {
            $this->seo = $seos['default'];
            $this->assign('seo', $this->seo);
        }
    }

    /**
     * 404
     */
    protected function _404() {
        $this->httpCode(404);
    }

    /**
     * 输出HTTP头
     *
     * @param $code
     */
    protected function httpCode($code)
    {
        if ($code == 404) {
            $this->_empty();
        } else {
            send_http_status($code);
        }
        exit;
    }

    /**
     * 不存在Action的时候执行
     */
    protected function _empty()
    {
        send_http_status(404);
    }

    /**
     * 记录内容访问轨迹
     */
    protected function visitLog () {
        $url = __SELF__;
        $last_visit_url = session('last_visit_url');

        $url = preg_replace('#^https?://[^/]+/#iUs', '', $url);

        // 以下情况不记录
        if($url == '' || md5($url) == $last_visit_url) {
            return;
        }

        $data = array(
            'session_id' => session_id(),
            'user_id' => session('user.id') ? session('user.id') : 0,
            'ip' => get_client_ip(),
            'url' => $url,
            'site' => 2,
            'addtime' => DATE_TIME,
        );

        D('UserVisit')->add($data);

        session('last_visit_url', md5($url));
        return;
    }
}