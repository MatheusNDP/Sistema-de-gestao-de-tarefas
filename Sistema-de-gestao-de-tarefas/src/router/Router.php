<?php


namespace App\Router;

header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Credentials: true"); 
class Router
{
    private $routes = [];

    public function add($method, $path, $callback)
    {
        $path = preg_replace('/\{(\w+)\}/', '(\d+)', $path);
        $this->routes[] = ['method' => $method, 'path' => "#^" . $path . "$#", 'callback' => $callback];
    }

    public function dispatch($requestedPath)
    {
        $requestedMethod = $_SERVER["REQUEST_METHOD"];

        
       
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestedMethod && preg_match($route['path'], $requestedPath, $matches)) {
                array_shift($matches);
                return call_user_func($route['callback'], $matches);
            }
        }
        echo "404 - Página não encontrada";
    }
}