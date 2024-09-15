<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Smartphone',
            'description' => 'A high-end smartphone with 128GB storage',
            'price' => 699.99,
            'category_id' => 1,
            'stock' => 50
        ]);

        Product::create([
            'name' => 'T-Shirt',
            'description' => 'Comfortable cotton t-shirt',
            'price' => 19.99,
            'category_id' => 2,
            'stock' => 200
        ]);
    }
}
