<?php
$configDB = array();
$configDB["host"] = "sql213.iceiy.com";
$configDB["database"] = "icei_37931888_webgiay";
$configDB["username"] = "icei_37931888";
$configDB["password"] = "mfviF5xLOq0G";
define("HOST", "sql213.iceiy.com");
define("DB_NAME", "icei_37931888_webgiay");
define("DB_USER", "icei_37931888");
define("DB_PASS", "mfviF5xLOq0G");
define('ROOT', dirname(dirname(__FILE__)));
//Thu muc tuyet doi truoc cua config; c:/wamp/www/lab/
define("BASE_URL", "http://" . $_SERVER['SERVER_NAME'] . "/lab/");//dia chi website


try {
    // Tạo đối tượng PDO và kết nối đến cơ sở dữ liệu
    $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    // Đặt chế độ lỗi của PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Nếu không thể kết nối, hiển thị lỗi
    echo "Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage();
    exit;
}