<?php

use Illuminate\Http\Request;
use App\Models\Game\Company;
use App\Models\Game\Game;
use Illuminate\Support\Facades\Route;

Route::post('/test-create-company', function(Request $request) {
    $validated = $request->validate([
        'company_name' => 'required|string|max:255',
        'game_id' => 'required|exists:games,id',
    ]);

    $company = Company::create([
        'name' => $validated['company_name'],
        'game_id' => $validated['game_id'],
    ]);

    return response()->json([
        'message' => 'Company created successfully',
        'company' => $company
    ]);
});
