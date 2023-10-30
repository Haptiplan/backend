<?php

require_once './controllers/MachineController.php';
require_once './Router.php';
require_once './request/Request.php';
require_once './response/Response.php';
require_once './response/ResponseHandler.php';

$request = new Request();
$responseHandler = new ResponseHandler();

$router = new Router('/Haptiplan-Frontend/HaptiPlan/');
$response = $router->callController($request);
$responseHandler->sendResponse($response); 







