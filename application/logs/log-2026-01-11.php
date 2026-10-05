ERROR - 2026-01-11 18:31:28 --> --- update_controller called ---
ERROR - 2026-01-11 18:31:28 --> POST DATA: Array
(
    [jobcard_id] => 83
    [service_name] => Array
        (
            [0] => 6
            [1] => 11
        )

    [service_amt] => Array
        (
            [0] => 180.00
            [1] => 180.00
        )

    [technician_id] => Array
        (
            [0] => 1
            [1] => 2
        )

    [part_type] => Array
        (
            [0] => New Parts
            [1] => Aftermarket Parts
            [2] => Used Parts
        )

    [part_qty] => Array
        (
            [0] => 1
            [1] => 1
            [2] => 1
        )

    [part_sellprice] => Array
        (
            [0] => 320.00
            [1] => 150.00
            [2] => 180.00
        )

    [part_disamt] => Array
        (
            [0] => 0.00
            [1] => 0.00
            [2] => 0.00
        )

    [part_totalprice] => Array
        (
            [0] => 320.00
            [1] => 150.00
            [2] => 180.00
        )

    [sublet] => Array
        (
            [0] => sdfsfsdf
        )

    [jobservice_amt] => Array
        (
            [0] => 345
        )

)

ERROR - 2026-01-11 18:31:28 --> --- update_services called ---
ERROR - 2026-01-11 18:31:28 --> Jobcard ID: 83
ERROR - 2026-01-11 18:31:28 --> Service IDs: Array
(
    [0] => 6
    [1] => 11
)

ERROR - 2026-01-11 18:31:28 --> Technician IDs: Array
(
    [0] => 1
    [1] => 2
)

ERROR - 2026-01-11 18:34:55 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 18:34:58 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 18:35:02 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 18:35:06 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 18:49:15 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 18:58:47 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 18:58:47 --> Query error: Unknown column 'jobcard_description_id' in 'field list' - Invalid query: SELECT `w`.`jobcard_description_id`, `w`.`status`
FROM `jobcard_work_logs` `w`
JOIN (SELECT `jobcard_description_id`, MAX(log_time) as last_time
FROM `jobcard_work_logs`
WHERE `jobcard_id` = '83'
GROUP BY `jobcard_description_id`) t ON `w`.`jobcard_description_id` = `t`.`jobcard_description_id` AND `w`.`log_time` = `t`.`last_time`
ERROR - 2026-01-11 18:59:02 --> Query error: Unknown column 'jobcard_description_id' in 'field list' - Invalid query: 
    SELECT
        jc.jobcard_id,
        jc.jobcard_no,

        COUNT(DISTINCT jd.jobcard_description_id) AS total_jobs,

        SUM(
            CASE
                -- COMPLETED JOB
                WHEN stop_log.jobcard_description_id IS NOT NULL THEN 100

                -- RUNNING JOB
                WHEN start_log.jobcard_description_id IS NOT NULL THEN
                    LEAST(
                        (IFNULL(running_minutes.minutes, 0) / 60) * 100,
                        99
                    )

                -- NOT STARTED
                ELSE 0
            END
        ) AS total_progress
    FROM job_cards jc
    LEFT JOIN jobcard_descriptions jd
        ON jd.jobcard_id = jc.jobcard_id

    -- STOP LOG
    LEFT JOIN (
        SELECT DISTINCT jobcard_description_id
        FROM jobcard_work_logs
        WHERE status = 'STOP'
    ) stop_log
        ON stop_log.jobcard_description_id = jd.jobcard_description_id

    -- START / RESUME EXISTENCE
    LEFT JOIN (
        SELECT DISTINCT jobcard_description_id
        FROM jobcard_work_logs
        WHERE status IN ('START','RESUME')
    ) start_log
        ON start_log.jobcard_description_id = jd.jobcard_description_id

    -- RUNNING TIME (no STOP yet)
    LEFT JOIN (
        SELECT
            wl.jobcard_description_id,
            SUM(
                TIMESTAMPDIFF(
                    MINUTE,
                    wl.log_time,
                    NOW()
                )
            ) AS minutes
        FROM jobcard_work_logs wl
        WHERE wl.status IN ('START','RESUME')
          AND NOT EXISTS (
              SELECT 1 FROM jobcard_work_logs s
              WHERE s.jobcard_description_id = wl.jobcard_description_id
                AND s.status = 'STOP'
          )
        GROUP BY wl.jobcard_description_id
    ) running_minutes
        ON running_minutes.jobcard_description_id = jd.jobcard_description_id

    GROUP BY jc.jobcard_id
    ORDER BY jc.created_at DESC
    
