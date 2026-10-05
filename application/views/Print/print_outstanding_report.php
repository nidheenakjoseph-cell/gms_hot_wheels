<?php
// echo "<pre>";
// echo "TO: $to\n";
// echo "TYPE: " . $data['request_type'] . "\n";
// exit;
//echo "<pre>"; print_r($request_type ); exit;
// foreach ($comapny_records as $row1) {
//     $company_name = $row1->company_name;
//     $company_add1 = $row1->company_address;
//     $company_city = $row1->company_city;
//     $company_pin = $row1->company_pincode;
//     $company_state = $row1->company_state;
//     $company_website = $row1->company_website;
//     $company_email = $row1->company_email_id;
//     $company_telephone = $row1->company_telephone;
// 	$company_trn = $row1->company_TRN;
// }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Outstanding Report</title>
    <style>
       * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            background: white;
            margin: 0;
            padding: 0;
        }

        #printable {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
        }

        .report-title-bar {
            background-color: #d3d3d3;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            color: #000;
            font-weight: bold;
            text-align: center;
            padding: 8px;
            margin-top: 20px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-weight: bold;
        }

        .meta-info {
            margin-top: 30px;
            font-size: 13px;
        }

        .footer {
            font-size: 12px;
            page-break-inside: avoid;
            margin-top: auto;
            padding-top: 20px;
        }

        .footer .bottom {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            border-top: 1px solid #000;
            padding-top: 8px;
        }

        .no-border td {
            border: none !important;
            padding: 2px 0;
        }

        @media print {
            html, body {
                height: 100%;
            }

            #printable {
                height: auto;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                page-break-after: auto;
            }

            .footer {
                position: relative;
                bottom: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
<?php $company_profile = get_current_company_details(); ?>

  <!-- Header -->
     <!-- Header -->
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">

    <!-- Logo -->
    <img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>" width="30%" style="height:70px;" alt="Company logo">

    <!-- Company Details -->
    <div style="text-align:right; font-size:13px; line-height:1.5;">
        <strong><?= htmlspecialchars($company_profile->company_name ?? '', ENT_QUOTES, 'UTF-8') ?></strong><br>
        <?= htmlspecialchars(implode(', ', array_filter([$company_profile->company_address ?? '', $company_profile->company_city ?? '', $company_profile->company_state ?? '', $company_profile->company_pincode ?? '', $company_profile->company_country ?? ''])), ENT_QUOTES, 'UTF-8') ?><br>
        <?= htmlspecialchars($company_profile->company_website ?? '', ENT_QUOTES, 'UTF-8') ?><br>
        <?= htmlspecialchars($company_profile->company_email_id ?? '', ENT_QUOTES, 'UTF-8') ?><br>
        Tel: <?= htmlspecialchars($company_profile->company_telephone ?? '', ENT_QUOTES, 'UTF-8') ?><br>
        TRN: <?= htmlspecialchars($company_profile->company_TRN ?? '', ENT_QUOTES, 'UTF-8') ?>
    </div>

</div>



<!-- Report Title -->
<div class="report-title-bar">
    <?php
        if ($request_type == 'Sundry Debtors') {
            echo 'OUTSTANDING REPORT - SUNDRY DEBTORS';
        } elseif ($request_type == 'Sundry Creditors') {
            echo 'OUTSTANDING REPORT - SUNDRY CREDITORS';
        } else {
            echo 'OUTSTANDING REPORT';
        }
    ?>
</div><!-- Date Info -->
<table class="sub-table">
    <tr>
        <td><strong>Today's Date:</strong> <?php echo date('d-M-Y'); ?></td>
        <td><strong>From Date:</strong> <?php echo date('d-M-Y', strtotime($_POST['from'])); ?></td>
                <td><strong>To Date:</strong> <?php echo date('d-M-Y', strtotime($_POST['to'])); ?></td>

    </tr>
</table>

<!-- Data Table -->
<table style="margin-top:10px;">
    <thead style="background:#f2f2f2;">
        <tr>
            <th>Srn</th>
            <th style="white-space: nowrap;">Date</th>
            <th>
            <?php 
            if ($request_type == 'Sundry Debtors') {
                echo 'Customer Name';
            } elseif ($request_type == 'Sundry Creditors') {
                echo 'Supplier Name';
            } else {
                echo 'Name';
            }
            ?>
        </th>
            <th>Ref.No</th>
            <th>Total Amount</th>
            <th>Amount Paid</th>
            <th>Outstanding</th>
            <th>Due On</th>
            <th>Overdue By Days</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $total_amt = 0;
        $total_paid = 0;
        $total_due_amt = 0;
        $ct = 0;

        if (!empty($records)):
            $ct = count($records);
            foreach($records as $row): 

                $due_date = strtotime('+3 months', strtotime($row->voucher_date));
                $today = strtotime(date('d-M-Y'));
                $overdue_days = ($today > $due_date) ? floor(($today - $due_date) / (60 * 60 * 24)) : '-';

                $paid_amount = (float)($row->paid_amount ?? 0);

                $total_amt += floatval($row->sum_amt);
                $total_paid += $paid_amount;
                $total_due_amt += floatval($row->sum_due_amt);
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
             <td style="white-space: nowrap;"><?php echo date('d-M-Y', strtotime($row->voucher_date)); ?></td>
            <td>
            <?php 
           if ($request_type == 'Sundry Creditors') {
            echo !empty($row->account_name) ? $row->account_name : 'N/A';
        } else {
            echo !empty($row->cust_name) ? $row->cust_name : 'N/A';
        }
            ?>
            </td>           
             <td><?php echo $row->voucher_code; ?></td>
            <td style="text-align:right;"><?php echo number_format(floatval($row->sum_amt), 2); ?></td>
            <td style="text-align:right;"><?php echo number_format($paid_amount, 2); ?></td>
            <td style="text-align:right;"><?php echo number_format(floatval($row->sum_due_amt), 2); ?></td>
            <td style="white-space: nowrap;"><?php echo date('d-M-Y', $due_date); ?></td>
            <td style="text-align:right;"><?php echo is_numeric($overdue_days) ? $overdue_days : '-'; ?></td>
        </tr>
        <?php endforeach; endif; ?>
    </tbody>
    <tfoot>
        <tr style="font-weight:bold; background:#f2f2f2;">
            <td colspan="4" style="text-align:right;">TOTAL</td>
            <td style="text-align:right;"><?php echo number_format($total_amt, 2); ?></td>
            <td style="text-align:right;"><?php echo number_format($total_paid, 2); ?></td>
            <td style="text-align:right;"><?php echo number_format($total_due_amt, 2); ?></td>
            <td colspan="2"></td>
        </tr>
    </tfoot>
</table>

	<!-- Totals Summary -->
	<div class="summary-row">
		<div><strong>Records Total: <?php echo $i - 1; ?></strong></div>
		<div><strong>Total Amount: <?php echo number_format($total_amt, 2); ?></strong></div>
		<div><strong>Amount Paid: <?php echo number_format($total_paid, 2); ?></strong></div>
		<div><strong>Outstanding: <?php echo number_format($total_due_amt, 2); ?></strong></div>
	</div>
	<!-- Meta Info -->
    <div class="meta-info">
        <strong>Report Dated</strong>: <?= date('d-M-Y'); ?><br>
        <strong>Report Generated By</strong>: <?php echo !empty($user_name) ? $user_name : 'N/A'; ?>
    </div>
<!-- Footer Section -->
	<div class="footer">
		
		<div class="bottom">
            <div>&copy;<?php echo date('Y'); ?> For <?= htmlspecialchars($company_profile->company_name ?? '', ENT_QUOTES, 'UTF-8') ?>, Designed and developed by Concepts 360 Plus</div>
		        <div id="page-number"></div>

		</div>
	</div>
	<script>
    window.onload = function () {
        window.print();
    };

      let totalPages = Math.ceil(document.body.scrollHeight / window.innerHeight);
        document.getElementById("page-number").innerText = "Page 1 of " + totalPages;
</script>
</body>
</html>
