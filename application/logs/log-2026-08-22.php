<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-08-22 09:58:12 --> Query error: Column 'company_id' in field list is ambiguous - Invalid query: SELECT `fy`.*, `u`.`username` AS `closed_by_name`, `company_id`
FROM (`financial_years` `fy`, `branches`)
LEFT JOIN `users` `u` ON `u`.`id` = `fy`.`closed_by`
WHERE `is_active` = 1
ORDER BY `is_main_branch` DESC, `branch_id` ASC
 LIMIT 1
ERROR - 2026-08-22 10:01:22 --> Query error: Column 'company_id' in field list is ambiguous - Invalid query: SELECT `fy`.*, `u`.`username` AS `closed_by_name`, `company_id`
FROM (`financial_years` `fy`, `branches`)
LEFT JOIN `users` `u` ON `u`.`id` = `fy`.`closed_by`
WHERE `is_active` = 1
ORDER BY `is_main_branch` DESC, `branch_id` ASC
 LIMIT 1
ERROR - 2026-08-22 12:01:03 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [invoice_id] => 150
            [invoice_no] => TI-2026-0027
            [invoice_date] => 2026-08-17
            [grand_total] => 12600.00
            [status] => Partially Paid
            [customer_name] => fleet dub
            [customer_phone] => 789654123
            [registration_no] => KL 98596
            [chassis_no] => 43343545
            [paid_amount] => 8682.450
        )

    [1] => stdClass Object
        (
            [invoice_id] => 149
            [invoice_no] => TI-2026-0026
            [invoice_date] => 2026-08-17
            [grand_total] => 3412.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 5156.950
        )

    [2] => stdClass Object
        (
            [invoice_id] => 148
            [invoice_no] => TI-2026-0025
            [invoice_date] => 2026-08-17
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 19527.900
        )

    [3] => stdClass Object
        (
            [invoice_id] => 147
            [invoice_no] => TI-2026-0024
            [invoice_date] => 2026-08-17
            [grand_total] => 3412.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 9633.750
        )

    [4] => stdClass Object
        (
            [invoice_id] => 146
            [invoice_no] => TI-2026-0023
            [invoice_date] => 2026-08-17
            [grand_total] => 6825.00
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 5666.850
        )

    [5] => stdClass Object
        (
            [invoice_id] => 145
            [invoice_no] => TI-2026-0022
            [invoice_date] => 2026-08-06
            [grand_total] => 960.75
            [status] => 
            [customer_name] => immu
            [customer_phone] => 789654123
            [registration_no] => kl8020
            [chassis_no] => 
            [paid_amount] => 2560.400
        )

    [6] => stdClass Object
        (
            [invoice_id] => 144
            [invoice_no] => TI-2026-0021
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => chgjuk6y56
            [chassis_no] => 769780
            [paid_amount] => 3823.450
        )

    [7] => stdClass Object
        (
            [invoice_id] => 143
            [invoice_no] => TI-2026-0020
            [invoice_date] => 2026-08-12
            [grand_total] => 892.50
            [status] => 
            [customer_name] => test immu test
            [customer_phone] => 
            [registration_no] => 888
            [chassis_no] => 888888888
            [paid_amount] => 10923.400
        )

    [8] => stdClass Object
        (
            [invoice_id] => 142
            [invoice_no] => TI-2026-0019
            [invoice_date] => 2026-08-17
            [grand_total] => 483.00
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 14380.900
        )

    [9] => stdClass Object
        (
            [invoice_id] => 141
            [invoice_no] => TI-2026-0018
            [invoice_date] => 2026-08-14
            [grand_total] => 409.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 640.500
        )

    [10] => stdClass Object
        (
            [invoice_id] => 140
            [invoice_no] => TI-2026-0017
            [invoice_date] => 2026-08-14
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 7754.950
        )

    [11] => stdClass Object
        (
            [invoice_id] => 139
            [invoice_no] => TI-2026-0016
            [invoice_date] => 2026-08-13
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 3943.000
        )

    [12] => stdClass Object
        (
            [invoice_id] => 138
            [invoice_no] => TI-2026-0015
            [invoice_date] => 2026-08-13
            [grand_total] => 262.50
            [status] => Unpaid
            [customer_name] => test name
            [customer_phone] => 
            [registration_no] => QW 2345
            [chassis_no] => 123456
            [paid_amount] => 4470.250
        )

    [13] => stdClass Object
        (
            [invoice_id] => 137
            [invoice_no] => TI-2026-0014
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => ytttttttttttttttt
            [customer_phone] => 
            [registration_no] => fkj
            [chassis_no] => 
            [paid_amount] => 7358.000
        )

    [14] => stdClass Object
        (
            [invoice_id] => 136
            [invoice_no] => TI-2026-0013
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => ghdgfh
            [customer_phone] => 34546
            [registration_no] => dhgtht546
            [chassis_no] => 
            [paid_amount] => 3371.000
        )

    [15] => stdClass Object
        (
            [invoice_id] => 135
            [invoice_no] => TI-2026-0012
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => test new changhes
            [customer_phone] => 9495192262
            [registration_no] => KL8481
            [chassis_no] => 123458
            [paid_amount] => 5349.900
        )

    [16] => stdClass Object
        (
            [invoice_id] => 134
            [invoice_no] => TI-2026-0011
            [invoice_date] => 2026-08-08
            [grand_total] => 367.50
            [status] => 
            [customer_name] => ghdgfh
            [customer_phone] => 34546
            [registration_no] => dhgtht546
            [chassis_no] => 
            [paid_amount] => 1950.900
        )

    [17] => stdClass Object
        (
            [invoice_id] => 133
            [invoice_no] => TI-2026-0010
            [invoice_date] => 2026-08-08
            [grand_total] => 157.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 2495.850
        )

    [18] => stdClass Object
        (
            [invoice_id] => 132
            [invoice_no] => TI-2026-0009
            [invoice_date] => 2026-08-08
            [grand_total] => 367.50
            [status] => Unpaid
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 1501.500
        )

    [19] => stdClass Object
        (
            [invoice_id] => 131
            [invoice_no] => TI-2026-0008
            [invoice_date] => 2026-08-08
            [grand_total] => 1207.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 8172.150
        )

    [20] => stdClass Object
        (
            [invoice_id] => 130
            [invoice_no] => TI-2026-0007
            [invoice_date] => 2026-08-07
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => izzah
            [customer_phone] => 456987123
            [registration_no] => kl5792
            [chassis_no] => 
            [paid_amount] => 3631.950
        )

    [21] => stdClass Object
        (
            [invoice_id] => 129
            [invoice_no] => TI-2026-0006
            [invoice_date] => 2026-08-07
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => izzah
            [customer_phone] => 456987123
            [registration_no] => kl5792
            [chassis_no] => 
            [paid_amount] => 7395.150
        )

    [22] => stdClass Object
        (
            [invoice_id] => 128
            [invoice_no] => TI-2026-0005
            [invoice_date] => 2026-04-03
            [grand_total] => 3328.50
            [status] => Unpaid
            [customer_name] => Shenujith Padikkal Raghavan Murukoly
            [customer_phone] => +971503667526
            [registration_no] => EE49796
            [chassis_no] => WDCTG5CB8HJ351452
            [paid_amount] => 1501.500
        )

    [23] => stdClass Object
        (
            [invoice_id] => 127
            [invoice_no] => TI-2026-0004
            [invoice_date] => 2026-04-24
            [grand_total] => 2111.55
            [status] => Unpaid
            [customer_name] => test
            [customer_phone] => 45345
            [registration_no] => asdasf
            [chassis_no] => 345346
            [paid_amount] => 2495.850
        )

    [24] => stdClass Object
        (
            [invoice_id] => 126
            [invoice_no] => TI-2026-0003
            [invoice_date] => 2026-03-28
            [grand_total] => 5185.95
            [status] => Unpaid
            [customer_name] => Sandesh Sasikumar
            [customer_phone] => 971529031946
            [registration_no] => W63879
            [chassis_no] => 1FA6P8TH9G5275052
            [paid_amount] => 1310.400
        )

    [25] => stdClass Object
        (
            [invoice_id] => 125
            [invoice_no] => TI-2026-0002
            [invoice_date] => 2026-05-13
            [grand_total] => 2173.50
            [status] => Unpaid
            [customer_name] => Test 999
            [customer_phone] => 999999
            [registration_no] => a12345
            [chassis_no] => dsfdsgsdg
            [paid_amount] => 1003.950
        )

    [26] => stdClass Object
        (
            [invoice_id] => 124
            [invoice_no] => TI-2026-0001
            [invoice_date] => 2026-04-03
            [grand_total] => 6620.25
            [status] => 
            [customer_name] => Aginco General Trading LLC
            [customer_phone] => 971544238210
            [registration_no] => DD41617
            [chassis_no] => MNTBB7A97F6020494
            [paid_amount] => 2605.500
        )

)

