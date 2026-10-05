<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 12mm; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 0; }
        table { width:100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border:1px solid #444; padding:6px; text-align:left; }
        th { background: #f5f5f5; }
        .header { font-size:18px; font-weight:bold; margin-bottom:10px; }
        .amount { text-align:right; }
        .total { margin-top: 18px; text-align:right; font-size:15px; font-weight:bold; }
    </style>
</head>
<body>

<div class="header">Job Card #<?= htmlspecialchars($jobcard->jobcard_no ?? $jobcard->jobcard_id, ENT_QUOTES, 'UTF-8') ?></div>

<p><strong>Customer:</strong> <?= $jobcard->customer_name ?><br>
<strong>Vehicle:</strong> <?= $jobcard->registration_no ?><br>
<strong>Date:</strong> <?= $jobcard->jobcard_date ?></p>

<h3>Services</h3>
<table>
    <tr><th>Service</th><th class="amount">Cost</th></tr>
    <?php foreach ($jobcard->services as $s): ?>
    <tr>
        <td><?= htmlspecialchars($s->service_name ?? $s->service_id ?? 'Service', ENT_QUOTES, 'UTF-8') ?></td>
        <td class="amount"><?= number_format((float) ($s->total_cost ?? 0), 2) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h3>Parts Used</h3>
<table>
    <tr><th>Part</th><th class="amount">Qty</th><th class="amount">Price</th></tr>
    <?php foreach ($jobcard->parts as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p->part_name ?? $p->part_id ?? 'Part', ENT_QUOTES, 'UTF-8') ?></td>
        <td class="amount"><?= number_format((float) ($p->qty ?? 0), 2) ?></td>
        <td class="amount"><?= number_format((float) ($p->total_price ?? 0), 2) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<p class="total">Net Total: AED <?= number_format((float) ($jobcard->display_total ?? 0), 2) ?></p>

</body>
</html>
