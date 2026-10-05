-- Migration: Add company_id to users table and backfill from branches

-- 1. Add company_id column if not exists
SET @dbname = DATABASE();
SET @tablename = "users";
SET @columnname = "company_id";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      (TABLE_NAME = @tablename)
      AND (TABLE_SCHEMA = @dbname)
      AND (COLUMN_NAME = @columnname)
  ) > 0,
  "SELECT 1",
  "ALTER TABLE `users` ADD COLUMN `company_id` INT(11) NOT NULL DEFAULT 1 AFTER `branch_id`, ADD INDEX `idx_users_company_id` (`company_id`)"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- 2. Backfill existing users' company_id from their assigned branch_id if valid
UPDATE `users` u
JOIN `branches` b ON b.branch_id = u.branch_id
SET u.company_id = b.company_id
WHERE b.company_id IS NOT NULL AND b.company_id > 0;

-- 3. Fallback for any remaining users
UPDATE `users`
SET `company_id` = 1
WHERE `company_id` IS NULL OR `company_id` <= 0;

-- 4. Clean up user_branch_access where branch does not belong to the user's company
DELETE uba
FROM `user_branch_access` uba
JOIN `users` u ON u.id = uba.user_id
JOIN `branches` b ON b.branch_id = uba.branch_id
WHERE uba.branch_id > 0 AND b.company_id != u.company_id;
