<?php


namespace Core;

use Helper\Inflect;

class Model extends DB
{
    protected static $tableName = '';

    private static $pdo;

    private static function base()
    {
        //позднее статическое связывание
        $c = static::$tableName;
        $c1 = self::$tableName;

        self::$pdo = DB::getInstance();

        $fullParentClass = explode('\\', get_called_class());
        return static::$tableName != ''
            ? static::$tableName
            : lcfirst($fullParentClass[count($fullParentClass) - 1]);
    }

    public static function all()
    {
        $tableName = self::base();
        $stmt = self::$pdo->query('SELECT * FROM '.$tableName);
        $row = $stmt->fetch();
        return 'asdfadsf';
    }

    public static function first()
    {
        $tableName = self::base();
        $tableName = Inflect::pluralize($tableName);
        $data = self::$pdo->query("SELECT name FROM $tableName order by id ASC limit 1")->fetchAll(\PDO::FETCH_COLUMN);
        return $data[0] ?? null;
    }
}
