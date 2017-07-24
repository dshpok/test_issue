<?php

class BaseView {


    public static function generate($partialView, $info = NULL) {

        require_once SITE_PATH . '/../app/views/BaseTemplate.php';
    }

}