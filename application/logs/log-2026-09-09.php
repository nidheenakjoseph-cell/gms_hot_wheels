<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-09-09 10:33:03 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1401
ERROR - 2026-09-09 10:33:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

    ...' at line 34 - Invalid query: SELECT 
            gl.account_id,
            gl.account_name,
            ag.group_name,

            (
                IFNULL(
                    CASE 
                        WHEN gl.opening_bal_type = 'Dr' THEN gl.opening_balance
                        WHEN gl.opening_bal_type = 'Cr' THEN -gl.opening_balance
                        ELSE 0
                    END
                ,0)

                +

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0)

            ) AS balance

        FROM general_ledger gl

        LEFT JOIN account_group ag 
            ON ag.group_no = gl.group_no

        LEFT JOIN voucher_transaction vt 
            ON vt.account_id = gl.account_id
            AND vt.cancel = 0
            AND vt.branch_id IN ()

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

        GROUP BY gl.account_id
        ORDER BY ag.group_name, gl.account_name
ERROR - 2026-09-09 12:04:55 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1401
ERROR - 2026-09-09 12:04:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

    ...' at line 34 - Invalid query: SELECT 
            gl.account_id,
            gl.account_name,
            ag.group_name,

            (
                IFNULL(
                    CASE 
                        WHEN gl.opening_bal_type = 'Dr' THEN gl.opening_balance
                        WHEN gl.opening_bal_type = 'Cr' THEN -gl.opening_balance
                        ELSE 0
                    END
                ,0)

                +

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0)

            ) AS balance

        FROM general_ledger gl

        LEFT JOIN account_group ag 
            ON ag.group_no = gl.group_no

        LEFT JOIN voucher_transaction vt 
            ON vt.account_id = gl.account_id
            AND vt.cancel = 0
            AND vt.branch_id IN ()

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

        GROUP BY gl.account_id
        ORDER BY ag.group_name, gl.account_name
ERROR - 2026-09-09 12:04:59 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1401
ERROR - 2026-09-09 12:04:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

    ...' at line 34 - Invalid query: SELECT 
            gl.account_id,
            gl.account_name,
            ag.group_name,

            (
                IFNULL(
                    CASE 
                        WHEN gl.opening_bal_type = 'Dr' THEN gl.opening_balance
                        WHEN gl.opening_bal_type = 'Cr' THEN -gl.opening_balance
                        ELSE 0
                    END
                ,0)

                +

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0)

            ) AS balance

        FROM general_ledger gl

        LEFT JOIN account_group ag 
            ON ag.group_no = gl.group_no

        LEFT JOIN voucher_transaction vt 
            ON vt.account_id = gl.account_id
            AND vt.cancel = 0
            AND vt.branch_id IN ()

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

        GROUP BY gl.account_id
        ORDER BY ag.group_name, gl.account_name
ERROR - 2026-09-09 12:05:01 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1401
ERROR - 2026-09-09 12:05:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

    ...' at line 34 - Invalid query: SELECT 
            gl.account_id,
            gl.account_name,
            ag.group_name,

            (
                IFNULL(
                    CASE 
                        WHEN gl.opening_bal_type = 'Dr' THEN gl.opening_balance
                        WHEN gl.opening_bal_type = 'Cr' THEN -gl.opening_balance
                        ELSE 0
                    END
                ,0)

                +

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0)

            ) AS balance

        FROM general_ledger gl

        LEFT JOIN account_group ag 
            ON ag.group_no = gl.group_no

        LEFT JOIN voucher_transaction vt 
            ON vt.account_id = gl.account_id
            AND vt.cancel = 0
            AND vt.branch_id IN ()

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

        GROUP BY gl.account_id
        ORDER BY ag.group_name, gl.account_name
