<?php
/**
 * Ein einziger Behandler für alle Arten von Anfragen, 
 * die bei der Anwendung eingehen
 */

class Router
{
    const MACHINE_ROOT = "machine";
    const EMPLOYEE_ROOT = "employee";
    const GET_METHOD = "GET";
    const POST_METHOD = "POST";
    const PUT_METHOD = "PUT";
    const DELETE_METHOD = "DELETE";

    private MachineDao $machineDao;
    private EmployeeDao $employeeDao;
    private string $prefix;

    public function __construct(string $prefix)
    {
        $this->machineDao = new MachineDao();
        $this->employeeDao = new EmployeeDao();
        $this->prefix = strtolower($prefix);
    }

    function callController(Request $request)
    {
        if ($request->getUrl() == $this->prefix . self::MACHINE_ROOT) {
            //Create Machine
            if ($request->getType() == self::POST_METHOD) {
                return $this->machineDao->insert($request);
            }
            //Get all machine
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineDao->getAll();
            }
        }

        //Update machine
        if ($request->getUrlwithoutPathParams() == $this->prefix . self::MACHINE_ROOT . "/update") {
            if ($request->getType() == self::PUT_METHOD) {
                return $this->machineDao->update($request);
            }
        }

        //Delete machine
        if ($request->getUrlwithoutPathParams() == $this->prefix . self::MACHINE_ROOT . "/delete") {
            if ($request->getType() == self::DELETE_METHOD) {
                return $this->machineDao->delete($request);
            }
        }
        /*
        //Get a specefic machine
        if (is_numeric($request->getPathParams())) {
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineDao->get($request);
            }
        }*/

        if ($request->getUrl() == $this->prefix . self::EMPLOYEE_ROOT) {
            
            //Create employee
            if ($request->getType() == self::POST_METHOD) {
                return $this->employeeDao->insert($request);
            }

            //Get all employee
            if ($request->getType() == self::GET_METHOD) {
                return $this->employeeDao->getAll();
            }
        }

        //Update employee
        if ($request->getUrlwithoutPathParams() == $this->prefix . self::EMPLOYEE_ROOT . "/update") {
            if ($request->getType() == self::PUT_METHOD) {
                return $this->employeeDao->update($request);
            }
        }

        //Delete employee
        if ($request->getUrlwithoutPathParams() == $this->prefix . self::EMPLOYEE_ROOT . "/delete") {
            if ($request->getType() == self::DELETE_METHOD) {
                return $this->employeeDao->delete($request);
            }
        }

        //TODO: Stimmt noch nicht
        //Get a specefic employee
        
        if (strpos($request->getUrl(), $this->prefix . self::EMPLOYEE_ROOT . "/") === 0) {
            $urlParts = explode("/", $request->getUrl());
            $employeeId = end($urlParts);
            if (is_numeric($employeeId) && $request->getType() == self::GET_METHOD) {
                return $this->employeeDao->get($request);
            }
        }
        

        return Response::jsonResponse("Not found" . $request->getUrl(), 404);
    }
}
