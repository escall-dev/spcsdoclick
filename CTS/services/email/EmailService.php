<?php
/**
 * Email Service
 * SDO CTS - San Pedro Division Office Complaint Tracking System
 * 
 * Handles all email operations using PHPMailer with SMTP
 */

$autoloadPath = __DIR__ . '/../../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
}
require_once __DIR__ . '/../../config/mail_config.php';
require_once __DIR__ . '/../../config/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    private $mailer;
    private $db;
    private $lastError = '';

    public function __construct() {
        $this->db = Database::getInstance();
        $this->initializeMailer();
    }

    /**
     * Initialize PHPMailer with SMTP configuration
     */
    private function initializeMailer() {
        try {
            if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
                throw new Exception("PHPMailer class not found. Composer dependencies missing.");
            }

            if (SMTP_AUTH && (SMTP_USERNAME === '' || SMTP_PASSWORD === '')) {
                throw new Exception('SMTP credentials are not configured. Check CTS/.env on the server.');
            }

            if (MAIL_FROM_ADDRESS === '') {
                throw new Exception('MAIL_FROM_ADDRESS is not configured. Check CTS/.env on the server.');
            }

            $this->mailer = new PHPMailer(true);

            // Server settings
            $this->mailer->SMTPDebug = MAIL_DEBUG;
            $this->mailer->isSMTP();
            $this->mailer->Host = SMTP_HOST;
            $this->mailer->SMTPAuth = SMTP_AUTH;
            $this->mailer->Username = SMTP_USERNAME;
            $this->mailer->Password = SMTP_PASSWORD;
            $this->mailer->Timeout = 15;
            
            // Set encryption
            if (SMTP_ENCRYPTION === 'tls') {
                $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            } elseif (SMTP_ENCRYPTION === 'ssl') {
                $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            }
            
            $this->applyTransportSettings();
            $this->mailer->CharSet = MAIL_CHARSET;

            if (!SMTP_VERIFY_SSL) {
                $this->mailer->SMTPOptions = [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ],
                ];
            }

            // Set default sender
            if (MAIL_FROM_ADDRESS) {
                $this->mailer->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
            }

            // Set reply-to if configured
            if (MAIL_REPLY_TO) {
                $this->mailer->addReplyTo(MAIL_REPLY_TO, MAIL_FROM_NAME);
            }

            // HTML email
            $this->mailer->isHTML(true);

        } catch (Throwable $e) {
            $this->lastError = "Mailer Initialization Error: " . $e->getMessage();
            error_log($this->lastError);
        }
    }

    /**
     * Apply SMTP port and encryption settings.
     */
    private function applyTransportSettings($port = null, $encryption = null) {
        if (!$this->mailer) {
            return;
        }

        $port = $port ?? SMTP_PORT;
        $encryption = strtolower((string) ($encryption ?? SMTP_ENCRYPTION));
        $this->mailer->Port = $port;

        if ($encryption === 'tls') {
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->SMTPAutoTLS = true;
        } elseif ($encryption === 'ssl') {
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mailer->SMTPAutoTLS = false;
        } else {
            $this->mailer->SMTPSecure = '';
            $this->mailer->SMTPAutoTLS = false;
        }
    }

    /**
     * Determine whether another SMTP transport attempt may help.
     */
    private function isRetryableSmtpError($message) {
        $message = strtolower((string) $message);
        $needles = [
            'connect',
            'connection',
            'timeout',
            'timed out',
            'could not',
            'stream_socket_client',
            'smtp connect() failed',
            'failed to connect',
        ];

        foreach ($needles as $needle) {
            if (strpos($message, $needle) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Try configured SMTP transport, then common shared-hosting fallbacks.
     */
    private function deliverSmtpMessage(callable $prepareMessage) {
        if (!$this->mailer) {
            return false;
        }

        $transportAttempts = [
            ['port' => SMTP_PORT, 'encryption' => SMTP_ENCRYPTION],
        ];

        if (SMTP_PORT !== 465 || strtolower(SMTP_ENCRYPTION) !== 'ssl') {
            $transportAttempts[] = ['port' => 465, 'encryption' => 'ssl'];
        }

        if (SMTP_PORT !== 587 || strtolower(SMTP_ENCRYPTION) !== 'tls') {
            $transportAttempts[] = ['port' => 587, 'encryption' => 'tls'];
        }

        $lastError = $this->lastError;

        foreach ($transportAttempts as $transport) {
            $this->applyTransportSettings($transport['port'], $transport['encryption']);
            $this->resetMailer();

            try {
                $prepareMessage();
                $this->mailer->send();
                $this->lastError = '';
                return true;
            } catch (Throwable $e) {
                $lastError = $this->mailer ? $this->mailer->ErrorInfo : $e->getMessage();
                if (!$this->isRetryableSmtpError($lastError)) {
                    break;
                }
            }
        }

        $this->lastError = $lastError ?: 'SMTP delivery failed';
        return false;
    }

    /**
     * Last-resort delivery for shared hosts that block external SMTP.
     */
    private function sendViaPhpMail(array $recipients, $subject, $body) {
        if (!function_exists('mail') || MAIL_FROM_ADDRESS === '') {
            return false;
        }

        $from = sprintf('%s <%s>', MAIL_FROM_NAME, MAIL_FROM_ADDRESS);
        $headers = implode("\r\n", [
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $from,
            'Reply-To: ' . (MAIL_REPLY_TO ?: MAIL_FROM_ADDRESS),
            'X-Mailer: SDO-CTS',
        ]);

        $allSent = true;
        foreach ($recipients as $recipient) {
            if (!@mail(trim($recipient), $subject, $body, $headers)) {
                $allSent = false;
                $this->lastError = 'PHP mail() delivery failed';
            }
        }

        return $allSent;
    }

    /**
     * Reset mailer for new email
     */
    private function resetMailer() {
        if (!$this->mailer) {
            return;
        }

        $this->mailer->clearAddresses();
        $this->mailer->clearAttachments();
        $this->mailer->clearCCs();
        $this->mailer->clearBCCs();
        $this->mailer->clearReplyTos();
        $this->lastError = '';

        // Re-set default sender
        if (MAIL_FROM_ADDRESS) {
            try {
                $this->mailer->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
            } catch (Exception $e) {
                $this->lastError = $e->getMessage();
            }
        }

        // Re-set reply-to if configured
        if (MAIL_REPLY_TO) {
            try {
                $this->mailer->addReplyTo(MAIL_REPLY_TO, MAIL_FROM_NAME);
            } catch (Exception $e) {
                // Non-critical error
            }
        }
    }

    /**
     * Embed logo images for email templates
     * This ensures logos display properly in all email clients
     */
    private function embedLogos() {
        if (!$this->mailer) {
            return;
        }

        $sdoLogoPath = __DIR__ . '/../../assets/img/sdo-logo.jpg';
        $bagongPilipinasLogoPath = __DIR__ . '/../../assets/img/bagongpilpinas-logo.png';

        // Embed SDO logo
        if (file_exists($sdoLogoPath)) {
            $this->mailer->addEmbeddedImage($sdoLogoPath, 'sdo_logo', 'sdo-logo.jpg');
        }

        // Embed Bagong Pilipinas logo
        if (file_exists($bagongPilipinasLogoPath)) {
            $this->mailer->addEmbeddedImage($bagongPilipinasLogoPath, 'bagongpilipinas_logo', 'bagongpilipinas-logo.png');
        }
    }

    /**
     * Set custom sender address
     */
    public function setFrom($email, $name = null) {
        if (!$this->mailer) {
            $this->lastError = 'Mailer not initialized';
            return false;
        }

        try {
            $this->mailer->setFrom($email, $name ?: MAIL_FROM_NAME);
            return true;
        } catch (Exception $e) {
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    /**
     * Send email
     */
    public function send($to, $subject, $body, $eventType = 'general', $referenceId = null) {
        if (!MAIL_ENABLED) {
            $this->logEmail($to, $subject, $eventType, $referenceId, 'skipped', 'Email notifications disabled');
            return true; // Return true to not interrupt processing
        }

        // Check for duplicate notification
        if ($this->isDuplicateNotification($to, $eventType, $referenceId)) {
            $this->logEmail($to, $subject, $eventType, $referenceId, 'skipped', 'Duplicate notification prevented');
            return true;
        }

        $recipients = is_array($to) ? $to : [$to];
        $sent = false;

        if ($this->mailer) {
            $sent = $this->deliverSmtpMessage(function () use ($recipients, $subject, $body) {
                foreach ($recipients as $recipient) {
                    $this->mailer->addAddress(trim($recipient));
                }

                $this->embedLogos();
                $this->mailer->Subject = $subject;
                $this->mailer->Body = $body;
                $this->mailer->AltBody = strip_tags(str_replace(['<br>', '<br/>', '<br />', '</p>'], "\n", $body));
            });
        } else {
            $this->lastError = $this->lastError ?: 'Mailer not initialized';
        }

        if (!$sent && MAIL_USE_PHP_MAIL_FALLBACK) {
            $sent = $this->sendViaPhpMail($recipients, $subject, $body);
        }

        foreach ($recipients as $recipient) {
            $this->logEmail(
                trim($recipient),
                $subject,
                $eventType,
                $referenceId,
                $sent ? 'sent' : 'failed',
                $sent ? null : $this->lastError
            );
        }

        return $sent;
    }

    /**
     * Send email with attachment
     */
    public function sendWithAttachment($to, $subject, $body, $attachmentPath, $attachmentName = '', $eventType = 'general', $referenceId = null) {
        if (!MAIL_ENABLED) {
            return true;
        }

        $recipients = is_array($to) ? $to : [$to];
        $sent = false;

        if ($this->mailer) {
            $sent = $this->deliverSmtpMessage(function () use ($recipients, $subject, $body, $attachmentPath, $attachmentName) {
                foreach ($recipients as $recipient) {
                    $this->mailer->addAddress(trim($recipient));
                }

                $this->embedLogos();
                $this->mailer->Subject = $subject;
                $this->mailer->Body = $body;
                $this->mailer->AltBody = strip_tags(str_replace(['<br>', '<br/>', '<br />', '</p>'], "\n", $body));

                if (file_exists($attachmentPath)) {
                    $this->mailer->addAttachment($attachmentPath, $attachmentName ?: basename($attachmentPath));
                }
            });
        } else {
            $this->lastError = $this->lastError ?: 'Mailer not initialized';
        }

        if (!$sent && MAIL_USE_PHP_MAIL_FALLBACK) {
            $sent = $this->sendViaPhpMail($recipients, $subject, $body);
        }

        foreach ($recipients as $recipient) {
            $this->logEmail(
                trim($recipient),
                $subject,
                $eventType,
                $referenceId,
                $sent ? 'sent' : 'failed',
                $sent ? null : $this->lastError
            );
        }

        return $sent;
    }

    /**
     * Send email with multiple attachments
     * @param string|array $to Recipient email(s)
     * @param string $subject Email subject
     * @param string $body Email body (HTML)
     * @param array $attachments Array of attachments, each with 'path' and optional 'name' keys
     * @param string $eventType Event type for logging
     * @param int|null $referenceId Reference ID for logging
     * @return bool Success status
     */
    public function sendWithMultipleAttachments($to, $subject, $body, $attachments = [], $eventType = 'general', $referenceId = null) {
        if (!MAIL_ENABLED) {
            $this->logEmail(is_array($to) ? $to[0] : $to, $subject, $eventType, $referenceId, 'skipped', 'Email notifications disabled');
            return true;
        }

        // Check for duplicate notification
        if ($this->isDuplicateNotification($to, $eventType, $referenceId)) {
            $this->logEmail(is_array($to) ? $to[0] : $to, $subject, $eventType, $referenceId, 'skipped', 'Duplicate notification prevented');
            return true;
        }

        $recipients = is_array($to) ? $to : [$to];
        $sent = false;

        if ($this->mailer) {
            $sent = $this->deliverSmtpMessage(function () use ($recipients, $subject, $body, $attachments) {
                foreach ($recipients as $recipient) {
                    $this->mailer->addAddress(trim($recipient));
                }

                $this->embedLogos();
                $this->mailer->Subject = $subject;
                $this->mailer->Body = $body;
                $this->mailer->AltBody = strip_tags(str_replace(['<br>', '<br/>', '<br />', '</p>'], "\n", $body));

                foreach ($attachments as $attachment) {
                    if (isset($attachment['path']) && file_exists($attachment['path'])) {
                        $attachmentName = $attachment['name'] ?? basename($attachment['path']);
                        $this->mailer->addAttachment($attachment['path'], $attachmentName);
                    }
                }
            });
        } else {
            $this->lastError = $this->lastError ?: 'Mailer not initialized';
        }

        if (!$sent && MAIL_USE_PHP_MAIL_FALLBACK) {
            $sent = $this->sendViaPhpMail($recipients, $subject, $body);
        }

        foreach ($recipients as $recipient) {
            $this->logEmail(
                trim($recipient),
                $subject,
                $eventType,
                $referenceId,
                $sent ? 'sent' : 'failed',
                $sent ? null : $this->lastError
            );
        }

        return $sent;
    }

    /**
     * Check if notification was already sent (prevent duplicates)
     */
    private function isDuplicateNotification($to, $eventType, $referenceId) {
        if (!$referenceId) {
            return false;
        }

        $recipient = is_array($to) ? $to[0] : $to;

        try {
            $sql = "SELECT id FROM email_logs 
                    WHERE recipient_email = ? 
                    AND event_type = ? 
                    AND reference_id = ? 
                    AND status = 'sent'
                    AND created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)
                    LIMIT 1";
            
            $result = $this->db->query($sql, [trim($recipient), $eventType, $referenceId])->fetch();
            return !empty($result);
        } catch (Exception $e) {
            // If table doesn't exist, allow email
            return false;
        }
    }

    /**
     * Log email sending attempt
     */
    private function logEmail($recipient, $subject, $eventType, $referenceId, $status, $errorMessage = null) {
        try {
            $sql = "INSERT INTO email_logs (recipient_email, subject, event_type, reference_id, status, error_message)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $this->db->query($sql, [$recipient, $subject, $eventType, $referenceId, $status, $errorMessage]);
        } catch (Exception $e) {
            // Log to error_log if database logging fails
            error_log("Email Log Error: " . $e->getMessage());
        }
    }

    /**
     * Get last error message
     */
    public function getLastError() {
        return $this->lastError;
    }

    /**
     * Test SMTP connection
     */
    public function testConnection() {
        if (!$this->mailer) {
            return ['success' => false, 'message' => $this->lastError ?: 'Mailer not initialized'];
        }

        $transportAttempts = [
            ['port' => SMTP_PORT, 'encryption' => SMTP_ENCRYPTION, 'label' => SMTP_PORT . '/' . SMTP_ENCRYPTION],
        ];

        if (SMTP_PORT !== 465 || strtolower(SMTP_ENCRYPTION) !== 'ssl') {
            $transportAttempts[] = ['port' => 465, 'encryption' => 'ssl', 'label' => '465/ssl'];
        }

        if (SMTP_PORT !== 587 || strtolower(SMTP_ENCRYPTION) !== 'tls') {
            $transportAttempts[] = ['port' => 587, 'encryption' => 'tls', 'label' => '587/tls'];
        }

        $errors = [];
        foreach ($transportAttempts as $transport) {
            try {
                $this->applyTransportSettings($transport['port'], $transport['encryption']);
                $this->mailer->smtpConnect();
                $this->mailer->smtpClose();
                return [
                    'success' => true,
                    'message' => 'SMTP connection successful via ' . $transport['label'],
                ];
            } catch (Exception $e) {
                $errors[] = $transport['label'] . ': ' . $e->getMessage();
            }
        }

        return ['success' => false, 'message' => implode(' | ', $errors)];
    }
}
