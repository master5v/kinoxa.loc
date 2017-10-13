<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routsPath = ROOT . '/config/routes.php';
        $this->routes = include($routsPath);
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
//           echo $uri . '<br>';

            if (preg_match("~$uriPattern~", $uri)) {


                $route = preg_replace("~$uriPattern~",$path, $uri);
                debug($route);
                $segments = explode('/', $route);
                $controllerName = ucfirst(array_shift($segments));
                $actionName =  array_shift($segments) . "Action";

                $filePath = ROOT . "/controllers/" . $controllerName . ".php";
                if (file_exists($filePath)) {
                    include_once($filePath);
                }else{
                    include "404.html";
                    die();
                }

                debug($controllerName);
                debug($actionName);


                if (class_exists($controllerName)){
                    $cObj = new $controllerName;
                    if (method_exists($cObj, $actionName)){
                        $cObj->$actionName($segments);

                    }else{
                        include "404.html";
                        die();
                    }

                }else{
                    include "404.html";
                    die();
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