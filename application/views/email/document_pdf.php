<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        .muted { color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 18px; }
        th, td { border: 1px solid #bbb; padding: 7px; }
        th { background: #f1f5f9; text-align: left; }
        .amount { text-align: right; }
        .total { margin-top: 18px; text-align: right; font-size: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($document_type, ENT_QUOTES, 'UTF-8') ?></h1>
    <p class="muted">
        Document No: <strong><?= htmlspecialchars($document_no, ENT_QUOTES, 'UTF-8') ?></strong><br>
        Date: <?= htmlspecialchars(date('d/m/Y', strtotime($document_date)), ENT_QUOTES, 'UTF-8') ?><br>
        Customer: <?= htmlspecialchars($customer_name ?? '', ENT_QUOTES, 'UTF-8') ?><br>
        Vehicle No: <?= htmlspecialchars($vehicle_no ?? '', ENT_QUOTES, 'UTF-8') ?>
    </p>
    <table>
        <thead><tr><th>Description</th><th class="amount">Amount</th></tr></thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item->service_name ?? $item->part_name ?? $item->description ?? 'Item', ENT_QUOTES, 'UTF-8') ?></td>
                <td class="amount"><?= number_format((float) ($item->total_cost ?? $item->total_price ?? $item->amount ?? 0), 2) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p class="total">Total: AED <?= number_format((float) $total, 2) ?></p>
</body>
</html>
