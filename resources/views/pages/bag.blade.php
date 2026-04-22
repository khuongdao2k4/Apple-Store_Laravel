@extends('layouts.app', ['pageTitle' => 'bag.php'])

@section('content')


<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        margin: 0;
        padding: 0;
        background-color: white;
    
    .container1, .container2 {
        max-width: 80%;
        margin: 0px auto;
        background: white;
        padding: 0px 30px;
    }
    .container1 {
        padding-top: 0px;
    }
    h1 {
        font-size: 28px;
        font-weight: bold;
    }
    p {
        color: #6e6e73;
        font-size: 16px;
        margin-bottom: 20px;
    }
    .buttons {
        margin: 20px 0;
    }
    button {
        padding: 12px 20px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }
    .sign-in {
        background-color: #0071e3;
        color: white;
        margin-right: 10px;
    }
    .continue-shopping {
        background-color: white;
        color: #0071e3;
        border: 1px solid #0071e3;
    }
    .help-text {
        font-size: 14px;
    }
    .help-text a {
        color: #0071e3;
        text-decoration: none;
    }
    .order-item {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        text-align: left;   
    }
    .order-item img {
        width: 230px;
        height: 140px;
        margin-right: 20px;
        border-radius: 5px;
        object-fit: contain;
    }
    
    .order-details {
        flex: 1;
    }
    .order-buttons {
        position: absolute;
        right: 150px;
        transform: translateY(-50%);
    }
    .order-buttons button {
        margin-left: 10px;
        padding: 8px 12px;
        font-size: 14px;
    }
    .delete-button {
        background-color: red;
        color: white;
    }
    .edit-button {
        background-color: orange;
        color: white;
    }

    .new-arrivals {
        display: flex;
        width: 980px;
        height: 400px;
        align-items: center;
        padding: 20px;
        background: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin: 0px auto;
    }
    .new-arrivals img {
        width: 100px;
        margin-right: 20px;
    }
    .shop-link {
        color: #0071e3;
        font-weight: bold;
        text-decoration: none;
    }
</style>

