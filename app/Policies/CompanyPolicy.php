<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Session;

class CompanyPolicy
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
    public function update(User $user, Company $company)
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }

        $isGamemaster = $company->game->gamemasters()
        ->where('user_id', $user->id)
        ->exists();

        return $isGamemaster
            ? Response::allow()
            : Response::deny();
    }
    public function delete(User $user, Company $company)
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }

        $isGamemaster = $company->game->gamemasters()
        ->where('user_id', $user->id)
        ->exists();

        return $isGamemaster
            ? Response::allow()
            : Response::deny();
    }
}
