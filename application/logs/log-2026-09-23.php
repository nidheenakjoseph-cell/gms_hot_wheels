<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-09-23 11:10:09 --> Query error: Unknown column 'sr.company_id' in 'where clause' - Invalid query: SELECT `sr`.*, `c`.`name` AS `customer_name`, `c`.`phone` AS `customer_phone`, `c`.`email` AS `customer_email`, `v`.`registration_no` AS `vehicle_no`, COUNT(srl.log_id) AS notify_count
FROM `service_reminders` `sr`
LEFT JOIN `customers` `c` ON `c`.`customer_id` = `sr`.`customer_id`
LEFT JOIN `vehicles` `v` ON `v`.`vehicle_id` = `sr`.`vehicle_id`
LEFT JOIN `service_reminder_logs` `srl` ON `srl`.`reminder_id` = `sr`.`reminder_id`
WHERE `sr`.`company_id` = 1
AND `c`.`branch_id` IN(1, 2, 3)
GROUP BY `sr`.`reminder_id`
ORDER BY `sr`.`reminder_date` DESC, `sr`.`reminder_id` DESC
ERROR - 2026-09-23 14:52:07 --> Severity: Warning --> fsockopen(): php_network_getaddresses: getaddrinfo failed: No such host is known.  C:\xampp\htdocs\gms\system\libraries\Email.php 2070
ERROR - 2026-09-23 14:52:07 --> Severity: Warning --> fsockopen(): unable to connect to ssl:// sandbox.smtp.mailtrap.io:465 (php_network_getaddresses: getaddrinfo failed: No such host is known. ) C:\xampp\htdocs\gms\system\libraries\Email.php 2070
ERROR - 2026-09-23 14:52:07 --> Gms_mailer SMTP error: The following SMTP error was encountered: 0 php_network_getaddresses: getaddrinfo failed: No such host is known. <br />Unable to send email using PHP SMTP. Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 23 Sep 2026 14:52:07 +0530
From: &quot;nidh&quot; &lt;nidheenakjoseph@gmail.com&gt;
Return-Path: &lt;nidheenakjoseph@gmail.com&gt;
To: test@gmail.com
Subject: =?UTF-8?Q?Service=20Reminder=20=20KL=209394=20is=20due=20on=202026-10-18?=
Reply-To: &lt;nidheenakjoseph@gmail.com&gt;
User-Agent: CodeIgniter
X-Sender: nidheenakjoseph@gmail.com
X-Mailer: CodeIgniter
X-Priority: 3 (Normal)
Message-ID: &lt;6ab39a3f2d4f7@gmail.com&gt;
Mime-Version: 1.0


Content-Type: multipart/alternative; boundary=&quot;B_ALT_6ab39a3f2d519&quot;

This is a multi-part message in MIME format.
Your email application may not support this format.

--B_ALT_6ab39a3f2d519
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit

Dear test customer21,
This is a friendly reminder that your vehicle is due for its next service.

 Vehicle No:KL 9394
 Last Service Date:2026-09-18
 Next Service Due:2026-10-18

Please book your appointment at your earliest convenience.
Thank you for choosing Demo Garage .
This is an automated reminder. Please do not reply directly.


--B_ALT_6ab39a3f2d519
Content-Type: text/html; charset=UTF-8
Content-Transfer-Encoding: quoted-printable

&lt;p&gt;Dear test customer21,&lt;/p&gt;=0A&lt;p&gt;This is a friendly reminder that your veh=
icle is due for its next service.&lt;/p&gt;=0A&lt;table style=3D&quot;border-collapse:col=
lapse;width:100%;max-width:500px;&quot;&gt;=0A  &lt;tr&gt;&lt;td style=3D&quot;padding:6px 0;colo=
r:#555;&quot;&gt;Vehicle No:&lt;/td&gt;&lt;td style=3D&quot;padding:6px 0;font-weight:bold;&quot;&gt;KL 9=
394&lt;/td&gt;&lt;/tr&gt;=0A  &lt;tr&gt;&lt;td style=3D&quot;padding:6px 0;color:#555;&quot;&gt;Last Service =
Date:&lt;/td&gt;&lt;td style=3D&quot;padding:6px 0;&quot;&gt;2026-09-18&lt;/td&gt;&lt;/tr&gt;=0A  &lt;tr&gt;&lt;td sty=
le=3D&quot;padding:6px 0;color:#555;&quot;&gt;Next Service Due:&lt;/td&gt;&lt;td style=3D&quot;padding=
:6px 0;font-weight:bold;color:#dc2626;&quot;&gt;2026-10-18&lt;/td&gt;&lt;/tr&gt;=0A&lt;/table&gt;=0A&lt;=
p&gt;Please book your appointment at your earliest convenience.&lt;/p&gt;=0A&lt;p&gt;Thank=
 you for choosing &lt;strong&gt;Demo Garage &lt;/strong&gt;.&lt;/p&gt;=0A&lt;p style=3D&quot;color:#8=
88;font-size:12px;&quot;&gt;This is an automated reminder. Please do not reply dire=
ctly.&lt;/p&gt;

--B_ALT_6ab39a3f2d519--</pre>
ERROR - 2026-09-23 14:53:58 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' C:\xampp\htdocs\gms\application\models\Employee_model.php 203
ERROR - 2026-09-23 13:42:06 --> 404 Page Not Found: Dashboard/inventory_dashboard
ERROR - 2026-09-23 16:32:34 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' C:\xampp\htdocs\gms\application\models\Employee_model.php 203
