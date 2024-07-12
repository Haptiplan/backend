<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('create_company', ['companies' => $companies, 'games' => $games]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|unique:companies,company_name',
            'game_id' => 'required',
        ]);
    
        $company_name = $validated['company_name'];
        $company_fk = $validated['game_id'];
    
        DB::table('companies')->insert([
            'company_name' => $company_name,
            'game_id' => $company_fk,
        ]);
    
        $companies = Company::all();
        $games = Game::all();
    
        return view('create_company', ['companies' => $companies, 'games' => $games]);
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
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Company::where('id', $id)->firstOrFail()->delete();
    
        return redirect()->route('company_create');
    }
}
