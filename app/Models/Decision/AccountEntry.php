<?php

namespace App\Models\Decision;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'company_id',
        'period',
        'debit', //SOLL
        'credit', // HABEN
        'amount',
    ];
    public function accountDebit()
    {
        return $this->belongsTo(Account::class, 'debit');
    }
    public function accountCredit()
    {
        return $this->belongsTo(Account::class, 'credit');
    }
}
