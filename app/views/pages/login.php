<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, firstname, lastname, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Lưu ID người dùng vào session
            $_SESSION['user_name'] = $user['firstname'] . ' ' . $user['lastname'];
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $user['role'];

            $_SESSION['success'] = "Đăng nhập thành công!";
            header("Location: home");
            exit();
        } else {
            $_SESSION['error'] = "Mật khẩu không đúng!";
        }
    } else {
        $_SESSION['error'] = "Email không tồn tại!";
    }
}
?>

<?php
$pageTitle = "login.php";
require_once '../app/views/layouts/header.php';
require_once '../app/views/layouts/navbar.php';
?>

<div class="header-container">
        <h3 style="font-size: 25px"><b>Apple Account</b></h3>
        <div class="nav-menu">
            <a href="register" style="text-decoration: none;">Register</a>
            <a href="register" style="text-decoration: none;">Tạo Tài khoản Apple</a>
            <a href="#" style="text-decoration: none;">Những Câu Hỏi Thường Gặp</a>
        </div>
    </div>
    <div class="info-bar mb-4">
        ID Apple bây giờ là Tài khoản Apple. Bạn vẫn có thể đăng nhập bằng cùng địa chỉ email hoặc số điện thoại và mật khẩu như trước đây. <a href="#">Tìm hiểu thêm</a>
    </div>
    <div class="container">
        <div class="login-container">
            <div class="text-center mb-3">
                <i class="fab fa-apple" style="font-size: 48px; color: #1d1d1f;"></i>
            </div>
            <h2 class="text-center fw-bold mb-3" style="font-size: 30px; letter-spacing: -0.02em;">Tài khoản Apple</h2>
            <p class="text-center text-muted mb-4" style="font-size: 17px;">Quản lý Tài khoản Apple của bạn</p>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger text-start"> <?= $_SESSION['error'];
                unset($_SESSION['error']); ?> </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success text-start"> <?= $_SESSION['success'];
                unset($_SESSION['success']); ?> </div>
            <?php endif; ?>

            <form action="login" method="POST">
                <div class="apple-input-group mb-4">
                    <input type="email" class="apple-input" name="email" placeholder="Email hoặc Số điện thoại" required>
                    <div class="apple-input-divider"></div>
                    <input type="password" class="apple-input" name="password" placeholder="Mật khẩu" required>
                </div>
                
                <div class="remember-me mb-4 d-flex justify-content-between align-items-center px-1">
                    <div class="form-check text-start mb-0">
                        <input class="form-check-input" type="checkbox" id="remember" style="margin-top: 0.3em;">
                        <label class="form-check-label text-muted" for="remember" style="font-size: 15px; user-select: none;">Ghi nhớ tôi</label>
                    </div>
                    <div>
                        <a href="reset-password" class="text-primary text-decoration-none" style="font-size: 15px;">Bạn đã quên mật khẩu?</a>
                    </div>
                </div>
                
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary btn-apple-login">Đăng Nhập <i class="fa fa-arrow-right ms-2" style="font-size: 14px;"></i></button>
                </div>
                
                <hr class="my-4 text-muted" style="opacity: 0.15;">
                
                <div class="text-center text-muted" style="font-size: 15px;">
                    Bạn không có Tài khoản Apple? <a href="register" class="text-primary text-decoration-none" style="font-weight: 500;">Tạo tài khoản của bạn ngay bây giờ.</a>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <h5 style="padding-left:290px">Bạn cần hỗ trợ thêm? <a href="">Chat ngay</a>(Mở trong cửa sổ mới) hoặc gọi
        1800-1192.</h5>
    <hr style="margin-bottom:0px">

<?php
require_once '../app/views/layouts/footer.php';
?>
