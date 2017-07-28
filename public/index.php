<?php
session_start();

use App\base\BaseRoute;


define ('DS', DIRECTORY_SEPARATOR);
//config file
require_once __DIR__ . DS.'..'.DS.'app'.DS.'config.php';
require_once __DIR__ . DS.'..'.DS.'vendor'.DS.'autoload.php';

BaseRoute::start();
