<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mua iPhone - Apple (VN)</title>
    <link rel="stylesheet" href="../assets/css/apple_mua-iphone_styles.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <script src="../assets/js/js-apple_mua-iphone.js"></script> -->

    <style>
        .modal-xl {
            max-width: 55%;
            background-color: transparent;
            top: 50px;

        }

        .modal-content {
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border: none;
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.8) !important;
        }

        .modal.fade.show {
            backdrop-filter: blur(2px);
            background: transparent;
        }

        .nav-tabs {
            border-bottom: none;
            background-color: rgb(232, 234, 236);
            border-radius: 25px;
            display: inline-flex;
            padding: 5px;
        }

        .nav-tabs .nav-item {
            margin-right: 5px;
        }

        .nav-tabs .nav-link {
            border-radius: 20px;
            border: 1px solid transparent;
            padding: 10px 10px;
            transition: all 0.2s ease;
            color: black;
        }

        .nav-tabs .nav-link.active {
            border-color: black;
            background-color: black;
            color: white;
        }

        /* Modal trên cùng */
        .top-modal {
            position: absolute;
            top: -70px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            width: 335px;
        }

        .top-modal {
            pointer-events: auto;
            /* Đảm bảo có thể bấm được */
        }

        .modal {
            pointer-events: auto;
        }

        /* left*/
        .modal-left {
            width: 55%;
            padding: 20px;
            background: #f9f9f9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .product-image {
            width: 80%;
            transition: opacity 0.3s ease-in-out;
        }

        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.1);
            color: black;
            border: none;
            font-size: 20px;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }

        .dots {
            display: flex;
            gap: 7px;
            margin-top: 10px;
        }

        .dot {
            width: 7px;
            height: 7px;
            background: #bbb;
            border-radius: 50%;
            cursor: pointer;
        }

        .dot.active {
            background: black;
        }

        .color-options-modal {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .color-option {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .color-option.active {
            border: 2px solid black;
        }

        /* right*/
        .modal-right {
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
            width: 45%;
            padding-top: 0px;
            padding-right: 20px;
            padding-bottom: 10px;
        }

        .modal-right h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .price-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-right p {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .buy-button {
            background: #007aff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: fit-content;
        }

        .buy-button

        /* Style cho nút Edit */
        .edit-btn .delete-btn {
            align-items: center;
        }

        .edit-btn {
            background-color: #f0ad4e;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 5px;
            transition: background 0.3s ease-in-out;
            margin-right: 30px;
            margin-left: 100px;
        }

        .edit-btn:hover {
            background-color: #ec971f;
        }

        /* Style cho nút Delete */
        .delete-btn {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease-in-out;
        }

        .delete-btn:hover {
            background-color: #c9302c;
        }

        .feature-list {
            margin-top: 20px;
            list-style: none;
            padding: 0;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .feature-list img {
            width: 24px;
            height: 24px;
        }

        /* phàn cuối modal*/
        .modal-end {
            display: flex;
            justify-content: space-between;
            background-color: #e0d9d9;
            padding: 20px;
            border-radius: 10px;
        }

        .offer {
            display: flex;
            align-items: flex-start;
            width: 30%;
        }

        .icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .content {
            max-width: 250px;
        }

        .title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .text {
            color: #555;
            font-size: 14px;
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
            right: 165px;
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
    <nav class="navbar navbar-expand-lg fixed-top">
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

    <div class="header-container">
        <h1 style="padding-left: 300px;">Mua iPhone</h1>
        <div class="support-container">
            <img src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/store-chat-specialist-icon-202309_AV2?wid=70&hei=70&fmt=jpeg&qlt=90&.v=1701194050335"
                alt="Support Icon">
            <div>
                <p><strong>Bạn cần trợ giúp mua sắm?</strong></p>
                <a href="#">Hỏi Chuyên Gia iPhone &rarr;</a>
            </div>
        </div>
    </div>

    <div class="navbar-container">
        <!-- Navbar -->
        <div class="navbar-content">
            <ul>
                <li class="nav-item-content" onclick="showContainer('container1', this)">Tất cả các phiên bản</li>
                <li class="nav-item-content"><a href="#section2" style="text-decoration: none; color: black;">Hướng dẫn
                        mua sắm</a></li>
                <li class="nav-item-content" onclick="showContainer('container3', this)">Nhiều cách để tiết kiệm</li>
                <li class="nav-item-content" onclick="showContainer('container4', this)">Phụ kiện</li>
                <li class="nav-item-content" onclick="showContainer('container5', this)">Thiết lập và hỗ trợ</li>
                <li class="nav-item-content" onclick="showContainer('container6', this)">Trải Nghiệm iPhone</li>
                <li class="nav-item-content" onclick="showContainer('container7', this)">Các cửa hàng đặc biệt</li>
            </ul>
        </div>
    </div>


    <script>
        function showContainer(containerId, element) {
            let containers = document.querySelectorAll('.container');
            containers.forEach(container => {
                container.classList.remove('active');
            });
            document.getElementById(containerId).classList.add('active');

            let navItems = document.querySelectorAll('.nav-item-content');
            navItems.forEach(item => {
                item.classList.remove('active');
            });
            element.classList.add('active');
        }

    </script>
    <!-- Các phần nội dung -->
    <div id="container1" class="container active">
        <div class="product-content">
            <br>
            <div>
                <h2>Mọi phiên bản. <p>Hãy chọn mẫu bạn thích.</p>
                </h2>
            </div>
            <?php
            $role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
            ?>
            <?php if ($role === 'admin'): ?>
                <div class="admin-actions">
                    <button class="add-product-btn" onclick="location.href='apple_add-product.php'">Thêm sản phẩm</button>
                </div>
            <?php endif; ?>
        </div>
        <section class="product-section" style="padding-right: 20px;">
            <div class="product-card">
                <h3>iPhone 16 Pro & <br>
                    iPhone 16 Pro Max</h3>
                <button class="explore-btn" data-bs-toggle="modal" data-bs-target="#productModal">Hãy khám phá thiết
                    bị</button>
                <img src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16prohero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1725567335931"
                    alt="">
                <div class="color-options">
                    <span class="color active" style="background-color: #d4c3b6;"></span>
                    <span class="color" style="background-color: #8e8e93;"></span>
                    <span class="color" style="background-color: #1c1c1e;"></span>
                </div>
                <div class="price-container">
                    <p>Từ 28.999.000đ hoặc 1.181.000đ/tháng <br> trong 24 tháng*</p>
                    <button class="buy-btn" class="btn btn-primary"
                        onclick="window.location.href='apple_order.php'">Mua</button>
                </div>
            </div>
            <div class="product-card">
                <h3>iPhone 16 & <br>
                    iPhone 16 Plus</h3>
                <button class="explore-btn" data-bs-toggle="modal" data-bs-target="#productModal">Hãy khám phá thiết
                    bị</button>
                <img src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16hero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1723234230295"
                    alt="">
                <div class="color-options">
                    <span class="color active" style="background-color: #add8e6;"></span>
                    <span class="color" style="background-color: #f8c8dc;"></span>
                    <span class="color" style="background-color: #8e8e93;"></span>
                    <span class="color" style="background-color: #1c1c1e;"></span>
                </div>
                <div class="price-container">
                    <p>Từ 22.999.000đ hoặc 936.000đ/tháng <br> trong 24 tháng*</p>
                    <button class="buy-btn" onclick="window.location.href='apple_order-test.php'" ;>Mua</button>
                </div>
            </div>
            <div class="product-card">
                <p>ĐẶT TRƯỚC VÀO NGÀY 28 THÁNG 2</p>
                <h3 style="padding-top: 0px;">iPhone 16e</h3>
                <button class="explore-btn" data-bs-toggle="modal" data-bs-target="#productModal">Hãy khám phá thiết
                    bị</button>
                <img src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone-16e-202502?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1739495700381"
                    alt="">
                <div class="color-options">
                    <span class="color active" style="background-color:rgb(227, 216, 216);"></span>
                    <span class="color" style="background-color: #1c1c1e;"></span>
                </div>
                <div class="price-container">
                    <p>Từ 16.999.000đ hoặc 692.000đ/mỗi<br> tháng trong 24 tháng*</p>
                    <button onclick="window.location.href='apple_order-test.php'" ; class="buy-btn">Xem Giá</button>
                </div>
            </div>
            <div class="product-card">
                <h3>iPhone 15 & <br>
                    iPhone 15 Plus</h3>
                <img src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16hero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1723234230295"
                    alt="">
                <button class="explore-btn" data-bs-toggle="modal" data-bs-target="#productModal">Hãy khám phá thiết
                    bị</button>
                <div class="color-options">
                    <span class="color active" style="background-color:rgb(255, 255, 255);"></span>
                    <span class="color" style="background-color: #f8c8dc;"></span>
                    <span class="color" style="background-color:rgb(228, 228, 104);"></span>
                    <span class="color" style="background-color:rgb(160, 160, 167);"></span>
                    <span class="color" style="background-color: #1c1c1e;"></span>
                </div>
                <div class="price-container">
                    <p>Từ 19.999.000đhoặc 814.000đ/tháng <br> trong 24 tháng*</p>
                    <button onclick="window.location.href='apple_order-test.php'" ; class="buy-btn">Mua</button>
                </div>
            </div>

            <?php
            $conn = new mysqli("localhost", "root", "", "phone_website");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if (!$result) {
                die("Lỗi truy vấn: " . $conn->error);
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product-card">';
                    echo '<h3 style="padding-bottom:20px;">' . htmlspecialchars($row["name"]) . '</h3>';
                    echo '<img style="width: 300px; height: 230px;padding-top:10px; margin-top:10px;object-fit: cover;" src="' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
                    echo '<button class="explore-btn" data-bs-toggle="modal" data-bs-target="#productModal">Hãy khám phá thiết bị</button>';

                    // Màu sắc sản phẩm
                    echo '<div class="color-options"; style="padding-top:10px">';
                    $colors = explode(",", $row["colors"]);
                    foreach ($colors as $index => $color) {
                        $activeClass = $index === 0 ? 'active' : '';
                        echo '<span class="color ' . $activeClass . '" style="background-color: ' . htmlspecialchars(trim($color)) . ';"></span>';
                    }
                    echo '</div>';

                    // Giá và nút mua hàng
                    echo '<div class="price-container">';
                    echo '<p>' . htmlspecialchars($row["price"]) . '</p>';
                    echo '<button class="buy-btn" onclick="window.location.href=\'apple_order-test.php?id=' . $row["id"] . '\'">Mua</button>';
                    echo '</div>';
                    echo '<button class="edit-btn" onclick="window.location.href=\'apple_edit-product.php?id=' . $row["id"] . '\'">Edit</button>';
                    echo '<button class="delete-btn" onclick="confirmDelete(' . $row["id"] . ')">Delete</button>';
                    echo '</div>'; // Đóng thẻ product-card
                }
            } else {
                echo "<p>Không có sản phẩm nào.</p>";
            }
            $conn->close();
            ?>
        </section>

        <br id="section2">
        <br>
        <br>
        <div>
            <h2>Hướng dẫn mua sắm. <p style="color: rgb(169, 169, 177); text-align: left;"> Không thể quyết định? Bắt
                    đầu tại đây.</p>
            </h2>
        </div>
        <section class="product-section" style="padding-right: 20px;">
            <div class="product-card"
                style="min-width: 480px !important; background-image:url(https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-card-50-compare-202409?wid=960&hei=1000&fmt=p-jpg&qlt=95&.v=1723564949528); ">
                <p style="color: rgb(133, 133, 139); font-size: 14px; padding-top:10px">SO SÁNH TẤT CẢ CÁC MÔ HÌNH</p>
                <h3 style="padding-top: 0px;">Chiếc iPhone nào phù hợp<br> với bạn ?</h3>
            </div>
            <div class="product-card"
                style="min-width: 480px !important; background-image:url(https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-card-50-apple-intelligence-202410?wid=960&hei=1000&fmt=p-jpg&qlt=95&.v=1729281958077); ">
                <p style="color: rgb(133, 133, 139); font-size: 14px;padding-top:10px">TRÍ TUỆ CỦA APPLE</p>
                <h3 style="padding-top: 0px;">Cá Nhân, Riêng Tư, Mạnh Mẽ.</h3>
            </div>
            <div class="product-card"
                style="min-width: 480px !important;background-image:url(https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-card-50-whyswitch-202409?wid=960&hei=1000&fmt=p-jpg&qlt=95&.v=1723847330385); ">
                <p style="color: rgb(133, 133, 139); font-size: 14px;padding-top:10px">CHUYỂN SANG iPHONE</p>
                <h3 style="padding-top: 0px;">Việc Chuyển Từ Android Sang<br> iPhone Cực Kỳ Đơn Giản. </h3>
            </div>
            <div class="product-card"
                style="min-width: 480px !important;background-image:url(https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-card-50-specialist-help-202309?wid=960&hei=1000&fmt=p-jpg&qlt=95&.v=1701194077641); ">
                <p style="color: rgb(133, 133, 139); font-size: 14px;padding-top:10px">CHUYÊN GIA APPLE</p>
                <h3 style="padding-top: 0px;">Mua Sắm Trực Tuyến Với<br> Chuyên Gia. </h3>
            </div>
        </section>
    </div>
    <div id="container2" class="container">
        <h1>Trang 2</h1>
        <p>Nội dung trang 2.</p>
    </div>
    <div id="container3" class="container">
        <h1>Trang 3</h1>
        <p>Nội dung trang 3.</p>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="top-modal">
                <ul class="nav nav-tabs" id="productTabs">
                    <li class="nav-item">
                        <a style="font-size:14px" class="nav-link active" data-bs-toggle="tab"
                            href="#iphone16pro">iPhone 16 Pro</a>
                    </li>
                    <li class="nav-item">
                        <a style="font-size:14px" class="nav-link" data-bs-toggle="tab" href="#iphone16promax">iPhone 16
                            Pro Max</a>
                    </li>
                </ul>
            </div>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="iphone16pro">
                            <div class="modal-content">
                                <div class="modal-left">
                                    <button class="prev" onclick="changeImage(-1)">&#10094;</button>
                                    <img id="product-img" class="product-image"
                                        src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone16promax-digitalmat-gallery-1-202409_GEO_US?wid=728&hei=666&fmt=p-jpg&qlt=95&.v=1723843667344"
                                        alt="Product Image">
                                    <button class="next" onclick="changeImage(1)">&#10095;</button>

                                    <div class="dots">
                                        <div class="dot active" onclick="setImage(0)"></div>
                                        <div class="dot" onclick="setImage(1)"></div>
                                        <div class="dot" onclick="setImage(2)"></div>
                                        <div class="dot" onclick="setImage(3)"></div>
                                        <div class="dot" onclick="setImage(4)"></div>
                                        <div class="dot" onclick="setImage(5)"></div>
                                    </div>

                                    <p style="text-align:center; padding-top:30px">Available in 4 finishes</p>

                                    <div class="color-options-modal">
                                        <div class="color-option" style="background: #d4af37;" onclick="setColor(0)">
                                        </div>
                                        <div class="color-option" style="background: #808080;" onclick="setColor(1)">
                                        </div>
                                        <div class="color-option" style="background: #f5f5dc;" onclick="setColor(2)">
                                        </div>
                                        <div class="color-option" style="background: #000000;" onclick="setColor(3)">
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-right">
                                    <div class="price-container">
                                        <h1 style="font-size: 38px; padding-top: 20px; padding-bottom:20px">iPhone 16
                                            Pro</h1>
                                        <button style="border-radius: 30px;" class="buy-button"
                                            onclick="location.href='apple_order.php'">Buy</button>

                                    </div>
                                    <p>From $1199 or $49.95/mo. for 24 mo.</p>
                                    <ul class="feature-list">
                                        <li><img style="width:40px; height:40px"
                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQw4j2YKBEC7N11eLYpIfUodw-ySoeLl1dUhwTkDNE3uIH7mkj1"
                                                alt="Icon"> Titanium design with a larger 6.9-inch Super Retina XDR
                                            display
                                        </li>
                                        <hr>
                                        <li><img style="width:40px; height:40px"
                                                src="data:image/jpeg;base64,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"
                                                alt="Icon"> The first iPhone designed for Apple Intelligence
                                            <hr>
                                        </li>
                                        <hr>
                                        <li><img style="width:40px; height:40px"
                                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIYAAAB8CAMAAACbrjjcAAAAh1BMVEX///8AAAABAQH+/v7f39/7+/vAwMAFBQVOTk5sbGz4+PgKCgrOzs709PQMDAwwMDBfX1/o6OjY2NhSUlLExMQrKyvm5uZzc3MSEhKOjo5CQkJXV1ciIiK6urqHh4c5OTmZmZkZGRl5eXmioqIXFxdnZ2ceHh6urq5JSUk2NjaTk5OAgICenp4+TqjdAAAHaElEQVR4nO1biXbiOgz1gjHYJCUBwt5O92Xm/7/vSVdhmQJ9LR0nM+egnpYlaXyjXZaiVCKyTgWrXKrLf5qCk9+WUShXdAK9tEzFMPph2TYK9yNqHae2bRh97XN907ZyhEftvb9qXTeWxms/aRuFGmptzFXbKC4wLjAuMP5iGBQ8HPIL6/htUEPyXlpg8FeWv1XJQ4y1shT/8rphaJgb1gVg4KPOKZc6xlhKt+h2XaCcy/LSBIO4IcsSAguGNRBwLfM8MAZ8HGoT9Q3Y5DjABTAkPQqGQC/VQGhJQtGT9bpLNC4zqE0DMJgXTmWLVeQIT+FV+xh1zvai/e1V1YxQrJjCemY0EQd5eonGECRGNLt2pJ44KSkJM+yUIERe17BqeM2gGIfkYSE5OwBChTkjMIRgS1H+DFk7XHpLYYuwqnjldUUkIK+jJ1RPA0ahktdPMAIX7PpBQxs2RMpBehrfyJC5aEluKrBGWmhOi7KBbGjGnLkjTlnVQDHpaoYEdVcr5ZYfuR6xYtgGZAJmOJTPxZLtdQuCfhYlvCu79PQ4gtxrR3VudNzhyPVqrTJhV3pDYVskIBQ+MjW+hb+oLcXfKwn0QTVYWbPZPpNywJ2zYly7JmLJO2KX7ew1F7AUUmZeT4uGIvw7HJbEQmoKF0bFNKmncy1s+5BRZKoib2rIgaxK8VtNwyAPkfFm02DFcpk925DZ5KnfUXJIie+fyIPOYRyheSA2c0j6gnoe9X6RpgTk5Q2jkGguTgTv9/L1T5HdYrY2YZbEsFxd0RyxY8rRNqkzn5dOlqInDgp0GHJ/x5WSG+Joye0fj7h0kEMk2JKQmAuuTgwOk8JtYaUS58+QCTk4th+yo0NeoBwuiqKqOumo7HSqIoOvPZYTskiK7nTCdQVHaZOIkJk93CzXheIs6D3fnSrmT1xh1RB0IuIrA8/tNWeGW6EENotCqeeVJLJG2PH128SN+lPLSwnlBQf/oaLhHi5KMmkyjYwic58vMIvCBeNPXu40UZnkzYf/t+M1A6JF+hk01nJEBDeGfImIys/vTv4K4Xb9B8I0uzJqoyNmWdQ1FFjiHnGKqcVizuEGS+QDZjCvdM2E2gjotr3UlApCUdf4yiObx3lfBkGipiLxf3lhdpCBJddzBxxkvbacaa6+6eDDojselOUZ/mBwAyynb8BAJHE9qKrxfDHTUvqbh8EmNyseCRW0ZlHaLJzpQt8gyXgaBjL1F7l8Vi18rSnDDFLJVEfXcpuGuvQ/J1sqmBUfoMBmR/xhEVhJFaaQEYlmILqhelFs/i77TmQNI+3B1dqNHDCDj86KzenW3WkoU3zBHo3LXmFt+rV7Fhc2KNR9TutsdePAu2lPRctwe75T3RtsQZjXDB8HM9HgN4tNw7MpW7BMTnHDM8sn4+316X7f2GSMJiXlj88o8nSOiuJsojR4/bqnogfcoCMPP3fn01oleymucTnDcHOoipkETqLPx0FiqaarkyrqzcNyDae9Pd1NxFjmyArvsFtlFt+ruDPkr6EYnKIy2H0UvNbCR9bcO2z2T2UTs4dQ9w1LkTzmg+Qv7Oc5XEX0sI9r+th36HsIbiRZ6NncYO0IQZ1C4YTZOxj0RQ/eyjxi0T4CiR6dzYczyaqe5B59dYFxgXGB8U/C8D10y5Si8q6ZHbPj3Ohx+aiq4ZPmAaUGtnOPwjAj3nNQc+6VxWETm8onYHBHLpto3tzNm5jXOiEU7scFPUNKNGhAOU5YCpp2Wnoy3Sa62MeFgi0OCrxUffluehQnuPGCclbqxrhuixu6hyN1PtseNy4wLjAuMP4dGL6HeSjesCFPum4LBnGDS0mU1dGP2wtt6OTyFhVVkq1FWA8YYUW8yFvMN/wILZ+fvFPol0VroW2E/eJOL/d+NE4P4lS+wQbLGjFYd6vf90OahEEFAieBjnvbzTxJ8TeXSxcYFxgXGP8CjDBFG4QjbKMPXlHJPEJfVj/ye27zcF/oxTY6FsWTLouIztcUDdBrdGPMRKYLmwSyQovQzzExeM/NS8r9CpWln4rfUaEqHrumbO85sKIMjLRg31STo4OkiHMe8CV2oOdniwkGsfVVpRqcjLKqM/Foa60KmeOc1h3Ru6pJdlTTenhh6qRD/5xLE9/PGxwTc3N+YsNznxp2kanwgjYXMWjYkYwn5XQPLp0Vy1iP2L5gO5Y3Q7szbHhxj/5xXBab6eQkRIl3KH8tVwzCR53HsUw2BQxDm+20yWauIRHJIxJGJhN49FvJOBy3x7IRtMNvh/Y/nkr5DokkPL/QIvlLJv1OHkHOVNnbn8051lX+c1TPh+CZgEW2aQM6TGaXI/LoJkY8yHDWNMsnSZjhPfx4v5JBSstOVQbir28xbbNB++XZns+TcCPXsx91g9bKsz4ZJms6j7nXW6mk4kbtswjKtMKDCU7tz0VyOV/dj2YbK0nFCrHJ1eK+Uw/Bv3crSAFcpxyMuwlpzcNDVagHAg5nAu32ITxM6v3Z6cz9Vj1GMZ08LnDorPG0hA1HZjj/KAkUzIXuDSb+B+dGXRjKzVyIAAAAAElFTkSuQmCC"
                                                alt="Icon"> Camera Control gives you an easier way to access camera
                                            tools
                                        </li>
                                        <hr>
                                        <li><img style="width:40px; height:40px"
                                                src="data:image/png;base64,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"
                                                alt="Icon"> A18 Pro chip powers Apple Intelligence and AAA gaming
                                        </li>
                                        <hr>
                                        <li><img style="width:40px; height:40px"
                                                src="data:image/png;base64,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"
                                                alt="Icon"> 4K 120 fps Dolby Vision and 4 studio-quality mics
                                        </li>
                                        <hr>
                                        <li><img style="width:40px; height:40px"
                                                src="data:image/jpeg;base64,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"
                                                alt="Icon"> Capture magical spatial photos and videos</li>
                                    </ul>
                                    <p style="padding-top:5px ;"><a href="#">Explore iPhone 16 Pro Max further ›</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="iphone16promax">
                            <div class="modal-content">
                                <div class="modal-left">
                                    <button class="prev" onclick="changeImage(-1)">&#10094;</button>
                                    <img id="product-img" class="product-image"
                                        src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone16promax-digitalmat-gallery-1-202409_GEO_US?wid=728&hei=666&fmt=p-jpg&qlt=95&.v=1723843667344"
                                        alt="Product Image">
                                    <button class="next" onclick="changeImage(1)">&#10095;</button>

                                    <div class="dots">
                                        <div class="dot active" onclick="setImage(0)"></div>
                                        <div class="dot" onclick="setImage(1)"></div>
                                        <div class="dot" onclick="setImage(2)"></div>
                                        <div class="dot" onclick="setImage(3)"></div>
                                        <div class="dot" onclick="setImage(4)"></div>
                                        <div class="dot" onclick="setImage(5)"></div>
                                    </div>

                                    <p style="text-align:center; padding-top:30px">Available in 5 finishes</p>

                                    <div class="color-options-modal">
                                        <div class="color-option" style="background: #d4af37;" onclick="setColor(0)">
                                        </div>
                                        <div class="color-option" style="background: #808080;" onclick="setColor(1)">
                                        </div>
                                        <div class="color-option" style="background: #f5f5dc;" onclick="setColor(2)">
                                        </div>
                                        <div class="color-option" style="background: #000000;" onclick="setColor(3)">
                                        </div>
                                        <div class="color-option" style="background:rgb(228, 157, 157);"
                                            onclick="setColor(3)">
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-right">
                                    <div class="price-container">
                                        <h1 style="font-size: 34px; padding-top: 20px; padding-bottom:20px">iPhone 16
                                            Pro Max</h1>
                                        <button style="border-radius: 30px;" class="buy-button"
                                            onclick="location.href='apple_order.php'">Buy</button>


                                    </div>
                                    <p>From $1399 or $59.95/mo. for 24 mo.</p>
                                    <ul class="feature-list">
                                        <li><img style="width:40px; height:40px"
                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQw4j2YKBEC7N11eLYpIfUodw-ySoeLl1dUhwTkDNE3uIH7mkj1"
                                                alt="Icon"> Titanium design with a larger 7.2-inch Super Retina XDR
                                            display
                                        </li>
                                        <hr>
                                        <li><img style="width:40px; height:40px"
                                                src="data:image/jpeg;base64,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"
                                                alt="Icon"> The first iPhone designed for Apple Intelligence
                                            <hr>
                                        </li>
                                        <hr>
                                        <li><img style="width:40px; height:40px"
                                                src="data:image/png;base64,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"
                                                alt="Icon"> Camera Control gives you an easier way to access camera
                                            tools
                                        </li>
                                        <hr>
                                        <li><img style="width:40px; height:40px"
                                                src="data:image/png;base64,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"
                                                alt="Icon"> A18 Pro chip powers Apple Intelligence and AAA gaming
                                        </li>
                                        <hr>
                                        <li><img style="width:40px; height:40px"
                                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHAAAABwCAMAAADxPgR5AAAAhFBMVEX///8AAAD+/v4BAQH9/f36+voFBQW/v7/39/fx8fGBgYHCwsJ+fn68vLwgICAMDAzt7e0vLy9gYGCenp4VFRWtra0QEBA0NDRdXV20tLQZGRknJyc+Pj6kpKRwcHDHx8eZmZmPj49OTk7R0dE7OztUVFR3d3ff39+JiYlGRkZQUFBqamrdaKlFAAAIrElEQVRoge1ae1/iPBNN0yT0RlvugoLuou7F7//93jlnUhR9dNvK+x/jLj8sNJO5nTmTasxVrnKVq1zlKlf5pzhjrDFeXixeXf/7rN49WLz8k/uclzdcpL9KM2CDJ7H6Hzc65/pv2Vv5rh+sjrc6mml5u+0ro1SpaAjd/cP8sUmStKckIiMcGg3MyvkyiLIkCUlPCfJlMy5rjH+4TaiNq/SWkIyMIdQFXUHV9pJUfsyAJIt5afzxj3pSfu6q/bQsfSyxi4s3mZTBj6D6ljcrzz1kBgX5rSz8TGTNfC7a0pDUP1pckEL0WiKjcuFrQW7mM+ZJU7T2ZBTywP0f9EHaGf355xe0M6TWUZ8fhnE9xbcb2NcUhCjFbWc7NL+8OPOE6CUPPqZK3AZtHFlgX0tFfXujvUlKwalhFthzySA6zYkjq2ERSwFq7PblLrD8w38AAAr98bA61e8AfXjxDgFMfsivOS/7vKhZkZ9CKj5okt1zFku1vzD/f2CJn2qul26zrQM7BRZOw39oDLQxaUK9Mm5YiCUdXbsOaWhaHx3k5oC2DktFb/jQplixgTgxN0OySmusUIdCu/dWACBAyXq+KEvEx2UfOrG5nyxeGtmH7GnWDkkq9HcLB9bIFjKMDQ2r99afovOhFD1/FrcBOL8Zgn2ZJOQWBu4jT/M3DNkhd15ZBmL0yYKuPTC880EGGvNT7lp3sLlldPYoQ+/K4rmoislHC2kT7lgw0Kv+GsUoS4siYctrpAT15ZW8pwXLKmdbtHqH8dVaWlhlgRB7OKTOXc9yxC0lMvEe0In8QREc5E533CE5NV/DbUlAUJXZhskSNki57BllUvUtRuyqEhVLRlC2WYtH68yZbCFv2Pkjt1llHUVGUsORIS2wRLsLIdQKiP9WKm6yP+XmP0bjuYU9C1n6yFqPRc+aPNKZWLKRxFxtpXs2ZMsM49aafm1MtNzKmr9ZEtYexJidrJrXMIyeg1JorXOFXe+RJc5u5VpO1ryWz18GVD/4LmFYMkXwOtyIawpBLeZLiDrlfeVijxRvbo1dyQctXTxPQ3jEVnrUI5IfrpvKjfg6vPggexUijOoIUSd13+qEZK3scCYuTcOSjM5KoiZNLNseHs2x/TLOWygqeT9VeI6dIo2suIR9sq0i9qe00hFkgiD3ZgZ2grt/semaFmk5wZJp15pi/0OBVBlr0Qr4cTsbnSNlBSX6/VSqQmKHze5Rd3JbdeLebzsS+E6GRbOiQeFncYkJPh6q0GO33a2uSDRRXi2E9kLblzgxQ7iyjmKNUWg9E7CE5zIynCSc2Qj/Vk7rMDPaWQCLiEQ5xkKKnwDI2CC7XHlVGEKlAI969UQdhV9XpsMVOnrK6V6tm6gz3wZRLkwxWXuEcVVVv4tV5ORuMkohmXYpqZnCjNvzJIW5grcES8nhhg5P19HkMQojvUf4U/DQKj2nhtBQsVY9GEiEg2TGtjQqafh13prifV4HUqdE6RJStm6J9RwJkvruTw2NG1wsR9The4XmSKPS2JwAA/fAbeee5NfZFBGfSv2nT5kflTTvFXrp5BG9Y4d60P4loJc8tigGwSUxNrmXu8L3FRqfHWtpAhG901swArCpeUialuRHbGzXaXJj3DRcwKViTVus42xxW7XdWCoqDvg0IzIJaWssrf6uQqcDorC230U1PX3ZS/9KSh+brTdTcbsfB20fXIrGxbLT5T0ATfBFEvdoTeQ3RioQCpFb37bwNN7Ho7RMSRbSxNGd2gmBitMLJA2H0Mx0RAVcyaKBgUAduBtmjVCgHRD4AklDI6Y3a0mZZl6aeB5qzDxpmly2wh21S6H5mbm/TNKY9qdOZEJh/sqAlNHkqQQR8CLtyQHkGkF0XPu2hUamtpCcaOkmV+B25q/8PpvC0yVAFYT2IllqzCyNxIZtQ/gLJ11Mj3KpfrqrE6K3eH9MA/5Y+JVO1fQqYLxwsUTyTWRz8uEsB9m4CLTZpaJ3d44htD6Oi95Vu4StZF2gbLwbw9o+JM02akq713Tru0MSZ6XjF8UKBQr+O6YOY0ZMMNvzcnV+PJNiIqPoWT9frCO3R8dPU342SCEO1qbwIw5O/LPG703PL1AKqiFWflyASBMc57X+CnXf9xgpPBDm8O50Rmiw0+W9MidjvYtXuE0Xd9NTITkfqL78UsKE5462dAaGZ0U4COYe1x0Xg+tpIIYo7Hogbp0YJk1Iz2IY4sGaJQGeFtXEkZxa1mE6nLUprwVbWlh0n2VyrnDtdKp2cPgCYLboesY+YFxzg6YnDpqi9VFWemFOPIczjUK70SB0fsmB6WHtlc0a8Ko7Z3se/7+6FPFAcjaG6T47C+FMg0zu7YyG9xfzxBlxRjiYvo8t3s4WxqyQnAtcdgRvLUacp+lxV6z9JelcvLRAOq/M21Lpr9DUSnlhS/ZXWaL49m+rx9I+zmsLXF3oWXG+w4mDkoI+Pn2n8BnFd5CV4brJyw7BmuNM0bLg6VbJnWlVTBXMzUvDCGd9T/jeKcx2iM8eq2PpzktZZFJ6GOOUYHieKCK1dm3WMb2BCjO74iTxwKWdPkyMruqO07zl4wUOiQxgGrZGc2aES715QeDCS2vi0Y0iGVi3i2yuwxvpxgeWzBOmjr4PqM4VwoQZD5/rRTyFhWPZ9rSFWa/piB0sauwNJaPb8qMsBIlgF1zf7CcTywfescSs6R4T2eN0P28U3mVItK+O/6cAepP0VT98OOdMf9ad3knanftxmumlKKp7w5ujieLGbMXHCOFzjTyb4pyDis/6P55yXdPt1CG1xTl4UPLlI2dlHnWRZ4zqABNdeW4hchvcz/BR0KeP0QVyHw/bmCW9kqWzKJ5BdRLnCe/i3w98+ocC5DTdBDJAiMevTomn9Txv+mol4BBRQQt1wCNGzs5n3/eWbMn/01MuQo8f4FFtcvaNRpilIOX9Fxu3fEjm7Qlgr3KVq1zlKle5yqfyP+lETW2+QYGKAAAAAElFTkSuQmCC"
                                                alt="Icon"> 4K 120 fps Dolby Vision and 4 studio-quality mics
                                        </li>
                                        <hr>
                                        <li><img style="width:40px; height:40px"
                                                src="data:image/jpeg;base64,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"
                                                alt="Icon"> Capture magical spatial photos and videos</li>
                                    </ul>
                                    <p style="padding-top:5px ;"><a href="#">Explore iPhone 16 Pro Max further ›</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-end">
                        <div class="offer">
                            <img class="icon"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAclBMVEX///8PwwkAvwDV89SH2obo+Ofz/PKG24Tc89yZ4Jee4p1h0l8KwwCV35Tl+OW26bXZ9Nl92XvO8M33/vfC7cKk46M7yjhQzk4qxyZn02VVzlOL2ort+uyu5q1g0l9213RGzETI78dr02m36bYlxiFx1nCbN14MAAAER0lEQVR4nO3d6XbaMBAF4FrsILawxOwkgfd/xZrQc1rQCEZCY4/T+/13oovlRbI1/vULAAAAAAAAAAAAAAAAAAAAAAAAAKAys3b1ZjLR2vPmKs+MDlm+as7bKeNtF8viz1qbaVE0xZjlYpso3+RgjJ5wf1ljDt0E+bYDU3WUB8zg5f3Y05zvwvReytc+ag9YRDy+cM6ZZBqPv3s2m8QGnKs8wbismccGrLrpbHERG/UJWERshAds1aSLXlkTftVY1ilgEXEZGrBZpz56YZphAUd1C1hEHAUlfK9XH72w7yEB3+q3C4ud+Pazd2HYTux6dqGSEaKvGYY/lmrSf9jkq2mnetNV7rlW80+n1I9kzSDFcDON7oDKaC13+wnRSW0WchzLe6OGPexu2qd+nrCrjbwR1dH6zI1X7rYxd7bCiJGBXTG3zd2EU9HGxpm6CXPeljNiF2rroxfunaW1vNnirbsl87cpmdvXDG/Khrjr1thJqW7K7GvExWIo3NY4Gzchb06KOElxz8Llcq9qzFM+EqqBhF5IqAYSev2XCRfCbY2zSJfQrjdNfTZr9740eh/qmIG6Fz2MrdVDp1tIiIT6ISES6sdM+PHjE9by4eEVeikS6oeESKgfEvoT2qrXH5BSjoA325Y+W+LJDObarpBQDST0QkI1kNALCdVAQi8kVAMJvZBQDST0QkI1kNALCdVAQi8kVAMJvZBQjVISbnedz/3gzv6zs2sly+FXQsLR/rt8lCszZi+/GEw+4dfDB43mK2UainjC8ZMnqWacNI9LOqFvSfs//094abR0Qvct63t2nTbRPeGEnNogwktPhRMuOAllVzEIJzw/Dyi99lQ4IbGk3WH3iTPdEk74ydmH58SZbgknHHISyq4fFk7Iec82qCZOOOnrIVF54Y70Mn7phM9L8sUW++MSvy+dPrsvla5TID+2ODwqy2fNIWUaSgnjw5011Ojwwthdwiy0Usb44/WJ2oGntXw+zNM8gIRqIKEXEqqBhF5IqEbKhK/VrpfScxPyKmER84Qd4bbG6bgJedOXREU64andSETlD15Fujaxnki4rVFmxPos5jdoTu5vU8ZQIdTO7Wsn5qZunWRuycUyzdwCpuxaydRE4VGwrXGORCu5s5dkyYGgeuAleCfayJ69JA7hQv4h2uIwHznVRMM+lshnEtYse/NGt3qNeW9JzoGxi+x6p0Ktmm920XN8IfOzSktfPWYzfkDW4091wp7HKqmgH4Jfkf3bszdJFAp9uaVmn5mJ+NBM7T7DEv7eR836acwLWM8enqkS9yRP9YcPbxn+3cyNdV0imug5iEM9Ir7yLLZfg4+vWfPSXOfkpH03mlP09x3/GOqOaBK8lLQ9+0YrVStGc+c0nwRuD3N9IYt4+TDhd50nw/V17KnBd0vWw1ePP1erMV70e9XrL8aNMpZzAAAAAAAAAAAAAAAAAAAAAAT7DRjpbCW8ri8wAAAAAElFTkSuQmCC"
                                alt="Credit Card Icon">
                            <div class="content">
                                <div class="title">Apple Card Monthly Installments</div>
                                <div class="text">Pay over time, interest-free when you choose to check out with Apple
                                    Card Monthly Installments.</div>
                            </div>
                        </div>

                        <div class="offer">
                            <img class="icon"
                                src="data:image/png;base64,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"
                                alt="Credit Card Icon">
                            <div class="content">
                                <div class="title">Trade in for credit</div>
                                <div class="text">Get credit toward your purchase when you trade in an eligible iPhone.
                                </div>
                            </div>
                        </div>

                        <div class="offer">
                            <img class="icon"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAclBMVEX///8PwwkAvwDV89SH2obo+Ofz/PKG24Tc89yZ4Jee4p1h0l8KwwCV35Tl+OW26bXZ9Nl92XvO8M33/vfC7cKk46M7yjhQzk4qxyZn02VVzlOL2ort+uyu5q1g0l9213RGzETI78dr02m36bYlxiFx1nCbN14MAAAER0lEQVR4nO3d6XbaMBAF4FrsILawxOwkgfd/xZrQc1rQCEZCY4/T+/13oovlRbI1/vULAAAAAAAAAAAAAAAAAAAAAAAAAKAys3b1ZjLR2vPmKs+MDlm+as7bKeNtF8viz1qbaVE0xZjlYpso3+RgjJ5wf1ljDt0E+bYDU3WUB8zg5f3Y05zvwvReytc+ag9YRDy+cM6ZZBqPv3s2m8QGnKs8wbismccGrLrpbHERG/UJWERshAds1aSLXlkTftVY1ilgEXEZGrBZpz56YZphAUd1C1hEHAUlfK9XH72w7yEB3+q3C4ud+Pazd2HYTux6dqGSEaKvGYY/lmrSf9jkq2mnetNV7rlW80+n1I9kzSDFcDON7oDKaC13+wnRSW0WchzLe6OGPexu2qd+nrCrjbwR1dH6zI1X7rYxd7bCiJGBXTG3zd2EU9HGxpm6CXPeljNiF2rroxfunaW1vNnirbsl87cpmdvXDG/Khrjr1thJqW7K7GvExWIo3NY4Gzchb06KOElxz8Llcq9qzFM+EqqBhF5IqAYSev2XCRfCbY2zSJfQrjdNfTZr9740eh/qmIG6Fz2MrdVDp1tIiIT6ISES6sdM+PHjE9by4eEVeikS6oeESKgfEvoT2qrXH5BSjoA325Y+W+LJDObarpBQDST0QkI1kNALCdVAQi8kVAMJvZBQDST0QkI1kNALCdVAQi8kVAMJvZBQjVISbnedz/3gzv6zs2sly+FXQsLR/rt8lCszZi+/GEw+4dfDB43mK2UainjC8ZMnqWacNI9LOqFvSfs//094abR0Qvct63t2nTbRPeGEnNogwktPhRMuOAllVzEIJzw/Dyi99lQ4IbGk3WH3iTPdEk74ydmH58SZbgknHHISyq4fFk7Iec82qCZOOOnrIVF54Y70Mn7phM9L8sUW++MSvy+dPrsvla5TID+2ODwqy2fNIWUaSgnjw5011Ojwwthdwiy0Usb44/WJ2oGntXw+zNM8gIRqIKEXEqqBhF5IqEbKhK/VrpfScxPyKmER84Qd4bbG6bgJedOXREU64andSETlD15Fujaxnki4rVFmxPos5jdoTu5vU8ZQIdTO7Wsn5qZunWRuycUyzdwCpuxaydRE4VGwrXGORCu5s5dkyYGgeuAleCfayJ69JA7hQv4h2uIwHznVRMM+lshnEtYse/NGt3qNeW9JzoGxi+x6p0Ktmm920XN8IfOzSktfPWYzfkDW4091wp7HKqmgH4Jfkf3bszdJFAp9uaVmn5mJ+NBM7T7DEv7eR836acwLWM8enqkS9yRP9YcPbxn+3cyNdV0imug5iEM9Ir7yLLZfg4+vWfPSXOfkpH03mlP09x3/GOqOaBK8lLQ9+0YrVStGc+c0nwRuD3N9IYt4+TDhd50nw/V17KnBd0vWw1ePP1erMV70e9XrL8aNMpZzAAAAAAAAAAAAAAAAAAAAAAT7DRjpbCW8ri8wAAAAAElFTkSuQmCC"
                                alt="Credit Card Icon">
                            <div class="content">
                                <div class="title">Get a sweet carrier deal at Apple</div>
                                <div class="text">Save even more on your new iPhone when you finance with select carrier
                                    deals.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <footer
        style="text-align: left;padding-bottom:30px; padding-left: 300px; padding-right: 150px; background-color:rgb(227, 227, 237);">
        <br>
        <br>
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
        var currentIndex = 0;
        var images = [
            "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone16promax-digitalmat-gallery-1-202409_GEO_US?wid=728&hei=666&fmt=p-jpg&qlt=95&.v=1723843667344",
            "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone16promax-digitalmat-gallery-2-202409?wid=728&hei=666&fmt=p-jpg&qlt=95&.v=1723843667165",
            "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone16promax-digitalmat-gallery-3-202409?wid=728&hei=666&fmt=p-jpg&qlt=95&.v=1723843667225",
            "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone16promax-digitalmat-gallery-4-202409?wid=728&hei=666&fmt=p-jpg&qlt=95&.v=1723843667689",
            "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone16promax-digitalmat-gallery-5-202409?wid=728&hei=666&fmt=p-jpg&qlt=95&.v=1723843667235",
            "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone16promax-digitalmat-gallery-6-202409?wid=728&hei=666&fmt=p-jpg&qlt=95&.v=1724880656312"
        ];
        const imgElement = document.getElementById("product-img");

        function changeImage(step) {
            currentIndex = (currentIndex + step + images.length) % images.length;
            updateImage();
        }

        function setImage(index) {
            currentIndex = index;
            updateImage();
        }

        function updateImage() {
            imgElement.src = images[currentIndex];
        }

    </script>
    <script>

        function showContainer(containerId, element) {
            let containers = document.querySelectorAll('.container');
            containers.forEach(container => {
                container.classList.remove('active');
            });
            document.getElementById(containerId).classList.add('active');

            let navItems = document.querySelectorAll('.nav-item-content');
            navItems.forEach(item => {
                item.classList.remove('active');
            });
            element.classList.add('active');
        }

    </script>

    <script>
        function confirmDelete(id) {
            if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                window.location.href = "apple_delete-product.php?id=" + id;
            }
        }
    </script>
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