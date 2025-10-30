<?php

namespace App\Models\Decision;

use App\Models\User\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Decision extends Model
{
    use HasFactory;
    public $timestamps = true; // This is default, but make sure it's not set to false

    protected $fillable = [
        'player_id',
        'period'
    ];

    public function player():BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function machinedecisions()
    {
        return $this->hasMany(MachineDecision::class);
    }
}
