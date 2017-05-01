<?php

namespace Mpweb\Router;

class Route
{
private $url;
private $controller;

public function __construct($url, $controller)
{
    $this->url = $url;
    $this->controller = $controller;

}

// protected function _setURL($url)
// {
//     $this->_url = '/^' . str_replace('/', '\\/', $url) . '$/';
// }

public function getURL()
{
    return $this->url;
}

public function getController()
{
    return $this->controller;
}
}