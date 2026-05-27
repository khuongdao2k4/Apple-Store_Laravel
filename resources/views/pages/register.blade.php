@extends('layouts.app', ['pageTitle' => 'register.php'])

@section('content')




<div class="header-container">
    <h3 style="font-size: 25px"><b>Apple Account</b></h3>
    <div class="nav-menu">
        <a href="login" style="text-decoration: none;">Đăng Nhập</a>
        <a href="register" style="text-decoration: none;">Tạo Tài khoản Apple</a>
        <a href="#" style="text-decoration: none;">Những Câu Hỏi Thường Gặp</a>
    </div>
</div>
<div class="container">
    <div class="register-container px-5">
        <h2 class="text-center fw-bold mb-3" style="font-size: 34px; letter-spacing: -0.02em;">Tạo Tài khoản Apple</h2>
        <p class="text-center text-muted mb-1" style="font-size: 15px;">Chỉ cần có một Tài khoản Apple để truy cập vào
            tất cả dịch vụ của Apple.</p>
        <p class="text-center mb-4" style="font-size: 15px;">Bạn đã có Tài khoản Apple? <a href="login"
                class="text-decoration-none">Đăng Nhập <i class="fa fa-arrow-up-right-from-square ms-1"
                    style="font-size: 11px;"></i></a></p>

        @if (session('error'))
            <div class="alert alert-danger text-start"> {{ session('error') }} </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success text-start"> {{ session('success') }} </div>
            <div class="text-center mb-4"><a href="login" class="btn btn-primary rounded-pill px-4">Đăng nhập ngay</a></div>
        @endif

        <form action="register" method="POST">
            @csrf
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <div class="apple-input-group">
                        <input type="text" class="apple-input" name="lastname" value="{{ old('lastname') }}" placeholder="Họ" required>
                    </div>
                    @error('lastname')
                        <div class="error-text google-error-msg text-start" data-for="lastname">
                            <i class="fa-solid fa-circle-exclamation google-error-icon"></i> <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="apple-input-group">
                        <input type="text" class="apple-input" name="firstname" value="{{ old('firstname') }}" placeholder="Tên" required>
                    </div>
                    @error('firstname')
                        <div class="error-text google-error-msg text-start" data-for="firstname">
                            <i class="fa-solid fa-circle-exclamation google-error-icon"></i> <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <p class="fw-bold mb-2 text-start" style="font-size: 15px;">Quốc gia/Vùng</p>
            <div class="apple-input-group mb-4">
                <select class="apple-input text-center" name="country" required
                    style="cursor: pointer; text-align-last: center;">
                    <option value="Việt Nam">Việt Nam</option>
                    <option value="Hoa Kỳ">Hoa Kỳ</option>
                    <option value="Hàn Quốc">Hàn Quốc</option>
                    <option value="Nhật Bản">Nhật Bản</option>
                </select>
                <i class="fa fa-chevron-down text-muted"
                    style="position: absolute; right: 20px; top: 20px; pointer-events: none; font-size: 12px;"></i>
            </div>

            <p class="fw-bold mb-2 text-start" style="font-size: 15px;">Ngày sinh <i
                    class="fa fa-question-circle text-muted ms-1" style="cursor: pointer;"></i></p>
            <div class="row g-3 mb-4">
                <div class="col-4">
                    <div class="apple-input-group">
                        <select class="apple-input text-center" name="day" required
                            style="cursor: pointer; text-align-last: center;">
                            <option value="">Ngày</option>
                            <?php for ($i = 1; $i <= 31; $i++)
                                echo "<option value='$i'>$i</option>"; ?>
                        </select>
                        <i class="fa fa-chevron-down text-muted"
                            style="position: absolute; right: 12px; top: 22px; pointer-events: none; font-size: 10px;"></i>
                    </div>
                </div>
                <div class="col-4">
                    <div class="apple-input-group">
                        <select class="apple-input text-center" name="month" required
                            style="cursor: pointer; text-align-last: center;">
                            <option value="">Tháng</option>
                            <?php for ($i = 1; $i <= 12; $i++)
                                echo "<option value='$i'>$i</option>"; ?>
                        </select>
                        <i class="fa fa-chevron-down text-muted"
                            style="position: absolute; right: 12px; top: 22px; pointer-events: none; font-size: 10px;"></i>
                    </div>
                </div>
                <div class="col-4">
                    <div class="apple-input-group">
                        <select class="apple-input text-center" name="year" required
                            style="cursor: pointer; text-align-last: center;">
                            <option value="">Năm</option>
                            <?php for ($i = date('Y') - 13; $i >= 1900; $i--)
                                echo "<option value='$i'>$i</option>"; ?>
                        </select>
                        <i class="fa fa-chevron-down text-muted"
                            style="position: absolute; right: 12px; top: 22px; pointer-events: none; font-size: 10px;"></i>
                    </div>
                </div>
            </div>

            <hr class="my-4 text-muted" style="opacity: 0.15;">
            <p class="fw-bold mb-2 text-start" style="font-size: 15px;">Địa chỉ Email</p>
            <div class="apple-input-group mb-3">
                <input type="email" class="apple-input" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
            </div>
            @error('email')
                <div class="error-text google-error-msg text-start" data-for="email">
                    <i class="fa-solid fa-circle-exclamation google-error-icon"></i> <span>{{ $message }}</span>
                </div>
            @enderror
            
            <p class="fw-bold mb-2 text-start mt-4" style="font-size: 15px;">Mật khẩu</p>
            <div class="apple-input-group mb-1">
                <input type="password" class="apple-input" name="password" placeholder="Mật Khẩu" required>
            </div>
            @error('password')
                <div class="error-text google-error-msg text-start" data-for="password">
                    <i class="fa-solid fa-circle-exclamation google-error-icon"></i> <span>{{ $message }}</span>
                </div>
            @enderror
            
            <p class="text-start text-muted mb-3" style="font-size: 13px;"><i class="fa-solid fa-shield-halved text-success me-1"></i> Mật khẩu của bạn phải có ít nhất 8 ký tự, bao gồm chữ số, chữ in hoa và chữ thường.</p>
            <div class="apple-input-group mb-4">
                <input type="password" class="apple-input" name="confirm_password" placeholder="Xác nhận Mật khẩu" required>
            </div>
            @error('confirm_password')
                <div class="error-text google-error-msg text-start" data-for="confirm_password">
                    <i class="fa-solid fa-circle-exclamation google-error-icon"></i> <span>{{ $message }}</span>
                </div>
            @enderror

            <hr class="my-4 text-muted" style="opacity: 0.15;">

            <div class="mb-3 text-start">
                <p class="fw-bold mb-2" style="font-size: 15px;">Xác minh với:</p>
                <div class="d-flex flex-column gap-2 mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="verification" id="sms" value="sms" checked>
                        <label class="form-check-label" for="sms" style="user-select: none;">Tin nhắn</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="verification" id="call" value="call">
                        <label class="form-check-label" for="call" style="user-select: none;">Cuộc gọi điện</label>
                    </div>
                </div>
            </div>

            <div class="mb-4 text-start">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="notifications[]" id="news" value="news"
                        checked>
                    <label class="form-check-label fw-bold" for="news" style="user-select: none;">Các Thông Báo</label>
                    <p class="text-muted mt-1 mb-0" style="font-size: 13px;">Nhận email và thông tin của Apple như thông
                        báo, quảng cáo, gợi ý và cập nhật về các sản phẩm, phần mềm.</p>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="notifications[]" id="apps" value="apps"
                        checked>
                    <label class="form-check-label fw-bold" for="apps" style="user-select: none;">Ứng Dụng, Nhạc, TV Và
                        Nhiều Hơn Nữa</label>
                    <p class="text-muted mt-1 mb-0" style="font-size: 13px;">Nhận email và thông tin về ứng dụng, nhạc,
                        phim, TV, sách, podcast và nhiều hơn nữa.</p>
                </div>
            </div>

            <hr class="my-4 text-muted" style="opacity: 0.15;">

            <div class="row align-items-center mb-4">
                <div class="col-sm-5 text-center text-sm-start mb-3 mb-sm-0">
                    <img src="{{ asset('captcha.php') }}" alt="CAPTCHA" id="captcha-img"
                        style="border-radius: 8px; width: 130px; height: 42px; border: 1px solid #d2d2d7;"
                        title="Click để tải lại mã mới"
                        onclick="this.src='{{ asset('captcha.php') }}?v='+Math.random()">
                    <div class="mt-2" style="font-size: 13px;">
                        <a href="#"
                            onclick="document.getElementById('captcha-img').src='{{ asset('captcha.php') }}?v='+Math.random(); return false;"
                            class="text-primary text-decoration-none"><i class="fa fa-refresh"></i> Mã Mới</a>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="apple-input-group">
                        <input type="text" class="apple-input" name="captcha" placeholder="Nhập các ký tự trong ảnh"
                            style="font-size: 15px;" required>
                    </div>
                </div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary"
                    style="background-color: #0071e3; border: none; border-radius: 12px; padding: 14px 20px; font-weight: 500; font-size: 17px; letter-spacing: -0.02em;">Tiếp
                    Tục</button>
            </div>
        </form>
    </div>
