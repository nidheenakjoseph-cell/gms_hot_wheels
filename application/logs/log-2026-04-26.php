<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-04-26 10:01:31 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 6790.350
        )

    [1] => stdClass Object
        (
            [account_id] => 2866
            [account_name] => NBD (Kishen Vijayan)
            [group_name] => Bank Accounts
            [balance] => 10000.000
        )

    [2] => stdClass Object
        (
            [account_id] => 23
            [account_name] => Cash
            [group_name] => Cash-in-hand
            [balance] => -4838.500
        )

)

ERROR - 2026-04-26 11:25:26 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 6790.350
        )

    [1] => stdClass Object
        (
            [account_id] => 2866
            [account_name] => NBD (Kishen Vijayan)
            [group_name] => Bank Accounts
            [balance] => 10000.000
        )

    [2] => stdClass Object
        (
            [account_id] => 23
            [account_name] => Cash
            [group_name] => Cash-in-hand
            [balance] => -4838.500
        )

)

ERROR - 2026-04-26 11:26:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'JOIN voucher_transaction v 
            ON v.trans_id = i.invoice_id
        ...' at line 14 - Invalid query: 
        SELECT 
            i.invoice_id,
            i.invoice_no,
            i.invoice_date,
			j.customer_id,
            i.grand_total,
		    IFNULL(SUM(v.amount),0) AS paid_amt
        FROM invoices i

        JOIN job_cards j 
            ON j.jobcard_id = i.jobcard_id
            AND j.customer_id = 

        LEFT JOIN voucher_transaction v 
            ON v.trans_id = i.invoice_id
            AND v.cancel = 0
            AND v.voucher_type = 'R'
            AND v.drcr_type = 'Cr'
            AND v.account_id = 2893

        WHERE i.invoice_type = 'TI'

        GROUP BY i.invoice_id

        ORDER BY i.invoice_date DESC, i.invoice_no DESC
    
ERROR - 2026-04-26 11:26:42 --> Account ID: 2893
ERROR - 2026-04-26 11:26:51 --> Account ID: 2823
ERROR - 2026-04-26 12:56:51 --> Supplier ID from model: 79
ERROR - 2026-04-26 12:56:51 --> account_id: 2823
ERROR - 2026-04-26 11:30:41 --> Account ID: 2893
ERROR - 2026-04-26 11:30:46 --> Account ID: 2823
ERROR - 2026-04-26 13:00:46 --> Supplier ID from model: 79
ERROR - 2026-04-26 13:00:46 --> account_id: 2823
ERROR - 2026-04-26 11:37:09 --> Account ID: 2823
ERROR - 2026-04-26 13:07:09 --> Supplier ID from model: 79
ERROR - 2026-04-26 13:07:09 --> account_id: 2823
