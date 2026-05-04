@extends('layouts.admin')
@section('title', 'Chi tiết đơn hàng #' . $order->id_order)
@section('content')

<div class="page-hdr d-flex justify-content-between align-items-center">
    <div>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span> 
            <a href="{{ route('admin.orders') }}">Đơn hàng</a><span>›</span> 
            Chi tiết #{{ $order->id_order }}
        </div>
        <h1 style="margin-top:4px">Đơn hàng #{{ $order->id_order }}</h1>
    </div>
    <div style="display:flex;gap:10px">
        <button class="btn-apple btn-ghost" onclick="window.print()">
            <span class="material-icons-round">print</span> In hóa đơn
        </button>
        <a href="{{ route('admin.orders') }}" class="btn-apple btn-tonal">
            <span class="material-icons-round">arrow_back</span> Quay lại
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- LEFT: ORDER ITEMS -->
    <div class="col-lg-8">
        <div class="adm-card mb-4">
            <div style="padding:18px 24px;border-bottom:1px solid var(--apple-gray-100);display:flex;justify-content:space-between;align-items:center">
                <span class="adm-card-title">Sản phẩm trong đơn</span>
                <span class="chip chip-{{ strtolower($order->status) }}">{{ strtoupper($order->status) }}</span>
            </div>
            <div class="table-responsive">
                <table class="adm-table">
                    <thead><tr>
                        <th style="width:80px">Ảnh</th>
                        <th>Thông tin sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-end">Đơn giá</th>
                        <th class="text-end">Thành tiền</th>
                    </tr></thead>
                    <tbody>
                        @php $subtotal = 0; @endphp
                        @if($order->items && is_array($order->items))
                            @foreach($order->items as $item)
                            @php 
                                $itemPrice = intval($item['price'] ?? 0);
                                $qty = intval($item['quantity'] ?? 1);
                                $total = $itemPrice * $qty;
                                $subtotal += $total;
                            @endphp
                            <tr>
                                <td>
                                    <div style="width:60px;height:60px;background:transparent;border-radius:12px;display:flex;align-items:center;justify-content:center;overflow:hidden">
                                        <img src="{{ !empty($item['image_url']) ? (Str::startsWith($item['image_url'],'http') ? $item['image_url'] : asset($item['image_url'])) : asset('assets/images/placeholder.png') }}" 
                                             alt="" style="width:50px;height:50px;object-fit:contain">
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight:600;font-size:15px;color:var(--apple-black)">{{ $item['product_name'] ?? 'Sản phẩm không tên' }}</div>
                                    <div style="font-size:12px;color:var(--apple-gray-500);margin-top:2px">
                                        {{ $item['storage'] ?? '' }}{{ !empty($item['color']) ? ' · ' . $item['color'] : '' }}
                                    </div>
                                    @if(!empty($item['applecare']))
                                    <div style="margin-top:6px">
                                        <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;background:#e8f1fd;color:#0071e3;border-radius:6px;padding:2px 8px">
                                            <span class="material-icons-round" style="font-size:13px">verified_user</span>
                                            {{ is_string($item['applecare']) ? $item['applecare'] : 'AppleCare+' }}
                                        </span>
                                    </div>
                                    @endif
                                </td>
                                <td class="text-center" style="font-weight:500">x{{ $qty }}</td>
                                <td class="text-end" style="font-weight:500">{{ number_format($itemPrice) }}đ</td>
                                <td class="text-end" style="font-weight:700;color:var(--apple-black)">{{ number_format($total) }}đ</td>
                            </tr>
                            @endforeach
                        @else
                            <!-- Fallback for legacy single item orders -->
                            @php $subtotal = floatval(preg_replace('/[^0-9]/', '', $order->price)); @endphp
                            <tr>
                                <td>
                                    <div style="width:60px;height:60px;background:transparent;border-radius:12px;display:flex;align-items:center;justify-content:center;overflow:hidden">
                                        <img src="{{ asset($order->image_url) }}" alt="" style="width:50px;height:50px;object-fit:contain">
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight:600;font-size:15px;color:var(--apple-black)">{{ $order->product }}</div>
                                    <div style="font-size:12px;color:var(--apple-gray-500);margin-top:2px">
                                        {{ $order->storage }}{{ $order->color ? ' · ' . $order->color : '' }}
                                    </div>
                                </td>
                                <td class="text-center" style="font-weight:500">x1</td>
                                <td class="text-end" style="font-weight:500">{{ number_format($subtotal) }}đ</td>
                                <td class="text-end" style="font-weight:700;color:var(--apple-black)">{{ number_format($subtotal) }}đ</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div style="padding:24px;background:var(--apple-gray-100);display:flex;justify-content:flex-end">
                <div style="width:300px">
                    <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:14px;color:var(--apple-gray-500)">
                        <span>Tạm tính:</span>
                        <span style="color:var(--apple-black)">{{ number_format($subtotal) }}đ</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:14px;color:var(--apple-gray-500)">
                        <span>Phí vận chuyển:</span>
                        <span style="color:var(--apple-black)">Miễn phí</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;margin-top:16px;padding-top:16px;border-top:1px solid var(--apple-gray-200)">
                        <span style="font-weight:600;font-size:16px">Tổng thanh toán:</span>
                        <span style="font-weight:700;font-size:20px;color:var(--apple-blue)">{{ number_format($subtotal) }}đ</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="adm-card">
            <div style="padding:18px 24px;border-bottom:1px solid var(--apple-gray-100)">
                <span class="adm-card-title">Cập nhật trạng thái</span>
            </div>
            <div style="padding:24px">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p style="font-size:13px;color:var(--apple-gray-500);margin-bottom:0">Thay đổi trạng thái để khách hàng có thể theo dõi đơn hàng của mình.</p>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end gap-2">
                        <select id="detail-status" class="f-input" style="width:200px">
                            <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                            <option value="paid" {{ $order->status=='paid'?'selected':'' }}>Paid</option>
                            <option value="shipped" {{ $order->status=='shipped'?'selected':'' }}>Shipped</option>
                            <option value="completed" {{ $order->status=='completed'?'selected':'' }}>Completed</option>
                            <option value="failed" {{ $order->status=='failed'?'selected':'' }}>Failed</option>
                        </select>
                        <button class="btn-apple btn-filled" onclick="updateDetailStatus()">Lưu thay đổi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT: CUSTOMER & PAYMENT -->
    <div class="col-lg-4">
        <div class="adm-card mb-4">
            <div style="padding:18px 24px;border-bottom:1px solid var(--apple-gray-100);display:flex;align-items:center;gap:8px">
                <span class="material-icons-round" style="color:var(--apple-blue)">person</span>
                <span class="adm-card-title">Thông tin khách hàng</span>
            </div>
            <div style="padding:24px">
                <div style="margin-bottom:20px">
                    <label style="display:block;font-size:11px;text-transform:uppercase;color:var(--apple-gray-500);font-weight:600;margin-bottom:4px">Họ tên</label>
                    <div style="font-weight:600;font-size:15px">{{ $order->username }}</div>
                </div>
                <div style="margin-bottom:20px">
                    <label style="display:block;font-size:11px;text-transform:uppercase;color:var(--apple-gray-500);font-weight:600;margin-bottom:4px">Email</label>
                    <div style="font-size:14px">{{ $order->email }}</div>
                </div>
                <div style="margin-bottom:20px">
                    <label style="display:block;font-size:11px;text-transform:uppercase;color:var(--apple-gray-500);font-weight:600;margin-bottom:4px">Số điện thoại</label>
                    <div style="font-size:14px">{{ $order->phone ?: 'Chưa cung cấp' }}</div>
                </div>
                <div>
                    <label style="display:block;font-size:11px;text-transform:uppercase;color:var(--apple-gray-500);font-weight:600;margin-bottom:4px">Địa chỉ giao hàng</label>
                    <div style="font-size:14px;line-height:1.5">{{ $order->address ?: 'Chưa cung cấp' }}</div>
                </div>
            </div>
        </div>

        <div class="adm-card">
            <div style="padding:18px 24px;border-bottom:1px solid var(--apple-gray-100);display:flex;align-items:center;gap:8px">
                <span class="material-icons-round" style="color:#f59e0b">payments</span>
                <span class="adm-card-title">Thanh toán</span>
            </div>
            <div style="padding:24px">
                <div style="margin-bottom:20px">
                    <label style="display:block;font-size:11px;text-transform:uppercase;color:var(--apple-gray-500);font-weight:600;margin-bottom:4px">Phương thức</label>
                    <div style="font-weight:600;font-size:14px;display:flex;align-items:center;gap:6px">
                        @if($order->payment_method == 'VNPAY')
                            <img src="https://vnpay.vn/sitemaps/vnpay_logo.png" alt="VNPAY" style="height:14px">
                        @endif
                        {{ $order->payment_method }}
                    </div>
                </div>
                @if($order->vnp_transaction_no)
                <div style="margin-bottom:20px">
                    <label style="display:block;font-size:11px;text-transform:uppercase;color:var(--apple-gray-500);font-weight:600;margin-bottom:4px">Mã GD VNPAY</label>
                    <div style="font-size:13px;font-family:monospace;background:var(--apple-gray-100);padding:4px 8px;border-radius:4px">{{ $order->vnp_transaction_no }}</div>
                </div>
                @endif
                <div>
                    <label style="display:block;font-size:11px;text-transform:uppercase;color:var(--apple-gray-500);font-weight:600;margin-bottom:4px">Ngày đặt hàng</label>
                    <div style="font-size:14px">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
async function updateDetailStatus() {
    const newStatus = document.getElementById('detail-status').value;
    try {
        const r = await fetch('{{ route('admin.order.update-status') }}', {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},
            body:JSON.stringify({id_order: {{ $order->id_order }}, status:newStatus})
        });
        const res = await r.json();
        if(res.success) {
            Swal.fire({icon:'success',title:'Thành công',text:'Đã cập nhật trạng thái đơn hàng.',timer:2000,showConfirmButton:false})
            .then(() => location.reload());
        } else Swal.fire('Lỗi',res.message,'error');
    } catch(e){ Swal.fire('Lỗi','Không thể kết nối máy chủ','error'); }
}
</script>
@endpush
@endsection
