-- SDO FAST Integration: Mandatory approval file upload tracking columns and sync log
-- Migration: 022_approval_file_upload.sql

-- Add approval file path column to projects table
ALTER TABLE projects
    ADD COLUMN approval_file_path VARCHAR(255) NULL;

-- Create bac_sync_logs for tracking proof of approval files
CREATE TABLE IF NOT EXISTS bac_sync_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    uploader VARCHAR(255) NOT NULL,
    pr_number VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
