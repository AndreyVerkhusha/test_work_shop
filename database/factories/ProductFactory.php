<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory {
    public $model = Product::class;

    public function definition() {
        return [
            'name'        => $this->faker->words(3, true),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'description' => $this->faker->paragraph(),
            'price'       => $this->faker->numberBetween(100, 100000),
        ];
    }
}
