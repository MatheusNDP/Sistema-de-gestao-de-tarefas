
<?php

require_once '../vendor/autoload.php';

use FastRoute\RouteCollector;
use Mathe\SistemaDeGestaoDeTarefas\Controllers\UserController;
use Mathe\SistemaDeGestaoDeTarefas\Controllers\TaskController;

$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
    $userController = new UserController();
    $taskController = new TaskController();

    // Rotas para Usuários
    $r->addRoute('GET', '/users', [$userController, 'index']);
    $r->addRoute('GET', '/users/{id:\d+}', [$userController, 'show']);
    $r->addRoute('POST', '/users', [$userController, 'create']);
    $r->addRoute('PUT', '/users/{id:\d+}', [$userController, 'update']);
    $r->addRoute('DELETE', '/users/{id:\d+}', [$userController, 'delete']);

    // Rotas para Tarefas
    $r->addRoute('GET', '/tasks', [$taskController, 'index']);
    $r->addRoute('GET', '/tasks/{id:\d+}', [$taskController, 'show']);
    $r->addRoute('POST', '/tasks', [$taskController, 'create']);
    $r->addRoute('PUT', '/tasks/{id:\d+}', [$taskController, 'update']);
    $r->addRoute('DELETE', '/tasks/{id:\d+}', [$taskController, 'delete']);
});

// Captura a URI da requisição
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Remove query string da URI, se existir
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Processa o roteamento
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "Rota não encontrada";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo "Método não permitido";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        call_user_func_array($handler, $vars);
        break;
}
