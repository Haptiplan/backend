<?php

namespace App\Http\Controllers\Gamemaster;

use App\Models\Company;
use App\Models\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Closure;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $game_id = session('selected_game_id');
        $game = Game::findOrFail($game_id);

        $companies = Company::where('game_id', $game_id)->get();
        return view('gamemaster.companies.index', ['companies' => $companies, 'game' => $game]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $game_id = session('selected_game_id');
        $game = Game::findOrFail($game_id);

        return view('gamemaster.companies.create', ['game' => $game]);
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

        if (Gate::denies('modify', $game)) {
            return redirect()->back()
                ->withErrors(['error' => __('validation.custom.game_not_modifiable')])
                ->withInput();
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
        $game_id = session('selected_game_id');
        $game = Game::findOrFail($game_id);
        $company = Company::where('game_id', $game_id)->where('id', $id)->firstOrFail();
        
        return view('gamemaster.companies.edit', ['company' => $company, 'game' => $game]);
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
                Rule::unique('companies', 'name')->ignore($company->id),
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
