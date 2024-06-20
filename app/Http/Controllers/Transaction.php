<?php

namespace App\Http\Controllers;

use App\Models\TransactionModel;
use Illuminate\Http\Request;

class Transaction extends Controller
{
    public function index()
    {
        $transactions = TransactionModel::orderBy('transaction_id', 'desc');

        if(request()->has('search')){
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $transactions = $transactions->where(function($query) use($searchTerm) {
                    $query->where('transactions.customer_name', 'like', "%$searchTerm%");
                });
            }
        }
        $transactions = $transactions->paginate(10)
            ->appends(['search' => request()->get('search')]);
            
        return view('transaction.index', compact('transactions'));
    }
}
