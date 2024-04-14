<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['product_name' => 'Trousers', 'icon' => '/img/pants.png'],
            ['product_name' => 'Blazers', 'icon' => '/img/jacket.png'],
            ['product_name' => 'Dress', 'icon' => '/img/dress.png'],
            ['product_name' => 'Tops', 'icon' => '/img/blouse.png'],
            ['product_name' => 'Misc', 'icon' => '/img/belt.png']
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'product_name' => $product['product_name'],
                'price' => 0.00,
                'icon' => $product['icon'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
