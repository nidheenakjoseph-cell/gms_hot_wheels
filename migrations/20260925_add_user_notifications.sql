-- User notification history and read state for the header notification menu.
CREATE TABLE IF NOT EXISTS `notification` (
  `msg_id` INT(11) NOT NULL AUTO_INCREMENT,
  `company_id` INT(11) NULL,
  `ref_id` INT(11) NULL,
  `user_id` INT(11) NOT NULL,
  `event_key` VARCHAR(80) NULL,
  `message` VARCHAR(500) NOT NULL,
  `details` TEXT NULL,
  `msg_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `redirect_url` VARCHAR(255) NULL,
  `read_flag` TINYINT(1) NOT NULL DEFAULT 0,
  `read_date` DATETIME NULL,
  `created_by` INT(11) NULL,
  PRIMARY KEY (`msg_id`),
  KEY `idx_notification_user_read_date` (`user_id`, `read_flag`, `msg_date`),
  KEY `idx_notification_company` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `notification`
  ADD COLUMN IF NOT EXISTS `company_id` INT(11) NULL AFTER `msg_id`,
  ADD COLUMN IF NOT EXISTS `event_key` VARCHAR(80) NULL AFTER `user_id`,
  ADD COLUMN IF NOT EXISTS `details` TEXT NULL AFTER `message`,
  ADD COLUMN IF NOT EXISTS `read_date` DATETIME NULL AFTER `read_flag`,
  ADD COLUMN IF NOT EXISTS `created_by` INT(11) NULL AFTER `read_date`;
