<?php

    header('Content-Type: application/json; charset=utf-8');

    // JSON Daten lesen
    $machines = @file_get_contents('data.json', true);
    echo json_encode(json_decode($machines ?: "[]"));

    http_response_code(200);
    die();
?>