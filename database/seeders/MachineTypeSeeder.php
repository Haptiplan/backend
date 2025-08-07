<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MachineType;


class MachineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $machineTypeA = new MachineType();
        $machineTypeA->game_id = 1;
        $machineTypeA->name = 'MaschineA';
        $machineTypeA->price = 10000000;
        $machineTypeA->fix_costs_per_period = 1000000;
        $machineTypeA->capacity = 1500;
        $machineTypeA->number_of_operators = 10;
        $machineTypeA->depreciation_period = 8;
        $machineTypeA->save();

        $machineTypeB = new MachineType();
        $machineTypeB->game_id = 1;
        $machineTypeB->name = 'MaschineB';
        $machineTypeB->price = 15000000;
        $machineTypeB->fix_costs_per_period = 1200000;
        $machineTypeB->capacity = 2000;
        $machineTypeB->number_of_operators = 12;
        $machineTypeB->depreciation_period = 8;
        $machineTypeB->save();

        $machineTypeC = new MachineType();
        $machineTypeC->game_id = 1;
        $machineTypeC->name = 'MaschineC';
        $machineTypeC->price = 20000000;
        $machineTypeC->fix_costs_per_period = 1500000;
        $machineTypeC->capacity = 2500;
        $machineTypeC->number_of_operators = 15;
        $machineTypeC->depreciation_period = 8;
        $machineTypeC->save();


    }
}
