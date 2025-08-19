<?php

namespace App\Services;

use App\Models\AccountEntry;
use App\Models\Decision;
use App\Models\MachineDecision;
use App\Models\Machine;
use Illuminate\Validation\Rules\Exists;

use function PHPUnit\Framework\isNull;

class DecisionService
{

     public function getKonto($kontonummer)
    {
        return collect(config('accounts'))->firstWhere('number', str_pad($kontonummer, 4, '0', STR_PAD_LEFT));
    }

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
                        AccountEntry::create([
                            'company_id' => $company->id,
                            'period' => $decision->period,
                            'debit' => $this->getKonto(2800)['number'],
                            'credit' => $this->getKonto(0720)['number'],
                            'amount' => $machine->original_price, 
                        ]);
                        AccountEntry::create([
                            'company_id' => $company->id,
                            'period' => $decision->period + 1,
                           'debit' => $this->getKonto(4400)['number'],
                            'credit' => $this->getKonto(kontonummer: 2800)['number'],
                            'amount' => $machine->original_price, 
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
                AccountEntry::create([
                    'company_id' => $decision->player->company->id,
                    'period' => $decision->period,
                    'debit' => 2800,
                    'credit' => 0720,
                    'amount' => 0 // TODO: Betrag berechnen
                ]);
                AccountEntry::create([
                    'company_id' => $decision->player->company->id,
                    'period' => $decision->period,
                    'debit' => 6960,
                    'credit' => 2800,
                    'amount' => $machine->original_price - 0, // TODO: Betrag berechnen
                ]);
            }
        }
    }
}
