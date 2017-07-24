<?php

define ('DS', DIRECTORY_SEPARATOR);
$sitePath = realpath(dirname(__FILE__) . DS);
define ('SITE_PATH', $sitePath);

defined('APPLICATION_PATH') ||
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));
//var_dump(APPLICATION_PATH);exit;
set_include_path(implode(PATH_SEPARATOR, array(
  APPLICATION_PATH . '/controllers',
  APPLICATION_PATH . '/models',
  APPLICATION_PATH . '/views',
  get_include_path()
)));

require_once '../app/bootstrap.php';