<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class InitialProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // iPhone 16 Pro Series
            [
                'name' => 'iPhone 16 Pro',
                'series' => 'iphone-16-pro',
                'series_title' => 'iPhone 16 Pro & iPhone 16 Pro Max',
                'series_image' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16prohero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1725567335931',
                'image_url' => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone16promax-digitalmat-gallery-1-202409_GEO_US?wid=728&hei=666&fmt=p-jpg&qlt=95&.v=1723843667344',
                'colors' => '#d4c3b6,#8e8e93,#1c1c1e',
                'price' => '28.999.000đ',
                'quantity' => 100,
                'sort_order' => 1,
            ],
            [
                'name' => 'iPhone 16 Pro Max',
                'series' => 'iphone-16-pro',
                'series_title' => 'iPhone 16 Pro & iPhone 16 Pro Max',
                'series_image' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16prohero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1725567335931',
                'image_url' => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone16promax-digitalmat-gallery-1-202409_GEO_US?wid=728&hei=666&fmt=p-jpg&qlt=95&.v=1723843667344',
                'colors' => '#d4c3b6,#8e8e93,#1c1c1e',
                'price' => '34.999.000đ',
                'quantity' => 100,
                'sort_order' => 2,
            ],
            // iPhone 16 Series
            [
                'name' => 'iPhone 16',
                'series' => 'iphone-16',
                'series_title' => 'iPhone 16 & iPhone 16 Plus',
                'series_image' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16hero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1723234230295',
                'image_url' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16hero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1723234230295',
                'colors' => '#add8e6,#f8c8dc,#8e8e93,#1c1c1e',
                'price' => '22.999.000đ',
                'quantity' => 100,
                'sort_order' => 3,
            ],
            [
                'name' => 'iPhone 16 Plus',
                'series' => 'iphone-16',
                'series_title' => 'iPhone 16 & iPhone 16 Plus',
                'series_image' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16hero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1723234230295',
                'image_url' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16hero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1723234230295',
                'colors' => '#add8e6,#f8c8dc,#8e8e93,#1c1c1e',
                'price' => '25.999.000đ',
                'quantity' => 100,
                'sort_order' => 4,
            ],
            // iPhone 16e
            [
                'name' => 'iPhone 16e',
                'series' => 'iphone-16e',
                'series_title' => 'iPhone 16e',
                'series_image' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone-16e-202502?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1739495700381',
                'image_url' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone-16e-202502?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1739495700381',
                'colors' => 'rgb(227, 216, 216),#1c1c1e',
                'price' => '16.999.000đ',
                'quantity' => 100,
                'sort_order' => 5,
            ],
            // iPhone 15 Series
            [
                'name' => 'iPhone 15',
                'series' => 'iphone-15',
                'series_title' => 'iPhone 15 & iPhone 15 Plus',
                'series_image' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16hero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1723234230295',
                'image_url' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16hero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1723234230295',
                'colors' => 'rgb(255, 255, 255),#f8c8dc,rgb(228, 228, 104),rgb(160, 160, 167),#1c1c1e',
                'price' => '19.999.000đ',
                'quantity' => 100,
                'sort_order' => 6,
            ],
            [
                'name' => 'iPhone 15 Plus',
                'series' => 'iphone-15',
                'series_title' => 'iPhone 15 & iPhone 15 Plus',
                'series_image' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16hero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1723234230295',
                'image_url' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16hero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1723234230295',
                'colors' => 'rgb(255, 255, 255),#f8c8dc,rgb(228, 228, 104),rgb(160, 160, 167),#1c1c1e',
                'price' => '22.999.000đ',
                'quantity' => 100,
                'sort_order' => 7,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
