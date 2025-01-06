<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Gamemaster;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GamemasterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gamemaster' => 'required|exists:users,id',
            'game_id' => 'required|exists:games,id',
        ]);

        $game = Game::find($validated['game_id']);

        // Check if the user is authorized to store the Gamemaster
        if ($request->user()->cannot('store', [Gamemaster::class, $game])) {
            abort(403);
        }

        // Use Eloquent to check if the Gamemaster already exists
        $existingGamemaster = Gamemaster::where('user_id', $validated['gamemaster'])
            ->where('game_id', $validated['game_id'])
            ->first();

        // If not exists, create the new gamemaster record
        if (!$existingGamemaster) {
            Gamemaster::create([
                'user_id' => $validated['gamemaster'],
                'game_id' => $validated['game_id'],
            ]);
        }

        return redirect(route('games.edit', [$validated['game_id']]));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroyOne(Request $request, $id, $game_id)
    {
        // Retrieve the Gamemaster record
        $gamemaster = Gamemaster::where('id', $id)->where('game_id', $game_id);

        // If Gamemaster doesn't exist, abort with 404
        if (!$gamemaster) {
            abort(404);
        }

        // Find the associated game
        $game = Game::find($game_id);

        // Check if the user has permission to delete the Gamemaster
        if ($request->user()->cannot('delete', [Gamemaster::class, $game])) {
            abort(403);
        }

        // Delete the Gamemaster record
        $gamemaster->delete();

        return redirect()->back()->with('success', 'Gamemaster removed successfully.');
    }
    /**
     * Remove the specified resources from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Retrieve the Gamemaster record by ID
        $gamemaster = Gamemaster::where('id', $id);

        // If Gamemaster doesn't exist, abort with 404
        if (!$gamemaster) {
            abort(404);
        }

        // Check if the user has permission to delete the Gamemaster
        if ($request->user()->cannot('deleteAll', Gamemaster::class)) {
            abort(403);
        }

        // Delete the Gamemaster record
        $gamemaster->delete();

        return redirect()->back()->with('success', 'Gamemaster removed successfully.');
    }
}
