<?php

class OrganizerModel {

    private static $_tableSchedulers = 'schedulers';
    private static $_table = 'users';


    public static function getAllUserSchedule($id) {

        if(!$id) {
            return false;
        }
        $sql = 'SELECT
                     sc.id,
                     sc.title,
                     sc.date_start,
                     sc.body,
                     sc.is_done,
                     sc.created_at
                       FROM '
          . self::$_table .' AS us '
          .' LEFT JOIN '.self::$_tableSchedulers.' AS sc
               ON us.id = sc.users_id  '

          .' WHERE us.id = ?
          ORDER BY sc.date_start ASC';
        try {
            $dbh = BaseModel::getInstance();
            $stm = $dbh->prepare($sql);
            $stm->bindParam(1, $id,PDO::PARAM_INT);
            $stm->execute();

            return $stm->fetchall(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            echo 'ERROR SELECT USER' . $e->getMessage();
        }
    }


    public static function getOneSchedule($id, $userId) {

        if(!$id) {
            return false;
        }
        $sql = 'SELECT *
                FROM '
          . self::$_tableSchedulers
          .' WHERE id = ? AND users_id = ?';

        try {
            $dbh = BaseModel::getInstance();
            $stm = $dbh->prepare($sql);
            $stm->bindParam(1, $id,PDO::PARAM_INT);
            $stm->bindParam(2, $userId,PDO::PARAM_INT);
            $stm->execute();

            return $stm->fetchall(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            echo 'ERROR SELECT SCHEDULER' . $e->getMessage();
        }
    }


    public static function addSchedule($params) { //var_dump($params);exit;
        if(!$params) {
            return false;
        }
//var_dump(($params));exit;

        $sql       = 'INSERT INTO ' . self::$_tableSchedulers .
          " (
            `title`,
            `body`,
            `users_id`,
            `date_start`,
            `is_done`
            )
             VALUES(?, ?, ?, ?, ?)";
        $dateStart = date('Y-m-d H:i:s', strtotime($params['date_start']) );
        $done      = 0;

        try {
            // $stm = BaseModel::getInstance()->insert($sql);
            $dbh = BaseModel::getInstance();
            $stm = $dbh->prepare($sql);
            $stm->bindParam(1, $params['title'], PDO::PARAM_STR);
            $stm->bindParam(2, $params['body'], PDO::PARAM_STR);
            $stm->bindParam(3, $params['user_id'], PDO::PARAM_INT);
            $stm->bindParam(4, $dateStart, PDO::PARAM_STR);
            $stm->bindParam(5, $done, PDO::PARAM_INT);
            return $stm->execute();

        } catch(PDOException $e) {
            echo 'ERROR TO ADD THE NEW SCHEDULE... SORRY, I am cry (((((' . $e->getMessage();
        }
    }


    public static function updateSchedule($params) {
        if(!$params) {
            return false;
        }

        $sql = 'UPDATE ' . self::$_tableSchedulers .
          ' SET `title` = ?,
          `body` = ?,
          `date_start` =?
           WHERE `id` = ?';
        $dateStart = date('Y-m-d H:i:s', strtotime($params['date_start']) );


        try {
            $stm = BaseModel::getInstance()->prepare($sql);
            $stm->bindParam(1, $params['title'],PDO::PARAM_STR);
            $stm->bindParam(2, $params['body'],PDO::PARAM_STR);
            $stm->bindParam(3, $dateStart,PDO::PARAM_STR);

            $stm->bindParam(4, $params['id'],PDO::PARAM_INT);
            return $stm->execute();
        }
        catch(PDOException $e) {
            echo 'ERROR TO UPDATE OLD SCHEDULE... SORRY ((((('.$e->getMessage();
        }
    }


    public static function deleteSchedule($id, $userId) {
        if(!$id
          || !$userId) {
            return false;
        }

        $sql = 'DELETE FROM ' . self::$_tableSchedulers

           .' WHERE `id` = ? AND `users_id` = ?';


        try {
            $stm = BaseModel::getInstance()->prepare($sql);
            $stm->bindParam(1, $id,PDO::PARAM_INT);
            $stm->bindParam(2, $userId,PDO::PARAM_INT);

            return $stm->execute();

        }
        catch(PDOException $e) {
            echo 'ERROR TO DELETE SCHEDULE... SORRY ((((('.$e->getMessage();
        }
    }


    public static function makeAsDoneSchedule($id, $userId) {
        if(!$id
          || !$userId) {
            return false;
        }

        $sql = 'UPDATE ' . self::$_tableSchedulers
          .' SET `is_done` = 1'
           .' WHERE `id` = ? AND `users_id` = ?';


        try {
            $stm = BaseModel::getInstance()->prepare($sql);
            $stm->bindParam(1, $id,PDO::PARAM_INT);
            $stm->bindParam(2, $userId,PDO::PARAM_INT);

           return $stm->execute();
        }
        catch(PDOException $e) {
            echo 'ERROR TO MAKE AS DONE SCHEDULE... SORRY ((((('.$e->getMessage();
        }
    }



}