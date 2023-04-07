<?php

namespace App;

/**
 *
 */
class Router
{
    /**
     * @var array
     */
    private array $routes = [];

    /**
     * @param string $method
     * @param string $uri
     * @param callable $handler
     * @return void
     */
    public function addRoute(string $method, string $uri, callable $handler): void
    {
        $this->routes[$method][$uri] = $handler;
    }

    /**
     * @param string $method
     * @param string $uri
     * @return void
     */
    public function handleRequest(string $method, string $uri): void
    {
        $handler = null;

        foreach ($this->routes[$method] as $route => $routeHandler) {
            $pattern = preg_replace('#\{[^}]+\}#', '([^/]+)', $route);
            $pattern = "#^{$pattern}$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                $handler = function () use ($routeHandler, $matches) {
                    return $routeHandler(...$matches);
                };
                break;
            }
        }

        if ($handler) {
            $handler();
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Not found.']);
        }

    }
}
