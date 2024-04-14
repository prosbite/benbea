<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = [
            ['price' => 15.00],
            ['price' => 20.00],
            ['price' => 25.00],
            ['price' => 80.00],
            ['price' => 100.00],
            ['price' => 120.00],
            ['price' => 150.00],
            ['price' => 200.00],
            ['price' => 250.00],
            ['price' => 280.00],
            ['price' => 290.00],
            ['price' => 350.00],
            ['price' => 380.00],
            ['price' => 450.00],
            ['price' => 490.00],
            // Add more prices as needed
        ];

        // Insert data into the prices table
        \App\Models\Price::insert($prices);
    }
}
