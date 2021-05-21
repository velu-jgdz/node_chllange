<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionData extends Model
{
    protected $table = 'transaction_history';
    protected $fillable = [
        'account_from', 'account_to', 'transaction_amount', 'transaction_notes'
    ];
}
