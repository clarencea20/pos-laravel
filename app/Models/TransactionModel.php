<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';
    protected $fillable = [
        'total_amount',
        'discount',
        'amount_tendered',
        'change',
        'payment_method',
        'customer_name'
    ];
}
