<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'machinetype_id',
        'company_id',
        'period',
        'original_price'
    ];

    public function machinetype()
    {
        return $this->belongsTo(MachineType::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
