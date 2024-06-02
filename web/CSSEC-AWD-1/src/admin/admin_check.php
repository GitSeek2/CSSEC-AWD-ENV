<?php
include_once "../includes/config.php";
global $ROOT_PATH;
if (!isset($_SESSION['username']) || $_SESSION['power'] < 3) {
    flash("越权操作！");
    header("Location: " . $ROOT_PATH . "index.php");
    exit;
}