ERROR - 2026-08-22 10:31:51 --> 160
ERROR - 2026-08-22 12:02:00 --> Severity: error --> Exception: Financial Year FY2026 is closed. This transaction cannot be modified. C:\xampp\htdocs\gms\application\models\Financial_year_model.php 142
ERROR - 2026-08-22 10:36:12 --> 160
ERROR - 2026-08-22 10:36:15 --> 160
ERROR - 2026-08-22 10:36:26 --> 160
ERROR - 2026-08-22 12:18:29 --> Severity: error --> Exception: Financial Year FY2026 is closed. This transaction cannot be modified. C:\xampp\htdocs\gms\application\models\Financial_year_model.php 142
ERROR - 2026-08-22 10:55:33 --> 160
ERROR - 2026-08-22 10:56:09 --> 160
ERROR - 2026-08-22 10:56:15 --> 160
ERROR - 2026-08-22 10:56:18 --> 160
ERROR - 2026-08-22 10:56:34 --> 160
ERROR - 2026-08-22 10:56:43 --> 160
ERROR - 2026-08-22 11:10:19 --> 160
ERROR - 2026-08-22 11:10:27 --> 160
ERROR - 2026-08-22 11:10:34 --> 160
ERROR - 2026-08-22 11:12:36 --> 160
ERROR - 2026-08-22 11:20:35 --> 160
ERROR - 2026-08-22 11:20:37 --> 160
ERROR - 2026-08-22 11:20:47 --> 160
ERROR - 2026-08-22 11:20:51 --> 160
ERROR - 2026-08-22 11:23:12 --> 160
ERROR - 2026-08-22 11:23:15 --> 160
ERROR - 2026-08-22 11:23:53 --> 160
ERROR - 2026-08-22 12:57:32 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [invoice_id] => 150
            [invoice_no] => TI-2026-0027
            [invoice_date] => 2026-08-08
            [grand_total] => 12600.00
            [status] => Partially Paid
            [customer_name] => fleet dub
            [customer_phone] => 789654123
            [registration_no] => KL 98596
            [chassis_no] => 43343545
            [paid_amount] => 8682.450
        )

    [1] => stdClass Object
        (
            [invoice_id] => 149
            [invoice_no] => TI-2026-0026
            [invoice_date] => 2026-08-17
            [grand_total] => 3412.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 5156.950
        )

    [2] => stdClass Object
        (
            [invoice_id] => 148
            [invoice_no] => TI-2026-0025
            [invoice_date] => 2026-08-17
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 19527.900
        )

    [3] => stdClass Object
        (
            [invoice_id] => 147
            [invoice_no] => TI-2026-0024
            [invoice_date] => 2026-08-17
            [grand_total] => 3412.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 9633.750
        )

    [4] => stdClass Object
        (
            [invoice_id] => 146
            [invoice_no] => TI-2026-0023
            [invoice_date] => 2026-08-17
            [grand_total] => 6825.00
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 5666.850
        )

    [5] => stdClass Object
        (
            [invoice_id] => 145
            [invoice_no] => TI-2026-0022
            [invoice_date] => 2026-08-06
            [grand_total] => 960.75
            [status] => 
            [customer_name] => immu
            [customer_phone] => 789654123
            [registration_no] => kl8020
            [chassis_no] => 
            [paid_amount] => 2560.400
        )

    [6] => stdClass Object
        (
            [invoice_id] => 144
            [invoice_no] => TI-2026-0021
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => chgjuk6y56
            [chassis_no] => 769780
            [paid_amount] => 3823.450
        )

    [7] => stdClass Object
        (
            [invoice_id] => 143
            [invoice_no] => TI-2026-0020
            [invoice_date] => 2026-08-12
            [grand_total] => 892.50
            [status] => 
            [customer_name] => test immu test
            [customer_phone] => 
            [registration_no] => 888
            [chassis_no] => 888888888
            [paid_amount] => 10923.400
        )

    [8] => stdClass Object
        (
            [invoice_id] => 142
            [invoice_no] => TI-2026-0019
            [invoice_date] => 2026-08-17
            [grand_total] => 483.00
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 14380.900
        )

    [9] => stdClass Object
        (
            [invoice_id] => 141
            [invoice_no] => TI-2026-0018
            [invoice_date] => 2026-08-14
            [grand_total] => 409.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 640.500
        )

    [10] => stdClass Object
        (
            [invoice_id] => 140
            [invoice_no] => TI-2026-0017
            [invoice_date] => 2026-08-14
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 7754.950
        )

    [11] => stdClass Object
        (
            [invoice_id] => 139
            [invoice_no] => TI-2026-0016
            [invoice_date] => 2026-08-13
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 3943.000
        )

    [12] => stdClass Object
        (
            [invoice_id] => 138
            [invoice_no] => TI-2026-0015
            [invoice_date] => 2026-08-13
            [grand_total] => 262.50
            [status] => Unpaid
            [customer_name] => test name
            [customer_phone] => 
            [registration_no] => QW 2345
            [chassis_no] => 123456
            [paid_amount] => 4470.250
        )

    [13] => stdClass Object
        (
            [invoice_id] => 137
            [invoice_no] => TI-2026-0014
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => ytttttttttttttttt
            [customer_phone] => 
            [registration_no] => fkj
            [chassis_no] => 
            [paid_amount] => 7358.000
        )

    [14] => stdClass Object
        (
            [invoice_id] => 136
            [invoice_no] => TI-2026-0013
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => ghdgfh
            [customer_phone] => 34546
            [registration_no] => dhgtht546
            [chassis_no] => 
            [paid_amount] => 3371.000
        )

    [15] => stdClass Object
        (
            [invoice_id] => 135
            [invoice_no] => TI-2026-0012
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => test new changhes
            [customer_phone] => 9495192262
            [registration_no] => KL8481
            [chassis_no] => 123458
            [paid_amount] => 5349.900
        )

    [16] => stdClass Object
        (
            [invoice_id] => 134
            [invoice_no] => TI-2026-0011
            [invoice_date] => 2026-08-08
            [grand_total] => 367.50
            [status] => 
            [customer_name] => ghdgfh
            [customer_phone] => 34546
            [registration_no] => dhgtht546
            [chassis_no] => 
            [paid_amount] => 1950.900
        )

    [17] => stdClass Object
        (
            [invoice_id] => 133
            [invoice_no] => TI-2026-0010
            [invoice_date] => 2026-08-08
            [grand_total] => 157.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 2495.850
        )

    [18] => stdClass Object
        (
            [invoice_id] => 132
            [invoice_no] => TI-2026-0009
            [invoice_date] => 2026-08-08
            [grand_total] => 367.50
            [status] => Unpaid
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 1501.500
        )

    [19] => stdClass Object
        (
            [invoice_id] => 131
            [invoice_no] => TI-2026-0008
            [invoice_date] => 2026-08-08
            [grand_total] => 1207.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 8172.150
        )

    [20] => stdClass Object
        (
            [invoice_id] => 130
            [invoice_no] => TI-2026-0007
            [invoice_date] => 2026-08-07
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => izzah
            [customer_phone] => 456987123
            [registration_no] => kl5792
            [chassis_no] => 
            [paid_amount] => 3631.950
        )

    [21] => stdClass Object
        (
            [invoice_id] => 129
            [invoice_no] => TI-2026-0006
            [invoice_date] => 2026-08-07
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => izzah
            [customer_phone] => 456987123
            [registration_no] => kl5792
            [chassis_no] => 
            [paid_amount] => 7395.150
        )

    [22] => stdClass Object
        (
            [invoice_id] => 128
            [invoice_no] => TI-2026-0005
            [invoice_date] => 2026-04-03
            [grand_total] => 3328.50
            [status] => Unpaid
            [customer_name] => Shenujith Padikkal Raghavan Murukoly
            [customer_phone] => +971503667526
            [registration_no] => EE49796
            [chassis_no] => WDCTG5CB8HJ351452
            [paid_amount] => 1501.500
        )

    [23] => stdClass Object
        (
            [invoice_id] => 127
            [invoice_no] => TI-2026-0004
            [invoice_date] => 2026-04-24
            [grand_total] => 2111.55
            [status] => Unpaid
            [customer_name] => test
            [customer_phone] => 45345
            [registration_no] => asdasf
            [chassis_no] => 345346
            [paid_amount] => 2495.850
        )

    [24] => stdClass Object
        (
            [invoice_id] => 126
            [invoice_no] => TI-2026-0003
            [invoice_date] => 2026-03-28
            [grand_total] => 5185.95
            [status] => Unpaid
            [customer_name] => Sandesh Sasikumar
            [customer_phone] => 971529031946
            [registration_no] => W63879
            [chassis_no] => 1FA6P8TH9G5275052
            [paid_amount] => 1310.400
        )

    [25] => stdClass Object
        (
            [invoice_id] => 125
            [invoice_no] => TI-2026-0002
            [invoice_date] => 2026-05-13
            [grand_total] => 2173.50
            [status] => Unpaid
            [customer_name] => Test 999
            [customer_phone] => 999999
            [registration_no] => a12345
            [chassis_no] => dsfdsgsdg
            [paid_amount] => 1003.950
        )

    [26] => stdClass Object
        (
            [invoice_id] => 124
            [invoice_no] => TI-2026-0001
            [invoice_date] => 2026-04-03
            [grand_total] => 6620.25
            [status] => 
            [customer_name] => Aginco General Trading LLC
            [customer_phone] => 971544238210
            [registration_no] => DD41617
            [chassis_no] => MNTBB7A97F6020494
            [paid_amount] => 2605.500
        )

)

