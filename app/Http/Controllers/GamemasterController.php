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
        if ($request->user()->cannot('store', [Gamemaster::class, $game])) {
            abort(403);
        }

        $user = $request->user();
        if (Session::has('impersonate')) $user = User::find(Session::get('impersonate'));

        if (!(DB::table('gamemasters')->where('user_id', $validated['gamemaster'])->where('game_id', $validated['game_id'])->exists())){
            DB::table('gamemasters')->insert([
                'id' => $validated['gamemaster'],
                'user_id' => $user->id,
                'game_id' => $validated['game_id'],
            ]);
        }
        return redirect(route('game.edit', [$validated['game_id']]));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id, $game_id)
    {
        $gamemaster = Gamemaster::where('id', $id)->where('game_id', $game_id);

        $game = Game::find($game_id);
        if ($request->user()->cannot('delete', [Gamemaster::class, $game])) {
            abort(403);
        }
        
        $gamemaster->delete();
        return redirect()->back();
    }
    /**
     * Remove the specified resources from storage.
     */
    public function destroyAll(Request $request, $id)
    {
        $gamemaster = Gamemaster::where('id', $id);
        
        $game = null;
        if ($request->user()->cannot('deleteAll', [Gamemaster::class, $game])) {
            abort(403);
        }
        
        $gamemaster->delete();
        return redirect()->back();
    }
}
