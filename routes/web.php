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

/**General user routes **/
Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'generalUserDashboard'])->name('dashboard');

/**Admin routes **/
Route::middleware('admin_auth')->prefix('admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('adminDashboardShow');
});

Route::get('/create_user', [UserController::class, 'create'])
->name('user.create')
->middleware('check_role:' . $admin);

Route::post('/create_user', [UserController::class, 'store'])
->name('user.store')
->middleware('check_role:' . $admin);

Route::get('create_user/{id}/edit', [UserController::class, 'edit'])
->name('user.edit')
->middleware('check_role:' . $admin);

Route::put('create_user/{id}', [UserController::class, 'update'])
->name('user.update')
->middleware('check_role:' . $admin);

Route::delete('/create_user/{id}', [UserController::class, 'destroy'])
->name('user.delete')
->middleware('check_role:' . $admin);

/**Gamemaster routes **/
Route::middleware('gamemaster_auth')->prefix('gamemaster')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'gamemasterDashboard'])->name('gamemasterDashboardShow');
});

//Machines
Route::get('/create_machine', [MachineController::class, 'index'])
->name('machine.index')
->middleware('check_role:' . $gamemaster);

Route::post('/create_machine', [MachineController::class, 'store'])
->name('machine.store')
->middleware('check_role:' . $gamemaster);

Route::get('/machines', [MachineController::class, 'index'])
->name('machine.list')
->middleware('check_role:' . $user);

Route::get('create_machine/{id}/edit', [MachineController::class, 'edit'])
->name('machine.edit')
->middleware('check_role:' . $gamemaster);

Route::put('create_machine/{id}', [MachineController::class, 'update'])
->name('machine.update')
->middleware('check_role:' . $gamemaster);

Route::delete('/create_machine/{id}', [MachineController::class, 'destroy'])
->name('machine.delete')
->middleware('check_role:' . $gamemaster);

/**Games **/
Route::get('/create_game', [GameController::class, 'index'])
->name('game.index')
->middleware('check_role:' . $gamemaster);

Route::post('/create_game', [GameController::class, 'store'])
->name('game.store')
->middleware('check_role:' . $gamemaster);

Route::get('create_game/{id}/edit', [GameController::class, 'edit'])
->name('game.edit')
->middleware('check_role:' . $gamemaster);

Route::put('create_game/{id}', [GameController::class, 'update'])
->name('game.update')
->middleware('check_role:' . $gamemaster);

Route::delete('/create_game/{id}', [GameController::class, 'destroy'])
->name('game.delete')
->middleware('check_role:' . $gamemaster);

/**Companies */
Route::get('/create_company', [CompanyController::class, 'create'])
->name('company.create')
->middleware('check_role:' . $gamemaster);

Route::post('/create_company', [CompanyController::class, 'store'])
->name('company.store')
->middleware('check_role:' . $gamemaster);

Route::get('create_company/{id}/edit', [CompanyController::class, 'edit'])
->name('company.edit')
->middleware('check_role:' . $gamemaster);

Route::put('create_company/{id}', [CompanyController::class, 'update'])
->name('company.update')
->middleware('check_role:' . $gamemaster);

Route::delete('/create_company/{id}', [CompanyController::class, 'destroy'])
->name('company.delete')
->middleware('check_role:' . $gamemaster);

/**User */
Route::get('/create_player', [PlayerController::class, 'create'])
->name('player.create')
->middleware('check_role:' . $gamemaster);

Route::post('/create_player', [PlayerController::class, 'store'])
->name('player.store')
->middleware('check_role:' . $gamemaster);

Route::get('create_player/{id}/edit', [PlayerController::class, 'edit'])
->name('player.edit')
->middleware('check_role:' . $gamemaster);

Route::put('create_player/{id}', [PlayerController::class, 'update'])
->name('player.update')
->middleware('check_role:' . $gamemaster);

Route::delete('/create_player/{id}', [PlayerController::class, 'destroy'])
->name('player.delete')
->middleware('check_role:' . $gamemaster);


require __DIR__.'/auth.php';
