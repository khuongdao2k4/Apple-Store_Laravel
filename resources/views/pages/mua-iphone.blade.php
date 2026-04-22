@extends('layouts.app', ['pageTitle' => 'mua-iphone.php'])

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
        
        let tabsHtml = '';
        let contentHtml = '';
        
        products.forEach((product, index) => {
            let activeClass = index === 0 ? 'active' : '';
            let showClass = index === 0 ? 'show active' : '';
            let tabId = 'product_tab_' + product.id;
            
            tabsHtml += `
                <li class="nav-item">
                    <a style="font-size:14px" class="nav-link ${activeClass}" data-bs-toggle="tab" href="#${tabId}">${product.name}</a>
                </li>
            `;
            
            let colors = product.colors ? product.colors.split(',') : [];
            let colorsHtml = colors.map((c, i) => `<div class="color-option" style="background: ${c.trim()};" onclick="setColor(${i})"></div>`).join('');
            
            let priceVal = parseInt(product.price.replace(/[^0-9]/g, '')) || 0;
            let priceFormatted = new Intl.NumberFormat('vi-VN').format(priceVal) + 'đ';
            
            contentHtml += `
                <div class="tab-pane fade ${showClass}" id="${tabId}">
                    <div class="modal-layout-row">
                        <div class="modal-left" style="margin-top: 30px;">
                            <img id="product-img-${product.id}" class="product-image" src="/${product.image_url}" alt="${product.name}" style="object-fit: contain;">
                            <p style="text-align:center; padding-top:30px">Hiện có ${colors.length} màu</p>
                            <div class="color-options-modal">
                                ${colorsHtml}
                            </div>
                        </div>
                        <div class="modal-right">
                            <div class="price-container">
                                <h1 style="font-size: 34px; padding-top: 20px; padding-bottom:20px">${product.name}</h1>
                                <button style="border-radius: 30px;" class="buy-button" onclick="location.href='/order?series=${encodeURIComponent(product.series)}'">Mua ngay</button>
                            </div>
                            <p>Từ ${priceFormatted}</p>
                            <ul class="feature-list">
                                <li>Thiết kế cao cấp và màn hình sắc nét</li>
                                <hr>
                                <li>Hiệu năng mạnh mẽ với chip thế hệ mới</li>
                            </ul>
                        </div>
                    </div>
                </div>
            `;
        });
        
        document.getElementById('productTabs').innerHTML = tabsHtml;
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
                $minPrice = $products->min(function($p) {
                    $val = preg_replace('/[^0-9]/', '', $p->price);
                    return $val != '' ? (int)$val : 999999999;
                });
                $maxPrice = $products->max(function($p) {
                    $val = preg_replace('/[^0-9]/', '', $p->price);
                    return $val != '' ? (int)$val : 0;
                });
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
                        onclick="loadSeriesModal({{ htmlspecialchars(json_encode($products)) }})">
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
<div id="container2" class="container">
    <h1>Trang 2</h1>
    <p>Nội dung trang 2.</p>
