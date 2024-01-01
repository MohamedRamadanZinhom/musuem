<?php

class Router
{
    private $routes = [];

    // Add a route
    public function addRoute($path, $handler)
    {
        $this->routes[$path] = $handler;
    }

    // Handle the request
    public function handleRequest($requestPath)
    {
        if (array_key_exists($requestPath, $this->routes)) {
            $handler = $this->routes[$requestPath];
            call_user_func($handler);
        } else {
            $this->handleNotFound();
        }
    }

    // Handle not found (404)
    private function handleNotFound()
    {
        include 'Views/404.php';
    }
}

?>
