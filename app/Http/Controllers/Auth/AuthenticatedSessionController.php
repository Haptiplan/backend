<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function customLogin(Request $request){
        
        $input = $request->all();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = User::ROLE_ADMIN;
        $gamemaster = User::ROLE_GAMEMASTER;
        $user = User::ROLE_USER;
        
        // check if the given user exists in db
        if(Auth::attempt(['email'=> $input['email'], 'password'=> $input['password']])){
            // check the user role
            if (Auth::user()->role == User::ROLE_USER) {
                return redirect()->route('dashboard');
            } elseif (Auth::user()->role == User::ROLE_GAMEMASTER) {
                return redirect()->route('gamemasterDashboardShow');
            } elseif (Auth::user()->role == User::ROLE_ADMIN) {
                return redirect()->route('adminDashboardShow');
            }
        }
        else{
            return redirect()->route('login')->with('error', __("Falsche Anmeldeinformationen"));
        }
        
    }
}
