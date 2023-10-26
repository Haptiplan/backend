<?php
/**
 * Ein einziger Behandler für alle Arten von Anfragen, 
 * die bei der Anwendung eingehen
 */

class Router {

    const GET_METHOD = "GET";
    const POST_METHOD = "POST";
    const PUT_METHOD = "PUT";
    const MACHINE_ROOT = "machine";

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
                return $this->machineController->displayMachine($request);
            }
        }

        if ($request->getUrl() == $this->prefix.self::MACHINE_ROOT."/create") {
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineController->createMachine($request);
            }
        }

        if ($request->getUrl() == $this->prefix.self::MACHINE_ROOT."/edit") {
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineController->editMachine($request);
            }
        }
        if ($request->getUrl() == $this->prefix.self::MACHINE_ROOT."/update") {
            if ($request->getType() == self::POST_METHOD) {
                return $this->machineController->updateMachine($request, $_POST['machineNr']);
            }
        }
        if ($request->getUrl() == $this->prefix.self::MACHINE_ROOT."/formToDeleteMachine") {
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineController->formToDeleteMachine($request);
            }
        }

        if ($request->getUrl() == $this->prefix.self::MACHINE_ROOT."/delete") {
            if ($request->getType() == self::POST_METHOD) {
                return $this->machineController->deleteMachine($request, $_POST['machineNr']);
            }
        }
        return Response::jsonResponse("Not found".$request->getUrl(), 404);
    }
}