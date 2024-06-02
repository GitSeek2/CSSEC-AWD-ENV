<?php
// /admin/admin_articles_edit.php
include_once "../includes/config.php";
global $conn;
global $ROOT_PATH;

include_once "admin_check.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        // 查询文章标题
        $sql = "SELECT title FROM articles WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $title = mysqli_fetch_assoc($result)['title'];
        // 删除文章
        $sql = "DELETE FROM articles WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            flash("文章 $title 删除成功！");
        } else {
            flash("文章 $title 删除失败！");
        }
        header("Location: index.php?action=edit&target=articles");
    }
}
?>
<div class="admin-articles-edit">
    <h1>文章管理</h1>
    <ul class="article-list">
        <?php
        $sql = "SELECT * FROM articles ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <li class="article-item">
                    <div class="article-header">
                        <h3 class="article-title"><?php echo $row['title']; ?></h3>
                        <div class="article-actions">
                            <form action="admin_articles_edit.php" method="post" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" name="delete" value="删除" onclick="return confirmDeleteArticle()">
                            </form>
                            <a href="index.php?action=post&target=articles&id=<?php echo $row['id']; ?>"
                               onclick="return confirmEditArticle()">编辑</a>
                        </div>
                    </div>
                    <p>
                        <?php
                        $row['content'] = str_replace('&nbsp;', '', $row['content']);
                        $row['content'] = strip_tags($row['content']);
                        $row['content'] = mb_substr($row['content'], 0, 100, 'utf-8');
                        echo $row['content'];
                        ?>
                    </p>
                    <small class="article-meta">
                        <span class="article-ctime">创建：<?php echo $row['created_at']; ?></span>
                        <span class="article-utime">更新：<?php echo $row['updated_at']; ?></span>
                        <span class="article-author">作者：<?php echo $row['author_id']; ?></span>
                    </small>
                </li>
                <?php
            }
        } else {
            echo "<li class='article-item'><h3 class='article-title'>暂无文章，无趣！</h3></li>";
        }
        ?>
    </ul>
</div>

<script>
    // 确定删除文章
    function confirmDeleteArticle() {
        return confirm('确定删除文章？');
    }

    // 确定编辑文章
    function confirmEditArticle() {
        return confirm('确定编辑文章？');
    }
</script>
