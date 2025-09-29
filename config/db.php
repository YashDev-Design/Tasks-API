<?php
class Database {
    private $host = '127.0.0.1';   // MySQL host
    private $db   = 'tasks_db';    // Database name
    private $user = 'root';        // Default user in XAMPP
    private $pass = '';            // Default password is empty
    private $charset = 'utf8mb4';  // Character encoding

    public function pdo(): PDO {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Show errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch as assoc arrays
        ];
        return new PDO($dsn, $this->user, $this->pass, $options);
    }
}