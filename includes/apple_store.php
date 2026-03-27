<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>iPhone - Apple (VN)</title>

    <link rel="stylesheet" href="../assets/css/apple_store-styles.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../assets/js/js-apple_store.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
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
                    <li class="nav-item" ; style="padding: 0px 10px"><a class="nav-link" href="apple_home.php">Cửa
                            Hàng</a>
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
                                    <li class="li-row" onclick="location.href='apple_statistics.php'">Thống Kê</li>
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
    <section class="product-categories">
        <div class="categories-container">
            <ul class="categories-list">
                <li><a href="#"><img
                            src="https://www.apple.com/v/iphone/home/cb/images/chapternav/iphone_16_pro_light__sh8e76empwyq_large.svg"
                            alt="iPhone 16 Pro"><br>iPhone 16 Pro</a></li>
                <li><a href="#"><img
                            src="https://www.apple.com/v/iphone/home/cb/images/chapternav/iphone_16_light__1g0j6j3ygciy_large.svg"
                            alt="iPhone 16"><br>iPhone 16</a></li>
                <li><a href="#"><img
                            src="https://www.apple.com/v/iphone/home/cb/images/chapternav/iphone_16e_light__dcdfirk5ikk2_large.svg"
                            alt="iPhone 16e"><br>iPhone 16e<br><span class="new-label">Mới</span></a></li>
                <li><a href="#"><img
                            src="https://www.apple.com/v/iphone/home/cb/images/chapternav/iphone_15_light__fj1tpga410a6_large.svg"
                            alt="iPhone 15"><br>iPhone 15</a></li>
                <li><a href="#"><img
                            src="https://www.apple.com/v/iphone/home/cb/images/chapternav/iphone_compare_light__f01dnbvbb62y_large.svg"
                            alt="So Sánh"><br>So Sánh</a></li>
                <li><a href="#"><img
                            src="https://www.apple.com/v/iphone/home/cb/images/chapternav/airpods_light__cd9exnztczjm_large.svg"
                            alt="AirPods"><br>AirPods</a></li>
                <li><a href="#"><img
                            src="https://www.apple.com/v/iphone/home/cb/images/chapternav/airtag_light__c19z9f5le0ia_large.svg"
                            alt="AirTag"><br>AirTag</a></li>
                <li><a href="#"><img
                            src="https://www.apple.com/v/iphone/home/cb/images/chapternav/accessories_light__e917u1i857e6_large.svg"
                            alt="Phụ Kiện"><br>Phụ Kiện</a></li>
                <li><a href="#"><img
                            src="https://www.apple.com/v/iphone/home/cb/images/chapternav/iphone_ios_light__b0jhieo01t0i_large.svg"
                            alt="iOS 18"><br>iOS 18</a></li>
                <li><a href="apple_mua-iphone.php"><img
                            src="https://www.apple.com/v/iphone/home/cb/images/chapternav/shop_iphone_light__e4dlk2n6h26a_large.svg"
                            alt="Mua sắm iPhone"><br>Mua sắm iPhone</a></li>
            </ul>
        </div>
        <div class="content-wrapper">
            <p>Thanh toán hàng tháng thật dễ dàng. Bao gồm lựa chọn lãi suất 0%. <a href="#">Tìm hiểu thêm ></a></p>
        </div>
    </section>
    <section class="hero-section">
        <h1>iPhone</h1>
        <p>Được thiết kế để ai cũng mê.</p>
    </section>
    <div class="video-container">
        <video id="heroVideo" class="hero-video" autoplay loop muted playsinline>
            <source
                src="https://www.apple.com/105/media/ww/iphone/family/2025/e7ff365a-cb59-4ce9-9cdf-4cb965455b69/anim/welcome/xlarge_2x.mp4#t=0"
                type="video/mp4">
            Trình duyệt của bạn không hỗ trợ video.
        </video>
        <button class="video-controls" onclick="toggleVideo()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="control-centered-small-icon">
                <g class="control-icon-pause">
                    <rect width="4.5" height="14" x="3.75" y="3" rx="1.5"></rect>
                    <rect width="4.5" height="14" x="11.75" y="3" rx="1.5"></rect>
                </g>
                <path class="control-icon-play"
                    d="M5 15.25V4.77a1.44 1.44 0 0 1 1.44-1.62 1.86 1.86 0 0 1 1.11.31l8.53 5c.76.44 1.17.8 1.17 1.51s-.41 1.07-1.17 1.51l-8.53 5a1.86 1.86 0 0 1-1.11.31A1.42 1.42 0 0 1 5 15.25Z">
                </path>
            </svg>
        </button>
    </div>
    <div class="product-content">
        <h1>Tìm hiểu iPhone.</h1>
    </div>
    <section class="product-section">
        <div class="product-card"
            style="background-image: url('https://www.apple.com/v/iphone/home/cb/images/overview/consider/camera__exi2qfijti0y_small_2x.jpg');">
            <h3>Camera Tiên Tiến</h3>
            <p>Ghi lại những chuyển động đẹp nhất <br>trong video và ảnh chụp.</p>
            <div class="plus-icon">+</div>
        </div>
        <div class="product-card"
            style="background-image: url('https://www.apple.com/v/iphone/home/cb/images/overview/consider/battery__2v7w6kmztvm2_small_2x.jpg');">
            <h3>Chip Và Thời Lượng <br> Pin</h3>
            <p>Nhanh. Nhanh dài lâu.</p>
            <div class="plus-icon">+</div>
        </div>
        <div class="product-card"
            style="background-image: url('https://www.apple.com/v/iphone/home/cb/images/overview/consider/innovation__os9bmmo3mjee_small_2x.jpg');">
            <h3 style="color: black">Đổi Mới Sáng Tạo</h3>
            <p style="color: black">Đẹp và bền, được mặc định trong <br>thiết kế.</p>
            <div class="plus-icon">+</div>
        </div>
        <div class="product-card"
            style="background-image: url('https://www.apple.com/v/iphone/home/cb/images/overview/consider/apple_intelligence__gbh77cvflkia_small_2x.jpg');">
            <h3>Apple Intelligence</h3>
            <p>Khai mở những tiềm năng mạnh mẽ.</p>
            <div class="plus-icon">+</div>
        </div>
        <div class="product-card"
            style="background-image: url('https://www.apple.com/v/iphone/home/cb/images/overview/consider/environment__e3v3gj88dl6q_small_2x.jpg');">
            <h3 style="color: black">Môi Trường</h3>
            <p style="color: black">Tái chế. Tái sử dụng. <br> Cứ thế.</p>
            <div class="plus-icon">+</div>
        </div>
        <div class="product-card"
            style="background-image: url('https://www.apple.com/vn/iphone/home/images/overview/consider/personalize__dwg8srggrbo2_small_2x.jpg');">
            <h3>Quyền Riêng Tư</h3>
            <p>Dữ liệu của bạn. <br> Ngay nơi bạn muốn.</p>
            <div class="plus-icon">+</div>
        </div>
        <div class="product-card"
            style="background-image: url('https://www.apple.com/vn/iphone/home/images/overview/consider/safety__bwp7rsowtjiu_small_2x.jpg');">
            <h3>Tuỳ Chỉnh iPhone</h3>
            <p>Thêm bản sắc của bạn. <br> vào khắp điện thoại.</p>
            <div class="plus-icon">+</div>
        </div>
    </section>

    <h2 class="text-left" style='padding-left:100px; padding-top: 50px; font-size: 55px; font-weight: bold; '>Khám phá
        dòng sản phẩm.</h2>

    <section class="new-product-section" style="margin-bottom: 50px;">
        <table class="product-table">
            <tr>
                <th><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/iphone_16pro__erw9alves2qa_xlarge_2x.png"
                        alt="iPhone 16 Pro" width="150"></th>
                <th><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/iphone_16__c5bvots96jee_xlarge_2x.png"
                        alt="iPhone 16" width="150"></th>
                <th><img src="http://apple.com/v/iphone/home/cb/images/overview/select/iphone_16e__cubm3xoy5qaa_xlarge_2x.png"
                        alt="iPhone 16e" width="150"></th>
                <th><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/iphone_15__buwagff0mwwi_xlarge_2x.png"
                        alt="iPhone 15" width="150"></th>
            </tr>
            <tr>
                <td class="color_phone"><img src="..\assets\img\color 3.png" alt=""></td>
                <td class="color_phone"><img src="..\assets\img\color 2.png" alt=""></td>
                <td class="color_phone"><img src="..\assets\img\color 3.png" alt=""></td>
                <td class="color_phone"><img src="..\assets\img\color 2.png" alt=""></td>
            </tr>
            <tr>
                <td style="font-size: 25px;">iPhone 16 Pro</td>
                <td style="font-size: 25px;">iPhone 16</td>
                <td style="font-size: 25px;">iPhone 16e</td>
                <td style="font-size: 25px;">iPhone 15</td>
            </tr>
            <tr>
                <td>Một iPhone cực đỉnh.</td>
                <td>Một thiết bị siêu mạnh mẽ.</td>
                <td>iPhone mới nhất với giá tốt nhất.</td>
                <td>Luôn tuyệt vời như thế.</td>
            </tr>
            <tr>
                <td><b>Từ 28.999.000đ hoặc 1.181.000đ/th. <br> trong 24 tháng*</b></td>
                <td><b>Từ 22.999.000đ hoặc 936.000đ/th.<br> trong 24 tháng*</b></td>
                <td><b>Từ 16.999.000đ hoặc 692.000đ/th.<br> trong 24 tháng*</b></td>
                <td><b>Từ 19.999.000đ hoặc 814.000đ/th.<br> trong 24 tháng*</b></td>
            </tr>
            <tr>
                <td><button class="btn btn-primary">Tìm hiểu thêm</button></td>
                <td><button class="btn btn-primary">Tìm hiểu thêm</button></td>
                <td><button class="btn btn-primary">Tìm hiểu thêm</button></td>
                <td><button class="btn btn-primary">Tìm hiểu thêm</button></td>
            </tr>
        </table>
        <hr>
        <table class="product-table2">
            <tr>
                <th><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_a18_pro__exkx38vklpci_large.png"
                        alt=""> <br>
                    <p>Chip A18 với GPU 6 lõi</p>
                </th>
                <th><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_a18__bpom9lrselte_large.png"
                        alt="">
                    <p>Chip A18 với GPU 5 lõi</p>
                </th>
                <th><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_a18__bpom9lrselte_large.png"
                        alt="">
                    <p>Chip A18 với GPU 4 lõi</p>
                </th>
                <th><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_a16__d1p797ptmg6e_large.png"
                        alt="">
                    <p>Chip A16 Bionic </p>
                </th>
            </tr>
            <tr>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_apple_intelligence__cy36nscjfrma_large.png"
                        alt=""> <br>
                    <p>Được thiết kế cho Apple Intelligence7</p>
                </td>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_apple_intelligence__cy36nscjfrma_large.png"
                        alt=""> <br>
                    <p>Được thiết kế cho Apple Intelligence7</p>
                </td>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_apple_intelligence__cy36nscjfrma_large.png"
                        alt=""> <br>
                    <p>Được thiết kế cho Apple Intelligence7</p>
                </td>
                <td><b>__</b></td>
            </tr>
            <tr>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_camera_button__e83hkgwaefam_large.png"
                        alt=""> <br>
                    <p>Điều Khiển Camera</p>
                </td>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_camera_button__e83hkgwaefam_large.png"
                        alt=""> <br>
                    <p>Điều Khiển Camera</p>
                </td>
                <td><b>__</b></td>
                <td><b>__</b></td>
            </tr>
            <tr>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_iphone_16_pro_camera__edtadvfv6hg2_large.png"
                        alt=""> <br>
                    <p>Hệ thống camera chuyên nghiệp <br> Camera Fusion 48MP tiên tiến nhất của chúng tôi <br> Camera
                        Telephoto 5x <br> Camera Ultra Wide 48MP <br> Trí Thông Minh Thị Giác, để nhận thức môi trường
                        <br>xung quanh bạn
                    </p>
                    <br>
                </td>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_iphone_16_camera__fbzexjpz33iy_large.png"
                        alt=""> <br>
                    <p>Hệ thống camera kép tiên tiến <br> Camera Fusion 48MP <br> Telephoto 2x <br> Camera Ultra Wide
                        12MP <br> Trí Thông Minh Thị Giác, để nhận thức môi trường <br> xung quanh bạn</p>
                    <br>
                </td>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_iphone_16e_camera__czsbuoy3qb8m_large.png"
                        alt=""> <br>
                    <p>Hệ thống camera 2 trong 1 <br> Camera Fusion 48MP <br> Telephoto 2x <br> — <br> Camera not
                        applicable <br> Trí Thông Minh Thị Giác, để nhận thức <br>môi trường xung quanh bạn</p>
                    <br>
                </td>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_iphone_15_camera__gfh1sh7ru0ya_large.png"
                        alt=""> <br>
                    <p>Hệ thống camera kép <br> Camera Chính 48MP <br> Telephoto 2x <br> Camera Ultra Wide <br> <br>—
                        <br> <br> <br>
                    </p>
                </td>
            </tr>
            <tr>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_battery_100__den5pjokk60y_large.png"
                        alt=""> <br>
                    <p>Thời gian xem video đến 33 giờ2</p>
                </td>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_battery_100__den5pjokk60y_large.png"
                        alt=""> <br>
                    <p>Thời gian xem video đến 27 giờ2</p>
                </td>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_battery_100__den5pjokk60y_large.png"
                        alt=""> <br>
                    <p>Thời gian xem video lên đến 26 giờ10</p>
                </td>
                <td><img src="https://www.apple.com/v/iphone/home/cb/images/overview/select/product_tile_icon_battery_100__den5pjokk60y_large.png"
                        alt=""> <br>
                    <p>Thời gian xem video lên đến 26 giờ2</p>
            </tr>
        </table>
    </section>




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

    <script>
        const pauseButton = document.querySelector('.pause-button');
        const video = document.querySelector('.video-container video');

        if (video.readyState >= 2) {
            video.play();
        } else {
            video.addEventListener('loadeddata', () => {
                video.play();
            });
        }
        pauseButton.addEventListener('click', function () {
            if (video.paused) {
                video.play();
                this.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
                this.setAttribute('aria-label', 'Pause video');
            } else {
                video.pause();
                this.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';
                this.setAttribute('aria-label', 'Play video');
            }
        });
        $(document).ready(function () {
            $('.image-carousel').slick({
                infinite: false, //Prevent infinite loop
                slidesToShow: 4, // Show 4 images
                slidesToScroll: 1,
                arrows: true, // Enable navigation arrows
                dots: false,  // Remove dots if you want
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });


        $(document).ready(function () {
            $('.image-carousel-icon').slick({
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>