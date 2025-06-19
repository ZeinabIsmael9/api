<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Category::factory(10)->create();
        Product::factory(50)->create();
    }
}
