<?php
// /admin/admin_banners_edit.php
include_once "../includes/config.php";
global $conn;
global $ROOT_PATH;

include_once "admin_check.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM banners WHERE id=$id";
        if ($conn->query($sql)) {
            flash("展板删除成功！");
        } else {
            flash("展板删除失败！");
        }
        header("Location: " . $ROOT_PATH . "admin/index.php?action=edit&target=banners");
    }
}

// 按照 id 顺序展示所有展板
$sql = "SELECT * FROM banners ORDER BY id";
$result = $conn->query($sql);
$banners = [];
while ($row = $result->fetch_assoc()) {
    $banners[] = $row;
}
$result->free();

?>

<div class="admin-banners-edit">
    <h1>展板编辑</h1>
    <section id="banner" class="carousel slide" data-bs-ride="carousel">
        <!-- 指示符 -->
        <div class="carousel-indicators">
            <?php
            foreach ($banners as $i => $banner) {
                ?>
                <button type="button" data-bs-target="#banner" data-bs-slide-to="<?php echo $i; ?>"
                        class="<?php echo $i == 0 ? 'active' : ''; ?>"></button>
                <?php
            }
            ?>
        </div>

        <!-- 轮播图片 -->
        <div class="carousel-inner banner">
            <?php
            foreach ($banners as $i => $banner) {
                ?>
                <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                    <img src="<?php echo $ROOT_PATH . 'uploads/banner/' . $banner['pic']; ?>"
                         alt="<?php echo $banner['title']; ?>">
                    <div class="carousel-caption">
                        <h2><?php echo $banner['title']; ?></h2>
                        <small><?php echo $banner['content']; ?></small>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <!-- 左右切换按钮 -->
        <button class="carousel-control-prev" type="button" data-bs-target="#banner" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#banner" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </section>
    <ul>
        <?php foreach ($banners as $banner): ?>
            <li class="admin-banners-edit-banners-item">
                <img src="<?php echo $ROOT_PATH . 'uploads/banner/' . $banner['pic']; ?>"
                     alt="<?php echo $banner['title']; ?>">
                <div class="admin-banners-edit-banners-item-text">
                    <div class="admin-banners-edit-banners-item-text-header">
                        <h3><?php echo $banner['title']; ?></h3>
                        <div>
                            <form action="admin_banners_edit.php" method="post" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $banner['id']; ?>">
                                <input type="submit" name="delete" value="删除" onclick="return confirmDeleteBanner()">
                            </form>
                            <a href="index.php?action=post&target=banners&id=<?php echo $banner['id']; ?>"
                               onclick="return confirmEditBanner()">编辑</a>
                        </div>
                    </div>
                    <p><?php echo $banner['content']; ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

</div>
<script>
    // 确定删除展板函数
    function confirmDeleteBanner() {
        return confirm('确定删除展板 <?php echo $banner['title']; ?>？');
    }

    // 确定编辑展板函数
    function confirmEditBanner() {
        return confirm('确定编辑展板 <?php echo $banner['title']; ?>？');
    }
</script>