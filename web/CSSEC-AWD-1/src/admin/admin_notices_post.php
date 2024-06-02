<?php
// /admin/admin_notices_post.php
include_once "../includes/config.php";
global $conn;
global $ROOT_PATH;
include_once "admin_check.php"; // 权限检查

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO notices (title, content) VALUES ('$title', '$content')";
    if ($conn->query($sql)) {
        flash("公告发布成功！");
    } else {
        flash("公告发布失败！");
    }
    header("Location: " . $ROOT_PATH . "admin/index.php");
}
?>
<div class="admin-notice-post">
    <h1>公告发布</h1>
    <form action="admin_notices_post.php" method="post">
        <label for="title">标题：</label>
        <input type="text" name="title" id="title" required>
        <label for="content">内容：</label>
        <textarea name="content" id="content" cols="30" rows="10" required></textarea>
        <input type="submit" value="发布公告">
    </form>
</div>