<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-09-20 18:46:04 --> Severity: Warning --> mysqli::query(): (HY000/1194): Table 'menus' is marked as crashed and should be repaired C:\xampp\htdocs\gms\system\database\drivers\mysqli\mysqli_driver.php 315
ERROR - 2026-09-20 18:46:04 --> Query error: Table 'menus' is marked as crashed and should be repaired - Invalid query: SELECT *
FROM `menus` `m`
WHERE `menu_url` = 'Reports/revenue'
ERROR - 2026-09-20 18:46:18 --> Severity: Warning --> mysqli::query(): (HY000/1194): Table 'menus' is marked as crashed and should be repaired C:\xampp\htdocs\gms\system\database\drivers\mysqli\mysqli_driver.php 315
ERROR - 2026-09-20 18:46:18 --> Query error: Table 'menus' is marked as crashed and should be repaired - Invalid query: SELECT *
FROM `menus` `m`
WHERE `menu_url` = 'Reports/revenue'
ERROR - 2026-09-20 18:52:46 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-20 18:52:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-20 18:52:48 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-20 18:52:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-20 18:52:49 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-20 18:52:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-20 18:52:49 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-20 18:52:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-20 18:52:50 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-20 18:52:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-20 18:52:50 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-20 18:52:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-20 18:52:51 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-20 18:52:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-20 18:58:00 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-20 18:58:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-20 18:58:01 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-20 18:58:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-20 18:58:22 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-20 18:58:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
