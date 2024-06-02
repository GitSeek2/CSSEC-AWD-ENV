<?php
// /register.php
include_once "includes/config.php";
global $conn;
global $ROOT_PATH;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword'])) {
    $username = $_POST['username'];
    $password_md5 = md5($_POST['password']);
    $repassword_md5 = md5($_POST['repassword']);

    if ($password_md5 !== $repassword_md5) {
        flash("两次输入的密码不一致，请重新输入！");
        header("Location: " . $ROOT_PATH . "register.php");
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            flash("用户名已存在，请更换用户名后重新注册！");
            header("Location: " . $ROOT_PATH . "register.php");
        } else {
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password_md5')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                flash("注册成功，欢迎你的加入，" . $username . "！");
                header("Location: " . $ROOT_PATH . "login.php");
            } else {
                flash("注册失败，请检查参数后重新注册！");
                header("Location: " . $ROOT_PATH . "register.php");

            }
        }
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

<form action="register.php" class="login-form register" method="post">
    <h2>注册 CSSEC CMS</h2>
    <div class="form-group">
        <label for="username"></label>
        <input type="text" id="username" name="username" placeholder="请输入用户名" required>
    </div>
    <div class="form-group">
        <label for="password"></label>
        <input type="password" id="password" name="password" placeholder="请输入密码" required>
    </div>
    <div class="form-group">
        <label for="repassword"></label>
        <input type="password" id="repassword" name="repassword" placeholder="请再次输入密码" required>
    </div>
    <div class="form-group">
        <input type="submit" value="注册">
    </div>

    <a href="<?php echo $ROOT_PATH . "login.php"; ?>">已经有账号？点击登录</a>
</form>
<?php
include_once "includes/footer.php";
?>
</body>
</html>
