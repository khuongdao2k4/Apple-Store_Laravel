@extends('layouts.app', ['pageTitle' => 'Checkout'])

@section('content')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .checkout-container {
        max-width: 1000px;
        margin: 0px auto;
        padding: 40px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    .checkout-header {
        border-bottom: 1px solid #d2d2d7;
        padding-bottom: 20px;
        margin-bottom: 40px;
    }

    .checkout-header h1 {
        font-size: 40px;
        font-weight: 600;
        letter-spacing: -0.003em;
    }

    .checkout-content {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 60px;
    }

    .section-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 24px;
        color: #1d1d1f;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        color: #6e6e73;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        font-size: 17px;
        border: 1px solid #d2d2d7;
        border-radius: 12px;
        outline: none;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #0071e3;
    }

    .order-summary {
        background: #f5f5f7;
        padding: 30px;
        border-radius: 18px;
        position: sticky;
        top: 100px;
    }

    .product-info {
        display: flex;
        gap: 20px;
        margin-bottom: 24px;
    }

    .product-info img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        background-color: #ffffff;
        padding: 8px;
        border-radius: 12px;
        border: 1px solid #d2d2d7;
    }

    .product-details h3 {
        font-size: 17px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .product-details p {
        font-size: 14px;
        color: #6e6e73;
        margin: 0;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 17px;
    }

    .summary-total {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #d2d2d7;
        font-weight: 600;
        font-size: 21px;
    }

    .confirm-button {
        width: 100%;
        background-color: #0071e3;
        color: white;
        border: none;
        padding: 16px;
        font-size: 17px;
        font-weight: 600;
        border-radius: 12px;
        cursor: pointer;
        margin-top: 24px;
        transition: background-color 0.3s;
    }

    .confirm-button:hover {
        background-color: #0077ed;
    }

    .confirm-button:disabled {
        background-color: #a1a1a6;
        cursor: not-allowed;
    }

    .payment-methods {
        margin-top: 30px;
    }

    .payment-option {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        border: 1px solid #d2d2d7;
        border-radius: 12px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .payment-option.active {
        border-color: #0071e3;
        background-color: #f5faff;
    }

    .payment-option input {
        display: none;
    }

    .payment-icon {
        font-size: 24px;
        color: #0071e3;
    }
</style>

<div class="checkout-container">
    <div class="checkout-header">
        <h1>Xác nhận đơn hàng</h1>
    </div>

    <div class="checkout-content">
        <div class="delivery-section">
            <h2 class="section-title">Thông tin giao hàng</h2>
            <form id="checkout-form">
                @csrf
                <div class="form-group">
                    <label class="form-label">Họ và tên người nhận</label>
                    <input type="text" name="name" class="form-control" value="{{ session('user_name') }}" required>
                </div>

                <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label class="form-label">Số điện thoại</label>
                        <input type="tel" name="phone" class="form-control" placeholder="0xxx xxx xxx" required>
                    </div>
                    <div>
                        <label class="form-label">Email liên hệ</label>
                        <input type="email" name="email" class="form-control" value="{{ session('email') }}" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Địa chỉ nhận hàng</label>
                    <textarea name="address" class="form-control" rows="3" placeholder="Số nhà, tên đường, phường/xã, quận/huyện..." required></textarea>
                </div>

                <h2 class="section-title" style="margin-top: 40px;">Phương thức thanh toán</h2>
                <div class="payment-methods">
                    <label class="payment-option active">
                        <input type="radio" name="payment_method" value="COD" checked>
                        <i class="fa-solid fa-truck-fast payment-icon"></i>
                        <span>Thanh toán khi nhận hàng (COD)</span>
                    </label>
                    
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="VNPAY">
                        <i class="fa-solid fa-credit-card payment-icon"></i>
                        <span>Thanh toán qua VNPay</span>
                    </label>
                </div>
                <input type="hidden" name="is_direct_buy" value="{{ $isDirectBuy ? '1' : '0' }}">
            </form>
        </div>

        <div class="summary-section">
            <div class="order-summary">
                <h2 class="section-title" style="font-size: 20px;">Tóm tắt đơn hàng</h2>
                
                @php $totalPrice = 0; @endphp
                @foreach ($cartItems as $item)
                    @php 
                        $priceVal = floatval(str_replace(['$', ','], '', $item->price));
                        $totalPrice += $priceVal * $item->quantity;
                    @endphp
                    <div class="product-info" style="border-bottom: 1px solid #d2d2d7; padding-bottom: 15px; margin-bottom: 15px;">
                        <img src="{{ $item->image_url }}" alt="{{ $item->product_name }}">
                        <div class="product-details">
                            <h3 style="font-size: 15px;">{{ $item->product_name }} (x{{ $item->quantity }})</h3>
                            @php
                                $checkoutOptions = explode(',', $item->storage);
                            @endphp
                            <div style="font-size: 13px; color: #6e6e73; margin: 4px 0 8px 0; line-height: 1.4;">
                                @foreach($checkoutOptions as $opt)
                                    @php
                                        $optLabel = trim($opt);
                                    @endphp
                                    @if($optLabel !== '')
                                        @php
                                            $optPriceStr = 'Miễn phí';
                                            $productModel = \App\Models\Product::where('name', $item->product_name)->first();
                                            if ($productModel) {
                                                $optionModel = \App\Models\ProductOption::where('product_id', $productModel->id)
                                                                ->where('label', $optLabel)
                                                                ->first();
                                                if ($optionModel && $optionModel->price_offset > 0) {
                                                    $optPriceStr = '+ ' . number_format($optionModel->price_offset, 0, ',', '.') . 'đ';
                                                }
                                            }
                                        @endphp
                                        <div style="margin-bottom: 2px; display: flex; justify-content: space-between;">
                                            <span>- {{ $optLabel }}</span>
                                            <span style="color: #86868b;">{{ $optPriceStr }}</span>
                                        </div>
                                    @endif
                                @endforeach
                                @if($item->color)
                                    <div style="margin-bottom: 2px; display: flex; justify-content: space-between;">
                                        <span>- Màu {{ \App\Helpers\ColorHelper::resolve($item->color) }}</span>
                                        <span style="color: #86868b;">Miễn phí</span>
                                    </div>
                                @endif
                            </div>
                            @if($item->applecare === true || $item->applecare === 1 || $item->applecare === '1' || $item->applecare === 'true')
                                <p style="font-size: 12px; color: #1e7e34; font-weight: 500; margin-top: 3px;">✓ Có AppleCare+</p>
                            @else
                                <p style="font-size: 12px; color: #86868b; margin-top: 3px;">Không có AppleCare+</p>
                            @endif
                            <p style="font-weight: bold; color: black; margin-top: 5px;">{{ number_format($priceVal * $item->quantity, 0, ',', '.') }}đ</p>
                        </div>
                    </div>
                @endforeach

                <div class="summary-row">
                    <span>Tạm tính</span>
                    <span>{{ number_format($totalPrice, 0, ',', '.') }}đ</span>
                </div>
                <div class="summary-row">
                    <span>Giao hàng</span>
                    <span>Miễn phí</span>
                </div>
                
                <div class="summary-row summary-total">
                    <span>Tổng cộng</span>
                    <span>{{ number_format($totalPrice, 0, ',', '.') }}đ</span>
                </div>

                <button type="button" id="submit-order" class="confirm-button">Xác nhận đặt hàng</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.payment-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            this.querySelector('input').checked = true;
        });
    });

    document.getElementById('submit-order').addEventListener('click', async function() {
        const form = document.getElementById('checkout-form');
        const formData = new FormData(form);
        
        // Ensure accurate product data for "Buy Now" (Direct Checkout)
        @if($isDirectBuy)
            @php $firstItem = $cartItems->first(); @endphp
            formData.set('product', '{{ $firstItem->product_name }}');
            formData.set('price', '{{ $firstItem->price }}');
            formData.set('storage', '{{ $firstItem->storage }}');
            formData.set('color', '{{ $firstItem->color }}');
            formData.set('image_url', '{{ $firstItem->image_url }}');
            formData.set('applecare', '{{ $firstItem->applecare ? '1' : '0' }}');
        @endif

        const name = formData.get('name');
        const phone = formData.get('phone');
        const address = formData.get('address');

        if (!name || !phone || !address) {
            Swal.fire({
                icon: 'warning',
                title: 'Thiếu thông tin',
                text: 'Vui lòng nhập đầy đủ thông tin giao hàng.',
                confirmButtonColor: '#0071e3'
            });
            return;
        }

        const phoneRegex = /^(0[3|5|7|8|9])+([0-9]{8})$/;
        if (!phoneRegex.test(phone.trim())) {
            Swal.fire({
                icon: 'warning',
                title: 'Số điện thoại không hợp lệ',
                text: 'Số điện thoại phải là số điện thoại Việt Nam bắt đầu bằng 03, 05, 07, 08, 09 và gồm 10 chữ số.',
                confirmButtonColor: '#0071e3'
            });
            return;
        }

        if (address.trim().length < 10) {
            Swal.fire({
                icon: 'warning',
                title: 'Địa chỉ quá ngắn',
                text: 'Vui lòng nhập địa chỉ nhận hàng chi tiết hơn (tối thiểu 10 ký tự).',
                confirmButtonColor: '#0071e3'
            });
            return;
        }

        const submitBtn = this;
        submitBtn.disabled = true;
        submitBtn.innerText = 'Đang xử lý...';

        try {
            const response = await fetch('{{ route('process-order') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                if (response.status === 422) {
                    const result = await response.json();
                    let errMsg = '';
                    if (result.errors) {
                        errMsg = Object.values(result.errors).flat().join('\n');
                    } else {
                        errMsg = result.message || 'Dữ liệu không hợp lệ.';
                    }
                    throw new Error(errMsg);
                } else {
                    const result = await response.json().catch(() => ({}));
                    throw new Error(result.message || 'Có lỗi xảy ra trong quá trình xử lý đơn hàng.');
                }
            }

            const result = await response.json();

            if (result.success) {
                if (result.payment_url) {
                    // Redirect to VNPay
                    window.location.href = result.payment_url;
                    return;
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Đặt hàng thành công!',
                    text: 'Cảm ơn bạn đã tin tưởng chọn Apple Store.',
                    confirmButtonText: 'Xem đơn hàng',
                    confirmButtonColor: '#0071e3',
                    allowOutsideClick: false
                }).then((res) => {
                    if (res.isConfirmed) {
                        window.location.href = '/bag?tab=orders';
                    }
                });
            } else {
                throw new Error(result.message || 'Có lỗi xảy ra.');
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Thất bại',
                text: error.message,
                confirmButtonColor: '#0071e3'
            });
            submitBtn.disabled = false;
            submitBtn.innerText = 'Xác nhận đặt hàng';
        }
    });
</script>
@endsection
