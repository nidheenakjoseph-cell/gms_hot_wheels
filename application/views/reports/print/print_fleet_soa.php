<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fleet Statement of Account</title>
    <style>
        /* ── Force colour preservation across all print engines ── */
        * {
            -webkit-print-color-adjust: exact !important;
                    print-color-adjust: exact !important;
                      color-adjust: exact !important;
            box-sizing: border-box;
        }

        /* ── Base ── */
        body {
            margin: 16px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11.5px;
            color: #1a1a1a;
            background: #fff;
            line-height: 1.45;
        }

        /* ── Typography helpers ── */
        .bold   { font-weight: bold; }
        .muted  { color: #555; }
        .small  { font-size: 10px; }
        .right  { text-align: right; }
        .center { text-align: center; }

        /* ── Dividers ── */
        .rule-heavy { border: none; border-top: 2px solid #1e3a5f; margin: 8px 0; }
        .rule-light { border: none; border-top: 1px solid #c0c8d4; margin: 6px 0; }

        /* ── Section heading ── */
        .section-head {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9.5px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #1e3a5f;
            background: #edf0f5 !important;
            border-left: 3px solid #1e3a5f;
            padding: 5px 8px;
            margin: 0;
        }

        /* ── Panel box ── */
        .panel {
            border: 1px solid #c0c8d4;
        }
        .panel-body {
            padding: 8px 10px;
        }
        .panel-body table {
            width: 100%;
            border-collapse: collapse;
        }
        .panel-body td {
            padding: 2.5px 0;
            vertical-align: top;
        }
        .panel-body .lbl {
            color: #555;
            width: 120px;
            font-size: 11px;
        }

        /* ── KPI strip ── */
        .kpi-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        .kpi-table td {
            border: 1px solid #c0c8d4;
            padding: 8px 10px;
            text-align: center;
            width: 20%;
            background: #f5f7fa !important;
        }
        .kpi-label {
            font-size: 9.5px;
            color: #555;
            margin-bottom: 3px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-family: Arial, Helvetica, sans-serif;
        }
        .kpi-value {
            font-size: 14px;
            font-weight: bold;
            color: #1e3a5f;
        }

        /* ── Aging strip ── */
        .aging-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
        .aging-table th {
            background: #1e3a5f !important;
            color: #fff !important;
            font-size: 9.5px;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-align: center;
            padding: 5px 8px;
            border: 1px solid #1e3a5f;
            width: 16%;
            font-family: Arial, Helvetica, sans-serif;
        }
        .aging-table td {
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            padding: 5px 8px;
            border: 1px solid #c0c8d4;
            background: #f5f7fa !important;
        }

        /* ── Main transactions table ── */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        .main-table thead tr th {
            background: #1e3a5f !important;
            color: #fff !important;
            padding: 6px 7px;
            text-align: left;
            border: 1px solid #16305a;
            font-size: 10.5px;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
            letter-spacing: 0.3px;
        }
        .main-table tbody tr td {
            padding: 4.5px 7px;
            border: 1px solid #dde3ec;
            vertical-align: middle;
        }
        .main-table tbody tr:nth-child(even) td {
            background: #f8f9fb !important;
        }
        .main-table tfoot tr td {
            background: #e8ecf2 !important;
            font-weight: bold;
            border: 1px solid #b0bfd0;
            padding: 5px 7px;
            font-size: 11px;
        }

        /* ── Sub-table (aging summary) ── */
        .sub-table { width: 100%; border-collapse: collapse; font-size: 11px; }
        .sub-table td { padding: 4px 6px; border: 1px solid #dde3ec; }
        .sub-table .sub-total td {
            background: #e8ecf2 !important;
            font-weight: bold;
            border-top: 2px solid #1e3a5f;
        }

        /* ── Debit / Credit colours (minimal — only for running balance) ── */
        .dr { color: #7a1a1a; font-weight: bold; }
        .cr { color: #14532d; font-weight: bold; }

        /* ── Print ── */
        @media print {
            @page { margin: 12mm 10mm; size: A4 landscape; }
            .no-print { display: none !important; }

            /* ── Backgrounds ── */
            .section-head            { background: #edf0f5 !important; color: #1e3a5f !important; border-left: 3px solid #1e3a5f; }
            .main-table thead tr th  { background: #1e3a5f !important; color: #fff !important; }
            .main-table tfoot tr td  { background: #e8ecf2 !important; }
            .main-table tbody tr:nth-child(even) td { background: #f8f9fb !important; }
            .aging-table th          { background: #1e3a5f !important; color: #fff !important; }
            .aging-table td          { background: #f5f7fa !important; }
            .kpi-table td            { background: #f5f7fa !important; }
            .sub-table .sub-total td { background: #e8ecf2 !important; }

            /* ── Page break rules ── */
            /* Header + customer block — never break inside, always keep together */
            table:first-of-type          { page-break-after: avoid; }
            hr.rule-heavy                { page-break-after: avoid; }

            /* Customer details + account summary panel — keep together */
            table:has(.panel)            { page-break-inside: avoid; }
            .panel                       { page-break-inside: avoid; }

            /* KPI strip + aging strip — keep each together, avoid break after */
            .kpi-table                   { page-break-inside: avoid; page-break-after: avoid; }
            .aging-table                 { page-break-inside: avoid; page-break-after: avoid; }

            /* Section heading always stays with first row of its table */
            .section-head                { page-break-after: avoid; }

            /* Transaction table — repeat header on every page, avoid orphan rows */
            .main-table                  { page-break-inside: auto; }
            .main-table thead            { display: table-header-group; }
            .main-table tfoot            { display: table-footer-group; }
            .main-table tbody tr         { page-break-inside: avoid; page-break-after: auto; }

            /* Aging summary + Notes at bottom — keep each panel together,
               try to keep both on same page; if not, each stays intact */
            table:last-of-type           { page-break-inside: avoid; }
            table:last-of-type .panel    { page-break-inside: avoid; }
            table:last-of-type td        { page-break-inside: avoid; }
        }
    </style>
</head>
<body>

<!-- ── Print button (screen only) ── -->
<div class="no-print" style="margin-bottom:14px;">
    <button onclick="window.print()"
            style="padding:6px 16px;background:#1e3a5f;color:#fff;border:0;cursor:pointer;font-size:11.5px;font-weight:bold;">
        Print / Save PDF
    </button>
    <button onclick="window.close()"
            style="padding:6px 16px;background:#6b7280;color:#fff;border:0;cursor:pointer;font-size:11.5px;margin-left:8px;">
        Close
    </button>
</div>

<!-- ── Header ── -->
<table style="width:100%;border-collapse:collapse;margin-bottom:10px;">
    <tr>
        <td style="vertical-align:middle;width:50%;">
            <img src="<?= base_url('public/images/logoauto1.png') ?>" style="height:58px;" alt="Logo">
        </td>
        <td style="text-align:right;vertical-align:top;width:50%;">
            <div style="font-size:20px;font-weight:bold;color:#1e3a5f;letter-spacing:1px;line-height:1.2;font-family:Arial,Helvetica,sans-serif;">
                STATEMENT OF ACCOUNTS
            </div>
            <table style="margin-left:auto;font-size:11px;margin-top:6px;border-collapse:collapse;">
                <tr>
                    <td style="color:#555;padding:2px 10px 2px 0;text-align:right;">Statement Date</td>
                    <td class="bold"><?= date('d M Y') ?></td>
                </tr>
                <tr>
                    <td style="color:#555;padding:2px 10px 2px 0;text-align:right;">Period</td>
                    <td class="bold">
                        <?php if (!empty($from) && !empty($to)): ?>
                            <?= date('d M Y', strtotime($from)) ?> &ndash; <?= date('d M Y', strtotime($to)) ?>
                        <?php elseif (!empty($from)): ?>
                            From <?= date('d M Y', strtotime($from)) ?>
                        <?php elseif (!empty($to)): ?>
                            Up to <?= date('d M Y', strtotime($to)) ?>
                        <?php else: ?>
                            All Transactions
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td style="color:#555;padding:2px 10px 2px 0;text-align:right;">Printed</td>
                    <td><?= date('d M Y, h:i A') ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<hr class="rule-heavy">

<?php
    $s               = $summary;
    $total_invoiced  = $s['total_invoiced'];
    $total_paid      = $s['total_paid'];
    $balance_due     = $s['balance_due'];
    $total_vat       = $s['total_vat'];
    $gl_opening_bal  = $s['gl_opening_bal']  ?? 0;
    $gl_opening_date = $s['gl_opening_date'] ?? null;
?>

<!-- ── Customer details + Account summary ── -->
<table style="width:100%;border-collapse:collapse;margin-bottom:12px;">
    <tr>
        <td style="width:48%;vertical-align:top;padding-right:12px;">
            <div class="panel">
                <div class="section-head">Customer Details</div>
                <div class="panel-body">
                    <table>
                        <tr>
                            <td class="lbl">Customer Name</td>
                            <td>: <strong><?= htmlspecialchars($customer->name) ?></strong></td>
                        </tr>
                        <?php if (!empty($customer->company_contact_person)): ?>
                        <tr><td class="lbl">Contact Person</td><td>: <?= htmlspecialchars($customer->company_contact_person) ?></td></tr>
                        <?php endif; ?>
                        <?php if (!empty($customer->phone)): ?>
                        <tr><td class="lbl">Phone</td><td>: <?= htmlspecialchars($customer->phone) ?></td></tr>
                        <?php endif; ?>
                        <?php if (!empty($customer->email)): ?>
                        <tr><td class="lbl">Email</td><td>: <?= htmlspecialchars($customer->email) ?></td></tr>
                        <?php endif; ?>
                        <?php if (!empty($customer->address)): ?>
                        <tr><td class="lbl" style="vertical-align:top;">Address</td><td>: <?= nl2br(htmlspecialchars($customer->address)) ?></td></tr>
                        <?php endif; ?>
                        <?php if (!empty($customer->trn)): ?>
                        <tr><td class="lbl">TRN</td><td>: <?= htmlspecialchars($customer->trn) ?></td></tr>
                        <?php endif; ?>
                        <?php if (!empty($customer->credit_limit) && $customer->credit_limit > 0): ?>
                        <tr><td class="lbl">Credit Limit</td><td>: AED <?= number_format($customer->credit_limit, 2) ?></td></tr>
                        <?php endif; ?>
                        <?php if (!empty($customer->payment_terms)): ?>
                        <tr><td class="lbl">Payment Terms</td><td>: <?= $customer->payment_terms ?> days</td></tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </td>
        <td style="width:4%;"></td>
        <td style="width:48%;vertical-align:top;padding-left:12px;">
            <div class="panel">
                <div class="section-head">Account Summary</div>
                <div class="panel-body">
                    <table style="border-collapse:collapse;">
                        <?php if ($gl_opening_bal != 0 || $gl_opening_date): ?>
                        <tr>
                            <td style="padding:3px 0;" class="muted">
                                Opening Balance<?= $gl_opening_date ? ' (as at ' . date('d M Y', strtotime($gl_opening_date)) . ')' : '' ?>
                            </td>
                            <td class="right" style="padding:3px 0;">AED <?= number_format($gl_opening_bal, 2) ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td style="padding:3px 0;" class="muted">Total Invoices</td>
                            <td class="right" style="padding:3px 0;">AED <?= number_format($total_invoiced, 2) ?></td>
                        </tr>
                        <tr>
                            <td style="padding:3px 0;" class="muted">Total Payments Received</td>
                            <td class="right" style="padding:3px 0;">AED <?= number_format($total_paid, 2) ?></td>
                        </tr>
                        <tr style="border-top:2px solid #1e3a5f;">
                            <td style="padding:6px 0;font-weight:bold;font-size:12px;">Closing Balance</td>
                            <td class="right <?= $balance_due > 0 ? 'dr' : 'cr' ?>" style="padding:6px 0;font-size:12px;">
                                AED <?= number_format(abs($balance_due), 2) ?> <?= $balance_due > 0 ? 'Dr' : 'Cr' ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
    </tr>
</table>

<!-- ── KPI strip ── -->
<table class="kpi-table">
    <tr>
        <td>
            <div class="kpi-label">Total Invoiced</div>
            <div class="kpi-value">AED <?= number_format($total_invoiced, 2) ?></div>
        </td>
        <td>
            <div class="kpi-label">Total Paid</div>
            <div class="kpi-value">AED <?= number_format($total_paid, 2) ?></div>
        </td>
        <td>
            <div class="kpi-label">Balance</div>
            <div class="kpi-value">AED <?= number_format($balance_due, 2) ?></div>
        </td>
        <td>
            <div class="kpi-label">
                Due Amount<?= !empty($customer->payment_terms) ? ' (Past ' . $customer->payment_terms . ' days)' : '' ?>
            </div>
            <div class="kpi-value">AED <?= number_format($s['due_amount'] ?? 0, 2) ?></div>
        </td>
        <td>
            <div class="kpi-label">VAT Collected</div>
            <div class="kpi-value">AED <?= number_format($total_vat, 2) ?></div>
        </td>
    </tr>
</table>

<!-- ── Aging strip ── -->
<table class="aging-table">
    <thead>
        <tr>
            <th></th>
            <th>0 &ndash; 30 Days</th>
            <th>31 &ndash; 60 Days</th>
            <th>61 &ndash; 90 Days</th>
            <th>91 &ndash; 120 Days</th>
            <th>120+ Days</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align:left;font-weight:bold;color:#555;">Invoiced</td>
            <td>AED <?= number_format($s['bucket_0_30_gross'],    2) ?></td>
            <td>AED <?= number_format($s['bucket_31_60_gross'],   2) ?></td>
            <td>AED <?= number_format($s['bucket_61_90_gross'],   2) ?></td>
            <td>AED <?= number_format($s['bucket_91_120_gross'],  2) ?></td>
            <td>AED <?= number_format($s['bucket_120plus_gross'], 2) ?></td>
        </tr>
        <tr>
            <td style="text-align:left;font-weight:bold;color:#14532d;">Paid</td>
            <td>AED <?= number_format($s['bucket_0_30_paid'],    2) ?></td>
            <td>AED <?= number_format($s['bucket_31_60_paid'],   2) ?></td>
            <td>AED <?= number_format($s['bucket_61_90_paid'],   2) ?></td>
            <td>AED <?= number_format($s['bucket_91_120_paid'],  2) ?></td>
            <td>AED <?= number_format($s['bucket_120plus_paid'], 2) ?></td>
        </tr>
        <tr style="font-weight:bold;">
            <td style="text-align:left;color:#7a1a1a;">Balance</td>
            <td>AED <?= number_format($s['bucket_0_30'],    2) ?></td>
            <td>AED <?= number_format($s['bucket_31_60'],   2) ?></td>
            <td>AED <?= number_format($s['bucket_61_90'],   2) ?></td>
            <td>AED <?= number_format($s['bucket_91_120'],  2) ?></td>
            <td>AED <?= number_format($s['bucket_120plus'], 2) ?></td>
        </tr>
    </tbody>
</table>

<!-- ── Transactions ── -->
<?php if (!empty($soa)): ?>
<div class="section-head" style="margin-bottom:0;">Account Transactions</div>
<table class="main-table">
    <thead>
        <tr>
            <th style="width:3%;">#</th>
            <th style="width:10%;">Date</th>
            <th style="width:12%;">Type</th>
            <th style="width:14%;">Reference</th>
            <th style="width:26%;">Vehicle</th>
            <th class="right" style="width:12%;">Debit (AED)</th>
            <th class="right" style="width:12%;">Credit (AED)</th>
            <th class="right" style="width:12%;">Balance (AED)</th>
            <th class="center" style="width:9%;">Aging (Days)</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach ($soa as $row):
            if ($row->txn_type === 'Opening Balance') continue;
            $is_invoice = ($row->debit > 0);
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= date('d M Y', strtotime($row->txn_date)) ?></td>
            <td><?= htmlspecialchars($is_invoice ? 'Invoice' : $row->txn_type) ?></td>
            <td><?= htmlspecialchars($row->invoice_no ?? '—') ?></td>
            <td><?php
                $veh = trim(($row->brand ?? '') . ' ' . ($row->model ?? ''));
                $reg = $row->registration_no ?? '';
                echo htmlspecialchars($veh ? "$veh – $reg" : ($reg ?: '—'));
            ?></td>
            <td class="right"><?= $row->debit  > 0 ? number_format($row->debit,  2) : '—' ?></td>
            <td class="right"><?= $row->credit > 0 ? number_format($row->credit, 2) : '—' ?></td>
            <td class="right <?= $row->balance > 0 ? 'dr' : ($row->balance < 0 ? 'cr' : '') ?>">
                <?= number_format(abs($row->balance), 2) ?>
                <?= $row->balance > 0 ? ' Dr' : ($row->balance < 0 ? ' Cr' : '') ?>
            </td>
            <td class="center">
                <?php if ($is_invoice && isset($row->aging_days)): ?>
                    <?= htmlspecialchars($row->aging_bucket) ?> (<?= $row->aging_days ?> days)
                <?php else: ?>
                    —
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="right" style="color:#1e3a5f;">Totals</td>
            <td class="right"><?= number_format($total_invoiced, 2) ?></td>
            <td class="right"><?= number_format($total_paid, 2) ?></td>
            <td class="right <?= $balance_due > 0 ? 'dr' : 'cr' ?>">
                <?= number_format(abs($balance_due), 2) ?> <?= $balance_due > 0 ? 'Dr' : 'Cr' ?>
            </td>
            <td></td>
        </tr>
    </tfoot>
</table>
<?php else: ?>
    <p class="center muted" style="padding:24px 0;">No transactions found for the selected period.</p>
<?php endif; ?>

<!-- ── Aging summary + Notes ── -->
<table style="width:100%;border-collapse:collapse;margin-top:18px;">
    <tr>
        <td style="width:46%;vertical-align:top;padding-right:16px;">
            <div class="panel">
                <div class="section-head">
                    Aging Summary (net, payments oldest-first) &mdash; as at <?= !empty($to) ? date('d M Y', strtotime($to)) : date('d M Y') ?>
                </div>
                <table class="sub-table">
                    <tr><td>0 &ndash; 30 Days</td>  <td class="right">AED <?= number_format($s['bucket_0_30'],    2) ?></td></tr>
                    <tr><td>31 &ndash; 60 Days</td> <td class="right">AED <?= number_format($s['bucket_31_60'],   2) ?></td></tr>
                    <tr><td>61 &ndash; 90 Days</td> <td class="right">AED <?= number_format($s['bucket_61_90'],   2) ?></td></tr>
                    <tr><td>91 &ndash; 120 Days</td><td class="right">AED <?= number_format($s['bucket_91_120'],  2) ?></td></tr>
                    <tr><td>120+ Days</td>           <td class="right">AED <?= number_format($s['bucket_120plus'], 2) ?></td></tr>
                    <tr class="sub-total">
                        <td>Total Balance</td>
                        <td class="right dr">AED <?= number_format($balance_due, 2) ?></td>
                    </tr>
                </table>
            </div>
        </td>
        <td style="width:54%;vertical-align:top;padding-left:16px;">
            <div class="panel">
                <div class="section-head">Notes</div>
                <div class="panel-body">
                    <ul style="margin:0;padding-left:16px;line-height:1.9;">
                        <li>Please ensure payments are made within the due date to avoid late fees.</li>
                        <li>For any queries regarding this statement, please contact our accounts department.</li>
                        <?php if (!empty($customer->payment_terms)): ?>
                        <li>Payment terms: <strong><?= $customer->payment_terms ?> days</strong> from invoice date.</li>
                        <?php endif; ?>
                        <li>Aging buckets reflect net outstanding after allocating payments oldest-first (120+ days cleared before 91–120, then 61–90, 31–60, and 0–30).</li>
                    </ul>
                </div>
            </div>
        </td>
    </tr>
</table>

</body>
</html>