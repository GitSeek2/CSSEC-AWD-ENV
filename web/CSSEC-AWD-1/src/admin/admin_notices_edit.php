<?php
// /admin/admin_notices_edit.php
include_once "../includes/config.php";
global $conn;
global $ROOT_PATH;

include_once "admin_check.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['clear'])) {
        // 清空公告
        $stmt = $conn->prepare("INSERT INTO notices (title, content) VALUES ('暂无公告', '无事发生，宁静的一天呢~')");
        if ($stmt->execute()) {
            flash("公告已清空！");
        } else {
            flash("清空公告失败！");
        }
    } else {
        // 更新公告
        $title = $_POST['title'];
        $content = $_POST['content'];

        $stmt = $conn->prepare("UPDATE notices SET title=?, content=? WHERE id=1");
        $stmt->bind_param("ss", $title, $content);

        if ($stmt->execute()) {
            flash("公告更新成功！");
        } else {
            flash("公告更新失败！");
        }
    }
    header("Location: " . $ROOT_PATH . "admin/index.php");
}
// 取出最新的公告
$sql = "SELECT * FROM notices ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$notice = mysqli_fetch_assoc($result);
?>
<div class="admin-notice-edit admin-notice-post">
    <h1>公告编辑</h1>
    <form action="admin_notices_edit.php" method="post">
        <label for="title">标题：</label>
        <input type="text" name="title" id="title" value="<?php echo $notice['title']; ?>" required>
        <label for="content">内容：</label>
        <textarea name="content" id="content" cols="30" rows="10" required><?php echo $notice['content']; ?></textarea>
        <input type="submit" value="更新公告">
    </form>

    <form action="admin_notices_edit.php" method="post" class="admin-notice-edit-clear">
        <input type="hidden" name="clear" value="1">
        <input type="submit" value="清空公告">
    </form>
</div>