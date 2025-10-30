<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game\Game;
use App\Models\Game\MachineType;
use App\Rules\MachineTypeUsedInGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MachineTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::hasGamemasters()->get();
        $machine_types = MachineType::whereIn('game_id', $games->pluck('id'))->get();

        return view('gamemaster.machine_types.index', ['machine_types' => $machine_types, 'games' => $games]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $games = Game::hasGamemasters()->get();
        return view('gamemaster.machine_types.create', ['games' => $games]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->user()->cannot('store', [MachineType::class, Game::findOrFail($request['game_id'])])){
            abort(403);
        }

        $validated = $request->validate([
            'game_id' => [
                'required',
                'exists:games,id',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                new MachineTypeUsedInGame($request['name'], $request['game_id'])
            ],
            'price' => [
                'required',
                'integer'
            ],
            'fix_costs_per_period' => [
                'required',
                'integer'
            ],
            'capacity' => [
                'required',
                'integer'
            ],
            'number_of_operators' => [
                'required',
                'integer'
            ],
            'depreciation_period' => [
                'required',
                'integer'
            ]
        ]);

        MachineType::create([
            'game_id' => $validated['game_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'fix_costs_per_period' => $validated['fix_costs_per_period'],
            'capacity' => $validated['capacity'],
            'number_of_operators' => $validated['number_of_operators'],
            'depreciation_period' => $validated['depreciation_period']
        ]);

        return redirect()->back()->with('success', 'messages.successCreate');
    }

    /**
     * Display the specified resource.
     */
    public function show(MachineType $machineType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $games = Game::hasGamemasters()->get();
        $machine_type = MachineType::whereIn('game_id', $games->pluck('id')->toArray())->find($id);

        return view('gamemaster.machine_types.edit', ['machine_type' => $machine_type, 'games' => $games]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $machine_type = MachineType::findOrFail($id);

        if($request->user()->cannot('update', $machine_type)){
            abort(403);
        }

        $validated = $request->validate([
            'game_id' => [
                'exists:games,id',
                'nullable',
                'sometimes'
            ],
            'name' => [
                'string',
                'max:255',
                'nullable',
                'sometimes',
                new MachineTypeUsedInGame($request['name'], $request['game_id'])
            ],
            'price' => [
                'integer',
                'nullable',
                'sometimes'
            ],
            'fix_costs_per_period' => [
                'integer',
                'nullable',
                'sometimes'
            ],
            'capacity' => [
                'integer',
                'nullable',
                'sometimes'
            ],
            'number_of_operators' => [
                'integer',
                'nullable',
                'sometimes'
            ],
            'depreciation_period' => [
                'integer',
                'nullable',
                'sometimes'
            ]
        ]);

        $machine_type->update($validated);

        return redirect()->back()->with('success', 'message.successEdit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $machine_type = MachineType::findOrFail($id);

        if (Auth::user()->cannot('delete', $machine_type)) {
            abort(403);
        }

        $machine_type->delete();

        return redirect()->route('machine_types.index')->with('status', 'messages.successDelete');
    }
}
