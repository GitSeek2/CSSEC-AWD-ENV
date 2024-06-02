<?php
// /admin/admin_banners_post.php
include_once "../includes/config.php";
global $conn;
global $ROOT_PATH;

include_once "admin_check.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $pic = $_FILES['pic'];

    $picName = time() . '.' . pathinfo($pic['name'], PATHINFO_EXTENSION);
    $picPath = $ROOT_PATH . 'uploads/banner/' . $picName;

    if (move_uploaded_file($pic['tmp_name'], $picPath)) {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = "UPDATE banners SET title='$title', pic='$picName', content='$content' WHERE id=$id";
        } else {
            $sql = "INSERT INTO banners (title, pic, content) VALUES ('$title', '$picName', '$content')";
        }

        if ($conn->query($sql)) {
            flash("展板" . (isset($_POST['id']) ? '更新' : '发布') . "成功！");
        } else {
            flash("展板" . (isset($_POST['id']) ? '更新' : '发布') . "失败！");
        }
    } else {
        flash("图片上传失败！");
    }
    header("Location: index.php");
}

/* 如果存在展板 id（来自编辑页面的展板 id），获取展板信息 */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM banners WHERE id=$id";
    $result = $conn->query($sql);
    $banner = $result->fetch_assoc();
    $result->free();
}
?>
<div class="admin-banners-post">
    <h1>展板发布</h1>
    <form action="admin_banners_post.php" method="post" enctype="multipart/form-data">
        <?php if (isset($banner)): ?>
            <input type="hidden" name="id" value="<?php echo $banner['id']; ?>">
        <?php endif; ?>
        <div class="admin-banners-post-title">
            <label for="title">标题：</label>
            <input type="text" name="title" id="title"
                   <?php echo isset($banner) ? 'value="' . $banner['title'] . '"' : ''; ?>required>
        </div>
        <input type="file" name="pic" id="pic" required>
        <div id="preview" onclick="document.getElementById('pic').click()">
            <p>图片预览（点击上传图片）</p>
        </div>
        <div class="admin-banners-post-content">
            <label for="content">内容：</label>
            <textarea name="content" id="content" cols="30" rows="10"
                      required><?php echo isset($banner) ? $banner['content'] : ''; ?></textarea>
        </div>
        <input type="submit" value="<?php echo isset($banner) ? '更新' : '发布'; ?>">
    </form>
</div>
<script>
    window.onload = function () {
        // 获取图片输入元素和预览元素
        let picInput = document.getElementById('pic');
        let preview = document.getElementById('preview');

        // 如果存在展板图片，显示展板图片
        <?php if (isset($banner)): ?>
        preview.style.backgroundImage = 'url(<?php echo $ROOT_PATH . 'uploads/banner/' . $banner['pic']; ?>)';
        preview.textContent = '';
        <?php endif; ?>

        // 当图片输入元素的值改变时（即用户选择了一个新的图片文件），更新预览图片
        picInput.onchange = function () {
            let file = picInput.files[0];
            let reader = new FileReader();

            reader.onloadend = function () {
                // 当文件读取完成后，更新预览图片的 src 属性
                preview.style.backgroundImage = 'url(' + reader.result + ')';
                preview.textContent = '';
            }

            if (file) {
                // 如果用户选择了一个文件，读取这个文件
                reader.readAsDataURL(file);
            } else {
                // 如果用户没有选择文件，显示默认文本
                preview.style.backgroundImage = '';
                preview.textContent = '图片预览';
            }
        }
    }
</script>