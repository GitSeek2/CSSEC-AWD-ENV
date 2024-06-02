<?php
// /login.php
include_once "includes/config.php";
global $conn;
global $ROOT_PATH;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password_md5 = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password_md5'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['power'] = $row['power'];
        $_SESSION['user_id'] = $row['id'];
        if ($_SESSION['power'] >= 2) {
            flash("欢迎你，管理员" . $row['username']);
        } else {
            flash("欢迎你，" . $row['username']);
        }
        header("Location: " . $ROOT_PATH . "index.php");
    } else {
        flash("用户名或密码错误，请重新输入！");
        header("Location: " . $ROOT_PATH . "login.php");
    }
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

<form action="login.php" class="login-form" method="post">
    <h2>登录 CSSEC CMS</h2>
    <div class="form-group">
        <label for="username"></label>
        <input type="text" id="username" name="username" placeholder="请输入用户名" required>
    </div>
    <div class="form-group">
        <label for="password"></label>
        <input type="password" id="password" name="password" placeholder="请输入密码" required>
    </div>
    <div class="form-group">
        <input type="submit" value="登录">
    </div>

    <a href="<?php echo $ROOT_PATH . "register.php"; ?>">还没有账号？点击注册</a>
</form>
<?php
include_once "includes/footer.php";
?>
</body>
</html>
