<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineDecision extends Model
{
    use HasFactory;

    protected $fillable = [
        'buy',
        'sell'
    ];

    public function machinetype()
    {
        return $this->belongsTo(MachineType::class);
    }

    public function decision()
    {
        return $this->belongsTo(Decision::class);
    }
}
