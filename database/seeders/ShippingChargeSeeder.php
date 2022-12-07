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
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Pakistan",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Albania",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Algeria",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "American Samoa",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "American Samoa",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Andorra",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Armenia",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Australia",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "India",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Austria",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Bahrain",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Belgium",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Bhutan",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Brazil",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Canada",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],
            [
                "country" => "Bangladesh",
                'zero_fiveHundred' => 50,
                'fiveHundredOne_oneThousand' => 100,
                'oneThousandOne_twoThousand' => 150,
                'twoThousandOne_fiveThousand' => 200,
                'above_FiveThousand' => 250,
                "status" => 1
            ],

        ];

        ShippingCharge::insert($data);
    }

}
