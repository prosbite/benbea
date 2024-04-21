<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Manually define product prices
        $productPrices = [
            ['product_id' => 1, 'price_id' => 8],
            ['product_id' => 1, 'price_id' => 9],
            ['product_id' => 1, 'price_id' => 10],
            ['product_id' => 1, 'price_id' => 12],
            ['product_id' => 1, 'price_id' => 13],
            ['product_id' => 3, 'price_id' => 6],
            ['product_id' => 3, 'price_id' => 7],
            ['product_id' => 3, 'price_id' => 8],
            ['product_id' => 3, 'price_id' => 9],
            ['product_id' => 3, 'price_id' => 10],
            ['product_id' => 3, 'price_id' => 12],
            ['product_id' => 3, 'price_id' => 14],
            ['product_id' => 2, 'price_id' => 8],
            ['product_id' => 2, 'price_id' => 9],
			['product_id' => 2, 'price_id' => 10],
            ['product_id' => 2, 'price_id' => 11],
			['product_id' => 2, 'price_id' => 12],
			['product_id' => 2, 'price_id' => 14],
			['product_id' => 2, 'price_id' => 16],
            ['product_id' => 4, 'price_id' => 4],
            ['product_id' => 4, 'price_id' => 5],
            ['product_id' => 4, 'price_id' => 6],
            ['product_id' => 4, 'price_id' => 7],
            ['product_id' => 5, 'price_id' => 1],
            ['product_id' => 5, 'price_id' => 2],
            ['product_id' => 5, 'price_id' => 3],
            ['product_id' => 5, 'price_id' => 7],
            // Add more entries as needed
        ];

        // Insert data into the product_price pivot table
        foreach ($productPrices as $productPrice) {
            DB::table('price_product')->insert($productPrice);
        }
    }
}
