<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-04-23 09:02:40 --> Array
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
            [account_id] => 23
            [account_name] => Cash
            [group_name] => Cash-in-hand
            [balance] => -198.500
        )

)

ERROR - 2026-04-23 09:09:54 --> Array
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
            [account_id] => 23
            [account_name] => Cash
            [group_name] => Cash-in-hand
            [balance] => -198.500
        )

)

ERROR - 2026-04-23 11:42:55 --> Severity: error --> Exception: Unsupported operand types: string + int /home/greenea4/public_html/projects/gms/application/controllers/Purchase.php 492
ERROR - 2026-04-23 11:48:58 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 11:48:58 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 11:49:31 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 108
            [invoice_code] => POD/26/0065
            [uid] => 100
            [grand_total] => 600.00
            [ref_no] => 
            [invoice_date] => 2026-03-25
            [po_code] => POD/26/0065
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 11:49:32 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 108
            [invoice_code] => POD/26/0065
            [uid] => 100
            [grand_total] => 600.00
            [ref_no] => 
            [invoice_date] => 2026-03-25
            [po_code] => POD/26/0065
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 11:49:54 --> Severity: Warning --> Undefined variable $supplier_id /home/greenea4/public_html/projects/gms/application/controllers/Ajax.php 477
ERROR - 2026-04-23 11:53:54 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/views/Accounts/bank_reconciliation_list.php 39
ERROR - 2026-04-23 10:24:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'JOIN voucher_transaction v 
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
            AND v.account_id = 2889

        WHERE i.invoice_type = 'TI'

        GROUP BY i.invoice_id

        ORDER BY i.invoice_date DESC, i.invoice_no DESC
    
ERROR - 2026-04-23 11:56:33 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/views/Accounts/bank_reconciliation_list.php 39
ERROR - 2026-04-23 10:34:15 --> Severity: Warning --> Trying to access array offset on value of type null /home/greenea4/public_html/projects/gms/application/models/Hr_model.php 759
ERROR - 2026-04-23 10:34:15 --> Severity: Warning --> Trying to access array offset on value of type null /home/greenea4/public_html/projects/gms/application/models/Hr_model.php 759
ERROR - 2026-04-23 12:04:15 --> /gms/index.php/Hr/add_emp_regignation_data
ERROR - 2026-04-23 12:04:15 --> Hr/add_emp_regignation_data
ERROR - 2026-04-23 10:36:09 --> Today Attendance Records: Array
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
            [name] => Jamaica Viernes
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

    [5] => stdClass Object
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

    [6] => stdClass Object
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

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 21
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
            [name] => test
            [created_by_user] => 
        )

)

ERROR - 2026-04-23 10:36:09 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [employee_code] => 
            [employee_name] => Jamaica Viernes
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 01:59:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 07:50:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:10:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 05:17:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 11
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:25:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [5] => stdClass Object
        (
            [employee_id] => 7
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => Office
            [passport_expiry_reminder] => 1_month
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 01:55:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [6] => stdClass Object
        (
            [employee_id] => 10
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:19:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [7] => stdClass Object
        (
            [employee_id] => 21
            [employee_code] => 
            [employee_name] => test
            [mobile] => rtert
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Advisor
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 02:33:34
            [department_name] => test department1
            [designation_name] => test designation1
        )

)

ERROR - 2026-04-23 10:36:30 --> Today Attendance Records: Array
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
            [name] => Jamaica Viernes
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

    [5] => stdClass Object
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

    [6] => stdClass Object
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

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 21
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
            [name] => test
            [created_by_user] => 
        )

)

ERROR - 2026-04-23 10:36:30 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [employee_code] => 
            [employee_name] => Jamaica Viernes
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 01:59:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 07:50:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:10:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 05:17:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 11
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:25:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [5] => stdClass Object
        (
            [employee_id] => 7
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => Office
            [passport_expiry_reminder] => 1_month
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 01:55:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [6] => stdClass Object
        (
            [employee_id] => 10
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:19:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [7] => stdClass Object
        (
            [employee_id] => 21
            [employee_code] => 
            [employee_name] => test
            [mobile] => rtert
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Advisor
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 02:33:34
            [department_name] => test department1
            [designation_name] => test designation1
        )

)

ERROR - 2026-04-23 10:38:55 --> Today Attendance Records: Array
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
            [name] => Jamaica Viernes
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

    [5] => stdClass Object
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

    [6] => stdClass Object
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

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 21
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
            [name] => test
            [created_by_user] => 
        )

)

ERROR - 2026-04-23 10:38:55 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [employee_code] => 
            [employee_name] => Jamaica Viernes
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 01:59:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 07:50:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:10:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 05:17:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 11
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:25:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [5] => stdClass Object
        (
            [employee_id] => 7
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => Office
            [passport_expiry_reminder] => 1_month
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 01:55:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [6] => stdClass Object
        (
            [employee_id] => 10
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:19:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [7] => stdClass Object
        (
            [employee_id] => 21
            [employee_code] => 
            [employee_name] => test
            [mobile] => rtert
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Advisor
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 02:33:34
            [department_name] => test department1
            [designation_name] => test designation1
        )

)

ERROR - 2026-04-23 10:57:45 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 4634.550
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
            [balance] => -198.500
        )

)

ERROR - 2026-04-23 10:57:50 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 4634.550
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
            [balance] => -198.500
        )

)

ERROR - 2026-04-23 11:09:01 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 4634.550
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
            [balance] => -198.500
        )

)

ERROR - 2026-04-23 11:17:25 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 4634.550
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
            [balance] => -198.500
        )

)

ERROR - 2026-04-23 11:36:52 --> Severity: Warning --> Undefined variable $i /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 494
ERROR - 2026-04-23 11:36:52 --> Severity: Warning --> Undefined variable $j /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 495
ERROR - 2026-04-23 11:36:59 --> Severity: Warning --> Undefined variable $i /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 494
ERROR - 2026-04-23 11:36:59 --> Severity: Warning --> Undefined variable $j /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 495
ERROR - 2026-04-23 11:37:06 --> Severity: Warning --> Undefined variable $i /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 494
ERROR - 2026-04-23 11:37:06 --> Severity: Warning --> Undefined variable $j /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 495
ERROR - 2026-04-23 11:37:20 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 11:37:21 --> Severity: Warning --> Undefined variable $i /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 494
ERROR - 2026-04-23 11:37:21 --> Severity: Warning --> Undefined variable $j /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 495
ERROR - 2026-04-23 11:37:31 --> Severity: Warning --> Undefined variable $i /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 494
ERROR - 2026-04-23 11:37:31 --> Severity: Warning --> Undefined variable $j /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 495
ERROR - 2026-04-23 11:37:32 --> Severity: Warning --> Undefined variable $i /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 494
ERROR - 2026-04-23 11:37:32 --> Severity: Warning --> Undefined variable $j /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 495
ERROR - 2026-04-23 11:37:43 --> Severity: Warning --> Undefined variable $i /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 494
ERROR - 2026-04-23 11:37:43 --> Severity: Warning --> Undefined variable $j /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 495
ERROR - 2026-04-23 11:37:52 --> Severity: Warning --> Undefined variable $i /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 494
ERROR - 2026-04-23 11:37:52 --> Severity: Warning --> Undefined variable $j /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 495
ERROR - 2026-04-23 11:38:59 --> Severity: Warning --> Undefined variable $i /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 494
ERROR - 2026-04-23 11:38:59 --> Severity: Warning --> Undefined variable $j /home/greenea4/public_html/projects/gms/application/views/hr/basic_salary_edit.php 495
ERROR - 2026-04-23 11:39:39 --> Today Attendance Records: Array
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
            [name] => Jamaica Viernes
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

    [5] => stdClass Object
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

    [6] => stdClass Object
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

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 21
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
            [name] => test
            [created_by_user] => 
        )

    [8] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 22
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
            [name] => test new
            [created_by_user] => 
        )

)

ERROR - 2026-04-23 11:39:39 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [employee_code] => 
            [employee_name] => Jamaica Viernes
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 01:59:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 07:50:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:10:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 05:17:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 11
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:25:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [5] => stdClass Object
        (
            [employee_id] => 7
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => Office
            [passport_expiry_reminder] => 1_month
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 01:55:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [6] => stdClass Object
        (
            [employee_id] => 10
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:19:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [7] => stdClass Object
        (
            [employee_id] => 21
            [employee_code] => 
            [employee_name] => test
            [mobile] => rtert
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Advisor
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 02:33:34
            [department_name] => test department1
            [designation_name] => test designation1
        )

    [8] => stdClass Object
        (
            [employee_id] => 22
            [employee_code] => 
            [employee_name] => test new
            [mobile] => 46346
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 03:38:14
            [department_name] => test department1
            [designation_name] => test designation1
        )

)

ERROR - 2026-04-23 11:40:14 --> Today Attendance Records: Array
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
            [name] => Jamaica Viernes
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

    [5] => stdClass Object
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

    [6] => stdClass Object
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

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 21
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
            [name] => test
            [created_by_user] => 
        )

    [8] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 22
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
            [name] => test new
            [created_by_user] => 
        )

)

ERROR - 2026-04-23 11:40:14 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [employee_code] => 
            [employee_name] => Jamaica Viernes
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 01:59:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 07:50:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:10:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 05:17:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 11
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:25:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [5] => stdClass Object
        (
            [employee_id] => 7
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => Office
            [passport_expiry_reminder] => 1_month
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 01:55:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [6] => stdClass Object
        (
            [employee_id] => 10
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:19:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [7] => stdClass Object
        (
            [employee_id] => 21
            [employee_code] => 
            [employee_name] => test
            [mobile] => rtert
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Advisor
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 02:33:34
            [department_name] => test department1
            [designation_name] => test designation1
        )

    [8] => stdClass Object
        (
            [employee_id] => 22
            [employee_code] => 
            [employee_name] => test new
            [mobile] => 46346
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 03:38:14
            [department_name] => test department1
            [designation_name] => test designation1
        )

)

ERROR - 2026-04-23 11:40:39 --> Today Attendance Records: Array
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
            [name] => Jamaica Viernes
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

    [5] => stdClass Object
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

    [6] => stdClass Object
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

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 21
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
            [name] => test
            [created_by_user] => 
        )

    [8] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 22
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
            [name] => test new
            [created_by_user] => 
        )

)

ERROR - 2026-04-23 11:40:39 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [employee_code] => 
            [employee_name] => Jamaica Viernes
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 01:59:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 07:50:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:10:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 05:17:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 11
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:25:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [5] => stdClass Object
        (
            [employee_id] => 7
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => Office
            [passport_expiry_reminder] => 1_month
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 01:55:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [6] => stdClass Object
        (
            [employee_id] => 10
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:19:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [7] => stdClass Object
        (
            [employee_id] => 21
            [employee_code] => 
            [employee_name] => test
            [mobile] => rtert
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Advisor
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 02:33:34
            [department_name] => test department1
            [designation_name] => test designation1
        )

    [8] => stdClass Object
        (
            [employee_id] => 22
            [employee_code] => 
            [employee_name] => test new
            [mobile] => 46346
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 03:38:14
            [department_name] => test department1
            [designation_name] => test designation1
        )

)

ERROR - 2026-04-23 11:41:20 --> Today Attendance Records: Array
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
            [name] => Jamaica Viernes
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

    [5] => stdClass Object
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

    [6] => stdClass Object
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

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 21
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
            [name] => test
            [created_by_user] => 
        )

    [8] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 22
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
            [name] => test new
            [created_by_user] => 
        )

)

