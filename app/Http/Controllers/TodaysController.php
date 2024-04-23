<?php

namespace App\Http\Controllers;
use App\Models\Today;
use Illuminate\Http\Request;

class TodaysController extends Controller
{
    public function store (Request $request) {
        $today = new Today;
        $today->starting_amount = $request->starting_amount;
        $today->user_id = $request->user_id;
        $today->save();
        return to_route('dashboard');
    }
}
