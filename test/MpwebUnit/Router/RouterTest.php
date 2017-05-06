<?php


namespace MpwebUnit\Router;


use Mpweb\Router\Route;
use Mpweb\Router\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    const ZERO_ELEMENTS    = 0;
	const ONE_ELEMENT      = 1;
    const THREE_ELEMENTS   = 3;

	private $routes = [ 1 => '/{id}/',
	 					2 => '/post/{id}/',
	 					3 => '/{category}/{product}/', 
	 					4 => '/tag/{name}/' 
	 				  ];
    /**
     * @var Router
     */
    private $router;

    /**
     * @var Route
     */
    private $route_1;

    /**
     * @var Route
     */
    private $route_2;

      /**
     * @var Route
     */
    private $route_3;

      /**
     * @var Route
     */
    private $route_4;

    protected function setUp()
    {
        $this->router  = new Router();
        $this->route_1 = new Route("/3/");
        $this->route_2 = new Route("/post/1/");
        $this->route_3 = new Route("/una_categoria/un_producto/");
        $this->route_4 = new Route("/tag/un_producto/");
    }

    protected function tearDown()
    {
        $this->router  = null;
        $this->route_1 = null;
        $this->route_2 = null;
        $this->route_3 = null;
        $this->route_4 = null;
    }

    /** @test */
    public function shouldHaveZeroElementsWhenNoElementIsAdded()
    {
        $this->assertEquals(self::ZERO_ELEMENTS, $this->router->length());
    }

     /** @test */
    public function shouldAddRouteToRouter()
    {
        $this->router->add($this->route_1);
        $this->router->add($this->route_2);
        $this->router->add($this->route_3);
        $this->router->add($this->route_4);
        $this->assertEquals($this->route_1->getURL(), $this->router->getRoutes()[0]->getURL());
        $this->assertEquals($this->route_2->getURL(), $this->router->getRoutes()[1]->getURL());
        $this->assertEquals($this->route_3->getURL(), $this->router->getRoutes()[2]->getURL());
        $this->assertEquals($this->route_4->getURL(), $this->router->getRoutes()[3]->getURL());

    }
    /*No keyParams-> Solo valida si match o no.*/
    // /** @test */
    // public function shouldMatchARoute()
    // {
    // 	$this->assertTrue($this->router->match($this->route_1->getURL(),$this->routes[1]),"The Route does not match");
    // 	$this->assertTrue($this->router->match($this->route_2->getURL(), $this->routes[2]), "The Route does not match");
    // 	$this->assertTrue($this->router->match($this->route_3->getURL(), $this->routes[3]), "The Route does not match");
    // 	$this->assertTrue($this->router->match($this->route_4->getURL(), $this->routes[4]), "The Route does not match");
    // }

    /** @test */
    public function shouldReturnARouteNotFound()
    {
        $this->assertFalse($this->router->match($this->route_1->getURL(),$this->routes[4]),"The Route is Matched");
    }

      /** @test */
    public function shouldReturn3AsAParameter()
    {     
        $this->assertEquals(self::THREE_ELEMENTS, $this->router->match($this->route_1->getURL(),$this->routes[1])['id']);
    }

        /** @test */
    public function shouldReturn1AsAPost()
    {
        $this->assertEquals(self::ONE_ELEMENT, $this->router->match($this->route_2->getURL(),$this->routes[2])['id']);
    }

        /** @test */
    public function shouldReturnUnaCategoriaAndUnProductoWheURLisVariable()
    {
        $this->assertEquals(["category"=>"una_categoria", "product" =>"un_producto"], $this->router->match($this->route_3->getURL(),$this->routes[3]));
    }

           /** @test */
    public function shouldReturnUnProductoWhenURLisAFixedTag()
    {
        $this->assertEquals(["name"=>"un_producto"], $this->router->match($this->route_4->getURL(),$this->routes[4]));
    }
















}