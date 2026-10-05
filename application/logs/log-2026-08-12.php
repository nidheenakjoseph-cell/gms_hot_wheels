<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-08-12 09:34:19 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 18491.650
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
            [balance] => 3565.500
        )

)

ERROR - 2026-08-12 09:43:53 --> Severity: Notice --> Undefined variable: from C:\xampp\htdocs\gms\application\models\Reports_model.php 27
ERROR - 2026-08-12 09:43:53 --> Severity: Notice --> Undefined variable: to C:\xampp\htdocs\gms\application\models\Reports_model.php 28
ERROR - 2026-08-12 09:43:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`NULL`
AND DATE(jc.jobcard_date) < `IS` `NULL`
AND `status` != 'Draft'
ORDER ...' at line 6 - Invalid query: SELECT `jc`.`jobcard_id`, `jc`.`status`, `jc`.`jobcard_date`, `c`.`customer_id`, `c`.`name` AS `customer_name`, `c`.`phone`, `v`.`registration_no`, `v`.`brand`, `v`.`model`
FROM `job_cards` `jc`
JOIN `customers` `c` ON `c`.`customer_id` = `jc`.`customer_id`
JOIN `vehicles` `v` ON `v`.`vehicle_id` = `jc`.`vehicle_id`
WHERE `jc`.`branch_id` IN(1, 2, 3)
AND DATE(jc.jobcard_date) > `IS` `NULL`
AND DATE(jc.jobcard_date) < `IS` `NULL`
AND `status` != 'Draft'
ORDER BY `jc`.`jobcard_date` DESC
ERROR - 2026-08-12 09:50:00 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 18491.650
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
            [balance] => 3565.500
        )

)

ERROR - 2026-08-12 09:50:02 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 18491.650
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
            [balance] => 3565.500
        )

)

ERROR - 2026-08-12 09:51:24 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 18491.650
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
            [balance] => 3565.500
        )

)

ERROR - 2026-08-12 09:58:44 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ss.branch_id IN (1,2,3) 

            ), 0) AS scrap_revenue,


    ...' at line 23 - Invalid query: 
        SELECT

            /* =========================================
             * JOB CARD REVENUE
             * ========================================= */
            IFNULL((
                SELECT SUM(i.grand_total)
                FROM invoices i
                WHERE i.invoice_type = 'TI'

                 AND i.branch_id IN (1,2,3) 

            ), 0) AS jobcard_revenue,


            /* =========================================
             * SCRAP REVENUE
             * ========================================= */
            IFNULL((
                SELECT SUM(ss.grand_total)
                FROM scrap_sales ss

                 AND ss.branch_id IN (1,2,3) 

            ), 0) AS scrap_revenue,


            /* =========================================
             * JOB CARD COLLECTED
             * ========================================= */
            IFNULL((
                SELECT SUM(

                    (
                        SELECT IFNULL(SUM(vt.amount), 0)

                        FROM voucher_transaction vt

                        JOIN job_cards jc
                            ON jc.jobcard_id = i.jobcard_id

                        JOIN general_ledger gl
                            ON gl.customer_id = jc.customer_id

                        WHERE
                            (
                                vt.invoice_code = i.invoice_no

                                OR

                                (
                                    vt.trans_id = i.quotation_id
                                    AND vt.trans_type = 'R'
                                )
                            )

                            AND vt.account_id = gl.account_id
                            AND vt.voucher_type = 'R'
                            AND vt.drcr_type = 'Cr'
                            AND vt.cancel = 0
                    )

                )

                FROM invoices i

                WHERE i.invoice_type = 'TI'

                 AND i.branch_id IN (1,2,3) 

            ), 0) AS jobcard_collected,


            /* =========================================
             * SCRAP COLLECTED
             * ========================================= */
            IFNULL((
                SELECT SUM(
                    ss.grand_total -
                    IFNULL(ss.balance, ss.grand_total)
                )

                FROM scrap_sales ss
                 AND ss.branch_id IN (1,2,3) 

            ), 0) AS scrap_collected
    
