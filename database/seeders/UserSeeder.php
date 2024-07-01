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
        $userObj->email = 'userHicham@gmail.com';
        $userObj->password = Hash::make('123456789');
        $userObj->type = 0;
        $userObj->save();

        $gamemaster = new User();
        $gamemaster->name = 'Gamemaster Hicham';
        $gamemaster->email = 'gamemasterHicham@gmail.com';
        $gamemaster->password = Hash::make('123456789');
        $gamemaster->type = 1;
        $gamemaster->save();

        $adminObj = new User();
        $adminObj->name = 'Admin Hicham';
        $adminObj->email = 'AdminHicham@gmail.com';
        $adminObj->password = Hash::make('123456789');
        $adminObj->type = 2;
        $adminObj->save();
    }
}
