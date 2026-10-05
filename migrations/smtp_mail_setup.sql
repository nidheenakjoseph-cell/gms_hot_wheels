-- ============================================================
-- GMS SMTP Mail Integration Migration
-- Created: 2026-09-14
-- Updated: 2026-09-15  (added inspection_report; removed {company_phone} placeholder)
-- ============================================================

-- 1. Create per-company SMTP credentials table
CREATE TABLE IF NOT EXISTS `company_smtp_settings` (
  `id`               INT(11)       NOT NULL AUTO_INCREMENT,
  `company_id`       INT(11)       NOT NULL DEFAULT 1,
  `smtp_host`        VARCHAR(150)  NOT NULL DEFAULT '',
  `smtp_port`        INT(5)        NOT NULL DEFAULT 587,
  `smtp_encryption`  ENUM('tls','ssl','none') NOT NULL DEFAULT 'tls',
  `smtp_username`    VARCHAR(150)  NOT NULL DEFAULT '',
  `smtp_password`    VARCHAR(255)  NOT NULL DEFAULT '',
  `smtp_from_email`  VARCHAR(100)  NOT NULL DEFAULT '',
  `smtp_from_name`   VARCHAR(100)  NOT NULL DEFAULT '',
  `is_active`        TINYINT(1)   NOT NULL DEFAULT 1,
  `updated_at`       DATETIME     DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_company_smtp` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2. Add company_id column to existing email_templates (if not already present)
ALTER TABLE `email_templates`
  ADD COLUMN IF NOT EXISTS `company_id` INT(11) NOT NULL DEFAULT 1 AFTER `id`,
  ADD COLUMN IF NOT EXISTS `is_active`  TINYINT(1) NOT NULL DEFAULT 1 AFTER `updated_at`;

-- 3. Seed default email templates
--    INSERT IGNORE is safe to re-run; existing rows are skipped.
INSERT IGNORE INTO `email_templates` (`template_key`, `company_id`, `template_name`, `subject`, `html_body`, `is_active`, `updated_at`) VALUES

-- 3a. Estimation
('estimation_sent', 1, 'Estimation Sent to Customer',
 'Estimation #{estimation_no} from {company_name}',
 '<p>Dear {customer_name},</p><p>Please find attached your <strong>Estimation #{estimation_no}</strong> dated <strong>{date}</strong>.</p><p>Vehicle No: <strong>{vehicle_no}</strong><br>Estimated Amount: <strong>{amount}</strong></p><p>Thank you for choosing <strong>{company_name}</strong>.</p>',
 1, NOW()),

-- 3b. Invoice
('invoice_sent', 1, 'Invoice Sent to Customer',
 'Invoice #{invoice_no} from {company_name}',
 '<p>Dear {customer_name},</p>
<p>Please find attached your <strong>Invoice #{invoice_no}</strong> dated <strong>{date}</strong>.</p>
<table style="border-collapse:collapse;width:100%;max-width:500px;">
  <tr><td style="padding:6px 0;color:#555;">Vehicle No:</td><td style="padding:6px 0;font-weight:bold;">{vehicle_no}</td></tr>
  <tr><td style="padding:6px 0;color:#555;">Invoice Amount:</td><td style="padding:6px 0;font-weight:bold;color:#1d4ed8;">{invoice_amount}</td></tr>
</table>
<p>Thank you for choosing <strong>{company_name}</strong>.</p>
<p style="color:#888;font-size:12px;">This is an automated email. Please do not reply directly.</p>',
 1, NOW()),

-- 3c. Quotation
('quotation_sent', 1, 'Quotation Sent to Customer',
 'Quotation #{quotation_no} from {company_name}',
 '<p>Dear {customer_name},</p>
<p>Please find attached your <strong>Quotation #{quotation_no}</strong> dated <strong>{date}</strong>.</p>
<table style="border-collapse:collapse;width:100%;max-width:500px;">
  <tr><td style="padding:6px 0;color:#555;">Vehicle No:</td><td style="padding:6px 0;font-weight:bold;">{vehicle_no}</td></tr>
  <tr><td style="padding:6px 0;color:#555;">Quotation Amount:</td><td style="padding:6px 0;font-weight:bold;color:#1d4ed8;">{quotation_amount}</td></tr>
</table>
<p>This quotation is valid for 7 days. Please contact us to confirm.</p>
<p>Thank you for choosing <strong>{company_name}</strong>.</p>',
 1, NOW()),

-- 3d. Job Card
('jobcard_created', 1, 'Job Card Created',
 'Job Card #{jobcard_no} — Vehicle Received',
 '<p>Dear {customer_name},</p>
<p>We have received your vehicle and created a job card.</p>
<table style="border-collapse:collapse;width:100%;max-width:500px;">
  <tr><td style="padding:6px 0;color:#555;">Job Card No:</td><td style="padding:6px 0;font-weight:bold;">#{jobcard_no}</td></tr>
  <tr><td style="padding:6px 0;color:#555;">Vehicle No:</td><td style="padding:6px 0;font-weight:bold;">{vehicle_no}</td></tr>
  <tr><td style="padding:6px 0;color:#555;">Date:</td><td style="padding:6px 0;">{date}</td></tr>
</table>
<p>We will keep you updated on the progress. Thank you for trusting <strong>{company_name}</strong>.</p>',
 1, NOW()),

-- 3e. Vehicle Ready (notification template — no PDF attachment needed)
('vehicle_ready', 1, 'Vehicle Ready for Pickup',
 'Your vehicle {vehicle_no} is ready for pickup',
 '<p>Dear {customer_name},</p>
<p>Great news! Your vehicle <strong>{vehicle_no}</strong> is ready for pickup.</p>
<table style="border-collapse:collapse;width:100%;max-width:500px;">
  <tr><td style="padding:6px 0;color:#555;">Job Card No:</td><td style="padding:6px 0;font-weight:bold;">#{jobcard_no}</td></tr>
  <tr><td style="padding:6px 0;color:#555;">Amount Due:</td><td style="padding:6px 0;font-weight:bold;color:#1d4ed8;">{amount}</td></tr>
</table>
<p>Please visit us during business hours. Thank you for your patience!</p>
<p><strong>{company_name}</strong></p>',
 1, NOW()),

-- 3f. Insurance Renewal Reminder
('insurance_renewal', 1, 'Insurance Renewal Reminder',
 'Insurance Renewal Reminder — {vehicle_no}',
 '<p>Dear {customer_name},</p>
<p>This is a friendly reminder that the insurance for your vehicle <strong>{vehicle_no}</strong> is due for renewal.</p>
<table style="border-collapse:collapse;width:100%;max-width:500px;">
  <tr><td style="padding:6px 0;color:#555;">Policy No:</td><td style="padding:6px 0;font-weight:bold;">{policy_no}</td></tr>
  <tr><td style="padding:6px 0;color:#555;">Expiry Date:</td><td style="padding:6px 0;font-weight:bold;color:#dc2626;">{expiry_date}</td></tr>
</table>
<p>Please contact us or your insurance provider to renew before the expiry date.</p>
<p><strong>{company_name}</strong></p>',
 1, NOW()),

-- 3g. Inspection Report
('inspection_report', 1, 'Inspection Report',
 'Vehicle Inspection Report — {vehicle_no}',
 '<p>Dear {customer_name},</p>
<p>Please find attached the <strong>Vehicle Health Check / Inspection Report</strong> for your vehicle.</p>
<table style="border-collapse:collapse;width:100%;max-width:500px;">
  <tr><td style="padding:6px 0;color:#555;">Inspection No:</td><td style="padding:6px 0;font-weight:bold;">{inspection_no}</td></tr>
  <tr><td style="padding:6px 0;color:#555;">Vehicle No:</td><td style="padding:6px 0;font-weight:bold;">{vehicle_no}</td></tr>
  <tr><td style="padding:6px 0;color:#555;">Date:</td><td style="padding:6px 0;">{inspection_date}</td></tr>
</table>
<p>If you have any questions about the report, please do not hesitate to contact us.</p>
<p>Thank you for choosing <strong>{company_name}</strong>.</p>
<p style="color:#888;font-size:12px;">This is an automated email. Please do not reply directly.</p>',
 1, NOW()),

-- 3h. Insurance Claim
('insurance_claim_sent', 1, 'Insurance Claim Report',
 'Insurance Claim #{claim_no} from {company_name}',
 '<p>Dear {customer_name},</p><p>Please find attached the insurance claim report for claim <strong>#{claim_no}</strong>, dated <strong>{date}</strong>.</p><table style="border-collapse:collapse;width:100%;max-width:500px;"><tr><td style="padding:6px 0;color:#555;">Policy No:</td><td style="padding:6px 0;font-weight:bold;">{policy_no}</td></tr><tr><td style="padding:6px 0;color:#555;">Claim Amount:</td><td style="padding:6px 0;font-weight:bold;color:#1d4ed8;">{claim_amount}</td></tr><tr><td style="padding:6px 0;color:#555;">Approved Amount:</td><td style="padding:6px 0;font-weight:bold;color:#1d4ed8;">{approved_amount}</td></tr></table><p>Thank you, <strong>{company_name}</strong>.</p>',
 1, NOW());

-- Keep already-installed templates aligned with their document section amounts.
UPDATE `email_templates`
SET `html_body` = REPLACE(REPLACE(`html_body`, 'Estimated Amount:</strong>', 'Quotation Amount:</strong>'), '{amount}', '{quotation_amount}')
WHERE `template_key` = 'quotation_sent';

UPDATE `email_templates`
SET `html_body` = REPLACE(REPLACE(`html_body`, 'Total Amount:</td>', 'Invoice Amount:</td>'), '{amount}', '{invoice_amount}')
WHERE `template_key` = 'invoice_sent';

-- 4. Add Email Settings menu entry (same parent as Company Master)
INSERT IGNORE INTO `menus` (`menu_name`, `menu_url`, `parent_id`, `sort_order`, `is_active`)
SELECT 'Email Settings', 'Admin/email_settings', parent_id, 999, 1
FROM menus WHERE menu_url = 'Admin/company_details' LIMIT 1;

-- 5. Grant access to the new menu for all users who already have Company Master access
INSERT IGNORE INTO `user_menu_access` (user_id, menu_id, can_view)
SELECT uma.user_id, m_new.menu_id, 1
FROM user_menu_access uma
JOIN menus m_new ON m_new.menu_url = 'Admin/email_settings'
WHERE uma.menu_id = (SELECT menu_id FROM menus WHERE menu_url = 'Admin/company_details' LIMIT 1);
