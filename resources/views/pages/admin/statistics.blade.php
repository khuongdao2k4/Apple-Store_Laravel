@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding-top: 100px; max-width: 1200px; margin: 0 auto; padding-bottom: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #0071e3; font-size: 14px;">&larr; Quay lại Dashboard</a>
            <h1 style="font-size: 40px; font-weight: 700; margin-top: 10px;">Thống kê Doanh thu</h1>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card p-4 border-0 shadow-sm mb-5" style="border-radius: 20px;">
        <form method="GET" action="{{ route('statistics') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label" style="font-weight: 600;">Chọn Tháng</label>
                <select name="month" class="form-select" style="border-radius: 10px; padding: 10px;">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ sprintf('%02d', $m) }}" {{ $month == $m ? 'selected' : '' }}>Tháng {{ $m }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" style="font-weight: 600;">Chọn Năm</label>
                <select name="year" class="form-select" style="border-radius: 10px; padding: 10px;">
                    @for ($y = 2020; $y <= date('Y'); $y++)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>Năm {{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100 p-2" style="border-radius: 10px; font-weight: 600;">Xem báo cáo</button>
            </div>
        </form>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <div class="p-5 text-center shadow-sm" style="background: white; border-radius: 25px; border: 1px solid #f5f5f7;">
                <p style="color: #86868b; font-size: 18px;">Tổng doanh thu tháng {{ (int)$month }}/{{ $year }}</p>
                <h2 style="font-size: 64px; font-weight: 800; color: #1d1d1f; margin: 20px 0;">${{ number_format($totalRevenue) }}</h2>
                <span class="badge bg-success p-2 px-3" style="border-radius: 20px;">Dựa trên {{ $orders->count() }} đơn hàng đã thanh toán</span>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card p-4 border-0 shadow-sm" style="border-radius: 20px;">
        <h4 class="mb-4" style="font-weight: 700;">Chi tiết các đơn hàng trong tháng</h4>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr style="color: #86868b; font-size: 13px;">
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td style="font-weight: 600;">#{{ $order->id_order }}</td>
                        <td>{{ $order->username }}</td>
                        <td>{{ $order->product }}</td>
                        <td style="font-weight: 600;">${{ number_format(floatval(preg_replace('/[^0-9]/', '', $order->price))) }}</td>
                        <td style="color: #86868b; font-size: 13px;">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge rounded-pill p-2 px-3 bg-light text-success" style="text-transform: uppercase; font-size: 10px;">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center p-5 text-muted">Không có dữ liệu trong thời gian này</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
