<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
          [
              'category_id' => 1,
              'section_id' => 1,
              'brand_id' => 1,
              'vendor_id' => null,
              'admin_type' => 'superadmin',
              'product_name' => 'Apple iPhone 12 Pro Max',
              'product_color' => 'Silver',
              'product_code' => 'A12PM',
              'product_price' => 1399,
              'product_discount' => 0,
              'product_weight' => 0.5,
              'product_image' => 'https://m.media-amazon.com/images/I/71MHTD3uL4L._AC_UY218_.jpg',
              'description' => '6.7-inch Super Retina XDR display Ceramic Shield with 4x better drop performance than any smartphone glass Industry-leading IP68 water resistance Tougher front and back glass, tougher stainless steel band, tougher ceramic shield',
              'meta_title' => 'Apple iPhone 12 Pro Max',
              'meta_keywords' => 'Apple iPhone 12 Pro Max',
              'meta_description' => 'Apple iPhone 12 Pro Max',
              'featured' => 'is_featured',
              'status' => 1,
              'created_at' => now(),
              'updated_at' => now(),
          ],
            [
                'category_id' => 1,
                'section_id' => 1,
                'brand_id' => 1,
                'vendor_id' => 1,
                'admin_type' => 'vendor',
                'product_name' => 'Apple iPhone 12 Pro',
                'product_color' => 'Silver',
                'product_code' => 'A12P',
                'product_price' => 1199,
                'product_discount' => 0,
                'product_weight' => 0.5,
                'product_image' => 'https://m.media-amazon.com/images/I/71MHTD3uL4L._AC_UY218_.jpg',
                'description' => '6.1-inch Super Retina XDR display Ceramic Shield with 4x better drop performance than any smartphone glass Industry-leading IP68 water resistance Tougher front and back glass, tougher stainless steel band, tougher ceramic shield',
                'meta_title' => 'Apple iPhone 12 Pro',
                'meta_keywords' => 'Apple iPhone 12 Pro',
                'meta_description' => 'Apple iPhone 12 Pro',
                'featured' => 'is_featured',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'section_id' => 2,
                'brand_id' => 2,
                'vendor_id' => 1,
                'admin_type' => 'vendor',
                'product_name' => 'Apple iPhone 12',
                'product_color' => 'Silver',
                'product_code' => 'A12',
                'product_price' => 999,
                'product_discount' => 0,
                'product_weight' => 0.5,
                'product_image' => 'https://m.media-amazon.com/images/I/71MHTD3uL4L._AC_UY218_.jpg',
                'description' => '6.1-inch Super Retina XDR display Ceramic Shield with 4x better drop performance than any smartphone glass Industry-leading IP68 water resistance Tougher front and back glass, tougher stainless steel band, tougher ceramic shield',
                'meta_title' => 'Apple iPhone 12',
                'meta_keywords' => 'Apple iPhone 12',
                'meta_description' => 'Apple iPhone 12',
                'featured' => 'is_featured',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'category_id' => 2,
                'section_id' => 2,
                'brand_id' => 2,
                'vendor_id' => 1,
                'admin_type' => 'vendor',
                'product_name' => 'Apple iPhone 12 Mini',
                'product_color' => 'Silver',
                'product_code' => 'A12M',
                'product_price' => 799,
                'product_discount' => 0,
                'product_weight' => 0.5,
                'product_image' => 'https://m.media-amazon.com/images/I/71MHTD3uL4L._AC_UY218_.jpg',
                'description' => '5.4-inch Super Retina XDR display Ceramic Shield with 4x better drop performance than any smartphone glass Industry-leading IP68 water resistance Tougher front and back glass, tougher stainless steel band, tougher ceramic shield',
                'meta_title' => 'Apple iPhone 12 Mini',
                'meta_keywords' => 'Apple iPhone 12 Mini',
                'meta_description' => 'Apple iPhone 12 Mini',
                'featured' => 'is_featured',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),

            ]
        ];

//        Product::insert($product);

        Product::factory()->count(100)->create();
    }
}
