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
    public function store($id, $game_id)
    {
        if(!(DB::table('gamemasters')->where('id', $id)->where('game_id', $game_id)->exists()))
            DB::table('gamemasters')->insert([
                'id' => $id,
                'game_id' => $game_id,
            ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $game_id)
    {
        Gamemaster::where('id', $id)->where('game_id', $game_id)->firstOrFail()->delete();
    }
    /**
     * Remove the specified resources from storage.
     */
    public function destroyAll($id)
    {
        Gamemaster::where('id', $id)->delete();
    }
}
