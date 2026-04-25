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
        $macNeo = Product::where('name', 'like', '%MacBook Neo%')->first();
        if ($macNeo) {
            ProductOption::create(['product_id' => $macNeo->id, 'attribute_id' => $storageAttr->id, 'label' => '256GB Magic Keyboard', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macNeo->id, 'attribute_id' => $storageAttr->id, 'label' => '512GB Magic Keyboard với Touch ID', 'price_offset' => 5000000, 'is_default' => false, 'sort_order' => 2]);
        }

        $macAir = Product::where('name', 'like', '%MacBook Air%')->first();
        if ($macAir) {
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $screenAttr->id, 'label' => '13 inch', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $screenAttr->id, 'label' => '15 inch', 'price_offset' => 5000000, 'is_default' => false, 'sort_order' => 2]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $chipAttr->id, 'label' => 'Chip M5 (CPU 10 lõi, GPU 8 lõi)', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macAir->id, 'attribute_id' => $chipAttr->id, 'label' => 'Chip M5 (CPU 10 lõi, GPU 10 lõi)', 'price_offset' => 3000000, 'is_default' => false, 'sort_order' => 2]);
        }

        $macPro = Product::where('name', 'like', '%MacBook Pro%')->first();
        if ($macPro) {
            ProductOption::create(['product_id' => $macPro->id, 'attribute_id' => $screenAttr->id, 'label' => 'Màn hình tiêu chuẩn', 'price_offset' => 0, 'is_default' => true, 'sort_order' => 1]);
            ProductOption::create(['product_id' => $macPro->id, 'attribute_id' => $screenAttr->id, 'label' => 'Màn hình Nano-texture', 'price_offset' => 4000000, 'is_default' => false, 'sort_order' => 2]);
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
