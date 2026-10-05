<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-09-19 10:36:38 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-19 10:36:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-19 11:10:28 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-19 11:10:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-19 10:30:24 --> Severity: error --> Exception: syntax error, unexpected '$id' (T_VARIABLE), expecting => (T_DOUBLE_ARROW) C:\xampp\htdocs\gms\application\controllers\MenuController.php 121
ERROR - 2026-09-19 10:30:24 --> Severity: Error --> Uncaught Error: Call to undefined function base_url() in C:\xampp\htdocs\gms\application\views\errors\html\error_exception.php:264
Stack trace:
#0 C:\xampp\htdocs\gms\system\core\Exceptions.php(220): include()
#1 C:\xampp\htdocs\gms\application\core\MY_Exceptions.php(49): CI_Exceptions->show_exception(Object(ParseError))
#2 C:\xampp\htdocs\gms\system\core\Common.php(660): MY_Exceptions->show_exception(Object(ParseError))
#3 [internal function]: _exception_handler(Object(ParseError))
#4 {main}
  thrown C:\xampp\htdocs\gms\application\views\errors\html\error_exception.php 264
ERROR - 2026-09-19 10:30:37 --> Severity: error --> Exception: syntax error, unexpected '$id' (T_VARIABLE), expecting => (T_DOUBLE_ARROW) C:\xampp\htdocs\gms\application\controllers\MenuController.php 121
ERROR - 2026-09-19 10:30:37 --> Severity: Error --> Uncaught Error: Call to undefined function base_url() in C:\xampp\htdocs\gms\application\views\errors\html\error_exception.php:264
Stack trace:
#0 C:\xampp\htdocs\gms\system\core\Exceptions.php(220): include()
#1 C:\xampp\htdocs\gms\application\core\MY_Exceptions.php(49): CI_Exceptions->show_exception(Object(ParseError))
#2 C:\xampp\htdocs\gms\system\core\Common.php(660): MY_Exceptions->show_exception(Object(ParseError))
#3 [internal function]: _exception_handler(Object(ParseError))
#4 {main}
  thrown C:\xampp\htdocs\gms\application\views\errors\html\error_exception.php 264
ERROR - 2026-09-19 10:30:40 --> Severity: error --> Exception: syntax error, unexpected '$id' (T_VARIABLE), expecting => (T_DOUBLE_ARROW) C:\xampp\htdocs\gms\application\controllers\MenuController.php 121
ERROR - 2026-09-19 10:30:40 --> Severity: Error --> Uncaught Error: Call to undefined function base_url() in C:\xampp\htdocs\gms\application\views\errors\html\error_exception.php:264
Stack trace:
#0 C:\xampp\htdocs\gms\system\core\Exceptions.php(220): include()
#1 C:\xampp\htdocs\gms\application\core\MY_Exceptions.php(49): CI_Exceptions->show_exception(Object(ParseError))
#2 C:\xampp\htdocs\gms\system\core\Common.php(660): MY_Exceptions->show_exception(Object(ParseError))
#3 [internal function]: _exception_handler(Object(ParseError))
#4 {main}
  thrown C:\xampp\htdocs\gms\application\views\errors\html\error_exception.php 264
ERROR - 2026-09-19 10:31:17 --> Severity: error --> Exception: syntax error, unexpected '$id' (T_VARIABLE), expecting => (T_DOUBLE_ARROW) C:\xampp\htdocs\gms\application\controllers\MenuController.php 121
ERROR - 2026-09-19 10:31:17 --> Severity: Error --> Uncaught Error: Call to undefined function base_url() in C:\xampp\htdocs\gms\application\views\errors\html\error_exception.php:264
Stack trace:
#0 C:\xampp\htdocs\gms\system\core\Exceptions.php(220): include()
#1 C:\xampp\htdocs\gms\application\core\MY_Exceptions.php(49): CI_Exceptions->show_exception(Object(ParseError))
#2 C:\xampp\htdocs\gms\system\core\Common.php(660): MY_Exceptions->show_exception(Object(ParseError))
#3 [internal function]: _exception_handler(Object(ParseError))
#4 {main}
  thrown C:\xampp\htdocs\gms\application\views\errors\html\error_exception.php 264
