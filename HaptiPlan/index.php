<?php

require_once './controllers/MachineController.php';
require_once './Router.php';

if (isset($_GET['page'])) {
    $requested_page = $_GET['page'];
} else {
    $requested_page = 'home';
}

$router = new Router();
$router->callController($requested_page, $_SERVER['REQUEST_METHOD']);