ERROR - 2026-09-09 12:05:02 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1401
ERROR - 2026-09-09 12:05:02 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

    ...' at line 34 - Invalid query: SELECT 
            gl.account_id,
            gl.account_name,
            ag.group_name,

            (
                IFNULL(
                    CASE 
                        WHEN gl.opening_bal_type = 'Dr' THEN gl.opening_balance
                        WHEN gl.opening_bal_type = 'Cr' THEN -gl.opening_balance
                        ELSE 0
                    END
                ,0)

                +

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0)

            ) AS balance

        FROM general_ledger gl

        LEFT JOIN account_group ag 
            ON ag.group_no = gl.group_no

        LEFT JOIN voucher_transaction vt 
            ON vt.account_id = gl.account_id
            AND vt.cancel = 0
            AND vt.branch_id IN ()

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

        GROUP BY gl.account_id
        ORDER BY ag.group_name, gl.account_name
ERROR - 2026-09-09 12:05:02 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1401
ERROR - 2026-09-09 12:05:02 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

    ...' at line 34 - Invalid query: SELECT 
            gl.account_id,
            gl.account_name,
            ag.group_name,

            (
                IFNULL(
                    CASE 
                        WHEN gl.opening_bal_type = 'Dr' THEN gl.opening_balance
                        WHEN gl.opening_bal_type = 'Cr' THEN -gl.opening_balance
                        ELSE 0
                    END
                ,0)

                +

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0)

            ) AS balance

        FROM general_ledger gl

        LEFT JOIN account_group ag 
            ON ag.group_no = gl.group_no

        LEFT JOIN voucher_transaction vt 
            ON vt.account_id = gl.account_id
            AND vt.cancel = 0
            AND vt.branch_id IN ()

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

        GROUP BY gl.account_id
        ORDER BY ag.group_name, gl.account_name
ERROR - 2026-09-09 12:05:04 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1401
ERROR - 2026-09-09 12:05:04 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

    ...' at line 34 - Invalid query: SELECT 
            gl.account_id,
            gl.account_name,
            ag.group_name,

            (
                IFNULL(
                    CASE 
                        WHEN gl.opening_bal_type = 'Dr' THEN gl.opening_balance
                        WHEN gl.opening_bal_type = 'Cr' THEN -gl.opening_balance
                        ELSE 0
                    END
                ,0)

                +

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0)

            ) AS balance

        FROM general_ledger gl

        LEFT JOIN account_group ag 
            ON ag.group_no = gl.group_no

        LEFT JOIN voucher_transaction vt 
            ON vt.account_id = gl.account_id
            AND vt.cancel = 0
            AND vt.branch_id IN ()

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

        GROUP BY gl.account_id
        ORDER BY ag.group_name, gl.account_name
ERROR - 2026-09-09 12:05:05 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1401
ERROR - 2026-09-09 12:05:05 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

    ...' at line 34 - Invalid query: SELECT 
            gl.account_id,
            gl.account_name,
            ag.group_name,

            (
                IFNULL(
                    CASE 
                        WHEN gl.opening_bal_type = 'Dr' THEN gl.opening_balance
                        WHEN gl.opening_bal_type = 'Cr' THEN -gl.opening_balance
                        ELSE 0
                    END
                ,0)

                +

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0)

            ) AS balance

        FROM general_ledger gl

        LEFT JOIN account_group ag 
            ON ag.group_no = gl.group_no

        LEFT JOIN voucher_transaction vt 
            ON vt.account_id = gl.account_id
            AND vt.cancel = 0
            AND vt.branch_id IN ()

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

        GROUP BY gl.account_id
        ORDER BY ag.group_name, gl.account_name
