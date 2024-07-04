<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Machine;

class MachineController extends Controller
{
    public function store(Request $request){
       
        $machine = $request->input("machine_name");
        DB::table('machines')->insert(['machineName' => $machine]);    
        $machines = Machine::all();

        return view("create_machines", ['machines' => $machines]);
    }

    public function create(){
        return view("create_machines");
    }

    public function index(){
        $machines = Machine::all();
        $user = Auth::user();

        if ($user->role == \App\Models\User::ROLE_ADMIN || $user->role == \App\Models\User::ROLE_GAMEMASTER) {
            return view("create_machines", ['machines' => $machines]);
        } elseif ($user->role == \App\Models\User::ROLE_USER) {
            return view("machines", ['machines' => $machines]);
        } else {
            abort(403);
        }
    }

    public function delete(){

    }

    public function edit(){

    }
}
