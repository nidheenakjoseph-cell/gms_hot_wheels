ALTER TABLE `company_master`
  ADD COLUMN `demo_enabled` TINYINT(1) NOT NULL DEFAULT 0 AFTER `timestamp`,
  ADD COLUMN `demo_start_date` DATE NULL AFTER `demo_enabled`,
  ADD COLUMN `demo_expiry_date` DATE NULL AFTER `demo_start_date`,
  ADD COLUMN `demo_duration_days` INT NOT NULL DEFAULT 0 AFTER `demo_expiry_date`;
