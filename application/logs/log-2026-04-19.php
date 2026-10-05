<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-04-19 22:30:49 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 4564.550
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
            [account_id] => 2881
            [account_name] => test bank account11
            [group_name] => Bank Accounts
            [balance] => -477.500
        )

    [3] => stdClass Object
        (
            [account_id] => 23
            [account_name] => Cash
            [group_name] => Cash-in-hand
            [balance] => 961.500
        )

)

ERROR - 2026-04-19 22:33:07 --> RFQ Data: Array
(
    [0] => stdClass Object
        (
            [po_id] => 118
            [po_date] => 2026-04-16
            [qtn_id] => 
            [revision] => 0
            [revision_date] => 2026-04-16
            [po_code] => COOL/POD/26/0070
            [supplier_ref] => 
            [subject] => 
            [supplier_id] => 127
            [sub_total] => 712.50
            [vat_percent] => 5.00
            [vat_amt] => 35.63
            [discount_percent] => 0.00
            [discount] => 0.00
            [currency_id] => 
            [currency_rate] => 
            [grand_total] => 748.13
            [payment_term] => test
            [delivery_term] => test
            [shipping_term] => 
            [general_term] => test
            [approved_person] => 
            [grn_status] => 0
            [is_grn_required] => 1
            [created_by] => 6
            [created_date] => 2026-04-16 12:12:38
            [stamp_id] => 
            [cancelled] => 0
            [del_date_quote] => 
            [del_date_client] => 
            [lead_time] => 
            [trans_charge] => 0.00
            [cust_charge] => 0.00
            [add_charge] => 0.00
            [certificate_term] => 
            [gen_term] => 
            [po_status] => 1
            [freight_mode] => Road
            [project] => test pro1
            [grn_id] => 0
            [validity] => 10
            [request_by] => test
            [jobcard_id] => 0
            [purchase_type] => PARTS
            [voucher_posted] => 0
            [supplier_code] => SUP0032
            [supplier_name] => test supplier160
            [contact_no] => 9632104587
            [email_id] => test160@gmail.com
            [billing_address] => test address
            [billing_city] => 
            [billing_state] => 
            [billing_po_box] => 
            [billing_country] => 
            [shipping_address] => 
            [shipping_city] => 
            [shipping_po_box] => 
            [shipping_country] => 
            [shipping_state] => 
            [contact_person] => 
            [contact_person_number] => 
            [trn_no] => 141414141414141
            [username] => Admin
            [quotation_code] => 
        )

)

ERROR - 2026-04-19 22:33:07 --> po Data: Array
(
    [0] => stdClass Object
        (
            [trans_id] => 269
            [trans_revision] => 0
            [po_master_id] => 118
            [line_type] => PART
            [product_id] => 168
            [brand] => 
            [desc] => test 
            [unit_id] => 2
            [packing_id] => 0
            [quantity] => 3.00
            [price] => 250.00
            [total] => 750.00
            [service_vat_per] => 0.00
            [service_vat_amt] => 0.00
            [expense_account_id] => 
            [dis_per] => 5.00
            [dis_amt] => 37.50
            [dis_per2] => 0.00
            [dis_amt2] => 0.00
            [unit_price] => 250.00
            [part_id] => 168
            [part_name] => test 
            [part_code] => 45
            [brand_id] => 
            [vehicle_model_id] => 
            [purchase_unit_id] => 2
            [stock_unit_id] => 2
            [qty_per_purchase_unit] => 1.00
            [min_stock] => 50
            [created_at] => 2026-03-25 09:15:04
            [part_type] => New Parts
            [warrenty] => 6 months
            [labeling] => 1
            [unit_name] => pcs
            [orgprice] => 250.00
            [received_qty] => 0.00
            [balance_qty] => 3.00
        )

)

ERROR - 2026-04-19 22:38:56 --> Query error: Table 'greenea4_gms.department_master' doesn't exist - Invalid query: select one.*,two.*, three.dept_name, four.designation_name from (select * from employee_resignation  where resig_id='47'  ORDER BY resignation_date DESC  )as one left join(select * from users )as two on(one.employee_id=two.user_id) left join(select * from department_master )as three on(two.dept_id=three.dept_id) left join(select  * from designation_master)as four on(two.desig_id=four.did) 
ERROR - 2026-04-19 23:01:23 --> Query error: Table 'greenea4_gms.department_master' doesn't exist - Invalid query: select one.*,two.*, three.dept_name, four.designation_name from (select * from employee_resignation  where resig_id='47'  ORDER BY resignation_date DESC  )as one left join(select * from users )as two on(one.employee_id=two.user_id) left join(select * from department_master )as three on(two.dept_id=three.dept_id) left join(select  * from designation_master)as four on(two.desig_id=four.did) 
