<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 3),
            'section_id' => $this->faker->numberBetween(1, 3),
            'brand_id' => $this->faker->numberBetween(1, 3),
            'vendor_id' => null,
            'admin_type' => 'superadmin',
            'product_name' => $this->faker->name,
            'product_color' => $this->faker->colorName,
            'product_code' => $this->faker->ean8,
            'product_price' => $this->faker->randomFloat(2, 10, 100),
            'product_discount' =>  $this->faker->numberBetween(0, 10),
            'product_weight' =>  $this->faker->numberBetween(0, 10),
            'product_image' => $this->faker->imageUrl(300, 300),
            'description' => $this->faker->text,
            'meta_title' => $this->faker->text(20),
            'meta_keywords' => $this->faker->text(20),
            'meta_description' => $this->faker->text(20),
            'featured' => null,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
