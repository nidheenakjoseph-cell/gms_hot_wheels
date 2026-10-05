<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-06-04 11:42:58 --> Voucher Code: SRV/26/00001
ERROR - 2026-06-04 10:14:32 --> Severity: Warning --> mysqli::query(): (HY000/1194): Table 'inspections' is marked as crashed and should be repaired C:\xampp\htdocs\gms\system\database\drivers\mysqli\mysqli_driver.php 315
ERROR - 2026-06-04 10:14:32 --> Query error: Table 'inspections' is marked as crashed and should be repaired - Invalid query: SELECT `i`.`inspection_id`, `i`.`status`, `i`.`km_reading`, `i`.`inspection_date`, `c`.`name` AS `customer_name`, `v`.`registration_no`
FROM `inspections` `i`
JOIN `customers` `c` ON `c`.`customer_id` = `i`.`customer_id`
JOIN `vehicles` `v` ON `v`.`vehicle_id` = `i`.`vehicle_id`
ORDER BY `i`.`created_at` DESC
 LIMIT 10
ERROR - 2026-06-04 10:15:23 --> Severity: Warning --> mysqli::query(): (HY000/1194): Table 'inspections' is marked as crashed and should be repaired C:\xampp\htdocs\gms\system\database\drivers\mysqli\mysqli_driver.php 315
ERROR - 2026-06-04 10:15:23 --> Query error: Table 'inspections' is marked as crashed and should be repaired - Invalid query: SELECT `i`.`inspection_id`, `i`.`status`, `i`.`km_reading`, `i`.`inspection_date`, `c`.`name` AS `customer_name`, `v`.`registration_no`
FROM `inspections` `i`
JOIN `customers` `c` ON `c`.`customer_id` = `i`.`customer_id`
JOIN `vehicles` `v` ON `v`.`vehicle_id` = `i`.`vehicle_id`
ORDER BY `i`.`created_at` DESC
 LIMIT 10
ERROR - 2026-06-04 10:15:38 --> Severity: Warning --> mysqli::query(): (HY000/1194): Table 'inspections' is marked as crashed and should be repaired C:\xampp\htdocs\gms\system\database\drivers\mysqli\mysqli_driver.php 315
ERROR - 2026-06-04 10:15:38 --> Query error: Table 'inspections' is marked as crashed and should be repaired - Invalid query: SELECT `i`.`inspection_id`, `i`.`status`, `i`.`km_reading`, `i`.`inspection_date`, `c`.`name` AS `customer_name`, `v`.`registration_no`
FROM `inspections` `i`
JOIN `customers` `c` ON `c`.`customer_id` = `i`.`customer_id`
JOIN `vehicles` `v` ON `v`.`vehicle_id` = `i`.`vehicle_id`
ORDER BY `i`.`created_at` DESC
 LIMIT 10
ERROR - 2026-06-04 10:19:58 --> Array
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
            [balance] => 3530.500
        )

)

ERROR - 2026-06-04 12:33:43 --> Voucher Code: SRV/26/00002
ERROR - 2026-06-04 13:02:42 --> Severity: error --> Exception: Call to undefined method Customer_model::create_with_ledger() C:\xampp\htdocs\gms\application\controllers\Scrap.php 63
ERROR - 2026-06-04 13:02:47 --> Severity: error --> Exception: Call to undefined method Customer_model::create_with_ledger() C:\xampp\htdocs\gms\application\controllers\Scrap.php 63
ERROR - 2026-06-04 13:02:48 --> Severity: error --> Exception: Call to undefined method Customer_model::create_with_ledger() C:\xampp\htdocs\gms\application\controllers\Scrap.php 63
ERROR - 2026-06-04 13:03:06 --> Severity: error --> Exception: Call to undefined method Customer_model::create_with_ledger() C:\xampp\htdocs\gms\application\controllers\Scrap.php 63
