<?php
session_start();
include '../config/DBconnect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

// Lấy từ khóa tìm kiếm từ URL
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($query !== '') {
    // Truy vấn tìm kiếm sản phẩm theo tên
    $sql = "SELECT id, name, price, image_url FROM products WHERE name LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
}

$conn->close();
?>
