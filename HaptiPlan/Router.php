<?php

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
                $this->machineController->addMachine();
            }
            if ($method == self::GET_METHOD) {
                $this->machineController->displayMachine();
            }
        }

        if ($requestedPage == self::MACHINE_ROOT . "/create") {
            if ($method == self::GET_METHOD) {
                $this->machineController->createMachine();
            }
        }

        if ($requestedPage == self::MACHINE_ROOT . "/edit") {
            if ($method == self::GET_METHOD) {
                $this->machineController->editMachine();
            }
        }

        if ($requestedPage == self::MACHINE_ROOT . "/update") {
            if ($method == self::POST_METHOD) {
                $this->machineController->updateMachine();
            }
        }

        if ($requestedPage == self::MACHINE_ROOT . "/deleteForm") {

            if ($method == self::GET_METHOD) {
                $this->machineController->deleteForm();
            }
        }

        if ($requestedPage == self::MACHINE_ROOT . "/delete") {
            if ($method == self::POST_METHOD) {
                $this->machineController->deleteMachine();
            }
        }
    }
}
