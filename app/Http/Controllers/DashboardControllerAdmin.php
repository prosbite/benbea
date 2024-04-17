<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardControllerAdmin extends Controller
{
    public function index () {
        return Inertia::render('admin/Dashboard',[
            "user" => Auth::user(),
        ]);
    }
}
