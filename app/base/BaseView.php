<?php
namespace  App\base;

class BaseView {


    public static function generate($partialView, $info = NULL) {

        require_once SITE_PATH . DS.'..'.DS.'app'.DS.'views'.DS.'BaseTemplate.php';
    }

}