ERROR - 2026-08-12 10:01:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ss.branch_id IN (1,2,3) 

            ), 0) AS scrap_revenue,

      ...' at line 22 - Invalid query: 
        SELECT

            /* =========================================
             * JOB CARD REVENUE
             * ========================================= */
            IFNULL((
                SELECT SUM(i.grand_total)
                FROM invoices i
                WHERE i.invoice_type = 'TI'

                 AND i.branch_id IN (1,2,3) 

            ), 0) AS jobcard_revenue,


            /* =========================================
             * SCRAP REVENUE
             * ========================================= */
            IFNULL((
                SELECT SUM(ss.grand_total)
                FROM scrap_sales ss
                 AND ss.branch_id IN (1,2,3) 

            ), 0) AS scrap_revenue,

            IFNULL((
                SELECT SUM(

                    (
                        SELECT IFNULL(SUM(vt.amount), 0)

                        FROM voucher_transaction vt

                        JOIN job_cards jc
                            ON jc.jobcard_id = i.jobcard_id

                        JOIN general_ledger gl
                            ON gl.customer_id = jc.customer_id

                        WHERE
                            (
                                vt.invoice_code = i.invoice_no

                                OR

                                (
                                    vt.trans_id = i.quotation_id
                                    AND vt.trans_type = 'R'
                                )
                            )

                            AND vt.account_id = gl.account_id
                            AND vt.voucher_type = 'R'
                            AND vt.drcr_type = 'Cr'
                            AND vt.cancel = 0
                    )

                )

                FROM invoices i
                WHERE i.invoice_type = 'TI'
                 AND i.branch_id IN (1,2,3) 

            ), 0) AS jobcard_collected,

            IFNULL((
                SELECT SUM(
                    ss.grand_total -
                    IFNULL(ss.balance, ss.grand_total)
                )
                FROM scrap_sales ss
                 AND ss.branch_id IN (1,2,3) 
            ), 0) AS scrap_collected
    
ERROR - 2026-08-12 10:01:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ss.branch_id IN (1,2,3) 

            ), 0) AS scrap_revenue,

      ...' at line 22 - Invalid query: 
        SELECT

            /* =========================================
             * JOB CARD REVENUE
             * ========================================= */
            IFNULL((
                SELECT SUM(i.grand_total)
                FROM invoices i
                WHERE i.invoice_type = 'TI'

                 AND i.branch_id IN (1,2,3) 

            ), 0) AS jobcard_revenue,


            /* =========================================
             * SCRAP REVENUE
             * ========================================= */
            IFNULL((
                SELECT SUM(ss.grand_total)
                FROM scrap_sales ss
                 AND ss.branch_id IN (1,2,3) 

            ), 0) AS scrap_revenue,

            IFNULL((
                SELECT SUM(

                    (
                        SELECT IFNULL(SUM(vt.amount), 0)

                        FROM voucher_transaction vt

                        JOIN job_cards jc
                            ON jc.jobcard_id = i.jobcard_id

                        JOIN general_ledger gl
                            ON gl.customer_id = jc.customer_id

                        WHERE
                            (
                                vt.invoice_code = i.invoice_no

                                OR

                                (
                                    vt.trans_id = i.quotation_id
                                    AND vt.trans_type = 'R'
                                )
                            )

                            AND vt.account_id = gl.account_id
                            AND vt.voucher_type = 'R'
                            AND vt.drcr_type = 'Cr'
                            AND vt.cancel = 0
                    )

                )

                FROM invoices i
                WHERE i.invoice_type = 'TI'
                 AND i.branch_id IN (1,2,3) 

            ), 0) AS jobcard_collected,

            IFNULL((
                SELECT SUM(
                    ss.grand_total -
                    IFNULL(ss.balance, ss.grand_total)
                )
                FROM scrap_sales ss
                 AND ss.branch_id IN (1,2,3) 
            ), 0) AS scrap_collected
    
