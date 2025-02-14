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

Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{locale}', [LanguageController::class, 'changeLanguage'])->name('lang');

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

Route::middleware(['web', 'localization', 'auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**Impersonating routes **/
Route::middleware(['localization', 'check_role:' . $admin . ',' . $gamemaster])->group(function(){
    Route::get('/users/impersonate', [UserController::class, 'impersonate'])->name('impersonate.view');
    Route::post('/users/impersonate/start', [UserController::class, 'startImpersonate'])->name('impersonate.start');
    Route::get('/users/stop', [UserController::class, 'stopImpersonate'])->name('impersonate.stop');
});


/**General user routes **/
Route::middleware(['localization', 'auth', 'verified', 'impersonate'])->get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');

/**Admin routes **/
Route::middleware(['localization', 'admin_auth'])->prefix('admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin_dashboard_show');
});

Route::middleware(['web', 'localization', 'verified','check_role:' . $admin])->group(function(){
    Route::resource('users', UserController::class)->parameters(['users' => 'id']);
});

/**Gamemaster routes **/
Route::middleware(['localization', 'gamemaster_auth'])->prefix('gamemaster')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'gamemasterDashboard'])->name('gamemaster_dashboard_show');
});

Route::middleware(['localization', 'verified', 'impersonate', 'check_period'])
        ->get('/check_decision/{id}/{period}', [DecisionController::class, 'check'])->name('decision.check');
        
Route::post('/continue_game', [GameController::class, 'continue'])->name('game.continue');
Route::post('/change_status/{id}', [GameController::class, 'changeStatus'])->name('game.status');

Route::middleware(['web', 'localization', 'verified', 'impersonate', 'check_role:' . $gamemaster])->group(function(){
    /** Games **/
    Route::resource('games', GameController::class)->parameters([
        'games' => 'id'
    ]);
    /** Gamemaster **/
    Route::resource('gamemasters', GamemasterController::class)->only([
        'store', 'destroy'
    ]);
    Route::delete('/gamemaster/{id}/{game_id}', [GamemasterController::class, 'destroyOne'])->name('gamemasters.deleteOne');
    /**Companies */
    Route::resource('companies', CompanyController::class)->parameters([
        'companies' => 'id'
    ]);
    /** User **/
    Route::resource('players', PlayerController::class)->parameters([
        'players' => 'id'
    ]);

});

//todo ::resource
Route::middleware(['localization', 'verified', 'impersonate', 'check_role:' . $user])->group(function () {
    //** Decisions **/
    Route::get('/decision', [DecisionController::class, 'index'])->name('decision.index');
    Route::get('/create_decision', [DecisionController::class, 'create'])->name('decision.create');
    Route::post('/create_decision', [DecisionController::class, 'store'])->name('decision.store');
    Route::get('/decision/{id}', [DecisionController::class, 'show'])->name('decision.show');
});

Route::middleware(['localization', 'verified', 'impersonate', 'check_role:' . $user])->group(function(){});


require __DIR__.'/auth.php';
