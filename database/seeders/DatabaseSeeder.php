<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
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
        $this->call(UserTableSeeder::class);
        $this->call(VendorsTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(VendorBusinessTableSeeder::class);
        $this->call(VendorBankTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ProductAttributeTableSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(FilterTableSeeder::class);
        $this->call(CouponTableSeeder::class);


    }
}