ERROR - 2026-08-12 10:01:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ss.branch_id IN (1,2,3) 

            ), 0) AS scrap_revenue,

      ...' at line 22 - Invalid query: 
        SELECT

            /* =========================================
             * JOB CARD REVENUE
             * ========================================= */
            IFNULL((
                SELECT SUM(i.grand_total)
                FROM invoices i
                WHERE i.invoice_type = 'TI'

                 AND i.branch_id IN (1,2,3) 

            ), 0) AS jobcard_revenue,


            /* =========================================
             * SCRAP REVENUE
             * ========================================= */
            IFNULL((
                SELECT SUM(ss.grand_total)
                FROM scrap_sales ss
                 AND ss.branch_id IN (1,2,3) 

            ), 0) AS scrap_revenue,

            IFNULL((
                SELECT SUM(

                    (
                        SELECT IFNULL(SUM(vt.amount), 0)

                        FROM voucher_transaction vt

                        JOIN job_cards jc
                            ON jc.jobcard_id = i.jobcard_id

                        JOIN general_ledger gl
                            ON gl.customer_id = jc.customer_id

                        WHERE
                            (
                                vt.invoice_code = i.invoice_no

                                OR

                                (
                                    vt.trans_id = i.quotation_id
                                    AND vt.trans_type = 'R'
                                )
                            )

                            AND vt.account_id = gl.account_id
                            AND vt.voucher_type = 'R'
                            AND vt.drcr_type = 'Cr'
                            AND vt.cancel = 0
                    )

                )

                FROM invoices i
                WHERE i.invoice_type = 'TI'
                 AND i.branch_id IN (1,2,3) 

            ), 0) AS jobcard_collected,

            IFNULL((
                SELECT SUM(
                    ss.grand_total -
                    IFNULL(ss.balance, ss.grand_total)
                )
                FROM scrap_sales ss
                 AND ss.branch_id IN (1,2,3) 
            ), 0) AS scrap_collected
    
ERROR - 2026-08-12 10:01:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ss.branch_id IN (1,2,3) 

            ), 0) AS scrap_revenue,

      ...' at line 22 - Invalid query: 
        SELECT

            /* =========================================
             * JOB CARD REVENUE
             * ========================================= */
            IFNULL((
                SELECT SUM(i.grand_total)
                FROM invoices i
                WHERE i.invoice_type = 'TI'

                 AND i.branch_id IN (1,2,3) 

            ), 0) AS jobcard_revenue,


            /* =========================================
             * SCRAP REVENUE
             * ========================================= */
            IFNULL((
                SELECT SUM(ss.grand_total)
                FROM scrap_sales ss
                 AND ss.branch_id IN (1,2,3) 

            ), 0) AS scrap_revenue,

            IFNULL((
                SELECT SUM(

                    (
                        SELECT IFNULL(SUM(vt.amount), 0)

                        FROM voucher_transaction vt

                        JOIN job_cards jc
                            ON jc.jobcard_id = i.jobcard_id

                        JOIN general_ledger gl
                            ON gl.customer_id = jc.customer_id

                        WHERE
                            (
                                vt.invoice_code = i.invoice_no

                                OR

                                (
                                    vt.trans_id = i.quotation_id
                                    AND vt.trans_type = 'R'
                                )
                            )

                            AND vt.account_id = gl.account_id
                            AND vt.voucher_type = 'R'
                            AND vt.drcr_type = 'Cr'
                            AND vt.cancel = 0
                    )

                )

                FROM invoices i
                WHERE i.invoice_type = 'TI'
                 AND i.branch_id IN (1,2,3) 

            ), 0) AS jobcard_collected,

            IFNULL((
                SELECT SUM(
                    ss.grand_total -
                    IFNULL(ss.balance, ss.grand_total)
                )
                FROM scrap_sales ss
                 AND ss.branch_id IN (1,2,3) 
            ), 0) AS scrap_collected
    
ERROR - 2026-08-12 10:03:43 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 18491.650
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
            [balance] => 3565.500
        )

)

ERROR - 2026-08-12 10:03:59 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 18491.650
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
            [balance] => 3565.500
        )

)

ERROR - 2026-08-12 10:04:53 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 18491.650
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
            [balance] => 3565.500
        )

)

