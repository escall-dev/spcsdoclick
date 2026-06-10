<?php
/**
 * receive-fast.php
 * SDO-BACtrack — Inbound API endpoint for SDO FAST system.
 *
 * Accepts POST requests with JSON payloads from SDO FAST to update
 * procurement project status in BACtrack (financial completion,
 * cancellation, DV creation, etc.).
 */

header('Content-Type: application/json');

// ── Bootstrap ──────────────────────────────────────────────────────
require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../config/database.php';

// ── Helper: JSON response ──────────────────────────────────────────
function jsonResponse(int $code, bool $success, string $message, array $extra = []): void
{
    http_response_code($code);
    echo json_encode(array_merge(['success' => $success, 'message' => $message], $extra), JSON_UNESCAPED_UNICODE);
    exit;
}

// ── Helper: Log integration event ──────────────────────────────────
function logIntegration(string $eventType, ?int $refId, string $status, ?string $msg = null): void
{
    try {
        db()->query(
            "INSERT INTO integration_logs
                (source_system, destination_system, event_type, reference_id, sync_status, response_message)
             VALUES (?, ?, ?, ?, ?, ?)",
            ['FAST', 'BACtrack', $eventType, $refId, $status, $msg]
        );
    } catch (\Exception $e) {
        error_log('[receive-fast] Log write failed: ' . $e->getMessage());
    }
}

// ── Authentication ─────────────────────────────────────────────────
$authHeader = $_SERVER['HTTP_AUTHORIZATION']
    ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION']
    ?? '';

$token = '';
if (preg_match('/^Bearer\s+(.+)$/i', $authHeader, $m)) {
    $token = trim($m[1]);
}

// Read raw body early so we can accept a fallback token if headers are stripped.
$rawBody = file_get_contents('php://input');
$bodyData = json_decode($rawBody, true);
$tokenFromBody = is_array($bodyData) ? trim((string)($bodyData['system_token'] ?? '')) : '';
$tokenFromQuery = trim((string)($_GET['system_token'] ?? ''));

if ($token === '' && $tokenFromQuery !== '') {
    $token = $tokenFromQuery;
}
if ($token === '' && $tokenFromBody !== '') {
    $token = $tokenFromBody;
}

$expectedFastToken = app_env_get('FAST_SYSTEM_TOKEN', '');
$expectedBacToken = app_env_get('BAC_SYSTEM_TOKEN', 'bac_secure_token_123');
$isValidToken = $token !== '' && (
    ($expectedFastToken !== '' && hash_equals($expectedFastToken, $token))
    || ($expectedBacToken !== '' && hash_equals($expectedBacToken, $token))
);

if (!$isValidToken) {
    jsonResponse(401, false, 'Unauthorized: invalid or missing token.');
}

// ── Accept only POST ───────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(405, false, 'Method not allowed. Use POST.');
}

// ── Parse JSON body ────────────────────────────────────────────────
$data = $bodyData;

if (!is_array($data)) {
    jsonResponse(400, false, 'Invalid JSON payload.');
}

$referenceNumber = trim($data['reference_number'] ?? '');
$eventType       = trim($data['event_type'] ?? '');
$payload         = $data['payload'] ?? [];

if ($referenceNumber === '' || $eventType === '') {
    jsonResponse(400, false, 'Missing required fields: reference_number, event_type.');
}

// ── Look up the project ────────────────────────────────────────────
$db = db();
$project = null;

if ($referenceNumber !== '') {
    $project = $db->fetch(
        "SELECT p.*, u.name AS creator_name
           FROM projects p
           LEFT JOIN users u ON p.created_by = u.id
          WHERE p.bactrack_id = ?",
        [$referenceNumber]
    );
}

if (!$project) {
    $referenceId = (int) ($payload['reference_id'] ?? 0);
    if ($referenceId > 0) {
        $project = $db->fetch(
            "SELECT p.*, u.name AS creator_name
               FROM projects p
               LEFT JOIN users u ON p.created_by = u.id
              WHERE p.id = ?",
            [$referenceId]
        );
    }
}

