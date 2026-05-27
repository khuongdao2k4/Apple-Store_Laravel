@extends('layouts.app', ['pageTitle' => 'reset-password.php'])

@section('content')



<div class="header-container">
    <h3 style="font-size: 25px"><b>Apple Account</b></h3>
    <div class="nav-menu">
        <a href="login" style="text-decoration: none;">Đăng Nhập</a>
        <a href="register" style="text-decoration: none;">Tạo Tài khoản Apple</a>
        <a href="#" style="text-decoration: none;">Những Câu Hỏi Thường Gặp</a>
    </div>
</div>
<div class="info-bar mb-4">
    ID Apple bây giờ là Tài khoản Apple. Nhập email của bạn để thiết lập lại mật khẩu an toàn. <a href="#">Tìm hiểu thêm</a>
</div>
<div class="container">
    <div class="login-container">
        <div class="text-center mb-3">
            <i class="fa fa-lock" style="font-size: 48px; color: #1d1d1f;"></i>
        </div>
        <h2 class="text-center fw-bold mb-3" style="font-size: 28px; letter-spacing: -0.02em;">Khôi phục Mật khẩu</h2>
        <p class="text-center text-muted mb-4" style="font-size: 15px;">Vui lòng nhập Email và mật khẩu mới để thiết lập lại.</p>

        @if (session('error'))
            <div class="alert alert-danger text-start">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success text-start">
                {{ session('success') }}
            </div>
            <div class="text-center mb-4">
                <a href="login" class="btn btn-outline-primary btn-sm rounded-pill px-4">Đăng nhập ngay</a>
            </div>
        @endif

        <form action="{{ route('reset-password.post') }}" method="POST" id="resetPasswordForm">
            @csrf
            <div class="apple-input-group mb-3">
                <input type="email" class="apple-input" name="email" value="{{ old('email') }}" placeholder="Email đăng nhập" required>
            </div>
            @error('email')
                <div class="error-text google-error-msg text-start" data-for="email">
                    <i class="fa-solid fa-circle-exclamation google-error-icon"></i> <span>{{ $message }}</span>
                </div>
            @enderror
            
            <div class="apple-input-group mb-3 mt-3">
                <input type="password" class="apple-input" name="password" placeholder="Mật khẩu mới" required>
            </div>
            @error('password')
                <div class="error-text google-error-msg text-start" data-for="password">
                    <i class="fa-solid fa-circle-exclamation google-error-icon"></i> <span>{{ $message }}</span>
                </div>
            @enderror
            
            <div class="apple-input-group mb-4 mt-3">
                <input type="password" class="apple-input" name="confirm_password" placeholder="Xác nhận Mật khẩu" required>
            </div>
            @error('confirm_password')
                <div class="error-text google-error-msg text-start" data-for="confirm_password">
                    <i class="fa-solid fa-circle-exclamation google-error-icon"></i> <span>{{ $message }}</span>
                </div>
            @enderror
            
            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-primary btn-apple-login">Cài đặt lại Mật khẩu <i class="fa fa-arrow-right ms-2" style="font-size: 14px;"></i></button>
            </div>
            
            <hr class="my-4 text-muted" style="opacity: 0.15;">
            
            <div class="text-center text-muted" style="font-size: 15px;">
                Bạn nhớ ra mật khẩu? <a href="login" class="text-primary text-decoration-none" style="font-weight: 500;">Quay lại Đăng nhập.</a>
            </div>
        </form>
    </div>
</div>

<hr>
<h5 class="text-center my-4" style="font-size:16px;">
    Bạn cần hỗ trợ thêm? <a href="#" class="text-primary text-decoration-none">Chat ngay</a> (Mở trong cửa sổ mới) hoặc gọi 1800-1192.
</h5>
<hr style="margin-bottom:0px">



