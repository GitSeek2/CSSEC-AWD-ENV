<?php
// /includes/functions.php

function getRootPath(): string
{
    // 通过判断 $_SERVER['PHP_SELF'] 中的符号 '/'数量来确定根目录相对当前文件的相对路径，输出对应个 '../'
    $path = $_SERVER['PHP_SELF'];
    $count = substr_count($path, '/') - 1;
    $count = max($count, 0);  // 确保 $count 不小于0
    return "./" . str_repeat('../', $count);
}

// 实现一个 PHP 的 flash 消息功能
// 用于在页面跳转时显示一些提示信息
function flash($message)
{
    $_SESSION['flash_messages'][] = $message; // 向数组添加消息
}

function get_flashed_messages()
{
    $messages = $_SESSION['flash_messages'];
    $_SESSION['flash_messages'] = []; // 清空消息
    return $messages;
}