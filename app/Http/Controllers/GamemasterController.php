<?php

namespace App\Http\Controllers;

use App\Models\Gamemaster;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

        // Check if the gamemaster-game relationship exists or create it
        Gamemaster::firstOrCreate([
            'gamemaster_id' => $validated['gamemaster'],
            'game_id' => $validated['game_id'],
        ]);

        return redirect(route('game.edit', [$validated['game_id']]));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $game_id)
    {
        $gamemaster = Gamemaster::where('id', $id)->where('game_id', $game_id)->first();

        if ($gamemaster) {
            $gamemaster->delete();
            return redirect()->back()->with('success', 'Gamemaster removed successfully.');
        } else {
            return redirect()->back()->with('error', 'Gamemaster not found.');
        }

    }
    /**
     * Remove the specified resources from storage.
     */
    public function destroyAll($id)
    {
        $gamemaster = Gamemaster::where('id', $id)->first();

        if ($gamemaster) {
            $gamemaster->delete();
            return redirect()->back()->with('success', 'Gamemaster removed successfully.');
        }

        return redirect()->back()->with('error', 'Gamemaster not found.');
    }
}
