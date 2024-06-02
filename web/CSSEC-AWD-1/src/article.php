<?php
// /article.php
include_once "includes/config.php";
global $conn;
global $ROOT_PATH;

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM articles WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$article = mysqli_fetch_assoc($result);

if (!$article) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM users WHERE id = " . $article['author_id'];
$result = mysqli_query($conn, $sql);
$author = mysqli_fetch_assoc($result);

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

<section class="container article-read">
    <div class="article-read-head">
        <h1 class="article-read-title"><?php echo $article['title']; ?></h1>
        <p class="article-read-meta">
            <span class="article-read-author">作者：<?php echo $author['username']; ?></span>
            <span class="article-read-ctime">发布时间：<?php echo $article['created_at']; ?></span>
            <span class="article-read-utime">更新时间：<?php echo $article['updated_at']; ?></span>
        </p>
    </div>
    <div class="article-read-content">
        <!--    // 对 content 内容进行一些转换，避免 XSS 攻击，并保持换行，空格等格式得正常显示-->
        <!--    $content = htmlspecialchars($content);-->
        <!--    $content = strip_tags($content, '<p><b><i><a><img>'); // 允许 <p>、<b>、<i>、<a>、<img> 这些标签-->
        <!--    $content = nl2br($content); // 将换行符转换为 <br>-->
        <!--    $content = str_replace(' ', '&nbsp;', $content); // 将空格转换为 &nbsp;-->
        <?php
        echo $article['content']; ?>
    </div>
</section>
</body>
</html>
