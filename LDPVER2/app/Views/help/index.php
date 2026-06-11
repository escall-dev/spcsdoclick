<?php
// Extracted variables from $data (handled by Controller::view)
// $user, $notifRepo, $helpdesk_url, $satisfaction_url
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Need Help - ELDP</title>
    <?php require BASE_PATH . 'includes/admin_head.php'; ?>
    <style>
        .help-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .help-header {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeInDown 0.8s ease-out;
        }

        .help-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary) 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .help-header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        .help-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .help-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .help-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .help-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .help-card:hover::before {
            opacity: 1;
        }

        .help-icon-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2.5rem;
            color: var(--primary);
            transition: transform 0.3s ease;
        }

        .help-card:hover .help-icon-wrapper {
            transform: scale(1.1) rotate(5deg);
        }

        .help-card h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--text-main);
        }

        .help-card p {
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 30px;
            font-size: 0.95rem;
        }

        .help-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 28px;
            background: var(--primary);
            color: white;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .help-btn:hover {
            background: #2563eb;
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
            color: white;
        }

        .help-btn i {
            font-size: 1.2rem;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .help-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="app-layout">
        <?php require BASE_PATH . 'includes/sidebar.php'; ?>

        <div class="main-content">
            <header class="top-bar">
                <div class="top-bar-left">
                    <div class="breadcrumb">
                        <h1 class="page-title">Need Help</h1>
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
                <div class="help-container">
                    <div class="help-header">
                        <h1>How can we help you today?</h1>
                        <p>Select a service below to get the support or provide the feedback you need.</p>
                    </div>

                    <div class="help-grid">
                        <!-- ICT Helpdesk Card -->
                        <div class="help-card">
                            <div>
                                <div class="help-icon-wrapper">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <h2>ICT Helpdesk</h2>
                                <p>Encountering technical issues with the system? Our ICT support team is ready to assist you. Click the button below to visit our helpdesk portal and submit a ticket.</p>
                            </div>
                            <a href="<?php echo htmlspecialchars($helpdesk_url); ?>" target="_blank" class="help-btn">
                                <i class="bi bi-box-arrow-up-right"></i>
                                Go to Helpdesk
                            </a>
                        </div>

                        <!-- Client Satisfaction Card -->
                        <div class="help-card">
                            <div>
                                <div class="help-icon-wrapper" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <h2>Client Satisfaction</h2>
                                <p>Your feedback is vital for our continuous improvement. Please take a moment to share your experience with the Electronic L&D Passbook through our survey.</p>
                            </div>
                            <a href="<?php echo htmlspecialchars($satisfaction_url); ?>" target="_blank" class="help-btn" style="background: #10b981;">
                                <i class="bi bi-journal-check"></i>
                                Take the Survey
                            </a>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="admin-footer">
                <p>&copy; <?php echo date('Y'); ?> Electronic L&D Passbook. <span class="text-muted">Developed by ICT UNIT</span></p>
            </footer>
        </div>
    </div>
    <script src="<?php echo PUBLIC_ROOT; ?>js/admin/dashboard.js?v=<?php echo time(); ?>"></script>
</body>

</html>
