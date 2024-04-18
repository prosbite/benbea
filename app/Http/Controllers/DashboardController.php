<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index () {
        return Inertia::render('MyDashboard');
    }
}
