@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="page-hdr d-flex justify-content-between align-items-start">
    <div>
        <h1>Tổng quan Dashboard</h1>
        <div class="breadcrumb">Chào mừng trở lại, <strong>{{ session('user_name', 'Quản trị viên') }}</strong></div>
    </div>
    <div style="display:flex;gap:10px">
        <button class="btn-apple btn-ghost" onclick="location.reload()">
            <span class="material-icons-round">refresh</span> Làm mới
        </button>
        <a href="{{ route('add-product') }}" class="btn-apple btn-filled">
            <span class="material-icons-round">add</span> Thêm sản phẩm
        </a>
    </div>
</div>

<!-- TOP STATS CARDS -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e8f1fd"><span class="material-icons-round" style="color:#0071e3">payments</span></div>
            <div class="stat-label">Tổng doanh thu</div>
            <div class="stat-value">{{ number_format($totalRevenue) }}đ</div>
            <div class="stat-meta"><span style="color:#34c759;font-weight:600">Dữ liệu tích lũy</span></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff4d9"><span class="material-icons-round" style="color:#f59e0b">pending_actions</span></div>
            <div class="stat-label">Đơn chờ duyệt</div>
            <div class="stat-value">{{ $pendingOrdersCount }}</div>
            <div class="stat-meta"><a href="{{ route('admin.orders', ['status'=>'pending']) }}" style="color:var(--apple-blue);text-decoration:none">Xử lý ngay →</a></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#d4edda"><span class="material-icons-round" style="color:#28a745">inventory_2</span></div>
            <div class="stat-label">Sản phẩm</div>
            <div class="stat-value">{{ $productsCount }}</div>
            <div class="stat-meta"><a href="{{ route('admin.products') }}" style="color:var(--apple-blue);text-decoration:none">Quản lý kho →</a></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#f3e8ff"><span class="material-icons-round" style="color:#7c3aed">group</span></div>
            <div class="stat-label">Người dùng</div>
            <div class="stat-value">{{ $usersCount }}</div>
            <div class="stat-meta"><span style="color:var(--apple-gray-500)">Khách hàng đã đăng ký</span></div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- MAIN CHART -->
    <div class="col-lg-8">
        <div class="adm-card" style="height:100%">
            <div style="padding:20px 24px;border-bottom:1px solid var(--apple-gray-100);display:flex;justify-content:space-between;align-items:center">
                <span class="adm-card-title">Doanh thu 6 tháng gần nhất</span>
                <div style="font-size:12px;color:var(--apple-gray-500)">Xu hướng: <span style="color:#34c759;font-weight:600">Ổn định</span></div>
            </div>
            <div style="padding:24px">
                <canvas id="revenueChart" height="280"></canvas>
            </div>
        </div>
    </div>

    <!-- TODAY SUMMARY & PIE CHART -->
    <div class="col-lg-4">
        <div class="adm-card mb-4" style="background:var(--apple-blue);color:#fff">
            <div style="padding:20px 24px">
                <div style="font-size:13px;opacity:0.8;font-weight:500">Hoạt động hôm nay</div>
                <div style="font-size:28px;font-weight:700;margin:8px 0">{{ number_format($revenueToday) }}đ</div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:20px;padding-top:16px;border-top:1px solid rgba(255,255,255,0.2)">
                    <div>
                        <div style="font-size:11px;opacity:0.7;text-transform:uppercase">Đơn hàng</div>
                        <div style="font-size:16px;font-weight:600">{{ $ordersTodayCount }} đơn</div>
                    </div>
                    <div class="text-end">
                        <div style="font-size:11px;opacity:0.7;text-transform:uppercase">Trung bình</div>
                        <div style="font-size:16px;font-weight:600">{{ $ordersTodayCount > 0 ? number_format($revenueToday / $ordersTodayCount) : 0 }}đ</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="adm-card">
            <div style="padding:18px 20px;border-bottom:1px solid var(--apple-gray-100)">
                <span class="adm-card-title">Cơ cấu doanh thu theo dòng</span>
            </div>
            <div style="padding:20px">
                <canvas id="categoryChart" height="180"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- RECENT ORDERS -->
    <div class="col-lg-7">
        <div class="adm-card" style="height:100%">
            <div style="padding:20px 24px;border-bottom:1px solid var(--apple-gray-100);display:flex;justify-content:space-between;align-items:center">
                <span class="adm-card-title">Đơn hàng mới nhất</span>
                <a href="{{ route('admin.orders') }}" class="btn-apple btn-tonal btn-sm">Xem tất cả</a>
            </div>
            <div class="table-responsive">
                <table class="adm-table">
                    <thead><tr>
                        <th style="width:48px"></th>
                        <th>ID</th><th>Khách hàng</th><th>Tổng tiền</th><th>Trạng thái</th><th class="text-end"></th>
                    </tr></thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        @php
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
                                <div style="width:36px;height:36px;background:transparent;border-radius:6px;display:flex;align-items:center;justify-content:center;overflow:hidden">
                                    @if($imgUrl)
                                        <img src="{{ Str::startsWith($imgUrl,'http') ? $imgUrl : asset($imgUrl) }}" alt="" style="width:28px;height:28px;object-fit:contain">
                                    @else
                                        <span class="material-icons-round" style="color:var(--apple-gray-300);font-size:16px">smartphone</span>
                                    @endif
                                </div>
                            </td>
                            <td><span style="font-weight:600;color:var(--apple-blue)">#{{ $order->id_order }}</span></td>
                            <td>
                                <div style="font-weight:500;font-size:13px">{{ $order->username }}</div>
                                <div style="font-size:11px;color:var(--apple-gray-500);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:140px">{{ $order->product }}</div>
                            </td>
                            <td style="font-weight:600;font-size:13px">{{ number_format(floatval(preg_replace('/[^0-9]/','', $order->price))) }}đ</td>
                            <td><span class="chip chip-{{ strtolower($order->status) }}">{{ $order->status_label }}</span></td>
                            <td class="text-end">
                                <a href="{{ route('admin.order.detail', ['id' => $order->id_order]) }}" class="btn-apple btn-tonal btn-sm">Chi tiết</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- PAYMENT & STOCK -->
    <div class="col-lg-5">
        <div class="adm-card mb-4">
            <div style="padding:18px 20px;border-bottom:1px solid var(--apple-gray-100)">
                <span class="adm-card-title">Phương thức thanh toán</span>
            </div>
            <div style="padding:15px 20px">
                @foreach($paymentMethods as $pm)
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;last-child:margin-bottom:0">
                    <div style="display:flex;align-items:center;gap:10px">
                        <div style="width:32px;height:32px;background:var(--apple-gray-100);border-radius:8px;display:flex;align-items:center;justify-content:center">
                            @if($pm->payment_method == 'VNPAY') <span class="material-icons-round" style="color:#0071e3;font-size:18px">account_balance</span>
                            @else <span class="material-icons-round" style="color:var(--apple-gray-500);font-size:18px">payments</span> @endif
                        </div>
                        <span style="font-size:14px;font-weight:500">{{ $pm->payment_method }}</span>
                    </div>
                    <span style="font-size:14px;font-weight:700">{{ $pm->count }} đơn</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="adm-card">
            <div style="padding:18px 20px;border-bottom:1px solid var(--apple-gray-100)">
                <span class="adm-card-title">Cảnh báo tồn kho</span>
            </div>
            <div style="padding:10px 0">
                @forelse($lowStockProducts as $p)
                <div style="display:flex;align-items:center;gap:12px;padding:10px 20px">
                    <img src="{{ asset($p->image_url) }}" style="width:32px;height:32px;object-fit:contain;background:var(--apple-gray-100);border-radius:6px">
                    <div style="flex:1">
                        <div style="font-size:13px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:140px">{{ $p->name }}</div>
                        <div style="font-size:11px;color:var(--apple-gray-500)">Còn {{ $p->quantity }} chiếc</div>
                    </div>
                    <a href="{{ route('edit-product', $p->id) }}" class="material-icons-round" style="color:var(--apple-gray-300);text-decoration:none;font-size:18px">edit</a>
                </div>
                @empty
                <div style="padding:20px;text-align:center;color:var(--apple-gray-500);font-size:13px">Tồn kho đang ổn định.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- TOP PRODUCTS -->
    <div class="col-lg-12">
        <div class="adm-card">
            <div style="padding:20px 24px;border-bottom:1px solid var(--apple-gray-100);display:flex;justify-content:space-between;align-items:center">
                <span class="adm-card-title">🏆 Sản phẩm bán chạy trong tháng</span>
                <span style="font-size:12px;color:var(--apple-gray-500)">tháng {{ date('m/Y') }}</span>
            </div>
            <div class="row g-0">
                @php $rank = 1; @endphp
                @forelse($topProducts as $name => $data)
                <div class="col-md-4" style="border-right:1px solid var(--apple-gray-100);border-bottom:1px solid var(--apple-gray-100)">
                    <div style="padding:15px 24px;display:flex;align-items:center;gap:15px">
                        <div style="width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:11px;
                            {{ $rank===1 ? 'background:#ffd700;color:#000' : ($rank===2 ? 'background:#c0c0c0;color:#000' : ($rank===3 ? 'background:#cd7f32;color:#000' : 'background:var(--apple-gray-100);color:var(--apple-gray-500)')) }}">
                            {{ $rank++ }}
                        </div>
                        <div style="flex:1">
                            <div style="font-size:14px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:180px">{{ $name }}</div>
                            <div style="font-size:12px;color:var(--apple-gray-500)">{{ $data['count'] }} đơn · <span style="color:var(--apple-blue);font-weight:600">{{ number_format($data['revenue']) }}đ</span></div>
                        </div>
                    </div>
                </div>
                @if($rank > 7) @break @endif
                @empty
                <div class="col-12 text-center" style="padding:40px;color:var(--apple-gray-500)">Chưa có dữ liệu tháng này.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const monthlyData = @json($monthlyChartData);
