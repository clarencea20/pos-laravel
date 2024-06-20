<?php

namespace Database\Seeders;

use App\Models\ProductModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductModel::factory()->create([
            'product_name' => 'Toothpaste',
            'product_price' => 'P120',
            'product_quantity' => '200'
         ]);
    }
}
