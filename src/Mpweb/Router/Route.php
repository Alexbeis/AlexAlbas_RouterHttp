<?php

namespace Mpweb\Router;

class Route
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getURL()
    {
        return $this->url;
    }

}