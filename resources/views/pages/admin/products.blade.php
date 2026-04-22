@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding-top: 100px; max-width: 1400px; margin: 0 auto; padding-bottom: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #0071e3; font-size: 14px;">&larr; Quay lại Dashboard</a>
            <h1 style="font-size: 40px; font-weight: 700; margin-top: 10px;">Quản lý Sản phẩm</h1>
        </div>
        <div>
            <a href="{{ route('add-product') }}" class="btn btn-primary p-2 px-4" style="border-radius: 20px; font-weight: 600;">
                <i class="fa-solid fa-plus me-2"></i> Thêm sản phẩm mới
            </a>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card p-0 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #fafafa;">
                    <tr style="color: #86868b; font-size: 13px;">
                        <th class="ps-4">Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                        <th>Màu sắc</th>
                        <th class="text-end pe-4">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="ps-4">
                            <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" style="width: 60px; height: 60px; object-fit: contain; border-radius: 10px;">
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #1d1d1f;">{{ $product->name }}</div>
                            <div style="font-size: 12px; color: #86868b;">ID: #{{ $product->id }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $product->price }}</div>
                        </td>
                        <td>
                            <div class="badge bg-light text-dark p-2 px-3" style="border-radius: 10px;">{{ $product->quantity }} chiếc</div>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                @foreach(explode(',', $product->colors) as $color)
                                    <div style="width: 15px; height: 15px; background: {{ trim($color) }}; border-radius: 50%; border: 1px solid #d2d2d7;"></div>
                                @endforeach
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('edit-product', ['id' => $product->id]) }}" class="btn btn-outline-primary btn-sm me-2" style="border-radius: 15px;">Sửa</a>
                            <button onclick="deleteProduct({{ $product->id }})" class="btn btn-outline-danger btn-sm" style="border-radius: 15px;">Xóa</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteProduct(id) {
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Dữ liệu sản phẩm sẽ bị xóa vĩnh viễn và không thể khôi phục!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#86868b',
            confirmButtonText: 'Có, xóa ngay!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                // Post to delete-product route
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('delete-product') }}';
                
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                
                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'id';
                idInput.value = id;
                
                form.appendChild(csrf);
                form.appendChild(idInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endpush
@endsection
