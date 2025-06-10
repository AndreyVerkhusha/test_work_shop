<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory {
    public $model = Order::class;

    public function definition() {
        return [
            'full_name'  => $this->faker->name(),
            'comment'    => $this->faker->sentence(),
            'product_id' => Product::inRandomOrder()->first()->id,
            'quantity'   => $this->faker->numberBetween(1, 10),
        ];
    }
}
