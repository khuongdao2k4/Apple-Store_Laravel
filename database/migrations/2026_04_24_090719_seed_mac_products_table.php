<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \DB::table('products')->insert([
            [
                'name' => 'MacBook Air (M2 chip)',
                'series' => 'macbook-air',
                'series_title' => 'MacBook Air',
                'series_image' => 'https://www.apple.com/v/mac/home/cc/images/chapternav/macbookair_light__dfypt7o3xfgy_large.svg',
                'image_url' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/macbook-air-midnight-select-20220606?wid=904&hei=840&fmt=jpeg&qlt=90&.v=1653084303665',
                'colors' => 'Midnight,Starlight,Space Gray,Silver',
                'price' => 24990000,
                'quantity' => 100,
                'sort_order' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'MacBook Air (M3 chip)',
                'series' => 'macbook-air',
                'series_title' => 'MacBook Air',
                'series_image' => 'https://www.apple.com/v/mac/home/cc/images/chapternav/macbookair_light__dfypt7o3xfgy_large.svg',
                'image_url' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/macbook-air-midnight-config-202402?wid=1080&hei=1080&fmt=jpeg&qlt=90&.v=1708726241315',
                'colors' => 'Midnight,Starlight,Space Gray,Silver',
                'price' => 27990000,
                'quantity' => 100,
                'sort_order' => 2,
                'created_at' => now(),
            ],
            [
                'name' => 'MacBook Pro 14” (M3 chip)',
                'series' => 'macbook-pro',
                'series_title' => 'MacBook Pro',
                'series_image' => 'https://www.apple.com/v/mac/home/cc/images/chapternav/macbookpro_light__bz67qc7sk48y_large.svg',
                'image_url' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/mbp14-spacegray-select-202310?wid=904&hei=840&fmt=jpeg&qlt=90&.v=1697230830203',
                'colors' => 'Space Gray,Silver',
                'price' => 39990000,
                'quantity' => 50,
                'sort_order' => 3,
                'created_at' => now(),
            ],
            [
                'name' => 'iMac (M3 chip)',
                'series' => 'imac',
                'series_title' => 'iMac',
                'series_image' => 'https://www.apple.com/v/mac/home/cc/images/chapternav/imac_light__cx5ex9nbqxme_large.svg',
                'image_url' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/imac-24-blue-selection-hero-202310?wid=904&hei=840&fmt=jpeg&qlt=90&.v=1697303818314',
                'colors' => 'Blue,Green,Pink,Silver,Yellow,Orange,Purple',
                'price' => 36990000,
                'quantity' => 30,
                'sort_order' => 4,
                'created_at' => now(),
            ],
            [
                'name' => 'Mac mini (M2 chip)',
                'series' => 'mac-mini',
                'series_title' => 'Mac mini',
                'series_image' => 'https://www.apple.com/v/mac/home/cc/images/chapternav/mac_mini_light__e7ojhup2ezau_large.svg',
                'image_url' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/mac-mini-hero-202301?wid=904&hei=840&fmt=jpeg&qlt=90&.v=1670038314708',
                'colors' => 'Silver',
                'price' => 14990000,
                'quantity' => 50,
                'sort_order' => 5,
                'created_at' => now(),
            ],
            [
                'name' => 'Mac Studio (M2 Max chip)',
                'series' => 'mac-studio',
                'series_title' => 'Mac Studio',
                'series_image' => 'https://www.apple.com/v/mac/home/cc/images/chapternav/mac_studio_light__fcr3455qk0i2_large.svg',
                'image_url' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/mac-studio-select-202306?wid=904&hei=840&fmt=jpeg&qlt=90&.v=1684345161143',
                'colors' => 'Silver',
                'price' => 54990000,
                'quantity' => 20,
                'sort_order' => 6,
                'created_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
