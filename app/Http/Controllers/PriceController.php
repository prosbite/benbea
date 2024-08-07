<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|unique:prices,price'
        ]);

        $price = Price::create([
            'price' => $request->price
        ]);

        // return response()->json([
        //     'price' => $price
        // ], 200); // Return a 200 status code
    }

    public function destroy (Price $price) {
        $price->delete();
    }
}
