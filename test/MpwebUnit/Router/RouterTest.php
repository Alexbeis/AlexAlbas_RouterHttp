<?php


namespace MpwebUnit\Router;


use Mpweb\Router\Route;
use Mpweb\Router\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var Route
     */
    private $route;

    /**
     * @var Route
     */
    private $route1;

    protected function setUp()
    {
        $this->router = new Router();
        $this->route = new Route("/", "@home");
        $this->route1 = new Route("post/{id}", "@post");
    }


    protected function tearDown()
    {
        $this->router = null;
        $this->route = null;
        $this->route1 = null;
    }

    /** @test */
    public function shouldHaveZeroElementsWhenNoElementIsAdded()
    {
        $this->assertEquals(0, $this->router->length("GET"));
        $this->assertEquals(0, $this->router->length("POST"));
    }

     /** @test */
    public function shouldAddGetRouteToRouter()
    {
        $this->router->add($this->route, "GET");
        $this->assertEquals($this->route->getController(), $this->router->getRoutes()["GET"][$this->route->getURL()]);
    }

    /** @test */
    public function shouldAddPostRoute()
    {
        $this->router->add($this->route1, "POST");
        $this->assertEquals($this->route1->getController(), $this->router->getRoutes()["POST"][$this->route1->getURL()]);
    }




}