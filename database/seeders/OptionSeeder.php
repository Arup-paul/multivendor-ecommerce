<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['type' => 'slider','value' => '{"title": "Best Ecommerce Shop", "short_title": "Amazing e-commerce platform for everyone", "child_image": "admin/img/slider/c1.jpg","banner": "admin/img/slider/1.png","button_text":"Shop","button_link":"shop"}','status' => '1','created_at' => now(),'updated_at' => now()],
            ['type' => 'slider','value' => '{"title": "Best Ecommerce Shop", "short_title": "Amazing e-commerce platform for everyone", "child_image": "admin/img/slider/c2.jpg","banner": "admin/img/slider/2.png","button_text":"Shop","button_link":"shop"}','status' => '1','created_at' => now(),'updated_at' => now()],
        ];

        Option::insert($data);
    }
}