ERROR - 2026-04-23 11:41:20 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [employee_code] => 
            [employee_name] => Jamaica Viernes
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 01:59:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 07:50:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:10:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 05:17:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 11
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:25:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [5] => stdClass Object
        (
            [employee_id] => 7
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => Office
            [passport_expiry_reminder] => 1_month
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 01:55:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [6] => stdClass Object
        (
            [employee_id] => 10
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:19:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [7] => stdClass Object
        (
            [employee_id] => 21
            [employee_code] => 
            [employee_name] => test
            [mobile] => rtert
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Advisor
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 02:33:34
            [department_name] => test department1
            [designation_name] => test designation1
        )

    [8] => stdClass Object
        (
            [employee_id] => 22
            [employee_code] => 
            [employee_name] => test new
            [mobile] => 46346
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 03:38:14
            [department_name] => test department1
            [designation_name] => test designation1
        )

)

ERROR - 2026-04-23 11:42:43 --> Today Attendance Records: Array
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
            [name] => Jamaica Viernes
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

    [5] => stdClass Object
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

    [6] => stdClass Object
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

    [7] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 21
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
            [name] => test
            [created_by_user] => 
        )

    [8] => stdClass Object
        (
            [emp_aId] => 
            [employee_id] => 22
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
            [name] => test new
            [created_by_user] => 
        )

)

ERROR - 2026-04-23 11:42:43 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [employee_code] => 
            [employee_name] => Jamaica Viernes
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 01:59:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 07:50:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:10:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 05:17:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 11
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:25:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [5] => stdClass Object
        (
            [employee_id] => 7
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => Office
            [passport_expiry_reminder] => 1_month
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 01:55:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [6] => stdClass Object
        (
            [employee_id] => 10
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:19:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

    [7] => stdClass Object
        (
            [employee_id] => 21
            [employee_code] => 
            [employee_name] => test
            [mobile] => rtert
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Advisor
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 02:33:34
            [department_name] => test department1
            [designation_name] => test designation1
        )

    [8] => stdClass Object
        (
            [employee_id] => 22
            [employee_code] => 
            [employee_name] => test new
            [mobile] => 46346
            [email] => kzfdsk@dffdg.com
            [address] => 
            [passport_number] => 
            [passport_issue_date] => 0000-00-00
            [passport_expiry_date] => 0000-00-00
            [passport_location] => 
            [passport_expiry_reminder] => 
            [passport_file] => 
            [department_id] => 6
            [designation_id] => 11
            [role] => Technician
            [software_access] => No
            [joining_date] => 0000-00-00
            [status] => Active
            [created_at] => 2026-04-23 03:38:14
            [department_name] => test department1
            [designation_name] => test designation1
        )

)

ERROR - 2026-04-23 11:52:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/greenea4/public_html/projects/gms/application/models/Hr_model.php 759
ERROR - 2026-04-23 11:52:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/greenea4/public_html/projects/gms/application/models/Hr_model.php 759
ERROR - 2026-04-23 11:52:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/greenea4/public_html/projects/gms/application/models/Hr_model.php 759
ERROR - 2026-04-23 13:22:11 --> /gms/index.php/Hr/add_emp_regignation_data
ERROR - 2026-04-23 13:22:11 --> Hr/add_emp_regignation_data
ERROR - 2026-04-23 13:32:49 --> /gms/index.php/Hr/update_emp_regignation
ERROR - 2026-04-23 13:32:49 --> Hr/update_emp_regignation
ERROR - 2026-04-23 12:03:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/greenea4/public_html/projects/gms/application/models/Hr_model.php 829
ERROR - 2026-04-23 13:33:11 --> /gms/index.php/Hr/update_emp_regignation
ERROR - 2026-04-23 13:33:11 --> Hr/update_emp_regignation
ERROR - 2026-04-23 13:33:24 --> /gms/index.php/Hr/update_emp_regignation
ERROR - 2026-04-23 13:33:24 --> Hr/update_emp_regignation
ERROR - 2026-04-23 13:34:20 --> /gms/index.php/Hr/add_corporate_file_data
ERROR - 2026-04-23 13:34:20 --> Hr/add_corporate_file_data
ERROR - 2026-04-23 12:13:34 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5488.870
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
            [balance] => -3838.500
        )

)

ERROR - 2026-04-23 12:14:07 --> Account ID: 2833
ERROR - 2026-04-23 13:44:07 --> Supplier ID from model: 95
ERROR - 2026-04-23 13:44:07 --> account_id: 2833
ERROR - 2026-04-23 12:14:28 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5488.870
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
            [balance] => -3838.500
        )

)

ERROR - 2026-04-23 12:15:23 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5488.870
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
            [balance] => -3838.500
        )

)

ERROR - 2026-04-23 13:45:44 --> Invoice List: Array
(
)

ERROR - 2026-04-23 13:45:44 --> Invoice List: Array
(
)

ERROR - 2026-04-23 13:46:08 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 13:46:08 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 13:50:03 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 13:50:04 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 13:51:41 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 13:51:41 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 13:53:10 --> Severity: Warning --> Undefined variable $supplier_id /home/greenea4/public_html/projects/gms/application/controllers/Ajax.php 477
ERROR - 2026-04-23 12:23:11 --> RFQ Data: Array
(
    [0] => stdClass Object
        (
            [po_id] => 151
            [po_date] => 2026-04-23
            [qtn_id] => 
            [revision] => 0
            [revision_date] => 2026-04-23
            [po_code] => POD/26/0069
            [supplier_ref] => 
            [subject] => 
            [supplier_id] => 109
            [sub_total] => 318.50
            [vat_percent] => 5.00
            [vat_amt] => 15.93
            [discount_percent] => 0.00
            [discount] => 0.00
            [currency_id] => 
            [currency_rate] => 
            [grand_total] => 334.43
            [payment_term] => 
            [delivery_term] => 
            [shipping_term] => 
            [general_term] => 
            [approved_person] => 
            [grn_status] => 0
            [is_grn_required] => 1
            [created_by] => 6
            [created_date] => 2026-04-23 13:52:51
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
            [freight_mode] => 
            [project] => 
            [grn_id] => 0
            [validity] => 
            [request_by] => 
            [jobcard_id] => 0
            [purchase_type] => PARTS
            [voucher_posted] => 0
            [supplier_code] => SUP0024
            [supplier_name] => Zofeur FZ-LLC
            [contact_no] => 045665377
            [email_id] => accounts@zofeur.com
            [billing_address] => 305/306, Building 7, DMC Dubai, Dubai  UAE AE
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
            [trn_no] =>  100510604000003
            [username] => Admin
            [quotation_code] => 
        )

)

ERROR - 2026-04-23 12:23:12 --> po Data: Array
(
    [0] => stdClass Object
        (
            [trans_id] => 335
            [trans_revision] => 0
            [po_master_id] => 151
            [line_type] => PART
            [product_id] => 3
            [brand] => 
            [desc] => Air Filter 
            [unit_id] => 1
            [packing_id] => 0
            [quantity] => 5.00
            [price] => 65.00
            [total] => 318.50
            [service_vat_per] => 0.00
            [service_vat_amt] => 0.00
            [expense_account_id] => 
            [dis_per] => 2.00
            [dis_amt] => 6.50
            [dis_per2] => 0.00
            [dis_amt2] => 0.00
            [unit_price] => 65.00
            [part_id] => 3
            [part_name] => Air Filter 
            [part_code] => 
            [brand_id] => 
            [vehicle_model_id] => 
            [purchase_unit_id] => 1
            [stock_unit_id] => 1
            [qty_per_purchase_unit] => 1.00
            [min_stock] => 2
            [created_at] => 2025-11-27 03:46:22
            [part_type] => Aftermarket Parts
            [warrenty] => 
            [labeling] => 1
            [unit_name] => pair
            [orgprice] => 65.00
            [received_qty] => 0.00
            [balance_qty] => 5.00
            [totalold] => 325.00
        )

)

ERROR - 2026-04-23 13:53:24 --> 5
ERROR - 2026-04-23 13:53:40 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 13:53:40 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 13:53:40 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 13:53:40 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 12:33:02 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5488.870
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
            [balance] => -5038.500
        )

)

ERROR - 2026-04-23 14:04:01 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:04:01 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 14:04:01 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:04:01 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 12:34:10 --> 
ERROR - 2026-04-23 12:34:10 --> quote new
ERROR - 2026-04-23 12:34:22 --> 1
ERROR - 2026-04-23 12:34:24 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '211', `service_id` = '2', `employee_id` = '', `estimated_time` = '2.00', `estimated_cost` = '120.00', `total_cost` = '240.00'
WHERE `jobcard_id` = '211'
AND `service_id` = '2'
ERROR - 2026-04-23 12:34:24 --> {"code":0,"message":""}
ERROR - 2026-04-23 12:34:24 --> ================ update_parts START ================
ERROR - 2026-04-23 12:34:24 --> Jobcard ID: 211
ERROR - 2026-04-23 12:34:24 --> PART IDS: Array
(
)

ERROR - 2026-04-23 12:34:24 --> PART TYPE: Array
(
)

ERROR - 2026-04-23 12:34:24 --> QTY: Array
(
)

ERROR - 2026-04-23 12:34:24 --> UNIT PRICE: Array
(
)

ERROR - 2026-04-23 12:34:24 --> SELL PRICE: Array
(
)

ERROR - 2026-04-23 12:34:24 --> TOTAL PRICE: Array
(
)

ERROR - 2026-04-23 12:34:24 --> DISCOUNT: Array
(
)

ERROR - 2026-04-23 12:34:24 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-04-23 12:34:24 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-04-23 12:34:25 --> 1
ERROR - 2026-04-23 12:34:27 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '211', `service_id` = '2', `employee_id` = '', `estimated_time` = '2.00', `estimated_cost` = '120.00', `total_cost` = '240.00'
WHERE `jobcard_id` = '211'
AND `service_id` = '2'
ERROR - 2026-04-23 12:34:27 --> {"code":0,"message":""}
ERROR - 2026-04-23 12:34:27 --> ================ update_parts START ================
ERROR - 2026-04-23 12:34:27 --> Jobcard ID: 211
ERROR - 2026-04-23 12:34:27 --> PART IDS: Array
(
)

ERROR - 2026-04-23 12:34:27 --> PART TYPE: Array
(
)

ERROR - 2026-04-23 12:34:27 --> QTY: Array
(
)

ERROR - 2026-04-23 12:34:27 --> UNIT PRICE: Array
(
)

ERROR - 2026-04-23 12:34:27 --> SELL PRICE: Array
(
)

ERROR - 2026-04-23 12:34:27 --> TOTAL PRICE: Array
(
)

ERROR - 2026-04-23 12:34:27 --> DISCOUNT: Array
(
)

ERROR - 2026-04-23 12:34:27 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-04-23 12:34:27 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-04-23 12:34:27 --> 1
ERROR - 2026-04-23 14:05:03 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:05:03 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 14:05:03 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:05:03 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 14:07:39 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:07:39 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 14:07:39 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:07:39 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 12:37:53 --> 
ERROR - 2026-04-23 12:37:53 --> quote new
ERROR - 2026-04-23 14:08:05 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:08:05 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 14:08:05 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:08:05 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 12:40:41 --> 
ERROR - 2026-04-23 12:40:41 --> quote new
ERROR - 2026-04-23 12:43:39 --> 1
ERROR - 2026-04-23 12:43:42 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '212', `service_id` = '2', `employee_id` = '', `estimated_time` = '2.00', `estimated_cost` = '120.00', `total_cost` = '240.00'
WHERE `jobcard_id` = '212'
AND `service_id` = '2'
ERROR - 2026-04-23 12:43:42 --> {"code":0,"message":""}
ERROR - 2026-04-23 12:43:42 --> ================ update_parts START ================
ERROR - 2026-04-23 12:43:42 --> Jobcard ID: 212
ERROR - 2026-04-23 12:43:42 --> PART IDS: Array
(
)