ERROR - 2026-09-09 12:05:10 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1401
ERROR - 2026-09-09 12:05:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

    ...' at line 34 - Invalid query: SELECT 
            gl.account_id,
            gl.account_name,
            ag.group_name,

            (
                IFNULL(
                    CASE 
                        WHEN gl.opening_bal_type = 'Dr' THEN gl.opening_balance
                        WHEN gl.opening_bal_type = 'Cr' THEN -gl.opening_balance
                        ELSE 0
                    END
                ,0)

                +

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0)

            ) AS balance

        FROM general_ledger gl

        LEFT JOIN account_group ag 
            ON ag.group_no = gl.group_no

        LEFT JOIN voucher_transaction vt 
            ON vt.account_id = gl.account_id
            AND vt.cancel = 0
            AND vt.branch_id IN ()

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

        GROUP BY gl.account_id
        ORDER BY ag.group_name, gl.account_name
ERROR - 2026-09-09 11:34:28 --> 404 Page Not Found: Jobcard/add
ERROR - 2026-09-09 11:42:01 --> 404 Page Not Found: Vehicle/add
ERROR - 2026-09-09 11:43:20 --> 404 Page Not Found: Jobcard/add
ERROR - 2026-09-09 11:45:06 --> 404 Page Not Found: Estimation/add
ERROR - 2026-09-09 11:46:35 --> 404 Page Not Found: Invoice/add
ERROR - 2026-09-09 15:22:08 --> 404 Page Not Found: Accounts/index
ERROR - 2026-09-09 15:31:13 --> 404 Page Not Found: Accounts/index
ERROR - 2026-09-09 17:19:13 --> Query error: Not unique table/alias: 'jc' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `job_cards` `jc`, `job_cards` `jc`
WHERE `jc`.`status` IN('Scheduled', 'In Progress', 'Finished', '', 'NULL')
AND `jc`.`branch_id` IN(1, 3, 2)
AND `jc`.`status` IN('In Progress')
AND `jc`.`branch_id` IN(1, 3, 2)
ERROR - 2026-09-09 17:19:37 --> Query error: Not unique table/alias: 'jc' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `job_cards` `jc`, `job_cards` `jc`
WHERE `jc`.`status` IN('Scheduled', 'In Progress', 'Finished', '', 'NULL')
AND `jc`.`branch_id` IN(1, 3, 2)
AND `jc`.`status` IN('In Progress')
AND `jc`.`branch_id` IN(1, 3, 2)
ERROR - 2026-09-09 17:27:43 --> Jobcard Descriptions: []
ERROR - 2026-09-09 17:28:00 --> Jobcard Descriptions: []
ERROR - 2026-09-09 17:28:13 --> Jobcard Descriptions: [{"jobcard_service_id":"977","jobcard_id":"445","service_id":"4","service_name":"Brake Pad Replacement (Rear)","service_type":"SERVICE","estimated_time":"1","estimated_cost":"320.00","total_cost":"350.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null},{"jobcard_service_id":"978","jobcard_id":"445","service_id":"3","service_name":"Brake Pad Replacement (Front)","service_type":"SERVICE","estimated_time":"1","estimated_cost":"350.00","total_cost":"350.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null}]
ERROR - 2026-09-09 17:28:15 --> Jobcard Descriptions: [{"jobcard_service_id":"977","jobcard_id":"445","service_id":"4","service_name":"Brake Pad Replacement (Rear)","service_type":"SERVICE","estimated_time":"1","estimated_cost":"320.00","total_cost":"350.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null},{"jobcard_service_id":"978","jobcard_id":"445","service_id":"3","service_name":"Brake Pad Replacement (Front)","service_type":"SERVICE","estimated_time":"1","estimated_cost":"350.00","total_cost":"350.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null}]
ERROR - 2026-09-09 17:28:23 --> Jobcard Descriptions: [{"jobcard_service_id":"977","jobcard_id":"445","service_id":"4","service_name":"Brake Pad Replacement (Rear)","service_type":"SERVICE","estimated_time":"1","estimated_cost":"320.00","total_cost":"350.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null},{"jobcard_service_id":"978","jobcard_id":"445","service_id":"3","service_name":"Brake Pad Replacement (Front)","service_type":"SERVICE","estimated_time":"1","estimated_cost":"350.00","total_cost":"350.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null}]