</div>


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
    border-radius: 8px; /* Khung bo góc mềm mại */
    padding: 10px 12px;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    display: flex;
    align-items: flex-start;
    gap: 8px;
    margin-top: 6px;
    margin-bottom: 2px;
    box-shadow: 0 2px 4px rgba(200, 0, 0, 0.05); /* Hiệu ứng nổi nhẹ */
    animation: slideDownFade 0.2s ease-out forwards;
}
.google-error-icon {
    font-size: 15px;
    margin-top: 2px;
    color: #d93025;
}
/* Style viền chuẩn áp dụng cho thẻ container */
.google-invalid-input {
    border: 2px solid #e30000 !important;
    border-radius: 12px; /* Dựa theo form Apple */
}
.google-invalid-input:focus-within {
    box-shadow: 0 0 0 4px rgba(227, 0, 0, 0.15) !important;
    border-color: #e30000 !important;
}
.google-valid-input {
    border: 2px solid #34c759 !important; /* Xanh lá chuẩn Apple */
    border-radius: 12px;
}
.google-valid-input:focus-within {
    box-shadow: 0 0 0 4px rgba(52, 199, 89, 0.15) !important;
    border-color: #34c759 !important;
}
</style>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const nameRegex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]{2,}$/u;
    
    const rules = {
        lastname: { 
            required: true, 
            pattern: nameRegex,
            message: "Họ không hợp lệ (không chứa số, tối thiểu 2 ký tự)." 
        },
        firstname: { 
            required: true, 
            pattern: nameRegex,
            message: "Tên không hợp lệ (không chứa số, tối thiểu 2 ký tự)." 
        },
        country: { required: true, message: "Vui lòng chọn quốc gia." },
        day: { required: true, message: "Chọn ngày." },
        month: { required: true, message: "Chọn tháng." },
        year: { required: true, message: "Chọn năm." },
        email: { 
            required: true, 
            pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 
            message: "Vui lòng nhập một địa chỉ email hợp lệ." 
        },
        password: { 
            required: true, 
            pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\W]{8,}$/,
            message: "Mật khẩu chưa đủ mạnh. Vui lòng làm theo hướng dẫn bảo mật." 
        },
        confirm_password: { 
            required: true, 
            match: 'password',
            message: "Mật khẩu xác nhận không khớp." 
        },
        captcha: { required: true, message: "Vui lòng nhập mã CAPTCHA." }
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
        } else if (rules[name].minLength && val.length < rules[name].minLength) {
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
            // Thêm class chuẩn Google
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

    const form = document.querySelector('form[action="register"]');
    if(form) {
        const inputs = form.querySelectorAll('input, select');
        
        inputs.forEach(input => {
            // Chỉ thông báo lỗi khi click ra ngoài ô input (blur)
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            // Ẩn lỗi khi người dùng bắt đầu nhập lại, chưa thông báo lại liền
            input.addEventListener('input', function() {
                const name = input.name;
                if (!rules[name]) return;
                
                const group = input.closest('.apple-input-group') || input;
                group.classList.remove('google-valid-input'); // Tạm bỏ màu xanh khi đang gõ
                
                let errorEl = group.parentNode.querySelector('.error-text[data-for="'+name+'"]');
                if (errorEl && errorEl.style.display !== 'none') {
                    // Trừ trường hợp confirm password có thể check real-time để biết khớp nhanh
                    if (name === 'confirm_password') {
                        validateField(input);
                    } else {
                        group.classList.remove('google-invalid-input');
                        errorEl.style.display = 'none';
                    }
                }
            });
            
            if(input.tagName === 'SELECT') {
                input.addEventListener('change', function() {
                    validateField(this);
                });
            }
        });

        // Check toàn bộ lần cuối trước khi submit chặn form
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