ERROR - 2026-04-23 12:43:42 --> PART TYPE: Array
(
)

ERROR - 2026-04-23 12:43:42 --> QTY: Array
(
)

ERROR - 2026-04-23 12:43:42 --> UNIT PRICE: Array
(
)

ERROR - 2026-04-23 12:43:42 --> SELL PRICE: Array
(
)

ERROR - 2026-04-23 12:43:42 --> TOTAL PRICE: Array
(
)

ERROR - 2026-04-23 12:43:42 --> DISCOUNT: Array
(
)

ERROR - 2026-04-23 12:43:42 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-04-23 12:43:42 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-04-23 12:43:42 --> 1
ERROR - 2026-04-23 12:43:43 --> UPDATED: UPDATE `jobcard_services` SET `jobcard_id` = '212', `service_id` = '2', `employee_id` = '', `estimated_time` = '2.00', `estimated_cost` = '120.00', `total_cost` = '240.00'
WHERE `jobcard_id` = '212'
AND `service_id` = '2'
ERROR - 2026-04-23 12:43:43 --> {"code":0,"message":""}
ERROR - 2026-04-23 12:43:43 --> ================ update_parts START ================
ERROR - 2026-04-23 12:43:43 --> Jobcard ID: 212
ERROR - 2026-04-23 12:43:43 --> PART IDS: Array
(
)

ERROR - 2026-04-23 12:43:43 --> PART TYPE: Array
(
)

ERROR - 2026-04-23 12:43:43 --> QTY: Array
(
)

ERROR - 2026-04-23 12:43:43 --> UNIT PRICE: Array
(
)

ERROR - 2026-04-23 12:43:43 --> SELL PRICE: Array
(
)

ERROR - 2026-04-23 12:43:43 --> TOTAL PRICE: Array
(
)

ERROR - 2026-04-23 12:43:43 --> DISCOUNT: Array
(
)

ERROR - 2026-04-23 12:43:43 --> EXISTING PART IDS IN DB: Array
(
)

ERROR - 2026-04-23 12:43:43 --> CLEANED PART IDS: Array
(
)

ERROR - 2026-04-23 12:43:44 --> 1
ERROR - 2026-04-23 14:13:56 --> Jobcard Data: stdClass Object
(
    [jobcard_id] => 212
    [jobcard_no] => JC-2026-0045
    [estimation_id] => 376
    [appointment_id] => 
    [customer_id] => 579
    [vehicle_id] => 721
    [jobcard_date] => 2026-04-23
    [jobcard_time] => 00:00:00
    [km_in] => 50
    [expected_delivery_date] => 0000-00-00
    [completion_time] => 00:00:00
    [technician_id] => 
    [status] => Scheduled
    [remarks] => 
    [subtotal] => 241.50
    [tax_percent] => 0.00
    [tax_amount] => 12.07
    [discount] => 0.00
    [grand_total] => 253.57
    [created_by] => 6
    [created_at] => 2026-04-23 12:43:39
    [quotation_id] => 159
    [quotation_no] => QT-2026-0045
    [quotation_date] => 2026-04-23
    [quotation_subtotal] => 241.50
    [quotation_tax] => 12.07
    [quotation_discount] => 0.00
    [quotation_grand_total] => 253.57
    [quotation_status] => Approved
    [sdiscount] => 10.00
    [subdiscount] => 0.00
    [customer_name] => test new cust
    [customer_phone] => 324325
    [customer_email] => kzfdsk@dffdg.com
    [customer_trn] => 
    [cistomer_address] => 
    [customer_emirates] => Dubai
    [registration_no] => 1234
    [brand] => Hummer
    [model] => H3
    [variant] => dsfsdf
    [year] => 214
    [chassis_no] => 34134
    [engine_no] => dsgsdgsdg
    [services] => Array
        (
            [0] => stdClass Object
                (
                    [id] => 1018
                    [service_id] => 2
                    [total_cost] => 240.00
                    [discount_amount] => 10.00
                    [service_name] => Full Vehicle Inspection
                    [service_type] => SERVICE
                )

        )

    [parts] => Array
        (
        )

    [descriptions] => Array
        (
        )

    [total_advance] => 100
    [used_advance] => 0
    [available_advance] => 100
    [fully_invoiced] => 
)

ERROR - 2026-04-23 12:43:57 --> 159
ERROR - 2026-04-23 14:25:17 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:25:17 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 14:25:18 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:25:18 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 96
            [invoice_code] => GRN/26/0037
            [uid] => 109
            [grand_total] => 334.43
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0069
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 14:29:20 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 14:29:20 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 14:30:38 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 14:30:38 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 150
            [invoice_code] => POD/26/0068
            [uid] => 109
            [grand_total] => 900.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 13:03:30 --> Query error: Table 'greenea4_gms.purchase_grn_transactions' doesn't exist - Invalid query: SHOW COLUMNS FROM `purchase_grn_transactions`
ERROR - 2026-04-23 14:34:11 --> Severity: Warning --> Undefined variable $flag /home/greenea4/public_html/projects/gms/application/controllers/Accounts.php 158
ERROR - 2026-04-23 14:35:04 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 152
            [invoice_code] => POD/26/0067
            [uid] => 128
            [grand_total] => 500.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0067
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 14:35:05 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 152
            [invoice_code] => POD/26/0067
            [uid] => 128
            [grand_total] => 500.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0067
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 14:37:05 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 152
            [invoice_code] => POD/26/0067
            [uid] => 128
            [grand_total] => 500.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0067
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 14:37:05 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 152
            [invoice_code] => POD/26/0067
            [uid] => 128
            [grand_total] => 500.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0067
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 14:38:26 --> Severity: Warning --> Undefined variable $supplier_id /home/greenea4/public_html/projects/gms/application/controllers/Ajax.php 477
ERROR - 2026-04-23 13:08:28 --> RFQ Data: Array
(
    [0] => stdClass Object
        (
            [po_id] => 153
            [po_date] => 2026-04-23
            [qtn_id] => 
            [revision] => 0
            [revision_date] => 2026-04-23
            [po_code] => POD/26/0068
            [supplier_ref] => 
            [subject] => 
            [supplier_id] => 128
            [sub_total] => 200.00
            [vat_percent] => 5.00
            [vat_amt] => 10.00
            [discount_percent] => 0.00
            [discount] => 0.00
            [currency_id] => 
            [currency_rate] => 
            [grand_total] => 210.00
            [payment_term] => 
            [delivery_term] => 
            [shipping_term] => 
            [general_term] => 
            [approved_person] => 
            [grn_status] => 0
            [is_grn_required] => 1
            [created_by] => 6
            [created_date] => 2026-04-23 14:38:11
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
            [freight_mode] => 
            [project] => 
            [grn_id] => 0
            [validity] => 
            [request_by] => 
            [jobcard_id] => 0
            [purchase_type] => PARTS
            [voucher_posted] => 0
            [supplier_code] => SUP0031
            [supplier_name] => test23
            [contact_no] => 
            [email_id] => 
            [billing_address] => 
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
            [trn_no] => 
            [username] => Admin
            [quotation_code] => 
        )

)

ERROR - 2026-04-23 13:08:28 --> po Data: Array
(
    [0] => stdClass Object
        (
            [trans_id] => 337
            [trans_revision] => 0
            [po_master_id] => 153
            [line_type] => PART
            [product_id] => 140
            [brand] => 
            [desc] => 3rd brake lamp
            [unit_id] => 1
            [packing_id] => 0
            [quantity] => 1.00
            [price] => 200.00
            [total] => 200.00
            [service_vat_per] => 0.00
            [service_vat_amt] => 0.00
            [expense_account_id] => 
            [dis_per] => 0.00
            [dis_amt] => 0.00
            [dis_per2] => 0.00
            [dis_amt2] => 0.00
            [unit_price] => 0.00
            [part_id] => 140
            [part_name] => 3rd brake lamp
            [part_code] => 
            [brand_id] => 
            [vehicle_model_id] => 
            [purchase_unit_id] => 1
            [stock_unit_id] => 1
            [qty_per_purchase_unit] => 1.00
            [min_stock] => 1
            [created_at] => 2026-03-14 13:54:31
            [part_type] => New Parts
            [warrenty] => 
            [labeling] => 1
            [unit_name] => pair
            [orgprice] => 200.00
            [received_qty] => 0.00
            [balance_qty] => 1.00
            [totalold] => 200.00
        )

)

ERROR - 2026-04-23 14:38:32 --> 1
ERROR - 2026-04-23 14:39:39 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:39:39 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 152
            [invoice_code] => POD/26/0067
            [uid] => 128
            [grand_total] => 500.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0067
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 97
            [invoice_code] => GRN/26/0037
            [uid] => 128
            [grand_total] => 210.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 14:39:40 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 14:39:40 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 152
            [invoice_code] => POD/26/0067
            [uid] => 128
            [grand_total] => 500.00
            [ref_no] => 
            [invoice_date] => 2026-04-23
            [po_code] => POD/26/0067
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 97
            [invoice_code] => GRN/26/0037
            [uid] => 128
            [grand_total] => 210.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0068
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Undefined array key 0 /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 341
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Attempt to read property "po_code" on null /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 341
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Undefined array key 0 /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 343
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Attempt to read property "po_date" on null /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 343
ERROR - 2026-04-23 14:46:30 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 343
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Undefined array key 0 /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 370
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Attempt to read property "supplier_name" on null /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 370
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Undefined array key 0 /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 374
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Attempt to read property "billing_address" on null /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 374
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Undefined array key 0 /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 378
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Attempt to read property "email_id" on null /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 378
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Undefined array key 0 /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 382
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Attempt to read property "trn_no" on null /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 382
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Undefined array key 0 /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 389
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Attempt to read property "po_code" on null /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 389
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Undefined array key 0 /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 393
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Attempt to read property "quotation_code" on null /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 393
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Undefined array key 0 /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 397
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Attempt to read property "payment_term" on null /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 397
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Undefined array key 0 /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 430
ERROR - 2026-04-23 14:46:30 --> Severity: Warning --> Attempt to read property "grand_total" on null /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 430
ERROR - 2026-04-23 14:46:30 --> Severity: 8192 --> number_format(): Passing null to parameter #1 ($num) of type float is deprecated /home/greenea4/public_html/projects/gms/application/views/purchase/print/po_print.php 478
ERROR - 2026-04-23 14:48:19 --> Voucher Code: RV/26/00006
ERROR - 2026-04-23 13:19:55 --> Today Attendance Records: Array
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
            [name] => Jamaica Viernes
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

    [5] => stdClass Object
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

    [6] => stdClass Object
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

)

