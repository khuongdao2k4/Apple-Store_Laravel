<?php
session_start();
include '../config/DBconnect.php';

// Lấy danh sách sản phẩm từ bảng products
$sql = "SELECT  name,image_url, colors, price, quantity FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy iPhone</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/apple_home-styles.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <style>
        .deals-container {
            background-color: rgb(234, 236, 238);
            padding: 10px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 900px;
            margin: 20px auto;
            font-size: 12px;
            /* Giảm cỡ chữ */
            margin-top: 70px;
        }

        .deals-container img {
            height: 20px;
            /* Giảm kích thước ảnh để phù hợp với cỡ chữ nhỏ hơn */
            margin-right: 8px;
        }

        .deal-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .see-all {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            font-size: 13px;
            /* Giảm cỡ chữ của link */
        }

        .deal-info {
            min-width: 180px;
            /* Đảm bảo chiều ngang đủ để chứa hết chữ */
            flex-shrink: 0;
            /* Không co lại */
        }

        .purchase-container {
            max-width: 1350px;
            margin: 20px auto;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .offer-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .offer-button {
            background-color: rgb(232, 233, 234);
            border-radius: 20px;
            padding: 10px 20px;
            display: inline-flex;
            text-align: center;
            justify-content: center;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .apple-intelligence {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            margin-top: 10px;
        }

        .apple-intelligence img {
            height: 20px;
        }


        .rf-bfe-main {
            display: flex;
            flex-wrap: wrap;
            max-width: 1500px;
            margin: 20px 80px 20px 100px;
        }

        .rf-bfe-column-left,
        .rf-bfe-column-right {
            width: 65%;
            max-height: 600px;
            overflow-y: scroll;
            scrollbar-width: none;
        }

        .rf-bfe-column-left::-webkit-scrollbar,
        .rf-bfe-column-right::-webkit-scrollbar {
            display: none;
        }

        .rf-bfe-column-right {
            width: 35%;
            padding-left: 20px;
        }

        .model-card,
        .storage-card {
            border: 1px solid #ccc;
            padding: 13px 13px 7px 13px;
            border-radius: 10px;
            margin-bottom: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .model-card p {
            font-size: 12px;
        }

        .storage-card p {
            font-size: 12px;
        }

        .model-card strong {
            font-size: 24px;
        }

        .storage-card strong {
            font-size: 24px;
        }

        .help-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
        }

        .color-options {
            display: flex;
            gap: 10px;
        }

        .color-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        .trade-options {
            display: flex;
            gap: 15px;
            margin-top: 10px;
            padding-bottom: 50px;
            padding-top: 10px;
        }

        .trade-card {
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            background-color: #f8f9fa;
            justify-content: center;
        }

        .payment-options {
            display: flex;
            gap: 15px;
            margin-top: 10px;
            height: 150px;
            padding-bottom: 50px;
            padding-top: 10px;
        }

        .payment-card {
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px 20px 5px 20px;
            text-align: center;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 150px;
        }

        .payment-card strong {
            align-self: flex-start;
            font-size: 15px;
        }

        .payment-card p {
            align-self: flex-end;
            font-size: 12px;
            margin-bottom: 0px !important;
        }

        /* search */
        .search-box {
            position: absolute;
            top: 7px;
            right: -250px;
            /* Ẩn ngoài màn hình */
            transition: right 0.3s ease-in-out;
            min-width: 300px;
            border-radius: 20px !important;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }

        .search-box.active {
            right: 155px;
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
            padding-left: 50px;
            padding-right: 50px;
            font-size: 12px;
            text-align: center;
            margin-top: 100px;
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if (isset($_SESSION['user_name']) && isset($_SESSION['role'])): ?>
                                <li><span class="dropdown-item">Hi, <?php echo $_SESSION['user_name']; ?>!</span></li>
                                <li><a class="dropdown-item" href="apple_logout.php">Đăng Xuất</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="apple_login.php">Đăng Nhập</a></li>
                                <li><a class="dropdown-item" href="apple_register.php">Đăng Ký</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
                <ul>

                </ul>
            </div>
        </div>
    </nav>
    <ul id="search-results"></ul>

    <div class="deals-container">
        <div class="deal-info">
            <strong style="font-size:13px;">Carrier Deals at Apple</strong><br>
            <a href="#" class="see-all">See all deals ➕</a>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-att?wid=24&hei=24&fmt=png-alpha&.v=1658193314821"
                alt="Carrier 1">
            <span>Save up to $1000 after trade-in.</span>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-lightyear?wid=24&hei=24&fmt=png-alpha&.v=1724793407797"
                alt="Carrier 2">
            <span>Save up to $1000. No trade-in needed.</span>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-tmobile?wid=24&hei=24&fmt=png-alpha&.v=1658193314615"
                alt="Carrier 3">
            <span>Save up to $1000 after trade-in.</span>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-verizon?wid=24&hei=24&fmt=png-alpha&.v=1725054383893"
                alt="Carrier 4">
            <span>Save up to $1000 after trade-in.</span>
        </div>
    </div>

    <div class="purchase-container">
        <div>
            <h1 style="font-size: 48px; font-weight: bold;">Buy iPhone 16 Pro</h1>
            <p style="font-size: 17px;">From $999 or $41.62/mo. for 24 mo.*</p>
            <div class="apple-intelligence">
                <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-selector-icon-apple-intelligence-202409?wid=17&hei=21&fmt=p-jpg&qlt=95&.v=1724970464935"
                    alt="Apple Intelligence">
                <span>Apple Intelligence<sup>8</sup></span>
            </div>
        </div>
        <div class="offer-buttons">
            <button class="offer-button" style="width:270px;">Get $40–$630 for your trade-in. ➕</button>
            <button class="offer-button">Get 3% Daily Cash back with Apple Card. ➕</button>
        </div>
    </div>


    <div class="rf-bfe-main row">
        <div class="rf-bfe-column-left">
            <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/iphone-16-pro-model-unselect-gallery-1-202409?wid=5120&hei=2880&fmt=webp&qlt=70&.v=aWs5czA5aDFXU0FlMGFGRlpYRXk2UWFRQXQ2R0JQTk5udUZxTkR3ZVlpTEJnOG9obkp6NERCS3lnVm1tcnlVUjBoUVhuTWlrY2hIK090ZGZZbk9HeE1xUVVnSHY5eU9CcGxDMkFhalkvT0NuWUpOMGpEMHVTZEtYYVA3c1B3UzVmbW94YnYxc1YvNXZ4emJGL0IxNFp3&traceId=1"
                alt="Product Image" style="width:930px; height: 570px; padding-bottom: 50px;">

            <h3><strong>Apple Trade In.</strong> Get $40–$630 credit toward your new iPhone.</h3>
            <div class="trade-options">
                <div class="trade-card" style="font-size: 19px;">Select a smartphone<br><small
                        style="font-size: 12px; font-weight: lighter;">Answer a few questions to get your
                        estimate.</small></div>
                <div class="trade-card" style="font-size: 19px;">
                    <p style="padding-top: 12px;">No trade-in</p>
                </div>
            </div>

            <h3><strong>Payment options.</strong> Select the one that works for you.</h3>
            <div class="payment-options">
                <div class="payment-card"><strong>Buy</strong>
                    <p>Pay with Apple Pay or other payment methods.</p>
                </div>
                <div class="payment-card"><strong>Finance</strong>
                    <p>Pay over time at 0% APR.</p>
                </div>
                <div class="payment-card"><strong>Apple iPhone Upgrade Program</strong>
                    <p>Pay monthly at 0% APR with the option to upgrade to a new iPhone every year.</p>
                </div>
            </div>
        </div>
        <div class="rf-bfe-column-right">
            <h2><strong>Model.</strong> Which is best for you?</h2>

            <div class="model-card">
                <div>
                    <strong>iPhone 16 Pro</strong>
                    <p>6.3-inch display</p>
                </div>
                <div>
                    <p>From $999 or $41.62/mo. <br> for 24 mo.*</p>
                </div>
            </div>

            <div class="model-card">
                <div>
                    <strong>iPhone 16 Pro Max</strong>
                    <p>6.9-inch display</p>
                </div>
                <div>
                    <p>From $1199 or $49.95/mo.<br> for 24 mo.*</p>
                </div>
            </div>

            <div class="help-box">
                <strong>Need help choosing a model?</strong>
                <p>Explore the differences in screen size and battery life.</p>
            </div>

            <br>
            <h2><strong>Finish.</strong> Pick your favorite.</h2>
            <br>
            <b>Color</b>
            <div class="color-options" style="padding:10px">
                <div class="color-circle" style="background-color: #F3E2D1;"></div>
                <div class="color-circle" style="background-color: #EDEDED;"></div>
                <div class="color-circle" style="background-color: #FFFFFF;"></div>
                <div class="color-circle" style="background-color: #B0B0B0;"></div>
            </div>

            <br>
            <br>
            <h2><strong>Storage.</strong> How much space do you need?</h2>

            <div class="storage-card">
                <div>
                    <strong>128GB²</strong>
                </div>
                <div>
                    <p>From $999 or $41.62/mo. for 24 mo.*</p>
                </div>
            </div>

            <div class="storage-card">
                <div>
                    <strong>256GB²</strong>
                </div>
                <div>
                    <p>From $1099 or $45.79/mo. for 24 mo.*</p>
                </div>
            </div>

            <div class="storage-card">
                <div>
                    <strong>512GB²</strong>
                </div>
                <div>
                    <p>From $1299 or $54.12/mo. for 24 mo.*</p>
                </div>
            </div>

            <div class="storage-card">
                <div>
                    <strong>1TB²</strong>
                </div>
                <div>
                    <p>From $1499 or $62.45/mo. for 24 mo.*</p>
                </div>
            </div>
        </div>
    </div>

    <footer
        style="text-align: left;padding-bottom:30px; padding-left: 300px; padding-right: 150px; background-color:rgb(227, 227, 237);">
        <br>
        <p style="color:rgb(106, 106, 108);">* Trade‑in values may vary, and are based on the condition and model of
            your trade‑in device. Additional trade‑in values require purchase of a new iPhone, subject to availability
            and limits. Must be at least 18. Offer may not be available in all stores and not all devices are eligible
            for credit. Apple or its trade-in partners reserve the right to refuse or limit any Trade In transaction for
            any reason. In‑store trade‑in requires presentation of a valid, government‑issued photo ID (local law may
            require saving this information). Sales tax may be assessed on full value of new iPhone. Value of your
            current device may be applied toward purchase of a new Apple device. Additional terms from Apple or Apple’s
            trade‑in partners may apply. See <u>apple.com/shop/trade-in </u> for more information. <br>
            <br>
            ** Pricing for iPhone 16 and iPhone 16 Plus includes a $30 connectivity discount that requires activation
            with AT&T, Boost Mobile, T‑Mobile, or Verizon. Pricing shown for iPhone 15 and iPhone 15 Plus includes a $30
            connectivity discount for Boost Mobile, T‑Mobile, and Verizon customers that requires activation and would
            otherwise be $30 higher for all other customers. Financing available to qualified customers, subject to
            credit approval and credit limit, and requires you to select Citizens One Apple iPhone Payments or Apple
            Card Monthly Installments (ACMI) as your payment type at checkout at Apple. You’ll need to select AT&T,
            Boost Mobile, T‑Mobile, or Verizon as your carrier when you checkout. An iPhone purchased with ACMI is
            always unlocked, so you can switch carriers at any time, subject to your carrier’s terms. Taxes and shipping
            on items purchased using ACMI are subject to your card’s variable APR, not the ACMI 0% APR. ACMI is not
            available for purchases made online at special storefronts. The last month’s payment for each product will
            be the product’s purchase price, less all other payments at the monthly payment amount. ACMI financing is
            subject to change at any time for any reason, including but not limited to, installment term lengths and
            eligible products. See the Apple Card Customer Agreement for more information about ACMI. Additional
            Citizens One Apple iPhone Payments terms are here.
        </p>
        <hr style="padding-left: 300px; padding-right: 150px;">
        <p>Xem thêm cách để mua hàng: <a href="">Tìm cửa hàng bán lẻ gần bạn</a> . Hoặc gọi <u>1800 1192</u> .</p>
        <hr>
        <p>Bản quyền © Apple Inc. 2025 Bảo lưu mọi quyền.</p>
        <p><a href="">Chính Sách Quyền Riêng Tư</a> | <a href="">Điều Khoản Sử Dụng</a> | <a href="">Bán Hàng Và Hoàn
                Tiền</a> | <a href="">Pháp Lý</a> | <a href="">Bản Đồ Trang Web</a></p>
        <p style="color:rgb(159, 159, 160);">ĐKKD số 0313510827, do Sở KH&ĐT thành phố Hồ Chí Minh cấp ngày 28 tháng 10
            năm 2015 <br>
            Giấy phép kinh doanh số 0313510827/KD-0137 do Sở Công Thương thành phố Hồ Chí Minh cấp ngày 23 tháng 5 năm
            2018 <br>
            Địa chỉ: Phòng 901, Ngôi Nhà Đức Tại Tp. Hồ Chí Minh, số 33, đường Lê Duẩn, Phường Bến Nghé, Quận 1, thành
            phố Hồ Chí Minh, Việt Nam <br>
            Điện thoại: 1800 1192</p>
        <img src="https://www.apple.com/vn/home/globalfooter/logo-local-compliance.png"
            style="width: 125px; height: 40px;" alt="">
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