ERROR - 2026-08-22 11:27:36 --> 160
ERROR - 2026-08-22 11:28:14 --> 160
ERROR - 2026-08-22 11:28:35 --> 160
ERROR - 2026-08-22 11:44:47 --> Today Attendance Records: Array
(
    [0] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 8
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Jamaica Viernes mk
            [created_by_user] => 
        )

    [1] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 13
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Kishen Vijayan
            [created_by_user] => 
        )

    [2] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 9
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Madiwadanan Sembaganathan
            [created_by_user] => 
        )

    [3] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 14
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Mohammad Anowar Hossain
            [created_by_user] => 
        )

    [4] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 15
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => newemp11
            [created_by_user] => 
        )

    [5] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 11
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Prasanga Rijman Perera Liyanage
            [created_by_user] => 
        )

    [6] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 7
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Richard Zon Pineda
            [created_by_user] => 
        )

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 10
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Ruchira Nadeesha Adikari Appuhamilage
            [created_by_user] => 
        )

    [8] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 12
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Test employee
            [created_by_user] => 
        )

    [9] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 17
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => test employee 101
            [created_by_user] => 
        )

    [10] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 18
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => ttttt
            [created_by_user] => 
        )

)

ERROR - 2026-08-22 11:44:47 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [branch_id] => 2
            [employee_code] => 
            [employee_name] => Jamaica Viernes mk
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:29:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 17:20:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:40:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 14:47:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 15
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => newemp11
            [mobile] => 
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-05-04 22:56:29
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [5] => stdClass Object
        (
            [employee_id] => 11
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:55:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [6] => stdClass Object
        (
            [employee_id] => 7
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 12:25:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [7] => stdClass Object
        (
            [employee_id] => 10
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:49:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [8] => stdClass Object
        (
            [employee_id] => 12
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Test employee
            [mobile] => 56546
            [email] => test@gmail.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 5
            [role] => Technician
            [software_access] => No
            [joining_date] => 2026-03-01
            [status] => Active
            [created_at] => 2026-03-17 14:32:29
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [9] => stdClass Object
        (
            [employee_id] => 17
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => test employee 101
            [mobile] => 98765544
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-05-05 13:21:13
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [10] => stdClass Object
        (
            [employee_id] => 18
            [branch_id] => 3
            [employee_code] => 
            [employee_name] => ttttt
            [mobile] => 
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-08-13 11:57:29
            [department_name] => OFFICE
            [designation_name] => Admin
        )

)

ERROR - 2026-08-22 11:54:58 --> Today Attendance Records: Array
(
    [0] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 8
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Jamaica Viernes mk
            [created_by_user] => 
        )

    [1] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 13
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Kishen Vijayan
            [created_by_user] => 
        )

    [2] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 9
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Madiwadanan Sembaganathan
            [created_by_user] => 
        )

    [3] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 14
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Mohammad Anowar Hossain
            [created_by_user] => 
        )

    [4] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 15
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => newemp11
            [created_by_user] => 
        )

    [5] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 11
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Prasanga Rijman Perera Liyanage
            [created_by_user] => 
        )

    [6] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 7
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Richard Zon Pineda
            [created_by_user] => 
        )

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 10
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Ruchira Nadeesha Adikari Appuhamilage
            [created_by_user] => 
        )

    [8] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 12
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Test employee
            [created_by_user] => 
        )

    [9] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 17
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => test employee 101
            [created_by_user] => 
        )

    [10] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 18
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => ttttt
            [created_by_user] => 
        )

)

