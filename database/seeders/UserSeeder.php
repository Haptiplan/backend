<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $admin = User::ROLE_ADMIN;
        $gamemaster = User::ROLE_GAMEMASTER;
        $user = User::ROLE_USER;

        $userObj = new User();
        $userObj->name = 'User Hicham';
        $userObj->email = 'uh@gmail.com';
        $userObj->password = Hash::make('123');
        $userObj->role = $user;
        $userObj->save();

        $gamemasterObj = new User();
        $gamemasterObj->name = 'Gamemaster Hicham';
        $gamemasterObj->email = 'gh@gmail.com';
        $gamemasterObj->password = Hash::make('123');
        $gamemasterObj->role = $gamemaster;
        $gamemasterObj->save();

        $adminObj = new User();
        $adminObj->name = 'Admin Hicham';
        $adminObj->email = 'ah@gmail.com';
        $adminObj->password = Hash::make('123');
        $adminObj->role = $admin;
        $adminObj->save();
    }
}
