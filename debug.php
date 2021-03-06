<?php

namespace php_rest;


// Simulate method:
$_SERVER['REQUEST_METHOD'] = 'GET';

// Simulate Login:
$_SERVER['PHP_AUTH_USER'] = 'localtest';
$_SERVER['PHP_AUTH_PW'] = 'secret';

$_REQUEST['version'] = 'v1';
$_REQUEST['view'] = 'Example';
// $_REQUEST['uid'] = '2';

// Sample data:
$_REQUEST['name'] = "Jason Whittaker";
$_REQUEST['age'] = 36;
$_REQUEST['city'] = "Capetown";
$_REQUEST['country'] = "Southafrica";


function autoloader($class)
{
    $class = str_replace(__NAMESPACE__ . '\\', '', $class); // Windows
    $class = str_replace(__NAMESPACE__ . '/', '', $class); // Linux
    $class = str_replace("\\", "/", $class);
    require_once $class . '.php';
}

spl_autoload_register(__NAMESPACE__ . '\autoloader');

use php_rest\src\controller\FilesController;
use php_rest\src\controller\RequestController;
use php_rest\src\controller\ResponseController;
use php_rest\src\controller\OutputController;

include("settings.php");

$filesHandler = new FilesController();
$controller = new OutputController($filesHandler);

$controller->handleRequest(new RequestController(), new ResponseController());
