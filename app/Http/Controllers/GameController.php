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
        $games = Game::all();   
        return view('games.create', ['games' => $games]);
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
        $game_name = $request->validate([
            'game_name' => 'required|unique:games,name'
        ], [
            'game_name.required' => 'The game must have a name!',
            'game_name.unique' => 'The name of the game must be unique!'
        ]);
        DB::table('games')->insert(['name' => $game_name['game_name']]); 
        $games = Game::all();   
        return redirect()->route('game.index')->with('success', 'Spiel erfolgreich erstellt!');
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
        return view('games.edit', ['game' => $game]);
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

        $game->name = $validated['game_name'];
        $game->save();
        $game->update();

        return redirect()->route('game.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('game.index');
    }
}
