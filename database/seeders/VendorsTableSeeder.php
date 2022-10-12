<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
          ['id'=>1,'name' =>'John','address'=>'Mirpur','city'=>'Dhaka','state'=>'Dhaka','country'=>'Bangladesh','pincode'=>'1200','mobile'=>'01700000000','email'=>'vendor@vendor.com','status'=>0],
        ];

        Vendor::insert($vendorRecords);
    }
}
