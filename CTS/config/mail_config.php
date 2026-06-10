<?php
/**
 * Email Configuration
 * SDO CTS - San Pedro Division Office Complaint Tracking System
 * 
 * Uses PHPMailer with SMTP for all email communications.
 * Configure via environment variables (.env file)
 */

require_once __DIR__ . '/env.php';
cts_load_env();

$smtpHost = cts_env('SMTP_HOST', 'smtp.gmail.com');
$smtpPassword = cts_env('SMTP_PASSWORD', '');

// Gmail app passwords are often copied with spaces; strip them for SMTP auth.
if (stripos($smtpHost, 'gmail') !== false) {
    $smtpPassword = str_replace(' ', '', $smtpPassword);
}

// SMTP Configuration - loaded from environment variables
define('MAIL_ENABLED', filter_var(cts_env('MAIL_ENABLED', 'true'), FILTER_VALIDATE_BOOLEAN));
define('SMTP_HOST', $smtpHost);
define('SMTP_PORT', intval(cts_env('SMTP_PORT', 587)));
define('SMTP_USERNAME', cts_env('SMTP_USERNAME', ''));
define('SMTP_PASSWORD', $smtpPassword);
define('SMTP_ENCRYPTION', cts_env('SMTP_ENCRYPTION', 'tls')); // 'tls' or 'ssl'
define('SMTP_AUTH', filter_var(cts_env('SMTP_AUTH', 'true'), FILTER_VALIDATE_BOOLEAN));

// Sender Configuration
define('MAIL_FROM_ADDRESS', cts_env('MAIL_FROM_ADDRESS', ''));
define('MAIL_FROM_NAME', cts_env('MAIL_FROM_NAME', 'SDO CTS - San Pedro Division Office'));
define('MAIL_REPLY_TO', cts_env('MAIL_REPLY_TO', ''));

// Admin notification recipients (comma-separated emails)
define('ADMIN_EMAIL_RECIPIENTS', cts_env('ADMIN_EMAIL_RECIPIENTS', ''));

// Email Settings
define('MAIL_CHARSET', 'UTF-8');
define('MAIL_DEBUG', intval(cts_env('MAIL_DEBUG', 0))); // 0 = off, 1 = client, 2 = server

// Email Templates Path
define('EMAIL_TEMPLATES_PATH', __DIR__ . '/../services/email/templates/');

// System URLs for email content
define('SYSTEM_BASE_URL', cts_env('SYSTEM_BASE_URL', 'http://localhost/SDO-cts'));
define('TRACKING_URL', SYSTEM_BASE_URL . '/track.php');
