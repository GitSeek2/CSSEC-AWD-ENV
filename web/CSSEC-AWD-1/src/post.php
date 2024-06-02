<?php
// /post.php
include_once "includes/config.php";
global $conn;
global $ROOT_PATH;
?>
<!DOCTYPE html>
<html lang="zh-CN">

<?php
include_once "includes/head.php";
?>

<body>
<?php
include_once "includes/header.php";
include_once "includes/nav.php";
?>

<?php
if (!isset($_SESSION['username']) || $_SESSION['power'] < 2) {
    flash("越权操作！");
    header("Location: " . $ROOT_PATH . "index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    // $content = htmlspecialchars($content); // 对 content 内容进行转义
    $content = nl2br($content); // 将换行符转换为 <br>
    $content = preg_replace('/\s(?=\s)/', '&nbsp;', $content); // 将空格转换为 &nbsp;（不转换标签的空格）
    $author_id = $_SESSION['user_id'];

    $sql = "INSERT INTO articles (title, content, author_id) VALUES ('$title', '$content', $author_id)";
    $result = $conn->query($sql);

    if ($result) {
        flash("文章发布成功");
    } else {
        flash("文章发布失败");
    }
    header("Location: " . $ROOT_PATH . "post.php");
}
?>

<form action="post.php" class="post-form container" method="post">
    <h2>发布文章</h2>
    <div class="form-group">
        <label for="title">文章标题</label>
        <input type="text" id="title" name="title" placeholder="请输入文章标题" required>
    </div>
    <div class="form-group">
        <label for="content">文章内容</label>
        <textarea id="content" name="content" placeholder="请输入文章内容" required></textarea>
    </div>
    <input type="submit" value="发布">
</form>
<?php
include_once "includes/footer.php";
?>
</body>
</html>