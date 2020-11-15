<?php

/**
 * Routes
 *
 * Array of route types, slugs, and their handlers
 */

return [
    'GET' => [
        '/' => 'BaseController@index',
        '/led' => 'LedController@index',
        '/led/toggle' => 'LedController@toggle',
        '/pin' => 'PinController@index',
        '/pin/{pin}' => 'PinController@read'
    ],
    'POST' => [
        '/pin/{pin}' => 'PinController@write'
    ],
    'PUT' => []
];