ERROR - 2026-01-11 19:02:21 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 19:02:21 --> Query error: Unknown column 'jobcard_description_id' in 'field list' - Invalid query: SELECT `w`.`jobcard_description_id`, `w`.`status`
FROM `jobcard_work_logs` `w`
JOIN (SELECT `jobcard_description_id`, MAX(log_time) as last_time
FROM `jobcard_work_logs`
WHERE `jobcard_id` = '83'
GROUP BY `jobcard_description_id`) t ON `w`.`jobcard_description_id` = `t`.`jobcard_description_id` AND `w`.`log_time` = `t`.`last_time`
ERROR - 2026-01-11 19:04:44 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 19:04:44 --> Query error: Unknown column 'jobcard_description_id' in 'field list' - Invalid query: SELECT `w`.`jobcard_description_id`, `w`.`status`
FROM `jobcard_work_logs` `w`
JOIN (SELECT `jobcard_description_id`, MAX(log_time) as last_time
FROM `jobcard_work_logs`
WHERE `jobcard_id` = '83'
GROUP BY `jobcard_description_id`) t ON `w`.`jobcard_description_id` = `t`.`jobcard_description_id` AND `w`.`log_time` = `t`.`last_time`
ERROR - 2026-01-11 19:07:25 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 19:07:25 --> Severity: Notice --> Undefined property: stdClass::$jobcard_description_id D:\wamp64\www\gms\application\controllers\Jobcard.php 436
ERROR - 2026-01-11 19:07:25 --> Query error: Unknown column 'jobcard_description_id' in 'field list' - Invalid query: SELECT `jobcard_description_id`, `status`, `log_time`
FROM `jobcard_work_logs`
WHERE `jobcard_id` = '83'
ORDER BY `log_time` ASC
ERROR - 2026-01-11 19:07:36 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 19:07:36 --> Severity: Notice --> Undefined property: stdClass::$jobcard_description_id D:\wamp64\www\gms\application\controllers\Jobcard.php 436
ERROR - 2026-01-11 19:07:36 --> Query error: Unknown column 'jobcard_description_id' in 'field list' - Invalid query: SELECT `jobcard_description_id`, `status`, `log_time`
FROM `jobcard_work_logs`
WHERE `jobcard_id` = '83'
ORDER BY `log_time` ASC
ERROR - 2026-01-11 19:08:13 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 19:08:13 --> Query error: Unknown column 'jobcard_description_id' in 'field list' - Invalid query: SELECT `jobcard_description_id`, `status`, `log_time`
FROM `jobcard_work_logs`
WHERE `jobcard_id` = '83'
ORDER BY `log_time` ASC
ERROR - 2026-01-11 19:08:53 --> Jobcard Descriptions: [{"jobcard_service_id":"58","jobcard_id":"83","service_id":"6","service_name":"Wheel Alignment & Balancing","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"1","employee_name":"anu"},{"jobcard_service_id":"59","jobcard_id":"83","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"2","employee_name":"rajesh"}]
ERROR - 2026-01-11 19:09:42 --> Severity: Notice --> Undefined property: stdClass::$disamount D:\wamp64\www\gms\application\views\jobcard\create.php 329
ERROR - 2026-01-11 19:09:42 --> Severity: Notice --> Undefined property: stdClass::$disamount D:\wamp64\www\gms\application\views\jobcard\create.php 329
ERROR - 2026-01-11 19:09:42 --> Severity: Notice --> Undefined property: stdClass::$disamount D:\wamp64\www\gms\application\views\jobcard\create.php 329
ERROR - 2026-01-11 19:10:11 --> Severity: Notice --> Undefined property: stdClass::$disamount D:\wamp64\www\gms\application\views\jobcard\create.php 329
ERROR - 2026-01-11 19:10:11 --> Severity: Notice --> Undefined property: stdClass::$disamount D:\wamp64\www\gms\application\views\jobcard\create.php 329
ERROR - 2026-01-11 19:10:11 --> Severity: Notice --> Undefined property: stdClass::$disamount D:\wamp64\www\gms\application\views\jobcard\create.php 329
ERROR - 2026-01-11 19:12:07 --> Severity: Notice --> Undefined property: stdClass::$disamount D:\wamp64\www\gms\application\views\jobcard\create.php 329
ERROR - 2026-01-11 19:12:07 --> Severity: Notice --> Undefined property: stdClass::$disamount D:\wamp64\www\gms\application\views\jobcard\create.php 329
ERROR - 2026-01-11 19:12:07 --> Severity: Notice --> Undefined property: stdClass::$disamount D:\wamp64\www\gms\application\views\jobcard\create.php 329
ERROR - 2026-01-11 19:16:10 --> Pending
ERROR - 2026-01-11 21:16:49 --> Jobcard Descriptions: []
ERROR - 2026-01-11 21:16:52 --> Jobcard Descriptions: []
ERROR - 2026-01-11 21:56:55 --> 404 Page Not Found: Jobcards/list_by_status
ERROR - 2026-01-11 21:57:22 --> 404 Page Not Found: Jobcards/list_by_status
ERROR - 2026-01-11 21:57:27 --> 404 Page Not Found: Jobcards/list_by_status
ERROR - 2026-01-11 21:59:16 --> 404 Page Not Found: Jobcards/list_by_status
ERROR - 2026-01-11 22:00:09 --> 404 Page Not Found: Jobcards/list_by_status
ERROR - 2026-01-11 22:11:23 --> Jobcard Descriptions: []
ERROR - 2026-01-11 22:11:26 --> Jobcard Descriptions: []
ERROR - 2026-01-11 22:12:41 --> Jobcard Descriptions: []
ERROR - 2026-01-11 22:14:01 --> Jobcard Descriptions: []
ERROR - 2026-01-11 22:14:32 --> 404 Page Not Found: Timesheet/86
ERROR - 2026-01-11 22:14:41 --> Jobcard Descriptions: []
ERROR - 2026-01-11 22:15:36 --> Jobcard Descriptions: []
ERROR - 2026-01-11 22:15:43 --> Jobcard Descriptions: []
ERROR - 2026-01-11 22:16:16 --> Jobcard Descriptions: []
ERROR - 2026-01-11 22:55:19 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 22:55:19 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 22:55:19 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 22:55:19 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 22:55:19 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 22:55:19 --> Severity: Notice --> Trying to get property 'work_name' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 22:58:33 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 22:58:33 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 22:58:33 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 22:58:33 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 22:58:33 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 22:58:33 --> Severity: Notice --> Trying to get property 'work_name' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 272
ERROR - 2026-01-11 23:27:37 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:27:37 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:27:37 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:27:37 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:27:37 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:27:37 --> Severity: Notice --> Trying to get property 'work_name' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:07 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:07 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:07 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:07 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:07 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:07 --> Severity: Notice --> Trying to get property 'work_name' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:18 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:18 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:18 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:18 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:18 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:29:18 --> Severity: Notice --> Trying to get property 'work_name' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:30:39 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:30:39 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:30:39 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:30:39 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:30:39 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:30:39 --> Severity: Notice --> Trying to get property 'work_name' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:11 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:11 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:11 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:11 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:11 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:11 --> Severity: Notice --> Trying to get property 'work_name' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:18 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\view.php 265
ERROR - 2026-01-11 23:31:18 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\view.php 265
ERROR - 2026-01-11 23:31:18 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\view.php 265
ERROR - 2026-01-11 23:31:18 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\view.php 265
ERROR - 2026-01-11 23:31:18 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\view.php 265
ERROR - 2026-01-11 23:31:18 --> Severity: Notice --> Trying to get property 'work_name' of non-object D:\wamp64\www\gms\application\views\inspection\view.php 265
ERROR - 2026-01-11 23:31:26 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:26 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:26 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:26 --> Severity: Notice --> Trying to get property 'work_id' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:26 --> Severity: Notice --> Undefined variable: w D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:31:26 --> Severity: Notice --> Trying to get property 'work_name' of non-object D:\wamp64\www\gms\application\views\inspection\edit.php 285
ERROR - 2026-01-11 23:40:50 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 300
            [estimation_id] => 175
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-11 13:16:19
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 0
            [part_name] => Brake Pad - Rear
        )

    [1] => stdClass Object
        (
            [id] => 299
            [estimation_id] => 175
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-11 13:16:19
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

)

