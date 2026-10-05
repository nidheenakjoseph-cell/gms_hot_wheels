<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-09-18 10:18:42 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-18 10:18:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

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
ERROR - 2026-09-18 11:32:47 --> Query error: Table 'gmslatest.service_reminders' doesn't exist - Invalid query: UPDATE `service_reminders` SET `status` = 'Closed', `closed_at` = '2026-09-18 11:32:47'
WHERE `vehicle_id` = 804
AND `status` = 'Pending'
ERROR - 2026-09-18 11:42:24 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '452', `service_id` = '1', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '180.00', `total_cost` = '180.00'
WHERE `jobcard_id` = '452'
AND `service_id` = '1'
ERROR - 2026-09-18 11:42:24 --> {"code":0,"message":""}
ERROR - 2026-09-18 11:42:24 --> ================ update_parts START ================
ERROR - 2026-09-18 11:42:24 --> Jobcard ID: 452
ERROR - 2026-09-18 11:42:24 --> PART IDS: Array
(
)

ERROR - 2026-09-18 11:42:24 --> PART TYPE: Array
(
)

ERROR - 2026-09-18 11:42:24 --> QTY: Array
(
)

ERROR - 2026-09-18 11:42:24 --> UNIT PRICE: Array
(
)

ERROR - 2026-09-18 11:42:24 --> SELL PRICE: Array
(
)

ERROR - 2026-09-18 11:42:24 --> TOTAL PRICE: Array
(
)

ERROR - 2026-09-18 11:42:24 --> DISCOUNT: Array
(
)

ERROR - 2026-09-18 11:42:24 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-09-18 11:42:24 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-09-18 11:47:52 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '452', `service_id` = '1', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '180.00', `total_cost` = '180.00'
WHERE `jobcard_id` = '452'
AND `service_id` = '1'
ERROR - 2026-09-18 11:47:52 --> {"code":0,"message":""}
ERROR - 2026-09-18 11:47:52 --> ================ update_parts START ================
ERROR - 2026-09-18 11:47:52 --> Jobcard ID: 452
ERROR - 2026-09-18 11:47:52 --> PART IDS: Array
(
)

ERROR - 2026-09-18 11:47:52 --> PART TYPE: Array
(
)

ERROR - 2026-09-18 11:47:52 --> QTY: Array
(
)

ERROR - 2026-09-18 11:47:52 --> UNIT PRICE: Array
(
)

ERROR - 2026-09-18 11:47:52 --> SELL PRICE: Array
(
)

ERROR - 2026-09-18 11:47:52 --> TOTAL PRICE: Array
(
)

ERROR - 2026-09-18 11:47:52 --> DISCOUNT: Array
(
)

ERROR - 2026-09-18 11:47:52 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-09-18 11:47:52 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-09-18 12:00:30 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '452', `service_id` = '1', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '180.00', `total_cost` = '180.00'
WHERE `jobcard_id` = '452'
AND `service_id` = '1'
ERROR - 2026-09-18 12:00:30 --> {"code":0,"message":""}
ERROR - 2026-09-18 12:00:30 --> ================ update_parts START ================
ERROR - 2026-09-18 12:00:30 --> Jobcard ID: 452
ERROR - 2026-09-18 12:00:30 --> PART IDS: Array
(
)

ERROR - 2026-09-18 12:00:30 --> PART TYPE: Array
(
)

ERROR - 2026-09-18 12:00:30 --> QTY: Array
(
)

ERROR - 2026-09-18 12:00:30 --> UNIT PRICE: Array
(
)

ERROR - 2026-09-18 12:00:30 --> SELL PRICE: Array
(
)

ERROR - 2026-09-18 12:00:30 --> TOTAL PRICE: Array
(
)

ERROR - 2026-09-18 12:00:30 --> DISCOUNT: Array
(
)

ERROR - 2026-09-18 12:00:30 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-09-18 12:00:30 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-09-18 12:01:56 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '452', `service_id` = '1', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '180.00', `total_cost` = '180.00'
WHERE `jobcard_id` = '452'
AND `service_id` = '1'
ERROR - 2026-09-18 12:01:56 --> {"code":0,"message":""}
ERROR - 2026-09-18 12:01:56 --> ================ update_parts START ================
ERROR - 2026-09-18 12:01:56 --> Jobcard ID: 452
ERROR - 2026-09-18 12:01:56 --> PART IDS: Array
(
)

