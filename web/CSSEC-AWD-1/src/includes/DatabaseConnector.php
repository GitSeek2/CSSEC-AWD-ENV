<?php
// /includes/DatabaseConnector.php

class DatabaseConnector
{
    private static $instance = null;
    private $conn;

    private function __construct($servername, $username, $password, $dbname)
    {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("连接失败: " . $this->conn->connect_error);
        }
    }

    public static function getInstance($servername, $username, $password, $dbname)
    {
        if (self::$instance == null) {
            self::$instance = new DatabaseConnector($servername, $username, $password, $dbname);
        }
        return self::$instance;
    }

    public function getConnection(): mysqli
    {
        return $this->conn;
    }
}