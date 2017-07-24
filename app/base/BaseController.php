<?php

class BaseController {

    public static $config = [];


    public static function setConfig($param, $value) {
        if(!$param || !$value) {
            return;
        }
        self::$config[$param] = $value;
    }

    public static function getConfig($param) {
        if (!$param) {
            return;
        }
        return !empty(self::$config[$param]) ? self::$config[$param] : '';
    }
}