ERROR - 2026-01-11 23:40:50 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1057
ERROR - 2026-01-11 23:40:50 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1057
ERROR - 2026-01-11 23:40:50 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1066
ERROR - 2026-01-11 23:40:50 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1066
ERROR - 2026-01-11 23:40:50 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1075
ERROR - 2026-01-11 23:40:50 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1075
ERROR - 2026-01-11 23:42:05 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 300
            [estimation_id] => 175
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-11 13:16:19
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 0
            [part_name] => Brake Pad - Rear
        )

    [1] => stdClass Object
        (
            [id] => 299
            [estimation_id] => 175
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-11 13:16:19
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

)

ERROR - 2026-01-11 23:42:05 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1068
ERROR - 2026-01-11 23:42:05 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1068
ERROR - 2026-01-11 23:42:05 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1077
ERROR - 2026-01-11 23:42:05 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1077
ERROR - 2026-01-11 23:42:05 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1086
ERROR - 2026-01-11 23:42:05 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1086
ERROR - 2026-01-11 23:43:09 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 300
            [estimation_id] => 175
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-11 13:16:19
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 0
            [part_name] => Brake Pad - Rear
        )

    [1] => stdClass Object
        (
            [id] => 299
            [estimation_id] => 175
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-11 13:16:19
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

)

