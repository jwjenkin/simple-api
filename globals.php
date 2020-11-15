<?php

/**
 * Globals (globals.php)
 *
 * Contains functions which can be used anywhere within the application.
 */

// Custom Routes
define('_ROUTES', require_once(__DIR__ . '/routes.php'));

/**
 * Returns data as a json object
 *
 * @param array|object|string $data
 * @param int $status (optional)
 * @return void
 */
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

/**
 * Attempts to find current route in route list, passing along any data it finds
 *
 * @param string $slug
 * @return string
 */
function lookup(string $slug)
{
    $requestType = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
    $urlsOfType = routes_of_type($requestType);
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

/**
 * Fetches all routes of given type
 *
 * @param string $type
 * @return array
 */
function routes_of_type(string $type)
{
    return _ROUTES[$type];
}

/**
 * Handles errors pleasantly.
 *
 * @param int (?) $severity
 * @param string $message
 * @param string $file
 * @param int $line
 * @return void
 * @NOTE: this was mainly added thanks to lighttpd being a bit odd
 */
function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}

/**
 * Quick var dump and die method
 *
 * @param array|double|int|object|string
 * @return void
 */
function dd(...$args)
{
    var_dump($args);
    die();
}
