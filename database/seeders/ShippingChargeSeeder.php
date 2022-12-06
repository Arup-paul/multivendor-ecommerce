<?php

namespace Database\Seeders;

use App\Models\ShippingCharge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingChargeSeeder extends Seeder
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
                "country" => "Afghanistan",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Pakistan",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Albania",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Algeria",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "American Samoa",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "American Samoa",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Andorra",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Armenia",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Australia",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "India",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Austria",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Bahrain",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Belgium",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Bhutan",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Brazil",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Canada",
                "shipping_charge" =>100,
                "status" => 1
            ],
            [
                "country" => "Bangladesh",
                "shipping_charge" =>100,
                "status" => 1
            ],

        ];

        ShippingCharge::insert($data);
    }

}
