<?php

namespace App\Services;

use App\Models\Decision\Account;
use App\Models\Decision\AccountEntry;
use App\Models\Decision\Decision;
use App\Models\Decision\MachineDecision;
use App\Models\Decision\Machine;
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
                    $machine = machine::create([
                        'machinetype_id' => $machineTypeId,
                        'company_id' => $company->id,
                        'period' => $decision->period,
                    ]);
                    $machineType = $machine->machinetype;
                    AccountEntry::create([
                        'company_id' => $company->id,
                        'period' => $decision->period,
                        'debit' => Account::find(720)->id,
                        'credit' => Account::find(4400)->id,
                        'amount' => $machineType->price,
                    ]);
                    AccountEntry::create([
                        'company_id' => $company->id,
                        'period' => $decision->period + 1,
                        'debit' => Account::find(4400)->id,
                        'credit' => Account::find(2800)->id,
                        'amount' => $machineType->price,
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
            AccountEntry::create([
                'company_id' => $decision->player->company->id,
                'period' => $decision->period,
                'debit' => Account::find(2800)->id,
                'credit' => Account::find(720)->id,
                'amount' => 0 // TODO: Betrag berechnen mit Parametern
            ]);
            AccountEntry::create([
                'company_id' => $decision->player->company->id,
                'period' => $decision->period,
                'debit' => Account::find(6960)->id,
                'credit' => Account::find(2800)->id,
                'amount' =>  0, // TODO: Betrag berechnen mit Parametern
            ]);
        }
    }
}
