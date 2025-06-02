<?php
namespace App;

class Route
{
    private $routes = [];

    public function addRoute($method = "GET", $path = "/", $handle = null)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path'   => rtrim($path, "/"),
            'handle' => $handle
        ];
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                $handle = $route['handle'];

                if (is_callable($handle)) {
                    call_user_func($handle);
                } elseif (is_array($handle)) {
                    if (!class_exists($handle[0])) {
                        die("Class {$handle[0]} not found!");
                    }

                    $controller = new $handle[0];
                    $methodName = $handle[1];

                    if (method_exists($controller, $methodName)) {
                        $controller->$methodName();
                    } else {
                        die("Method {$methodName} not found in " . get_class($controller));
                    }
                }

                return;
            }
        }

        http_response_code(404);
        view('404.php');
    }
}
