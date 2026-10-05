
ERROR - 2026-01-08 13:52:10 --> Query error: Unknown column 'js.amount' in 'field list' - Invalid query: SELECT `sm`.`service_name`, `js`.`amount`
FROM `jobcard_services` `js`
JOIN `services_master` `sm` ON `sm`.`master_service_id` = `js`.`service_id`
WHERE `js`.`jobcard_id` = '52'
ERROR - 2026-01-08 14:06:50 --> Jobcard Descriptions: [{"jobcard_description_id":"26","jobcard_id":"52","description":"cvcxvcxb fhdfhdfh","employee_id":"0"}]
ERROR - 2026-01-08 16:41:05 --> Used Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 7
            [brand_name] => Ford
        )

)

ERROR - 2026-01-08 16:41:05 --> New Brands: Array
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

ERROR - 2026-01-08 16:41:05 --> Aftermarket Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 4
            [brand_name] => Jeep
        )

)

ERROR - 2026-01-08 16:41:52 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('139', '10', '1', '150.00', '150.00')
ERROR - 2026-01-08 16:41:52 --> {"code":0,"message":""}
ERROR - 2026-01-08 16:41:52 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('139', '7', '1', '50.00', '50.00')
ERROR - 2026-01-08 16:41:52 --> {"code":0,"message":""}
ERROR - 2026-01-08 16:42:02 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('139', '7', '1.00', '50.00', '50.00')
ERROR - 2026-01-08 16:42:02 --> {"code":0,"message":""}
ERROR - 2026-01-08 16:42:02 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('139', '10', '1.00', '150.00', '150.00')
ERROR - 2026-01-08 16:42:02 --> {"code":0,"message":""}
ERROR - 2026-01-08 16:42:02 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 137
            [estimation_id] => 139
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 330.00
            [total_price] => 330.00
            [created_at] => 2026-01-08 18:12:02
            [markup_percentage] => 10.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

)

