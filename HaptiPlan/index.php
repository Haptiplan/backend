<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
Header("Access-Control-Allow-Methods: *");

require_once './dao/dao.php';
require_once './dao/machinedao.php';
require_once './dao/creditdao.php';

require_once './include/database.php';

require_once './router.php';
require_once './request/request.php';
require_once './response/response.php';
require_once './response/responseHandler.php';

require_once './models/decision.php';
require_once './models/building.php';
require_once './models/credit.php';
require_once './models/employeeproduction.php';
require_once './models/raw.php';
require_once './models/machine.php';
require_once './models/machinetype.php';

$request = new Request();
$responseHandler = new ResponseHandler();
$router = new Router('/backend/HaptiPlan/');
$response = $router->callController($request);
$responseHandler->sendResponse($response); 







