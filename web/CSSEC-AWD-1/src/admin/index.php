<?php
// /admin/index.php
// 管理后台页面（单页）
// GET 请求则根据请求参数加载不同的管理页面
// POST 请求则根据请求参数执行不同的 发布/管理 操作
include_once "../includes/config.php";
global $conn;
global $ROOT_PATH;

include_once "admin_check.php";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo $ROOT_PATH . "static/assets/admin_style.css" ?>">
    <link rel="stylesheet" href="<?php echo $ROOT_PATH . "static/assets/carousel.css" ?>">
    <title>CSSEC CMS 后台管理</title>
</head>
<body>

<nav class="admin-actions">
    <ul class="admin-actions-list">
        <li class="admin-actions-item admin-logo"><h2><a href='<?php echo $ROOT_PATH . "admin/index.php"; ?>'>CSSEC
                    CMS</a></h2></li>
        <li class="admin-actions-item <?php if ($_GET['target'] == 'notices' && $_GET['action'] == 'post') echo 'active'; ?>">
            <a href='index.php?action=post&target=notices'>公告发布</a></li>
        <li class="admin-actions-item <?php if ($_GET['target'] == 'notices' && $_GET['action'] == 'edit') echo 'active'; ?>">
            <a href='index.php?action=edit&target=notices'>公告管理</a></li>
        <li class="admin-actions-item <?php if ($_GET['target'] == 'banners' && $_GET['action'] == 'post') echo 'active'; ?>">
            <a href='index.php?action=post&target=banners'>展板发布</a></li>
        <li class="admin-actions-item <?php if ($_GET['target'] == 'banners' && $_GET['action'] == 'edit') echo 'active'; ?>">
            <a href='index.php?action=edit&target=banners'>展板管理</a></li>
        <li class="admin-actions-item <?php if ($_GET['target'] == 'articles' && $_GET['action'] == 'post') echo 'active'; ?>">
            <a href='index.php?action=post&target=articles'>文章发布</a></li>
        <li class="admin-actions-item <?php if ($_GET['target'] == 'articles' && $_GET['action'] == 'edit') echo 'active'; ?>">
            <a href='index.php?action=edit&target=articles'>文章管理</a></li>
        <li class="admin-actions-item <?php if ($_GET['target'] == 'users' && $_GET['action'] == 'edit') echo 'active'; ?>">
            <a href='index.php?action=edit&target=users'>用户管理</a></li>
        <li class="admin-info"><p><?php echo "管理员：" . $_SESSION['username']; ?>
                <a href="<?php echo $ROOT_PATH . "logout.php"; ?>">注销</a></p></li>
    </ul>
    <footer>
        <small>&copy; 2024 <a href="https://www.yuque.com/cssec/wiki" target="_blank">CSSEC</a></small>
    </footer>
</nav>

<section class="container">
    <?php
    // 根据 GET 请求参数加载不同的管理页面
    // 默认页面
    if (!isset($_GET['action']) || !isset($_GET['target'])) {
        include_once "admin_default.php";
    } else {
        // 公告
        if ($_GET['target'] == 'notices') {
            if ($_GET['action'] == 'post') {
                include_once "admin_notices_post.php";
            } else if ($_GET['action'] == 'edit') {
                include_once "admin_notices_edit.php";
            }
        }
        // 展板
        if ($_GET['target'] == 'banners') {
            if ($_GET['action'] == 'post') {
                include_once "admin_banners_post.php";
            } else if ($_GET['action'] == 'edit') {
                include_once "admin_banners_edit.php";
            }
        }
        // 文章
        if ($_GET['target'] == 'articles') {
            if ($_GET['action'] == 'post') {
                include_once "admin_articles_post.php";
            } else if ($_GET['action'] == 'edit') {
                include_once "admin_articles_edit.php";
            }
        }
        // 用户
        if ($_GET['target'] == 'users') {
            if ($_GET['action'] == 'edit') {
                include_once "admin_users_edit.php";
            }
        }
    }
    ?>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>