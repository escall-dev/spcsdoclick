<?php
/**
 * Integrations Controller and View
 * SDO-BACtrack — Synchronize data between SDO-BACtrack and SDO-FAST
 */

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/flash.php';
require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ . '/../config/database.php';

$auth = auth();
$auth->requireLogin();

$projectModel = new Project();

// Helpers for HTTP Requests (uses native streams fallback to avoid php_curl extension dependency)
function fetchPendingFromFast() {
    $fastApiUrl = app_env_get('FAST_API_URL', 'http://localhost/fast/api/integrations/receive-bac.php');
    $fastBaseUrl = str_replace('/receive-bac.php', '', $fastApiUrl);
    $url = $fastBaseUrl . '/send-to-bac.php';
    $token = app_env_get('BAC_SYSTEM_TOKEN', 'bac_secure_token_123');

    $options = [
        'http' => [
            'method' => 'GET',
            'header' => "Authorization: Bearer " . $token . "\r\n" .
                        "Content-Type: application/json\r\n",
            'ignore_errors' => true,
            'timeout' => 6
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]
    ];
    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);

    $httpCode = 500;
    if (isset($http_response_header) && is_array($http_response_header)) {
        if (preg_match('/^HTTP\/\d\.\d\s+(\d+)/i', $http_response_header[0], $matches)) {
            $httpCode = (int)$matches[1];
        }
    }

    if ($httpCode === 200 && $response !== false) {
        $data = json_decode($response, true);
        return $data['transactions'] ?? [];
    }
    return [];
}

function sendProjectToFast($project) {
    $url = app_env_get('FAST_API_URL', 'http://localhost/fast/api/integrations/receive-bac.php');
    $token = app_env_get('BAC_SYSTEM_TOKEN', 'bac_secure_token_123');

    $refNumber = $project['bactrack_id'] ?: 'PR-' . str_pad($project['id'], 4, '0', STR_PAD_LEFT);

    $payload = [
        'reference_number' => $refNumber,
        'event_type' => 'PROCUREMENT_APPROVED',
        'payload' => [
            'reference_id' => (int)$project['id'],
            'project_number' => $refNumber,
            'procurement_type' => PROCUREMENT_TYPES[$project['procurement_type']] ?? $project['procurement_type'],
            'particulars' => $project['title'],
            'amount' => (float)($project['approved_budget'] ?? 150000.00),
            'checklist' => [
                'purchase_request' => true,
                'memorandum' => true,
                'activity_proposal' => true,
                'saro' => true
            ]
        ]
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Authorization: Bearer " . $token . "\r\n" .
                        "Content-Type: application/json\r\n",
            'content' => json_encode($payload),
            'ignore_errors' => true,
            'timeout' => 6
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]
    ];
    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);

    $httpCode = 500;
    if (isset($http_response_header) && is_array($http_response_header)) {
        if (preg_match('/^HTTP\/\d\.\d\s+(\d+)/i', $http_response_header[0], $matches)) {
            $httpCode = (int)$matches[1];
        }
    }

    if (($httpCode === 200 || $httpCode === 201) && $response !== false) {
        return json_decode($response, true);
    }
    return ['success' => false, 'message' => 'HTTP Code ' . $httpCode . ': ' . ($response ?: 'Connection timed out or failed.')];
}

