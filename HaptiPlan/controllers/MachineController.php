<?php

/**
 * Front Control kann Machinecontroller-Objekt verwenden,
 * um die Anfrage an den entsprechenden spezifischen Handler 
 * weiterzuleiten
 * 
 */
class MachineController
{

    function addMachine(Request $request)
    {
        if (isset($_POST["machineNr"]) && isset($_POST["beschreibung"])) {
            $new_data = array(
                "machineNr" => $_POST["machineNr"],
                "beschreibung" => $_POST["beschreibung"]
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

    function updateMachine(Request $request, $id)
    {
        if (isset($_POST['submit'])) {
            $new_data = array(
                "machineNr" => $_POST['machineNr'],
                "beschreibung" => $_POST['beschreibung']
            );

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

    function deleteMachine(Request $request, $id)
    {

            $jsonFilePath = 'data.json';
            if (file_exists($jsonFilePath)) {
                //read the existing JSON file
                $existingData = json_decode(file_get_contents($jsonFilePath), true);

                foreach ($existingData as $key => $value) {
                    if ($existingData[$key]["machineNr"] == $id) {
                        unset($existingData[$key]);
                    }
                }

                $jsonData = json_encode($existingData, JSON_PRETTY_PRINT);
                file_put_contents($jsonFilePath, $jsonData);

                return Response::jsonResponse("Machine deleted");
            }
            return Response::jsonResponse("Machine is not founded", 404);
    }

    function displayMachine(Request $request)
    {
        $jsonFilePath = 'data.json';
        $existingData = json_decode(file_get_contents($jsonFilePath), true);

        return Response::jsonResponse($existingData);
        /*
        echo '<pre>';
        var_dump($existingData);
        echo '</pre>';
        */
    }

    function createMachine(Request $request)
    {
        $path = './templates/create_machine.php';
        return Response::viewResponse($path);
    }

    function editMachine(Request $request)
    {
        $path = './templates/edit_machine.php';
        return Response::viewResponse($path);
    }

    function formToDeleteMachine(Request $request)
    {
        $path =  './templates/delete_machine.php';
        return Response::viewResponse($path);
    }
}
