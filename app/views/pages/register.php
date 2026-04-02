<?php

// File kết nối database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = trim($_POST['lastname']);
    $firstname = trim($_POST['firstname']);
    $country = trim($_POST['country']);
    $day = trim($_POST['day']);
    $month = trim($_POST['month']);
    $year = trim($_POST['year']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $captcha = trim($_POST['captcha'] ?? '');

    // Xác thực CAPTCHA
    if (empty($captcha) || strtoupper($captcha) !== ($_SESSION['captcha_code'] ?? '')) {
        $_SESSION['error'] = "Mã xác nhận (CAPTCHA) không chính xác!";
        header("Location: register");
        exit();
    }

    // Xác thực Mật khẩu
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Mật khẩu xác nhận không khớp!";
        header("Location: register");
        exit();
    }

    // Chuyển ngày tháng năm thành định dạng YYYY-MM-DD
    $birthdate = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-" . str_pad($day, 2, '0', STR_PAD_LEFT);

    // Kiểm tra email đã tồn tại chưa
    $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();

    if ($check_email->num_rows > 0) {
        $_SESSION['error'] = "Email đã tồn tại!";
        header("Location: register");
        exit();
    }
    $check_email->close();

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Thêm dữ liệu vào database
    $sql = "INSERT INTO users (lastname, firstname, country, birthdate, email, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $lastname, $firstname, $country, $birthdate, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Tài khoản Apple của bạn đã được tạo thành công!";
    } else {
        $_SESSION['error'] = "Lỗi hệ thống khi đăng ký!";
    }

    $stmt->close();
    $conn->close();
    header("Location: register");
    exit();
}
?>

<?php
$pageTitle = "register.php";
require_once '../app/views/layouts/header.php';
require_once '../app/views/layouts/navbar.php';
?>

<div class="header-container">
    <h3 style="font-size: 25px"><b>Apple Account</b></h3>
    <div class="nav-menu">
        <a href="login" style="text-decoration: none;">Đăng Nhập</a>
        <a href="register" style="text-decoration: none;">Tạo Tài khoản Apple</a>
        <a href="#" style="text-decoration: none;">Những Câu Hỏi Thường Gặp</a>
    </div>
