<?php
namespace Core\Config;

class Router
{

    private static String $routerUrl = '';

    private static array $routes = [];

    public static function get($url, $handler, $middleware = false): void
    {
        $url = self::$routerUrl . $url ?? '';
        self::$routes['GET'][$url] = [$handler, $middleware];
    }

    public static function post($url, $handler, $middleware = false): void
    {
        $url = self::$routerUrl . $url ?? '';
        self::$routes['POST'][$url] = [$handler, $middleware];
    }

    public static function put($url, $handler, $middleware = false): void
    {
        $url = self::$routerUrl . $url ?? '';
        self::$routes['PUT'][$url] = [$handler, $middleware];
    }
    public static function delete($url, $handler, $middleware = false): void
    {
        $url = self::$routerUrl . $url ?? '';
        self::$routes['DELETE'][$url] = [$handler, $middleware];
    }

    public static function resource($url, $handler, $middleware = false): void
    {
        self::get($url, $handler . '@index', $middleware);
        self::post($url, $handler . '@create', $middleware);
        self::get($url . '/{id}', $handler . '@show', $middleware);
        self::put($url . '/{id}', $handler . '@update', $middleware);
        self::delete($url . '/{id}', $handler . '@delete', $middleware);

    }

    public static function group($url, $callback) {
        self::$routerUrl = $url;
        call_user_func($callback);
    }

    public static function handle()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];

        $url = self::urlParser($url);

        foreach (self::$routes[$method] as $route => $handler) {
            $routeRegex = self::generateRouteRegex($route);
            if (preg_match($routeRegex, $url, $matches)) {
                array_shift($matches);
                return self::callHandler($handler, $matches);
            }
        }

        return '404 Not Found';
    }

    private static function urlParser($url)
    {
        if(stristr($url, '?')){
            //get var
            $exp = explode('?', $url);
            return $exp[0];
        }
        return $url;
    }

    private static function generateRouteRegex($route): string
    {
        $routeRegex = str_replace('/', '\/', $route);
        $routeRegex = preg_replace('/\{.*?\}/', '([^\/]+)', $routeRegex);
        return '/^' . $routeRegex . '$/';
    }

    private static function callHandler($handler, $matches)
    {
        //middleware kontrolu yap
        $middlewarePath = $_SERVER['DOCUMENT_ROOT'] . '/Core/Middlewares/' . $handler[1] . '.php';

        if(file_exists($middlewarePath)){
            $midllewareController = '\\Core\Middlewares\\' . $handler[1];
            $controller = new $midllewareController;
            echo call_user_func_array([$controller, 'index'], []);
        }

        $handlerParts = explode('@', $handler[0]);
        $controllerName = '\\Core\Controllers\\' . $handlerParts[0];
        $methodName = $handlerParts[1];
        $controller = new $controllerName;
        return call_user_func_array([$controller, $methodName], $matches);
    }
}
