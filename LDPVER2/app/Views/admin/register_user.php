<?php
// Extracted variables from $data (handled by Controller::view)
// $offices_list, $user, $notifRepo, $pdo
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account - Admin</title>
    <?php require BASE_PATH . 'includes/admin_head.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo PUBLIC_ROOT; ?>css/admin/register_user.css?v=<?php echo time(); ?>">

</head>

<body>
    <div class="app-layout">
        <?php require BASE_PATH . 'includes/sidebar.php'; ?>

        <div class="main-content">
            <header class="top-bar">
                <div class="top-bar-left">
                    <div class="breadcrumb">
                        <h1 class="page-title">Registration Panel</h1>
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
                <form method="POST" action="" enctype="multipart/form-data" id="registerForm">
                    <div class="register-layout">
                        <!-- Left Panel: Account Access (ID Anchor) -->
                        <div class="register-panel-left">
                            <div class="panel-header-blue">
                                <h2><i class="bi bi-shield-lock"></i> ACCOUNT ACCESS</h2>
                                <p>Identity & System Access</p>
                            </div>
                            
                            <div class="panel-body">
                                <div class="profile-upload-section">
                                    <div class="avatar-container">
                                        <div class="avatar-overlay btn-shine">
                                            <i class="bi bi-camera"></i>
                                        </div>
                                        <img src="<?php echo PUBLIC_ROOT; ?>assets/defaults/user.svg" id="preview-image" class="avatar-img">
                                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewFile()">
                                    </div>
                                    <div class="upload-text">Profile Photo</div>
                                </div>

                                <div class="form-group-custom">
                                    <label class="custom-label">System Role</label>
                                    <div class="select-wrapper">
                                        <select name="role" id="role-select" class="custom-select" required>
                                            <option value="user">User (L&D Personnel)</option>
                                            <option value="immediate_head">Immediate Head (Approver)</option>
                                            <option value="head_hr">Admin (Human Resource Development)</option>
                                        </select>
                                        <small class="helper-text">Assigned by Administrator</small>
                                    </div>
                                </div>


                                <div class="form-group-custom">
                                    <label class="custom-label">Password</label>
                                    <div class="input-with-icon">
                                        <i class="bi bi-key"></i>
                                        <input type="password" name="password" class="custom-input" placeholder="••••••••" required minlength="6" maxlength="10">
                                    </div>
                                </div>

                                <div class="panel-footer-btn">
                                    <button type="submit" class="btn-create-account btn-shine">
                                        <i class="bi bi-person-plus-fill"></i> CREATE ACCOUNT
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Right Panel: Personnel Information (Main Form) -->
                        <div class="register-panel-right">
                            <div class="form-card">
                                <div class="form-card-header">
                                    <h2><i class="bi bi-person-badge"></i> PERSONNEL INFORMATION</h2>
                                </div>
                                <div class="form-card-body">
                                    <!-- Section 1: Personal Details -->
                                    <div class="form-section">
                                        <h3 class="section-title">Personal Details</h3>
                                        <div class="form-grid">
                                            <div class="form-field span-2">
                                                <label>Full Name</label>
                                                <input type="text" name="full_name" id="full_name" placeholder="Fullname" required>
                                            </div>
                                            <div class="form-field">
                                                <label>Email Address</label>
                                                <input type="email" name="gmail" placeholder="example@deped.gov.ph" required>
                                            </div>
                                            <div class="form-field">
                                                <label>Office / Station</label>
                                                <select id="office-select" name="office_station" autocomplete="off" placeholder="Search office...">
                                                    <option value="">Select Office/Station...</option>
                                                    <?php if (!empty($offices_list)): ?>
                                                        <?php foreach ($offices_list as $category => $items): ?>
                                                            <optgroup label="<?php echo htmlspecialchars($category); ?>">
                                                                <?php foreach ($items as $office): ?>
                                                                    <option value="<?php echo htmlspecialchars($office['name']); ?>">
                                                                        <?php echo htmlspecialchars($office['name']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="form-field span-2">
                                                <label>Position / Designation</label>
                                                <input type="text" name="position" placeholder="Position">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 2: Employment Details -->
                                    <div class="form-section" id="employment-details-section">
                                        <h3 class="section-title">Employment Details</h3>
                                        <div class="form-grid">
                                            <div class="form-field">
                                                <label>Employee Number</label>
                                                <input type="text" name="employee_number" placeholder="e.g. 1234567" maxlength="7" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            </div>
                                            <div class="form-field">
                                                <label>Area of Specialization</label>
                                                <input type="text" name="area_of_specialization" placeholder="Specialization">
                                            </div>
                                            <div class="form-field">
                                                <label>Age</label>
                                                <input type="number" name="age" placeholder="--">
                                            </div>
                                            <div class="form-field">
                                                <label>Sex</label>
                                                <select name="sex" class="form-select-custom">
                                                    <option value="">Select...</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('office-select')) {
                new TomSelect("#office-select", {
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            }

            const roleSelect = document.getElementById('role-select');
            const employmentDetailsSection = document.getElementById('employment-details-section');
            const fullNameInput = document.getElementById('full_name');
            const officeSelect = document.getElementById('office-select'); // Get office select if needed

            // Roles that trigger special behavior
            const specialRoles = ['immediate_head', 'head_hr'];
            
             // Mapping for role names to display in Full Name field
            const roleNames = {
                'immediate_head': 'Immediate Head',
                'head_hr': 'Admin (Human Resource Development)'
            };

            function handleRoleChange() {
                const selectedRole = roleSelect.value;

                if (specialRoles.includes(selectedRole)) {
                    // Start Exit Animation if visible
                     if (employmentDetailsSection.style.display !== 'none') {
                        employmentDetailsSection.style.opacity = '0';
                        setTimeout(() => {
                             employmentDetailsSection.style.display = 'none';
                        }, 300); // Wait for fade out
                    }

                    // Auto-fill Full Name
                    if (roleNames[selectedRole]) {
                        fullNameInput.value = roleNames[selectedRole];
                        fullNameInput.setAttribute('readonly', true); // Optional: Make it read-only to prevent editing
                    }
                    
                    // Clear Employment Details inputs
                    const inputs = employmentDetailsSection.querySelectorAll('input, select');
                    inputs.forEach(input => {
                         input.value = '';
                    });

                } else {
                    // Show Employment Details
                    employmentDetailsSection.style.display = 'block';
                    // slight delay to allow display block to apply before opacity transition
                    setTimeout(() => {
                         employmentDetailsSection.style.opacity = '1';
                    }, 10);

                    // Clear Full Name if it was auto-filled (check if it matches one of the special names)
                    if (Object.values(roleNames).includes(fullNameInput.value)) {
                        fullNameInput.value = '';
                    }
                    fullNameInput.removeAttribute('readonly');
                }
            }

            // Initial check on page load
            if(roleSelect) {
                 // Add transition for smooth hiding
                employmentDetailsSection.style.transition = 'opacity 0.3s ease';
                handleRoleChange();
                roleSelect.addEventListener('change', handleRoleChange);
            }
        });

        function previewFile() {
            var preview = document.querySelector('#preview-image');
            var file = document.querySelector('#profile_picture').files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "<?php echo PUBLIC_ROOT; ?>assets/human_avatar.png";
            }
        }
    </script>
</body>

</html>