<?php

require_once '../vendor/autoload.php';

use App\Controllers\TaskController;
use App\Controllers\UserController;
use App\Router\Router;




require_once './config/db.php';
header("Content-type: application/json; charset=UTF-8");
$router = new Router();

$userController = new UserController();
$taskController = new TaskController();

$router->add('GET', '/users', [$userController, 'index']);
$router->add('GET', '/users/{id:\d+}', [$userController, 'show']);
$router->add('POST', '/users', [$userController, 'create']);
$router->add('PUT', '/users/{id:\d+}', [$userController, 'update']);
$router->add('DELETE', '/users/{id:\d+}', [$userController, 'delete']);


$router->add('GET', '/tasks', [$taskController, 'index']);
$router->add('GET', '/tasks/{id:\d+}', [$taskController, 'show']);
$router->add('POST', '/tasks', [$taskController, 'create']);
$router->add('PUT', '/tasks/{id:\d+}', [$taskController, 'update']);
$router->add('DELETE', '/tasks/{id:\d+}', [$taskController, 'delete']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);

$requestedPath = "/" . ($pathItems[3] ?? '') . (!empty($pathItems[4]) ? "/" . $pathItems[4] : "");


$router->dispatch($requestedPath);
