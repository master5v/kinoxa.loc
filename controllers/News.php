<?php


class News
{
    public function indexAction(){

        echo __METHOD__."  NewsController -> actionIndex()";

        return true;
    }
    public function viewAction($arr){
        debug($arr);

        echo __METHOD__."  NewsController -> view() ---- ".$arr[0];

        return true;
    }
}