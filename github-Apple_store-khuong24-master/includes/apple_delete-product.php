<?php
session_start();
require '../config/DBconnect.php'; // Kết nối database

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Sản phẩm đã được xóa!'); window.location.href='apple_mua-iphone.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>
