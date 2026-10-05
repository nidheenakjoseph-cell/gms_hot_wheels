<?php
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
    <title>Trial Balance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .company-info {
            text-align: right;
        }
        .company-info h2 {
            margin: 0;
            font-size: 18px;
        }
        .company-info p {
            margin: 2px 0;
        }
        .title-bar {
            background: #f0f0f0;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        table th, table td {
            border: 1px solid #999;
            padding: 6px;
            text-align: left;
        }
        table th {
            background: #ddd;
        }
        .group-row {
            background: #f9f9f9;
            font-weight: bold;
        }
        .total-row {
            font-weight: bold;
            background: #e0e0e0;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>
<?php $company_profile = get_current_company_details(); ?>
     <!-- Header -->
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">

    <!-- Logo -->
    <img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>" width="20%" alt="Company logo">

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



<div class="title-bar">
    TRIAL BALANCE REPORT<br>
    <span>From <?= htmlspecialchars($from_date) ?> to <?= htmlspecialchars($to_date) ?></span>
</div>

<table>
    <thead>
        <tr>
            <th>Group / Account</th>
            <th></th>
            <th>Debit (AED)</th>
            <th>Credit (AED)</th>
        </tr>
    </thead>
    <tbody>
    <?php
$current_group = null;
$group_debit = 0;
$group_credit = 0;
$grand_debit = 0;
$grand_credit = 0;

foreach ($accounts as $row) {
    if ($current_group !== null && $current_group !== $row['group_name']) {
        // Group Total Row
        echo "<tr class='total-row'>";
        echo "<td>{$current_group} Total</td><td></td>";
        echo "<td style='text-align:right;'>" . number_format($group_debit, 2) . "</td>";
        echo "<td style='text-align:right;'>" . number_format($group_credit, 2) . "</td>";
        echo "</tr>";
        $group_debit = 0;
        $group_credit = 0;
    }

    if ($current_group !== $row['group_name']) {
        echo "<tr class='group-row'><td colspan='4'>{$row['group_name']}</td></tr>";
        $current_group = $row['group_name'];
    }

    // Convert to float with 2 decimal precision (rounding)
    $debit = round(floatval($row['debit']), 2);
    $credit = round(floatval($row['credit']), 2);

    $group_debit += $debit;
    $group_credit += $credit;
    $grand_debit += $debit;
    $grand_credit += $credit;

    echo "<tr>";
    echo "<td>{$row['account_name']}</td><td></td>";
    echo "<td style='text-align:right;'>" . ($debit != 0 ? number_format($debit, 2) : '') . "</td>";
    echo "<td style='text-align:right;'>" . ($credit != 0 ? number_format($credit, 2) : '') . "</td>";
    echo "</tr>";
}

// Last group total
if ($current_group !== null) {
    echo "<tr class='total-row'>";
    echo "<td>{$current_group} Total</td><td></td>";
    echo "<td style='text-align:right;'>" . number_format($group_debit, 2) . "</td>";
    echo "<td style='text-align:right;'>" . number_format($group_credit, 2) . "</td>";
    echo "</tr>";
}

// Grand Total
echo "<tr class='total-row' style='border-top:2px solid #000'>";
echo "<td>Grand Total</td><td></td>";
echo "<td style='text-align:right;'>" . number_format(round($grand_debit, 2), 2) . "</td>";
echo "<td style='text-align:right;'>" . number_format(round($grand_credit, 2), 2) . "</td>";
echo "</tr>";

// Debug output to check difference if needed
if (round($grand_debit, 2) !== round($grand_credit, 2)) {
    $diff = round(abs($grand_debit - $grand_credit), 2);
    echo "<tr style='color:red; font-weight:bold;'><td colspan='4'>Warning: Debit and Credit mismatch by $diff</td></tr>";
}
?>

    </tbody>
</table>

<div class="footer">
    Printed on <?= date('d-M-Y H:i') ?> |
    Printed by <?= $this->session->userdata('username') ?> |
    &copy; <?= date('Y') ?> <?= htmlspecialchars($company_profile->company_name ?? '', ENT_QUOTES, 'UTF-8') ?>
</div>

</body>
</html>