ERROR - 2026-01-08 16:42:02 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 974
ERROR - 2026-01-08 16:42:02 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 974
ERROR - 2026-01-08 16:42:02 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 983
ERROR - 2026-01-08 16:42:02 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 983
ERROR - 2026-01-08 16:42:02 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 992
ERROR - 2026-01-08 16:42:02 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 992
ERROR - 2026-01-08 16:42:23 --> Severity: Notice --> Undefined property: stdClass::$amount D:\wamp64\www\gms\application\views\jobcard\jobcard_view.php 62
ERROR - 2026-01-08 16:42:23 --> Severity: Notice --> Undefined property: stdClass::$amount D:\wamp64\www\gms\application\views\jobcard\jobcard_view.php 66
ERROR - 2026-01-08 16:42:23 --> Severity: Notice --> Undefined property: stdClass::$amount D:\wamp64\www\gms\application\views\jobcard\jobcard_view.php 62
ERROR - 2026-01-08 16:42:23 --> Severity: Notice --> Undefined property: stdClass::$amount D:\wamp64\www\gms\application\views\jobcard\jobcard_view.php 66
ERROR - 2026-01-08 16:42:46 --> Jobcard Descriptions: [{"jobcard_description_id":"26","jobcard_id":"52","description":"cvcxvcxb fhdfhdfh","employee_id":"0"}]
ERROR - 2026-01-08 16:42:50 --> Jobcard Descriptions: [{"jobcard_description_id":"32","jobcard_id":"53","description":"aaaaaa","employee_id":"0"},{"jobcard_description_id":"31","jobcard_id":"53","description":"bbbbbb","employee_id":"0"},{"jobcard_description_id":"30","jobcard_id":"53","description":"ccccc","employee_id":"0"}]
ERROR - 2026-01-08 16:42:52 --> Jobcard Descriptions: [{"jobcard_description_id":"32","jobcard_id":"53","description":"aaaaaa","employee_id":"0"},{"jobcard_description_id":"31","jobcard_id":"53","description":"bbbbbb","employee_id":"0"},{"jobcard_description_id":"30","jobcard_id":"53","description":"ccccc","employee_id":"0"}]
ERROR - 2026-01-08 16:43:05 --> Jobcard Descriptions: [{"jobcard_description_id":"32","jobcard_id":"53","description":"aaaaaa","employee_id":"0"},{"jobcard_description_id":"31","jobcard_id":"53","description":"bbbbbb","employee_id":"0"},{"jobcard_description_id":"30","jobcard_id":"53","description":"ccccc","employee_id":"0"}]
ERROR - 2026-01-08 16:43:15 --> Jobcard Descriptions: [{"jobcard_description_id":"32","jobcard_id":"53","description":"aaaaaa","employee_id":"0"},{"jobcard_description_id":"31","jobcard_id":"53","description":"bbbbbb","employee_id":"0"},{"jobcard_description_id":"30","jobcard_id":"53","description":"ccccc","employee_id":"0"}]
ERROR - 2026-01-08 16:43:48 --> Jobcard Descriptions: [{"jobcard_description_id":"32","jobcard_id":"53","description":"aaaaaa","employee_id":"0"},{"jobcard_description_id":"31","jobcard_id":"53","description":"bbbbbb","employee_id":"0"},{"jobcard_description_id":"30","jobcard_id":"53","description":"ccccc","employee_id":"0"}]
ERROR - 2026-01-08 16:43:50 --> Jobcard Descriptions: [{"jobcard_description_id":"32","jobcard_id":"53","description":"aaaaaa","employee_id":"0"},{"jobcard_description_id":"31","jobcard_id":"53","description":"bbbbbb","employee_id":"0"},{"jobcard_description_id":"30","jobcard_id":"53","description":"ccccc","employee_id":"0"}]
ERROR - 2026-01-08 17:20:36 --> Jobcard Descriptions: [{"jobcard_description_id":"32","jobcard_id":"53","description":"aaaaaa","employee_id":"0"},{"jobcard_description_id":"31","jobcard_id":"53","description":"bbbbbb","employee_id":"0"},{"jobcard_description_id":"30","jobcard_id":"53","description":"ccccc","employee_id":"0"}]
ERROR - 2026-01-08 17:23:40 --> Used Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 7
            [brand_name] => Ford
        )

)

ERROR - 2026-01-08 17:23:40 --> New Brands: Array
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

ERROR - 2026-01-08 17:23:40 --> Aftermarket Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 4
            [brand_name] => Jeep
        )

)

ERROR - 2026-01-08 21:00:39 --> Used Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 7
            [brand_name] => Ford
        )

)

ERROR - 2026-01-08 21:00:39 --> New Brands: Array
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

ERROR - 2026-01-08 21:00:39 --> Aftermarket Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 4
            [brand_name] => Jeep
        )

)

ERROR - 2026-01-08 21:01:32 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('141', '10', '1', '150.00', '150.00')
ERROR - 2026-01-08 21:01:32 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:01:32 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('141', '6', '1', '180.00', '180.00')
ERROR - 2026-01-08 21:01:32 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:01:32 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('141', '4', '1', '320.00', '320.00')
ERROR - 2026-01-08 21:01:32 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:04:35 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('141', '4', '1.00', '320.00', '320.00')
ERROR - 2026-01-08 21:04:35 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:04:35 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('141', '6', '1.00', '180.00', '180.00')
ERROR - 2026-01-08 21:04:35 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:04:35 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('141', '10', '1.00', '150.00', '150.00')
ERROR - 2026-01-08 21:04:35 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:04:35 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 143
            [estimation_id] => 141
            [part_id] => 8
            [qty] => 1
            [unit_price] => 290.00
            [selling_price] => 290.00
            [total_price] => 290.00
            [created_at] => 2026-01-08 22:34:35
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 6
            [selected] => 1
            [part_name] => Coolant 1L
        )

    [1] => stdClass Object
        (
            [id] => 144
            [estimation_id] => 141
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 330.00
            [total_price] => 330.00
            [created_at] => 2026-01-08 22:34:35
            [markup_percentage] => 10.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 0
            [part_name] => Wiper Blade 20 inch
        )

)