ERROR - 2026-09-18 12:01:56 --> PART TYPE: Array
(
)

ERROR - 2026-09-18 12:01:56 --> QTY: Array
(
)

ERROR - 2026-09-18 12:01:56 --> UNIT PRICE: Array
(
)

ERROR - 2026-09-18 12:01:56 --> SELL PRICE: Array
(
)

ERROR - 2026-09-18 12:01:56 --> TOTAL PRICE: Array
(
)

ERROR - 2026-09-18 12:01:56 --> DISCOUNT: Array
(
)

ERROR - 2026-09-18 12:01:56 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-09-18 12:01:56 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-09-18 12:45:46 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '452', `service_id` = '1', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '180.00', `total_cost` = '180.00'
WHERE `jobcard_id` = '452'
AND `service_id` = '1'
ERROR - 2026-09-18 12:45:46 --> {"code":0,"message":""}
ERROR - 2026-09-18 12:45:46 --> ================ update_parts START ================
ERROR - 2026-09-18 12:45:46 --> Jobcard ID: 452
ERROR - 2026-09-18 12:45:46 --> PART IDS: Array
(
)

ERROR - 2026-09-18 12:45:46 --> PART TYPE: Array
(
)

ERROR - 2026-09-18 12:45:46 --> QTY: Array
(
)

ERROR - 2026-09-18 12:45:46 --> UNIT PRICE: Array
(
)

ERROR - 2026-09-18 12:45:46 --> SELL PRICE: Array
(
)

ERROR - 2026-09-18 12:45:46 --> TOTAL PRICE: Array
(
)

ERROR - 2026-09-18 12:45:46 --> DISCOUNT: Array
(
)

ERROR - 2026-09-18 12:45:46 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-09-18 12:45:46 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-09-18 12:46:00 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '452', `service_id` = '1', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '180.00', `total_cost` = '180.00'
WHERE `jobcard_id` = '452'
AND `service_id` = '1'
ERROR - 2026-09-18 12:46:00 --> {"code":0,"message":""}
ERROR - 2026-09-18 12:46:00 --> ================ update_parts START ================
ERROR - 2026-09-18 12:46:00 --> Jobcard ID: 452
ERROR - 2026-09-18 12:46:00 --> PART IDS: Array
(
)

ERROR - 2026-09-18 12:46:00 --> PART TYPE: Array
(
)

ERROR - 2026-09-18 12:46:00 --> QTY: Array
(
)

ERROR - 2026-09-18 12:46:00 --> UNIT PRICE: Array
(
)

ERROR - 2026-09-18 12:46:00 --> SELL PRICE: Array
(
)

ERROR - 2026-09-18 12:46:00 --> TOTAL PRICE: Array
(
)

ERROR - 2026-09-18 12:46:00 --> DISCOUNT: Array
(
)

ERROR - 2026-09-18 12:46:00 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-09-18 12:46:00 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-09-18 13:02:22 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '455', `service_id` = '2', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '120.00', `total_cost` = '120.00'
WHERE `jobcard_id` = '455'
AND `service_id` = '2'
ERROR - 2026-09-18 13:02:22 --> {"code":0,"message":""}
ERROR - 2026-09-18 13:02:22 --> ================ update_parts START ================
ERROR - 2026-09-18 13:02:22 --> Jobcard ID: 455
ERROR - 2026-09-18 13:02:22 --> PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 13:02:22 --> PART TYPE: Array
(
    [0] => New Parts
    [1] => New Parts
)

ERROR - 2026-09-18 13:02:22 --> QTY: Array
(
    [0] => 2
    [1] => 1
)

ERROR - 2026-09-18 13:02:22 --> UNIT PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 13:02:22 --> SELL PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 13:02:22 --> TOTAL PRICE: Array
(
    [0] => 254.80
    [1] => 1138.50
)

ERROR - 2026-09-18 13:02:22 --> DISCOUNT: Array
(
    [0] => 5.20
    [1] => 11.50
)

