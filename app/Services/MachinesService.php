<?php

namespace App\Services;

use App\Models\Company;

class MachinesService
{
    public function calcMachinesValues(Company $company)
    {
        $value = 0;
        $machines = $company->machines()->where('status', '!=', 0)->get();
        foreach ($machines as $machine) {
            $price = $machine->original_price;
            $depreciation = $price / $machine->machinetype->depreciation_period;
            $period = $company->game->current_period_number - $machine->period;

            $value += $price - $depreciation * $period;
        }

        return $value;
    }

    public function calcFixCost(Company $company)
    {
        $value = 0;
        $machines = $company->machines()->where('status', '!=', 0)->get();
        foreach($machines as $machine) {
            $value += $machine->machinetype->fix_costs_per_period;
        }
        return $value;
    }
}
