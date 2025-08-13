<?php

namespace App\Services;

use App\Models\Decision;
use App\Models\MachineDecision;
use App\Models\Machine;
use Illuminate\Validation\Rules\Exists;

use function PHPUnit\Framework\isNull;

class DecisionService
{
    public function createDecision(array $validated)
    {
        $decision = Decision::create([
            'player_id' => $validated['player_id'],
            'period' => $validated['period'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Create Buy MachineDecisions
        if (isset($validated['buy'])) {
            $this->MachineBuy($decision, $validated);
        }
        // Create Sell MachineDecisions
        if (isset($validated['sell'])) {
            $this->MachineSell($decision, $validated);
        }
    }
    private function MachineBuy($decision, array $validated)
    {
        foreach ($validated['buy'] as $machineTypeId => $buyMachine) {
            $company = $decision->player->company;
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
                        'period' => $decision->period,
                    ]);
                }
            }
        }
    }
    private function MachineSell($decision, array $validated)
    {
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
