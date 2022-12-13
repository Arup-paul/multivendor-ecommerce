<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'SameSung','image'=> 'brand','status' => '1','created_at' => now(),'updated_at' => now()],
            ['name' => 'Puma','image'=> 'brand','status' => '1','created_at' => now(),'updated_at' => now()],
            ['name' => 'MI','image'=> 'brand','status' => '1','created_at' => now(),'updated_at' => now()],
            ['name' => 'Minister','image'=> 'brand','status' => '1','created_at' => now(),'updated_at' => now()],
        ];

        Brand::insert($data);
    }
}
