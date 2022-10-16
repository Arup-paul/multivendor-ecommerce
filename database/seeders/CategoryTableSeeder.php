<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category =[
            [
          'parent_id' => null,
          'section_id' => 1,
          'category_name' => 'T-Shirts',
          'category_image' => '',
          'category_discount' => 0,
          'description' => 'T-Shirts',
          'url' => 't-shirts',
          'meta_title' => 'T-Shirts',
          'meta_description' => 'T-Shirts',
          'meta_keywords' => 'T-Shirts',
          'status' => 1,
          'created_at' => now(),
          'updated_at' => now(),
        ],  [
          'parent_id' => 1,
          'section_id' => 2,
          'category_name' => 'Shirts',
          'category_image' => '',
          'category_discount' => 0,
          'description' => 'Shirts',
          'url' => 'shirts',
          'meta_title' => 'Shirts',
          'meta_description' => 'Shirts',
          'meta_keywords' => 'Shirts',
          'status' => 1,
          'created_at' => now(),
          'updated_at' => now(),
        ], [
            'parent_id' => 1,
            'section_id' => 2,
            'category_name' => 'Sports',
            'category_image' => '',
            'category_discount' => 0,
            'description' => 'Sports',
            'url' => 'sports',
            'meta_title' => 'Sports',
            'meta_description' => 'Sports',
            'meta_keywords' => 'Sports',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
         [
            'parent_id' => 1,
            'section_id' => 2,
            'category_name' => 'Health & Beauty',
            'category_image' => '',
            'category_discount' => 0,
            'description' => 'Health & Beauty',
            'url' => 'health-beauty',
            'meta_title' => 'Health & Beauty',
            'meta_description' => 'Health & Beauty',
            'meta_keywords' => 'Health & Beauty',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        ];

        Category::insert($category);

    }
}
