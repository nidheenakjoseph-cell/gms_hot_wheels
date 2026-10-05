<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        h2 { font-size: 14px; margin-top: 20px; border-bottom: 1px solid #bbb; padding-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #bbb; padding: 7px; text-align: left; }
        th { background: #f1f5f9; }
        .amount { text-align: right; }
    </style>
</head>
<body>
    <h1>Insurance Claim Report</h1>
    <p>
        Claim No: <strong><?= htmlspecialchars($claim->claim_number ?? '-', ENT_QUOTES, 'UTF-8') ?></strong><br>
        Date: <?= !empty($claim->claim_date) ? date('d/m/Y', strtotime($claim->claim_date)) : '-' ?><br>
        Customer: <?= htmlspecialchars($claim->customer_name ?? '-', ENT_QUOTES, 'UTF-8') ?><br>
        Policy No: <?= htmlspecialchars($claim->policy_number ?? '-', ENT_QUOTES, 'UTF-8') ?><br>
        Vehicle: <?= htmlspecialchars(trim(($claim->brand ?? '') . ' ' . ($claim->registration_no ?? '')) ?: '-', ENT_QUOTES, 'UTF-8') ?>
    </p>
    <h2>Claim Information</h2>
    <table>
        <tr><th>Claim Type</th><td><?= htmlspecialchars($claim->claim_type ?? '-', ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>Status</th><td><?= htmlspecialchars($claim->claim_status ?? '-', ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>Claim Amount</th><td class="amount">AED <?= number_format((float) ($claim->claim_amount ?? 0), 2) ?></td></tr>
        <tr><th>Approved Amount</th><td class="amount">AED <?= number_format((float) ($claim->approved_amount ?? 0), 2) ?></td></tr>
        <tr><th>Description</th><td><?= nl2br(htmlspecialchars($claim->incident_description ?? '-', ENT_QUOTES, 'UTF-8')) ?></td></tr>
    </table>
</body>
</html>