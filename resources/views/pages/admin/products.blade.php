@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding-top: 100px; max-width: 1400px; margin: 0 auto; padding-bottom: 100px;">
    <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
            <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #0071e3; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-chevron-left" style="font-size: 10px;"></i> Dashboard
            </a>
            <h1 style="font-size: 48px; font-weight: 700; color: #1d1d1f; letter-spacing: -0.5px; margin-top: 10px;">Quản lý sản phẩm</h1>
        </div>
        <div>
            <a href="{{ route('add-product') }}" class="btn btn-primary" style="border-radius: 980px; padding: 12px 24px; font-weight: 600; font-size: 15px; background-color: #0071e3; border: none; transition: all 0.2s;">
                <i class="fa-solid fa-plus me-2"></i> Thêm sản phẩm
            </a>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card border-0 shadow-sm" style="border-radius: 24px; overflow: hidden; background: #ffffff;">
        <div class="table-responsive">
            <table class="table align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                <thead>
                    <tr style="background: #f5f5f7; border-bottom: 1px solid #d2d2d7;">
                        <th class="ps-4 py-3" style="color: #86868b; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; width: 100px;">Ảnh</th>
                        <th class="py-3" style="color: #86868b; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Sản phẩm</th>
                        <th class="py-3" style="color: #86868b; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Giá bán</th>
                        <th class="py-3" style="color: #86868b; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Kho hàng</th>
                        <th class="py-3" style="color: #86868b; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Màu sắc</th>
                        <th class="text-end pe-4 py-3" style="color: #86868b; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr style="border-bottom: 1px solid #f5f5f7; transition: background-color 0.2s;">
                        <td class="ps-4 py-3">
                            <div style="width: 64px; height: 64px; background: #fbfbfb; border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px solid #f2f2f2;">
                                <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" style="width: 48px; height: 48px; object-fit: contain;">
                            </div>
                        </td>
                        <td class="py-3">
                            <div style="font-size: 16px; font-weight: 600; color: #1d1d1f; margin-bottom: 2px;">{{ $product->name }}</div>
                            <div style="font-size: 13px; color: #86868b; font-weight: 400;">Series: {{ $product->series }}</div>
                        </td>
                        <td class="py-3">
                            <div style="font-size: 15px; font-weight: 600; color: #1d1d1f;">{{ $product->price }}</div>
                        </td>
                        <td class="py-3">
                            <span class="badge" style="background: #f5f5f7; color: #1d1d1f; border-radius: 6px; padding: 6px 10px; font-weight: 500; font-size: 13px;">
                                {{ $product->quantity }} chiếc
                            </span>
                        </td>
                        <td class="py-3">
                            <div class="d-flex gap-2">
                                @foreach(explode(',', $product->colors) as $color)
                                    <div style="width: 18px; height: 18px; background: {{ trim($color) }}; border-radius: 50%; border: 1px solid #d2d2d7; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);" title="{{ trim($color) }}"></div>
                                @endforeach
                            </div>
                        </td>
                        <td class="text-end pe-4 py-3">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('edit-product', ['id' => $product->id]) }}" class="btn btn-sm btn-light" style="border-radius: 8px; padding: 6px 14px; font-weight: 600; color: #0071e3; background: #f5f5f7; border: none; transition: all 0.2s;">
                                    Sửa
                                </a>
                                <button onclick="deleteProduct({{ $product->id }})" class="btn btn-sm btn-light" style="border-radius: 8px; padding: 6px 14px; font-weight: 600; color: #d33; background: #f5f5f7; border: none; transition: all 0.2s;">
                                    Xoá
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="mt-5 d-flex justify-content-center">
        <div class="apple-pagination">
            {{ $products->links() }}
        </div>
    </div>
    @endif
</div>

<style>
    .apple-pagination .pagination {
        gap: 8px;
    }
    .apple-pagination .page-item .page-link {
        border-radius: 10px !important;
        border: none;
        color: #1d1d1f;
        background: #f5f5f7;
        padding: 8px 16px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .apple-pagination .page-item.active .page-link {
        background-color: #0071e3;
        color: white;
    }
    .apple-pagination .page-item .page-link:hover {
        background-color: #e8e8ed;
    }
    
    tr:hover {
        background-color: #fafafa !important;
    }
    
    .btn-light:hover {
        background-color: #e8e8ed !important;
        transform: scale(1.02);
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteProduct(id) {
        Swal.fire({
            title: 'Xoá sản phẩm?',
            text: "Dữ liệu này sẽ biến mất vĩnh viễn khỏi hệ thống của bạn.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#86868b',
            confirmButtonText: 'Đồng ý xoá',
            cancelButtonText: 'Huỷ bỏ',
            border_radius: '20px',
            customClass: {
                popup: 'apple-alert-popup',
                confirmButton: 'apple-alert-confirm',
                cancelButton: 'apple-alert-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
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
<style>
    .apple-alert-popup {
        border-radius: 20px !important;
        padding: 20px !important;
    }
    .apple-alert-confirm {
        border-radius: 12px !important;
        padding: 10px 24px !important;
        font-weight: 600 !important;
    }
    .apple-alert-cancel {
        border-radius: 12px !important;
        padding: 10px 24px !important;
        font-weight: 600 !important;
    }
</style>
@endpush
@endsection
