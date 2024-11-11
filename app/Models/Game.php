<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Game extends Model
{
    use HasFactory;

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function gamemasters(): HasMany
    {
        return $this->hasMany(Gamemaster::class);
    }

    public static function hasGamemasters()
    {
        $user = Auth::user()->id;
        if (Session::has('impersonate')) {
            $user = Session::get('impersonate');
        }

        $game = Game::whereHas('gamemasters', function ($query) use ($user) {
            $query->where('id', $user);
        });

        return $game;
    }
}
