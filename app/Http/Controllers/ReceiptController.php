<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Inertia\Inertia;

class ReceiptController extends Controller
{
    public function show ($id) {
        $transaction = Transaction::with('products')->find($id);
        return Inertia::render('Receipt',[
            "transaction" => $transaction
        ]);
    }
}
