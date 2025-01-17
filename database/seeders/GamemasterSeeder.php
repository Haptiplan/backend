<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Gamemaster;
use App\Models\User;

class GamemasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = Game::all();
        $users = User::all();

        $gamemasterObj = new Gamemaster();
        if(empty($games)){
            (new GameSeeder)->run();
            $games = Game::all();
        }
        $game = $games->pluck('id')->random();
        if(empty($users)){
            (new UserSeeder)->run();
            $users = User::all();
        }
        $user = $users->where('role_id', User::ROLE_GAMEMASTER)->pluck('id')->random();
        $gamemasterObj->user_id = $user;
        $gamemasterObj->game_id = $game;
        $gamemasterObj->save();
    }
}