ERROR - 2026-09-18 13:02:22 --> EXISTING PART IDS IN DB: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 13:02:22 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-09-18 13:02:22 --> PART ID: 5
ERROR - 2026-09-18 13:02:22 --> QTY: 2
ERROR - 2026-09-18 13:02:22 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '5', `qty` = '2', `part_type` = 'New Parts', `unit_price` = '130.00', `selling_price` = '130.00', `total_price` = '254.80', `disamount` = '5.20'
WHERE `jobcard_id` = '455'
AND `part_id` = '5'
ERROR - 2026-09-18 13:02:22 --> {"code":0,"message":""}
ERROR - 2026-09-18 13:02:22 --> ------ LOOP INDEX: 1 ------
ERROR - 2026-09-18 13:02:22 --> PART ID: 6
ERROR - 2026-09-18 13:02:22 --> QTY: 1
ERROR - 2026-09-18 13:02:22 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '6', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '1150.00', `selling_price` = '1150.00', `total_price` = '1138.50', `disamount` = '11.50'
WHERE `jobcard_id` = '455'
AND `part_id` = '6'
ERROR - 2026-09-18 13:02:22 --> {"code":0,"message":""}
ERROR - 2026-09-18 13:02:22 --> CLEANED PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 13:02:28 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '455', `service_id` = '2', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '120.00', `total_cost` = '120.00'
WHERE `jobcard_id` = '455'
AND `service_id` = '2'
ERROR - 2026-09-18 13:02:28 --> {"code":0,"message":""}
ERROR - 2026-09-18 13:02:28 --> ================ update_parts START ================
ERROR - 2026-09-18 13:02:28 --> Jobcard ID: 455
ERROR - 2026-09-18 13:02:28 --> PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 13:02:28 --> PART TYPE: Array
(
    [0] => New Parts
    [1] => New Parts
)

ERROR - 2026-09-18 13:02:28 --> QTY: Array
(
    [0] => 2
    [1] => 1
)

ERROR - 2026-09-18 13:02:28 --> UNIT PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 13:02:28 --> SELL PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 13:02:28 --> TOTAL PRICE: Array
(
    [0] => 254.80
    [1] => 1138.50
)

ERROR - 2026-09-18 13:02:28 --> DISCOUNT: Array
(
    [0] => 5.20
    [1] => 11.50
)

ERROR - 2026-09-18 13:02:28 --> EXISTING PART IDS IN DB: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 13:02:28 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-09-18 13:02:28 --> PART ID: 5
ERROR - 2026-09-18 13:02:28 --> QTY: 2
ERROR - 2026-09-18 13:02:28 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '5', `qty` = '2', `part_type` = 'New Parts', `unit_price` = '130.00', `selling_price` = '130.00', `total_price` = '254.80', `disamount` = '5.20'
WHERE `jobcard_id` = '455'
AND `part_id` = '5'
ERROR - 2026-09-18 13:02:28 --> {"code":0,"message":""}
ERROR - 2026-09-18 13:02:28 --> ------ LOOP INDEX: 1 ------
ERROR - 2026-09-18 13:02:28 --> PART ID: 6
ERROR - 2026-09-18 13:02:28 --> QTY: 1
ERROR - 2026-09-18 13:02:28 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '6', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '1150.00', `selling_price` = '1150.00', `total_price` = '1138.50', `disamount` = '11.50'
WHERE `jobcard_id` = '455'
AND `part_id` = '6'
ERROR - 2026-09-18 13:02:28 --> {"code":0,"message":""}
ERROR - 2026-09-18 13:02:28 --> CLEANED PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 13:02:32 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '455', `service_id` = '2', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '120.00', `total_cost` = '120.00'
WHERE `jobcard_id` = '455'
AND `service_id` = '2'
ERROR - 2026-09-18 13:02:32 --> {"code":0,"message":""}
ERROR - 2026-09-18 13:02:32 --> ================ update_parts START ================
ERROR - 2026-09-18 13:02:32 --> Jobcard ID: 455
ERROR - 2026-09-18 13:02:32 --> PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 13:02:32 --> PART TYPE: Array
(
    [0] => New Parts
    [1] => New Parts
)

ERROR - 2026-09-18 13:02:32 --> QTY: Array
(
    [0] => 2
    [1] => 1
)

ERROR - 2026-09-18 13:02:32 --> UNIT PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 13:02:32 --> SELL PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 13:02:32 --> TOTAL PRICE: Array
(
    [0] => 254.80
    [1] => 1138.50
)

