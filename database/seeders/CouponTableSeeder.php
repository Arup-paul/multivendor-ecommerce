<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponTableSeeder extends Seeder
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
                'coupon_option' => 'Fixed',
                'coupon_code' => 'FIXED10',
                'categories' => '1,2',
                'users' => '1,2',
                'coupon_type' => 'Percentage',
                'amount_type' => 'Fixed',
                'amount' => 10,
                'start_date' => '2022-11-24',
                'end_date' => '2023-11-30',
                'status' => 1,
            ],
            [
                'coupon_option' => 'Manual',
                'coupon_code' => 'Manual10',
                'categories' => '1,2',
                'users' => '1,2',
                'coupon_type' => 'Manual',
                'amount_type' => 'Manual',
                'amount' => 10,
                'start_date' => '2022-11-24',
                'end_date' => '2023-11-30',
                'status' => 1,
            ]
        ];

        Coupon::insert($data);
    }
}
