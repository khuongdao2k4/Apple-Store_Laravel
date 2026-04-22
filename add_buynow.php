<?php
$file = 'resources/views/pages/order.blade.php';
$content = file_get_contents($file);

// Find the closing </form> tag near the "Thêm vào giỏ hàng" button in the checkout section
// and insert "Mua ngay" button after it

$search = '                <button type="submit"
                    style="width: 100%; padding: 14px 20px; border-radius: 980px; background-color: #0071e3; color: white; font-size: 17px; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.2s;"
                    onmouseover="this.style.backgroundColor=\'#0077ed\'"
                    onmouseout="this.style.backgroundColor=\'#0071e3\'">
                    Thêm vào giỏ hàng
                </button>
            </form>';

$replace = '                <button type="submit"
                    style="width: 100%; padding: 14px 20px; border-radius: 980px; background-color: #0071e3; color: white; font-size: 17px; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.2s; margin-bottom: 10px;"
                    onmouseover="this.style.backgroundColor=\'#0077ed\'"
                    onmouseout="this.style.backgroundColor=\'#0071e3\'">
                    Thêm vào giỏ hàng
                </button>
            </form>

            {{-- Mua ngay button --}}
            <form action="{{ route(\'checkout\') }}" method="GET" style="margin-top: 10px;">
                <input type="hidden" name="product" id="buynow-product-name" value="">
                <input type="hidden" name="price" id="buynow-total-price" value="">
                <input type="hidden" name="storage" id="buynow-storage" value="">
                <input type="hidden" name="color" id="buynow-color" value="">
                <input type="hidden" name="applecare" id="buynow-applecare" value="0">
                <input type="hidden" name="image_url" id="buynow-image" value="">
                <input type="hidden" name="buy_now" value="1">
                <button type="submit"
                    style="width: 100%; padding: 14px 20px; border-radius: 980px; background-color: transparent; color: #0071e3; font-size: 17px; font-weight: 600; border: 1.5px solid #0071e3; cursor: pointer; transition: all 0.2s;"
                    onmouseover="this.style.backgroundColor=\'#0071e3\'; this.style.color=\'white\';"
                    onmouseout="this.style.backgroundColor=\'transparent\'; this.style.color=\'#0071e3\';">
                    Mua ngay
                </button>
            </form>';

if (strpos($content, $search) !== false) {
    $content = str_replace($search, $replace, $content);
    file_put_contents($file, $content);
    echo "SUCCESS: Mua ngay button added!\n";
} else {
    echo "NOT FOUND - searching for button...\n";
    $pos = strpos($content, 'Thêm vào giỏ hàng');
    echo "Found 'Thêm vào giỏ hàng' at char: $pos\n";
    echo substr($content, $pos - 200, 400) . "\n";
}
