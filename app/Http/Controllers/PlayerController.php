<?php

namespace App\Http\Controllers;

use App\Models\Game\Company;
use App\Models\Game\Game;
use App\Models\User\Player;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $game_id = session('selected_game_id');
        $game = Game::findOrFail($game_id);

        // Get all companies for the games that have gamemasters
        $companies = Company::where('game_id', $game_id)->get();
        // Get the players related to these companies (eager loading done in the above query)
        $players = Player::whereIn('company_id', $companies->pluck('id'))->get();

        $user_ids = $players->pluck('id');
        $user_list = User::whereIn('id', $user_ids)->get();

        return view('gamemaster.players.index', [
            'user_list' => $user_list,
            'companies' => $companies,
            'players' => $players,
            'game' => $game,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Fetch users who do not have a player record.
        $users = User::whereHas('role', function ($query) {
            $query->where('name', 'user');
        })
            ->whereNotIn('id', Player::pluck('id'))
            ->get();

        $game_id = session('selected_game_id');
        $game = Game::findOrFail($game_id);

        $companies = Company::where('game_id', $game_id)->get();

        return view('gamemaster.players.create', [
            'users' => $users,
            'game' => $game,
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = Company::find($request->input('company_id'));

        // Validate the input
        $validated = $request->validate([
            'id' => 'required|exists:users,id|unique:players,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        // Retrieve the company
        $company = Company::find($validated['company_id']);

        // Check if the user has permission to store the player for the given company
        if ($request->user()->cannot('store', [Player::class, $company])) {
            abort(403);
        }

        // Use Eloquent to insert the new player into the players table
        Player::create([
            'id' => $validated['id'],
            'company_id' => $validated['company_id'],
        ]);

        return redirect()->back()->with('status', 'messages.successCreate');
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
        $user = User::findOrFail($id);
        $player = Player::find($id);
        $game_id = session('selected_game_id');
        $game = Game::findOrFail($game_id);
        // Fetch all companies
        $companies = Company::all();

        return view('gamemaster.players.edit', [
            'user' => $user,
            'player' => $player,
            'companies' => $companies,
            'game' => $game,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the input
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id'
        ]);

        // Find the company to be associated with the player
        $company = Company::findOrFail($validated['company_id']);

        // Check if the user has permission to update the player
        if ($request->user()->cannot('update', [Player::class, $company])) {
            abort(403);
        }

        // Find the player record, and update the company_id
        $player = Player::findOrFail($id); // Using findOrFail to handle missing players
        $player->company_id = $company->id;
        $player->save(); // Use save() instead of update() when updating individual attributes

        // Redirect back to the previous page
        return redirect()->back()->with('status', 'messages.successEdit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Find the player or throw a 404 error if not found
        $player = Player::findOrFail($id);

        // Find the associated company, or throw a 404 error if not found
        $company = Company::findOrFail($player->company_id);

        // Check if the user has permission to delete this player
        if ($request->user()->cannot('delete', [Player::class, $company])) {
            abort(403);
        }

        // Delete the player record
        $player->delete();

        // Redirect to the players index page
        return redirect()->route('games.players.index')->with('status', 'messages.successDelete');
    }
}
