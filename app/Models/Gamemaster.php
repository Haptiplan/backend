<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gamemaster extends Model
{
    use HasFactory;

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
