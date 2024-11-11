<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Game;
use App\Http\Controllers\Controller;
use App\Rules\CompanyUsedInGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Closure;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $games = Game::hasGamemasters()->get();
        $companies = Company::whereIn('game_id', Game::hasGamemasters()->pluck('id')->toArray())->get();
        return view('companies.create', ['companies' => $companies, 'games' => $games]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request using the custom rule for `game_id`
        $validated = $request->validate([
            'company_name' => 'required',
            'game_id' => [
                'required',
                new CompanyUsedInGame($request->input('company_name'), $request->input('game_id')),
            ],
        ]);

        // Insert the new company into the database using Eloquent
        Company::create([
            'name' => $validated['company_name'],
            'game_id' => $validated['game_id'],
        ]);

        // Redirect after insertion
        return redirect()->route('company.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $games = Game::hasGamemasters()->get();
        $game_ids = $games->pluck('id')->toArray();
        $company = Company::whereIn('game_id', $game_ids)->where('id', $id)->first();

        return view('companies.edit', ['company' => $company, 'games' => $games]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company_name' => 'required',
            'game_id' => [
                'required',
                new CompanyUsedInGame($request->input('company_name'), $request->input('game_id'), $id),
            ],
        ]);

        $company = Company::find($id);

        // Update the company using mass assignment
        $company->update([
            'name' => $validated['company_name'],
            'game_id' => $validated['game_id'],
        ]);

        return redirect()->route('company.create');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Company::where('id', $id)->firstOrFail()->delete();

        return redirect()->route('company.create');
    }
}
