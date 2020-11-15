<?php

opcache_reset();
set_error_handler("exception_error_handler");

require_once('../classes/index.php');
require_once('../controllers/index.php');

use Classes\Routes;

Routes::lookup($_SERVER['REQUEST_URI']);

function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}

function dd(...$args)
{
    var_dump($args);
    die();
}


