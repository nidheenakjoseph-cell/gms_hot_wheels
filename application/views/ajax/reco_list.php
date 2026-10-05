<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<?php
$total_receipts = 0;
$total_payments = 0;
$count_receipts = 0;
$count_payments = 0;

foreach ($records as $r) {
    if (strtoupper($r->drcr_type) == 'DR' || strtoupper($r->voucher_type) == 'R') {
        $total_receipts += floatval($r->amount);
        $count_receipts++;
    } else {
        $total_payments += floatval($r->amount);
        $count_payments++;
    }
}
?>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <!-- Receipts Card -->
    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-bold text-xl">
            ↓
        </div>
        <div>
            <p class="text-xs font-semibold text-emerald-700 uppercase tracking-wider">Unreconciled Receipts</p>
            <h3 class="text-xl font-bold text-emerald-900 mt-0.5">₹ <?= number_format($total_receipts, 2) ?></h3>
            <p class="text-[11px] text-emerald-600 font-medium"><?= $count_receipts ?> item(s)</p>
        </div>
    </div>

    <!-- Payments Card -->
    <div class="bg-rose-50 border border-rose-200 rounded-2xl p-4 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 bg-rose-500 text-white rounded-xl flex items-center justify-center font-bold text-xl">
            ↑
        </div>
        <div>
            <p class="text-xs font-semibold text-rose-700 uppercase tracking-wider">Unreconciled Payments</p>
            <h3 class="text-xl font-bold text-rose-900 mt-0.5">₹ <?= number_format($total_payments, 2) ?></h3>
            <p class="text-[11px] text-rose-600 font-medium"><?= $count_payments ?> item(s)</p>
        </div>
    </div>

    <!-- Selected Count Card -->
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center font-bold text-lg">
            <span id="card_selected_count">0</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-blue-700 uppercase tracking-wider">Selected Items</p>
            <h3 class="text-xl font-bold text-blue-900 mt-0.5" id="card_selected_total">₹ 0.00</h3>
            <p class="text-[11px] text-blue-600 font-medium">Ready to reconcile</p>
        </div>
    </div>

    <!-- Total Net Difference Card -->
    <div class="bg-slate-100 border border-slate-300 rounded-2xl p-4 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 bg-slate-700 text-white rounded-xl flex items-center justify-center font-bold text-lg">
            ∑
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Net Unreconciled</p>
            <h3 class="text-xl font-bold text-slate-800 mt-0.5">₹ <?= number_format($total_receipts - $total_payments, 2) ?></h3>
            <p class="text-[11px] text-slate-500 font-medium">Receipts - Payments</p>
        </div>
    </div>
</div>

<!-- Toolbar & Batch Date Helpers -->
<div class="bg-slate-800 text-white rounded-2xl p-4 mb-4 flex flex-wrap items-center justify-between gap-3 shadow-sm">
    <div class="flex items-center gap-3">
        <label class="inline-flex items-center gap-2 cursor-pointer text-sm font-medium hover:text-blue-200 transition">
            <input type="checkbox" id="select_all_cb" onchange="toggleSelectAll(this)" class="w-4 h-4 rounded text-blue-500 focus:ring-offset-gray-800 focus:ring-blue-500">
            <span>Select All Items</span>
        </label>
        <span class="text-slate-600">|</span>
        <span class="text-xs text-slate-300">Quick Batch Actions:</span>
    </div>

    <div class="flex flex-wrap items-center gap-2">
        <button type="button" onclick="fillTodayDates()" class="bg-slate-700 hover:bg-slate-600 text-slate-200 hover:text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition inline-flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Set Today's Date
        </button>

        <button type="button" onclick="copyVoucherDates()" class="bg-slate-700 hover:bg-slate-600 text-slate-200 hover:text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition inline-flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            Copy Voucher Dates
        </button>
    </div>
</div>