ERROR - 2026-08-12 10:16:52 --> Severity: Notice --> Undefined property: Dashboard::$Accounts_model C:\xampp\htdocs\gms\application\controllers\Dashboard.php 52
ERROR - 2026-08-12 10:16:52 --> Severity: error --> Exception: Call to a member function get_revenue_summary() on null C:\xampp\htdocs\gms\application\controllers\Dashboard.php 52
ERROR - 2026-08-12 10:17:36 --> Severity: Notice --> Undefined variable: revenueSummary C:\xampp\htdocs\gms\application\views\dashboard.php 33
ERROR - 2026-08-12 10:17:36 --> Severity: Notice --> Trying to get property 'total_invoice_amount' of non-object C:\xampp\htdocs\gms\application\views\dashboard.php 33
ERROR - 2026-08-12 10:17:36 --> Severity: Notice --> Undefined variable: revenueSummary C:\xampp\htdocs\gms\application\views\dashboard.php 51
ERROR - 2026-08-12 10:17:36 --> Severity: Notice --> Trying to get property 'total_collected_amount' of non-object C:\xampp\htdocs\gms\application\views\dashboard.php 51
ERROR - 2026-08-12 10:17:36 --> Severity: Notice --> Undefined variable: revenueSummary C:\xampp\htdocs\gms\application\views\dashboard.php 58
ERROR - 2026-08-12 10:17:36 --> Severity: Notice --> Trying to get property 'pending_amount' of non-object C:\xampp\htdocs\gms\application\views\dashboard.php 58
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:31 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 636
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 640
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 641
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 645
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 646
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 650
ERROR - 2026-08-12 10:37:32 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 651
ERROR - 2026-08-12 10:37:58 --> 1
ERROR - 2026-08-12 10:37:58 --> 
ERROR - 2026-08-12 10:37:58 --> quote new
ERROR - 2026-08-12 10:38:04 --> ================ update_parts START ================
ERROR - 2026-08-12 10:38:04 --> Jobcard ID: 198
ERROR - 2026-08-12 10:38:04 --> PART IDS: Array
(
    [0] => 2
)

ERROR - 2026-08-12 10:38:04 --> PART TYPE: Array
(
    [0] => New Parts
)

ERROR - 2026-08-12 10:38:04 --> QTY: Array
(
    [0] => 1
)

ERROR - 2026-08-12 10:38:04 --> UNIT PRICE: Array
(
    [0] => 850.00
)

ERROR - 2026-08-12 10:38:04 --> SELL PRICE: Array
(
    [0] => 850.00
)

ERROR - 2026-08-12 10:38:04 --> TOTAL PRICE: Array
(
    [0] => 850.00
)

ERROR - 2026-08-12 10:38:04 --> DISCOUNT: Array
(
    [0] => 0.00
)

ERROR - 2026-08-12 10:38:04 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-08-12 10:38:04 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-08-12 10:38:04 --> PART ID: 2
ERROR - 2026-08-12 10:38:04 --> QTY: 1
ERROR - 2026-08-12 10:38:04 --> INSERTED PART: INSERT INTO `jobcard_parts` (`jobcard_id`, `part_id`, `qty`, `part_type`, `unit_price`, `selling_price`, `total_price`, `disamount`) VALUES ('198', '2', '1', 'New Parts', '850.00', '850.00', '850.00', '0.00')
ERROR - 2026-08-12 10:38:04 --> {"code":0,"message":""}
ERROR - 2026-08-12 10:38:04 --> CLEANED PART IDS: Array
(
    [0] => 2
)

ERROR - 2026-08-12 10:38:10 --> ================ update_parts START ================
ERROR - 2026-08-12 10:38:10 --> Jobcard ID: 198
ERROR - 2026-08-12 10:38:10 --> PART IDS: Array
(
    [0] => 2
)

ERROR - 2026-08-12 10:38:10 --> PART TYPE: Array
(
    [0] => New Parts
)

ERROR - 2026-08-12 10:38:10 --> QTY: Array
(
    [0] => 1
)

ERROR - 2026-08-12 10:38:10 --> UNIT PRICE: Array
(
    [0] => 850.00
)

ERROR - 2026-08-12 10:38:10 --> SELL PRICE: Array
(
    [0] => 850.00
)

ERROR - 2026-08-12 10:38:10 --> TOTAL PRICE: Array
(
    [0] => 850.00
)

