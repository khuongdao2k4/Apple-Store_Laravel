<?php session_start(); ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập Tài Khoản Apple</title>

    <link rel="stylesheet" href="../assets/css/apple_home-styles.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <script src="../assets/js/js-apple_home.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <main class="main" role="main">
        <!-- Top Module (Video Header) -->
        <div id="top-module-container" class="container-fluid position-relative overflow-hidden">
            <video src="../assets/img/large.mp4" width="100%" autoplay loop muted class="video-large object-fit-cover"
                style="height: 100vh;">
                Your browser does not support the video tag.
            </video>

            <!-- Play Button -->
            <button id="watch-video-btn" type="button"
                class="btn btn-lg bg-body-secondary position-absolute top-50 start-50 translate-middle rounded-pill d-flex align-items-center">
                <i class="bi-play-fill me-2"></i>
                <span class="fs-5">Xem phim</span>
            </button>

            <!-- Pause Button -->
            <button class="btn btn-sm btn-secondary rounded-circle position-absolute top-0 end-0 m-3"
                id="pause-video-btn">
                <i class="bi bi-pause-fill"></i>
            </button>
        </div>

        <!-- Center Module (iPhone 16e) -->
        <div id="center-module-container" class="container-fluid py-5" style="margin-top:50px">
            <div id="top-content-module" class="row bg-body-tertiary text-center">
                <div class="col-12">
                    <div class="split-wrapper-top">
                        <br>
                        <h2 class="h1 fw-bolder mb-3">iPhone 16<span class="text-body-secondary">e</span></h2>
                        <p class="h3 fw-normal mb-3">iPhone mới nhất với giá tốt nhất.</p>
                        <p class="text-secondary mb-1">Đặt trước vào ngày 28 tháng 2</p>
                        <p class="text-secondary mb-3">Có hàng từ ngày 7 tháng 3</p>
                    </div>
                    <div class="cta-link">
                        <a href="#" class="btn btn-primary btn-lg rounded-pill">Tìm hiểu thêm</a>
                        <a href="#" class="btn btn-outline-primary btn-lg rounded-pill">Xem Giá</a>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <img src="../assets/img/hero_iphone_16e_endframe__enpjcl8w7fyq_largetall.png" alt="iPhone 16e"
                        class="img-fluid">
                </div>
                <div class="col-12 mt-3 fw-light">Apple Intelligence hiện đã khả dụng với Tiếng Anh</div>
            </div>
        </div>

        <!-- Body Center Module (iPhone 16 Pro & iPhone 16) -->
        <div id="body-center-module-container" class="container-fluid" style="margin-top:20px">
            <section class="product-section mb-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-image-container" style="margin-bottom:10px">
                            <img src="../assets/img/hero_iphone16pro_avail__fnf0f9x70jiy_largetall.jpg"
                                class="img-fluid" alt="iPhone 16 Pro">
                            <div class="product-description text-light">
                                <h5 class="product-title text-light">iPhone 16 Pro</h5>
                                <p class="product-text text-light ">Apple Intelligence hiện đã khả dụng với tiếng Anh
                                </p>
                                <div class="product-buttons">
                                    <a href="#" class="btn btn-primary rounded-pill">Tìm hiểu thêm</a>
                                    <a href="#" class="btn btn-outline-primary rounded-pill">Mua</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="product-image-container">
                            <img src="../assets/img/hero_iphone16_avail__euwzls69btea_largetall.jpg" class="img-fluid"
                                alt="iPhone 16">
                            <div class="product-description">
                                <h5 class="product-title">iPhone 16</h5>
                                <p class="product-text">Apple Intelligence hiện đã khả dụng với tiếng Anh</p>
                                <div class="product-buttons">
                                    <a href="#" class="btn btn-primary rounded-pill">Tìm hiểu thêm</a>
                                    <a href="#" class="btn btn-outline-primary rounded-pill">Mua</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="product-section mb-1">
                <div class="row gx-1">
                    <div class="col-md-6">
                        <div class="product-image-container">
                            <img src="../assets/img/promo_apple_watch_series_10_avail_lte__c70y29goir42_large.jpg"
                                class="img-fluid" alt="Apple Watch Series 10">
                            <div class="product-description">
                                <h5 class="product-title">Apple Watch Series 10</h5>
                                <p class="product-text">Mông hơn. Mãi đình.</p>
                                <div class="product-buttons">
                                    <a href="#" class="btn btn-primary rounded-pill">Tìm hiểu thêm</a>
                                    <a href="#" class="btn btn-outline-primary rounded-pill">Mua</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="product-image-container">
                            <img src="../assets/img/promo_ipadpro_avail__s271j89g8kii_large.jpg" class="img-fluid"
                                alt="iPad Pro">
                            <div class="product-description">
                                <h5 class="product-title">iPad Pro</h5>
                                <p class="product-text">Mồng không tưởng, linh không ngờ.</p>
                                <div class="product-buttons">
                                    <a href="#" class="btn btn-primary rounded-pill">Tìm hiểu thêm</a>
                                    <a href="#" class="btn btn-outline-primary rounded-pill">Mua</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>

            <section class="product-section mb-1">
                <div class="row gx-1">
                    <div class="col-md-6">
                        <div class="product-image-container">
                            <img src="../assets/img/promo_macbook_air_m3__e43jegok3wuq_large.jpg" class="img-fluid"
                                alt="MacBook Air">
                            <div class="product-description">
                                <h5 class="product-title">MacBook Air</h5>
                                <p class="product-text">Cỗ máy 13. Gọn bằng. Cân mọi việc.</p>
                                <div class="product-buttons">
                                    <a href="#" class="btn btn-primary rounded-pill">Tìm hiểu thêm</a>
                                    <a href="#" class="btn btn-outline-primary rounded-pill">Mua</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="product-image-container">
                            <img src="../assets/img/promo_macbookpro_announce__gdf98j6tj2ie_large.jpg" class="img-fluid"
                                alt="MacBook Pro">
                            <div class="product-description">
                                <h5 class="product-title">MacBook Pro</h5>
                                <p class="product-text">Một tuyệt tác. Của trí tuệ.</p>
                                <div class="product-buttons">
                                    <a href="#" class="btn btn-primary rounded-pill">Tìm hiểu thêm</a>
                                    <a href="#" class="btn btn-outline-primary rounded-pill">Mua</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>

            <section class="product-section mb-1">
                <div class="row gx-1">
                    <div class="col-md-6">
                        <div class="product-image-container">
                            <img src="../assets/img/promo_airpods_4_avail__bl22kvpg6ez6_large.jpg" class="img-fluid"
                                alt="AirPods 4">
                            <div class="product-description">
                                <h5 class="product-title">AirPods 4</h5>
                                <p class="product-text">Nay với tính năng Chủ Động Khử Tháng Ôn.</p>
                                <div class="product-buttons">
                                    <a href="#" class="btn btn-primary rounded-pill">Tìm hiểu thêm</a>
                                    <a href="#" class="btn btn-outline-primary rounded-pill">Mua</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="product-image-container">
                            <img src="../assets/img/promo_ipadair_ai__3fv1eitzqv6y_large.jpg" class="img-fluid"
                                alt="iPad Air">
                            <div class="product-description">
                                <h5 class="product-title">iPad Air</h5>
                                <p class="product-text">Hai Kịch ồ. Chip nhanh hơn. Đa zi năng.</p>
                                <div class="product-buttons">
                                    <a href="#" class="btn btn-primary rounded-pill">Tìm hiểu thêm</a>
                                    <a href="#" class="btn btn-outline-primary rounded-pill">Mua</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Apple TV+ Carousel -->
            <section class="apple-tv-carousel py-5" style="padding-top: 10px !important;">
                <div class="row">
                    <div class="col-12">
                        <div id="appleTVCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#appleTVCarousel" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#appleTVCarousel" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#appleTVCarousel" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#appleTVCarousel" data-bs-slide-to="3"
                                    aria-label="Slide 4"></button>
                                <button type="button" data-bs-target="#appleTVCarousel" data-bs-slide-to="4"
                                    aria-label="Slide 5"></button>
                                <button type="button" data-bs-target="#appleTVCarousel" data-bs-slide-to="5"
                                    aria-label="Slide 6"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../assets/img/980x551 (1).jpg" class="d-block w-100 img-fluid"
                                        alt="Severance">
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/img/980x551 (2).jpg" class="d-block w-100 img-fluid"
                                        alt="Prime Target">
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/img/980x551 (3).jpg" class="d-block w-100 img-fluid"
                                        alt="Drama Series">
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/img/980x551.jpg" class="d-block w-100 img-fluid"
                                        alt="Latest Apple TV+ Show">
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/img/980x551 (4).jpg" class="d-block w-100 img-fluid"
                                        alt="Action Series">
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/img/980x551 (5).jpg" class="d-block w-100 img-fluid"
                                        alt="Sci-Fi Thriller">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#appleTVCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#appleTVCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer
        style="text-align: left;padding-bottom:30px; padding-left: 300px; padding-right: 250px; background-color:rgb(227, 227, 237);">
        <br>
        <p style="color:rgb(106, 106, 108);">* Nay có hai phiên bản: AirPods 4 và AirPods 4 với Chủ Động Khử Tiếng Ồn.
            <br>
            Phiên bản beta của Apple Intelligence khả dụng trên tất cả các phiên bản iPhone 16, iPhone 15 Pro, iPhone 15
            Pro Max, iPad mini (A17 Pro), iPad và Mac với M1 trở lên, với Siri<br>
            và ngôn ngữ thiết bị được thiết lập là tiếng Anh (Úc, Canada, Ireland, New Zealand, Nam Phi, Vương quốc Anh
            hoặc Mỹ), trên một bản cập nhật phần mềm iOS 18, iPadOS 18 và <br>
            macOS Sequoia. Một số tính năng bổ sung và hỗ trợ ngôn ngữ tiếng Trung (Giản thể), tiếng Anh (Ấn Độ,
            Singapore), tiếng Pháp, tiếng Đức, tiếng Ý, tiếng Nhật, tiếng Hàn, tiếng <br>
            Bồ Đào Nha (Brazil), tiếng Tây Ban Nha sẽ ra mắt vào đầu tháng 4, và nhiều ngôn ngữ khác, bao gồm cả tiếng
            Việt sẽ ra mắt trong năm nay. Một số tính năng không khả dụng ở <br>
            một số khu vực hoặc ngôn ngữ. <br>
            Apple TV+ yêu cầu đăng ký thuê bao.<br>
            Một số tính năng có thể thay đổi. Một số tính năng, ứng dụng và dịch vụ chỉ khả dụng ở một số khu vực hoặc
            ngôn ngữ.</p>
        <hr>
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