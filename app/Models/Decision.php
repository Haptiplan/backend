<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Decision extends Model
{
    use HasFactory;
    public $timestamps = true; // This is default, but make sure it's not set to false

    public function player():BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
