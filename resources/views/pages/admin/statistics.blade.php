@extends('layouts.admin')
@section('title', 'Thống kê Doanh thu')
@section('content')

<div class="page-hdr">
    <h1>Thống kê Doanh thu</h1>
    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span> Thống kê
    </div>
</div>

<!-- FILTER -->
<div class="adm-card mb-4">
    <div style="padding:14px 20px;border-bottom:1px solid var(--apple-gray-100)"><span class="adm-card-title">Lọc theo thời gian</span></div>
    <div class="adm-card-body">
        <form method="GET" action="{{ route('statistics') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="f-label">Tháng</label>
                    <select name="month" class="f-input" style="appearance:none">
                        @for($m=1;$m<=12;$m++)
                        <option value="{{ sprintf('%02d',$m) }}" {{ $month==$m?'selected':'' }}>Tháng {{ $m }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="f-label">Năm</label>
                    <select name="year" class="f-input" style="appearance:none">
                        @for($y=2020;$y<=date('Y');$y++)
                        <option value="{{ $y }}" {{ $year==$y?'selected':'' }}>Năm {{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn-apple btn-filled" style="width:100%;justify-content:center">
                        <span class="material-icons-round">search</span> Xem báo cáo
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- SUMMARY STATS -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#0071e3,#005acd);border:none">
            <div class="stat-label" style="color:rgba(255,255,255,.75)">Tổng doanh thu tháng {{ (int)$month }}/{{ $year }}</div>
            <div class="stat-value" style="color:#fff;font-size:34px;margin:8px 0">{{ number_format($totalRevenue) }}đ</div>
            <div class="stat-meta" style="color:rgba(255,255,255,.7)">
                <span class="material-icons-round" style="font-size:14px">receipt</span> {{ $orders->count() }} đơn đã thanh toán
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#d4edda"><span class="material-icons-round" style="color:#28a745">check_circle</span></div>
            <div class="stat-label">Đơn hoàn tất</div>
            <div class="stat-value">{{ $orders->count() }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff4d9"><span class="material-icons-round" style="color:#f59e0b">analytics</span></div>
            <div class="stat-label">Trung bình mỗi đơn</div>
            <div class="stat-value" style="font-size:20px">{{ $orders->count()>0 ? number_format($totalRevenue/$orders->count()) : '0' }}đ</div>
        </div>
    </div>
</div>

<!-- CHARTS ROW -->
<div class="row g-3 mb-4">
    <!-- Chart 1: Daily Revenue -->
    <div class="col-lg-7">
        <div class="adm-card">
            <div style="padding:18px 20px 12px;border-bottom:1px solid var(--apple-gray-100)">
                <span class="adm-card-title">Doanh thu theo ngày — Tháng {{ (int)$month }}/{{ $year }}</span>
            </div>
            <div style="padding:20px 20px 16px">
                <canvas id="dailyChart" height="220"></canvas>
            </div>
        </div>
    </div>
    <!-- Chart 2: Product Revenue Doughnut -->
    <div class="col-lg-5">
        <div class="adm-card">
            <div style="padding:18px 20px 12px;border-bottom:1px solid var(--apple-gray-100)">
                <span class="adm-card-title">Doanh thu theo sản phẩm</span>
            </div>
            <div style="padding:16px">
                @if(count($productChartData) > 0)
                    <canvas id="productChart" height="260"></canvas>
                @else
                    <div class="empty-state" style="padding:40px">
                        <span class="material-icons-round">donut_large</span>
                        <p>Không có dữ liệu</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ORDERS TABLE -->
<div class="adm-card">
    <div style="padding:16px 20px 14px;border-bottom:1px solid var(--apple-gray-100)">
        <span class="adm-card-title">Chi tiết đơn hàng — Tháng {{ (int)$month }}/{{ $year }}</span>
    </div>
    <div class="table-responsive">
        <table class="adm-table">
            <thead><tr>
                <th>ID</th><th>Khách hàng</th><th>Sản phẩm</th><th>Tổng tiền</th><th>Ngày tạo</th><th>Trạng thái</th>
            </tr></thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><span style="font-weight:600;color:var(--apple-blue)">#{{ $order->id_order }}</span></td>
                    <td>{{ $order->username }}</td>
                    <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $order->product }}</td>
                    <td style="font-weight:600">{{ number_format(floatval(preg_replace('/[^0-9]/','', $order->price))) }}đ</td>
                    <td style="color:var(--apple-gray-500);font-size:13px">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td><span class="chip chip-{{ strtolower($order->status) }}">{{ $order->status }}</span></td>
                </tr>
                @empty
                <tr><td colspan="6">
                    <div class="empty-state"><span class="material-icons-round">bar_chart</span><p>Không có dữ liệu trong thời gian này.</p></div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// ── Daily Revenue Line/Bar Chart ──────────────────
const dailyRaw = @json($dailyData);
const dailyCtx = document.getElementById('dailyChart').getContext('2d');

const gradientDaily = dailyCtx.createLinearGradient(0, 0, 0, 280);
gradientDaily.addColorStop(0, 'rgba(0,113,227,0.25)');
gradientDaily.addColorStop(1, 'rgba(0,113,227,0)');

new Chart(dailyCtx, {
    type: 'line',
    data: {
        labels: dailyRaw.map(d => d.day),
        datasets: [{
            label: 'Doanh thu',
            data: dailyRaw.map(d => d.value),
            borderColor: '#0071e3',
            backgroundColor: gradientDaily,
            fill: true,
            tension: 0.4,
            pointRadius: dailyRaw.map(d => d.value > 0 ? 4 : 0),
            pointBackgroundColor: '#0071e3',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            borderWidth: 2.5,
        }]
    },
    options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: 'rgba(29,29,31,0.92)',
                titleFont: { family: 'Inter', size: 12 },
                bodyFont: { family: 'Inter', size: 12 },
                padding: 10,
                callbacks: {
                    title: ctx => 'Ngày ' + ctx[0].label,
                    label: ctx => ' ' + new Intl.NumberFormat('vi-VN').format(ctx.raw) + 'đ'
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#f0f0f2' },
                ticks: {
                    font: { family: 'Inter', size: 11 }, color: '#86868b',
                    callback: v => v >= 1e9 ? (v/1e9).toFixed(1)+'B' : v >= 1e6 ? (v/1e6).toFixed(0)+'M' : v
                }
            },
            x: {
                grid: { display: false },
                ticks: {
                    font: { family: 'Inter', size: 11 }, color: '#86868b',
                    maxTicksLimit: 15,
                    callback: (val, i) => (dailyRaw[i].value > 0 ? dailyRaw[i].day : '')
                }
            }
        }
    }
});