ERROR - 2026-01-08 21:04:35 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 974
ERROR - 2026-01-08 21:04:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 974
ERROR - 2026-01-08 21:04:35 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 983
ERROR - 2026-01-08 21:04:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 983
ERROR - 2026-01-08 21:04:35 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 992
ERROR - 2026-01-08 21:04:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 992
ERROR - 2026-01-08 21:14:20 --> Severity: Notice --> Uninitialized string offset: 4 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:14:20 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('140', '10', '1', '150.00', '150.00')
ERROR - 2026-01-08 21:14:20 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:14:20 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('140', '6', '1', '180.00', '180.00')
ERROR - 2026-01-08 21:14:20 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:14:38 --> Parts Used (New): Array
(
)

ERROR - 2026-01-08 21:14:38 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 974
ERROR - 2026-01-08 21:14:38 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 974
ERROR - 2026-01-08 21:14:38 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 983
ERROR - 2026-01-08 21:14:38 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 983
ERROR - 2026-01-08 21:14:38 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 992
ERROR - 2026-01-08 21:14:38 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 992
ERROR - 2026-01-08 21:19:01 --> Used Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 7
            [brand_name] => Ford
        )

)

ERROR - 2026-01-08 21:19:01 --> New Brands: Array
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

ERROR - 2026-01-08 21:19:01 --> Aftermarket Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 4
            [brand_name] => Jeep
        )

)

ERROR - 2026-01-08 21:20:34 --> Severity: Notice --> Uninitialized string offset: 4 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:20:34 --> Severity: Notice --> Uninitialized string offset: 5 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:20:34 --> Severity: Notice --> Uninitialized string offset: 6 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:20:34 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('142', '12', '1', '40.00', '40.00')
ERROR - 2026-01-08 21:20:34 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:20:34 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('142', '6', '1', '180.00', '180.00')
ERROR - 2026-01-08 21:20:34 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:20:34 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('142', '2', '1', '120.00', '120.00')
ERROR - 2026-01-08 21:20:34 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:20:34 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('142', '1', '1', '180.00', '180.00')
ERROR - 2026-01-08 21:20:34 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:21:33 --> Severity: Notice --> Uninitialized string offset: 4 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:21:33 --> Severity: Notice --> Uninitialized string offset: 5 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:21:33 --> Severity: Notice --> Uninitialized string offset: 6 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:21:33 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('142', '1', '1.00', '180.00', '180.00')
ERROR - 2026-01-08 21:21:33 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:21:33 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('142', '2', '1.00', '120.00', '120.00')
ERROR - 2026-01-08 21:21:33 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:21:33 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('142', '6', '1.00', '180.00', '180.00')
ERROR - 2026-01-08 21:21:33 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:21:33 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('142', '12', '1.00', '40.00', '40.00')
ERROR - 2026-01-08 21:21:33 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:21:56 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 162
            [estimation_id] => 142
            [part_id] => 16
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 8
            [selected] => 1
            [part_name] => abcd
        )

    [1] => stdClass Object
        (
            [id] => 163
            [estimation_id] => 142
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 1
            [part_name] => Headlight Bulb H4
        )

    [2] => stdClass Object
        (
            [id] => 161
            [estimation_id] => 142
            [part_id] => 8
            [qty] => 1
            [unit_price] => 290.00
            [selling_price] => 290.00
            [total_price] => 290.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 6
            [selected] => 0
            [part_name] => Coolant 1L
        )

    [3] => stdClass Object
        (
            [id] => 160
            [estimation_id] => 142
            [part_id] => 5
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 2
            [selected] => 1
            [part_name] => Brake Pad - Front
        )

    [4] => stdClass Object
        (
            [id] => 159
            [estimation_id] => 142
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

)

