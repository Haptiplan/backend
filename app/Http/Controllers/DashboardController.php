<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function gamemasterDashboard(){
        return view('gamemasterDashboard');
    }

    public function adminDashboard(){
        return view('adminDashboard');
    }

    public function generalUserDashboard(){
        return view('generalUserDashboard');
    }
}
