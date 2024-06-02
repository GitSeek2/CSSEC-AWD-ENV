<?php
// /install.php
// 初始化数据库
include_once "includes/config.php";
global $conn;

$sql = "
DROP TABLE IF EXISTS articles;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS banners;
DROP TABLE IF EXISTS notices;

CREATE TABLE users(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, -- id 主键，无符号，自增
   username VARCHAR(30) NOT NULL UNIQUE,
   password VARCHAR(32) NOT NULL,
   power INT(1) NOT NULL default 1, -- 用户权限，0 - 不允许访问，1 - 允许访问，2 - 允许编辑，3 - 允许管理
   created_at TIMESTAMP default CURRENT_TIMESTAMP -- 用户创建时间戳，默认就是注册时的当前时间戳
);

CREATE TABLE articles(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, -- id 主键，无符号，自增
   title VARCHAR(30) NOT NULL,
   content TEXT NOT NULL,
   created_at TIMESTAMP default CURRENT_TIMESTAMP, -- 文章创建时间戳，默认就是注册时的当前时间戳
   updated_at TIMESTAMP default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- 文章创建时间戳，默认就是数据库更新时时间戳
   author_id INT(6) UNSIGNED NOT NULL,
   FOREIGN KEY(author_id) REFERENCES users(id) -- 作者 id 外键
);

CREATE TABLE banners(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, -- id 主键，无符号，自增
   title VARCHAR(30) NOT NULL,
   pic VARCHAR(255) NOT NULL,
   content TEXT NOT NULL,
   created_at TIMESTAMP default CURRENT_TIMESTAMP -- 文章创建时间戳，默认就是注册时的当前时间戳
);

CREATE TABLE notices(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, -- id 主键，无符号，自增
   title VARCHAR(30) NOT NULL,
   content TEXT NOT NULL,
   created_at TIMESTAMP default CURRENT_TIMESTAMP -- 文章创建时间戳，默认就是注册时的当前时间戳
);
";

if (file_exists("install.lock")) {
    flash("数据库已经初始化！");
    header("Location: index.php");
    exit();
}

// 执行 sql 语句，检查是否报错
if ($conn->multi_query($sql)) {
    do {
        // 存储第一个结果集
        if ($result = $conn->store_result()) {
            $result->free();
        }
        // 如果还有更多的结果
        if ($conn->more_results()) {
            // 准备下一个结果集
            if (!$conn->next_result()) {
                // 如果 next_result() 返回 false，那么打印出错误信息
                echo "Error preparing next result: " . $conn->error;
                $conn->close();
                exit();  // Exit the script if table creation failed
            }
        } else {
            break;
        }
    } while (true);
    echo "数据库初始化成功！";
    // 向文件写值，标记数据库已经初始化
    file_put_contents("install.lock", "true");
    flash("数据库初始化成功！");
    header("Location: index.php");
} else {
    echo "数据库初始化失败！";
}