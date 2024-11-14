<?php

namespace App\Controllers;

use App\Config\database;
use App\Models\task;

class TaskController
{
    private $db;

    public function __construct()
    {
        $this->db = (new database())->connect();
    }

    public function index($userId = null)
    {
        $task = new task($this->db);
        $tasks = $task->getAllByUserId($userId);

        include __DIR__ . '/../../views/tasks/list.php';
    }

    // Método para carregar o formulário de criação e salvar uma nova tarefa
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $task = new Task($this->db);
            $task->setTitle($data['titulo']);
            $task->setDescription($data['descricao']);
            $task->setStatus($data['status']);
            $task->setUserId($data['usuario_id']); // Certifique-se de que 'usuario_id' está sendo passado

            if ($task->save()) {
                header("Location: /tasks"); // Redireciona para a lista de tarefas
                exit;
            } else {
                echo "Erro ao criar tarefa.";
            }
        } else {
            // Carregar o formulário de criação de tarefa
            include __DIR__ . '/../../views/tasks/create.php';
        }
    }

    // Método para carregar o formulário de edição e atualizar uma tarefa existente
    public function update($taskId)
    {
        $task = new Task($this->db);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $task->setTitle($data['titulo']);
            $task->setDescription($data['descricao']);
            $task->setStatus($data['status']);

            if ($task->update($taskId)) {
                header("Location: /tasks"); // Redireciona para a lista de tarefas
                exit;
            } else {
                echo "Erro ao atualizar tarefa.";
            }
        } else {
            // Carregar a tarefa para exibir no formulário de edição
            $taskData = $task->getById($taskId);
            include __DIR__ . '/../../views/tasks/edit.php';
        }
    }

    // Método para mostrar uma única tarefa (opcional)
    public function show($taskId)
    {
        $task = new Task($this->db);
        $taskData = $task->getById($taskId);

        if ($taskData) {
            echo "ID: {$taskData['id']} - Título: {$taskData['titulo']} - Descrição: {$taskData['descricao']} - Status: {$taskData['status']}";
        } else {
            echo "Tarefa não encontrada.";
        }
    }

    // Método para deletar uma tarefa
    public function delete($taskId)
    {
        $task = new Task($this->db);

        if ($task->delete($taskId)) {
            header("Location: /tasks"); // Redireciona para a lista de tarefas
            exit;
        } else {
            echo "Erro ao deletar tarefa.";
        }
    }
}
