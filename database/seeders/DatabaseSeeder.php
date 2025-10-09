<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RoleSeeder::class,UserSeeder::class, GameSeeder::class, CompanySeeder::class, GamemasterSeeder::class, PlayerSeeder::class, MachineTypeSeeder::class, AccountSeeder::class]);
        // User::factory(10)->create();
    }
}
