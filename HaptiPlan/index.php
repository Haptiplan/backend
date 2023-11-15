<?php

require_once './models/Machine.php';
require_once './include/database.php';

require_once './controllers/MachineController.php';
require_once './Router.php';
require_once './request/Request.php';
require_once './response/Response.php';
require_once './response/ResponseHandler.php';

$request = new Request();
$responseHandler = new ResponseHandler();

$router = new Router('/haptiplan-backend/HaptiPlan/');
$response = $router->callController($request);
$responseHandler->sendResponse($response); 







