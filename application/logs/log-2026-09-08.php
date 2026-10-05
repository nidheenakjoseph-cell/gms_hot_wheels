<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-09-08 12:30:07 --> Query error: Unknown column 'vt.id' in 'field list' - Invalid query: 

        SELECT
            month_key,
            SUM(collection) AS collection

        FROM
        (
            SELECT

                DATE_FORMAT(vt_date.payment_date, '%Y-%m')
                    AS month_key,

                SUM(vt_date.amount) AS collection

            FROM
            (

                SELECT DISTINCT

                    vt.id,

                    vt.amount,

                    vt.voucher_date AS payment_date

                FROM voucher_transaction vt

                INNER JOIN invoices i
                    ON (
                        vt.invoice_code = i.invoice_no
                        OR
                        (
                            vt.trans_id = i.quotation_id
                            AND vt.trans_type = 'R'
                        )
                    )

                INNER JOIN job_cards jc
                    ON jc.jobcard_id = i.jobcard_id

                INNER JOIN general_ledger gl
                    ON gl.customer_id = jc.customer_id

                WHERE vt.voucher_type = 'R'
                  AND vt.drcr_type = 'Cr'
                  AND vt.cancel = 0

                  AND vt.account_id = gl.account_id

                  AND vt.voucher_date >= '2025-10-01'
                  AND vt.voucher_date <= '2026-09-08'

            ) vt_date

            GROUP BY
                DATE_FORMAT(vt_date.payment_date, '%Y-%m')


            UNION ALL

            SELECT

                DATE_FORMAT(ss.sale_date, '%Y-%m')
                    AS month_key,

                SUM(
                    ss.grand_total -
                    IFNULL(ss.balance, ss.grand_total)
                ) AS collection

            FROM scrap_sales ss

            WHERE ss.sale_date >= '2025-10-01'
              AND ss.sale_date <= '2026-09-08'

               AND ss.branch_id IN (1) 

            GROUP BY
                DATE_FORMAT(ss.sale_date, '%Y-%m')

        ) collection_data

        GROUP BY month_key
        ORDER BY month_key
    
ERROR - 2026-09-08 16:13:03 --> Severity: Compile Error --> Cannot redeclare sidebar_menu_has_active() (previously declared in C:\xampp\htdocs\gms\application\views\includes\sidebar.php:112) C:\xampp\htdocs\gms\application\views\includes\sidebar.php 112
ERROR - 2026-09-08 16:46:51 --> 404 Page Not Found: Dashboard/index
ERROR - 2026-09-08 17:49:02 --> 404 Page Not Found: Accounts/index
