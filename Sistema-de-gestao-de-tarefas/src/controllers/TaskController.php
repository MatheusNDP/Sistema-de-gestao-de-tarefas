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

    public function index($userId)
    {
        $task = new task($this->db);
        $tasks = $task->getAllByUserId($userId[0]);
        echo json_encode(value: $tasks);

    }

    
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));
            $task = new Task($this->db);
            $task->setTitle($data->titulo);
            $task->setDescription($data->descricao);
            $task->setStatus($data->status);
            $task->setUserId($data->usuario_id); 

            if ($task->save()) {
                http_response_code(200);
                echo json_encode(["message" => "tarefa criado com sucesso"]);
                exit;
            } else {
                echo "Erro ao criar tarefa.";
            }
        } else {

            include __DIR__ . '/../../views/tasks/create.php';
        }
    }

    
    public function update($taskId)
    {
        $task = new Task($this->db);

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents("php://input"));
            $task->setTitle($data->titulo);
            $task->setDescription($data->descricao);
            $task->setStatus($data->status);

            if ($task->update($taskId[0])) {
                echo 'usuario atualizado com sucesso';
                exit;
            } else {
                echo "Erro ao atualizar tarefa.";
            }
        } else {
            
            $taskData = $task->getById($taskId);
        }
    }

    
    public function show($taskId)
    {
        $task = new Task($this->db);
        $taskData = $task->getById($taskId[0]);

        if ($taskData) {
            echo json_encode(value: $taskData);
        } else {
            echo "Tarefa não encontrada.";
        }
    }

    
    public function delete($taskId)
    {
        $task = new Task($this->db);

        if ($task->delete($taskId[0])) {
            echo 'Tarefa deletada com sucesso';
            exit;
        } else {
            echo "Erro ao deletar tarefa.";
        }
    }
}
