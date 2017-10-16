<?php

namespace Controllers;


use Models\Main;

class MainController extends Controllers
{
    public function indexAction(){
//        echo __METHOD__;
        $data = Main::indexAction();
//        require ROOT . "/views/main/index.php";
    }

}