ERROR - 2026-09-18 13:02:32 --> DISCOUNT: Array
(
    [0] => 5.20
    [1] => 11.50
)

ERROR - 2026-09-18 13:02:32 --> EXISTING PART IDS IN DB: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 13:02:32 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-09-18 13:02:32 --> PART ID: 5
ERROR - 2026-09-18 13:02:32 --> QTY: 2
ERROR - 2026-09-18 13:02:32 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '5', `qty` = '2', `part_type` = 'New Parts', `unit_price` = '130.00', `selling_price` = '130.00', `total_price` = '254.80', `disamount` = '5.20'
WHERE `jobcard_id` = '455'
AND `part_id` = '5'
ERROR - 2026-09-18 13:02:32 --> {"code":0,"message":""}
ERROR - 2026-09-18 13:02:32 --> ------ LOOP INDEX: 1 ------
ERROR - 2026-09-18 13:02:32 --> PART ID: 6
ERROR - 2026-09-18 13:02:32 --> QTY: 1
ERROR - 2026-09-18 13:02:32 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '6', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '1150.00', `selling_price` = '1150.00', `total_price` = '1138.50', `disamount` = '11.50'
WHERE `jobcard_id` = '455'
AND `part_id` = '6'
ERROR - 2026-09-18 13:02:32 --> {"code":0,"message":""}
ERROR - 2026-09-18 13:02:32 --> CLEANED PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 14:34:16 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '455', `service_id` = '2', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '120.00', `total_cost` = '120.00'
WHERE `jobcard_id` = '455'
AND `service_id` = '2'
ERROR - 2026-09-18 14:34:16 --> {"code":0,"message":""}
ERROR - 2026-09-18 14:34:16 --> ================ update_parts START ================
ERROR - 2026-09-18 14:34:16 --> Jobcard ID: 455
ERROR - 2026-09-18 14:34:16 --> PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 14:34:16 --> PART TYPE: Array
(
    [0] => New Parts
    [1] => New Parts
)

ERROR - 2026-09-18 14:34:16 --> QTY: Array
(
    [0] => 2
    [1] => 1
)

ERROR - 2026-09-18 14:34:16 --> UNIT PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 14:34:16 --> SELL PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 14:34:16 --> TOTAL PRICE: Array
(
    [0] => 254.80
    [1] => 1138.50
)

ERROR - 2026-09-18 14:34:16 --> DISCOUNT: Array
(
    [0] => 5.20
    [1] => 11.50
)

ERROR - 2026-09-18 14:34:16 --> EXISTING PART IDS IN DB: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 14:34:16 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-09-18 14:34:16 --> PART ID: 5
ERROR - 2026-09-18 14:34:16 --> QTY: 2
ERROR - 2026-09-18 14:34:16 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '5', `qty` = '2', `part_type` = 'New Parts', `unit_price` = '130.00', `selling_price` = '130.00', `total_price` = '254.80', `disamount` = '5.20'
WHERE `jobcard_id` = '455'
AND `part_id` = '5'
ERROR - 2026-09-18 14:34:16 --> {"code":0,"message":""}
ERROR - 2026-09-18 14:34:16 --> ------ LOOP INDEX: 1 ------
ERROR - 2026-09-18 14:34:16 --> PART ID: 6
ERROR - 2026-09-18 14:34:16 --> QTY: 1
ERROR - 2026-09-18 14:34:16 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '6', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '1150.00', `selling_price` = '1150.00', `total_price` = '1138.50', `disamount` = '11.50'
WHERE `jobcard_id` = '455'
AND `part_id` = '6'
ERROR - 2026-09-18 14:34:16 --> {"code":0,"message":""}
ERROR - 2026-09-18 14:34:16 --> CLEANED PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 14:35:08 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '455', `service_id` = '2', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '120.00', `total_cost` = '120.00'
WHERE `jobcard_id` = '455'
AND `service_id` = '2'
ERROR - 2026-09-18 14:35:08 --> {"code":0,"message":""}
ERROR - 2026-09-18 14:35:08 --> ================ update_parts START ================
ERROR - 2026-09-18 14:35:08 --> Jobcard ID: 455
ERROR - 2026-09-18 14:35:08 --> PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 14:35:08 --> PART TYPE: Array
(
    [0] => New Parts
    [1] => New Parts
)

