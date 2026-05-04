@extends('layouts.admin')
@section('title', 'Chỉnh sửa Sản phẩm')

@section('content')
<div class="page-hdr d-flex justify-content-between align-items-start">
    <div>
        <h1>Chỉnh sửa Sản phẩm</h1>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span> 
            <a href="{{ route('admin.products') }}">Sản phẩm</a><span>›</span> Chỉnh sửa
        </div>
    </div>
</div>

<style>
    /* OPTIONS TABLE - MODERN CARD LOOK */
    .opts-table-wrap{border:none; border-radius:0; overflow:visible}
    .opts-table-wrap table{width:100%; border-collapse: separate; border-spacing: 0 16px; margin-top: -16px}
    .opts-table-wrap thead th{
        background: transparent; padding: 0 12px 8px; font-size: 11px; 
        font-weight: 600; text-transform: uppercase; letter-spacing: .06em; 
        color: var(--apple-gray-500); border: none
    }
    .opts-table-wrap tbody td{
        padding: 20px 16px; background: #fff; border-top: 1px solid var(--apple-gray-200); 
        border-bottom: 1px solid var(--apple-gray-200); vertical-align: middle;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .opts-table-wrap tbody td:first-child{border-left: 1px solid var(--apple-gray-200); border-radius: 12px 0 0 12px}
    .opts-table-wrap tbody td:last-child{border-right: 1px solid var(--apple-gray-200); border-radius: 0 12px 12px 0}
    
    .opts-table-wrap .form-control, .opts-table-wrap .form-select{
        border-radius: 8px; border-color: var(--apple-gray-200); font-size: 13px; background: #fafafa;
        transition: all 0.2s; height: 38px; padding: 0 12px;
    }
    .opts-table-wrap .form-select { padding-right: 32px; width: 100%; } /* Space for arrow */
    .opts-table-wrap .form-control { width: 100%; }
    .opts-table-wrap .form-control:focus, .opts-table-wrap .form-select:focus{
        background: #fff; border-color: var(--apple-blue); box-shadow: 0 0 0 3px rgba(0,113,227,0.1);
    }

    /* COLOR PICKER - APPLE STYLE */
    .color-dot-wrapper {
        position: relative; width: 48px; height: 48px; 
        padding: 3px; border-radius: 50%; border: 2px solid transparent;
        transition: all 0.2s; cursor: pointer;
    }
    .color-dot-wrapper:hover { border-color: var(--apple-gray-300); }
    .color-dot-inner {
        width: 100%; height: 100%; border-radius: 50%; border: 1px solid rgba(0,0,0,0.1);
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }
    .color-dot-remove {
        position: absolute; top: -2px; right: -2px; width: 20px; height: 20px;
        background: #fff; color: #ff3b30; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2); border: none;
        opacity: 0; transform: scale(0.8); transition: all 0.2s;
    }
    .color-dot-wrapper:hover .color-dot-remove { opacity: 1; transform: scale(1); }
    .color-dot-remove:hover { background: #ff3b30; color: #fff; }
    .color-dot-remove .material-icons-round { font-size: 14px; }
</style>

<form action="{{ route('update-product', $product->id) }}" method="POST" class="needs-validation" novalidate id="editProductForm">
    @csrf
    @method('POST')
    <input type="hidden" name="id" value="{{ $product->id }}">
    
    <div class="row">
        <!-- LEFT COLUMN: BASIC INFO & MEDIA -->
        <div class="col-lg-8">
            <!-- BASIC INFO -->
            <div class="form-section">
                <div class="form-section-hdr">
                    <div class="sec-icon"><span class="material-icons-round">info</span></div>
                    <div>
                        <div class="sec-title">Thông tin cơ bản</div>
                        <div class="sec-desc">Cập nhật tên sản phẩm và phân loại nhóm</div>
                    </div>
                </div>
                <div class="form-section-body">
                    <div class="mb-4">
                        <label class="f-label">Tên sản phẩm <span class="req">*</span></label>
                        <input type="text" name="name" class="f-input" value="{{ $product->name }}" placeholder="Ví dụ: iPhone 16 Pro" required>
                        <div class="f-error">Vui lòng nhập tên sản phẩm.</div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="f-label">Mã nhóm (Series) <span class="req">*</span></label>
                            <input type="text" name="series" id="series_input" list="series_list" class="f-input" value="{{ $product->series }}" required>
                            <datalist id="series_list">
                                @foreach($existingSeries as $s)
                                    <option value="{{ $s->series }}" data-title="{{ $s->series_title }}" data-image="{{ $s->series_image }}">{{ $s->series_title }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-md-6">
                            <label class="f-label">Tên hiển thị nhóm <span class="req">*</span></label>
                            <input type="text" name="series_title" id="series_title_input" class="f-input" value="{{ $product->series_title }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PRICING & INVENTORY -->
            <div class="form-section">
                <div class="form-section-hdr">
                    <div class="sec-icon"><span class="material-icons-round">payments</span></div>
                    <div>
                        <div class="sec-title">Giá & Tồn kho</div>
                        <div class="sec-desc">Thiết lập giá cơ bản và quản lý số lượng</div>
                    </div>
                </div>
                <div class="form-section-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="f-label">Giá cơ bản <span class="req">*</span></label>
                            <div style="position:relative">
                                <input type="text" name="price" id="price_input" class="f-input" style="padding-right:45px" value="{{ number_format(floatval($product->price), 0, ',', '.') }}" required>
                                <span style="position:absolute;right:12px;top:50%;transform:translateY(-50%);font-size:12px;font-weight:600;color:var(--apple-gray-500)">VNĐ</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="f-label">Số lượng <span class="req">*</span></label>
                            <input type="number" name="quantity" class="f-input" value="{{ $product->quantity }}" required min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="f-label">Thứ tự <span class="req">*</span></label>
                            <input type="number" name="sort_order" class="f-input" value="{{ $product->sort_order ?? 0 }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PRODUCT OPTIONS -->
            <div class="form-section">
                <div class="form-section-hdr">
                    <div class="sec-icon"><span class="material-icons-round">tune</span></div>
                    <div style="flex:1">
                        <div class="sec-title">Cấu hình chi tiết (Options)</div>
                        <div class="sec-desc">Các lựa chọn về Dung lượng, RAM, Chip...</div>
                    </div>
                    <button type="button" class="btn-apple btn-tonal btn-sm" id="btn-add-option">
                        <span class="material-icons-round" style="font-size:16px">add</span> Thêm tùy chọn
                    </button>
                </div>
                <div class="form-section-body" style="padding:0 20px">
                    <div class="opts-table-wrap">
                        <table id="options-table">
                            <thead>
                                <tr>
                                    <th style="width:200px">Loại thuộc tính</th>
                                    <th>Chi tiết tùy chọn</th>
                                    <th style="width:140px">Giá chênh lệch</th>
                                    <th style="width:50px">Mặc định</th>
                                    <th style="width:50px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product->options as $index => $option)
                                <tr>
                                    <td>
                                        <select name="options[{{ $index }}][attribute_id]" class="form-select form-select-sm" required onchange="handleAttrChange(this, {{ $index }})">
                                            @foreach($attributes as $attr)
                                                <option value="{{ $attr->id }}" {{ $option->attribute_id == $attr->id ? 'selected' : '' }}>{{ $attr->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div id="label-container-{{ $index }}">
                                            @if($option->attribute && $option->attribute->name == 'Bàn phím')
                                                <select name="options[{{ $index }}][label]" class="form-select form-select-sm mb-1" required>
                                                    <option value="Tiếng Anh (Mỹ)" {{ $option->label == 'Tiếng Anh (Mỹ)' ? 'selected' : '' }}>Tiếng Anh (Mỹ)</option>
                                                    <option value="Tiếng Việt" {{ $option->label == 'Tiếng Việt' ? 'selected' : '' }}>Tiếng Việt</option>
                                                    <option value="Tiếng Trung" {{ $option->label == 'Tiếng Trung' ? 'selected' : '' }}>Tiếng Trung</option>
                                                    <option value="Tiếng Nhật" {{ $option->label == 'Tiếng Nhật' ? 'selected' : '' }}>Tiếng Nhật</option>
                                                    <option value="Tiếng Hàn" {{ $option->label == 'Tiếng Hàn' ? 'selected' : '' }}>Tiếng Hàn</option>
                                                </select>
                                            @else
                                                <input type="text" name="options[{{ $index }}][label]" class="form-control form-control-sm mb-1" value="{{ $option->label }}" placeholder="Nhãn chính (ví dụ: Chip M5)" required style="font-weight: 600">
                                            @endif
                                        </div>
                                        <div class="rich-info-box" style="background: #f9f9fb; border-radius: 6px; padding: 6px; border: 1px solid #eee">
                                            <div class="mb-1">
                                                <label style="font-size: 9px; text-transform: uppercase; color: #86868b; display: block; margin-bottom: 2px">Nhãn phụ (Dòng trên)</label>
                                                <input type="text" name="options[{{ $index }}][sub_label]" class="form-control form-control-sm" value="{{ $option->sub_label }}" placeholder="Ví dụ: CPU 10 lõi, GPU 8 lõi..." style="font-size: 11px">
                                            </div>
                                            <div>
                                                <label style="font-size: 9px; text-transform: uppercase; color: #86868b; display: block; margin-bottom: 2px">Mô tả (Dòng dưới)</label>
                                                <textarea name="options[{{ $index }}][description]" class="form-control form-control-sm" rows="1" placeholder="Ví dụ: Mang tốc độ và tính linh hoạt..." style="font-size: 11px">{{ $option->description }}</textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="position:relative">
                                            <input type="text" name="options[{{ $index }}][price_offset]" class="form-control form-control-sm offset-input" style="padding-right:32px" value="{{ number_format($option->price_offset, 0, ',', '.') }}">
                                            <span style="position:absolute;right:8px;top:50%;transform:translateY(-50%);font-size:10px;color:#86868b">đ</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="default_option" value="{{ $index }}" {{ $option->is_default ? 'checked' : '' }} onchange="updateDefaultFlag({{ $index }})">
                                        <input type="hidden" name="options[{{ $index }}][is_default]" value="{{ $option->is_default ? '1' : '0' }}">
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-link btn-sm text-danger p-0" onclick="this.closest('tr').remove(); checkEmptyOptions();"><span class="material-icons-round" style="font-size:18px">delete</span></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="no-options-message" class="text-center py-5 text-muted" style="font-size: 13px; display: {{ $product->options->count() > 0 ? 'none' : 'block' }}">
                            <span class="material-icons-round d-block mb-2" style="font-size: 32px; opacity: 0.3">settings_suggest</span>
                            Chưa có tùy chọn nào. Bấm "Thêm tùy chọn" để tạo mới.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: IMAGES & COLORS -->
        <div class="col-lg-4">
            <!-- MEDIA PREVIEW -->
            <div class="form-section">
                <div class="form-section-hdr">
                    <div class="sec-icon"><span class="material-icons-round">image</span></div>
                    <div class="sec-title">Hình ảnh</div>
                </div>
                <div class="form-section-body">
                    <div class="mb-4">
                        <label class="f-label">Link ảnh sản phẩm <span class="req">*</span></label>
                        <input type="text" name="image_url" id="image_url_input" class="f-input" value="{{ $product->image_url }}" required>
                        <div id="image_url_preview_container" class="mt-3 text-center" style="display:none; background:#ffffff; border-radius:12px; padding:24px; border:1.5px dashed var(--apple-gray-200)">
                            <img id="image_url_preview" src="" alt="" style="max-height:200px; width:100%; object-fit:contain">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="f-label">Link ảnh gộp (Series) <span class="req">*</span></label>
                        <input type="text" name="series_image" id="series_image_input" class="f-input" value="{{ $product->series_image }}" required>
                        <div id="series_image_preview_container" class="mt-3 text-center" style="display:none; background:#ffffff; border-radius:12px; padding:24px; border:1.5px dashed var(--apple-gray-200)">
                            <img id="series_image_preview" src="" alt="" style="max-height:200px; width:100%; object-fit:contain">
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLORS -->
            <div class="form-section">
                <div class="form-section-hdr">
                    <div class="sec-icon"><span class="material-icons-round">palette</span></div>
                    <div style="flex:1">
                        <div class="sec-title">Màu sắc</div>
                        <div class="sec-desc">Các phiên bản màu hỗ trợ</div>
                    </div>
                    <button type="button" class="btn-apple btn-ghost btn-sm" id="btn-add-color" style="padding:0 8px">
                        <span class="material-icons-round" style="font-size:18px">add_circle</span>
                    </button>
                </div>
                <div class="form-section-body">
                    <input type="hidden" name="colors" id="colors_hidden_input" value="{{ $product->colors }}" required>
                    <div id="color-picker-wrapper" style="display:flex; flex-wrap:wrap; gap:12px">
                        <!-- Color dots will be added here -->
                    </div>
                    <div id="color-error" class="f-error" style="display:none">Vui lòng chọn ít nhất một màu.</div>
                </div>
            </div>
        </div>
    </div>

    <!-- STICKY ACTION BAR -->
    <div class="adm-action-bar" style="margin:24px -32px -48px; padding:16px 32px; border-top:1px solid var(--apple-gray-200); background:rgba(245,245,247,0.8); backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px)">
        <div style="flex:1; display:flex; align-items:center; gap:12px; color:var(--apple-gray-500); font-size:13px">
            <span class="material-icons-round" style="font-size:18px">info</span>
            Đang chỉnh sửa: <strong style="color: var(--apple-black)">#{{ $product->id }} — {{ $product->name }}</strong>
        </div>
        <a href="{{ route('admin.products') }}" class="btn-apple btn-ghost">Hủy bỏ</a>
        <button type="submit" class="btn-apple btn-filled">
            <span class="material-icons-round">save</span> Lưu thay đổi
        </button>
    </div>
</form>

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
                seriesImageInput.dispatchEvent(new Event('input'));
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
                if (!url.startsWith('http') && !url.startsWith('/')) url = '/' + url;
                img.src = url;
                container.style.display = 'block';
                img.onerror = () => container.style.display = 'none';
            } else {
                container.style.display = 'none';
            }
        });
        if (input.value) input.dispatchEvent(new Event('input'));
    }
    setupImagePreview('image_url_input', 'image_url_preview_container', 'image_url_preview');
    setupImagePreview('series_image_input', 'series_image_preview_container', 'series_image_preview');

    // 3. Pricing Formatter
    const priceInput = document.getElementById('price_input');
    priceInput.addEventListener('input', function(e) {
        let value = this.value.replace(/[^0-9]/g, '');
        if (value) this.value = new Intl.NumberFormat('vi-VN').format(parseInt(value));
    });

    // 4. Color Picker Logic
    const colorWrapper = document.getElementById('color-picker-wrapper');
    const addColorBtn = document.getElementById('btn-add-color');
    const hiddenColorsInput = document.getElementById('colors_hidden_input');
    const colorError = document.getElementById('color-error');

    function updateHiddenColors() {
        const colors = Array.from(colorWrapper.querySelectorAll('input[type="color"]')).map(input => input.value);
        hiddenColorsInput.value = colors.join(',');
        if (colors.length > 0) colorError.style.display = 'none';
    }

    function createColorPicker(value = '#000000') {
        const wrapper = document.createElement('div');
        wrapper.className = 'color-dot-wrapper';
        
        const inner = document.createElement('div');
        inner.className = 'color-dot-inner';
        inner.style.backgroundColor = value;
        
        const input = document.createElement('input');
        input.type = 'color';
        input.value = value;
        input.style.cssText = 'position:absolute; top:0; left:0; width:100%; height:100%; opacity:0; cursor:pointer';
        input.addEventListener('input', (e) => {
            inner.style.backgroundColor = e.target.value;
            updateHiddenColors();
        });

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'color-dot-remove';
        removeBtn.innerHTML = '<span class="material-icons-round">close</span>';
        removeBtn.onclick = (e) => { 
            e.stopPropagation();
            wrapper.remove(); 
            updateHiddenColors(); 
        };

        wrapper.appendChild(inner);
        wrapper.appendChild(input);
        wrapper.appendChild(removeBtn);
        colorWrapper.appendChild(wrapper);
        updateHiddenColors();
    }

    // Initialize existing colors
    const existingColors = "{{ $product->colors }}".split(',').filter(c => c.trim() !== '');
    existingColors.forEach(c => createColorPicker(c));
    if (existingColors.length === 0) createColorPicker('#ffffff');

    addColorBtn.onclick = () => createColorPicker();

    // 5. Dynamic Options Table
    const optionsTableBody = document.querySelector('#options-table tbody');
    const addOptionBtn = document.getElementById('btn-add-option');
    const noOptionsMessage = document.getElementById('no-options-message');
    const attributes = @json($attributes);
    let optionCount = {{ $product->options->count() }};

    addOptionBtn.onclick = () => {
        noOptionsMessage.style.display = 'none';
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <select name="options[${optionCount}][attribute_id]" class="form-select form-select-sm" required onchange="handleAttrChange(this, ${optionCount})">
                    <option value="">Chọn...</option>
                    ${attributes.map(a => `<option value="${a.id}">${a.name}</option>`).join('')}
                </select>
            </td>
            <td>
                <div id="label-container-${optionCount}">
                    <input type="text" name="options[${optionCount}][label]" class="form-control form-control-sm mb-1" placeholder="Nhãn chính (ví dụ: Chip M5)" required style="font-weight: 600">
                </div>
                <div class="rich-info-box" style="background: #f9f9fb; border-radius: 6px; padding: 6px; border: 1px solid #eee">
                    <div class="mb-1">
                        <label style="font-size: 9px; text-transform: uppercase; color: #86868b; display: block; margin-bottom: 2px">Nhãn phụ (Dòng trên)</label>
                        <input type="text" name="options[${optionCount}][sub_label]" class="form-control form-control-sm" placeholder="Ví dụ: CPU 10 lõi, GPU 8 lõi..." style="font-size: 11px">
                    </div>
                    <div>
                        <label style="font-size: 9px; text-transform: uppercase; color: #86868b; display: block; margin-bottom: 2px">Mô tả (Dòng dưới)</label>
                        <textarea name="options[${optionCount}][description]" class="form-control form-control-sm" rows="1" placeholder="Ví dụ: Mang tốc độ và tính linh hoạt..." style="font-size: 11px"></textarea>
                    </div>
                </div>
            </td>
            <td>
                <div style="position:relative">
                    <input type="text" name="options[${optionCount}][price_offset]" class="form-control form-control-sm offset-input" style="padding-right:32px" placeholder="0">
                    <span style="position:absolute;right:8px;top:50%;transform:translateY(-50%);font-size:10px;color:#86868b">đ</span>
                </div>
            </td>
            <td class="text-center">
                <input type="radio" name="default_option" value="${optionCount}" onchange="updateDefaultFlag(${optionCount})">
                <input type="hidden" name="options[${optionCount}][is_default]" value="0">
            </td>
            <td class="text-end">
                <button type="button" class="btn btn-link btn-sm text-danger p-0" onclick="this.closest('tr').remove(); checkEmptyOptions();"><span class="material-icons-round" style="font-size:18px">delete</span></button>
            </td>
        `;
        optionsTableBody.appendChild(tr);
        tr.querySelector('.offset-input').addEventListener('input', function() {
            let v = this.value.replace(/[^0-9-]/g, '');
            if (v) this.value = new Intl.NumberFormat('vi-VN').format(parseInt(v));
        });
        optionCount++;
    };

    window.handleAttrChange = function(select, idx) {
        const attrId = select.value;
        const attr = attributes.find(a => a.id == attrId);
        const container = document.getElementById(`label-container-${idx}`);
        if (attr && attr.name === 'Bàn phím') {
            container.innerHTML = `
                <select name="options[${idx}][label]" class="form-select form-select-sm mb-1" required>
                    <option value="Tiếng Anh (Mỹ)">Tiếng Anh (Mỹ)</option>
                    <option value="Tiếng Việt">Tiếng Việt</option>
                    <option value="Tiếng Trung">Tiếng Trung</option>
                    <option value="Tiếng Nhật">Tiếng Nhật</option>
                    <option value="Tiếng Hàn">Tiếng Hàn</option>
                </select>
            `;
        } else {
            container.innerHTML = `<input type="text" name="options[${idx}][label]" class="form-control form-control-sm mb-1" placeholder="Nhãn chính (ví dụ: Chip M5)" required style="font-weight: 600">`;
        }
    };

    window.updateDefaultFlag = (idx) => {
        document.querySelectorAll('input[name^="options"][name$="[is_default]"]').forEach(input => input.value = "0");
        document.querySelector(`input[name="options[${idx}][is_default]"]`).value = "1";
    };

    window.checkEmptyOptions = () => {
        if (optionsTableBody.children.length === 0) noOptionsMessage.style.display = 'block';
    };

    // Format existing offsets
    document.querySelectorAll('.offset-input').forEach(input => {
        input.addEventListener('input', function() {
            let v = this.value.replace(/[^0-9-]/g, '');
            if (v) this.value = new Intl.NumberFormat('vi-VN').format(parseInt(v));
        });
    });

    // Form Validation
    const form = document.getElementById('editProductForm');
    form.addEventListener('submit', function(e) {
        let valid = true;
        if (!form.checkValidity()) valid = false;
        if (hiddenColorsInput.value.trim() === '') { colorError.style.display = 'block'; valid = false; }
        if (!valid) { e.preventDefault(); e.stopPropagation(); const first = form.querySelector(':invalid'); if (first) first.scrollIntoView({behavior:'smooth', block:'center'}); }
        form.classList.add('was-validated');
    });
});
</script>
@endsection