function receiveTransactionFromFast($tx) {
    $baseUrl = app_env_get('SYSTEM_BASE_URL', 'http://localhost/SDO-BACtrack');
    $url = rtrim($baseUrl, '/') . '/api/integrations/receive-fast.php';
    $token = app_env_get('FAST_SYSTEM_TOKEN', app_env_get('BAC_SYSTEM_TOKEN', 'bac_secure_token_123'));

    $db = db();
    $project = null;
    $incomingRef = trim((string)($tx['bac_reference_number'] ?? ''));
    if ($incomingRef !== '') {
        $project = $db->fetch(
            "SELECT * FROM projects WHERE bactrack_id = ?",
            [$incomingRef]
        );
    }
    if (!$project && !empty($tx['tracking_number'])) {
        $project = $db->fetch(
            "SELECT * FROM projects WHERE fast_tracking_number = ?",
            [$tx['tracking_number']]
        );
    }

    $resolvedRef = $incomingRef;
    $resolvedProjectId = 0;
    $resolvedProjectNumber = '';
    if ($project) {
        $resolvedProjectId = (int) $project['id'];
        $resolvedRef = $project['bactrack_id'] ?: 'PR-' . str_pad((string)$project['id'], 4, '0', STR_PAD_LEFT);
        $resolvedProjectNumber = 'PR-' . str_pad((string)$project['id'], 4, '0', STR_PAD_LEFT);
    }

    $eventType = 'PROCUREMENT_UPDATED';
    if ($tx['current_status'] === 'Approved') {
        $eventType = 'FINANCIAL_COMPLETED';
    } elseif ($tx['current_status'] === 'Rejected') {
        $eventType = 'PROCUREMENT_CANCELLED';
    } elseif ($tx['current_status'] === 'Pending Final Approval' || !empty($tx['dv_number'])) {
        $eventType = 'DV_CREATED';
    }

    $payload = [
        'reference_number' => $resolvedRef,
        'event_type' => $eventType,
        'system_token' => $token,
        'payload' => [
            'fast_reference_number' => $tx['tracking_number'],
            'fast_financial_status' => $tx['current_status'],
            'dv_number' => $tx['dv_number'] ?? '',
            'remarks' => $tx['remarks'] ?? 'Received from FAST',
            'synced_at' => date('Y-m-d H:i:s'),
            'reference_id' => $resolvedProjectId,
            'project_number' => $resolvedProjectNumber
        ]
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Authorization: Bearer " . $token . "\r\n" .
                        "Content-Type: application/json\r\n",
            'content' => json_encode($payload),
            'ignore_errors' => true,
            'timeout' => 6
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]
    ];
    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);

    $httpCode = 500;
    if (isset($http_response_header) && is_array($http_response_header)) {
        if (preg_match('/^HTTP\/\d\.\d\s+(\d+)/i', $http_response_header[0], $matches)) {
            $httpCode = (int)$matches[1];
        }
    }

    if ($httpCode === 200 && $response !== false) {
        return json_decode($response, true);
    }
    return ['success' => false, 'message' => 'HTTP Code ' . $httpCode . ': ' . ($response ?: 'Connection timed out or failed.')];
}

// Handle Form Submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';



    if ($action === 'receive_from_fast') {
        $trackingNumber = $_POST['tracking_number'] ?? '';
        $pending = fetchPendingFromFast();
        
        $selectedTx = null;
        foreach ($pending as $tx) {
            if ($tx['tracking_number'] === $trackingNumber) {
                $selectedTx = $tx;
                break;
            }
        }

        if (!$selectedTx) {
            setFlashMessage('error', 'Transaction not found in pending list.');
            header('Location: ' . APP_URL . '/admin/integrations.php');
            exit;
        }

        $res = receiveTransactionFromFast($selectedTx);
        if ($res['success']) {
            setFlashMessage('success', 'Status updates received and applied for project ' . $selectedTx['bac_reference_number']);
            header('Location: ' . APP_URL . '/admin/integrations.php?tab=received');
        } else {
            setFlashMessage('error', 'Failed to receive from FAST: ' . ($res['message'] ?? 'Unknown error'));
            header('Location: ' . APP_URL . '/admin/integrations.php?tab=receive');
        }
        exit;
    }

    if ($action === 'delete_received_log') {
        $logId = (int) ($_POST['log_id'] ?? 0);

        if ($logId > 0) {
            try {
                db()->query(
                    "DELETE FROM integration_logs WHERE id = ? AND source_system = 'FAST' AND destination_system = 'BACtrack'",
                    [$logId]
                );
                setFlashMessage('success', 'Received history entry deleted.');
            } catch (Exception $e) {
                setFlashMessage('error', 'Failed to delete history entry: ' . $e->getMessage());
            }
        } else {
            setFlashMessage('error', 'Invalid history entry.');
        }

        header('Location: ' . APP_URL . '/admin/integrations.php?tab=received');
        exit;
    }
}

// Load views data
// Send to FAST displays all approved projects not yet submitted or rejected by FAST
$sendProjects = $projectModel->getAll(['approval_status' => 'APPROVED']);
$sendProjectsFiltered = [];
foreach ($sendProjects as $p) {
    if (empty($p['fast_sync_status']) || $p['fast_sync_status'] === 'REJECTED') {
        $sendProjectsFiltered[] = $p;
    }
}

// Receive from FAST fetches transactions from FAST API
$receiveTransactions = fetchPendingFromFast();

// History of successfully received updates from FAST
$receivedHistory = [];
try {
    $receivedHistory = db()->fetchAll(
        "SELECT l.*, p.bactrack_id, p.title
           FROM integration_logs l
           LEFT JOIN projects p ON l.reference_id = p.id
          WHERE l.source_system = 'FAST'
            AND l.destination_system = 'BACtrack'
            AND l.sync_status = 'SUCCESS'
          ORDER BY l.id DESC
          LIMIT 50"
    );
} catch (Exception $e) {
    $receivedHistory = [];
}

