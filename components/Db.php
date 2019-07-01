<?php

    class Db
    {
        public static function getConnection()
        {
            $paramsPath = ROOT.'/config/db_params.php';
            $params = include($paramsPath);

            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $link = new PDO($dsn, $params['user'], $params['pass']);

            $link->exec('set names utf8');

            return $link;
        }
    }