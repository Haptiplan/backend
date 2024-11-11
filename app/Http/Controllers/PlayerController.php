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
        // Get users who are not already players
        $users = User::where('role', User::ROLE_USER)
            ->whereDoesntHave('players')  // Using Eloquent to avoid subquery
            ->get();

        $user_list = User::all();

        // Get games that have gamemasters
        $games = Game::hasGamemasters()->get();

        // Get companies for these games
        $game_ids = $games->pluck('id')->toArray();
        $companies = Company::whereIn('game_id', $game_ids)->get();

        // Get players from the related companies
        $company_ids = $companies->pluck('id')->toArray();
        $players = Player::whereIn('company_id', $company_ids)->get();

        return view('players.create', [
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
        // Validate the request data
        $validated = $request->validate([
            'id' => 'required|unique:players,id',
            'company_id' => 'required|exists:companies,id', // Ensures the company exists
        ]);

        // Create the new player using Eloquent
        Player::create([
            'id' => $validated['id'],
            'company_id' => $validated['company_id'],
        ]);

        // Redirect with a success message
        return redirect()->route('player.create')->with('success', 'Player successfully created!');
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
        // Retrieve the user and player by ID, throw an exception if not found
        $user = User::findOrFail($id);
        $player = Player::findOrFail($id);

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
        // Validate the company_id
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id'
        ]);

        // Find the player or fail if not found
        $player = Player::findOrFail($id);

        // Update the company_id and save the player
        $player->company_id = $validated['company_id'];
        $player->save(); // No need to call update(), save() is sufficient

        return redirect()->route('player.create')->with('success', 'Player updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $player = Player::findOrFail($id);

        $player->delete();

        return redirect()->route('player.create')->with('success', 'Player deleted successfully');
    }
}
