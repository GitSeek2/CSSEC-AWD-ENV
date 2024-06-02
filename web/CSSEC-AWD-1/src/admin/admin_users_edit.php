<?php
// /admin/admin_users_edit.php
include_once "../includes/config.php";
global $conn;
global $ROOT_PATH;

include_once "admin_check.php";

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    // 查询用户名
    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $username = $result->fetch_assoc()['username'];
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    flash("用户 " . $username . " 已删除");
    header("Location: " . $ROOT_PATH . "admin/index.php?action=edit&target=users");
    exit;
}

if (isset($_POST['action']) && $_POST['action'] == 'reset') {
    $id = $_POST['id'];
    $password = md5('123456');
    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $password, $id);
    $stmt->execute();
    // 查询用户名
    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $username = $result->fetch_assoc()['username'];
    flash("用户 " . $username . " 的密码已重置为 123456");
    header("Location: " . $ROOT_PATH . "admin/index.php?action=edit&target=users");
    exit;
}

if (isset($_POST['id']) && isset($_POST['power'])) {
    $id = $_POST['id'];
    $power = $_POST['power'];
    $sql = "UPDATE users SET power = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $power, $id);
    $stmt->execute();
    // 查询用户名
    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $username = $result->fetch_assoc()['username'];
    flash("用户 " . $username . " 的权限已更新为 " . ($power == 0 ? "不允许访问" : ($power == 1 ? "允许访问" : ($power == 2 ? "允许编辑" : "允许管理"))));
    header("Location: " . $ROOT_PATH . "admin/index.php?action=edit&target=users");
    exit;
}
?>
<div class="admin-users-edit">
    <h1>用户管理</h1>
    <table>
        <tr>
            <th>用户名</th>
            <th>权限</th>
            <th>注册时间</th>
            <th>操作</th>
        </tr>
        <?php
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td>
                        <form action="admin_users_edit.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <label>
                                <select name="power" onchange="this.form.submit()">
                                    <option value="0" <?php if ($row['power'] == 0) echo "selected"; ?>>不允许访问
                                    </option>
                                    <option value="1" <?php if ($row['power'] == 1) echo "selected"; ?>>允许访问
                                    </option>
                                    <option value="2" <?php if ($row['power'] == 2) echo "selected"; ?>>允许编辑
                                    </option>
                                    <option value="3" <?php if ($row['power'] == 3) echo "selected"; ?>>允许管理
                                    </option>
                                </select>
                            </label>
                        </form>
                    </td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <form action="admin_users_edit.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="submit" value="删除用户"
                                   onclick="return confirmDeleteUser('<?php echo $row['username']; ?>')">
                        </form>
                        <form action="admin_users_edit.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="action" value="reset">
                            <input type="submit" value="重置密码"
                                   onclick="return confirmResetPassword('<?php echo $row['username']; ?>')">
                        </form>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
<script>
    function confirmDeleteUser(username) {
        return confirm("确定要删除用户 " + username + " 吗？");
    }

    function confirmResetPassword(username) {
        return confirm("确定要重置用户 " + username + " 的密码吗？");
    }
</script>
