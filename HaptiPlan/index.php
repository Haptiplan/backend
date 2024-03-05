<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
Header("Access-Control-Allow-Methods: *");


require_once './router.php';

spl_autoload_register(function ($class) {
    $directories = [
        __DIR__ . '/dao/',
        __DIR__ . '/response/',
        __DIR__ . '/include/',
        __DIR__ . '/request/'
    ];

    foreach ($directories as $directory) {
        $classPath = $directory . strtolower($class) . '.php';
        if (file_exists($classPath)) {
            require_once $classPath;
            return;
        }
    }
});


$request = new Request();
$responseHandler = new ResponseHandler();
$router = new Router('/backend/HaptiPlan/');
$response = $router->callController($request);

$responseHandler->sendResponse($response); 