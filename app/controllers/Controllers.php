<?php

namespace app\controllers;


use app\components\Router;

abstract class Controllers
{
    public $route;
    public function __construct($route)
    {
        $this->route = $route;
    }

    public function getView($path)
    {
//            $pathView = ROOT . "/views/{$path[0]}/{$path[1]}.php";
//            if (is_file($pathView)){
//                require $pathView;
//            }else{
//                require '/404.html';
//            }

    }
}