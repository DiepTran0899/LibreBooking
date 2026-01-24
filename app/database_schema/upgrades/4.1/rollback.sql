-- Rollback script for Camera Feature
-- Run this script if you need to remove the camera feature changes

-- Remove the note column from reservation_files table
ALTER TABLE `reservation_files` DROP COLUMN `note`;

-- Note: This will not delete existing attachment files
-- Files are stored in uploads/reservation_attachments/ and named by file_id
