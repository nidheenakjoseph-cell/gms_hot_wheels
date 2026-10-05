<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-04-11 10:40:38 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5955.600
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
            [balance] => -6339.500
        )

)

ERROR - 2026-04-11 10:46:33 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5955.600
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
            [balance] => -6339.500
        )

)

ERROR - 2026-04-11 10:49:31 --> Used Brands: Array
(
)

ERROR - 2026-04-11 10:49:31 --> New Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 2
            [brand_name] => Audi
        )

    [1] => stdClass Object
        (
            [brand_id] => 7
            [brand_name] => Ford
        )

    [2] => stdClass Object
        (
            [brand_id] => 9
            [brand_name] => Hyundai
        )

    [3] => stdClass Object
        (
            [brand_id] => 4
            [brand_name] => Jeep
        )

    [4] => stdClass Object
        (
            [brand_id] => 5
            [brand_name] => Mercedes
        )

)

ERROR - 2026-04-11 10:49:31 --> Aftermarket Brands: Array
(
)

ERROR - 2026-04-11 10:52:26 --> 3
ERROR - 2026-04-11 10:52:26 --> 356
ERROR - 2026-04-11 10:52:26 --> quote new
ERROR - 2026-04-11 10:53:19 --> check this function
ERROR - 2026-04-11 10:53:19 --> check this 356
ERROR - 2026-04-11 10:53:19 --> estimation_id this 357
ERROR - 2026-04-11 10:53:32 --> INSERTED: INSERT INTO `jobcard_services` (`jobcard_id`, `service_id`, `employee_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('194', '10', '9', '1.00', '150.00', '150.00')
ERROR - 2026-04-11 10:53:32 --> {"code":0,"message":""}
ERROR - 2026-04-11 10:53:32 --> INSERTED: INSERT INTO `jobcard_services` (`jobcard_id`, `service_id`, `employee_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('194', '4', '14', '1.00', '320.00', '320.00')
ERROR - 2026-04-11 10:53:32 --> {"code":0,"message":""}
ERROR - 2026-04-11 10:53:32 --> ================ update_parts START ================
ERROR - 2026-04-11 10:53:32 --> Jobcard ID: 194
ERROR - 2026-04-11 10:53:32 --> PART IDS: Array
(
    [0] => 5
    [1] => 61
    [2] => 49
)

ERROR - 2026-04-11 10:53:32 --> PART TYPE: Array
(
    [0] => New Parts
    [1] => Aftermarket Parts
    [2] => Used Parts
)

ERROR - 2026-04-11 10:53:32 --> QTY: Array
(
    [0] => 1
    [1] => 1
    [2] => 1
)

ERROR - 2026-04-11 10:53:32 --> UNIT PRICE: Array
(
    [0] => 130.00
    [1] => 450.00
    [2] => 100.00
)

ERROR - 2026-04-11 10:53:32 --> SELL PRICE: Array
(
    [0] => 130.00
    [1] => 450.00
    [2] => 100.00
)

ERROR - 2026-04-11 10:53:32 --> TOTAL PRICE: Array
(
    [0] => 130.00
    [1] => 450.00
    [2] => 100.00
)

ERROR - 2026-04-11 10:53:32 --> DISCOUNT: Array
(
    [0] => 0.00
    [1] => 0.00
    [2] => 0.00
)

ERROR - 2026-04-11 10:53:32 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-04-11 10:53:32 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-04-11 10:53:32 --> PART ID: 5
ERROR - 2026-04-11 10:53:32 --> QTY: 1
ERROR - 2026-04-11 10:53:32 --> INSERTED PART: INSERT INTO `jobcard_parts` (`jobcard_id`, `part_id`, `qty`, `part_type`, `unit_price`, `selling_price`, `total_price`, `disamount`) VALUES ('194', '5', '1', 'New Parts', '130.00', '130.00', '130.00', '0.00')
ERROR - 2026-04-11 10:53:32 --> {"code":0,"message":""}
ERROR - 2026-04-11 10:53:32 --> ------ LOOP INDEX: 1 ------
ERROR - 2026-04-11 10:53:32 --> PART ID: 61
ERROR - 2026-04-11 10:53:32 --> QTY: 1
ERROR - 2026-04-11 10:53:32 --> INSERTED PART: INSERT INTO `jobcard_parts` (`jobcard_id`, `part_id`, `qty`, `part_type`, `unit_price`, `selling_price`, `total_price`, `disamount`) VALUES ('194', '61', '1', 'Aftermarket Parts', '450.00', '450.00', '450.00', '0.00')
ERROR - 2026-04-11 10:53:32 --> {"code":0,"message":""}
ERROR - 2026-04-11 10:53:32 --> ------ LOOP INDEX: 2 ------
ERROR - 2026-04-11 10:53:32 --> PART ID: 49
ERROR - 2026-04-11 10:53:32 --> QTY: 1
ERROR - 2026-04-11 10:53:32 --> INSERTED PART: INSERT INTO `jobcard_parts` (`jobcard_id`, `part_id`, `qty`, `part_type`, `unit_price`, `selling_price`, `total_price`, `disamount`) VALUES ('194', '49', '1', 'Used Parts', '100.00', '100.00', '100.00', '0.00')
ERROR - 2026-04-11 10:53:32 --> {"code":0,"message":""}
ERROR - 2026-04-11 10:53:32 --> CLEANED PART IDS: Array
(
    [0] => 5
    [1] => 61
    [2] => 49
)

ERROR - 2026-04-11 10:53:32 --> 1
ERROR - 2026-04-11 10:53:59 --> 1
ERROR - 2026-04-11 10:54:55 --> 144
ERROR - 2026-04-11 10:58:43 --> 144
ERROR - 2026-04-11 12:01:14 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5955.600
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
            [balance] => -6339.500
        )

)

