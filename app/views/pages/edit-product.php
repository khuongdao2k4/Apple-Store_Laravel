<?php
// Kiểm tra nếu user đã đăng nhập và có quyền admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Bạn không có quyền truy cập!'); window.location.href = 'mua-iphone';</script>";
    exit();
}

include_once '../app/config/database.php'; // Đảm bảo kết nối CSDL

// Lấy và xử lý dữ liệu POST trước
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
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
        exit();
    } else {
        echo "<script>alert('Lỗi khi cập nhật sản phẩm!');</script>";
    }
    $stmt->close();
}

// Sau đó mới lấy thông tin GET để hiển thị
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "<script>alert('Sản phẩm không tồn tại!'); window.location.href='mua-iphone';</script>";
        exit();
    }
} else {
    // Chỉ chuyển hướng nếu không phải là yêu cầu POST thành công
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: mua-iphone");
        exit();
    }
}


// Dữ liệu đã được xử lý ở phía trên, không cần khối này nữa


$pageTitle = "edit-product.php";
require_once '../app/views/layouts/header.php';
require_once '../app/views/layouts/navbar.php';
?>

<h5 class="page-title">Chỉnh Sửa Sản Phẩm</h5>

<div class="banner">
    <div class="text-content">
        <h1>Phối. Hợp. MagSafe.</h1>
        <p>Gắn thêm ốp lưng, ví hoặc bộ sạc không dây.</p>
        <a href="#">Mua MagSafe &gt;</a>
    </div>
</div>

<div class="edit-product-container">
    <h2>Chỉnh Sửa Sản Phẩm</h2>
    
    <form action="edit-product" method="POST">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

        <div class="mb-4">
            <input type="text" class="form-control" id="name" name="name" 
                value="<?php echo htmlspecialchars($product['name']); ?>" placeholder="Tên Sản Phẩm" required>
        </div>

        <div class="mb-4">
            <input type="url" class="form-control" id="image_url" name="image_url" 
                value="<?php echo htmlspecialchars($product['image_url']); ?>" placeholder="URL Hình ảnh sản phẩm" required>
            <div id="image-preview-container">
                <img id="image-preview" src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="Preview">
            </div>
        </div>

        <div class="mb-4">
            <input type="text" class="form-control" id="colors" name="colors" 
                value="<?php echo htmlspecialchars($product['colors']); ?>" placeholder="Màu sắc (VD: gray, silver)" required>
        </div>

        <div class="mb-4">
            <input type="number" class="form-control" id="price" name="price" 
                value="<?php echo htmlspecialchars($product['price']); ?>" placeholder="Giá sản phẩm" required>
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        </div>
    </form>
</div>


<?php
require_once '../app/views/layouts/footer.php';
?>

