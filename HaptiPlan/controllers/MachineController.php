<?php

/**
 * Front Control kann Machinecontroller-Objekt verwenden,
 * um die Anfrage an den entsprechenden spezifischen Handler 
 * weiterzuleiten
 * 
 */
class MachineController
{
    function addMachine($request)
    {
        $last_id = $this->last_id_in_the_JSON();
        $last_id++;
        if ($request->has('beschreibung')) {
            $new_data = array(
                "machineNr" =>$last_id,
                "beschreibung" => $request->input('beschreibung')
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

    function updateMachine($request)
    {
        if ($request->has('submit')) {
            $new_data = array(
                "machineNr" => $request->input('machineNr'),
                "beschreibung" => $request->input('beschreibung')
            );

            $id = $_POST['machineNr'];

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

            $id = $_POST['machineNr'];

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

    function displayMachine()
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
        $path =  './templates/delete_machine.php';
        return Response::viewResponse($path);
    }

    function last_id_in_the_JSON():int{

        $jsonFilePath = 'data.json';
        $existingData = json_decode(file_get_contents($jsonFilePath), true);

        $array_of_ids = [];

        for ($i=0; $i < count($existingData) ; $i++) { 
            $array_of_ids[$i] = $existingData[$i]['machineNr'];
        }

        $max = max($array_of_ids); 
        return $max;
    }
}
