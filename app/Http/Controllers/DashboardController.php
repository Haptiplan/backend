<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function gamemasterDashboard(){
        return view('gamemaster_dashboard');
    }

    public function adminDashboard(){
        return view('admin_dashboard');
    }

    public function userDashboard(){
        return view('dashboard');
    }
}
