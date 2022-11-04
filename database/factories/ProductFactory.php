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
            'product_name' => $this->faker->randomElement(['Lemon','Orange','Mango','Pumpkins','Tomato','Potato','Onion','Garlic','Cabbage','Carrot','Cucumber','Apple','Banana','Grapes','Pineapple','Watermelon','Strawberry','Papaya','Cherry','Kiwi','Pomegranate','Mushroom','Broccoli','Spinach','Cauliflower','Peas','Beans','Corn','Beetroot','Brinjal','Capsicum','Sweet Potato','Raddish','Lettuce','Cabbage','Cauliflower','Cucumber','Carrot','Tomato','Potato','Onion','Garlic','Mushroom','Broccoli','Spinach','Peas','Beans','Corn','Beetroot','Brinjal','Capsicum','Sweet Potato','Raddish','Lettuce','Cabbage','Cauliflower','Cucumber','Carrot','Tomato','Potato','Onion','Garlic','Mushroom','Broccoli','Spinach','Peas','Beans','Corn','Beetroot','Brinjal','Capsicum','Sweet Potato','Raddish','Lettuce','Cabbage','Cauliflower','Cucumber','Carrot','Tomato','Potato','Onion','Garlic','Mushroom','Broccoli','Spinach','Peas','Beans','Corn','Beetroot','Brinjal','Capsicum','Sweet Potato','Raddish','Lettuce','Cabbage','Cauliflower','Cucumber','Carrot','Tomato','Potato','Onion','Garlic','Mushroom','Broccoli','Spinach','Peas','Beans','Corn','Beetroot','Brinjal','Capsicum','Sweet Potato','Raddish','Lettuce','Cabbage','Cauliflower','Cucumber','Carrot','Tomato','Potato','Onion','Garlic','Mushroom','Broccoli','Spinach','Peas','Beans','Corn','Beetroot','Brinjal','Capsicum','Sweet Potato','Raddish','Lettuce','Cabbage','Cauliflower','Cucumber','Carrot','Tomato','Potato','Onion','Garlic','Mushroom','Broccoli','Spinach','Peas','Beans','Corn','Beetroot','Brinjal','Capsicum','Sweet Potato','Raddish','Lettuce','Cabbage','Cauliflower','Cucumber','Carrot','Tomato','Potato']),
            'product_color' => $this->faker->colorName,
            'product_code' => $this->faker->ean8,
            'product_price' => $this->faker->randomFloat(2, 10, 100),
            'product_discount' =>  $this->faker->numberBetween(0, 10),
            'product_weight' =>  $this->faker->numberBetween(0, 10),
            'product_image' => 'admin/img/products/p-'.$this->faker->numberBetween(01, 30).'.jpg',
            'description' => $this->faker->text,
            'meta_title' => $this->faker->text(20),
            'meta_keywords' => $this->faker->text(20),
            'meta_description' => $this->faker->text(20),
            'featured' => $this->faker->randomElement(['is_featured', 'is_latest', 'is_trending', 'is_best_rated', 'is_most_viewed','is_best_seller']),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