<style>
    .bag-nav {
        display: flex;
        gap: 30px;
        margin-bottom: 40px;
        border-bottom: 1px solid #d2d2d7;
        padding-bottom: 10px;
        max-width: 980px;
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

    /* Custom Pagination Styling */
    .pagination {
        justify-content: center;
        margin-top: 30px;
        gap: 5px;
    }
    .pagination .page-item .page-link {
        border-radius: 8px;
        color: #1d1d1f;
        border: 1px solid #d2d2d7;
        padding: 8px 16px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .pagination .page-item.active .page-link {
        background-color: #0071e3;
        border-color: #0071e3;
        color: white;
    }
    .pagination .page-item .page-link:hover:not(.active) {
        background-color: #f5f5f7;
        border-color: #d2d2d7;
    }
    .page-link:focus {
        box-shadow: none;
    }
</style>

<div class="container1" style="margin-bottom: 20px; text-align: left; margin-left: auto; margin-right: auto; max-width: 980px; padding-top: 80px;">
    @if (!session()->has('email'))
        <h1 style="font-size:48px;">Your bag is empty.</h1>
        <p>Sign in to see if you have any saved items. Or continue shopping.</p>
        <div class="buttons">
            <button class="sign-in" style="width: 300px; border-radius: 20px;" onclick="location.href='{{ route('login') }}'">Sign In</button>
            <button class="continue-shopping" style="width: 300px; border-radius: 20px;" onclick="location.href='{{ route('mua-iphone') }}'">Continue Shopping</button>
        </div>
    @else
        <div class="bag-nav">
            <button class="tab-btn active" onclick="switchTab('bag-tab')">Review your bag.</button>
            <button class="tab-btn" onclick="switchTab('orders-tab')">Your Orders.</button>
        </div>

        <!-- Bag Tab Content -->
        <div id="bag-tab" class="tab-content active">
            <p style="font-size: 17px; margin-bottom: 30px;">Free delivery and free returns on all orders.</p>
            
            @if ($cartItems->count() > 0)
                @php $totalAmount = 0; @endphp
                @foreach ($cartItems as $item)
                    @php 
                        $priceVal = floatval(str_replace(['$', ','], '', $item->price));
                        $totalAmount += $priceVal * $item->quantity;
                    @endphp
                    <div class="order-item" id="cart-item-{{ $item->id }}">
                        <img src="{{ $item->image_url }}" alt="Product Image">
                        <div class="order-details">
                            <h3 style="font-size: 24px; font-weight: bold;">{{ $item->product_name }}</h3>
                            <p>{{ $item->storage }} | {{ $item->color }}</p>
                            
                            <div class="quantity-controls" style="display: flex; align-items: center; gap: 15px; margin-top: 15px;">
                                <button onclick="updateQty({{ $item->id }}, {{ $item->quantity - 1 }})" style="background: #f5f5f7; border-radius: 50%; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-minus"></i></button>
                                <span style="font-size: 18px; font-weight: bold;">{{ $item->quantity }}</span>
                                <button onclick="updateQty({{ $item->id }}, {{ $item->quantity + 1 }})" style="background: #f5f5f7; border-radius: 50%; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="item-price" style="text-align: right; width: 150px;">
                            <p style="font-size: 24px; font-weight: bold; color: black;">${{ number_format($priceVal * $item->quantity) }}</p>
                            <button onclick="removeItem({{ $item->id }})" style="background: none; color: #0071e3; border: none; padding: 0; font-size: 14px;">Remove</button>
                        </div>
                    </div>
                @endforeach

                <div class="pagination-wrapper mt-4">
                    {{ $cartItems->appends(['tab' => 'bag', 'order_page' => request('order_page')])->links() }}
                </div>

                <div class="bag-summary" style="margin-top: 40px; border-top: 1px solid #d2d2d7; padding-top: 30px;">
                    <div style="display: flex; justify-content: space-between; font-size: 24px; font-weight: bold; margin-bottom: 20px;">
                        <span>Total</span>
                        <span>${{ number_format($totalAmount) }}</span>
                    </div>
                    <div style="text-align: right;">
                        <button class="confirm-button" style="width: 320px; padding: 18px; border-radius: 12px; font-weight: bold;" onclick="location.href='{{ route('checkout') }}'">Check Out</button>
                    </div>
                </div>
            @else
                <h1 style="font-size:32px; margin-top: 40px;">Your bag is empty.</h1>
                <p>Continue shopping to find your next favorite Apple product.</p>
                <div class="buttons">
                    <button class="continue-shopping" style="width: 300px; border-radius: 20px;" onclick="location.href='{{ route('mua-iphone') }}'">Continue Shopping</button>
                </div>
            @endif
        </div>

        <!-- Orders Tab Content -->
        <div id="orders-tab" class="tab-content">
            <p style="font-size: 17px; margin-bottom: 30px;">Manage and track your recent orders.</p>
            
            @if ($orders->count() > 0)
                @foreach ($orders as $order)
                    <div class="order-item" style="border-color: #f5f5f7; background: #fafafa11;">
                        <img src="{{ $order->image_url }}" alt="Order Image" style="filter: grayscale(0.2);">
                        <div class="order-details">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <h3 style="font-size: 22px; font-weight: bold;">{{ $order->product }}</h3>
                                <span class="order-status-badge status-{{ strtolower($order->status) }}">{{ $order->status }}</span>
                            </div>
                            <p style="margin-top: 5px;">{{ $order->storage }} | {{ $order->color }}</p>
                            <p style="font-size: 13px; color: #86868b; margin-top: 10px;">
                                Order ID: #{{ $order->id_order }} | Date: {{ $order->created_at->format('M d, Y') }}
                            </p>
                            <p style="font-size: 13px; color: #86868b;">Payment: {{ $order->payment_method }}</p>
                        </div>
                        <div style="text-align: right; width: 150px;">
                            <p style="font-size: 22px; font-weight: bold; color: black;">
                                @if(is_numeric(str_replace(['$', ','], '', $order->price)))
                                    ${{ number_format(floatval(str_replace(['$', ','], '', $order->price))) }}
                                @else
                                    {{ $order->price }}
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach

                <div class="pagination-wrapper mt-4">
                    {{ $orders->appends(['tab' => 'orders', 'bag_page' => request('bag_page')])->links() }}
                </div>
            @else
                <h1 style="font-size:32px; margin-top: 40px;">No orders found.</h1>
                <p>Once you make a purchase, it will appear here.</p>
            @endif
        </div>
    @endif
</div>

<script>
    function switchTab(tabId) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        
        // Show target tab
        document.getElementById(tabId).classList.add('active');
        
        // Update button state
        const btnText = tabId === 'bag-tab' ? 'Review your bag.' : 'Your Orders.';
        document.querySelectorAll('.tab-btn').forEach(btn => {
            if(btn.innerText === btnText) btn.classList.add('active');
        });

        // Update URL without refresh
        const url = new URL(window.location);
        url.searchParams.set('tab', tabId === 'bag-tab' ? 'bag' : 'orders');
        window.history.pushState({}, '', url);
    }

    // Auto switch based on URL
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab');
        if(tab === 'orders') {
            switchTab('orders-tab');
        }
    });
</script>

<style>
    .confirm-button {
        background-color: #0071e3;
        color: white;
        border: none;
        cursor: pointer;
    }
    .confirm-button:hover {
        background-color: #0077ed;
    }
</style>

<script>
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
                location.reload(); // Simple refresh to update totals
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
            cancelButtonText: 'Hủy'
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



@endsection

