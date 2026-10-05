<?php
$this->load->helper('account');

$account_id   = $account_id ?? '';
$account_name = $account_name ?? '';
$group_name   = $group_name ?? '';
$root_type    = $root_type ?? '';
$from         = $from ?? date('Y-01-01');
$to           = $to ?? date('Y-m-d');

$opening_raw  = (float)($opening_raw ?? 0);
$transactions = $transactions ?? [];

if (!function_exists('format_drcr_balance')) {
    function format_drcr_balance($raw) {
        if (round($raw, 2) == 0) {
            return '0.00';
        }
        if ($raw > 0) {
            return number_format($raw, 2) . ' Dr';
        }
        return number_format(abs($raw), 2) . ' Cr';
    }
}

if (!function_exists('balance_sheet_voucher_label')) {
    function balance_sheet_voucher_label($voucher_type, $trans_type = '') {
        switch (strtoupper((string) $voucher_type)) {
            case 'S':
                return 'Sales Invoice';
            case 'G':
                return strtoupper((string) $trans_type) === 'SRN' ? 'SRN' : 'Purchase / GRN Invoice';
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
                return !empty($trans_type) ? $trans_type : 'Transaction';
        }
    }
}
?>

<style>
    .bs-drill-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .bs-drill-table th,
    .bs-drill-table td {
        border: 1px solid #dee2e6;
        padding: 8px 10px;
        vertical-align: middle;
    }

    .bs-drill-table th {
        background: #f8f9fa;
        font-weight: bold;
        text-align: left;
    }

    .bs-drill-table .num {
        text-align: right;
        white-space: nowrap;
    }

    .bs-drill-wrap {
        max-height: 450px;
        overflow-y: auto;
    }

    .bs-drill-meta {
        margin-bottom: 12px;
        font-size: 14px;
    }
</style>

<?php if (empty($account_id)): ?>

    <p style="color:#c82333;">
        No ledger selected for drilldown.
    </p>

<?php else: ?>

    <div class="bs-drill-meta">

        <?php if (!empty($account_name)): ?>
            <div>
                <strong>Ledger:</strong>
                <?= htmlspecialchars($account_name) ?>
                <?php if (!empty($group_name)): ?>
                    <span class="text-muted" style="color: #6c757d;">(Group: <?= htmlspecialchars($group_name) ?>)</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div>
            <strong>Period:</strong>
            <?= date('d M Y', strtotime($from)) ?>
            to
            <?= date('d M Y', strtotime($to)) ?>
        </div>

    </div>

    <div class="bs-drill-wrap">

        <table class="bs-drill-table">

            <thead>
                <tr>
                    <th>Date</th>
                    <th>Reference</th>
                    <th>Narration</th>
                    <th class="num">Debit (Dr)</th>
                    <th class="num">Credit (Cr)</th>
                    <th class="num">Running Balance</th>
                </tr>
            </thead>

            <tbody>

                <!-- Opening Balance Row -->
                <tr style="background-color: #f9f9f9; font-weight: 600;">
                    <td><?= date('d-m-Y', strtotime($from)) ?></td>
                    <td colspan="2"><i>Opening Balance (as of <?= date('d-m-Y', strtotime($from)) ?>)</i></td>
                    <td class="num">-</td>
                    <td class="num">-</td>
                    <td class="num"><?= format_drcr_balance($opening_raw) ?></td>
                </tr>

                <?php
                $running_raw = $opening_raw;
                $total_dr = 0;
                $total_cr = 0;
                ?>

                <?php if (!empty($transactions)): ?>

                    <?php foreach ($transactions as $t): ?>

                        <?php
                        $dr = (strcasecmp($t->drcr_type, 'Dr') === 0) ? (float)$t->amount : 0;
                        $cr = (strcasecmp($t->drcr_type, 'Cr') === 0) ? (float)$t->amount : 0;

                        $total_dr += $dr;
                        $total_cr += $cr;

                        $running_raw += ($dr - $cr);
                        ?>

                        <tr>

                            <td>
                                <?= !empty($t->date)
                                    ? date('d-m-Y', strtotime($t->date))
                                    : '-' ?>
                            </td>

                            <td>
                                <?php if (!empty($t->vcode)): ?>
                                    <strong><?= htmlspecialchars($t->vcode) ?></strong>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                                <?php if (!empty($t->trans_id) && (string) $t->trans_id !== (string) ($t->vcode ?? '')): ?>
                                    <br><small>Transaction: <?= htmlspecialchars($t->trans_id) ?></small>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(!empty($t->narration) ? $t->narration : balance_sheet_voucher_label($t->vtype ?? '', $t->trans_type ?? '')) ?>
                            </td>

                            <td class="num" style="color: green;">
                                <?= $dr > 0 ? number_format($dr, 2) : '-' ?>
                            </td>

                            <td class="num" style="color: red;">
                                <?= $cr > 0 ? number_format($cr, 2) : '-' ?>
                            </td>

                            <td class="num" style="font-weight: 500;">
                                <?= format_drcr_balance($running_raw) ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                <!-- Period Totals Row -->
                <tr style="font-weight:bold; background:#e9ecef;">
                    <td colspan="3">Total Movements in Period</td>
                    <td class="num" style="color: green;"><?= number_format($total_dr, 2) ?></td>
                    <td class="num" style="color: red;"><?= number_format($total_cr, 2) ?></td>
                    <td class="num">-</td>
                </tr>

                <!-- Closing Balance Row -->
                <tr style="font-weight:bold; background:#d4edda; color: #155724;">
                    <td colspan="3">Closing Balance (as of <?= date('d-m-Y', strtotime($to)) ?>)</td>
                    <td colspan="2" class="num">Net: <?= number_format(abs($running_raw), 2) ?></td>
                    <td class="num"><?= format_drcr_balance($running_raw) ?></td>
                </tr>

            </tbody>

        </table>

    </div>

<?php endif; ?>