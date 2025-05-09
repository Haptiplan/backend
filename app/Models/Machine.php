<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    public function machinetype()
    {
        return $this->belongsTo(MachineType::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
