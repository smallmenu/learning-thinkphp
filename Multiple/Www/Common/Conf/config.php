<?php
/**
 * 应用Conf/config.php 覆盖项目公共SDK配置
 */
if (is_file(SDK_PATH . 'Conf/config.php')) $SDK_CONFIG = include SDK_PATH . 'Conf/config.php';

return array_merge($SDK_CONFIG, array(
    'LOAD_EXT_CONFIG' => array(
        'db',
        'router',
        'cookie',
        'define'  => 'define',
        'cache'   => 'cache',
    ),

    'DEFAULT_THEME'   => 'Default',

    //'SHOW_PAGE_TRACE' => true,
));