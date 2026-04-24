@extends('layouts.app', ['pageTitle' => 'config-mac.php'])

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/apple_buy-mac-styles.css') }}?v={{ time() }}">

<div class="buy-mac-container">
    <!-- Top Model Selector (Horizontal Scroll) -->
    <section class="model-selector-bar">
        <div class="container-fluid">
            <ul class="model-nav-list">
                @foreach($groupedProducts as $series => $products)
                    <li class="model-nav-item @if($product->series == $series) active @endif" data-series="{{ $series }}">
                        <img src="{{ $products[0]->series_image }}" alt="{{ $products[0]->series_title }}">
                        <span>{{ $products[0]->series_title }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <!-- Main Purchase Section -->
    <div class="container mt-5">
        <div class="row purchase-layout">
            <!-- Left: Sticky Gallery -->
            <div class="col-lg-7 gallery-column">
                <div class="sticky-gallery">
                    <h1 class="product-title" id="display-name">{{ $product->name }}</h1>
                    <div class="gallery-image-container">
                        <img id="main-product-image" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </div>
                </div>
            </div>

            <!-- Right: Scrollable Options -->
            <div class="col-lg-5 options-column">
                <div class="options-wrapper">
                    <!-- Series Specific Models -->
                    <div id="model-variants" class="option-section">
                        <h6 class="option-title">Chọn dòng máy.</h6>
                        <div class="variant-grid" id="variant-list">
                            @foreach($groupedProducts[$product->series] as $v)
                                <div class="variant-card @if($v->id == $product->id) active @endif" data-id="{{ $v->id }}">
                                    <div class="v-name">{{ $v->name }}</div>
                                    <div class="v-price">Từ {{ number_format($v->price, 0, ',', '.') }}đ</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Color Selection -->
                    <div id="color-selection" class="option-section mt-5">
                        <h6 class="option-title">Chọn màu sắc.</h6>
                        <div class="color-grid" id="color-list">
                            @php $colors = explode(',', $product->colors); @endphp
                            @foreach($colors as $index => $color)
                                <div class="color-option @if($index == 0) active @endif" title="{{ trim($color) }}" data-color="{{ trim($color) }}">
                                    <div class="color-circle" style="background-color: #ccc"></div> <!-- Color map handled in JS -->
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Specifications (Mockup) -->
                    <div class="option-section mt-5">
                        <h6 class="option-title">Bộ nhớ (RAM).</h6>
                        <div class="spec-grid">
                            <div class="spec-card active"><span>8GB</span></div>
                            <div class="spec-card"><span>16GB</span></div>
                            <div class="spec-card"><span>24GB</span></div>
                        </div>
                    </div>

                    <div class="option-section mt-5">
                        <h6 class="option-title">Ổ lưu trữ (SSD).</h6>
                        <div class="spec-grid">
                            <div class="spec-card active"><span>256GB SSD</span></div>
                            <div class="spec-card"><span>512GB SSD</span></div>
                            <div class="spec-card"><span>1TB SSD</span></div>
                        </div>
                    </div>

                    <!-- AppleCare+ -->
                    <div class="applecare-section mt-5">
                        <div class="applecare-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">AppleCare+ cho Mac</h6>
                                    <p class="text-muted small mb-0">Bảo vệ máy của bạn toàn diện.</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="applecare-toggle">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Sticky Price Bar -->
    <div class="bottom-price-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="price-display">
                <span class="price-label">Tổng cộng:</span>
                <span class="price-value" id="total-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
            </div>
            <button class="btn btn-primary add-to-bag-btn" id="add-to-bag">Thêm vào giỏ hàng</button>
        </div>
    </div>
</div>

<script>
    const groupedProducts = @json($groupedProducts);
</script>
<script src="{{ asset('assets/js/js-apple_buy-mac.js') }}?v={{ time() }}"></script>
@endsection
