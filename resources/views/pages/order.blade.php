@extends('layouts.app', ['pageTitle' => 'order.php'])

@section('content')
<style>
    .option-group-container {
        margin-top: 40px;
    }
    .option-group-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #1d1d1f;
    }
    .option-group-title span {
        font-weight: 400;
        color: #86868b;
    }
    .premium-option-card {
        padding: 20px;
        border: 1.5px solid #d2d2d7;
        border-radius: 12px;
        cursor: pointer;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        transition: all 0.2s ease-in-out;
        background: #fff;
    }
    .premium-option-card:hover {
        border-color: #86868b;
    }
    .premium-option-card.selected {
        border-color: #0071e3;
        border-width: 2px;
        padding: 19.5px; /* Offset for border width */
    }
    .option-content {
        flex: 1;
        padding-right: 15px;
    }
    .option-sub-label {
        font-size: 14px;
        font-weight: 600;
        color: #bf4800;
        margin-bottom: 4px;
    }
    .option-label {
        font-size: 19px;
        font-weight: 600;
        color: #1d1d1f;
        margin-bottom: 8px;
        line-height: 1.2;
    }
    .option-description {
        font-size: 14px;
        color: #1d1d1f;
        line-height: 1.4;
    }
    .option-price-container {
        text-align: right;
        min-width: 140px;
        font-size: 14px;
        color: #1d1d1f;
        line-height: 1.3;
    }
    .option-price-monthly {
        color: #1d1d1f;
    }
    .option-price-note {
        font-size: 12px;
        color: #1d1d1f;
    }

    /* Installment info footer */
    .installment-info-footer {
        font-size: 14px;
        color: #1d1d1f;
        margin-top: 20px;
        line-height: 1.4;
    }
    .help-box {
        background: #f5f5f7;
        border-radius: 15px;
        padding: 24px;
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    .help-box-content h3 {
        font-size: 17px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .help-box-content p {
        font-size: 14px;
        color: #1d1d1f;
        margin: 0;
    }
    .help-box-icon {
        font-size: 20px;
        color: #86868b;
    }

    /* Customization (Tùy biến) styles */
    .custom-summary-card {
        background: #f5f5f7;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
        border: 1px solid #d2d2d7;
        transition: all 0.3s ease;
        user-select: none;
    }
    .custom-summary-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }
    .custom-summary-header i {
        font-size: 24px;
        color: #1d1d1f;
    }
    .custom-summary-title {
        font-size: 19px;
        font-weight: 600;
        color: #1d1d1f;
    }
    .custom-summary-desc {
        font-size: 14px;
        color: #1d1d1f;
        margin-bottom: 16px;
        line-height: 1.4;
    }
    .custom-current-label {
        font-size: 14px;
        color: #1d1d1f;
        margin-bottom: 2px;
    }
    .custom-current-value {
        font-size: 24px;
        font-weight: 600;
        color: #1d1d1f;
        margin-bottom: 16px;
    }
    .custom-summary-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 1px solid #d2d2d7;
    }
    .custom-available-text {
        font-size: 14px;
        color: #1d1d1f;
    }
    .btn-custom-edit {
        background: #fff;
        border: 1.2px solid #1d1d1f;
        border-radius: 999px;
        padding: 8px 24px;
        font-size: 17px;
        font-weight: 400;
        color: #1d1d1f;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.2s;
        line-height: 1;
    }
    .btn-custom-edit:focus {
        outline: none;
        box-shadow: 0 0 0 2px #fff, 0 0 0 4px #0071e3;
    }
    .btn-custom-edit:hover {
        background: #f5f5f7;
    }

    .custom-options-dropdown {
        display: none;
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid #d2d2d7;
    }
    .custom-options-dropdown.show {
        display: block;
    }
    .custom-dropdown-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .custom-dropdown-title {
        font-size: 21px;
        font-weight: 600;
        color: #1d1d1f;
    }
    .btn-close-dropdown {
        background: #fff;
        border: 1px solid #1d1d1f;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #1d1d1f;
        font-size: 18px;
    }
    .btn-close-dropdown:focus {
        outline: none;
        box-shadow: 0 0 0 2px #fff, 0 0 0 4px #0071e3;
    }

    .nested-option-card {
        padding: 24px;
        border: 1.5px solid #d2d2d7;
        border-radius: 12px;
        cursor: pointer;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
        transition: all 0.2s;
    }
    .nested-option-card.selected {
        border-color: #0071e3;
        border-width: 2px;
        padding: 23.5px;
    }
    .nested-option-label {
        font-size: 17px;
        font-weight: 600;
        color: #1d1d1f;
    }
    .nested-option-price {
        font-size: 14px;
        color: #1d1d1f;
    }

    /* Selection Sequence Styles */
    .option-section {
        transition: all 0.3s ease;
        position: relative;
    }
    .option-section.disabled {
        opacity: 0.5; /* Increased opacity so they are visible */
        pointer-events: none;
        filter: grayscale(0.8);
    }
    .option-section.disabled::after {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 10;
    }

    /* Summary List Styles */
    .summary-config-list {
        list-style: none;
        padding: 0;
        margin: 0 0 24px 0;
    }
    .summary-config-item {
        font-size: 15px;
        color: #1d1d1f;
        margin-bottom: 8px;
        display: flex;
        align-items: flex-start;
        line-height: 1.4;
    }
    .summary-config-item::before {
        content: "•";
        margin-right: 10px;
        color: #86868b;
    }
    .summary-config-category {
        font-weight: 600;
        margin-right: 5px;
    }
    .rf-bfe-main {
        display: flex;
        align-items: flex-start;
        margin: 0 80px 80px 80px; /* Increased side margins to 80px */
        padding: 0;
        user-select: none; /* Globally prevent text cursor on selection area */
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    .rf-bfe-column-left {
        flex: 0 0 70%;
        position: sticky !important;
        top: 120px;
        align-self: flex-start;
        padding-right: 80px;
    }
    .rf-bfe-column-right {
        flex: 0 0 30%;
        padding-bottom: 100px;
    }
    .model-card {
        border: 2px solid #d2d2d7;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
        user-select: none; /* Prevent text selection cursor */
    }
    .model-card:hover {
        border-color: #86868b;
    }
    .model-card.selected {
        border-color: #0071e3;
        border-width: 2px;
        padding: 23px;
    }
    .model-info-left {
        flex: 1;
        text-align: left;
    }
    .model-label {
        font-size: 19px;
        font-weight: 600;
        color: #1d1d1f;
        margin-bottom: 8px;
    }
    .model-sub-label {
        font-size: 14px;
        color: #1d1d1f;
        line-height: 1.4;
    }
    .model-info-right {
        text-align: right;
        font-size: 14px;
        color: #1d1d1f;
        line-height: 1.3;
        min-width: 150px;
    }
    .model-card, .model-card *,
    .premium-option-card, .premium-option-card *,
    .nested-option-card, .nested-option-card *,
    .custom-summary-card, .custom-summary-card *,
    .color-circle {
        cursor: pointer !important;
    }
</style>

{{-- Sticky Header Bar --}}
<div id="sticky-header" class="sticky-header-bar" style="display: none;">
    <div class="sticky-header-content" style="flex-direction: column; align-items: stretch; padding: 0;">
        <div class="sticky-row-top" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 80px 6px;">
            <div class="sticky-header-left">
                <span id="sticky-product-name" style="font-size: 21px; font-weight: 700; color: #1d1d1f; letter-spacing: -0.01em;">{{ $seriesTitle ?? 'Sản phẩm' }}</span>
            </div>
            <div class="sticky-header-right" style="font-size: 15px; color: #1d1d1f; font-weight: 400; letter-spacing: -0.01em; display: flex; align-items: center; gap: 4px;">
                <span>Tổng cộng</span><span id="sticky-total-price" style="font-weight: 600;">0đ</span><span>hoặc</span><span id="sticky-monthly-price" style="font-weight: 600;">0đ</span><span>/tháng cho 24 tháng<sup>Δ</sup></span>
            </div>
        </div>
        <div style="height: 1px; background-color: #d2d2d7; width: 100%;"></div>
        <div class="sticky-row-bottom" style="display: flex; justify-content: flex-end; align-items: center; padding: 8px 80px 12px;">
            <div style="font-size: 13px; color: #1d1d1f; display: flex; align-items: center; gap: 8px;">
                <span>Giao đến: <a href="#" style="color: #0066cc; text-decoration: none;">P. Sài Gòn</a></span>
                <svg viewBox="0 0 25 18" class="as-svgicon as-svgicon-shipping" role="img" aria-hidden="true" width="16" height="16" style="fill: #1d1d1f;">
                    <path d="M19.5,6.5h-1.042C18.172,6.177,17.86,5.908,17.5,5.74V4.5c0-0.552-0.448-1-1-1h-11c-0.552,0-1,0.448-1,1v9c0,0.552,0.448,1,1,1h0.101 c0.203,1.135,1.194,2,2.399,2s2.196-0.865,2.399-2h5.202c0.203,1.135,1.194,2,2.399,2s2.196-0.865,2.399-2H21.5c0.552,0,1-0.448,1-1 v-5C22.5,8.015,21.157,6.5,19.5,6.5z M6.5,15.5c-0.827,0-1.5-0.673-1.5-1.5s0.673-1.5,1.5-1.5s1.5,0.673,1.5,1.5S7.327,15.5,6.5,15.5z M16,4.5v9h-1.042c-0.203-1.135-1.194-2-2.399-2c-0.019,0-0.038,0.002-0.057,0.003V4.5H16z M18.5,15.5 c-0.827,0-1.5-0.673-1.5-1.5s0.673-1.5,1.5-1.5s1.5,0.673,1.5,1.5S19.327,15.5,18.5,15.5z M21.5,13.5h-0.601 c-0.203-1.135-1.194-2-2.399-2c-0.36,0-0.672,0.128-0.923,0.34V7.5h1.923c1.103,0,2,0.897,2,2V13.5z"></path>
                </svg>
                <span id="sticky-delivery-date">...</span> (Miễn Phí)
            </div>
        </div>
    </div>
</div>

<div class="purchase-container">
    <div>
        @php
            $seriesTitleDisplay = $seriesTitle ?? 'Sản phẩm';
            $minPrice = $products->min(function($p) {
                return $p->numeric_price;
            });
            $minPriceFormatted = number_format($minPrice, 0, ',', '.') . 'đ';
        @endphp
        <h1 style="font-size: 48px; font-weight: bold;" id="page-title">Mua {{ $seriesTitleDisplay }}</h1>
        <p style="font-size: 17px; margin-bottom: 4px;" id="page-price-subtitle">Từ {{ $minPriceFormatted }} hoặc {{ number_format($minPrice/24, 0, ',', '.') }}đ/tháng trong 24 tháng*</p>
        <p style="font-size: 12px; color: #1d1d1f; margin-bottom: 12px;">Trả góp theo tháng với phí dịch vụ thực 1.67%, sau khi thanh toán lần đầu 20%.</p>
        <div class="apple-intelligence">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-selector-icon-apple-intelligence-202409?wid=17&hei=21&fmt=p-jpg&qlt=95&.v=1724970464935"
                alt="Apple Intelligence">
            <span>Apple Intelligence<sup>8</sup> <a href="#" style="text-decoration: none; color: #0066cc;">Tìm hiểu thêm ⊕</a></span>
        </div>
    </div>
    <div class="offer-buttons">
        <button class="offer-button">Nhận từ 800.000đ–17.600.000đ khi thu cũ đổi mới. ⊕</button>
        <button class="offer-button" style="width: fit-content;">Có tài trợ ⊕</button>
    </div>
</div>

<div class="rf-bfe-main">
    {{-- Left Column --}}
    <div class="rf-bfe-column-left">
        <div class="main-image-container">
            <button class="slider-nav slider-prev" onclick="moveSlider(-1)">&#10094;</button>
            <div class="image-slider" id="image-slider">
                <div class="image-slide">
                    <img id="main-product-image" src="{{ asset($products->first()->image_url ?? 'images/default.jpg') }}" alt="Product Image">
                </div>
            </div>
            <button class="slider-nav slider-next" onclick="moveSlider(1)">&#10095;</button>
            <div class="slider-dots" id="slider-dots"></div>
        </div>

        <h3 id="trade-in-section-title" style="margin-top: 40px; font-size: 24px; font-weight: 700;"><strong>Apple Trade In.</strong> <span style="font-weight: normal; color: #86868b;">Nhận 800.000đ–17.600.000đ điểm tín dụng để sử dụng khi mua <span id="trade-in-product-name">{{ $seriesTitleDisplay }}</span> mới.<sup>§</sup></span></h3>

        <div style="display:flex; gap:15px; margin-top:12px;">
            <div id="trade-chon-card" class="trade-card" onclick="toggleTradeIn(true)">
                <strong>Thêm yêu cầu đổi cũ lấy mới</strong>
                <p>Trả lời một số câu hỏi để nhận được giá trị ước tính của bạn.</p>
            </div>
            <div id="trade-no-card" class="trade-card selected" onclick="toggleTradeIn(false)">
                <strong>Không đổi cũ lấy mới</strong>
            </div>
        </div>

        <div id="trade-in-form" class="trade-in-form" style="display: none;">
            <p style="font-size: 14px; margin-bottom: 12px; color: #1d1d1f;">Nhập số sê-ri iPhone để kiểm tra giá trị trao đổi.</p>
            <div style="display: flex; gap: 10px;">
                <input type="text" placeholder="Số sê-ri" id="trade-serial-input">
                <button type="button">Xác minh</button>
            </div>
            <p style="font-size: 12px; color: #86868b; margin-top: 15px;">Trên iPhone, hãy vào mục Cài đặt > Cài đặt chung > Giới thiệu.</p>
        </div>

        <h3 style="margin-top: 50px; font-size: 24px; font-weight: 700;"><strong>Gói bảo hành AppleCare+.</strong> <span style="font-weight: normal; color: #86868b;">Bảo vệ <span id="applecare-product-name">{{ $seriesTitleDisplay }}</span> mới của bạn.</span></h3>
        <div class="applecare-options" style="display: flex; gap: 15px; margin-top: 10px;">
            <div class="applecare-card" id="applecare-yes-card" onclick="openApplecareModal()">
                <div class="applecare-header">
                    <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/APPLECARE-plus-201508?wid=326&hei=332&fmt=png-alpha" style="height: 24px; object-fit: contain;" alt="Apple"> AppleCare+
                </div>
                <p style="font-size: 14px; color: #1d1d1f; margin-bottom: 10px;">5.499.000đ hoặc 224.000đ/tháng cho 24 tháng<sup>◊</sup></p>
                <hr style="border: 0; border-top: 1px solid #d2d2d7; margin: 10px 0;">
                <ul class="applecare-benefits">
                    <li>Nay đã có dịch vụ sửa chữa không hạn chế cho trường hợp hư hỏng do sự cố bất ngờ.*</li>
                    <li>Dịch vụ sửa chữa được Apple chứng nhận sử dụng linh kiện Apple chính hãng.</li>
                    <li>Dịch vụ Thay Thế Cấp Tốc — Chúng tôi sẽ gửi cho bạn một thiết bị thay thế để bạn không phải chờ sửa chữa.</li>
                    <li>Ưu tiên tiếp cận các chuyên gia Apple.</li>
                </ul>
            </div>
            <div class="applecare-card selected" id="applecare-no-card" onclick="selectApplecare('no')">
                <strong>Không có bảo hành AppleCare+</strong>
            </div>
        </div>
    </div>

    {{-- Right Column --}}
    <div class="rf-bfe-column-right">
        <div class="option-section" id="section-model">
            <h2><strong>Phiên bản.</strong> <span style="font-weight: normal; color: #86868b;">Mẫu nào phù hợp nhất?</span></h2>
            <div id="model-selections">
                @foreach($products as $index => $product)
                    @php $priceVal = $product->numeric_price; @endphp
                    <div class="model-card {{ $index == 0 ? 'selected' : '' }}" 
                         data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $priceVal }}" 
                         data-image="{{ asset($product->image_url) }}" 
                         data-images='@json([asset($product->image_url), asset($product->image_url)])'
                         data-colors='{{ $product->colors }}' 
                         data-options='@json($product->options)'
                         onclick="selectModel(this)">
                        <div class="model-info-left">
                            <div class="model-label">{{ $product->name }}</div>
                            <div class="model-sub-label">{{ $product->sub_label ?? 'Có chip M5, M5 Pro hoặc M5 Max.' }}</div>
                        </div>
                        <div class="model-info-right">
                            <div>Từ {{ number_format($priceVal, 0, ',', '.') }}đ</div>
                            <div style="margin-top: 4px;">hoặc {{ number_format($priceVal / 24, 0, ',', '.') }}đ/tháng</div>
                            <div style="color: #86868b; font-size: 12px;">trong 24 tháng*</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="option-section disabled" id="section-color" style="margin-top: 40px;">
            <h2><strong>Màu.</strong> <span style="font-weight: normal; color: #86868b;">Chọn màu yêu thích.</span></h2>
            <b style="font-size: 17px; font-weight: 600; color: #1d1d1f;" id="color-label">Màu sắc</b>
            <div class="color-options" id="color-selections" style="padding: 15px 0;"></div>
        </div>

        <div id="dynamic-options-container"></div>

        <div class="help-info-box">
            <h4>Chương trình đổi cũ lấy mới hoạt động như thế nào? <span style="color: #86868b;">⊕</span></h4>
            <p>Tìm hiểu cách để tiết kiệm cho giao dịch này thông qua chương trình trao đổi. Hoặc tái chế thiết bị miễn phí.</p>
        </div>

        <div class="help-info-box">
            <h4>AppleCare+ hoạt động như thế nào? <span style="color: #86868b;">⊕</span></h4>
            <p>Bảo hành cho sự cố bị rơi hay đổ nước và hơn thế nữa cho iPhone của bạn. Xem dịch vụ đi kèm.</p>
        </div>
    </div>
