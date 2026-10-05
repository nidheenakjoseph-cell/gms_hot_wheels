-- ============================================================
-- GMS Service Reminder — Add company_id for multi-company isolation
-- Created: 2026-09-20
-- ============================================================

-- 1. Add company_id to service_reminder_settings
ALTER TABLE `service_reminder_settings`
  ADD COLUMN IF NOT EXISTS `company_id` INT(11) NOT NULL DEFAULT 1 AFTER `setting_id`;

-- Index for fast lookups per company
ALTER TABLE `service_reminder_settings`
  ADD INDEX IF NOT EXISTS `idx_company_id` (`company_id`);

-- 2. Add company_id to service_reminders
ALTER TABLE `service_reminders`
  ADD COLUMN IF NOT EXISTS `company_id` INT(11) NOT NULL DEFAULT 1 AFTER `reminder_id`;

-- Index for fast lookups per company
ALTER TABLE `service_reminders`
  ADD INDEX IF NOT EXISTS `idx_company_id` (`company_id`);

-- 3. Seed company_id from the customer's branch if possible (best-effort back-fill)
--    This sets company_id on existing reminders using the customer's branch.
UPDATE `service_reminders` sr
INNER JOIN `customers` c ON c.customer_id = sr.customer_id
INNER JOIN `branches`  b ON b.branch_id   = c.branch_id
SET sr.company_id = b.company_id
WHERE sr.company_id = 1;
