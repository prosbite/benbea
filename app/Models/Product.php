<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
	protected $primary_key = 'product_id';

    public function prices()
    {
        return $this->belongsToMany(Price::class);
    }
}
