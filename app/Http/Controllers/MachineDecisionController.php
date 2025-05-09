<?php

namespace App\Http\Controllers;

use APp\Models\Decision;
use App\Models\Machine;
use App\Models\MachineDecision;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

use function PHPUnit\Framework\isEmpty;

class MachineDecisionController extends Controller
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
            'decision_id' => 'required|exists:decisions,id',
            'machinetype_id' => 'required|exists:machine_types,id',
            'buy' => 'integer|nullable',
            'sell' => 'array|nullable' // ids from the machines supposed to delete
        ]);

        if (!isset($validated['buy'])) {
            $validated['buy'] = 0;
        }
        
        if (empty($validated['sell'])) {
            $validated['sell'] = 0;
        }

        //dd($validated);

        $machinedecision = MachineDecision::create([
            'decision_id' => $validated['decision_id'],
            'machinetype_id' => $validated['machinetype_id'],
            'buy' => $validated['buy'],
            'sell' => $validated['sell']
        ]);

        if(!isEmpty($validated['buy'])) {
            for($i = 0; $i < $validated['buy']; $i++){
                $company = Decision::findOrFail($validated['decision_id'])->player->company->get();
                Machine::create([
                    'machinetype_id' => $validated['machinetype_id'],
                    'company_id' => $company->id,
                    'period' => Decision::findOrFail($validated['decision_id'])->period
                ]);
            }
        }
        if(!isEmpty($validated['sell'])) {
            foreach($validated['sell'] as $sell){
                Machine::destroy($sell);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MachineDecision $machineDecision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MachineDecision $machineDecision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MachineDecision $machineDecision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MachineDecision $machineDecision)
    {
        //
    }
}