ERROR - 2026-08-22 11:54:58 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [branch_id] => 2
            [employee_code] => 
            [employee_name] => Jamaica Viernes mk
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:29:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 17:20:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:40:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 14:47:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 15
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => newemp11
            [mobile] => 
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-05-04 22:56:29
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [5] => stdClass Object
        (
            [employee_id] => 11
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:55:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [6] => stdClass Object
        (
            [employee_id] => 7
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 12:25:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [7] => stdClass Object
        (
            [employee_id] => 10
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:49:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [8] => stdClass Object
        (
            [employee_id] => 12
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Test employee
            [mobile] => 56546
            [email] => test@gmail.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 5
            [role] => Technician
            [software_access] => No
            [joining_date] => 2026-03-01
            [status] => Active
            [created_at] => 2026-03-17 14:32:29
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [9] => stdClass Object
        (
            [employee_id] => 17
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => test employee 101
            [mobile] => 98765544
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-05-05 13:21:13
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [10] => stdClass Object
        (
            [employee_id] => 18
            [branch_id] => 3
            [employee_code] => 
            [employee_name] => ttttt
            [mobile] => 
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-08-13 11:57:29
            [department_name] => OFFICE
            [designation_name] => Admin
        )

)

ERROR - 2026-08-22 11:55:17 --> Today Attendance Records: Array
(
    [0] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 8
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Jamaica Viernes mk
            [created_by_user] => 
        )

    [1] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 13
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Kishen Vijayan
            [created_by_user] => 
        )

    [2] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 9
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Madiwadanan Sembaganathan
            [created_by_user] => 
        )

    [3] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 14
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Mohammad Anowar Hossain
            [created_by_user] => 
        )

    [4] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 15
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => newemp11
            [created_by_user] => 
        )

    [5] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 11
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Prasanga Rijman Perera Liyanage
            [created_by_user] => 
        )

    [6] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 7
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Richard Zon Pineda
            [created_by_user] => 
        )

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 10
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Ruchira Nadeesha Adikari Appuhamilage
            [created_by_user] => 
        )

    [8] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 12
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Test employee
            [created_by_user] => 
        )

    [9] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 17
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => test employee 101
            [created_by_user] => 
        )

    [10] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 18
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => ttttt
            [created_by_user] => 
        )

)

