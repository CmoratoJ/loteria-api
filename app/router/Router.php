<?php

namespace app\router;

class Router
{
    private $routes = [];

    public function add($route, $callback) {
        $this->routes[$route] = $callback;
    }

    public function dispatch($requestedRoute) {
        foreach ($this->routes as $route => $callback) {
            if ($route === $requestedRoute) {
                $response = call_user_func($callback);
                echo $response;
                return;
            }
        }
        header("HTTP/1.0 404 Not Found");
        echo json_encode(['error' => 'Route not found']);
    }
}
