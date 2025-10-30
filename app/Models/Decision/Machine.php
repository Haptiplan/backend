<?php

namespace App\Models\Decision;

use App\Models\Game\Company;
use App\Models\Game\MachineType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'machinetype_id',
        'company_id',
        'period',
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
