<?php

namespace Mathe\SistemaDeGestaoDeTarefas\Config;

use PDO;
use PDOException;
use Exception; // Adiciona a exceção genérica para tratamento do arquivo .env

class Database
{
    private $host;
    private $name;
    private $user;
    private $password;
    private $port;
    public $conn;

    public function __construct()
    {
        // Carregar as variáveis do arquivo .env
        $this->loadEnv(__DIR__ . '/../../.env');

        // Configurar as variáveis de conexão usando as variáveis de ambiente
        $this->host = getenv('DB_HOST');
        $this->name = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->password = getenv('DB_PASSWORD');
        $this->port = getenv('DB_PORT');
    }

    /**
     * Função para carregar o arquivo .env manualmente.
     * Este método lê cada linha do .env e define as variáveis de ambiente.
     */
    private function loadEnv($path)
    {
        if (!file_exists($path)) {
            throw new Exception("Arquivo .env não encontrado: $path");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }

    /**
     * Função para conectar ao banco de dados usando PDO.
     * Retorna uma instância de PDO ou null em caso de erro.
     */
    public function connect()
    {
        $this->conn = null;
        try {
            // Constrói o DSN para conexão com PostgreSQL
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->name}";
            $this->conn = new PDO($dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Tratamento de erro de conexão
            error_log("Erro na conexão com o banco de dados: " . $e->getMessage());
            echo "Erro na conexão com o banco de dados. Por favor, tente novamente mais tarde.";
        }
        return $this->conn;
    }
}
