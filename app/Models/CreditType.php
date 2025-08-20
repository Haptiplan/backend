<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditType extends Model
{
        protected $fillable = [
        'name',
        'duration',
        'amount',
        'interest_rate'
    ];
}