ERROR - 2026-08-22 11:55:17 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [branch_id] => 2
            [employee_code] => 
            [employee_name] => Jamaica Viernes mk
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:29:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 17:20:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:40:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 14:47:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 15
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => newemp11
            [mobile] => 
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-05-04 22:56:29
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [5] => stdClass Object
        (
            [employee_id] => 11
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:55:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [6] => stdClass Object
        (
            [employee_id] => 7
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 12:25:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [7] => stdClass Object
        (
            [employee_id] => 10
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:49:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [8] => stdClass Object
        (
            [employee_id] => 12
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Test employee
            [mobile] => 56546
            [email] => test@gmail.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 5
            [role] => Technician
            [software_access] => No
            [joining_date] => 2026-03-01
            [status] => Active
            [created_at] => 2026-03-17 14:32:29
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [9] => stdClass Object
        (
            [employee_id] => 17
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => test employee 101
            [mobile] => 98765544
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-05-05 13:21:13
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [10] => stdClass Object
        (
            [employee_id] => 18
            [branch_id] => 3
            [employee_code] => 
            [employee_name] => ttttt
            [mobile] => 
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-08-13 11:57:29
            [department_name] => OFFICE
            [designation_name] => Admin
        )

)

ERROR - 2026-08-22 11:56:35 --> Today Attendance Records: Array
(
    [0] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 8
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Jamaica Viernes mk
            [created_by_user] => 
        )

    [1] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 13
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Kishen Vijayan
            [created_by_user] => 
        )

    [2] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 9
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Madiwadanan Sembaganathan
            [created_by_user] => 
        )

    [3] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 14
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Mohammad Anowar Hossain
            [created_by_user] => 
        )

    [4] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 15
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => newemp11
            [created_by_user] => 
        )

    [5] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 11
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Prasanga Rijman Perera Liyanage
            [created_by_user] => 
        )

    [6] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 7
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Richard Zon Pineda
            [created_by_user] => 
        )

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 10
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Ruchira Nadeesha Adikari Appuhamilage
            [created_by_user] => 
        )

    [8] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 12
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => Test employee
            [created_by_user] => 
        )

    [9] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 17
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => test employee 101
            [created_by_user] => 
        )

    [10] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 18
            [attendence] => 
            [in_time] => 
            [out_time] => 
            [Attendance_date] => 
            [remark] => 
            [created_by] => 
            [created_date] => 
            [use_paid_leave] => 
            [ivms_id] => 
            [type] => 
            [name] => ttttt
            [created_by_user] => 
        )

)

