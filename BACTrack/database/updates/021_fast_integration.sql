-- SDO FAST Integration: sync tracking columns and integration audit log
-- Migration: 021_fast_integration.sql

-- Add FAST sync tracking columns to projects table
ALTER TABLE projects
    ADD COLUMN fast_tracking_number VARCHAR(100) NULL,
    ADD COLUMN fast_sync_status ENUM('PENDING','ACCEPTED','REJECTED') DEFAULT NULL,
    ADD COLUMN fast_synced_at TIMESTAMP NULL;

CREATE INDEX idx_fast_sync_status ON projects (fast_sync_status);
CREATE INDEX idx_fast_tracking_number ON projects (fast_tracking_number);

-- Integration audit log for BACtrack ↔ FAST communication
CREATE TABLE IF NOT EXISTS integration_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    source_system VARCHAR(50) NOT NULL,
    destination_system VARCHAR(50) NOT NULL,
    event_type VARCHAR(100) NOT NULL,
    reference_id INT NULL,
    sync_status VARCHAR(50) NOT NULL DEFAULT 'PENDING',
    response_message TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_integration_source (source_system),
    INDEX idx_integration_event (event_type),
    INDEX idx_integration_ref (reference_id),
    INDEX idx_integration_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
