<?php
namespace Router;

use Psr\Http\Message\RequestInterface;
use Router\Exceptions\RequestRouteNotFoundException;

class Router
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * Router constructor.
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * @param RequestInterface $request
     * @return Route
     * @throws RequestRouteNotFoundException
     */
    public function find(RequestInterface $request) : Route
    {
        /** @var Route $route */
        foreach ($this->routes as $route) {
            if (strtoupper($request->getMethod()) !== strtoupper($route->method())) {
                continue;
            }

            if ($route->isUriMatch($request->getUri())) {
                return $route;
            }
        }

        throw new RequestRouteNotFoundException(
            sprintf(
                'Request not found for: %s %s',
                $request->getMethod(),
                $request->getRequestTarget()
            )
        );
    }
}