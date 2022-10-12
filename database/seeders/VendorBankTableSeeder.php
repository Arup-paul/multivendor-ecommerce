<?php

namespace Database\Seeders;

use App\Models\VendorsBankDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBankTableSeeder extends Seeder
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
                'account_holder_name'=>'Account Holder Name 1',
                'account_number'=>'Account Number 1',
                'bank_name'=>'Bank Name 1',
                'bank_ifsc_code'=>'Bank IFSC Code 1',
            ]
        ];

        VendorsBankDetail::insert($data);
    }
}
