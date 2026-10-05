<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-09-17 15:18:52 --> Gms_mailer test_connection error: 220 www.greenearthnetwork.in ESMTP Postfix (Ubuntu)
<br /><pre>hello: 250-www.greenearthnetwork.in
250-PIPELINING
250-SIZE 10240000
250-VRFY
250-ETRN
250-AUTH PLAIN LOGIN
250-AUTH=PLAIN LOGIN
250-ENHANCEDSTATUSCODES
250-8BITMIME
250-DSN
250-SMTPUTF8
250 CHUNKING
</pre>Failed to authenticate password. Error: 535 5.7.8 Error: authentication failed: UGFzc3dvcmQ6
<br />Unable to send email using PHP SMTP. Your server might not be configured to send mail using this method.<br /><pre>Date: Thu, 17 Sep 2026 15:18:46 +0530
From: &quot;GMS&quot; &lt;nidheenakjoseph@gmail.com&gt;
Return-Path: &lt;nidheenakjoseph@gmail.com&gt;
To: nidheenakjoseph@gmail.com
Subject: =?UTF-8?Q?GMS=20SMTP=20Test=20=E2=80=94=202026-09-17=2015:18:46?=
Reply-To: &lt;nidheenakjoseph@gmail.com&gt;
User-Agent: CodeIgniter
X-Sender: nidheenakjoseph@gmail.com
X-Mailer: CodeIgniter
X-Priority: 3 (Normal)
Message-ID: &lt;6aabb77e79c1e@gmail.com&gt;
Mime-Version: 1.0


Content-Type: multipart/alternative; boundary=&quot;B_ALT_6aabb77e79c6a&quot;

This is a multi-part message in MIME format.
Your email application may not support this format.

--B_ALT_6aabb77e79c6a
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit

This is a test email from GMS to confirm your SMTP settings are working
correctly.Sent: 2026-09-17 15:18:46


--B_ALT_6aabb77e79c6a
Content-Type: text/html; charset=UTF-8
Content-Transfer-Encoding: quoted-printable

&lt;p&gt;This is a &lt;strong&gt;test email&lt;/strong&gt; from GMS to confirm your SMTP sett=
ings are working correctly.&lt;/p&gt;&lt;p style=3D&quot;color:#888;font-size:12px;&quot;&gt;Sent=
: 2026-09-17 15:18:46&lt;/p&gt;

--B_ALT_6aabb77e79c6a--</pre>
ERROR - 2026-09-17 16:50:27 --> Query error: Table 'gmslatest.password_reset_tokens' doesn't exist - Invalid query: DELETE FROM `password_reset_tokens`
WHERE `user_id` = '6'
ERROR - 2026-09-17 17:58:37 --> Severity: Warning --> implode(): Invalid arguments passed C:\xampp\htdocs\gms\application\models\Dashboard_model.php 1517
ERROR - 2026-09-17 17:58:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

    ...' at line 34 - Invalid query: SELECT 
            gl.account_id,
            gl.account_name,
            ag.group_name,

            (
                IFNULL(
                    CASE 
                        WHEN gl.opening_bal_type = 'Dr' THEN gl.opening_balance
                        WHEN gl.opening_bal_type = 'Cr' THEN -gl.opening_balance
                        ELSE 0
                    END
                ,0)

                +

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0)

            ) AS balance

        FROM general_ledger gl

        LEFT JOIN account_group ag 
            ON ag.group_no = gl.group_no

        LEFT JOIN voucher_transaction vt 
            ON vt.account_id = gl.account_id
            AND vt.cancel = 0
            AND vt.branch_id IN ()

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

        GROUP BY gl.account_id
        ORDER BY ag.group_name, gl.account_name
