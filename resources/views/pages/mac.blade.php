@extends('layouts.app', ['pageTitle' => 'mac.php'])

@section('content')





<section class="product-categories">
		<div class="categories-container">
			<ul class="categories-list">
				<li><a href="#"><img
							src="https://www.apple.com/assets-www/en_WW/mac/04_chapternav/small/nav_mbn_1fa302e95.png"
							alt="iPhone 16 Pro"><br>MacBook Air</a></li>
				<li><a href="#"><img
							src="https://www.apple.com/assets-www/en_WW/mac/04_chapternav/small/nav_mba_ea12e0d5b.png"
							alt="iPhone 16"><br>MacBook Pro</a></li>
				<li><a href="#"><img
							src="https://www.apple.com/assets-www/en_WW/mac/04_chapternav/small/nav_mbp_bfa749034.png"
							alt="iPhone 16e"><br>iMac<br><span class="new-label">Mới</span></a></li>
				<li><a href="#"><img
							src="https://www.apple.com/assets-www/en_WW/mac/04_chapternav/small/nav_imac_24_832584093.png"
							alt="iPhone 15"><br>Mac mini</a></li>
				<li><a href="#"><img
							src="https://www.apple.com/assets-www/en_WW/mac/04_chapternav/small/nav_mac_mini_bff82a643.png"
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
				<li><a href="mua-iphone"><img
							src="https://www.apple.com/v/mac/home/cc/images/chapternav/mac_accessories_light__esnwbnk4bxqq_large.svg"
							alt="Mua sắm iPhone"><br>Acessories</a></li>
				<li><a href="mua-iphone"><img
							src="https://www.apple.com/v/mac/home/cc/images/chapternav/mac_os_light__6mb5pqhztcie_large.svg"
							alt="Mua sắm iPhone"><br>Sequoia</a></li>
				<li><a href="mua-iphone"><img
							src="	https://www.apple.com/v/mac/home/cc/images/chapternav/mac_shop_light__f0m72gc7jguq_large.svg"
							alt="Mua sắm iPhone"><br>Shop Mac</a></li>
			</ul>
		</div>
		<div class="content-wrapper">
			<p>Now through April 2, get extra trade-in credit toward a new Mac with Apple Trade In. <a href="#">Shop Mac
					></a></p>
		</div>
	</section>

	<main class="container mt-4 mb-4">
		<section class="jumbotron ">
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
					<source src="{{ asset('assets/img/large12.mp4') }}" type="video/mp4" />
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
								<img src="{{ asset('assets/img/mac_compatibility__cu59oukz81ci_large.jpg') }}"
									style="border-radius: 20px" alt="Image 1" />
								<button class="btn btn-dark rounded-circle image-button carousel-button">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div>
							<div class="image-wrapper">
								<img src="{{ asset('assets/img/mac_durability__epiwcuk7zkeq_large') }} (1).jpg"
									style="border-radius: 20px" alt="Image 2" />
								<button class="btn btn-dark rounded-circle image-button carousel-button">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div>
							<div class="image-wrapper">
								<img src="{{ asset('assets/img/mac_intelligence__esfi0qmvis6e_large.jpg') }}"
									style="border-radius: 20px" alt="Image 3" />
								<button class="btn btn-dark rounded-circle image-button carousel-button">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div>
							<div class="image-wrapper">
								<img src="{{ asset('assets/img/mac_iphone__gh1tblkt6bqm_large.jpg') }}" style="border-radius: 20px"
									alt="Image 4" />
								<button class="btn btn-dark rounded-circle image-button carousel-button">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div>
							<div class="image-wrapper">
								<img src="{{ asset('assets/img/mac_performance__dh5hyac1zf8m_large.jpg') }}"
									style="border-radius: 20px" alt="Image 5" />
								<button class="btn btn-dark rounded-circle image-button carousel-button">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div>
							<div class="image-wrapper">
								<img src="{{ asset('assets/img/mac_security__gfwda10khdym_large.jpg') }}"
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
					<img src="{{ asset('assets/img/tradein__gbtxz5sa3cyi_large.jpg') }}" class="img-fluid" alt="Apple Trade In" />
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



@endsection

