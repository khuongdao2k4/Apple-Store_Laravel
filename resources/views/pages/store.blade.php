@extends('layouts.app', ['pageTitle' => 'store.php'])

@section('title', 'iPhone - Apple (VN)')

@section('content')




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
                <li><a href="mua-iphone"><img
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



@endsection

