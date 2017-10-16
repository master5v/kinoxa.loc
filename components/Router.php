<?php

namespace Components;

class Router
{
    private $routes = array(
        '^([a-z]+)$' => '$1/index',
        '^([a-z]+)/([0-9]+)' => '$1/view/$2',
        '^$' => 'main/index',
    );

//    public function __construct()
//    {
//        $routsPath = ROOT . '/config/routes.php';
//        $this->routes = include($routsPath);
//    }


    public function run($uri)
    {

        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {

                $route = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/', $route);
                $pathView = $segments;
                $controllerName = "controllers\\" . ucfirst(array_shift($segments)) . "Controller";
                $actionName = array_shift($segments) . "Action";


                if (class_exists($controllerName)) {
                    $cObj = new $controllerName;
                    if (method_exists($cObj, $actionName)) {
                        $cObj->$actionName($segments);
                        $cObj->getView($pathView);

                    } else {
                        include "404.html";
                    }

                } else {
                    include "404.html";
                }


//

//
//                $obj = new $controllerName;
//
//                $result = call_user_func_array(array($obj,$actionName),$segments);
//
//                if ($result != NULL) {
//                    break;
//                }


            }


        }


    }

}