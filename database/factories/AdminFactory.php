<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

               return [
                   'name' => fake()->name(),
                   'type' => 'superadmin',
                   'vendor_id' => null,
                   'mobile' => fake()->unique()->phoneNumber(),
                   'email' => fake()->unique()->safeEmail(),
                   'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                   'image' => '',
                   'status' => 1,
                   'created_at' => now(),
                   'updated_at' => now(),
               ];

    }
}
