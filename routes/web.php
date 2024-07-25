<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::middleware('adminAuth')->prefix('admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('adminDashboardShow');
});

/**Gamemaster routes **/
Route::middleware('gamemasterAuth')->prefix('gamemaster')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'gamemasterDashboard'])->name('gamemasterDashboardShow');
});

//Machines
Route::get('/create_machine', [MachineController::class, 'index'])
->name('machine_index')
->middleware('check_role: 1');

Route::post('/create_machine', [MachineController::class, 'store'])
->name('machine_store')
->middleware('check_role: 1');

Route::get('/machines', [MachineController::class, 'index'])
->name('machine_list')
->middleware('check_role: 0');

Route::get('create_machine/{id}/edit', [MachineController::class, 'edit'])
->name('machine_edit')
->middleware('check_role: 1');

Route::put('create_machine/{id}', [MachineController::class, 'update'])
->name('machine_update')
->middleware('check_role: 1');

Route::delete('/create_machine/{id}', [MachineController::class, 'destroy'])
->name('machine_delete')
->middleware('check_role:1');

/**Games **/
Route::get('/create_game', [GameController::class, 'index'])
->name('game_index')
->middleware('check_role: 1');

Route::post('/create_game', [GameController::class, 'store'])
->name('game_store')
->middleware('check_role: 1');

Route::get('create_game/{id}/edit', [GameController::class, 'edit'])
->name('game_edit')
->middleware('check_role: 1');

Route::put('create_game/{id}', [GameController::class, 'update'])
->name('game_update')
->middleware('check_role: 1');

Route::delete('/create_game/{id}', [GameController::class, 'destroy'])
->name('game_delete')
->middleware('check_role: 1'); //1 is gamemaster

/**Companies */
Route::get('/create_company', [CompanyController::class, 'create'])
->name('company_create')
->middleware('check_role: 1');

Route::post('/create_company', [CompanyController::class, 'store'])
->name('company_store')
->middleware('check_role: 1');

Route::get('create_company/{id}/edit', [CompanyController::class, 'edit'])
->name('company_edit')
->middleware('check_role: 1');

Route::put('create_company/{id}', [CompanyController::class, 'update'])
->name('company_update')
->middleware('check_role: 1');

Route::delete('/create_company/{id}', [CompanyController::class, 'destroy'])
->name('company_delete')
->middleware('check_role:1');

/**User */
Route::get('/create_player', [PlayerController::class, 'create'])
->name('player_create')
->middleware('check_role: 1');

Route::post('/create_player', [PlayerController::class, 'store'])
->name('player_store')
->middleware('check_role: 1');

Route::get('create_player/{id}/edit', [PlayerController::class, 'edit'])
->name('player_edit')
->middleware('check_role: 1');

Route::put('create_player/{id}', [PlayerController::class, 'update'])
->name('player_update')
->middleware('check_role: 1');

Route::delete('/create_player/{id}', [PlayerController::class, 'destroy'])
->name('player_delete')
->middleware('check_role:1');


require __DIR__.'/auth.php';
