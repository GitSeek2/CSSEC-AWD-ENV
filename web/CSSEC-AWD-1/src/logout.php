<?php
// /logout.php
include_once 'includes/config.php';
global $ROOT_PATH;
if (isset($_SESSION['username'])) {
    flash("再见，" . $_SESSION['username'] . "！");
    // 清空用户信息
    unset($_SESSION['username']);
    unset($_SESSION['power']);
    unset($_SESSION['user_id']);
} else {
    flash("你还没有登录！");
}
header("Location: $ROOT_PATH" . "index.php");
exit;
