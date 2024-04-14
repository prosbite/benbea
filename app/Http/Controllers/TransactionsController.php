<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index () {
        return Transaction::all();
    }

    public function store (Request $request) {
        $transaction = new \App\Models\Transaction;
        $transaction->total_amount = $request->total_amount;
        $transaction->amount_received = $request->amount_received;
        $transaction->discount = $request->discount;
        $transaction->change = $request->change;
        $transaction->user_id = $request->user_id;
        $transaction->save();
        foreach ($transaction->items as $key => $value) {
            $data = [
                'product_id' => $value->id,
                'transaction_id' => $transaction->id,
                'price' => $value->price,
            ];

            DB::table('product_transaction')->insert($data);
        }
        return Inertia::redirect('/dashboard');
    }
}