// ── Product Doughnut Chart ────────────────────────
@if(count($productChartData) > 0)
const prodData = @json($productChartData);
const prodCtx = document.getElementById('productChart').getContext('2d');
const prodColors = ['#0071e3','#34c759','#ff9f0a','#ff375f','#bf5af2','#5ac8fa','#ff6b35','#00c7be'];

new Chart(prodCtx, {
    type: 'doughnut',
    data: {
        labels: Object.keys(prodData),
        datasets: [{
            data: Object.values(prodData),
            backgroundColor: prodColors,
            borderWidth: 3,
            borderColor: '#fff',
            hoverOffset: 10,
        }]
    },
    options: {
        cutout: '58%',
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    font: { family: 'Inter', size: 11 }, color: '#3a3a3c',
                    padding: 10, boxWidth: 10, boxHeight: 10, usePointStyle: true,
                    generateLabels: chart => {
                        const total = chart.data.datasets[0].data.reduce((a,b)=>a+b,0);
                        return chart.data.labels.map((label, i) => ({
                            text: label + ' (' + (chart.data.datasets[0].data[i]/total*100).toFixed(1) + '%)',
                            fillStyle: prodColors[i % prodColors.length],
                            strokeStyle: '#fff',
                            lineWidth: 2,
                            index: i,
                            pointStyle: 'circle',
                        }));
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: ctx => ' ' + new Intl.NumberFormat('vi-VN').format(ctx.raw) + 'đ'
                }
            }
        }
    }
});
@endif
</script>
@endpush
@endsection
