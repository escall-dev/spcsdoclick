<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record New Activity - ELDP</title>
    <!-- Use PUBLIC_ROOT for includes -->
    <?php include BASE_PATH . 'includes/head.php'; ?>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <!-- Tom Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo PUBLIC_ROOT; ?>css/user/common_branded_header.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- Splash Screen Transition -->
    <div class="page-splash-screen" id="pageSplashScreen">
        <div class="splash-logo-container">
            <img src="<?php echo PUBLIC_ROOT; ?>assets/LogoLDP.png" alt="ELDP Logo" class="splash-logo">
        </div>
    </div>

    <div class="app-layout">
        <?php include BASE_PATH . 'includes/sidebar.php'; ?>

        <div class="main-content">
            <header class="top-bar">
                <div class="top-bar-left">
                    <div class="breadcrumb">
                        <h1 class="page-title">Record Activity</h1>
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
                            <img src="<?php echo PUBLIC_ROOT; ?>assets/LogoLDP.png" alt="ELDP Logo" class="branded-logo" id="actualPageLogo" style="opacity: 0; transform: scale(0.8); transition: all 0.5s ease-out;">
                        </div>
                        <div class="header-content" id="headerContentReveal" style="opacity: 0;">
                            <span class="system-badge">Activity Entry</span>
                            <h1 class="header-main-title">Learning & Development Attended</h1>
                            <p class="header-subtitle">Schools Division Office - Official Record Form</p>
                        </div>
                    </div>

                    <script>
                        // Splash Screen Fade-out & Hero Transition Logic (Dynamic Shared-Element)
                        window.addEventListener('load', function () {
                            const splash = document.getElementById('pageSplashScreen');
                            const actualLogo = document.getElementById('actualPageLogo');
                            const headerContent = document.getElementById('headerContentReveal');
                            const splashLogo = splash ? splash.querySelector('.splash-logo') : null;
                            
                            if (splash && actualLogo && splashLogo) {
                                // Calculate exact target coordinates for the pixel-perfect transition
                                const rect = actualLogo.getBoundingClientRect();
                                const targetX = rect.left + rect.width / 2;
                                const targetY = rect.top + rect.height / 2;
                                
                                // Target scale = (Actual logo width) / (Splash logo base width: 450px)
                                const splashBaseWidth = 450;
                                const targetScale = rect.width / splashBaseWidth;

                                // Apply dynamic coordinates to CSS variables
                                splash.style.setProperty('--target-top', `${targetY}px`);
                                splash.style.setProperty('--target-left', `${targetX}px`);
                                splash.style.setProperty('--target-scale', targetScale);

                                // Transition sequence
                                setTimeout(() => {
                                    splash.classList.add('fade-out');
                                    
                                    // Step 1: Reveal page logo & slide in header content (Synced with 0.6s fade)
                                    setTimeout(() => {
                                        actualLogo.style.opacity = "1";
                                        actualLogo.style.transform = "scale(1)";
                                        if (headerContent) headerContent.classList.add('header-content-reveal');
                                        
                                        // Step 2: Staggered reveal for the form body elements (line by line)
                                        setTimeout(() => {
                                            const bodyReveal = document.getElementById('cardBodyReveal');
                                            if (bodyReveal) {
                                                bodyReveal.style.opacity = "1";
                                                
                                                // Stagger each form section reveal
                                                const sections = bodyReveal.querySelectorAll('.form-section');
                                                sections.forEach((section, index) => {
                                                    setTimeout(() => {
                                                        section.classList.add('form-section-reveal');
                                                    }, index * 150); // 150ms stagger between sections
                                                });
                                            }
                                        }, 300); 
                                    }, 500); 

                                    setTimeout(() => {
                                        splash.remove();
                                    }, 1200);
                                }, 1200); 
                            }
                        });
                    </script>

                    <div class="card-body activity-card-body" id="cardBodyReveal" style="opacity: 0; transition: opacity 0.8s ease-out;">
                        <form id="activity-form" method="POST" enctype="multipart/form-data">

                            <!-- Section 1: Basic Information -->
                            <div class="form-section" style="opacity: 0;">
                                <div class="form-section-header">
                                    <i class="bi bi-info-circle"></i>
                                    <h3>Basic Information</h3>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Activity Title <span style="color: var(--danger);">*</span></label>
                                    <input type="text" name="title" id="activity_title" class="form-control" placeholder="Enter activity title (e.g. 3-Day Capacity Building on Digital Literacy)" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Code Category (Reference Code) <span style="color: var(--danger);">*</span></label>
                                    <select id="training_reference_select" name="training_code" class="form-control" required>
                                        <option value="" disabled selected>Type to search by code or category name...</option>
                                        <?php foreach ($training_codes as $code): ?>
                                            <option value="<?php echo htmlspecialchars($code['code_name']); ?>" 
                                                    data-title="<?php echo htmlspecialchars($code['title'] ?? ''); ?>"
                                                    data-desc="<?php echo htmlspecialchars($code['description'] ?? ''); ?>">
                                                <?php echo htmlspecialchars($code['code_name'] . ' - ' . ($code['title'] ?? 'No Title')); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-row-grid">
                                    <div class="form-group">
                                        <label class="form-label">Date(s) Attended <span style="color: var(--danger);"
                                                id="req-date">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"
                                                style="background: var(--bg-secondary); border-right: none;">
                                                <i class="bi bi-calendar3"></i>
                                            </span>
                                            <input type="text" name="date_attended" id="date_picker"
                                                class="form-control" placeholder="Click to select dates" required
                                                style="border-left: none;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Venue <span style="color: var(--danger);"
                                                id="req-venue">*</span></label>
                                        <input type="text" name="venue" id="venue" class="form-control" required
                                            placeholder="e.g. SDO Conference Hall">
                                    </div>
                                </div>

                                <div class="form-row-grid">
                                    <div class="form-group">
                                        <label class="form-label">Addressed Competency/ies <span
                                                style="color: var(--danger);">*</span></label>
                                        <select id="competency_select" name="competency[]" class="form-control"
                                            placeholder="Select or type learning needs..." required multiple>
                                            <option value="Relevant Expertise">Relevant Expertise</option>
                                            <?php if (!empty($competencies)): ?>
                                                <optgroup label="System Competencies">
                                                    <?php foreach ($competencies as $comp): ?>
                                                        <option value="<?php echo htmlspecialchars($comp['code_name']); ?>">
                                                            <?php echo htmlspecialchars($comp['code_name']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </optgroup>
                                            <?php endif; ?>
                                            <optgroup label="Your Personal Needs (ILDN)">
                                                <?php foreach ($user_ildns as $ildn): ?>
                                                    <option value="<?php echo htmlspecialchars($ildn['need_text']); ?>">
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
                                            required multiple placeholder="Select classification...">
                                            <?php foreach ($classifications as $classItem): ?>
                                                <option value="<?php echo htmlspecialchars($classItem['name']); ?>">
                                                    <?php echo htmlspecialchars($classItem['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Modalities & Type -->
                            <div class="form-section" style="opacity: 0;">
                                <div class="form-row-grid">
                                    <div>
                                        <div class="form-section-header">
                                            <i class="bi bi-diagram-3"></i>
                                            <h3>Modality <span style="color: var(--danger);" id="req-modality">*</span>
                                            </h3>
                                        </div>
                                        <select id="modality_select" name="modality" class="form-control" required
                                            placeholder="Select modality...">
                                            <option value="" disabled selected>Select modality...</option>
                                            <?php foreach ($modalities as $mod): ?>
                                                <option value="<?php echo htmlspecialchars($mod['name']); ?>">
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
                                            placeholder="Select type of L&D...">
                                            <option value="" disabled selected>Select type of L&D...</option>
                                            <?php foreach ($ld_types as $type): ?>
                                                <option value="<?php echo htmlspecialchars($type['name']); ?>">
                                                    <?php echo htmlspecialchars($type['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                        <div id="type-others-input-container" style="display: none; margin-top: 12px;">
                                            <input type="text" name="type_ld_others" class="form-control"
                                                placeholder="Please specify type...">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 24px;">
                                    <div class="form-section-header">
                                        <i class="bi bi-briefcase"></i>
                                        <h3>Job Embedded Learning</h3>
                                    </div>
                                    <select id="job_embedded_learning_select" name="job_embedded_learning" class="form-control"
                                        placeholder="Select job embedded learning...">
                                        <option value="" disabled selected>Select job embedded learning...</option>
                                        <?php foreach ($job_embedded_learnings as $jel): ?>
                                            <option value="<?php echo htmlspecialchars($jel['name']); ?>">
                                                <?php echo htmlspecialchars($jel['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Section 4: Application of Learning Plan -->
                            <div class="form-section" style="opacity: 0;">
                                <div class="form-section-header">
                                    <i class="bi bi-lightbulb"></i>
                                    <h3>Application of Learning Plan</h3>
                                </div>

                                <div class="form-group">
                                    <label class="premium-label" style="display: block;">
                                        Supporting Document
                                        <i style="display: block; text-transform: none; font-weight: 500; font-size: 0.7rem; margin-top: 4px; color: var(--primary);">For final training approval this field must be updated</i>
                                    </label>
                                    <div class="file-drop-zone" id="app-drop-zone"
                                        onclick="document.getElementById('application_file').click()"
                                        style="padding: 20px; min-height: auto;">
                                        <i class="bi bi-cloud-arrow-up" style="font-size: 2rem;"></i>
                                        <p style="font-size: 0.9rem;">Click to upload files (Images or Document)</p>
                                        <span class="upload-hint" style="font-size: 0.75rem;">Drag and drop your files
                                            here or click to browse</span>
                                        <input type="file" name="application_file[]" id="application_file"
                                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" multiple hidden>
                                    </div>
                                    <div id="app-file-list"
                                        style="display: flex; flex-wrap: wrap; gap: 8px; justify: center; margin-top: 10px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3: Completion Report -->
                            <div class="form-section" style="opacity: 0;">
                                <div class="form-section-header">
                                    <i class="bi bi-file-earmark-check"></i>
                                    <h3>Completion Report</h3>
                                </div>

                                <div class="form-group">
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
                            <div class="form-section" style="opacity: 0;">
                                <div class="form-section-header">
                                    <i class="bi bi-journal-check"></i>
                                    <h3>Certificate of Utilization/Adaptation</h3>
                                </div>

                                <div class="form-group">
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
                            <div class="form-section" style="opacity: 0;">
                                <div class="form-section-header">
                                    <i class="bi bi-award"></i>
                                    <h3>Certificate of Appearance</h3>
                                </div>

                                <div class="form-group">
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
                                            accept=".pdf,.jpg,.jpeg,.png,.webp" multiple hidden required>
                                    </div>
                                    <div id="cert-file-list"
                                        style="display: flex; flex-wrap: wrap; gap: 8px; justify: center; margin-top: 10px;">
                                    </div>
                                </div>
                            </div>

                             <!-- Privacy Notice -->
                             <div class="privacy-notice-box form-section" style="opacity: 0;">
                                <i class="bi bi-shield-lock-fill"></i>
                                <div class="privacy-content">
                                    <h4>Privacy Notice</h4>
                                    <p>We collect personal and professional information (Name, Activity Details, and
                                        Evidence) when you submit this record. This data will be utilized solely for
                                        documentation and processing of your L&D progress within SDO DepEd.</p>
                                    <label class="privacy-check-container">
                                        <input type="checkbox" id="privacy-agree" name="privacy_agree" required>
                                        <span class="privacy-check-text">I have read and agree to the Privacy
                                            Notice</span>
                                    </label>
                                </div>
                            </div>

                             <!-- Submit Button -->
                             <div class="form-section" style="margin-top: 32px; text-align: center; padding-bottom: 40px; opacity: 0;">
                                <button type="submit" class="btn btn-primary btn-lg"
                                    style="width: 100%; max-width: 400px;">
                                    <i class="bi bi-check-circle-fill"></i> SUBMIT ACTIVITY RECORD
                                </button>
                                
                            </div>

                        </form>
                    </div>
                </div>
            </main>

            <footer class="user-footer">
                <p>&copy;
                    <?php echo date('Y'); ?> Electronic L&D Passbook.
                </p>
            </footer>
        </div>
    </div>

    <!-- Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <!-- Flatpickr JS -->
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
                dropdownParent: 'body',
                onChange: function (value) {
                    checkRelevantExpertise();
                }
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
                    option: function(data, escape) {
                        return '<div class="py-2 px-3 border-bottom">' +
                                '<div class="fw-bold text-primary mb-1">' + escape(data.value) + '</div>' +
                                '<div class="text-dark small">' + escape(data.title) + '</div>' +
                                (data.desc ? '<div class="text-muted extra-small mt-1">' + escape(data.desc) + '</div>' : '') +
                               '</div>';
                    },
                    item: function(data, escape) {
                        return '<div>' + escape(data.value) + ' - ' + escape(data.title) + '</div>';
                    }
                },
                onChange: function(value) {
                    saveDraft();
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
                    saveDraft(); // Save on change
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

            // Logic for "Relevant Expertise" Bypass
            const checkRelevantExpertise = () => {
                const selected = competencySelect.getValue();
                const isRelevantExpertise = Array.isArray(selected)
                    ? selected.includes('Relevant Expertise')
                    : selected === 'Relevant Expertise';

                const optionalFields = [
                    { id: 'date_picker', el: document.getElementById('date_picker') },
                    { id: 'venue', el: document.getElementById('venue') },
                    { id: 'classification_select', el: document.getElementById('classification_select') },
                    { id: 'modality_select', el: document.getElementById('modality_select') },
                    { id: 'type_ld_select', el: document.getElementById('type_ld_select') },
                    { id: 'certificate_image', el: document.getElementById('certificate_image') },
                    { id: 'reflection', el: document.querySelector('textarea[name="reflection"]') }
                ];

                const reqIndicators = {
                    'req-date': document.getElementById('req-date'),
                    'req-venue': document.getElementById('req-venue'),
                    'req-classification': document.getElementById('req-classification'),
                    'req-modality': document.getElementById('req-modality'),
                    'req-type': document.getElementById('req-type'),
                    'req-cert': document.getElementById('req-cert'),
                    'req-reflection': document.getElementById('req-reflection')
                };

                if (isRelevantExpertise) {
                    optionalFields.forEach(field => {
                        if (field.el) field.el.removeAttribute('required');
                    });

                    // Hide Asterisks
                    Object.values(reqIndicators).forEach(el => { if (el) el.style.display = 'none'; });

                } else {
                    optionalFields.forEach(field => {
                        if (field.el) field.el.setAttribute('required', 'required');
                    });

                    // Show Asterisks
                    Object.values(reqIndicators).forEach(el => { if (el) el.style.display = 'inline'; });
                }

                saveDraft();
            };

            // Logic for "Others" specify input
            const othersContainer = document.getElementById('type-others-input-container');

            // Function to toggle 'others' input visibility
            const toggleOthersInput = () => {
                if (othersContainer && typeSelect) {
                    const selected = typeSelect.getValue(); // Returns array for multiple
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


            // --- Form Persistence Logic ---
            const form = document.getElementById('activity-form');
            const STORAGE_KEY = 'eldp_activity_draft_v1'; // Renamed for ELDP rebranding

            /**
             * Save form data to localStorage
             */
            const saveDraft = () => {
                const formData = new FormData(form);
                const draft = {};

                // Convert FormData to object
                for (const [key, value] of formData.entries()) {
                    if (value instanceof File) continue;

                    if (draft[key]) {
                        if (!Array.isArray(draft[key])) {
                            draft[key] = [draft[key]];
                        }
                        draft[key].push(value);
                    } else {
                        draft[key] = value;
                    }
                }

                // We need to explicitly check multi-selects if they are empty, as FormData won't include them
                // But TomSelect updates the underlying select, so if it has value, it's in FormData.
                // If it's empty, it's missing. That's fine for saving.

                localStorage.setItem(STORAGE_KEY, JSON.stringify(draft));
            };

            /**
             * Restore form data from localStorage
             */
            const restoreDraft = () => {
                const savedData = localStorage.getItem(STORAGE_KEY);
                if (!savedData) return;

                try {
                    const draft = JSON.parse(savedData);

                    // Restore Standard Inputs (Text, inputs)
                    Object.keys(draft).forEach(name => {
                        // Skip complex fields handled below
                        if (['modality', 'type_ld', 'competency[]', 'date_attended', 'classification[]'].includes(name)) return;

                        const inputs = form.querySelectorAll(`[name="${name}"]`);
                        if (inputs.length > 0) {
                            if (inputs[0].type !== 'file') {
                                inputs[0].value = draft[name];
                            }
                        }
                    });

                    // Restore Special Components

                    // 1. Flatpickr (Date)
                    if (draft['date_attended']) {
                        datePicker.setDate(draft['date_attended'], true);
                    }

                    // 1.5 TomSelect (Training Reference)
                    if (draft['training_code']) {
                        trainingReferenceSelect.setValue(draft['training_code']);
                    }

                    // 2. TomSelect (Competency)
                    if (draft['competency[]']) {
                        const comps = Array.isArray(draft['competency[]']) ? draft['competency[]'] : [draft['competency[]']];
                        comps.forEach(val => {
                            if (!competencySelect.options[val]) {
                                competencySelect.addOption({ value: val, text: val });
                            }
                        });
                        competencySelect.setValue(comps);
                    }

                    // 3. TomSelect (Classification) - Multi
                    if (draft['classification[]']) {
                        const classes = Array.isArray(draft['classification[]']) ? draft['classification[]'] : [draft['classification[]']];
                        classificationSelect.setValue(classes);
                    }

                    // 4. TomSelect (Modality) - Single
                    if (draft['modality']) {
                        const mod = Array.isArray(draft['modality']) ? draft['modality'][0] : draft['modality'];
                        modalitySelect.setValue(mod);
                    }

                    // 5. TomSelect (Type of L&D) - Single
                    if (draft['type_ld']) {
                        const type = Array.isArray(draft['type_ld']) ? draft['type_ld'][0] : draft['type_ld'];
                        typeSelect.setValue(type);
                    }

                    // 6. Trigger UI updates query
                    toggleOthersInput();
                    checkRelevantExpertise();

                } catch (e) {
                    console.error("Error restoring draft:", e);
                }
            };

            // Event Listeners for Saving
            form.addEventListener('input', saveDraft);
            form.addEventListener('change', saveDraft); // Bubbles from original selects too

            // Clear draft on submit
            form.addEventListener('submit', function () {
                localStorage.removeItem(STORAGE_KEY);
            });

            // Initial Restore
            restoreDraft();

        });
    </script>
</body>

</html>