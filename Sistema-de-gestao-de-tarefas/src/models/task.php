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

    
    public function setTitle($title) { $this->title = $title; }
    public function setDescription($description) { $this->description = $description; }
    public function setStatus($status) { $this->status = $status; }
    public function setUserId($userId) { $this->userId = $userId; }

    
    public function save()
    {
        $stmt = $this->db->prepare("INSERT INTO tasks (titulo, descricao, status, usuario_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$this->title, $this->description, $this->status, $this->userId]);
    }

    
    public function getAllByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE usuario_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getById($taskId)
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$taskId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   
    public function update($taskId)
    {
        $stmt = $this->db->prepare("UPDATE tasks SET titulo = ?, descricao = ?, status = ? WHERE id = ?");
        return $stmt->execute([$this->title, $this->description, $this->status, $taskId]);
    }

    
    public function delete($taskId)
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$taskId]);
    }
}
