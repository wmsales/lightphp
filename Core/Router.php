<?php

namespace Core;

class Router
{
    private static $routes = [];

    public static function get($uri, $action)
    {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post($uri, $action)
    {
        self::$routes['POST'][$uri] = $action;
    }

    public static function resolve()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $method = $_SERVER['REQUEST_METHOD'];

        //error_log("Resolving URI: $uri with method: $method");

        if (!isset(self::$routes[$method])) {
            //error_log("No routes defined for method: $method");
            self::loadErrorPage();
            return;
        }

        foreach (self::$routes[$method] as $route => $action) {
            // Modificación de la expresión regular para que funcione correctamente
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', trim($route, '/'));
            //error_log("Checking pattern: $pattern against URI: $uri");

            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches); // Elimina la coincidencia completa de los matches
                //error_log("Match found for route: $route, invoking action $action with params: " . implode(", ", $matches));
                return self::callAction($action, $matches);
            }
        }

        //error_log("No match found for URI: $uri, loading error page");
        self::loadErrorPage();
    }

    private static function callAction($action, $params = [])
    {
        list($controller, $method) = explode('@', $action);
        $controller = "\\App\\Controllers\\$controller";

        if (class_exists($controller) && method_exists($controller, $method)) {
            call_user_func_array([new $controller, $method], $params);
        } else {
            self::loadErrorPage();
        }
    }

    private static function loadErrorPage()
    {
        $controller = new \App\Controllers\Error();
        $controller->pageNotFound();
    }

    public static function loadRoutes()
    {
        require_once __DIR__ . '/../routes/web.php';
        require_once __DIR__ . '/../routes/api.php';
    }
}
