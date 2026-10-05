-- Create branches table
CREATE TABLE IF NOT EXISTS `branches` (
  `branch_id` INT(11) NOT NULL AUTO_INCREMENT,
  `company_id` INT(11) DEFAULT 1,
  `branch_code` VARCHAR(20) NOT NULL UNIQUE,
  `branch_name` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(30) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `address` TEXT DEFAULT NULL,
  `trn_no` VARCHAR(100) DEFAULT NULL,
  `is_main_branch` TINYINT(1) DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1,
  `created_by` INT(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default main branch if not exists
INSERT INTO `branches` (`branch_id`, `company_id`, `branch_code`, `branch_name`, `is_main_branch`, `is_active`)
SELECT 1, 1, 'BR001', 'Main Branch', 1, 1
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `branches` WHERE `branch_id` = 1);

-- Function helper pattern for adding columns safely
DROP PROCEDURE IF EXISTS AddBranchIdColumn;

DELIMITER //
CREATE PROCEDURE AddBranchIdColumn(IN target_table VARCHAR(64))
BEGIN
  IF EXISTS (
    SELECT 1 FROM INFORMATION_SCHEMA.TABLES 
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = target_table
  ) THEN
    IF NOT EXISTS (
      SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS 
      WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = target_table AND COLUMN_NAME = 'branch_id'
    ) THEN
      SET @s = CONCAT('ALTER TABLE `', target_table, '` ADD COLUMN `branch_id` INT(11) DEFAULT 1');
      PREPARE stmt FROM @s;
      EXECUTE stmt;
      DEALLOCATE PREPARE stmt;
    END IF;
  END IF;
END //
DELIMITER ;

CALL AddBranchIdColumn('scrap_sales');
CALL AddBranchIdColumn('scrap_collections');
CALL AddBranchIdColumn('invoices');
CALL AddBranchIdColumn('job_cards');
CALL AddBranchIdColumn('jobcard');
CALL AddBranchIdColumn('customers');
CALL AddBranchIdColumn('voucher_transaction');
CALL AddBranchIdColumn('direct_invoices');
CALL AddBranchIdColumn('quotations');
CALL AddBranchIdColumn('direct_quotations');
CALL AddBranchIdColumn('estimations');
CALL AddBranchIdColumn('appointments');
CALL AddBranchIdColumn('inspections');
CALL AddBranchIdColumn('inventory_parts');
CALL AddBranchIdColumn('spare_parts');
CALL AddBranchIdColumn('purchase_orders');
CALL AddBranchIdColumn('purchases');
CALL AddBranchIdColumn('supplier_master');

DROP PROCEDURE IF EXISTS AddBranchIdColumn;


