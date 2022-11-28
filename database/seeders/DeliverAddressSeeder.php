<?php

namespace Database\Seeders;

use App\Models\DeliveryAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverAddressSeeder extends Seeder
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
                'user_id' => 1,
                'name' => 'john',
                'email' => 'john@gmail.com',
                'mobile' => '1234567890',
                'address' => 'Dhaka',
                'city' => 'Dhaka',
                'state' => 'Dhaka',
                'country' => 'Bangladesh',
                'zip' => '1234',
                'address_type' => 'Home',
                'status' => 1,
            ]
        ];

        DeliveryAddress::insert($data);
    }
}
