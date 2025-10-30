<?php

namespace App\Providers;

use App\Models\Decision\Decision;
use App\Models\Game\Company;
use App\Models\Game\Game;
use App\Models\Game\MachineType;
use App\Models\User\Gamemaster;
use App\Models\User\Player;
use App\Policies\Decision\DecisionPolicy;
use App\Policies\Game\CompanyPolicy;
use App\Policies\Game\GamePolicy;
use App\Policies\Game\MachineTypePolicy;
use App\Policies\User\GamemasterPolicy;
use App\Policies\User\PlayerPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Decision::class, DecisionPolicy::class);
        Gate::policy(Company::class, CompanyPolicy::class);
        Gate::policy(Game::class, GamePolicy::class);
        Gate::policy(MachineType::class, MachineTypePolicy::class);
        Gate::policy(Player::class, PlayerPolicy::class);
        Gate::policy(Gamemaster::class, GamemasterPolicy::class);
    }
}
