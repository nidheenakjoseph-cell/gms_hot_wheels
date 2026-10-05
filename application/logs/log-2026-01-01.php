ERROR - 2026-01-01 11:35:17 --> Query error: Unknown column 'js.amount' in 'field list' - Invalid query: SELECT `sm`.`service_name`, `js`.`amount`
FROM `jobcard_services` `js`
JOIN `services_master` `sm` ON `sm`.`master_service_id` = `js`.`service_id`
WHERE `js`.`jobcard_id` = '32'
ERROR - 2026-01-01 21:45:32 --> Severity: Warning --> mysqli::real_connect(): (HY000/1045): Access denied for user 'develtest'@'localhost' (using password: YES) D:\wamp64\www\gms\system\database\drivers\mysqli\mysqli_driver.php 211
ERROR - 2026-01-01 21:45:32 --> Unable to connect to the database
ERROR - 2026-01-01 21:45:33 --> Severity: Warning --> mysqli::real_connect(): (HY000/1045): Access denied for user 'develtest'@'localhost' (using password: YES) D:\wamp64\www\gms\system\database\drivers\mysqli\mysqli_driver.php 211
ERROR - 2026-01-01 21:45:33 --> Unable to connect to the database
ERROR - 2026-01-01 22:45:31 --> Severity: Notice --> Undefined property: stdClass::$jobcard_id D:\wamp64\www\gms\application\views\jobcard\timesheet.php 99
ERROR - 2026-01-01 22:46:13 --> Severity: Notice --> Undefined property: stdClass::$jobcard_id D:\wamp64\www\gms\application\views\jobcard\timesheet.php 99
