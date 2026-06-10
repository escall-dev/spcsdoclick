-- Migration: Allow uploaded_form signature type for handwritten submissions
USE sdo_cts;

ALTER TABLE complaints
MODIFY COLUMN signature_type ENUM('digital', 'typed', 'uploaded_form') NOT NULL DEFAULT 'typed';
