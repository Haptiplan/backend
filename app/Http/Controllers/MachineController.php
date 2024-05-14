<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Machine;

class MachineController extends Controller
{
    public function store(Request $request){
       
        $machine = $request->input("machine_name");
        DB::table('machines')->insert(['machineName' => $machine]);    
        return "created";
    }

    public function create(){
        return view("create_machines");
    }

    public function index(){

        $machines = Machine::all();

        return view("machines", ['machines' => $machines]);
    }

    public function delete(){

    }

    public function edit(){

    }
}
