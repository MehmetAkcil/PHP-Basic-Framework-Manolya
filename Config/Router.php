<?php

class Router
{
    private Array $routes = [];

    public function get($url, $handler, $middleware = false): void
    {
        $this->routes['GET'][$url] = [$handler, $middleware];
    }

    public function post($url, $handler, $middleware = false): void
    {
        $this->routes['POST'][$url] = [$handler, $middleware];
    }

    public function put($url, $handler, $middleware = false): void
    {
        $this->routes['PUT'][$url] = [$handler, $middleware];
    }
    public function delete($url, $handler, $middleware = false): void
    {
        $this->routes['DELETE'][$url] = [$handler, $middleware];
    }

    public function resource($url, $handler, $middleware = false): void
    {
        $this->get($url, $handler . '@index', $middleware);
        $this->post($url, $handler . '@create', $middleware);
        $this->get($url . '/{id}', $handler . '@show', $middleware);
        $this->put($url . '/{id}', $handler . '@update', $middleware);
        $this->delete($url . '/{id}', $handler . '@delete', $middleware);

    }

    public function handle()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];

        foreach ($this->routes[$method] as $route => $handler) {
            $routeRegex = $this->generateRouteRegex($route);
            if (preg_match($routeRegex, $url, $matches)) {
                array_shift($matches);
                return $this->callHandler($handler, $matches);
            }
        }

        return '404 Not Found';
    }

    private function generateRouteRegex($route): string
    {
        $routeRegex = str_replace('/', '\/', $route);
        $routeRegex = preg_replace('/\{.*?\}/', '([^\/]+)', $routeRegex);
        return '/^' . $routeRegex . '$/';
    }

    private function callHandler($handler, $matches)
    {
        //middleware kontrolu yap
        $middlewarePath = $_SERVER['DOCUMENT_ROOT'] . '/Middlewares/' . $handler[1] . '.php';

        if(file_exists($middlewarePath)){
            include $middlewarePath;
            $controller = new $handler[1];
            echo call_user_func_array([$controller, 'index'], []);
        }

        $handlerParts = explode('@', $handler[0]);
        $controllerName = $handlerParts[0];
        $methodName = $handlerParts[1];
        $controllerFolderPath = $_SERVER['DOCUMENT_ROOT'] . '/Controllers/';
        include $controllerFolderPath . $controllerName . '.php';
        $controller = new $controllerName;
        return call_user_func_array([$controller, $methodName], $matches);
    }
}


$router = new Router();

$router->resource('/user', 'UserController', 'AuthMiddleware');
$router->get('/', 'HomeController@index');

echo $router->handle();