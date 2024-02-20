<?php
/**
 * Ein einziger Behandler für alle Arten von Anfragen, 
 * die bei der Anwendung eingehen
 */

class Router
{
    const MACHINE_ROOT = "machine";
    const CREDIT_ROOT = "credit";
    const GET_METHOD = "GET";
    const POST_METHOD = "POST";
    const PUT_METHOD = "PUT";
    const DELETE_METHOD = "DELETE";

    private MachineDao $machineDao;
    private CreditDao $creditDao;
    private string $prefix;

    public function __construct(string $prefix)
    {
        $this->machineDao = new MachineDao();
        $this->creditDao = new CreditDao();
        $this->prefix = strtolower($prefix);
    }

    function callController(Request $request)
    {
        //Credit
        if ($request->getUrl() == $this->prefix . self::CREDIT_ROOT) { 
            //Get all Credit
            if ($request->getType() == self::GET_METHOD) {
                return $this->creditDao->getAll();
            }
        }
        
        if ($request->getUrlwithoutPathParams() == $this->prefix . self::CREDIT_ROOT . "/update") {
            //Update Credit
             if ($request->getType() == self::PUT_METHOD) {
                return $this->creditDao->update($request);
            }
        }

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
        /** 
         //Get a specefic machine (Kritisch prüfen!)
        if (is_numeric($request->getPathParams())) {
            if ($request->getType() == self::GET_METHOD) {
                return $this->machineDao->get($request);
            }
        }
*/
       
        return Response::jsonResponse("Not found" . $request->getUrl(), 404);
    }
}
