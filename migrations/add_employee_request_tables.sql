-- Employee HR requests and their uploaded documents.
-- Safe to run against an existing database.

CREATE TABLE IF NOT EXISTS `employee_request_data` (
    `emp_req_id` INT(11) NOT NULL AUTO_INCREMENT,
    `emp_reqtype` VARCHAR(50) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `dept_id` INT(11) DEFAULT NULL,
    `allowance_type` INT(11) DEFAULT NULL,
    `app_date` DATE DEFAULT NULL,
    `form_date` DATE DEFAULT NULL,
    `to_date` DATE DEFAULT NULL,
    `last_ticket_date` DATE DEFAULT NULL,
    `rejoin_date` DATE DEFAULT NULL,
    `visa_expiry_date` DATE DEFAULT NULL,
    `amount` DECIMAL(15,2) DEFAULT NULL,
    `emi_amount` DECIMAL(15,2) DEFAULT NULL,
    `total_month` INT(11) DEFAULT NULL,
    `project_name` VARCHAR(255) DEFAULT NULL,
    `urgency` VARCHAR(50) DEFAULT NULL,
    `as_code` VARCHAR(100) DEFAULT NULL,
    `remark` TEXT DEFAULT NULL,
    `in_time` TIME DEFAULT NULL,
    `out_time` TIME DEFAULT NULL,
    `approved_flag` TINYINT(1) DEFAULT NULL,
    `approved_date` DATE DEFAULT NULL,
    `approved_form_date` DATE DEFAULT NULL,
    `approved_to_date` DATE DEFAULT NULL,
    `approved_amount` DECIMAL(15,2) DEFAULT NULL,
    `approve_emi` DECIMAL(15,2) DEFAULT NULL,
    `approve_total_month` INT(11) DEFAULT NULL,
    `approve_remark` TEXT DEFAULT NULL,
    `rec_in_time` TIME DEFAULT NULL,
    `rec_out_time` TIME DEFAULT NULL,
    `created_by` INT(11) DEFAULT NULL,
    `created_date` DATE DEFAULT NULL,
    PRIMARY KEY (`emp_req_id`),
    KEY `idx_employee_request_user` (`user_id`),
    KEY `idx_employee_request_type` (`emp_reqtype`),
    KEY `idx_employee_request_dates` (`approved_form_date`, `approved_to_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `employee_req_documents` (
    `document_id` INT(11) NOT NULL AUTO_INCREMENT,
    `emp_req_id` INT(11) NOT NULL,
    `document_name` VARCHAR(255) DEFAULT NULL,
    `document_path` VARCHAR(255) NOT NULL,
    `created_by` INT(11) DEFAULT NULL,
    `create_date` DATE DEFAULT NULL,
    PRIMARY KEY (`document_id`),
    KEY `idx_employee_req_documents_request` (`emp_req_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;