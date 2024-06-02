<?php
include_once "includes/config.php";
global $conn;
global $ROOT_PATH;
?>
<nav>
    <ul class="nav-list">
        <li class="nav-item"><a href="<?php echo $ROOT_PATH . "index.php"; ?>">首页</a></li>
        <li class="nav-item"><a href="<?php echo $ROOT_PATH . "about.php"; ?>">关于</a></li>
        <?php
        // power >=2 允许编辑 | power >=3 允许管理
        if (isset($_SESSION['power']) && $_SESSION['power'] >= 2) {
            echo "<li class='nav-item admin-operate'><a href='" . $ROOT_PATH . "post.php'>发布</a></li>";
        }
        if (isset($_SESSION['power']) && $_SESSION['power'] >= 3) {
            echo "<li class='nav-item admin-operate'><a href='" . $ROOT_PATH . "admin/index.php'>管理</a></li>";
        }
        ?>
    </ul>
    <ul class="account-operate">
        <?php
        if (isset($_SESSION['username'])) {
            echo "<li class='nav-item'><a>欢迎您，" . $_SESSION['username'] . "</a></li>";
            echo "<li class='nav-item'><a href='" . $ROOT_PATH . "logout.php'>注销</a></li>";
        } else {
            echo "<li class='nav-item'><a href='" . $ROOT_PATH . "login.php'>登录</a></li>";
            echo "<li class='nav-item'><a href='" . $ROOT_PATH . "register.php'>注册</a></li>";
        }
        ?>
    </ul>
</nav>