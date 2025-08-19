<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountEntry;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }
        $company = $user->player->company;
        $period = $company->game->current_period_number;
        $accounts = Account::where('company_id', $company->id)
            ->where('period', '<', $period)
            ->get();
        return redirect(route('accounts.index', [
            'accounts' => $accounts,
            'period' => $period - 1,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }
        $company = $user->player->company;
        $period = $company->game->current_period_number - 1;
        $accounts = Account::where('company_id', $company->id)
            ->where('period', $period)
            ->get();
        $guv = Account::calculateGuV($company->id, $period);
        return redirect(route('accounts.index', [
            'accounts' => $accounts,
            'period' => $period,
            'guv' => $guv,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }
}

