<?php

namespace App\Http\Controllers;

use App\Models\Decision\Account;
use App\Models\User\User;
use App\Http\Controllers\Controller;
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
        return view('user.results.index', [
            'periods' => $period - 1,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($period)
    {
        $user = Auth::user();
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }
        $company = $user->player->company;
        if ($period < 0 || $period >= $company->game->current_period_number) {
            return redirect()->route('accounts.index')->withErrors(['error' => __('messages.invalid_period')]);
        }
        $guv = Account::calculateGuV($company->id, $period);
        $bilanz = Account::bilanzMitGuV($company->id, $period);
        return view('user.results.show', [
            'period' => $period,
            'guv' => $guv,
            'bilanz' => $bilanz,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }
}

