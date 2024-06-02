<?php
// /admin/admin_default.php
// 展示文章数量，用户数量，当前公告，当前展板
include_once "../includes/config.php";
global $conn;
global $ROOT_PATH;

include_once "admin_check.php";

$sql = "SELECT COUNT(*) FROM articles";
$result = $conn->query($sql);
$row = $result->fetch_row();
$article_count = $row[0];
$result->free();

$sql = "SELECT COUNT(*) FROM users";
$result = $conn->query($sql);
$row = $result->fetch_row();
$user_count = $row[0];
$result->free();

$sql = "SELECT * FROM notices ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$notice = $row;
$result->free();

// 按照 id 顺序展示所有展板
$sql = "SELECT * FROM banners ORDER BY id";
$result = $conn->query($sql);
$banners = [];
while ($row = $result->fetch_assoc()) {
    $banners[] = $row;
}
$result->free();

?>
<div class="admin-default">
    <h1>CSSEC CMS 后台管理</h1>
    <a href="<?php echo $ROOT_PATH . "index.php"; ?>" class="admin-default-home" target="_blank"
       onclick="return confirm('确定离开后台？')">返回首页</a>
    <h2 class="admin-default-articles-count">文章数量：<?php echo $article_count; ?></h2>
    <h2 class="admin-default-users-count">用户数量：<?php echo $user_count; ?></h2>
    <div class="admin-default-notice">
        <h2>当前公告：<?php echo $notice['title']; ?></h2>
        <p>
            <?php echo $notice['content']; ?>
        </p>
    </div>
    <div class="admin-default-banners">
        <h2>当前展板：</h2>
        <ul>
            <?php foreach ($banners as $banner): ?>
                <li class="admin-default-banners-item">
                    <img src="<?php echo $ROOT_PATH . 'uploads/banner/' . $banner['pic']; ?>"
                         alt="<?php echo $banner['title']; ?>">
                    <div class="admin-default-banners-item-text">
                        <h3><?php echo $banner['title']; ?></h3>
                        <p><?php echo $banner['content']; ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>