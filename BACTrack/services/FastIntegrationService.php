<?php
/**
 * FastIntegrationService
 * SDO-BACtrack → SDO FAST bidirectional sync service.
 *
 * Sends procurement data to the FAST financial system and logs
 * every integration attempt for audit purposes.
 */

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';

class FastIntegrationService
{
    /**
     * Map BACtrack procurement_type constants to FAST-compatible categories.
     */
    private static function mapProcurementType(string $bactrackType): string
    {
        $servicesTypes = [
            'CONSULTING_SERVICES',
            'DIRECT_PROCUREMENT_STI',
        ];

        if (in_array($bactrackType, $servicesTypes, true)) {
            return 'Services';
        }

        return 'Goods';
    }

    /**
     * Build the project number in PR-XXXX format from the project ID.
     */
    private static function formatProjectNumber(int $projectId): string
    {
        return 'PR-' . str_pad((string) $projectId, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Log an integration event to the integration_logs table.
     */
    private static function log(
        string $source,
        string $destination,
        string $eventType,
        ?int   $referenceId,
        string $status,
        ?string $message = null
    ): void {
        try {
            db()->query(
                "INSERT INTO integration_logs
                    (source_system, destination_system, event_type, reference_id, sync_status, response_message)
                 VALUES (?, ?, ?, ?, ?, ?)",
                [$source, $destination, $eventType, $referenceId, $status, $message]
            );
        } catch (\Exception $e) {
            error_log('[FastIntegration] Failed to write integration log: ' . $e->getMessage());
        }
    }

    /**
     * Synchronize an approved project to SDO FAST with proof of approval document.
     *
     * @param  array  $project          Project row (from Project::findById)
     * @param  string $filePath         File path relative to uploads directory
     * @param  string $originalFilename Original name of the uploaded document
     * @param  string $uploaderName     Name of the user uploading the document
     * @return array{success: bool, message: string, tracking_number?: string}
     */
    public static function syncProjectToFast(array $project, string $filePath, string $originalFilename, string $uploaderName): array
    {
        $fastApiUrl   = app_env_get('FAST_API_URL', 'http://localhost/fast/api/integrations/receive-bac.php');
        $fastToken    = app_env_get('BAC_SYSTEM_TOKEN', 'bac_secure_token_123');
        $projectId    = (int) ($project['id'] ?? 0);
        $bactrackId   = $project['bactrack_id'] ?? '';

        if ($projectId <= 0 || $bactrackId === '') {
            $msg = 'Project ID or BACtrack ID is missing.';
            self::log('BACtrack', 'FAST', 'PROCUREMENT_APPROVED', $projectId, 'FAILED', $msg);
            return ['success' => false, 'message' => $msg];
        }

        // Read and encode approval document
        $fullPath = UPLOAD_DIR . $filePath;
        if (!file_exists($fullPath)) {
            $msg = 'Approval document file not found at: ' . $fullPath;
            self::log('BACtrack', 'FAST', 'PROCUREMENT_APPROVED', $projectId, 'FAILED', $msg);
            return ['success' => false, 'message' => $msg];
        }
        $fileContent = file_get_contents($fullPath);
        if ($fileContent === false) {
            $msg = 'Failed to read approval document file: ' . $filePath;
            self::log('BACtrack', 'FAST', 'PROCUREMENT_APPROVED', $projectId, 'FAILED', $msg);
            return ['success' => false, 'message' => $msg];
        }
        $base64File = base64_encode($fileContent);
        $prNumber = self::formatProjectNumber($projectId);

        // Fetch checklist documents for this project to include in sync payload
        try {
            $checklistDocs = db()->fetchAll("SELECT category FROM project_documents WHERE project_id = ?", [$projectId]);
        } catch (\Exception $ex) {
            $checklistDocs = [];
        }
        
        $hasPR = false;
        $hasMemo = false;
        $hasProposal = false;
        $hasSaro = false;

        foreach ($checklistDocs ?: [] as $doc) {
            $cat = strtolower(trim($doc['category'] ?? ''));
            if ($cat === 'purchase_request' || $cat === 'purchase request' || $cat === 'purchase-request') {
                $hasPR = true;
            } elseif ($cat === 'memorandum') {
                $hasMemo = true;
            } elseif ($cat === 'activity_proposal' || $cat === 'activity or project proposal' || $cat === 'activity-proposal') {
                $hasProposal = true;
            } elseif ($cat === 'saro') {
                $hasSaro = true;
            }
        }

        $checklistPayload = [
            'purchase_request' => $hasPR,
            'memorandum' => $hasMemo,
            'activity_proposal' => $hasProposal,
            'saro' => $hasSaro
        ];


        // Build payload matching FAST receive-bac.php expectations
        $payload = [
            'reference_number' => $bactrackId,
            'event_type'       => 'PROCUREMENT_APPROVED',
            'payload'          => [
                'reference_id'      => $projectId,
                'project_number'    => $prNumber,
                'procurement_type'  => self::mapProcurementType($project['procurement_type'] ?? 'PUBLIC_BIDDING'),
                'particulars'       => trim(
                    ($project['title'] ?? 'Untitled')
                    . (! empty($project['description']) ? ' - ' . $project['description'] : '')
                ),
                'amount'            => (float) (($project['approved_budget'] ?? 0) > 0 ? $project['approved_budget'] : 150000.00),
                'base64_file'       => $base64File,
                'original_filename' => $originalFilename,
                'pr_number'         => $prNumber,
                'checklist'         => $checklistPayload,
            ],
        ];

        $jsonPayload = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // Mark as PENDING before the HTTP call
        try {
            db()->query(
                "UPDATE projects SET fast_sync_status = 'PENDING' WHERE id = ?",
                [$projectId]
            );
        } catch (\Exception $e) {
            error_log('[FastIntegration] Could not set PENDING status: ' . $e->getMessage());
        }

        // Log filename, uploader, timestamp, and PR number in bac_sync_logs
        try {
            db()->query(
                "INSERT INTO bac_sync_logs (filename, uploader, pr_number) VALUES (?, ?, ?)",
                [$originalFilename, $uploaderName, $prNumber]
            );
        } catch (\Exception $e) {
            error_log('[FastIntegration] Failed to log sync in bac_sync_logs: ' . $e->getMessage());
        }

        // ── Stream-based POST ──────────────────────────────────────
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n" .
                            "Authorization: Bearer " . $fastToken . "\r\n" .
                            "Accept: application/json\r\n",
                'content' => $jsonPayload,
                'ignore_errors' => true,
                'timeout' => 30
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ]
        ];

        $context = stream_context_create($options);
        $response = @file_get_contents($fastApiUrl, false, $context);

        $httpCode = 500;
        if (isset($http_response_header) && is_array($http_response_header)) {
            if (preg_match('/^HTTP\/\d\.\d\s+(\d+)/i', $http_response_header[0], $matches)) {
                $httpCode = (int)$matches[1];
            }
        }

        if ($response === false) {
            $msg = 'Failed to connect to SDO FAST server.';
            self::markFailed($projectId, $msg);
            return ['success' => false, 'message' => $msg];
        }

        $decoded = json_decode($response, true);

        if ($httpCode >= 200 && $httpCode < 300 && !empty($decoded['success'])) {
            $trackingNumber = $decoded['tracking_number'] ?? ($decoded['data']['tracking_number'] ?? null);
            self::markSynced($projectId, $trackingNumber);
            return [
                'success'          => true,
                'message'          => $decoded['message'] ?? 'Synced successfully.',
                'tracking_number'  => $trackingNumber,
            ];
        }

        // Failure path
        $errorMsg = $decoded['message'] ?? ($decoded['error'] ?? "HTTP {$httpCode}: unexpected response");
        self::markFailed($projectId, $errorMsg);
        return ['success' => false, 'message' => $errorMsg];
    }

