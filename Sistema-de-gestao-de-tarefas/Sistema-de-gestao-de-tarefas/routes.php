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
} elseif ($method == 'GET' && $uri == '/users/create') {
    // Exibir formulário para criar um novo usuário
    (new UserController())->create();
} elseif ($method == 'POST' && $uri == '/users') {
    // Processar criação de um novo usuário
    (new UserController())->create();
} elseif ($method == 'GET' && preg_match('/\/users\/(\d+)\/edit/', $uri, $matches)) {
    // Exibir formulário de edição de um usuário
    $userId = $matches[1];
    (new UserController())->update($userId);
} elseif ($method == 'POST' && preg_match('/\/users\/(\d+)/', $uri, $matches)) {
    // Processar atualização de um usuário
    $userId = $matches[1];
    (new UserController())->update($userId);
} elseif ($method == 'DELETE' && preg_match('/\/users\/(\d+)/', $uri, $matches)) {
    // Deletar um usuário pelo ID
    $userId = $matches[1];
    (new UserController())->delete($userId);
}

// Mapeamento de rotas manual para Tarefas
elseif ($method == 'GET' && $uri == '/tasks') {
    // Listar todas as tarefas
    (new TaskController())->index();
} elseif ($method == 'GET' && $uri == '/tasks/create') {
    // Exibir formulário para criar uma nova tarefa
    (new TaskController())->create();
} elseif ($method == 'POST' && $uri == '/tasks') {
    // Processar criação de uma nova tarefa
    (new TaskController())->create();
} elseif ($method == 'GET' && preg_match('/\/tasks\/(\d+)\/edit/', $uri, $matches)) {
    // Exibir formulário de edição de uma tarefa
    $taskId = $matches[1];
    (new TaskController())->update($taskId);
} elseif ($method == 'POST' && preg_match('/\/tasks\/(\d+)/', $uri, $matches)) {
    // Processar atualização de uma tarefa
    $taskId = $matches[1];
    (new TaskController())->update($taskId);
} elseif ($method == 'DELETE' && preg_match('/\/tasks\/(\d+)/', $uri, $matches)) {
    // Deletar uma tarefa pelo ID
    $taskId = $matches[1];
    (new TaskController())->delete($taskId);
} else {
    // Se nenhuma rota for encontrada, retorna uma mensagem de erro 404
    http_response_code(404);
    echo "Rota não encontrada!";
}
