@extends('layouts.app', ['pageTitle' => 'order.php'])

@section('content')

<div class="deals-container">
    <div class="deal-info">
        <strong style="font-size:13px;">Carrier Deals at Apple</strong><br>
        <a href="#" class="see-all">See all deals ➕</a>
    </div>
    <div class="deal-item">
        <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-att?wid=24&hei=24&fmt=png-alpha&.v=1658193314821"
            alt="Carrier 1">
        <span>Save up to $1000 after trade-in.</span>
    </div>
    <div class="deal-item">
        <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-lightyear?wid=24&hei=24&fmt=png-alpha&.v=1724793407797"
            alt="Carrier 2">
        <span>Save up to $1000. No trade-in needed.</span>
    </div>
    <div class="deal-item">
        <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-tmobile?wid=24&hei=24&fmt=png-alpha&.v=1658193314615"
            alt="Carrier 3">
        <span>Save up to $1000 after trade-in.</span>
    </div>
    <div class="deal-item">
        <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-verizon?wid=24&hei=24&fmt=png-alpha&.v=1725054383893"
            alt="Carrier 4">
        <span>Save up to $1000 after trade-in.</span>
    </div>
</div>

<div class="purchase-container">
    <div>
        <h1 style="font-size: 48px; font-weight: bold;">Buy iPhone 16 Pro</h1>
        <p style="font-size: 17px;">From $999 or $41.62/mo. for 24 mo.*</p>
        <div class="apple-intelligence">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-selector-icon-apple-intelligence-202409?wid=17&hei=21&fmt=p-jpg&qlt=95&.v=1724970464935"
                alt="Apple Intelligence">
            <span>Apple Intelligence<sup>8</sup></span>
        </div>
    </div>
    <div class="offer-buttons">
        <button class="offer-button" style="width:270px;">Get $40–$630 for your trade-in. ➕</button>
        <button class="offer-button">Get 3% Daily Cash back with Apple Card. ➕</button>
    </div>
</div>

