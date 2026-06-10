-- Update FAST sync status enum values
-- Migration: 023_update_fast_sync_status_enum.sql

-- Expand enum temporarily to allow value migration
ALTER TABLE projects
    MODIFY COLUMN fast_sync_status ENUM('PENDING','SYNCED','FAILED','ACCEPTED','REJECTED') DEFAULT NULL;

-- Map legacy values
UPDATE projects SET fast_sync_status = 'ACCEPTED' WHERE fast_sync_status = 'SYNCED';
UPDATE projects SET fast_sync_status = NULL WHERE fast_sync_status = 'FAILED';

-- Finalize enum values
ALTER TABLE projects
    MODIFY COLUMN fast_sync_status ENUM('PENDING','ACCEPTED','REJECTED') DEFAULT NULL;
