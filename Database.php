<?php
class Database
{
    private string $host = 'localhost';
    private string $dbname = 'sdc310_complaints';
    private string $username = 'root';
    private string $password = '';

    public function connect(): PDO
    {
        $pdo = new PDO(
            "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
            $this->username,
            $this->password
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}
