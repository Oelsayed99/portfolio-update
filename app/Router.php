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

        foreach ($this->routes as $routeUrl => $routeData) {
            $pattern = preg_replace('/:[a-zA-Z0-9_]+/', '([^/]+)', $routeUrl);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                $controllerName = $routeData['controller'];
                $action = $routeData['action'];

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $action)) {
                        call_user_func_array([$controller, $action], $matches);
                        return;
                    } else {
                        self::abort(404, "Action '$action' not found in controller '$controllerName'");
                    }
                } else {
                    self::abort(404, "Controller '$controllerName' not found");
                }
            }
        }

        self::abort(404, "Route '$url' not found");
    }

    /**
     * Not-found page. $message is for logs only: it can contain the requested URL,
     * so it is never echoed into the page.
     */
    public static function abort($code = 404, $message = "")
    {
        http_response_code($code);
        if ($message) error_log("[$code] $message");
        $active_page = '404';
        $seo = ['noindex' => true];
        require VIEW_PATH . '/404.php';
        exit;
    }
}