ERROR - 2026-08-22 11:56:35 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [branch_id] => 2
            [employee_code] => 
            [employee_name] => Jamaica Viernes mk
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:29:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 17:20:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:40:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 14:47:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 15
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => newemp11
            [mobile] => 
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-05-04 22:56:29
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [5] => stdClass Object
        (
            [employee_id] => 11
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:55:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [6] => stdClass Object
        (
            [employee_id] => 7
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 12:25:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [7] => stdClass Object
        (
            [employee_id] => 10
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 12:49:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [8] => stdClass Object
        (
            [employee_id] => 12
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => Test employee
            [mobile] => 56546
            [email] => test@gmail.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 5
            [role] => Technician
            [software_access] => No
            [joining_date] => 2026-03-01
            [status] => Active
            [created_at] => 2026-03-17 14:32:29
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [9] => stdClass Object
        (
            [employee_id] => 17
            [branch_id] => 1
            [employee_code] => 
            [employee_name] => test employee 101
            [mobile] => 98765544
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-05-05 13:21:13
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [10] => stdClass Object
        (
            [employee_id] => 18
            [branch_id] => 3
            [employee_code] => 
            [employee_name] => ttttt
            [mobile] => 
            [email] => 
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-08-13 11:57:29
            [department_name] => OFFICE
            [designation_name] => Admin
        )

)

ERROR - 2026-08-22 13:44:16 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [invoice_id] => 150
            [invoice_no] => TI-2026-0027
            [invoice_date] => 2025-06-04
            [grand_total] => 12600.00
            [status] => Partially Paid
            [customer_name] => fleet dub
            [customer_phone] => 789654123
            [registration_no] => KL 98596
            [chassis_no] => 43343545
            [paid_amount] => 8682.450
        )

    [1] => stdClass Object
        (
            [invoice_id] => 149
            [invoice_no] => TI-2026-0026
            [invoice_date] => 2026-08-17
            [grand_total] => 3412.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 5156.950
        )

    [2] => stdClass Object
        (
            [invoice_id] => 148
            [invoice_no] => TI-2026-0025
            [invoice_date] => 2026-08-17
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 19527.900
        )

    [3] => stdClass Object
        (
            [invoice_id] => 147
            [invoice_no] => TI-2026-0024
            [invoice_date] => 2026-08-17
            [grand_total] => 3412.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 9633.750
        )

    [4] => stdClass Object
        (
            [invoice_id] => 146
            [invoice_no] => TI-2026-0023
            [invoice_date] => 2026-08-17
            [grand_total] => 6825.00
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 5666.850
        )

    [5] => stdClass Object
        (
            [invoice_id] => 145
            [invoice_no] => TI-2026-0022
            [invoice_date] => 2026-08-06
            [grand_total] => 960.75
            [status] => 
            [customer_name] => immu
            [customer_phone] => 789654123
            [registration_no] => kl8020
            [chassis_no] => 
            [paid_amount] => 2560.400
        )

    [6] => stdClass Object
        (
            [invoice_id] => 144
            [invoice_no] => TI-2026-0021
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => chgjuk6y56
            [chassis_no] => 769780
            [paid_amount] => 3823.450
        )

    [7] => stdClass Object
        (
            [invoice_id] => 143
            [invoice_no] => TI-2026-0020
            [invoice_date] => 2026-08-12
            [grand_total] => 892.50
            [status] => 
            [customer_name] => test immu test
            [customer_phone] => 
            [registration_no] => 888
            [chassis_no] => 888888888
            [paid_amount] => 10923.400
        )

    [8] => stdClass Object
        (
            [invoice_id] => 142
            [invoice_no] => TI-2026-0019
            [invoice_date] => 2026-08-17
            [grand_total] => 483.00
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 14380.900
        )

    [9] => stdClass Object
        (
            [invoice_id] => 141
            [invoice_no] => TI-2026-0018
            [invoice_date] => 2026-08-14
            [grand_total] => 409.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 640.500
        )

    [10] => stdClass Object
        (
            [invoice_id] => 140
            [invoice_no] => TI-2026-0017
            [invoice_date] => 2026-08-14
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 7754.950
        )

    [11] => stdClass Object
        (
            [invoice_id] => 139
            [invoice_no] => TI-2026-0016
            [invoice_date] => 2026-08-13
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 3943.000
        )

    [12] => stdClass Object
        (
            [invoice_id] => 138
            [invoice_no] => TI-2026-0015
            [invoice_date] => 2026-08-13
            [grand_total] => 262.50
            [status] => Unpaid
            [customer_name] => test name
            [customer_phone] => 
            [registration_no] => QW 2345
            [chassis_no] => 123456
            [paid_amount] => 4470.250
        )

    [13] => stdClass Object
        (
            [invoice_id] => 137
            [invoice_no] => TI-2026-0014
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => ytttttttttttttttt
            [customer_phone] => 
            [registration_no] => fkj
            [chassis_no] => 
            [paid_amount] => 7358.000
        )

    [14] => stdClass Object
        (
            [invoice_id] => 136
            [invoice_no] => TI-2026-0013
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => ghdgfh
            [customer_phone] => 34546
            [registration_no] => dhgtht546
            [chassis_no] => 
            [paid_amount] => 3371.000
        )

    [15] => stdClass Object
        (
            [invoice_id] => 135
            [invoice_no] => TI-2026-0012
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => test new changhes
            [customer_phone] => 9495192262
            [registration_no] => KL8481
            [chassis_no] => 123458
            [paid_amount] => 5349.900
        )

    [16] => stdClass Object
        (
            [invoice_id] => 134
            [invoice_no] => TI-2026-0011
            [invoice_date] => 2026-08-08
            [grand_total] => 367.50
            [status] => 
            [customer_name] => ghdgfh
            [customer_phone] => 34546
            [registration_no] => dhgtht546
            [chassis_no] => 
            [paid_amount] => 1950.900
        )

    [17] => stdClass Object
        (
            [invoice_id] => 133
            [invoice_no] => TI-2026-0010
            [invoice_date] => 2026-08-08
            [grand_total] => 157.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 2495.850
        )

    [18] => stdClass Object
        (
            [invoice_id] => 132
            [invoice_no] => TI-2026-0009
            [invoice_date] => 2026-08-08
            [grand_total] => 367.50
            [status] => Unpaid
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 1501.500
        )

    [19] => stdClass Object
        (
            [invoice_id] => 131
            [invoice_no] => TI-2026-0008
            [invoice_date] => 2026-08-08
            [grand_total] => 1207.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 8172.150
        )

    [20] => stdClass Object
        (
            [invoice_id] => 130
            [invoice_no] => TI-2026-0007
            [invoice_date] => 2026-08-07
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => izzah
            [customer_phone] => 456987123
            [registration_no] => kl5792
            [chassis_no] => 
            [paid_amount] => 3631.950
        )

    [21] => stdClass Object
        (
            [invoice_id] => 129
            [invoice_no] => TI-2026-0006
            [invoice_date] => 2026-08-07
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => izzah
            [customer_phone] => 456987123
            [registration_no] => kl5792
            [chassis_no] => 
            [paid_amount] => 7395.150
        )

    [22] => stdClass Object
        (
            [invoice_id] => 128
            [invoice_no] => TI-2026-0005
            [invoice_date] => 2026-04-03
            [grand_total] => 3328.50
            [status] => Unpaid
            [customer_name] => Shenujith Padikkal Raghavan Murukoly
            [customer_phone] => +971503667526
            [registration_no] => EE49796
            [chassis_no] => WDCTG5CB8HJ351452
            [paid_amount] => 1501.500
        )

    [23] => stdClass Object
        (
            [invoice_id] => 127
            [invoice_no] => TI-2026-0004
            [invoice_date] => 2026-04-24
            [grand_total] => 2111.55
            [status] => Unpaid
            [customer_name] => test
            [customer_phone] => 45345
            [registration_no] => asdasf
            [chassis_no] => 345346
            [paid_amount] => 2495.850
        )

    [24] => stdClass Object
        (
            [invoice_id] => 126
            [invoice_no] => TI-2026-0003
            [invoice_date] => 2026-03-28
            [grand_total] => 5185.95
            [status] => Unpaid
            [customer_name] => Sandesh Sasikumar
            [customer_phone] => 971529031946
            [registration_no] => W63879
            [chassis_no] => 1FA6P8TH9G5275052
            [paid_amount] => 1310.400
        )

    [25] => stdClass Object
        (
            [invoice_id] => 125
            [invoice_no] => TI-2026-0002
            [invoice_date] => 2026-05-13
            [grand_total] => 2173.50
            [status] => Unpaid
            [customer_name] => Test 999
            [customer_phone] => 999999
            [registration_no] => a12345
            [chassis_no] => dsfdsgsdg
            [paid_amount] => 1003.950
        )

    [26] => stdClass Object
        (
            [invoice_id] => 124
            [invoice_no] => TI-2026-0001
            [invoice_date] => 2026-04-03
            [grand_total] => 6620.25
            [status] => 
            [customer_name] => Aginco General Trading LLC
            [customer_phone] => 971544238210
            [registration_no] => DD41617
            [chassis_no] => MNTBB7A97F6020494
            [paid_amount] => 2605.500
        )

)

ERROR - 2026-08-22 12:14:19 --> 160
ERROR - 2026-08-22 12:15:05 --> 160
ERROR - 2026-08-22 15:00:38 --> Severity: error --> Exception: syntax error, unexpected '<', expecting end of file C:\xampp\htdocs\gms\application\views\includes\topbar.php 68
ERROR - 2026-08-22 15:00:45 --> Severity: error --> Exception: syntax error, unexpected '<', expecting end of file C:\xampp\htdocs\gms\application\views\includes\topbar.php 68
ERROR - 2026-08-22 15:00:48 --> Severity: error --> Exception: syntax error, unexpected '<', expecting end of file C:\xampp\htdocs\gms\application\views\includes\topbar.php 68
ERROR - 2026-08-22 15:00:51 --> Severity: error --> Exception: syntax error, unexpected '<', expecting end of file C:\xampp\htdocs\gms\application\views\includes\topbar.php 68
ERROR - 2026-08-22 15:00:51 --> Severity: error --> Exception: syntax error, unexpected '<', expecting end of file C:\xampp\htdocs\gms\application\views\includes\topbar.php 68
ERROR - 2026-08-22 15:01:00 --> Severity: error --> Exception: syntax error, unexpected '<', expecting end of file C:\xampp\htdocs\gms\application\views\includes\topbar.php 68
ERROR - 2026-08-22 15:01:08 --> Severity: error --> Exception: syntax error, unexpected '<', expecting end of file C:\xampp\htdocs\gms\application\views\includes\topbar.php 68
ERROR - 2026-08-22 15:01:20 --> Severity: error --> Exception: syntax error, unexpected '<', expecting end of file C:\xampp\htdocs\gms\application\views\includes\topbar.php 68
ERROR - 2026-08-22 15:01:32 --> Severity: error --> Exception: syntax error, unexpected '<', expecting end of file C:\xampp\htdocs\gms\application\views\includes\topbar.php 68
ERROR - 2026-08-22 15:03:37 --> Severity: error --> Exception: syntax error, unexpected '<', expecting end of file C:\xampp\htdocs\gms\application\views\includes\topbar.php 68
ERROR - 2026-08-22 16:41:09 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [invoice_id] => 150
            [invoice_no] => TI-2026-0027
            [invoice_date] => 2025-06-04
            [grand_total] => 12600.00
            [status] => Partially Paid
            [customer_name] => fleet dub
            [customer_phone] => 789654123
            [registration_no] => KL 98596
            [chassis_no] => 43343545
            [paid_amount] => 8682.450
        )

    [1] => stdClass Object
        (
            [invoice_id] => 149
            [invoice_no] => TI-2026-0026
            [invoice_date] => 2026-08-17
            [grand_total] => 3412.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 5156.950
        )

    [2] => stdClass Object
        (
            [invoice_id] => 148
            [invoice_no] => TI-2026-0025
            [invoice_date] => 2026-08-17
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 19527.900
        )

    [3] => stdClass Object
        (
            [invoice_id] => 147
            [invoice_no] => TI-2026-0024
            [invoice_date] => 2026-08-17
            [grand_total] => 3412.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 9633.750
        )

    [4] => stdClass Object
        (
            [invoice_id] => 146
            [invoice_no] => TI-2026-0023
            [invoice_date] => 2026-08-17
            [grand_total] => 6825.00
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 5666.850
        )

    [5] => stdClass Object
        (
            [invoice_id] => 145
            [invoice_no] => TI-2026-0022
            [invoice_date] => 2026-08-06
            [grand_total] => 960.75
            [status] => 
            [customer_name] => immu
            [customer_phone] => 789654123
            [registration_no] => kl8020
            [chassis_no] => 
            [paid_amount] => 2560.400
        )

    [6] => stdClass Object
        (
            [invoice_id] => 144
            [invoice_no] => TI-2026-0021
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => chgjuk6y56
            [chassis_no] => 769780
            [paid_amount] => 3823.450
        )

    [7] => stdClass Object
        (
            [invoice_id] => 143
            [invoice_no] => TI-2026-0020
            [invoice_date] => 2026-08-12
            [grand_total] => 892.50
            [status] => 
            [customer_name] => test immu test
            [customer_phone] => 
            [registration_no] => 888
            [chassis_no] => 888888888
            [paid_amount] => 10923.400
        )

    [8] => stdClass Object
        (
            [invoice_id] => 142
            [invoice_no] => TI-2026-0019
            [invoice_date] => 2026-08-17
            [grand_total] => 483.00
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 14380.900
        )

    [9] => stdClass Object
        (
            [invoice_id] => 141
            [invoice_no] => TI-2026-0018
            [invoice_date] => 2026-08-14
            [grand_total] => 409.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 640.500
        )

    [10] => stdClass Object
        (
            [invoice_id] => 140
            [invoice_no] => TI-2026-0017
            [invoice_date] => 2026-08-14
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet new user
            [customer_phone] => 
            [registration_no] => 7896
            [chassis_no] => 3333333
            [paid_amount] => 7754.950
        )

    [11] => stdClass Object
        (
            [invoice_id] => 139
            [invoice_no] => TI-2026-0016
            [invoice_date] => 2026-08-13
            [grand_total] => 157.50
            [status] => 
            [customer_name] => fleet test fleet ff
            [customer_phone] => 
            [registration_no] => test main 1234
            [chassis_no] => 5434636
            [paid_amount] => 3943.000
        )

    [12] => stdClass Object
        (
            [invoice_id] => 138
            [invoice_no] => TI-2026-0015
            [invoice_date] => 2026-08-13
            [grand_total] => 262.50
            [status] => Unpaid
            [customer_name] => test name
            [customer_phone] => 
            [registration_no] => QW 2345
            [chassis_no] => 123456
            [paid_amount] => 4470.250
        )

    [13] => stdClass Object
        (
            [invoice_id] => 137
            [invoice_no] => TI-2026-0014
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => ytttttttttttttttt
            [customer_phone] => 
            [registration_no] => fkj
            [chassis_no] => 
            [paid_amount] => 7358.000
        )

    [14] => stdClass Object
        (
            [invoice_id] => 136
            [invoice_no] => TI-2026-0013
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => ghdgfh
            [customer_phone] => 34546
            [registration_no] => dhgtht546
            [chassis_no] => 
            [paid_amount] => 3371.000
        )

    [15] => stdClass Object
        (
            [invoice_id] => 135
            [invoice_no] => TI-2026-0012
            [invoice_date] => 2026-08-08
            [grand_total] => 892.50
            [status] => 
            [customer_name] => test new changhes
            [customer_phone] => 9495192262
            [registration_no] => KL8481
            [chassis_no] => 123458
            [paid_amount] => 5349.900
        )

    [16] => stdClass Object
        (
            [invoice_id] => 134
            [invoice_no] => TI-2026-0011
            [invoice_date] => 2026-08-08
            [grand_total] => 367.50
            [status] => 
            [customer_name] => ghdgfh
            [customer_phone] => 34546
            [registration_no] => dhgtht546
            [chassis_no] => 
            [paid_amount] => 1950.900
        )

    [17] => stdClass Object
        (
            [invoice_id] => 133
            [invoice_no] => TI-2026-0010
            [invoice_date] => 2026-08-08
            [grand_total] => 157.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 2495.850
        )

    [18] => stdClass Object
        (
            [invoice_id] => 132
            [invoice_no] => TI-2026-0009
            [invoice_date] => 2026-08-08
            [grand_total] => 367.50
            [status] => Unpaid
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 1501.500
        )

    [19] => stdClass Object
        (
            [invoice_id] => 131
            [invoice_no] => TI-2026-0008
            [invoice_date] => 2026-08-08
            [grand_total] => 1207.50
            [status] => 
            [customer_name] => tiins
            [customer_phone] => 54647865875
            [registration_no] => xghf5657
            [chassis_no] => 785745
            [paid_amount] => 8172.150
        )

    [20] => stdClass Object
        (
            [invoice_id] => 130
            [invoice_no] => TI-2026-0007
            [invoice_date] => 2026-08-07
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => izzah
            [customer_phone] => 456987123
            [registration_no] => kl5792
            [chassis_no] => 
            [paid_amount] => 3631.950
        )

    [21] => stdClass Object
        (
            [invoice_id] => 129
            [invoice_no] => TI-2026-0006
            [invoice_date] => 2026-08-07
            [grand_total] => 892.50
            [status] => Unpaid
            [customer_name] => izzah
            [customer_phone] => 456987123
            [registration_no] => kl5792
            [chassis_no] => 
            [paid_amount] => 7395.150
        )

    [22] => stdClass Object
        (
            [invoice_id] => 128
            [invoice_no] => TI-2026-0005
            [invoice_date] => 2026-04-03
            [grand_total] => 3328.50
            [status] => Unpaid
            [customer_name] => Shenujith Padikkal Raghavan Murukoly
            [customer_phone] => +971503667526
            [registration_no] => EE49796
            [chassis_no] => WDCTG5CB8HJ351452
            [paid_amount] => 1501.500
        )

    [23] => stdClass Object
        (
            [invoice_id] => 127
            [invoice_no] => TI-2026-0004
            [invoice_date] => 2026-04-24
            [grand_total] => 2111.55
            [status] => Unpaid
            [customer_name] => test
            [customer_phone] => 45345
            [registration_no] => asdasf
            [chassis_no] => 345346
            [paid_amount] => 2495.850
        )

    [24] => stdClass Object
        (
            [invoice_id] => 126
            [invoice_no] => TI-2026-0003
            [invoice_date] => 2026-03-28
            [grand_total] => 5185.95
            [status] => Unpaid
            [customer_name] => Sandesh Sasikumar
            [customer_phone] => 971529031946
            [registration_no] => W63879
            [chassis_no] => 1FA6P8TH9G5275052
            [paid_amount] => 1310.400
        )

    [25] => stdClass Object
        (
            [invoice_id] => 125
            [invoice_no] => TI-2026-0002
            [invoice_date] => 2026-05-13
            [grand_total] => 2173.50
            [status] => Unpaid
            [customer_name] => Test 999
            [customer_phone] => 999999
            [registration_no] => a12345
            [chassis_no] => dsfdsgsdg
            [paid_amount] => 1003.950
        )

    [26] => stdClass Object
        (
            [invoice_id] => 124
            [invoice_no] => TI-2026-0001
            [invoice_date] => 2026-04-03
            [grand_total] => 6620.25
            [status] => 
            [customer_name] => Aginco General Trading LLC
            [customer_phone] => 971544238210
            [registration_no] => DD41617
            [chassis_no] => MNTBB7A97F6020494
            [paid_amount] => 2605.500
        )

)

