<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Game;


class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Game $game)
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $games = Game::all();   
        return view('create_game', ['games' => $games]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Game $game)
    {
        $game_name = $request->input("game_name");
        DB::table('games')->insert(['game_name' => $game_name]); 
        $games = Game::all();   
        return redirect()->route('game_create')->with('success', 'Spiel erfolgreich erstellt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $game_id)
    {
        $game = Game::findOrFail($game_id); 
        return view('edit_game', ['game' => $game]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $game_id)
    {
        $validated = $request->validate([
            'game_name' => 'required|string|max:255', 
        ]);
        
        $game = Game::find($game_id);

        $game->game_name = $validated['game_name'];
        $game->save();
        $game->update();

        return redirect()->route('game_create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('game_create');
    }
}
