<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Game;
use App\Http\Controllers\Controller;
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
        $companies = Company::all();
        $games = Game::all();
        return view('companies.create', ['companies' => $companies, 'games' => $games]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company_name = $request->input('company_name');
        $game_id = $request->input('game_id');

        $company_exists = Company::where('name', $company_name)
            ->where('game_id', $game_id)
            ->exists();

        $validated = $request->validate([
            'company_name' => 'required',
            'game_id' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) use ($company_exists) 
                {
                    if ($company_exists) 
                    {
                        $fail("The name of the company is already taken in the selected game!");
                    }
                },
            ],
        ], [
            'company_name.required' => 'The field for the company name cannot be empty!',
            'game_id.required' => 'A game must be selected!',
        ]);
    
        $company_name = $validated['company_name'];
        $company_fk = $validated['game_id'];
    
        DB::table('companies')->insert([
            'name' => $company_name,
            'game_id' => $company_fk,
        ]);
    
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
        $company = Company::find($id);
        $games = Game::all();

        return view('companies.edit', ['company' => $company, 'games' => $games]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $company_name = $request->input('company_name');
        $game_id = $request->input('game_id');

        $game_id_exists = Company::where('name', $company_name)
            ->where('game_id', $game_id)
            ->exists();

        $validated = $request->validate([
            'company_name' => 'required',
            'game_id' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) use ($game_id_exists) 
                {
                    if ($game_id_exists) 
                    {
                        $fail("The name of the company is already taken in the selected game!");
                    }
                },
            ],
        ], [
            'company_name.required' => 'The field for the company name must be filled!',
            'game_id.required' => 'A game must be selected!',
        ]);

        $company = Company::find($id);
        $company->name = $validated['company_name'];
        $company->game_id = $validated['game_id'];
        $company->save();

        return redirect()->route('company.create')->with('success', 'Company updated successfully.');
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
