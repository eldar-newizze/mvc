<?php


namespace Core;


class DB
{
    private static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = self::getData();
        }
        return self::$instance;
    }

    private static function getData()
    {
        $host = 'localhost';
        $db   = 'academy_mvc';
        $user = 'root';
        $pass = 'root';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            return new \PDO($dsn, $user, $pass, $opt);
        } catch (\PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }

    }
}
