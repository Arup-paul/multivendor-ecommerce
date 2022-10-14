<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VendorsTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(VendorBusinessTableSeeder::class);
        $this->call(VendorBankTableSeeder::class);
        $this->call(CountryTableSeeder::class);

    }
}
