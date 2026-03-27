<?php
session_start();
include '../config/DBconnect.php'; // Đảm bảo đường dẫn chính xác

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ form
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $product = $_POST['name'] ?? '';
    $storage = $_POST['storage'] ?? '';
    $color = $_POST['color'] ?? '';
    $price = $_POST['price'] ?? '';
    $image_url = $_POST['image_url'] ?? '';

    //Kiểm tra dữ liệu
    echo "Dữ liệu nhận được:\n";
    var_dump($_POST);
    
    // Kiểm tra dữ liệu hợp lệ
    if ( empty($product) || empty($storage) || empty($color) || empty($price) || empty($image_url)) {
        die("Thiếu dữ liệu, vui lòng kiểm tra lại.");
    }
    
    // Bắt đầu giao dịch để đảm bảo dữ liệu đồng nhất
    $conn->begin_transaction();
    
    try {

        // Giảm số lượng sản phẩm đi 1
        $stmt_update = $conn->prepare("UPDATE products SET quantity = quantity - 1 WHERE name = ?");
        if ($stmt_update === false) {
            throw new Exception("Lỗi prepare (update): " . $conn->error);
        }
        $stmt_update->bind_param("s", $product);
        if ($stmt_update->execute() === false) {
            throw new Exception("Lỗi execute (update): " . $stmt_update->error);
        }

        // Chèn đơn hàng vào bảng orders
        $stmt_insert = $conn->prepare("INSERT INTO orders (username, email, product, image_url, storage, color, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt_insert === false) {
            throw new Exception("Lỗi prepare (insert): " . $conn->error);
        }
        $stmt_insert->bind_param("sssssss", $username, $email, $product, $image_url, $storage, $color, $price);
        if ($stmt_insert->execute() === false) {
            throw new Exception("Lỗi execute (insert): " . $stmt_insert->error);
        }

        // Hoàn tất giao dịch
        $conn->commit();

        // Chuyển hướng sau khi đặt hàng thành công
        header("Location: apple_order-detail.php?name=" . urlencode($product) .
        "&price=" . urlencode($price) .
        "&storage=" . urlencode($storage) .
        "&color=" . urlencode($color) .
        "&image_url=" . urlencode($image_url));
        exit();

    } catch (Exception $e) {
        $conn->rollback(); // Hoàn tác nếu có lỗi xảy ra
        die("Lỗi: " . $e->getMessage());
    } finally {
        // Đảm bảo đóng các statement và connection
        if (isset($stmt_check) && $stmt_check !== false) $stmt_check->close();
        if (isset($stmt_update) && $stmt_update !== false) $stmt_update->close();
        if (isset($stmt_insert) && $stmt_insert !== false) $stmt_insert->close();
        $conn->close();
    }

} else {
    die("Yêu cầu không hợp lệ.");
}
?>