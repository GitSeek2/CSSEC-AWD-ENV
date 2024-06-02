<?php
// /about.php
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
<section class="about container">
    <div class="cssec">
        <h2>信息安全组 | CSSEC</h2>
        <p>信息安全组，简称信安组，也称 CSSEC，是 四川师范大学IT培优 项目下编程组所属的一个学习小组。</p>
        <p>小组致力于在川师计科学院营造良好的网络安全 & CTF 学习氛围。</p>
    </div>

    <div class="cssec-cms">
        <h2>CSSEC CMS</h2>
        <p>
            CSSEC CMS 是一个简单的内容管理系统，基于 PHP 语言开发，使用 MySQL 数据库存储数据，用作信安组 AWD 练习的 Web 题目。由于开发周期比较短，如你所见它还存在很多不完美的地方。
        </p>
    </div>

    <div class="seek2-team">
        <h2>Seek2 Team</h2>
        <p>一个专注于 CTF 赛事的团队，我们希望它能更加纯粹。</p>
    </div>

    <div class="contact">
        <h2>联系我们</h2>
        <img src="<?php echo $ROOT_PATH . "static/images/cssec2024.jpg"; ?>" alt="cssec2024">
    </div>
</section>
<?php
include_once "includes/footer.php";
?>
</body>
</html>