$activeTab = $_GET['tab'] ?? 'receive';

// Add integrations to titles array dynamically
$pageTitle = 'Integrations';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div>
        <p style="color: var(--text-muted); margin: 4px 0 0;">Bidirectional synchronization with SDO-FAST</p>
    </div>
</div>

<div class="tabs" data-tabs>
    <button type="button" class="tab-btn<?php echo $activeTab === 'send' ? ' is-active' : ''; ?>" data-tab="send">
        Send to FAST
        <span class="tab-count"><?php echo count($sendProjectsFiltered); ?></span>
    </button>
    <button type="button" class="tab-btn<?php echo $activeTab === 'receive' ? ' is-active' : ''; ?>" data-tab="receive">
        Receive from FAST
        <span class="tab-count"><?php echo count($receiveTransactions); ?></span>
    </button>
    <button type="button" class="tab-btn<?php echo $activeTab === 'received' ? ' is-active' : ''; ?>" data-tab="received">
        Received History
        <span class="tab-count"><?php echo count($receivedHistory); ?></span>
    </button>
</div>

<div class="tab-panels">
    <section class="tab-panel<?php echo $activeTab === 'send' ? ' is-active' : ''; ?>" data-tab-panel="send">
        <h2 style="margin: 12px 0 12px; color: var(--text-primary); font-weight: 700; font-size: 1.25rem;">Send to FAST</h2>
        <div class="data-card" style="margin-bottom: 32px;">
    <?php if (empty($sendProjectsFiltered)): ?>
    <div class="empty-state">
        <div class="empty-icon"><i class="fas fa-paper-plane"></i></div>
        <h3>No projects pending sync</h3>
        <p>All approved BAC projects are synchronized with SDO-FAST.</p>
    </div>
    <?php else: ?>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="text-align: center;">Project ID</th>
                    <th style="text-align: center;">Project Title</th>
                    <th style="text-align: center;">Mode of Procurement</th>
                    <th style="text-align: center;">Project Proponent</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Implementation Date</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sendProjectsFiltered as $project): ?>
                <tr>
                    <td style="text-align: center; font-weight: 700; letter-spacing: 0.02em;">
                        <?php echo htmlspecialchars($project['bactrack_id'] ?? ('PR-' . str_pad((string)$project['id'], 4, '0', STR_PAD_LEFT))); ?>
                    </td>
                    <td>
                        <span style="color: #000; font-weight: 600;">
                            <?php echo htmlspecialchars($project['title']); ?>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <?php echo PROCUREMENT_TYPES[$project['procurement_type']] ?? $project['procurement_type']; ?>
                    </td>
                    <td style="text-align: center;">
                        <span><?php echo htmlspecialchars($project['creator_name'] ?? '-'); ?></span>
                    </td>
                    <td style="text-align: center;">
                        <?php $approval = $project['approval_status'] ?? 'APPROVED'; ?>
                        <span class="status-badge status-<?php echo strtolower(str_replace('_', '-', $approval)); ?>">
                            <?php echo PROJECT_APPROVAL_STATUSES[$approval] ?? $approval; ?>
                        </span>
                    </td>
                    <td style="text-align: center;"><?php echo date('M j, Y', strtotime(!empty($project['project_start_date']) ? $project['project_start_date'] : $project['created_at'])); ?></td>
                    <td style="text-align: center;">
                        <a href="<?php echo APP_URL; ?>/admin/project-view.php?id=<?php echo $project['id']; ?>" class="btn btn-primary btn-sm" style="padding: 6px 12px; font-size: 0.8rem; border-radius: 4px; display: inline-block; text-decoration: none;">
                            <i class="fas fa-eye" style="margin-right: 4px;"></i> View
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
        </div>
    </section>

    <section class="tab-panel<?php echo $activeTab === 'receive' ? ' is-active' : ''; ?>" data-tab-panel="receive">
        <h2 style="margin: 12px 0 12px; color: var(--text-primary); font-weight: 700; font-size: 1.25rem;">Receive from FAST</h2>
        <div class="data-card">
    <?php if (empty($receiveTransactions)): ?>
    <div class="empty-state">
        <div class="empty-icon"><i class="fas fa-download"></i></div>
        <h3>No pending data from FAST</h3>
        <p>There are no status updates or new vouchers to retrieve from SDO-FAST right now.</p>
    </div>
    <?php else: ?>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="text-align: center;">Project ID</th>
                    <th style="text-align: center;">Project Title</th>
                    <th style="text-align: center;">Mode of Procurement</th>
                    <th style="text-align: center;">Project Proponent</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Implementation Date</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($receiveTransactions as $tx): ?>
                <tr>
                    <td style="text-align: center; font-weight: 700; letter-spacing: 0.02em;">
                        <?php echo htmlspecialchars($tx['bac_reference_number']); ?>
                    </td>
                    <td>
                        <span style="color: #000; font-weight: 600;">
                            <?php echo htmlspecialchars($tx['event_name']); ?>
                        </span>
                        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">
                            FAST Ref: <?php echo htmlspecialchars($tx['tracking_number']); ?>
                            <?php if (!empty($tx['dv_number'])): ?> | DV: <?php echo htmlspecialchars($tx['dv_number']); ?><?php endif; ?>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <?php echo htmlspecialchars($tx['bac_procurement_type']); ?>
                    </td>
                    <td style="text-align: center;">
                        <span><?php echo htmlspecialchars($tx['requestor_name'] ?? '-'); ?></span>
                    </td>
                    <td style="text-align: center;">
                        <span class="status-badge" style="background-color: rgba(27, 74, 154, 0.1); color: var(--primary);">
                            <?php echo htmlspecialchars($tx['current_status']); ?>
                        </span>
                    </td>
                    <td style="text-align: center;"><?php echo date('M j, Y', strtotime($tx['created_at'])); ?></td>
                    <td style="text-align: center;">
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="receive_from_fast">
                            <input type="hidden" name="tracking_number" value="<?php echo htmlspecialchars($tx['tracking_number']); ?>">
                            <input type="hidden" name="tab" value="receive">
                            <button type="submit" class="btn btn-secondary btn-sm" style="padding: 6px 12px; font-size: 0.8rem; border-radius: 4px; background-color: #28a745; color: #fff; border: none;">
                                <i class="fas fa-download" style="margin-right: 4px;"></i> Receive
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
        </div>
    </section>

    <section class="tab-panel<?php echo $activeTab === 'received' ? ' is-active' : ''; ?>" data-tab-panel="received">
        <h2 style="margin: 12px 0 12px; color: var(--text-primary); font-weight: 700; font-size: 1.25rem;">Received History</h2>
        <div class="data-card">
            <?php if (empty($receivedHistory)): ?>
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-check-circle"></i></div>
                <h3>No received history yet</h3>
                <p>Successful FAST updates will appear here after you click Receive.</p>
            </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Project ID</th>
                            <th style="text-align: center;">Project Title</th>
                            <th style="text-align: center;">Event</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Received At</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($receivedHistory as $row): ?>
                        <tr>
                            <td style="text-align: center; font-weight: 700; letter-spacing: 0.02em;">
                                <?php echo htmlspecialchars($row['bactrack_id'] ?? '-'); ?>
                            </td>
                            <td>
                                <span style="color: #000; font-weight: 600;">
                                    <?php echo htmlspecialchars($row['title'] ?? 'Unknown Project'); ?>
                                </span>
                                <?php if (!empty($row['response_message'])): ?>
                                <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">
                                    <?php echo htmlspecialchars($row['response_message']); ?>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php echo htmlspecialchars($row['event_type']); ?>
                            </td>
                            <td style="text-align: center;">
                                <span class="status-badge status-approved">SUCCESS</span>
                            </td>
                            <td style="text-align: center;">
                                <?php echo !empty($row['created_at']) ? date('M j, Y g:i A', strtotime($row['created_at'])) : '-'; ?>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: inline-flex; align-items: center; gap: 6px;">
                                    <?php if (!empty($row['reference_id'])): ?>
                                        <a href="<?php echo APP_URL; ?>/admin/project-view.php?id=<?php echo (int) $row['reference_id']; ?>" class="btn btn-primary btn-sm" style="padding: 6px 12px; font-size: 0.8rem; border-radius: 4px; display: inline-block; text-decoration: none;">
                                            <i class="fas fa-eye" style="margin-right: 4px;"></i> View
                                        </a>
                                    <?php else: ?>
                                        <span style="color: var(--text-muted);">-</span>
                                    <?php endif; ?>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="delete_received_log">
                                        <input type="hidden" name="log_id" value="<?php echo (int) $row['id']; ?>">
                                        <button type="submit" class="btn btn-secondary btn-sm" style="padding: 6px 12px; font-size: 0.8rem; border-radius: 4px; background-color: #dc3545; color: #fff; border: none;">
                                            <i class="fas fa-trash" style="margin-right: 4px;"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
