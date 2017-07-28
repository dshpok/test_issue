<?php

namespace  App\controllers;

use App\base\BaseController;


class UtilsController extends BaseController {


    public static function clean($text) {
        if(!$text) {
           return;
        }
        return (htmlspecialchars(trim($text)));
    }


}