ERROR - 2026-04-23 13:19:55 --> All Attendance Records: Array
(
    [0] => stdClass Object
        (
            [employee_id] => 8
            [employee_code] => 
            [employee_name] => Jamaica Viernes
            [mobile] => 0582549792
            [email] => maicaviernes0308@gmail.com
            [address] => Dubai,UAE
            [passport_number] => P4373362B
            [passport_issue_date] => 2020-01-11
            [passport_expiry_date] => 2030-01-10
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 8
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 01:59:10
            [department_name] => OFFICE
            [designation_name] => Admin
        )

    [1] => stdClass Object
        (
            [employee_id] => 13
            [employee_code] => 
            [employee_name] => Kishen Vijayan
            [mobile] => +971 55 962 3366
            [email] => kishenvijayan619@gmail.com
            [address] => Dubai,UAE
            [passport_number] => V5692464
            [passport_issue_date] => 2022-01-06
            [passport_expiry_date] => 2032-01-05
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774439458.pdf
            [department_id] => 3
            [designation_id] => 5
            [role] => Advisor
            [software_access] => Yes
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-25 07:50:58
            [department_name] => OFFICE
            [designation_name] => Manager
        )

    [2] => stdClass Object
        (
            [employee_id] => 9
            [employee_code] => 
            [employee_name] => Madiwadanan Sembaganathan
            [mobile] => +971 52 368 9299
            [email] => Ahmadahmad20030326@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N10765244
            [passport_issue_date] => 2023-07-28
            [passport_expiry_date] => 2033-07-28
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:10:25
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [3] => stdClass Object
        (
            [employee_id] => 14
            [employee_code] => 
            [employee_name] => Mohammad Anowar Hossain
            [mobile] => 0523549324
            [email] => 
            [address] => 
            [passport_number] => A13779322
            [passport_issue_date] => 2024-01-19
            [passport_expiry_date] => 2034-01-18
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => passport_1774948661.jpeg
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-31 05:17:41
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [4] => stdClass Object
        (
            [employee_id] => 11
            [employee_code] => 
            [employee_name] => Prasanga Rijman Perera Liyanage
            [mobile] => +971529754792
            [email] => prasangarijman03@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N8146977
            [passport_issue_date] => 2019-01-23
            [passport_expiry_date] => 2029-01-23
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 9
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:25:24
            [department_name] => Operation
            [designation_name] => Junior Mechanic
        )

    [5] => stdClass Object
        (
            [employee_id] => 7
            [employee_code] => 
            [employee_name] => Richard Zon Pineda
            [mobile] => 0543000117
            [email] => ericzonpineda007@gmail.com
            [address] => 
            [passport_number] => P4552701A
            [passport_issue_date] => 2022-09-20
            [passport_expiry_date] => 2032-09-19
            [passport_location] => Office
            [passport_expiry_reminder] => 1_month
            [passport_file] => 
            [department_id] => 3
            [designation_id] => 7
            [role] => Admin
            [software_access] => Yes
            [joining_date] => 2025-12-01
            [status] => Active
            [created_at] => 2026-03-07 01:55:55
            [department_name] => OFFICE
            [designation_name] => Operation Manager
        )

    [6] => stdClass Object
        (
            [employee_id] => 10
            [employee_code] => 
            [employee_name] => Ruchira Nadeesha Adikari Appuhamilage
            [mobile] => +971 52 868 4576
            [email] => ruchiranedeesha6@gmail.com
            [address] => Dubai,UAE
            [passport_number] => N7422493
            [passport_issue_date] => 2018-04-25
            [passport_expiry_date] => 2028-04-25
            [passport_location] => Employee
            [passport_expiry_reminder] => 3_months
            [passport_file] => 
            [department_id] => 5
            [designation_id] => 10
            [role] => Technician
            [software_access] => No
            [joining_date] => 2025-12-04
            [status] => Active
            [created_at] => 2026-03-07 02:19:14
            [department_name] => Operation
            [designation_name] => Senior Mechanic
        )

)

ERROR - 2026-04-23 13:51:10 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 13:51:22 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 14:03:34 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 15:39:41 --> Jobcard Data: stdClass Object
(
    [jobcard_id] => 205
    [jobcard_no] => JC-2026-0041
    [estimation_id] => 366
    [appointment_id] => 
    [customer_id] => 577
    [vehicle_id] => 719
    [jobcard_date] => 2026-04-09
    [jobcard_time] => 
    [km_in] => 137404
    [expected_delivery_date] => 0000-00-00
    [completion_time] => 00:00:00
    [technician_id] => 
    [status] => Scheduled
    [remarks] => RECOMMENDATION: FRT LOWER ARM , ENGINE OIL PUMP,ENGINE OIL PRESSURE,REGULATOR VALVE,TYRE PRESSURE SENSOR
    [subtotal] => 0.00
    [tax_percent] => 0.00
    [tax_amount] => 0.00
    [discount] => 0.00
    [grand_total] => 0.00
    [created_by] => 7
    [created_at] => 2026-04-17 13:32:07
    [quotation_id] => 151
    [quotation_no] => QT-2026-0042
    [quotation_date] => 2026-04-09
    [quotation_subtotal] => 628.95
    [quotation_tax] => 31.45
    [quotation_discount] => 0.00
    [quotation_grand_total] => 660.40
    [quotation_status] => Approved
    [sdiscount] => 0.00
    [subdiscount] => 0.00
    [customer_name] => Shaun Michael Bromfield
    [customer_phone] => 971563076825
    [customer_email] => 
    [customer_trn] => 
    [cistomer_address] => Dubai,UAE
    [customer_emirates] => Dubai
    [registration_no] => 	C15872
    [brand] => Volkswagen
    [model] => Tiguan
    [variant] => petrol
    [year] => 2018
    [chassis_no] => WVGCD1AX4JW940668
    [engine_no] => 
    [services] => Array
        (
        )

    [parts] => Array
        (
            [0] => stdClass Object
                (
                    [id] => 3165
                    [part_id] => 17
                    [qty] => 1
                    [selling_price] => 0.00
                    [dis_amount] => 0.00
                    [total_price] => 0.00
                    [part_name] => Engine oil filter
                )

            [1] => stdClass Object
                (
                    [id] => 3164
                    [part_id] => 7
                    [qty] => 1
                    [selling_price] => 0.00
                    [dis_amount] => 0.00
                    [total_price] => 0.00
                    [part_name] => Engine oil
                )

            [2] => stdClass Object
                (
                    [id] => 3163
                    [part_id] => 55
                    [qty] => 1
                    [selling_price] => 599.00
                    [dis_amount] => 0.00
                    [total_price] => 599.00
                    [part_name] => Minor service
                )

        )

    [descriptions] => Array
        (
        )

    [total_advance] => 300
    [used_advance] => 0
    [available_advance] => 300
    [fully_invoiced] => 
)

ERROR - 2026-04-23 14:09:42 --> 151
ERROR - 2026-04-23 15:42:51 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 15:42:51 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 59
            [invoice_code] => POD/26/0023
            [uid] => 102
            [grand_total] => 480.00
            [ref_no] => 
            [invoice_date] => 2026-03-06
            [po_code] => POD/26/0023
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 51
            [invoice_code] => GRN/26/0013
            [uid] => 102
            [grand_total] => 1865.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0029
            [utype] => supplier
            [source] => GRN
        )

    [2] => stdClass Object
        (
            [inv_id] => 53
            [invoice_code] => GRN/26/0015
            [uid] => 102
            [grand_total] => 190.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0030
            [utype] => supplier
            [source] => GRN
        )

    [3] => stdClass Object
        (
            [inv_id] => 65
            [invoice_code] => GRN/26/0027
            [uid] => 102
            [grand_total] => 2400.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0048
            [utype] => supplier
            [source] => GRN
        )

    [4] => stdClass Object
        (
            [inv_id] => 77
            [invoice_code] => GRN/26/0035
            [uid] => 102
            [grand_total] => 2700.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0063
            [utype] => supplier
            [source] => GRN
        )

    [5] => stdClass Object
        (
            [inv_id] => 78
            [invoice_code] => GRN/26/0036
            [uid] => 102
            [grand_total] => 1400.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0064
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:43:37 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 59
            [invoice_code] => POD/26/0023
            [uid] => 102
            [grand_total] => 480.00
            [ref_no] => 
            [invoice_date] => 2026-03-06
            [po_code] => POD/26/0023
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 51
            [invoice_code] => GRN/26/0013
            [uid] => 102
            [grand_total] => 1865.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0029
            [utype] => supplier
            [source] => GRN
        )

    [2] => stdClass Object
        (
            [inv_id] => 53
            [invoice_code] => GRN/26/0015
            [uid] => 102
            [grand_total] => 190.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0030
            [utype] => supplier
            [source] => GRN
        )

    [3] => stdClass Object
        (
            [inv_id] => 65
            [invoice_code] => GRN/26/0027
            [uid] => 102
            [grand_total] => 2400.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0048
            [utype] => supplier
            [source] => GRN
        )

    [4] => stdClass Object
        (
            [inv_id] => 77
            [invoice_code] => GRN/26/0035
            [uid] => 102
            [grand_total] => 2700.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0063
            [utype] => supplier
            [source] => GRN
        )

    [5] => stdClass Object
        (
            [inv_id] => 78
            [invoice_code] => GRN/26/0036
            [uid] => 102
            [grand_total] => 1400.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0064
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 15:44:43 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 15:44:43 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 109
            [invoice_code] => POD/26/0066
            [uid] => 109
            [grand_total] => 229.95
            [ref_no] => 
            [invoice_date] => 2026-03-31
            [po_code] => POD/26/0066
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 59
            [invoice_code] => POD/26/0023
            [uid] => 102
            [grand_total] => 480.00
            [ref_no] => 
            [invoice_date] => 2026-03-06
            [po_code] => POD/26/0023
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 51
            [invoice_code] => GRN/26/0013
            [uid] => 102
            [grand_total] => 1865.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0029
            [utype] => supplier
            [source] => GRN
        )

    [2] => stdClass Object
        (
            [inv_id] => 53
            [invoice_code] => GRN/26/0015
            [uid] => 102
            [grand_total] => 190.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0030
            [utype] => supplier
            [source] => GRN
        )

    [3] => stdClass Object
        (
            [inv_id] => 65
            [invoice_code] => GRN/26/0027
            [uid] => 102
            [grand_total] => 2400.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0048
            [utype] => supplier
            [source] => GRN
        )

    [4] => stdClass Object
        (
            [inv_id] => 77
            [invoice_code] => GRN/26/0035
            [uid] => 102
            [grand_total] => 2700.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0063
            [utype] => supplier
            [source] => GRN
        )

    [5] => stdClass Object
        (
            [inv_id] => 78
            [invoice_code] => GRN/26/0036
            [uid] => 102
            [grand_total] => 1400.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0064
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 15:45:11 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 59
            [invoice_code] => POD/26/0023
            [uid] => 102
            [grand_total] => 480.00
            [ref_no] => 
            [invoice_date] => 2026-03-06
            [po_code] => POD/26/0023
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 51
            [invoice_code] => GRN/26/0013
            [uid] => 102
            [grand_total] => 1865.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0029
            [utype] => supplier
            [source] => GRN
        )

    [2] => stdClass Object
        (
            [inv_id] => 53
            [invoice_code] => GRN/26/0015
            [uid] => 102
            [grand_total] => 190.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0030
            [utype] => supplier
            [source] => GRN
        )

    [3] => stdClass Object
        (
            [inv_id] => 65
            [invoice_code] => GRN/26/0027
            [uid] => 102
            [grand_total] => 2400.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0048
            [utype] => supplier
            [source] => GRN
        )

    [4] => stdClass Object
        (
            [inv_id] => 77
            [invoice_code] => GRN/26/0035
            [uid] => 102
            [grand_total] => 2700.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0063
            [utype] => supplier
            [source] => GRN
        )

    [5] => stdClass Object
        (
            [inv_id] => 78
            [invoice_code] => GRN/26/0036
            [uid] => 102
            [grand_total] => 1400.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0064
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 15:47:28 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 44
            [invoice_code] => GRN/26/0006
            [uid] => 95
            [grand_total] => 635.25
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0015
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 15:47:28 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 44
            [invoice_code] => GRN/26/0006
            [uid] => 95
            [grand_total] => 635.25
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0015
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 14:23:36 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 4653.100
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
            [balance] => -4538.500
        )

)

