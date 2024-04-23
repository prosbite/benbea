<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Today extends Model
{
    use HasFactory;

    public function today ($id) {
        $today = Carbon::today();
        return self::whereDate("created_at", $today)->where("user_id", $id)->first();
    }
}
