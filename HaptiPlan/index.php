<?php

require_once './controllers/MachineController.php';
require_once './Router.php';
require_once './model/game.php';
require_once './model/company.php';
require_once './model/machine.php';
require_once './model/user.php';

if (isset($_GET['page'])) {
    $requested_page = $_GET['page'];
} else {
    $requested_page = 'home';
}

$router = new Router();
$router->callController($requested_page, $_SERVER['REQUEST_METHOD']);