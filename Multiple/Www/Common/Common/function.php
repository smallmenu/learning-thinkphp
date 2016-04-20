<?php
/**
 * 应用Common/function.php 自动加载项目SDK函数库
 */
if (is_file(SDK_PATH . 'Common/function.php')) include SDK_PATH . 'Common/function.php';

function appCommon()
{
    echo 'appCommon';
}