<!-- Main Data Table Container -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-6">
    <div class="overflow-x-auto">
        <table id="dr_table" class="min-w-full text-sm divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wider">
                    <th class="px-4 py-3 text-center w-10">Select</th>
                    <th class="px-4 py-3 text-left">Voucher Code</th>
                    <th class="px-4 py-3 text-left">Type</th>
                    <th class="px-4 py-3 text-left">Voucher Date</th>
                    <th class="px-4 py-3 text-left">Dr/Cr</th>
                    <th class="px-4 py-3 text-left">Party / Ledger Name</th>
                    <th class="px-4 py-3 text-left">Narration</th>
                    <th class="px-4 py-3 text-left">Instrument No</th>
                    <th class="px-4 py-3 text-right">Amount (₹)</th>
                    <th class="px-4 py-3 text-left w-36">Bank Date</th>
                    <th class="px-4 py-3 text-center w-28">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 bg-white">
                <?php if (empty($records)): ?>
                    <tr>
                        <td colspan="11" class="text-center py-8 text-gray-400">
                            No unreconciled transactions found for this account.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($records as $r): ?>
                        <?php
                        $voucher_type_name = 'Payment';
                        $type_badge = 'bg-rose-100 text-rose-800';
                        if ($r->voucher_type == 'R') {
                            $voucher_type_name = 'Receipt';
                            $type_badge = 'bg-emerald-100 text-emerald-800';
                        } elseif ($r->voucher_type == 'C') {
                            $voucher_type_name = 'Contra';
                            $type_badge = 'bg-blue-100 text-blue-800';
                        } elseif ($r->voucher_type == 'J') {
                            $voucher_type_name = 'Journal';
                            $type_badge = 'bg-purple-100 text-purple-800';
                        }

                        $is_dr = (strtoupper($r->drcr_type) == 'DR' || $r->voucher_type == 'R');
                        ?>
                        <tr id="row_<?= $r->voucher_id ?>" class="hover:bg-gray-50 transition">
                            <!-- Checkbox -->
                            <td class="px-4 py-3 text-center">
                                <input type="checkbox"
                                    name="inv_id[]"
                                    value="<?php echo $r->voucher_id; ?>"
                                    onchange="updateSelectedTotals()"
                                    class="reco-cb w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            </td>

                            <!-- Voucher Code -->
                            <td class="px-4 py-3 font-semibold text-gray-800">
                                <a href="<?php echo base_url('index.php/Accounts/view_account_transaction_details/' . urlencode($r->voucher_id)); ?>"
                                    target="_blank"
                                    class="bg-slate-100 hover:bg-slate-200 text-slate-600 p-1.5 rounded-lg transition inline-flex items-center justify-center">
                             <?php echo !empty($r->voucher_code) ? $r->voucher_code : ('V#' . $r->voucher_id); ?>
    
                                </a>
                            </td>

                            <!-- Voucher Type Badge -->
                            <td class="px-4 py-3">
                                <span class="px-2.5 py-0.5 text-[11px] font-bold rounded-full <?php echo $type_badge; ?>">
                                    <?php echo $voucher_type_name; ?>
                                </span>
                            </td>

                            <!-- Voucher Date -->
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap" data-vdate="<?php echo date('Y-m-d', strtotime($r->voucher_date)); ?>">
                                <?php echo date('d-M-Y', strtotime($r->voucher_date)); ?>
                                <input type="hidden"
                                    name="instrument_dates[<?php echo $r->voucher_id; ?>]"
                                    value="<?php echo date('Y-m-d', strtotime($r->voucher_date)); ?>">
                            </td>

                            <!-- Dr/Cr -->
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 text-xs font-bold rounded <?php echo $is_dr ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200'; ?>">
                                    <?php echo !empty($r->drcr_type) ? $r->drcr_type : ($is_dr ? 'Dr' : 'Cr'); ?>
                                </span>
                            </td>

                            <!-- Party / Ledger Name -->
                            <td class="px-4 py-3 font-medium text-gray-800">
                                <?php echo !empty($r->account_name) ? $r->account_name : 'N/A'; ?>
                            </td>

                            <!-- Narration -->
                            <td class="px-4 py-3 text-xs text-gray-500 max-w-xs truncate" title="<?php echo htmlspecialchars($r->narration ?? ''); ?>">
                                <?php echo !empty($r->narration) ? substr($r->narration, 0, 30) . (strlen($r->narration) > 30 ? '...' : '') : '-'; ?>
                            </td>

                            <!-- Instrument Number -->
                            <td class="px-4 py-3 text-gray-600">
                                <input type="text"
                                    id="inst_no_<?= $r->voucher_id ?>"
                                    name="instrument_nos[<?php echo $r->voucher_id; ?>]"
                                    value="<?php echo $r->transaction_no; ?>"
                                    placeholder="Inst No"
                                    class="border border-gray-200 rounded px-2 py-1 text-xs w-28 focus:ring-1 focus:ring-blue-500 focus:outline-none">
                            </td>

                            <!-- Amount -->
                            <td class="px-4 py-3 text-right font-bold <?php echo $is_dr ? 'text-emerald-700' : 'text-slate-800'; ?>" data-amount="<?php echo $r->amount; ?>">
                                ₹ <?php echo number_format($r->amount, 2); ?>
                                <input type="hidden"
                                    name="deposit_amounts[<?php echo $r->voucher_id; ?>]"
                                    value="<?php echo $r->amount; ?>">
                            </td>

                            <!-- Bank Date -->
                            <td class="px-4 py-2">
                                <input type="date"
                                    id="bank_date_<?php echo $r->voucher_id; ?>"
                                    name="bank_dates[<?php echo $r->voucher_id; ?>]"
                                    value="<?php echo !empty($r->bank_date) ? date('Y-m-d', strtotime($r->bank_date)) : date('Y-m-d'); ?>"
                                    class="bank-date-input border border-gray-300 rounded-lg px-2 py-1 text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none w-full">
                            </td>

                            <!-- Actions -->
                            <td class="px-4 py-2 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <!-- Single Reconcile Button -->
                                    <button type="button"
                                        onclick="reconcileSingleRow(<?php echo $r->voucher_id; ?>)"
                                        title="Reconcile this item"
                                        class="bg-emerald-600 hover:bg-emerald-700 text-white p-1.5 rounded-lg transition inline-flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>

                                    <!-- View Voucher Link -->
                                    <?php if (!empty($r->voucher_code)): ?>
                                        <a href="<?php echo base_url('index.php/Accounts/view_account_transaction_details/' . urlencode($r->voucher_id)); ?>"
                                            target="_blank"
                                            title="View Details"
                                            class="bg-slate-100 hover:bg-slate-200 text-slate-600 p-1.5 rounded-lg transition inline-flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bulk Submission Footer Bar -->
<div class="bg-gray-50 border border-gray-200 rounded-2xl p-5 flex flex-wrap items-center justify-between gap-4">
    <div class="w-full md:w-96">
        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">
            Reconciliation Remarks
        </label>
        <textarea id="remark" name="remark" rows="2" placeholder="Optional notes or bank statement reference" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white"></textarea>
    </div>

    <div>
        <button type="submit" id="add" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transition inline-flex items-center gap-2 text-base">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Reconcile Selected Items
        </button>
    </div>
</div>
