<?php
namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private $host;
    private $username;
    private $password;
    private $dbname;
    public $pdo;

    public function __construct() {
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->username = getenv('DB_USER') ?: 'root';
        $this->password = getenv('DB_PASS') ?: '';
        $this->dbname = getenv('DB_NAME') ?: 'ldpver2';
    }

    public function getConnection()
    {
        $this->pdo = null;

        try {
            $this->pdo = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Set timezone
            date_default_timezone_set('Asia/Manila');

        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->pdo;
    }
}