ERROR - 2026-01-08 21:21:57 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 974
ERROR - 2026-01-08 21:21:57 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 974
ERROR - 2026-01-08 21:21:57 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 983
ERROR - 2026-01-08 21:21:57 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 983
ERROR - 2026-01-08 21:21:57 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 992
ERROR - 2026-01-08 21:21:57 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 992
ERROR - 2026-01-08 21:29:35 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 162
            [estimation_id] => 142
            [part_id] => 16
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 8
            [selected] => 1
            [part_name] => abcd
        )

    [1] => stdClass Object
        (
            [id] => 163
            [estimation_id] => 142
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 1
            [part_name] => Headlight Bulb H4
        )

    [2] => stdClass Object
        (
            [id] => 161
            [estimation_id] => 142
            [part_id] => 8
            [qty] => 1
            [unit_price] => 290.00
            [selling_price] => 290.00
            [total_price] => 290.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 6
            [selected] => 0
            [part_name] => Coolant 1L
        )

    [3] => stdClass Object
        (
            [id] => 160
            [estimation_id] => 142
            [part_id] => 5
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 2
            [selected] => 1
            [part_name] => Brake Pad - Front
        )

    [4] => stdClass Object
        (
            [id] => 159
            [estimation_id] => 142
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

)

ERROR - 2026-01-08 21:29:35 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 908
ERROR - 2026-01-08 21:29:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 908
ERROR - 2026-01-08 21:29:35 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 917
ERROR - 2026-01-08 21:29:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 917
ERROR - 2026-01-08 21:29:35 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 926
ERROR - 2026-01-08 21:29:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 926
ERROR - 2026-01-08 21:30:19 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 162
            [estimation_id] => 142
            [part_id] => 16
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 8
            [selected] => 1
            [part_name] => abcd
        )

    [1] => stdClass Object
        (
            [id] => 163
            [estimation_id] => 142
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 1
            [part_name] => Headlight Bulb H4
        )

    [2] => stdClass Object
        (
            [id] => 161
            [estimation_id] => 142
            [part_id] => 8
            [qty] => 1
            [unit_price] => 290.00
            [selling_price] => 290.00
            [total_price] => 290.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 6
            [selected] => 0
            [part_name] => Coolant 1L
        )

    [3] => stdClass Object
        (
            [id] => 160
            [estimation_id] => 142
            [part_id] => 5
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 2
            [selected] => 1
            [part_name] => Brake Pad - Front
        )

    [4] => stdClass Object
        (
            [id] => 159
            [estimation_id] => 142
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

)

ERROR - 2026-01-08 21:30:19 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 908
ERROR - 2026-01-08 21:30:19 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 908
ERROR - 2026-01-08 21:30:19 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 917
ERROR - 2026-01-08 21:30:19 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 917
ERROR - 2026-01-08 21:30:19 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 926
ERROR - 2026-01-08 21:30:19 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 926
ERROR - 2026-01-08 21:30:49 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 162
            [estimation_id] => 142
            [part_id] => 16
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 8
            [selected] => 1
            [part_name] => abcd
        )

    [1] => stdClass Object
        (
            [id] => 163
            [estimation_id] => 142
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 1
            [part_name] => Headlight Bulb H4
        )

    [2] => stdClass Object
        (
            [id] => 161
            [estimation_id] => 142
            [part_id] => 8
            [qty] => 1
            [unit_price] => 290.00
            [selling_price] => 290.00
            [total_price] => 290.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 6
            [selected] => 0
            [part_name] => Coolant 1L
        )

    [3] => stdClass Object
        (
            [id] => 160
            [estimation_id] => 142
            [part_id] => 5
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 2
            [selected] => 1
            [part_name] => Brake Pad - Front
        )

    [4] => stdClass Object
        (
            [id] => 159
            [estimation_id] => 142
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

)