ERROR - 2026-09-18 14:35:08 --> QTY: Array
(
    [0] => 2
    [1] => 1
)

ERROR - 2026-09-18 14:35:08 --> UNIT PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 14:35:08 --> SELL PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 14:35:08 --> TOTAL PRICE: Array
(
    [0] => 254.80
    [1] => 1138.50
)

ERROR - 2026-09-18 14:35:08 --> DISCOUNT: Array
(
    [0] => 5.20
    [1] => 11.50
)

ERROR - 2026-09-18 14:35:08 --> EXISTING PART IDS IN DB: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 14:35:08 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-09-18 14:35:08 --> PART ID: 5
ERROR - 2026-09-18 14:35:08 --> QTY: 2
ERROR - 2026-09-18 14:35:08 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '5', `qty` = '2', `part_type` = 'New Parts', `unit_price` = '130.00', `selling_price` = '130.00', `total_price` = '254.80', `disamount` = '5.20'
WHERE `jobcard_id` = '455'
AND `part_id` = '5'
ERROR - 2026-09-18 14:35:08 --> {"code":0,"message":""}
ERROR - 2026-09-18 14:35:08 --> ------ LOOP INDEX: 1 ------
ERROR - 2026-09-18 14:35:08 --> PART ID: 6
ERROR - 2026-09-18 14:35:08 --> QTY: 1
ERROR - 2026-09-18 14:35:08 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '6', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '1150.00', `selling_price` = '1150.00', `total_price` = '1138.50', `disamount` = '11.50'
WHERE `jobcard_id` = '455'
AND `part_id` = '6'
ERROR - 2026-09-18 14:35:08 --> {"code":0,"message":""}
ERROR - 2026-09-18 14:35:08 --> CLEANED PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 14:35:49 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '455', `service_id` = '2', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '120.00', `total_cost` = '120.00'
WHERE `jobcard_id` = '455'
AND `service_id` = '2'
ERROR - 2026-09-18 14:35:49 --> {"code":0,"message":""}
ERROR - 2026-09-18 14:35:49 --> ================ update_parts START ================
ERROR - 2026-09-18 14:35:49 --> Jobcard ID: 455
ERROR - 2026-09-18 14:35:49 --> PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 14:35:49 --> PART TYPE: Array
(
    [0] => New Parts
    [1] => New Parts
)

ERROR - 2026-09-18 14:35:49 --> QTY: Array
(
    [0] => 2
    [1] => 1
)

ERROR - 2026-09-18 14:35:49 --> UNIT PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 14:35:49 --> SELL PRICE: Array
(
    [0] => 130.00
    [1] => 1150.00
)

ERROR - 2026-09-18 14:35:49 --> TOTAL PRICE: Array
(
    [0] => 254.80
    [1] => 1138.50
)

ERROR - 2026-09-18 14:35:49 --> DISCOUNT: Array
(
    [0] => 5.20
    [1] => 11.50
)

ERROR - 2026-09-18 14:35:49 --> EXISTING PART IDS IN DB: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 14:35:49 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-09-18 14:35:49 --> PART ID: 5
ERROR - 2026-09-18 14:35:49 --> QTY: 2
ERROR - 2026-09-18 14:35:49 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '5', `qty` = '2', `part_type` = 'New Parts', `unit_price` = '130.00', `selling_price` = '130.00', `total_price` = '254.80', `disamount` = '5.20'
WHERE `jobcard_id` = '455'
AND `part_id` = '5'
ERROR - 2026-09-18 14:35:49 --> {"code":0,"message":""}
ERROR - 2026-09-18 14:35:49 --> ------ LOOP INDEX: 1 ------
ERROR - 2026-09-18 14:35:49 --> PART ID: 6
ERROR - 2026-09-18 14:35:49 --> QTY: 1
ERROR - 2026-09-18 14:35:49 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '455', `part_id` = '6', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '1150.00', `selling_price` = '1150.00', `total_price` = '1138.50', `disamount` = '11.50'
WHERE `jobcard_id` = '455'
AND `part_id` = '6'
ERROR - 2026-09-18 14:35:49 --> {"code":0,"message":""}
ERROR - 2026-09-18 14:35:49 --> CLEANED PART IDS: Array
(
    [0] => 5
    [1] => 6
)

