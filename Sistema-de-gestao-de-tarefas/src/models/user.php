<?php

namespace App\Models;

use PDO;

class user
{
    private $db;
    private $name;
    private $email;
    private $password;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    
    public function setName($name) { $this->name = $name; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }

    
    public function save()
    {
        $stmt = $this->db->prepare("INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)");
        return $stmt->execute([$this->name, $this->email, $this->password]);
    }

  
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getById($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   
    public function update($userId)
    {
        $stmt = $this->db->prepare("UPDATE users SET nome = ?, email = ?, senha = ? WHERE id = ?");
        return $stmt->execute([$this->name, $this->email, $this->password, $userId]);
    }

    
    public function delete($userId)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$userId[0]]);
    }
}
