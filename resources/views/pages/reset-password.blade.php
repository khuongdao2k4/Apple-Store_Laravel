@extends('layouts.app', ['pageTitle' => 'reset-password.php'])

@section('content')
<?php

 // Đảm bảo đường dẫn đúng

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Kiểm tra xem email có tồn tại không
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $message = "Email không tồn tại. Vui lòng kiểm tra lại!";
    } elseif ($new_password !== $confirm_password) {
        $message = "Password xác nhận không khớp!";
    } else {
        // Mã hóa mật khẩu trước khi lưu
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Cập nhật mật khẩu mới vào database
        $stmt_update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt_update->bind_param("ss", $hashed_password, $email);

        if ($stmt_update->execute()) {
            $message = "Đặt lại mật khẩu thành công!";
            $success = true;
        } else {
            $message = "Có lỗi xảy ra, vui lòng thử lại!";
        }

        $stmt_update->close();
    }
    $stmt->close();
    $conn->close();
}
?>



<div class="header-container">
    <h3 style="font-size: 25px"><b>Apple Account</b></h3>
    <div class="nav-menu">
        <a href="login" style="text-decoration: none;">Đăng Nhập</a>
        <a href="register" style="text-decoration: none;">Tạo Tài khoản Apple</a>
        <a href="#" style="text-decoration: none;">Những Câu Hỏi Thường Gặp</a>
    </div>
</div>
<div class="info-bar mb-4">
    ID Apple bây giờ là Tài khoản Apple. Nhập email của bạn để thiết lập lại mật khẩu an toàn. <a href="#">Tìm hiểu thêm</a>
</div>
<div class="container">
    <div class="login-container">
        <div class="text-center mb-3">
            <i class="fa fa-lock" style="font-size: 48px; color: #1d1d1f;"></i>
        </div>
        <h2 class="text-center fw-bold mb-3" style="font-size: 28px; letter-spacing: -0.02em;">Khôi phục Mật khẩu</h2>
        <p class="text-center text-muted mb-4" style="font-size: 15px;">Vui lòng nhập Email và mật khẩu mới để thiết lập lại.</p>

        <?php if (isset($message)): ?>
            <div class="alert <?= isset($success) ? 'alert-success' : 'alert-danger' ?> text-start">
                <?= $message; ?>
            </div>
            <?php if (isset($success)): ?>
                <div class="text-center mb-4">
                    <a href="login" class="btn btn-outline-primary btn-sm rounded-pill px-4">Đăng nhập ngay</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="apple-input-group mb-4">
                <input type="email" class="apple-input" name="email" placeholder="Email đăng nhập" required>
                <div class="apple-input-divider"></div>
                <input type="password" class="apple-input" name="new_password" placeholder="Mật khẩu mới" required>
                <div class="apple-input-divider"></div>
                <input type="password" class="apple-input" name="confirm_password" placeholder="Xác nhận Mật khẩu" required>
            </div>
            
            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-primary btn-apple-login">Cài đặt lại Mật khẩu <i class="fa fa-arrow-right ms-2" style="font-size: 14px;"></i></button>
            </div>
            
            <hr class="my-4 text-muted" style="opacity: 0.15;">
            
            <div class="text-center text-muted" style="font-size: 15px;">
                Bạn nhớ ra mật khẩu? <a href="login" class="text-primary text-decoration-none" style="font-weight: 500;">Quay lại Đăng nhập.</a>
            </div>
        </form>
    </div>
</div>

<hr>
<h5 class="text-center my-4" style="font-size:16px;">
    Bạn cần hỗ trợ thêm? <a href="#" class="text-primary text-decoration-none">Chat ngay</a> (Mở trong cửa sổ mới) hoặc gọi 1800-1192.
</h5>
<hr style="margin-bottom:0px">



@endsection

