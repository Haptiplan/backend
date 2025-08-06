<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Session;

class DecisionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function store(User $user, Company $company): Response
    {
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }

        $player = $company->players()
            ->where('id', $user->id)
            ->first();

        if (!$player) {
            return Response::deny();
        }

        $periodDecisions = $company->players->flatMap->decisions->pluck('period')->toArray();

        return in_array($company->game->current_period_number, $periodDecisions)
            ? Response::allow()
            : Response::deny();
    }
}
