<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Session;


class GamePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function store(User $user): Response
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }

        return $user->role->id == User::ROLE_GAMEMASTER
            ? Response::allow()
            : Response::deny();
    }
    public function update(User $user, Game $game)
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }

        return in_array($user->id, $game->gamemasters()->pluck('user_id')->toArray())
            ? Response::allow()
            : Response::deny();
    }
    public function delete(User $user, Game $game)
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }
        
        return in_array($user->id, $game->gamemasters()->pluck('user_id')->toArray())
            ? Response::allow()
            : Response::deny();
    }
}