ERROR - 2026-08-12 10:38:10 --> DISCOUNT: Array
(
    [0] => 0.00
)

ERROR - 2026-08-12 10:38:10 --> EXISTING PART IDS IN DB: Array
(
    [0] => 2
)

ERROR - 2026-08-12 10:38:10 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-08-12 10:38:10 --> PART ID: 2
ERROR - 2026-08-12 10:38:10 --> QTY: 1
ERROR - 2026-08-12 10:38:10 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '198', `part_id` = '2', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '850.00', `selling_price` = '850.00', `total_price` = '850.00', `disamount` = '0.00'
WHERE `jobcard_id` = '198'
AND `part_id` = '2'
ERROR - 2026-08-12 10:38:10 --> {"code":0,"message":""}
ERROR - 2026-08-12 10:38:10 --> CLEANED PART IDS: Array
(
    [0] => 2
)

ERROR - 2026-08-12 10:40:16 --> Severity: Notice --> Undefined variable: date C:\xampp\htdocs\gms\application\models\Reports_model.php 118
ERROR - 2026-08-12 16:59:16 --> FROM: 2026-08-01
ERROR - 2026-08-12 16:59:16 --> TO: 2026-08-12
ERROR - 2026-08-12 16:59:16 --> SUPPLIER: 
ERROR - 2026-08-12 16:59:16 --> PO Report Data: Array
(
    [0] => stdClass Object
        (
            [po_code] => POD/26/0099
            [po_date] => 2026-08-10
            [grand_total] => 1225.22
            [supplier_name] => ADCB BANK SUP0112
        )

    [1] => stdClass Object
        (
            [po_code] => POD/26/0100
            [po_date] => 2026-08-10
            [grand_total] => 2760.00
            [supplier_name] => ADCB BANK SUP0112
        )

    [2] => stdClass Object
        (
            [po_code] => POD/26/0101
            [po_date] => 2026-08-10
            [grand_total] => 760.00
            [supplier_name] => abcd efgh ijk SUP0032
        )

    [3] => stdClass Object
        (
            [po_code] => POD/26/0101
            [po_date] => 2026-08-10
            [grand_total] => 760.00
            [supplier_name] => abcd efgh ijk - Supplier Advance (SUP0032)
        )

    [4] => stdClass Object
        (
            [po_code] => POD/26/0094
            [po_date] => 2026-08-05
            [grand_total] => 90.00
            [supplier_name] => test main supplier SUP0038
        )

    [5] => stdClass Object
        (
            [po_code] => POD/26/0095
            [po_date] => 2026-08-05
            [grand_total] => 12.00
            [supplier_name] => test main supplier SUP0038
        )

    [6] => stdClass Object
        (
            [po_code] => POD/26/0096
            [po_date] => 2026-08-05
            [grand_total] => 16.00
            [supplier_name] => test main supplier SUP0038
        )

    [7] => stdClass Object
        (
            [po_code] => POD/26/0098
            [po_date] => 2026-08-06
            [grand_total] => 5854.61
            [supplier_name] => test main supplier SUP0038
        )

    [8] => stdClass Object
        (
            [po_code] => POD/26/0097
            [po_date] => 2026-08-06
            [grand_total] => 2075.00
            [supplier_name] => supl dubai SUP0039
        )

)

