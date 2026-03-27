<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<title>Mac - Apple(VN)</title>
	<link rel="stylesheet" href="../assets/css/apple_store-styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
		integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="../assets/apple_mac-styles.php" />
	<link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
	<style>
		body {
			font-family: sans-serif;
		}

		/* Styling for the video section to match the look */
		.video-container {
			position: relative;
			overflow: hidden;
			width: 100%;
			height: 700px;
			margin: 0 auto;
		}

		/* Custom style for pause button */
		.pause-button {
			position: absolute;
			bottom: 15px;
			right: 15px;
			background-color: rgba(0, 0, 0, 0.5);
			color: white;
			border: none;
			width: 30px;
			height: 30px;
			cursor: pointer;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1rem;
			z-index: 10;
		}

		.slick-slide {
			margin: 0 10px;
		}

		.slick-prev:before,
		.slick-next:before {
			color: black;
		}

		.image-wrapper {
			overflow: hidden;
			position: relative;
		}

		.image-wrapper img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.btn-primary {
			background-color: #007bff;
			border-color: #007bff;
			display: block;
			margin: 0 auto;
			width: fit-content;
		}

		.btn-primary:hover {
			background-color: #0069d9;
			border-color: #0062cc;
		}

		.image-button {
			position: absolute;
			bottom: 10px;
			right: 10px;
			width: 25px;
			height: 25px;
			cursor: pointer;
			display: flex;
			align-items: center;
			justify-content: center;
			text-align: center;
			z-index: 10;
		}

		/* Vì sao Apple là nơi tốt nhất để mua Mac */
		.section-incentive {
			padding: 2rem 0;
		}

		/* Styles for title */
		.section-header-headline {
			text-align: left;
			font-weight: bold;
		}

		.carousel-button {
			position: absolute;
			bottom: 10px;
			right: 10px;
			width: 25px;
			height: 25px;
			cursor: pointer;
			text-align: center;
			z-index: 10;
		}

		.carousel-button i {
			font-size: 1rem
		}

		/*Change from white to black the text in cards*/
		div .card .card-title {
			color: black;
			text-align: left
		}

		/*Styles to fix what was created*/
		.col-12 .image-wrapper {
			width: auto;

		}

		.col-md-4 .text-md-end {
			text-align: end !important;
			/*Override the text aligment to the right when small size screens happens */
		}

		/* Style for the bold big Mac word*/
		.text-bk {
			font-size: 5rem;
			font-weight: 600;
		}

		/* Footer styles */
		.footer-list-title {
			font-size: 1rem;
			font-weight: bold;
			margin-bottom: 0.5rem;
		}

		.footer-list a {
			color: black;
			font-weight: lighter;
			font-size: small;
			text-decoration: none;
			/* Remove underline */
		}

		.footer-legal {
			font-size: 0.75rem;
		}

		.footer-bottom {
			margin-top: 1rem;
			border-top: 1px solid #ddd;
			padding-top: 1rem;
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
	<section class="product-categories">
		<div class="categories-container">
			<ul class="categories-list">
				<li><a href="#"><img
							src="https://www.apple.com/v/mac/home/cc/images/chapternav/macbookair_light__dfypt7o3xfgy_large.svg"
							alt="iPhone 16 Pro"><br>MacBook Air</a></li>
				<li><a href="#"><img
							src="https://www.apple.com/v/mac/home/cc/images/chapternav/macbookair_light__dfypt7o3xfgy_large.svg"
							alt="iPhone 16"><br>MacBook Pro</a></li>
				<li><a href="#"><img
							src="https://www.apple.com/v/mac/home/cc/images/chapternav/imac_light__cx5ex9nbqxme_large.svg"
							alt="iPhone 16e"><br>iMac<br><span class="new-label">Mới</span></a></li>
				<li><a href="#"><img
							src="https://www.apple.com/v/mac/home/cc/images/chapternav/mac_mini_light__e7ojhup2ezau_large.svg"
							alt="iPhone 15"><br>Mac mini</a></li>
				<li><a href="#"><img
							src="https://www.apple.com/v/mac/home/cc/images/chapternav/mac_studio_light__fcr3455qk0i2_large.svg"
							alt="So Sánh"><br>Mac Studio</a></li>
				<li><a href="#"><img
							src="https://www.apple.com/v/mac/home/cc/images/chapternav/mac_pro_light__bly2b0ua4seq_large.svg"
							alt="AirPods"><br>Mac Pro</a></li>
				<li><a href="#"><img
							src="	https://www.apple.com/v/mac/home/cc/images/chapternav/hmc_light__fq8mh4xb68mm_large.svg"
							alt="AirTag"><br>Help Me Choose</a></li>
				<li><a href="#"><img
							src="	https://www.apple.com/v/mac/home/cc/images/chapternav/mac_compare_light__capy8s4wrbhy_large.svg"
							alt="Phụ Kiện"><br>Compare</a></li>
				<li><a href="#"><img
							src="https://www.apple.com/v/mac/home/cc/images/chapternav/displays_light__d67yrnk0qsa6_large.svg"
							alt="iOS 18"><br>Displays</a></li>
				<li><a href="apple_mua-iphone.php"><img
							src="https://www.apple.com/v/mac/home/cc/images/chapternav/mac_accessories_light__esnwbnk4bxqq_large.svg"
							alt="Mua sắm iPhone"><br>Acessories</a></li>
				<li><a href="apple_mua-iphone.php"><img
							src="https://www.apple.com/v/mac/home/cc/images/chapternav/mac_os_light__6mb5pqhztcie_large.svg"
							alt="Mua sắm iPhone"><br>Sequoia</a></li>
				<li><a href="apple_mua-iphone.php"><img
							src="	https://www.apple.com/v/mac/home/cc/images/chapternav/mac_shop_light__f0m72gc7jguq_large.svg"
							alt="Mua sắm iPhone"><br>Shop Mac</a></li>
			</ul>
		</div>
		<div class="content-wrapper">
			<p>Now through April 2, get extra trade-in credit toward a new Mac with Apple Trade In. <a href="#">Shop Mac
					></a></p>
		</div>
	</section>

	<main class="container mt-4">
		<section class="jumbotron bg-white">
			<div class="row align-items-center" style="padding-top: 50px;">
				<div class="col-md-6">
					<p class="text-bk">Mac</p>
				</div>
				<div class="col-md-6">
					<p class="h4 fw-medium text-md-end">
						Bạn nghĩ được <br />là Mac làm được.
					</p>
				</div>
			</div>

			<!-- Video Section -->
			<div class="video-container" style="border-radius: 10px">
				<video autoplay muted loop>
					<!-- style="width:1350px; height: 705px;" -->
					<source src="../assets/img/large12.mp4" type="video/mp4" />
					Your browser does not support the video tag.
				</video>
				<button class="pause-button rounded-circle" aria-label="Pause video">
					<i class="fa fa-pause" aria-hidden="true"></i>
				</button>
			</div>
		</section>

		<section class="section section-consider mt-5">
			<div class="section-header">
				<h2 class="h1 fw-bolder">Tìm hiểu về Mac</h2>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="image-carousel">
						<div>
							<div class="image-wrapper">
								<img src="../assets/img/mac_compatibility__cu59oukz81ci_large.jpg"
									style="border-radius: 20px" alt="Image 1" />
								<button class="btn btn-dark rounded-circle image-button carousel-button">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div>
							<div class="image-wrapper">
								<img src="../assets/img/mac_durability__epiwcuk7zkeq_large (1).jpg"
									style="border-radius: 20px" alt="Image 2" />
								<button class="btn btn-dark rounded-circle image-button carousel-button">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div>
							<div class="image-wrapper">
								<img src="../assets/img/mac_intelligence__esfi0qmvis6e_large.jpg"
									style="border-radius: 20px" alt="Image 3" />
								<button class="btn btn-dark rounded-circle image-button carousel-button">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div>
							<div class="image-wrapper">
								<img src="../assets/img/mac_iphone__gh1tblkt6bqm_large.jpg" style="border-radius: 20px"
									alt="Image 4" />
								<button class="btn btn-dark rounded-circle image-button carousel-button">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div>
							<div class="image-wrapper">
								<img src="../assets/img/mac_performance__dh5hyac1zf8m_large.jpg"
									style="border-radius: 20px" alt="Image 5" />
								<button class="btn btn-dark rounded-circle image-button carousel-button">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div>
							<div class="image-wrapper">
								<img src="../assets/img/mac_security__gfwda10khdym_large.jpg"
									style="border-radius: 20px" alt="Image 6" />
								<button class="btn btn-dark rounded-circle image-button carousel-button">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="section section-trade-in mt-5">
			<div class="section-header">
				<p class="h1 fw-bolder">Apple Trade In</p>
			</div>
			<div class="row align-items-center"
				style="border-radius: 10px; box-shadow: rgb(196, 196, 196) 5px 5px 20px;">
				<div class="col-md-6">
					<div class="card-body">
						<h5 class="card-title">
							Đưa máy cũ cho chúng tôi. Tiết kiệm khi mua máy mới.
						</h5>
						<p class="card-text">
							Với Apple Trade In, bạn có thể nhận được khoản giá trị xứng đáng
							khi đổi thiết bị đang dùng và sử dụng giá trị đó để mua thiết bị
							mới. Nếu thiết bị của bạn không đủ điều kiện để đổi lấy điểm tín
							dụng, chúng tôi sẽ tái chế thiết bị miễn phí.
						</p>
						<a href="#">Xem thiết bị của bạn đáng giá bao nhiêu
							<i class="fa-solid fa-angle-right"></i></a>
					</div>
				</div>
				<div class="col-md-6">
					<img src="../assets/img/tradein__gbtxz5sa3cyi_large.jpg" class="img-fluid" alt="Apple Trade In" />
				</div>
			</div>
		</section>

		<section class="section section-incentive mt-5">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-8">
						<h2 class="section-header-headline">Vì sao Apple là nơi tốt nhất để mua Mac</h2>
					</div>
					<div class="col-md-4 text-md-end">
						<a href="/vn/shop/goto/buy_mac" class="icon-wrapper section-header-cta-link">
							<span class="icon-copy">Mua sắm Mac
								<i class="fa-solid fa-angle-right"></i>
							</span>
							<span class="icon icon-after more"></span>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="image-carousel-icon">
							<div class="card finance border-0 rounded-4" style="height: 200px; width: 200px;">
								<div class="card-body h-100 d-flex flex-column card-body-icon"
									style="border: 1px solid; border-radius: 20px;">
									<i class="fa fa-credit-card fa-2x" aria-hidden="true"></i>
									<h5 class="card-title">Thanh toán hàng tháng thật dễ dàng</h5>
									<p class="card-text">Bao gồm lựa chọn lãi suất 0%.</p>
									<p class="align-self-end"> <!--To add the button below the text-->
										<a href="#" class="btn btn-dark rounded-circle image-button carousel-button"
											aria-label="More Info"><i class="fas fa-plus"></i></a>
									</p>
								</div>
							</div>
							<div class="card tweak border-0 rounded-4" style="height: 200px; width: 200px;">
								<div class="card-body h-100 d-flex flex-column card-body-icon"
									style="border: 1px solid; border-radius: 20px;">
									<i class="fa fa-cog fa-2x" aria-hidden="true"></i>
									<h5 class="card-title">Tùy chỉnh máy Mac của bạn</h5>
									<p class="card-text">Chọn chip, bộ nhớ, dung lượng lưu trữ và cả màu sắc.</p>
									<p class="align-self-end"> <!--To add the button below the text-->
										<a href="#" class="btn btn-dark rounded-circle image-button carousel-button"
											aria-label="More Info"><i class="fas fa-plus"></i></a>
									</p>
								</div>
							</div>
							<div class="card delivery border-0 rounded-4" style="height: 200px; width: 200px;">
								<div class="card-body h-100 d-flex flex-column card-body-icon"
									style="border: 1px solid; border-radius: 20px;">
									<i class="fa fa-truck fa-2x" aria-hidden="true"></i>
									<h5 class="card-title">Giao hàng miễn phí</h5>
									<p class="card-text">Giao hàng miễn phí thẳng đến tận nhà.</p>
									<p class="align-self-end"> <!--To add the button below the text-->
										<a href="#" class="btn btn-dark rounded-circle image-button carousel-button"
											aria-label="More Info"><i class="fas fa-plus"></i></a>
									</p>
								</div>
							</div>
							<div class="card expert border-0 rounded-4" style="height: 200px; width: 200px;">
								<div class="card-body h-100 d-flex flex-column card-body-icon"
									style="border: 1px solid; border-radius: 20px;">
									<i class="fa fa-user fa-2x" aria-hidden="true"></i>
									<h5 class="card-title">Mua sắm cùng Chuyên Gia Máy Mac</h5>
									<p class="card-text">Mua sắm trực tiếp với Chuyên Gia trực tuyến.</p>
									<p class="align-self-end"> <!--To add the button below the text-->
										<a href="#" class="btn btn-dark rounded-circle image-button carousel-button"
											aria-label="More Info"><i class="fas fa-plus"></i></a>
									</p>
								</div>
							</div>
							<div class="card appstore border-0 rounded-4" style="height: 200px; width: 200px;">
								<div class="card-body h-100 d-flex flex-column card-body-icon"
									style="border: 1px solid; border-radius: 20px;">
									<i class="fa fa-apple fa-2x" aria-hidden="true"></i>
									<h5 class="card-title">Apple Store App</h5>
									<p class="card-text">Khám phá trải nghiệm mua sắm được thiết kế dành cho bạn.</p>
									<p class="align-self-end"> <!--To add the button below the text-->
										<a href="#" class="btn btn-dark rounded-circle image-button carousel-button"
											aria-label="More Info"><i class="fas fa-plus"></i></a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

	<footer class="bg-light text-muted py-3 mt-4">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<h6 class="footer-list-title">Mua Sắm Và Tìm Hiểu</h6>
					<ul class="list-unstyled footer-list">
						<li><a href="#">Cửa Hàng</a></li>
						<li><a href="#">Mac</a></li>
						<li><a href="#">iPad</a></li>
						<li><a href="#">iPhone</a></li>
						<li><a href="#">Watch</a></li>
						<li><a href="#">AirPods</a></li>
						<li><a href="#">TV & Nhà</a></li>
						<li><a href="#">AirTag</a></li>
						<li><a href="#">Phụ Kiện</a></li>
					</ul>
					<h6 class="footer-list-title">Ví Apple</h6>
					<ul class="list-unstyled footer-list">
						<li><a href="#">Ví</a></li>
						<li><a href="#">Apple Pay</a></li>
					</ul>
				</div>
				<div class="col-md-2">
					<h6 class="footer-list-title">Tài Khoản</h6>
					<ul class="list-unstyled footer-list">
						<li><a href="#">Quản Lý Tài Khoản Apple</a></li>
						<li><a href="#">Tài Khoản Apple Store</a></li>
						<li><a href="#">iCloud.com</a></li>
					</ul>
					<h6 class="footer-list-title">Giải Trí</h6>
					<ul class="list-unstyled footer-list">
						<li><a href="#">Apple One</a></li>
						<li><a href="#">Apple TV+</a></li>
						<li><a href="#">Apple Music</a></li>
						<li><a href="#">Apple Arcade</a></li>
						<li><a href="#">Apple Podcasts</a></li>
						<li><a href="#">Apple Books</a></li>
					</ul>
				</div>
				<div class="col-md-2">
					<h6 class="footer-list-title">Apple Store</h6>
					<ul class="list-unstyled footer-list">
						<li><a href="#">Ứng Dụng Apple Store</a></li>
						<li><a href="#">Apple Trade In</a></li>
						<li><a href="#">Tài Chính</a></li>
						<li><a href="#">Tình Trạng Đơn Hàng</a></li>
						<li><a href="#">Hỗ Trợ Mua Hàng</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<h6 class="footer-list-title">Dành Cho Doanh Nghiệp</h6>
					<ul class="list-unstyled footer-list">
						<li><a href="#">Apple Và Doanh Nghiệp</a></li>
						<li><a href="#">Mua Hàng Cho Doanh Nghiệp</a></li>
					</ul>
					<h6 class="footer-list-title">Cho Giáo Dục</h6>
					<ul class="list-unstyled footer-list">
						<li><a href="#">Apple Và Giáo Dục</a></li>
						<li><a href="#">Mua Hàng Cho Bậc Đại Học</a></li>
					</ul>
					<h6 class="footer-list-title">Cho Chăm Sóc Sức Khỏe</h6>
					<ul class="list-unstyled footer-list">
						<li><a href="#">Apple Trong Chăm Sóc Sức Khỏe</a></li>
						<li><a href="#">Mac Trong Chăm Sóc Sức Khỏe</a></li>
						<li><a href="#">Sức Khỏe Trên Apple Watch</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<h6 class="footer-list-title">Giá Trị Cốt Lõi Của Apple</h6>
					<ul class="list-unstyled footer-list">
						<li><a href="#">Trợ Năng</a></li>
						<li><a href="#">Môi Trường</a></li>
						<li><a href="#">Quyền Riêng Tư</a></li>
						<li><a href="#">Chuỗi Cung Ứng</a></li>
					</ul>
					<h6 class="footer-list-title">Về Apple</h6>
					<ul class="list-unstyled footer-list">
						<li><a href="#">Newsroom</a></li>
						<li><a href="#">Lãnh Đạo Của Apple</a></li>
						<li><a href="#">Nhà Đầu Tư</a></li>
						<li><a href="#">Đạo Đức & Quy Tắc</a></li>
						<li><a href="#">Sự Kiện</a></li>
						<li><a href="#">Liên Hệ Apple</a></li>
					</ul>
				</div>
			</div>
			<hr />
			<div class="row footer-bottom">
				<div class="col-md-6">
					<p class="footer-legal">Xem thêm cách để mua hàng: <a href="#">Tìm cửa hàng bán lẻ</a> gần bạn. Hoặc
						gọi 1800 1192.</p>
					<p class="footer-legal">© 2025 Apple Inc. Bảo lưu mọi quyền.</p>
				</div>
				<div class="col-md-6 text-md-end">
					<ul class="list-unstyled footer-legal">
						<li><a href="#">Chính Sách Quyền Riêng Tư</a></li>
						<li><a href="#">Điều Khoản Sử Dụng</a></li>
						<li><a href="#">Bán Hàng Và Hoàn Tiền</a></li>
						<li><a href="#">Pháp Lý</a></li>
						<li><a href="#">Bản Đồ Trang Web</a></li>
					</ul>
				</div>
				<div class="col-md-12 text-md-end">
					<p>Viet Nam</p>
				</div>
			</div>
		</div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
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