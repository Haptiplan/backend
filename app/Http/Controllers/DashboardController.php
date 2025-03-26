<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function gamemasterDashboard(){
        return view('gamemaster.dashboard');
    }

    public function adminDashboard(){
        return view('admin.dashboard');
    }

    public function userDashboard(){
        return view('user.dashboard');
    }
}
