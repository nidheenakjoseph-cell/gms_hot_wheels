<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-06-24 10:17:37 --> 404 Page Not Found: Testwa/template
ERROR - 2026-06-24 14:58:41 --> Array
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
            [balance] => 3585.500
        )

)

ERROR - 2026-06-24 14:58:51 --> Severity: error --> Exception: Too few arguments to function Alerts::trigger_jobcard(), 0 passed in C:\xampp\htdocs\gms\system\core\CodeIgniter.php on line 533 and exactly 1 expected C:\xampp\htdocs\gms\application\controllers\Alerts.php 15
ERROR - 2026-06-24 14:59:17 --> Severity: error --> Exception: Too few arguments to function Alerts::trigger_jobcard(), 0 passed in C:\xampp\htdocs\gms\system\core\CodeIgniter.php on line 533 and exactly 1 expected C:\xampp\htdocs\gms\application\controllers\Alerts.php 15
ERROR - 2026-06-24 14:59:41 --> Severity: Warning --> mail(): Failed to connect to mailserver at &quot;localhost&quot; port 25, verify your &quot;SMTP&quot; and &quot;smtp_port&quot; setting in php.ini or use ini_set() C:\xampp\htdocs\gms\system\libraries\Email.php 1903
ERROR - 2026-06-24 14:59:41 --> SMTP Dispatch Rejection log: Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 24 Jun 2026 14:59:39 +0400
From: &quot;Elite Auto Workshop&quot; &lt;your-garage-email@gmail.com&gt;
Return-Path: &lt;your-garage-email@gmail.com&gt;
Reply-To: &lt;your-garage-email@gmail.com&gt;
User-Agent: CodeIgniter
X-Sender: your-garage-email@gmail.com
X-Mailer: CodeIgniter
X-Priority: 3 (Normal)
Message-ID: &lt;6a3bb89b38c35@gmail.com&gt;
Mime-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
=?UTF-8?Q?Vehicle=20Received=20-=20Job=20Card=20#JC-2026-904?=
&lt;h2&gt;Dear John Doe,&lt;/h2&gt;&lt;p&gt;Your vehicle &lt;strong&gt;MH-12-AB-1234&lt;/strong&gt; has
been received at our workshop.&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Job Card Number:&lt;/strong&gt;
JC-2026-904&lt;br&gt;&lt;strong&gt;Estimated Delivery:&lt;/strong&gt; 2026-06-26 05:00
PM&lt;/p&gt;&lt;p&gt;We will update you once inspection is complete.&lt;/p&gt;
</pre>
