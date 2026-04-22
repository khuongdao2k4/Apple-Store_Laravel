@extends('layouts.app', ['pageTitle' => 'login.php'])

@section('content')




<div class="header-container">
        <h3 style="font-size: 25px"><b>Apple Account</b></h3>
        <div class="nav-menu">
            <a href="register" style="text-decoration: none;">Register</a>
            <a href="register" style="text-decoration: none;">Tạo Tài khoản Apple</a>
            <a href="#" style="text-decoration: none;">Những Câu Hỏi Thường Gặp</a>
        </div>
    </div>
    <div class="info-bar mb-4">
        ID Apple bây giờ là Tài khoản Apple. Bạn vẫn có thể đăng nhập bằng cùng địa chỉ email hoặc số điện thoại và mật khẩu như trước đây. <a href="#">Tìm hiểu thêm</a>
    </div>
    <div class="container">
        <div class="login-container">
            <div class="text-center mb-3">
                <i class="fab fa-apple" style="font-size: 48px; color: #1d1d1f;"></i>
            </div>
            <h2 class="text-center fw-bold mb-3" style="font-size: 30px; letter-spacing: -0.02em;">Tài khoản Apple</h2>
            <p class="text-center text-muted mb-4" style="font-size: 17px;">Quản lý Tài khoản Apple của bạn</p>

            @if (session('error'))
                <div class="alert alert-danger text-start"> {{ session('error') }} </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success text-start"> {{ session('success') }} </div>
            @endif

            <form action="login" method="POST">
                @csrf
                <div class="apple-input-group mb-4">
                    <input type="email" class="apple-input" name="email" placeholder="Email hoặc Số điện thoại" required>
                    <div class="apple-input-divider"></div>
                    <input type="password" class="apple-input" name="password" placeholder="Mật khẩu" required>
                </div>
                
                <div class="remember-me mb-4 d-flex justify-content-between align-items-center px-1">
                    <div class="form-check text-start mb-0">
                        <input class="form-check-input" type="checkbox" id="remember" style="margin-top: 0.3em;">
                        <label class="form-check-label text-muted" for="remember" style="font-size: 15px; user-select: none;">Ghi nhớ tôi</label>
                    </div>
                    <div>
                        <a href="reset-password" class="text-primary text-decoration-none" style="font-size: 15px;">Bạn đã quên mật khẩu?</a>
                    </div>
                </div>
                
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary btn-apple-login">Đăng Nhập <i class="fa fa-arrow-right ms-2" style="font-size: 14px;"></i></button>
                </div>
                
                <hr class="my-4 text-muted" style="opacity: 0.15;">
                
                <div class="text-center text-muted" style="font-size: 15px;">
                    Bạn không có Tài khoản Apple? <a href="register" class="text-primary text-decoration-none" style="font-weight: 500;">Tạo tài khoản của bạn ngay bây giờ.</a>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <h5 style="padding-left:290px">Bạn cần hỗ trợ thêm? <a href="">Chat ngay</a>(Mở trong cửa sổ mới) hoặc gọi
        1800-1192.</h5>
    <hr style="margin-bottom:0px">



@endsection
