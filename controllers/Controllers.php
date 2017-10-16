<?php

namespace Controllers;


class Controllers
{
    public function getView($path)
    {
            $pathView = ROOT . "/views/{$path[0]}/{$path[1]}.php";
            if (is_file($pathView)){
                require $pathView;
            }else{
                require '/404.html';
            }

    }
}