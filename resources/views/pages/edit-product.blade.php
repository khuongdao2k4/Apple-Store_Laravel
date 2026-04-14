@extends('layouts.app', ['pageTitle' => 'edit-product.php'])

@section('content')
@php
    // Guard: admin only
    if (session('role') !== 'admin') {
        echo "<script>alert('Bạn không có quyền truy cập!'); window.location.href='/mua-iphone';</script>";
    }
    // $product is passed from PageController@editProduct
    $product = $product ?? ['id'=>'','name'=>'','image_url'=>'','colors'=>'','price'=>''];
@endphp

<h5 class="page-title">Chỉnh Sửa Sản Phẩm</h5>

<div class="banner">
    <div class="text-content">
        <h1>Phối. Hợp. MagSafe.</h1>
        <p>Gắn thêm ốp lưng, ví hoặc bộ sạc không dây.</p>
        <a href="#">Mua MagSafe &gt;</a>
    </div>
</div>

<div class="edit-product-container">
    <h2>Chỉnh Sửa Sản Phẩm</h2>
    
    <form action="{{ route('edit-product') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $product['id'] }}">

        <div class="mb-4">
            <input type="text" class="form-control" id="name" name="name" 
                value="{{ htmlspecialchars($product['name']) }}" placeholder="Tên Sản Phẩm" required>
        </div>

        <div class="mb-4">
            <input type="url" class="form-control" id="image_url" name="image_url" 
                value="{{ htmlspecialchars($product['image_url']) }}" placeholder="URL Hình ảnh sản phẩm" required>
            <div id="image-preview-container">
                <img id="image-preview" src="{{ htmlspecialchars($product['image_url']) }}" alt="Preview">
            </div>
        </div>

        <div class="mb-4">
            <input type="text" class="form-control" id="colors" name="colors" 
                value="{{ htmlspecialchars($product['colors']) }}" placeholder="Màu sắc (VD: gray, silver)" required>
        </div>

        <div class="mb-4">
            <input type="number" class="form-control" id="price" name="price" 
                value="{{ htmlspecialchars($product['price']) }}" placeholder="Giá sản phẩm" required>
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        </div>
    </form>
</div>

@endsection
