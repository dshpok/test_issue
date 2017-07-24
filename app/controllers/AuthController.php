<?php


class AuthController extends BaseController {

    private $user;

    /*
     * check is authorized user or no
     */
    public static function isAuth() {
        if(!empty($_COOKIE['isAuthUser'])) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * if user is authorized redirect to his profile, else - redirect to login
     */
    public static function checkAuth() {
        if (self::isAuth()) {
            header('location:/auth/userSchedulers/');
        }
        else {
            header('location:/auth/getLoginForm/');
        }
    }

    public function getLoginForm() {
        if(self::isAuth()) {
            header('location:/auth/userSchedulers/');
        }
        BaseView::generate( 'loginForm.php');
    }

    /*
     * login the our users
     */
    public function login() {

        $result = [];
        if(!empty($_POST['email']) && !empty($_POST['password'])) {
            $email    = UtilsController::clean($_POST['email']);
            $passwordInput = UtilsController::clean($_POST['password']);
            $this->user = MainModel::login($email);

            if($this->user
               && password_verify($passwordInput, $this->user[0]['password'])) {

                setcookie('isAuthUser', $this->user[0]['id'],time()+60*60*24*30*365,'/');
                $result['success'] =  true;
                echo json_encode($result);
            } else {
                $result['error'] =  'This user is not credential !';
                echo json_encode($result);
            }
        } else {
            header('location:/auth/getLoginForm/');
            return;
        }
    }

    public function logout() {

        setcookie('isAuthUser', null, -1, '/');
        session_destroy();
        header('location:/auth/getLoginForm/');
    }

    /*
     * get the info about user
     */
    public function userSchedulers() {
        if(empty($_COOKIE['isAuthUser'])) {
            header('location:/auth/getLoginForm/');
            return;
        }

        $id = $_COOKIE['isAuthUser'];

        if(!$id) {
            header('location:/auth/getLoginForm/');
            return;
        }
        $info            = OrganizerModel::getAllUserSchedule($id);
        $userInfo['all'] = $info;
        BaseView::generate('userSchedulers.php', $userInfo);
    }

    public function registration() {

        if(empty($_POST['email'])
          || empty($_POST['password']
          || !$this->_validateEmail($_POST['email']))
        ) {
            header('location:/auth/getRegistrationForm/');
            return;
        }

        $email      = trim($_POST['email']);
        $password   = trim($_POST['password']);

        //if exists user - return;
        if($this->checkExistsUser($email)) {
            return;
        }

        $this->user = [
          'email'    => $email,
          'password' => $password,

                     ];


        $userId = MainModel::registration($this->user);
        setcookie('isAuthUser', $userId,time()+60*60*24*30*365,'/');
        header('location:/auth/userSchedulers');
    }

    public function getRegistrationForm() {
        if(self::isAuth()) {
            header('location:/auth/userSchedulers/');
        }
        BaseView::generate( 'registration.php');
    }


    public function checkExistsUser($email) {

        if(empty($email)){
            return;
        }


        $exists = MainModel::checkExistsUser($email);
        return $exists;

    }


    public function checkExistsUserForAjax() {

        if($this->checkExistsUser($_GET['email'])) {

            echo 'false';
        } else {

            echo 'true';
        }
    }

    private function _validateEmail($email) {
        return filter_var(trim($email), FILTER_VALIDATE_EMAIL);

    }

}