ERROR - 2026-01-08 21:30:49 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 908
ERROR - 2026-01-08 21:30:49 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 908
ERROR - 2026-01-08 21:30:49 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 917
ERROR - 2026-01-08 21:30:49 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 917
ERROR - 2026-01-08 21:30:49 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 926
ERROR - 2026-01-08 21:30:49 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 926
ERROR - 2026-01-08 21:32:28 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 162
            [estimation_id] => 142
            [part_id] => 16
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 8
            [selected] => 1
            [part_name] => abcd
        )

    [1] => stdClass Object
        (
            [id] => 163
            [estimation_id] => 142
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 1
            [part_name] => Headlight Bulb H4
        )

    [2] => stdClass Object
        (
            [id] => 161
            [estimation_id] => 142
            [part_id] => 8
            [qty] => 1
            [unit_price] => 290.00
            [selling_price] => 290.00
            [total_price] => 290.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 6
            [selected] => 0
            [part_name] => Coolant 1L
        )

    [3] => stdClass Object
        (
            [id] => 160
            [estimation_id] => 142
            [part_id] => 5
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 2
            [selected] => 1
            [part_name] => Brake Pad - Front
        )

    [4] => stdClass Object
        (
            [id] => 159
            [estimation_id] => 142
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

)

ERROR - 2026-01-08 21:32:28 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 910
ERROR - 2026-01-08 21:32:28 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 910
ERROR - 2026-01-08 21:32:28 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 919
ERROR - 2026-01-08 21:32:28 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 919
ERROR - 2026-01-08 21:32:28 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 928
ERROR - 2026-01-08 21:32:28 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 928
ERROR - 2026-01-08 21:35:33 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 162
            [estimation_id] => 142
            [part_id] => 16
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 8
            [selected] => 1
            [part_name] => abcd
        )

    [1] => stdClass Object
        (
            [id] => 163
            [estimation_id] => 142
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 1
            [part_name] => Headlight Bulb H4
        )

    [2] => stdClass Object
        (
            [id] => 161
            [estimation_id] => 142
            [part_id] => 8
            [qty] => 1
            [unit_price] => 290.00
            [selling_price] => 290.00
            [total_price] => 290.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 6
            [selected] => 0
            [part_name] => Coolant 1L
        )

    [3] => stdClass Object
        (
            [id] => 160
            [estimation_id] => 142
            [part_id] => 5
            [qty] => 1
            [unit_price] => 1250.00
            [selling_price] => 1250.00
            [total_price] => 1250.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 2
            [selected] => 1
            [part_name] => Brake Pad - Front
        )

    [4] => stdClass Object
        (
            [id] => 159
            [estimation_id] => 142
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 22:51:33
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

)

ERROR - 2026-01-08 21:35:33 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 910
ERROR - 2026-01-08 21:35:33 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 910
ERROR - 2026-01-08 21:35:33 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 919
ERROR - 2026-01-08 21:35:33 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 919
ERROR - 2026-01-08 21:35:33 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 928
ERROR - 2026-01-08 21:35:33 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 928
ERROR - 2026-01-08 21:41:19 --> Used Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 7
            [brand_name] => Ford
        )

)

ERROR - 2026-01-08 21:41:19 --> New Brands: Array
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

ERROR - 2026-01-08 21:41:19 --> Aftermarket Brands: Array
(
    [0] => stdClass Object
        (
            [brand_id] => 4
            [brand_name] => Jeep
        )

)