ERROR - 2026-04-11 21:35:03 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5955.600
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
            [balance] => -6339.500
        )

)

ERROR - 2026-04-11 21:39:37 --> 5
ERROR - 2026-04-11 21:39:37 --> 
ERROR - 2026-04-11 21:39:37 --> quote new
ERROR - 2026-04-11 21:39:55 --> check this function
ERROR - 2026-04-11 21:39:55 --> check this 
ERROR - 2026-04-11 21:39:55 --> estimation_id this 358
ERROR - 2026-04-11 21:41:04 --> check this function
ERROR - 2026-04-11 21:41:04 --> check this 
ERROR - 2026-04-11 21:41:04 --> estimation_id this 358
ERROR - 2026-04-11 21:41:12 --> INSERTED: INSERT INTO `jobcard_services` (`jobcard_id`, `service_id`, `employee_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('195', '14', '', '1.00', '850.00', '850.00')
ERROR - 2026-04-11 21:41:12 --> {"code":0,"message":""}
ERROR - 2026-04-11 21:41:12 --> INSERTED: INSERT INTO `jobcard_services` (`jobcard_id`, `service_id`, `employee_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('195', '9', '', '1.00', '450.00', '450.00')
ERROR - 2026-04-11 21:41:12 --> {"code":0,"message":""}
ERROR - 2026-04-11 21:41:12 --> INSERTED: INSERT INTO `jobcard_services` (`jobcard_id`, `service_id`, `employee_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('195', '8', '', '1.00', '200.00', '200.00')
ERROR - 2026-04-11 21:41:12 --> {"code":0,"message":""}
ERROR - 2026-04-11 21:41:12 --> ================ update_parts START ================
ERROR - 2026-04-11 21:41:12 --> Jobcard ID: 195
ERROR - 2026-04-11 21:41:12 --> PART IDS: Array
(
    [0] => 5
    [1] => 18
    [2] => 48
)

ERROR - 2026-04-11 21:41:12 --> PART TYPE: Array
(
    [0] => New Parts
    [1] => New Parts
    [2] => Aftermarket Parts
)

ERROR - 2026-04-11 21:41:12 --> QTY: Array
(
    [0] => 1
    [1] => 1
    [2] => 1
)

ERROR - 2026-04-11 21:41:12 --> UNIT PRICE: Array
(
    [0] => 130.00
    [1] => 50.00
    [2] => 45.00
)

ERROR - 2026-04-11 21:41:12 --> SELL PRICE: Array
(
    [0] => 130.00
    [1] => 50.00
    [2] => 45.00
)

ERROR - 2026-04-11 21:41:12 --> TOTAL PRICE: Array
(
    [0] => 123.50
    [1] => 46.00
    [2] => 42.75
)

ERROR - 2026-04-11 21:41:12 --> DISCOUNT: Array
(
    [0] => 6.50
    [1] => 4.00
    [2] => 2.25
)

ERROR - 2026-04-11 21:41:12 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-04-11 21:41:12 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-04-11 21:41:12 --> PART ID: 5
ERROR - 2026-04-11 21:41:12 --> QTY: 1
ERROR - 2026-04-11 21:41:12 --> INSERTED PART: INSERT INTO `jobcard_parts` (`jobcard_id`, `part_id`, `qty`, `part_type`, `unit_price`, `selling_price`, `total_price`, `disamount`) VALUES ('195', '5', '1', 'New Parts', '130.00', '130.00', '123.50', '6.50')
ERROR - 2026-04-11 21:41:12 --> {"code":0,"message":""}
ERROR - 2026-04-11 21:41:12 --> ------ LOOP INDEX: 1 ------
ERROR - 2026-04-11 21:41:12 --> PART ID: 18
ERROR - 2026-04-11 21:41:12 --> QTY: 1
ERROR - 2026-04-11 21:41:12 --> INSERTED PART: INSERT INTO `jobcard_parts` (`jobcard_id`, `part_id`, `qty`, `part_type`, `unit_price`, `selling_price`, `total_price`, `disamount`) VALUES ('195', '18', '1', 'New Parts', '50.00', '50.00', '46.00', '4.00')
ERROR - 2026-04-11 21:41:12 --> {"code":0,"message":""}
ERROR - 2026-04-11 21:41:12 --> ------ LOOP INDEX: 2 ------
ERROR - 2026-04-11 21:41:12 --> PART ID: 48
ERROR - 2026-04-11 21:41:12 --> QTY: 1
ERROR - 2026-04-11 21:41:12 --> INSERTED PART: INSERT INTO `jobcard_parts` (`jobcard_id`, `part_id`, `qty`, `part_type`, `unit_price`, `selling_price`, `total_price`, `disamount`) VALUES ('195', '48', '1', 'Aftermarket Parts', '45.00', '45.00', '42.75', '2.25')
ERROR - 2026-04-11 21:41:12 --> {"code":0,"message":""}
ERROR - 2026-04-11 21:41:12 --> CLEANED PART IDS: Array
(
    [0] => 5
    [1] => 18
    [2] => 48
)

ERROR - 2026-04-11 21:41:12 --> 1
ERROR - 2026-04-11 21:41:27 --> 145
ERROR - 2026-04-11 21:41:55 --> 145
ERROR - 2026-04-11 21:42:39 --> quotation exist
ERROR - 2026-04-11 21:43:02 --> quotation exist
ERROR - 2026-04-11 22:06:12 --> quotation exist
ERROR - 2026-04-11 22:06:22 --> check this function
ERROR - 2026-04-11 22:06:22 --> check this 
ERROR - 2026-04-11 22:06:22 --> estimation_id this 358
ERROR - 2026-04-11 22:06:26 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '195', `service_id` = '8', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '200.00', `total_cost` = '200.00'
WHERE `jobcard_id` = '195'
AND `service_id` = '8'
ERROR - 2026-04-11 22:06:26 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:06:26 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '195', `service_id` = '9', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '450.00', `total_cost` = '450.00'
WHERE `jobcard_id` = '195'
AND `service_id` = '9'
ERROR - 2026-04-11 22:06:26 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:06:26 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '195', `service_id` = '14', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '850.00', `total_cost` = '850.00'
WHERE `jobcard_id` = '195'
AND `service_id` = '14'
ERROR - 2026-04-11 22:06:26 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:06:26 --> INSERTED: INSERT INTO `jobcard_services` (`jobcard_id`, `service_id`, `employee_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('195', '13', '', '1.00', '100.00', '100.00')
ERROR - 2026-04-11 22:06:26 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:06:26 --> ================ update_parts START ================
ERROR - 2026-04-11 22:06:26 --> Jobcard ID: 195
ERROR - 2026-04-11 22:06:26 --> PART IDS: Array
(
    [0] => 5
    [1] => 18
    [2] => 48
)

ERROR - 2026-04-11 22:06:26 --> PART TYPE: Array
(
    [0] => New Parts
    [1] => New Parts
    [2] => Aftermarket Parts
)

ERROR - 2026-04-11 22:06:26 --> QTY: Array
(
    [0] => 1
    [1] => 1
    [2] => 1
)

ERROR - 2026-04-11 22:06:26 --> UNIT PRICE: Array
(
    [0] => 130.00
    [1] => 50.00
    [2] => 45.00
)

ERROR - 2026-04-11 22:06:26 --> SELL PRICE: Array
(
    [0] => 130.00
    [1] => 50.00
    [2] => 45.00
)

ERROR - 2026-04-11 22:06:26 --> TOTAL PRICE: Array
(
    [0] => 123.50
    [1] => 46.00
    [2] => 42.75
)

ERROR - 2026-04-11 22:06:26 --> DISCOUNT: Array
(
    [0] => 6.50
    [1] => 4.00
    [2] => 2.25
)

ERROR - 2026-04-11 22:06:26 --> EXISTING PART IDS IN DB: Array
(
    [0] => 5
    [1] => 18
    [2] => 48
)

ERROR - 2026-04-11 22:06:26 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-04-11 22:06:26 --> PART ID: 5
ERROR - 2026-04-11 22:06:26 --> QTY: 1
ERROR - 2026-04-11 22:06:26 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '195', `part_id` = '5', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '130.00', `selling_price` = '130.00', `total_price` = '123.50', `disamount` = '6.50'
WHERE `jobcard_id` = '195'
AND `part_id` = '5'
ERROR - 2026-04-11 22:06:26 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:06:26 --> ------ LOOP INDEX: 1 ------
ERROR - 2026-04-11 22:06:26 --> PART ID: 18
ERROR - 2026-04-11 22:06:26 --> QTY: 1
ERROR - 2026-04-11 22:06:26 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '195', `part_id` = '18', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '50.00', `selling_price` = '50.00', `total_price` = '46.00', `disamount` = '4.00'
WHERE `jobcard_id` = '195'
AND `part_id` = '18'
ERROR - 2026-04-11 22:06:26 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:06:26 --> ------ LOOP INDEX: 2 ------
ERROR - 2026-04-11 22:06:26 --> PART ID: 48
ERROR - 2026-04-11 22:06:26 --> QTY: 1
ERROR - 2026-04-11 22:06:26 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '195', `part_id` = '48', `qty` = '1', `part_type` = 'Aftermarket Parts', `unit_price` = '45.00', `selling_price` = '45.00', `total_price` = '42.75', `disamount` = '2.25'
WHERE `jobcard_id` = '195'
AND `part_id` = '48'
ERROR - 2026-04-11 22:06:26 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:06:26 --> CLEANED PART IDS: Array
(
    [0] => 5
    [1] => 18
    [2] => 48
)

ERROR - 2026-04-11 22:06:27 --> 1
ERROR - 2026-04-11 22:06:41 --> 1
ERROR - 2026-04-11 22:08:24 --> 145
ERROR - 2026-04-11 22:09:06 --> 145
ERROR - 2026-04-11 22:11:37 --> 145
ERROR - 2026-04-11 22:11:46 --> 145
ERROR - 2026-04-11 22:11:56 --> 145
ERROR - 2026-04-11 22:12:13 --> 145
ERROR - 2026-04-11 22:12:24 --> 145
ERROR - 2026-04-11 22:13:41 --> 145
ERROR - 2026-04-11 22:13:48 --> 145
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "invoice_no" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 15
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "name" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 21
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "phone" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 22
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "registration_no" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 26
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "jobcard_no" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 27
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "invoice_id" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 33
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "invoice_type" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 34
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "invoice_no" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 35
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "jobcard_id" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 36
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "quotation_id" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 37
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "customer_id" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 38
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "invoice_date" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 42
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "remarks" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 208
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "discount_amount" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 213
ERROR - 2026-04-11 23:46:52 --> Severity: Warning --> Attempt to read property "adv_paid" on null /home/greenea4/public_html/projects/gms/application/views/invoice/edit_invoice.php 221
ERROR - 2026-04-11 22:16:53 --> 
<div style=
ERROR - 2026-04-11 22:17:10 --> 1
ERROR - 2026-04-11 22:17:19 --> 145
ERROR - 2026-04-11 22:17:45 --> 145
ERROR - 2026-04-11 22:18:52 --> quotation exist
ERROR - 2026-04-11 22:19:05 --> check this function
ERROR - 2026-04-11 22:19:05 --> check this 
ERROR - 2026-04-11 22:19:05 --> estimation_id this 358
ERROR - 2026-04-11 22:19:09 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '195', `service_id` = '13', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '100.00', `total_cost` = '100.00'
WHERE `jobcard_id` = '195'
AND `service_id` = '13'
ERROR - 2026-04-11 22:19:09 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:19:09 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '195', `service_id` = '8', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '200.00', `total_cost` = '200.00'
WHERE `jobcard_id` = '195'
AND `service_id` = '8'
ERROR - 2026-04-11 22:19:09 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:19:09 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '195', `service_id` = '9', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '450.00', `total_cost` = '450.00'
WHERE `jobcard_id` = '195'
AND `service_id` = '9'
ERROR - 2026-04-11 22:19:09 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:19:09 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '195', `service_id` = '14', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '850.00', `total_cost` = '850.00'
WHERE `jobcard_id` = '195'
AND `service_id` = '14'
ERROR - 2026-04-11 22:19:09 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:19:09 --> ================ update_parts START ================
ERROR - 2026-04-11 22:19:09 --> Jobcard ID: 195
ERROR - 2026-04-11 22:19:09 --> PART IDS: Array
(
    [0] => 5
    [1] => 18
    [2] => 48
    [3] => 8
)

ERROR - 2026-04-11 22:19:09 --> PART TYPE: Array
(
    [0] => New Parts
    [1] => New Parts
    [2] => Aftermarket Parts
    [3] => New Parts
)

ERROR - 2026-04-11 22:19:09 --> QTY: Array
(
    [0] => 1
    [1] => 1
    [2] => 1
    [3] => 1
)

ERROR - 2026-04-11 22:19:09 --> UNIT PRICE: Array
(
    [0] => 130.00
    [1] => 50.00
    [2] => 45.00
    [3] => 80.00
)

ERROR - 2026-04-11 22:19:09 --> SELL PRICE: Array
(
    [0] => 130.00
    [1] => 50.00
    [2] => 45.00
    [3] => 80.00
)

ERROR - 2026-04-11 22:19:09 --> TOTAL PRICE: Array
(
    [0] => 123.50
    [1] => 46.00
    [2] => 42.75
    [3] => 80.00
)

ERROR - 2026-04-11 22:19:09 --> DISCOUNT: Array
(
    [0] => 6.50
    [1] => 4.00
    [2] => 2.25
    [3] => 0.00
)

ERROR - 2026-04-11 22:19:09 --> EXISTING PART IDS IN DB: Array
(
    [0] => 5
    [1] => 18
    [2] => 48
)

ERROR - 2026-04-11 22:19:09 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-04-11 22:19:09 --> PART ID: 5
ERROR - 2026-04-11 22:19:09 --> QTY: 1
ERROR - 2026-04-11 22:19:09 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '195', `part_id` = '5', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '130.00', `selling_price` = '130.00', `total_price` = '123.50', `disamount` = '6.50'
WHERE `jobcard_id` = '195'
AND `part_id` = '5'
ERROR - 2026-04-11 22:19:09 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:19:09 --> ------ LOOP INDEX: 1 ------
ERROR - 2026-04-11 22:19:09 --> PART ID: 18
ERROR - 2026-04-11 22:19:09 --> QTY: 1
ERROR - 2026-04-11 22:19:09 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '195', `part_id` = '18', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '50.00', `selling_price` = '50.00', `total_price` = '46.00', `disamount` = '4.00'
WHERE `jobcard_id` = '195'
AND `part_id` = '18'
ERROR - 2026-04-11 22:19:09 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:19:09 --> ------ LOOP INDEX: 2 ------
ERROR - 2026-04-11 22:19:09 --> PART ID: 48
ERROR - 2026-04-11 22:19:09 --> QTY: 1
ERROR - 2026-04-11 22:19:09 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '195', `part_id` = '48', `qty` = '1', `part_type` = 'Aftermarket Parts', `unit_price` = '45.00', `selling_price` = '45.00', `total_price` = '42.75', `disamount` = '2.25'
WHERE `jobcard_id` = '195'
AND `part_id` = '48'
ERROR - 2026-04-11 22:19:09 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:19:09 --> ------ LOOP INDEX: 3 ------
ERROR - 2026-04-11 22:19:09 --> PART ID: 8
ERROR - 2026-04-11 22:19:09 --> QTY: 1
ERROR - 2026-04-11 22:19:09 --> INSERTED PART: INSERT INTO `jobcard_parts` (`jobcard_id`, `part_id`, `qty`, `part_type`, `unit_price`, `selling_price`, `total_price`, `disamount`) VALUES ('195', '8', '1', 'New Parts', '80.00', '80.00', '80.00', '0.00')
ERROR - 2026-04-11 22:19:09 --> {"code":0,"message":""}
ERROR - 2026-04-11 22:19:09 --> CLEANED PART IDS: Array
(
    [0] => 5
    [1] => 18
    [2] => 48
    [3] => 8
)

ERROR - 2026-04-11 22:19:09 --> 1
ERROR - 2026-04-11 22:19:19 --> 145
