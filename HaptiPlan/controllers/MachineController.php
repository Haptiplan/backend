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
        $lastId = $this->last_id_in_the_JSON();
        $lastId++;
        if (isset($_POST['submit'])) {

            $new_data = array(
                "id" => $lastId,
                "machine_name" => $_POST['machine_name']
            );
            $jsonFilePath = 'data.json';
            $existingData = $this->getDataJson($jsonFilePath);
            $existingData[] = $new_data;
            $this->setDataJson($jsonFilePath, $existingData);

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
            $existingData = $this->getDataJson($jsonFilePath);

            for ($i = 0; $i < count($existingData); $i++) {
                if ($existingData[$i]['machineNr'] == $id) {
                    $existingData[$i] = $new_data;
                }
            }

            $this->setDataJson($jsonFilePath, $existingData);

            return Response::jsonResponse("Machine updated");
        }

        return Response::jsonResponse("Machine Number or Beschreibung not correct", 400);
    }

    function deleteMachine($id)
    {

        $id = $_POST['id'];

        $jsonFilePath = 'data.json';
        if ($this->checkJsonExists($jsonFilePath)) {
            //read the existing JSON file
            $existingData = json_decode(file_get_contents($jsonFilePath), true);

            foreach ($existingData as $key => $value) {
                if ($existingData[$key]["id"] == $id) {
                    unset($existingData[$key]);
                }
            }
            $this->setDataJson($jsonFilePath, $existingData);

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
        $path = './templates/create_machine.php';
        return Response::viewResponse($path);
    }

    function editMachine()
    {
        $path = './templates/edit_machine.php';
        return Response::viewResponse($path);
    }

    function formToDeleteMachine()
    {
        $path = './templates/delete_machine.php';
        return Response::viewResponse($path);
    }
    function last_id_in_the_JSON(): int
    {
        $existingData = $this->getDataJson('data.json');

        $array_of_ids = [];

        for ($i = 0; $i < count($existingData); $i++) {
            $array_of_ids[$i] = $existingData[$i]['id'];
        }
        if (!empty($array_of_ids)) {
            $max = max($array_of_ids);
        } else {
            $max = 0;
        }
        return $max;
    }
    /**
     * Gibt Daten aus dem JSON raus, falls es keine Json existiert
     * dann erstellt er eine neue JSON Datei
     */
    function getDataJson(string $jsonFilePath)
    {
        if (file_exists($jsonFilePath)) {
            $existingData = json_decode(file_get_contents($jsonFilePath), true);
        } else {
            $existingData = [];
        }

        return $existingData;
    }

    function setDataJson(string $jsonFilePath, array $existingData)
    {
        $jsonData = json_encode($existingData, JSON_PRETTY_PRINT);
        file_put_contents($jsonFilePath, $jsonData);
    }

    function checkJsonExists(string $jsonFilePath) : bool
    {
        $jsonExists = false;
        
        if (file_exists($jsonFilePath)) {
            $jsonExists = true;
        }
        return $jsonExists;
    }    
}
