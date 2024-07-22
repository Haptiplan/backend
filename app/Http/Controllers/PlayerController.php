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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = DB::table('users')
            ->where('role', '=', 0)
            ->whereNotIn('id', function($query) {
                $query->select('p.id')->from('players as p');
            })
            ->get();
        $user_list = User::all();
        $companies = Company::all();
        $players = Player::all();
        $games = Game::all();
        return view('create_player', [
            'users' => $users, 
            'user_list' => $user_list,
            'companies' => $companies, 
            'players' => $players, 
            'games' => $games,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|unique:players,id',
            'company_id' => 'required',
        ]);
    
        DB::table('players')->insert([
            'id' => $validated['id'],
            'company_id' => $validated['company_id'],
        ]);
    
        return redirect()->route('player_create');
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
        return view('edit_player', [
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
        $validated = $request->validate([ 'company_id' => 'required|exists:companies,id' ]);
        $player = Player::find($id);
        $player->company_id = $validated['company_id'];
        $player->update();

        return redirect()->route('player_create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $player = Player::where('id', $id)->firstOrFail();
        $player->delete();

        return redirect()->route('player_create');
    }
}