    /**
     * Retry syncing a previously-failed project.
     */
    public static function retrySync(int $projectId): array
    {
        require_once __DIR__ . '/../models/Project.php';
        $projectModel = new Project();
        $project = $projectModel->findById($projectId);

        if (!$project) {
            return ['success' => false, 'message' => 'Project not found.'];
        }

        $filePath = $project['approval_file_path'] ?? '';
        if ($filePath === '') {
            return ['success' => false, 'message' => 'No approval document attached to this project. Retry is not possible without an approval file.'];
        }

        $originalFilename = basename($filePath);
        $uploaderName = 'System Retry';

        if (function_exists('auth')) {
            try {
                $user = auth()->getUser();
                if ($user && !empty($user['name'])) {
                    $uploaderName = $user['name'];
                }
            } catch (\Exception $ex) {
                // Ignore session/auth errors in cli or system contexts
            }
        }

        return self::syncProjectToFast($project, $filePath, $originalFilename, $uploaderName);
    }

    // ── Private helpers ────────────────────────────────────────────

    private static function markSynced(int $projectId, ?string $trackingNumber): void
    {
        try {
            db()->query(
                "UPDATE projects
                    SET fast_sync_status     = 'ACCEPTED',
                        fast_tracking_number = ?,
                        fast_synced_at       = NOW()
                  WHERE id = ?",
                [$trackingNumber, $projectId]
            );
            self::log('BACtrack', 'FAST', 'PROCUREMENT_APPROVED', $projectId, 'ACCEPTED', 'Tracking: ' . ($trackingNumber ?? 'N/A'));
        } catch (\Exception $e) {
            error_log('[FastIntegration] Failed to mark ACCEPTED: ' . $e->getMessage());
        }
    }

    private static function markFailed(int $projectId, string $reason): void
    {
        try {
            db()->query(
                "UPDATE projects SET fast_sync_status = NULL WHERE id = ?",
                [$projectId]
            );
            self::log('BACtrack', 'FAST', 'PROCUREMENT_APPROVED', $projectId, 'FAILED', $reason);
        } catch (\Exception $e) {
            error_log('[FastIntegration] Failed to mark FAILED: ' . $e->getMessage());
        }
    }
}
