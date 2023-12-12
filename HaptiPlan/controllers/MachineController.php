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
        $machineType = new MachineType();
        $machineType->setDescription($request->getRawData('description'));
        $machineType->createMachine();

        return Response::jsonResponse("Machine is created", 201);
    }

    function updateMachine($request)
    {

        $machineType =  new MachineType();
        $machineType->updateMachine($request);

        return Response::jsonResponse("Machine updated"); 
    }

    function deleteMachine($request)
    {
        $machineType = new MachineType();

        if ($machineType->ifMachineExist($request)) {

            $machineType->deleteMachine($request);
            return Response::jsonResponse("Machine deleted");
        }

        return Response::jsonResponse("Machine not found", 404);
    }

    function displayMachine()
    {
        $machineType = new MachineType();
        $allMachine = $machineType->getALLMachine();
        return Response::jsonResponse($allMachine);
    }

    function getMachine($request){
        $machineType = new MachineType();
        $machineType = $machineType->getMachine($request);
        return Response::jsonResponse($machineType);
    }
}
