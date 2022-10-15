<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $section = [
          ['name' => 'Electronics','status' => '1','created_at' => now(),'updated_at' => now()],
          ['name' => 'Clothing','status' => '1','created_at' => now(),'updated_at' => now()],
          ['name' => 'Sports','status' => '1','created_at' => now(),'updated_at' => now()],
          ['name' => 'Health & Beauty','status' => '1','created_at' => now(),'updated_at' => now()],
       ];

       Section::insert($section);
    }
}
