<?php
namespace App\Services;

use App\Models\Decision;
use App\Models\MachineDecision;
use App\Models\Machine;

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

        $machineTypeId = $validated['machinetype_id'];
        $buy = $validated['buy'][$machineTypeId] ?? 0;

        $machinedecision = MachineDecision::create([
            'decision_id' => $decision->id,
            'machine_type_id' => $validated['machinetype_id'],
            'buy' => $buy,
            'sell' => $validated['sell'] ?? 0,
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
            foreach ($machinedecision->sell as $machineId) {
                Machine::destroy($machineId);
            }
        }
    }
}
