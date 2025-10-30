<?php

namespace App\Models\Decision;

use App\Models\Game\MachineType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineDecision extends Model
{
    use HasFactory;

    protected $fillable = [
        'decision_id',
        'machine_type_id',
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
