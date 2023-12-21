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
        $machinetype->setMachine_name($request->getRawData('machine_name'));
        $machinetype->setMachine_capacity($request->getRawData('machine_capacity'));
        $machinetype->setMachine_price($request->getRawData('machine_price'));
        $machinetype->setMachine_duration($request->getRawData('machine_duration'));
        $machinetype->setMachine_period($request->getRawData('machine_period'));
        $machineCreated = $machinetype->createMachine();
       
        return Response::jsonResponse("Machine is created", 201);
        
        //return Response::jsonResponse("Machine Number or description not correct", 400);
    }

    function updateMachine($request)
    {
        $machinetype =  new Machinetype();
        $machinetype->updateMachine($request);

        return Response::jsonResponse("Machine updated");
      
        //return Response::jsonResponse("Machine Number or description not correct", 400);
    }

    function deleteMachine($request)
    {
        $machine = new Machinetype();

        if ($machine->ifMachineExist($request)) {

            $machine->deleteMachine($request);
            return Response::jsonResponse("Machine deleted");
        }

        return Response::jsonResponse("Machine not found", 404);
    }

    function displayMachine()
    {
        $machine = new Machinetype();
        $allMachine = $machine->getALLMachine();
        return Response::jsonResponse($allMachine);
    }

    function getMachine($request){
        $machine = new Machinetype();
        $machine = $machine->getMachine($request);
        return Response::jsonResponse($machine);
    }
}