ERROR - 2026-08-22 15:11:12 --> 160
ERROR - 2026-08-22 15:11:17 --> 160
ERROR - 2026-08-22 16:42:25 --> Jobcard Data: stdClass Object
(
    [jobcard_id] => 181
    [jobcard_no] => JC-2026-0032
    [estimation_id] => 341
    [appointment_id] => 
    [customer_id] => 566
    [vehicle_id] => 703
    [jobcard_date] => 2026-04-23
    [jobcard_time] => 00:00:00
    [km_in] => 0
    [expected_delivery_date] => 0000-00-00
    [completion_time] => 00:00:00
    [technician_id] => 
    [status] => In Progress
    [remarks] => 
    [subtotal] => 1113.00
    [tax_percent] => 0.00
    [tax_amount] => 55.65
    [discount] => 0.00
    [grand_total] => 1168.65
    [created_by] => 6
    [created_at] => 2026-04-23 15:29:18
    [quotation_id] => 134
    [branch_id] => 1
    [quotation_no] => QT-2026-0038
    [quotation_date] => 2026-04-23
    [quotation_subtotal] => 1113.00
    [quotation_tax] => 55.65
    [quotation_discount] => 0.00
    [quotation_grand_total] => 1168.65
    [quotation_status] => Approved
    [sdiscount] => 0.00
    [subdiscount] => 0.00
    [customer_name] => test customer26
    [customer_phone] => 9865320147
    [customer_email] => test@gmail.com
    [customer_trn] => 
    [cistomer_address] => test address
    [customer_emirates] => Dubai
    [registration_no] => b 7676
    [brand] => Hummer
    [model] => H3
    [variant] => diesel
    [year] => 2020
    [chassis_no] => 98653201478
    [engine_no] => 1010101010
    [services] => Array
        (
            [0] => stdClass Object
                (
                    [id] => 812
                    [service_id] => 2
                    [total_cost] => 120.00
                    [discount_amount] => 0.00
                    [service_name] => Full Vehicle Inspection
                    [service_type] => SERVICE
                )

            [1] => stdClass Object
                (
                    [id] => 811
                    [service_id] => 7
                    [total_cost] => 50.00
                    [discount_amount] => 0.00
                    [service_name] => Battery Replacement
                    [service_type] => SERVICE
                )

            [2] => stdClass Object
                (
                    [id] => 810
                    [service_id] => 12
                    [total_cost] => 40.00
                    [discount_amount] => 0.00
                    [service_name] => Car Wash & Interior Cleaning
                    [service_type] => SERVICE
                )

            [3] => stdClass Object
                (
                    [id] => 809
                    [service_id] => 14
                    [total_cost] => 850.00
                    [discount_amount] => 0.00
                    [service_name] => Timing Belt Replacement
                    [service_type] => SERVICE
                )

        )

    [parts] => Array
        (
        )

    [descriptions] => Array
        (
        )

    [total_advance] => 510
    [used_advance] => 0
    [available_advance] => 510
    [fully_invoiced] => 
)

ERROR - 2026-08-22 15:12:25 --> 134
ERROR - 2026-08-22 15:15:39 --> Query error: Column 'company_id' in field list is ambiguous - Invalid query: SELECT `fy`.*, `u`.`username` AS `closed_by_name`, `company_id`
FROM (`financial_years` `fy`, `branches`)
LEFT JOIN `users` `u` ON `u`.`id` = `fy`.`closed_by`
WHERE `is_active` = 1
ORDER BY `is_main_branch` DESC, `branch_id` ASC
 LIMIT 1