</div>

{{-- What's in the Box Section --}}
<div style="background: #fff; padding: 40px 0; border-top: 1px solid #d2d2d7; text-align: center;">
    <div class="container" style="max-width: 980px;">
        <h2 style="font-size: 48px; font-weight: 700; margin-bottom: 70px; color: #1d1d1f; letter-spacing: -0.015em;">Trong hộp có gì</h2>
        
        <div style="background-color: #f5f5f7; border-radius: 28px; padding: 60px 40px; margin-bottom: 40px; display: flex; justify-content: space-around; align-items: flex-end; gap: 20px;">
            {{-- Item 1: Product --}}
            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 30px;">
                <div style="height: 320px; display: flex; align-items: flex-end; justify-content: center;">
                    <img id="box-product-img" src="{{ asset($products->first()->image_url) }}" style="max-height: 100%; max-width: 100%; object-fit: contain; mix-blend-mode: multiply;">
                </div>
                <p id="box-product-name" style="font-size: 14px; font-weight: 400; color: #1d1d1f; margin: 0; text-align: center;">{{ $seriesTitleDisplay }}</p>
            </div>

            {{-- Item 2: Cable --}}
            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 30px;">
                <div style="height: 320px; display: flex; align-items: flex-end; justify-content: center;">
                    <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/iphone-17-pro-witb-cable-202509?wid=400&hei=800&fmt=png-alpha" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
                <p style="font-size: 14px; font-weight: 400; color: #1d1d1f; margin: 0; text-align: center;">Cáp Sạc USB‑C</p>
            </div>

            {{-- Item 3: Adapter (Mac only) --}}
            @if(str_contains(strtolower($seriesTitleDisplay), 'mac'))
            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 30px;">
                <div style="height: 320px; display: flex; align-items: flex-end; justify-content: center;">
                    <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/macbook-neo-witb-adapter-202603_GEO_VN?wid=2176&hei=3136&fmt=p-jpg&qlt=95&.v=R2g1bDVDM0hPNnF6UVdMWWpFSlo1RXBQTmZPYkFBZzJyZC9PdDZ1RU55Mk51Qy9JMkYzcmQ2a3NmaUM4dlZLZzlvVnZxV2NUNlU3eTllalVnUFN1ZFFTTWdLL2xrUmxCSzFHMVo3SzVGQytoS29wTkEvZG5Zc0lIWERMQ3F0aVY" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
                <p style="font-size: 14px; font-weight: 400; color: #1d1d1f; margin: 0; text-align: center;">Bộ Tiếp Hợp Nguồn USB‑C 30W</p>
            </div>
            @endif
        </div>

        <div style="max-width: 780px; margin: 0 auto; text-align: center; border-top: 1px solid #d2d2d7; padding-top: 40px; margin-bottom: 40px;">
            <h4 style="font-size: 17px; font-weight: 600; color: #1d1d1f; margin-bottom: 15px;">Các mục tiêu về môi trường của chúng tôi.</h4>
            <p style="font-size: 14px; color: #86868b; line-height: 1.6; max-width: 700px; margin: 0 auto;">
                Là một phần trong nỗ lực của chúng tôi nhằm đạt được <a href="#" style="color: #0066cc; text-decoration: none;">trạng thái trung hòa carbon vào năm 2030</a>, {{ $seriesTitleDisplay }} không đi kèm bộ tiếp hợp nguồn hay Tai Nghe EarPods. Trong hộp có một cáp sạc nhanh USB-C hỗ trợ sạc nhanh và tương thích với bộ tiếp hợp nguồn USB-C cũng như cổng máy tính.
            </p>
            <p style="font-size: 14px; color: #86868b; line-height: 1.6; max-width: 700px; margin: 15px auto 0;">
                Chúng tôi khuyến khích bạn sử dụng bất kỳ bộ tiếp hợp nguồn USB-C nào tương thích. Bạn cũng có thể mua bộ tiếp hợp nguồn hoặc tai nghe mới của Apple nếu cần.
            </p>
        </div>

    </div>
</div>

{{-- Checkout Summary --}}
<div style="background: #f5f5f7; border-top: 1px solid #d2d2d7; padding: 60px 0;">
    <div class="container" style="max-width: 1300px; display: flex; gap: 80px; align-items: flex-start;">
        {{-- Left: Headline --}}
        <div style="flex: 1;">
            <h2 style="font-size: 36px; font-weight: 700; line-height: 1.1; margin-bottom: 40px; color: #1d1d1f;">
                <span id="summary-product-name-large">Sản phẩm</span> mới của bạn.<br>
                <span style="color: #86868b;">Theo cách bạn muốn.</span>
            </h2>
            <img id="checkout-product-image" src="{{ asset($products->first()->image_url) }}" style="width: 100%; max-width: 450px; object-fit: contain; border-radius: 18px; mix-blend-mode: multiply;">
        </div>

        {{-- Middle: Details --}}
        <div style="flex: 1.5;">
            <div style="margin-bottom: 20px;">
                <h3 id="summary-product-headline" style="font-size: 24px; font-weight: 600; margin-bottom: 20px; color: #1d1d1f; line-height: 1.2;">Sản phẩm của bạn</h3>
                
                <div id="summary-config-details" class="summary-config-list">
                    <!-- Structured list items will be injected here -->
                </div>
                
                <div style="margin-bottom: 25px;">
                    <div style="font-size: 21px; font-weight: 600; color: #1d1d1f; margin-bottom: 4px;">Tổng cộng <span id="summary-total-price">0đ</span></div>
                    <div style="font-size: 17px; color: #1d1d1f;">hoặc</div>
                    <div style="font-size: 21px; font-weight: 600; color: #1d1d1f; margin-top: 4px;">
                        <span id="summary-monthly-price">0đ</span>/tháng cho 24 tháng<sup>Δ</sup>
                    </div>
                    <div id="summary-installment-detail" style="font-size: 14px; color: #1d1d1f; margin-top: 6px;">
                        Ở mức phí dịch vụ 1.67%, sau khi thanh toán lần đầu 20% là <span id="summary-initial-payment">0đ</span>
                    </div>
                </div>

                <div id="summary-applecare-status" style="display: none; font-size: 17px; color: #1d1d1f; margin-bottom: 12px;">
                    Đi kèm AppleCare+
                </div>

                <div style="font-size: 17px; color: #1d1d1f; margin-bottom: 15px;">
                    Bao gồm thuế GTGT khoảng <span id="summary-vat-price">0đ</span>.<sup>Δ</sup>
                </div>

                <a href="#" style="color: #0066cc; text-decoration: none; font-size: 17px; display: flex; align-items: center; gap: 5px; margin-bottom: 30px;">
                    Khám phá thêm các lựa chọn trả góp hàng tháng <span style="font-size: 20px; font-weight: 300;">⊕</span>
                </a>

                <hr style="border: 0; border-top: 1.2px solid #86868b; margin: 0 0 25px 0;">

                <div style="margin-bottom: 25px;">
                    <h4 style="font-size: 17px; font-weight: 600; color: #1d1d1f; margin-bottom: 6px;">Vẫn chưa thể quyết định?</h4>
                    <p style="font-size: 17px; color: #1d1d1f; line-height: 1.4; margin-bottom: 12px;">
                        Bạn có thể nhấn "Lưu để xem lại sau" để dễ dàng quay lại xem sản phẩm.
                    </p>
                    <a href="#" style="color: #0066cc; text-decoration: none; font-size: 17px; display: flex; align-items: center; gap: 8px;">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 16L9 11.5L4 16V4C4 3.44772 4.44772 3 5 3H13C13.5523 3 14 3.44772 14 4V16Z" stroke="#0066cc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Lưu để xem lại sau
                    </a>
                </div>

                <hr style="border: 0; border-top: 1.2px solid #86868b; margin: 0 0 25px 0;">

                <p style="font-size: 17px; color: #1d1d1f; line-height: 1.4;">
                    Chi tiết giao hàng cho khu vực của bạn sẽ được hiển thị trong phần Thanh Toán.
                </p>
            </div>
        </div>

        {{-- Right: CTA --}}
        <div style="flex: 0 0 340px;">
            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div style="display: flex; gap: 15px; align-items: flex-start;">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                        <path d="M24 10H20V6C20 4.89543 19.1046 4 18 4H4C2.89543 4 2 4.89543 2 6V22C2 23.1046 2.89543 24 4 24H6C6 25.6569 7.34315 27 9 27C10.6569 27 12 25.6569 12 24H20C20 25.6569 21.3431 27 23 27C24.6569 27 26 25.6569 26 24H28C29.1046 24 30 23.1046 30 22V16L24 10Z" stroke="#1d1d1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="9" cy="24" r="3" stroke="#1d1d1f" stroke-width="1.5"/>
                        <circle cx="23" cy="24" r="3" stroke="#1d1d1f" stroke-width="1.5"/>
                        <path d="M24 10V16H30" stroke="#1d1d1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div style="font-size: 16px; color: #1d1d1f; line-height: 1.4;">
                        Đặt hàng hôm nay. Giao hàng đến <a href="#" style="color: #0066cc; text-decoration: underline;">P. Sài Gòn</a><br>
                        <strong><span id="summary-delivery-date">...</span> — Miễn Phí</strong>
                    </div>
                </div>
                
                <form id="add-to-cart-form">
                    @csrf
                    <input type="hidden" id="input-product-name">
                    <input type="hidden" id="input-total-price">
                    <input type="hidden" id="input-storage">
                    <input type="hidden" id="input-color">
                    <input type="hidden" id="input-applecare" value="0">
                    <input type="hidden" id="input-image">
                    
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <button type="button" class="buy-now-button" onclick="buyNow()" style="width: 100%; background-color: #0071e3; color: #fff; font-size: 17px; font-weight: 500; padding: 18px; border-radius: 12px; border: none; cursor: pointer; transition: all 0.3s ease;">
                            Mua hàng
                        </button>
                        <button type="button" class="add-to-bag-button" onclick="addToCart()" style="width: 100%; background-color: transparent; color: #0071e3; font-size: 17px; font-weight: 400; padding: 18px; border-radius: 12px; border: 1px solid #0071e3; cursor: pointer; transition: all 0.3s ease;">
                            Thêm vào giỏ hàng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if(str_contains(strtolower($seriesTitleDisplay), 'mac'))
{{-- Mac Benefits Section --}}
<div style="background: #fff; padding: 100px 0; border-top: 1px solid #d2d2d7; text-align: center;">
    <div class="container" style="max-width: 980px;">
        <h2 style="font-size: 48px; font-weight: 700; color: #1d1d1f; margin-bottom: 80px; letter-spacing: -0.015em; line-height: 1.1;">Mac mới đến với nhiều lợi<br>ích cộng thêm.</h2>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; text-align: center;">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/services-tv?wid=98&hei=98&fmt=jpeg&qlt=90" style="width: 48px; height: 48px; margin-bottom: 20px; border-radius: 10px;">
                <h3 style="font-size: 19px; font-weight: 600; color: #1d1d1f; margin-bottom: 8px;">Apple TV</h3>
                <p style="font-size: 14px; color: #1d1d1f; line-height: 1.4; max-width: 240px;">3 tháng miễn phí để xem các bộ phim và series gốc "đáng cày".<sup>§</sup></p>
            </div>
            <div style="display: flex; flex-direction: column; align-items: center;">
                <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/services-music?wid=98&hei=98&fmt=jpeg&qlt=90" style="width: 48px; height: 48px; margin-bottom: 20px; border-radius: 10px;">
                <h3 style="font-size: 19px; font-weight: 600; color: #1d1d1f; margin-bottom: 8px;">Apple Music</h3>
                <p style="font-size: 14px; color: #1d1d1f; line-height: 1.4; max-width: 240px;">3 tháng miễn phí để thưởng thức tất cả các bài hát bạn yêu thích, hoàn toàn không có quảng cáo.<sup>§</sup></p>
            </div>
            <div style="display: flex; flex-direction: column; align-items: center;">
                <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/services-arcade?wid=98&hei=98&fmt=jpeg&qlt=90" style="width: 48px; height: 48px; margin-bottom: 20px; border-radius: 10px;">
                <h3 style="font-size: 19px; font-weight: 600; color: #1d1d1f; margin-bottom: 8px;">Apple Arcade</h3>
                <p style="font-size: 14px; color: #1d1d1f; line-height: 1.4; max-width: 240px;">3 tháng miễn phí để chơi game cực vui, không gián đoạn.<sup>§</sup></p>
            </div>
        </div>
    </div>
</div>

{{-- Education Section --}}
<div style="background: #f5f5f7; padding: 100px 0; border-top: 1px solid #d2d2d7; text-align: center;">
    <div class="container" style="max-width: 980px;">
        <h2 style="font-size: 40px; font-weight: 700; color: #1d1d1f; margin-bottom: 24px; letter-spacing: -0.015em;">Sinh viên và giáo viên – tiết kiệm khi mua Mac mới.</h2>
        <p style="font-size: 19px; color: #1d1d1f; margin-bottom: 20px; font-weight: 400;">Nhận mức giá đặc biệt trong Cửa Hàng Dành Cho Ngành Giáo Dục.</p>
        <a href="#" style="color: #0066cc; text-decoration: none; font-size: 19px; display: flex; align-items: center; justify-content: center; gap: 5px;">
            Mua ngay <span style="font-size: 24px;">›</span>
        </a>
    </div>
</div>
@endif

@push('scripts')
<script>
    let currentModel = null, selectedOptions = {}, currentColor = null, appleCarePrice = 0, currentSlide = 0, sliderImages = [];
    function formatCurrency(n) { return new Intl.NumberFormat('vi-VN').format(n) + 'đ'; }
    
    // Custom slow smooth scroll function
    function slowScrollTo(targetY, duration = 800) {
        const startY = window.pageYOffset;
        const diff = targetY - startY;
        let startTime = null;

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = timestamp - startTime;
            const percent = Math.min(progress / duration, 1);
            
            // Easing function: easeOutCubic
            const ease = 1 - Math.pow(1 - percent, 3);
            
            window.scrollTo(0, startY + diff * ease);

            if (progress < duration) {
                window.requestAnimationFrame(step);
            }
        }
        window.requestAnimationFrame(step);
    }

    function toggleTradeIn(show) {
        document.getElementById('trade-in-form').style.display = show ? 'block' : 'none';
        document.getElementById('trade-chon-card').classList.toggle('selected', show);
        document.getElementById('trade-no-card').classList.toggle('selected', !show);
    }
    
    function selectApplecare(c) {
        appleCarePrice = c === 'yes' ? 5499000 : 0;
        document.getElementById('applecare-yes-card').classList.toggle('selected', c === 'yes');
        document.getElementById('applecare-no-card').classList.toggle('selected', c === 'no');
        document.getElementById('input-applecare').value = c === 'yes' ? '1' : '0';
        updateSummary();
    }
    
    function openApplecareModal() {
        document.getElementById('applecare-modal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeApplecareModal() {
        document.getElementById('applecare-modal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    function addAppleCare() {
        selectApplecare('yes');
        closeApplecareModal();
    }
    
    function showInfo(type) {
        let title = '', text = '';
        if (type.toLowerCase().includes('ram') || type.toLowerCase().includes('bộ nhớ')) {
            title = 'Về Bộ Nhớ (RAM)';
            text = 'Bộ nhớ càng lớn, bạn càng có thể chạy nhiều ứng dụng cùng lúc với hiệu suất cao hơn.';
        } else if (type.toLowerCase().includes('ssd') || type.toLowerCase().includes('ổ cứng') || type.toLowerCase().includes('dung lượng')) {
            title = 'Về Dung Lượng Lưu Trữ';
            text = 'Dung lượng lưu trữ là dung lượng để bạn lưu tài liệu, ảnh, nhạc, video và các tệp khác.';
        } else {
            title = 'Thông tin về ' + type;
            text = 'Lựa chọn này giúp bạn tùy chỉnh thiết bị phù hợp nhất với nhu cầu sử dụng.';
        }
        Swal.fire({
            title: title,
            text: text,
            confirmButtonText: 'Đã hiểu',
            confirmButtonColor: '#0071e3',
            customClass: { popup: 'apple-alert-popup' }
        });
    }
    
    function init() {
        const first = document.querySelector('.model-card');
        if(first) {
            // Delay slightly to ensure all elements are ready
            setTimeout(() => selectModel(first), 100);
        }
        window.addEventListener('scroll', () => {
            const h = document.getElementById('sticky-header'), t = document.getElementById('page-price-subtitle');
            if(t && h) h.style.display = window.scrollY > (t.getBoundingClientRect().bottom + window.scrollY) ? 'flex' : 'none';
        });
    }

    document.addEventListener('DOMContentLoaded', init);
    function toggleCustomEdit(btn) {
        const summaryCard = btn.closest('.custom-summary-card');
        const dropdown = summaryCard.querySelector('.custom-options-dropdown');
        const footer = summaryCard.querySelector('.custom-summary-footer');
        const isShowing = dropdown.classList.contains('show');

        // Close all other dropdowns first
        document.querySelectorAll('.custom-options-dropdown.show').forEach(el => {
            if (el !== dropdown) {
                el.classList.remove('show');
                const otherCard = el.closest('.custom-summary-card');
                if (otherCard) {
                    otherCard.querySelector('.custom-summary-footer').style.display = 'flex';
                    const otherBtn = otherCard.querySelector('.btn-custom-edit');
                    if (otherBtn) otherBtn.innerHTML = `Chỉnh sửa <i class="bi bi-chevron-down"></i>`;
                }
            }
        });

        if (isShowing) {
            dropdown.classList.remove('show');
            if (footer) footer.style.display = 'flex';
            btn.innerHTML = `Chỉnh sửa <i class="bi bi-chevron-down"></i>`;
        } else {
            dropdown.classList.add('show');
            if (footer) footer.style.display = 'none';
            btn.innerHTML = `Đóng <i class="bi bi-chevron-up"></i>`;
        }
    }

    function selectModel(el) {
        document.querySelectorAll('.model-card').forEach(c => c.classList.remove('selected'));
        el.classList.add('selected');
        
        let rawOptions = [];
        try { rawOptions = JSON.parse(el.dataset.options || '[]'); } catch(e) { rawOptions = []; }
        
        let rawImages = [];
        try { rawImages = JSON.parse(el.dataset.images || '[]'); } catch(e) { rawImages = []; }

        let rawColors = [];
        try {
            const colorData = el.dataset.colors || "";
            if (colorData.trim().startsWith('[')) {
                rawColors = JSON.parse(colorData);
            } else {
                rawColors = colorData.split(',').map(c => c.trim()).filter(c => c !== "");
            }
        } catch(e) { rawColors = []; }

        currentModel = {
            id: el.dataset.id, 
            name: el.dataset.name, 
            price: parseInt(el.dataset.price) || 0,
            image: el.dataset.image, 
            images: rawImages,
            colors: rawColors, 
            options: rawOptions
        };

        const mainImg = document.getElementById('main-product-image');
        if(mainImg) mainImg.src = currentModel.image;
        const boxImg = document.getElementById('box-product-img');
        if(boxImg) boxImg.src = currentModel.image;
        
        const pageTitle = document.getElementById('page-title');
        if(pageTitle) pageTitle.innerText = `Mua ${currentModel.name}`;
        const pagePriceSub = document.getElementById('page-price-subtitle');
        if(pagePriceSub) pagePriceSub.innerText = `Từ ${formatCurrency(currentModel.price)} hoặc ${formatCurrency(Math.round(currentModel.price/24))}/tháng trong 24 tháng*`;
        
        const idsToUpdate = ['sticky-product-name', 'trade-in-product-name', 'applecare-product-name', 'box-product-name', 'summary-product-name-large', 'summary-product-headline'];
        idsToUpdate.forEach(id => {
            const el = document.getElementById(id);
            if(el) el.innerText = currentModel.name;
        });
        
        // Dynamic options
        const container = document.getElementById('dynamic-options-container');
        if(container) {
            container.innerHTML = '';
            
            // Group options by attribute and then by group_name
            const attributesMap = {};
            (currentModel.options || []).forEach(o => {
                const attr = o.attribute || { id: o.attribute_id, name: 'Tùy chọn', group_name: null };
                if(!attributesMap[attr.id]) {
                    attributesMap[attr.id] = {
                        id: attr.id,
                        name: attr.name,
                        group_name: attr.group_name,
                        items: []
                    };
                }
                attributesMap[attr.id].items.push(o);
            });

            // Further group by group_name
            const groups = {};
            Object.values(attributesMap).forEach(attr => {
                const gName = attr.group_name || `ungrouped_${attr.id}`;
                if(!groups[gName]) groups[gName] = { name: attr.group_name, attrs: [] };
                groups[gName].attrs.push(attr);
            });

            Object.entries(groups).forEach(([gName, g], groupIndex) => {
                const groupDiv = document.createElement('div');
                groupDiv.className = 'option-section disabled';
                groupDiv.id = `group-${groupIndex}`;
                groupDiv.style.marginTop = '40px';
                
                if(g.name) {
                    groupDiv.innerHTML = `<h2><strong>${g.name}.</strong> <span style="font-weight: normal; color: #86868b;">Giữ nguyên hoặc điều chỉnh.</span></h2>`;
                }

                g.attrs.forEach(attr => {
                    const attrDiv = document.createElement('div');
                    attrDiv.className = 'attribute-container mb-4';

                    if(!g.name) {
                        attrDiv.innerHTML = `
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                                <h2 class="option-group-title">${attr.name}. <span>Chọn cấu hình của bạn.</span></h2>
                            </div>
                        `;
                    }

                    // If it's a grouped attribute (like in "Tùy biến"), show summary card
                    if(g.name) {
                        const defaultOpt = attr.items.find(i => i.is_default) || attr.items[0];
                        selectedOptions[attr.id] = { name: attr.name, label: defaultOpt.label, offset: parseFloat(defaultOpt.price_offset) };
                        
                        let icon = 'bi-cpu';
                        if(attr.name.toLowerCase().includes('dung lượng') || attr.name.toLowerCase().includes('ssd')) icon = 'bi-device-ssd';
                        if(attr.name.toLowerCase().includes('nguồn')) icon = 'bi-lightning-charge';
                        if(attr.name.toLowerCase().includes('bàn phím')) icon = 'bi-keyboard';
                        if(attr.name.toLowerCase().includes('màn hình')) icon = 'bi-display';
                        if(attr.name.toLowerCase().includes('đế')) icon = 'bi-box-arrow-in-down';
                        if(attr.name.toLowerCase().includes('ethernet')) icon = 'bi-ethernet';
                        if(attr.name.toLowerCase().includes('chuột')) icon = 'bi-mouse';

                        const summaryCard = document.createElement('div');
                        summaryCard.className = 'custom-summary-card';
                        summaryCard.id = `summary-card-${attr.id}`;
                        summaryCard.innerHTML = `
                            <div class="custom-summary-header">
                                <i class="bi ${icon}"></i>
                                <div class="custom-summary-title">${attr.name}</div>
                            </div>
                            <div class="custom-summary-desc">${attr.items[0].description || ''}</div>
                            <div class="custom-current-label">Hiện tại</div>
                            <div class="custom-current-value" id="current-val-${attr.id}">${defaultOpt.label}</div>
                            
                            <div class="custom-summary-footer">
                                <div class="custom-available-text">Có sẵn các tùy chọn từ ${attr.items[0].label} đến ${attr.items[attr.items.length-1].label}</div>
                                <button type="button" class="btn-custom-edit" id="btn-edit-${attr.id}" onclick="toggleCustomEdit(this)">
                                    Chỉnh sửa <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                            
                            <div class="custom-options-dropdown" id="custom-options-${attr.id}">
                                <div class="custom-dropdown-header">
                                    <div class="custom-dropdown-title">Chọn ${attr.name.toLowerCase()}.</div>
                                    <button type="button" class="btn-close-dropdown" onclick="toggleCustomEdit(this.closest('.custom-summary-card').querySelector('.btn-custom-edit'))">
                                        <i class="bi bi-chevron-up"></i>
                                    </button>
                                </div>
                                <div class="nested-options-list"></div>
                            </div>
                        `;
                        attrDiv.appendChild(summaryCard);
                        
                        const list = attrDiv.querySelector('.nested-options-list');
                        attr.items.forEach(o => {
                            const card = createNestedOptionCard(o, attr.id);
                            list.appendChild(card);
                        });
                    } else {
                        // Standard layout
                        attr.items.forEach(o => {
                            const card = createOptionCard(o, attr.id, false);
                            attrDiv.appendChild(card);
                            if(o.is_default) selectedOptions[attr.id] = { name: attr.name, label: o.label, offset: parseFloat(o.price_offset) };
                        });

                        if(attr.name.toLowerCase().includes('chip')) {
                            const footer = document.createElement('div');
                            footer.className = 'installment-info-footer';
                            footer.innerHTML = `Trà góp theo tháng với phí dịch vụ thực 1.67%, sau khi thanh toán lần đầu 20%. Có thêm tùy chọn thanh toán khi hoàn tất giao dịch.`;
                            attrDiv.appendChild(footer);
                        }
                    }
                    groupDiv.appendChild(attrDiv);
                });
                container.appendChild(groupDiv);
            });
        }
        
        // Colors
        const cc = document.getElementById('color-selections'); 
        if(cc) {
            cc.innerHTML = '';
            (currentModel.colors || []).forEach((c, i) => {
                const d = document.createElement('div'); d.className = 'color-circle' + (i===0?' selected':'');
                d.style.backgroundColor = c.trim(); 
                d.onclick = () => { 
                    cc.querySelectorAll('.color-circle').forEach(x=>x.classList.remove('selected')); 
                    d.classList.add('selected'); 
                    currentColor = c.trim(); 
                    // Enable next section (Chip or first dynamic section)
                    const nextSection = document.querySelector('#dynamic-options-container .option-section');
                    if (nextSection) {
                        nextSection.classList.remove('disabled');
                        // Use the new slow scroll
                        slowScrollTo(nextSection.offsetTop - 120, 1000);
                    }
                    updateSummary(); 
                };
                cc.appendChild(d); 
                if(i===0) currentColor = c.trim();
            });
        }

        // Initially enable Color section when Model is selected
        const colorSection = document.getElementById('section-color');
        if (colorSection) colorSection.classList.remove('disabled');
        
        updateSummary();
    }

    function createOptionCard(o, attrId, isNested) {
        const card = document.createElement('div');
        card.className = 'premium-option-card' + (o.is_default ? ' selected' : '');
        
        const totalWithOption = currentModel.price + parseFloat(o.price_offset);
        const monthlyWithOption = Math.round(totalWithOption / 24);

        card.innerHTML = `
            <div class="option-content">
                ${o.sub_label ? `<div class="option-sub-label">${o.sub_label}</div>` : ''}
                <div class="option-label">${o.label}</div>
                ${o.description ? `<div class="option-description">${o.description}</div>` : ''}
            </div>
            <div class="option-price-container">
                <div>Từ ${formatCurrency(totalWithOption)}</div>
                <div class="option-price-monthly">hoặc<br>${formatCurrency(monthlyWithOption)}/tháng</div>
                <div class="option-price-note">trong 24 tháng*</div>
            </div>
        `;

        card.onclick = () => {
            const container = card.parentElement;
            container.querySelectorAll('.premium-option-card').forEach(x => x.classList.remove('selected'));
            card.classList.add('selected');
            selectedOptions[attrId] = { ...selectedOptions[attrId], label: o.label, offset: parseFloat(o.price_offset) };
            
            // Update summary text if it's a customization option
            const summaryVal = document.getElementById(`current-val-${attrId}`);
            if(summaryVal) {
                summaryVal.innerHTML = o.label;
            }

            // Enable next section
            const currentSection = card.closest('.option-section');
            let nextSection = currentSection.nextElementSibling;
            if (!nextSection && currentSection.id === 'section-customization') {
                // Tùy biến doesn't have a direct next, it might be the peripherals
                nextSection = document.querySelector('#dynamic-options-container .option-section:not(#section-customization):not(.disabled)');
            }
            if (nextSection) {
                nextSection.classList.remove('disabled');
                // Use the new slow scroll
                slowScrollTo(nextSection.offsetTop - 120, 1000);
            }

            updateSummary();
        };
        return card;
    }
    
    function createNestedOptionCard(o, attrId) {
        const card = document.createElement('div');
        card.className = 'nested-option-card' + (o.is_default ? ' selected' : '');
        
        const priceText = parseFloat(o.price_offset) === 0 ? 'Có sẵn' : `+ ${formatCurrency(parseFloat(o.price_offset))}`;

        card.innerHTML = `
            <div class="nested-option-label">${o.label}</div>
            <div class="nested-option-price">${priceText}</div>
        `;

        card.onclick = () => {
            const container = card.parentElement;
            container.querySelectorAll('.nested-option-card').forEach(x => x.classList.remove('selected'));
            card.classList.add('selected');
            selectedOptions[attrId] = { ...selectedOptions[attrId], label: o.label, offset: parseFloat(o.price_offset) };
            
            const summaryVal = document.getElementById(`current-val-${attrId}`);
            if(summaryVal) summaryVal.innerText = o.label;

            // Enable next section if available
            const currentSection = card.closest('.option-section');
            if (currentSection) {
                const nextSection = currentSection.nextElementSibling;
                if (nextSection) nextSection.classList.remove('disabled');
            }

            updateSummary();
        };
        return card;
    }

    function updateSummary() {
        if(!currentModel) return;
        
        const getColorName = (hex) => {
            hex = hex.trim().toLowerCase();
            if(hex.length === 4) hex = '#' + hex[1] + hex[1] + hex[2] + hex[2] + hex[3] + hex[3];
            const names = [
                ["000000", "Đen"], ["ffffff", "Trắng"], ["f5f5f0", "Trắng Ánh Sao"], ["e3e4e5", "Bạc"],
                ["2c2c2e", "Đen Không Gian"], ["d1d1d1", "Titan Tự Nhiên"], ["e5e5e5", "Titan Trắng"],
                ["4b4b4b", "Titan Đen"], ["7d7d7d", "Titan Xanh"], ["f2d1c1", "Hồng"], ["ff0000", "Đỏ"],
                ["c0c0c0", "Bạc"], ["ffd700", "Vàng"], ["3c3c3c", "Xám Không Gian"], ["5c61f0", "Xanh Lưu Ly"],
                ["b2d4c6", "Lục Lam (Teal)"], ["00ffcc", "Xanh Ngọc"], ["bf00ff", "Tím Nhạt"], ["c29b83", "Titan Sa Mạc"],
                ["808080", "Xám"], ["0000ff", "Xanh Biển"], ["00ff00", "Xanh Lá"], ["ffff00", "Vàng"],
                ["ffa500", "Cam"], ["ffc0cb", "Hồng"], ["800080", "Tím"], ["a52a2a", "Nâu"], ["00ffff", "Xanh Da Trời"]
            ];
            let r = parseInt(hex.substring(1, 3), 16), g = parseInt(hex.substring(3, 5), 16), b = parseInt(hex.substring(5, 7), 16);
            let minDiff = Infinity, bestName = "Màu sắc";
            names.forEach(n => {
                let nr = parseInt(n[0].substring(0, 2), 16), ng = parseInt(n[0].substring(2, 4), 16), nb = parseInt(n[0].substring(4, 6), 16);
                let diff = Math.pow(r - nr, 2) + Math.pow(g - ng, 2) + Math.pow(b - nb, 2);
                if(diff < minDiff) { minDiff = diff; bestName = n[1]; }
            });
            return bestName;
        };

        const colorName = getColorName(currentColor || "#ffffff");
        const colorLabel = document.getElementById('color-label');
        if (colorLabel) colorLabel.innerText = colorName;

        let optionsTotal = 0, lbls = [];
        Object.values(selectedOptions).forEach(o => { 
            optionsTotal += o.offset; 
            lbls.push(o.label);
        });
        const total = currentModel.price + optionsTotal + appleCarePrice;
        
        // Update price labels
        const totalPriceEl = document.getElementById('summary-total-price');
        if(totalPriceEl) totalPriceEl.innerText = formatCurrency(total);
        const monthlyPriceEl = document.getElementById('summary-monthly-price');
        if(monthlyPriceEl) monthlyPriceEl.innerText = formatCurrency(Math.round(total/24));
        document.getElementById('summary-initial-payment').innerText = formatCurrency(Math.round(total * 0.2));
        document.getElementById('summary-vat-price').innerText = formatCurrency(Math.round(total * 0.1));
        
        document.getElementById('sticky-total-price').innerText = formatCurrency(total);
        document.getElementById('sticky-monthly-price').innerText = formatCurrency(Math.round(total/24));

        // Update Structured Summary Details
        const summaryDetails = document.getElementById('summary-config-details');
        if (summaryDetails) {
            summaryDetails.innerHTML = '';
            
            // 1. Model
            const mItem = document.createElement('div');
            mItem.className = 'summary-config-item';
            mItem.innerHTML = `<span class="summary-config-category">Phiên bản:</span> ${currentModel.name}`;
            summaryDetails.appendChild(mItem);

            // 2. Color
            const cItem = document.createElement('div');
            cItem.className = 'summary-config-item';
            cItem.innerHTML = `<span class="summary-config-category">Màu sắc:</span> ${colorName}`;
            summaryDetails.appendChild(cItem);

            // 3. Dynamic Options
            Object.values(selectedOptions).forEach(opt => {
                const optItem = document.createElement('div');
                optItem.className = 'summary-config-item';
                optItem.innerHTML = `<span class="summary-config-category">${opt.name}:</span> ${opt.label}`;
                summaryDetails.appendChild(optItem);
            });

            // 4. AppleCare
            if (appleCarePrice > 0) {
                const acItem = document.createElement('div');
                acItem.className = 'summary-config-item';
                acItem.innerHTML = `<span class="summary-config-category">Bảo vệ:</span> Gói bảo hành AppleCare+`;
                summaryDetails.appendChild(acItem);
            }
        }

        // Calculate delivery dates
        const now = new Date();
        const start = new Date();
        start.setDate(now.getDate() + 1);
        const end = new Date();
        end.setDate(now.getDate() + 3);
        
        const formatDate = (date) => {
            const d = String(date.getDate()).padStart(2, '0');
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const y = date.getFullYear();
            return `${d}/${m}/${y}`;
        };
        
        const deliveryDateStr = `${formatDate(start)} – ${formatDate(end)}`;
        const deliveryDateEl = document.getElementById('sticky-delivery-date');
        if(deliveryDateEl) deliveryDateEl.innerText = deliveryDateStr;
        const summaryDeliveryDateEl = document.getElementById('summary-delivery-date');
        if(summaryDeliveryDateEl) summaryDeliveryDateEl.innerText = deliveryDateStr;
        
        // Calculate initial payment (20%)
        const initialPayment = Math.round(total * 0.2);
        document.getElementById('summary-initial-payment').innerText = formatCurrency(initialPayment);
        
        // Calculate VAT (approx 10%)
        const vat = Math.round((total / 1.1) * 0.1);
        document.getElementById('summary-vat-price').innerText = formatCurrency(vat);
        
        // AppleCare status visibility
        document.getElementById('summary-applecare-status').style.display = appleCarePrice > 0 ? 'block' : 'none';
        
        document.getElementById('checkout-product-image').src = currentModel.image;
        
        // Update hidden inputs
        document.getElementById('input-product-name').value = currentModel.name;
        document.getElementById('input-total-price').value = total;
        document.getElementById('input-storage').value = lbls.join(', ');
        document.getElementById('input-color').value = colorName;
        document.getElementById('input-image').value = currentModel.image;
    }
    
    function addToCart(showSuccessAlert = true) {
        const data = {
            _token: '{{ csrf_token() }}',
            product_name: document.getElementById('input-product-name').value,
            price: document.getElementById('input-total-price').value,
            storage: document.getElementById('input-storage').value,
            color: document.getElementById('input-color').value,
            applecare: document.getElementById('input-applecare').value,
            image_url: document.getElementById('input-image').value
        };

        if(!data.product_name) {
            Swal.fire('Lỗi', 'Vui lòng chọn cấu hình sản phẩm trước.', 'error');
            return;
        }

        return fetch('{{ route('cart-add') }}', { 
            method: 'POST', 
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}, 
            body: JSON.stringify(data) 
        })
        .then(r => {
            if(r.status === 401) throw new Error('AUTH_REQUIRED');
            return r.json();
        })
        .then(res => { 
            if(res.success) {
                if (showSuccessAlert) {
                    Swal.fire({
                        title: 'Đã thêm vào túi',
                        text: res.message,
                        icon: 'success',
                        confirmButtonText: 'Xem giỏ hàng',
                        showCancelButton: true,
                        cancelButtonText: 'Tiếp tục mua sắm',
                        confirmButtonColor: '#0071e3'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('bag') }}';
                        }
                    });
                }
                return true;
            } else {
                Swal.fire('Thất bại', res.message || 'Có lỗi xảy ra', 'error');
                return false;
            }
        })
        .catch(err => {
            if(err.message === 'AUTH_REQUIRED') {
                Swal.fire({
                    title: 'Cần đăng nhập',
                    text: 'Vui lòng đăng nhập để thực hiện chức năng này.',
                    icon: 'warning',
                    confirmButtonText: 'Đăng nhập ngay',
                    confirmButtonColor: '#0071e3'
                }).then(() => {
                    window.location.href = '{{ route('login') }}';
                });
            } else {
                console.error(err);
                Swal.fire('Lỗi', 'Không thể kết nối đến máy chủ', 'error');
            }
            return false;
        });
    }

    function buyNow() {
        const data = {
            product: document.getElementById('input-product-name').value,
            price: document.getElementById('input-total-price').value,
            storage: document.getElementById('input-storage').value,
            color: document.getElementById('input-color').value,
            applecare: document.getElementById('input-applecare').value,
            image_url: document.getElementById('input-image').value
        };

        if(!data.product) {
            Swal.fire('Lỗi', 'Vui lòng chọn cấu hình sản phẩm trước.', 'error');
            return;
        }

        // Chuyển hướng trực tiếp sang checkout với các tham số (Direct Buy)
        // Luồng này sẽ không lưu vào bảng cart_items mà xử lý đơn hàng tức thì
        const params = new URLSearchParams(data).toString();
        window.location.href = `{{ route('checkout') }}?${params}`;
    }
    document.addEventListener('DOMContentLoaded', init);
