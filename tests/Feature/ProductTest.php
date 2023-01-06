<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    private Admin $admin;
    protected function  setUp(): void
    {
        parent::setUp();
        $this->admin = $this->createAdmin();
    }

    public function test_admin_can_read_all_products()
    {
        $product = Product::factory()->create();
        $response = $this->actingAs(  $this->admin,'admin')->get('/admin/products');
        $response->assertStatus(200);
        $response->assertSee($product->product_name);
    }

    public function test_admin_can_read_single_product()
    {
        $product = Product::factory()->create();
        $response = $this->actingAs(  $this->admin,'admin')->get('/admin/products/'.$product->id);
        $response->assertSee($product->product_name);
    }
    public function test_admin_store_product()
    {
        $product = Product::factory()->make();
        $response =  $this->actingAs(  $this->admin,'admin')->post('/admin/products',$product->toArray());
        $response->assertStatus(200);
    }

    public function test_unauthenticated_admin_can_not_store_product()
    {
        $product = Product::factory()->make();
        $this->post('/admin/products',$product->toArray())
            ->assertRedirect('/admin/login');
    }




    private function createAdmin(): \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        return Admin::factory()->create();
    }
}
