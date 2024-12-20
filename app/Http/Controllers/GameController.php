<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Gamemaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Game $game)
    {
        $games = Game::hasGamemasters()->get();
        return view('games.create', ['games' => $games]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $game_name = $request->validate([
            'game_name' => 'required|unique:games,name'
        ]);
        DB::table('games')->insert(['name' => $game_name['game_name']]);

        $game = Game::where('name', $game_name['game_name'])->firstOrFail();

        if (Session::has('impersonate')) {
            $id = Session::get('impersonate');
        } else {
            $id = Auth::user()->id;
        }

        DB::table('gamemasters')->insert([
            'id' => $id,
            'game_id' => $game->id,
        ]);

        return redirect()->route('game.index')->with('status', 'messages.success-create');
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
        $id = Auth::user()->id;
        if (Session::has('impersonate')) {
            $id =  Session::get('impersonate');
        }
        $game = Game::hasGamemasters()->findOrFail($game_id);
        $gm_in_game = Gamemaster::where('game_id', $game_id)->pluck('id')->toArray();
        $gamemasters = User::where('role', User::ROLE_GAMEMASTER)->whereNot('id', $id)->whereNotIn('id', $gm_in_game)->get();
        $list = Gamemaster::where('game_id', $game_id)->whereNot('id', $id)->pluck('id')->toArray();
        $list_gamemasters = User::whereIn('id', $list)->get();
        return view('games.edit', [
            'game' => $game,
            'game_id' => $game_id,
            'gamemasters' => $gamemasters,
            'list_gamemasters' => $list_gamemasters,
        ]);
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

        return redirect()->route('game.index')->with('status', 'messages.successEdit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('game.index')->with('status', 'message.successDelete');
    }
}
