<?php

namespace Database\Seeders;

use App\Models\ProductFilter;
use App\Models\ProductFilterValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilterTableSeeder extends Seeder
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
               'category_id' => '1,2,3',
               'filter_name' => 'Color',
               'filter_column' => 'color',
               'status' => 1,
               'created_at' => now(),
               'updated_at' => now(),
           ],
            [
                'category_id' => '2,4',
                'filter_name' => 'Fabric',
                'filter_column' => 'fabric',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        ProductFilter::insert($data);
        foreach ($data as $d){
            DB::statement('ALTER TABLE products ADD '.$d['filter_column'].' VARCHAR(255) NULL AFTER description');
        }


        $data = [
            [
                'product_filter_id' => 1,
                'filter_value' => 'Red',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_filter_id' => 1,
                'filter_value' => 'Green',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_filter_id' => 2,
                'filter_value' => 'Sleeve',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_filter_id' => 2,
                'filter_value' => 'Fit',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        ProductFilterValue::insert($data);


    }
}
