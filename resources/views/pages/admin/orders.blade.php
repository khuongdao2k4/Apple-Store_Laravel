@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding-top: 100px; max-width: 1400px; margin: 0 auto; padding-bottom: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #0071e3; font-size: 14px;">&larr; Quay lại Dashboard</a>
            <h1 style="font-size: 40px; font-weight: 700; margin-top: 10px;">Quản lý Đơn hàng</h1>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary" style="border-radius: 20px;" onclick="location.reload()"><i class="fa-solid fa-rotate"></i> Làm mới</button>
        </div>
    </div>

    <!-- Filter/Search Placeholder -->
    <div class="card p-3 border-0 shadow-sm mb-4" style="border-radius: 15px;">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span style="color: #86868b;">Tổng số đơn hàng: <strong>{{ $orders->total() }}</strong></span>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card p-0 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #fafafa;">
                    <tr style="color: #86868b; font-size: 13px;">
                        <th class="ps-4">ID</th>
                        <th>Thông tin khách hàng</th>
                        <th>Sản phẩm & Tùy chọn</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="ps-4" style="font-weight: 600;">#{{ $order->id_order }}</td>
                        <td>
                            <div style="font-weight: 600; color: #1d1d1f;">{{ $order->username }}</div>
                            <div style="font-size: 12px; color: #86868b;">{{ $order->email }}</div>
                            <div style="font-size: 12px; color: #86868b;">{{ $order->phone }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 500;">{{ $order->product }}</div>
                            <div style="font-size: 12px; color: #86868b;">{{ $order->storage }} | {{ $order->color }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: #1d1d1f;">${{ number_format(floatval(preg_replace('/[^0-9]/', '', $order->price))) }}</div>
                            <div style="font-size: 11px; text-transform: uppercase; color: #86868b;">{{ $order->payment_method }}</div>
                        </td>
                        <td>
                            <select onchange="updateStatus({{ $order->id_order }}, this.value)" class="form-select status-select status-{{ strtolower($order->status) }}" style="width: 140px; border-radius: 20px; font-size: 13px; font-weight: 500;">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ $order->status == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-link py-0" style="color: #0071e3; font-size: 14px;" onclick="viewDetail({{ $order->id_order }})">Chi tiết</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
</div>

@push('styles')
<style>
    .status-select { border: none; padding: 5px 15px; }
    .status-pending { background-color: #fff4e5 !important; color: #b25e09 !important; }
    .status-paid { background-color: #e5f9e7 !important; color: #1e7e34 !important; }
    .status-shipped { background-color: #e3f2fd !important; color: #0071e3 !important; }
    .status-failed { background-color: #ffe5e5 !important; color: #d32f2f !important; }
    .status-completed { background-color: #f5f5f7 !important; color: #1d1d1f !important; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    async function updateStatus(id, newStatus) {
        try {
            const response = await fetch('{{ route('admin.order.update-status') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ id_order: id, status: newStatus })
            });

            const result = await response.json();
            if (result.success) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
                Toast.fire({
                    icon: 'success',
                    title: result.message
                });
                
                // Update select class
                const select = event.target;
                select.className = 'form-select status-select status-' + newStatus.toLowerCase();
            } else {
                Swal.fire('Lỗi', result.message, 'error');
            }
        } catch (error) {
            console.error(error);
            Swal.fire('Lỗi', 'Không thể kết nối đến máy chủ', 'error');
        }
    }

    function viewDetail(id) {
        Swal.fire({
            title: 'Chi tiết đơn hàng #' + id,
            text: 'Tính năng đang được phát triển. Bạn có thể xem thông tin cơ bản ngay tại danh sách.',
            icon: 'info'
        });
    }
</script>
@endpush
@endsection
