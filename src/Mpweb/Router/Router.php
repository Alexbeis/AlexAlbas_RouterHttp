<?php

namespace Mpweb\Router;

class Router
{


    private $_routes = array();

    private $regexExpression = ["~^/home/~",
                                "/^\/post\/(?<name>[a-zA-Z0-9\_\-]+)\/?$/"];


    public function add(Route $route)
    {
        $this->_routes[] = $route;
             
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

    public function match($uri, $path)
    {   
        foreach($this->_routes as $route) {
            foreach($this->regexExpression as $regex) {
                if (preg_match($regex, $route->getURL(), $matches)) {
                    return true;
                }
            }    
        }
    }
}