<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureGameIsSelected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->role_id === \App\Models\User::ROLE_GAMEMASTER) {
            if (!session()->has('selected_game_id') &&
                !$request->routeIs('games.select') &&
                !$request->routeIs('games.set_selected')
            ) {
                return redirect()->route('games.select');
            }
        }
        return $next($request);
    }
}
