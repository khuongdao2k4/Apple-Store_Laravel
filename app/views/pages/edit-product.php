<?php

 // Kết nối database

// Kiểm tra nếu user đã đăng nhập và có quyền admin
if (!isset($_SESSION['role']) == 'admin') {
    echo "<script>alert('Bạn không có quyền truy cập!'); window.location.href = 'mua-iphone';</script>";
}

// Lấy thông tin sản phẩm từ database
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "<script>alert('Sản phẩm không tồn tại!'); window.location.href='product_list.php';</script>";
        exit();
    }
}

// Xử lý cập nhật sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $image_url = $_POST['image_url'];
    $colors = $_POST['colors'];
    $price = $_POST['price'];

    $update_query = "UPDATE products SET name=?, image_url=?, colors=?, price=? WHERE id=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssi", $name, $image_url, $colors, $price, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href='mua-iphone';</script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật sản phẩm!');</script>";
    }
    $stmt->close();
}

$conn->close();
?>

<?php
$pageTitle = "edit-product.php";
require_once '../app/views/layouts/header.php';
require_once '../app/views/layouts/navbar.php';
?>

<h5 style="font-weight: bold; padding-left: 300px; padding-top: 10px;">Chỉnh Sửa Sản Phẩm </h5>

    <div class="banner">
        <div class="text-content">
            <h1>Phối. Hợp. MagSafe.</h1>
            <p>Gắn thêm ốp lưng, ví hoặc bộ sạc không dây.</p>
            <a href="#">Mua MagSafe &gt;</a>
        </div>
    </div>

    <div class="add-product-container">
        <h2>Chỉnh Sửa Sản Phẩm</h2>
        <br>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <div class="row mb-3">
                <input style="border-radius:20px" type="text" class="form-control" name="name"
                    value="<?php echo htmlspecialchars($product['name']); ?>" placeholder="Tên Sản Phẩm" required>
            </div>

            <div class="row mb-3">
                <input style="border-radius:20px" type="url" class="form-control" name="image_url"
                    value="<?php echo htmlspecialchars($product['image_url']); ?>" placeholder="URL Image" required>
            </div>

            <div class="row mb-3">
                <input style="border-radius:20px" type="text" class="form-control" name="colors"
                    value="<?php echo htmlspecialchars($product['colors']); ?>" placeholder="Color" required>
            </div>

            <div class="row mb-3">
                <input style="border-radius:20px" type="text" class="form-control" name="price"
                    value="<?php echo htmlspecialchars($product['price']); ?>" placeholder="Price" required>
            </div>

            <div class="d-grid">
                <button style="border-radius:20px" type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
            </div>
        </form>
    </div>

<?php
require_once '../app/views/layouts/footer.php';
?>
