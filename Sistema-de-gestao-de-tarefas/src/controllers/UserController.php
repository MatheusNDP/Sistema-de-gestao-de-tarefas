<?php

namespace Mathe\SistemaDeGestaoDeTarefas\Controllers;

use Mathe\SistemaDeGestaoDeTarefas\Models\User;
use Mathe\SistemaDeGestaoDeTarefas\Config\Database;

class UserController
{
    private $db;

    public function __construct()
    {
        // Estabelece a conexão com o banco de dados
        $this->db = (new Database())->connect();
    }

    // Método para criar um novo usuário
    public function create($data)
    {
        $user = new User($this->db);
        $user->setName($data['nome']);
        $user->setEmail($data['email']);
        $user->setPassword(password_hash($data['senha'], PASSWORD_BCRYPT));
        
        if ($user->save()) {
            echo "Usuário criado com sucesso!";
        } else {
            echo "Erro ao criar usuário.";
        }
    }

    // Método para listar todos os usuários
    public function index()
    {
        $user = new User($this->db);
        $users = $user->getAll();

        foreach ($users as $user) {
            echo "ID: {$user['id']} - Nome: {$user['nome']} - Email: {$user['email']}<br>";
        }
    }

    // Método para mostrar um único usuário
    public function show($userId)
    {
        $user = new User($this->db);
        $userData = $user->getById($userId);

        if ($userData) {
            echo "ID: {$userData['id']} - Nome: {$userData['nome']} - Email: {$userData['email']}";
        } else {
            echo "Usuário não encontrado.";
        }
    }

    // Método para atualizar um usuário
    public function update($userId, $data)
    {
        $user = new User($this->db);
        $user->setName($data['nome']);
        $user->setEmail($data['email']);
        if (!empty($data['senha'])) {
            $user->setPassword(password_hash($data['senha'], PASSWORD_BCRYPT));
        }

        if ($user->update($userId)) {
            echo "Usuário atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar usuário.";
        }
    }

    // Método para deletar um usuário
    public function delete($userId)
    {
        $user = new User($this->db);

        if ($user->delete($userId)) {
            echo "Usuário deletado com sucesso!";
        } else {
            echo "Erro ao deletar usuário.";
        }
    }
}
