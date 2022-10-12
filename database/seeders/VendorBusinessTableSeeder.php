<?php

namespace Database\Seeders;

use App\Models\VendorsBusinessDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBusinessTableSeeder extends Seeder
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
               'id'=>1,
               'vendor_id' => 1,
               'shop_name'=>'Shop 1',
               'shop_address'=>'Shop 1 Address',
               'shop_city'=>'Shop 1 City',
               'shop_country'=>'Shop 1 Country',
               'shop_pincode'=>'Shop 1 Pincode',
               'shop_mobile'=>'Shop 1 Phone',
               'shop_email'=>'Shop 1 Email',
               'shop_website'=>'Shop 1 Website',
               'address_proof'=>'Shop 1 Address Proof',
               'address_proof_image'=>'Shop 1 Address Proof Image',
               'business_license_number'=>'Shop 1 Business License Number',
               'gst_number'=>'Shop 1 GST',
               'pan_number'=>'Shop 1 PAN',
              ]
        ];

        VendorsBusinessDetail::insert($data);

    }
}
