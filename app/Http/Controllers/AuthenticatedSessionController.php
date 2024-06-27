<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticatedSessionController extends Controller
{
    public function customLogin(Request $request){
        
        $input = $request->all();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // check if the given user exists in db
        if(Auth::attempt(['email'=> $input['email'], 'password'=> $input['password']])){
            // check the user role
            if(Auth::user()->type == 0){
                return redirect()->route('dashboard');
            }
            elseif (Auth::user()->type == 1) {
                return redirect()->route('adminDashboardShow');
            }
            elseif (Auth::user()->type == 2) {
                return redirect()->route('superAdminDashboardShow');
            }
        }
        else{
            return redirect()->route('login')->with('error', "Wrong credentials");
        }
        
    }
}
