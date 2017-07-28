<?php
namespace  App\base;

class BaseModel {

    private static $_instance = NULL;


    private function __construct() {}
    private function __clone() {}


    public static function getInstance() {

        if(self::$_instance === NULL) {

            $options = array(
              \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
              \PDO::ATTR_PERSISTENT => true
            );
            try {
                self::$_instance = new \PDO(
                  "mysql:host=" .DB_HOST .
                  ";dbname=" . DB_NAME,
                  DB_USER,
                  DB_PASS,
                  $options);
                self::$_instance->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
            }
            catch(\PDOException $e) {
                echo 'Connection Error ' . $e->getMessage();
            }
        }
        return self::$_instance;
    }

}