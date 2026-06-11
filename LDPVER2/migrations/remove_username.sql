-- Migration: Remove Username Field
-- This script removes the 'username' column and updates 'password_resets' to use 'gmail'.

-- 1. Update password_resets to use gmail instead of username
-- First, add the gmail column if it doesn't exist
ALTER TABLE password_resets ADD COLUMN gmail VARCHAR(100) AFTER token;

-- Map existing usernames to gmail from the users table
UPDATE password_resets pr
JOIN users u ON pr.username = u.username
SET pr.gmail = u.gmail;

-- Remove the username column from password_resets
ALTER TABLE password_resets DROP COLUMN username;

-- 2. Remove the username column from the users table
ALTER TABLE users DROP COLUMN username;
