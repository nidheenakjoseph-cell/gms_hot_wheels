<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-06-30 09:22:43 --> Severity: Warning --> mail(): Failed to connect to mailserver at &quot;localhost&quot; port 25, verify your &quot;SMTP&quot; and &quot;smtp_port&quot; setting in php.ini or use ini_set() C:\xampp\htdocs\gms\system\libraries\Email.php 1903
ERROR - 2026-06-30 09:22:43 --> SMTP Dispatch Rejection log: Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Tue, 30 Jun 2026 09:22:41 +0400
From: &quot;Elite Auto Workshop&quot; &lt;your-garage-email@gmail.com&gt;
Return-Path: &lt;your-garage-email@gmail.com&gt;
Reply-To: &lt;your-garage-email@gmail.com&gt;
User-Agent: CodeIgniter
X-Sender: your-garage-email@gmail.com
X-Mailer: CodeIgniter
X-Priority: 3 (Normal)
Message-ID: &lt;6a4352a12b1f4@gmail.com&gt;
Mime-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
=?UTF-8?Q?Vehicle=20Received=20-=20Job=20Card=20#JC-2026-904?=
&lt;h2&gt;Dear John Doe,&lt;/h2&gt;&lt;p&gt;Your vehicle &lt;strong&gt;MH-12-AB-1234&lt;/strong&gt; has
been received at our workshop.&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Job Card Number:&lt;/strong&gt;
JC-2026-904&lt;br&gt;&lt;strong&gt;Estimated Delivery:&lt;/strong&gt; 2026-06-26 05:00
PM&lt;/p&gt;&lt;p&gt;We will update you once inspection is complete.&lt;/p&gt;
</pre>
ERROR - 2026-06-30 13:26:51 --> Invoice List: Array
(
    [0] => stdClass Object
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
            [paid_amount] => 0.000
        )

    [1] => stdClass Object
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
            [paid_amount] => 0.000
        )

    [2] => stdClass Object
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
            [paid_amount] => 0.000
        )

    [3] => stdClass Object
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
            [paid_amount] => 0.000
        )

    [4] => stdClass Object
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
            [paid_amount] => 6620.250
        )

)

ERROR - 2026-06-30 11:56:57 --> 133
ERROR - 2026-06-30 13:33:07 --> Invoice List: Array
(
    [0] => stdClass Object
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
            [paid_amount] => 0.000
        )

    [1] => stdClass Object
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
            [paid_amount] => 0.000
        )

    [2] => stdClass Object
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
            [paid_amount] => 0.000
        )

    [3] => stdClass Object
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
            [paid_amount] => 0.000
        )

    [4] => stdClass Object
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
            [paid_amount] => 6620.250
        )

)

ERROR - 2026-06-30 12:03:10 --> 136
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:23 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 12:07:24 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:16 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_name' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 532
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 536
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 537
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 541
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 542
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 546
ERROR - 2026-06-30 16:35:17 --> Severity: Notice --> Trying to get property 'item_id' of non-object C:\xampp\htdocs\gms\application\views\inspection\edit.php 547
