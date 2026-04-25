@extends('layouts.app', ['pageTitle' => 'mua-iphone.php'])

@section('title', 'Mua iPhone - Apple (VN)')

@section('content')




<div class="header-container">
    <h1 style="padding-left: 7.5vw;">Mua iPhone</h1>
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


<style>
    /* Apple Style Modal CSS */
    .modal-xl { max-width: 1200px; }
    
    #productModal .modal-content {
        background: transparent !important;
        border: none !important;
    }

    #productModal .modal-content-wrapper {
        background: white;
        border-radius: 28px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }

    .top-series-tabs {
        display: flex;
        justify-content: center;
        width: fit-content;
        margin: 0 auto 24px auto;
        background: #f5f5f7;
        border-radius: 40px;
        padding: 5px;
    }

    .pill-tab {
        background: transparent;
        border: none;
        border-radius: 30px;
        padding: 10px 24px;
        font-size: 15px;
        font-weight: 500;
        color: #1d1d1f;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .pill-tab.active {
        background: #1d1d1f;
        color: white;
    }


    .inner-modal-tabs {
        display: flex;
        gap: 16px;
        margin-bottom: 30px;
    }

    .inner-pill {
        background: #f5f5f7;
        border-radius: 12px;
        padding: 6px 12px;
        font-size: 13px;
        color: #1d1d1f;
        text-decoration: none;
        transition: 0.2s;
    }

    .inner-pill.active {
        background: #e8e8ed;
        font-weight: 600;
    }

    .modal-close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 36px;
        height: 36px;
        background: #f5f5f7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 1100;
        border: none;
        color: #86868b;
    }

    .modal-grid {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 40px;
        padding: 40px;
    }

    .modal-left-col {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .main-product-img {
        width: 100%;
        max-height: 380px;
        object-fit: contain;
    }

    .carousel-dots {
        display: flex;
        gap: 8px;
        margin-top: 20px;
        margin-bottom: 30px;
    }

    .dot {
        width: 6px;
        height: 6px;
        background: #d2d2d7;
        border-radius: 50%;
    }

    .dot.active { background: #86868b; }

    .spec-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .spec-item {
        display: flex;
        gap: 20px;
        margin-bottom: 24px;
        align-items: flex-start;
    }

    .spec-icon {
        width: 32px;
        height: 32px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .spec-icon i { font-size: 24px; color: #1d1d1f; }
    .spec-icon img { width: 100%; height: 100%; object-fit: contain; }

    .spec-content {
        font-size: 14px;
        line-height: 1.4;
        color: #1d1d1f;
    }

    .spec-title {
        font-weight: 600;
        display: block;
        margin-bottom: 4px;
    }

    .modal-apple-footer {
        background: #f5f5f7;
        padding: 24px 40px;
        display: grid;
        grid-template-columns: 1fr 1fr 1.5fr;
        gap: 30px;
    }

    .footer-item {
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .footer-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        color: #1d1d1f;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .footer-text {
        font-size: 11px;
        color: #1d1d1f;
        line-height: 1.3;
    }

    .footer-link {
        color: #06c;
        text-decoration: none;
    }

    .buy-pill-btn {
        background: #0071e3;
        color: white;
        border: none;
        border-radius: 18px;
        padding: 8px 18px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
    }

    .explore-more-link {
        color: #06c;
        text-decoration: none;
        font-size: 14px;
        display: block;
        margin-top: 20px;
    }
    
    .price-subtext {
        font-size: 12px;
        color: #86868b;
        margin-bottom: 20px;
    }

    .color-options-row {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
</style>

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

    function confirmDelete(id) {
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
            window.location.href = "{{ route('delete-product') }}?id=" + id;
        }
    }
    
    function loadSeriesModal(products) {
        if (!products || products.length === 0) return;
        
        let topTabsHtml = '';
        let contentHtml = '';
        
        products.forEach((product, index) => {
            // Determine the correct image URL
            let finalImageUrl = product.image_url;
            if (!finalImageUrl.startsWith('http') && !finalImageUrl.startsWith('/')) {
                finalImageUrl = '/' + finalImageUrl;
            }

            let activeClass = index === 0 ? 'active' : '';
            let showClass = index === 0 ? 'show active' : '';
            let tabId = 'product_tab_' + product.id;
            
            // Generate top modal tabs
            topTabsHtml += `
                <button class="pill-tab ${activeClass}" data-bs-toggle="tab" data-bs-target="#${tabId}" type="button" role="tab">${product.name}</button>
            `;
            
            let priceVal = parseInt(product.price.replace(/[^0-9]/g, '')) || 0;
            let priceFormatted = new Intl.NumberFormat('vi-VN').format(priceVal) + 'đ';
            let colors = product.colors ? product.colors.split(',') : [];
            let colorsHtml = colors.map((c, i) => `<div class="color-option" style="background: ${c.trim()}; width: 12px; height: 12px; border-radius: 50%; border: 1px solid #d2d2d7;"></div>`).join('');

            // Spec list logic (using placeholders for icons)
            let specsHtml = `
                <div class="spec-item">
                    <div class="spec-icon"><i class="bi bi-display"></i></div>
                    <div class="spec-content">
                        <span class="spec-title">Màn hình 6,3 inch với ProMotion lên đến 120Hz.</span>
                        Mặt trước Ceramic Shield 2 cho khả năng chống trầy xước tốt hơn gấp 3 lần. Thiết kế nguyên khối nhôm rèn.
                    </div>
                </div>
                <div class="spec-item">
                    <div class="spec-icon"><i class="bi bi-camera"></i></div>
                    <div class="spec-content">
                        <span class="spec-title">Hệ thống camera pro.</span>
                        Chụp cận hơn nữa với thu phóng chất lượng quang học 8x và camera sau 48MP.
                    </div>
                </div>
                <div class="spec-item">
                    <div class="spec-icon"><i class="bi bi-cpu"></i></div>
                    <div class="spec-content">
                        <span class="spec-title">Camera trước 18MP Center Stage.</span>
                        Nhiều cách linh hoạt để căn chỉnh khung hình. Chụp selfie nhóm thông minh hơn, video Ghi Hình Kép để quay đồng thời cả phía trước và phía sau, và hơn thế nữa.
                    </div>
                </div>
                <div class="spec-item">
                    <div class="spec-icon"><i class="bi bi-cpu"></i></div>
                    <div class="spec-content">
                        <span class="spec-title">Chip A19 Pro với GPU 6 lõi.</span>
                        Tản nhiệt hơi nước. Nhanh thần tốc.
                    </div>
                </div>
                <div class="spec-item">
                    <div class="spec-icon"><i class="bi bi-battery-full"></i></div>
                    <div class="spec-content">
                        <span class="spec-title">Thời lượng pin đột phá.</span>
                        Thời gian xem video lên đến 31 giờ.
                    </div>
                </div>
            `;

            contentHtml += `
                <div class="tab-pane fade ${showClass}" id="${tabId}">
                    <div class="modal-grid">
                        <div class="modal-left-col">
                            <img class="main-product-img" src="${finalImageUrl}" alt="${product.name}">
                            <div class="carousel-dots">
                                <div class="dot active"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                            </div>
                            <p style="font-size: 12px; color: #86868b; margin-bottom: 8px;">Có ${colors.length} màu</p>
                            <div class="color-options-row">
                                ${colorsHtml}
                            </div>
                        </div>
                        <div class="modal-right-col">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                                <div style="flex: 1;">
                                    <h2 style="font-size: 32px; font-weight: 600; margin: 0;">${product.name}</h2>
                                    <div class="price-subtext" style="margin-top: 5px;">Từ ${priceFormatted} hoặc 1.425.000đ/tháng trong 24 tháng</div>
                                </div>
                                <button class="buy-pill-btn" onclick="location.href='/order?series=${encodeURIComponent(product.series)}'">Mua</button>
                            </div>
                            
                            <div class="spec-list" style="margin-top: 20px;">
                                ${specsHtml}
                            </div>

                            <a href="#" class="explore-more-link">Khám phá thêm về ${product.name} ></a>
                        </div>
                    </div>
                </div>
            `;
        });
        
        const topSeriesContainer = document.getElementById('topSeriesTabs');
        if (topSeriesContainer) {
            topSeriesContainer.innerHTML = topTabsHtml;
        }
        document.getElementById('productTabContent').innerHTML = contentHtml;
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
        @php
            $role = session('role', '');
        @endphp
        @if ($role === 'admin')
            <div class="admin-actions">
                <button class="add-product-btn" onclick="location.href='{{ route('add-product') }}'">Thêm sản phẩm</button>
            </div>
        @endif
        
    </div>
    <section class="product-section" style="padding-right: 20px;">
        @foreach($groupedProducts as $series => $products)
            @php
                $firstProduct = $products->first();
                $seriesTitle = $firstProduct->series_title ?? $firstProduct->name;
                $seriesImage = $firstProduct->series_image ?? $firstProduct->image_url;
                
                // Find minimum price in the group
                $minPrice = $products->min('numeric_price');
                $maxPrice = $products->max('numeric_price');
                if ($minPrice == $maxPrice) {
                    $priceFormatted = "Từ " . number_format($minPrice, 0, ',', '.') . "đ";
                } else {
                    $priceFormatted = "Từ " . number_format($minPrice, 0, ',', '.') . "đ đến " . number_format($maxPrice, 0, ',', '.') . "đ";
                }
            @endphp
            
            <div class="product-card">
                <h3>{!! str_replace('&', '& <br>', $seriesTitle) !!}</h3>
                <button class="explore-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#productModal"
                        onclick='loadSeriesModal(@json($products))'>
                    Hãy khám phá thiết bị
                </button>
                <img src="{{ asset($seriesImage) }}" alt="{{ $seriesTitle }}" style="object-fit: contain;">
                
                <div class="color-options">
                    @php $allColors = explode(',', $firstProduct->colors); @endphp
                    @foreach($allColors as $index => $color)
                        <span class="color {{ $index === 0 ? 'active' : '' }}" style="background-color: {{ trim($color) }};"></span>
                    @endforeach
                </div>
                
                <div class="price-container">
                    <p>{{ $priceFormatted }} hoặc {{ number_format($minPrice / 24, 0, ',', '.') }}đ/tháng <br> trong 24 tháng*</p>
                    <button class="buy-btn" onclick="window.location.href='{{ route('order', ['series' => $series]) }}'">Mua</button>
                </div>

                @if (session('role') === 'admin')
                    <div class="mt-2">
                        <button class="btn btn-sm btn-outline-primary" style="font-size: 10px;" onclick="window.location.href='{{ route('edit-product', ['id' => $firstProduct->id]) }}'">Sửa Nhóm</button>
                    </div>
                @endif
            </div>
        @endforeach
    </section>
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

{{-- Product Discovery Modal --}}
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="background: transparent !important; border: none !important;">
            <!-- Top Series Pills (outside main white card) -->
            <div class="top-series-tabs" id="topSeriesTabs" role="tablist">
                <!-- Javascript will render series pills here -->
            </div>

            <div class="modal-content-wrapper">
                <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>

                <div class="modal-body p-0">
                    <div class="tab-content" id="productTabContent" style="padding-top: 30px;">
                        <!-- Javascript will render content here -->
                    </div>
                </div>

                <!-- Modal Footer Bar -->
                <div class="modal-apple-footer">
                    <div class="footer-item">
                        <div class="footer-icon"><i class="bi bi-credit-card"></i></div>
                        <div class="footer-text">
                            <strong>Tài Chính</strong><br>
                            Các cách trả góp tuyệt vời, bao gồm lựa chọn lãi suất 0%.*
                        </div>
                    </div>
                    <div class="footer-item">
                        <div class="footer-icon"><i class="bi bi-arrow-repeat"></i></div>
                        <div class="footer-text">
                            <strong>Apple Trade In</strong><br>
                            Đổi thiết bị đủ điều kiện của bạn lấy điểm tín dụng cho lần mua hàng tiếp theo.<sup>1</sup>
                        </div>
                    </div>
                    <div class="footer-item">
                        <div class="footer-icon"><i class="bi bi-truck"></i></div>
                        <div class="footer-text">
                            <strong>Giao hàng miễn phí ngày làm việc tiếp theo</strong><br>
                            Chỉ khả dụng tại Thành Phố Hồ Chí Minh đối với một số sản phẩm Apple có sẵn nhất định được đặt hàng trước 15:00.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Icons CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endsection

