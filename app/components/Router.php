<?php
namespace app\components;

class Router
{
    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
               $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {
                $obj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']).'Action';
                if (method_exists($obj, $action)) {
                    $obj->$action();
                } else {
                    http_response_code(404);
                    echo ' metod РЅРµ РЅР°Р№РґРµРЅ';
                    include WWW . '/404.html';
                }
            } else {
                http_response_code(404);
                echo ' class РєР»Р°СЃСЃ РЅРµ РЅР°Р№РґРµРЅ';
                include WWW . '/404.html';
            }
        } else {
            http_response_code(404);
            include WWW . '/404.html';
        }
    }

    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    protected static function lowerCamelCase($name)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $name))));
    }

    protected static function removeQueryString($url){
        if ($url){
            $params = explode('?', $url, 2);
            if (false === strpos($params[0],'=')){
                return rtrim($params[0], '/');
            }else{
                return '';
            }
        }
    }
}