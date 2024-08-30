<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

$admin = User::ROLE_ADMIN;
$gamemaster = User::ROLE_GAMEMASTER;
$user = User::ROLE_USER;

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**Impersonating routes **/
Route::get('/users/impersonate', [UserController::class, 'impersonate'])
->name('impersonate.view')
->middleware('check_role:' . $admin . ',' . $gamemaster);

Route::post('/users/impersonate/start', [UserController::class, 'startImpersonate'])
->name('impersonate.start')
->middleware('check_role:' . $admin . ',' . $gamemaster);

Route::get('/users/stop', [UserController::class, 'stopImpersonate'])
->name('impersonate.stop');

/**General user routes **/
Route::middleware(['auth', 'verified', 'impersonate'])->get('/dashboard', [DashboardController::class, 'generalUserDashboard'])->name('dashboard');

/**Admin routes **/
Route::middleware('admin_auth')->prefix('admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('adminDashboardShow');
});

Route::middleware('check_role:' . $admin)->group(function(){
    Route::get('/create_user', [UserController::class, 'create'])->name('user.create');
    Route::post('/create_user', [UserController::class, 'store'])->name('user.store');
    Route::get('create_user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('create_user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/create_user/{id}', [UserController::class, 'destroy'])->name('user.delete');
});

/**Gamemaster routes **/
Route::middleware('gamemaster_auth')->prefix('gamemaster')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'gamemasterDashboard'])->name('gamemasterDashboardShow');
});

Route::middleware(['impersonate', 'check_role:' . $gamemaster])->group(function(){
    /** Machines **/
    Route::get('/create_machine', [MachineController::class, 'index'])->name('machine.index');
    Route::post('/create_machine', [MachineController::class, 'store'])->name('machine.store');
    Route::get('create_machine/{id}/edit', [MachineController::class, 'edit'])->name('machine.edit');
    Route::put('create_machine/{id}', [MachineController::class, 'update'])->name('machine.update');
    Route::delete('/create_machine/{id}', [MachineController::class, 'destroy'])->name('machine.delete');
    /** Games **/
    Route::get('/create_game', [GameController::class, 'index'])->name('game.index');
    Route::post('/create_game', [GameController::class, 'store'])->name('game.store');
    Route::get('create_game/{id}/edit', [GameController::class, 'edit'])->name('game.edit');
    Route::put('create_game/{id}', [GameController::class, 'update'])->name('game.update');
    Route::delete('/create_game/{id}', [GameController::class, 'destroy'])->name('game.delete');
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

Route::middleware(['impersonate', 'check_role:' . $user])->group(function(){
    Route::get('/machines', [MachineController::class, 'index'])->name('machine.list');
});



require __DIR__.'/auth.php';