if (!$project) {
    $projectNumber = trim((string)($payload['project_number'] ?? $referenceNumber));
    if (preg_match('/^PR-(\d+)$/i', $projectNumber, $m)) {
        $projectIdFromNumber = (int) $m[1];
        if ($projectIdFromNumber > 0) {
            $project = $db->fetch(
                "SELECT p.*, u.name AS creator_name
                   FROM projects p
                   LEFT JOIN users u ON p.created_by = u.id
                  WHERE p.id = ?",
                [$projectIdFromNumber]
            );
        }
    }
}

if (!$project) {
    $fastTrackingNumber = trim((string)($payload['fast_reference_number'] ?? ($payload['tracking_number'] ?? '')));
    if ($fastTrackingNumber !== '') {
        $project = $db->fetch(
            "SELECT p.*, u.name AS creator_name
               FROM projects p
               LEFT JOIN users u ON p.created_by = u.id
              WHERE p.fast_tracking_number = ?",
            [$fastTrackingNumber]
        );
    }
}

if (!$project && $referenceNumber !== '') {
    if (preg_match('/(\d{1,6})$/', $referenceNumber, $m)) {
        $suffixId = (int) $m[1];
        if ($suffixId > 0) {
            $project = $db->fetch(
                "SELECT p.*, u.name AS creator_name
                   FROM projects p
                   LEFT JOIN users u ON p.created_by = u.id
                  WHERE p.id = ?",
                [$suffixId]
            );

            if ($project && empty($project['bactrack_id'])) {
                try {
                    $db->query(
                        "UPDATE projects SET bactrack_id = ? WHERE id = ?",
                        [$referenceNumber, $project['id']]
                    );
                    $project['bactrack_id'] = $referenceNumber;
                } catch (\Exception $e) {
                    error_log('[receive-fast] Failed to backfill bactrack_id: ' . $e->getMessage());
                }
            }
        }
    }
}

if (!$project) {
    logIntegration($eventType, null, 'FAILED', "Project not found for reference: {$referenceNumber}");
    jsonResponse(404, false, 'Project not found for reference number: ' . $referenceNumber);
}

$projectId = (int) $project['id'];

// Save checklist documents sent from FAST in the integration payload
$checklistFiles = $payload['checklist_files'] ?? [];
if (is_array($checklistFiles) && !empty($checklistFiles)) {
    foreach ($checklistFiles as $slug => $fileData) {
        if (!empty($fileData['base64_file']) && !empty($fileData['original_filename'])) {
            $base64 = $fileData['base64_file'];
            $origName = $fileData['original_filename'];
            
            $decoded = base64_decode($base64);
            if ($decoded !== false) {
                $ext = pathinfo($origName, PATHINFO_EXTENSION) ?: 'pdf';
                $timestamp = time();
                $filename = "{$projectId}_{$slug}_{$timestamp}.{$ext}";
                $relativeDir = 'procurement-docs/';
                $uploadDir = UPLOAD_DIR . $relativeDir;
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $filePath = $relativeDir . $filename;
                $fullPath = $uploadDir . $filename;
                
                if (file_put_contents($fullPath, $decoded) !== false) {
                    $existing = $db->fetch(
                        "SELECT id, file_path FROM project_documents WHERE project_id = ? AND category = ?",
                        [$projectId, $slug]
                    );
                    
                    if ($existing) {
                        $oldFullPath = UPLOAD_DIR . $existing['file_path'];
                        if (file_exists($oldFullPath)) {
                            @unlink($oldFullPath);
                        }
                        $db->query(
                            "UPDATE project_documents 
                               SET file_path = ?, original_name = ?, file_size = ?, uploaded_at = NOW() 
                             WHERE id = ?",
                            [$filePath, $origName, strlen($decoded), $existing['id']]
                        );
                    } else {
                        $db->query(
                            "INSERT INTO project_documents (project_id, category, file_path, original_name, file_size, uploaded_at) 
                             VALUES (?, ?, ?, ?, ?, NOW())",
                            [$projectId, $slug, $filePath, $origName, strlen($decoded)]
                        );
                    }
                }
            }
        }
    }
}