<div class="rf-bfe-main">
    {{-- Left Column: Product image + Trade In + AppleCare --}}
    <div class="rf-bfe-column-left">
        <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/iphone-16-pro-model-unselect-gallery-1-202409?wid=5120&hei=2880&fmt=webp&qlt=70&.v=aWs5czA5aDFXU0FlMGFGRlpYRXk2UWFRQXQ2R0JQTk5udUZxTkR3ZVlpTEJnOG9obkp6NERCS3lnVm1tcnlVUjBoUVhuTWlrY2hIK090ZGZZbk9HeE1xUVVnSHY5eU9CcGxDMkFhalkvT0NuWUpOMGpEMHVTZEtYYVA3c1B3UzVmbW94YnYxc1YvNXZ4emJGL0IxNFp3&traceId=1"
            alt="Product Image" style="display: block; margin: 0 auto; max-width: 100%; height: auto; object-fit: contain; padding-bottom: 50px;">

        <h3><strong>Apple Trade In.</strong> <span style="font-weight: normal; color: #86868b;">Nhận 800.000đ–17.600.000đ điểm tín dụng để sử dụng khi mua iPhone mới.<sup>§</sup></span></h3>

        {{-- Trade-in option cards --}}
        <div style="display:flex; gap:12px; margin-top:12px; margin-bottom:0;">
            <div id="trade-chon-card" onclick="selectTradeOption('chon')"
                style="flex:1; border:1px solid #d2d2d7; border-radius:12px; padding:20px 16px; cursor:pointer; background:#fff; transition:all 0.2s; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; min-height:80px;">
                <span style="font-size:15px; font-weight:600; color:#1d1d1f;">Chọn iPhone</span>
                <span style="font-size:12px; color:#86868b; margin-top:4px;">Trả lời một số câu hỏi để nhận được giá trị ước tính của bạn.</span>
            </div>
            <div id="trade-no-card" onclick="selectTradeOption('no')"
                style="flex:1; border:2px solid #0071e3; border-radius:12px; padding:20px 16px; cursor:pointer; background:#fff; transition:all 0.2s; display:flex; align-items:center; justify-content:center; text-align:center; min-height:80px;">
                <span style="font-size:15px; font-weight:600; color:#1d1d1f;">Không đổi cũ lấy mới</span>
            </div>
        </div>

        {{-- Trade-in form (hidden by default) --}}
        <div id="trade-form" style="display:none; margin-top:20px; border:1px solid #d2d2d7; border-radius:12px; padding:24px; background:#fff;">
            <div style="display:flex; gap:32px;">
                {{-- Left: Form fields --}}
                <div style="flex:1;">
                    {{-- Model selection --}}
                    <p style="font-size:15px; font-weight:600; color:#1d1d1f; margin:0 0 10px;"><strong>Bạn sử dụng phiên bản nào?</strong></p>
                    <div style="position:relative; margin-bottom:20px;">
                        <label style="position:absolute; top:8px; left:14px; font-size:11px; color:#86868b; z-index:1;">Chọn phiên bản sản phẩm</label>
                        <select id="trade-model-select" onchange="updateTradeStorage()"
                            style="width:100%; border:1px solid #d2d2d7; border-radius:10px; padding:26px 40px 10px 14px; font-size:15px; color:#1d1d1f; appearance:none; -webkit-appearance:none; background:#fff; cursor:pointer; font-family:inherit;">
                            <option value="">Chọn</option>
                            <option value="16ProMax">iPhone 16 Pro Max - Lên tới 17.600.000đ</option>
                            <option value="16Pro">iPhone 16 Pro - Lên tới 16.000.000đ</option>
                            <option value="16Plus">iPhone 16 Plus - Lên tới 14.100.000đ</option>
                            <option value="16">iPhone 16 - Lên tới 11.400.000đ</option>
                            <option value="16e">iPhone 16e - Lên tới 8.600.000đ</option>
                            <option value="15ProMax">iPhone 15 Pro Max - Lên tới 15.100.000đ</option>
                            <option value="15Pro">iPhone 15 Pro - Lên tới 11.900.000đ</option>
                            <option value="15Plus">iPhone 15 Plus - Lên tới 9.600.000đ</option>
                            <option value="15">iPhone 15 - Lên tới 9.200.000đ</option>
                            <option value="14ProMax">iPhone 14 Pro Max - Lên tới 11.200.000đ</option>
                            <option value="14Pro">iPhone 14 Pro - Lên tới 9.700.000đ</option>
                            <option value="14Plus">iPhone 14 Plus - Lên tới 7.000.000đ</option>
                            <option value="14">iPhone 14 - Lên tới 6.400.000đ</option>
                            <option value="13ProMax">iPhone 13 Pro Max - Lên tới 8.100.000đ</option>
                            <option value="13Pro">iPhone 13 Pro - Lên tới 6.800.000đ</option>
                            <option value="13">iPhone 13 - Lên tới 4.900.000đ</option>
                        </select>
                        <span style="position:absolute; right:14px; top:50%; transform:translateY(-50%); pointer-events:none; color:#86868b; font-size:14px;">&#8964;</span>
                    </div>

                    {{-- Storage selection --}}
                    <p style="font-size:15px; font-weight:600; color:#1d1d1f; margin:0 0 10px;"><strong>Dung lượng bao nhiêu?</strong></p>
                    <div style="position:relative; margin-bottom:20px;">
                        <label style="position:absolute; top:8px; left:14px; font-size:11px; color:#86868b; z-index:1;">Chọn dung lượng sản phẩm</label>
                        <select id="trade-storage-select"
                            style="width:100%; border:1px solid #d2d2d7; border-radius:10px; padding:26px 40px 10px 14px; font-size:15px; color:#1d1d1f; appearance:none; -webkit-appearance:none; background:#fff; cursor:pointer; font-family:inherit;">
                            <option value="">Chọn</option>
                            <option value="256">256GB</option>
                            <option value="512">512GB</option>
                            <option value="1tb">1TB</option>
                        </select>
                        <span style="position:absolute; right:14px; top:50%; transform:translateY(-50%); pointer-events:none; color:#86868b; font-size:14px;">&#8964;</span>
                    </div>

                    {{-- Condition --}}
                    <p style="font-size:15px; font-weight:600; color:#1d1d1f; margin:0 0 10px;"><strong>Tình trạng iPhone của bạn có tốt không?</strong></p>
                    <div style="display:flex; gap:12px;">
                        <button id="cond-yes" onclick="selectCondition('yes')"
                            style="flex:1; border:1px solid #d2d2d7; border-radius:10px; padding:18px; font-size:15px; font-weight:600; color:#1d1d1f; background:#fff; cursor:pointer; transition:all 0.2s; font-family:inherit;">Đúng</button>
                        <button id="cond-no" onclick="selectCondition('no')"
                            style="flex:1; border:1px solid #d2d2d7; border-radius:10px; padding:18px; font-size:15px; font-weight:600; color:#1d1d1f; background:#fff; cursor:pointer; transition:all 0.2s; font-family:inherit;">Sai</button>
                    </div>
                </div>

                {{-- Right: Helper info --}}
                <div style="width:220px; flex-shrink:0; padding-top:50px">
                    <p id="trade-hint-model" style="font-size:12px; color:#86868b; line-height:1.5; margin:0 0 20px;">Trên iPhone, hãy vào mục Cài đặt > Tên của bạn. Cuộn xuống để xem phiên bản.</p>
                    <p id="trade-hint-storage" style="font-size:12px; color:#86868b; line-height:1.5; margin:0 0 20px;">Trên iPhone, hãy vào mục Cài đặt > Cài đặt chung > Giới thiệu. Trên các điện thoại thông minh khác, hãy vào mục Cài đặt > Dung lượng.</p>
                    <div id="trade-hint-cond" style="display:none;">
                        <p style="font-size:12px; color:#86868b; margin:0 0 6px;">Trả lời có nếu tất cả các điều sau là đúng:</p>
                        <ul style="font-size:12px; color:#0071e3; margin:0; padding-left:16px; line-height:1.7;">
                            <li>Máy bật và hoạt động bình thường</li>
                            <li>Tất cả các nút đều hoạt động bình thường</li>
                            <li>Camera hoạt động bình thường và tất cả ống kính đều không bị hư hỏng</li>
                            <li style="color:#86868b;">Thân máy không bị lõm hoặc trầy xước</li>
                            <li style="color:#86868b;">Màn hình cảm ứng và mặt kính sau không bị hư hỏng</li>
                            <li style="color:#86868b;">Màn hình không bị biến dạng, sọc, có chấm đen hoặc trắng</li>
                            <li style="color:#86868b;">Pin vẫn hoạt động bình thường</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function selectTradeOption(choice) {
            var chonCard = document.getElementById('trade-chon-card');
            var noCard = document.getElementById('trade-no-card');
            var form = document.getElementById('trade-form');
            if (choice === 'chon') {
                chonCard.style.border = '2px solid #0071e3';
                noCard.style.border = '1px solid #d2d2d7';
                form.style.display = 'block';
            } else {
                noCard.style.border = '2px solid #0071e3';
                chonCard.style.border = '1px solid #d2d2d7';
                form.style.display = 'none';
            }
        }
        function selectCondition(choice) {
            var yes = document.getElementById('cond-yes');
            var no = document.getElementById('cond-no');
            var hint = document.getElementById('trade-hint-cond');
            if (choice === 'yes') {
                yes.style.border = '2px solid #0071e3';
                yes.style.background = '#f5faff';
                no.style.border = '1px solid #d2d2d7';
                no.style.background = '#fff';
            } else {
                no.style.border = '2px solid #0071e3';
                no.style.background = '#f5faff';
                yes.style.border = '1px solid #d2d2d7';
                yes.style.background = '#fff';
            }
            hint.style.display = 'block';
        }
        function updateTradeStorage() {
            var model = document.getElementById('trade-model-select').value;
            var storageSelect = document.getElementById('trade-storage-select');
            storageSelect.innerHTML = '<option value="">Chọn</option>';
            if (!model) return;
            var options = [];
            // Pro Max / Pro models have 256, 512, 1TB
            if (model.includes('ProMax') || model.includes('Pro')) {
                options = ['256GB','512GB','1TB'];
            } else if (model.includes('Plus') || model === '16' || model === '15' || model === '14' || model === '13') {
                options = ['128GB','256GB','512GB'];
            } else {
                options = ['128GB','256GB'];
            }
            options.forEach(function(opt) {
                var el = document.createElement('option');
                el.value = opt; el.textContent = opt;
                storageSelect.appendChild(el);
            });
        }
        </script>

        <h3><strong>Gói bảo hành AppleCare+.</strong> <span style="font-weight: normal; color: #86868b;">Bảo vệ iPhone mới của bạn.</span></h3>
        <div class="applecare-options" id="applecare-options" style="display: flex; gap: 15px; margin-top: 10px; padding-bottom: 50px; padding-top: 10px;">
            <div class="applecare-card" id="applecare-yes-card" onclick="openApplecareModal()" style="flex: 1; border: 1px solid #d2d2d7; border-radius: 12px; padding: 25px 20px; text-align: left; display: flex; flex-direction: column; justify-content: flex-start; cursor: pointer; background-color: #ffffff; transition: border-color 0.2s;">
                <div style="font-size: 17px; font-weight: 600; color: #1d1d1f; display: flex; align-items: center; gap: 5px;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" style="height: 16px; opacity: 0.6; filter: invert(0.5) sepia(1) saturate(5) hue-rotate(315deg);" alt="Apple"> AppleCare+
                </div>
                <hr style="border: 0; border-top: 1px solid #d2d2d7; margin: 15px 0;">
                <ul style="font-size: 12px; font-weight: 400; color: #86868b; margin: 0; padding-left: 20px; list-style-type: disc; display: flex; flex-direction: column; gap: 10px;">
                    <li>Nay đã có dịch vụ sửa chữa không hạn chế cho trường hợp hư hỏng do sự cố bất ngờ.*</li>
                    <li>Dịch vụ sửa chữa được Apple chứng nhận sử dụng linh kiện Apple chính hãng</li>
                    <li>Dịch Vụ Thay Thế Cấp Tốc — Chúng tôi sẽ gửi cho bạn một thiết bị thay thế để bạn không phải chờ sửa chữa±</li>
                    <li>Ưu tiên tiếp cận các chuyên gia Apple</li>
                </ul>
            </div>
            <div class="applecare-card" id="applecare-no-card" onclick="selectApplecare('no')" style="flex: 1; border: 1px solid #d2d2d7; border-radius: 12px; padding: 25px 20px; text-align: left; display: flex; flex-direction: column; justify-content: flex-start; background-color: #ffffff; cursor: pointer; transition: border-color 0.2s;">
                <span style="font-size: 17px; font-weight: 600; color: #86868b;">Không có bảo hành AppleCare+</span>
            </div>
        </div>

        {{-- AppleCare+ Modal --}}
        <div id="applecare-modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; overflow-y:auto;">
            <div style="background:#fff; max-width:45vw; margin:40px auto; border-radius:20px; padding:36px 40px 32px 40px; position:relative; box-shadow:0 30px 80px rgba(0,0,0,0.25); font-family:-apple-system,BlinkMacSystemFont,'SF Pro Text','SF Pro Display','Helvetica Neue',Arial,sans-serif;">
                {{-- Close button --}}
                <button onclick="closeApplecareModal()" style="position:absolute; top:18px; right:18px; background:#e8e8ed; border:none; border-radius:50%; width:30px; height:30px; font-size:16px; cursor:pointer; color:#6e6e73; display:flex; align-items:center; justify-content:center; font-weight:500; line-height:1;">&times;</button>

                {{-- Header --}}
                <div style="text-align:center; margin-bottom:28px;">
                    <div style="width:64px; height:64px; background:linear-gradient(145deg,#e8002d,#bf001b); border-radius:16px; margin:0 auto 10px; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(232,0,45,0.4);">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" style="height:34px; filter:brightness(0) invert(1);" alt="AppleCare+">
                    </div>
                    <p style="font-size:12px; font-weight:600; color:#e30000; letter-spacing:0.3px; margin:0 0 10px;">AppleCare+</p>
                    <h2 style="font-size:32px; font-weight:700; color:#1d1d1f; margin:0 0 8px; letter-spacing:-0.5px;">AppleCare+</h2>
                    <p style="font-size:14px; color:#1d1d1f; margin:0; font-weight:400;">5.499.000đ hoặc 224.000đ/tháng cho 24 tháng<sup style="font-size:10px;">^</sup></p>
                </div>

                {{-- Body --}}
                <div style="font-size:15px; color:#1d1d1f; line-height:1.65; font-weight:400;">
                    <p style="margin:0 0 16px;">Mỗi sản phẩm iPhone đều được bảo hành sửa chữa phần cứng một năm qua <a href="#" style="color:#0071e3; text-decoration:none;">bảo hành giới hạn</a> và hỗ trợ kỹ thuật miễn phí lên đến <a href="#" style="color:#0071e3; text-decoration:none;">90 ngày</a>. AppleCare+ cho iPhone kéo dài thời gian bảo hành lên hai năm kể từ ngày bạn mua AppleCare+, bao gồm bảo hành không giới hạn số lần cho các trường hợp hư hỏng do sự cố bất ngờ. Mỗi lần bảo hành chịu phí dịch vụ 799.000đ đối với trường hợp hư hỏng màn hình hoặc kính mặt sau, hoặc 2.649.000đ đối với trường hợp hư hỏng do sự cố bất ngờ khác. Để biết thông tin đầy đủ, vui lòng tham khảo các <a href="#" style="color:#0071e3; text-decoration:none;">điều khoản</a>.</p>
                    <p style="margin:0 0 20px;"><a href="https://www.apple.com/vn/support/products/iphone/" target="_blank" style="color:#0071e3; text-decoration:none; font-size:15px;">Tìm hiểu thêm về AppleCare+ ↗</a></p>

                    <hr style="border:0; border-top:1px solid #d2d2d7; margin:0 0 16px;">

                    <p style="font-size:11px; color:#86868b; margin:0 0 8px;"><sup>A</sup> Ước tính. Mức phí có thể thay đổi theo thời gian.</p>
                    <p style="font-size:11px; color:#86868b; margin:0 0 8px;">Chương trình Trả Góp Hàng Tháng Với MoMo do (các) đối tác tín dụng cung cấp qua ứng dụng MoMo của Công Ty Cổ Phần Dịch Vụ Di Động Trực Tuyến ("MoMo") chứ không phải Apple. Chỉ cư dân Việt Nam đủ điều kiện mới có thể mua sản phẩm đủ điều kiện qua chương trình này.</p>
                    <p style="font-size:11px; color:#86868b; margin:0;">Tất cả sản phẩm được mua qua hình thức Trả Góp Hàng Tháng Với MoMo đều cần có tài khoản vi điện tử từ MoMo và phải được (các) đối tác tín dụng của MoMo phê duyệt. Nếu bạn có câu hỏi về điều kiện tín dụng, vui lòng liên hệ với MoMo để nhận câu trả lời từ (các) đối tác tín dụng của MoMo.</p>
                </div>

                {{-- Footer button --}}
                <button onclick="closeApplecareModal()" style="display:block; width:100%; margin-top:24px; padding:15px; background:#0071e3; color:#fff; border:none; border-radius:30px; font-size:17px; font-weight:600; cursor:pointer; transition:background 0.2s; font-family:inherit; letter-spacing:0;">Chọn AppleCare+</button>
            </div>
        </div>

        <script>
        var applecareSelected = null; // 'yes' or 'no'

        function openApplecareModal() {
            document.getElementById('applecare-modal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeApplecareModal() {
            document.getElementById('applecare-modal').style.display = 'none';
            document.body.style.overflow = '';
            selectApplecare('yes');
        }

        function selectApplecare(choice) {
            applecareSelected = choice;
            var yesCard = document.getElementById('applecare-yes-card');
            var noCard = document.getElementById('applecare-no-card');
            if (choice === 'yes') {
                yesCard.style.border = '2px solid #0071e3';
                yesCard.style.backgroundColor = '#f5faff';
                noCard.style.border = '1px solid #d2d2d7';
                noCard.style.backgroundColor = '#ffffff';
            } else {
                noCard.style.border = '2px solid #0071e3';
                noCard.style.backgroundColor = '#f5faff';
                yesCard.style.border = '1px solid #d2d2d7';
                yesCard.style.backgroundColor = '#ffffff';
            }
        }

        // Close modal when clicking outside
        document.getElementById('applecare-modal').addEventListener('click', function(e) {
            if (e.target === this) closeApplecareModal();
        });
        </script>
    </div>

    {{-- Right Column: Model, Color, Storage --}}
    <div class="rf-bfe-column-right">
        <h2><strong>Phiên bản.</strong> <span style="font-weight: normal; color: #86868b;">Mẫu nào phù hợp nhất với bạn?</span></h2>

        <div class="model-card selected" data-price="999">
            <div style="flex: 1; text-align: left;">
                <strong>iPhone 16 Pro</strong>
                <p>Màn hình 6.3 inch²</p>
            </div>
            <div style="flex: 1; text-align: right;">
                <p style="text-align: right;">Từ $999<br>hoặc<br>${{ number_format(999 / 24, 2) }}/tháng<br>trong 24 tháng</p>
            </div>
        </div>

        <div class="model-card" data-price="1199">
            <div style="flex: 1; text-align: left;">
                <strong>iPhone 16 Pro Max</strong>
                <p>Màn hình 6.9 inch²</p>
            </div>
            <div style="flex: 1; text-align: right;">
                <p style="text-align: right;">Từ $1,199<br>hoặc<br>${{ number_format(1199 / 24, 2) }}/tháng<br>trong 24 tháng</p>
            </div>
        </div>

        <div class="help-box">
            <div style="text-align: left;">
                <strong>Bạn cần trợ giúp chọn một phiên bản?</strong>
                <p style="margin: 0;">Khám phá sự khác biệt về kích thước màn hình và thời lượng pin.</p>
            </div>
            <div style="font-size: 24px; color: #1d1d1f; font-weight: 300;">⊕</div>
        </div>

        <br>
        <h2><strong>Màu.</strong> <span style="font-weight: normal; color: #86868b;">Chọn màu bạn yêu thích.</span></h2>
        <br>
        <b style="font-size: 17px; font-weight: 600; color: #1d1d1f;" id="color-label">Màu - Bạc</b>
        <div class="color-options" style="padding: 15px 0;">
            <div class="color-circle selected" style="background-color: #F3E2D1;"></div>
            <div class="color-circle" style="background-color: #EDEDED;"></div>
            <div class="color-circle" style="background-color: #FFFFFF;"></div>
            <div class="color-circle" style="background-color: #B0B0B0;"></div>
        </div>

        <br>
        <h2><strong>Dung lượng lưu trữ.</strong> <span style="font-weight: normal; color: #86868b;">Bạn cần bao nhiêu dung lượng?</span></h2>

        <div class="storage-card selected" data-price-offset="0" data-storage="128GB">
            <div style="flex: 1; text-align: left;">
                <strong>128GB¹</strong>
            </div>
            <div style="flex: 1; text-align: right;">
                <p style="text-align: right;">$999<br>hoặc<br>${{ number_format(999 / 24, 2) }}/tháng<br>trong 24 tháng</p>
            </div>
        </div>

        <div class="storage-card" data-price-offset="100" data-storage="256GB">
            <div style="flex: 1; text-align: left;">
                <strong>256GB¹</strong>
            </div>
            <div style="flex: 1; text-align: right;">
                <p style="text-align: right;">${{ number_format(999 + 100) }}<br>hoặc<br>${{ number_format((999 + 100) / 24, 2) }}/tháng<br>trong 24 tháng</p>
            </div>
        </div>

        <div class="storage-card" data-price-offset="300" data-storage="512GB">
            <div style="flex: 1; text-align: left;">
                <strong>512GB¹</strong>
            </div>
            <div style="flex: 1; text-align: right;">
                <p style="text-align: right;">${{ number_format(999 + 300) }}<br>hoặc<br>${{ number_format((999 + 300) / 24, 2) }}/tháng<br>trong 24 tháng</p>
            </div>
        </div>

        <div class="storage-card" data-price-offset="500" data-storage="1TB">
            <div style="flex: 1; text-align: left;">
                <strong>1TB¹</strong>
            </div>
            <div style="flex: 1; text-align: right;">
                <p style="text-align: right;">${{ number_format(999 + 500) }}<br>hoặc<br>${{ number_format((999 + 500) / 24, 2) }}/tháng<br>trong 24 tháng</p>
            </div>
        </div>

        <p style="font-size: 11px; color: #e30000; margin-top: 15px;">Trả góp theo tháng với phí dịch vụ thực 1.67%, sau khi thanh toán lần đầu 20%. Có thêm tùy chọn thanh toán khi hoàn tất giao dịch.</p>

        <div class="help-box" style="margin-top: 15px;">
            <div style="text-align: left;">
                <strong>Bạn không chắc mình cần bao nhiêu dung lượng?</strong>
                <p style="margin: 0;">Hiểu rõ hơn về dung lượng bạn cần.</p>
            </div>
            <div style="font-size: 24px; color: #1d1d1f; font-weight: 300;">⊕</div>
        </div>
    </div>
</div>

@endsection
