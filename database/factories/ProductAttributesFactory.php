<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttributes>
 */
class ProductAttributesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 100),
            'sku' => $this->faker->ean8,
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'stock' => $this->faker->numberBetween(0, 100),
            'status' => 1,
        ];
    }
}
