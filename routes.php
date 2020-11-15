<?php

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
