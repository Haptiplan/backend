<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Game;
use App\Models\Gamemaster;
use App\Models\Player;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        $users = User::where('id', '!=', Auth::id())->get();
        $players = Player::all();
        $games = Game::all();
        $companies = Company::all();
        return view('users.create', [
            'users' => $users,
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'role' => 'required',
            'password' => 'required',
            'game' => 'required_if:role,' . User::ROLE_GAMEMASTER,
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => bcrypt($validated['password']),
        ]);

        if($validated['role'] == User::ROLE_GAMEMASTER)
        {
            (new GamemasterContoller)->store($user->id, $validated['game']);
        }

        return redirect()->route('user.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $player = Player::find($id);
        $gamemasters = Gamemaster::findMany($id);
        $game_ids = $gamemasters->pluck('game_id')->toArray();
        
        $games_used = Game::whereIn('id', $game_ids)->get();
        $games_free = Game::whereNotIn('id', $game_ids)->get();
        return view('users.edit', [
            'user' => $user,
            'player' => $player,
            'gamemasters' => $gamemasters,
            'games_free' => $games_free,
            'games_used' => $games_used,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'role' => 'required',
            'game' => 'required_if:role,' . User::ROLE_GAMEMASTER
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if($validated['role'] == User::ROLE_GAMEMASTER) {
            (new GamemasterContoller)->store($id, $validated['game']);
        }
        $user->save();


        return redirect()->route('user.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id', $id)->firstOrFail()->delete();

        return redirect()->route('user.create');
    }
}
