<?php
namespace App\Services;

use App\Models\Decision;
use App\Models\MachineDecision;
use App\Models\Machine;

class DecisionService
{
    public function createDecisionWithMachineDecision(array $data)
    {
        // Erst Decision erstellen
        $decision = Decision::create([
            'player_id' => $data['player_id'],
            'period' => $data['period'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // MachineDecision erstellen
        $machinedecision = MachineDecision::create([
            'decision_id' => $decision->id,
            'machine_type_id' => $data['machinetype_id'],
            'buy' => $data['buy'] ?? 0,
            'sell' => $data['sell'] ?? 0,
        ]);

        // Maschinen kaufen/sell Logik
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

        return $decision;
    }
}