ERROR - 2026-01-08 21:42:39 --> Severity: Notice --> Uninitialized string offset: 4 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:42:39 --> Severity: Notice --> Uninitialized string offset: 5 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:42:39 --> Severity: Notice --> Uninitialized string offset: 6 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:42:39 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('143', '11', '1', '180.00', '180.00')
ERROR - 2026-01-08 21:42:39 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:42:39 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('143', '5', '1', '250.00', '250.00')
ERROR - 2026-01-08 21:42:39 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:42:39 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('143', '3', '1', '350.00', '350.00')
ERROR - 2026-01-08 21:42:39 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:42:39 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('143', '8', '1', '200.00', '200.00')
ERROR - 2026-01-08 21:42:39 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:43:10 --> Severity: Notice --> Uninitialized string offset: 4 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:43:10 --> Severity: Notice --> Uninitialized string offset: 5 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:43:10 --> Severity: Notice --> Uninitialized string offset: 6 D:\wamp64\www\gms\application\models\Estimation_model.php 85
ERROR - 2026-01-08 21:43:10 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('143', '8', '1.00', '200.00', '200.00')
ERROR - 2026-01-08 21:43:10 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:43:10 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('143', '3', '1.00', '350.00', '350.00')
ERROR - 2026-01-08 21:43:10 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:43:10 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('143', '5', '1.00', '250.00', '250.00')
ERROR - 2026-01-08 21:43:10 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:43:10 --> INSERT INTO `estimation_services` (`estimation_id`, `service_id`, `estimated_time`, `estimated_cost`, `total_cost`) VALUES ('143', '11', '1.00', '180.00', '180.00')
ERROR - 2026-01-08 21:43:10 --> {"code":0,"message":""}
ERROR - 2026-01-08 21:43:21 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 21:43:21 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 910
ERROR - 2026-01-08 21:43:21 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 910
ERROR - 2026-01-08 21:43:21 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 919
ERROR - 2026-01-08 21:43:21 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 919
ERROR - 2026-01-08 21:43:21 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 928
ERROR - 2026-01-08 21:43:21 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 928
ERROR - 2026-01-08 21:56:14 --> Pending
ERROR - 2026-01-08 22:42:21 --> Severity: error --> Exception: Object of class stdClass could not be converted to string D:\wamp64\www\gms\system\database\DB_driver.php 1484
ERROR - 2026-01-08 22:43:27 --> Severity: Compile Error --> Cannot use empty array elements in arrays D:\wamp64\www\gms\application\models\Jobcard_model.php 54
ERROR - 2026-01-08 22:49:22 --> Severity: Notice --> Undefined variable: technicians D:\wamp64\www\gms\application\views\jobcard\create.php 209
ERROR - 2026-01-08 22:49:22 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\jobcard\create.php 209
ERROR - 2026-01-08 22:49:22 --> Severity: Notice --> Undefined variable: technicians D:\wamp64\www\gms\application\views\jobcard\create.php 209
ERROR - 2026-01-08 22:49:22 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\jobcard\create.php 209
ERROR - 2026-01-08 22:49:22 --> Severity: Notice --> Undefined variable: technicians D:\wamp64\www\gms\application\views\jobcard\create.php 209
ERROR - 2026-01-08 22:49:22 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\jobcard\create.php 209
ERROR - 2026-01-08 22:49:22 --> Severity: Notice --> Undefined variable: technicians D:\wamp64\www\gms\application\views\jobcard\create.php 209
ERROR - 2026-01-08 22:49:22 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\jobcard\create.php 209
ERROR - 2026-01-08 22:50:54 --> Severity: Notice --> Undefined variable: j D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:54 --> Severity: Notice --> Trying to get property 'employee_name' of non-object D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:54 --> Severity: Notice --> Undefined variable: j D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:54 --> Severity: Notice --> Trying to get property 'employee_name' of non-object D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:54 --> Severity: Notice --> Undefined variable: j D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:54 --> Severity: Notice --> Trying to get property 'employee_name' of non-object D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:54 --> Severity: Notice --> Undefined variable: j D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:55 --> Severity: Notice --> Trying to get property 'employee_name' of non-object D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:55 --> Severity: Notice --> Undefined variable: j D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:55 --> Severity: Notice --> Trying to get property 'employee_name' of non-object D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:55 --> Severity: Notice --> Undefined variable: j D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:55 --> Severity: Notice --> Trying to get property 'employee_name' of non-object D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:55 --> Severity: Notice --> Undefined variable: j D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:55 --> Severity: Notice --> Trying to get property 'employee_name' of non-object D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:55 --> Severity: Notice --> Undefined variable: j D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:50:55 --> Severity: Notice --> Trying to get property 'employee_name' of non-object D:\wamp64\www\gms\application\views\jobcard\create.php 212
ERROR - 2026-01-08 22:56:28 --> Severity: Notice --> Undefined property: stdClass::$amount D:\wamp64\www\gms\application\views\jobcard\jobcard_view.php 62
ERROR - 2026-01-08 22:56:28 --> Severity: Notice --> Undefined property: stdClass::$amount D:\wamp64\www\gms\application\views\jobcard\jobcard_view.php 62
ERROR - 2026-01-08 22:56:28 --> Severity: Notice --> Undefined property: stdClass::$amount D:\wamp64\www\gms\application\views\jobcard\jobcard_view.php 62
ERROR - 2026-01-08 22:56:28 --> Severity: Notice --> Undefined property: stdClass::$amount D:\wamp64\www\gms\application\views\jobcard\jobcard_view.php 62
ERROR - 2026-01-08 22:57:11 --> Completed
ERROR - 2026-01-08 22:57:20 --> Jobcard Descriptions: [{"jobcard_description_id":"37","jobcard_id":"65","description":"Spark Plug Replacement","employee_id":"1","service_id":"8"},{"jobcard_description_id":"38","jobcard_id":"65","description":"Brake Pad Replacement (Front)","employee_id":"2","service_id":"3"},{"jobcard_description_id":"39","jobcard_id":"65","description":"AC Service & Gas Refill","employee_id":"1","service_id":"5"},{"jobcard_description_id":"40","jobcard_id":"65","description":"Radiator Coolant Flush","employee_id":"2","service_id":"11"}]
ERROR - 2026-01-08 22:57:27 --> Jobcard Descriptions: [{"jobcard_description_id":"37","jobcard_id":"65","description":"Spark Plug Replacement","employee_id":"1","service_id":"8"},{"jobcard_description_id":"38","jobcard_id":"65","description":"Brake Pad Replacement (Front)","employee_id":"2","service_id":"3"},{"jobcard_description_id":"39","jobcard_id":"65","description":"AC Service & Gas Refill","employee_id":"1","service_id":"5"},{"jobcard_description_id":"40","jobcard_id":"65","description":"Radiator Coolant Flush","employee_id":"2","service_id":"11"}]
ERROR - 2026-01-08 22:57:30 --> Jobcard Descriptions: [{"jobcard_description_id":"37","jobcard_id":"65","description":"Spark Plug Replacement","employee_id":"1","service_id":"8"},{"jobcard_description_id":"38","jobcard_id":"65","description":"Brake Pad Replacement (Front)","employee_id":"2","service_id":"3"},{"jobcard_description_id":"39","jobcard_id":"65","description":"AC Service & Gas Refill","employee_id":"1","service_id":"5"},{"jobcard_description_id":"40","jobcard_id":"65","description":"Radiator Coolant Flush","employee_id":"2","service_id":"11"}]
ERROR - 2026-01-08 22:57:33 --> Jobcard Descriptions: [{"jobcard_description_id":"37","jobcard_id":"65","description":"Spark Plug Replacement","employee_id":"1","service_id":"8"},{"jobcard_description_id":"38","jobcard_id":"65","description":"Brake Pad Replacement (Front)","employee_id":"2","service_id":"3"},{"jobcard_description_id":"39","jobcard_id":"65","description":"AC Service & Gas Refill","employee_id":"1","service_id":"5"},{"jobcard_description_id":"40","jobcard_id":"65","description":"Radiator Coolant Flush","employee_id":"2","service_id":"11"}]
ERROR - 2026-01-08 22:57:36 --> Jobcard Descriptions: [{"jobcard_description_id":"37","jobcard_id":"65","description":"Spark Plug Replacement","employee_id":"1","service_id":"8"},{"jobcard_description_id":"38","jobcard_id":"65","description":"Brake Pad Replacement (Front)","employee_id":"2","service_id":"3"},{"jobcard_description_id":"39","jobcard_id":"65","description":"AC Service & Gas Refill","employee_id":"1","service_id":"5"},{"jobcard_description_id":"40","jobcard_id":"65","description":"Radiator Coolant Flush","employee_id":"2","service_id":"11"}]
ERROR - 2026-01-08 23:21:37 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:21:37 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:21:37 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:21:37 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:21:37 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:21:37 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:21:37 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:21:46 --> Severity: error --> Exception: Too few arguments to function Estimation::view(), 0 passed in D:\wamp64\www\gms\system\core\CodeIgniter.php on line 533 and exactly 1 expected D:\wamp64\www\gms\application\controllers\Estimation.php 412
ERROR - 2026-01-08 23:26:24 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:26:24 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:26:24 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:26:24 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:26:24 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:26:24 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:26:24 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:26:34 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:26:34 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:26:34 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:26:34 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:26:34 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:26:34 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:26:34 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:41:29 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:41:29 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:41:29 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:41:29 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:41:29 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:41:29 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:41:29 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:41:34 --> Severity: error --> Exception: Too few arguments to function Quotation::view(), 0 passed in D:\wamp64\www\gms\system\core\CodeIgniter.php on line 533 and exactly 1 expected D:\wamp64\www\gms\application\controllers\Quotation.php 227
ERROR - 2026-01-08 23:42:24 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:42:24 --> Severity: error --> Exception: syntax error, unexpected '<' D:\wamp64\www\gms\application\views\quotation\edit.php 20
ERROR - 2026-01-08 23:42:44 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:42:44 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:42:44 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:42:44 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:42:44 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:42:44 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:42:44 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:42:46 --> 404 Page Not Found: 
ERROR - 2026-01-08 23:43:22 --> 404 Page Not Found: 
ERROR - 2026-01-08 23:43:50 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:43:50 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:43:50 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 913
ERROR - 2026-01-08 23:43:50 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:43:50 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 922
ERROR - 2026-01-08 23:43:50 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:43:50 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 931
ERROR - 2026-01-08 23:43:51 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:43:51 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:43:51 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:43:51 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:43:51 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:45:05 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:45:05 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:45:05 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:45:05 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:45:05 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:45:48 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:45:48 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:45:48 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:45:48 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:45:48 --> Severity: Notice --> Undefined property: stdClass::$service_name D:\wamp64\www\gms\application\views\quotation\view.php 187
ERROR - 2026-01-08 23:47:14 --> Severity: error --> Exception: Call to undefined method Quotation_model::get_parts_type() D:\wamp64\www\gms\application\controllers\Quotation.php 255
ERROR - 2026-01-08 23:47:29 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:52:19 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:53:12 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:53:31 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:53:47 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:55:58 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 177
            [estimation_id] => 143
            [part_id] => 10
            [qty] => 1
            [unit_price] => 220.00
            [selling_price] => 220.00
            [total_price] => 220.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 9
            [selected] => 0
            [part_name] => Headlight Bulb H4
        )

    [1] => stdClass Object
        (
            [id] => 176
            [estimation_id] => 143
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

    [2] => stdClass Object
        (
            [id] => 175
            [estimation_id] => 143
            [part_id] => 3
            [qty] => 1
            [unit_price] => 320.00
            [selling_price] => 320.00
            [total_price] => 320.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 3
            [selected] => 1
            [part_name] => Air Filter - Hyundai i20
        )

    [3] => stdClass Object
        (
            [id] => 174
            [estimation_id] => 143
            [part_id] => 2
            [qty] => 1
            [unit_price] => 850.00
            [selling_price] => 850.00
            [total_price] => 850.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 1
            [selected] => 1
            [part_name] => Engine Oil 5W30
        )

    [4] => stdClass Object
        (
            [id] => 173
            [estimation_id] => 143
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-08 23:13:10
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 1
            [part_name] => Brake Pad - Rear
        )

)

ERROR - 2026-01-08 23:59:35 --> 404 Page Not Found: 
ERROR - 2026-01-08 23:59:47 --> 404 Page Not Found: 
