<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Session;

class GamemasterPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function store(User $user, Game $game): Response
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }

        if ($user->role == User::ROLE_ADMIN) return Response::allow();

        return ($user->role == User::ROLE_GAMEMASTER)
            ? Response::allow()
            : Response::deny();
    }
    
    public function delete(User $user, Game $game)
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }

        if ($user->role == User::ROLE_ADMIN) return Response::allow();

        return in_array($game->id, $game->hasGamemasters()->pluck('id')->toArray())
            ? Response::allow()
            : Response::deny();
    }

    public function deleteAll(User $user)
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }

        return $user->role == User::ROLE_ADMIN
            ? Response::allow()
            : Response::deny();
    }
}
