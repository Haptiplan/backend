<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
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
        return view('gamemaster.games.index', ['games' => $games]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gamemaster.games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'game_name' => 'required|unique:games,name',
        ]);

        // Create the game
        Game::create(['name' => $validated['game_name']]);

        $game = Game::where('name', $validated['game_name'])->firstOrFail();

        // Authorization check
        if ($request->user()->cannot('store', [Game::class, $request->user()])) {
            abort(403);
        }

        // Determine the user ID for the gamemaster
        $id = Session::has('impersonate') ? Session::get('impersonate') : Auth::id();

        // Insert the gamemaster record
        DB::table('gamemasters')->insert([
            'user_id' => $id,
            'game_id' => $game->id,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('status', 'messages.successCreate');
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
    public function edit(Request $request, string $game_id)
    {
        // Determine the user ID based on session impersonation
        $id = Session::has('impersonate') ? Session::get('impersonate') : Auth::id();

        // Get the game and its associated gamemasters
        $game = Game::hasGamemasters()->findOrFail($game_id);

        // Get the user IDs of the gamemasters associated with the game, excluding the current user (if impersonating)
        $gm_in_game = Gamemaster::where('game_id', $game_id)->pluck('user_id')->toArray();

        // Retrieve the users who are not already gamemasters for the game and not the current user
        $gamemasters = User::whereHas('role', function ($query) {
            $query->where('name', 'gamemaster');
        })
            ->where('id', '!=', $id)
            ->whereNotIn('id', $gm_in_game)
            ->get();

        // Get the list of gamemasters already assigned to the game excluding the current user
        $list_gamemasters = Gamemaster::where('game_id', $game_id)
            ->whereNot('user_id', $id)
            ->with('user')  // Eager load the associated User model to avoid multiple queries
            ->get()
            ->pluck('user'); // Pluck out the user model directly

        return view('gamemaster.games.edit', [
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
        // Validate the input
        $validated = $request->validate([
            'game_name' => 'required|string|max:255',
        ]);

        // Find the game or abort if not found
        $game = Game::findOrFail($game_id);

        // Check if the user is authorized to update the game
        if ($request->user()->cannot('update', $game)) {
            abort(403);
        }

        // Update the game name
        $game->update(['name' => $validated['game_name']]);

        // Redirect back with a success message
        return redirect()->back()->with('status', 'messages.successEdit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // Find the game or abort if not found
        $game = Game::findOrFail($id);

        // Check if the user is authorized to delete the game
        if ($request->user()->cannot('delete', $game)) {
            abort(403);
        }

        // Delete the game
        $game->delete();

        // Redirect to the games index route with a success message
        return redirect()->route('games.index')->with('status', 'messages.successDelete');
    }

    public function continue(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
        ]);

        if (!$request->has('done')) {
            return redirect()->back()->withErrors(['error' => __('validation.custom.no_decision')]);
        }

        $finished = array_sum($request['done']);
        $game = Game::find($validated['game_id']);
        $companies = Company::where('game_id', $game->id)->count();

        if ($finished < $companies) {
            return redirect()->back()->withErrors(['error' => __('validation.custom.no_decision')]);
        }

        if ($game->current_period_number <= $game->max_period_number) {
            $game->increment('current_period_number');
        }
        return redirect()->route('decision.check', [$game->id, $game->current_period_number]);
    }  
    public function changeStatus(string $id)
    {
        $game = Game::findOrFail($id);
        $game = DB::table('games')->where('id', $id)->first();
        $newStatus = $game->active == 1 ? 0 : 1;
        DB::table('games')->where('id', $id)->update(['active' => $newStatus]);
        return redirect()->route('gamemaster.game.index');
    }
}

