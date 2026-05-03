<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Support\Facades\DB;

class ProductOptionSeeder extends Seeder
{
    public function run()
    {
        // Clear existing to avoid duplicates
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductOption::truncate();
        Attribute::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Create Attributes
        $storageAttr = Attribute::create(['name' => 'Dung lượng lưu trữ']);
        $chipAttr = Attribute::create(['name' => 'Chip']);
        $screenAttr = Attribute::create(['name' => 'Màn hình']);
        $keyboardAttr = Attribute::create(['name' => 'Bàn phím']);

        // 2. MacBook Options
        $macAir = Product::where('name', 'like', '%MacBook Air%')->first();
        if ($macAir) {
            // Ensure attributes exist with correct group_names
            $chipAttr = Attribute::firstOrCreate(['name' => 'Chip'], ['category' => 'mac', 'group_name' => null]);
            $memAttr = Attribute::firstOrCreate(['name' => 'Bộ nhớ'], ['category' => 'mac', 'group_name' => 'Tùy biến']);
            $ssdAttr = Attribute::firstOrCreate(['name' => 'Dung lượng lưu trữ SSD'], ['category' => 'mac', 'group_name' => 'Tùy biến']);
            $powerAttr = Attribute::firstOrCreate(['name' => 'Bộ tiếp hợp nguồn'], ['category' => 'mac', 'group_name' => 'Tùy biến']);

            // Clear old options for this product
            ProductOption::where('product_id', $macAir->id)->delete();

            // Chip (Large Cards)
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $chipAttr->id, 'label' => 'Chip M5', 'sub_label' => 'CPU 10 lõi, GPU 8 lõi, Neural Engine 16 lõi', 'description' => 'Mang tốc độ và tính linh hoạt vào mọi công việc bạn làm.', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $chipAttr->id, 'label' => 'Chip M5', 'sub_label' => 'CPU 10 lõi, GPU 10 lõi, Neural Engine 16 lõi', 'description' => 'Hiệu năng đồ họa mạnh mẽ hơn cho các tác vụ chuyên nghiệp.', 'price_offset' => 3000000, 'is_default' => false, 'sort_order' => 2]);

