<?php

use App\Http\Controllers\MachineController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [MachineController::class, 'TestMethode']); 

Route::get('/home', function() {
    return view('home', ['name' => "Hicham"]);
});

Route::get('/about', function(){
    return view('about', ['name' => "Hicham"]);
});

//Route::post('/machines/create', )

Route::get('/machines', [MachineController::class, 'index']);
Route::get('/machines/create', [MachineController::class, 'create']);
Route::post('/machines', [MachineController::class, 'store'])->name('machines.store');
