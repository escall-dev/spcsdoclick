<?php
// Load Environment Variables (if not already loaded via index.php)
if (!isset($_ENV['DB_HOST'])) {
    require_once __DIR__ . '/Env.php';
    App\Core\Env::load(__DIR__ . '/../.env');
}

$host = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$dbname = getenv('DB_NAME') ?: 'ldpver2';

// Set Global Timezone
date_default_timezone_set('Asia/Manila');

try {
    // Connect directly to the specific database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create users table
    // Fields based on "Learning & Development Passbook"
    // Name, Office/Station, Position, Employee Number, Area of Specialization, Age, Sex
    // Plus id, gmail, password, role (admin/user)
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        gmail VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        full_name VARCHAR(100) NOT NULL,
        office_station VARCHAR(100),
        position VARCHAR(100),
        employee_number VARCHAR(100),
        rating_period VARCHAR(100),
        area_of_specialization VARCHAR(100),
        age INT,
        sex VARCHAR(20),
        role VARCHAR(20) DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);

    // Create training_codes table
    $sql_codes = "CREATE TABLE IF NOT EXISTS training_codes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        code_name VARCHAR(100) NOT NULL UNIQUE,
        description VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql_codes);

    // Create events table for "Recent Events Attended"
    $sql_events = "CREATE TABLE IF NOT EXISTS events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        event_name VARCHAR(255) NOT NULL,
        event_date DATE NOT NULL,
        status VARCHAR(50) DEFAULT 'Attended',
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $pdo->exec($sql_events);

    // Create ld_activities table
    $sql_ld = "CREATE TABLE IF NOT EXISTS ld_activities (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        training_code VARCHAR(100),
        date_attended TEXT,
        venue VARCHAR(255),
        modality VARCHAR(100),
        competency VARCHAR(255),
        type_ld VARCHAR(100),
        type_ld_others VARCHAR(255),
        conducted_by VARCHAR(255),
        approved_by VARCHAR(255),
        workplace_application TEXT,
        workplace_image_path LONGTEXT,
        completion_report_path LONGTEXT,
        certificate_utilization_path LONGTEXT,
        organizer_signature_path VARCHAR(255),
        signature_path VARCHAR(255),
        reviewed_by_supervisor TINYINT(1) DEFAULT 0,
        recommending_asds TINYINT(1) DEFAULT 0,
        approved_sds TINYINT(1) DEFAULT 0,
        reviewed_at DATETIME NULL,
        recommended_at DATETIME NULL,
        approved_at DATETIME NULL,
        reflection TEXT,
        rating_period VARCHAR(100),
        job_embedded_learning VARCHAR(255) DEFAULT NULL,
        status VARCHAR(50) DEFAULT 'Pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $pdo->exec($sql_ld);

    // Create activity_logs table
    $sql_logs = "CREATE TABLE IF NOT EXISTS activity_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        action VARCHAR(255) NOT NULL,
        details TEXT,
        ip_address VARCHAR(45),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $pdo->exec($sql_logs);

    // Create job_embedded_learning table
    $sql_jel = "CREATE TABLE IF NOT EXISTS job_embedded_learning (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql_jel);

} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>