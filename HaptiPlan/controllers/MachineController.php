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
        if ($request->has('description')) {

            $description = $request->input('description');

            $machine = new MachineType();
            $machine->setDescription($description);
            $machine->createMachine();

            return Response::jsonResponse("Machine is created", 201);
        }

        return Response::jsonResponse("Machine Number or description not correct", 400);
    }

    function updateMachine($request)
    {
        //if ($request->has('submit')) {
        $machine =  new MachineType();
        $machine->updateMachine($request);

        return Response::jsonResponse("Machine updated");
        //}

        //return Response::jsonResponse("Machine Number or description not correct", 400);
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
        //$jsonFilePath = 'data.json';
        //$existingData = json_decode(file_get_contents($jsonFilePath), true);
        $machine = new MachineType();
        $allMachine = $machine->getALLMachine();
        return Response::jsonResponse($allMachine);

    }

    function createMachineForm()
    {
        $path = './templates/create_machine.php';
        return Response::viewResponse($path);
    }

    function editMachineForm()
    {
        $path = './templates/edit_machine.php';
        return Response::viewResponse($path);
    }

    function deleteMachineForm()
    {
        $path =  './templates/delete_machine.php';
        return Response::viewResponse($path);
    }

    function last_id_in_the_JSON(): int
    {
        $jsonFilePath = 'data.json';
        $existingData = json_decode(file_get_contents($jsonFilePath), true);

        if (!$existingData) {
            $max = 0;
            return $max;
        }

        $array_of_ids = [];

        for ($i = 0; $i < count($existingData); $i++) {
            $array_of_ids[$i] = $existingData[$i]['machineNr'];
        }

        $max = max($array_of_ids);
        return $max;
    }
}