</div>
<div class="container">
    <div class="register-container px-5">
        <h2 class="text-center fw-bold mb-3" style="font-size: 34px; letter-spacing: -0.02em;">Tạo Tài khoản Apple</h2>
        <p class="text-center text-muted mb-1" style="font-size: 15px;">Chỉ cần có một Tài khoản Apple để truy cập vào
            tất cả dịch vụ của Apple.</p>
        <p class="text-center mb-4" style="font-size: 15px;">Bạn đã có Tài khoản Apple? <a href="login"
                class="text-decoration-none">Đăng Nhập <i class="fa fa-arrow-up-right-from-square ms-1"
                    style="font-size: 11px;"></i></a></p>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger text-start"> <?= $_SESSION['error'];
            unset($_SESSION['error']); ?> </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success text-start"> <?= $_SESSION['success'];
            unset($_SESSION['success']); ?> </div>
            <div class="text-center mb-4"><a href="login" class="btn btn-primary rounded-pill px-4">Đăng nhập ngay</a></div>
        <?php endif; ?>

        <form action="register" method="POST">
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <div class="apple-input-group">
                        <input type="text" class="apple-input" name="lastname" placeholder="Họ" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="apple-input-group">
                        <input type="text" class="apple-input" name="firstname" placeholder="Tên" required>
                    </div>
                </div>
            </div>

            <p class="fw-bold mb-2 text-start" style="font-size: 15px;">Quốc gia/Vùng</p>
            <div class="apple-input-group mb-4">
                <select class="apple-input text-center" name="country" required
                    style="cursor: pointer; text-align-last: center;">
                    <option value="Việt Nam">Việt Nam</option>
                    <option value="Hoa Kỳ">Hoa Kỳ</option>
                    <option value="Hàn Quốc">Hàn Quốc</option>
                    <option value="Nhật Bản">Nhật Bản</option>
                </select>
                <i class="fa fa-chevron-down text-muted"
                    style="position: absolute; right: 20px; top: 20px; pointer-events: none; font-size: 12px;"></i>
            </div>

            <p class="fw-bold mb-2 text-start" style="font-size: 15px;">Ngày sinh <i
                    class="fa fa-question-circle text-muted ms-1" style="cursor: pointer;"></i></p>
            <div class="row g-3 mb-4">
                <div class="col-4">
                    <div class="apple-input-group">
                        <select class="apple-input text-center" name="day" required
                            style="cursor: pointer; text-align-last: center;">
                            <option value="">Ngày</option>
                            <?php for ($i = 1; $i <= 31; $i++)
                                echo "<option value='$i'>$i</option>"; ?>
                        </select>
                        <i class="fa fa-chevron-down text-muted"
                            style="position: absolute; right: 12px; top: 22px; pointer-events: none; font-size: 10px;"></i>
                    </div>
                </div>
                <div class="col-4">
                    <div class="apple-input-group">
                        <select class="apple-input text-center" name="month" required
                            style="cursor: pointer; text-align-last: center;">
                            <option value="">Tháng</option>
                            <?php for ($i = 1; $i <= 12; $i++)
                                echo "<option value='$i'>$i</option>"; ?>
                        </select>
                        <i class="fa fa-chevron-down text-muted"
                            style="position: absolute; right: 12px; top: 22px; pointer-events: none; font-size: 10px;"></i>
                    </div>
                </div>
                <div class="col-4">
                    <div class="apple-input-group">
                        <select class="apple-input text-center" name="year" required
                            style="cursor: pointer; text-align-last: center;">
                            <option value="">Năm</option>
                            <?php for ($i = date('Y') - 13; $i >= 1900; $i--)
                                echo "<option value='$i'>$i</option>"; ?>
                        </select>
                        <i class="fa fa-chevron-down text-muted"
                            style="position: absolute; right: 12px; top: 22px; pointer-events: none; font-size: 10px;"></i>
                    </div>
                </div>
            </div>

            <hr class="my-4 text-muted" style="opacity: 0.15;">
            <div class="apple-input-group mb-3">
                <input type="email" class="apple-input" name="email" placeholder="name@example.com" required>
            </div>
            <div class="apple-input-group mb-3">
                <input type="password" class="apple-input" name="password" placeholder="Mật Khẩu" required>
            </div>
            <div class="apple-input-group mb-4">
                <input type="password" class="apple-input" name="confirm_password" placeholder="Xác nhận Mật khẩu"
                    required>
            </div>

            <hr class="my-4 text-muted" style="opacity: 0.15;">

            <div class="mb-3 text-start">
                <p class="fw-bold mb-2" style="font-size: 15px;">Xác minh với:</p>
                <div class="d-flex flex-column gap-2 mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="verification" id="sms" value="sms" checked>
                        <label class="form-check-label" for="sms" style="user-select: none;">Tin nhắn</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="verification" id="call" value="call">
                        <label class="form-check-label" for="call" style="user-select: none;">Cuộc gọi điện</label>
                    </div>
                </div>
            </div>

            <div class="mb-4 text-start">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="notifications[]" id="news" value="news"
                        checked>
                    <label class="form-check-label fw-bold" for="news" style="user-select: none;">Các Thông Báo</label>
                    <p class="text-muted mt-1 mb-0" style="font-size: 13px;">Nhận email và thông tin của Apple như thông
                        báo, quảng cáo, gợi ý và cập nhật về các sản phẩm, phần mềm.</p>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="notifications[]" id="apps" value="apps"
                        checked>
                    <label class="form-check-label fw-bold" for="apps" style="user-select: none;">Ứng Dụng, Nhạc, TV Và
                        Nhiều Hơn Nữa</label>
                    <p class="text-muted mt-1 mb-0" style="font-size: 13px;">Nhận email và thông tin về ứng dụng, nhạc,
                        phim, TV, sách, podcast và nhiều hơn nữa.</p>
                </div>
            </div>

            <hr class="my-4 text-muted" style="opacity: 0.15;">

            <div class="row align-items-center mb-4">
                <div class="col-sm-5 text-center text-sm-start mb-3 mb-sm-0">
                    <img src="<?= BASE_URL ?>public/captcha.php" alt="CAPTCHA" id="captcha-img"
                        style="border-radius: 8px; width: 130px; height: 42px; border: 1px solid #d2d2d7;"
                        title="Click để tải lại mã mới"
                        onclick="this.src='<?= BASE_URL ?>public/captcha.php?v='+Math.random()">
                    <div class="mt-2" style="font-size: 13px;">
                        <a href="#"
                            onclick="document.getElementById('captcha-img').src='<?= BASE_URL ?>public/captcha.php?v='+Math.random(); return false;"
                            class="text-primary text-decoration-none"><i class="fa fa-refresh"></i> Mã Mới</a>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="apple-input-group">
                        <input type="text" class="apple-input" name="captcha" placeholder="Nhập các ký tự trong ảnh"
                            style="font-size: 15px;" required>
                    </div>
                </div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary"
                    style="background-color: #0071e3; border: none; border-radius: 12px; padding: 14px 20px; font-weight: 500; font-size: 17px; letter-spacing: -0.02em;">Tiếp
                    Tục</button>
            </div>
        </form>
    </div>
</div>

<?php
require_once '../app/views/layouts/footer.php';
?>