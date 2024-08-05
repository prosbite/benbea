<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;

class PriceProductController extends Controller
{
    public function destroy (Product $product, Price $price) {
        $product->prices()->detach($price);
    }
}
