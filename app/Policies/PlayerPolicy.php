<?php

namespace App\Policies;

use App\Models\Game\Company;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Session;

class PlayerPolicy
{
    public function store(User $user, Company $company): Response
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }
        $user_ids = $company->game->gamemasters->pluck('user_id')->toArray();

        return in_array($user->id, $user_ids)
            ? Response::allow()
            : Response::deny();
    }
    public function update(User $user, Company $company)
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }
        $user_ids = $company->game->gamemasters->pluck('user_id')->toArray();

        return in_array($user->id, $user_ids)
            ? Response::allow()
            : Response::deny();
    }
    public function delete(User $user, Company $company)
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }
        $user_ids = $company->game->gamemasters->pluck('user_id')->toArray();

        return in_array($user->id, $user_ids)
            ? Response::allow()
            : Response::deny();
    }
}