ERROR - 2026-09-18 14:36:31 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '452', `service_id` = '1', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '180.00', `total_cost` = '180.00'
WHERE `jobcard_id` = '452'
AND `service_id` = '1'
ERROR - 2026-09-18 14:36:31 --> {"code":0,"message":""}
ERROR - 2026-09-18 14:36:31 --> ================ update_parts START ================
ERROR - 2026-09-18 14:36:31 --> Jobcard ID: 452
ERROR - 2026-09-18 14:36:31 --> PART IDS: Array
(
)

ERROR - 2026-09-18 14:36:31 --> PART TYPE: Array
(
)

ERROR - 2026-09-18 14:36:31 --> QTY: Array
(
)

ERROR - 2026-09-18 14:36:31 --> UNIT PRICE: Array
(
)

ERROR - 2026-09-18 14:36:31 --> SELL PRICE: Array
(
)

ERROR - 2026-09-18 14:36:31 --> TOTAL PRICE: Array
(
)

ERROR - 2026-09-18 14:36:31 --> DISCOUNT: Array
(
)

ERROR - 2026-09-18 14:36:31 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-09-18 14:36:31 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-09-18 17:05:09 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '445', `service_id` = '4', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '350.00', `total_cost` = '350.00'
WHERE `jobcard_id` = '445'
AND `service_id` = '4'
ERROR - 2026-09-18 17:05:09 --> {"code":0,"message":""}
ERROR - 2026-09-18 17:05:09 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '445', `service_id` = '3', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '350.00', `total_cost` = '350.00'
WHERE `jobcard_id` = '445'
AND `service_id` = '3'
ERROR - 2026-09-18 17:05:09 --> {"code":0,"message":""}
ERROR - 2026-09-18 17:05:09 --> ================ update_parts START ================
ERROR - 2026-09-18 17:05:09 --> Jobcard ID: 445
ERROR - 2026-09-18 17:05:09 --> PART IDS: Array
(
    [0] => 39
    [1] => 6
    [2] => 5
)

ERROR - 2026-09-18 17:05:09 --> PART TYPE: Array
(
    [0] => New Parts
    [1] => New Parts
    [2] => New Parts
)

ERROR - 2026-09-18 17:05:09 --> QTY: Array
(
    [0] => 1
    [1] => 1
    [2] => 1
)

ERROR - 2026-09-18 17:05:09 --> UNIT PRICE: Array
(
    [0] => 50.00
    [1] => 315.00
    [2] => 426.00
)

ERROR - 2026-09-18 17:05:09 --> SELL PRICE: Array
(
    [0] => 50.00
    [1] => 315.00
    [2] => 426.00
)

ERROR - 2026-09-18 17:05:09 --> TOTAL PRICE: Array
(
    [0] => 50.00
    [1] => 315.00
    [2] => 426.00
)

ERROR - 2026-09-18 17:05:09 --> DISCOUNT: Array
(
    [0] => 0.00
    [1] => 0.00
    [2] => 0.00
)

ERROR - 2026-09-18 17:05:09 --> EXISTING PART IDS IN DB: Array
(
    [0] => 39
    [1] => 6
    [2] => 5
)

ERROR - 2026-09-18 17:05:09 --> ------ LOOP INDEX: 0 ------
ERROR - 2026-09-18 17:05:09 --> PART ID: 39
ERROR - 2026-09-18 17:05:09 --> QTY: 1
ERROR - 2026-09-18 17:05:09 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '445', `part_id` = '39', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '50.00', `selling_price` = '50.00', `total_price` = '50.00', `disamount` = '0.00'
WHERE `jobcard_id` = '445'
AND `part_id` = '39'
ERROR - 2026-09-18 17:05:09 --> {"code":0,"message":""}
ERROR - 2026-09-18 17:05:09 --> ------ LOOP INDEX: 1 ------
ERROR - 2026-09-18 17:05:09 --> PART ID: 6
ERROR - 2026-09-18 17:05:09 --> QTY: 1
ERROR - 2026-09-18 17:05:09 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '445', `part_id` = '6', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '315.00', `selling_price` = '315.00', `total_price` = '315.00', `disamount` = '0.00'
WHERE `jobcard_id` = '445'
AND `part_id` = '6'
ERROR - 2026-09-18 17:05:09 --> {"code":0,"message":""}
ERROR - 2026-09-18 17:05:09 --> ------ LOOP INDEX: 2 ------
ERROR - 2026-09-18 17:05:09 --> PART ID: 5
ERROR - 2026-09-18 17:05:09 --> QTY: 1
ERROR - 2026-09-18 17:05:09 --> UPDATED PART: UPDATE `jobcard_parts` SET `jobcard_id` = '445', `part_id` = '5', `qty` = '1', `part_type` = 'New Parts', `unit_price` = '426.00', `selling_price` = '426.00', `total_price` = '426.00', `disamount` = '0.00'
WHERE `jobcard_id` = '445'
AND `part_id` = '5'
ERROR - 2026-09-18 17:05:09 --> {"code":0,"message":""}
ERROR - 2026-09-18 17:05:09 --> CLEANED PART IDS: Array
(
    [0] => 39
    [1] => 6
    [2] => 5
)

