<?php

namespace App\Models;

use PDO;

class task
{
    private $db;
    private $title;
    private $description;
    private $status;
    private $userId;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Setters para os atributos
    public function setTitle($title) { $this->title = $title; }
    public function setDescription($description) { $this->description = $description; }
    public function setStatus($status) { $this->status = $status; }
    public function setUserId($userId) { $this->userId = $userId; }

    // Método para salvar uma nova tarefa
    public function save()
    {
        $stmt = $this->db->prepare("INSERT INTO tarefas (titulo, descricao, status, usuario_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$this->title, $this->description, $this->status, $this->userId]);
    }

    // Método para buscar todas as tarefas de um usuário específico
    public function getAllByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM tarefas WHERE usuario_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar uma tarefa pelo ID
    public function getById($taskId)
    {
        $stmt = $this->db->prepare("SELECT * FROM tarefas WHERE id = ?");
        $stmt->execute([$taskId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para atualizar uma tarefa existente
    public function update($taskId)
    {
        $stmt = $this->db->prepare("UPDATE tarefas SET titulo = ?, descricao = ?, status = ? WHERE id = ?");
        return $stmt->execute([$this->title, $this->description, $this->status, $taskId]);
    }

    // Método para deletar uma tarefa
    public function delete($taskId)
    {
        $stmt = $this->db->prepare("DELETE FROM tarefas WHERE id = ?");
        return $stmt->execute([$taskId]);
    }
}
