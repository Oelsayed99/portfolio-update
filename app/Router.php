<?php

namespace app;

class Router
{
    protected $routes = [];

    /**
     * Add a route to the routing table
     */
    public function add($url, $controller, $action)
    {
        $this->routes[$url] = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    /**
     * Dispatch the request
     */
    public function dispatch($url)
    {
        // Remove trailing slashes and sanitize
        $url = trim($url, '/');

        if (array_key_exists($url, $this->routes)) {
            $controllerName = $this->routes[$url]['controller'];
            $action = $this->routes[$url]['action'];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $action)) {
                    $controller->$action();
                } else {
                    $this->abort(404, "Action '$action' not found in controller '$controllerName'");
                }
            } else {
                $this->abort(404, "Controller '$controllerName' not found");
            }
        } else {
            $this->abort(404, "Route '$url' not found");
        }
    }

    protected function abort($code, $message = "")
    {
        http_response_code($code);
        echo "<h1>$code Error</h1>";
        echo "<p>$message</p>";
        exit;
    }
}
