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
    private string $prefix;

    public function __construct(string $prefix)
    {
        $this->machineController = new MachineController();
        $this->prefix = $prefix;
    }

    function callController(Request $request){

        if ($request->getUrl() == $this->prefix.self::MACHINE_ROOT) { 
            if ($request->getType() == self::POST_METHOD) {
                return $this->machineController->addMachine($request);
            }
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineController->displayMachine();
            }
        }

        if ($request->getUrl() == $this->prefix.self::MACHINE_ROOT."/createForm") {
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineController->createMachineForm();
            }
        }

        if ($request->getUrl() == $this->prefix.self::MACHINE_ROOT."/editForm") {
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineController->editMachineForm();
            }
        }
        if ($request->getUrl() == $this->prefix.self::MACHINE_ROOT."/update") {
            if ($request->getType() == self::POST_METHOD) {
                return $this->machineController->updateMachine($request);
            }
        }
        if ($request->getUrl() == $this->prefix.self::MACHINE_ROOT."/deleteForm") {
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineController->deleteMachineForm();
            }
        }

        if ($request->getUrl() == $this->prefix.self::MACHINE_ROOT."/delete") {
            if ($request->getType() == self::POST_METHOD) {
                return $this->machineController->deleteMachine($request);
            }
        }
        return Response::jsonResponse("Not found".$request->getUrl(), 404);
    }
}
