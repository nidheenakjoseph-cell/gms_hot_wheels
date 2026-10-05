<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-06-05 18:11:22 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 18864.470
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
            [balance] => 3575.500
        )

)

ERROR - 2026-06-05 20:16:08 --> Query error: Unknown column 'ss.advance_used' in 'having clause' - Invalid query: SELECT `ss`.`id`, `ss`.`invoice_no`, `ss`.`customer_name`, `ss`.`sale_date`, `ss`.`grand_total` as `total_amount`, COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0) as paid_amount, ss.grand_total - (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) as pending_amount, `ss`.`cash_account_id` as `customer_ledger_id`
FROM `scrap_sales` `ss`
LEFT JOIN (
            SELECT trans_id, SUM(amount) AS receipt_paid
            FROM voucher_transaction
            WHERE trans_type = 'SCRAP'
                AND voucher_type = 'R'
                AND drcr_type = 'Cr'
                AND cancel = 0
            GROUP BY trans_id
        ) receipt ON `receipt`.`trans_id` = `ss`.`id`
HAVING (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) < `ss`.`grand_total`
ORDER BY `ss`.`sale_date` DESC
ERROR - 2026-06-05 20:22:41 --> Query error: Unknown column 'ss.advance_used' in 'having clause' - Invalid query: SELECT `ss`.`id`, `ss`.`invoice_no`, `ss`.`customer_name`, `ss`.`sale_date`, `ss`.`grand_total` as `total_amount`, COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0) as paid_amount, ss.grand_total - (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) as pending_amount, `ss`.`cash_account_id` as `customer_ledger_id`
FROM `scrap_sales` `ss`
LEFT JOIN (
            SELECT trans_id, SUM(amount) AS receipt_paid
            FROM voucher_transaction
            WHERE trans_type = 'SCRAP'
                AND voucher_type = 'R'
                AND drcr_type = 'Cr'
                AND cancel = 0
            GROUP BY trans_id
        ) receipt ON `receipt`.`trans_id` = `ss`.`id`
HAVING (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) < `ss`.`grand_total`
ORDER BY `ss`.`sale_date` DESC
ERROR - 2026-06-05 20:23:36 --> Query error: Unknown column 'ss.advance_used' in 'having clause' - Invalid query: SELECT `ss`.`id`, `ss`.`invoice_no`, `ss`.`customer_name`, `ss`.`sale_date`, `ss`.`grand_total` as `total_amount`, COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0) as paid_amount, ss.grand_total - (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) as pending_amount, `ss`.`cash_account_id` as `customer_ledger_id`
FROM `scrap_sales` `ss`
LEFT JOIN (
            SELECT trans_id, SUM(amount) AS receipt_paid
            FROM voucher_transaction
            WHERE trans_type = 'SCRAP'
                AND voucher_type = 'R'
                AND drcr_type = 'Cr'
                AND cancel = 0
            GROUP BY trans_id
        ) receipt ON `receipt`.`trans_id` = `ss`.`id`
HAVING (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) < `ss`.`grand_total`
ORDER BY `ss`.`sale_date` DESC
ERROR - 2026-06-05 20:28:05 --> Query error: Unknown column 'ss.advance_used' in 'having clause' - Invalid query: SELECT `ss`.`id`, `ss`.`invoice_no`, `ss`.`sale_date`, `ss`.`grand_total` as `total_amount`, COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0) as paid_amount, ss.grand_total - (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) as pending_amount, `ss`.`cash_account_id` as `customer_ledger_id`
FROM `scrap_sales` `ss`
LEFT JOIN (
            SELECT trans_id, SUM(amount) AS receipt_paid
            FROM voucher_transaction
            WHERE trans_type = 'SCRAP'
                AND voucher_type = 'R'
                AND drcr_type = 'Cr'
                AND cancel = 0
            GROUP BY trans_id
        ) receipt ON `receipt`.`trans_id` = `ss`.`id`
WHERE `ss`.`customer_name` = 'A E F Cleaning services llc'
HAVING (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) < `ss`.`grand_total`
ORDER BY `ss`.`sale_date` DESC
ERROR - 2026-06-05 20:28:21 --> Query error: Unknown column 'ss.advance_used' in 'having clause' - Invalid query: SELECT `ss`.`id`, `ss`.`invoice_no`, `ss`.`sale_date`, `ss`.`grand_total` as `total_amount`, COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0) as paid_amount, ss.grand_total - (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) as pending_amount, `ss`.`cash_account_id` as `customer_ledger_id`
FROM `scrap_sales` `ss`
LEFT JOIN (
            SELECT trans_id, SUM(amount) AS receipt_paid
            FROM voucher_transaction
            WHERE trans_type = 'SCRAP'
                AND voucher_type = 'R'
                AND drcr_type = 'Cr'
                AND cancel = 0
            GROUP BY trans_id
        ) receipt ON `receipt`.`trans_id` = `ss`.`id`
WHERE `ss`.`customer_name` = 'A E F Cleaning services llc'
HAVING (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) < `ss`.`grand_total`
ORDER BY `ss`.`sale_date` DESC
ERROR - 2026-06-05 20:37:54 --> Voucher Code: SRV/26/00007
ERROR - 2026-06-05 20:45:14 --> Severity: error --> Exception: Call to undefined method Scrap_model::get_scrap_invoice_due_amount() C:\xampp\htdocs\gms\application\models\Scrap_model.php 453
ERROR - 2026-06-05 22:26:56 --> Voucher Code: SRV/26/00008
ERROR - 2026-06-05 22:27:44 --> Voucher Code: SRV/26/00008
ERROR - 2026-06-05 22:34:53 --> Voucher Code: SRV/26/00010
