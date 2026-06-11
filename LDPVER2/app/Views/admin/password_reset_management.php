<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Management - LDP</title>
    <?php require BASE_PATH . 'includes/admin_head.php'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $path_to_public; ?>css/admin/security_dashboard.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="app-layout">
        <?php require BASE_PATH . 'includes/sidebar.php'; ?>

        <div class="main-content">
            <header class="top-bar">
                <div class="top-bar-left">
                    <div class="breadcrumb">
                        <h1 class="page-title">Password Reset Rate Limits</h1>
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

            <div class="content-wrapper security-content-wrapper">
                <div class="stats-grid" id="statsGrid">
                    <!-- Stats will be loaded here via JS -->
                    <div class="stat-card">
                        <div class="stat-icon icon-blue"><i class="bi bi-people"></i></div>
                        <div class="stat-info"><span class="stat-value">...</span><span class="stat-label">Users with
                                Requests</span></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-red"><i class="bi bi-slash-circle"></i></div>
                        <div class="stat-info"><span class="stat-value">...</span><span class="stat-label">Blocked
                                Users</span></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-green"><i class="bi bi-check-circle"></i></div>
                        <div class="stat-info"><span class="stat-value">...</span><span class="stat-label">Active
                                Users</span></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-purple"><i class="bi bi-envelope"></i></div>
                        <div class="stat-info"><span class="stat-value">...</span><span class="stat-label">Total OTP
                                Requests</span></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-cyan"><i class="bi bi-eye"></i></div>
                        <div class="stat-info"><span class="stat-value">...</span><span class="stat-label">Page
                                Accesses</span></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-orange"><i class="bi bi-arrow-repeat"></i></div>
                        <div class="stat-info"><span class="stat-value">...</span><span class="stat-label">Total
                                Resends</span></div>
                    </div>
                </div>

                <div class="management-card">
                    <div class="table-header">
                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text" id="userSearch" placeholder="Search by name or email..."
                                onkeyup="filterTable()">
                        </div>
                        <div class="header-actions">
                            <span class="record-count" id="recordCount">Showing ...
                                records</span>
                        </div>
                    </div>

                    <div class="table-container">
                        <table id="securityTable">
                            <thead>
                                <tr>
                                    <th>USER</th>
                                    <th>ROLE</th>
                                    <th>PAGE VISITS</th>
                                    <th>OTP REQUESTS (1h)</th>
                                    <th>OTP INPUT</th>
                                    <th>RESENDS (1h)</th>
                                    <th>STATUS</th>
                                    <th>LAST ACTIVITY</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody id="securityTableBody">
                                <!-- Data will be loaded via JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', loadSecurityStats);

        function loadSecurityStats() {
            fetch('<?php echo $route_prefix; ?>admin/get-security-stats')
                .then(r => r.json())
                .then(data => {
                    if (data.error) {
                        showToast(data.error, 'error');
                        return;
                    }
                    updateDashboard(data);
                })
                .catch(e => showToast("Failed to load security stats", 'error'));
        }

        function updateDashboard(data) {
            // Update Stats
            const stats = data.stats;
            const statElements = document.querySelectorAll('.stat-value');
            statElements[0].innerText = stats.usersWithRequests;
            statElements[1].innerText = stats.blockedUsers;
            statElements[2].innerText = stats.activeUsers;
            statElements[3].innerText = stats.totalOtpRequests;
            statElements[4].innerText = stats.pageAccesses;
            statElements[5].innerText = stats.totalResends;

            // Update Table
            const tbody = document.getElementById('securityTableBody');
            tbody.innerHTML = '';

            data.users.forEach(u => {
                const row = document.createElement('tr');
                const lastActivity = u.last_activity !== 'N/A' ? formatDateTime(u.last_activity) : 'N/A';

                // Limits (hardcoded based on logic)
                const reqLimit = 3;
                const inputLimit = 5;
                const resendLimit = 10; // Assuming a soft limit for display

                row.innerHTML = `
                    <td>
                        <div class="user-cell">
                            ${u.profile_picture ? `<img src="../public/uploads/profile_pics/${u.profile_picture}" class="user-avatar-circular">` : `<div class="user-avatar">${u.full_name.charAt(0)}</div>`}
                            <div class="user-info">
                                <span class="name">${u.full_name}</span>
                                <span class="email">${u.email}</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="role-badge">${u.role.toUpperCase()}</span></td>
                    <td><span class="metric-value">${u.page_visits}</span></td>
                    <td>
                        <div class="font-weight-600">${u.otp_requests}/${reqLimit}</div>
                        <div class="progress-mini"><div class="progress-bar" style="width: ${Math.min(100, (u.otp_requests / reqLimit) * 100)}%; background: ${u.otp_requests >= reqLimit ? 'var(--danger)' : 'var(--primary)'}"></div></div>
                    </td>
                    <td>
                        <div class="font-weight-600">${u.otp_input_attempts || 0}/${inputLimit}</div>
                        <div class="progress-mini"><div class="progress-bar" style="width: ${Math.min(100, (u.otp_input_attempts / inputLimit) * 100)}%; background: ${u.otp_input_attempts >= inputLimit ? 'var(--danger)' : 'var(--warning)'}"></div></div>
                    </td>
                    <td>
                        <div class="font-weight-600">${u.resends}/${reqLimit}</div>
                        <div class="progress-mini"><div class="progress-bar" style="width: ${Math.min(100, (u.resends / reqLimit) * 100)}%; background: var(--primary)"></div></div>
                    </td>
                    <td>
                        <span class="badge ${u.is_blocked ? 'badge-blocked' : 'badge-active'}">
                            <i class="bi ${u.is_blocked ? 'bi-lock-fill' : 'bi-shield-check'}"></i> ${u.is_blocked ? 'Blocked' : 'Active'}
                        </span>
                    </td>
                    <td class="text-muted-sm">${lastActivity}</td>
                    <td>
                        <div class="action-btns">
                            <button class="btn-mini" onclick="resetLimit('${u.email}', 'otp_limit')"><i class="bi bi-arrow-counterclockwise"></i> OTP Limit</button>
                            <button class="btn-mini" onclick="resetLimit('${u.email}', 'input_tries')"><i class="bi bi-pencil-square"></i> Input Tries</button>
                            <button class="btn-mini" onclick="resetLimit('${u.email}', 'resend_limit')"><i class="bi bi-send"></i> Resend Limit</button>
                            <button class="btn-mini" onclick="resetLimit('${u.email}', 'page_visits')"><i class="bi bi-eye"></i> Page Visits</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });

            document.getElementById('recordCount').innerText = `Showing ${data.users.length} records`;
        }

        function resetLimit(email, type) {
            if (!confirm(`Are you sure you want to reset ${type.replace('_', ' ')} for ${email}?`)) return;

            const formData = new FormData();
            formData.append('email', email);
            formData.append('type', type);

            fetch('<?php echo $route_prefix; ?>admin/reset-security-limit', {
                method: 'POST',
                body: formData
            })
                .then(r => r.json())
                .then(data => {
                    if (data.status === 'success') {
                        showToast(data.message, 'success');
                        loadSecurityStats(); // Reload
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(e => showToast("Error resetting limit", 'error'));
        }

        function filterTable() {
            const input = document.getElementById("userSearch");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("securityTable");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                const tdName = tr[i].getElementsByClassName("name")[0];
                const tdEmail = tr[i].getElementsByClassName("email")[0];
                if (tdName || tdEmail) {
                    const text = (tdName.innerText + " " + tdEmail.innerText).toLowerCase();
                    tr[i].style.display = text.indexOf(filter) > -1 ? "" : "none";
                }
            }
        }

        function formatDateTime(dateTimeStr) {
            const date = new Date(dateTimeStr);
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) + ' ' +
                date.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
        }
    </script>
</body>

</html>