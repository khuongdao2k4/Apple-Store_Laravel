<?php
session_start();

// Nạp cấu hình
require_once '../app/config/config.php';
require_once '../app/config/database.php';

// Route cơ bản
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
if ($url === '' || $url === 'index.php') {
    $url = 'home';
}

// Tránh lỗi Directory Traversal
$url = basename($url);

$pagePath = "../app/views/pages/{$url}.php";

// Kiểm tra xem file view tương ứng có tồn tại không
if (file_exists($pagePath)) {
    require_once $pagePath;
} else {
    // Xử lý 404 Not Found
    http_response_code(404);
    echo "<h1 style='text-align:center; margin-top:50px;'>404 - Trang không tồn tại (Page Not Found)</h1>";
    echo "<p style='text-align:center;'><a href='" . BASE_URL . "'>Trở về trang chủ</a></p>";
}
?>
