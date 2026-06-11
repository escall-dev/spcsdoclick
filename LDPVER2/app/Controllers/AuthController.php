<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Config\Database;
use PDO;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController extends Controller
{
    public function index()
    {
        $db = new Database();
        $pdo = $db->getConnection();

        $message = '';
        $isRegistration = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['register'])) {
                if (isset($_POST['request_registration_code'])) {
                    $password = trim($_POST['reg_password']);
                    $gmail = trim($_POST['gmail'] ?? '');

                    // Basic validation
                    if (empty($password) || empty($gmail)) {
                        echo json_encode(['status' => 'error', 'message' => "Required fields missing."]);
                        exit;
                    }

                    if (strlen($password) < 6 || strlen($password) > 10) {
                        echo json_encode(['status' => 'error', 'message' => "Password must be 6-10 characters long."]);
                        exit;
                    }

                    // Check if email exists
                    $stmt = $pdo->prepare("SELECT id FROM users WHERE gmail = ?");
                    $stmt->execute([$gmail]);
                    if ($stmt->fetch()) {
                        echo json_encode(['status' => 'error', 'message' => "Email address already exists."]);
                        exit;
                    }

                    // 0. Check Hourly Rate Limit (3 per hour)
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM registration_request_logs WHERE email = ? AND requested_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
                    $stmt->execute([$gmail]);
                    $requestCount = $stmt->fetchColumn();

                    if ($requestCount >= 3) {
                        echo json_encode(['status' => 'error', 'message' => 'Maximum registration code requests reached for this hour. Please try again in an hour.']);
                        exit;
                    }

                    // Generate 6-digit code
                    $code = sprintf("%06d", mt_rand(100000, 999999));

                    // Store registration data in session
                    $_SESSION['reg_data'] = [
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'full_name' => trim($_POST['full_name']),
                        'office_station' => trim($_POST['office_station'] ?? ''),
                        'position' => trim($_POST['position'] ?? ''),
                        'employee_number' => trim($_POST['employee_number'] ?? ''),
                        'area_of_specialization' => trim($_POST['area_of_specialization'] ?? ''),
                        'age' => (int) ($_POST['age'] ?? 0),
                        'sex' => trim($_POST['sex'] ?? ''),
                        'gmail' => $gmail,
                        'code' => $code,
                        'attempts' => 0,
                        'expires' => time() + (10 * 60) // 10 minutes
                    ];

                    // Log the request
                    $pdo->prepare("INSERT INTO registration_request_logs (email) VALUES (?)")->execute([$gmail]);

                    // Send Email
                    $subject = "Registration Verification Code - Electronic L&D Passbook";
                    $body = $this->getEmailTemplate(
                        "Registration Verification",
                        "Thank you for registering. Please use the following 6-digit code to verify your email address. This code is valid for 10 minutes.",
                        $code
                    );

                    if ($this->sendEmail($gmail, $_POST['full_name'], $subject, $body)) {
                        echo json_encode(['status' => 'success', 'message' => "Verification code sent to $gmail."]);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => "Failed to send verification email. Please try again."]);
                    }
                    exit;
                }

                if (isset($_POST['verify_registration_code'])) {
                    $code = trim($_POST['code'] ?? '');

                    if (!isset($_SESSION['reg_data']) || empty($_SESSION['reg_data'])) {
                        echo json_encode(['status' => 'error', 'message' => "Session expired. Please start over."]);
                        exit;
                    }

                    $reg_data = $_SESSION['reg_data'];

                    if (time() > $reg_data['expires']) {
                        unset($_SESSION['reg_data']);
                        echo json_encode(['status' => 'error', 'message' => "Verification code expired. Please start over."]);
                        exit;
                    }

                    if ($reg_data['code'] !== $code) {
                        $_SESSION['reg_data']['attempts']++;
                        $currentAttempts = $_SESSION['reg_data']['attempts'];

                        if ($currentAttempts >= 5) {
                            unset($_SESSION['reg_data']);
                            echo json_encode(['status' => 'attempts_exceeded', 'message' => "Too many failed attempts. Your registration session has been cleared. Please start over."]);
                        } else {
                            $remaining = 5 - $currentAttempts;
                            echo json_encode(['status' => 'error', 'message' => "Invalid verification code. $remaining attempts remaining."]);
                        }
                        exit;
                    }

                    error_log("Attempting to finalize registration for user: " . ($reg_data['gmail'] ?? 'unknown'));
                    
                    try {
                        $userRepo = new \App\Models\UserRepository($pdo);
                        
                        $userData = [
                            'password' => $reg_data['password'],
                            'full_name' => $reg_data['full_name'],
                            'office_station' => $reg_data['office_station'],
                            'position' => $reg_data['position'],
                            'area_of_specialization' => $reg_data['area_of_specialization'],
                            'age' => $reg_data['age'],
                            'sex' => $reg_data['sex'],
                            'gmail' => $reg_data['gmail'],
                            'employee_number' => $reg_data['employee_number'],
                            'is_active' => 1,
                            'role' => 'user'
                        ];

                        if ($userRepo->createUser($userData)) {
                            $newUserId = $pdo->lastInsertId();

                            // Notify Head HR about the new account
                            $stmtHead = $pdo->prepare("SELECT id FROM users WHERE role = 'head_hr'");
                            $stmtHead->execute();
                            $headHRs = $stmtHead->fetchAll(\PDO::FETCH_ASSOC);

                            if ($headHRs) {
                                $notifRepo = new \App\Models\NotificationRepository($pdo);
                                foreach ($headHRs as $hr) {
                                    $notifRepo->sendNotification($newUserId, $hr['id'], "A new account has been created and verified: " . $reg_data['full_name'] . " (" . $reg_data['gmail'] . ")");
                                }
                            }

                            // Log the registration in activity_logs
                            $logRepo = new \App\Models\ActivityLogRepository($pdo);
                            $logRepo->logAction($newUserId, 'Profile Created', "New account registered and verified via email: " . $reg_data['gmail']);

                            unset($_SESSION['reg_data']);
                            echo json_encode(['status' => 'success', 'message' => "Registration successful! Your account is now active. You can now log in."]);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => "Registration failed. Please try again."]);
                        }
                    } catch (\PDOException $e) {
                        error_log("Registration DB Error: " . $e->getMessage());
                        echo json_encode(['status' => 'error', 'message' => "Database error: " . $e->getMessage()]);
                    } catch (\Throwable $t) {
                        error_log("Registration Fatal Error: " . $t->getMessage());
                        echo json_encode(['status' => 'error', 'message' => "System error: " . $t->getMessage()]);
                    }
                    exit;
                }

                // Fallback for non-AJAX or old logic (though the UI now uses AJAX only)
                $isRegistration = true;
                $message = "Invalid or outdated registration request. Please refresh the page.";

                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    echo json_encode(['status' => 'error', 'message' => $message]);
                    exit;
                }
            } elseif (isset($_POST['forgot_password'])) {
                $email = trim($_POST['email']);
                $stmt = $pdo->prepare("SELECT full_name, gmail, role FROM users WHERE gmail = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    if ($user['role'] === 'super_admin') {
                        echo json_encode(['status' => 'error', 'message' => 'Password reset is not available for Super Admin accounts.']);
                        exit;
                    }

                    // 0. Check Hourly Rate Limit (3 per hour)
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reset_request_logs WHERE email = ? AND requested_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
                    $stmt->execute([$email]);
                    $requestCount = $stmt->fetchColumn();

                    if ($requestCount >= 3) {
                        echo json_encode(['status' => 'error', 'message' => 'Maximum reset requests reached for this hour. Please try again in an hour.']);
                        exit;
                    }

                    // 1. Check for active token (non-expired) and cooldown
                    $stmt = $pdo->prepare("SELECT token, created_at, TIMESTAMPDIFF(SECOND, created_at, NOW()) as diff FROM password_resets WHERE gmail = ? AND expires_at > NOW() ORDER BY created_at DESC LIMIT 1");
                    $stmt->execute([$email]);
                    $activeToken = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($activeToken) {
                        $token = $activeToken['token'];
                        $message = "Your active verification token has been re-sent to your email. It will expire in 5 minutes.";
                        $requestType = 'resend';
                    } else {
                        // 2. Invalidate all previous/expired tokens for this user
                        $pdo->prepare("DELETE FROM password_resets WHERE gmail = ?")->execute([$email]);

                        $token = sprintf("%06d", mt_rand(1, 999999));
                        $message = "A reset token has been sent to your registered email address. Note: The token expires in 5 minutes.";
                        $requestType = 'request';

                        // 3. Store new token with 5-minute expiration
                        $stmt = $pdo->prepare("INSERT INTO password_resets (gmail, token, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 5 MINUTE))");
                        $stmt->execute([$email, $token]);
                    }

                    // Log the request with type
                    $pdo->prepare("INSERT INTO reset_request_logs (email, type) VALUES (?, ?)")->execute([$email, $requestType]);

                    // Increment page visits / activity for this email
                    $pdo->prepare("INSERT INTO security_tracking (email, page_visits) VALUES (?, 1) ON DUPLICATE KEY UPDATE page_visits = page_visits + 1, last_activity = CURRENT_TIMESTAMP")->execute([$email]);

                    // Send email
                    $subject = "Security Verification Token - Electronic L&D Passbook";
                    $body = $this->getEmailTemplate(
                        "Password Reset Request",
                        "Please use the following 6-digit code to reset your password. This token is valid for 5 minutes.",
                        $token
                    );

                    if ($this->sendEmail($user['gmail'], $user['full_name'], $subject, $body)) {
                        echo json_encode(['status' => 'success', 'message' => $message]);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Email address not found.']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Email address not found.']);
                }
                exit;
            } elseif (isset($_POST['verify_token'])) {
                $email = trim($_POST['email']);
                $token = trim($_POST['token']);

                $stmt = $pdo->prepare("SELECT id FROM users WHERE gmail = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $stmt = $pdo->prepare("SELECT id, token, attempts FROM password_resets WHERE gmail = ? AND expires_at > NOW() ORDER BY created_at DESC LIMIT 1");
                    $stmt->execute([$email]);
                    $resetRecord = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($resetRecord) {
                        if ($resetRecord['token'] === $token) {
                            echo json_encode(['status' => 'success', 'message' => 'Token verified successfully.']);
                        } else {
                            $newAttempts = $resetRecord['attempts'] + 1;
                            if ($newAttempts >= 5) {
                                $pdo->prepare("DELETE FROM password_resets WHERE id = ?")->execute([$resetRecord['id']]);
                                echo json_encode(['status' => 'attempts_exceeded', 'message' => 'Too many failed attempts. Please request a new token.']);
                            } else {
                                $pdo->prepare("UPDATE password_resets SET attempts = ? WHERE id = ?")->execute([$newAttempts, $resetRecord['id']]);
                                $remaining = 5 - $newAttempts;
                                echo json_encode(['status' => 'error', 'message' => "Invalid token. $remaining attempts remaining."]);
                            }
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Invalid or expired token. Please request a new one.']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Email address not found.']);
                }
                exit;
            } elseif (isset($_POST['reset_password'])) {
                $email = trim($_POST['email']);
                $token = trim($_POST['token']);
                $password = trim($_POST['password']);

                if (strlen($password) < 6 || strlen($password) > 10) {
                    echo json_encode(['status' => 'error', 'message' => 'Password must be 6-10 characters long.']);
                    exit;
                }

                $stmt = $pdo->prepare("SELECT id FROM users WHERE gmail = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $stmt = $pdo->prepare("SELECT id FROM password_resets WHERE gmail = ? AND token = ? AND expires_at > NOW() ORDER BY created_at DESC LIMIT 1");
                    $stmt->execute([$email, $token]);

                    if ($stmt->fetch()) {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE gmail = ?");
                        if ($stmt->execute([$hashed_password, $email])) {
                            $pdo->prepare("DELETE FROM password_resets WHERE gmail = ?")->execute([$email]);
                            echo json_encode(['status' => 'success', 'message' => 'Password reset successful! You can now login with your new password.']);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Failed to reset password.']);
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Invalid session or token expired.']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Email address not found.']);
                }
                exit;
            } elseif (isset($_POST['log_reset_visit'])) {
                $email = isset($_POST['email']) ? trim($_POST['email']) : '';
                if ($email) {
                    $pdo->prepare("INSERT INTO security_tracking (email, page_visits) VALUES (?, 1) ON DUPLICATE KEY UPDATE page_visits = page_visits + 1, last_activity = CURRENT_TIMESTAMP")->execute([$email]);
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Email missing']);
                }
                exit;
            } else {
                $email = isset($_POST['email']) ? trim($_POST['email']) : '';
                $password = isset($_POST['password']) ? trim($_POST['password']) : '';

                if (empty($email) || empty($password)) {
                    $message = "Please enter both email address and password.";
                } else {
                    $stmt = $pdo->prepare("SELECT * FROM users WHERE gmail = ?");
                    $stmt->execute([$email]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($user && password_verify($password, $user['password'])) {
                        if (isset($user['is_active']) && $user['is_active'] == 0) {
                            $message = "Your account is pending HR verification. Please wait for approval.";
                        } else {
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['full_name'] = $user['full_name'];
                            $_SESSION['role'] = $user['role'];
                            $_SESSION['position'] = $user['position'];

                            $logStmt = $pdo->prepare("INSERT INTO activity_logs (user_id, action, ip_address) VALUES (?, ?, ?)");
                            $logStmt->execute([$user['id'], 'Logged In', $_SERVER['REMOTE_ADDR']]);

                            // REDIRECT TO APPROPRIATE DASHBOARD
                            if ($user['role'] === 'admin' || $user['role'] === 'super_admin' || $user['role'] === 'immediate_head' || $user['role'] === 'head_hr') {
                                $this->redirect('admin/dashboard');
                            } elseif ($user['role'] === 'hr') {
                                $this->redirect('hr/dashboard');
                            } else {
                                $this->redirect('user/home');
                            }
                        }
                    } else {
                        $message = "Invalid email address or password.";
                    }
                }
            }
        }

        // Fetch Offices for Dropdown
        $offices_list = [];
        if ($pdo) {
            try {
                $stmt_offices = $pdo->query("SELECT category, name, id FROM offices ORDER BY category, name");
                $offices_list = $stmt_offices->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                $offices_list = [];
            }
        }

        // Pass data to view
        $this->view('auth/login', [
            'message' => $message,
            'isRegistration' => $isRegistration,
            'offices_list' => $offices_list
        ]);
    }

}
