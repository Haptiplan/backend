<?php

namespace App\Services;

use App\Models\Decision;
use App\Models\MachineDecision;
use App\Models\Machine;
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

        if (isset($validated['machinetype_id'])) {
            $machineTypeId = $validated['machinetype_id'];
            $buy = $validated['buy'][$machineTypeId];
        } else {
            $buy = 0;
        }

        if (isset($validated['sell'])) {
            $sell = count($validated['sell']);
        } else {
            $sell = 0;
        }

        $machinedecision = MachineDecision::create([
            'decision_id' => $decision->id,
            'machine_type_id' => $validated['machinetype_id'] ?? null,
            'buy' => $buy,
            'sell' => $sell,
        ]);

        if ($machinedecision->buy != 0) {
            for ($i = 0; $i < $machinedecision->buy; $i++) {
                $company = $decision->player->company;
                Machine::create([
                    'machinetype_id' => $machinedecision->machine_type_id,
                    'company_id' => $company->id,
                    'period' => $decision->period,
                ]);
            }
        }

        if ($machinedecision->sell != 0) {
            foreach ($validated['sell'] as $machineId) {
                $machine = Machine::find($machineId);
                if ($machine) {
                    $machine->status = '0';
                    $machine->save();
                }
            }
        }
    }
}