ERROR - 2026-08-12 17:04:04 --> FROM: 2026-08-01
ERROR - 2026-08-12 17:04:04 --> TO: 2026-08-12
ERROR - 2026-08-12 17:04:04 --> SUPPLIER: 
ERROR - 2026-08-12 17:04:04 --> PO Report Data: Array
(
    [0] => stdClass Object
        (
            [po_code] => POD/26/0099
            [po_date] => 2026-08-10
            [grand_total] => 1225.22
            [supplier_name] => ADCB BANK SUP0112
        )

    [1] => stdClass Object
        (
            [po_code] => POD/26/0100
            [po_date] => 2026-08-10
            [grand_total] => 2760.00
            [supplier_name] => ADCB BANK SUP0112
        )

    [2] => stdClass Object
        (
            [po_code] => POD/26/0101
            [po_date] => 2026-08-10
            [grand_total] => 760.00
            [supplier_name] => abcd efgh ijk SUP0032
        )

    [3] => stdClass Object
        (
            [po_code] => POD/26/0101
            [po_date] => 2026-08-10
            [grand_total] => 760.00
            [supplier_name] => abcd efgh ijk - Supplier Advance (SUP0032)
        )

    [4] => stdClass Object
        (
            [po_code] => POD/26/0094
            [po_date] => 2026-08-05
            [grand_total] => 90.00
            [supplier_name] => test main supplier SUP0038
        )

    [5] => stdClass Object
        (
            [po_code] => POD/26/0095
            [po_date] => 2026-08-05
            [grand_total] => 12.00
            [supplier_name] => test main supplier SUP0038
        )

    [6] => stdClass Object
        (
            [po_code] => POD/26/0096
            [po_date] => 2026-08-05
            [grand_total] => 16.00
            [supplier_name] => test main supplier SUP0038
        )

    [7] => stdClass Object
        (
            [po_code] => POD/26/0098
            [po_date] => 2026-08-06
            [grand_total] => 5854.61
            [supplier_name] => test main supplier SUP0038
        )

    [8] => stdClass Object
        (
            [po_code] => POD/26/0097
            [po_date] => 2026-08-06
            [grand_total] => 2075.00
            [supplier_name] => supl dubai SUP0039
        )

)

ERROR - 2026-08-12 20:36:22 --> Severity: Notice --> Undefined variable: to C:\xampp\htdocs\gms\application\views\reports\over_stay_report.php 22
ERROR - 2026-08-12 20:36:22 --> Severity: Notice --> Undefined variable: customers C:\xampp\htdocs\gms\application\views\reports\over_stay_report.php 28
ERROR - 2026-08-12 20:36:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\gms\application\views\reports\over_stay_report.php 28
ERROR - 2026-08-12 21:34:09 --> Severity: Notice --> Undefined variable: paid_days C:\xampp\htdocs\gms\application\controllers\Ajax.php 958
ERROR - 2026-08-12 21:34:09 --> Severity: Notice --> Undefined variable: use_paid_leave C:\xampp\htdocs\gms\application\controllers\Ajax.php 958
ERROR - 2026-08-12 23:04:11 --> /gms/index.php/Hr/add_leave_application_data
ERROR - 2026-08-12 23:04:11 --> Hr/add_leave_application_data
ERROR - 2026-08-12 21:43:21 --> Today Attendance Records: Array
(
    [0] => stdClass Object
        (
            [emp_aId] => 456401
            [employee_id] => 8
            [attendence] => P
            [in_time] => 11:13:00
            [out_time] => 23:13:00
            [Attendance_date] => 2026-08-12
            [remark] => 
            [created_by] => 6
            [created_date] => 2026-08-12 21:43:21
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => M
            [name] => Jamaica Viernes
            [created_by_user] => 
        )

    [1] => stdClass Object
        (
            [emp_aId] => 456402
            [employee_id] => 13
            [attendence] => P
            [in_time] => 11:13:00
            [out_time] => 23:13:00
            [Attendance_date] => 2026-08-12
            [remark] => 
            [created_by] => 6
            [created_date] => 2026-08-12 21:43:21
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => M
            [name] => Kishen Vijayan
            [created_by_user] => 
        )

    [2] => stdClass Object
        (
            [emp_aId] => 456403
            [employee_id] => 9
            [attendence] => P
            [in_time] => 11:13:00
            [out_time] => 23:13:00
            [Attendance_date] => 2026-08-12
            [remark] => 
            [created_by] => 6
            [created_date] => 2026-08-12 21:43:21
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => M
            [name] => Madiwadanan Sembaganathan
            [created_by_user] => 
        )

    [3] => stdClass Object
        (
            [emp_aId] => 456404
            [employee_id] => 14
            [attendence] => P
            [in_time] => 11:13:00
            [out_time] => 23:13:00
            [Attendance_date] => 2026-08-12
            [remark] => 
            [created_by] => 6
            [created_date] => 2026-08-12 21:43:21
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => M
            [name] => Mohammad Anowar Hossain
            [created_by_user] => 
        )

    [4] => stdClass Object
        (
            [emp_aId] => 456405
            [employee_id] => 15
            [attendence] => P
            [in_time] => 11:13:00
            [out_time] => 23:13:00
            [Attendance_date] => 2026-08-12
            [remark] => 
            [created_by] => 6
            [created_date] => 2026-08-12 21:43:21
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => M
            [name] => newemp11
            [created_by_user] => 
        )

    [5] => stdClass Object
        (
            [emp_aId] => 456406
            [employee_id] => 11
            [attendence] => P
            [in_time] => 11:13:00
            [out_time] => 23:13:00
            [Attendance_date] => 2026-08-12
            [remark] => 
            [created_by] => 6
            [created_date] => 2026-08-12 21:43:21
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => M
            [name] => Prasanga Rijman Perera Liyanage
            [created_by_user] => 
        )

    [6] => stdClass Object
        (
            [emp_aId] => 456407
            [employee_id] => 7
            [attendence] => P
            [in_time] => 11:13:00
            [out_time] => 23:13:00
            [Attendance_date] => 2026-08-12
            [remark] => 
            [created_by] => 6
            [created_date] => 2026-08-12 21:43:21
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => M
            [name] => Richard Zon Pineda
            [created_by_user] => 
        )

    [7] => stdClass Object
        (
            [emp_aId] => 456408
            [employee_id] => 10
            [attendence] => P
            [in_time] => 11:13:00
            [out_time] => 23:13:00
            [Attendance_date] => 2026-08-12
            [remark] => 
            [created_by] => 6
            [created_date] => 2026-08-12 21:43:21
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => M
            [name] => Ruchira Nadeesha Adikari Appuhamilage
            [created_by_user] => 
        )

    [8] => stdClass Object
        (
            [emp_aId] => 456409
            [employee_id] => 12
            [attendence] => P
            [in_time] => 11:13:00
            [out_time] => 23:13:00
            [Attendance_date] => 2026-08-12
            [remark] => 
            [created_by] => 6
            [created_date] => 2026-08-12 21:43:21
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => M
            [name] => Test employee
            [created_by_user] => 
        )

    [9] => stdClass Object
        (
            [emp_aId] => 456410
            [employee_id] => 17
            [attendence] => P
            [in_time] => 11:13:00
            [out_time] => 23:13:00
            [Attendance_date] => 2026-08-12
            [remark] => 
            [created_by] => 6
            [created_date] => 2026-08-12 21:43:21
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => M
            [name] => test employee 101
            [created_by_user] => 
        )

)

