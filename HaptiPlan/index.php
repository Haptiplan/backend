<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
Header("Access-Control-Allow-Methods: *");

require_once './models/Machine.php';
require_once './include/database.php';
require_once './models/machinetype.php';

require_once './controllers/MachineController.php';
require_once './Router.php';
require_once './request/Request.php';
require_once './response/Response.php';
require_once './response/ResponseHandler.php';
require_once './models/decision.php';
require_once './models/building.php';
require_once './models/credit.php';
require_once './models/employeeproduction.php';
require_once './models/raw.php';
require_once './models/machine.php';


$request = new Request();
$responseHandler = new ResponseHandler();

$router = new Router('/haptiplan-backend/HaptiPlan/');
$response = $router->callController($request);
$responseHandler->sendResponse($response); 







