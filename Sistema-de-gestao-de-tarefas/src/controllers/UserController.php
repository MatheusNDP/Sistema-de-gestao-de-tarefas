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

    // Método para listar todos os usuários
    public function index()
    {
        $user = new User($this->db);
        $users = $user->getAll();

        // Carregar a lista de usuários na view
        include __DIR__ . '/../../views/users/list.php';
    }

    // Método para exibir o formulário de criação e processar a criação de um novo usuário
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $user = new User($this->db);
            $user->setName($data['nome']);
            $user->setEmail($data['email']);
            $user->setPassword(password_hash($data['senha'], PASSWORD_BCRYPT));
            
            if ($user->save()) {
                header("Location: /users");
                exit;
            } else {
                echo "Erro ao criar usuário.";
            }
        } else {
            // Carregar o formulário de criação
            include __DIR__ . '/../../views/users/create.php';
        }
    }

    // Método para mostrar um único usuário (opcional para este CRUD)
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

    // Método para exibir o formulário de edição e processar a atualização de um usuário
    public function update($userId)
    {
        $user = new User($this->db);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $user->setName($data['nome']);
            $user->setEmail($data['email']);
            if (!empty($data['senha'])) {
                $user->setPassword(password_hash($data['senha'], PASSWORD_BCRYPT));
            }

            if ($user->update($userId)) {
                header("Location: /users");
                exit;
            } else {
                echo "Erro ao atualizar usuário.";
            }
        } else {
            // Carregar os dados do usuário para exibir no formulário de edição
            $userData = $user->getById($userId);
            include __DIR__ . '/../../views/users/edit.php';
        }
    }

    // Método para deletar um usuário
    public function delete($userId)
    {
        $user = new User($this->db);

        if ($user->delete($userId)) {
            header("Location: /users");
            exit;
        } else {
            echo "Erro ao deletar usuário.";
        }
    }
}
