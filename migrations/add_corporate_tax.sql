-- =============================================================
-- Migration: Corporate Tax Module
-- Tables: corporate_tax_calculations, corporate_tax_adjustments
-- Menu: Financial Years + Corporate Tax entries under Accounts (menu_id=60)
--       and Accounts Reports (menu_id=76)
-- =============================================================

-- ---------------------------------------------------------------
-- 1. corporate_tax_calculations
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `corporate_tax_calculations` (
  `id`                           INT(11)        NOT NULL AUTO_INCREMENT,
  `company_id`                   INT(11)        NOT NULL DEFAULT 1,
  `financial_year_id`            INT(11)        NOT NULL,
  `accounting_profit`            DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `total_additions`              DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `total_deductions`             DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `taxable_income_before_losses` DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `tax_loss_brought_forward`     DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `tax_loss_utilised`            DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `final_taxable_income`         DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `tax_at_zero_rate`             DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `tax_at_standard_rate`         DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `corporate_tax_payable`        DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `status`                       ENUM('DRAFT','CALCULATED','FINALIZED','FILED') NOT NULL DEFAULT 'DRAFT',
  `calculated_at`                DATETIME       DEFAULT NULL,
  `finalized_at`                 DATETIME       DEFAULT NULL,
  `finalized_by`                 INT(11)        DEFAULT NULL,
  `created_by`                   INT(11)        DEFAULT NULL,
  `created_at`                   DATETIME       DEFAULT CURRENT_TIMESTAMP,
  `updated_at`                   DATETIME       DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_company_year` (`company_id`, `financial_year_id`),
  KEY `idx_financial_year_id` (`financial_year_id`),
  KEY `idx_company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---------------------------------------------------------------
-- 2. corporate_tax_adjustments
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `corporate_tax_adjustments` (
  `id`                           INT(11)        NOT NULL AUTO_INCREMENT,
  `company_id`                   INT(11)        NOT NULL DEFAULT 1,
  `financial_year_id`            INT(11)        NOT NULL,
  `corporate_tax_calculation_id` INT(11)        DEFAULT NULL,
  `adjustment_type`              VARCHAR(255)   NOT NULL,
  `description`                  TEXT           DEFAULT NULL,
  `accounting_amount`            DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `tax_adjustment`               DECIMAL(15,2)  NOT NULL DEFAULT 0.00,
  `adjustment_direction`         ENUM('ADD','DEDUCT') NOT NULL DEFAULT 'ADD',
  `source_account_id`            INT(11)        DEFAULT NULL,
  `created_by`                   INT(11)        DEFAULT NULL,
  `created_at`                   DATETIME       DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_financial_year_id` (`financial_year_id`),
  KEY `idx_company_id` (`company_id`),
  KEY `idx_calculation_id` (`corporate_tax_calculation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---------------------------------------------------------------
-- 3. Menu entries
--    menu_id 115 = Financial Years  (under Accounts, parent=60)
--    menu_id 116 = Corporate Tax    (under Accounts, parent=60)
--    menu_id 117 = Corporate Tax Report (under Accounts Reports, parent=76)
-- ---------------------------------------------------------------
INSERT INTO `menus` (`menu_id`, `menu_name`, `menu_url`, `parent_id`, `sort_order`, `is_active`)
SELECT 115, 'Financial Years', 'Accounts/financial_years', 60, 11, 1
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `menus` WHERE `menu_id` = 115);

INSERT INTO `menus` (`menu_id`, `menu_name`, `menu_url`, `parent_id`, `sort_order`, `is_active`)
SELECT 116, 'Corporate Tax', 'Accounts/corporate_tax', 60, 12, 1
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `menus` WHERE `menu_id` = 116);

INSERT INTO `menus` (`menu_id`, `menu_name`, `menu_url`, `parent_id`, `sort_order`, `is_active`)
SELECT 117, 'Corporate Tax Report', 'Accounts/corporate_tax', 76, 7, 1
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `menus` WHERE `menu_id` = 117);

-- ---------------------------------------------------------------
-- 4. Grant menu access to ALL existing users (admin-level access).
--    Re-run is safe — INSERT IGNORE skips duplicates.
-- ---------------------------------------------------------------
INSERT IGNORE INTO `user_menu_access` (`user_id`, `menu_id`)
SELECT u.user_id, m.menu_id
FROM `users` u
CROSS JOIN `menus` m
WHERE m.menu_id IN (115, 116, 117);
