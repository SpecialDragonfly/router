<?php
namespace Router;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RouteManager
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @param Router $router Router instance to manage routes
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws Exceptions\RequestRouteNotFoundException
     */
    public function routeRequest(ServerRequestInterface $request): ResponseInterface
    {
        $route = $this->router->find($request);
        $controller = $route->controller()();

        $action = $route->action();

        return $controller->$action($request);
    }
}