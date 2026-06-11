<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../Models/ActivityRepository.php';

use App\Config\Database;
use App\Models\ActivityRepository;

$db = new Database();
$pdo = $db->getConnection();
$repo = new ActivityRepository($pdo);

try {
    // 1. Fetch all activities without a tracking number, ordered by created_at
    $sql = "SELECT id, created_at FROM ld_activities WHERE tracking_number IS NULL OR tracking_number = '' ORDER BY created_at ASC";
    $stmt = $pdo->query($sql);
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Found " . count($activities) . " activities to backfill.\n";

    // 2. Keep track of sequence per Year-Month
    $monthlyCounters = [];

    foreach ($activities as $act) {
        $id = $act['id'];
        $created_at = $act['created_at'];
        $ym = date('Y-m', strtotime($created_at));
        
        if (!isset($monthlyCounters[$ym])) {
            $monthlyCounters[$ym] = 1;
        } else {
            $monthlyCounters[$ym]++;
        }

        // Generate Random Part (3 chars)
        $chars = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
        $randomPart = substr(str_shuffle($chars), 0, 3);
        $yearMonth = date('Ym', strtotime($created_at));
        $paddedSequence = str_pad($monthlyCounters[$ym], 3, '0', STR_PAD_LEFT);
        
        $trackingNumber = "ELDP{$randomPart}-{$yearMonth}-{$paddedSequence}";

        // Update record
        $updateStmt = $pdo->prepare("UPDATE ld_activities SET tracking_number = ? WHERE id = ?");
        $updateStmt->execute([$trackingNumber, $id]);
        
        echo "Updated record $id with tracking number: $trackingNumber\n";
    }

    echo "Backfill complete.\n";
} catch (Exception $e) {
    echo "Error during backfill: " . $e->getMessage() . "\n";
}
