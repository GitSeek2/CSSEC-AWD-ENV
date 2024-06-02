<?php
// index.php
// 展示 logo nav notice search-box article-list
include_once "includes/config.php";
global $conn;
global $ROOT_PATH;

// 如果权限为 0，跳转到登录页面
if (isset($_SESSION['power']) && $_SESSION['power'] == 0) {
    header("Location: " . $ROOT_PATH . "login.php");
}

function getBanners($conn, $ROOT_PATH): array
{
    $sql = "SELECT * FROM banners";
    $result = mysqli_query($conn, $sql);
    $banners = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $banners[] = $row;
        }
    } else {
        // 输出默认的 banner
        $banners[] = [
            'title' => 'CSSEC CMS',
            'pic' => $ROOT_PATH . 'uploads/banner/cssec-cms.jpg',
            'content' => 'CSSEC CMS 0.0.1',
        ];
    }
    return $banners;
}

$banners = getBanners($conn, $ROOT_PATH);

if (isset($_GET['async']) && $_GET['async'] == 1) {
    $count = $_GET['count'];
    $limit = 5; // 每次加载的文章数量

    $sql = "SELECT * FROM articles ORDER BY id DESC LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $count, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $articles = [];
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $key => $value) {
            $row['content'] = strip_tags($row['content']);
            $row['content'] = str_replace('&nbsp;', '', $row['content']);
            $row['content'] = mb_substr($row['content'], 0, 100, 'utf-8');
        }
        $articles[] = $row;
    }

    if (count($articles) == 0) {
        echo json_encode(['message' => '已显示所有文章']);
    } else {
        echo json_encode($articles);
    }
    exit;
}
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

<section class="notice container">
    <?php
    $sql = "SELECT * FROM notices ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $notice = mysqli_fetch_assoc($result);
        echo "<h2>{$notice['title']}</h2>";
        echo "<p>{$notice['content']}</p>";
    } else {
        echo "<h2>暂无公告，宁静的一天~</h2>";
    }
    ?>
</section>

<section class="articles container">
    <ul class="article-list">
        <?php
        $sql = "SELECT * FROM articles ORDER BY id DESC LIMIT 5";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li class='article-item'>";
                echo "<h3 class='article-title'>{$row['title']}</h3>";
                $row['content'] = str_replace('&nbsp;', '', $row['content']);
                $row['content'] = strip_tags($row['content']);
                $row['content'] = mb_substr($row['content'], 0, 100, 'utf-8');
                echo "<p class='article-content-outline'>{$row['content']}</p>";
                echo "<small class='article-meta'>";
                echo "<span class='article-time'>{$row['created_at']}</span>";
                echo "<a href='{$ROOT_PATH}article.php?id={$row['id']}' class='article-read-all'>阅读全文 >>></a>";
                echo "</small>";
                echo "</li>";
            }
        } else {
            echo "<li class='article-item'>";
            echo "<h3 class='article-title'>暂无文章，无趣！</h3>";
            echo "</li>";
        }
        ?>
    </ul>
    <!--更多文章按钮，异步请求-->
    <button id="more-articles" class="btn">更多文章</button>
</section>

<?php
include_once "includes/footer.php";
?>

</body>

</html>