<?php

namespace Components;


class Db
{
    public static function getConnection(){

        $dsn = 'mysql:dbname=tests;host=localhost';
        $user = 'root';
        $password = '';
        $opt = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC

        );

        try {
            return new \PDO($dsn, $user, $password,  $opt);
        } catch (\PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }

    }

}