ERROR - 2026-09-19 12:21:05 --> Severity: Notice --> Undefined variable: from_date C:\xampp\htdocs\gms\application\views\reports\total_sales.php 11
ERROR - 2026-09-19 12:21:05 --> Severity: Notice --> Undefined variable: to_date C:\xampp\htdocs\gms\application\views\reports\total_sales.php 19
ERROR - 2026-09-19 12:21:05 --> Severity: Notice --> Undefined variable: branches C:\xampp\htdocs\gms\application\views\reports\total_sales.php 30
ERROR - 2026-09-19 12:21:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\gms\application\views\reports\total_sales.php 30
ERROR - 2026-09-19 12:27:10 --> Query error: Table 'gmslatest.invoice' doesn't exist - Invalid query: SELECT COUNT(DISTINCT i.id) AS total_invoices, COALESCE(SUM(i.sub_total), 0) AS gross_sales, COALESCE(SUM(i.discount), 0) AS discount, COALESCE(SUM(i.tax_amount), 0) AS vat, COALESCE(SUM(i.grand_total), 0) AS net_sales
FROM `invoice` `i`
WHERE DATE(i.invoice_date) >= '2026-09-01'
AND DATE(i.invoice_date) <= '2026-09-19'
ERROR - 2026-09-19 12:32:17 --> Query error: Unknown column 'i.sub_total' in 'field list' - Invalid query: SELECT COUNT(DISTINCT i.invoice_id) AS total_invoices, COALESCE(SUM(i.sub_total), 0) AS gross_sales, COALESCE(SUM(i.discount), 0) AS discount, COALESCE(SUM(i.tax_amount), 0) AS vat, COALESCE(SUM(i.grand_total), 0) AS net_sales
FROM `invoices` `i`
LEFT JOIN `job_cards` `j` ON `j`.`jobcard_id` = `i`.`jobcard_id`
WHERE DATE(i.invoice_date) >= '2026-09-01'
AND DATE(i.invoice_date) <= '2026-09-19'
ERROR - 2026-09-19 12:35:18 --> Query error: Unknown column 'i.sub_total' in 'field list' - Invalid query: SELECT COUNT(DISTINCT i.invoice_id) AS total_invoices, COALESCE(SUM(i.sub_total), 0) AS gross_sales, COALESCE(SUM(i.discount), 0) AS discount, COALESCE(SUM(i.tax_amount), 0) AS vat, COALESCE(SUM(i.grand_total), 0) AS net_sales
FROM `invoices` `i`
LEFT JOIN `job_cards` `j` ON `j`.`jobcard_id` = `i`.`jobcard_id`
WHERE DATE(i.invoice_date) >= '2026-09-01'
AND DATE(i.invoice_date) <= '2026-09-19'
ERROR - 2026-09-19 12:35:22 --> Query error: Unknown column 'i.sub_total' in 'field list' - Invalid query: SELECT COUNT(DISTINCT i.invoice_id) AS total_invoices, COALESCE(SUM(i.sub_total), 0) AS gross_sales, COALESCE(SUM(i.discount), 0) AS discount, COALESCE(SUM(i.tax_amount), 0) AS vat, COALESCE(SUM(i.grand_total), 0) AS net_sales
FROM `invoices` `i`
LEFT JOIN `job_cards` `j` ON `j`.`jobcard_id` = `i`.`jobcard_id`
WHERE DATE(i.invoice_date) >= '2026-09-01'
AND DATE(i.invoice_date) <= '2026-09-19'
ERROR - 2026-09-19 15:18:23 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:18:39 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:19:23 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:19:44 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:20:23 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:20:51 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:21:23 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:21:52 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:22:58 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:24:05 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:25:12 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:26:15 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:27:15 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:28:15 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:29:17 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:30:22 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:31:25 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:32:32 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:33:36 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:34:38 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:35:34 --> Severity: error --> Exception: Call to undefined method Customer_model::get_customer_by_id() C:\xampp\htdocs\gms\application\controllers\Reports.php 42
ERROR - 2026-09-19 15:35:39 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:36:43 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:37:45 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:38:45 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:39:49 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:40:48 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:41:50 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:42:52 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:43:56 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:44:57 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:45:57 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:46:58 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:47:59 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:49:01 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:50:01 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:51:02 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:52:06 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:53:12 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:54:12 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:55:13 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:56:13 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:57:14 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:58:14 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 15:59:21 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:00:24 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:01:27 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:02:27 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:03:32 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:04:34 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:05:34 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:06:39 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:07:41 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:08:43 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:09:49 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:10:54 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:11:59 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:13:04 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:14:10 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:15:15 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:16:20 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:17:25 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:18:31 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:19:36 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:20:41 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:21:46 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:22:52 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:23:57 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:25:02 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:26:07 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:27:13 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:28:18 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:29:23 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:30:28 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:31:34 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:32:34 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:33:39 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:34:44 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:35:50 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:36:55 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:38:00 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:39:05 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:40:11 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:41:16 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:42:21 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:43:26 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:44:32 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:45:37 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:46:42 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:47:48 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:48:53 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:49:58 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:51:03 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:52:09 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:53:14 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:54:19 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:55:24 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:56:30 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:57:35 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:58:40 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 16:59:46 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:00:51 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:01:56 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:03:01 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:04:07 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:05:07 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:06:12 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:07:17 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:08:17 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:09:18 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:10:18 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:11:25 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:12:32 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:13:32 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:14:33 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:15:34 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:16:34 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:17:35 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:18:35 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:19:42 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:20:49 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:21:49 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:22:54 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:24:00 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:25:00 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:26:01 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:27:06 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:28:13 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:29:20 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:30:27 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:31:27 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:32:28 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:33:28 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:34:28 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:35:28 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:36:29 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:37:29 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:38:29 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:39:29 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:40:29 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:41:30 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:42:30 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:43:30 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:44:31 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:45:31 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:46:32 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:47:39 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:48:45 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:49:46 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:50:46 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:51:46 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:52:47 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:53:54 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:54:58 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:55:58 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:56:58 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:57:59 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:58:59 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 17:59:59 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 18:01:06 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 18:02:06 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

ERROR - 2026-09-19 18:02:32 --> SalesDashboard filters: Array
(
    [start_date] => 2026-09-01 00:00:00
    [end_date] => 2026-09-19 23:59:59
    [branch_id] => all
    [customer_id] => all
    [status] => all
)

