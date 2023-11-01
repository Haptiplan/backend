<?php
/**
 * Ein einziger Behandler für alle Arten von Anfragen, 
 * die bei der Anwendung eingehen
 */

class Router
{
    const MACHINE_ROOT = "machine";

    const GET_METHOD = "GET";
    const POST_METHOD = "POST";
    const PUT_METHOD = "PUT";
    const DELETE_METHOD = "DELETE";

    private MachineController $machineController;

    public function __construct()
    {
        $this->machineController = new MachineController();
    }

    function callController($requestedPage, $method)
    {
        if ($requestedPage == self::MACHINE_ROOT) {
            if ($method == self::POST_METHOD) {
                return $this->machineController->addMachine();
            }
            if ($method == self::GET_METHOD) {
                return $this->machineController->displayMachine();
            }
        }

        if ($requestedPage == self::MACHINE_ROOT . "/create") {
            if ($method == self::GET_METHOD) {
                return $this->machineController->createMachine();
            }
        }

        if ($requestedPage == self::MACHINE_ROOT . "/edit") {
            if ($method == self::GET_METHOD) {
                return $this->machineController->editMachine();
            }
        }
      
        if ($requestedPage == self::MACHINE_ROOT."/update") {
            if ($method == self::POST_METHOD) {
                return $this->machineController->updateMachine($_POST['machineNr']);
            }
        }
        if ($requestedPage == self::MACHINE_ROOT."/formToDeleteMachine") {
            if ($method == self::GET_METHOD) {
                return $this->machineController->formToDeleteMachine();
            }
        }

        if ($requestedPage == self::MACHINE_ROOT."/delete") {
            if ($method == self::POST_METHOD) {
                return $this->machineController->deleteMachine($_POST['machineNr']);
            }
        }
        return Response::jsonResponse("No Content", 404);

    }
}
