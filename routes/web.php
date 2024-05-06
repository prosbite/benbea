<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TodaysController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\DashboardControllerAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\Transaction;
use Inertia\Inertia;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("/dashboard");
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', AdminMiddleware::class]], function () {
    // Routes within the admin section
    Route::get('dashboard', [DashboardControllerAdmin::class, 'index'])->name('admin.dashboard');
    // ... other admin routes
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/transaction/create', [TransactionsController::class, 'create'])->name('transaction.create');
    Route::post('/today/store', [TodaysController::class, 'store'])->name('today.store');
    Route::get('/receipt/{id}', [ReceiptController::class, 'show'])->name('receipt');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/transaction/store', [TransactionsController::class, 'store'])->name('transaction.store');
});

require __DIR__.'/auth.php';
