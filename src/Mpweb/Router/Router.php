<?php

namespace Mpweb\Router;

class Router
{

const GET = 'GET';
const POST = 'POST';

private $_routes = array(
    'GET' => array(),
    'POST' => array()
);

public function add(Route $route, $method)
{
    switch ($method) {
        case 'GET':
            $this->_routes['GET'][$route->getURL()] = $route->getController();
        break;

        case 'POST':
            $this->_routes['POST'][$route->getURL()] = $route->getController();
        break;

        default:
            exit('Error!');
        break;
    }
}

public function getController(Route $route, $method)
{
    return $this->_routes[$method][$route->getURL()];
}

public function length($method)
{
    return count($this->_routes[$method]);
}

public function getRoutes()
{
    return $this->_routes;
}

public function getRouteByIndexAndMethod($index, $method)
{
    return array_search($index, $this->_routes[$method]);
}

public function run($path, $method)
{
    //$path = array_key_exists('path', $url);

    foreach (self::$_routes[$method] as $url => $controller) {
        if (preg_match($url, $path, $matches)) {
            array_shift($matches);
            call_user_func_array($callback, array_values($matches));
            return;
        }
    }
}
}