            // Memory (Grouped in "Tùy biến")
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $memAttr->id, 'label' => '16GB', 'description' => 'Thêm bộ nhớ giúp chạy nhiều ứng dụng cùng lúc để đa nhiệm nhanh hơn, trôi chảy hơn.', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $memAttr->id, 'label' => '24GB', 'description' => 'Thêm bộ nhớ giúp chạy nhiều ứng dụng cùng lúc để đa nhiệm nhanh hơn, trôi chảy hơn.', 'price_offset' => 5500000, 'is_default' => false, 'sort_order' => 2]);

            // SSD (Grouped in "Tùy biến")
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $ssdAttr->id, 'label' => '512GB', 'description' => 'Sở hữu dung lượng dồi dào và khả năng truy cập nhanh vào ứng dụng, hình ảnh, phim, âm nhạc.', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $ssdAttr->id, 'label' => '1TB', 'description' => 'Sở hữu dung lượng dồi dào và khả năng truy cập nhanh vào ứng dụng, hình ảnh, phim, âm nhạc.', 'price_offset' => 5500000, 'is_default' => false, 'sort_order' => 2]);

            // Power (Grouped in "Tùy biến")
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $powerAttr->id, 'label' => 'USB-C 30W', 'description' => 'Sạc nhanh, hiệu quả.', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $powerAttr->id, 'label' => 'Cổng USB-C Kép 35W', 'description' => 'Hai cổng để sạc hai thiết bị cùng lúc.', 'price_offset' => 628000, 'is_default' => false, 'sort_order' => 2]);

            // Display Tech (Grouped in "Tùy biến")
            $displayAttr = Attribute::firstOrCreate(['name' => 'Màn hình'], ['category' => 'mac', 'group_name' => 'Tùy biến']);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $displayAttr->id, 'label' => 'Mặt kính tiêu chuẩn', 'description' => 'Được thiết kế để cho độ phản chiếu thấp, hỗ trợ giảm chói theo điều kiện môi trường của bạn.', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $displayAttr->id, 'label' => 'Mặt kính Nano-texture', 'description' => 'Giảm chói và phản chiếu tốt hơn trong điều kiện ánh sáng mạnh. Chỉ khả dụng với phiên bản bốn cổng.', 'price_offset' => 5500000, 'is_default' => false, 'sort_order' => 2]);

            // Stand (Grouped in "Tùy biến")
            $standAttr = Attribute::firstOrCreate(['name' => 'Đế'], ['category' => 'mac', 'group_name' => 'Tùy biến']);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $standAttr->id, 'label' => 'Chân đế', 'description' => 'Đặt trên bàn làm việc, có thể điều chỉnh nghiêng lên xuống.', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $standAttr->id, 'label' => 'Ngàm Kết Nối VESA', 'description' => 'Gắn liền nên có thể gắn vào tường hoặc giá đỡ dễ điều chỉnh.', 'price_offset' => 2000000, 'is_default' => false, 'sort_order' => 2]);

            // Ethernet (Grouped in "Tùy biến")
            $ethAttr = Attribute::firstOrCreate(['name' => 'Ethernet'], ['category' => 'mac', 'group_name' => 'Tùy biến']);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $ethAttr->id, 'label' => 'Cổng Gigabit Ethernet', 'description' => 'Kết nối mạng tốc độ cao qua cáp.', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $ethAttr->id, 'label' => 'Cổng 10Gb Ethernet', 'description' => 'Tốc độ mạng cực nhanh cho các tác vụ chuyên nghiệp.', 'price_offset' => 2300000, 'is_default' => false, 'sort_order' => 2]);

            // Peripherals (Standard layout)
            $mouseAttr = Attribute::firstOrCreate(['name' => 'Chuột hay bàn di'], ['category' => 'mac', 'group_name' => null]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $mouseAttr->id, 'label' => 'Magic Mouse', 'description' => 'Hỗ trợ cử chỉ Multi-Touch như vuốt và cuộn.', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $mouseAttr->id, 'label' => 'Magic Trackpad', 'description' => 'Hỗ trợ tất cả các cử chỉ Multi-Touch và công nghệ Force Touch.', 'price_offset' => 1031000, 'is_default' => false, 'sort_order' => 2]);

            $kbAttr = Attribute::firstOrCreate(['name' => 'Bàn phím'], ['category' => 'mac', 'group_name' => null]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $kbAttr->id, 'label' => 'Magic Keyboard với Touch ID', 'description' => 'Xác thực nhanh chóng và dễ dàng bằng vân tay.', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $kbAttr->id, 'label' => 'Magic Keyboard với Touch ID và Numeric Keypad', 'description' => 'Bố cục mở rộng kèm tính năng điều khiển điều hướng.', 'price_offset' => 1000000, 'is_default' => false, 'sort_order' => 2]);
        }

        // 3. iPhone Options (All models found in DB)
        $iphones = Product::where('series', 'like', 'iphone%')->get();
        
        foreach ($iphones as $iphone) {
            // Default storage tiers
            $tiers = [
                ['label' => '128GB', 'offset' => 0],
                ['label' => '256GB', 'offset' => 3000000],
                ['label' => '512GB', 'offset' => 8000000],
            ];

            // Pro models usually have 1TB
            if (str_contains($iphone->name, 'Pro')) {
                $tiers[] = ['label' => '1TB', 'offset' => 13000000];
            }

            foreach ($tiers as $index => $tier) {
                ProductOption::create([
                    'product_id' => $iphone->id,
                    'attribute_id' => $storageAttr->id,
                    'label' => $tier['label'],
                    'price_offset' => $tier['offset'],
                    'is_default' => ($index === 0),
                    'sort_order' => $index + 1
                ]);
            }
        }
    }
}
