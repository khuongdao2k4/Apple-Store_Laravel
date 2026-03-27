<?php
session_start();
include '../config/DBconnect.php'; // Đảm bảo đường dẫn đúng

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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPhone - Order Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/apple_home-styles.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            height: 100vh;
            background-color: #f9f9f9;
            flex-direction: column;
        }

        .header {
            width: 100%;
            max-width: 68%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0px;
            padding-top: 80px;
            margin-left: -80px;
            margin-right: -200px;
        }

        .header a {
            text-decoration: none;
            color: #007aff;
            font-size: 14px;
        }

        .main-container {
            display: flex;
            background: #f9f9f9;
            ;
            padding: 20px;
            width: 80%;
            height: 60vh;
            transition: all 0.3s ease;
            border-top: 1px solid #ccc;
            display: ;
        }

        .info-section {
            width: 40%;
            padding-left: 20px;
            text-align: center;
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }

        .info-content {
            display: flex;
            align-items: center;
            gap: 10px;
            align-self: flex-start;
            margin: 30px;
            margin-right: 70px;
        }


        .info-section img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .info-section img:hover {
            transform: scale(1.05);
        }

        .form-section {
            width: 60%;
            padding-left: 20px;
            text-align: center;
            border-right: 1px solid #ccc;
            display: ;
        }

        h2 {
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
            color: #666;
        }

        input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #007aff;
            box-shadow: 0 0 5px rgba(0, 122, 255, 0.5);
        }

        button {
            width: 40%;
            padding: 10px;
            background: #007aff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        button:hover {
            background: rgb(0, 0, 0);
            transform: scale(1.05);
        }

        .message {
            margin-top: 10px;
            font-size: 14px;
            color: red;
        }

        .message.success {
            color: green;
        }

        /* search */
        .search-box {
            position: absolute;
            top: -3px;
            right: -250px;
            /* Ẩn ngoài màn hình */
            transition: right 0.3s ease-in-out;
            min-width: 300px;
            border-radius: 20px !important;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }

        .search-box.active {
            right: 120px;
            transform: translateX(0);
            /* Hiện ra khi có class 'active' */
        }

        #search-results {
            list-style-type: none;
            /* Xóa dấu chấm */
            padding: 0;
            margin: 5px 0;
            background: white;
            border: 1px solid #ddd;
            max-width: 400px;
            position: absolute;
            top: 50px;
            right: 85px;
            z-index: 1000;
            display: none;
            border-radius: 10px;
        }

        .search-item {
            max-width: 420px;
            display: flex;
            align-items: center;
            padding: 8px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .search-item:hover {
            background: #f1f1f1;
        }

        .search-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-info {
            display: flex;
            flex-direction: column;
        }

        .search-name {
            font-size: 20px;
            font-weight: bold;
        }

        .search-price {
            font-size: 17px;
            color: #888;
        }

        footer {
            padding-top: 30px;
            padding-left: 290px;
            padding-right: 180px;
            padding-bottom: 20px;
            font-size: 12px;
            text-align: left;
            background-color: rgb(236, 236, 241);
        }

        footer a {
            color: black;
            text-decoration: none;
        }
        .submenu-container {
            position: fixed;
            top: 50px;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0);
            /* Ban đầu trong suốt */
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link" href="apple_home.php"><i
                                class="fa-brands fa-apple fa-xl"></i></a></li>
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link" href="#">Cửa Hàng</a>
                        <div class="submenu-container">
                            <div class="submenu">
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Mua Hàng</li>
                                    <li class="li-rowh">Mua Sản Phẩm Mới Nhất</li>
                                    <li class="li-rowh">Mac</li>
                                    <li class="li-rowh">iPad</li>
                                    <li class="li-rowh">iPhone</li>
                                    <li class="li-rowh">Apple Watch</li>
                                    <li class="li-rowh">Phụ Kiện</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Liên Kết Nhanh
                                    </li>
                                    <li class="li-row">Tình Trạng Đơn Hàng</li>
                                    <li class="li-row">Apple Trade In</li>
                                    <li class="li-row">Tài Chính</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Mua Tại Cửa Hàng
                                        Đặc Biệt</li>
                                    <li class="li-row">Giáo Dục</li>
                                    <li class="li-row">Doanh Nghiệp</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link" href="apple_mac.php">Mac</a>
                        <div class="submenu-container">
                            <div class="submenu">
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Khám Phá Mac
                                    </li>
                                    <li class="li-rowh">Khám Phá Tất Cả Mac</li>
                                    <li class="li-rowh">MacBook Air</li>
                                    <li class="li-rowh">MacBook Pro</li>
                                    <li class="li-rowh">iMac</li>
                                    <li class="li-rowh">Mac mini</li>
                                    <li class="li-rowh">Mac Studio</li>
                                    <li class="li-rowh">Mac Pro</li>
                                    <li class="li-rowh">Màn Hình</li>
                                    <li class="li-row">So Sánh Mac</li>
                                    <li class="li-row" style="font-size:14px">Chuyển Từ PC Sang Mac</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Mua Mac</li>
                                    <li class="li-row">Mua Mac</li>
                                    <li class="li-row">Phụ Liện Mac</li>
                                    <li class="li-row">Apple Trade In </li>
                                    <li class="li-row">Tài Chính </li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Tìm Hiểu Thêm Về
                                        Mac</li>
                                    <li class="li-row">Hỗ Trợ Mac</li>
                                    <li class="li-row">AppleCare+ cho Mac</li>
                                    <li class="li-row">macOS Sequeia</li>
                                    <li class="li-row">Apple Intelligence</li>
                                    <li class="li-row">Các Ứng Dụng Của Apple</li>
                                    <li class="li-row">Tính Liên Tục</li>
                                    <li class="li-row">iCloud+</li>
                                    <li class="li-row">Mac Cho Doanh Nghiệp</li>
                                    <li class="li-row">Giáo Dục</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link" href="#">iPad</a>
                        <div class="submenu-container">
                            <div class="submenu">
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Khám Phá iPad
                                    </li>
                                    <li class="li-rowh">Khám Phá Tất Cả iPad</li>
                                    <li class="li-rowh">iPad Pro</li>
                                    <li class="li-rowh">iPad Air</li>
                                    <li class="li-rowh">iPad</li>
                                    <li class="li-rowh">iPad mini</li>
                                    <li class="li-rowh">Apple Pencil</li>
                                    <li class="li-rowh">Bàn Phím</li>
                                    <li class="li-row">So Sánh iPad</li>
                                    <li class="li-row">Tại Sao Nên Dùng iPad</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Mua iPad</li>
                                    <li class="li-row">Mua iPad</li>
                                    <li class="li-row">Phụ Kiện iPad</li>
                                    <li class="li-row">Apple Trade In </li>
                                    <li class="li-row">Tài Chính</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Tìm Hiểu Thêm Về
                                        iPad</li>
                                    <li class="li-row">Hỗ Trợ iPad</li>
                                    <li class="li-row">AppleCare+ cho iPad</li>
                                    <li class="li-row">iPadOS 18</li>
                                    <li class="li-row">Apple Intelligence</li>
                                    <li class="li-row">Các Ứng Dụng Của Apple</li>
                                    <li class="li-row">iCloud+</li>
                                    <li class="li-row">Giáo Dục</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link"
                            href="apple_store.php">iPhone</a>
                        <div class="submenu-container">
                            <div class="submenu">
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Khám Phá iPhone
                                    </li>
                                    <li class="li-rowh">Khám Phá Tất Cả iPhone</li>
                                    <li class="li-rowh">iPhone 16 Pro</li>
                                    <li class="li-rowh">iPhone 16</li>
                                    <li class="li-rowh">iPhone 16e</li>
                                    <li class="li-rowh">iPhone 15</li>
                                    <li class="li-row">So Sánh iPhone</li>
                                    <li class="li-row">Chuyển Từ Android</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Mua iPhone</li>
                                    <li class="li-row" onclick="location.href='apple_mua-iphone.php'"
                                        style="cursor: pointer;">Mua iPhone</li>
                                    <li class="li-row">Phụ Kiện iPhone</li>
                                    <li class="li-row">Apple Trade In </li>
                                    <li class="li-row">Tài Chính</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Tìm Hiểu Thêm Về
                                        iPhone</li>
                                    <li class="li-row">Hỗ Trợ iPhone</li>
                                    <li class="li-row">AppleCare+ cho iPhone</li>
                                    <li class="li-row">iOS 18</li>
                                    <li class="li-row">Apple Intelligence</li>
                                    <li class="li-row">Các Ứng Dụng Của Apple</li>
                                    <li class="li-row">Quyền Riêng Tư Trên iPhone</li>
                                    <li class="li-row">iCloud+</li>
                                    <li class="li-row">Ví, Pay</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link" href="#">Watch</a>
                        <div class="submenu-container">
                            <div class="submenu">
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Khám Phá Watch
                                    </li>
                                    <li class="li-rowh">Khám Phá Tất Cả Apple Watch</li>
                                    <li class="li-rowh">Apple Watch Series 10</li>
                                    <li class="li-rowh">Apple Watch Ultra 2</li>
                                    <li class="li-rowh">Apple Watch SE</li>
                                    <li class="li-rowh">Apple Watch Nike</li>
                                    <li class="li-row">So Sánh Watch</li>
                                    <li class="li-row">Tại Sao Nên Dùng Apple Watch</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Mua Watch</li>
                                    <li class="li-row">Mua Apple Watch</li>
                                    <li class="li-row">Apple Watch Studio</li>
                                    <li class="li-row">Dây Đeo Apple Watch</li>
                                    <li class="li-row">Phụ Kiện Apple Watch</li>
                                    <li class="li-row">Apple Trade In </li>
                                    <li class="li-row">Tài Chính</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Tìm Hiểu Thêm Về
                                        Watch</li>
                                    <li class="li-row">Hỗ Trợ Watch</li>
                                    <li class="li-row">AppleCare+</li>
                                    <li class="li-row">watchOS 11</li>
                                    <li class="li-row">Các Ứng Dụng Của Apple</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link" href="#">AirPods</a>
                        <div class="submenu-container">
                            <div class="submenu">
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Khám Phá AirPods
                                    </li>
                                    <li class="li-rowh">Khám Phá Tất Cả AirPods</li>
                                    <li class="li-rowh">AirPods 4</li>
                                    <li class="li-rowh">AirPods Pro 2</li>
                                    <li class="li-rowh">AirPods Max</li>
                                    <li class="li-row">So Sánh AirPods</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Mua AirPods</li>
                                    <li class="li-row">Mua AirPods</li>
                                    <li class="li-row">Phụ Kiện AirPods</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Tìm Hiểu Thêm Về
                                        AirPods</li>
                                    <li class="li-row">Hỗ Trợ AirPods</li>
                                    <li class="li-row">AppleCare+ cho Tai Nghe</li>
                                    <li class="li-row">Apple Music</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link" href="#">TV & Nhà</a>
                        <div class="submenu-container">
                            <div class="submenu">
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Khám Phá TV &
                                        Nhà</li>
                                    <li class="li-rowh">Khám Phá TV & Nhà</li>
                                    <li class="li-rowh">Apple TV 4K</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Mua TV & Nhà
                                    </li>
                                    <li class="li-row">Mua Apple TV 4K</li>
                                    <li class="li-row">Mua Phụ Kiện TV & Nhà</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Tìm Hiểu Thêm Về
                                        TV & Nhà</li>
                                    <li class="li-row">Hỗ Trợ Apple TV</li>
                                    <li class="li-row">AppleCare+</li>
                                    <li class="li-row">Ứng Dụng Apple TV</li>
                                    <li class="li-row">Apple TV+</li>
                                    <li class="li-row">Apple Music</li>
                                    <li class="li-row">AirPlay</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link" href="#">Giải Trí</a>
                        <div class="submenu-container">
                            <div class="submenu">
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Khám Phá Giải
                                        Trí</li>
                                    <li class="li-rowh">Khám Phá Giải Trí</li>
                                    <li class="li-rowh">Apple One</li>
                                    <li class="li-rowh">Apple TV+</li>
                                    <li class="li-rowh">Apple Music</li>
                                    <li class="li-rowh">Apple Arcade</li>
                                    <li class="li-rowh">Apple Podcasts</li>
                                    <li class="li-rowh">Apple Books</li>
                                    <li class="li-rowh">App Store</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Hỗ Trợ</li>
                                    <li class="li-row">Hỗ Trợ Apple TV+</li>
                                    <li class="li-row">Hỗ Trợ Apple Music</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;"></li>
                                    <li class="li-row"></li>
                                    <li class="li-row"></li>
                                    <li class="li-row"></li>
                                    <li class="li-row"></li>
                                    <li class="li-row"></li>
                                    <li class="li-row"></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link" href="#">Phụ Kiện</a>
                        <div class="submenu-container">
                            <div class="submenu">
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Mua Phụ Kiện
                                    </li>
                                    <li class="li-rowh">Mua Tất Cả Phụ Kiện</li>
                                    <li class="li-rowh">Mac</li>
                                    <li class="li-rowh">iPad</li>
                                    <li class="li-rowh">iPhone</li>
                                    <li class="li-rowh">Apple Watch</li>
                                    <li class="li-rowh">AirPods</li>
                                    <li class="li-rowh">TV & Nhà</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Khám Phá Phụ
                                        Kiện</li>
                                    <li class="li-row">Sản Xuất Bởi Apple</li>
                                    <li class="li-row">Beats by Dr. Dre</li>
                                    <li class="li-row">AirTag</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;"></li>
                                    <li class="li-row"></li>
                                    <li class="li-row"></li>
                                    <li class="li-row"></li>
                                    <li class="li-row"></li>
                                    <li class="li-row"></li>
                                    <li class="li-row"></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link" href="#">Hỗ Trợ</a>
                        <div class="submenu-container">
                            <div class="submenu">
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Khám Phá Hỗ Trợ
                                    </li>
                                    <li class="li-rowh">iPhone</li>
                                    <li class="li-rowh">Mac</li>
                                    <li class="li-rowh">iPad</li>
                                    <li class="li-rowh">Watch</li>
                                    <li class="li-rowh">AirPods</li>
                                    <li class="li-rowh">Music</li>
                                    <li class="li-rowh">TV & Nhà</li>
                                    <li class="li-row">Khám Phá Hỗ Trợ</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;">Trợ Giúp</li>
                                    <li class="li-row">Cộng Đồng</li>
                                    <li class="li-row">Kiểm Tra Bảo Hành</li>
                                    <li class="li-row">Sửa Chữa</li>
                                    <li class="li-row" onclick="location.href='apple_statistics.php'" >Thống Kê</li>
                                </ul>
                                <ul>
                                    <li class="header-li" style="color: #6E6E73; padding-bottom: 10px;"> Chủ Đề Hữu Ích
                                    </li>
                                    <li class="li-row">Mua AppleCare+</li>
                                    <li class="li-row">Tài Khoản và Mật Khẩu Apple</li>
                                    <li class="li-row">Thanh Toán & Gói Đăng Ký</li>
                                    <li class="li-row">Trợ Năng</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <ul style="list-style-type: none;">
                        <li class="nav-item">
                            <a href="#" class="nav-link search-icon"><i
                                    class="fa-solid fa-magnifying-glass fa-lg"></i></a>
                        </li>
                        <li class="nav-item search-box">
                            <input type="text" id="search-input" class="form-control"
                                placeholder="Tìm kiếm sản phẩm...">
                        </li>
                    </ul>
                    <li class="nav-item"><a href="apple_bag.php" class="nav-link"><i
                                class="fa-solid fa-bag-shopping fa-lg"></i></a>
                    </li>
                </ul>
                <ul>

                </ul>
            </div>
        </div>
    </nav>
    <ul id="search-results"></ul>

    <div class="header">
        <h3>Apple Order Detail</h3>
        <div>
            <a href="apple_login.php">Sign In</a> | <a href="#">FAQ</a>
        </div>
    </div>
    <hr>
    <div class="main-container">
        <div class="form-section">
            <br>
            <h2 style="margin-left:-250px ;">Reset Password</h2>
            <p style="margin-left:55px;font-size: 14px;">Enter your email address or phone number that you use with your
                account to continue.</p>
            <br>
            <?php if (isset($message)): ?>
                <p class="message <?php echo isset($success) ? 'success' : ''; ?>"><?php echo $message; ?></p>
                <?php if (isset($success))
                    echo '<a href="apple_login.php">Đăng nhập ngay</a>'; ?>
            <?php endif; ?>

            <form action="" method="POST" style="padding-left: 0px">
                <input style="border-radius: 20px; margin-bottom:20px; text-align: center; width: 350px;" type="email"
                    name="email" placeholder="Email" required>
                <input style="border-radius: 20px; margin-bottom:20px; text-align: center; width: 350px;"
                    type="password" name="new_password" placeholder="New Password" required>
                <input style="border-radius: 20px; margin-bottom:30px; text-align: center; width: 350px;"
                    type="password" name="confirm_password" placeholder="Confirm Password" required>
                <br>
                <button type="submit" style="width:140px; border-radius: 20px; margin-bottom:20px" ; text-align:
                    center;>Reset</button>
            </form>
        </div>
        <div class="info-section">
            <div class="info-content">
                <img style="width:80px; height: 80px;"
                    src="data:image/png;base64,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"
                    alt="User Icon">
                <p>You've come to the right place to reset a forgotten password. For your security, we'll ask you a few
                    questions to verify that you're the owner of this account.</p>
            </div>
        </div>
    </div>

    <hr>
    <h5 style="padding-left:90px; padding-top: 30px;">Bạn cần hỗ trợ thêm? <a href="">Chat ngay</a>(Mở trong cửa sổ mới)
        hoặc gọi
        1800-1192.</h5>
    <hr style="margin-bottom:0px">
    <footer>
        <p>Giá hiển thị đã bao gồm tất cả các khoản thuế. Giao hàng miễn phí cho tất cả đơn hàng.</p>
        <p>Apple Store Trực Tuyến sử dụng công nghệ mã hóa chuẩn ngành để bảo vệ tính bảo mật của thông tin do bạn gửi.
            Tìm hiểu thêm về <a href="">Chính Sách Bảo Mật</a> của chúng tôi (mở trong cửa sổ mới).</p>
        <hr>
        <p>Xem thêm cách để mua hàng: Tìm cửa hàng bán lẻ gần bạn. Hoặc gọi <u>1800-1192</u> .</p>
        <p>Bản quyền © 2025 Apple Inc. Bảo lưu mọi quyền.</p>
        <p><a href="">Chính Sách Quyền Riêng Tư</a> | <a href="">Điều Khoản Sử Dụng</a> | <a href="">Bán Hàng Và Hoàn
                Tiền</a> | <a href="">Pháp Lý</a> | <a href="">Bản Đồ Trang Web</a></p>
    </footer>
    <script>
        document.querySelector(".search-icon").addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(".search-box").classList.toggle("active");
        });

        document.getElementById("search-input").addEventListener("input", function () {
            let keyword = this.value.trim();
            let resultsContainer = document.getElementById("search-results");

            if (keyword.length > 1) {
                fetch(`apple_search.php?query=${encodeURIComponent(keyword)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            let resultHTML = data.map(p => `
                        <li class="search-item" data-id="${p.id}" style="">
                            <img src="${p.image_url}" alt="${p.name}" class="search-image" style="">
                            <div class="search-info">
                                <span class="search-name">${p.name}</span>
                                <span class="search-price">${p.price}đ</span>
                            </div>
                        </li>
                    `).join("");

                            resultsContainer.innerHTML = resultHTML;
                            resultsContainer.style.display = "block";

                            // Thêm sự kiện click vào mỗi item để điều hướng
                            document.querySelectorAll(".search-item").forEach(item => {
                                item.addEventListener("click", function () {
                                    let productId = this.getAttribute("data-id");
                                    window.location.href = `apple_order-test.php?id=${productId}`;
                                });
                            });

                        } else {
                            resultsContainer.innerHTML = "<li>Không tìm thấy sản phẩm</li>";
                            resultsContainer.style.display = "block";
                        }
                    })
                    .catch(error => {
                        console.error("Lỗi:", error);
                        resultsContainer.innerHTML = "<li>Có lỗi xảy ra!</li>";
                        resultsContainer.style.display = "block";
                    });
            } else {
                resultsContainer.innerHTML = "";
                resultsContainer.style.display = "none";
            }
        });
    </script>
</body>

</html>