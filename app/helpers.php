<?php
/**
 * 共用函数库
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/11
 * Time: 15:55
 */


//替换富文本文件相对路径为绝对路径
function replace_content_file_url($html_content)
{
    $http = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false ? 'http' : 'https';
    $host = $http . '://' . $_SERVER['HTTP_HOST'];

    $replace = "/(<img[^>]+src=\"([^\"]+)\"[^>]*>)|(<a[^>]+href=\"([^\"]+)\"[^>]*>)|(<img[^>]+src='([^']+)'[^>]*>)|(<a[^>]+href='([^']+)'[^>]*>)/i";
    if (preg_match_all($replace, $html_content, $regs)) {
        foreach ($regs [0] as $num => $url) {
            $html_content = str_replace($url, lIIIIl($url, $host), $html_content);
        }
    }
    return $html_content;
}


function lIIIIl($l1, $l2)
{
    if (preg_match("/(.*)(href|src)\=(.+?)( |\/\>|\>).*/i", $l1, $regs)) {
        $I2 = $regs [3];
    }
    if (strlen($I2) > 0) {
        $I1 = str_replace(chr(34), "", $I2);
        $I1 = str_replace(chr(39), "", $I1);
    } else {
        return $l1;
    }
    $url_parsed = parse_url($l2);
    $scheme = isset($url_parsed['scheme']) ? $url_parsed ["scheme"] : '';
    if ($scheme != "") {
        $scheme = $scheme . "://";
    }
    $host = isset($url_parsed ["host"]) ? $url_parsed['host'] : '';
    $l3 = $scheme . $host;
    if (strlen($l3) == 0) {
        return $l1;
    }
    $path = isset($url_parsed ["path"]) ? dirname($url_parsed ["path"]) : '';
    if (!empty($path)) {
        if ($path [0] == "\\") {
            $path = "";
        }
    }
    $pos = strpos($I1, "#");
    if ($pos > 0)
        $I1 = substr($I1, 0, $pos);

    //判断类型
    if (preg_match("/^(http|https|ftp):(\/\/|\\\\)(([\w\/\\\+\-~`@:%])+\.)+([\w\/\\\.\=\?\+\-~`@\':!%#]|(&amp;)|&)+/i", $I1)) {
        return $l1;
    } //http开头的url类型要跳过
    elseif ($I1 [0] == "/") {
        $I1 = $l3 . $I1;
    } //绝对路径
    elseif (substr($I1, 0, 3) == "../") { //相对路径
        while (substr($I1, 0, 3) == "../") {
            $I1 = substr($I1, strlen($I1) - (strlen($I1) - 3), strlen($I1) - 3);
            if (strlen($path) > 0) {
                $path = dirname($path);
            }
        }
        $I1 = $l3 . $path . "/" . $I1;
    } elseif (substr($I1, 0, 2) == "./") {
        $I1 = $l3 . $path . substr($I1, strlen($I1) - (strlen($I1) - 1), strlen($I1) - 1);
    } elseif (strtolower(substr($I1, 0, 7)) == "mailto:" || strtolower(substr($I1, 0, 11)) == "javascript:") {
        return $l1;
    } else {
        $I1 = $l3 . $path . "/" . $I1;
    }
    return str_replace($I2, "\"$I1\"", $l1);
}