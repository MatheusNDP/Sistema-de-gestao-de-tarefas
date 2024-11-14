<?php

namespace App\Controllers;

use App\Config\database;
use App\Models\user;

class UserController
{
    private $db;

    public function __construct()
    {
        $this->db = (new database())->connect();
    }

    public function index()
    {
        $user = new user($this->db);
        $users = $user->getAll();

        include __DIR__ . '/../../views/users/list.php';
    }

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
            include __DIR__ . '/../../views/users/create.php';
        }
    }

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
            $userData = $user->getById($userId);
            include __DIR__ . '/../../views/users/edit.php';
        }
    }

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
