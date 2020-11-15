<?php

require_once(__DIR__ . '/BaseController.php');
require_once(__DIR__ . '/PinController.php');
require_once(__DIR__ . '/LedController.php');

function response($data, $status = 200)
{
    if ( is_string($data) ) {
        $data = [ 'data' => $data ];
    }

    $response = json_encode($data);

    header('Content-Type: application/json');
    http_response_code($status);
    echo $response;
    exit();
}