ERROR - 2026-04-23 14:23:46 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 4653.100
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
            [balance] => -4538.500
        )

)

ERROR - 2026-04-23 14:25:35 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 4653.100
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
            [balance] => -4538.500
        )

)

ERROR - 2026-04-23 14:47:22 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 4653.100
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
            [balance] => -4538.500
        )

)

ERROR - 2026-04-23 14:49:56 --> 404 Page Not Found: 
ERROR - 2026-04-23 15:00:58 --> Account ID: 2903
ERROR - 2026-04-23 15:01:04 --> Account ID: 2837
ERROR - 2026-04-23 16:31:04 --> Supplier ID from model: 99
ERROR - 2026-04-23 16:31:04 --> account_id: 2837
ERROR - 2026-04-23 15:01:51 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 15:07:33 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 15:14:50 --> Account ID: 2835
ERROR - 2026-04-23 16:44:50 --> Supplier ID from model: 97
ERROR - 2026-04-23 16:44:50 --> account_id: 2835
ERROR - 2026-04-23 15:15:28 --> Account ID: 2837
ERROR - 2026-04-23 16:45:28 --> Supplier ID from model: 99
ERROR - 2026-04-23 16:45:28 --> account_id: 2837
ERROR - 2026-04-23 15:15:45 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 17:01:23 --> Jobcard Data: stdClass Object
(
    [jobcard_id] => 205
    [jobcard_no] => JC-2026-0041
    [estimation_id] => 366
    [appointment_id] => 
    [customer_id] => 577
    [vehicle_id] => 719
    [jobcard_date] => 2026-04-09
    [jobcard_time] => 
    [km_in] => 137404
    [expected_delivery_date] => 0000-00-00
    [completion_time] => 00:00:00
    [technician_id] => 
    [status] => Scheduled
    [remarks] => RECOMMENDATION: FRT LOWER ARM , ENGINE OIL PUMP,ENGINE OIL PRESSURE,REGULATOR VALVE,TYRE PRESSURE SENSOR
    [subtotal] => 0.00
    [tax_percent] => 0.00
    [tax_amount] => 0.00
    [discount] => 0.00
    [grand_total] => 0.00
    [created_by] => 7
    [created_at] => 2026-04-17 13:32:07
    [quotation_id] => 151
    [quotation_no] => QT-2026-0042
    [quotation_date] => 2026-04-09
    [quotation_subtotal] => 628.95
    [quotation_tax] => 31.45
    [quotation_discount] => 0.00
    [quotation_grand_total] => 660.40
    [quotation_status] => Approved
    [sdiscount] => 0.00
    [subdiscount] => 0.00
    [customer_name] => Shaun Michael Bromfield
    [customer_phone] => 971563076825
    [customer_email] => 
    [customer_trn] => 
    [cistomer_address] => Dubai,UAE
    [customer_emirates] => Dubai
    [registration_no] => 	C15872
    [brand] => Volkswagen
    [model] => Tiguan
    [variant] => petrol
    [year] => 2018
    [chassis_no] => WVGCD1AX4JW940668
    [engine_no] => 
    [services] => Array
        (
        )

    [parts] => Array
        (
            [0] => stdClass Object
                (
                    [id] => 3165
                    [part_id] => 17
                    [qty] => 1
                    [selling_price] => 0.00
                    [dis_amount] => 0.00
                    [total_price] => 0.00
                    [part_name] => Engine oil filter
                )

            [1] => stdClass Object
                (
                    [id] => 3164
                    [part_id] => 7
                    [qty] => 1
                    [selling_price] => 0.00
                    [dis_amount] => 0.00
                    [total_price] => 0.00
                    [part_name] => Engine oil
                )

            [2] => stdClass Object
                (
                    [id] => 3163
                    [part_id] => 55
                    [qty] => 1
                    [selling_price] => 599.00
                    [dis_amount] => 0.00
                    [total_price] => 599.00
                    [part_name] => Minor service
                )

        )

    [descriptions] => Array
        (
        )

    [total_advance] => 300
    [used_advance] => 0
    [available_advance] => 300
    [fully_invoiced] => 
)

