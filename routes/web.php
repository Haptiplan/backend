<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GamemasterController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

$admin = User::ROLE_ADMIN;
$gamemaster = User::ROLE_GAMEMASTER;
$user = User::ROLE_USER;

Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de'])) {
        App::setLocale($locale);
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang');

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
    Route::get('/create_user', [UserController::class, 'create'])->name('user.create');
    Route::post('/create_user', [UserController::class, 'store'])->name('user.store');
    Route::get('create_user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('create_user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/create_user/{id}', [UserController::class, 'destroy'])->name('user.delete');
});

/**Gamemaster routes **/
Route::middleware(['localization', 'gamemaster_auth'])->prefix('gamemaster')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'gamemasterDashboard'])->name('gamemaster_dashboard_show');
});

Route::middleware(['web', 'localization', 'verified', 'impersonate', 'check_role:' . $gamemaster])->group(function(){
    /** Games **/
    Route::get('/create_game', [GameController::class, 'index'])->name('game.index');
    Route::post('/create_game', [GameController::class, 'store'])->name('game.store');
    Route::get('create_game/{id}/edit', [GameController::class, 'edit'])->name('game.edit');
    Route::put('create_game/{id}', [GameController::class, 'update'])->name('game.update');
    Route::delete('/create_game/{id}', [GameController::class, 'destroy'])->name('game.delete');
    /** Gamemaster **/
    Route::post('/create_gamemaster', [GamemasterController::class, 'store'])->name('gamemaster.store');
    Route::delete('/create_gamemaster/{id}/{game_id}', [GamemasterController::class, 'destroy'])->name('gamemaster.delete');
    Route::delete('/create_gamemaster/{id}', [GamemasterController::class, 'destroyAll'])->name('gamemaster.deleteAll');
    /**Companies */
    Route::get('/create_company', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/create_company', [CompanyController::class, 'store'])->name('company.store');
    Route::get('create_company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::put('create_company/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::delete('/create_company/{id}', [CompanyController::class, 'destroy'])->name('company.delete');
    /** User **/
    Route::get('/create_player', [PlayerController::class, 'create'])->name('player.create');
    Route::post('/create_player', [PlayerController::class, 'store'])->name('player.store');
    Route::get('create_player/{id}/edit', [PlayerController::class, 'edit'])->name('player.edit');
    Route::put('create_player/{id}', [PlayerController::class, 'update'])->name('player.update');
    Route::delete('/create_player/{id}', [PlayerController::class, 'destroy'])->name('player.delete');

});

Route::middleware(['localization', 'verified', 'impersonate', 'check_role:' . $user])->group(function(){});



require __DIR__.'/auth.php';
