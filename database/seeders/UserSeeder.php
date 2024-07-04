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
        $userObj = new User();
        $userObj->name = 'User Hicham';
        $userObj->email = 'u';
        $userObj->password = Hash::make('123');
        $userObj->role = 0;
        $userObj->save();

        $gamemaster = new User();
        $gamemaster->name = 'Gamemaster Hicham';
        $gamemaster->email = 'g';
        $gamemaster->password = Hash::make('123');
        $gamemaster->role = 1;
        $gamemaster->save();

        $adminObj = new User();
        $adminObj->name = 'Admin Hicham';
        $adminObj->email = 'a';
        $adminObj->password = Hash::make('123');
        $adminObj->role = 2;
        $adminObj->save();
    }
}
