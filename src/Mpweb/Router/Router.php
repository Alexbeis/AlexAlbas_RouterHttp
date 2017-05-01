<?php

namespace Mpweb\Router;

class Router
{


    private $_routes = array();


    public function add(Route $route)
    {
        $this->_routes[$route->getURL()] = $route->getController();
             
    }

    public function delete(Route $route)
    {
        unset($this->_routes[$route->getURL()]);
            
    }

    public function getController(Route $route)
    {
        return $this->_routes[$route->getURL()];
    }

    public function length()
    {
        return count($this->_routes);
    }

    public function getRoutes()
    {
        return $this->_routes;
    }

    public function run($path)
    {   
        foreach($this->_routes as $uri => $controller) {
            
            if (preg_match($uri, $path, $matches)) {

                return $matches[0];
            }
            
        }
    }
}