<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class PlayerPolicy
{
    public function store(User $user, Company $company)
    {
        // ToDo: even if user->id is in array user_ids, I get 403 page.

        if (Session::has('impersonate'))
        {
            $user = User::find(Session::get('impersonate'));
        }
        $user_ids = $company->game->gamemasters->pluck('user_id');

        return $user_ids->contains($user->id);
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
