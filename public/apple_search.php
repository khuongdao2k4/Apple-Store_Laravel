<?php
// Tắt nạp layout để chỉ trả về JSON
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

require_once '../app/config/config.php';
require_once '../app/config/database.php';

// Lấy từ khóa tìm kiếm từ URL
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($query !== '') {
    // Truy vấn tìm kiếm sản phẩm theo tên
    $sql = "SELECT id, name, price, image_url FROM products WHERE name LIKE ? ORDER BY name ASC LIMIT 10";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        // Đảm bảo đường dẫn ảnh chính xác
        if (!preg_match('/^https?:\/\//', $row['image_url'])) {
            $row['image_url'] = BASE_URL . 'public/assets/img/' . $row['image_url'];
        }
        $products[] = $row;
    }

    echo json_encode($products);
} else {
    echo json_encode([]);
}

$conn->close();
?>
