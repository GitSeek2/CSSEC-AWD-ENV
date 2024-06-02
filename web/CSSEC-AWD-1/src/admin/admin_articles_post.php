<?php
// /admin/admin_articles_post.php
include_once "../includes/config.php";
global $conn;
global $ROOT_PATH;

include_once "admin_check.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $author_id = $_SESSION['user_id'];
    $content = nl2br($content); // 将换行符转换为 <br>
    $content = preg_replace('/\s(?=\s)/', '&nbsp;', $content); // 将空格转换为 &nbsp;（不转换标签的空格）
    if (empty($title) || empty($content)) {
        flash("标题和内容不能为空！");
        return;
    }

    if (isset($_POST['id'])) {
        // 更新文章
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE articles SET title=?, content=? WHERE id=?");
        $stmt->bind_param("ssi", $title, $content, $id);

        if ($stmt->execute()) {
            flash("文章更新成功！");
        } else {
            flash("文章更新失败！" . $stmt->error);
        }

        header("Location: " . $ROOT_PATH . "admin/index.php?action=edit&target=articles");
    } else {
        // 发布文章
        $stmt = $conn->prepare("INSERT INTO articles (title, content, author_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $content, $author_id);

        if ($stmt->execute()) {
            flash("文章发布成功！");
        } else {
            flash("文章发布失败！" . $stmt->error);
        }

        header("Location: " . $ROOT_PATH . "admin/index.php?action=post&target=articles");
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();
    $result->free();
}
?>
<div class="admin-articles-post">
    <h1>文章<?php echo isset($article) ? '更新' : '发布'; ?></h1>
    <form action="admin_articles_post.php" method="post">
        <?php if (isset($article)): ?>
            <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
        <?php endif; ?>
        <label for="title">标题：</label>
        <input type="text" name="title"
               id="title" <?php echo isset($article) ? 'value="' . $article['title'] . '"' : ''; ?>
               required>
        <label for="content">内容：</label>
        <textarea name="content" id="content" cols="30" rows="10"
                  required><?php echo isset($article) ? $article['content'] : ''; ?></textarea>
        <input type="submit" value="<?php echo isset($article) ? '更新' : '发布'; ?>">
    </form>
</div>