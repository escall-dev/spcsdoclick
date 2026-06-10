<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Complaint.php';

try {
    $complaint = new Complaint();
    $data = [
        'referred_to' => 'OSDS',
        'referred_to_other' => '',
        'name_pangalan' => 'John Doe',
        'address_tirahan' => '',
        'contact_number' => '1234567890',
        'email_address' => 'john@example.com',
        'involved_full_name' => '',
        'involved_position' => '',
        'involved_address' => '',
        'involved_school_office_unit' => '',
        'narration_complaint' => '',
        'narration_complaint_page2' => '',
        'desired_action_relief' => '',
        'certification_agreed' => true,
        'printed_name_pangalan' => 'John Doe',
        'signature_type' => 'uploaded_form',
        'signature_data' => ''
    ];
    $result = $complaint->create($data);
    echo "SUCCESS: " . json_encode($result);
} catch (Throwable $e) {
    echo "ERROR: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine();
}
