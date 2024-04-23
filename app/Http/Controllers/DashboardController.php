<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Today;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index () {
        return Inertia::render('MyDashboard',[
            "user" => Auth::user(),
            "today" => (new Today())->today(Auth::user()->id),
            "today_sales" => (new Transaction())->todaySales(Auth::user()->id)
        ]);
    }
}
