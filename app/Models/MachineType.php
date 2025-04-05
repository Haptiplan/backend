<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineType extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'name',
        'price',
        'fix_costs_per_period',
        'capacity',
        'number_of_operators',
        'depreciation_period'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
