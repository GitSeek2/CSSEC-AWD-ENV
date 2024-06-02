<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// /includes/config.php
include_once 'DatabaseConnector.php';
include_once 'functions.php';

$severname = 'localhost';
$username = 'root';
$password = 'root';
$database = 'csseccms001';

$db = DatabaseConnector::getInstance($severname, $username, $password, $database);
$conn = $db->getConnection(); // 获取数据库连接对象
$ROOT_PATH = getRootPath(); // 获取根目录相对路径

$messages = get_flashed_messages();
if ($messages && count($messages) > 0) {
    echo "<div class='flash'>";
    foreach ($messages as $message) {
        echo "<div class='flash-message'>$message</div>";
    }
    echo "</div>";
}