const seriesData = @json($seriesRevenue);

// ── Revenue Trend Chart ───────────────────────────
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const gradient = revenueCtx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(0,113,227,0.2)');
gradient.addColorStop(1, 'rgba(255,255,255,0)');

new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: monthlyData.map(d => d.label),
        datasets: [{
            data: monthlyData.map(d => d.value),
            borderColor: '#0071e3',
            borderWidth: 3,
            backgroundColor: gradient,
            fill: true,
            tension: 0.4,
            pointRadius: 4,
            pointBackgroundColor: '#fff',
            pointBorderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { color: '#f5f5f7' }, ticks: { callback: v => v >= 1000000 ? (v/1000000) + 'M' : v } },
            x: { grid: { display: false } }
        }
    }
});

// ── Category Pie Chart ────────────────────────────
const catCtx = document.getElementById('categoryChart').getContext('2d');
new Chart(catCtx, {
    type: 'doughnut',
    data: {
        labels: Object.keys(seriesData),
        datasets: [{
            data: Object.values(seriesData),
            backgroundColor: ['#0071e3', '#34c759', '#ff9500', '#af52de', '#ff3b30', '#5856d6'],
            borderWidth: 0,
            cutout: '70%'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom', labels: { boxWidth: 8, usePointStyle: true, font: { size: 10 } } }
        }
    }
});
</script>
@endpush
@endsection
