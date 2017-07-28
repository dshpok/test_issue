<?php

namespace App;
error_reporting(E_ALL);

// for connect DB
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'scheduler');
//date format
define('DATE_FORMAT', 'Y-m-d H:i:s');


$sitePath = realpath(dirname(__FILE__) . DS);
define ('SITE_PATH', $sitePath);

defined('APPLICATION_PATH') ||
define('APPLICATION_PATH', realpath(dirname(__FILE__) . DS.'..'.DS.'app'));