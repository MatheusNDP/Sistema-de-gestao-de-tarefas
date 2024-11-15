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

        echo json_encode($users);

    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));
            $user = new User($this->db);
            $user->setName($data->nome);
            $user->setEmail($data->email);
            $user->setPassword(password_hash($data->senha, PASSWORD_BCRYPT));
            
            if ($user->save()) {
                http_response_code(200);
                echo json_encode(["message" => "usuario criado com sucesso"]);
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
        $userData = $user->getById($userId[0]);

        if ($userData) {
            echo json_encode($userData);
        } else {
            echo "Usuário não encontrado.";
        }
    }

    public function update($userId)
    {
        $user = new User($this->db);

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents("php://input"));
            $user->setName($data->nome);
            $user->setEmail($data->email);
            if (!empty($data->senha)) {
                $user->setPassword(password_hash($data->senha, PASSWORD_BCRYPT));
            }

            if ($user->update($userId[0])) {
                echo 'Usuario atualizado com sucesso';
                exit;
            } else {
                echo "Erro ao atualizar usuário.";
            }
        } else {
            $userData = $user->getById($userId[0]);
        }
    }

    public function delete($userId)
    {
        $user = new User($this->db);

        if ($user->delete($userId)) {
            echo 'Usuario deletado com sucesso';
            exit;
        } else {
            echo "Erro ao deletar usuário.";
        }
    }
}