ERROR - 2026-09-18 17:56:11 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '447', `service_id` = '1', `employee_id` = '', `estimated_time` = '1.00', `estimated_cost` = '180.00', `total_cost` = '180.00'
WHERE `jobcard_id` = '447'
AND `service_id` = '1'
ERROR - 2026-09-18 17:56:11 --> {"code":0,"message":""}
ERROR - 2026-09-18 17:56:11 --> ================ update_parts START ================
ERROR - 2026-09-18 17:56:11 --> Jobcard ID: 447
ERROR - 2026-09-18 17:56:12 --> PART IDS: Array
(
)

ERROR - 2026-09-18 17:56:12 --> PART TYPE: Array
(
)

ERROR - 2026-09-18 17:56:12 --> QTY: Array
(
)

ERROR - 2026-09-18 17:56:12 --> UNIT PRICE: Array
(
)

ERROR - 2026-09-18 17:56:12 --> SELL PRICE: Array
(
)

ERROR - 2026-09-18 17:56:12 --> TOTAL PRICE: Array
(
)

ERROR - 2026-09-18 17:56:12 --> DISCOUNT: Array
(
)

ERROR - 2026-09-18 17:56:12 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-09-18 17:56:12 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-09-18 17:57:12 --> ================ update_parts START ================
ERROR - 2026-09-18 17:57:12 --> Jobcard ID: 219
ERROR - 2026-09-18 17:57:12 --> PART IDS: Array
(
)

ERROR - 2026-09-18 17:57:12 --> PART TYPE: Array
(
)

ERROR - 2026-09-18 17:57:12 --> QTY: Array
(
)

ERROR - 2026-09-18 17:57:12 --> UNIT PRICE: Array
(
)

ERROR - 2026-09-18 17:57:12 --> SELL PRICE: Array
(
)

ERROR - 2026-09-18 17:57:12 --> TOTAL PRICE: Array
(
)

ERROR - 2026-09-18 17:57:12 --> DISCOUNT: Array
(
)

ERROR - 2026-09-18 17:57:12 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-09-18 17:57:12 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-09-18 18:17:45 --> Severity: error --> Exception: Too few arguments to function ServiceReminder::history(), 0 passed in C:\xampp\htdocs\gms\system\core\CodeIgniter.php on line 533 and exactly 1 expected C:\xampp\htdocs\gms\application\controllers\ServiceReminder.php 175
ERROR - 2026-09-18 17:47:16 --> Severity: error --> Exception: syntax error, unexpected 'public' (T_PUBLIC) C:\xampp\htdocs\gms\application\controllers\ServiceReminder.php 41
ERROR - 2026-09-18 17:47:16 --> Severity: Error --> Uncaught Error: Call to undefined function base_url() in C:\xampp\htdocs\gms\application\views\errors\html\error_exception.php:264
Stack trace:
#0 C:\xampp\htdocs\gms\system\core\Exceptions.php(220): include()
#1 C:\xampp\htdocs\gms\application\core\MY_Exceptions.php(49): CI_Exceptions->show_exception(Object(ParseError))
#2 C:\xampp\htdocs\gms\system\core\Common.php(660): MY_Exceptions->show_exception(Object(ParseError))
#3 [internal function]: _exception_handler(Object(ParseError))
#4 {main}
  thrown C:\xampp\htdocs\gms\application\views\errors\html\error_exception.php 264