</div>
<div id="container3" class="container">
    <h1>Trang 3</h1>
    <p>Nội dung tran        <div class="top-modal">
            <ul class="nav nav-tabs" id="productTabs">
                <!-- Javascript will render tabs here -->
            </ul>
        </div>
        <div class="modal-content main-modal-wrapper">
            <div class="modal-body p-0">
                <div class="tab-content" id="productTabContent">
                    <!-- Javascript will render content here -->
                </div>
            </div>
        </div>
                </div>
                <div class="modal-end">
                    <div class="offer">
                        <img class="icon"
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAclBMVEX///8PwwkAvwDV89SH2obo+Ofz/PKG24Tc89yZ4Jee4p1h0l8KwwCV35Tl+OW26bXZ9Nl92XvO8M33/vfC7cKk46M7yjhQzk4qxyZn02VVzlOL2ort+uyu5q1g0l9213RGzETI78dr02m36bYlxiFx1nCbN14MAAAER0lEQVR4nO3d6XbaMBAF4FrsILawxOwkgfd/xZrQc1rQCEZCY4/T+/13oovlRbI1/vULAAAAAAAAAAAAAAAAAAAAAAAAAKAys3b1ZjLR2vPmKs+MDlm+as7bKeNtF8viz1qbaVE0xZjlYpso3+RgjJ5wf1ljDt0E+bYDU3WUB8zg5f3Y05zvwvReytc+ag9YRDy+cM6ZZBqPv3s2m8QGnKs8wbismccGrLrpbHERG/UJWERshAds1aSLXlkTftVY1ilgEXEZGrBZpz56YZphAUd1C1hEHAUlfK9XH72w7yEB3+q3C4ud+Pazd2HYTux6dqGSEaKvGYY/lmrSf9jkq2mnetNV7rlW80+n1I9kzSDFcDON7oDKaC13+wnRSW0WchzLe6OGPexu2qd+nrCrjbwR1dH6zI1X7rYxd7bCiJGBXTG3zd2EU9HGxpm6CXPeljNiF2rroxfunaW1vNnirbsl87cpmdvXDG/Khrjr1thJqW7K7GvExWIo3NY4Gzchb06KOElxz8Llcq9qzFM+EqqBhF5IqAYSev2XCRfCbY2zSJfQrjdNfTZr9740eh/qmIG6Fz2MrdVDp1tIiIT6ISES6sdM+PHjE9by4eEVeikS6oeESKgfEvoT2qrXH5BSjoA325Y+W+LJDObarpBQDST0QkI1kNALCdVAQi8kVAMJvZBQDST0QkI1kNALCdVAQi8kVAMJvZBQjVISbnedz/3gzv6zs2sly+FXQsLR/rt8lCszZi+/GEw+4dfDB43mK2UainjC8ZMnqWacNI9LOqFvSfs//094abR0Qvct63t2nTbRPeGEnNogwktPhRMuOAllVzEIJzw/Dyi99lQ4IbGk3WH3iTPdEk74ydmH58SZbgknHHISyq4fFk7Iec82qCZOOOnrIVF54Y70Mn7phM9L8sUW++MSvy+dPrsvla5TID+2ODwqy2fNIWUaSgnjw5011Ojwwthdwiy0Usb44/WJ2oGntXw+zNM8gIRqIKEXEqqBhF5IqEbKhK/VrpfScxPyKmER84Qd4bbG6bgJedOXREU64andSETlD15Fujaxnki4rVFmxPos5jdoTu5vU8ZQIdTO7Wsn5qZunWRuycUyzdwCpuxaydRE4VGwrXGORCu5s5dkyYGgeuAleCfayJ69JA7hQv4h2uIwHznVRMM+lshnEtYse/NGt3qNeW9JzoGxi+x6p0Ktmm920XN8IfOzSktfPWYzfkDW4091wp7HKqmgH4Jfkf3bszdJFAp9uaVmn5mJ+NBM7T7DEv7eR836acwLWM8enqkS9yRP9YcPbxn+3cyNdV0imug5iEM9Ir7yLLZfg4+vWfPSXOfkpH03mlP09x3/GOqOaBK8lLQ9+0YrVStGc+c0nwRuD3N9IYt4+TDhd50nw/V17KnBd0vWw1ePP1erMV70e9XrL8aNMpZzAAAAAAAAAAAAAAAAAAAAAAT7DRjpbCW8ri8wAAAAAElFTkSuQmCC"
                            alt="Credit Card Icon">
                        <div class="content">
                            <div class="title">Apple Card Monthly Installments</div>
                            <div class="text">Pay over time, interest-free when you choose to check out with Apple
                                Card Monthly Installments.</div>
                        </div>
                    </div>

                    <div class="offer">
                        <img class="icon"
                            src="data:image/png;base64,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"
                            alt="Credit Card Icon">
                        <div class="content">
                            <div class="title">Trade in for credit</div>
                            <div class="text">Get credit toward your purchase when you trade in an eligible iPhone.
                            </div>
                        </div>
                    </div>

                    <div class="offer">
                        <img class="icon"
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAclBMVEX///8PwwkAvwDV89SH2obo+Ofz/PKG24Tc89yZ4Jee4p1h0l8KwwCV35Tl+OW26bXZ9Nl92XvO8M33/vfC7cKk46M7yjhQzk4qxyZn02VVzlOL2ort+uyu5q1g0l9213RGzETI78dr02m36bYlxiFx1nCbN14MAAAER0lEQVR4nO3d6XbaMBAF4FrsILawxOwkgfd/xZrQc1rQCEZCY4/T+/13oovlRbI1/vULAAAAAAAAAAAAAAAAAAAAAAAAAKAys3b1ZjLR2vPmKs+MDlm+as7bKeNtF8viz1qbaVE0xZjlYpso3+RgjJ5wf1ljDt0E+bYDU3WUB8zg5f3Y05zvwvReytc+ag9YRDy+cM6ZZBqPv3s2m8QGnKs8wbismccGrLrpbHERG/UJWERshAds1aSLXlkTftVY1ilgEXEZGrBZpz56YZphAUd1C1hEHAUlfK9XH72w7yEB3+q3C4ud+Pazd2HYTux6dqGSEaKvGYY/lmrSf9jkq2mnetNV7rlW80+n1I9kzSDFcDON7oDKaC13+wnRSW0WchzLe6OGPexu2qd+nrCrjbwR1dH6zI1X7rYxd7bCiJGBXTG3zd2EU9HGxpm6CXPeljNiF2rroxfunaW1vNnirbsl87cpmdvXDG/Khrjr1thJqW7K7GvExWIo3NY4Gzchb06KOElxz8Llcq9qzFM+EqqBhF5IqAYSev2XCRfCbY2zSJfQrjdNfTZr9740eh/qmIG6Fz2MrdVDp1tIiIT6ISES6sdM+PHjE9by4eEVeikS6oeESKgfEvoT2qrXH5BSjoA325Y+W+LJDObarpBQDST0QkI1kNALCdVAQi8kVAMJvZBQDST0QkI1kNALCdVAQi8kVAMJvZBQjVISbnedz/3gzv6zs2sly+FXQsLR/rt8lCszZi+/GEw+4dfDB43mK2UainjC8ZMnqWacNI9LOqFvSfs//094abR0Qvct63t2nTbRPeGEnNogwktPhRMuOAllVzEIJzw/Dyi99lQ4IbGk3WH3iTPdEk74ydmH58SZbgknHHISyq4fFk7Iec82qCZOOOnrIVF54Y70Mn7phM9L8sUW++MSvy+dPrsvla5TID+2ODwqy2fNIWUaSgnjw5011Ojwwthdwiy0Usb44/WJ2oGntXw+zNM8gIRqIKEXEqqBhF5IqEbKhK/VrpfScxPyKmER84Qd4bbG6bgJedOXREU64andSETlD15Fujaxnki4rVFmxPos5jdoTu5vU8ZQIdTO7Wsn5qZunWRuycUyzdwCpuxaydRE4VGwrXGORCu5s5dkyYGgeuAleCfayJ69JA7hQv4h2uIwHznVRMM+lshnEtYse/NGt3qNeW9JzoGxi+x6p0Ktmm920XN8IfOzSktfPWYzfkDW4091wp7HKqmgH4Jfkf3bszdJFAp9uaVmn5mJ+NBM7T7DEv7eR836acwLWM8enqkS9yRP9YcPbxn+3cyNdV0imug5iEM9Ir7yLLZfg4+vWfPSXOfkpH03mlP09x3/GOqOaBK8lLQ9+0YrVStGc+c0nwRuD3N9IYt4+TDhd50nw/V17KnBd0vWw1ePP1erMV70e9XrL8aNMpZzAAAAAAAAAAAAAAAAAAAAAAT7DRjpbCW8ri8wAAAAAElFTkSuQmCC"
                            alt="Credit Card Icon">
                        <div class="content">
                            <div class="title">Get a sweet carrier deal at Apple</div>
                            <div class="text">Save even more on your new iPhone when you finance with select carrier
                                deals.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection

