<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Player;
use App\Models\User;
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
    public function update(User $user, Player $player)
    {
        //
    }
    public function delete(User $user, Player $player)
    {
        //
    }
}
