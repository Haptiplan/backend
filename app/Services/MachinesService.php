<?php

namespace App\Services;

use App\Models\Company;

class MachinesService
{
    public function calcMachinesValues(Company $company)
    {
        Company::findOrFail($company);

        $value = 0;
        $machines = $company->machines;
        foreach($machines as $machine) {
            $price = $machine->machinetype->price;
            $depreciation = $price / $machine->machinetype->depreciation_period;
            $period = $machine->period - $company->game->current_period_number;

            $value =+ $price - $depreciation * $period; 
        }

        return $value;
    }
}