<?php

class MachineController
{

    function addMachine()
    {
        if (isset($_POST['submit'])) {

            $new_data = array(
                "id" => $_POST['id'],
                "name" => $_POST['name'],
                "kapazitaet" => $_POST['kapazitaet'],
                "preis" => $_POST['preis'],
                "laufzeit" => $_POST['laufzeit'],
                "periode" => $_POST['periode']
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

            $this->displayMachine();
            
        }
    }

    function updateMachine()
    {
        if (isset($_POST['submit'])) {
            $new_data = array(
                "id" => $_POST['id'],
                "name" => $_POST['name'],
                "kapazitaet" => $_POST['kapazitaet'],
                "preis" => $_POST['preis'],
                "laufzeit" => $_POST['laufzeit'],
                "periode" => $_POST['periode']
            );

            $id = $_POST['id'];

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

            $id = $_POST['id'];

            $jsonFilePath = 'data.json';
            if (file_exists($jsonFilePath)) {
                //read the existing JSON file
                $existingData = json_decode(file_get_contents($jsonFilePath), true);
                //var_dump($existingData);
                foreach ($existingData as $key => $value) {
                    if ($existingData[$key]["id"] == $id) {
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
        $existingData = file_get_contents($jsonFilePath);
        //include './templates/display_machine.php';
        header('Content-Type: application/json; charset=utf-8');
        echo $existingData;
        die();
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
