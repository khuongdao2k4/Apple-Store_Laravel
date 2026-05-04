@extends('layouts.admin')
@section('title', 'Danh sách AppleCare+')
@section('content')

<div class="page-hdr d-flex justify-content-between align-items-start">
    <div>
        <h1>AppleCare+</h1>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span> Danh sách AppleCare+
        </div>
    </div>
</div>

<!-- SEARCH & FILTER BAR -->
<form method="GET" action="{{ route('admin.applecare') }}">
<div class="adm-card mb-3" style="padding:14px 18px">
    <div class="row g-2 align-items-end">
        <div class="col-md-5">
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
        <div class="col-md-3" style="display:flex;gap:6px">
            <button type="submit" class="btn-apple btn-filled" style="flex:1;justify-content:center">
                <span class="material-icons-round">filter_list</span> Lọc
            </button>
            @if(request()->hasAny(['search','date_from','date_to']))
            <a href="{{ route('admin.applecare') }}" class="btn-apple btn-ghost" style="padding:0 10px" title="Xóa bộ lọc">
                <span class="material-icons-round">close</span>
            </a>
            @endif
        </div>
    </div>
</div>
</form>

<!-- INFO CARDS -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e8f1fd"><span class="material-icons-round" style="color:#0071e3">verified_user</span></div>
            <div class="stat-label">Tổng đơn có AppleCare+</div>
            <div class="stat-value">{{ $orders->total() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#d4edda"><span class="material-icons-round" style="color:#28a745">shield</span></div>
            <div class="stat-label">Đơn đã thanh toán</div>
            <div class="stat-value">{{ $orders->getCollection()->whereIn('status',['paid','shipped','completed'])->count() }}</div>
            <div class="stat-meta">Trên trang này</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff4d9"><span class="material-icons-round" style="color:#f59e0b">payments</span></div>
            <div class="stat-label">Doanh thu AppleCare+ (trang này)</div>
            <div class="stat-value" style="font-size:20px">
                {{ number_format($orders->getCollection()->whereIn('status',['paid','shipped','completed'])->sum(fn($o) => floatval(preg_replace('/[^0-9]/','', $o->price)))) }}đ
            </div>
        </div>
    </div>
</div>

<!-- TABLE -->
<div class="adm-card">
    <div style="padding:14px 20px;border-bottom:1px solid var(--apple-gray-100);display:flex;align-items:center;gap:8px">
        <span class="material-icons-round" style="color:#0071e3;font-size:18px">verified_user</span>
        <span class="adm-card-title">Đơn hàng có AppleCare+</span>
        <span style="font-size:13px;color:var(--apple-gray-500)">· {{ $orders->total() }} đơn</span>
    </div>
    <div class="table-responsive">
        <table class="adm-table">
            <thead><tr>
                <th style="width:64px">Ảnh</th>
                <th style="width:70px">ID</th>
                <th>Khách hàng</th>
                <th>Sản phẩm</th>
                <th>Gói AppleCare</th>
                <th>Thời hạn</th>
                <th>Còn lại</th>
                <th>Trạng thái</th>
                <th class="text-end"></th>
            </tr></thead>
            <tbody>
                @forelse($orders as $order)
                @php
                    $imgUrl = null;
                    $applecarePlan = 'AppleCare+';
                    if ($order->items && is_array($order->items)) {
                        foreach ($order->items as $item) {
                            if (!empty($item['image_url']) && !$imgUrl) $imgUrl = $item['image_url'];
                            if (!empty($item['applecare'])) {
                                $applecarePlan = is_string($item['applecare']) ? $item['applecare'] : 'AppleCare+';
                            }
                        }
                    }
                    if (!$imgUrl && !empty($order->image_url)) $imgUrl = $order->image_url;

                    // Expiry logic: Mac = 3 years, others = 2 years
                    $years = str_contains(strtolower($order->product), 'mac') ? 3 : 2;
                    $expiryDate = $order->created_at->addYears($years);
                    $daysRemaining = max(0, now()->diffInDays($expiryDate, false));
                    $isExpired = $daysRemaining <= 0;
                @endphp
                <tr>
                    <td>
                        <div style="width:48px;height:48px;background:transparent;border-radius:10px;display:flex;align-items:center;justify-content:center;overflow:hidden">
                            @if($imgUrl)
                                <img src="{{ Str::startsWith($imgUrl,'http') ? $imgUrl : asset($imgUrl) }}" alt="" style="width:40px;height:40px;object-fit:contain" onerror="this.style.display='none'">
                            @else
                                <span class="material-icons-round" style="color:var(--apple-gray-300);font-size:20px">smartphone</span>
                            @endif
                        </div>
                    </td>
                    <td><span style="font-weight:600;color:var(--apple-blue)">#{{ $order->id_order }}</span></td>
                    <td>
                        <div style="font-weight:500;font-size:13px">{{ $order->username }}</div>
                        <div style="font-size:11px;color:var(--apple-gray-500)">{{ $order->email }}</div>
                    </td>
                    <td style="max-width:160px">
                        <div style="font-size:13px;font-weight:500;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $order->product }}</div>
                        <div style="font-size:11px;color:var(--apple-gray-500)">{{ $order->storage }}{{ $order->color ? ' · '.$order->color : '' }}</div>
                    </td>
                    <td>
                        <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;background:#e8f1fd;color:#0071e3;border-radius:6px;padding:3px 8px">
                            <span class="material-icons-round" style="font-size:14px">verified_user</span>
                            {{ $applecarePlan }}
                        </span>
                    </td>
                    <td style="font-size:12px">
                        <div style="font-weight:500;color:var(--apple-gray-700)">Đến: {{ $expiryDate->format('d/m/Y') }}</div>
                        <div style="font-size:11px;color:var(--apple-gray-500)">Kích hoạt: {{ $order->created_at->format('d/m/Y') }}</div>
                    </td>
                    <td>
                        @if($isExpired)
                            <span style="color:#ff3b30;font-weight:600;font-size:12px">Hết hạn</span>
                        @else
                            @php
                                $diff = now()->diff($expiryDate);
                                $parts = [];
                                if ($diff->y > 0) $parts[] = $diff->y . ' năm';
                                if ($diff->m > 0) $parts[] = $diff->m . ' tháng';
                                if ($diff->d > 0 || count($parts) == 0) $parts[] = $diff->d . ' ngày';
                                $timeStr = implode(', ', $parts);
                            @endphp
                            <div style="font-weight:700;color:#28a745;font-size:13px">{{ $timeStr }}</div>
                            <div class="progress" style="height:4px;width:60px;margin-top:4px;background:#eee">
                                @php 
                                    $totalDays = $years * 365;
                                    $remainingDays = now()->diffInDays($expiryDate, false);
                                    $percent = min(100, max(0, ($remainingDays / $totalDays) * 100)); 
                                @endphp
                                <div class="progress-bar" style="width:{{ $percent }}%;background:#28a745"></div>
                            </div>
                        @endif
                    </td>
                    <td><span class="chip chip-{{ strtolower($order->status) }}">{{ $order->status }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('admin.order.detail', ['id' => $order->id_order]) }}" class="btn-apple btn-tonal btn-sm">Chi tiết</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8">
                    <div class="empty-state">
                        <span class="material-icons-round">verified_user</span>
                        <p>Không tìm thấy đơn hàng AppleCare+ nào.</p>
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
@endsection
