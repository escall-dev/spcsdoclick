<?php
/**
 * send-to-fast.php
 * SDO-BACtrack — Outbound integration API endpoint.
 * Exposes approved projects that are pending sync/creation in FAST.
 */

header('Content-Type: application/json');

require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../config/database.php';

// JSON Response helper
function jsonResponse(int $code, bool $success, string $message, array $extra = []): void
{
    http_response_code($code);
    echo json_encode(array_merge(['success' => $success, 'message' => $message], $extra), JSON_UNESCAPED_UNICODE);
    exit;
}

// Authentication
$authHeader = $_SERVER['HTTP_AUTHORIZATION']
    ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION']
    ?? '';

$token = '';
if (preg_match('/^Bearer\s+(.+)$/i', $authHeader, $m)) {
    $token = trim($m[1]);
}

if ($token === '') {
    $token = trim((string)($_GET['system_token'] ?? ''));
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

// Accept only GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(405, false, 'Method not allowed. Use GET.');
}

try {
    $db = db();
    $ownerNameColumnExists = false;
    try {
        $rows = $db->fetchAll("SHOW COLUMNS FROM projects LIKE 'project_owner_name'");
        $ownerNameColumnExists = !empty($rows);
    } catch (Exception $e) {
        $ownerNameColumnExists = false;
    }

    $ownerNameSql = $ownerNameColumnExists
        ? "COALESCE(NULLIF(p.project_owner_name, ''), u.name)"
        : "u.name";

        // Query approved projects that are explicitly submitted to FAST
        $projects = $db->fetchAll(
            "SELECT p.*, {$ownerNameSql} as creator_name 
             FROM projects p
             LEFT JOIN users u ON p.created_by = u.id
             WHERE p.approval_status = 'APPROVED' 
               AND p.fast_sync_status = 'PENDING'
             ORDER BY p.id DESC"
        );

        $baseUrl = rtrim(APP_URL, '/');
        foreach ($projects as &$project) {
            $projectId = (int)($project['id'] ?? 0);
            $project['documents'] = [];
            $project['approval_document'] = null;

            if ($projectId > 0) {
                $docs = $db->fetchAll(
                    "SELECT category, file_path, original_name, file_size, uploaded_at
                     FROM project_documents
                     WHERE project_id = ?
                     ORDER BY uploaded_at DESC",
                    [$projectId]
                );

                foreach ($docs as &$doc) {
                    if (!empty($doc['file_path'])) {
                        $doc['file_url'] = $baseUrl . '/uploads/' . ltrim($doc['file_path'], '/');
                    } else {
                        $doc['file_url'] = null;
                    }
                }
                unset($doc);
                $project['documents'] = $docs;

                if (!empty($project['approval_file_path'])) {
                    $project['approval_document'] = [
                        'file_path' => $project['approval_file_path'],
                        'original_name' => basename($project['approval_file_path']),
                        'file_url' => $baseUrl . '/uploads/' . ltrim($project['approval_file_path'], '/')
                    ];
                }
            }
        }
        unset($project);

        jsonResponse(200, true, 'Pending projects retrieved successfully.', ['projects' => $projects]);

} catch (Exception $e) {
    jsonResponse(500, false, 'Server error: ' . $e->getMessage());
}
