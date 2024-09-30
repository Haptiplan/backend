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
        if (!(DB::table('gamemasters')->where('id', $validated['gamemaster'])->where('game_id', $validated['game_id'])->exists())){
            $new_gamemaster = new Gamemaster();
            $new_gamemaster->game_id = $validated["game_id"];
            $new_gamemaster->id = $validated["gamemaster"];
            $new_gamemaster->save();
        }
        return redirect(route('game.edit', [$validated['game_id']]));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $game_id)
    {
        Gamemaster::where('id', $id)->where('game_id', $game_id)->delete();
        return redirect()->back();
    }
    /**
     * Remove the specified resources from storage.
     */
    public function destroyAll($id)
    {
        Gamemaster::whereId($id)->delete();
        return redirect()->back();
    }
}
