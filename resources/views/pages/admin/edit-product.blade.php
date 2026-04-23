@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 100px; max-width: 800px; margin: 0 auto; padding-bottom: 100px;">
    <div class="mb-5">
        <a href="{{ route('admin.products') }}" style="text-decoration: none; color: #0071e3; font-size: 14px;">&larr; Quay lại danh sách sản phẩm</a>
        <h1 style="font-size: 40px; font-weight: 700; margin-top: 10px;">Chỉnh sửa Sản phẩm</h1>
        <p style="color: #86868b; font-size: 18px;">ID: #{{ $product->id }}</p>
    </div>

    <div class="card p-5 border-0 shadow-sm" style="border-radius: 20px;">
        <form action="{{ route('update-product') }}" method="POST" class="needs-validation" novalidate id="editProductForm">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" style="border-radius: 10px; padding: 12px;" required>
                    <div class="invalid-feedback">Vui lòng nhập tên sản phẩm.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="font-weight: 600;">Series (Mã nhóm)</label>
                    <input type="text" name="series" id="series_input" list="series_list" class="form-control" value="{{ $product->series }}" style="border-radius: 10px; padding: 12px;" required>
                    <datalist id="series_list">
                        @foreach($existingSeries as $s)
                            <option value="{{ $s->series }}" data-title="{{ $s->series_title }}" data-image="{{ $s->series_image }}">{{ $s->series_title }}</option>
                        @endforeach
                    </datalist>
                    <div class="invalid-feedback">Vui lòng chọn hoặc nhập Series.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="font-weight: 600;">Series Title (Tên nhóm hiển thị)</label>
                    <input type="text" name="series_title" id="series_title_input" class="form-control" value="{{ $product->series_title }}" style="border-radius: 10px; padding: 12px;" required>
                    <div class="invalid-feedback">Vui lòng nhập tên hiển thị nhóm.</div>
                </div>

                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Series Image (Ảnh gộp đại diện)</label>
                    <input type="text" name="series_image" id="series_image_input" class="form-control" value="{{ $product->series_image }}" style="border-radius: 10px; padding: 12px;" required>
                    <div class="mt-2 text-center" id="series_image_preview_container" style="display: none;">
                        <img id="series_image_preview" src="" alt="Series Preview" style="max-height: 150px; border-radius: 10px; border: 1px solid #ddd; padding: 5px;">
                    </div>
                    <div class="invalid-feedback">Vui lòng nhập link ảnh đại diện nhóm.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="font-weight: 600;">Giá</label>
                    <input type="text" name="price" id="price_input" class="form-control" value="{{ $product->price }}" style="border-radius: 10px; padding: 12px;" required>
                    <div class="invalid-feedback">Vui lòng nhập giá sản phẩm.</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label" style="font-weight: 600;">Số lượng tồn kho</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" style="border-radius: 10px; padding: 12px;" required min="0">
                    <div class="invalid-feedback">Vui lòng nhập số lượng hợp lệ (>= 0).</div>
                </div>

                <div class="col-md-2">
                    <label class="form-label" style="font-weight: 600;">Thứ tự</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ $product->sort_order }}" style="border-radius: 10px; padding: 12px;" required>
                </div>

                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Link hình ảnh sản phẩm</label>
                    <input type="text" name="image_url" id="image_url_input" class="form-control" value="{{ $product->image_url }}" style="border-radius: 10px; padding: 12px;" required>
                    <div class="mt-2 text-center" id="image_url_preview_container" style="display: none;">
                        <img id="image_url_preview" src="" alt="Product Preview" style="max-height: 150px; border-radius: 10px; border: 1px solid #ddd; padding: 5px;">
                    </div>
                    <div class="invalid-feedback">Vui lòng nhập link hình ảnh sản phẩm.</div>
                </div>

                <div class="col-12">
                    <label class="form-label" style="font-weight: 600;">Các màu sắc</label>
                    <input type="hidden" name="colors" id="colors_hidden_input" required>
                    <div id="color-picker-wrapper" class="d-flex flex-wrap gap-3 align-items-center mb-2">
                        <!-- Color pickers will be appended here -->
                    </div>
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-add-color" style="border-radius: 20px;"><i class="bi bi-plus-circle"></i> Thêm màu</button>
                    <div class="invalid-feedback d-block" id="color-error" style="display: none !important; color: #dc3545; font-size: .875em; margin-top: .25rem;">Vui lòng chọn ít nhất một màu.</div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Series Auto-fill
    const seriesInput = document.getElementById('series_input');
    const seriesTitleInput = document.getElementById('series_title_input');
    const seriesImageInput = document.getElementById('series_image_input');
    
    seriesInput.addEventListener('input', function() {
        const selectedValue = this.value;
        const datalist = document.getElementById('series_list');
        const options = datalist.querySelectorAll('option');
        
        for (let option of options) {
            if (option.value === selectedValue) {
                seriesTitleInput.value = option.getAttribute('data-title');
                seriesImageInput.value = option.getAttribute('data-image');
                seriesImageInput.dispatchEvent(new Event('input')); // Trigger preview
                break;
            }
        }
    });

    // 2. Image Previews
    function setupImagePreview(inputId, previewContainerId, previewImgId) {
        const input = document.getElementById(inputId);
        const container = document.getElementById(previewContainerId);
        const img = document.getElementById(previewImgId);

        input.addEventListener('input', function() {
            let url = this.value.trim();
            if (url) {
                // Thêm '/' ở đầu nếu là đường dẫn nội bộ
                if (!url.startsWith('http') && !url.startsWith('/')) {
                    url = '/' + url;
                }
                img.src = url;
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
        });
        
        // Hide image if it fails to load
        img.addEventListener('error', function() {
            container.style.display = 'none';
        });

        // Trigger on load if there's an old value
        if(input.value) input.dispatchEvent(new Event('input'));
    }

    setupImagePreview('series_image_input', 'series_image_preview_container', 'series_image_preview');
    setupImagePreview('image_url_input', 'image_url_preview_container', 'image_url_preview');

    // 3. Price Formatting
    const priceInput = document.getElementById('price_input');
    priceInput.addEventListener('input', function(e) {
        let val = this.value;
        
        // Lấy các chữ số
        let numericVal = val.replace(/\D/g, '');
        
        if (!numericVal) {
            this.value = '';
            return;
        }

        // Định dạng số với dấu chấm
        let formattedStr = parseInt(numericVal, 10).toLocaleString('vi-VN').replace(/,/g, '.');
        
        // Thêm hậu tố VNĐ
        this.value = formattedStr + ' VNĐ';
    });

    // 4. Color Picker Logic
    const colorWrapper = document.getElementById('color-picker-wrapper');
    const btnAddColor = document.getElementById('btn-add-color');
    const hiddenColorsInput = document.getElementById('colors_hidden_input');
    const colorError = document.getElementById('color-error');

    function updateColorsHiddenInput() {
        const pickers = colorWrapper.querySelectorAll('input[type="color"]');
        const hexValues = Array.from(pickers).map(p => p.value);
        hiddenColorsInput.value = hexValues.join(',');
        if (hexValues.length > 0) {
            colorError.style.setProperty('display', 'none', 'important');
        }
    }

    function addColorPicker(initialColor = '#000000') {
        const container = document.createElement('div');
        container.className = 'd-flex align-items-center gap-1';
        
        const picker = document.createElement('input');
        picker.type = 'color';
        picker.value = initialColor;
        picker.className = 'form-control form-control-color p-0 border-0';
        picker.style.width = '35px';
        picker.style.height = '35px';
        picker.style.borderRadius = '50%';
        picker.style.cursor = 'pointer';
        picker.style.overflow = 'hidden';
        
        picker.addEventListener('input', updateColorsHiddenInput);

        const btnRemove = document.createElement('button');
        btnRemove.type = 'button';
        btnRemove.className = 'btn btn-sm text-danger p-0 ms-1';
        btnRemove.innerHTML = '<i class="bi bi-x-circle-fill fs-5"></i>';
        btnRemove.style.border = 'none';
        btnRemove.style.background = 'none';
        btnRemove.onclick = function() {
            container.remove();
            updateColorsHiddenInput();
        };

        container.appendChild(picker);
        container.appendChild(btnRemove);
        colorWrapper.appendChild(container);
        updateColorsHiddenInput();
    }

    btnAddColor.addEventListener('click', () => addColorPicker());

    // Initialize with existing colors
    const existingColors = '{{ $product->colors }}';
    if (existingColors) {
        const colorsArr = existingColors.split(',').map(c => c.trim()).filter(c => c);
        if(colorsArr.length > 0) {
            colorsArr.forEach(c => addColorPicker(c));
        } else {
            addColorPicker('#000000');
        }
    } else {
        addColorPicker('#000000');
    }

    // 5. Form Validation
    const form = document.getElementById('editProductForm');
    form.addEventListener('submit', function (event) {
        let isValid = true;
        
        if (!form.checkValidity()) {
            isValid = false;
        }

        if (hiddenColorsInput.value.trim() === '') {
            colorError.style.setProperty('display', 'block', 'important');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    }, false);
});
</script>
@endsection
