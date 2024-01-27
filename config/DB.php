<?php
class DB {
    private $host;
    private $username;
    private $password;
    private $database;
    private $charset;
    private $pdo;

    public function __construct($host, $username, $password, $database, $charset = 'utf8') {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->charset = $charset;

        $this->connect();
    }

    private function connect() {
        $dsn = "mysql:host={$this->host};dbname={$this->database};charset={$this->charset}";

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>