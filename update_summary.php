<?php
$file = 'resources/views/pages/order.blade.php';
$content = file_get_contents($file);

$old = <<<'EOL'
        {{-- Apple-style total summary --}}
        <div class="total-summary" style="margin-top: 40px; border-top: 1px solid #d2d2d7; padding-top: 30px;">

            {{-- Product headline --}}
            <p id="summary-product-headline" style="font-size: 19px; font-weight: 600; color: #1d1d1f; margin: 0 0 6px;">iPhone</p>

            {{-- Total price large --}}
            <p style="font-size: 15px; color: #1d1d1f; margin: 0 0 2px;">
                Tổng cộng <strong id="summary-total-price" style="font-size: 17px;">0đ</strong>
            </p>

            {{-- Monthly installment --}}
            <p style="font-size: 15px; color: #1d1d1f; margin: 0 0 4px;">
                hoặc
            </p>
            <p style="font-size: 19px; font-weight: 600; color: #1d1d1f; margin: 0 0 4px;">
                <span id="summary-monthly-price">0đ</span>/tháng cho 24 tháng<sup style="font-size:11px;">^</sup>
            </p>
            <p style="font-size: 11px; color: #6e6e73; margin: 0 0 16px;">
                Ở mức phí dịch vụ 1,67%, sau khi thanh toán lần đầu 20%
            </p>

            <hr style="border: 0; border-top: 1px solid #d2d2d7; margin: 16px 0;">

            {{-- AppleCare row --}}
            <div id="summary-applecare-row" style="display: none; justify-content: space-between; align-items: center; margin-bottom: 10px; font-size: 14px; color: #1d1d1f;">
                <span>AppleCare+</span>
                <span>5.499.000đ</span>
            </div>

            {{-- Shipping info --}}
            <div style="display: flex; gap: 10px; align-items: flex-start; margin-bottom: 20px;">
                <span style="font-size: 20px; color: #1d1d1f;">🚚</span>
                <div>
                    <p style="font-size: 13px; font-weight: 600; color: #1d1d1f; margin: 0 0 2px;">Vận chuyển:</p>
                    <p style="font-size: 13px; color: #6e6e73; margin: 0;">3–5 ngày làm việc</p>
                    <a href="#" style="font-size: 13px; color: #0071e3; text-decoration: none;">Vận Chuyển Miễn Phí</a>
                </div>
            </div>

            <form action="{{ route('checkout') }}" method="GET">
                <input type="hidden" name="product" id="input-product-name" value="">
                <input type="hidden" name="price" id="input-total-price" value="">
                <input type="hidden" name="storage" id="input-storage" value="">
                <input type="hidden" name="color" id="input-color" value="">
                <input type="hidden" name="applecare" id="input-applecare" value="0">
                <input type="hidden" name="image_url" id="input-image" value="">

                <button type="submit" style="width: 100%; padding: 18px; border-radius: 980px; background-color: #0071e3; color: white; font-size: 17px; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.2s; letter-spacing: 0;" onmouseover="this.style.backgroundColor='#0077ed'" onmouseout="this.style.backgroundColor='#0071e3'">
                    Thêm vào giỏ hàng
                </button>
            </form>
        </div>
EOL;

