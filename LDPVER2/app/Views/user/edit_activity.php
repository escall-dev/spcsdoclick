<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Activity Record - LDP</title>
    <?php include BASE_PATH . 'includes/head.php'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo PUBLIC_ROOT; ?>css/user/common_branded_header.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="app-layout">
        <?php include BASE_PATH . 'includes/sidebar.php'; ?>

        <div class="main-content">
            <header class="top-bar">
                <div class="top-bar-left">
                    <div class="breadcrumb">
                        <h1 class="page-title">Edit Activity</h1>
                    </div>
                </div>
                <div class="top-bar-right">
                    <div class="current-date-box">
                        <div class="time-section">
                            <span id="real-time-clock">
                                <?php echo date('h:i:s A'); ?>
                            </span>
                        </div>
                        <div class="date-section">
                            <i class="bi bi-calendar3"></i>
                            <span>
                                <?php echo date('F j, Y'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="content-wrapper">
                <div class="dashboard-card"
                    style="max-width: 900px; margin: 0 auto; overflow: hidden; border-radius: var(--radius-xl);">
                    <!-- Activity Branded Header -->
                    <div class="activity-branded-header">
                        <div class="header-logo-container">
                            <img src="<?php echo PUBLIC_ROOT; ?>assets/LogoLDP.png" alt="LDP Logo" class="branded-logo">
                        </div>
                        <div class="header-content">
                            <span class="system-badge">Modify Record</span>
                            <h1 class="header-main-title">Learning & Development Record</h1>
                            <p class="header-subtitle">Schools Division Office - Update Activity</p>
                        </div>
                    </div>

                    <div class="card-body" style="padding: 40px;">
                        <?php if (isset($is_locked) && $is_locked): ?>
                            <div
                                style="margin-bottom: 30px; padding: 20px; background: #fffbeb; border: 1px solid #fef3c7; border-radius: 12px; display: flex; align-items: center; gap: 15px;">
                                <div
                                    style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #fef3c7; border-radius: 50%;">
                                    <i class="bi bi-lock-fill" style="font-size: 1.2rem; color: #b45309;"></i>
                                </div>
                                <div style="flex: 1;">
                                    <h4 style="margin: 0; color: #92400e; font-weight: 700; font-size: 1rem;">Documentation
                                        Required</h4>
                                    <p style="margin: 5px 0 0; color: #b45309; font-size: 0.85rem;">This activity record has
                                        been reviewed, but requires <strong>mandatory documentation updates</strong>. You
                                        may only update the <strong>Workplace Application Plan</strong> and
                                        <strong>Application of Learning</strong> attachments. Other fields are restricted to
                                        maintain record integrity.</p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form id="activity-form" method="POST" enctype="multipart/form-data">

                            <!-- Section 1: Basic Information -->
                            <div class="form-section">
                                <div class="form-section-header">
                                    <i class="bi bi-info-circle"></i>
                                    <h3>Basic Information</h3>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Activity Title <span
                                            style="color: var(--danger);">*</span></label>
                                    <input type="text" name="title" id="activity_title" class="form-control"
                                        value="<?php echo htmlspecialchars($activity['title']); ?>"
                                        placeholder="Enter activity title (e.g. 3-Day Capacity Building on Digital Literacy)"
                                        required <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Code Category (Reference Code) <span
                                            style="color: var(--danger);">*</span></label>
                                    <select id="training_reference_select" name="training_code" class="form-control"
                                        required <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                        <option value="" disabled>Type to search by code or category name...</option>
                                        <?php foreach ($training_codes as $code): ?>
                                            <option value="<?php echo htmlspecialchars($code['code_name']); ?>"
                                                data-title="<?php echo htmlspecialchars($code['title'] ?? ''); ?>"
                                                data-desc="<?php echo htmlspecialchars($code['description'] ?? ''); ?>"
                                                <?php echo (isset($activity['training_code']) && $activity['training_code'] == $code['code_name']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($code['code_name'] . ' - ' . ($code['title'] ?? 'No Title')); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                                    <div class="form-group">
                                        <label class="form-label">Date(s) Attended <span
                                                style="color: var(--danger);">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                                            <input type="text" name="date_attended" id="date_picker"
                                                class="form-control"
                                                value="<?php echo htmlspecialchars($activity['date_attended']); ?>"
                                                required <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Venue <span
                                                style="color: var(--danger);">*</span></label>
                                        <input type="text" name="venue" class="form-control" required
                                            value="<?php echo htmlspecialchars($activity['venue']); ?>" <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                    </div>
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                                    <div class="form-group">
                                        <label class="form-label">Addressed Competency/ies <span
                                                style="color: var(--danger);">*</span></label>
                                        <select id="competency_select" name="competency[]" class="form-control"
                                            placeholder="Select or type learning needs..." required multiple <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                            <?php
                                            $selected_competencies = explode(', ', $activity['competency']);
                                            ?>
                                            <option value="Relevant Expertise" <?php echo in_array('Relevant Expertise', $selected_competencies) ? 'selected' : ''; ?>>Relevant Expertise
                                            </option>

                                            <?php if (!empty($competencies)): ?>
                                                <optgroup label="System Competencies">
                                                    <?php foreach ($competencies as $comp): ?>
                                                        <option value="<?php echo htmlspecialchars($comp['code_name']); ?>"
                                                            <?php echo in_array($comp['code_name'], $selected_competencies) ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($comp['code_name']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </optgroup>
                                            <?php endif; ?>

                                            <optgroup label="Your Personal Needs (ILDN)">
                                                <?php foreach ($user_ildns as $ildn): ?>
                                                    <option value="<?php echo htmlspecialchars($ildn['need_text']); ?>"
                                                        <?php echo in_array($ildn['need_text'], $selected_competencies) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($ildn['need_text']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Classification <span style="color: var(--danger);"
                                                id="req-classification">*</span></label>
                                        <select id="classification_select" name="classification[]" class="form-control"
                                            required multiple placeholder="Select classification..." <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                            <?php
                                            $selected_classifications = !empty($activity['classification']) ? explode(', ', $activity['classification']) : [];
                                            foreach ($classifications as $classItem): ?>
                                                <option value="<?php echo htmlspecialchars($classItem['name']); ?>" <?php echo in_array($classItem['name'], $selected_classifications) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($classItem['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Modalities & Type -->
                            <div class="form-section">
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
                                    <div>
                                        <div class="form-section-header">
                                            <i class="bi bi-diagram-3"></i>
                                            <h3>Modality <span style="color: var(--danger);" id="req-modality">*</span>
                                            </h3>
                                        </div>
                                        <select id="modality_select" name="modality" class="form-control" required
                                            placeholder="Select modality..." <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                            <option value="" disabled>Select modality...</option>
                                            <?php foreach ($modalities as $mod): ?>
                                                <option value="<?php echo htmlspecialchars($mod['name']); ?>" <?php echo $activity['modality'] == $mod['name'] ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($mod['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div>
                                        <div class="form-section-header">
                                            <i class="bi bi-tags"></i>
                                            <h3>Type of L&D <span style="color: var(--danger);" id="req-type">*</span>
                                            </h3>
                                        </div>
                                        <select id="type_ld_select" name="type_ld" class="form-control" required
                                            placeholder="Select type of L&D..." <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                            <option value="" disabled>Select type of L&D...</option>
                                            <?php foreach ($ld_types as $type): ?>
                                                <option value="<?php echo htmlspecialchars($type['name']); ?>" <?php echo $activity['type_ld'] == $type['name'] ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($type['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                        <div id="type-others-input-container"
                                            style="display: <?php echo $activity['type_ld'] == 'Others' ? 'block' : 'none'; ?>; margin-top: 12px;">
                                            <input type="text" name="type_ld_others" class="form-control"
                                                placeholder="Please specify type..."
                                                value="<?php echo htmlspecialchars($activity['type_ld_others']); ?>"
                                                <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 24px;">
                                    <div class="form-section-header">
                                        <i class="bi bi-briefcase"></i>
                                        <h3>Job Embedded Learning</h3>
                                    </div>
                                    <select id="job_embedded_learning_select" name="job_embedded_learning" class="form-control"
                                        placeholder="Select job embedded learning..." <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                        <option value="" disabled selected>Select job embedded learning...</option>
                                        <?php foreach ($job_embedded_learnings as $jel): ?>
                                            <option value="<?php echo htmlspecialchars($jel['name']); ?>" <?php echo ($activity['job_embedded_learning'] ?? '') == $jel['name'] ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($jel['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Section 4: Application of Learning Plan -->
                            <div class="form-section">
                                <div class="form-section-header">
                                    <i class="bi bi-lightbulb"></i>
                                    <h3>Application of Learning Plan</h3>
                                </div>

                                <div class="form-group">
                                    <?php if (!empty($activity['application_file_path'])): ?>
                                        <label class="current-file-label">Current Supporting Documents (Click <i
                                                class="bi bi-x-circle-fill" style="color: #e11d48;"></i> to remove)</label>
                                        <div class="current-files-grid" id="current-app-grid" style="margin-bottom: 20px;">
                                            <?php foreach (explode(', ', $activity['application_file_path']) as $file):
                                                if (empty($file))
                                                    continue; ?>
                                                <div class="current-file-item"
                                                    style="position: relative; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px; display: flex; align-items: center; justify-content: center; background: #f8fafc;">
                                                    <i class="bi bi-file-earmark-text"
                                                        style="font-size: 2.5rem; color: var(--primary);"></i>
                                                    <input type="hidden" name="retained_application_files[]"
                                                        value="<?php echo htmlspecialchars($file); ?>">
                                                    <button type="button" class="btn-remove-existing"
                                                        onclick="this.parentElement.remove()" title="Remove this file"
                                                        style="position: absolute; top: -5px; right: -5px; width: 20px; height: 20px; border-radius: 50%; background: #e11d48; color: white; border: 1px solid white; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10;">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                    <a href="<?php echo PUBLIC_ROOT . $file; ?>" target="_blank"
                                                        style="position: absolute; bottom: 5px; font-size: 0.65rem; color: var(--primary); text-decoration: none; font-weight: 700;">VIEW</a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <label class="premium-label" style="display: block;">
                                        Supporting Document
                                        <i
                                            style="display: block; text-transform: none; font-weight: 500; font-size: 0.7rem; margin-top: 4px; color: var(--primary);">For
                                            final training approval this field must be updated</i>
                                    </label>
                                    <div class="file-drop-zone" id="app-drop-zone"
                                        onclick="document.getElementById('application_file').click()"
                                        style="padding: 20px; min-height: auto;">
                                        <i class="bi bi-cloud-arrow-up" style="font-size: 2rem;"></i>
                                        <p style="font-size: 0.9rem;">Click to upload files (Images or Document)</p>
                                        <span class="upload-hint" style="font-size: 0.75rem;">Drag and drop your files
                                            here or click to browse</span>
                                        <input type="file" name="application_file[]" id="application_file"
                                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" multiple hidden <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                    </div>
                                    <div id="app-file-list"
                                        style="display: flex; flex-wrap: wrap; gap: 8px; justify: center; margin-top: 15px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3: Completion Report -->
                            <div class="form-section">
                                <div class="form-section-header">
                                    <i class="bi bi-file-earmark-check"></i>
                                    <h3>Completion Report</h3>
                                </div>

                                <div class="form-group">
                                    <?php if (!empty($activity['completion_report_path'])): ?>
                                        <label class="current-file-label">Current Completion Report (Click <i class="bi bi-x-circle-fill" style="color: #e11d48;"></i> to remove)</label>
                                        <div class="current-files-grid" id="current-completion-grid" style="margin-bottom: 20px;">
                                            <?php foreach (explode(', ', $activity['completion_report_path']) as $img):
                                                if (empty($img))
                                                    continue; 
                                                $isImg = in_array(strtolower(pathinfo($img, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                                ?>
                                                <div class="current-file-item" style="position: relative;">
                                                    <?php if ($isImg): ?>
                                                        <img src="<?php echo PUBLIC_ROOT . $img; ?>" alt="Completion Report">
                                                    <?php else: ?>
                                                        <div style="height: 100px; display: flex; align-items: center; justify-content: center; background: #f1f5f9;">
                                                            <i class="bi bi-file-earmark-text" style="font-size: 2rem; color: var(--primary);"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <input type="hidden" name="retained_completion_reports[]" value="<?php echo htmlspecialchars($img); ?>">
                                                    <button type="button" class="btn-remove-existing"
                                                        onclick="this.parentElement.remove()" title="Remove this file"
                                                        style="position: absolute; top: 5px; right: 5px; width: 24px; height: 24px; border-radius: 50%; background: #e11d48; color: white; border: 2px solid white; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.2); transition: all 0.2s ease; z-index: 10;">
                                                        <i class="bi bi-x" style="font-size: 1.2rem; line-height: 1;"></i>
                                                    </button>
                                                    <a href="<?php echo PUBLIC_ROOT . $img; ?>" target="_blank"
                                                        style="position: absolute; bottom: 5px; left: 50%; transform: translateX(-50%); font-size: 0.65rem; color: white; background: rgba(0,0,0,0.5); padding: 2px 8px; border-radius: 4px; text-decoration: none; font-weight: 700;">VIEW</a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <label class="premium-label" style="display: block;">
                                        Completion Report Document
                                        <i style="display: block; text-transform: none; font-weight: 500; font-size: 0.7rem; margin-top: 4px; color: var(--primary);">For final training approval this field must be updated</i>
                                    </label>
                                    <div class="file-drop-zone" id="completion-drop-zone"
                                        onclick="document.getElementById('completion_report').click()"
                                        style="padding: 20px; min-height: auto;">
                                        <i class="bi bi-cloud-arrow-up" style="font-size: 2rem;"></i>
                                        <p style="font-size: 0.9rem;">Click to upload Completion Report (Images, PDF, or Document)</p>
                                        <span class="upload-hint" style="font-size: 0.75rem;">Drag and drop your files here or click to browse</span>
                                        <input type="file" name="completion_report[]" id="completion_report" multiple hidden>
                                    </div>
                                    <div id="completion-file-list"
                                        style="display: flex; flex-wrap: wrap; gap: 8px; justify: center; margin-top: 15px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3b: Certificate of Utilization/Adaptation -->
                            <div class="form-section">
                                <div class="form-section-header">
                                    <i class="bi bi-journal-check"></i>
                                    <h3>Certificate of Utilization/Adaptation</h3>
                                </div>

                                <div class="form-group">
                                    <?php if (!empty($activity['certificate_utilization_path'])): ?>
                                        <label class="current-file-label">Current Certificate of Utilization (Click <i class="bi bi-x-circle-fill" style="color: #e11d48;"></i> to remove)</label>
                                        <div class="current-files-grid" id="current-utilization-grid" style="margin-bottom: 20px;">
                                            <?php foreach (explode(', ', $activity['certificate_utilization_path']) as $img):
                                                if (empty($img))
                                                    continue; 
                                                $isImg = in_array(strtolower(pathinfo($img, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                                ?>
                                                <div class="current-file-item" style="position: relative;">
                                                    <?php if ($isImg): ?>
                                                        <img src="<?php echo PUBLIC_ROOT . $img; ?>" alt="Certificate of Utilization">
                                                    <?php else: ?>
                                                        <div style="height: 100px; display: flex; align-items: center; justify-content: center; background: #f1f5f9;">
                                                            <i class="bi bi-file-earmark-text" style="font-size: 2rem; color: var(--primary);"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <input type="hidden" name="retained_certificate_utilizations[]" value="<?php echo htmlspecialchars($img); ?>">
                                                    <button type="button" class="btn-remove-existing"
                                                        onclick="this.parentElement.remove()" title="Remove this file"
                                                        style="position: absolute; top: 5px; right: 5px; width: 24px; height: 24px; border-radius: 50%; background: #e11d48; color: white; border: 2px solid white; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.2); transition: all 0.2s ease; z-index: 10;">
                                                        <i class="bi bi-x" style="font-size: 1.2rem; line-height: 1;"></i>
                                                    </button>
                                                    <a href="<?php echo PUBLIC_ROOT . $img; ?>" target="_blank"
                                                        style="position: absolute; bottom: 5px; left: 50%; transform: translateX(-50%); font-size: 0.65rem; color: white; background: rgba(0,0,0,0.5); padding: 2px 8px; border-radius: 4px; text-decoration: none; font-weight: 700;">VIEW</a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <label class="premium-label" style="display: block;">
                                        Certificate of Utilization/Adaptation Document
                                        <i style="display: block; text-transform: none; font-weight: 500; font-size: 0.7rem; margin-top: 4px; color: var(--primary);">For final training approval this field must be updated</i>
                                    </label>
                                    <div class="file-drop-zone" id="utilization-drop-zone"
                                        onclick="document.getElementById('certificate_utilization').click()"
                                        style="padding: 20px; min-height: auto;">
                                        <i class="bi bi-cloud-arrow-up" style="font-size: 2rem;"></i>
                                        <p style="font-size: 0.9rem;">Click to upload Certificate of Utilization/Adaptation (Images, PDF, or Document)</p>
                                        <span class="upload-hint" style="font-size: 0.75rem;">Drag and drop your files here or click to browse</span>
                                        <input type="file" name="certificate_utilization[]" id="certificate_utilization" multiple hidden>
                                    </div>
                                    <div id="utilization-file-list"
                                        style="display: flex; flex-wrap: wrap; gap: 8px; justify: center; margin-top: 15px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Section 5: Certificate of Appearance -->
                            <div class="form-section">
                                <div class="form-section-header">
                                    <i class="bi bi-award"></i>
                                    <h3>Certificate of Appearance</h3>
                                </div>

                                <div class="form-group">
                                    <?php if (!empty($activity['certificate_path'])): ?>
                                        <label class="current-file-label">Current Certificates (Click <i
                                                class="bi bi-x-circle-fill" style="color: #e11d48;"></i> to remove)</label>
                                        <div class="current-files-grid" id="current-cert-grid" style="margin-bottom: 20px;">
                                            <?php foreach (explode(', ', $activity['certificate_path']) as $cert):
                                                if (empty($cert))
                                                    continue; ?>
                                                <div class="current-file-item" style="position: relative;">
                                                    <img src="<?php echo PUBLIC_ROOT . $cert; ?>" alt="Certificate"
                                                        onerror="this.src='<?php echo PUBLIC_ROOT; ?>assets/placeholder-cert.png'; this.style.opacity='0.5';">
                                                    <input type="hidden" name="retained_certificates[]"
                                                        value="<?php echo htmlspecialchars($cert); ?>">
                                                    <button type="button" class="btn-remove-existing"
                                                        onclick="this.parentElement.remove()" title="Remove this file"
                                                        style="position: absolute; top: 5px; right: 5px; width: 24px; height: 24px; border-radius: 50%; background: #e11d48; color: white; border: 2px solid white; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.2); transition: all 0.2s ease; z-index: 10;">
                                                        <i class="bi bi-x" style="font-size: 1.2rem; line-height: 1;"></i>
                                                    </button>
                                                    <a href="<?php echo PUBLIC_ROOT . $cert; ?>" target="_blank"
                                                        style="position: absolute; bottom: 5px; left: 50%; transform: translateX(-50%); font-size: 0.65rem; color: white; background: rgba(0,0,0,0.5); padding: 2px 8px; border-radius: 4px; text-decoration: none; font-weight: 700;">VIEW</a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <label class="premium-label">Upload Certificate <span style="color: var(--danger);"
                                            id="req-cert">*</span></label>
                                    <div class="file-drop-zone" id="cert-drop-zone"
                                        onclick="document.getElementById('certificate_image').click()"
                                        style="padding: 20px; min-height: auto;">
                                        <i class="bi bi-cloud-arrow-up" style="font-size: 2rem;"></i>
                                        <p style="font-size: 0.9rem;">Click to upload certificate (Images or PDF)</p>
                                        <span class="upload-hint" style="font-size: 0.75rem;">Drag and drop file here or
                                            click to browse</span>
                                        <input type="file" name="certificate_image[]" id="certificate_image"
                                            accept=".pdf,.jpg,.jpeg,.png,.webp" multiple hidden <?php echo (isset($is_locked) && $is_locked) ? 'disabled' : ''; ?>>
                                    </div>
                                    <div id="cert-file-list"
                                        style="display: flex; flex-wrap: wrap; gap: 8px; justify: center; margin-top: 15px;">
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 32px; text-align: center;">
                                <button type="submit" class="btn btn-primary btn-lg"
                                    style="width: 100%; max-width: 400px;">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <?php echo (isset($is_locked) && $is_locked) ? 'UPDATE EVIDENCE' : 'UPDATE RECORD'; ?>
                                </button>
                                <a href="javascript:history.back()" class="btn btn-secondary btn-lg"
                                    style="width: 100%; max-width: 400px; margin-top: 12px;">CANCEL</a>
                            </div>

                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="<?php echo PUBLIC_ROOT; ?>js/active-forms.js?v=<?php echo time(); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Flatpickr
            const datePicker = flatpickr("#date_picker", {
                mode: "multiple",
                dateFormat: "Y-m-d",
                conjunction: ", ",
                altInput: true,
                altFormat: "M j, Y",
                disableMobile: "true"
            });

            // Initialize TomSelect for Competencies
            const competencySelect = new TomSelect('#competency_select', {
                plugins: ['remove_button'],
                create: true,
                persist: false,
                placeholder: 'Select or type learning needs...',
                maxOptions: 50,
                dropdownParent: 'body'
            });

            // Initialize TomSelect for Classification
            const classificationSelect = new TomSelect('#classification_select', {
                plugins: ['remove_button'],
                create: false,
                persist: false,
                placeholder: 'Select classification...',
                dropdownParent: 'body'
            });

            // Initialize TomSelect for Training Reference (Code + Title)
            const trainingReferenceSelect = new TomSelect('#training_reference_select', {
                create: false,
                persist: false,
                placeholder: 'Type to search by code or category name...',
                maxItems: 1,
                dropdownParent: 'body',
                render: {
                    option: function (data, escape) {
                        return '<div class="py-2 px-3 border-bottom">' +
                            '<div class="fw-bold text-primary mb-1">' + escape(data.value) + '</div>' +
                            '<div class="text-dark small">' + escape(data.title) + '</div>' +
                            (data.desc ? '<div class="text-muted extra-small mt-1">' + escape(data.desc) + '</div>' : '') +
                            '</div>';
                    },
                    item: function (data, escape) {
                        return '<div>' + escape(data.value) + ' - ' + escape(data.title) + '</div>';
                    }
                },
                onChange: function (value) {
                    // Custom title field is handled separately
                }
            });

            // Initialize TomSelect for Modalities
            const modalitySelect = new TomSelect('#modality_select', {
                create: false,
                persist: false,
                placeholder: 'Select modality...',
                maxItems: 1,
                dropdownParent: 'body'
            });

            // Initialize TomSelect for Type of L&D
            const typeSelect = new TomSelect('#type_ld_select', {
                create: false,
                persist: false,
                placeholder: 'Select type of L&D...',
                maxItems: 1,
                dropdownParent: 'body',
                onChange: function (value) {
                    toggleOthersInput();
                }
            });

            // Initialize TomSelect for Job Embedded Learning
            const jelSelect = new TomSelect('#job_embedded_learning_select', {
                create: false,
                persist: false,
                placeholder: 'Select job embedded learning...',
                maxItems: 1,
                dropdownParent: 'body'
            });

            // Logic for "Others" specify input
            const othersContainer = document.getElementById('type-others-input-container');

            // Function to toggle 'others' input visibility
            const toggleOthersInput = () => {
                if (othersContainer && typeSelect) {
                    const selected = typeSelect.getValue();
                    const isOthersSelected = selected === 'Others';
                    othersContainer.style.display = isOthersSelected ? 'block' : 'none';
                }
            };

            // Initial check
            toggleOthersInput();

            // Enhanced File List Preview with removal support and session merging
            const setupFilePreview = (inputId, listId) => {
                const input = document.getElementById(inputId);
                const list = document.getElementById(listId);
                if (!input || !list) return;

                // Persistent selection for the current upload session
                let cumulativeFiles = new DataTransfer();

                input.addEventListener('change', function (e) {
                    // If no files were selected (user cancelled picker), do nothing
                    if (this.files.length === 0) return;

                    // Add NEWLY selected files to our cumulative collection
                    Array.from(this.files).forEach(file => {
                        // Optional: Check for duplicates by name and size
                        const isDuplicate = Array.from(cumulativeFiles.files).some(f => f.name === file.name && f.size === file.size);
                        if (!isDuplicate) {
                            cumulativeFiles.items.add(file);
                        }
                    });

                    // Synchronize the actual input.files with our cumulative collection
                    input.files = cumulativeFiles.files;

                    // Update UI
                    updatePreview();
                });

                const updatePreview = () => {
                    list.innerHTML = '';
                    Array.from(cumulativeFiles.files).forEach((file, index) => {
                        const badge = document.createElement('div');
                        badge.className = 'file-badge';
                        badge.style.position = 'relative';
                        badge.innerHTML = `
                            <i class="bi bi-file-earmark-check"></i> 
                            <span style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</span>
                            <i class="bi bi-x-circle-fill btn-remove-new" data-index="${index}" 
                               style="cursor:pointer; color: #e11d48; margin-left: 8px; font-size: 1.1rem; transition: transform 0.2s;"
                               onmouseover="this.style.transform='scale(1.2)'"
                               onmouseout="this.style.transform='scale(1)'"></i>
                        `;
                        list.appendChild(badge);
                    });
                };

                list.addEventListener('click', (e) => {
                    const removeBtn = e.target.closest('.btn-remove-new');
                    if (removeBtn) {
                        const indexToRemove = parseInt(removeBtn.getAttribute('data-index'));
                        const dt = new DataTransfer();
                        const { files } = cumulativeFiles;

                        for (let i = 0; i < files.length; i++) {
                            if (i !== indexToRemove) {
                                dt.items.add(files[i]);
                            }
                        }

                        cumulativeFiles = dt;
                        input.files = cumulativeFiles.files;
                        updatePreview();
                    }
                });
            };

            setupFilePreview('completion_report', 'completion-file-list');
            setupFilePreview('certificate_utilization', 'utilization-file-list');
            setupFilePreview('application_file', 'app-file-list');
            setupFilePreview('certificate_image', 'cert-file-list');
        });
    </script>
</body>

</html>