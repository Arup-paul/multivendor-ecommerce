<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    private Admin $admin;

    /**
     * @return void
     */


    protected function  setUp(): void
    {
        parent::setUp();
        $this->admin = $this->createAdmin();
    }

    public function test_admin_can_read_all_products()
    {
        $product = $this->createProduct();
        $response = $this->actingAs(  $this->admin,'admin')->get('/admin/products');
        $response->assertStatus(200);
    }

    public function test_admin_can_read_single_product()
    {
        $product =  $this->createProduct();
        $response = $this->actingAs(  $this->admin,'admin')->get('/admin/products/'.$product->id);
        $response->assertSee($product->product_name);
    }
    public function test_admin_store_product()
    {
        $product = $this->createProduct();
        $response =  $this->actingAs(  $this->admin,'admin')->post('/admin/products',$product->toArray());
        $response->assertStatus(200);
    }

    public function test_unauthenticated_admin_can_not_store_product()
    {
        $product = $this->createProduct();
        $this->post('/admin/products',$product->toArray())
            ->assertRedirect('/admin/login');
    }
    public function test_product_requires_a_name(){

        $product = $this->createProduct();
        $product->product_name = null;
        $response = $this->actingAs(  $this->admin,'admin')->post('/admin/products',$product->toArray());
        $response->assertSessionHasErrors('product_name');

    }

    public function test_product_requires_a_product_color(){

        $product = $this->createProduct();
        $product->product_color = null;
        $response = $this->actingAs(  $this->admin,'admin')->post('/admin/products',$product->toArray());
        $response->assertSessionHasErrors('product_color');

    }

    public function test_admin_update_product(){


        $product = $this->createProduct();
        $product->product_name = 'updated product name';
        $this->actingAs(  $this->admin,'admin')->put('/admin/products/'.$product->id, $product->toArray());
        $this->assertDatabaseHas('products',['id'=> $product->id , 'product_name' => 'updated product name']);

    }


    public function test_admin_mass_destroy_multiple_products(){

        $product =   $this->createProduct();

        $product2 = $this->createProduct();

        $requestData =  ['ids' => [$product->id,$product2->id],'deleteAction' => 'delete'];

        $this->actingAs(  $this->admin,'admin')->post('/admin/products/mass-destroy',$requestData);
        $this->assertDatabaseMissing('products',['id'=> $product->id]);
        $this->assertDatabaseMissing('products',['id'=> $product2->id]);

    }

    private function createAdmin(): \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        return Admin::factory()->create();
    }

    public function createProduct()
    {
        $section = Section::create([
            'name' => 'Electronics',
            'status' => 1,
        ]);
        $category = Category::create([
            'parent_id' => null,
            'section_id' => $section->id,
            'category_name' => 'Mobiles',
            'category_image' => '',
            'category_discount' => 0,
            'description' => '',
            'url' => 'mobiles'.rand(1,100),
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'status' => 1
        ]);
        $brand = Brand::create([
            'name' => 'Apple',
            'image' => '',
            'status' => 1
        ]);

        $product = Product::factory([
            'category_id' => $category->id,
            'section_id' => $section->id,
            'brand_id' => $brand->id,
            'vendor_id' => null,
            'admin_type' => 'superadmin',
            'product_name' => 'new product'.rand(1,100),
            'slug' => 'new-product'.rand(1,100),
            'product_color' => 'red',
            'product_code' => '2032',
            'product_price' => 20,
            'product_discount' => 0,
            'product_weight' => 20,
            'product_image' => 'admin/img/products/p-1.jpg',
            'description' => 'random text',
            'meta_title' => 'meta title',
            'meta_keywords' => 'meta keywords',
            'meta_description' => 'meta description',
            'featured' => 'is_featured',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ])->create();

        return $product;
    }
}
