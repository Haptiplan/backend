<?php

namespace App\Services;

use App\Models\Decision;
use App\Models\MachineDecision;
use App\Models\Machine;
use App\Models\MachineType;
use Illuminate\Validation\Rules\Exists;

use function PHPUnit\Framework\isNull;

class DecisionService
{
    public function createDecisionWithMachineDecision(array $validated)
    {
        $decision = Decision::create([
            'player_id' => $validated['player_id'],
            'period' => $validated['period'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create Buy MachineDecisions
        if (isset($validated['buy'])) {
            foreach ($validated['buy'] as $machineTypeId => $buyMachine) {
                $company = $decision->player->company;

                // Later we must add parameters for machines here!
                $machineType = MachineType::findOrFail($buyMachine);
                $originalPrice = $machineType->price; // * $parameter_for_machines
                
                // Create MachineDecision for each Machine Type
                if ($buyMachine > 0) {
                    MachineDecision::create([
                        'decision_id' => $decision->id,
                        'machine_type_id' => $machineTypeId,
                        'buy' => $buyMachine,
                        'sell' => null
                    ]);
                    // Create Machine, loop the number of Machines a Player wanted to buy
                    for ($i = 0; $i < $buyMachine; $i++) {
                        Machine::create([
                            'machinetype_id' => $machineTypeId,
                            'company_id' => $company->id,
                            'original_price' => $originalPrice,
                            'period' => $decision->period,
                        ]);
                    }
                }
            }
        }

        // Create Sell MachineDecisions
        if (isset($validated['sell'])) {
            foreach ($validated['sell'] as $sellMachine) {
                // Create MachineDecision
                MachineDecision::create([
                    'decision_id' => $decision->id,
                    'machine_type_id' => null,
                    'buy' => null,
                    'sell' => $sellMachine      // $sellMachine is a Machine_ID
                ]);
                // Sell Machines
                $machine = Machine::find($sellMachine);
                if ($machine) {
                    $machine->status = '0';
                    $machine->save();
                }
            }
        }
    }
}
