<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = [
           ['name' => 'Super Admin','type' => 'superadmin','vendor_id' => 0,'email' => 'admin@admin.com','password'=> Hash::make('rootadmin'),'mobile' => '01866702189','image' => '','status' => 1,'created_at' => now(),'updated_at' => now()],
          ];

        Admin::insert($record);
    }
}
