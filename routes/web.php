<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GamemasterController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
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
Route::middleware(['localization', 'gamemaster_auth'])->prefix('gamemaster')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'gamemasterDashboard'])->name('gamemaster_dashboard_show');
});
// Show desicion of players in a game period:
Route::middleware(['localization', 'verified', 'impersonate', 'check_period'])
    ->get('/check_decision/{id}/{period}', [DecisionController::class, 'check'])->name('decisions.check');
// Update game to next period:
Route::post('/continue_game', [GameController::class, 'continue'])->name('game.continue');
// Change status of game (active or inactive):
Route::post('/change_status/{id}', [GameController::class, 'changeStatus'])->name('game.status');

// CRUD of various models the gamemaster has access to:
Route::middleware(['web', 'localization', 'verified', 'impersonate', 'check_role:' . $gamemaster])->group(function () {
    /** 
     * Games 
     * Doesn't use the model in url but the id, thus the parameters-function is used.
     */
    Route::resource('games', GameController::class)->parameters([
        'games' => 'id'
    ]);
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
});

/** Player routes */

// Dashboard:
Route::middleware(['localization', 'auth', 'verified', 'impersonate'])->get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
// CRUD of various models the players have access to.
Route::middleware(['localization', 'verified', 'impersonate', 'check_role:' . $user])->group(function(){
    /** 
     * Decisions 
     * Players shouldn't be able to edit or delete a decision.
     */
    Route::resource('decisions', DecisionController::class)->except([
        'edit', 'update', 'destroy'
    ]);
});


require __DIR__.'/auth.php';
