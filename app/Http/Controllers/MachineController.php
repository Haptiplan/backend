<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Machine;

class MachineController extends Controller
{
    public function index(){
        $machines = Machine::all();
        $user = Auth::user();

        if ($user->role == \App\Models\User::ROLE_GAMEMASTER) {
            return view("machines.create", ['machines' => $machines]);
        } elseif ($user->role == \App\Models\User::ROLE_USER) {
            return view("machines.index", ['machines' => $machines]);
        } else {
            abort(403);
        }
    }

    public function create(){
        return view("machines.create");
    }

    public function store(Request $request){
       
        $machine = $request->input("machine_name");
        DB::table('machines')->insert(['machine_name' => $machine]);    
        $machines = Machine::all();

        return view("machines.index", ['machines' => $machines]);
    }

    public function edit(string $machine_id){
        $machine = Machine::findOrFail($machine_id); 
        return view('machines.edit', ['machine' => $machine]);
    }

    public function update(Request $request, string $machine_id)
    {
        $validated = $request->validate([
            'machine_name' => 'required|string|max:255', 
        ]);
        
        $machine = Machine::find($machine_id);

        $machine->machine_name = $validated['machine_name'];
        $machine->save();
        $machine->update();

        return redirect()->route('machine.index');
    }

    public function destroy(string $machine_id)
    {
        $machine = Machine::findOrFail($machine_id);
        $machine->delete();

        return redirect()->route('machine.index');
    }

    
}
