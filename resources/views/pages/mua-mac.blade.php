@extends('layouts.app', ['pageTitle' => 'mua-mac.php'])

@section('title', 'Mua Mac - Apple (VN)')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/apple_buy-mac-landing.css') }}?v={{ time() }}">

<div class="shop-mac-landing">
    <!-- Header Section -->
    <header class="shop-header container pt-5 pb-4">
        <div class="d-flex justify-content-between align-items-baseline">
            <h1 class="display-3 fw-bold" style="letter-spacing: -0.02em;">Mua Mac</h1>
            <a href="#" class="text-decoration-none text-primary small fw-medium">Kết Nối Với Chuyên Gia <i class="bi bi-chevron-right" style="font-size: 10px;"></i></a>
        </div>
    </header>

    <!-- Sub-navigation -->
    <nav class="shop-subnav border-bottom sticky-top">
        <div class="container">
            <ul class="nav gap-4 flex-nowrap" id="shop-nav-list">
                <li class="nav-item"><a href="#all-models" class="nav-link active">Tất cả các phiên bản</a></li>
                <li class="nav-item"><a href="#buying-guide" class="nav-link">Hướng Dẫn Mua Sắm</a></li>
                <li class="nav-item"><a href="#ways-to-save" class="nav-link">Nhiều cách để tiết kiệm</a></li>
                <li class="nav-item"><a href="#apple-store-diff" class="nav-link">Apple Store Tạo Nên Mọi Khác Biệt</a></li>
                <li class="nav-item"><a href="#accessories" class="nav-link">Phụ kiện</a></li>
                <li class="nav-item"><a href="#setup-support" class="nav-link">Thiết lập và hỗ trợ</a></li>
                <li class="nav-item"><a href="#mac-experience" class="nav-link">Trải Nghiệm Mac</a></li>
            </ul>
        </div>
    </nav>

    <!-- Section: Mọi phiên bản -->
    <section id="all-models" class="section-padding bg-light" style="overflow: visible;">
        <div class="container">
            <h2 class="section-headline mb-5">Mọi phiên bản. <span class="section-subheadline">Hãy chọn mẫu bạn thích.</span></h2>
        </div>
        
        <div class="model-scroll-container">
                @foreach($products as $p)
                <div class="product-card d-flex flex-column justify-content-between">
                    <div>
                        @if($p->sort_order <= 3)
                            <span class="card-eyebrow text-danger">MỚI</span>
                        @endif
                        <h3 class="apple-card-title">{{ $p->name }}</h3>
                    </div>
                    <div class="text-center py-4 product-image-container" onclick="openMacModal('{{ $p->series }}', '{{ $p->image_url }}', '{{ $p->name }}', 'Từ {{ number_format($p->numeric_price, 0, ',', '.') }}đ', '{{ $p->id }}', '{{ $p->colors }}')">
                        <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="img-fluid" style="max-height: 200px;">
                        <button class="explore-btn">Hãy khám phá thiết bị</button>
                    </div>
                    
                    <!-- Color Swatches -->
                    <div class="color-swatches">
                        @if(!empty($p->colors))
                            @foreach(explode(',', $p->colors) as $color)
                                @php
                                    $colorMap = [
                                        'Silver' => '#e3e4e5',
                                        'Space Gray' => '#3b3b3e',
                                        'Starlight' => '#f0e4d3',
                                        'Midnight' => '#2e3641',
                                        'Space Black' => '#2c2c2e',
                                        'Gold' => '#f9dcc4',
                                        'Pink' => '#e8d2ce',
                                        'Blue' => '#c1d8e0',
                                    ];
                                    $bgColor = $colorMap[trim($color)] ?? trim($color);
                                @endphp
                                <span class="swatch-dot" style="background-color: {{ $bgColor }};" title="{{ trim($color) }}"></span>
                            @endforeach
                        @else
                            <!-- Default dots if database is empty -->
                            <span class="swatch-dot" style="background-color: #e3e4e5;"></span>
                            <span class="swatch-dot" style="background-color: #3b3b3e;"></span>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <p class="mb-0 fw-medium" style="flex: 1; margin-right: 15px;">Từ {{ number_format($p->numeric_price, 0, ',', '.') }}đ</p>
                        <a href="{{ route('order', ['series' => $p->series]) }}" class="btn btn-primary rounded-pill px-4 fw-medium flex-shrink-0">Mua</a>
                    </div>
                </div>
                @endforeach
        </div>
    </section>

    <!-- Section: Hướng dẫn mua sắm -->
    <section id="buying-guide" class="section-padding horizontal-scroll-section">
        <div class="container">
            <h2 class="section-headline mb-5">Hướng dẫn mua sắm. <span class="section-subheadline">Chưa thể quyết? Bắt đầu từ đây nhé.</span></h2>
        </div>
        
        <!-- Navigation Buttons -->
        <button id="prev-btn-bg" class="scroll-nav-btn prev" onclick="scrollSection('buying-guide-scroll', -500)"><i class="bi bi-chevron-left"></i></button>
        <button id="next-btn-bg" class="scroll-nav-btn next show" onclick="scrollSection('buying-guide-scroll', 500)"><i class="bi bi-chevron-right"></i></button>

        <div class="cards-scroll-container" id="buying-guide-scroll">
            <!-- Card 1 -->
            <div class="card-item" style="min-width: 480px;">
                <div class="apple-card bg-light" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-50-compare-models-202603?wid=960&hei=1000&fmt=p-jpg&qlt=95&.v=VVlYUmhtQ01FUnVZSm9ubk84akVKQVhDbGhXa21pNVNBVURtbkZ6K0ZoSHpIR0l0TVpNQnJZb1NNY29pWWhnM1pwRE93ZVBDaGlEa25QZUpFTG9OUTY2TXlIZTdvcW0vUW90dllTQklLcUJ0VktRME9sRTEwdS8xcGRlRVdEOFc');">
                    <div>
                        <span class="card-eyebrow text-muted">SO SÁNH TẤT CẢ CÁC PHIÊN BẢN</span>
                        <h4 class="apple-card-title">Máy Mac nào phù hợp với bạn?</h4>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="card-item" style="min-width: 480px;">
                <div class="apple-card bg-light" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-50-whyswitch-202603?wid=960&hei=1000&fmt=p-jpg&qlt=95&.v=YmR4ajRKeHZrUjhpcnkyZi82dWY5ejZ6dml1bW1ZbGhRWFBxbXk4WEt2OEF3Wk1qdTlJUXpYbmUrMWJwLzZvbTJTaS9RTTYzTWg5VUhTM1Ara0JyS0kwaHZaQXc5K1ZuSmFNUEtRM1VVV0E');">
                    <div>
                        <span class="card-eyebrow text-muted">TẠI SAO NÊN DÙNG MAC</span>
                        <h4 class="apple-card-title">Nếu bạn yêu thích iPhone, bạn sẽ yêu Mac.</h4>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="card-item" style="min-width: 480px;">
                <div class="apple-card" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-50-apple-intelligence-202510?wid=960&hei=1000&fmt=p-jpg&qlt=95&.v=TFU2UzByZjhMakduTVVUMVptdlJxS29iYW9Qd2NDSzB6MDd4Y1RDZWNGdy9ESkVJdWpDdDRmM2xuT3VSQktwQm1td3JHMmlHM0d0VzBMMGs5ZHR4WjJqdEhGTHliaWE4M0pHcXFRWnR5Vkt2VHZPbk05RGxvVWJZbUE1M0o2dU4'); background-color: #f8f9fa; background-size: cover;">
                    <div>
                        <h4 class="apple-card-title"><span style="color: #0071e3">Apple Intelligence.</span><br>Sáng tạo, giao tiếp và hoàn tất công việc dễ dàng</h4>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="card-item" style="min-width: 480px; margin-right: 20px;">
                <div class="apple-card bg-light" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-50-earth-day-specialist-help-202605?wid=4000&hei=4167&fmt=p-jpg&qlt=95&.v=SjVIRmJ0MnM5OUFIWXIrejNMa3BYV3ZUazZxdDJpcjM2SkxEWjNERGpzU3ZFajBONGp2MlVaaUdBeDg1RHVWUC85UDFrREVCUFJWRFNDVDBTQjFJZ3VCc3FjamJwVXJjd2U3WEc3Smc2MXh2WmpXeHg2WlR4VERXR1dyV1QrbFZmbW94YnYxc1YvNXZ4emJGL0IxNFp3'); background-size: cover;">
                    <div>
                        <span class="card-eyebrow text-muted">CHUYÊN GIA MAC</span>
                        <h4 class="apple-card-title">Mua hàng với tư vấn trực tiếp từ Chuyên Gia trực tuyến.</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function scrollSection(id, distance) {
            const container = document.getElementById(id);
            container.scrollBy({ left: distance, behavior: 'smooth' });
        }

        function updateNavButtons(scrollContainerId, prevBtnId, nextBtnId) {
            const container = document.getElementById(scrollContainerId);
            const prevBtn = document.getElementById(prevBtnId);
            const nextBtn = document.getElementById(nextBtnId);

            if (!container || !prevBtn || !nextBtn) return;

            // Kiểm tra vị trí cuộn
            const scrollLeft = container.scrollLeft;
            const maxScrollLeft = container.scrollWidth - container.clientWidth;

            // Hiện/Ẩn nút Prev
            if (scrollLeft > 20) {
                prevBtn.classList.add('show');
            } else {
                prevBtn.classList.remove('show');
            }

            // Hiện/Ẩn nút Next
            if (scrollLeft < maxScrollLeft - 20) {
                nextBtn.classList.add('show');
            } else {
                nextBtn.classList.remove('show');
            }
        }

        // Lắng nghe sự kiện cuộn
        document.getElementById('buying-guide-scroll').addEventListener('scroll', () => {
            updateNavButtons('buying-guide-scroll', 'prev-btn-bg', 'next-btn-bg');
        });
        
        document.getElementById('savings-scroll').addEventListener('scroll', () => {
            updateNavButtons('savings-scroll', 'prev-btn-savings', 'next-btn-savings');
        });

        // Smooth Scrolling for Nav Links
        document.querySelectorAll('.shop-subnav a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    const offset = 52; // Height of subnav
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - offset;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Scrollspy: Cập nhật trạng thái active khi cuộn
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.shop-subnav .nav-link');

        window.addEventListener('scroll', () => {
            let current = "";
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop - 60) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(current)) {
                    link.classList.add('active');
                }
            });
        });

        // Khởi tạo trạng thái nút ban đầu và nav active
        window.addEventListener('load', () => {
            updateNavButtons('buying-guide-scroll', 'prev-btn-bg', 'next-btn-bg');
            updateNavButtons('savings-scroll', 'prev-btn-savings', 'next-btn-savings');
        });
    </script>

    <!-- Section: Nhiều cách để tiết kiệm -->
    <section id="ways-to-save" class="section-padding horizontal-scroll-section">
        <div class="container">
            <h2 class="section-headline mb-5">Nhiều cách để tiết kiệm. <span class="section-subheadline">Tìm cách phù hợp với bạn.</span></h2>
        </div>

        <!-- Navigation Buttons -->
        <button id="prev-btn-savings" class="scroll-nav-btn prev" onclick="scrollSection('savings-scroll', -500)"><i class="bi bi-chevron-left"></i></button>
        <button id="next-btn-savings" class="scroll-nav-btn next show" onclick="scrollSection('savings-scroll', 500)"><i class="bi bi-chevron-right"></i></button>

        <div class="cards-scroll-container" id="savings-scroll">
            <!-- Card 1: Apple Trade In -->
            <div class="card-item" style="min-width: 480px;">
                <div class="apple-card" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-50-tradein-202603?wid=960&hei=1000&fmt=p-jpg&qlt=95&.v=bnBGZmQyZENCQjV2MDY0V0laRVBER1hHTmYyb3piY1Y0THVqMzBBNDVoTkx0QXRvdnJ4V1dBNW1Qd2w2K1l1dlMwV0hhcmdVdXZzZ1NwTlFUaEgwTHdMY3RGMHNGL3RGQTdEcFpMejZDZFE');">
                    <div>
                        <span class="card-eyebrow text-muted">APPLE TRADE IN</span>
                        <h4 class="apple-card-title">Tiết kiệm khi mua Mac mới bằng cách trao đổi thiết bị hợp lệ.<sup>Δ</sup></h4>
                    </div>
                </div>
            </div>
            <!-- Card 2: Installments -->
            <div class="card-item" style="min-width: 480px;">
                <div class="apple-card" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/ipad-card-50-monthly-installments-202503?wid=960&hei=1000&fmt=p-jpg&qlt=95&.v=dmNtNCtodDJvQTBIQ0d3WHg4bUVxMzhEc29tTzFZcVJzWmpnd0dqTS82cUVoeEc1MlQxYXlqK0lIMGZORU9HYlVrc1JZVkQ0S2s0elFpK2Y1K2lCS1NsOG1PN3FBRzN3cEphZ2ZrZllTNFlZQnNPWGg5Mk1Ub2dhYnlGMGVVNng');">
                    <div>
                        <span class="card-eyebrow text-muted">TÀI CHÍNH</span>
                        <h4 class="apple-card-title">Thanh toán hàng tháng thật dễ dàng. Bao gồm lựa chọn lãi suất 0%.<sup>§</sup></h4>
                    </div>
                </div>
            </div>
            <!-- Card 3: Education -->
            <div class="card-item" style="min-width: 480px; margin-right: 20px;">
                <div class="apple-card" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-50-education-202504?wid=960&hei=1000&fmt=p-jpg&qlt=95&.v=emVzQ3llK0t4OHJwS2lhMGVteFJuMDFVOTgvQlNKWWhkOHROMU1vSnZIWUF3Wk1qdTlJUXpYbmUrMWJwLzZvbTJTaS9RTTYzTWg5VUhTM1Ara0JyS0RQQ0hNZlF5ZTRab1NRVFFlY0M3aDQ');">
                    <div>
                        <span class="card-eyebrow text-muted">CHÍNH SÁCH TRỢ GIÁ CHO GIÁO DỤC</span>
                        <h4 class="apple-card-title" style="max-width: 400px;">Tiết kiệm với chính sách trợ giá cho giáo dục khi mua sắm tại Cửa Hàng Dành Cho Ngành Giáo Dục.<sup>2</sup></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Apple Store tạo nên mọi khác biệt -->
    <section id="apple-store-diff" class="section-padding">
        <div class="container text-start">
            <h2 class="section-headline mb-5">Apple Store tạo nên mọi khác biệt. <span class="section-subheadline">Thêm nhiều lý do để mua sắm cùng chúng tôi.</span></h2>
            
            <div class="banner-card bg-white shadow-sm" style="max-width: 980px;">
                <div class="banner-content pt-5 ps-5 text-start">
                    <h3 class="apple-banner-title mb-2">Tùy chỉnh máy Mac của bạn.</h3>
                    <p class="apple-banner-text">Chọn chip, bộ nhớ, dung lượng lưu trữ và cả màu sắc.</p>
                </div>
                <div class="banner-image-wrapper">
                    <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-100-customize-202603?wid=1960&hei=740&fmt=png-alpha&.v=WGVJR1JzeVlHQndDQ0hPeUcxZEhIVVNmTzIwVEdWL0ZUQlpNR2hpaFowcHJSYTIyTmVtUXQ0Q1I1cVhOOGlKMDAzOVFHb3N0MkVmS01ZcFh0d1Y4R2hlODcrV3lMcmtBTFFKYWh5cWxTS28" class="banner-image-bottom" alt="Custom Mac">
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Thiết Lập Và Hỗ Trợ -->
    <section id="setup-support" class="section-padding bg-light">
        <div class="container text-start">
            <h2 class="section-headline mb-5">Thiết Lập Và Hỗ Trợ. <span class="section-subheadline">Các Chuyên Gia của chúng tôi sẵn sàng giúp đỡ.</span></h2>
            
            <div class="row g-4 ms-0" style="max-width: 980px;">
                <div class="col-md-6">
                    <div class="apple-card support-card">
                        <div class="card-content mb-auto">
                            <span class="card-eyebrow text-muted">TRUYỀN DỮ LIỆU DỄ DÀNG</span>
                            <h4 class="apple-card-title mt-2">Máy Mac mới? Hãy xem việc di chuyển nội dung của bạn qua máy mới dễ dàng như thế nào.</h4>
                        </div>
                        <div class="support-card-image-bg" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-50-transfer-202510?wid=960&hei=1000&fmt=p-jpg');"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="apple-card support-card">
                        <div class="card-content mb-auto">
                            <span class="card-eyebrow text-muted">APPLECARE+</span>
                            <h4 class="apple-card-title mt-2">Được hưởng bảo hành lên đến 3 năm cho trường hợp hư hỏng do sự cố bất ngờ.</h4>
                        </div>
                        <div class="support-card-image-bg" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-50-applecare-202108?wid=960&hei=1000&fmt=p-jpg');"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Một trải nghiệm rất Mac -->
    <section id="experience-mac" class="section-padding overflow-hidden">
        <div class="container text-start">
            <h2 class="section-headline mb-4">Một trải nghiệm rất Mac. <span class="section-subheadline">Được thiết kế để kết nối với mọi thứ của Apple.</span></h2>
        </div>
        
        <div class="horizontal-scroll-section">
            <div class="cards-scroll-container" id="experience-mac-scroll">
                <!-- Card 1: Apple Music -->
                <div class="apple-card experience-card" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/store-card-50-apple-music-202412?wid=800&hei=1000&fmt=p-jpg');">
                    <div class="card-content">
                        <h4 class="apple-card-title">Tặng 3 tháng sử dụng Apple Music miễn phí.</h4>
                        <p class="card-description mt-2">Đi kèm khi mua một số thiết bị Apple.<sup>*</sup></p>
                    </div>
                </div>

                <!-- Card 2: macOS -->
                <div class="apple-card experience-card" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-50-macos-202603?wid=960&hei=1000&fmt=p-jpg');">
                    <div class="card-content">
                        <span class="card-eyebrow text-muted">macos</span>
                        <h4 class="apple-card-title mt-1">Khám phá xem macOS Tahoe có gì mới.</h4>
                    </div>
                </div>

                <!-- Card 3: Continuity -->
                <div class="apple-card experience-card" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-50-continuity-202510_GEO_VN?wid=960&hei=1000&fmt=p-jpg');">
                    <div class="card-content">
                        <span class="card-eyebrow text-muted">THÔNG SUỐT</span>
                        <h4 class="apple-card-title mt-1">Mạnh mẽ khi riêng lẻ. Mạnh gấp bội khi lập đội.</h4>
                    </div>
                </div>

                <!-- Card 4: Creator Studio (Dark Theme) -->
                <div class="apple-card experience-card dark-card" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/store-card-50-apple-creator-studio-202601?wid=960&hei=1000&fmt=p-jpg');">
                    <div class="card-content text-white">
                        <span class="card-eyebrow text-white-50">APPLE CREATOR STUDIO</span>
                        <h4 class="apple-card-title mt-1">Tặng 3 tháng sử dụng miễn phí khi mua Mac.<sup>‡</sup></h4>
                        <p class="card-description mt-2 text-white-50">Apple Creator Studio bao gồm các ứng dụng nâng cao năng suất như Final Cut Pro, Logic Pro, Pixelmator Pro và nhiều tiện ích khác.</p>
                    </div>
                </div>

                <!-- Card 5: iCloud+ -->
                <div class="apple-card experience-card" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-50-icloud-202504?wid=960&hei=1000&fmt=p-jpg');">
                    <div class="card-content">
                        <span class="card-eyebrow text-muted">ICLOUD+</span>
                        <h4 class="apple-card-title mt-1">Nhận dung lượng lưu trữ bạn cần, cùng quyền riêng tư bạn xứng đáng có. Nâng cấp gói iCloud+ ngay.<sup>#</sup></h4>
                    </div>
                </div>

                <!-- Card 6: Split Card (College & Work) -->
                <div class="split-experience-card">
                    <!-- Sub-card Top: College -->
                    <div class="apple-card sub-experience-card dark-card" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-25-college-202108?wid=960&hei=480&fmt=p-jpg');">
                        <div class="card-content text-white">
                            <span class="card-eyebrow text-white-50">APPLE TẠI ĐẠI HỌC</span>
                            <h4 class="apple-card-title mt-1" style="max-width: 250px;">Đạt điểm cao nhất, bất kể môn nào với Apple.</h4>
                        </div>
                    </div>
                    <!-- Sub-card Bottom: Work -->
                    <div class="apple-card sub-experience-card dark-card" style="background-image: url('https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/mac-card-25-work-202108?wid=960&hei=480&fmt=p-jpg');">
                        <div class="card-content text-white">
                            <span class="card-eyebrow text-white-50">APPLE TẠI NƠI LÀM VIỆC</span>
                            <h4 class="apple-card-title mt-1" style="max-width: 280px;">Thêm sức mạnh cho công việc của bạn với phần cứng, phần mềm và dịch vụ từ Apple.</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button id="prev-btn-exp" class="scroll-nav-btn prev" onclick="scrollSection('experience-mac-scroll', -500)"><i class="bi bi-chevron-left"></i></button>
            <button id="next-btn-exp" class="scroll-nav-btn next show" onclick="scrollSection('experience-mac-scroll', 500)"><i class="bi bi-chevron-right"></i></button>
        </div>
    </section>
    <!-- Mac Comparison Modal -->
    <div class="modal fade apple-modal" id="macCompareModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Tabs (Floating outside with Scroll Arrows & Fade) -->
                <div class="d-flex justify-content-center align-items-center position-relative w-100">
                    <div class="tabs-capsule-wrapper" id="tabsWrapper">
                        <button class="scroll-arrow left" id="scrollLeftBtn" onclick="scrollTabs('left')">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        
                        <div class="modal-header-tabs" id="macModalTabs" onscroll="updateScrollButtons()">
                            <!-- Tabs injected by JS -->
                        </div>
                        
                        <button class="scroll-arrow right" id="scrollRightBtn" onclick="scrollTabs('right')">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                    
                    <!-- Close Button (Floating right of tabs) -->
                    <button type="button" class="btn-close-apple" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                
                <!-- Main White Body -->
                <div class="modal-main-body">
                    <div class="modal-body p-0">
                        <div class="row g-0">
                            <!-- Left: Image -->
                            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center p-5">
                                <div id="modalProductImageContainer" class="text-center mb-4">
                                    <img id="modalProductImage" src="" class="img-fluid" style="max-height: 380px; transition: all 0.5s ease;">
                                </div>
                                <div class="text-muted small mb-2" id="modalColorCount">Có 4 màu</div>
                                <div class="color-swatches" id="modalColorSwatches"></div>
                            </div>
                            
                            <!-- Right: Specs -->
                            <div class="col-md-6 p-5">
                                <div class="mb-4">
                                    <span class="badge bg-light text-danger rounded-pill px-3 py-2 mb-2" id="modalBadge">MỚI</span>
                                    <h2 class="display-6 fw-bold" id="modalProductName" style="font-size: 32px; letter-spacing: -0.01em;"></h2>
                                    <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
                                        <p class="text-muted mb-0" id="modalProductPrice" style="font-size: 14px; flex: 1; margin-right: 15px;"></p>
                                        <a href="#" id="modalBuyBtn" class="btn btn-primary rounded-pill px-4 py-2 fw-medium flex-shrink-0">Mua</a>
                                    </div>
                                </div>

                                <div id="modalSpecsContainer"></div>

                                <div class="mt-4 text-center">
                                    <a href="#" class="text-primary text-decoration-none fw-medium small" id="modalLearnMore">Khám phá thêm về <span id="modalLearnMoreName"></span> <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer: Finance & Delivery -->
                        <div class="modal-footer-info">
                            <div class="footer-info-item">
                                <i class="bi bi-wallet2"></i>
                                <div>
                                    <h6>Tài Chính</h6>
                                    <p>Các cách trả góp tuyệt vời, bao gồm lựa chọn lãi suất 0%.<sup>**</sup></p>
                                </div>
                            </div>
                            <div class="footer-info-item">
                                <i class="bi bi-truck"></i>
                                <div>
                                    <h6>Giao hàng miễn phí ngày làm việc tiếp theo</h6>
                                    <p>Chỉ khả dụng tại Thành Phố Hồ Chí Minh đối với một số sản phẩm Apple có sẵn nhất định được đặt hàng trước 15:00.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Lấy toàn bộ danh sách sản phẩm từ CSDL để dùng trong Modal
        const allProducts = @json($products);

        const macData = {
            'macbook-air': {
                badge: 'MỚI',
                specs: [
                    { icon: 'bi-laptop', text: 'Điều tuyệt diệu của Mac ở mức giá bất ngờ. Bốn màu tuyệt đẹp và một thiết kế nhôm bền chắc.' },
                    { icon: 'bi-cpu', text: 'Chạy xuyên các tác vụ hàng ngày và các ứng dụng nhanh như bay với chip M3 Pro' },
                    { icon: 'bi-battery-full', text: 'Pin dùng cả ngày, thời lượng lên đến 18 giờ, theo bạn từ sáng đến đêm <sup>3</sup>' },
                    { icon: 'bi-aspect-ratio', text: 'Màn hình Liquid Retina 13 inch tuyệt đẹp, hỗ trợ 1 tỷ màu sắc <sup>4</sup>' },
                    { icon: 'bi-camera-video', text: 'Camera FaceTime HD 1080p mang đến video sắc nét, sống động để bạn luôn trông đỉnh nhất' },
                    { icon: 'bi-stars', text: 'Được thiết kế cho AI, bao gồm các tính năng Apple Intelligence mạnh mẽ <sup>¶</sup>' }
                ]
            },
            'macbook-pro': {
                badge: 'MỚI',
                specs: [
                    { icon: 'bi-cpu', text: 'Sức mạnh vượt trội cho các quy trình làm việc chuyên nghiệp nhất với chip M3 Pro hoặc M3 Max.' },
                    { icon: 'bi-battery-full', text: 'Thời lượng pin lên đến 22 giờ — lâu nhất từng có trên máy Mac. <sup>3</sup>' },
                    { icon: 'bi-aspect-ratio', text: 'Màn hình Liquid Retina XDR tốt nhất thế giới trên máy tính xách tay. <sup>4</sup>' },
                    { icon: 'bi-camera-video', text: 'Hệ thống âm thanh sáu loa và mảng ba micrô chất lượng studio cho trải nghiệm âm thanh sống động.' },
                    { icon: 'bi-stars', text: 'Tối ưu hóa cho AI với kiến trúc Apple Intelligence tiên tiến. <sup>¶</sup>' }
                ]
            }
        };

        function openMacModal(series, dbImage, dbName, dbPrice, productId, dbColors) {
            const modal = new bootstrap.Modal(document.getElementById('macCompareModal'));
            updateModalContent(series, dbImage, dbName, dbPrice, productId, dbColors);
            renderTabs(productId);
            modal.show();
        }

        function renderTabs(activeProductId) {
            const tabsContainer = document.getElementById('macModalTabs');
            tabsContainer.innerHTML = '';
            
            allProducts.forEach(product => {
                const tab = document.createElement('div');
                // So sánh ID để set active
                const isActive = (product.id == activeProductId);
                tab.className = `modal-tab-item ${isActive ? 'active' : ''}`;
                tab.innerText = product.name;
                tab.onclick = () => {
                    const priceFormatted = 'Từ ' + new Intl.NumberFormat('vi-VN').format(product.numeric_price) + 'đ';
                    updateModalContent(product.series, product.image_url, product.name, priceFormatted, product.id, product.colors);
                    renderTabs(product.id);
                };
                tabsContainer.appendChild(tab);
            });
        }

        function updateModalContent(series, dbImage, dbName, dbPrice, productId, dbColors) {
            const data = macData[series] || macData['macbook-air'];
            
            // Cập nhật thông tin cơ bản
            document.getElementById('modalProductImage').src = dbImage || '';
            document.getElementById('modalProductName').innerText = dbName || '';
            document.getElementById('modalProductPrice').innerText = dbPrice || '';
            document.getElementById('modalBadge').innerText = data.badge;
            document.getElementById('modalLearnMoreName').innerText = dbName || '';
            
            // Cập nhật link nút Mua
            const buyBtn = document.getElementById('modalBuyBtn');
            if (series) {
                buyBtn.href = `/order?series=${series}`;
            }

            // Xử lý màu sắc
            const colorsArray = dbColors ? dbColors.split(',') : [];
            document.getElementById('modalColorCount').innerText = `Có ${colorsArray.length} màu`;
            
            const colorContainer = document.getElementById('modalColorSwatches');
            colorContainer.innerHTML = colorsArray.map(colorName => {
                // Map tên màu sang mã hex (tận dụng logic swatch-dot của bạn)
                const colorMap = {
                    'Silver': '#e3e4e5', 'Starlight': '#f0e4d3', 'Space Gray': '#3b3b3e', 'Midnight': '#2e3641',
                    'Bạc': '#e3e4e5', 'Ánh Sao': '#f0e4d3', 'Xám Không Gian': '#3b3b3e', 'Xanh Đen': '#2e3641',
                    'Gold': '#f9dcc4', 'Vàng': '#f9dcc4', 'Rose Gold': '#e8d2ce'
                };
                const hex = colorMap[colorName.trim()] || '#ccc';
                return `<span class="swatch-dot" style="background-color: ${hex}; width: 12px; height: 12px;"></span>`;
            }).join('');
            
            // Cập nhật thông số kỹ thuật (Specs)
            const specsContainer = document.getElementById('modalSpecsContainer');
            specsContainer.innerHTML = data.specs.map(spec => `
                <div class="spec-item" style="border-bottom: 1px solid #f5f5f7; margin-bottom: 20px; padding-bottom: 15px;">
                    <i class="bi ${spec.icon} fs-4 text-dark mt-1"></i>
                    <div>
                        <p class="mb-0" style="font-size: 14px; line-height: 1.5; color: #1d1d1f; font-weight: 500;">${spec.text}</p>
                    </div>
                </div>
            `).join('');

            // Cập nhật mũi tên cuộn sau khi render xong
            setTimeout(updateScrollButtons, 100);
        }

        function scrollTabs(direction) {
            const container = document.getElementById('macModalTabs');
            const scrollAmount = 250;
            if (direction === 'left') {
                container.scrollLeft -= scrollAmount;
            } else {
                container.scrollLeft += scrollAmount;
            }
        }

        function updateScrollButtons() {
            const container = document.getElementById('macModalTabs');
            const wrapper = document.getElementById('tabsWrapper');
            const leftBtn = document.getElementById('scrollLeftBtn');
            const rightBtn = document.getElementById('scrollRightBtn');
            
            if (!container || !wrapper) return;

            const scrollLeft = container.scrollLeft;
            const maxScroll = container.scrollWidth - container.clientWidth;
            
            // Ngưỡng 5px để tránh rung lắc (jitter)
            if (scrollLeft > 5) {
                leftBtn.classList.add('visible');
                wrapper.classList.add('show-left');
            } else {
                leftBtn.classList.remove('visible');
                wrapper.classList.remove('show-left');
            }
            
            if (scrollLeft < maxScroll - 5) {
                rightBtn.classList.add('visible');
                wrapper.classList.add('show-right');
            } else {
                rightBtn.classList.remove('visible');
                wrapper.classList.remove('show-right');
            }
        }

        // Cập nhật lại khi thay đổi kích thước cửa sổ
        window.addEventListener('resize', updateScrollButtons);
    </script>
</div>
@endsection
