<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;
    public function todaySales ($userId) {
        $today = Carbon::today();
        return self::whereDate('created_at', $today)->where('user_id', $userId)->with('products')->get();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, "product_transaction")->withPivot('price');
    }
}
