<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../../models/ComplaintAdmin.php';
require_once __DIR__ . '/../../services/email/ComplaintNotification.php';

try {
    echo "Files loaded successfully.\n";
    $complaintModel = new ComplaintAdmin();
    echo "ComplaintAdmin instantiated successfully.\n";
    $emailNotification = new ComplaintNotification();
    echo "ComplaintNotification instantiated successfully.\n";
    
    // Simulate what the script does loosely
    echo "All classes instantiated.\n";
} catch (Throwable $e) {
    echo "Exception: " . $e->getMessage() . "\n" . $e->getTraceAsString();
}
