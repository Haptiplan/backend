<?php

/**
 * Front Control kann Machinecontroller-Objekt verwenden,
 * um die Anfrage an den entsprechenden spezifischen Handler 
 * weiterzuleiten
 */
class MachineController
{
    function addMachine($request)
    {  
        $machinetype = new Machinetype();
        $mach_dao = new MachineDao();
        $machinetype->setMachine_name($request->getRawData('machine_name'));
        $machinetype->setMachine_capacity($request->getRawData('machine_capacity'));
        $machinetype->setMachine_price($request->getRawData('machine_price'));
        $machinetype->setMachine_duration($request->getRawData('machine_duration'));
        $machinetype->setMachine_period($request->getRawData('machine_period'));
        $mach_dao->insert($request);
        return Response::jsonResponse("Machine is created", 201);
    }

    function update($request)
    {
        $machinetype = new MachineDao();
        $machinetype->update($request);

        return Response::jsonResponse("Machine updated");
      
    }

    function delete($request)
    {
        $machine = new MachineDao();

        if ($machine->ifMachineExist($request)) {

            $machine->delete($request);
            return Response::jsonResponse("Machine deleted");
        }

        return Response::jsonResponse("Machine not found", 404);
    }

    function displayMachine()
    {
        $machine = new MachineDao();
        $allMachine = $machine->getAll();
        return Response::jsonResponse($allMachine);
    }

    function get($request){
        $machine = new MachineDao();
        $machine = $machine->get($request);
        return Response::jsonResponse($machine);
    }
}