ERROR - 2026-04-23 15:31:24 --> 151
ERROR - 2026-04-23 16:06:37 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 16:07:00 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 16:07:03 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 16:09:34 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 16:21:59 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 16:22:24 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 17:02:07 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 17:32:58 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 17:33:41 --> Array
(
    [0] => stdClass Object
        (
            [account_id] => 2263
            [account_name] => ABU DHABI COMMERCIAL BANK
            [group_name] => Bank Accounts
            [balance] => 5288.850
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

ERROR - 2026-04-23 17:33:49 --> Account ID: 2837
ERROR - 2026-04-23 19:03:49 --> Supplier ID from model: 99
ERROR - 2026-04-23 19:03:49 --> account_id: 2837
ERROR - 2026-04-23 19:09:03 --> Voucher Code: RV/26/00009
ERROR - 2026-04-23 17:40:07 --> Array
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

ERROR - 2026-04-23 17:40:16 --> Array
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

ERROR - 2026-04-23 17:40:16 --> Array
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

ERROR - 2026-04-23 19:11:51 --> Invoice Data: Array
(
    [invoice] => stdClass Object
        (
            [invoice_id] => 89
            [jobcard_id] => 143
            [invoice_no] => TI-2026-0006
            [invoice_type] => TI
            [invoice_date] => 2026-03-03
            [subtotal] => 956.14
            [tax_amount] => 47.81
            [discount_amount] => 0.00
            [invoiced_amount] => 
            [cumulative_invoiced] => 
            [grand_total] => 1003.95
            [balance_after_invoice] => 
            [status] => Unpaid
            [created_at] => 2026-03-31 07:25:47
            [quotation_id] => 92
            [remarks] => EXEEDED 4,000KM For service
            [paid_amt] => 
            [po_number] => 
            [po_date] => 
            [adv_paid] => 
            [quotation_no] => QT-2026-0002
            [quotation_date] => 2026-03-03
            [jobcard_no] => JC-2026-0002
            [km_in] => 138354
            [jobcard_date] => 2026-03-03
            [customer_name] => Brian St Christopher Webster Edwards
            [phone] => 526417917
            [trn] => 
            [address] => Dubai,UAE
            [emirates] => Dubai
            [registration_no] => N86018
            [brand] => Jeep
            [model] => Grand Cherokee
            [chassis_no] => 1C4RJFJT3JC145551
            [year] => 2018
        )

    [services] => Array
        (
        )

    [parts] => Array
        (
            [0] => stdClass Object
                (
                    [item_id] => 390
                    [part_name] => Engine oil filter
                    [item_name] => Engine oil filter
                    [quantity] => 1
                    [invoiceprice] => 0.00
                    [total_price] => 0.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 
                    [part_id] => 17
                    [brand_id] => 0
                    [vehicle_model_id] => 0
                    [purchase_unit_id] => 0
                    [stock_unit_id] => 0
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 0.00
                    [min_stock] => 5
                    [created_at] => 2026-01-12 01:50:07
                    [source_jobcard_item_id] => 17
                )

            [1] => stdClass Object
                (
                    [item_id] => 389
                    [part_name] => Minor service
                    [item_name] => Minor service
                    [quantity] => 1
                    [invoiceprice] => 899.00
                    [total_price] => 899.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 
                    [part_id] => 55
                    [brand_id] => 0
                    [vehicle_model_id] => 0
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 599.00
                    [min_stock] => 1
                    [created_at] => 2026-01-24 13:23:53
                    [source_jobcard_item_id] => 55
                )

            [2] => stdClass Object
                (
                    [item_id] => 388
                    [part_name] => Engine oil
                    [item_name] => Engine oil
                    [quantity] => 8
                    [invoiceprice] => 0.00
                    [total_price] => 0.00
                    [disamount] => 0.00
                    [part_code] => 5W-40
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 
                    [part_id] => 7
                    [brand_id] => 0
                    [vehicle_model_id] => 0
                    [purchase_unit_id] => 0
                    [stock_unit_id] => 0
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 0.00
                    [min_stock] => 3
                    [created_at] => 2025-11-27 03:46:22
                    [source_jobcard_item_id] => 7
                )

        )

    [sublets] => Array
        (
            [0] => stdClass Object
                (
                    [item_id] => 391
                    [item_name] => Drop off service
                    [quantity] => 1
                    [unit_price] => 57.14
                    [total_price] => 57.14
                )

        )

    [payments] => Array
        (
            [0] => stdClass Object
                (
                    [voucher_id] => 1349
                    [voucher_code] => RV/26/00002
                    [voucher_date] => 2026-03-03 04:56:56
                    [amount] => 1003.950
                    [payment_type] => 
                    [narration] => Jeep cherokee payment
                    [customer_id] => 194
                )

        )

    [paid] => 1003.95
    [balance] => 0
)

ERROR - 2026-04-23 19:11:51 --> Severity: Warning --> Undefined property: stdClass::$payment_date /home/greenea4/public_html/projects/gms/application/views/invoice/print_pdf.php 397
ERROR - 2026-04-23 19:11:51 --> Severity: Warning --> Undefined property: stdClass::$payment_mode /home/greenea4/public_html/projects/gms/application/views/invoice/print_pdf.php 398
ERROR - 2026-04-23 19:13:28 --> Invoice Data: Array
(
    [invoice] => stdClass Object
        (
            [invoice_id] => 90
            [jobcard_id] => 145
            [invoice_no] => TI-2026-0007
            [invoice_type] => TI
            [invoice_date] => 2026-03-04
            [subtotal] => 1312.00
            [tax_amount] => 62.40
            [discount_amount] => 64.00
            [invoiced_amount] => 
            [cumulative_invoiced] => 
            [grand_total] => 1310.40
            [balance_after_invoice] => 
            [status] => Unpaid
            [created_at] => 2026-03-31 07:38:58
            [quotation_id] => 94
            [remarks] => 
            [paid_amt] => 
            [po_number] => 
            [po_date] => 
            [adv_paid] => 
            [quotation_no] => QT-2026-0004
            [quotation_date] => 2026-03-04
            [jobcard_no] => JC-2026-0004
            [km_in] => 173146
            [jobcard_date] => 2026-03-04
            [customer_name] => Mihaela Gabriela Lacobita
            [phone] => 585952388
            [trn] => 
            [address] => 
            [emirates] => 
            [registration_no] => U36233
            [brand] => BMW
            [model] => 520i
            [chassis_no] => WBA5A3102GG303914
            [year] => 2016
        )

    [services] => Array
        (
            [0] => stdClass Object
                (
                    [item_id] => 392
                    [item_name] => Brake Pad Replacement (Front)
                    [quantity] => 1
                    [unit_price] => 320.00
                    [total_price] => 320.00
                )

        )

    [parts] => Array
        (
            [0] => stdClass Object
                (
                    [item_id] => 393
                    [part_name] => Front brake sensor
                    [item_name] => Front brake sensor
                    [quantity] => 1
                    [invoiceprice] => 133.00
                    [total_price] => 133.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 18
                    [brand_id] => 0
                    [vehicle_model_id] => 0
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 50.00
                    [min_stock] => 0
                    [created_at] => 2026-01-12 03:06:48
                    [source_jobcard_item_id] => 18
                )

            [1] => stdClass Object
                (
                    [item_id] => 394
                    [part_name] => Front brake pad
                    [item_name] => Front brake pad
                    [quantity] => 1
                    [invoiceprice] => 779.00
                    [total_price] => 779.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 5
                    [brand_id] => 2
                    [vehicle_model_id] => 3
                    [purchase_unit_id] => 0
                    [stock_unit_id] => 0
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 130.00
                    [min_stock] => 2
                    [created_at] => 2025-11-27 03:46:22
                    [source_jobcard_item_id] => 5
                )

        )

    [sublets] => Array
        (
            [0] => stdClass Object
                (
                    [item_id] => 395
                    [item_name] => Front disc skimming
                    [quantity] => 1
                    [unit_price] => 80.00
                    [total_price] => 80.00
                )

        )

    [payments] => Array
        (
            [0] => stdClass Object
                (
                    [voucher_id] => 1389
                    [voucher_code] => RV/26/00004
                    [voucher_date] => 2026-03-06 06:00:41
                    [amount] => 1310.400
                    [payment_type] => 
                    [narration] => TI-2026-0007 BMW 520i PAYMENT
                    [customer_id] => 61
                )

        )

    [paid] => 1310.4
    [balance] => 0
)

ERROR - 2026-04-23 19:13:28 --> Severity: Warning --> Undefined property: stdClass::$payment_date /home/greenea4/public_html/projects/gms/application/views/invoice/print_pdf.php 397
ERROR - 2026-04-23 19:13:28 --> Severity: Warning --> Undefined property: stdClass::$payment_mode /home/greenea4/public_html/projects/gms/application/views/invoice/print_pdf.php 398
ERROR - 2026-04-23 19:15:34 --> Invoice Data: Array
(
    [invoice] => stdClass Object
        (
            [invoice_id] => 93
            [jobcard_id] => 146
            [invoice_no] => TI-2026-0009
            [invoice_type] => TI
            [invoice_date] => 2026-03-05
            [subtotal] => 1430.00
            [tax_amount] => 71.50
            [discount_amount] => 0.00
            [invoiced_amount] => 
            [cumulative_invoiced] => 
            [grand_total] => 1501.50
            [balance_after_invoice] => 
            [status] => Unpaid
            [created_at] => 2026-04-01 09:01:00
            [quotation_id] => 95
            [remarks] => 
            [paid_amt] => 
            [po_number] => 
            [po_date] => 
            [adv_paid] => 
            [quotation_no] => QT-2026-0005
            [quotation_date] => 2026-03-05
            [jobcard_no] => JC-2026-0005
            [km_in] => 203764
            [jobcard_date] => 2026-03-05
            [customer_name] => Peter Ronald Harry Smithson
            [phone] => 585910948
            [trn] => 
            [address] => 
            [emirates] => 
            [registration_no] => J64595
            [brand] => Dodge
            [model] => Challenger
            [chassis_no] => 2C3CDYBT3EH245695
            [year] => 2014
        )

    [services] => Array
        (
            [0] => stdClass Object
                (
                    [item_id] => 413
                    [item_name] => Labour Charges
                    [quantity] => 1
                    [unit_price] => 560.00
                    [total_price] => 560.00
                )

        )

    [parts] => Array
        (
            [0] => stdClass Object
                (
                    [item_id] => 414
                    [part_name] => Alternator
                    [item_name] => Alternator
                    [quantity] => 1
                    [invoiceprice] => 720.00
                    [total_price] => 720.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => Aftermarket Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 93
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 2
                    [stock_unit_id] => 2
                    [qty_per_purchase_unit] => 0.00
                    [unit_price] => 560.00
                    [min_stock] => 1
                    [created_at] => 2026-02-28 12:29:41
                    [source_jobcard_item_id] => 93
                )

        )

    [sublets] => Array
        (
            [0] => stdClass Object
                (
                    [item_id] => 415
                    [item_name] => Recovery service
                    [quantity] => 1
                    [unit_price] => 150.00
                    [total_price] => 150.00
                )

        )

    [payments] => Array
        (
            [0] => stdClass Object
                (
                    [voucher_id] => 1754
                    [voucher_code] => RV/26/00009
                    [voucher_date] => 2026-03-09 07:04:43
                    [amount] => 1501.500
                    [payment_type] => 
                    [narration] => TI-2026-0009 DODGE CHALLENGER PAYMENT
                    [customer_id] => 118
                )

        )

    [paid] => 1501.5
    [balance] => 0
)

ERROR - 2026-04-23 19:15:34 --> Severity: Warning --> Undefined property: stdClass::$payment_date /home/greenea4/public_html/projects/gms/application/views/invoice/print_pdf.php 397
ERROR - 2026-04-23 19:15:34 --> Severity: Warning --> Undefined property: stdClass::$payment_mode /home/greenea4/public_html/projects/gms/application/views/invoice/print_pdf.php 398
ERROR - 2026-04-23 17:46:03 --> 99
ERROR - 2026-04-23 19:16:18 --> Invoice Data: Array
(
    [invoice] => stdClass Object
        (
            [invoice_id] => 94
            [jobcard_id] => 150
            [invoice_no] => TI-2026-0010
            [invoice_type] => TI
            [invoice_date] => 2026-03-06
            [subtotal] => 14486.00
            [tax_amount] => 724.30
            [discount_amount] => 0.00
            [invoiced_amount] => 
            [cumulative_invoiced] => 
            [grand_total] => 15210.30
            [balance_after_invoice] => 
            [status] => Unpaid
            [created_at] => 2026-04-01 09:59:24
            [quotation_id] => 99
            [remarks] => 
            [paid_amt] => 
            [po_number] => 
            [po_date] => 
            [adv_paid] => 
            [quotation_no] => QT-2026-0009
            [quotation_date] => 2026-03-06
            [jobcard_no] => JC-2026-0009
            [km_in] => 97650
            [jobcard_date] => 2026-03-06
            [customer_name] => DAWIA BUSINESS CENTRE L.L.C
            [phone] => +971565034199
            [trn] => 104305721300003
            [address] => Office 2406, 24th Floor, The Exchange,
Parcel ID: 346-474, Business Bay, Dubai
231095, Dubai, Dubai
            [emirates] => Dubai
            [registration_no] => M80214
            [brand] => Chevrolet
            [model] => Tahoe
            [chassis_no] => 1GNSK8KD3NR261912
            [year] => 2022
        )

    [services] => Array
        (
            [0] => stdClass Object
                (
                    [item_id] => 439
                    [item_name] => Pull down engine (top overhaul)
                    [quantity] => 1
                    [unit_price] => 2000.00
                    [total_price] => 2000.00
                )

        )

    [parts] => Array
        (
            [0] => stdClass Object
                (
                    [item_id] => 457
                    [part_name] => Exhaust gasket
                    [item_name] => Exhaust gasket
                    [quantity] => 2
                    [invoiceprice] => 87.00
                    [total_price] => 174.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 130
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 87.00
                    [min_stock] => 1
                    [created_at] => 2026-03-09 14:13:10
                    [source_jobcard_item_id] => 130
                )

            [1] => stdClass Object
                (
                    [item_id] => 456
                    [part_name] => Intake manifold gasket
                    [item_name] => Intake manifold gasket
                    [quantity] => 8
                    [invoiceprice] => 35.00
                    [total_price] => 280.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 129
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 35.00
                    [min_stock] => 1
                    [created_at] => 2026-03-09 14:12:12
                    [source_jobcard_item_id] => 129
                )

            [2] => stdClass Object
                (
                    [item_id] => 455
                    [part_name] => Cylinder head gasket
                    [item_name] => Cylinder head gasket
                    [quantity] => 2
                    [invoiceprice] => 335.00
                    [total_price] => 670.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 128
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 335.00
                    [min_stock] => 1
                    [created_at] => 2026-03-09 14:11:03
                    [source_jobcard_item_id] => 128
                )

            [3] => stdClass Object
                (
                    [item_id] => 454
                    [part_name] => Flushing oil
                    [item_name] => Flushing oil
                    [quantity] => 2
                    [invoiceprice] => 45.00
                    [total_price] => 90.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 0
                    [part_id] => 127
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 45.00
                    [min_stock] => 1
                    [created_at] => 2026-03-09 14:10:23
                    [source_jobcard_item_id] => 127
                )

            [4] => stdClass Object
                (
                    [item_id] => 453
                    [part_name] => PCV Valve
                    [item_name] => PCV Valve
                    [quantity] => 1
                    [invoiceprice] => 110.00
                    [total_price] => 110.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 126
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 110.00
                    [min_stock] => 1
                    [created_at] => 2026-03-09 14:08:58
                    [source_jobcard_item_id] => 126
                )

            [5] => stdClass Object
                (
                    [item_id] => 452
                    [part_name] => Thermostat
                    [item_name] => Thermostat
                    [quantity] => 1
                    [invoiceprice] => 215.00
                    [total_price] => 215.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 26
                    [brand_id] => 54
                    [vehicle_model_id] => 274
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 150.00
                    [min_stock] => 3
                    [created_at] => 2026-01-12 05:13:40
                    [source_jobcard_item_id] => 26
                )

            [6] => stdClass Object
                (
                    [item_id] => 451
                    [part_name] => Engine oil pan gasket
                    [item_name] => Engine oil pan gasket
                    [quantity] => 1
                    [invoiceprice] => 100.00
                    [total_price] => 100.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 125
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 100.00
                    [min_stock] => 1
                    [created_at] => 2026-03-09 13:42:45
                    [source_jobcard_item_id] => 125
                )

            [7] => stdClass Object
                (
                    [item_id] => 450
                    [part_name] => Lower radiator hose
                    [item_name] => Lower radiator hose
                    [quantity] => 1
                    [invoiceprice] => 240.00
                    [total_price] => 240.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 124
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 240.00
                    [min_stock] => 1
                    [created_at] => 2026-03-09 13:41:19
                    [source_jobcard_item_id] => 124
                )

            [8] => stdClass Object
                (
                    [item_id] => 449
                    [part_name] => Upper radiator hose
                    [item_name] => Upper radiator hose
                    [quantity] => 1
                    [invoiceprice] => 330.00
                    [total_price] => 330.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 123
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 330.00
                    [min_stock] => 1
                    [created_at] => 2026-03-09 13:40:55
                    [source_jobcard_item_id] => 123
                )

            [9] => stdClass Object
                (
                    [item_id] => 448
                    [part_name] => Coolant
                    [item_name] => Coolant
                    [quantity] => 2
                    [invoiceprice] => 80.00
                    [total_price] => 160.00
                    [disamount] => 0.00
                    [part_code] => CLNT1
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 
                    [part_id] => 8
                    [brand_id] => 0
                    [vehicle_model_id] => 0
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 80.00
                    [min_stock] => 5
                    [created_at] => 2025-11-27 03:46:22
                    [source_jobcard_item_id] => 8
                )

            [10] => stdClass Object
                (
                    [item_id] => 447
                    [part_name] => Valve seal
                    [item_name] => Valve seal
                    [quantity] => 16
                    [invoiceprice] => 180.00
                    [total_price] => 2880.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 97
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 20.00
                    [min_stock] => 1
                    [created_at] => 2026-02-28 13:01:49
                    [source_jobcard_item_id] => 97
                )

            [11] => stdClass Object
                (
                    [item_id] => 446
                    [part_name] => Front crank oil seal
                    [item_name] => Front crank oil seal
                    [quantity] => 1
                    [invoiceprice] => 150.00
                    [total_price] => 150.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 90
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 75.00
                    [min_stock] => 1
                    [created_at] => 2026-02-28 12:29:17
                    [source_jobcard_item_id] => 90
                )

            [12] => stdClass Object
                (
                    [item_id] => 445
                    [part_name] => Valve cover gasket
                    [item_name] => Valve cover gasket
                    [quantity] => 2
                    [invoiceprice] => 50.00
                    [total_price] => 100.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 95
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 70.00
                    [min_stock] => 1
                    [created_at] => 2026-02-28 12:33:24
                    [source_jobcard_item_id] => 95
                )

            [13] => stdClass Object
                (
                    [item_id] => 444
                    [part_name] => Radiator
                    [item_name] => Radiator
                    [quantity] => 1
                    [invoiceprice] => 1078.00
                    [total_price] => 1078.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => Aftermarket Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 132
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 1078.00
                    [min_stock] => 1
                    [created_at] => 2026-03-09 14:14:40
                    [source_jobcard_item_id] => 132
                )

            [14] => stdClass Object
                (
                    [item_id] => 443
                    [part_name] => Consumables
                    [item_name] => Consumables
                    [quantity] => 1
                    [invoiceprice] => 300.00
                    [total_price] => 300.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 
                    [part_id] => 39
                    [brand_id] => 54
                    [vehicle_model_id] => 274
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 0.00
                    [min_stock] => 10
                    [created_at] => 2026-01-17 01:48:55
                    [source_jobcard_item_id] => 39
                )

            [15] => stdClass Object
                (
                    [item_id] => 442
                    [part_name] => Engine oil
                    [item_name] => Engine oil
                    [quantity] => 8
                    [invoiceprice] => 0.00
                    [total_price] => 0.00
                    [disamount] => 0.00
                    [part_code] => 5W-40
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 
                    [part_id] => 7
                    [brand_id] => 0
                    [vehicle_model_id] => 0
                    [purchase_unit_id] => 0
                    [stock_unit_id] => 0
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 0.00
                    [min_stock] => 3
                    [created_at] => 2025-11-27 03:46:22
                    [source_jobcard_item_id] => 7
                )

            [16] => stdClass Object
                (
                    [item_id] => 441
                    [part_name] => Minor service
                    [item_name] => Minor service
                    [quantity] => 1
                    [invoiceprice] => 899.00
                    [total_price] => 899.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 
                    [part_id] => 55
                    [brand_id] => 0
                    [vehicle_model_id] => 0
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 599.00
                    [min_stock] => 1
                    [created_at] => 2026-01-24 13:23:53
                    [source_jobcard_item_id] => 55
                )

            [17] => stdClass Object
                (
                    [item_id] => 440
                    [part_name] => Engine oil filter
                    [item_name] => Engine oil filter
                    [quantity] => 1
                    [invoiceprice] => 0.00
                    [total_price] => 0.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 
                    [part_id] => 17
                    [brand_id] => 0
                    [vehicle_model_id] => 0
                    [purchase_unit_id] => 0
                    [stock_unit_id] => 0
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 0.00
                    [min_stock] => 5
                    [created_at] => 2026-01-12 01:50:07
                    [source_jobcard_item_id] => 17
                )

            [18] => stdClass Object
                (
                    [item_id] => 458
                    [part_name] => Coolant hose (no. 8)
                    [item_name] => Coolant hose (no. 8)
                    [quantity] => 1
                    [invoiceprice] => 375.00
                    [total_price] => 375.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 131
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 375.00
                    [min_stock] => 1
                    [created_at] => 2026-03-09 14:14:11
                    [source_jobcard_item_id] => 131
                )

            [19] => stdClass Object
                (
                    [item_id] => 459
                    [part_name] => Water pump
                    [item_name] => Water pump
                    [quantity] => 1
                    [invoiceprice] => 1385.00
                    [total_price] => 1385.00
                    [disamount] => 0.00
                    [part_code] => 
                    [part_type] => New Parts
                    [warrenty] => 
                    [labeling] => 1
                    [part_id] => 86
                    [brand_id] => 
                    [vehicle_model_id] => 
                    [purchase_unit_id] => 1
                    [stock_unit_id] => 1
                    [qty_per_purchase_unit] => 1.00
                    [unit_price] => 0.00
                    [min_stock] => 1
                    [created_at] => 2026-02-28 12:23:47
                    [source_jobcard_item_id] => 86
                )

        )

    [sublets] => Array
        (
            [0] => stdClass Object
                (
                    [item_id] => 460
                    [item_name] => Recovery service
                    [quantity] => 1
                    [unit_price] => 150.00
                    [total_price] => 150.00
                )

            [1] => stdClass Object
                (
                    [item_id] => 461
                    [item_name] => MACHINE SHOP(REFACING,CRACK TEST,VALVE SETTING,POLISHING)
                    [quantity] => 1
                    [unit_price] => 2800.00
                    [total_price] => 2800.00
                )

        )

    [payments] => Array
        (
        )

    [paid] => 0
    [balance] => 15210.3
)

ERROR - 2026-04-23 18:09:44 --> Array
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

ERROR - 2026-04-23 18:10:02 --> Account ID: 2837
ERROR - 2026-04-23 19:40:02 --> Supplier ID from model: 99
ERROR - 2026-04-23 19:40:02 --> account_id: 2837
ERROR - 2026-04-23 18:45:14 --> Array
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

ERROR - 2026-04-23 20:49:06 --> Array
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

ERROR - 2026-04-23 22:19:20 --> Invoice List: Array
(
)

ERROR - 2026-04-23 22:19:21 --> Invoice List: Array
(
)

ERROR - 2026-04-23 22:19:23 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 94
            [invoice_code] => POD/26/0054
            [uid] => 70
            [grand_total] => 105.00
            [ref_no] => 
            [invoice_date] => 2026-03-25
            [po_code] => POD/26/0054
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 79
            [invoice_code] => POD/26/0043
            [uid] => 70
            [grand_total] => 84.00
            [ref_no] => 
            [invoice_date] => 2026-03-18
            [po_code] => POD/26/0043
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 77
            [invoice_code] => POD/26/0041
            [uid] => 70
            [grand_total] => 525.00
            [ref_no] => 
            [invoice_date] => 2026-03-17
            [po_code] => POD/26/0041
            [utype] => supplier
            [source] => PO
        )

    [3] => stdClass Object
        (
            [inv_id] => 78
            [invoice_code] => POD/26/0042
            [uid] => 70
            [grand_total] => 42.00
            [ref_no] => 
            [invoice_date] => 2026-03-17
            [po_code] => POD/26/0042
            [utype] => supplier
            [source] => PO
        )

    [4] => stdClass Object
        (
            [inv_id] => 76
            [invoice_code] => POD/26/0040
            [uid] => 70
            [grand_total] => 105.00
            [ref_no] => 
            [invoice_date] => 2026-03-16
            [po_code] => POD/26/0040
            [utype] => supplier
            [source] => PO
        )

    [5] => stdClass Object
        (
            [inv_id] => 54
            [invoice_code] => POD/26/0018
            [uid] => 70
            [grand_total] => 42.00
            [ref_no] => 
            [invoice_date] => 2026-03-10
            [po_code] => POD/26/0018
            [utype] => supplier
            [source] => PO
        )

    [6] => stdClass Object
        (
            [inv_id] => 48
            [invoice_code] => POD/26/0012
            [uid] => 70
            [grand_total] => 63.00
            [ref_no] => 
            [invoice_date] => 2026-03-07
            [po_code] => POD/26/0012
            [utype] => supplier
            [source] => PO
        )

    [7] => stdClass Object
        (
            [inv_id] => 43
            [invoice_code] => POD/26/0007
            [uid] => 70
            [grand_total] => 21.00
            [ref_no] => 
            [invoice_date] => 2026-03-04
            [po_code] => POD/26/0007
            [utype] => supplier
            [source] => PO
        )

    [8] => stdClass Object
        (
            [inv_id] => 44
            [invoice_code] => POD/26/0008
            [uid] => 70
            [grand_total] => 21.00
            [ref_no] => 
            [invoice_date] => 2026-03-04
            [po_code] => POD/26/0008
            [utype] => supplier
            [source] => PO
        )

    [9] => stdClass Object
        (
            [inv_id] => 39
            [invoice_code] => POD/26/0003
            [uid] => 70
            [grand_total] => 63.00
            [ref_no] => 
            [invoice_date] => 2026-03-03
            [po_code] => POD/26/0003
            [utype] => supplier
            [source] => PO
        )

    [10] => stdClass Object
        (
            [inv_id] => 38
            [invoice_code] => POD/26/0002
            [uid] => 70
            [grand_total] => 551.25
            [ref_no] => 
            [invoice_date] => 2026-03-02
            [po_code] => POD/26/0002
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 22:19:23 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 94
            [invoice_code] => POD/26/0054
            [uid] => 70
            [grand_total] => 105.00
            [ref_no] => 
            [invoice_date] => 2026-03-25
            [po_code] => POD/26/0054
            [utype] => supplier
            [source] => PO
        )

    [1] => stdClass Object
        (
            [inv_id] => 79
            [invoice_code] => POD/26/0043
            [uid] => 70
            [grand_total] => 84.00
            [ref_no] => 
            [invoice_date] => 2026-03-18
            [po_code] => POD/26/0043
            [utype] => supplier
            [source] => PO
        )

    [2] => stdClass Object
        (
            [inv_id] => 77
            [invoice_code] => POD/26/0041
            [uid] => 70
            [grand_total] => 525.00
            [ref_no] => 
            [invoice_date] => 2026-03-17
            [po_code] => POD/26/0041
            [utype] => supplier
            [source] => PO
        )

    [3] => stdClass Object
        (
            [inv_id] => 78
            [invoice_code] => POD/26/0042
            [uid] => 70
            [grand_total] => 42.00
            [ref_no] => 
            [invoice_date] => 2026-03-17
            [po_code] => POD/26/0042
            [utype] => supplier
            [source] => PO
        )

    [4] => stdClass Object
        (
            [inv_id] => 76
            [invoice_code] => POD/26/0040
            [uid] => 70
            [grand_total] => 105.00
            [ref_no] => 
            [invoice_date] => 2026-03-16
            [po_code] => POD/26/0040
            [utype] => supplier
            [source] => PO
        )

    [5] => stdClass Object
        (
            [inv_id] => 54
            [invoice_code] => POD/26/0018
            [uid] => 70
            [grand_total] => 42.00
            [ref_no] => 
            [invoice_date] => 2026-03-10
            [po_code] => POD/26/0018
            [utype] => supplier
            [source] => PO
        )

    [6] => stdClass Object
        (
            [inv_id] => 48
            [invoice_code] => POD/26/0012
            [uid] => 70
            [grand_total] => 63.00
            [ref_no] => 
            [invoice_date] => 2026-03-07
            [po_code] => POD/26/0012
            [utype] => supplier
            [source] => PO
        )

    [7] => stdClass Object
        (
            [inv_id] => 43
            [invoice_code] => POD/26/0007
            [uid] => 70
            [grand_total] => 21.00
            [ref_no] => 
            [invoice_date] => 2026-03-04
            [po_code] => POD/26/0007
            [utype] => supplier
            [source] => PO
        )

    [8] => stdClass Object
        (
            [inv_id] => 44
            [invoice_code] => POD/26/0008
            [uid] => 70
            [grand_total] => 21.00
            [ref_no] => 
            [invoice_date] => 2026-03-04
            [po_code] => POD/26/0008
            [utype] => supplier
            [source] => PO
        )

    [9] => stdClass Object
        (
            [inv_id] => 39
            [invoice_code] => POD/26/0003
            [uid] => 70
            [grand_total] => 63.00
            [ref_no] => 
            [invoice_date] => 2026-03-03
            [po_code] => POD/26/0003
            [utype] => supplier
            [source] => PO
        )

    [10] => stdClass Object
        (
            [inv_id] => 38
            [invoice_code] => POD/26/0002
            [uid] => 70
            [grand_total] => 551.25
            [ref_no] => 
            [invoice_date] => 2026-03-02
            [po_code] => POD/26/0002
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:28 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 39
            [invoice_code] => GRN/26/0001
            [uid] => 71
            [grand_total] => 52.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0004
            [utype] => supplier
            [source] => GRN
        )

    [1] => stdClass Object
        (
            [inv_id] => 40
            [invoice_code] => GRN/26/0002
            [uid] => 71
            [grand_total] => 630.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0005
            [utype] => supplier
            [source] => GRN
        )

    [2] => stdClass Object
        (
            [inv_id] => 41
            [invoice_code] => GRN/26/0003
            [uid] => 71
            [grand_total] => 588.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0006
            [utype] => supplier
            [source] => GRN
        )

    [3] => stdClass Object
        (
            [inv_id] => 42
            [invoice_code] => GRN/26/0004
            [uid] => 71
            [grand_total] => 2210.25
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0010
            [utype] => supplier
            [source] => GRN
        )

    [4] => stdClass Object
        (
            [inv_id] => 46
            [invoice_code] => GRN/26/0008
            [uid] => 71
            [grand_total] => 168.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0017
            [utype] => supplier
            [source] => GRN
        )

    [5] => stdClass Object
        (
            [inv_id] => 47
            [invoice_code] => GRN/26/0009
            [uid] => 71
            [grand_total] => 378.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0019
            [utype] => supplier
            [source] => GRN
        )

    [6] => stdClass Object
        (
            [inv_id] => 48
            [invoice_code] => GRN/26/0010
            [uid] => 71
            [grand_total] => 1706.25
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0020
            [utype] => supplier
            [source] => GRN
        )

    [7] => stdClass Object
        (
            [inv_id] => 49
            [invoice_code] => GRN/26/0011
            [uid] => 71
            [grand_total] => 2409.75
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0021
            [utype] => supplier
            [source] => GRN
        )

    [8] => stdClass Object
        (
            [inv_id] => 56
            [invoice_code] => GRN/26/0018
            [uid] => 71
            [grand_total] => 47.25
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0034
            [utype] => supplier
            [source] => GRN
        )

    [9] => stdClass Object
        (
            [inv_id] => 58
            [invoice_code] => GRN/26/0020
            [uid] => 71
            [grand_total] => 913.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0038
            [utype] => supplier
            [source] => GRN
        )

    [10] => stdClass Object
        (
            [inv_id] => 60
            [invoice_code] => GRN/26/0022
            [uid] => 71
            [grand_total] => 5196.54
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0037
            [utype] => supplier
            [source] => GRN
        )

    [11] => stdClass Object
        (
            [inv_id] => 61
            [invoice_code] => GRN/26/0023
            [uid] => 71
            [grand_total] => 115.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0039
            [utype] => supplier
            [source] => GRN
        )

    [12] => stdClass Object
        (
            [inv_id] => 62
            [invoice_code] => GRN/26/0024
            [uid] => 71
            [grand_total] => 163.80
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0044
            [utype] => supplier
            [source] => GRN
        )

    [13] => stdClass Object
        (
            [inv_id] => 63
            [invoice_code] => GRN/26/0025
            [uid] => 71
            [grand_total] => 84.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0046
            [utype] => supplier
            [source] => GRN
        )

    [14] => stdClass Object
        (
            [inv_id] => 64
            [invoice_code] => GRN/26/0026
            [uid] => 71
            [grand_total] => 1312.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0047
            [utype] => supplier
            [source] => GRN
        )

    [15] => stdClass Object
        (
            [inv_id] => 66
            [invoice_code] => GRN/26/0028
            [uid] => 71
            [grand_total] => 2404.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0049
            [utype] => supplier
            [source] => GRN
        )

    [16] => stdClass Object
        (
            [inv_id] => 67
            [invoice_code] => GRN/26/0029
            [uid] => 71
            [grand_total] => 52.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0055
            [utype] => supplier
            [source] => GRN
        )

    [17] => stdClass Object
        (
            [inv_id] => 68
            [invoice_code] => GRN/26/0030
            [uid] => 71
            [grand_total] => 536.55
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0056
            [utype] => supplier
            [source] => GRN
        )

    [18] => stdClass Object
        (
            [inv_id] => 69
            [invoice_code] => GRN/26/0031
            [uid] => 71
            [grand_total] => 1396.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0058
            [utype] => supplier
            [source] => GRN
        )

    [19] => stdClass Object
        (
            [inv_id] => 70
            [invoice_code] => GRN/26/0032
            [uid] => 71
            [grand_total] => 1396.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0058
            [utype] => supplier
            [source] => GRN
        )

    [20] => stdClass Object
        (
            [inv_id] => 71
            [invoice_code] => GRN/26/0033
            [uid] => 71
            [grand_total] => 2184.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0059
            [utype] => supplier
            [source] => GRN
        )

    [21] => stdClass Object
        (
            [inv_id] => 72
            [invoice_code] => GRN/26/0034
            [uid] => 71
            [grand_total] => 330.75
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0060
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated /home/greenea4/public_html/projects/gms/application/models/Accounts_model.php 3747
ERROR - 2026-04-23 22:19:29 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 39
            [invoice_code] => GRN/26/0001
            [uid] => 71
            [grand_total] => 52.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0004
            [utype] => supplier
            [source] => GRN
        )

    [1] => stdClass Object
        (
            [inv_id] => 40
            [invoice_code] => GRN/26/0002
            [uid] => 71
            [grand_total] => 630.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0005
            [utype] => supplier
            [source] => GRN
        )

    [2] => stdClass Object
        (
            [inv_id] => 41
            [invoice_code] => GRN/26/0003
            [uid] => 71
            [grand_total] => 588.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0006
            [utype] => supplier
            [source] => GRN
        )

    [3] => stdClass Object
        (
            [inv_id] => 42
            [invoice_code] => GRN/26/0004
            [uid] => 71
            [grand_total] => 2210.25
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0010
            [utype] => supplier
            [source] => GRN
        )

    [4] => stdClass Object
        (
            [inv_id] => 46
            [invoice_code] => GRN/26/0008
            [uid] => 71
            [grand_total] => 168.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0017
            [utype] => supplier
            [source] => GRN
        )

    [5] => stdClass Object
        (
            [inv_id] => 47
            [invoice_code] => GRN/26/0009
            [uid] => 71
            [grand_total] => 378.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0019
            [utype] => supplier
            [source] => GRN
        )

    [6] => stdClass Object
        (
            [inv_id] => 48
            [invoice_code] => GRN/26/0010
            [uid] => 71
            [grand_total] => 1706.25
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0020
            [utype] => supplier
            [source] => GRN
        )

    [7] => stdClass Object
        (
            [inv_id] => 49
            [invoice_code] => GRN/26/0011
            [uid] => 71
            [grand_total] => 2409.75
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0021
            [utype] => supplier
            [source] => GRN
        )

    [8] => stdClass Object
        (
            [inv_id] => 56
            [invoice_code] => GRN/26/0018
            [uid] => 71
            [grand_total] => 47.25
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0034
            [utype] => supplier
            [source] => GRN
        )

    [9] => stdClass Object
        (
            [inv_id] => 58
            [invoice_code] => GRN/26/0020
            [uid] => 71
            [grand_total] => 913.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0038
            [utype] => supplier
            [source] => GRN
        )

    [10] => stdClass Object
        (
            [inv_id] => 60
            [invoice_code] => GRN/26/0022
            [uid] => 71
            [grand_total] => 5196.54
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0037
            [utype] => supplier
            [source] => GRN
        )

    [11] => stdClass Object
        (
            [inv_id] => 61
            [invoice_code] => GRN/26/0023
            [uid] => 71
            [grand_total] => 115.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0039
            [utype] => supplier
            [source] => GRN
        )

    [12] => stdClass Object
        (
            [inv_id] => 62
            [invoice_code] => GRN/26/0024
            [uid] => 71
            [grand_total] => 163.80
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0044
            [utype] => supplier
            [source] => GRN
        )

    [13] => stdClass Object
        (
            [inv_id] => 63
            [invoice_code] => GRN/26/0025
            [uid] => 71
            [grand_total] => 84.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0046
            [utype] => supplier
            [source] => GRN
        )

    [14] => stdClass Object
        (
            [inv_id] => 64
            [invoice_code] => GRN/26/0026
            [uid] => 71
            [grand_total] => 1312.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0047
            [utype] => supplier
            [source] => GRN
        )

    [15] => stdClass Object
        (
            [inv_id] => 66
            [invoice_code] => GRN/26/0028
            [uid] => 71
            [grand_total] => 2404.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0049
            [utype] => supplier
            [source] => GRN
        )

    [16] => stdClass Object
        (
            [inv_id] => 67
            [invoice_code] => GRN/26/0029
            [uid] => 71
            [grand_total] => 52.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0055
            [utype] => supplier
            [source] => GRN
        )

    [17] => stdClass Object
        (
            [inv_id] => 68
            [invoice_code] => GRN/26/0030
            [uid] => 71
            [grand_total] => 536.55
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0056
            [utype] => supplier
            [source] => GRN
        )

    [18] => stdClass Object
        (
            [inv_id] => 69
            [invoice_code] => GRN/26/0031
            [uid] => 71
            [grand_total] => 1396.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0058
            [utype] => supplier
            [source] => GRN
        )

    [19] => stdClass Object
        (
            [inv_id] => 70
            [invoice_code] => GRN/26/0032
            [uid] => 71
            [grand_total] => 1396.50
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0058
            [utype] => supplier
            [source] => GRN
        )

    [20] => stdClass Object
        (
            [inv_id] => 71
            [invoice_code] => GRN/26/0033
            [uid] => 71
            [grand_total] => 2184.00
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0059
            [utype] => supplier
            [source] => GRN
        )

    [21] => stdClass Object
        (
            [inv_id] => 72
            [invoice_code] => GRN/26/0034
            [uid] => 71
            [grand_total] => 330.75
            [ref_no] => 
            [invoice_date] => 
            [po_code] => POD/26/0060
            [utype] => supplier
            [source] => GRN
        )

)

ERROR - 2026-04-23 22:55:12 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 45
            [invoice_code] => POD/26/0009
            [uid] => 99
            [grand_total] => 26.99
            [ref_no] => 
            [invoice_date] => 2026-03-05
            [po_code] => POD/26/0009
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 22:55:13 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 45
            [invoice_code] => POD/26/0009
            [uid] => 99
            [grand_total] => 26.99
            [ref_no] => 
            [invoice_date] => 2026-03-05
            [po_code] => POD/26/0009
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 22:59:17 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 45
            [invoice_code] => POD/26/0009
            [uid] => 99
            [grand_total] => 26.99
            [ref_no] => 
            [invoice_date] => 2026-03-05
            [po_code] => POD/26/0009
            [utype] => supplier
            [source] => PO
        )

)

ERROR - 2026-04-23 22:59:18 --> Invoice List: Array
(
    [0] => stdClass Object
        (
            [inv_id] => 45
            [invoice_code] => POD/26/0009
            [uid] => 99
            [grand_total] => 26.99
            [ref_no] => 
            [invoice_date] => 2026-03-05
            [po_code] => POD/26/0009
            [utype] => supplier
            [source] => PO
        )

)

