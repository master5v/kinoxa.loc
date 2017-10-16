<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require_once ROOT . "/components/functions.php";

$uri = trim($_SERVER['REQUEST_URI'], '/');

//spl_autoload_extensions(".php");
//spl_autoload_register();
spl_autoload_register(function ($class){
    $path = ROOT . '/' . str_replace('\\','/',$class) . '.php';
    if (is_file($path)){
        require $path;
    }else{
        http_response_code(404);
//        echo 'dsf';
        include "/404.html";
    }
//
});



$router = new Components\Router();
$router->run($uri);