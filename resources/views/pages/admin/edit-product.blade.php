@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 100px; max-width: 800px; margin: 0 auto; padding-bottom: 100px;">
    <div class="mb-5">
        <a href="{{ route('admin.products') }}" style="text-decoration: none; color: #0071e3; font-size: 14px;">&larr; Quay lại danh sách sản phẩm</a>
        <h1 style="font-size: 40px; font-weight: 700; margin-top: 10px;">Chỉnh sửa Sản phẩm</h1>
    </div>

    <div class="card p-5 border-0 shadow-sm" style="border-radius: 20px;">
        <form action="{{ route('update-product') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="row g-4">
                <div class="col-12 text-center mb-3">
                    <img src="{{ asset($product->image_url) }}" alt="Preview" style="max-width: 150px; border-radius: 15px; border: 1px solid #f5f5f7;">
                </div>

                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" style="border-radius: 10px; padding: 12px;" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="font-weight: 600;">Series (Mã nhóm)</label>
                    <input type="text" name="series" class="form-control" value="{{ $product->series }}" style="border-radius: 10px; padding: 12px;">
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="font-weight: 600;">Series Title (Tên nhóm hiển thị)</label>
                    <input type="text" name="series_title" class="form-control" value="{{ $product->series_title }}" style="border-radius: 10px; padding: 12px;">
                </div>

                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Series Image (Ảnh gộp đại diện)</label>
                    <input type="text" name="series_image" class="form-control" value="{{ $product->series_image }}" style="border-radius: 10px; padding: 12px;">
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="font-weight: 600;">Giá (String format)</label>
                    <input type="text" name="price" class="form-control" value="{{ $product->price }}" style="border-radius: 10px; padding: 12px;" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label" style="font-weight: 600;">Số lượng tồn kho</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" style="border-radius: 10px; padding: 12px;" required>
                </div>

                <div class="col-md-2">
                    <label class="form-label" style="font-weight: 600;">Thứ tự</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ $product->sort_order }}" style="border-radius: 10px; padding: 12px;" required>
                </div>

                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Link hình ảnh</label>
                    <input type="text" name="image_url" class="form-control" value="{{ $product->image_url }}" style="border-radius: 10px; padding: 12px;" required>
                </div>

                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Các màu sắc</label>
                    <input type="text" name="colors" class="form-control" value="{{ $product->colors }}" style="border-radius: 10px; padding: 12px;">
                </div>

                <div class="col-12 mt-5">
                    <button type="submit" class="btn btn-primary w-100 p-3" style="border-radius: 15px; font-weight: 700; font-size: 16px;">
                        Lưu thay đổi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
