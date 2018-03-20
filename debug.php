<?php

namespace php_rest;

$GLOBALS["debug"] = false;

// Simulate request in debug mode:
if (isset($argv[1]) && $argv[1] == 'debug') 
{
    $GLOBALS["debug"] = true;

    // Simulate method:
    $_SERVER['REQUEST_METHOD'] = 'PUT';

    $_REQUEST['version'] = 'v1';
    $_REQUEST['view'] = 'Example';
    $_REQUEST['api_key'] = 'localtest';
    $_REQUEST['token'] = '0acd0596ce9a6ed7fbcdff663b3be726e566ba36'; // Generate like this: sha1($apiKey . $secret . (gmdate("U")))

    // Sample data:
    $_REQUEST['data'] = json_encode([
        "firstname" => "Alice",
        "lastname" => "Cooper",
        "job" => "Singer",
    ]);
}


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

$filesHandler = new FilesController();
$controller = new OutputController($filesHandler);

$controller->handleRequest(new RequestController(), new ResponseController());