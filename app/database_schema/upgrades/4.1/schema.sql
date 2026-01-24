-- Add note column to reservation_files table for image annotations
ALTER TABLE `reservation_files` ADD COLUMN `note` TEXT DEFAULT NULL AFTER `file_extension`;
