-- =============================================================
-- Migration: UAE Financial Year-End Closing
-- Adds columns needed by the Year-End Closing (YEC) process.
-- Safe to re-run: all changes use IF NOT EXISTS / IF EXISTS guards.
-- =============================================================

-- ---------------------------------------------------------------
-- 1. financial_years: store the closing JV reference so it can be
--    voided if the year is reopened.
-- ---------------------------------------------------------------
DROP PROCEDURE IF EXISTS AddYECColumnsFY;

DELIMITER //
CREATE PROCEDURE AddYECColumnsFY()
BEGIN
    -- closing_jv_code: the voucher_code of the Year-End Closing JV
    IF NOT EXISTS (
        SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME   = 'financial_years'
          AND COLUMN_NAME  = 'closing_jv_code'
    ) THEN
        ALTER TABLE `financial_years`
            ADD COLUMN `closing_jv_code` VARCHAR(30) DEFAULT NULL
            COMMENT 'Voucher code of the Year-End Closing JV (YEC/...)';
    END IF;

    -- net_profit_loss: snapshot of the net P&L transferred at closing
    IF NOT EXISTS (
        SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME   = 'financial_years'
          AND COLUMN_NAME  = 'net_profit_loss'
    ) THEN
        ALTER TABLE `financial_years`
            ADD COLUMN `net_profit_loss` DECIMAL(15,2) DEFAULT NULL
            COMMENT 'Net Profit (positive) or Loss (negative) at year close';
    END IF;

    -- retained_earnings_account_id: which ledger was the P&L transferred to
    IF NOT EXISTS (
        SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME   = 'financial_years'
          AND COLUMN_NAME  = 'retained_earnings_account_id'
    ) THEN
        ALTER TABLE `financial_years`
            ADD COLUMN `retained_earnings_account_id` INT(11) DEFAULT NULL
            COMMENT 'GL account that received the net P&L transfer';
    END IF;
END //
DELIMITER ;

CALL AddYECColumnsFY();
DROP PROCEDURE IF EXISTS AddYECColumnsFY;


-- ---------------------------------------------------------------
-- 2. voucher_transaction: mark Year-End Closing JV lines so they
--    cannot be modified/deleted, and so the closed-year bypass
--    can be applied only to them.
-- ---------------------------------------------------------------
DROP PROCEDURE IF EXISTS AddYECColumnsVT;

DELIMITER //
CREATE PROCEDURE AddYECColumnsVT()
BEGIN
    -- financial_year_id: auto-populated by insert_voucher_transaction() helper
    IF NOT EXISTS (
        SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME   = 'voucher_transaction'
          AND COLUMN_NAME  = 'financial_year_id'
    ) THEN
        ALTER TABLE `voucher_transaction`
            ADD COLUMN `financial_year_id` INT(11) DEFAULT NULL
            COMMENT 'FK to financial_years.id — set automatically by the helper';
    END IF;

    -- is_year_end_jv: protects the closing JV from edit/delete
    IF NOT EXISTS (
        SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME   = 'voucher_transaction'
          AND COLUMN_NAME  = 'is_year_end_jv'
    ) THEN
        ALTER TABLE `voucher_transaction`
            ADD COLUMN `is_year_end_jv` TINYINT(1) NOT NULL DEFAULT 0
            COMMENT '1 = Year-End Closing JV line; protected from modification';
    END IF;
END //
DELIMITER ;

CALL AddYECColumnsVT();
DROP PROCEDURE IF EXISTS AddYECColumnsVT;


-- ---------------------------------------------------------------
-- 3. financial_year_closing_log: complete audit trail of every
--    close and reopen action, including which JV was created/voided.
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `financial_year_closing_log` (
    `id`                  INT(11)      NOT NULL AUTO_INCREMENT,
    `financial_year_id`   INT(11)      NOT NULL,
    `company_id`          INT(11)      NOT NULL DEFAULT 1,
    `action`              ENUM('CLOSED','REOPENED') NOT NULL,
    `closing_jv_code`     VARCHAR(30)  DEFAULT NULL COMMENT 'JV created (CLOSED) or voided (REOPENED)',
    `net_profit_loss`     DECIMAL(15,2) DEFAULT NULL,
    `retained_earnings_account_id` INT(11) DEFAULT NULL,
    `performed_by`        INT(11)      NOT NULL,
    `reason`              TEXT         DEFAULT NULL,
    `performed_at`        DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_fy_id`       (`financial_year_id`),
    KEY `idx_company_id`  (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
  COMMENT='Audit trail for Year-End Closing and Reopen actions';


-- ---------------------------------------------------------------
-- 4. financial_years table: create it if it does not yet exist
--    (covers fresh installs that have not run the corporate tax
--    migration which originally created it with fewer columns).
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `financial_years` (
    `id`                            INT(11)      NOT NULL AUTO_INCREMENT,
    `company_id`                    INT(11)      NOT NULL DEFAULT 1,
    `year_name`                     VARCHAR(100) NOT NULL,
    `start_date`                    DATE         NOT NULL,
    `end_date`                      DATE         NOT NULL,
    `status`                        ENUM('OPEN','CLOSED','EXTENDED') NOT NULL DEFAULT 'OPEN',
    `closed_at`                     DATETIME     DEFAULT NULL,
    `closed_by`                     INT(11)      DEFAULT NULL,
    `close_reason`                  TEXT         DEFAULT NULL,
    `extended_from`                 DATE         DEFAULT NULL,
    `extended_to`                   DATE         DEFAULT NULL,
    `closing_jv_code`               VARCHAR(30)  DEFAULT NULL,
    `net_profit_loss`               DECIMAL(15,2) DEFAULT NULL,
    `retained_earnings_account_id`  INT(11)      DEFAULT NULL,
    `created_at`                    DATETIME     DEFAULT CURRENT_TIMESTAMP,
    `updated_at`                    DATETIME     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_company_dates` (`company_id`, `start_date`, `end_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- ---------------------------------------------------------------
-- 5. financial_year_extensions: create if missing (used by the
--    existing reopen / extension workflow).
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `financial_year_extensions` (
    `id`                  INT(11)      NOT NULL AUTO_INCREMENT,
    `financial_year_id`   INT(11)      NOT NULL,
    `company_id`          INT(11)      NOT NULL DEFAULT 1,
    `original_end_date`   DATE         NOT NULL,
    `extended_to`         DATE         NOT NULL,
    `reason`              TEXT         DEFAULT NULL,
    `requested_by`        INT(11)      DEFAULT NULL,
    `approved_by`         INT(11)      DEFAULT NULL,
    `approved_at`         DATETIME     DEFAULT NULL,
    `status`              ENUM('REQUESTED','APPROVED','REJECTED') NOT NULL DEFAULT 'REQUESTED',
    `created_at`          DATETIME     DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_fy_id` (`financial_year_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
