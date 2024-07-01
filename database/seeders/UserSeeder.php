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

        $adminObj = new User();
        $adminObj->name = 'gamemaster Hicham';
        $adminObj->email = 'gamemasterHicham@gmail.com';
        $adminObj->password = Hash::make('123456789');
        $adminObj->type = 1;
        $adminObj->save();

        $superAdminObj = new User();
        $superAdminObj->name = 'Admin Hicham';
        $superAdminObj->email = 'AdminHicham@gmail.com';
        $superAdminObj->password = Hash::make('123456789');
        $superAdminObj->type = 2;
        $superAdminObj->save();
    }
}
