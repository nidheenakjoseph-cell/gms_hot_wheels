<?php
$transactions = $transactions ?? [];
$from         = $from ?? date('Y-m-01');
$to           = $to ?? date('Y-m-d');
$account_name = $account_name ?? '';
$group_name   = $group_name ?? '';
$is_income    = !empty($is_income);
$is_expense   = !empty($is_expense);

if (!function_exists('pnl_drilldown_ledger_name')) {
    function pnl_drilldown_ledger_name($row)
    {
        if (!empty($row->customer_name)) {
            return $row->customer_name;
        }
        if (!empty($row->supplier_name)) {
            return $row->supplier_name;
        }
        if (!empty($row->contra_ledger_name)) {
            return $row->contra_ledger_name;
        }
        return '-';
    }
}

if (!function_exists('pnl_drilldown_voucher_label')) {
    function pnl_drilldown_voucher_label($voucher_type, $trans_type = '')
    {
        switch ($voucher_type) {
            case 'S':
                return 'Sales Invoice';
            case 'G':
                return ($trans_type === 'SRN') ? 'SRN' : 'PO GRN Invoice';
            case 'R':
                return 'Receipt';
            case 'P':
                return 'Payment';
            case 'C':
                return 'Credit Note';
            case 'D':
                return 'Debit Note';
            case 'J':
                return 'Journal';
            case 'N':
                return 'Contra Entry';
            case 'PR':
            case 'PURCHASE_RETURN':
                return 'Purchase Return';
            case 'AD':
                return 'Supplier Advance';
            default:
                return $voucher_type ?: '-';
        }
    }
}

if (!function_exists('pnl_drilldown_particulars')) {
    function pnl_drilldown_particulars($row)
    {
        $invoice_date = (!empty($row->invoice_date) && $row->invoice_date != '0000-00-00')
            ? date('d-M-Y', strtotime($row->invoice_date))
            : '';

        if ($row->voucher_type == 'S') {
            $parts = [];
            if (!empty($row->ref_no)) {
                $parts[] = 'Ref No: ' . htmlspecialchars($row->ref_no);
            }
            if ($invoice_date !== '') {
                $parts[] = 'Invoice Date: ' . $invoice_date;
            }
            if (!empty($row->po_code)) {
                $parts[] = 'Client PO: ' . htmlspecialchars($row->po_code);
            }
            return !empty($parts) ? implode('<br>', $parts) : '-';
        }

        if ($row->voucher_type == 'G') {
            $parts = [];
            if (!empty($row->ref_no)) {
                $parts[] = 'Invoice No: ' . htmlspecialchars($row->ref_no);
            }
            if ($invoice_date !== '') {
                $parts[] = 'Invoice Date: ' . $invoice_date;
            }
            if (!empty($row->po_code)) {
                $parts[] = 'Ref No: ' . htmlspecialchars($row->po_code);
            }
            return !empty($parts) ? implode('<br>', $parts) : '-';
        }

        if ($row->voucher_type == 'P') {
            $parts = [];
            if (!empty($row->ref_no)) {
                $parts[] = 'Invoice No: ' . htmlspecialchars($row->ref_no);
            }
            if ($invoice_date !== '') {
                $parts[] = 'Invoice Date: ' . $invoice_date;
            }
            if (!empty($row->po_code)) {
                $parts[] = 'Ref No: ' . htmlspecialchars($row->po_code);
            }
            if (!empty($row->narration)) {
                $parts[] = htmlspecialchars($row->narration);
            }
            return !empty($parts) ? implode('<br>', $parts) : '-';
        }

        return !empty($row->narration) ? htmlspecialchars($row->narration) : '-';
    }
}
?>

<div class="pnl-drill-meta" style="margin-bottom: 12px; font-size: 13px; color: #374151;">
    <?php if (!empty($account_name)): ?>
        <div><strong>Ledger:</strong> <?= htmlspecialchars($account_name) ?></div>
    <?php endif; ?>
    <?php if (!empty($group_name)): ?>
        <div><strong>Group:</strong> <?= htmlspecialchars($group_name) ?></div>
    <?php endif; ?>
    <div>
        <strong>Period:</strong>
        <?= date('d M Y', strtotime($from)) ?>
        to
        <?= date('d M Y', strtotime($to)) ?>
    </div>
</div>

<table class="table table-striped table-bordered table-sm">

    <thead>
        <tr>
            <th>Date</th>
            <th>Ledger Name</th>
            <th>Voucher No</th>
            <th>Type</th>
            <th>Particulars</th>
            <th class="text-right">Debit (Dr)</th>
            <th class="text-right">Credit (Cr)</th>
        </tr>
    </thead>

    <tbody>

        <?php
        $total_dr = 0;
        $total_cr = 0;
        ?>

        <?php if (!empty($transactions)): ?>

            <?php foreach ($transactions as $t): ?>

                <?php
                $dr = (strcasecmp($t->drcr_type, 'Dr') === 0) ? (float) $t->amount : 0;
                $cr = (strcasecmp($t->drcr_type, 'Cr') === 0) ? (float) $t->amount : 0;
                $total_dr += $dr;
                $total_cr += $cr;
                ?>

                <tr>
                    <td>
                        <?= !empty($t->voucher_date)
                            ? date('d-m-Y', strtotime($t->voucher_date))
                            : '-' ?>
                    </td>

                    <td><?= htmlspecialchars(pnl_drilldown_ledger_name($t)) ?></td>

                    <td>
                        <?php if (!empty($t->voucher_id)): ?>
                            <a class="text-blue-600 hover:underline" href="<?= site_url('Accounts/view_account_transaction_details/' . rawurlencode($t->voucher_id)) ?>">
                                <?= htmlspecialchars($t->voucher_code ?? '-') ?>
                            </a>
                        <?php else: ?>
                            <?= htmlspecialchars($t->voucher_code ?? '-') ?>
                        <?php endif; ?>
                    </td>

                    <td><?= htmlspecialchars(pnl_drilldown_voucher_label($t->voucher_type ?? '', $t->trans_type ?? '')) ?></td>

                    <td><?= pnl_drilldown_particulars($t) ?></td>

                    <td align="right" style="color: #15803d;">
                        <?= $dr > 0 ? number_format($dr, 2) : '-' ?>
                    </td>

                    <td align="right" style="color: #b91c1c;">
                        <?= $cr > 0 ? number_format($cr, 2) : '-' ?>
                    </td>
                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="7" class="text-center">
                    No transactions found for this period.
                </td>
            </tr>

        <?php endif; ?>

    </tbody>

    <?php if (!empty($transactions)): ?>

        <?php
        if ($is_income) {
            $net_movement = $total_cr - $total_dr;
        } elseif ($is_expense) {
            $net_movement = $total_dr - $total_cr;
        } else {
            $net_movement = $total_dr - $total_cr;
        }
        ?>

        <tfoot>
            <tr style="font-weight: bold; background: #f3f4f6;">
                <td colspan="5">Period Total</td>
                <td align="right" style="color: #15803d;"><?= number_format($total_dr, 2) ?></td>
                <td align="right" style="color: #b91c1c;"><?= number_format($total_cr, 2) ?></td>
            </tr>
            <tr style="font-weight: bold; background: #e5e7eb;">
                <td colspan="6">Net Movement (matches P&amp;L amount)</td>
                <td align="right"><?= number_format(abs($net_movement), 2) ?></td>
            </tr>
        </tfoot>

    <?php endif; ?>

</table>
