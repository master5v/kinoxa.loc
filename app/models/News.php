<?php

namespace app\models;
use app\components\Db;

class News
{
    public static function getNewsList(){

        $db = Db::getConnection();

       $result = $db->query('SELECT * FROM news ')->fetchAll();
        return $result;
//        $data = [];
//
//        for($i = 0; $row = $result->fetch(); $i++){
//            $data[$i]['id'] = $row['id'];
//            $data[$i]['name'] = $row['name'];
//            $data[$i]['description'] = $row['description'];
//        }
//        return $data;
    }

    public static function getNewsbyid($id){

 $db= Db::getConnection();

        $result = $db->query("SELECT * FROM news WHERE id = $id");


        return $result->fetch();


    }
}