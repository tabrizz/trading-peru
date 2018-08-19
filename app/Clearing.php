<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clearing extends Model
{
    //
    protected $fillable = [
        'seller_id',
        'expense_id',
        'payment_id',
        'discount_id',
        'credit_id',
        'sells_id',
        'incomes_id',
        'income',
        'expense',
        'discount',
        'credit',
        'payment',
        'balance',
    ];
}
