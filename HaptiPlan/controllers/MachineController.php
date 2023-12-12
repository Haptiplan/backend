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
            $description = $request->input('description');

            $machine = new MachineType();
            $machine->setDescription($description);
            $machine->createMachine();

            return Response::jsonResponse("Machine is created", 201);
    }

    function updateMachine($request)
    {

        $machine =  new MachineType();
        $machine->updateMachine($request);

        return Response::jsonResponse("Machine updated"); 
    }

    function deleteMachine($request)
    {
        $machine = new MachineType();

        if ($machine->ifMachineExist($request)) {

            $machine->deleteMachine($request);
            return Response::jsonResponse("Machine deleted");
        }

        return Response::jsonResponse("Machine not found", 404);
    }

    function displayMachine()
    {
        $machine = new MachineType();
        $allMachine = $machine->getALLMachine();
        return Response::jsonResponse($allMachine);
    }

    function getMachine($request){
        $machine = new MachineType();
        $machine = $machine->getMachine($request);
        return Response::jsonResponse($machine);
    }
}
