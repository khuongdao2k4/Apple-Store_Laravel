<?php
$file = 'resources/views/pages/order.blade.php';
$content = file_get_contents($file);

// Find and remove total-summary from right column, and close right column properly
// Also remove the extra </div> for right column that follows

// The block to replace: from the total-summary comment to the closing of rf-bfe-main
$oldBlock = '        
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

            <form action="{{ route(\'checkout\') }}" method="GET">
                <input type="hidden" name="product" id="input-product-name" value="">
                <input type="hidden" name="price" id="input-total-price" value="">
                <input type="hidden" name="storage" id="input-storage" value="">
                <input type="hidden" name="color" id="input-color" value="">
                <input type="hidden" name="applecare" id="input-applecare" value="0">
                <input type="hidden" name="image_url" id="input-image" value="">

                <button type="submit" style="width: 100%; padding: 17px; border-radius: 980px; background-color: #0071e3; color: white; font-size: 17px; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor=\'#0077ed\'" onmouseout="this.style.backgroundColor=\'#0071e3\'">
                    Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>
</div>';

// New block: close right column properly, close rf-bfe-main, then add Apple-style checkout summary below
$newBlock = '        
    </div>
</div>

{{-- ===== Apple-style Checkout Summary (below two-column layout) ===== --}}
<div style="background: #f5f5f7; border-top: 1px solid #d2d2d7; padding: 60px 100px; margin-top: 0;">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; gap: 60px; align-items: flex-start;">

        {{-- Left: Big headline + product image --}}
        <div style="flex: 0 0 340px;">
            <h2 style="font-size: 40px; font-weight: 700; color: #1d1d1f; line-height: 1.1; margin: 0 0 8px;">
                <span id="checkout-product-name-title">iPhone</span><br>
                <span style="font-weight: 700;">mới của bạn.</span>
            </h2>
            <p style="font-size: 21px; color: #86868b; font-weight: 400; margin: 0 0 30px;">Theo cách bạn muốn.</p>
            <img id="checkout-product-image" src="{{ asset($products->first()->image_url ?? \'images/default.jpg\') }}"
                 alt="Product" style="max-width: 280px; display: block;">
        </div>

        {{-- Middle: Pricing details --}}
        <div style="flex: 1; min-width: 0;">
            <p id="summary-product-headline" style="font-size: 17px; font-weight: 600; color: #1d1d1f; margin: 0 0 10px;">iPhone</p>

            <p style="font-size: 15px; color: #1d1d1f; margin: 0 0 2px;">
                Tổng cộng <strong id="summary-total-price" style="font-size: 15px;">0đ</strong>
            </p>
            <p style="font-size: 15px; color: #1d1d1f; margin: 4px 0;">hoặc</p>
            <p style="font-size: 21px; font-weight: 700; color: #1d1d1f; margin: 0 0 4px; line-height: 1.2;">
                <span id="summary-monthly-price">0đ</span>/tháng cho 24 tháng<sup style="font-size:12px; font-weight:400;">^</sup>
            </p>
            <p style="font-size: 11px; color: #6e6e73; margin: 0 0 6px; line-height: 1.4;">
                Ở mức phí dịch vụ 1,67%, sau khi thanh toán lần đầu 20% là <span id="summary-down-payment">0đ</span>
            </p>
            <p style="font-size: 11px; color: #6e6e73; margin: 0 0 6px; line-height: 1.4;">
                Bao gồm thuế GTGT khoảng <span id="summary-tax">0đ</span>.<sup style="font-size:9px;">^</sup>
            </p>
            <p style="font-size: 13px; color: #6e6e73; margin: 0 0 16px;">
                <a href="#" style="color: #6e6e73; text-decoration: none;">Khám phá thêm các lựa chọn trả góp hàng tháng ⊕</a>
            </p>

            <div id="summary-applecare-row" style="display: none; justify-content: space-between; align-items: center; margin-bottom: 16px; font-size: 14px; color: #1d1d1f; border-top: 1px solid #d2d2d7; padding-top: 12px;">
                <span>AppleCare+</span>
                <span>5.499.000đ</span>
            </div>

            <hr style="border: 0; border-top: 1px solid #d2d2d7; margin: 0 0 16px;">

            <p style="font-size: 13px; font-weight: 400; color: #6e6e73; margin: 0 0 4px;">Vận chưa thể quyết định?</p>
            <p style="font-size: 13px; color: #6e6e73; margin: 0 0 6px; line-height: 1.4;">
                Bạn có thể nhấn "Lưu để xem lại sau" để dễ dàng quay lại xem sản phẩm.
            </p>
            <p style="font-size: 13px; margin: 0 0 16px;">
                <a href="#" style="color: #6e6e73; text-decoration: none;">☐ Lưu để xem lại sau</a>
            </p>

            <hr style="border: 0; border-top: 1px solid #d2d2d7; margin: 0 0 16px;">

            <p style="font-size: 13px; color: #6e6e73; margin: 0; line-height: 1.5;">
                Chi tiết giao hàng cho khu vực của bạn sẽ được hiển thị trong phần Thanh Toán.
            </p>
        </div>

        {{-- Right: Shipping + Button --}}
        <div style="flex: 0 0 200px;">
            <div style="display: flex; gap: 10px; align-items: flex-start; margin-bottom: 20px;">
                <span style="font-size: 18px; margin-top: 2px;">🚚</span>
                <div>
                    <p style="font-size: 13px; font-weight: 600; color: #1d1d1f; margin: 0 0 2px;">Vận chuyển:</p>
                    <p style="font-size: 13px; color: #6e6e73; margin: 0 0 2px;">3–5 ngày làm việc</p>
                    <a href="#" style="font-size: 13px; color: #0071e3; text-decoration: none;">Vận Chuyển Miễn Phí</a><br>
                    <a href="#" style="font-size: 13px; color: #0071e3; text-decoration: none;">Nhận thông tin về ngày giao hàng ⓘ</a>
                </div>
            </div>

            <form action="{{ route(\'checkout\') }}" method="GET">
                <input type="hidden" name="product" id="input-product-name" value="">
                <input type="hidden" name="price" id="input-total-price" value="">
                <input type="hidden" name="storage" id="input-storage" value="">
                <input type="hidden" name="color" id="input-color" value="">
                <input type="hidden" name="applecare" id="input-applecare" value="0">
                <input type="hidden" name="image_url" id="input-image" value="">

                <button type="submit"
                    style="width: 100%; padding: 14px 20px; border-radius: 980px; background-color: #0071e3; color: white; font-size: 17px; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.2s;"
                    onmouseover="this.style.backgroundColor=\'#0077ed\'"
                    onmouseout="this.style.backgroundColor=\'#0071e3\'">
                    Thêm vào giỏ hàng
                </button>
            </form>
        </div>

    </div>
</div>';

if (strpos($content, $oldBlock) !== false) {
    $content = str_replace($oldBlock, $newBlock, $content);
    file_put_contents($file, $content);
    echo "SUCCESS!\n";
} else {
    echo "NOT FOUND - trying to locate...\n";
    $pos = strpos($content, 'Apple-style total summary');
    echo "Found at: $pos\n";
    echo substr($content, $pos - 10, 100) . "\n";
}
