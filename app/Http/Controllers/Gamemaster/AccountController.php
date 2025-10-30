<?php

namespace App\Http\Controllers\gamemaster;

use App\Http\Controllers\Controller;
use App\Models\Decision\Account;
use App\Models\Game\Game;
use App\Models\User\User;
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
        $game = Game::find(session('selected_game_id'));
        $period = $game->current_period_number;
        return view('gamemaster.results.index', [
            'game' => $game,
            'periods' => $period - 1,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $period)
    {
        $user = Auth::user();
        if (Session::has('impersonate')) {
            $user = User::find(Session::get('impersonate'));
        }
        $game = Game::find(session('selected_game_id'));
        if ($period < 0 || $period >= $game->current_period_number) {
            return redirect()->route('accounts.index')->withErrors(['error' => __('messages.invalid_period')]);
        }
        $companies = $game->companies;
        $guvs = [];
        $bilanzen = [];

        foreach ($companies as $company) {
            $guv = Account::calculateGuV($company->id, $period);
            $bilanz = Account::bilanzMitGuV($company->id, $period);

            $guvs[$company->id] = $guv;
            $bilanzen[$company->id] = $bilanz;
        }

        return view('gamemaster.results.show', [
            'game' => $game,
            'period' => $period,
            'companies' => $companies,
            'guvs' => $guvs,
            'bilanzen' => $bilanzen,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
