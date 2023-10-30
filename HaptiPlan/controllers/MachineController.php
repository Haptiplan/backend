<?php

class MachineController
{

    function addMachine()
    {
        if (isset($_POST['submit'])) {
            $new_data = array(
                "maschineNr" => $_POST['maschineNr'],
                "beschreibung" => $_POST['beschreibung']
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
        }
    }

    function updateMachine()
    {
        if (isset($_POST['submit'])) {
            $new_data = array(
                "maschineNr" => $_POST['maschineNr'],
                "beschreibung" => $_POST['beschreibung']
            );

            $id = $_POST['maschineNr'];

            $jsonFilePath = 'data.json';
            if (file_exists($jsonFilePath)) {
                //read the existing JSON file
                $existingData = json_decode(file_get_contents($jsonFilePath), true);
                $existingData[$id] = $new_data;

                $jsonData = json_encode($existingData, JSON_PRETTY_PRINT);

                file_put_contents($jsonFilePath, $jsonData);
            }
        }
    }

    function deleteMachine()
    {
        if (isset($_POST['submit'])) {

            $id = $_POST['maschineNr'];

            $jsonFilePath = 'data.json';
            if (file_exists($jsonFilePath)) {
                //read the existing JSON file
                $existingData = json_decode(file_get_contents($jsonFilePath), true);
                //var_dump($existingData);
                foreach ($existingData as $key => $value) {
                    if ($existingData[$key]["maschineNr"] == $id) {
                        unset($existingData[$key]);
                    }
                }

                $jsonData = json_encode($existingData, JSON_PRETTY_PRINT);

                file_put_contents($jsonFilePath, $jsonData);
            }
        }
    }

    function displayMachine()
    {
        $jsonFilePath = 'data.json';
        //read the existing JSON file
        $existingData = json_decode(file_get_contents($jsonFilePath), true);
        echo '<pre>';
        var_dump($existingData);
        echo '</pre>';
    }

    function createMachine()
    {
        require_once './templates/create_machine.php';
    }

    function editMachine()
    {
        require_once './templates/edit_machine.php';
    }

    function deleteForm()
    {
        require_once './templates/delete_machine.php';
    }
}
