<?php

require_once 'core/App.php';
require_once 'core/Controller.php';


//App Config
define("ROOT", realpath(dirname(__FILE__) . "/../") . "/");

define("APP_NAME", "NumAX");
define("APP_ROOT", ROOT . "app/");
define("APP_PROTOCOL", stripos($_SERVER["SERVER_PROTOCOL"], "https") === true ? "https://" : "http://");
define("APP_CONFIG_FILE", APP_ROOT . "config.php");

// Public Config
define("PUBLIC_ROOT", ROOT . "public_html/");

// Controller Config
define("CONTROLLER_PATH", '\app\controllers\\');
define("DEFAULT_CONTROLLER", CONTROLLER_PATH . "Index");
define("DEFAULT_CONTROLLER_ACTION", "index");

// View Config
define("VIEW_PATH", "..\app\\views\\");
define("DEFAULT_404_PATH", "404.php");
