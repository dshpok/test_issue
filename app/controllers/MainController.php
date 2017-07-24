<?php

class MainController extends BaseController {

    //start our application - check who came to us
    public function start() {
        AuthController::checkAuth();
    }


    public function getRegistrationForm() {
        BaseView::generate( 'registration.php');
    }

    public function getProfileForm() {
        BaseView::generate( 'userSchedulers.php');
    }


}