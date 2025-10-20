<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GamemasterController;
use App\Http\Controllers\Gamemaster\AccountController as GMAccountController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MachineTypeController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Gamemaster\DecisionController as GmDecisionController;
use App\Http\Controllers\Player\DecisionController as PlayerDecisionController;
use App\Models\User;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

$admin = User::ROLE_ADMIN;
$gamemaster = User::ROLE_GAMEMASTER;
$user = User::ROLE_USER;

/** Standard route */

Route::get('/', function () {
    return view('welcome');
});

/** 
 * Localization route 
 * To change languages.
 */
Route::get('lang/{locale}', [LanguageController::class, 'changeLanguage'])->name('lang');

/** 
 * Basic routes 
 * Configure the account the user owns.
 */
Route::middleware(['web', 'localization', 'auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/** 
 * Impersonating routes 
 * Imitate a user.
 */
Route::middleware(['localization', 'check_role:' . $admin . ',' . $gamemaster])->group(function () {
    Route::get('/users/impersonate', [UserController::class, 'impersonate'])->name('impersonate.view');
    Route::post('/users/impersonate/start', [UserController::class, 'startImpersonate'])->name('impersonate.start');
    Route::get('/users/stop', [UserController::class, 'stopImpersonate'])->name('impersonate.stop');
});


/** Admin routes */

// Dashboard:
Route::middleware(['localization', 'admin_auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin_dashboard_show');
});
// CRUD to manage all users (including admins, gamemasters and players, exept yourself):
Route::middleware(['web', 'localization', 'verified', 'check_role:' . $admin])
    ->group(function () {
        Route::resource('users', UserController::class)->parameters(['users' => 'id']);
    });

/** Gamemaster routes */

// Dashboard:
Route::middleware(['ensure_game_selected', 'localization', 'gamemaster_auth'])->prefix('gamemaster')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'gamemasterDashboard'])->name('gamemaster_dashboard_show');
});
Route::middleware(['localization', 'impersonate', 'gamemaster_auth'])
    ->group(function () {
        Route::get('/games/select', [GameController::class, 'select'])->name('games.select');
        Route::post('/games/select/{game}', [GameController::class, 'setSelected'])->name('games.set_selected');
    });

// Show desicion of players in a game period:
Route::middleware(['localization', 'verified', 'impersonate', 'check_period'])
    ->get('/check_decision/{id}/{period}', [GmDecisionController::class, 'show'])->name('decisions.check');
// Update game to next period:
Route::post('/continue_game', [GameController::class, 'continue'])->name('game.continue');
Route::patch('/games/{game}/status', [GameController::class, 'updateStatus'])->name('games.updateStatus');

//


// CRUD of various models the gamemaster has access to:
Route::middleware(['ensure_game_selected', 'web', 'localization', 'verified', 'impersonate', 'check_role:' . $gamemaster])->group(function () {
    // Game routes without the prefix
    Route::resource('games', GameController::class);
    Route::prefix(prefix: 'games/{games}')->name('games.')->group(function () {

        /** 
         * Gamemaster 
         * Only need to be able to add a gamemaster to a game or delete them.
         * Deleting either all gamemaster entries for a user (destroy) or one entry in a specific game (destroyOne).
         */
        Route::resource('gamemasters', GamemasterController::class)->only([
            'store',
            'destroy'
        ]);
        Route::delete('/gamemaster/{id}/{game_id}', [GamemasterController::class, 'destroyOne'])->name('gamemasters.deleteOne');
        /** 
         * Companies 
         */
        Route::resource('companies', CompanyController::class)->parameters([
            'companies' => 'id'
        ]);
        /** 
         * User 
         */
        Route::resource('players', PlayerController::class)->parameters([
            'players' => 'id'
        ]);
        /**
         * End results (accounting)
         */
        Route::resource('accounts', GMAccountController::class)->only([
            'index',
            'show'
        ]);
    });
    //Machine Type without the prefix
    Route::resource('machine_types', MachineTypeController::class)->parameters([
        'machine_types' => 'id'
    ]);
});

/** Player routes */

// Dashboard:
Route::middleware(['localization', 'auth', 'verified', 'impersonate', 'role_dashboard'])->get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
// CRUD of various models the players have access to.
Route::middleware(['localization', 'verified', 'impersonate', 'check_role:' . $user])->group(function () {
    /** 
     * Decisions 
     * Players shouldn't be able to edit or delete a decision.
     */
    Route::resource('decisions', PlayerDecisionController::class)->except([
        'edit',
        'update',
        'destroy'
    ]);
    /** 
     * Accounts
     * Players can see the end result of the past periods.
     */
    Route::resource('accounts', AccountController::class)->only([
        'index',
        'show'
    ]);
});


require __DIR__ . '/auth.php';
