<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Submissions Progress - LDP</title>
    <?php include BASE_PATH . 'includes/head.php'; ?>
    <style>
        .submission-card {
            margin-bottom: 24px;
            position: relative;
        }

        .submission-card .card-body {
            padding: 16px 20px;
        }

        .prog-track-wrapper {
            margin-top: 16px;
            position: relative;
            padding: 0 10px;
        }

        .prog-track-line {
            position: absolute;
            top: 14px;
            left: 20px;
            right: 20px;
            height: 4px;
            background: var(--bg-tertiary);
            z-index: 1;
            border-radius: 2px;
        }

        .prog-track-fill {
            position: absolute;
            top: 14px;
            left: 20px;
            height: 4px;
            background: var(--success);
            z-index: 2;
            border-radius: 2px;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .prog-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            z-index: 3;
        }

        .prog-step {
            text-align: center;
            flex: 1;
            transition: all 0.3s ease;
            cursor: default;
            position: relative;
        }

        /* Base Pop Effect */
        .prog-step:hover .prog-icon {
            transform: translateY(-5px) scale(1.15);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            border-color: var(--primary-light);
            background: white;
            color: var(--primary);
        }

        .prog-step.active:hover .prog-icon {
            border-color: var(--success);
            box-shadow: 0 0 0 6px var(--success-bg), 0 8px 20px rgba(16, 185, 129, 0.2);
        }

        /* --- Individual Icon Animations --- */

        /* 1. Fly away for SUBMITTED (bi-send) */
        .prog-step:hover .bi-send {
            animation: fly-away 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes fly-away {
            0% { transform: translate(0, 0) rotate(0); }
            20% { transform: translate(-2px, 2px) rotate(-15deg); }
            100% { transform: translate(40px, -40px) rotate(10deg); opacity: 0; }
        }

        /* 2. Fast Blink for REVIEWED (bi-eye) */
        .prog-step:hover .bi-eye {
            animation: eye-blink 0.6s ease-in-out infinite;
        }

        @keyframes eye-blink {
            0%, 10%, 90%, 100% { transform: scaleY(1); }
            50% { transform: scaleY(0.1); }
        }

        /* 3. Bounce/Check for RECOMMENDED (bi-check2-circle) */
        .prog-step:hover .bi-check2-circle {
            animation: check-write 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes check-write {
            0% { transform: scale(1); }
            50% { transform: scale(1.3) rotate(-15deg); }
            100% { transform: scale(1.1) rotate(0); }
        }

        /* 4. Steady Winner Pop for APPROVED (bi-trophy) */
        .prog-step:hover .bi-trophy {
            animation: trophy-winner-pop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            position: relative;
            z-index: 10;
        }

        @keyframes trophy-winner-pop {
            0% { transform: scale(1); }
            50% { transform: scale(1.6); color: #fbbf24; }
            100% { transform: scale(1.4); color: #fbbf24; filter: drop-shadow(0 0 12px rgba(251, 191, 36, 0.4)); }
        }

        .prog-icon {
            width: 32px;
            height: 32px;
            background: white;
            border: 2.5px solid var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            font-size: 0.85rem;
            color: var(--text-muted);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            z-index: 5;
        }

        .prog-step.active .prog-icon {
            border-color: var(--success);
            color: var(--success);
            box-shadow: 0 0 0 6px var(--success-bg);
        }

        .prog-label {
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--text-secondary);
            text-transform: uppercase;
        }

        .prog-date {
            font-size: 0.6rem;
            color: var(--text-muted);
            display: block;
            margin-top: 1px;
        }

        .filter-bar-custom {
            background: var(--card-bg);
            padding: 12px 16px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            margin-bottom: 20px;
            display: flex;
            gap: 12px;
            align-items: center;
            box-shadow: var(--shadow-sm);
        }

        .dashboard-card.submission-card {
            transition: all var(--transition-base);
            border: 1px solid var(--border-color);
        }

        .dashboard-card.submission-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .submissions-list-scroll {
            max-height: 850px;
            overflow-y: auto;
            padding: 4px 12px 20px 4px;
            margin-right: -12px;
        }

        .activity-meta-info {
            font-size: 0.82rem;
            color: #64748b;
            font-weight: 500;
            margin-top: 8px;
            display: flex;
            gap: 16px;
        }

        .activity-meta-info i {
            color: var(--primary-light);
            font-size: 0.9rem;
        }

        .status-pill {
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid transparent;
        }

        .status-pill.pending { background: #f8fafc; color: #64748b; border-color: #e2e8f0; }
        .status-pill.reviewed { background: #fffbeb; color: #b45309; border-color: #fef3c7; }
        .status-pill.recommending { background: #eff6ff; color: #1d4ed8; border-color: #dbeafe; }
        .status-pill.approved,
        .status-pill.viewed { background: #f0fdf4; color: #15803d; border-color: #dcfce7; }
        .status-pill.recorded { background: #f5f3ff; color: #6d28d9; border-color: #ddd6fe; }

        .missing-doc-badge {
            background: #fff1f2;
            color: #e11d48;
            border: 1px solid #fda4af;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-left: 8px;
        }

        .missing-doc-badge i {
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .filter-bar-custom {
                flex-wrap: wrap;
                gap: 10px;
                padding: 15px;
            }

            .filter-bar-custom > div.search-box {
                flex: 1 1 100% !important;
                min-width: 100% !important;
                width: 100% !important;
            }

            .filter-bar-custom > div.status-box {
                flex: 0 0 auto !important;
                min-width: 150px !important;
                width: auto !important;
            }

            .filter-bar-custom .form-control {
                width: 100% !important;
                height: auto !important;
                padding-top: 8px !important;
                padding-bottom: 8px !important;
            }

            .filter-bar-custom .btn {
                flex: 1;
                height: auto !important;
                padding-top: 10px !important;
                padding-bottom: 10px !important;
            }
        }
    </style>
</head>

<body>
    <div class="app-layout">
        <?php include BASE_PATH . 'includes/sidebar.php'; ?>

        <div class="main-content">
            <header class="top-bar">
                <div class="top-bar-left">
                    <div class="breadcrumb">
                        <h1 class="page-title">My Activity History</h1>
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
                <form method="GET" action="<?php echo PUBLIC_ROOT; ?>index.php/user/submissions-progress"
                    class="filter-bar-custom">
                    <div class="search-box" style="position: relative; flex: 1; min-width: 250px;">
                        <i class="bi bi-search"
                            style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                        <input type="text" name="search" class="form-control" placeholder="Search activities..."
                            value="<?php echo htmlspecialchars($filters['search']); ?>"
                            style="padding-left: 42px;">
                    </div>
                    <div class="status-box" style="width: 160px;">
                        <select name="status" class="form-control">
                            <option value="">All Statuses</option>
                            <option value="Pending" <?php echo $filters['status'] == 'Pending' ? 'selected' : ''; ?>>
                                Pending</option>
                            <option value="Reviewed" <?php echo $filters['status'] == 'Reviewed' ? 'selected' : ''; ?>>
                                Reviewed</option>
                            <option value="Recommending" <?php echo $filters['status'] == 'Recommending' ? 'selected' : ''; ?>>Recommending</option>
                            <option value="Approved" <?php echo $filters['status'] == 'Approved' ? 'selected' : ''; ?>>
                                Approved</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i>
                        Apply</button>
                    <?php if ($filters['search'] || $filters['status']): ?>
                        <a href="<?php echo PUBLIC_ROOT; ?>index.php/user/submissions-progress" class="btn btn-secondary"
                            style="display: flex; align-items: center;">Reset</a>
                    <?php endif; ?>
                </form>

                <div class="submissions-list-scroll">
                    <?php include BASE_PATH . 'includes/functions/activity-functions.php'; ?>
                    <?php if (count($activities) > 0): ?>
                        <?php foreach ($activities as $act):
                            $prog = getProgressInfo($act);
                            $active_count = 0;
                            foreach ($prog['stages'] as $s)
                                if ($s['completed'])
                                    $active_count++;
                            $line_pct = ($active_count - 1) / (count($prog['stages']) - 1) * 100;
                            if ($line_pct < 0)
                                $line_pct = 0;
                            ?>
                            <div class="dashboard-card submission-card">
                                <div class="card-body">
                                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                        <div>
                                            <p style="margin: 0; font-size: 0.75rem; color: #64748b; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 2px; display: flex; align-items: center;">
                                                #<?php echo htmlspecialchars($act['tracking_number']); ?>
                                                <?php 
                                                $missingCompletion = empty($act['completion_report_path']);
                                                $missingUtilization = empty($act['certificate_utilization_path']);
                                                if (!empty($act['workplace_image_path'])) {
                                                    $missingCompletion = false;
                                                    $missingUtilization = false;
                                                }
                                                if ($missingCompletion): ?>
                                                    <span class="missing-doc-badge" title="Missing Completion Report">
                                                        <i class="bi bi-file-earmark-x-fill"></i> MISSING COMP REPORT
                                                    </span>
                                                <?php endif; ?>
                                                <?php if ($missingUtilization): ?>
                                                    <span class="missing-doc-badge" title="Missing Utilization Certificate">
                                                        <i class="bi bi-file-earmark-x-fill"></i> MISSING UTIL CERT
                                                    </span>
                                                <?php endif; ?>
                                                <?php if (empty($act['application_file_path'])): ?>
                                                    <span class="missing-doc-badge" title="Missing AoL Plan Document">
                                                        <i class="bi bi-file-earmark-medical"></i> MISSING AOL PLAN
                                                    </span>
                                                <?php endif; ?>
                                            </p>
                                            <h3 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; letter-spacing: -0.01em; margin: 0;">
                                                <?php echo htmlspecialchars($act['title']); ?>
                                            </h3>
                                            <?php
                                            $isRelevantExpertise = strpos($act['competency'], 'Relevant Expertise') !== false;
                                            ?>
                                            <div class="activity-meta-info">
                                                <span><i class="bi bi-geo-alt-fill"></i>
                                                    <?php echo htmlspecialchars($act['venue']); ?>
                                                </span>
                                                <span><i class="bi bi-calendar-event-fill"></i>
                                                    <?php echo date('M d, Y', strtotime(explode(', ', $act['date_attended'])[0])); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div style="text-align: right;">
                                            <?php if ($isRelevantExpertise): ?>
                                                <span class="status-pill recorded">
                                                    <i class="bi bi-patch-check-fill"></i> Recorded Entry
                                                </span>
                                            <?php else: 
                                                $statusClass = strtolower($act['status'] ?? 'pending');
                                                ?>
                                                <span class="status-pill <?php echo $statusClass; ?>">
                                                    <i class="bi bi-dot" style="font-size: 1.5rem; margin: -5px;"></i>
                                                    <?php echo $act['status'] ?? 'Pending'; ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php if (!$isRelevantExpertise): ?>
                                        <div class="prog-track-wrapper">
                                            <div class="prog-track-line"></div>
                                            <div class="prog-track-fill" style="width: <?php echo $line_pct; ?>%;"></div>
                                            <div class="prog-steps">
                                                <?php foreach ($prog['stages'] as $stage): ?>
                                                    <div class="prog-step <?php echo $stage['completed'] ? 'active' : ''; ?>">
                                                        <div class="prog-icon"><i class="bi <?php echo $stage['icon']; ?>"></i></div>
                                                        <span class="prog-label">
                                                            <?php echo $stage['label']; ?>
                                                        </span>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div
                                            style="margin-top: 16px; padding: 12px; background: #f8fafc; border-radius: 8px; font-size: 0.85rem; color: #64748b; display: flex; align-items: center; gap: 8px;">
                                            <i class="bi bi-info-circle-fill" style="color: #4338ca;"></i>
                                            <span>This activity is recorded via Relevant Expertise bypass and does not require
                                                approval.</span>
                                        </div>
                                    <?php endif; ?>

                                        <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                                            <a href="<?php echo PUBLIC_ROOT; ?>index.php/user/view-activity?id=<?php echo $act['id']; ?>"
                                                class="btn btn-secondary btn-sm">View Details</a>
                                            <?php if (!$act['reviewed_by_supervisor']): ?>
                                                <a href="<?php echo PUBLIC_ROOT; ?>index.php/user/edit-activity?id=<?php echo $act['id']; ?>"
                                                    class="btn btn-primary btn-sm">Edit Record</a>
                                            <?php else: 
                                                $missingCompletion = empty($act['completion_report_path']);
                                                $missingUtilization = empty($act['certificate_utilization_path']);
                                                if (!empty($act['workplace_image_path'])) {
                                                    $missingCompletion = false;
                                                    $missingUtilization = false;
                                                }
                                                $missingAoL = empty($act['application_file_path']);
                                                if ($missingCompletion || $missingUtilization || $missingAoL):
                                            ?>
                                                <a href="<?php echo PUBLIC_ROOT; ?>index.php/user/edit-activity?id=<?php echo $act['id']; ?>"
                                                    class="btn btn-primary btn-sm" style="background: #e11d48; border-color: #e11d48;">
                                                    Update Documentation
                                                </a>
                                            <?php endif; endif; ?>
                                        </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="dashboard-card" style="padding: 40px; text-align: center;">No activities found.</div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
</body>

</html>