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
        $this->prefix = strtolower($prefix);
    }

    function callController(Request $request)
    {
        if ($request->getUrl() == $this->prefix . self::MACHINE_ROOT) {
            //Create Machine
            if ($request->getType() == self::POST_METHOD) {
                return $this->machineController->addMachine($request);
            }
            //Get all machine
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineController->displayMachine();
            }
        }

        //Get a specefic machine
        if (is_numeric($request->getPathParams())) {
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineController->getMachine($request);
            }
        }

        //Update machine
        if ($request->getUrlwithoutPathParams() == $this->prefix . self::MACHINE_ROOT . "/update") {
            if ($request->getType() == self::PUT_METHOD) {
                return $this->machineController->updateMachine($request);
            }
        }

        //Delete machine
        if ($request->getUrlwithoutPathParams() == $this->prefix . self::MACHINE_ROOT . "/delete") {
            if ($request->getType() == self::DELETE_METHOD) {
                return $this->machineController->deleteMachine($request);
            }
        }
        return Response::jsonResponse("Not found" . $request->getUrl(), 404);
    }
}
