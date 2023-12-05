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
        $machine = new Machine();
        $machine->setDescription($request->getRawData('description'));
        $machineCreated = $machine->createMachine();
       
        return Response::jsonResponse("Machine is created", 201);
        
        //return Response::jsonResponse("Machine Number or description not correct", 400);
    }

    function updateMachine($request)
    {
        //if ($request->has('submit')) {
        $machine =  new Machine();
        $machine->updateMachine($request);

        return Response::jsonResponse("Machine updated");
        //}

        return Response::jsonResponse("Machine Number or description not correct", 400);
    }

    function deleteMachine($request)
    {
        $machine = new Machine();

        if ($machine->ifMachineExist($request)) {

            $machine->deleteMachine($request);
            return Response::jsonResponse("Machine deleted");
        }

        return Response::jsonResponse("Machine not found", 404);
    }

    function displayMachine()
    {
        $machine = new Machine();
        $allMachine = $machine->getALLMachine();
        return Response::jsonResponse($allMachine);
    }

    function getMachine($request){
        $machine = new Machine();
        $machine = $machine->getMachine($request);
        return Response::jsonResponse($machine);
    }
}
