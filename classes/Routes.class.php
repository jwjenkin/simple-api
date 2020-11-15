<?php

namespace Classes;

class Routes
{
    const CURRENT = [
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

    public static function lookup(string $slug)
    {
        $requestType = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
        $urlsOfType = self::CURRENT[$requestType];
        $handler = null;
        $data = [];
        $exactSlug = isset($urlsOfType[$slug]);

        if ( !$exactSlug ) {
            foreach ( $urlsOfType as $url => $urlHandler ) {
                $params = null;
                preg_match_all('/\{(.*)\}/', $url, $params);
                // handle changes
                $urlMatcher = str_replace(
                    '/', '\\/',
                    preg_replace('/\{(.*)\}/', '([\w\-\.\@]+)', $url)
                );

                $matches = null;
                if ( !preg_match_all("/^$urlMatcher$/", $slug, $matches) ) {
                    continue;
                }

                if ( count($params[0]) ) {
                    foreach ( $params[1] as $paramIndex => $param ) {
                        $data[$param] = $matches[1][$paramIndex];
                    }
                }

                foreach ( $_REQUEST as $dataKey => $value ) {
                    $data[$dataKey] = $value;
                }

                $handler = $urlHandler;
                break;
            }
        } else {
            $handler = $urlsOfType[$slug];
        }

        if ( is_null($handler) ) {
            return response([ 'error' => 'No such page.' ], 404);
        }

        $pieces = explode('@', $handler);
        $class = "Controller\\{$pieces[0]}";
        $function = $pieces[1];
        $controller = new $class();

        try {
            return response($controller->{$function}(...array_values($data)));
        } catch ( \Error $e ) {
            return response($e->getMessage(), 500);
        }
    }
}
