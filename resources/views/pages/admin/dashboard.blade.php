@extends('layouts.app')

@section('content')
<div class="admin-dashboard container-fluid" style="padding-top: 100px; max-width: 1200px; margin: 0 auto;">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 style="font-size: 40px; font-weight: 700;">Hệ thống Quản trị</h1>
        <div>
            <span class="badge bg-primary p-2 px-3" style="border-radius: 20px;">Administrator</span>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="stat-card p-4 shadow-sm" style="background: white; border-radius: 20px; border: 1px solid #f5f5f7;">
                <p style="color: #86868b; font-size: 14px; margin-bottom: 5px;">Tổng doanh thu</p>
                <h3 style="font-weight: 700; color: #1d1d1f;">${{ number_format($totalRevenue) }}</h3>
                <div style="font-size: 12px; color: #1e7e34;">+12% so với tháng trước</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card p-4 shadow-sm" style="background: white; border-radius: 20px; border: 1px solid #f5f5f7;">
                <p style="color: #86868b; font-size: 14px; margin-bottom: 5px;">Đơn hàng chờ duyệt</p>
                <h3 style="font-weight: 700; color: #1d1d1f;">{{ $pendingOrdersCount }}</h3>
                <div style="font-size: 12px; color: #0071e3;"><a href="{{ route('admin.orders') }}">Xem tất cả &rarr;</a></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card p-4 shadow-sm" style="background: white; border-radius: 20px; border: 1px solid #f5f5f7;">
                <p style="color: #86868b; font-size: 14px; margin-bottom: 5px;">Sản phẩm đang bán</p>
                <h3 style="font-weight: 700; color: #1d1d1f;">{{ $productsCount }}</h3>
                <div style="font-size: 12px; color: #0071e3;"><a href="{{ route('admin.products') }}">Quản lý &rarr;</a></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card p-4 shadow-sm" style="background: white; border-radius: 20px; border: 1px solid #f5f5f7;">
                <p style="color: #86868b; font-size: 14px; margin-bottom: 5px;">Người dùng hệ thống</p>
                <h3 style="font-weight: 700; color: #1d1d1f;">{{ $usersCount }}</h3>
                <div style="font-size: 12px; color: #86868b;">Hoạt động tích cực</div>
            </div>
        </div>
    </div>

    <!-- Navigation Shortcuts -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="action-card p-4" onclick="location.href='{{ route('admin.orders') }}'" style="background: #fafafa; border-radius: 20px; cursor: pointer; transition: transform 0.2s;">
                <i class="fa-solid fa-box-open mb-3" style="font-size: 32px; color: #0071e3;"></i>
                <h4 style="font-weight: 600;">Duyệt Đơn hàng</h4>
                <p style="color: #86868b; font-size: 14px;">Quản lý và cập nhật trạng thái các đơn hàng mới từ khách hàng.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="action-card p-4" onclick="location.href='{{ route('admin.products') }}'" style="background: #fafafa; border-radius: 20px; cursor: pointer; transition: transform 0.2s;">
                <i class="fa-solid fa-plus mb-3" style="font-size: 32px; color: #1e7e34;"></i>
                <h4 style="font-weight: 600;">Quản lý Sản phẩm</h4>
                <p style="color: #86868b; font-size: 14px;">Thêm sản phẩm mới hoặc chỉnh sửa thông tin sản phẩm hiện tại.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="action-card p-4" onclick="location.href='{{ route('statistics') }}'" style="background: #fafafa; border-radius: 20px; cursor: pointer; transition: transform 0.2s;">
                <i class="fa-solid fa-chart-line mb-3" style="font-size: 32px; color: #b25e09;"></i>
                <h4 style="font-weight: 600;">Báo cáo Doanh thu</h4>
                <p style="color: #86868b; font-size: 14px;">Xem đồ thị và thống kê chi tiết lợi nhuận theo từng tháng.</p>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="card p-4 border-0 shadow-sm" style="border-radius: 20px;">
        <h4 class="mb-4" style="font-weight: 700;">Đơn hàng gần đây</h4>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr style="color: #86868b; font-size: 13px;">
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                    <tr>
                        <td style="font-weight: 600;">#{{ $order->id_order }}</td>
                        <td>{{ $order->username }}</td>
                        <td>{{ $order->product }}</td>
                        <td>${{ number_format(floatval(preg_replace('/[^0-9]/', '', $order->price))) }}</td>
                        <td>
                            <span class="badge rounded-pill p-2 px-3 status-{{ strtolower($order->status) }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td style="color: #86868b; font-size: 13px;">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .action-card:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .status-pending { background: #fff4e5; color: #b25e09; }
    .status-paid { background: #e5f9e7; color: #1e7e34; }
    .status-shipped { background: #e3f2fd; color: #0071e3; }
    .status-failed { background: #ffe5e5; color: #d32f2f; }
</style>
@endsection
