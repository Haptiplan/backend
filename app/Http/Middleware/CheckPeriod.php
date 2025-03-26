<?php

namespace App\Http\Middleware;

use App\Models\Game;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPeriod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $game = Game::find($request->route('id'));
        if (!$game) {
            return redirect()->route('gamemaster_dashboard_show')->withErrors(['error' => __('validation.custom.no_game')]);
        }

        $period = $game->current_period_number;
        if ($period < $request->route('period')) {
            return redirect()->route('gamemaster_dashboard_show')->withErrors(['error' => __('validation.custom.unvalid_period')]);
        }

        return $next($request);
    }
}
