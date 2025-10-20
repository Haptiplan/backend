<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectToRoleDashboard
{
    /**
     * Handle an incoming request.
     * Use only for routes to a dashboard!
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Prüfe, ob die aktuelle Route zum User passt
        if ($user->role->id == User::ROLE_ADMIN) {
            return redirect()->route('admin_dashboard_show');
        }
        if ($user->role->id == User::ROLE_GAMEMASTER) {
            return redirect()->route('gamemaster_dashboard_show');
        }
        if ($user->role->id == User::ROLE_USER) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
