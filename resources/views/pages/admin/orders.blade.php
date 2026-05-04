@extends('layouts.admin')
@section('title', 'Quản lý Đơn hàng')
@section('content')

<div class="page-hdr d-flex justify-content-between align-items-start">
    <div>
        <h1>Đơn hàng</h1>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span> Quản lý Đơn hàng
        </div>
    </div>
    <button class="btn-apple btn-ghost" onclick="location.reload()">
        <span class="material-icons-round">refresh</span> Làm mới
    </button>
</div>

<!-- SEARCH & FILTER BAR -->
<form method="GET" action="{{ route('admin.orders') }}">
<div class="adm-card mb-3" style="padding:14px 18px">
    <div class="row g-2 align-items-end">
        <div class="col-md-4">
            <label class="f-label">Tìm kiếm</label>
            <div style="position:relative">
                <span class="material-icons-round" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--apple-gray-500);font-size:18px;pointer-events:none">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tên khách, email, sản phẩm, mã đơn..." class="f-input" style="padding-left:36px">
            </div>
        </div>
        <div class="col-md-2">
            <label class="f-label">Từ ngày</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="f-input">
        </div>
        <div class="col-md-2">
            <label class="f-label">Đến ngày</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="f-input">
        </div>
        <div class="col-md-2">
            <label class="f-label">Trạng thái</label>
            <select name="status" class="f-input" style="appearance:none">
                <option value="">Tất cả</option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Chờ xử lý</option>
                <option value="paid" {{ request('status')=='paid'?'selected':'' }}>Đã thanh toán</option>
                <option value="shipped" {{ request('status')=='shipped'?'selected':'' }}>Đang giao hàng</option>
                <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Hoàn thành</option>
                <option value="failed" {{ request('status')=='failed'?'selected':'' }}>Thất bại</option>
            </select>
        </div>
        <div class="col-md-2" style="display:flex;gap:6px">
            <button type="submit" class="btn-apple btn-filled" style="flex:1;justify-content:center">
                <span class="material-icons-round">filter_list</span> Lọc
            </button>
            @if(request()->hasAny(['search','date_from','date_to','status']))
            <a href="{{ route('admin.orders') }}" class="btn-apple btn-ghost" style="padding:0 10px" title="Xóa bộ lọc">
                <span class="material-icons-round">close</span>
            </a>
            @endif
        </div>
    </div>
</div>
</form>

<!-- SUMMARY -->
<div class="adm-card mb-3" style="padding:11px 18px">
    <div style="display:flex;align-items:center;gap:8px;font-size:13px;color:var(--apple-gray-500)">
        <span class="material-icons-round" style="font-size:17px;color:var(--apple-blue)">info</span>
        Hiển thị <strong style="color:var(--apple-black);margin:0 3px">{{ $orders->total() }}</strong> đơn hàng
        @if(request()->hasAny(['search','date_from','date_to','status']))
            <span style="color:var(--apple-blue)">· Đang lọc</span>
        @endif
    </div>
</div>

