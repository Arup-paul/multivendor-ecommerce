<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_product_contains_empty_table()
    {
        $response = $this->get('/admin/products');

        $response->assertStatus(302);
    }

    public function test_product_contains_table()
    {
        Product::create(  [
            'category_id' => 1,
            'section_id' => 1,
            'brand_id' => 1,
            'vendor_id' => null,
            'admin_type' => 'superadmin',
            'product_name' => 'Apple iPhone 12 Pro Max',
            'slug' => 'apple-iphone-12-pro-max',
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
        ]);

        $response = $this->get('/admin/products');

        $response->assertStatus(302);
    }
}
