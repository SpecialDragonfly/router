<?php
namespace Router;

use Psr\Http\Message\UriInterface;

final class Route
{
    /**
     * @var string
     */
    private $method = '';
    /**
     * @var string
     */
    private $regex;
    /**
     * @var callable
     */
    private $callable;
    /**
     * @var string
     */
    private $action;

    /**
     * Route constructor.
     * @param string   $method
     * @param string   $regex
     * @param callable $callable
     * @param string   $action
     */
    private function __construct(string $method, string $regex, callable $callable, string $action)
    {
        $this->method = $method;
        $this->regex = $regex;
        $this->callable = $callable;
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function method() : string
    {
        return $this->method;
    }

    /**
     * @param UriInterface $uri
     * @return bool
     */
    public function isUriMatch(UriInterface $uri) : bool
    {
        $result = preg_match(
            $this->regex,
            $uri->getPath().(!empty($uri->getQuery()) ? '?' . $uri->getQuery() : '')
        );

        return $result === 1;
    }

    /**
     * @return callable
     */
    public function controller() : callable
    {
        return $this->callable;
    }

    /**
     * @return string
     */
    public function action() : string
    {
        return $this->action;
    }

    /**
     * @param string   $regex
     * @param callable $callable
     * @param string   $action
     * @return Route
     */
    public static function get(string $regex, callable $callable, string $action) : self
    {
        return new self('GET', $regex, $callable, $action);
    }

    /**
     * @param string   $regex
     * @param callable $callable
     * @param string   $action
     * @return Route
     */
    public static function post(string $regex, callable $callable, string $action) : self
    {
        return new self('POST', $regex, $callable, $action);
    }

    /**
     * @param string   $regex
     * @param callable $callable
     * @param string   $action
     * @return Route
     */
    public static function put(string $regex, callable $callable, string $action) : self
    {
        return new self('PUT', $regex, $callable, $action);
    }

    /**
     * @param string   $regex
     * @param callable $callable
     * @param string   $action
     * @return Route
     */
    public static function delete(string $regex, callable $callable, string $action) : self
    {
        return new self('DELETE', $regex, $callable, $action);
    }
}