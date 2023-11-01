<?php

require_once './controllers/MachineController.php';
require_once './Router.php';

require_once './response/Response.php';
require_once './response/ResponseHandler.php';


$responseHandler = new ResponseHandler();


if (isset($_GET['page'])) {
    $requested_page = $_GET['page'];
} else {
    $requested_page = 'home';
}

$router = new Router();
$response = $router->callController($requested_page, $_SERVER['REQUEST_METHOD']);
$responseHandler->sendResponse($response); 







