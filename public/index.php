<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use app\components\Router;

define('WWW', __DIR__);
define('ROOT',dirname(__DIR__));
define('APP',ROOT . '/app');

require_once ROOT . "/app/components/functions.php";

$uri = trim($_SERVER['REQUEST_URI'], '/');

spl_autoload_register(function ($class){
    $path = ROOT . '/' . str_replace('\\','/',$class) . '.php';
    if (is_file($path)){
        require $path;
    }else{
        http_response_code(404);
        echo 'dsf';
//        include "404.html";
    }
});

//Router::add('^page/?(?P<alias>[a-z-]+)?$', ['controller' => 'Page', 'action' =>'view']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
Router::add('^$',['controller' => 'Main', 'action' =>'index']);

Router::dispatch($uri);