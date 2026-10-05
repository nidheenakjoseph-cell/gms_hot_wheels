-- ============================================================
-- GMS Service Reminder Notification Enhancement Migration
-- Created: 2026-09-18
-- ============================================================

-- 1. Add reminder_date_months and reminder_date_weeks to settings
ALTER TABLE `service_reminder_settings`
  ADD COLUMN IF NOT EXISTS `reminder_date_months` INT(11) NOT NULL DEFAULT 0 AFTER `reminder_period_months`,
  ADD COLUMN IF NOT EXISTS `reminder_date_weeks`  INT(11) NOT NULL DEFAULT 1 AFTER `reminder_date_months`;

-- 2. Add reminder_date column to service_reminders
ALTER TABLE `service_reminders`
  ADD COLUMN IF NOT EXISTS `reminder_date` DATE NULL AFTER `next_service_date`;

-- 3. Create service_reminder_logs table
CREATE TABLE IF NOT EXISTS `service_reminder_logs` (
  `log_id`      INT(11)       NOT NULL AUTO_INCREMENT,
  `reminder_id` INT(11)       NOT NULL,
  `channel`     ENUM('whatsapp','email') NOT NULL,
  `sent_to`     VARCHAR(150)  NOT NULL DEFAULT '',
  `sent_at`     DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status`      ENUM('success','failed') NOT NULL DEFAULT 'success',
  `note`        TEXT          NULL,
  PRIMARY KEY (`log_id`),
  KEY `idx_reminder_id` (`reminder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 4. Seed email template for service reminder notifications
INSERT IGNORE INTO `email_templates`
  (`template_key`, `company_id`, `template_name`, `subject`, `html_body`, `is_active`, `updated_at`)
VALUES
(
  'service_reminder',
  1,
  'Service Reminder Notification',
  'Service Reminder — {vehicle_no} is due on {next_service_date}',
  '<p>Dear {customer_name},</p>
<p>This is a friendly reminder that your vehicle is due for its next service.</p>
<table style="border-collapse:collapse;width:100%;max-width:500px;">
  <tr><td style="padding:6px 0;color:#555;">Vehicle No:</td><td style="padding:6px 0;font-weight:bold;">{vehicle_no}</td></tr>
  <tr><td style="padding:6px 0;color:#555;">Last Service Date:</td><td style="padding:6px 0;">{last_service_date}</td></tr>
  <tr><td style="padding:6px 0;color:#555;">Next Service Due:</td><td style="padding:6px 0;font-weight:bold;color:#dc2626;">{next_service_date}</td></tr>
</table>
<p>Please book your appointment at your earliest convenience.</p>
<p>Thank you for choosing <strong>{company_name}</strong>.</p>
<p style="color:#888;font-size:12px;">This is an automated reminder. Please do not reply directly.</p>',
  1,
  NOW()
);
