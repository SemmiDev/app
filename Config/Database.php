<?php

namespace Config;

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_NAME = 'app';
const DB_PASS = '';

class Database
{
    private static ?\PDO $pdo = null;
    private static ?\mysqli $mysqli = null;

    public static function getPDOConnection(): \PDO{
        if(self::$pdo == null){
            $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8'; 
            self::$pdo = new \PDO($dsn, DB_USER, DB_PASS);
            self::$pdo->setAttribute(\PDO::ATTR_PERSISTENT, true);
        }
        return self::$pdo;
    }

    public static function getMySQLiConnection(): \mysqli{
        if(self::$mysqli == null){
            self::$mysqli = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }
        return self::$mysqli;
    }

    public static function beginTransaction(){
        self::$pdo->beginTransaction();
    }

    public static function commitTransaction(){
        self::$pdo->commit();
    }

    public static function rollbackTransaction(){
        self::$pdo->rollBack();
    }
}