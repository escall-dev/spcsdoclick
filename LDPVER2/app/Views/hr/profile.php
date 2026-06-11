<?php
// Extracted variables from $data (handled by Controller::view)
// $user, $all_ildns, $certificates, $notifRepo, $pdo
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Profile - ELDP</title>
    <?php require BASE_PATH . 'includes/admin_head.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo PUBLIC_ROOT; ?>css/admin/profile.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="app-layout">
        <?php require BASE_PATH . 'includes/sidebar.php'; ?>

        <div class="main-content">
            <header class="top-bar">
                <div class="top-bar-left">
                    <div class="breadcrumb">
                        <h1 class="page-title">My Profile</h1>
                    </div>
                </div>
                <div class="top-bar-right">
                    <div class="current-date-box">
                        <div class="time-section">
                            <span id="real-time-clock"><?php echo date('h:i:s A'); ?></span>
                        </div>
                        <div class="date-section">
                            <i class="bi bi-calendar3"></i>
                            <span><?php echo date('F j, Y'); ?></span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="content-wrapper">
                <div class="admin-profile-container">
                    <div class="profile-grid-main">
                        <div class="dashboard-card hover-elevate">
                            <div class="card-header">
                                <h2><i class="bi bi-person-vcard text-gradient"></i> Core Identification</h2>
                            </div>
                            <div class="card-body identification-card-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="update_profile_hr" value="1">

                                    <div class="identification-grid">
                                        <!-- Field 1: Full Name -->
                                        <div class="identification-row">
                                            <label class="identification-label">Primary Full Name</label>
                                            <div class="identification-field">
                                                <i class="bi bi-person identification-icon"></i>
                                                <input type="text" name="full_name" class="form-control identification-input"
                                                    required value="<?php echo htmlspecialchars($user['full_name']); ?>">
                                            </div>
                                        </div>

                                        <!-- Field 2: Office/Assignment -->
                                        <div class="identification-row">
                                            <label class="identification-label">Current Office / Assignment</label>
                                            <div class="identification-field">
                                                <i class="bi bi-building identification-icon"></i>
                                                <select name="office_station" id="office_select"
                                                    class="form-select identification-input" required>
                                                    <option value="">Select your office...</option>
                                                    <optgroup label="OSDS">
                                                        <option value="ADMINISTRATIVE (PERSONEL)" <?php echo ($user['office_station'] == 'ADMINISTRATIVE (PERSONEL)') ? 'selected' : ''; ?>>ADMINISTRATIVE (PERSONEL)</option>
                                                        <option value="ADMINISTRATIVE (PROPERTY AND SUPPLY)" <?php echo ($user['office_station'] == 'ADMINISTRATIVE (PROPERTY AND SUPPLY)') ? 'selected' : ''; ?>>ADMINISTRATIVE (PROPERTY AND SUPPLY)</option>
                                                        <option value="ADMINISTRATIVE (RECORDS)" <?php echo ($user['office_station'] == 'ADMINISTRATIVE (RECORDS)') ? 'selected' : ''; ?>>ADMINISTRATIVE (RECORDS)</option>
                                                        <option value="ADMINISTRATIVE (CASH)" <?php echo ($user['office_station'] == 'ADMINISTRATIVE (CASH)') ? 'selected' : ''; ?>>ADMINISTRATIVE (CASH)</option>
                                                        <option value="ADMINISTRATIVE (GENERAL SERVICES)" <?php echo ($user['office_station'] == 'ADMINISTRATIVE (GENERAL SERVICES)') ? 'selected' : ''; ?>>ADMINISTRATIVE (GENERAL SERVICES)</option>
                                                        <option value="FINANCE (ACCOUNTING)" <?php echo ($user['office_station'] == 'FINANCE (ACCOUNTING)') ? 'selected' : ''; ?>>FINANCE (ACCOUNTING)</option>
                                                        <option value="FINANCE (BUDGET)" <?php echo ($user['office_station'] == 'FINANCE (BUDGET)') ? 'selected' : ''; ?>>FINANCE (BUDGET)</option>
                                                        <option value="LEGAL" <?php echo ($user['office_station'] == 'LEGAL') ? 'selected' : ''; ?>>LEGAL</option>
                                                        <option value="ICT" <?php echo ($user['office_station'] == 'ICT') ? 'selected' : ''; ?>>ICT</option>
                                                    </optgroup>
                                                    <optgroup label="SGOD">
                                                        <option value="SCHOOL MANAGEMENT MONITORING & EVALUATION" <?php echo ($user['office_station'] == 'SCHOOL MANAGEMENT MONITORING & EVALUATION') ? 'selected' : ''; ?>>SCHOOL MANAGEMENT MONITORING & EVALUATION</option>
                                                        <option value="HUMAN RESOURCES DEVELOPMENT" <?php echo ($user['office_station'] == 'HUMAN RESOURCES DEVELOPMENT') ? 'selected' : ''; ?>>HUMAN RESOURCES DEVELOPMENT</option>
                                                        <option value="DISASTER RISK REDUCTION AND MANAGEMENT" <?php echo ($user['office_station'] == 'DISASTER RISK REDUCTION AND MANAGEMENT') ? 'selected' : ''; ?>>DISASTER RISK REDUCTION AND MANAGEMENT</option>
                                                        <option value="EDUCATION FACILITIES" <?php echo ($user['office_station'] == 'EDUCATION FACILITIES') ? 'selected' : ''; ?>>EDUCATION FACILITIES</option>
                                                        <option value="SCHOOL HEALTH AND NUTRITION" <?php echo ($user['office_station'] == 'SCHOOL HEALTH AND NUTRITION') ? 'selected' : ''; ?>>SCHOOL HEALTH AND NUTRITION</option>
                                                        <option value="SCHOOL HEALTH AND NUTRITION (DENTAL)" <?php echo ($user['office_station'] == 'SCHOOL HEALTH AND NUTRITION (DENTAL)') ? 'selected' : ''; ?>>SCHOOL HEALTH AND NUTRITION (DENTAL)</option>
                                                        <option value="SCHOOL HEALTH AND NUTRITION (MEDICAL)" <?php echo ($user['office_station'] == 'SCHOOL HEALTH AND NUTRITION (MEDICAL)') ? 'selected' : ''; ?>>SCHOOL HEALTH AND NUTRITION (MEDICAL)</option>
                                                    </optgroup>
                                                    <optgroup label="CID">
                                                        <option value="CURRICULUM IMPLEMENTATION DIVISION (INSTRUCTIONAL MANAGEMENT)" <?php echo ($user['office_station'] == 'CURRICULUM IMPLEMENTATION DIVISION (INSTRUCTIONAL MANAGEMENT)') ? 'selected' : ''; ?>>CURRICULUM IMPLEMENTATION DIVISION (INSTRUCTIONAL MANAGEMENT)</option>
                                                        <option value="CURRICULUM IMPLEMENTATION DIVISION (LEARNING RESOURCES MANAGEMENT)" <?php echo ($user['office_station'] == 'CURRICULUM IMPLEMENTATION DIVISION (LEARNING RESOURCES MANAGEMENT)') ? 'selected' : ''; ?>>CURRICULUM IMPLEMENTATION DIVISION (LEARNING RESOURCES MANAGEMENT)</option>
                                                        <option value="CURRICULUM IMPLEMENTATION DIVISION (ALTERNATIVE LEARNING SYSTEM)" <?php echo ($user['office_station'] == 'CURRICULUM IMPLEMENTATION DIVISION (ALTERNATIVE LEARNING SYSTEM)') ? 'selected' : ''; ?>>CURRICULUM IMPLEMENTATION DIVISION (ALTERNATIVE LEARNING SYSTEM)</option>
                                                        <option value="CURRICULUM IMPLEMENTATION DIVISION (DISTRICT INSTRUCTIONAL SUPERVISION)" <?php echo ($user['office_station'] == 'CURRICULUM IMPLEMENTATION DIVISION (DISTRICT INSTRUCTIONAL SUPERVISION)') ? 'selected' : ''; ?>>CURRICULUM IMPLEMENTATION DIVISION (DISTRICT INSTRUCTIONAL SUPERVISION)</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Field 3: Position -->
                                        <div class="identification-row">
                                            <label class="identification-label">Official Position</label>
                                            <div class="identification-field">
                                                <i class="bi bi-briefcase identification-icon"></i>
                                                <input type="text" name="position" class="form-control identification-input"
                                                    value="<?php echo htmlspecialchars($user['position']); ?>">
                                            </div>
                                        </div>

                                        <!-- Field 4: Security (Password) -->
                                        <div class="identification-row">
                                            <label class="identification-label">Security Override</label>
                                            <div class="identification-field">
                                                <i class="bi bi-shield-lock identification-icon"></i>
                                                <input type="password" name="password" class="form-control identification-input"
                                                    placeholder="Leave blank to keep current password" autocomplete="new-password">
                                            </div>
                                        </div>

                                        <!-- Field 5: Passkey -->
                                        <div class="identification-row">
                                            <label class="identification-label" style="color: #dc2626;">Security Passkey</label>
                                            <div class="identification-field-group">
                                                <div class="identification-field">
                                                    <i class="bi bi-shield-lock-fill identification-icon" style="color: #dc2626;"></i>
                                                    <input type="text" name="passkey_input" class="form-control identification-input"
                                                        placeholder="Enter 6-digit code" maxlength="6" style="border-color: #fca5a5;">
                                                </div>
                                                <small style="color: #dc2626; font-style: italic; font-weight: 600; margin-top: 8px; display: block;">
                                                    * Required for password changes. Use the code from your registration email.
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="identification-footer">
                                        <div class="footer-left">
                                            <a href="<?php echo PUBLIC_ROOT; ?>index.php/hr/dashboard" class="btn-back">
                                                <i class="bi bi-arrow-left"></i> Return to Dashboard
                                            </a>
                                        </div>
                                        <div class="footer-right">
                                            <button type="submit" class="btn-sync">
                                                <i class="bi bi-cloud-arrow-up"></i> Synchronize Security Profile
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="profile-grid-aside">
                        <div class="dashboard-card privilege-card">
                            <div class="card-header">
                                <h2><i class="bi bi-shield-check"></i> Administrative Privileges</h2>
                            </div>
                            <div class="card-body privilege-card-body">
                                <div class="d-flex align-items-center gap-20">
                                    <div class="privilege-icon-box">
                                        <i class="bi bi-key-fill"></i>
                                    </div>
                                    <div>
                                        <?php
                                        $role_info = [
                                            'super_admin' => [
                                                'level' => 'Highest Level',
                                                'desc' => 'Your account is authorized with <strong>Highest Level</strong> administrative permissions. You have full control over system configuration, user management, and security protocols.'
                                            ],
                                            'admin' => [
                                                'level' => 'Full Administrative',
                                                'desc' => 'Your account is authorized with <strong>Full Administrative</strong> permissions. You can manage system settings, overlook user activities, and handle high-level approvals.'
                                            ],
                                            'head_hr' => [
                                                'level' => 'Higher Level',
                                                'desc' => 'Your account is authorized with <strong>Higher Level</strong> administrative permissions. You can manage personnel records and audit system logs.'
                                            ],
                                            'hr' => [
                                                'level' => 'Mid-Level',
                                                'desc' => 'Your account is authorized with <strong>Mid-Level</strong> administrative permissions. You can manage personnel profiles, monitor registration growth, and assist in user management.'
                                            ],
                                            'immediate_head' => [
                                                'level' => 'Supervisor Level',
                                                'desc' => 'Your account is authorized with <strong>Supervisor Level</strong> permissions. You can review, recommend, and approve personnel activity submissions within your division.'
                                            ],
                                            'user' => [
                                                'level' => 'Standard Access',
                                                'desc' => 'Your account is authorized with <strong>Standard Access</strong>. You can record your L&D activities, view your activity records, and manage your personal profile.'
                                            ]
                                        ];
                                        $current_role = $_SESSION['role'];
                                        $info = $role_info[$current_role] ?? $role_info['user'];
                                        ?>
                                        <div class="privilege-role-level">
                                            Role Level: <?php echo strtoupper($current_role); ?>
                                        </div>
                                        <div class="privilege-description">
                                            <?php echo $info['desc']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        // Tom Select for office dropdown
        new TomSelect('#office_select', {
            create: false,
            sortField: { field: 'text', direction: 'asc' }
        });

        // Profile picture preview
        function previewProfilePic(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('profilePicPreview');
                    const placeholder = document.getElementById('profilePicPlaceholder');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if (placeholder) placeholder.style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Real-time clock
        function updateClock() {
            const now = new Date();
            const hours = now.getHours() % 12 || 12;
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const ampm = now.getHours() >= 12 ? 'PM' : 'AM';
            document.getElementById('real-time-clock').textContent = `${hours}:${minutes}:${seconds} ${ampm}`;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>

</html>