<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function index () {
        return (new Transaction())->todaySales();
    }

    public function create () {
        $products = Product::with(['prices' => function ($query) {
            $query->orderBy('price', 'asc');
        }])->get();

        return Inertia::render('TransactionCreate',[
            "products" => $products
        ]);
    }

    public function store (Request $request) {
        $transaction = new \App\Models\Transaction;
        $transaction->total_amount = $request->total_amount;
        $transaction->amount_received = $request->amount_received;
        $transaction->discount = $request->discount;
        $transaction->change = $request->change;
		$transaction->note = $request->note;
        $transaction->user_id = $request->user_id;
        $transaction->save();
        foreach ($request->items as $value) {
            $data = [
                'product_id' => $value['id'],
                'transaction_id' => $transaction->id,
                'price' => $value['price'],
            ];

            DB::table('product_transaction')->insert($data);
        }
        return to_route('receipt', $transaction->id);
    }
}
