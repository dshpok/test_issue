<?php

namespace  App\models;

use App\base\BaseModel;

class MainModel {

    private static $_table = 'users';
    private static $_tableShedulers = 'schedulers';


    public static function login($login) {
        if(!$login) {
            return;
        }

        $sql = 'SELECT * FROM '
               . self::$_table .
               ' WHERE email = ?
                ';
        try {
            $dbh = BaseModel::getInstance();
            $stm = $dbh->prepare($sql);
            $stm->bindParam(1, $login,\PDO::PARAM_STR);
            $stm->execute();

            return $stm->fetchall(\PDO::FETCH_ASSOC);
        }
        catch(\PDOException $e) {
            echo 'ERROR LOGIN USER' . $e->getMessage();
        }
    }



    public static function checkExistsUser($login) {
    if(!$login) {
        return;
    }

    $sql = 'SELECT * FROM '
      . self::$_table .
      ' WHERE `email` = ?
                ';
    try {
        $stm = BaseModel::getInstance()->prepare($sql);
        $stm->bindParam(1, $login,\PDO::PARAM_STR);
        $stm->execute();
        return $stm->fetchall(\PDO::FETCH_ASSOC);
    }
    catch(\PDOException $e) {
        echo 'ERROR CHECK EXISTS  USER' . $e->getMessage();
    }
}


    public static function registration($params) {
        if(!$params) {
            return;
        }

        $pass =  password_hash( $params['password'], PASSWORD_BCRYPT );

        $sql = 'INSERT INTO '.  self::$_table.
            " (
            `email`,
            `password`
            )
             VALUES(?, ?)";

        try {
            $dbh = BaseModel::getInstance();
            $stm = $dbh->prepare($sql);
            $stm->bindParam(1, $params['email'],\PDO::PARAM_STR);
            $stm->bindParam(2, $pass,\PDO::PARAM_STR);
            $stm->execute();
            return $dbh->lastInsertId();
        }
        catch(\PDOException $e) {
            echo 'ERROR TO ADD THE NEW USER'.$e->getMessage();
        }
    }

}