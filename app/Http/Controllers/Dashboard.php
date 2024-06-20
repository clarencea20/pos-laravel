<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\TransactionModel;

class Dashboard extends Controller
{
    public function index()
    {
        $totalProducts = ProductModel::count();
        $totalTransactions = TransactionModel::count();
        $totalIncome = TransactionModel::sum('total_amount');

        return view('dashboard', compact('totalProducts', 'totalTransactions', 'totalIncome'));
    }
}
