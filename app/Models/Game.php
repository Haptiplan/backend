<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Game extends Model
{
    use HasFactory;

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function gamemasters(): HasMany
    {
        return $this->hasMany(Gamemaster::class);
    }

    /**
     * Summary of hasGamemasters
     * Function to return all games from the current gamemaster
     * @return Builder|Game
     */
    public static function hasGamemasters()
    {
        $user = Auth::user()->id;
        if (Session::has('impersonate')) {
            $user = Session::get('impersonate');
        }

        $game = Game::whereHas('gamemasters', function ($query) use ($user) {
            $query->where('user_id', $user);
        });

        return $game;
    }
}
