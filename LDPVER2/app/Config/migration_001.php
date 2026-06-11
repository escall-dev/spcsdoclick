<?php
require_once __DIR__ . '/Database.php';

use App\Config\Database;

$db = new Database();
$pdo = $db->getConnection();

try {
    // Add tracking_number column
    $pdo->exec("ALTER TABLE ld_activities ADD COLUMN tracking_number VARCHAR(50) AFTER id");
    $pdo->exec("CREATE UNIQUE INDEX idx_tracking_number ON ld_activities(tracking_number)");
    echo "Column tracking_number added successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