$new = <<<'EOL'
        {{-- Apple-style total summary --}}
        <div class="total-summary" style="margin-top: 40px; border-top: 1px solid #d2d2d7; padding-top: 24px;">

            {{-- Product headline --}}
            <p id="summary-product-headline" style="font-size: 17px; font-weight: 600; color: #0071e3; margin: 0 0 12px; cursor: pointer;">iPhone</p>

            {{-- Total price --}}
            <p style="font-size: 15px; color: #1d1d1f; margin: 0 0 2px;">
                Tổng cộng <strong id="summary-total-price" style="font-size: 15px; font-weight: 600;">0đ</strong>
            </p>

            {{-- "hoặc" --}}
            <p style="font-size: 15px; color: #1d1d1f; margin: 4px 0;">hoặc</p>

            {{-- Monthly installment (large, bold) --}}
            <p style="font-size: 21px; font-weight: 700; color: #1d1d1f; margin: 0 0 4px; line-height: 1.2;">
                <span id="summary-monthly-price">0đ</span>/tháng cho 24 tháng<sup style="font-size:12px; font-weight:400;">^</sup>
            </p>

            {{-- Fee note --}}
            <p style="font-size: 11px; color: #6e6e73; margin: 0 0 6px; line-height: 1.4;">
                Ở mức phí dịch vụ 1,67%, sau khi thanh toán lần đầu 20% là <span id="summary-down-payment">0đ</span>
            </p>

            {{-- Tax estimate --}}
            <p style="font-size: 11px; color: #6e6e73; margin: 0 0 6px; line-height: 1.4;">
                Bao gồm thuế GTGT khoảng <span id="summary-tax">0đ</span>.<sup style="font-size:9px;">^</sup>
            </p>

            {{-- Explore installment link --}}
            <p style="font-size: 13px; margin: 0 0 16px;">
                <a href="#" style="color: #0071e3; text-decoration: none;">Khám phá thêm các lựa chọn trả góp hàng tháng ⊕</a>
            </p>

            {{-- AppleCare row --}}
            <div id="summary-applecare-row" style="display: none; justify-content: space-between; align-items: center; margin-bottom: 16px; font-size: 14px; color: #1d1d1f; border-top: 1px solid #d2d2d7; padding-top: 12px;">
                <span>AppleCare+</span>
                <span>5.499.000đ</span>
            </div>

            <hr style="border: 0; border-top: 1px solid #d2d2d7; margin: 0 0 16px;">

            {{-- "Vận chưa thể quyết định?" --}}
            <p style="font-size: 13px; font-weight: 600; color: #6e6e73; margin: 0 0 4px;">Vận chưa thể quyết định?</p>
            <p style="font-size: 13px; color: #6e6e73; margin: 0 0 6px; line-height: 1.4;">Bạn có thể nhấn "Lưu để xem lại sau" để dễ dàng quay lại xem sản phẩm.</p>
            <p style="font-size: 13px; margin: 0 0 16px;">
                <a href="#" style="color: #0071e3; text-decoration: none;">☐ Lưu để xem lại sau</a>
            </p>

            {{-- Shipping info --}}
            <div style="display: flex; gap: 10px; align-items: flex-start; margin-bottom: 16px;">
                <span style="font-size: 18px; margin-top: 2px;">🚚</span>
                <div>
                    <p style="font-size: 13px; font-weight: 600; color: #1d1d1f; margin: 0 0 2px;">Vận chuyển:</p>
                    <p style="font-size: 13px; color: #6e6e73; margin: 0 0 2px;">3–5 ngày làm việc</p>
                    <a href="#" style="font-size: 13px; color: #0071e3; text-decoration: none;">Vận Chuyển Miễn Phí</a><br>
                    <a href="#" style="font-size: 13px; color: #0071e3; text-decoration: none;">Nhận thông tin về ngày giao hàng ⓘ</a>
                </div>
            </div>

            <p style="font-size: 11px; color: #6e6e73; margin: 0 0 16px; line-height: 1.5;">
                Chi tiết giao hàng cho khu vực của bạn sẽ được hiển thị trong phần Thanh Toán.
            </p>

            <form action="{{ route('checkout') }}" method="GET">
                <input type="hidden" name="product" id="input-product-name" value="">
                <input type="hidden" name="price" id="input-total-price" value="">
                <input type="hidden" name="storage" id="input-storage" value="">
                <input type="hidden" name="color" id="input-color" value="">
                <input type="hidden" name="applecare" id="input-applecare" value="0">
                <input type="hidden" name="image_url" id="input-image" value="">

                <button type="submit" style="width: 100%; padding: 17px; border-radius: 980px; background-color: #0071e3; color: white; font-size: 17px; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#0077ed'" onmouseout="this.style.backgroundColor='#0071e3'">
                    Thêm vào giỏ hàng
                </button>
            </form>
        </div>
EOL;

if (strpos($content, $old) !== false) {
    $content = str_replace($old, $new, $content);
    file_put_contents($file, $content);
    echo "SUCCESS: Total summary updated!\n";
} else {
    echo "ERROR: Could not find the target content.\n";
    // Show a portion of what's in the file for debugging
    preg_match('/Apple-style total summary.*?<\/div>\s*<\/div>\s*<\/div>/s', $content, $m);
    echo substr($content, strpos($content, 'Apple-style total summary'), 200);
}
