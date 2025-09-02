<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'stripe_customer_id',
        'stripe_setup_intent_id',
        'stripe_account_id'
    ];
}
