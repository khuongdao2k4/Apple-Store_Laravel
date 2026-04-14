<?php  ?>

<?php
$pageTitle = "home.php";
require_once '../app/views/layouts/header.php';
require_once '../app/views/layouts/navbar.php';
?>

<main class="main" role="main">
        <!-- Top Module (Video Header) -->
        <div id="top-module-container" class="container-fluid position-relative overflow-hidden">
            <video src="<?= BASE_URL ?>public/assets/img/large.mp4" width="100%" autoplay loop muted class="video-large object-fit-cover"
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
                    <img src="<?= BASE_URL ?>public/assets/img/hero_iphone_16e_endframe__enpjcl8w7fyq_largetall.png" alt="iPhone 16e"
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
                            <img src="<?= BASE_URL ?>public/assets/img/hero_iphone16pro_avail__fnf0f9x70jiy_largetall.jpg"
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
                            <img src="<?= BASE_URL ?>public/assets/img/hero_iphone16_avail__euwzls69btea_largetall.jpg" class="img-fluid"
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
                            <img src="<?= BASE_URL ?>public/assets/img/promo_apple_watch_series_10_avail_lte__c70y29goir42_large.jpg"
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
                            <img src="<?= BASE_URL ?>public/assets/img/promo_ipadpro_avail__s271j89g8kii_large.jpg" class="img-fluid"
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
                            <img src="<?= BASE_URL ?>public/assets/img/promo_macbook_air_m3__e43jegok3wuq_large.jpg" class="img-fluid"
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
                            <img src="<?= BASE_URL ?>public/assets/img/promo_macbookpro_announce__gdf98j6tj2ie_large.jpg" class="img-fluid"
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
                            <img src="<?= BASE_URL ?>public/assets/img/promo_airpods_4_avail__bl22kvpg6ez6_large.jpg" class="img-fluid"
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
                            <img src="<?= BASE_URL ?>public/assets/img/promo_ipadair_ai__3fv1eitzqv6y_large.jpg" class="img-fluid"
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
                                    <img src="<?= BASE_URL ?>public/assets/img/980x551 (1).jpg" class="d-block w-100 img-fluid"
                                        alt="Severance">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= BASE_URL ?>public/assets/img/980x551 (2).jpg" class="d-block w-100 img-fluid"
                                        alt="Prime Target">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= BASE_URL ?>public/assets/img/980x551 (3).jpg" class="d-block w-100 img-fluid"
                                        alt="Drama Series">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= BASE_URL ?>public/assets/img/980x551.jpg" class="d-block w-100 img-fluid"
                                        alt="Latest Apple TV+ Show">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= BASE_URL ?>public/assets/img/980x551 (4).jpg" class="d-block w-100 img-fluid"
                                        alt="Action Series">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= BASE_URL ?>public/assets/img/980x551 (5).jpg" class="d-block w-100 img-fluid"
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

<?php
require_once '../app/views/layouts/footer.php';
?>
