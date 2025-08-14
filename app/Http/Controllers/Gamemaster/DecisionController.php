<?php

namespace App\Http\Controllers\Gamemaster;

use App\Models\Decision;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Game;
use App\Models\Machine;
use App\Models\MachineDecision;
use App\Models\MachineType;
use App\Models\Player;
use App\Models\User;
use App\Services\DecisionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;


class DecisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display all decisions the players made for the gamemaster.
     */
    public function show($id, $period)
    {
       $all_games = Game::hasGamemasters()->get();
        $all_companies = Company::where('game_id', $all_games->pluck('id')->toArray())->get();
        $game = Game::find($id);
        $companies = Company::where('game_id', $id)->get();
        $players = Player::whereIn('company_id', $companies->pluck('id')->toArray())->get();

        $decisions = Decision::whereIn('player_id', $players->pluck('id')->toArray())
            ->where('period', $period)->get();
        $machine_decisions = MachineDecision::whereIn('decision_id', $decisions->pluck('id')->toArray())->get();

        $machines_bought = Machine::whereIn('company_id', $companies->pluck('id')->toArray())->where('period', $period)->get();
        $machines_sold = Machine::whereIn('id', $machine_decisions->pluck('sell')->toArray())->get();

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
            'machine_decisions' => $machine_decisions,
            'machines_bought' => $machines_bought,
            'machines_sold' => $machines_sold,
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
