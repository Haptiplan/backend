<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function gamemasterDashboard()
    {
        return view('gamemaster.dashboard', [
            'game' => session('selected_game_id')
        ]);
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function userDashboard()
    {
        return view('user.dashboard');
    }
}
