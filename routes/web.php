<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
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

/**Games **/
Route::get('/create_game', [GameController::class, 'index'])
->name('game_index')
->middleware('check_role: 1');

Route::post('/create_game', [GameController::class, 'store'])
->name('game_store')
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

require __DIR__.'/auth.php';
