<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\MachineType;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Session;

class MachineTypePolicy
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

        return in_array($user->id, $game->gamemasters->pluck('user_id')->toArray())
            ? Response::allow()
            : Response::deny();
    }
    public function update(User $user, MachineType $machine_type)
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }

        $isGamemaster = $machine_type->game->gamemasters()
        ->where('user_id', $user->id)
        ->exists();

        return $isGamemaster
            ? Response::allow()
            : Response::deny();
    }
    public function delete(User $user, MachineType $machine_type)
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }

        $isGamemaster = $machine_type->game->gamemasters()
        ->where('user_id', $user->id)
        ->exists();

        return $isGamemaster
            ? Response::allow()
            : Response::deny();
    }
}
