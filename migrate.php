<?php
// Script tạo database và import dữ liệu từ file SQL
$host = "localhost";
$user = "root";
$pass = "";
$dbName = "phone_website";

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Kết nối thất bại, hãy chắc chắn bạn đã bật MySQL trong XAMPP: " . $conn->connect_error);
}

// Chuyển UTF-8
$conn->set_charset("utf8mb4");

// Tạo database nếu chưa có
if ($conn->query("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci") === TRUE) {
    echo "Database `$dbName` được tạo / đã tồn tại.<br>";
} else {
    die("Lỗi tạo database: " . $conn->error);
}

// Chọn db
$conn->select_db($dbName);

// Đọc và chạy file SQL
$sqlFile = 'phone_website.sql';
if (file_exists($sqlFile)) {
    $sql = file_get_contents($sqlFile);
    if ($conn->multi_query($sql)) {
        do {
            if ($res = $conn->store_result()) {
                $res->free();
            }
        } while ($conn->more_results() && $conn->next_result());
        echo "<h3> Import dữ liệu thành công! </h3>";
        echo "<br><br><a href='public/' style='padding: 10px 20px; background: #007bff; color: #fff; text-decoration: none; border-radius: 5px;'>🚀 Nhấn vào đây để vào Trang Chủ</a>";
    } else {
        echo "Lỗi import file SQL: " . $conn->error;
    }
} else {
    echo "Không tìm thấy file bằng $sqlFile";
}
$conn->close();
?>