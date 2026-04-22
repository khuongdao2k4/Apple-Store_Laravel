@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 100px; max-width: 800px; margin: 0 auto; padding-bottom: 100px;">
    <div class="mb-5">
        <a href="{{ route('admin.products') }}" style="text-decoration: none; color: #0071e3; font-size: 14px;">&larr; Quay lại danh sách sản phẩm</a>
        <h1 style="font-size: 40px; font-weight: 700; margin-top: 10px;">Thêm Sản phẩm mới</h1>
    </div>

    <div class="card p-5 border-0 shadow-sm" style="border-radius: 20px;">
        <form action="{{ route('store-product') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" placeholder="Ví dụ: iPhone 16 Pro" style="border-radius: 10px; padding: 12px;" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="font-weight: 600;">Series (Mã nhóm)</label>
                    <input type="text" name="series" class="form-control" placeholder="Ví dụ: iphone-16-pro" style="border-radius: 10px; padding: 12px;">
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="font-weight: 600;">Series Title (Tên nhóm hiển thị)</label>
                    <input type="text" name="series_title" class="form-control" placeholder="Ví dụ: iPhone 16 Pro & 16 Pro Max" style="border-radius: 10px; padding: 12px;">
                </div>

                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Series Image (Ảnh gộp đại diện)</label>
                    <input type="text" name="series_image" class="form-control" placeholder="Ví dụ: assets/img/iphone16pro-series.png" style="border-radius: 10px; padding: 12px;">
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="font-weight: 600;">Giá (String format)</label>
                    <input type="text" name="price" class="form-control" placeholder="Ví dụ: $999" style="border-radius: 10px; padding: 12px;" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label" style="font-weight: 600;">Số lượng tồn kho</label>
                    <input type="number" name="quantity" class="form-control" placeholder="100" style="border-radius: 10px; padding: 12px;" required>
                </div>

                <div class="col-md-2">
                    <label class="form-label" style="font-weight: 600;">Thứ tự</label>
                    <input type="number" name="sort_order" class="form-control" value="0" style="border-radius: 10px; padding: 12px;" required>
                </div>

                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Link hình ảnh</label>
                    <input type="text" name="image_url" class="form-control" placeholder="Ví dụ: assets/img/iphone16pro.png" style="border-radius: 10px; padding: 12px;" required>
                </div>

                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Các màu sắc (Cách nhau bằng dấu phẩy)</label>
                    <input type="text" name="colors" class="form-control" placeholder="#000000,#ffffff,#ffd700" style="border-radius: 10px; padding: 12px;">
                    <small class="text-muted">Nhập mã màu Hex, ví dụ: #f5e1c8,#ededed</small>
                </div>

                <div class="col-12 mt-5">
                    <button type="submit" class="btn btn-primary w-100 p-3" style="border-radius: 15px; font-weight: 700; font-size: 16px;">
                        Xác nhận thêm sản phẩm
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
