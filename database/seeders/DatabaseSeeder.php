<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
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
        $categories = ['light', 'fragile', 'heavy'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }

        Product::factory(21)->create();
        Order::factory(11)->create();
    }
}
