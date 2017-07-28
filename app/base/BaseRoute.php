<?php
namespace  App\base;

use App\controllers\AuthController;
use App\controllers\MainController;
use App\controllers\ScheduleController;
use App\controllers\UtilsController;

class BaseRoute {

    const CONTROLLER_NAMESPACE = 'App\controllers\\';

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
        $controllerPath = SITE_PATH .DS.'..'.DS.'app'.DS.'controllers'.DS. $controllerFile;
        $controllerNameWithNamespace = self::CONTROLLER_NAMESPACE.$controllerName;
        if (!file_exists($controllerPath)) {
            self::ErrorPage404();

        }

        // create controller
        if(class_exists($controllerNameWithNamespace)) {
            $controller = new $controllerNameWithNamespace;
            $action     = $actionName;

            if (method_exists($controller, $action)) {
                //var_dump(method_exists($actionName));exit;
                // call to controller action
                $controller->$action();
            }
            else {
                self::ErrorPage404();
            }
        } else {
            self::ErrorPage404();
        }

    }


    private static  function ErrorPage404() {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        BaseView::generate('404.php');exit;
    }

}