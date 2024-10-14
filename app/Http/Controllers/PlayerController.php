<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Game;
use App\Models\Player;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_list = User::all();
        $games = Game::hasGamemasters()->get();

        $game_ids = $games->pluck('id')->toArray();
        $companies = Company::whereIn('game_id', $game_ids)->get();

        $company_ids = $companies->pluck('id')->toArray();
        $players = Player::whereIn('company_id', $company_ids)->get();
        return view('players.index', [
            'user_list' => $user_list,
            'companies' => $companies, 
            'players' => $players, 
            'games' => $games,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = DB::table('users')
            ->where('role', '=', User::ROLE_USER)
            ->whereNotIn('id', function($query) {
                $query->select('p.id')->from('players as p');
            })
        ->get();
        $games = Game::hasGamemasters()->get();
        $game_ids = $games->pluck('id')->toArray();
        $companies = Company::whereIn('game_id', $game_ids)->get();

        return view('players.create', [
            'users' => $users,
            'games' => $games,
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:players|unique:players,id',
            'company_id' => 'required',
        ]);
    
        DB::table('players')->insert([
            'id' => $validated['id'],
            'company_id' => $validated['company_id'],
        ]);
    
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        $player = Player::find($id);
        $companies = Company::all();
        $games = Game::all();
        return view('players.edit', [
            'user' => $user, 
            'player' => $player,
            'companies' => $companies, 
            'games' => $games,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([ 
            'company_id' => 'required|exists:companies,id' 
        ]);
        $player = Player::find($id);
        $player->company_id = $validated['company_id'];
        $player->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $player = Player::where('id', $id)->firstOrFail();
        $player->delete();

        return redirect()->route('players.index');
    }
}