<style>
/* Hiệu ứng mượt mà khi báo lỗi */
@keyframes slideDownFade {
    0% { opacity: 0; transform: translateY(-3px); }
    100% { opacity: 1; transform: translateY(0); }
}
.google-error-msg {
    color: #c80000 !important;
    background-color: #fdf2f2;
    border: 1px solid #f5c2c7;
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    display: flex;
    align-items: flex-start;
    gap: 8px;
    margin-top: 6px;
    margin-bottom: 12px;
    box-shadow: 0 2px 4px rgba(200, 0, 0, 0.05);
    animation: slideDownFade 0.2s ease-out forwards;
}
.google-error-icon {
    font-size: 15px;
    margin-top: 2px;
    color: #d93025;
}
.google-invalid-input {
    border: 2px solid #e30000 !important;
    border-radius: 12px;
}
.google-invalid-input:focus-within {
    box-shadow: 0 0 0 4px rgba(227, 0, 0, 0.15) !important;
    border-color: #e30000 !important;
}
.google-valid-input {
    border: 2px solid #34c759 !important;
    border-radius: 12px;
}
.google-valid-input:focus-within {
    box-shadow: 0 0 0 4px rgba(52, 199, 89, 0.15) !important;
    border-color: #34c759 !important;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const rules = {
        email: { 
            required: true, 
            pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 
            message: "Vui lòng nhập một địa chỉ email hợp lệ." 
        },
        password: { 
            required: true, 
            pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\W]{8,}$/,
            message: "Mật khẩu mới chưa đủ mạnh. Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường và chữ số." 
        },
        confirm_password: {
            required: true,
            match: 'password',
            message: "Mật khẩu xác nhận không khớp."
        }
    };

    function validateField(input) {
        const name = input.name;
        if (!rules[name]) return true;
        
        let isValid = true;
        let errorMessage = rules[name].message;
        const val = input.value.trim();

        if (rules[name].required && val === "") {
            isValid = false;
        } else if (rules[name].pattern && !rules[name].pattern.test(val)) {
            isValid = false;
        } else if (rules[name].match) {
            const matchInput = document.querySelector(`input[name="${rules[name].match}"]`);
            if (val !== matchInput.value) {
                isValid = false;
            }
        }

        const group = input.closest('.apple-input-group') || input;
        let errorEl = group.parentNode.querySelector('.error-text[data-for="'+name+'"]');
        if (!errorEl) {
            errorEl = document.createElement('div');
            errorEl.className = 'error-text google-error-msg text-start';
            errorEl.setAttribute('data-for', name);
            group.parentNode.insertBefore(errorEl, group.nextSibling);
        }

        if (!isValid) {
            group.classList.add('google-invalid-input');
            group.classList.remove('google-valid-input');
            errorEl.innerHTML = `<i class="fa-solid fa-circle-exclamation google-error-icon"></i> <span>${errorMessage}</span>`;
            errorEl.style.display = 'flex';
        } else {
            group.classList.remove('google-invalid-input');
            if(val !== "") {
                group.classList.add('google-valid-input');
            } else {
                group.classList.remove('google-valid-input');
            }
            errorEl.style.display = 'none';
        }
        return isValid;
    }

    const form = document.getElementById('resetPasswordForm');
    if(form) {
        const inputs = form.querySelectorAll('input[name="email"], input[name="password"], input[name="confirm_password"]');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                const name = input.name;
                if (!rules[name]) return;
                
                const group = input.closest('.apple-input-group') || input;
                group.classList.remove('google-valid-input');
                
                let errorEl = group.parentNode.querySelector('.error-text[data-for="'+name+'"]');
                if (errorEl && errorEl.style.display !== 'none') {
                    if (name === 'confirm_password') {
                        validateField(input);
                    } else {
                        group.classList.remove('google-invalid-input');
                        errorEl.style.display = 'none';
                    }
                }
            });
        });

        form.addEventListener('submit', function(e) {
            let isFormValid = true;
            inputs.forEach(input => {
                if (rules[input.name]) {
                    if (!validateField(input)) {
                        isFormValid = false;
                    }
                }
            });
            if (!isFormValid) {
                e.preventDefault();
            }
        });
    }
});
</script>
@endsection

