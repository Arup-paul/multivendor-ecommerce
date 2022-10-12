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
           ['name' => 'Super Admin','type' => 'superadmin','vendor_id' => null,'email' => 'admin@admin.com','password'=> Hash::make('rootadmin'),'mobile' => '01866702189','image' => '','status' => 1,'created_at' => now(),'updated_at' => now()],
           ['name' => 'Vendor','type' => 'vendor','vendor_id' => 1,'email' => 'vendor@vendor.com','password'=> Hash::make('rootadmin'),'mobile' => '01866702189','image' => '','status' => 1,'created_at' => now(),'updated_at' => now()],
          ];

        Admin::insert($record);
    }
}
