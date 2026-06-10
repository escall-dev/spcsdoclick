<?php
/**
 * Database Configuration
 * SDO CTS - San Pedro Division Office Complaint Tracking System
 * 
 * Credentials are loaded from the .env file in the project root.
 */

require_once __DIR__ . '/env.php';
cts_load_env();

define('DB_HOST', cts_env('DB_HOST', 'localhost'));
define('DB_NAME', cts_env('DB_NAME', 'sdo_cts'));
define('DB_USER', cts_env('DB_USER', 'root'));
define('DB_PASS', cts_env('DB_PASS', ''));

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }
}


