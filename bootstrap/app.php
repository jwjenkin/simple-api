<?php

/**
 * App
 *
 * Starts up the application and begins handling url routing
 */

require_once(__DIR__ . '/../globals.php');
require_once(__DIR__ . '/../classes/index.php');
require_once(__DIR__ . '/../controllers/index.php');

set_error_handler("exception_error_handler");

use Classes\Routes;

lookup($_SERVER['REQUEST_URI']);
