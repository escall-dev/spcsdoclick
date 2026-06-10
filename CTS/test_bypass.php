<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Complaint.php';

try {
    $db = Database::getInstance()->getConnection();
    $db->beginTransaction();
    echo "Database connection successful!\n";
    
    $complaint = new Complaint();
    $bypassData = [
        'name_pangalan' => 'Test User Bypass',
        'email_address' => 'test@example.com',
        'contact_number' => '09123456789',
        'involved_school_office_unit' => 'SDO SPC',
        'signature_type' => 'uploaded_form'
    ];
    
    $result = $complaint->create($bypassData);
    if ($result) {
        echo "SUCCESS: Complaint bypass mode passed database validation and SQL execution! Reference: $result\n";
    } else {
        echo "FAILED: create() returned false.\n";
    }
    
    $db->rollBack();
    echo "Transaction rolled back (no test data saved to DB).\n";
    
} catch (PDOException $e) {
    echo "DATABASE ERROR: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

// Verify Logos
$sdoPath = __DIR__ . '/assets/img/sdo-logo.jpg';
$bpPath = __DIR__ . '/assets/img/bagongpilpinas-logo.png';
echo "SDO Logo path exists: " . (file_exists($sdoPath) ? 'Yes' : 'No') . "\n";
echo "Bagong Pilipinas Logo path exists: " . (file_exists($bpPath) ? 'Yes' : 'No') . "\n";
