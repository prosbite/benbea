<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Today;

class DashboardControllerAdmin extends Controller
{
    public function index () {
        return Inertia::render('admin/Dashboard',[
            "user" => Auth::user(),
            "today" => (new Today())->today(Auth::user()->id),
            "today_sales" => (new Transaction())->salesByDate(1, '2024-05-09')
        ]);
    }
}
