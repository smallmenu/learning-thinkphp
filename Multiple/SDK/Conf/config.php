<?php
/**
 * 公共SDK配置
 */

return array(
    'AUTOLOAD_NAMESPACE'   => array(
        'SDK' => SDK_PATH,
    ),

    /* 模板引擎设置 */
    'TMPL_ENGINE_TYPE'     => 'PHP',
    'TMPL_TEMPLATE_SUFFIX' => '.phtml',

    /* URL设置 */
    'URL_MODEL'            => 2,
    'URL_HTML_SUFFIX'      => '',
);