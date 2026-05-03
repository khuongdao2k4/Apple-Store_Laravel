<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;

class AttributeFixSeeder extends Seeder
{
     public function run()
    {
        // Define common Mac attributes
        $macAttributes = [
            ['name' => 'Chip', 'category' => 'mac', 'group_name' => null],
            ['name' => 'Bộ nhớ', 'category' => 'mac', 'group_name' => 'Tùy biến'],
            ['name' => 'Dung lượng lưu trữ SSD', 'category' => 'mac', 'group_name' => 'Tùy biến'],
            ['name' => 'Màn hình', 'category' => 'mac', 'group_name' => 'Tùy biến'],
            ['name' => 'Đế', 'category' => 'mac', 'group_name' => 'Tùy biến'],
            ['name' => 'Ethernet', 'category' => 'mac', 'group_name' => 'Tùy biến'],
            ['name' => 'Bộ tiếp hợp nguồn', 'category' => 'mac', 'group_name' => 'Tùy biến'],
            ['name' => 'Chuột hay bàn di', 'category' => 'mac', 'group_name' => null],
            ['name' => 'Bàn phím', 'category' => 'mac', 'group_name' => null],
        ];

        // Define iPhone attributes
        $iphoneAttributes = [
            ['name' => 'Dung lượng lưu trữ', 'category' => 'iphone', 'group_name' => null],
        ];

        // Clear and insert
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Attribute::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach (array_merge($macAttributes, $iphoneAttributes) as $attr) {
            Attribute::create($attr);
        }
    }
}
