<?php

namespace App\Config;

use PDO;
use PDOException;
use Exception;

class database
{
    private $host;
    private $name;
    private $user;
    private $password;
    private $port;
    public $conn;

    public function __construct()
    {

        $this->host = 'localhost';
        $this->name = 'database_gerencia';
        $this->user = 'postgres';
        $this->password = 'unigran';
        $this->port = '5432';
    }

    
    /**
     * Função para conectar ao banco de dados usando PDO.
     * Retorna uma instância de PDO ou null em caso de erro.
     */
    public function connect()
    {
        $this->conn = null;
        try {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->name}";
            $this->conn = new PDO($dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Erro na conexão com o banco de dados: " . $e->getMessage());
            echo "Erro na conexão com o banco de dados. Por favor, tente novamente mais tarde.";
        }
        return $this->conn;
    }
}
