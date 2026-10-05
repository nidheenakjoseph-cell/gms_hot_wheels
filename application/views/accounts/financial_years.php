<?php
// Guard: equity_accounts and closing_logs are set by the controller.
// Provide safe defaults if called from a context that did not set them.
if (!isset($equity_accounts))  $equity_accounts  = [];
if (!isset($closing_logs))     $closing_logs     = [];
?>
<script>
/* ===================================================================
   FINANCIAL YEARS — page scripts
   =================================================================== */

// ---------- Add Financial Year modal ----------
function openAddFinancialYearModal() {
    var modal = document.getElementById('addFinancialYearModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.getElementById('year_name').focus();
}
function closeAddFinancialYearModal() {
    var modal = document.getElementById('addFinancialYearModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('addFinancialYearModal')
        .addEventListener('click', function (e) { if (e.target === this) closeAddFinancialYearModal(); });

    document.getElementById('addFinancialYearForm')
        .addEventListener('submit', function (e) {
            var s = document.getElementById('financial_year_start_date').value;
            var d = document.getElementById('financial_year_end_date').value;
            if (s && d && s >= d) { e.preventDefault(); alert('Start Date must be before End Date.'); }
        });
});

// ---------- Close Year modal ----------
function openCloseYearModal(yearId, yearName, startDate, endDate) {
    document.getElementById('closeYearId').value     = yearId;
    document.getElementById('closeYearName').textContent  = yearName;
    document.getElementById('closeYearPeriod').textContent = startDate + ' to ' + endDate;

    var modal = document.getElementById('closeYearModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.getElementById('close_reason').focus();
}
function closeCloseYearModal() {
    var modal = document.getElementById('closeYearModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
document.addEventListener('DOMContentLoaded', function () {
    var m = document.getElementById('closeYearModal');
    if (m) {
        m.addEventListener('click', function (e) { if (e.target === this) closeCloseYearModal(); });
    }
    var form = document.getElementById('closeYearForm');
    if (form) {
        form.addEventListener('submit', function (e) {
            var re = document.getElementById('retained_earnings_account_id');
            if (re && re.value === '') {
                e.preventDefault();
                alert('Please select the Retained Earnings / Equity account.');
                return false;
            }
            var reason = document.getElementById('close_reason').value.trim();
            if (reason === '') {
                e.preventDefault();
                alert('Please enter a closing reason.');
                return false;
            }
            return confirm(
                'You are about to CLOSE the financial year shown.\n\n' +
                'This will:\n' +
                '  • Generate a Year-End Closing Journal Voucher (YEC)\n' +
                '  • Zero out all Income & Expense account balances\n' +
                '  • Transfer Net Profit/Loss to the selected Retained Earnings account\n' +
                '  • Lock the year — no transactions can be added or edited\n\n' +
                'This action requires an Admin Reopen to undo.\n\nProceed?'
            );
        });
    }
});

// ---------- Audit log toggle ----------
function toggleAuditLog(yearId) {
    var el = document.getElementById('audit_log_' + yearId);
    if (el) el.classList.toggle('hidden');
}
</script>

<div class="p-4 bg-white rounded-lg shadow">

    <!-- Page header -->
    <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
        <div>
            <h3 class="text-xl font-semibold text-gray-700">Financial Years</h3>
            <p class="text-sm text-gray-500 mt-1">Manage company financial accounting periods</p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" onclick="openAddFinancialYearModal()"
                class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                + Add Financial Year
            </button>
        </div>
    </div>

    <!-- Flash messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="mb-4 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700">
            <?php echo html_escape($this->session->flashdata('success')); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-4 rounded-md bg-red-50 px-4 py-3 text-sm text-red-700">
            <?php echo html_escape($this->session->flashdata('error')); ?>
        </div>
    <?php endif; ?>

    <!-- =====================================================================
         FINANCIAL YEARS TABLE
         ===================================================================== -->
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2 text-left">Financial Year</th>
                    <th class="border px-3 py-2">Start Date</th>
                    <th class="border px-3 py-2">End Date</th>
                    <th class="border px-3 py-2">Status</th>
                    <th class="border px-3 py-2">Net P&amp;L (AED)</th>
                    <th class="border px-3 py-2">Closing JV</th>
                    <th class="border px-3 py-2">Closed By</th>
                    <th class="border px-3 py-2">Closed Date</th>
                    <th class="border px-3 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($financial_years as $year): ?>
                    <?php
                        $is_closed  = ($year->status === 'CLOSED');
                        $is_locked  = in_array((int) $year->id, $tax_finalized_year_ids, true);
                        $net_pl     = isset($year->net_profit_loss) ? (float) $year->net_profit_loss : null;
                        $has_jv     = !empty($year->closing_jv_code);
                        $log_rows   = $closing_logs[$year->id] ?? [];
                    ?>
                    <tr class="hover:bg-gray-50">
                        <!-- Name -->
                        <td class="border px-3 py-2 font-medium"><?php echo html_escape($year->year_name); ?></td>

                        <!-- Dates -->
                        <td class="border px-3 py-2 text-center"><?php echo date('d-M-Y', strtotime($year->start_date)); ?></td>
                        <td class="border px-3 py-2 text-center"><?php echo date('d-M-Y', strtotime($year->end_date)); ?></td>

                        <!-- Status badge -->
                        <td class="border px-3 py-2 text-center">
                            <?php
                                $badge = 'bg-green-100 text-green-700';
                                if ($year->status === 'CLOSED')   $badge = 'bg-red-100 text-red-700';
                                if ($year->status === 'EXTENDED') $badge = 'bg-yellow-100 text-yellow-700';
                            ?>
                            <span class="rounded px-2 py-1 text-xs font-semibold <?php echo $badge; ?>">
                                <?php echo html_escape($year->status); ?>
                            </span>
                        </td>

                        <!-- Net P&L -->
                        <td class="border px-3 py-2 text-right font-mono text-xs">
                            <?php if ($net_pl !== null): ?>
                                <span class="font-semibold <?php echo $net_pl >= 0 ? 'text-green-700' : 'text-red-700'; ?>">
                                    <?php echo ($net_pl >= 0 ? '+' : ''); echo number_format($net_pl, 2); ?>
                                </span>
                            <?php else: ?>
                                <span class="text-gray-400">—</span>
                            <?php endif; ?>
                        </td>

                        <!-- Closing JV code -->
                        <td class="border px-3 py-2 text-center font-mono text-xs">
                            <?php if ($has_jv): ?>
                                <span class="rounded bg-indigo-50 text-indigo-700 px-2 py-0.5 font-semibold">
                                    <?php echo html_escape($year->closing_jv_code); ?>
                                </span>
                            <?php else: ?>
                                <span class="text-gray-400">—</span>
                            <?php endif; ?>
                        </td>

                        <!-- Closed By -->
                        <td class="border px-3 py-2 text-center text-xs">
                            <?php echo !empty($year->closed_by_name) ? html_escape($year->closed_by_name) : '—'; ?>
                        </td>

                        <!-- Closed Date -->
                        <td class="border px-3 py-2 text-center text-xs">
                            <?php echo $year->closed_at ? date('d-M-Y H:i', strtotime($year->closed_at)) : '—'; ?>
                        </td>

                        <!-- Actions -->
                        <td class="border px-3 py-2">
                            <div class="flex flex-col gap-2">

                                <?php if (!$is_closed): ?>
                                    <!-- ── Open year: show Close button (admin only) and audit log toggle -->
                                    <?php if (strtolower((string) $this->session->userdata('role')) === 'admin'): ?>
                                        <button
                                            type="button"
                                            onclick="openCloseYearModal(
                                                '<?php echo (int) $year->id; ?>',
                                                '<?php echo html_escape(addslashes($year->year_name)); ?>',
                                                '<?php echo date('d-M-Y', strtotime($year->start_date)); ?>',
                                                '<?php echo date('d-M-Y', strtotime($year->end_date)); ?>'
                                            )"
                                            class="rounded bg-red-600 px-3 py-1 text-xs text-white hover:bg-red-700 inline-flex items-center gap-1">
                                            🔒 Close Financial Year
                                        </button>
                                    <?php endif; ?>

                                    <!-- Extension request (non-admin) -->
                                    <?php if ($year->status === 'CLOSED' && !$is_locked): ?>
                                        <form method="post" action="<?php echo base_url('index.php/Accounts/request_financial_year_extension'); ?>" class="flex flex-wrap gap-2">
                                            <input type="hidden" name="financial_year_id" value="<?php echo (int) $year->id; ?>">
                                            <input type="date" name="extended_to" min="<?php echo date('Y-m-d', strtotime($year->end_date . ' +1 day')); ?>" required class="border rounded px-2 py-1 text-xs">
                                            <input type="text" name="reason" required placeholder="Reason" class="border rounded px-2 py-1 text-xs">
                                            <button type="submit" class="rounded bg-blue-600 px-3 py-1 text-xs text-white hover:bg-blue-700">Request Extension</button>
                                        </form>
                                    <?php endif; ?>

                                <?php else: ?>
                                    <!-- ── Closed year -->
                                    <?php if ($is_locked): ?>
                                        <!-- Tax finalized: permanently locked -->
                                        <span class="inline-flex items-center gap-1 rounded bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-600"
                                              title="Corporate Tax has been finalized. This financial year is permanently locked.">
                                            🔒 Tax Finalized — Locked
                                        </span>

                                    <?php else: ?>
                                        <!-- Extension request form -->
                                        <form method="post" action="<?php echo base_url('index.php/Accounts/request_financial_year_extension'); ?>" class="flex flex-wrap gap-2">
                                            <input type="hidden" name="financial_year_id" value="<?php echo (int) $year->id; ?>">
                                            <input type="date" name="extended_to" min="<?php echo date('Y-m-d', strtotime($year->end_date . ' +1 day')); ?>" required class="border rounded px-2 py-1 text-xs">
                                            <input type="text" name="reason" required placeholder="Reason" class="border rounded px-2 py-1 text-xs">
                                            <button type="submit" class="rounded bg-blue-600 px-3 py-1 text-xs text-white hover:bg-blue-700">Request Extension</button>
                                        </form>

                                        <?php if (strtolower((string) $this->session->userdata('role')) === 'admin'): ?>
                                            <form method="post" action="<?php echo base_url('index.php/Accounts/reopen_financial_year'); ?>"
                                                  onsubmit="return confirm('⚠️ Reopen this financial year?\n\nThis will VOID the Year-End Closing JV (<?php echo html_escape($year->closing_jv_code ?: 'N/A'); ?>) and restore the year to OPEN.\n\nYou must re-close the year after making corrections.');">
                                                <input type="hidden" name="financial_year_id" value="<?php echo (int) $year->id; ?>">
                                                <button type="submit" class="rounded bg-orange-500 px-3 py-1 text-xs text-white hover:bg-orange-600 inline-flex items-center gap-1">
                                                    🔓 Reopen Year
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- Audit log toggle (always visible if there are entries) -->
                                <?php if (!empty($log_rows)): ?>
                                    <button type="button" onclick="toggleAuditLog(<?php echo (int) $year->id; ?>)"
                                        class="text-xs text-indigo-600 hover:underline text-left">
                                        📋 View Audit Log (<?php echo count($log_rows); ?>)
                                    </button>
                                <?php endif; ?>

                            </div>
                        </td>
                    </tr>

                    <!-- ── Inline audit log panel ───────────────────────────────────── -->
                    <?php if (!empty($log_rows)): ?>
                        <tr id="audit_log_<?php echo (int) $year->id; ?>" class="hidden bg-indigo-50">
                            <td colspan="9" class="border px-4 py-3">
                                <p class="text-xs font-semibold text-indigo-700 mb-2">
                                    Year-End Closing Audit Trail — <?php echo html_escape($year->year_name); ?>
                                </p>
                                <table class="min-w-full text-xs border border-indigo-200">
                                    <thead class="bg-indigo-100">
                                        <tr>
                                            <th class="border px-2 py-1 text-left">Action</th>
                                            <th class="border px-2 py-1">Closing JV</th>
                                            <th class="border px-2 py-1 text-right">Net P&amp;L (AED)</th>
                                            <th class="border px-2 py-1">Retained Earnings A/C</th>
                                            <th class="border px-2 py-1">Performed By</th>
                                            <th class="border px-2 py-1">Date &amp; Time</th>
                                            <th class="border px-2 py-1 text-left">Reason</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($log_rows as $log): ?>
                                            <tr class="hover:bg-indigo-50">
                                                <td class="border px-2 py-1">
                                                    <?php if ($log->action === 'CLOSED'): ?>
                                                        <span class="rounded bg-red-100 text-red-700 px-2 py-0.5 font-semibold">CLOSED</span>
                                                    <?php else: ?>
                                                        <span class="rounded bg-orange-100 text-orange-700 px-2 py-0.5 font-semibold">REOPENED</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="border px-2 py-1 text-center font-mono">
                                                    <?php echo $log->closing_jv_code ? html_escape($log->closing_jv_code) : '—'; ?>
                                                </td>
                                                <td class="border px-2 py-1 text-right font-mono">
                                                    <?php if ($log->net_profit_loss !== null): ?>
                                                        <span class="<?php echo $log->net_profit_loss >= 0 ? 'text-green-700' : 'text-red-700'; ?>">
                                                            <?php echo ($log->net_profit_loss >= 0 ? '+' : ''); echo number_format($log->net_profit_loss, 2); ?>
                                                        </span>
                                                    <?php else: ?>—<?php endif; ?>
                                                </td>
                                                <td class="border px-2 py-1 text-center">
                                                    <?php echo $log->retained_account_name ? html_escape($log->retained_account_name) : '—'; ?>
                                                </td>
                                                <td class="border px-2 py-1 text-center">
                                                    <?php echo html_escape($log->performed_by_name ?? '—'); ?>
                                                </td>
                                                <td class="border px-2 py-1 text-center whitespace-nowrap">
                                                    <?php echo date('d-M-Y H:i', strtotime($log->performed_at)); ?>
                                                </td>
                                                <td class="border px-2 py-1 text-gray-600 max-w-xs truncate" title="<?php echo html_escape($log->reason ?? ''); ?>">
                                                    <?php echo html_escape($log->reason ?? '—'); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    <?php endif; ?>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- /overflow-x-auto -->


    <!-- =====================================================================
         FINANCIAL YEAR EXTENSION REQUESTS
         ===================================================================== -->
    <div class="mt-8">
        <h4 class="mb-3 text-lg font-semibold text-gray-700">Financial Year Extension Requests</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2 text-left">Financial Year</th>
                        <th class="border px-3 py-2">Requested By</th>
                        <th class="border px-3 py-2">Original End Date</th>
                        <th class="border px-3 py-2">Requested End Date</th>
                        <th class="border px-3 py-2">Reason</th>
                        <th class="border px-3 py-2">Status</th>
                        <?php if (strtolower((string) $this->session->userdata('role')) === 'admin'): ?>
                            <th class="border px-3 py-2">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($extension_requests)): ?>
                        <tr>
                            <td class="border px-3 py-3 text-center text-gray-500"
                                colspan="<?php echo strtolower((string) $this->session->userdata('role')) === 'admin' ? '7' : '6'; ?>">
                                No extension requests found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($extension_requests as $request): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="border px-3 py-2 font-medium"><?php echo html_escape($request->year_name); ?></td>
                                <td class="border px-3 py-2 text-center"><?php echo html_escape($request->requested_by_name ?: '—'); ?></td>
                                <td class="border px-3 py-2 text-center"><?php echo date('d-M-Y', strtotime($request->original_end_date)); ?></td>
                                <td class="border px-3 py-2 text-center"><?php echo date('d-M-Y', strtotime($request->extended_to)); ?></td>
                                <td class="border px-3 py-2"><?php echo html_escape($request->reason); ?></td>
                                <td class="border px-3 py-2 text-center"><?php echo html_escape($request->status); ?></td>
                                <?php if (strtolower((string) $this->session->userdata('role')) === 'admin'): ?>
                                    <td class="border px-3 py-2 text-center">
                                        <?php if ($request->status === 'REQUESTED'): ?>
                                            <?php if (in_array((int) $request->financial_year_id, $tax_finalized_year_ids, true)): ?>
                                                <span class="inline-flex items-center gap-1 rounded bg-gray-200 px-2 py-1 text-xs font-semibold text-gray-500"
                                                      title="Corporate Tax finalized — approval is blocked.">
                                                    🔒 Locked
                                                </span>
                                            <?php else: ?>
                                                <form method="post" action="<?php echo base_url('index.php/Accounts/decide_financial_year_extension'); ?>" class="flex justify-center gap-2">
                                                    <input type="hidden" name="extension_id" value="<?php echo (int) $request->id; ?>">
                                                    <button type="submit" name="status" value="APPROVED" class="rounded bg-green-600 px-3 py-1 text-xs text-white hover:bg-green-700">Approve</button>
                                                    <button type="submit" name="status" value="REJECTED" class="rounded bg-red-600 px-3 py-1 text-xs text-white hover:bg-red-700">Reject</button>
                                                </form>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo html_escape($request->approved_by_name ?: '—'); ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div><!-- /extension requests -->


    <!-- =====================================================================
         ADD FINANCIAL YEAR MODAL
         ===================================================================== -->
    <div id="addFinancialYearModal"
         class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="w-full max-w-lg rounded-lg bg-white shadow-xl mx-4">

            <div class="flex items-center justify-between border-b px-5 py-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Add Financial Year</h3>
                    <p class="text-xs text-gray-500 mt-1">Create a new accounting period for this company</p>
                </div>
                <button type="button" onclick="closeAddFinancialYearModal()" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>

            <form method="post" action="<?php echo base_url('index.php/Accounts/add_financial_year'); ?>" id="addFinancialYearForm">
                <div class="p-5">

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">
                            Financial Year <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="year_name" id="year_name" placeholder="Example: FY 2026"
                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Start Date <span class="text-red-500">*</span></label>
                        <input type="date" name="start_date" id="financial_year_start_date"
                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">End Date <span class="text-red-500">*</span></label>
                        <input type="date" name="end_date" id="financial_year_end_date"
                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm" required>
                    </div>

                    <div class="rounded-md bg-blue-50 border border-blue-100 px-4 py-3">
                        <p class="text-sm text-blue-700">New Financial Year will be created with <strong>OPEN</strong> status.</p>
                    </div>
                </div>

                <div class="flex justify-end gap-3 border-t px-5 py-4">
                    <button type="button" onclick="closeAddFinancialYearModal()"
                            class="rounded border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cancel</button>
                    <button type="submit"
                            class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Create Financial Year</button>
                </div>
            </form>
        </div>
    </div><!-- /addFinancialYearModal -->


    <!-- =====================================================================
         CLOSE FINANCIAL YEAR MODAL
         ===================================================================== -->
    <div id="closeYearModal"
         class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-60">
        <div class="w-full max-w-2xl rounded-xl bg-white shadow-2xl mx-4 overflow-hidden">

            <!-- Modal header -->
            <div class="bg-red-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">🔒 Close Financial Year</h3>
                    <p id="closeYearName" class="text-red-100 text-sm mt-0.5 font-medium"></p>
                </div>
                <button type="button" onclick="closeCloseYearModal()" class="text-white hover:text-red-200 text-2xl leading-none">&times;</button>
            </div>

            <!-- What will happen -->
            <div class="px-6 pt-5 pb-3">
                <div class="rounded-lg bg-amber-50 border border-amber-200 px-4 py-3 mb-4">
                    <p class="text-sm font-semibold text-amber-800 mb-1">⚠️ What happens when you close this year?</p>
                    <ul class="list-disc list-inside text-xs text-amber-700 space-y-1">
                        <li>The system verifies the <strong>Trial Balance is balanced</strong>.</li>
                        <li>All <strong>Income &amp; Expense (P&amp;L)</strong> account balances are zeroed out.</li>
                        <li>A <strong>Year-End Closing Journal Voucher (YEC)</strong> is automatically created.</li>
                        <li>The <strong>Net Profit or Loss</strong> is transferred to the selected Retained Earnings account.</li>
                        <li>The Closing JV is <strong>protected</strong> from editing or deletion.</li>
                        <li>All <strong>Balance Sheet accounts</strong> (Assets, Liabilities, Cash, Bank, VAT, etc.) carry forward.</li>
                        <li>The Financial Year is <strong>marked CLOSED</strong> — no transactions can be added or edited.</li>
                    </ul>
                </div>

                <p class="text-xs text-gray-500 mb-4">Period: <strong id="closeYearPeriod"></strong></p>

                <form id="closeYearForm" method="post" action="<?php echo base_url('index.php/Accounts/close_financial_year'); ?>">
                    <input type="hidden" name="financial_year_id" id="closeYearId" value="">

                    <!-- Retained Earnings account -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Retained Earnings / Equity Account
                            <span class="text-red-500">*</span>
                        </label>
                        <select name="retained_earnings_account_id" id="retained_earnings_account_id"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400" required>
                            <option value="">— Select Retained Earnings / Capital account —</option>
                            <?php
                                $last_group = '';
                                foreach ($equity_accounts as $acc):
                                    if ($acc->group_name !== $last_group):
                                        if ($last_group !== '') echo '</optgroup>';
                                        echo '<optgroup label="' . html_escape($acc->group_name) . '">';
                                        $last_group = $acc->group_name;
                                    endif;
                            ?>
                                <option value="<?php echo (int) $acc->account_id; ?>">
                                    <?php echo html_escape($acc->account_name); ?>
                                </option>
                            <?php endforeach; ?>
                            <?php if ($last_group !== '') echo '</optgroup>'; ?>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">
                            The Net Profit/Loss will be transferred to this account.
                            If your Retained Earnings account is not listed, ensure it is under a Capital / Equity group.
                        </p>
                    </div>

                    <!-- Closing reason -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Closing Reason <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="close_reason" id="close_reason" maxlength="500"
                               placeholder="e.g. End of Financial Year 2025-26 — Books finalised"
                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400" required>
                    </div>

                    <div class="flex justify-end gap-3 border-t pt-4">
                        <button type="button" onclick="closeCloseYearModal()"
                                class="rounded border border-gray-300 px-5 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Cancel
                        </button>
                        <button type="submit"
                                class="rounded bg-red-600 px-6 py-2 text-sm font-semibold text-white hover:bg-red-700">
                            🔒 Close Financial Year &amp; Generate JV
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /closeYearModal -->

</div><!-- /page card -->