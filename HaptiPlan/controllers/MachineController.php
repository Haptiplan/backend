<?php

/**
 * Front Control kann Machinecontroller-Objekt verwenden,
 * um die Anfrage an den entsprechenden spezifischen Handler 
 * weiterzuleiten
 * 
 */
class MachineController
{

    function addMachine()
    {

        if (isset($_POST['name'])) {

            $new_data = array(
                "name" => $_POST['name']   

            );

            $jsonFilePath = 'data.json';
            if (file_exists($jsonFilePath)) {
                //read the existing JSON file
                $existingData = json_decode(file_get_contents($jsonFilePath), true);
                $existingData[] = $new_data;
            } else {
                $existingData = array($new_data);
            }

            $jsonData = json_encode($existingData, JSON_PRETTY_PRINT);

            file_put_contents($jsonFilePath, $jsonData);


            return Response::jsonResponse("Machine is created", 201);
        }

        return Response::jsonResponse("Machine Number or Beschreibung not correct", 400);
    }

    function updateMachine()
    {
        // TODO variablen prüfen ob gesetzt.
        if (isset($_POST['submit'])) {
            $new_data = array(
                "name" => $_POST['name'], 
                "capacity" => $_POST['capacity'],
                "price" => $_POST['price'],
                "duration" => $_POST['duration'],
                "period" => $_POST['period']
            );

            $id = $_POST['id'];

            $jsonFilePath = 'data.json';
            if (file_exists($jsonFilePath)) {
                //read the existing JSON file
                $existingData = json_decode(file_get_contents($jsonFilePath), true);

                for ($i = 0; $i < count($existingData); $i++) {
                    if ($existingData[$i]['machineNr'] == $id) {
                        $existingData[$i] = $new_data;
                    }
                }

                $jsonData = json_encode($existingData, JSON_PRETTY_PRINT);
                file_put_contents($jsonFilePath, $jsonData);

                return Response::jsonResponse("Machine updated");
            }
        }
        return Response::jsonResponse("Machine Number or Beschreibung not correct", 400);
    }

    function deleteMachine($id)
    {

            $id = $_POST['id'];

            $jsonFilePath = 'data.json';
            if (file_exists($jsonFilePath)) {
                //read the existing JSON file
                $existingData = json_decode(file_get_contents($jsonFilePath), true);

                foreach ($existingData as $key => $value) {
                    if ($existingData[$key]["id"] == $id) {
                        unset($existingData[$key]);
                    }
                }
                $jsonData = json_encode($existingData, JSON_PRETTY_PRINT);
                file_put_contents($jsonFilePath, $jsonData);

                return Response::jsonResponse("Machine deleted");
            }
            return Response::jsonResponse("Machine is not founded", 404);
    }

    function displayMachine()
    {
        $jsonFilePath = 'data.json';
        $existingData = json_decode(file_get_contents($jsonFilePath), true);

        return Response::jsonResponse($existingData);
    }

    function createMachine()
    {
        $path = './templates/create_machine.html';
        return Response::viewResponse($path);
    }

    function editMachine()
    {
        $path = './templates/edit_machine.php';
        return Response::viewResponse($path);
    }

    function formToDeleteMachine()
    {
        $path =  './templates/delete_machine.php';
        return Response::viewResponse($path);
    }
}
