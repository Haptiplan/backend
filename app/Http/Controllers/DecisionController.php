<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DecisionController extends Controller
{
    public function index()
    {
        return view('gm_decisions');
    }

    public function destroy()
    {
        
    }
}
