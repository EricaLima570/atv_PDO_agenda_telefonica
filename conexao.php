<?php
//arquivo referente a conexao de Diego

class Conexao {
    private static $instancia = null;
    private $conexao = null;

    private $host = 'localhost';
    private $dbname = 'prog_web_2024_2';
    private $username = 'root';
    private $password = '230719';

    private function __construct() {
        try {
            $this->conexao = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public static function conectar(): PDO {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia->conexao;
    }
}