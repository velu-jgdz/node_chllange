<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountDetails extends Model
{
    protected $table = 'account_details';
    protected $fillable = [
        'account_number', 'user_id', 'balance'
    ];
}
