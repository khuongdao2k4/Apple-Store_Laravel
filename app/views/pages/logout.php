<?php
// XỬ LÝ ĐĂNG XUẤT (LOGOUT)
// Logic này phải được chạy TRƯỚC KHI có bất kỳ mã HTML nào được xuất ra trình duyệt.

// Đảm bảo session đã được bắt đầu (thông thường đã được khởi tạo ở public/index.php)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Xóa toàn bộ biến session
session_unset();

// Hủy bỏ session hiện tại
session_destroy();

// Chuyển hướng người dùng về trang chủ
// URL_ROOT hoặc hằng số BASE_URL đã được nạp từ config/config.php (nếu index.php chạy)
header("Location: " . BASE_URL);
exit();
?>