</script>
@endpush
<div class="apple-modal-overlay" id="applecare-modal">
    <div class="apple-modal">
        <button class="apple-modal-close" onclick="closeApplecareModal()">&times;</button>
        <div style="text-align: center;">
            <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/APPLECARE-plus-201508?wid=326&hei=332&fmt=png-alpha" style="height: 80px; margin-bottom: 20px; object-fit: contain;" alt="AppleCare+">
            <h2 style="font-size: 32px; font-weight: 700; margin-bottom: 8px;">AppleCare+</h2>
            <p style="font-size: 17px; color: #1d1d1f; margin-bottom: 30px;">5.499.000đ hoặc 224.000đ/tháng cho 24 tháng<sup>◊</sup></p>
            <button class="modal-add-button" onclick="addAppleCare()">Thêm</button>
        </div>
        <div style="text-align: left; line-height: 1.6;">
            <p style="font-size: 14px; margin-bottom: 20px;">
                Mỗi sản phẩm iPhone đều được bảo hành sửa chữa phần cứng một năm qua <a href="#" style="color: #0066cc; text-decoration: none;">bảo hành giới hạn</a> và hỗ trợ kỹ thuật miễn phí lên đến <a href="#" style="color: #0066cc; text-decoration: none;">90 ngày</a>. AppleCare+ cho iPhone kéo dài thời gian bảo hành lên hai năm kể từ ngày bạn mua AppleCare+, bao gồm bảo hành không giới hạn số lần cho các trường hợp hư hỏng do sự cố bất ngờ. Mỗi lần bảo hành chịu phí dịch vụ 799.000đ đối với trường hợp hư hỏng màn hình hoặc kính mặt sau, hoặc 2.649.000đ đối với trường hợp hư hỏng do sự cố bất ngờ khác. Để biết thông tin đầy đủ, vui lòng tham khảo các <a href="#" style="color: #0066cc; text-decoration: none;">điều khoản</a>.
            </p>
            <a href="#" style="color: #0066cc; text-decoration: none; font-size: 14px; display: block; margin-bottom: 40px;">Tìm hiểu thêm về AppleCare+ ↗</a>
            
            <div style="font-size: 11px; color: #86868b; line-height: 1.4;">
                <p>Δ Ước tính. Mức phí có thể thay đổi theo thời gian.</p>
                <p>Chương trình Trả Góp Hàng Tháng Với MoMo do (các) đối tác tín dụng cung cấp qua ứng dụng MoMo của Công Ty Cổ Phần Dịch Vụ Di Động Trực Tuyến (“MoMo”) chứ không phải Apple. Chỉ cư dân Việt Nam đủ điều kiện mới có thể mua sản phẩm đủ điều kiện qua chương trình này.</p>
                <p>Tất cả sản phẩm được mua qua hình thức Trả Góp Hàng Tháng Với MoMo đều cần có tài khoản ví điện tử MoMo và phải được (các) đối tác tín dụng của MoMo phê duyệt. Nếu bạn có câu hỏi về điều kiện tín dụng của mình, vui lòng liên hệ với MoMo để nhận câu trả lời từ (các) đối tác tín dụng của MoMo. Ngoài ra, vui lòng tham khảo ứng dụng MoMo hoặc (các) đối tác tín dụng của MoMo để biết điều kiện, phí và phụ phí.</p>
                <p>Apple có toàn quyền quyết định sản phẩm nào đủ điều kiện hưởng ưu đãi trả góp vào bất cứ lúc nào. Mọi thay đổi về việc lựa chọn sản phẩm, kỳ hạn trả góp và phí dịch vụ đều sẽ làm thay đổi ưu đãi trả góp hàng tháng. Phí dịch vụ quy định trên trang web là một con số ước tính.</p>
            </div>
        </div>
    </div>
</div>
@endsection
