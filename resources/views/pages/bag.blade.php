@extends('layouts.app', ['pageTitle' => 'Giỏ hàng - Apple (VN)'])

@section('content')

<style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        background-color: #ffffff;
        color: #1d1d1f;
        margin: 0;
        padding: 0;
    }

    .bag-container {
        max-width: 980px;
        margin: 0 auto;
        padding: 40px 20px 80px 20px;
    }

    /* Tabs */
    .bag-nav {
        display: flex;
        gap: 30px;
        margin-bottom: 40px;
        border-bottom: 1px solid #d2d2d7;
        padding-bottom: 10px;
    }
    .tab-btn {
        background: none;
        border: none;
        font-size: 24px;
        font-weight: 600;
        color: #86868b;
        cursor: pointer;
        padding: 0;
        transition: color 0.3s ease;
    }
    .tab-btn.active {
        color: #1d1d1f;
    }
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
    }

    /* Header */
    .bag-header {
        text-align: center;
        margin-bottom: 40px;
        padding-top: 20px;
    }
    .bag-header-notice {
        font-size: 14px;
        color: #1d1d1f;
        margin-bottom: 40px;
    }
    .bag-header h1 {
        font-size: 40px;
        font-weight: 600;
        letter-spacing: -0.01em;
        margin: 0 0 16px 0;
    }
    .bag-header-shipping {
        font-size: 17px;
        color: #1d1d1f;
        margin-bottom: 30px;
    }
    .btn-checkout {
        background-color: #0071e3;
        color: white;
        border: none;
        border-radius: 15px;
        padding: 12px 24px;
        font-size: 17px;
        font-weight: 400;
        min-width: 280px;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .btn-checkout:hover {
        background-color: #0077ed;
    }
    .btn-checkout:disabled {
        background-color: #0071e3;
        opacity: 0.5;
        cursor: default;
    }

    /* Item List */
    .bag-items {
        border-top: 1px solid #d2d2d7;
        margin-bottom: 40px;
    }
    .bag-item {
        display: flex;
        padding: 40px 0;
        border-bottom: 1px solid #d2d2d7;
        align-items: flex-start;
    }
    .item-image {
        flex: 0 0 250px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }
    .item-image img {
        width: 200px;
        height: 200px;
        object-fit: contain;
    }
    .item-details {
        flex: 1;
        padding-left: 20px;
    }
    
    /* Row 1: Name, Select, Price */
    .item-row-1 {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }
    .item-title {
        font-size: 24px;
        font-weight: 600;
        line-height: 1.16667;
        flex: 1;
        padding-right: 20px;
    }
    .item-quantity {
        flex: 0 0 70px;
    }
    .qty-select {
        font-size: 24px;
        font-weight: 600;
        border: none;
        background: transparent;
        cursor: pointer;
        color: #1d1d1f;
        appearance: none;
        -webkit-appearance: none;
        padding-right: 20px;
        background-image: url('data:image/svg+xml;utf8,<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6 6L11 1" stroke="%231d1d1f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>');
        background-repeat: no-repeat;
        background-position: right center;
    }
    .qty-select:focus {
        outline: none;
    }
    .item-price {
        font-size: 24px;
        font-weight: 600;
        flex: 0 0 160px;
        text-align: right;
    }

    /* Row 2: Installment */
    .item-row-2 {
        display: flex;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    .item-installment-text {
        font-size: 12px;
        color: #1d1d1f;
        max-width: 350px;
        line-height: 1.5;
    }
    .item-installment-price {
        font-size: 12px;
        color: #1d1d1f;
        text-align: right;
    }

    /* Row 3: Remove */
    .item-row-3 {
        text-align: right;
        margin-bottom: 40px;
    }
    .btn-remove {
        background: none;
        border: none;
        color: #0071e3;
        font-size: 17px;
        cursor: pointer;
        padding: 0;
    }
    .btn-remove:hover {
        text-decoration: underline;
    }

    /* Service Block (AppleCare) */
    .service-block {
        border-top: 1px solid #d2d2d7;
        padding-top: 20px;
        margin-top: 20px;
    }
    .service-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }
    .service-title {
        font-size: 14px;
        font-weight: 600;
    }
    .service-title-icon {
        color: #e30000;
        font-weight: bold;
        margin-right: 5px;
    }
    .btn-add-service {
        background: none;
        border: none;
        color: #0071e3;
        font-size: 14px;
        cursor: pointer;
        padding: 0;
    }
    .btn-add-service:hover {
        text-decoration: underline;
    }
    .service-details {
        font-size: 12px;
        color: #1d1d1f;
        padding-left: 15px;
        margin: 0 0 8px 0;
    }
    .service-details li {
        margin-bottom: 4px;
    }
    .service-link {
        font-size: 12px;
        color: #0071e3;
        text-decoration: none;
    }

    /* Delivery Block */
    .delivery-block {
        margin-top: 30px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    .delivery-icon {
        font-size: 20px;
    }
    .delivery-text {
        font-size: 14px;
        line-height: 1.4;
    }
    .delivery-link {
        color: #0071e3;
        text-decoration: none;
    }

    /* Summary */
    .bag-summary-container {
        display: flex;
        justify-content: flex-end;
        padding-top: 20px;
        padding-bottom: 40px;
    }
    .bag-summary {
        width: 100%;
        max-width: 700px;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 17px;
        margin-bottom: 16px;
    }
    .summary-row.total-row {
        font-size: 32px;
        font-weight: 600;
        border-top: 1px solid #d2d2d7;
        padding-top: 24px;
        margin-top: 16px;
    }
    .summary-row.installment-row {
        font-size: 28px;
        font-weight: 500;
        margin-top: 24px;
        align-items: flex-start;
    }
    .summary-installment-desc {
        font-size: 14px;
        color: #86868b;
        font-weight: 400;
        margin-top: 4px;
    }
    .summary-tax-row {
        text-align: right;
        font-size: 13px;
        color: #1d1d1f;
        margin-top: 24px;
        line-height: 1.6;
    }
    .summary-checkout-row {
        text-align: end;
        margin-top: 40px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 0;
    }
    .empty-state h1 {
        font-size: 40px;
        font-weight: 600;
        margin-bottom: 20px;
    }
    .empty-state p {
        font-size: 17px;
        color: #1d1d1f;
        margin-bottom: 40px;
    }

    /* Orders styles from old template */
    .order-status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 13px;
        font-weight: 600;
        text-transform: capitalize;
    }
    .status-pending { background: #fff4e5; color: #b25e09; }
    .status-paid { background: #e5f9e7; color: #1e7e34; }
    .status-failed { background: #ffe5e5; color: #d32f2f; }
    .old-order-item {
        display: flex;
        align-items: center;
        border: 1px solid #f5f5f7;
        background: #fafafa11;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        text-align: left;   
    }
    .old-order-item img {
        width: 150px;
        height: 100px;
        margin-right: 20px;
        border-radius: 5px;
        object-fit: contain;
        filter: grayscale(0.2);
    }
    .old-order-details { flex: 1; }
</style>

<div class="bag-container">
    @if (!session()->has('email'))
        <div class="empty-state">
            <h1>Giỏ hàng của bạn đang trống.</h1>
            <p>Đăng nhập để xem bạn có sản phẩm nào đã lưu hay không. Hoặc tiếp tục mua sắm.</p>
            <div style="display: flex; gap: 15px; justify-content: center; margin-top: 20px;">
                <button class="btn-checkout" style="min-width: 200px;" onclick="location.href='{{ route('login') }}'">Đăng Nhập</button>
                <button class="btn-checkout" style="min-width: 200px; background: white; color: #0071e3; border: 1px solid #0071e3;" onclick="location.href='{{ route('mua-iphone') }}'">Tiếp tục Mua sắm</button>
            </div>
        </div>
    @else
        <div class="bag-nav">
            <button class="tab-btn active" onclick="switchTab('bag-tab')">Xem lại giỏ hàng.</button>
            <button class="tab-btn" onclick="switchTab('orders-tab')">Đơn hàng của bạn.</button>
        </div>

        <!-- Bag Tab Content -->
        <div id="bag-tab" class="tab-content active">
            @if ($cartItems->count() > 0)
                @php 
                    $totalAmount = 0; 
                    foreach ($cartItems as $i) {
                        $pVal = floatval(str_replace(['$', ','], '', $i->price));
                        $totalAmount += $pVal * $i->quantity;
                    }
                    $downPayment = round($totalAmount * 0.20);
                    $monthly = round($totalAmount / 24);
                    $tax = round($totalAmount * 8 / 108);
                @endphp

                <div class="bag-header">
                    <div class="bag-header-notice">Xin lưu ý rằng chúng tôi không chấp nhận đổi trả đối với các đơn hàng trực tuyến.</div>
                    <h1>Tổng giá trị giỏ hàng của bạn là {{ number_format($totalAmount, 0, ',', '.') }}đ.</h1>
                    <div class="bag-header-shipping">Vận chuyển miễn phí đối với mọi đơn hàng.</div>
                    <button class="btn-checkout" onclick="location.href='{{ route('checkout') }}'">Thanh Toán</button>
                </div>

                <div class="bag-items">
                    @foreach ($cartItems as $item)
                        @php 
                            $priceVal = floatval(str_replace(['$', ','], '', $item->price));
                            $itemTotal = $priceVal * $item->quantity;
                            $itemMonthly = round($itemTotal / 24);
                        @endphp
                        <div class="bag-item" id="cart-item-{{ $item->id }}">
                            <div class="item-image">
                                <img src="{{ asset($item->image_url) }}" alt="{{ $item->product_name }}">
                            </div>
                            <div class="item-details">
                                <div class="item-row-1">
                                    <div class="item-title">{{ $item->product_name }} {{ $item->storage }} {{ $item->color }}</div>
                                    <div class="item-quantity">
                                        <select class="qty-select" onchange="updateQty({{ $item->id }}, this.value)">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="item-price">{{ number_format($itemTotal, 0, ',', '.') }}đ</div>
                                </div>
                                <div class="item-row-2">
                                    <div class="item-installment-text">Thanh toán phí dịch vụ 1.67% trong 24 tháng sau khi thanh toán lần đầu 20% là {{ number_format($downPayment, 0, ',', '.') }}đ.</div>
                                    <div class="item-installment-price">{{ number_format($itemMonthly, 0, ',', '.') }}đ/tháng*</div>
                                </div>
                                <div class="item-row-3">
                                    <button class="btn-remove" onclick="removeItem({{ $item->id }})">Xóa</button>
                                </div>

                                {{-- AppleCare+ Display based on selection --}}
                                <div class="service-block">
                                    @if($item->applecare)
                                        <div class="service-header">
                                            <div class="service-title" style="display: flex; align-items: center; color: #1d7c34;">
                                                <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/APPLECARE-plus_ICON?wid=800&hei=800&fmt=jpeg&qlt=90&fit=constrain&.v=NCtyMU9JdVpIVnJwaHNhN0RoQytrbHBLMzlLdW0zb1ZjUGpUUE1kYUlMY2ZKN0k1QXkvZmhaRGFteVRZTU9MajltL1NSWVF4eU0yK0ozVG10L3E2d25iMjF4RmlZZXZVcEFBNVZkS1k0VUY4bzhjYTlKRDBSTFZ3YzlieG9MeSs" alt="AppleCare+" style="width: 18px; height: 18px; margin-right: 8px;">
                                                ✓ AppleCare+ đã được thêm — 5.499.000đ
                                            </div>
                                        </div>
                                        <ul class="service-details">
                                            <li>Nay đã có dịch vụ sửa chữa không hạn chế cho trường hợp hư hỏng do sự cố bất ngờ.</li>
                                            <li>Dịch vụ sửa chữa được Apple chứng nhận sử dụng linh kiện Apple chính hãng</li>
                                            <li>Dịch Vụ Thay Thế Cấp Tốc không áp dụng cho trường hợp vượt quá phí thay màn hình hoặc hỏng kính mặt sau</li>
                                            <li>Ưu tiên tiếp cận các chuyên gia Apple</li>
                                        </ul>
                                        <a href="#" class="service-link">Tìm hiểu thêm ⊕</a>
                                    @else
                                        <div class="service-header">
                                            <div class="service-title" style="display: flex; align-items: center;">
                                                <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/APPLECARE-plus_ICON?wid=800&hei=800&fmt=jpeg&qlt=90&fit=constrain&.v=NCtyMU9JdVpIVnJwaHNhN0RoQytrbHBLMzlLdW0zb1ZjUGpUUE1kYUlMY2ZKN0k1QXkvZmhaRGFteVRZTU9MajltL1NSWVF4eU0yK0ozVG10L3E2d25iMjF4RmlZZXZVcEFBNVZkS1k0VUY4bzhjYTlKRDBSTFZ3YzlieG9MeSs" alt="AppleCare+" style="width: 18px; height: 18px; margin-right: 8px;">
                                                Thêm AppleCare+ cho {{ $item->product_name }} cho mức giá 5.499.000đ
                                            </div>
                                            <button class="btn-add-service">Thêm</button>
                                        </div>
                                        <ul class="service-details">
                                            <li>Nay đã có dịch vụ sửa chữa không hạn chế cho trường hợp hư hỏng do sự cố bất ngờ.</li>
                                            <li>Dịch vụ sửa chữa được Apple chứng nhận sử dụng linh kiện Apple chính hãng</li>
                                            <li>Dịch Vụ Thay Thế Cấp Tốc không áp dụng cho trường hợp vượt quá phí thay màn hình hoặc hỏng kính mặt sau</li>
                                            <li>Ưu tiên tiếp cận các chuyên gia Apple</li>
                                        </ul>
                                        <a href="#" class="service-link">Tìm hiểu thêm ⊕</a>
                                    @endif
                                </div>

                                {{-- Delivery Info --}}
                                <div class="delivery-block">
                                    <div class="delivery-icon" style="font-size: 24px;">🚚</div>
                                    <div class="delivery-text">
                                        <strong>3-5 ngày làm việc</strong><br>
                                        Tùy chọn giao hàng cho: <a href="#" class="delivery-link">Chọn Địa Điểm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination if needed --}}
                @if($cartItems->hasPages())
                <div class="pagination-wrapper mt-4 mb-4" style="text-align: center;">
                    {{ $cartItems->appends(['tab' => 'bag', 'order_page' => request('order_page')])->links() }}
                </div>
                @endif

                {{-- Summary Section --}}
                <div class="bag-summary-container">
                    <div class="bag-summary">
                        <div class="summary-row">
                            <span>Tổng phụ</span>
                            <span>{{ number_format($totalAmount, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="summary-row">
                            <span>Vận chuyển</span>
                            <span>MIỄN PHÍ</span>
                        </div>
                        
                        <div class="summary-row total-row">
                            <span>Thanh toán toàn bộ</span>
                            <span>{{ number_format($totalAmount, 0, ',', '.') }}đ</span>
                        </div>
                        
                        <div style="font-size: 17px; margin-top: 20px;">hoặc</div>
                        
                        <div class="summary-row installment-row">
                            <div>
                                Thanh Toán Hàng Tháng
                                <div class="summary-installment-desc">Thanh toán phí dịch vụ thực 1.67% cho 24 tháng</div>
                            </div>
                            <span>{{ number_format($monthly, 0, ',', '.') }}đ/tháng*</span>
                        </div>
                        
                        <div class="summary-tax-row">
                            <strong>Số tiền trả trước cần thanh toán hôm nay: {{ number_format($downPayment, 0, ',', '.') }}đ</strong><br>
                            Bao gồm thuế GTGT {{ number_format($tax, 0, ',', '.') }}đ<br>
                            <a href="#" class="delivery-link" style="font-size: 14px;">Khám phá thêm các lựa chọn trả góp hàng tháng ></a>
                        </div>
                        
                        <div class="summary-checkout-row">
                            <button class="btn-checkout" style="width: 45%; padding: 16px; font-size: 17px; " onclick="location.href='{{ route('checkout') }}'">Thanh Toán</button>
                        </div>
                    </div>
                </div>

            @else
                <div class="empty-state">
                    <h1>Giỏ hàng của bạn đang trống.</h1>
                    <p>Tiếp tục mua sắm để tìm sản phẩm yêu thích tiếp theo của bạn.</p>
                    <button class="btn-checkout" style="min-width: 200px;" onclick="location.href='{{ route('mua-iphone') }}'">Tiếp tục Mua sắm</button>
                </div>
            @endif
        </div>

        <!-- Orders Tab Content -->
        <div id="orders-tab" class="tab-content">
            <div class="bag-header" style="text-align: left; margin-bottom: 20px; padding-top: 0;">
                <h2 style="font-size: 32px; font-weight: 600;">Quản lý và theo dõi các đơn hàng gần đây.</h2>
            </div>
            
            @if ($orders->count() > 0)
                <div class="bag-items" style="border-top: none;">
                    @foreach ($orders as $order)
                        @if($order->items)
                            <div class="order-block" style="padding-bottom: 40px; margin-bottom: 40px; border-bottom: 1px solid #d2d2d7;">
                                <div style="font-size: 14px; color: #86868b; margin-bottom: 20px; display: flex; justify-content: space-between;">
                                    <div>Mã đơn: <span style="color: #1d1d1f; font-weight: 500;">#{{ $order->id_order }}</span> &nbsp;|&nbsp; Ngày đặt: {{ $order->created_at->format('d/m/Y') }}</div>
                                    <div>Thanh toán: {{ $order->payment_method }}</div>
                                </div>
                                
                                <div class="order-items-list" style="padding: 0 10px;">
                                    @foreach($order->items as $item)
                                        <div class="bag-item" style="border-bottom: none; padding: 15px 0;">
                                            <div class="item-image" style="flex: 0 0 120px;">
                                                <img src="{{ asset($item['image_url']) }}" alt="Order Image" style="width: 100px; height: 100px; object-fit: contain; filter: none;">
                                            </div>
                                            <div class="item-details" style="display: flex; justify-content: space-between; align-items: center; padding-left: 20px;">
                                                <div style="flex: 1; padding-right: 20px;">
                                                    <div class="item-title" style="font-size: 18px; font-weight: 600; margin-bottom: 4px;">{{ $item['product_name'] }} <span style="font-size: 14px; font-weight: normal; color: #86868b;">(x{{ $item['quantity'] ?? 1 }})</span></div>
                                                    <div style="font-size: 14px; color: #1d1d1f; margin-bottom: 2px;">{{ $item['storage'] }} | {{ $item['color'] }}</div>
                                                    <div style="font-size: 14px; color: #86868b;">Bảo hành: 
                                                    @if(!empty($item['applecare']) && $item['applecare'])
                                                        <span style="color: #1e7e34; font-weight: 500;">✓ AppleCare+</span>
                                                    @else
                                                        Không có AppleCare
                                                    @endif
                                                </div>
                                                </div>
                                                <div style="text-align: right;">
                                                    <div style="font-size: 18px; font-weight: 500;">
                                                        {{ number_format(floatval(str_replace(['$', ',', 'đ', '.'], '', $item['price'])), 0, ',', '.') }}đ
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding: 20px 10px 0 10px;">
                                    <span class="order-status-badge status-{{ strtolower($order->status) }}" style="font-size: 13px; padding: 8px 16px;">{{ $order->status }}</span>
                                    <div style="font-size: 24px; font-weight: 600;">
                                        Tổng cộng: 
                                        @if(is_numeric(str_replace(['$', ',', 'đ', '.'], '', $order->price)))
                                            <span>{{ number_format(floatval(str_replace(['$', ',', 'đ', '.'], '', $order->price)), 0, ',', '.') }}đ</span>
                                        @else
                                            <span>{{ $order->price }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Legacy Support - same layout as multi-item orders --}}
                            <div class="order-block" style="padding-bottom: 40px; margin-bottom: 40px; border-bottom: 1px solid #d2d2d7;">
                                <div style="font-size: 14px; color: #86868b; margin-bottom: 20px; display: flex; justify-content: space-between;">
                                    <div>Mã đơn: <span style="color: #1d1d1f; font-weight: 500;">#{{ $order->id_order }}</span> &nbsp;|&nbsp; Ngày đặt: {{ $order->created_at->format('d/m/Y') }}</div>
                                    <div>Thanh toán: {{ $order->payment_method }}</div>
                                </div>

                                <div class="order-items-list" style="padding: 0 10px;">
                                    <div class="bag-item" style="border-bottom: none; padding: 15px 0;">
                                        <div class="item-image" style="flex: 0 0 120px;">
                                            <img src="{{ asset($order->image_url) }}" alt="Order Image" style="width: 100px; height: 100px; object-fit: contain; filter: none;">
                                        </div>
                                        <div class="item-details" style="display: flex; justify-content: space-between; align-items: center; padding-left: 20px;">
                                            <div style="flex: 1; padding-right: 20px;">
                                                <div class="item-title" style="font-size: 18px; font-weight: 600; margin-bottom: 4px;">{{ $order->product }}</div>
                                                <div style="font-size: 14px; color: #1d1d1f; margin-bottom: 2px;">{{ $order->storage }} | {{ $order->color }}</div>
                                                <div style="font-size: 14px; color: #86868b;">Bảo hành: Không có AppleCare</div>
                                            </div>
                                            <div style="text-align: right;">
                                                <div style="font-size: 18px; font-weight: 500;">
                                                    @if(is_numeric(str_replace(['$', ',', 'đ', '.'], '', $order->price)))
                                                        {{ number_format(floatval(str_replace(['$', ',', 'đ', '.'], '', $order->price)), 0, ',', '.') }}đ
                                                    @else
                                                        {{ $order->price }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding: 20px 10px 0 10px;">
                                    <span class="order-status-badge status-{{ strtolower($order->status) }}" style="font-size: 13px; padding: 8px 16px;">{{ $order->status }}</span>
                                    <div style="font-size: 24px; font-weight: 600;">
                                        Tổng cộng:
                                        @if(is_numeric(str_replace(['$', ',', 'đ', '.'], '', $order->price)))
                                            <span>{{ number_format(floatval(str_replace(['$', ',', 'đ', '.'], '', $order->price)), 0, ',', '.') }}đ</span>
                                        @else
                                            <span>{{ $order->price }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="pagination-wrapper mt-4 mb-4" style="text-align: center;">
                    {{ $orders->appends(['tab' => 'orders', 'bag_page' => request('bag_page')])->links() }}
                </div>
            @else
                <div class="empty-state">
                    <h1>Không tìm thấy đơn hàng nào.</h1>
                    <p>Sau khi bạn thanh toán, đơn hàng sẽ xuất hiện tại đây.</p>
                </div>
            @endif
        </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        
        document.getElementById(tabId).classList.add('active');
        
        const btnText = tabId === 'bag-tab' ? 'Xem lại giỏ hàng.' : 'Đơn hàng của bạn.';
        document.querySelectorAll('.tab-btn').forEach(btn => {
            if(btn.innerText === btnText) btn.classList.add('active');
        });

        const url = new URL(window.location);
        url.searchParams.set('tab', tabId === 'bag-tab' ? 'bag' : 'orders');
        window.history.pushState({}, '', url);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab');
        if(tab === 'orders') {
            switchTab('orders-tab');
        }
    });

    async function updateQty(id, newQty) {
        if (newQty < 1) return;
        
        try {
            const response = await fetch('{{ route('cart-update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ id: id, quantity: newQty })
            });

            if (response.ok) {
                location.reload(); 
            }
        } catch (error) {
            console.error("Update failed", error);
        }
    }

    async function removeItem(id) {
        const res = await Swal.fire({
            title: 'Bỏ khỏi giỏ hàng?',
            text: "Bạn có chắc chắn muốn xóa sản phẩm này?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy',
            customClass: {
                popup: 'apple-alert-popup',
                confirmButton: 'apple-alert-confirm',
                cancelButton: 'apple-alert-cancel'
            }
        });

        if (res.isConfirmed) {
            try {
                const response = await fetch('{{ route('cart-remove') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ id: id })
                });

                if (response.ok) {
                    location.reload();
                }
            } catch (error) {
                console.error("Remove failed", error);
            }
        }
    }
</script>

<style>
    .apple-alert-popup { border-radius: 20px !important; padding: 20px !important; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important; }
    .apple-alert-confirm { border-radius: 12px !important; padding: 10px 24px !important; font-weight: 600 !important; background-color: #0071e3 !important; }
    .apple-alert-cancel { border-radius: 12px !important; padding: 10px 24px !important; font-weight: 600 !important; color: #1d1d1f !important; }
</style>
@endpush

@endsection
