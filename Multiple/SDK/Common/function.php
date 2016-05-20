<?php
/**
 * ID加密
 *
 * @param $id
 * @return string
 */
function id_encrypt($id)
{
    $pad = substr($id, -1, 1);
    $id = str_pad($id, 12, '0', STR_PAD_LEFT);
    $id = base64_encode_safe($id);
    $id = substr($id, 0, 12) . $pad . substr($id, 12);
    return $id;
}

/**
 * ID解密
 *
 * @param $id
 * @return int
 */
function id_decrypt($id)
{
    if (is_numeric($id)) return $id;
    $id = substr($id, 0, 12) . substr($id, 13);
    $id = base64_decode_safe(strtr($id, '-_', '+/'));
    return (int)$id;
}

/**
 * URL安全的base64
 *
 * @param string $str
 * @return string
 */
function base64_encode_safe($str = '')
{
    $str = base64_encode($str);
    $str = str_replace(array('+', '/', '='), array('-', '_', '!'), $str);
    return $str;
}

/**
 * @param string $str
 * @return mixed|string
 */
function base64_decode_safe($str = '')
{
    $str = str_replace(array('-', '_', '!'), array('+', '/', '='), $str);
    $str = base64_decode($str);
    return $str;
}

/**
 * @param $a
 * @param $b
 * @return bool
 */
function sortArray($a, $b)
{
    return strlen($a) > strlen($b);
}

/**
 * @param $word
 * @param $title
 * @param string $code
 * @return mixed
 */
function word_highlight($word, $title, $code = 'em')
{
    if (strpos($title, $word) !== false) {
        $replace = '<'. $code. '>'. $word. '</'. $code. '>';
        $title = str_replace($word, $replace, $title);
        return $title;
    }
    return $title;
}

/**
 * @param $src
 * @param bool $version
 * @return string
 */
function assets($src, $version = false)
{
    $assets = $src = trim($src);
    if (!empty($src)) {
        if (!$version) {
            $assets = $src;
        } else {
            $srcPath = ROOT_PATH . $src;
            $mtime = filemtime($srcPath);
            $mtime = date('mdHi', $mtime);
            $concat = strpos($src, '?') === false ? '?v=' : '&v=';
            $assets = $src . $concat . $mtime;
        }
    }
    return $assets;
}