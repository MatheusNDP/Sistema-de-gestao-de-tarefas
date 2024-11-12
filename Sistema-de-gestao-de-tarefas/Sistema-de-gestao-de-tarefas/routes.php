<?php

// Carrega o autoload do Composer para garantir que todas as classes estão disponíveis
require_once __DIR__ . '/../../vendor/autoload.php';

use Mathe\SistemaDeGestaoDeTarefas\Controllers\UserController;
use Mathe\SistemaDeGestaoDeTarefas\Controllers\TaskController;

// Captura a URL e o método HTTP da requisição
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Mapeamento de rotas manual para Usuários
if ($method == 'GET' && $uri == '/users') {
    // Listar todos os usuários
    (new UserController())->index();
} elseif ($method == 'POST' && $uri == '/users') {
    // Criar um novo usuário
    (new UserController())->create($_POST);
} elseif ($method == 'GET' && preg_match('/\/users\/(\d+)/', $uri, $matches)) {
    // Mostrar um único usuário pelo ID
    $userId = $matches[1];
    (new UserController())->show($userId);
} elseif ($method == 'PUT' && preg_match('/\/users\/(\d+)/', $uri, $matches)) {
    // Atualizar um usuário pelo ID
    $userId = $matches[1];
    parse_str(file_get_contents("php://input"), $_PUT);
    (new UserController())->update($userId, $_PUT);
} elseif ($method == 'DELETE' && preg_match('/\/users\/(\d+)/', $uri, $matches)) {
    // Deletar um usuário pelo ID
    $userId = $matches[1];
    (new UserController())->delete($userId);
}

// Mapeamento de rotas manual para Tarefas
elseif ($method == 'GET' && $uri == '/tasks') {
    // Listar todas as tarefas
    (new TaskController())->index();
} elseif ($method == 'POST' && $uri == '/tasks') {
    // Criar uma nova tarefa
    (new TaskController())->create($_POST);
} elseif ($method == 'GET' && preg_match('/\/tasks\/(\d+)/', $uri, $matches)) {
    // Mostrar uma única tarefa pelo ID
    $taskId = $matches[1];
    (new TaskController())->show($taskId);
} elseif ($method == 'PUT' && preg_match('/\/tasks\/(\d+)/', $uri, $matches)) {
    // Atualizar uma tarefa pelo ID
    $taskId = $matches[1];
    parse_str(file_get_contents("php://input"), $_PUT);
    (new TaskController())->update($taskId, $_PUT);
} elseif ($method == 'DELETE' && preg_match('/\/tasks\/(\d+)/', $uri, $matches)) {
    // Deletar uma tarefa pelo ID
    $taskId = $matches[1];
    (new TaskController())->delete($taskId);
} else {
    // Se nenhuma rota for encontrada, retorna uma mensagem de erro 404
    http_response_code(404);
    echo "Rota não encontrada!";
}
