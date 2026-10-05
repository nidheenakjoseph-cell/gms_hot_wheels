ERROR - 2026-01-06 21:57:54 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\estimation\create.php 628
ERROR - 2026-01-06 21:57:54 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\estimation\create.php 628
ERROR - 2026-01-06 21:57:54 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\estimation\create.php 637
ERROR - 2026-01-06 21:57:54 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\estimation\create.php 637
ERROR - 2026-01-06 21:57:54 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\estimation\create.php 646
ERROR - 2026-01-06 21:57:54 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\estimation\create.php 646
ERROR - 2026-01-06 22:00:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.`brand_id`, `vb`.`brand_name`
FROM `spare_parts` `sp`
JOIN `vehicle_brands` `vb' at line 1 - Invalid query: SELECT `DISTINCT` `vb`.`brand_id`, `vb`.`brand_name`
FROM `spare_parts` `sp`
JOIN `vehicle_brands` `vb` ON `vb`.`brand_id` = `sp`.`brand_id`
WHERE `sp`.`part_type` = 'Used Parts'
ORDER BY `vb`.`brand_name` ASC
ERROR - 2026-01-06 22:00:34 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.`brand_id`, `vb`.`brand_name`
FROM `spare_parts` `sp`
JOIN `vehicle_brands` `vb' at line 1 - Invalid query: SELECT `DISTINCT` `vb`.`brand_id`, `vb`.`brand_name`
FROM `spare_parts` `sp`
JOIN `vehicle_brands` `vb` ON `vb`.`brand_id` = `sp`.`brand_id`
WHERE `sp`.`part_type` = 'Used Parts'
ORDER BY `vb`.`brand_name` ASC
ERROR - 2026-01-06 22:02:55 --> Used Brands: Array
(
)

ERROR - 2026-01-06 22:02:55 --> New Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 2
            [brand_name] => Audi
        )

    [1] => stdClass Object
        (
            [brand_id] => 8
            [brand_name] => BMW
        )

    [2] => stdClass Object
        (
            [brand_id] => 7
            [brand_name] => Ford
        )

    [3] => stdClass Object
        (
            [brand_id] => 11
            [brand_name] => Honda
        )

    [4] => stdClass Object
        (
            [brand_id] => 9
            [brand_name] => Hyundai
        )

    [5] => stdClass Object
        (
            [brand_id] => 4
            [brand_name] => Jeep
        )

    [6] => stdClass Object
        (
            [brand_id] => 6
            [brand_name] => Kia
        )

    [7] => stdClass Object
        (
            [brand_id] => 3
            [brand_name] => Lexus
        )

    [8] => stdClass Object
        (
            [brand_id] => 5
            [brand_name] => Mercedes
        )

    [9] => stdClass Object
        (
            [brand_id] => 1
            [brand_name] => Toyota
        )

)

ERROR - 2026-01-06 22:02:55 --> Aftermarket Brands: Array
(
)

ERROR - 2026-01-06 22:33:59 --> Used Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 7
            [brand_name] => Ford
        )

)

ERROR - 2026-01-06 22:33:59 --> New Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 2
            [brand_name] => Audi
        )

    [1] => stdClass Object
        (
            [brand_id] => 8
            [brand_name] => BMW
        )

    [2] => stdClass Object
        (
            [brand_id] => 11
            [brand_name] => Honda
        )

    [3] => stdClass Object
        (
            [brand_id] => 9
            [brand_name] => Hyundai
        )

    [4] => stdClass Object
        (
            [brand_id] => 6
            [brand_name] => Kia
        )

    [5] => stdClass Object
        (
            [brand_id] => 3
            [brand_name] => Lexus
        )

    [6] => stdClass Object
        (
            [brand_id] => 5
            [brand_name] => Mercedes
        )

    [7] => stdClass Object
        (
            [brand_id] => 1
            [brand_name] => Toyota
        )

)

ERROR - 2026-01-06 22:33:59 --> Aftermarket Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 4
            [brand_name] => Jeep
        )

)

ERROR - 2026-01-06 22:34:32 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('100', '16', '1', '1200.00', '1200.00')
ERROR - 2026-01-06 22:34:32 --> {"code":0,"message":""}
ERROR - 2026-01-06 22:57:58 --> Query error: Column 'part_type' in where clause is ambiguous - Invalid query: SELECT `estimation_parts`.*, `spare_parts`.`part_name`
FROM `estimation_parts`
JOIN `spare_parts` ON `spare_parts`.`part_id` = `estimation_parts`.`part_id`
WHERE `estimation_id` = '100'
AND `part_type` = 'New'
ERROR - 2026-01-06 23:44:07 --> Used Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 7
            [brand_name] => Ford
        )

)

ERROR - 2026-01-06 23:44:07 --> New Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 2
            [brand_name] => Audi
        )

    [1] => stdClass Object
        (
            [brand_id] => 8
            [brand_name] => BMW
        )

    [2] => stdClass Object
        (
            [brand_id] => 11
            [brand_name] => Honda
        )

    [3] => stdClass Object
        (
            [brand_id] => 9
            [brand_name] => Hyundai
        )

    [4] => stdClass Object
        (
            [brand_id] => 6
            [brand_name] => Kia
        )

    [5] => stdClass Object
        (
            [brand_id] => 3
            [brand_name] => Lexus
        )

    [6] => stdClass Object
        (
            [brand_id] => 5
            [brand_name] => Mercedes
        )

    [7] => stdClass Object
        (
            [brand_id] => 1
            [brand_name] => Toyota
        )

)

ERROR - 2026-01-06 23:44:07 --> Aftermarket Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 4
            [brand_name] => Jeep
        )

)

ERROR - 2026-01-06 23:58:05 --> Severity: Notice --> Undefined offset: 0 D:\wamp64\www\gms\application\models\Estimation_model.php 86
ERROR - 2026-01-06 23:58:05 --> Query error: Column 'selected' cannot be null - Invalid query: INSERT INTO `estimation_parts` (`estimation_id`, `part_id`, `qty`, `unit_price`, `selling_price`, `total_price`, `markup_percentage`, `discount`, `dis_amount`, `part_type`, `brand_id`, `selected`) VALUES ('101', '11', '1', '300.00', '300.00', '300.00', '0', '0', '0.00', 'New', '11', NULL)
