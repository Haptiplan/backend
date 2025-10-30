<?php

namespace App\Http\Controllers\Decision;

use App\Models\Decision\Machine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MachineController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'machinetype_id' => 'required|exists:machinetypes,id',
            'company_id' => 'required|exists:companies,id',
            'period' => 'required' //TODO: check, if it's correct period
        ]);

        Machine::create([
            'machinetype_id' => $validated['machinetype_id'],
            'company_id' => $validated['compnay_id'],
            'period' => $validated['period'],
        ]);
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Machine $machine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Machine $machine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Machine $machine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machine $machine)
    {
        //
    }
}
