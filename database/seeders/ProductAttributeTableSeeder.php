<?php

namespace Database\Seeders;

use App\Models\ProductAttributes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = [
          [
              'product_id' => 1,
              'sku' => 'SKU-001',
              'size' => 'S',
              'price' => 100,
              'stock' => 10,
              'status' => 1,
              'created_at' => now(),
              'updated_at' => now(),
          ],
           [
               'product_id' => 1,
               'sku' => 'SKU-002',
               'size' => 'M',
               'price' => 200,
               'stock' => 20,
               'status' => 1,
               'created_at' => now(),
               'updated_at' => now(),
           ],
           [
               'product_id' => 1,
               'sku' => 'SKU-003',
               'size' => 'L',
               'price' => 300,
               'stock' => 30,
               'status' => 1,
               'created_at' => now(),
               'updated_at' => now(),
           ]
       ];

       ProductAttributes::insert($data);

       ProductAttributes::factory()->count(100)->create();
    }
}
