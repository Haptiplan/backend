<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Player;
use App\Models\User;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        $users = User::all();

        $playerObj = new Player();
        if(empty($companies)){
            (new CompanySeeder)->run();
            $companies = Company::all();
        }
        $company = $companies->pluck('id')->random();
        if(empty($users)){
            (new UserSeeder)->run();
            $users = User::all();
        }
        $user = $users->pluck('id')->random();
        $playerObj->id = $user;
        $playerObj->company_id = $company;
        $playerObj->save();
    }
}
