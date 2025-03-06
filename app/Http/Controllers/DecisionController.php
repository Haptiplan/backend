<?php

namespace App\Http\Controllers;

use App\Models\Decision;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Game;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DecisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        if (Session::has('impersonate')) {
            $id = Session::get('impersonate');
        }

        $player = Player::find($id);
        $company = Company::where('id', $player->company_id)->first();

        $game = Game::where('id', $company->game_id)->first();

        $player_ids = Player::where('company_id', $company->id)->pluck('id')->toArray();
        $decisions = Decision::whereIn('player_id', $player_ids)->get();

        if (($decisions->max('period') < $game->current_period_number) || $decisions->isEmpty()) {
            return redirect()->route('decisions.create');
        }

        return view('user.decision.index', [
            'decisions' => $decisions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = Auth::user()->id;
        if (Session::has('impersonate')) {
            $id = Session::get('impersonate');
        }

        $player = Player::find($id);
        $company = Company::where('id', $player->company_id)->first();
        $game = Game::where('id', $company->game_id)->first();

        $player_ids = Player::where('company_id', $company->id)->pluck('id')->toArray();
        $decisions = Decision::whereIn('player_id', $player_ids)->orderByDesc('id')->get();

        if ($decisions->isNotEmpty() && ($decisions->max('period') >= $game->current_period_number)) {
            return redirect()->route('decisions.index');
        }

        return view('gamemaster.decisions.create', [
            'decisions' => $decisions,
            'period' => $game->current_period_number,
            'player' => $player,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'approve' => 'required',
            'player_id' => 'required | exists:players,id',
            'period' => 'digits_between:1,8',
        ]);

        DB::table('decisions')->insert([
            'player_id' => $validated['player_id'],
            'period' => $validated['period'],
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $decision = Decision::findOrFail($id);
        $decision_maker = User::where('id', $decision->player_id)->first();

        return view('gamemaster.decisions.show', [
            'decision' => $decision,
            'decision_maker' => $decision_maker,
        ]);
    }

    /**
     * Display all decisions the players made for the gamemaster.
     */
    public function check($id, $period)
    {
        $all_games = Game::hasGamemasters()->get();
        $all_companies = Company::where('game_id', $all_games->pluck('id')->toArray())->get();
        $game = Game::find($id);
        $companies = Company::where('game_id', $id)->get();
        $players = Player::whereIn('company_id', $companies->pluck('id')->toArray())->get();

        $decisions = Decision::whereIn('player_id', $players->pluck('id')->toArray())
            ->where('period', $period)->get();
        $decision_makers = User::select('users.*', 'players.company_id')
            ->join('players', 'users.id', '=', 'players.id')
            ->whereIn('users.id', $decisions->pluck('player_id')->toArray())
            ->get();

        return view('gamemaster.decisions.check', [
            'all_games' => $all_games,
            'all_companies' => $all_companies,
            'period' => $period,
            'game' => $game,
            'companies' => $companies,
            'decisions' => $decisions,
            'decision_makers' => $decision_makers,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Decision::findOrFail($id)->delete();

        return redirect()->back();
    }
}
