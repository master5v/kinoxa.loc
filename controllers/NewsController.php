<?php

namespace Controllers;

use Models\News;

class NewsController extends Controllers
{
    public function indexAction()
    {

//      $data =  News::getNewsList();
//      debug($data);
    }

    public function viewAction($arr)
    {
//

        $data =   News::getNewsbyid($arr[0]);
        debug($data);
    }
}