ERROR - 2026-01-11 23:43:10 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1070
ERROR - 2026-01-11 23:43:10 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1070
ERROR - 2026-01-11 23:43:10 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1079
ERROR - 2026-01-11 23:43:10 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1079
ERROR - 2026-01-11 23:43:10 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1088
ERROR - 2026-01-11 23:43:10 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1088
ERROR - 2026-01-11 23:43:41 --> Parts Used (New): Array
(
    [0] => stdClass Object
        (
            [id] => 300
            [estimation_id] => 175
            [part_id] => 6
            [qty] => 1
            [unit_price] => 1150.00
            [selling_price] => 1150.00
            [total_price] => 1150.00
            [created_at] => 2026-01-11 13:16:19
            [markup_percentage] => 0.00
            [discount] => .
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 5
            [selected] => 0
            [part_name] => Brake Pad - Rear
        )

    [1] => stdClass Object
        (
            [id] => 299
            [estimation_id] => 175
            [part_id] => 11
            [qty] => 1
            [unit_price] => 300.00
            [selling_price] => 300.00
            [total_price] => 300.00
            [created_at] => 2026-01-11 13:16:19
            [markup_percentage] => 0.00
            [discount] => 0
            [dis_amount] => 0.00
            [part_type] => New Parts
            [brand_id] => 11
            [selected] => 1
            [part_name] => Wiper Blade 20 inch
        )

)

ERROR - 2026-01-11 23:43:41 --> Severity: Notice --> Undefined variable: newbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1070
ERROR - 2026-01-11 23:43:41 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1070
ERROR - 2026-01-11 23:43:41 --> Severity: Notice --> Undefined variable: afterbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1079
ERROR - 2026-01-11 23:43:41 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1079
ERROR - 2026-01-11 23:43:41 --> Severity: Notice --> Undefined variable: usedbrands D:\wamp64\www\gms\application\views\quotation\edit.php 1088
ERROR - 2026-01-11 23:43:41 --> Severity: Warning --> Invalid argument supplied for foreach() D:\wamp64\www\gms\application\views\quotation\edit.php 1088
ERROR - 2026-01-11 23:53:56 --> Jobcard Descriptions: [{"jobcard_service_id":"61","jobcard_id":"88","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null},{"jobcard_service_id":"60","jobcard_id":"88","service_id":"8","service_name":"Spark Plug Replacement","service_type":"SERVICE","estimated_time":"1","estimated_cost":"200.00","total_cost":"200.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null}]
ERROR - 2026-01-11 23:58:03 --> Jobcard Descriptions: [{"jobcard_service_id":"61","jobcard_id":"88","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null},{"jobcard_service_id":"60","jobcard_id":"88","service_id":"8","service_name":"Spark Plug Replacement","service_type":"SERVICE","estimated_time":"1","estimated_cost":"200.00","total_cost":"200.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null}]
ERROR - 2026-01-11 23:58:23 --> Jobcard Descriptions: [{"jobcard_service_id":"61","jobcard_id":"88","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null},{"jobcard_service_id":"60","jobcard_id":"88","service_id":"8","service_name":"Spark Plug Replacement","service_type":"SERVICE","estimated_time":"1","estimated_cost":"200.00","total_cost":"200.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null}]
ERROR - 2026-01-11 23:59:09 --> Jobcard Descriptions: [{"jobcard_service_id":"61","jobcard_id":"88","service_id":"11","service_name":"Radiator Coolant Flush","service_type":"SERVICE","estimated_time":"1","estimated_cost":"180.00","total_cost":"180.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null},{"jobcard_service_id":"60","jobcard_id":"88","service_id":"8","service_name":"Spark Plug Replacement","service_type":"SERVICE","estimated_time":"1","estimated_cost":"200.00","total_cost":"200.00","actual_time":null,"actual_cost":null,"status":"Pending","employee_id":"0","employee_name":null}]
