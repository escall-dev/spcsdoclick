<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

putenv('DB_HOST=localhost');
putenv('DB_USER=root');
putenv('DB_PASS=');
putenv('DB_NAME=sdo_cts');

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Complaint.php';

$complaint = new Complaint();
$data = [
    'signature_type' => 'uploaded_form',
];

try {
    $id = $complaint->create($data);
    echo "Success: $id";
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
} catch (Error $e) {
    echo "Error: " . $e->getMessage();
}