// ── Require models only when needed ────────────────────────────────
require_once __DIR__ . '/../../models/BacCycle.php';
require_once __DIR__ . '/../../models/Notification.php';

$cycleModel        = new BacCycle();
$notificationModel = new Notification();

// ── Route by event_type ────────────────────────────────────────────
switch ($eventType) {

    // ================================================================
    // FINANCIAL_COMPLETED — FAST says financial processing is done
    // ================================================================
    case 'FINANCIAL_COMPLETED':
        $fastRef     = $payload['fast_reference_number'] ?? '';
        $finStatus   = $payload['fast_financial_status'] ?? 'Approved';
        $dvNumber    = $payload['dv_number'] ?? '';
        $remarks     = $payload['remarks'] ?? '';

        $activeCycle = $cycleModel->getActiveCycle($projectId);
        if (!$activeCycle) {
            logIntegration($eventType, $projectId, 'FAILED', 'No active BAC cycle found.');
            jsonResponse(422, false, 'No active BAC cycle for this project.');
        }

        // Find the Payment activity step in the active cycle
        $paymentActivity = $db->fetch(
            "SELECT * FROM project_activities
              WHERE bac_cycle_id = ?
                AND LOWER(step_name) LIKE '%payment%'
              ORDER BY step_order DESC
              LIMIT 1",
            [$activeCycle['id']]
        );

        if (!$paymentActivity) {
            // Fallback: find the last PENDING/IN_PROGRESS step
            $paymentActivity = $db->fetch(
                "SELECT * FROM project_activities
                  WHERE bac_cycle_id = ?
                    AND status IN ('PENDING', 'IN_PROGRESS', 'DELAYED')
                  ORDER BY step_order DESC
                  LIMIT 1",
                [$activeCycle['id']]
            );
        }

        if ($paymentActivity) {
            $today = date('Y-m-d');

            // Mark activity as COMPLETED
            $db->query(
                "UPDATE project_activities
                    SET status = 'COMPLETED',
                        actual_completion_date = ?,
                        compliance_remarks = ?
                  WHERE id = ?",
                [
                    $today,
                    "FAST Ref: {$fastRef} | DV: {$dvNumber} | Status: {$finStatus} | {$remarks}",
                    $paymentActivity['id'],
                ]
            );

            // Add history log
            $db->query(
                "INSERT INTO activity_history_logs
                    (activity_id, action_type, old_value, new_value, changed_by, remarks)
                 VALUES (?, 'STATUS_CHANGE', ?, 'COMPLETED', NULL, ?)",
                [
                    $paymentActivity['id'],
                    $paymentActivity['status'],
                    "Completed via FAST integration. DV: {$dvNumber}",
                ]
            );

            // Store FAST tracking number on the project
            $db->query(
                "UPDATE projects
                    SET fast_tracking_number = ?,
                        fast_sync_status     = 'SYNCED',
                        fast_synced_at       = NOW()
                  WHERE id = ?",
                [$fastRef ?: $dvNumber, $projectId]
            );

            // Check if ALL activities in the cycle are now COMPLETED
            $pendingCount = $db->fetch(
                "SELECT COUNT(*) AS cnt FROM project_activities
                  WHERE bac_cycle_id = ? AND status != 'COMPLETED'",
                [$activeCycle['id']]
            );

            if ((int) ($pendingCount['cnt'] ?? 1) === 0) {
                $cycleModel->updateStatus($activeCycle['id'], 'COMPLETED');
            }
        }

        // Notify the project creator
        $notificationModel->create([
            'user_id'        => (int) $project['created_by'],
            'title'          => 'Financial Processing Completed',
            'message'        => "Financial processing for project '{$project['title']}' is complete. DV: {$dvNumber}. Status: {$finStatus}.",
            'type'           => 'FAST_FINANCIAL_COMPLETED',
            'reference_type' => 'project',
            'reference_id'   => $projectId,
        ]);

        logIntegration($eventType, $projectId, 'SUCCESS', "DV: {$dvNumber}, Status: {$finStatus}");
        jsonResponse(200, true, 'Financial completion processed successfully.');
        break;

    // ================================================================
    // PROCUREMENT_CANCELLED — FAST requests cancellation
    // ================================================================
    case 'PROCUREMENT_CANCELLED':
        $remarks = $payload['remarks'] ?? 'Cancelled by FAST system.';

        $activeCycle = $cycleModel->getActiveCycle($projectId);
        if ($activeCycle) {
            $cycleModel->updateStatus($activeCycle['id'], 'CANCELLED');
        }

        $notificationModel->create([
            'user_id'        => (int) $project['created_by'],
            'title'          => 'Procurement Cancelled',
            'message'        => "Procurement for project '{$project['title']}' has been cancelled. Reason: {$remarks}",
            'type'           => 'FAST_PROCUREMENT_CANCELLED',
            'reference_type' => 'project',
            'reference_id'   => $projectId,
        ]);

        logIntegration($eventType, $projectId, 'SUCCESS', $remarks);
        jsonResponse(200, true, 'Procurement cancellation processed.');
        break;

    // ================================================================
    // DV_CREATED — Disbursement Voucher created in FAST
    // ================================================================
    case 'DV_CREATED':
        $dvNumber = $payload['dv_number'] ?? '';
        $remarks  = $payload['remarks']   ?? '';

        $activeCycle = $cycleModel->getActiveCycle($projectId);
        if ($activeCycle) {
            $currentActivity = $db->fetch(
                "SELECT * FROM project_activities
                  WHERE bac_cycle_id = ?
                    AND status IN ('PENDING', 'IN_PROGRESS', 'DELAYED')
                  ORDER BY step_order ASC
                  LIMIT 1",
                [$activeCycle['id']]
            );

            if ($currentActivity) {
                $existingRemarks = $currentActivity['compliance_remarks'] ?? '';
                $dvNote = "DV Created: {$dvNumber}";
                if ($remarks !== '') {
                    $dvNote .= " ({$remarks})";
                }
                $newRemarks = $existingRemarks !== '' ? $existingRemarks . ' | ' . $dvNote : $dvNote;

                $db->query(
                    "UPDATE project_activities SET compliance_remarks = ? WHERE id = ?",
                    [$newRemarks, $currentActivity['id']]
                );
            }
        }

        $notificationModel->create([
            'user_id'        => (int) $project['created_by'],
            'title'          => 'Disbursement Voucher Created',
            'message'        => "A DV ({$dvNumber}) has been created in FAST for project '{$project['title']}'. {$remarks}",
            'type'           => 'FAST_DV_CREATED',
            'reference_type' => 'project',
            'reference_id'   => $projectId,
        ]);

        logIntegration($eventType, $projectId, 'SUCCESS', "DV: {$dvNumber}");
        jsonResponse(200, true, 'DV creation recorded successfully.');
        break;

    // ================================================================
    // PROCUREMENT_UPDATED — Generic update from FAST
    // ================================================================
    case 'PROCUREMENT_UPDATED':
        $remarks = $payload['remarks'] ?? 'Updated by FAST system.';

        $notificationModel->create([
            'user_id'        => (int) $project['created_by'],
            'title'          => 'Procurement Updated',
            'message'        => "Project '{$project['title']}' was updated by FAST. {$remarks}",
            'type'           => 'FAST_PROCUREMENT_UPDATED',
            'reference_type' => 'project',
            'reference_id'   => $projectId,
        ]);

        logIntegration($eventType, $projectId, 'SUCCESS', $remarks);
        jsonResponse(200, true, 'Procurement update recorded.');
        break;

    // ================================================================
    // Unknown event type
    // ================================================================
    default:
        logIntegration($eventType, $projectId, 'FAILED', 'Unknown event type: ' . $eventType);
        jsonResponse(400, false, 'Unknown event type: ' . $eventType);
}
