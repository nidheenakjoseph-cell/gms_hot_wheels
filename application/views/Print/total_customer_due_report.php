<?php
$company = !empty($company_records) ? $company_records[0] : null;
$company_name = $company->company_name ?? '';
$company_address = $company->company_address ?? '';
$company_city = $company->company_city ?? '';
$company_pincode = $company->company_pincode ?? '';
$company_telephone = $company->company_telephone ?? '';
$company_email = $company->company_email_id ?? '';
$company_trn = $company->company_TRN ?? '';
$total_due = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Total Customer Due Report</title>
    <style>
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; background: #fff; color: #000; }
        body { font-family: Arial, sans-serif; font-size: 11px; }
        .print-page { width: 100%; padding: 8px; }
        .company-header { display: flex; align-items: center; gap: 14px; padding-bottom: 8px; border-bottom: 2px solid #222; }
        .company-header img { width: 68px; height: auto; }
        .company-name { font-size: 17px; font-weight: bold; }
        .company-details { margin-top: 3px; line-height: 1.35; }
        .title { margin: 10px 0 5px; padding: 7px; border: 1px solid #000; background: #eee; text-align: center; font-size: 15px; font-weight: bold; }
        .date { text-align: center; margin-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background: #eee; text-align: left; }
        .number { text-align: right; }
        .footer { margin-top: 10px; padding-top: 5px; border-top: 1px solid #000; text-align: center; font-size: 10px; }
        @media print { @page { margin: 10mm; } .print-page { padding: 0; } thead { display: table-header-group; } tr { page-break-inside: avoid; } }
    </style>
</head>
<body>
<div class="print-page">
    <div class="company-header">
        <img src="<?= htmlspecialchars(get_current_company_logo_url(), ENT_QUOTES, 'UTF-8') ?>" alt="Company logo">
        <div>
            <div class="company-name"><?= htmlspecialchars($company_name, ENT_QUOTES, 'UTF-8'); ?></div>
            <div class="company-details">
                <?= htmlspecialchars($company_address, ENT_QUOTES, 'UTF-8'); ?><?= $company_city ? ', ' . htmlspecialchars($company_city, ENT_QUOTES, 'UTF-8') : ''; ?><?= $company_pincode ? ' ' . htmlspecialchars($company_pincode, ENT_QUOTES, 'UTF-8') : ''; ?><br>
                Tel: <?= htmlspecialchars($company_telephone, ENT_QUOTES, 'UTF-8'); ?> | Email: <?= htmlspecialchars($company_email, ENT_QUOTES, 'UTF-8'); ?><?= $company_trn ? ' | TRN: ' . htmlspecialchars($company_trn, ENT_QUOTES, 'UTF-8') : ''; ?>
            </div>
        </div>
    </div>

    <div class="title">TOTAL CUSTOMER DUE REPORT</div>
    <div class="date">Pending customer ledger balances as of <strong><?= date('d M Y', strtotime($to)); ?></strong></div>

    <table>
        <thead>
            <tr>
                <th>S.No</th><th>Customer</th><th>Ledger</th><th class="number">Opening Balance</th><th class="number">Debit</th><th class="number">Credit</th><th class="number">Customer Due</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($records)) : foreach ($records as $index => $row) : $total_due += (float) $row->due_amount; ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= htmlspecialchars($row->customer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($row->account_name, ENT_QUOTES, 'UTF-8'); ?></td>
                <td class="number"><?= number_format((float) $row->opening_balance, 2); ?></td>
                <td class="number"><?= number_format((float) $row->debit, 2); ?></td>
                <td class="number"><?= number_format((float) $row->credit, 2); ?></td>
                <td class="number"><?= number_format((float) $row->due_amount, 2); ?></td>
            </tr>
        <?php endforeach; else : ?>
            <tr><td colspan="7" style="text-align:center;">No pending customer dues found.</td></tr>
        <?php endif; ?>
        </tbody>
        <tfoot>
            <tr><th colspan="6" class="number">Total Customer Due</th><th class="number"><?= number_format($total_due, 2); ?></th></tr>
        </tfoot>
    </table>
    <div class="footer">Printed on <?= date('d-M-Y H:i'); ?> | <?= htmlspecialchars($company_name, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<script>window.onload = function () { window.print(); };</script>
</body>
</html>
