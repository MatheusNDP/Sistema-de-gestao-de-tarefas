<?php
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Credentials: true"); 

require_once '../vendor/autoload.php';

use App\Controllers\TaskController;
use App\Controllers\UserController;
use App\Router\Router;

require_once '../src/config/database.php';

$router = new Router();

$userController = new UserController();
$taskController = new TaskController();

// Definindo as rotas para Usuários
$router->add('GET', '/users', [$userController, 'index']);
$router->add('GET', '/users/{id}', [$userController, 'show']);
$router->add('POST', '/users', [$userController, 'create']);
$router->add('PUT', '/users/{id}', [$userController, 'update']);
$router->add('DELETE', '/users/{id}', [$userController, 'delete']);

// Definindo as rotas para Tarefas
$router->add('GET', '/tasks/{id}', [$taskController, 'index']);
$router->add('GET', '/task/{id}', [$taskController, 'show']);
$router->add('POST', '/tasks', [$taskController, 'create']);
$router->add('PUT', '/tasks/{id}', [$taskController, 'update']);
$router->add('DELETE', '/tasks/{id}', [$taskController, 'delete']);

// Capturando o caminho da requisição
$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);

// Ajustando o caminho da requisição para garantir o redirecionamento para home.php se o caminho for '/'
if ($requestedPath === '/') {
    header("Location: /home.php");
    exit;
}
// print_r($pathItems);

// Construindo o caminho solicitado para roteamento
$requestedPath = "/" . ($pathItems[1] ?? '') . (!empty($pathItems[2]) ? "/" . $pathItems[2] : "");

// Despachando a rota solicitada
$router->dispatch($requestedPath);
