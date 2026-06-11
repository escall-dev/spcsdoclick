<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Input Management - ELDP</title>
    <?php include BASE_PATH . 'includes/head.php'; ?>
    <!-- Bootstrap 5 for Modals -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo PUBLIC_ROOT; ?>css/admin/dashboard.css?v=<?php echo time(); ?>">

    <style>
        /* Override Bootstrap defaults to match project theme */
        .btn-primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        .btn-primary:hover {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
        }

        .system-input-card {
            background: var(--input-card-bg);
            border-radius: 16px;
            border: 1px solid var(--input-border);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card-header-premium {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 24px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title-group h2 {
            font-weight: 800;
            margin: 0;
            font-size: 1.5rem;
            letter-spacing: -0.02em;
        }

        .header-title-group p {
            margin: 4px 0 0;
            opacity: 0.8;
            font-size: 0.85rem;
        }

        .table-container {
            padding: 0;
        }

        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .custom-table th {
            background: #f8fafc;
            padding: 16px 24px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            border-bottom: 1px solid var(--input-border);
        }

        .custom-table td {
            padding: 16px 24px;
            vertical-align: middle;
            border-bottom: 1px solid var(--input-border);
            transition: background 0.2s ease;
        }

        .custom-table tr:last-child td {
            border-bottom: none;
        }

        .custom-table tr:hover td {
            background: var(--input-hover);
        }

        .code-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            background: #eff6ff;
            color: #2563eb;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            border: 1px solid #dbeafe;
        }

        .description-text {
            color: #475569;
            font-size: 0.9rem;
            max-width: 400px;
            line-height: 1.5;
        }

        .action-cell {
            text-align: right;
            white-space: nowrap;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 8px;
            transition: all 0.2s ease;
            border: 1px solid #e2e8f0;
            background: white;
            color: #64748b;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .btn-edit:hover {
            color: #2563eb;
            border-color: #2563eb;
            background: #eff6ff;
        }

        .btn-delete:hover {
            color: #dc2626;
            border-color: #dc2626;
            background: #fef2f2;
        }

        .empty-state-premium {
            padding: 80px 40px;
            text-align: center;
            background: white;
            border-radius: 16px;
            border: 2px dashed #e2e8f0;
        }

        .empty-icon-wrapper {
            width: 80px;
            height: 80px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: #94a3b8;
            font-size: 2.5rem;
        }

        .empty-state-premium h3 {
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .empty-state-premium p {
            color: #64748b;
            max-width: 300px;
            margin: 0 auto 24px;
        }

        .modal-content-premium {
            border-radius: 20px;
            border: none;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .modal-header-premium {
            background: #f8fafc;
            padding: 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-title-premium {
            font-weight: 800;
            color: #1e293b;
        }

        .modal-body-premium {
            padding: 24px;
        }

        .form-label-premium {
            font-weight: 700;
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .form-control-premium {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            transition: all 0.2s ease;
        }

        .form-control-premium:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(15, 76, 117, 0.1);
        }

        .modal-footer-premium {
            padding: 16px 24px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        /* Fix: Ensure modal is above the sidebar (which is z-index 9999) */
        .modal {
            z-index: 10060 !important;
        }
        .modal-backdrop {
            z-index: 10050 !important;
        }

        /* Fix: Modal width and centering */
        .modal-dialog-premium {
            max-width: 500px !important;
            margin: 1.75rem auto;
        }

        @media (max-width: 576px) {
            .modal-dialog-premium {
                margin: 1rem;
                max-width: none !important;
            }
        }

        /* Tab Styles */
        .management-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            padding: 6px;
            background: #f1f5f9;
            border-radius: 14px;
            width: fit-content;
        }

        .tab-item {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.9rem;
            color: #64748b;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tab-item:hover {
            color: var(--primary);
            background: rgba(255, 255, 255, 0.5);
        }

        .tab-item.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <?php include BASE_PATH . 'includes/sidebar.php'; ?>
        
        <?php if (isset($_SESSION['toast'])): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '<?php echo $_SESSION['toast']['title']; ?>',
                        text: '<?php echo $_SESSION['toast']['message']; ?>',
                        icon: '<?php echo $_SESSION['toast']['type']; ?>',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                });
            </script>
            <?php unset($_SESSION['toast']); ?>
        <?php endif; ?>

        <div class="main-content">
            <header class="top-bar">
                <div class="top-bar-left">
                    <div class="breadcrumb">
                        <h1 class="page-title">System Input</h1>
                    </div>
                </div>
                <div class="top-bar-right">
                    <button class="btn btn-primary" onclick="openAddModal()">
                        <i class="bi bi-plus-lg"></i> Add New Input
                    </button>
                </div>
            </header>

            <main class="content-wrapper">
                <!-- Tab Navigation -->
                <div class="management-tabs">
                    <button class="tab-item active" id="tab-codes" onclick="switchTab('codes')">
                        <i class="bi bi-hash"></i> Training Reference Codes
                    </button>
                    <button class="tab-item" id="tab-competencies" onclick="switchTab('competencies')">
                        <i class="bi bi-award"></i> System Competencies
                    </button>
                    <button class="tab-item" id="tab-classifications" onclick="switchTab('classifications')">
                        <i class="bi bi-diagram-3"></i> Classifications
                    </button>
                    <button class="tab-item" id="tab-modalities" onclick="switchTab('modalities')">
                        <i class="bi bi-layers"></i> Modalities
                    </button>
                    <button class="tab-item" id="tab-ld_types" onclick="switchTab('ld_types')">
                        <i class="bi bi-briefcase"></i> Types of L&D
                    </button>
                    <button class="tab-item" id="tab-job_embedded_learning" onclick="switchTab('job_embedded_learning')">
                        <i class="bi bi-briefcase-fill"></i> Job Embedded Learning
                    </button>
                </div>

                <!-- Training Codes Section -->
                <div id="codes-section" class="tab-content">
                    <div class="system-input-card">
                        <div class="card-header-premium">
                            <div class="header-title-group">
                                <h2>Training Reference Codes</h2>
                                <p>Manage pre-defined codes for L&D activity categorization.</p>
                            </div>
                            <div class="header-stats">
                                <span class="badge bg-white rounded-pill px-3 py-2 font-weight-bold" style="color: var(--primary);">
                                    <?php echo count($training_codes); ?> Total Codes
                                </span>
                            </div>
                        </div>

                        <?php if (empty($training_codes)): ?>
                            <div class="p-4">
                                <div class="empty-state-premium">
                                    <div class="empty-icon-wrapper">
                                        <i class="bi bi-gear-wide-connected"></i>
                                    </div>
                                    <h3>No Reference Codes Found</h3>
                                    <p>Start by adding codes that users will use to categorize their activities.</p>
                                    <button class="btn btn-primary px-4 py-2 rounded-pill" onclick="openAddModal('activity_code')">
                                        <i class="bi bi-plus-lg me-2"></i>Create First Code
                                    </button>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="table-container">
                                <table class="custom-table">
                                    <thead>
                                        <tr>
                                            <th>Reference Code</th>
                                            <th>Category Name</th>
                                            <th>Description</th>
                                            <th>Date Created</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($training_codes as $code): ?>
                                            <tr>
                                                <td>
                                                    <span class="code-pill">
                                                        <i class="bi bi-hash me-1"></i>
                                                        <?php echo htmlspecialchars($code['code_name']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="fw-bold text-dark">
                                                        <?php echo htmlspecialchars($code['title'] ?: '—'); ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="description-text">
                                                        <?php echo htmlspecialchars($code['description'] ?: 'No description provided.'); ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted small">
                                                        <?php echo date('M d, Y', strtotime($code['created_at'])); ?>
                                                    </span>
                                                </td>
                                                <td class="action-cell">
                                                    <button class="btn-action btn-edit" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editModal_activity_code_<?php echo $code['id']; ?>"
                                                            title="Edit Input">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                    <button class="btn-action btn-delete"
                                                            onclick="confirmDelete(<?php echo $code['id']; ?>, '<?php echo addslashes($code['code_name']); ?>', 'activity_code')"
                                                            title="Delete Input">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Competencies Section -->
                <div id="competencies-section" class="tab-content" style="display: none;">
                    <div class="system-input-card">
                        <div class="card-header-premium" style="background: linear-gradient(135deg, #e53e3e 0%, #9b2c2c 100%);">
                            <div class="header-title-group">
                                <h2>System Competencies</h2>
                                <p>Pre-defined competencies for individual learning and development needs.</p>
                            </div>
                            <div class="header-stats">
                                <span class="badge bg-white rounded-pill px-3 py-2 font-weight-bold" style="color: #e53e3e;">
                                    <?php echo count($competencies); ?> Total Competencies
                                </span>
                            </div>
                        </div>

                        <?php if (empty($competencies)): ?>
                            <div class="p-4">
                                <div class="empty-state-premium">
                                    <div class="empty-icon-wrapper" style="color: var(--primary); background: #eef2ff;">
                                        <i class="bi bi-award"></i>
                                    </div>
                                    <h3>No Competencies Found</h3>
                                    <p>Create a list of competencies that users can choose from in their activities and profiles.</p>
                                    <button class="btn px-4 py-2 rounded-pill" style="background: var(--primary); color: white;" onclick="openAddModal('competency')">
                                        <i class="bi bi-plus-lg me-2"></i>Create First Competency
                                    </button>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="table-container">
                                <table class="custom-table">
                                    <thead>
                                        <tr>
                                            <th>Competency Name</th>
                                            <th>Description</th>
                                            <th>Date Created</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($competencies as $comp): ?>
                                            <tr>
                                                <td>
                                                    <span class="code-pill" style="background: #e1f5fe; color: var(--primary); border-color: #b3e5fc;">
                                                        <i class="bi bi-award me-1"></i>
                                                        <?php echo htmlspecialchars($comp['code_name']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="description-text">
                                                        <?php echo htmlspecialchars($comp['description'] ?: 'No description provided.'); ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted small">
                                                        <?php echo date('M d, Y', strtotime($comp['created_at'])); ?>
                                                    </span>
                                                </td>
                                                <td class="action-cell">
                                                    <button class="btn-action btn-edit" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editModal_competency_<?php echo $comp['id']; ?>"
                                                            title="Edit Competency">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                    <button class="btn-action btn-delete"
                                                            onclick="confirmDelete(<?php echo $comp['id']; ?>, '<?php echo addslashes($comp['code_name']); ?>', 'competency')"
                                                            title="Delete Competency">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Classifications Section -->
                <div id="classifications-section" class="tab-content" style="display: none;">
                    <div class="system-input-card">
                        <div class="card-header-premium" style="background: linear-gradient(135deg, #1b4a9a 0%, #12336b 100%);">
                            <div class="header-title-group">
                                <h2>Personnel Classifications</h2>
                                <p>Manage available classification types for personnel records.</p>
                            </div>
                            <div class="header-stats">
                                <span class="badge bg-white text-primary rounded-pill px-3 py-2 font-weight-bold">
                                    <?php echo (isset($classifications) ? count($classifications) : 0); ?> Classifications
                                </span>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>Classification Name</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($classifications)): foreach ($classifications as $item): ?>
                                        <tr>
                                            <td><div class="fw-bold text-dark"><?php echo htmlspecialchars($item['name']); ?></div></td>
                                            <td class="action-cell">
                                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editModal_classification_<?php echo $item['id']; ?>">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <button class="btn-action btn-delete" onclick="confirmDelete(<?php echo $item['id']; ?>, '<?php echo addslashes($item['name']); ?>', 'classification')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modalities Section -->
                <div id="modalities-section" class="tab-content" style="display: none;">
                    <div class="system-input-card">
                        <div class="card-header-premium" style="background: linear-gradient(135deg, #48bb78 0%, #2f855a 100%);">
                            <div class="header-title-group">
                                <h2>Training Modalities</h2>
                                <p>Manage delivery formats for L&D activities.</p>
                            </div>
                            <div class="header-stats">
                                <span class="badge bg-white text-success rounded-pill px-3 py-2 font-weight-bold">
                                    <?php echo (isset($modalities) ? count($modalities) : 0); ?> Modalities
                                </span>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>Modality Name</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($modalities)): foreach ($modalities as $item): ?>
                                        <tr>
                                            <td><div class="fw-bold text-dark"><?php echo htmlspecialchars($item['name']); ?></div></td>
                                            <td class="action-cell">
                                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editModal_modality_<?php echo $item['id']; ?>">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <button class="btn-action btn-delete" onclick="confirmDelete(<?php echo $item['id']; ?>, '<?php echo addslashes($item['name']); ?>', 'modality')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- LD Types Section -->
                <div id="ld_types-section" class="tab-content" style="display: none;">
                    <div class="system-input-card">
                        <div class="card-header-premium" style="background: linear-gradient(135deg, #ed8936 0%, #c05621 100%);">
                            <div class="header-title-group">
                                <h2>Types of L&D</h2>
                                <p>Manage specialized L&D categories and domains.</p>
                            </div>
                            <div class="header-stats">
                                <span class="badge bg-white text-warning rounded-pill px-3 py-2 font-weight-bold" style="color: #c05621 !important;">
                                    <?php echo (isset($ld_types) ? count($ld_types) : 0); ?> L&D Types
                                </span>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>L&D Type Name</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($ld_types)): foreach ($ld_types as $item): ?>
                                        <tr>
                                            <td><div class="fw-bold text-dark"><?php echo htmlspecialchars($item['name']); ?></div></td>
                                            <td class="action-cell">
                                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editModal_ld_type_<?php echo $item['id']; ?>">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <button class="btn-action btn-delete" onclick="confirmDelete(<?php echo $item['id']; ?>, '<?php echo addslashes($item['name']); ?>', 'ld_type')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Job Embedded Learning Section -->
                <div id="job_embedded_learning-section" class="tab-content" style="display: none;">
                    <div class="system-input-card">
                        <div class="card-header-premium" style="background: linear-gradient(135deg, #4f46e5 0%, #312e81 100%);">
                            <div class="header-title-group">
                                <h2>Job Embedded Learning</h2>
                                <p>Manage choices for Job Embedded Learning dropdown.</p>
                            </div>
                            <div class="header-stats">
                                <span class="badge bg-white rounded-pill px-3 py-2 font-weight-bold" style="color: #4f46e5 !important;">
                                    <?php echo (isset($job_embedded_learnings) ? count($job_embedded_learnings) : 0); ?> Choices
                                </span>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>Choice Name</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($job_embedded_learnings)): foreach ($job_embedded_learnings as $item): ?>
                                        <tr>
                                            <td><div class="fw-bold text-dark"><?php echo htmlspecialchars($item['name']); ?></div></td>
                                            <td class="action-cell">
                                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editModal_job_embedded_learning_<?php echo $item['id']; ?>">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <button class="btn-action btn-delete" onclick="confirmDelete(<?php echo $item['id']; ?>, '<?php echo addslashes($item['name']); ?>', 'job_embedded_learning')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modals -->
    <?php 
    $groups = [
        ['items' => $training_codes, 'cat' => 'activity_code', 'label' => 'Training Code'],
        ['items' => $competencies, 'cat' => 'competency', 'label' => 'Competency'],
        ['items' => $classifications, 'cat' => 'classification', 'label' => 'Classification'],
        ['items' => $modalities, 'cat' => 'modality', 'label' => 'Modality'],
        ['items' => $ld_types, 'cat' => 'ld_type', 'label' => 'L&D Type'],
        ['items' => $job_embedded_learnings, 'cat' => 'job_embedded_learning', 'label' => 'Job Embedded Learning']
    ];

    foreach ($groups as $group):
        if (!empty($group['items'])):
            foreach ($group['items'] as $item): 
                $itemName = ($group['cat'] === 'activity_code' || $group['cat'] === 'competency') ? $item['code_name'] : $item['name'];
                ?>
                <div class="modal fade" id="editModal_<?php echo $group['cat']; ?>_<?php echo $item['id']; ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-premium">
                        <div class="modal-content modal-content-premium">
                            <div class="modal-header-premium">
                                <h5 class="modal-title-premium">Update <?php echo $group['label']; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="<?php echo PUBLIC_ROOT; ?>index.php/admin/system-input" method="POST">
                                <div class="modal-body-premium">
                                    <input type="hidden" name="code_id" value="<?php echo $item['id']; ?>">
                                    <input type="hidden" name="category" value="<?php echo $group['cat']; ?>">
                                    
                                    <div class="mb-4">
                                        <label class="form-label-premium"><?php echo $group['label']; ?> Name</label>
                                        <input type="text" name="code_name" class="form-control form-control-premium" required value="<?php echo htmlspecialchars($itemName); ?>">
                                    </div>

                                    <?php if ($group['cat'] === 'activity_code'): ?>
                                        <div class="mb-4">
                                            <label class="form-label-premium">Category Name</label>
                                            <input type="text" name="title" class="form-control form-control-premium" value="<?php echo htmlspecialchars($item['title'] ?? ''); ?>" placeholder="Enter the category name...">
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($group['cat'] === 'activity_code' || $group['cat'] === 'competency'): ?>
                                        <div class="mb-2">
                                            <label class="form-label-premium">Detailed Description</label>
                                            <textarea name="description" class="form-control form-control-premium" rows="4"><?php echo htmlspecialchars($item['description'] ?? ''); ?></textarea>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="modal-footer-premium">
                                    <div class="d-flex gap-2 w-100">
                                        <button type="button" class="btn btn-light rounded-pill px-4 flex-grow-1" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="update_code" class="btn btn-primary rounded-pill px-4 flex-grow-1">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <div class="modal fade" id="addCodeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-premium">
            <div class="modal-content modal-content-premium">
                <div class="modal-header-premium">
                    <h5 class="modal-title-premium" id="addModalTitle">Add System Input</h5>
                    <p class="text-muted small mb-0" id="addModalSubtitle">Create a new entry for the system.</p>
                </div>
                <form action="<?php echo PUBLIC_ROOT; ?>index.php/admin/system-input" method="POST">
                    <div class="modal-body-premium">
                        <input type="hidden" name="category" id="input_category" value="activity_code">
                        <div class="mb-4">
                            <label class="form-label-premium" id="nameLabel">Input Name / Code</label>
                            <input type="text" name="code_name" class="form-control form-control-premium" required placeholder="e.g., TC-001 or LEAD-01" id="nameInput">
                        </div>
                        <div class="mb-4" id="addTitleGroup">
                            <label class="form-label-premium">Category Name</label>
                            <input type="text" name="title" class="form-control form-control-premium" placeholder="Enter the category name...">
                        </div>
                        <div class="mb-2" id="addDescGroup">
                            <label class="form-label-premium">Detailed Description</label>
                            <textarea name="description" class="form-control form-control-premium" rows="4" placeholder="Briefly explain what this represents..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer-premium">
                        <div class="d-flex gap-2 w-100">
                            <button type="button" class="btn btn-light rounded-pill px-4 flex-grow-1" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="add_code" class="btn btn-primary rounded-pill px-4 flex-grow-1">Create Entry</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="delete-form" action="<?php echo PUBLIC_ROOT; ?>index.php/admin/system-input" method="POST" style="display:none;">
        <input type="hidden" name="code_id" id="delete-id">
        <input type="hidden" name="category" id="delete-category">
        <input type="hidden" name="delete_code" value="1">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentCategory = 'activity_code';

        function switchTab(tab) {
            // Mapping UI tab to internal category
            const categoryMap = {
                'codes': 'activity_code',
                'competencies': 'competency',
                'classifications': 'classification',
                'modalities': 'modality',
                'ld_types': 'ld_type',
                'job_embedded_learning': 'job_embedded_learning'
            };
            
            currentCategory = categoryMap[tab];
            
            // Toggle visibility of all tab contents
            document.querySelectorAll('.tab-content').forEach(section => section.style.display = 'none');
            const targetSection = document.getElementById(tab + '-section');
            if (targetSection) targetSection.style.display = 'block';
            
            // Toggle active class on tabs
            document.querySelectorAll('.tab-item').forEach(btn => btn.classList.remove('active'));
            const targetTab = document.getElementById('tab-' + tab);
            if (targetTab) targetTab.classList.add('active');
        }

        function openAddModal(category = null) {
            const cat = category || currentCategory;
            document.getElementById('input_category').value = cat;
            
            const titleEl = document.getElementById('addModalTitle');
            const subtitleEl = document.getElementById('addModalSubtitle');
            const titleGroup = document.getElementById('addTitleGroup');
            const descGroup = document.getElementById('addDescGroup');
            const nameLabel = document.getElementById('nameLabel');
            const nameInput = document.getElementById('nameInput');

            // Reset defaults
            titleGroup.style.display = 'none';
            descGroup.style.display = 'block';
            nameLabel.innerText = 'Input Name / Code';
            nameInput.placeholder = 'Enter name...';

            if (cat === 'competency') {
                titleEl.innerText = 'Add New Competency';
                subtitleEl.innerText = 'Define a new skill or knowledge area for personnel.';
                nameLabel.innerText = 'Competency Name';
            } else if (cat === 'activity_code') {
                titleEl.innerText = 'Add Training Code';
                subtitleEl.innerText = 'Create a new reference code for activity tracking.';
                titleGroup.style.display = 'block';
            } else if (cat === 'classification') {
                titleEl.innerText = 'Add Classification';
                subtitleEl.innerText = 'Create a new classification type (e.g., Teaching, Non-Teaching).';
                nameLabel.innerText = 'Classification Name';
                descGroup.style.display = 'none';
            } else if (cat === 'modality') {
                titleEl.innerText = 'Add Modality';
                subtitleEl.innerText = 'Create a new training modality (e.g., Face-to-Face, Virtual).';
                nameLabel.innerText = 'Modality Name';
                descGroup.style.display = 'none';
            } else if (cat === 'ld_type') {
                titleEl.innerText = 'Add Type of L&D';
                subtitleEl.innerText = 'Create a new L&D type (e.g., Managerial, Technical).';
                nameLabel.innerText = 'L&D Type Name';
                descGroup.style.display = 'none';
            } else if (cat === 'job_embedded_learning') {
                titleEl.innerText = 'Add Job Embedded Learning';
                subtitleEl.innerText = 'Create a new Job Embedded Learning option.';
                nameLabel.innerText = 'Option Name';
                descGroup.style.display = 'none';
            }
            
            new bootstrap.Modal(document.getElementById('addCodeModal')).show();
        }

        function confirmDelete(id, name, category) {
            Swal.fire({
                title: 'Delete System Input?',
                html: `Are you sure you want to remove <b class="text-danger">${name}</b>?<br>This may affect existing records using this entry.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                padding: '2em',
                customClass: {
                    container: 'premium-swal'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-id').value = id;
                    document.getElementById('delete-category').value = category;
                    document.getElementById('delete-form').submit();
                }
            })
        }

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            if (tab) {
                switchTab(tab);
            }
        };
    </script>
</body>
</html>