ERROR - 2026-08-12 21:43:21 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [employee_code] => 
            [employee_name] => Jamaica Viernes
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:29:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 17:20:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:40:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 14:47:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 15
            [employee_code] => 
            [employee_name] => newemp11
            [mobile] => 
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-05-04 22:56:29
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [5] => stdClass Object
        (
            [employee_id] => 11
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:55:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [6] => stdClass Object
        (
            [employee_id] => 7
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 12:25:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [7] => stdClass Object
        (
            [employee_id] => 10
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:49:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [8] => stdClass Object
        (
            [employee_id] => 12
            [employee_code] => 
            [employee_name] => Test employee
            [mobile] => 56546
            [email] => test@gmail.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 5
            [role] => Technician
            [software_access] => No
            [joining_date] => 2026-03-01
            [status] => Active
            [created_at] => 2026-03-17 14:32:29
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [9] => stdClass Object
        (
            [employee_id] => 17
            [employee_code] => 
            [employee_name] => test employee 101
            [mobile] => 98765544
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-05-05 13:21:13
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

)

ERROR - 2026-08-12 21:47:09 --> Severity: Notice --> Undefined variable: to C:\xampp\htdocs\gms\application\views\reports\over_stay_report.php 22
ERROR - 2026-08-12 21:47:09 --> Severity: Notice --> Undefined variable: customers C:\xampp\htdocs\gms\application\views\reports\over_stay_report.php 28
ERROR - 2026-08-12 21:47:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\gms\application\views\reports\over_stay_report.php 28
