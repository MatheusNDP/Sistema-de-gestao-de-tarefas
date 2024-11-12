<?php

namespace Mathe\SistemaDeGestaoDeTarefas\Models;

use PDO;

class User
{
    private $db;
    private $name;
    private $email;
    private $password;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Setters para os atributos
    public function setName($name) { $this->name = $name; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }

    // Método para salvar um novo usuário
    public function save()
    {
        $stmt = $this->db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        return $stmt->execute([$this->name, $this->email, $this->password]);
    }

    // Método para buscar todos os usuários
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar um usuário pelo ID
    public function getById($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para atualizar um usuário existente
    public function update($userId)
    {
        $stmt = $this->db->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?");
        return $stmt->execute([$this->name, $this->email, $this->password, $userId]);
    }

    // Método para deletar um usuário
    public function delete($userId)
    {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$userId]);
    }
}
