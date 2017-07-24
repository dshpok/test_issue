<?php

class BaseRoute {

    public static function start() {
        // controller and action by default
        $controllerName = '';
        $actionName     = '';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // controllers name
        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }

        // action name
        if (!empty($routes[2])) {
            if(strpos($routes[2], '?') !== FALSE) {
                $info  = explode('?', $routes[2]);
                if(!empty($info[0])) {
                    $actionName = $info[0];
                }
            } else {
                $actionName = $routes[2];
            }
        }

        //if this the start page, '/'
        if(!$controllerName && !$actionName) {
            header('location:/main/start/');
            return;
        }
        // added class of controllers
        $controllerName = ucfirst($controllerName) . 'Controller';
        $controllerFile = $controllerName . '.php';
        $controllerPath = SITE_PATH ."/app/controllers/" . $controllerFile;

        if (file_exists($controllerPath)) {
            require_once SITE_PATH . "/app/controllers/" . $controllerFile;
        }
        else {
            self::ErrorPage404();
        }
        // create controller
        if(class_exists($controllerName)) {
            $controller = new $controllerName;
            $action     = $actionName;
        } else {
            self::ErrorPage404();
        }

        if (method_exists($controller, $action)) {
            // call to controller action
            $controller->$action();
        }
        else {
            self::ErrorPage404();
        }
    }


    private static  function ErrorPage404() {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        BaseView::generate('404.php');exit;
    }

}