<!-- ORDERS TABLE -->
<div class="adm-card">
    <div class="table-responsive">
        <table class="adm-table">
            <thead><tr>
                <th style="width:72px">Ảnh</th>
                <th style="width:70px">ID</th>
                <th>Khách hàng</th>
                <th>Sản phẩm</th>
                <th>Thanh toán</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th class="text-end">Thao tác</th>
            </tr></thead>
            <tbody>
                @forelse($orders as $order)
                @php
                    // Try to get image from items JSON first, then image_url field
                    $imgUrl = null;
                    if ($order->items && is_array($order->items)) {
                        foreach ($order->items as $item) {
                            if (!empty($item['image_url'])) { $imgUrl = $item['image_url']; break; }
                        }
                    }
                    if (!$imgUrl && !empty($order->image_url)) $imgUrl = $order->image_url;
                @endphp
                <tr>
                    <td>
                        <div style="width:52px;height:52px;background:transparent;border-radius:10px;display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0">
                            @if($imgUrl)
                                <img src="{{ Str::startsWith($imgUrl,'http') ? $imgUrl : asset($imgUrl) }}"
                                     alt="" style="width:44px;height:44px;object-fit:contain"
                                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <span class="material-icons-round" style="display:none;color:var(--apple-gray-300);font-size:20px">image_not_supported</span>
                            @else
                                <span class="material-icons-round" style="color:var(--apple-gray-300);font-size:20px">smartphone</span>
                            @endif
                        </div>
                    </td>
                    <td><span style="font-weight:600;color:var(--apple-blue)">#{{ $order->id_order }}</span></td>
                    <td>
                        <div style="font-weight:500;font-size:13px">{{ $order->username }}</div>
                        <div style="font-size:11px;color:var(--apple-gray-500)">{{ $order->email }}</div>
                        @if($order->phone)<div style="font-size:11px;color:var(--apple-gray-500)">{{ $order->phone }}</div>@endif
                    </td>
                    <td style="max-width:180px">
                        <div style="font-size:13px;font-weight:500;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $order->product }}</div>
                        <div style="font-size:11px;color:var(--apple-gray-500);margin-top:1px">
                            {{ $order->storage }}{{ $order->color ? ' · '.$order->color : '' }}
                        </div>
                        @if($order->items)
                        @php
                            $hasAppleCare = false;
                            if(is_array($order->items)) {
                                foreach($order->items as $it) {
                                    if(!empty($it['applecare']) || (!empty($it['name']) && str_contains(strtolower($it['name']),'applecare'))) {
                                        $hasAppleCare = true; break;
                                    }
                                }
                            }
                        @endphp
                        @if($hasAppleCare)
                        <span style="display:inline-flex;align-items:center;gap:3px;font-size:10px;font-weight:600;background:#e8f1fd;color:#0071e3;border-radius:4px;padding:2px 6px;margin-top:3px">
                            <span class="material-icons-round" style="font-size:11px">verified_user</span> AppleCare+
                        </span>
                        @endif
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:700;font-size:13px">{{ number_format(floatval(preg_replace('/[^0-9]/','', $order->price))) }}đ</div>
                        <div style="font-size:11px;color:var(--apple-gray-500);text-transform:uppercase">{{ $order->payment_method }}</div>
                    </td>
                    <td>
                        <select onchange="updateStatus({{ $order->id_order }}, this.value, this)"
                            class="status-select status-{{ strtolower($order->status) }}">
                            <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Chờ xử lý</option>
                            <option value="paid" {{ $order->status=='paid'?'selected':'' }}>Đã thanh toán</option>
                            <option value="shipped" {{ $order->status=='shipped'?'selected':'' }}>Đang giao hàng</option>
                            <option value="completed" {{ $order->status=='completed'?'selected':'' }}>Hoàn thành</option>
                            <option value="failed" {{ $order->status=='failed'?'selected':'' }}>Thất bại</option>
                        </select>
                    </td>
                    <td style="color:var(--apple-gray-500);font-size:12px;white-space:nowrap">
                        {{ $order->created_at->format('d/m/Y') }}<br>
                        <span style="color:var(--apple-gray-300)">{{ $order->created_at->format('H:i') }}</span>
                    </td>
                    <td class="text-end">
                        <button class="btn-apple btn-tonal btn-sm" onclick="viewDetail({{ $order->id_order }})">Chi tiết</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8">
                    <div class="empty-state">
                        <span class="material-icons-round">receipt_long</span>
                        <p>Không tìm thấy đơn hàng nào.</p>
                    </div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div style="padding:14px 20px;border-top:1px solid var(--apple-gray-100);display:flex;justify-content:center">
        {{ $orders->links() }}
    </div>
    @endif
</div>

@push('scripts')
<script>
async function updateStatus(id, newStatus, el) {
    try {
        const r = await fetch('{{ route('admin.order.update-status') }}', {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},
            body:JSON.stringify({id_order:id, status:newStatus})
        });
        const res = await r.json();
        if(res.success) {
            Swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:2000})
                .fire({icon:'success',title:'Cập nhật thành công!'});
            if(el) el.className='status-select status-'+newStatus.toLowerCase();
        } else Swal.fire('Lỗi',res.message,'error');
    } catch(e){ 
        console.error(e);
        Swal.fire('Lỗi','Không thể kết nối máy chủ. Vui lòng kiểm tra lại.','error'); 
    }
}
function viewDetail(id){ window.location.href = '{{ url('admin/order') }}/' + id; }
</script>
@endpush
@endsection
