<?php

class Database
{
    private string $host = 'localhost';
    private string $port = '3307';
    private string $dbname = 'bookstore';
    private string $username = 'root';
    private string $password = '';
    private string $charset = 'utf8mb4';

    private ?PDO $conn = null;

    public function connect(): PDO
    {
        if ($this->conn !== null) {
            return $this->conn;
        }

        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}";

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            die('Lỗi kết nối cơ sở dữ liệu: ' . $e->getMessage());
        }

        return $this->conn;
    }
}