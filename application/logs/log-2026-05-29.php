<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-05-29 07:56:40 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'GROUP BY v.vehicle_id
                ORDER BY v.registration_no' at line 15 - Invalid query: 
                SELECT
                    v.vehicle_id,
                    v.registration_no,
                    v.brand,
                    v.model,
                    v.year,
                    COUNT(DISTINCT i.invoice_id) AS invoice_count,
                    IFNULL(SUM(i.grand_total), 0) AS total_billed,
                    IFNULL(SUM(i.paid_amt), 0) AS total_paid_v,
                    IFNULL(SUM(i.grand_total), 0) - IFNULL(SUM(i.paid_amt), 0) AS outstanding
                FROM vehicles v
                LEFT JOIN job_cards jc ON jc.vehicle_id = v.vehicle_id
                LEFT JOIN invoices i ON i.jobcard_id = jc.jobcard_id
                WHERE v.customer_id = 
                GROUP BY v.vehicle_id
                ORDER BY v.registration_no
            
ERROR - 2026-05-29 07:56:53 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5433.160
        )

    [1] => stdClass Object
        (
            [account_id] => 2866
            [account_name] => NBD (Kishen Vijayan)
            [group_name] => Bank Accounts
            [balance] => 0.000
        )

    [2] => stdClass Object
        (
            [account_id] => 23
            [account_name] => Cash
            [group_name] => Cash-in-hand
            [balance] => 428.000
        )

)

ERROR - 2026-05-29 07:56:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'GROUP BY v.vehicle_id
                ORDER BY v.registration_no' at line 15 - Invalid query: 
                SELECT
                    v.vehicle_id,
                    v.registration_no,
                    v.brand,
                    v.model,
                    v.year,
                    COUNT(DISTINCT i.invoice_id) AS invoice_count,
                    IFNULL(SUM(i.grand_total), 0) AS total_billed,
                    IFNULL(SUM(i.paid_amt), 0) AS total_paid_v,
                    IFNULL(SUM(i.grand_total), 0) - IFNULL(SUM(i.paid_amt), 0) AS outstanding
                FROM vehicles v
                LEFT JOIN job_cards jc ON jc.vehicle_id = v.vehicle_id
                LEFT JOIN invoices i ON i.jobcard_id = jc.jobcard_id
                WHERE v.customer_id = 
                GROUP BY v.vehicle_id
                ORDER BY v.registration_no
            
ERROR - 2026-05-29 07:57:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'GROUP BY v.vehicle_id
                ORDER BY v.registration_no' at line 15 - Invalid query: 
                SELECT
                    v.vehicle_id,
                    v.registration_no,
                    v.brand,
                    v.model,
                    v.year,
                    COUNT(DISTINCT i.invoice_id) AS invoice_count,
                    IFNULL(SUM(i.grand_total), 0) AS total_billed,
                    IFNULL(SUM(i.paid_amt), 0) AS total_paid_v,
                    IFNULL(SUM(i.grand_total), 0) - IFNULL(SUM(i.paid_amt), 0) AS outstanding
                FROM vehicles v
                LEFT JOIN job_cards jc ON jc.vehicle_id = v.vehicle_id
                LEFT JOIN invoices i ON i.jobcard_id = jc.jobcard_id
                WHERE v.customer_id = 
                GROUP BY v.vehicle_id
                ORDER BY v.registration_no
            
ERROR - 2026-05-29 09:41:02 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5433.160
        )

    [1] => stdClass Object
        (
            [account_id] => 2866
            [account_name] => NBD (Kishen Vijayan)
            [group_name] => Bank Accounts
            [balance] => 0.000
        )

    [2] => stdClass Object
        (
            [account_id] => 23
            [account_name] => Cash
            [group_name] => Cash-in-hand
            [balance] => 428.000
        )

)

ERROR - 2026-05-29 11:56:05 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') AS txn_type, 0 AS `debit`, `vt`.`amount` AS `credit`, '' AS status, '' AS j...' at line 7 - Invalid query: SELECT `vt`.`voucher_id` AS `invoice_id`, `vt`.`voucher_code` AS `invoice_no`, DATE(vt.voucher_date) AS txn_date, CONCAT(
                CASE vt.voucher_type
                    WHEN 'J' THEN 'Receipt'
                    WHEN 'R' THEN 'Receipt'
                    WHEN 'P' THEN 'Payment'
                    ELSE IFNULL(vt.voucher_type, 'Payment')
                END, ) AS txn_type, 0 AS `debit`, `vt`.`amount` AS `credit`, '' AS status, '' AS jobcard_no, '' AS registration_no, '' AS brand, '' AS model, 0 AS `vehicle_id`
FROM `voucher_transaction` `vt`
WHERE `vt`.`account_id` = '2831'
AND `vt`.`drcr_type` = 'Dr'
AND `vt`.`trans_type` IN('J', 'R')
AND `vt`.`cancel` = 0
ERROR - 2026-05-29 12:35:21 --> Severity: Notice --> Undefined index: bucket_0_30_gross C:\Users\hk\Desktop\xampp\htdocs\gms_fleet\application\views\reports\fleet_soa.php 216
ERROR - 2026-05-29 12:35:21 --> Severity: Notice --> Undefined index: bucket_0_30_paid C:\Users\hk\Desktop\xampp\htdocs\gms_fleet\application\views\reports\fleet_soa.php 216
ERROR - 2026-05-29 12:35:21 --> Severity: Notice --> Undefined index: bucket_31_60_gross C:\Users\hk\Desktop\xampp\htdocs\gms_fleet\application\views\reports\fleet_soa.php 217
ERROR - 2026-05-29 12:35:21 --> Severity: Notice --> Undefined index: bucket_31_60_paid C:\Users\hk\Desktop\xampp\htdocs\gms_fleet\application\views\reports\fleet_soa.php 217
ERROR - 2026-05-29 12:35:21 --> Severity: Notice --> Undefined index: bucket_61_90_gross C:\Users\hk\Desktop\xampp\htdocs\gms_fleet\application\views\reports\fleet_soa.php 218
ERROR - 2026-05-29 12:35:21 --> Severity: Notice --> Undefined index: bucket_61_90_paid C:\Users\hk\Desktop\xampp\htdocs\gms_fleet\application\views\reports\fleet_soa.php 218
ERROR - 2026-05-29 12:35:21 --> Severity: Notice --> Undefined index: bucket_91_120_gross C:\Users\hk\Desktop\xampp\htdocs\gms_fleet\application\views\reports\fleet_soa.php 219
ERROR - 2026-05-29 12:35:21 --> Severity: Notice --> Undefined index: bucket_91_120_paid C:\Users\hk\Desktop\xampp\htdocs\gms_fleet\application\views\reports\fleet_soa.php 219
ERROR - 2026-05-29 12:35:21 --> Severity: Notice --> Undefined index: bucket_120plus_gross C:\Users\hk\Desktop\xampp\htdocs\gms_fleet\application\views\reports\fleet_soa.php 220
ERROR - 2026-05-29 12:35:21 --> Severity: Notice --> Undefined index: bucket_120plus_paid C:\Users\hk\Desktop\xampp\htdocs\gms_fleet\application\views\reports\fleet_soa.php 220
ERROR - 2026-05-29 15:31:06 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 4817.160
        )

    [1] => stdClass Object
        (
            [account_id] => 2866
            [account_name] => NBD (Kishen Vijayan)
            [group_name] => Bank Accounts
            [balance] => 0.000
        )

    [2] => stdClass Object
        (
            [account_id] => 23
            [account_name] => Cash
            [group_name] => Cash-in-hand
            [balance] => 428.000
        )

)

