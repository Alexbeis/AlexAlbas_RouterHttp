<?php


namespace MpwebUnit\Router;


use Mpweb\Router\Route;
use Mpweb\Router\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{
	
	 private $routes = [ 1 => '/home/',
	 					 2 => '/post/{id}',
	 					 3 => '/{category}/{product}/{id}/', 
	 					 4 => '/tag/{name}/' 
	 					];
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
        $this->route = new Route("/home/");
        $this->route1 = new Route("/post/1");
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
        $this->assertEquals(0, $this->router->length());
    }

     /** @test */
    public function shouldAddRouteToRouter()
    {
        $this->router->add($this->route);
        $this->router->add($this->route1);
        $this->assertEquals($this->route->getURL(), $this->router->getRoutes()[0]->getURL());
        $this->assertEquals($this->route1->getURL(), $this->router->getRoutes()[1]->getURL());

    }

    /** @test */
    public function shouldGetARoute()
    {
    	$this->router->add($this->route);
        $this->router->add($this->route1);
    	$this->assertTrue($this->router->match($this->routes[1], $this->route));
    }


    /** @test */
    public function shouldGetARoute1()
    {
    	$this->router->add($this->route);
    	$this->router->add($this->route1);
        $this->assertTrue($this->router->match($this->routes[2], $this->route1));
    
    }

}