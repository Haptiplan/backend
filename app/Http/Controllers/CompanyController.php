<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Closure;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::hasGamemasters()->get();
        $companies = Company::whereIn('game_id', $games->pluck('id'))->get();

        return view('gamemaster.companies.index', ['companies' => $companies, 'games' => $games]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $games = Game::hasGamemasters()->get();
        return view('gamemaster.companies.create', ['games' => $games]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'company_name' => [
                'required',
                'string',
                'max:255',  
                Rule::unique('companies', 'name'),
            ],
            'game_id' => [
                'required',
                'exists:games,id',
            ],
        ]);

        $game = Game::findOrFail($validated['game_id']);
        if ($request->user()->cannot('store', [Company::class, $game])) {
            abort(403);
        }

        Company::create([
            'name' => $validated['company_name'],
            'game_id' => $validated['game_id'],
        ]);

        return redirect()->back()->with('status', 'messages.successCreate');
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
        $company = Company::whereIn('game_id', $game_ids)->find($id);

        return view('gamemaster.companies.edit', ['company' => $company, 'games' => $games]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validated = $request->validate([
            'company_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies','name')->ignore($company->id),
            ],
            'game_id' => [
                'required',
                'exists:games,id',
            ],
        ]);


        if ($request->user()->cannot('update', $company)) {
            abort(403);
        }

        $company->update([
            'name' => $validated['company_name'],
            'game_id' => $validated['game_id'],
        ]);

        return redirect()->back()->with('status', 'messages.successEdit');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        if (Auth::user()->cannot('delete', $company)) {
            abort(403);
        }

        $company->delete();

        return redirect()->route('companies.index')->with('status', 'messages.successDelete');
    }
}
