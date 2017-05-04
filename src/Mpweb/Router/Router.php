<?php

namespace Mpweb\Router;

class Router
{
    private $routes = array();

    public function add(Route $route)
    {
        $this->routes[] = $route;
             
    }

    public function delete(Route $route)
    {
        unset($this->routes[$route->getURL()]);
            
    }

    public function getController(Route $route)
    {
        return $this->routes[$route->getURL()];
    }

    public function length()
    {
        return count($this->routes);
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function match($uri, $regexUri)
    {   
        $params = [];

        preg_match_all('\'' . '{(\w+)}' . '\'', $regexUri, $matches);
        $matches = $matches[0];
        foreach ($matches as $key => $value) {
            $matches[$key] = str_replace('{', '', $matches[$key]);
            $matches[$key] = str_replace('}', '', $matches[$key]);
        }

        //Replace parameter names to transform URL to regex format.
        $regexUri = preg_replace('%' . '{(\w+)}' . '%', '(\w+|\d+)', $regexUri);
        $regexUri .= '$';
        $regexUri = '%^' . $regexUri . '$%';
        $res = preg_match($regexUri, $uri, $params);
    
        if (!$res || $res == 0) return false;

        $paramLength = count($matches);
        $keyParams = array();

        for ($i = 0; $i < $paramLength; $i++) {
            $keyParams[$matches[$i]] = $params[$i + 1];
        }
    
        if ($keyParams) return true;




        // foreach($this->_routes as $route) {
        //     foreach($this->regexExpression as $regex) {
        //         if (preg_match($regex, $route->getURL(), $matches)) {
        //             return true;
        //         }
        //     }    
        // }
    }
}