<?php

 // Kết nối database

// Kiểm tra nếu user đã đăng nhập và có quyền admin
if (!isset($_SESSION['role']) == 'admin') {
    echo "<script>alert('Bạn không có quyền truy cập!'); window.location.href = 'mua-iphone';</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $image_url = $_POST['image_url'];
    $colors = $_POST['colors'];
    $price = $_POST['price'];

    // Chuẩn bị truy vấn SQL để thêm sản phẩm
    $stmt = $conn->prepare("INSERT INTO products (name, image_url, colors, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $image_url, $colors, $price);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm sản phẩm thành công!'); window.location.href = 'mua-iphone';</script>";
    } else {
        echo "<script>alert('Lỗi khi thêm sản phẩm!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<?php
$pageTitle = "add-product.php";
require_once '../app/views/layouts/header.php';
require_once '../app/views/layouts/navbar.php';
?>

<h5 style="font-weight: bold; padding-left: 300px; padding-top: 10px;">Thêm Sản Phẩm </h5>

    <div class="banner">
        <div class="text-content">
            <h1>Phối. Hợp. MagSafe.</h1>
            <p>Gắn thêm ốp lưng, ví hoặc bộ sạc không dây.</p>
            <a href="#">Mua MagSafe &gt;</a>
        </div>
    </div>

    <div class="add-product-container">
        <h2>Thêm Sản Phẩm</h2>
        <br>
        <?php
        if (isset($_GET['message'])) {
            echo '<div class="alert alert-success">' . htmlspecialchars($_GET['message']) . '</div>';
        }
        ?>
        <form action="add-product" method="POST">

            <div class="row mb-3">
                <input style="border-radius:20px" type="text" class="form-control" id="name" name="name"
                    placeholder="Tên Sản Phẩm" required>
            </div>

            <div class="row mb-3">
                <input style="border-radius:20px" type="url" class="form-control" id="image_url" name="image_url"
                    placeholder="URL Image" required>
            </div>

            <div class="row mb-3">
                <input style="border-radius:20px" type="text" class="form-control" id="colors" name="colors"
                    placeholder="Color" required>
            </div>

            <div class="row mb-3">
                <input style="border-radius:20px" type="text" class="form-control" id="price" name="price"
                    placeholder="Price" required>
            </div>

            <div class="d-grid">
                <button style="border-radius:20px" type="submit" class="btn btn-primary ">Thêm sản phẩm</button>
            </div>
        </form>
    </div>

<?php
require_once '../app/views/layouts/footer.php';
?>
