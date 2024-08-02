<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Game;

use function PHPUnit\Framework\isEmpty;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = Game::all();

        $companyObj = new Company();
        $companyObj->name = 'Erste Company';
        if(empty($games)){
            (new GameSeeder)->run();
            $games = Game::all();
        }
        $game = $games->pluck('id')->random();
        $companyObj->game_id = $game;
        $companyObj->save();
    }
}
