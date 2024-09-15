<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Electronics', 'description' => 'Electronic devices and gadgets']);
        Category::create(['name' => 'Clothing', 'description' => 'Fashion and apparel']);
        Category::create(['name' => 'Books', 'description' => 'Books and publications']);
    }
}
