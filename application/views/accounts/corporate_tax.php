<?php
$is_locked = $calculation && in_array($calculation->status, ['FINALIZED', 'FILED'], true);

$status_badge = '';
if ($calculation) {
    $badge_map = [
        'DRAFT'      => 'bg-gray-200 text-gray-700',
        'CALCULATED' => 'bg-blue-100 text-blue-700',
        'FINALIZED'  => 'bg-green-100 text-green-700',
        'FILED'      => 'bg-purple-100 text-purple-700',
    ];
    $badge_class = $badge_map[$calculation->status] ?? 'bg-gray-100 text-gray-600';
    $status_badge = '<span class="inline-block rounded-full px-3 py-0.5 text-xs font-semibold ' . $badge_class . '">'
        . html_escape($calculation->status) . '</span>';
}
?>
<div class="p-4 bg-white rounded-lg shadow">

    <!-- Header -->
    <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
        <div class="flex items-center gap-3">
            <h3 class="text-xl font-semibold text-gray-700">Corporate Tax</h3>
            <?php echo $status_badge; ?>
        </div>
        <a href="<?php echo base_url('index.php/Accounts/financial_years'); ?>"
           class="text-sm text-blue-600 hover:underline">Financial Years</a>
    </div>

    <!-- Flash Messages -->
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

    <!-- Financial Year Selector -->
    <form method="post" action="<?php echo base_url('index.php/Accounts/corporate_tax'); ?>"
          class="mb-6 flex flex-wrap items-end gap-3">
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Financial Year</label>
            <select name="financial_year_id" required class="border rounded-md px-3 py-2 text-sm">
                <option value="">Select Financial Year</option>
                <?php foreach ($financial_years as $year): ?>
                    <option value="<?php echo (int) $year->id; ?>"
                        <?php echo (int) $year->id === (int) $financial_year_id ? 'selected' : ''; ?>>
                        <?php echo html_escape($year->year_name); ?>
                        <?php if (isset($year->status)): ?>
                            (<?php echo html_escape($year->status); ?>)
                        <?php endif; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button class="rounded-md bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">Load</button>
    </form>

    <?php if ($financial_year_id): ?>

        <?php if (!$is_locked): ?>
        <!-- Add Adjustment + Calculate forms -->
        <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2">

            <!-- Add Adjustment -->
            <form method="post" action="<?php echo base_url('index.php/Accounts/corporate_tax_add_adjustment'); ?>"
                  class="rounded-md border p-4">
                <h4 class="mb-3 font-semibold text-gray-700">Add Tax Adjustment</h4>
                <input type="hidden" name="financial_year_id" value="<?php echo (int) $financial_year_id; ?>">
                <input type="hidden" name="corporate_tax_calculation_id"
                       value="<?php echo $calculation ? (int) $calculation->id : 0; ?>">
                <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
                    <input name="adjustment_type" required placeholder="Adjustment type e.g. Depreciation"
                           class="border rounded px-2 py-2 text-sm col-span-2">
                    <select name="adjustment_direction" required class="border rounded px-2 py-2 text-sm">
                        <option value="ADD">ADD (Non-deductible expense)</option>
                        <option value="DEDUCT">DEDUCT (Exempt income)</option>
                    </select>
                    <select name="source_account_id" class="border rounded px-2 py-2 text-sm">
                        <option value="">Source Account (optional)</option>
                        <?php foreach ($ledger_accounts as $acct): ?>
                            <option value="<?php echo (int) $acct->account_id; ?>">
                                <?php echo html_escape($acct->account_name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input name="accounting_amount" type="number" step="0.01" required
                           placeholder="Accounting amount" class="border rounded px-2 py-2 text-sm">
                    <input name="tax_adjustment" type="number" step="0.01" required
                           placeholder="Tax adjustment amount" class="border rounded px-2 py-2 text-sm">
                </div>
                <textarea name="description" placeholder="Description / notes"
                          class="mt-2 w-full border rounded px-2 py-2 text-sm"></textarea>
                <button class="mt-3 rounded-md bg-gray-700 px-4 py-2 text-sm text-white hover:bg-gray-800">
                    Add Adjustment
                </button>
            </form>

            <!-- Calculate -->
            <form method="post" action="<?php echo base_url('index.php/Accounts/corporate_tax_calculate'); ?>"
                  class="rounded-md border p-4">
                <h4 class="mb-3 font-semibold text-gray-700">Calculate Corporate Tax</h4>
                <p class="text-xs text-gray-500 mb-3">
                    UAE Corporate Tax: 0% on first AED 375,000 &mdash; 9% on income above threshold.
                </p>
                <input type="hidden" name="financial_year_id" value="<?php echo (int) $financial_year_id; ?>">
                <label class="block text-sm text-gray-600 mb-1">Tax Loss Brought Forward (AED)</label>
                <input name="tax_loss_brought_forward" type="number" step="0.01"
                       value="<?php echo $calculation ? (float) $calculation->tax_loss_brought_forward : 0; ?>"
                       class="w-full border rounded px-2 py-2 text-sm">
                <button class="mt-3 rounded-md bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
                    Calculate
                </button>
            </form>
        </div>
        <?php else: ?>
            <div class="mb-4 rounded-md bg-yellow-50 border border-yellow-200 px-4 py-3 text-sm text-yellow-800">
                ⚠️ This Corporate Tax calculation is <strong><?php echo html_escape($calculation->status); ?></strong>
                and cannot be modified.
            </div>
        <?php endif; ?>

        <?php if ($calculation): ?>

            <!-- Adjustments Table -->
            <?php if (!empty($adjustments)): ?>
            <div class="mb-6 overflow-x-auto">
                <h4 class="mb-2 font-semibold text-gray-700">Tax Adjustments</h4>
                <table class="min-w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2 text-left">Type</th>
                            <th class="border px-3 py-2 text-left">Description</th>
                            <th class="border px-3 py-2 text-center">Direction</th>
                            <th class="border px-3 py-2 text-right">Acctg. Amount</th>
                            <th class="border px-3 py-2 text-right">Tax Adjustment</th>
                            <th class="border px-3 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($adjustments as $adjustment): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2"><?php echo html_escape($adjustment->adjustment_type); ?></td>
                            <td class="border px-3 py-2 text-gray-500"><?php echo html_escape($adjustment->description); ?></td>
                            <td class="border px-3 py-2 text-center">
                                <?php if ($adjustment->adjustment_direction === 'ADD'): ?>
                                    <span class="rounded-full bg-green-100 text-green-700 px-2 py-0.5 text-xs font-semibold">ADD</span>
                                <?php else: ?>
                                    <span class="rounded-full bg-red-100 text-red-700 px-2 py-0.5 text-xs font-semibold">DEDUCT</span>
                                <?php endif; ?>
                            </td>
                            <td class="border px-3 py-2 text-right">
                                <?php echo number_format((float) $adjustment->accounting_amount, 2); ?>
                            </td>
                            <td class="border px-3 py-2 text-right font-medium">
                                <?php echo number_format((float) $adjustment->tax_adjustment, 2); ?>
                            </td>
                          
<td class="border px-3 py-2 text-center">

    <?php if (!$is_locked): ?>

        <div class="flex justify-center gap-2">

            <!-- Edit -->
            <button type="button"
                    onclick='openEditModal(<?= htmlspecialchars(json_encode([
                        "id"                   => (int) $adjustment->id,
                        "adjustment_type"      => $adjustment->adjustment_type,
                        "description"          => $adjustment->description,
                        "accounting_amount"    => (float) $adjustment->accounting_amount,
                        "tax_adjustment"       => (float) $adjustment->tax_adjustment,
                        "adjustment_direction" => $adjustment->adjustment_direction,
                        "source_account_id"    => (int) $adjustment->source_account_id,
                    ]), ENT_QUOTES, "UTF-8") ?>)'
                    class="rounded bg-blue-600 px-3 py-1 text-xs text-white hover:bg-blue-700">
                Edit
            </button>

            <!-- Delete -->
            <form method="post"
                  action="<?= base_url('index.php/Accounts/corporate_tax_delete_adjustment/' . (int) $adjustment->id); ?>"
                  onsubmit="return confirm('Delete this adjustment?');">

                <input type="hidden"
                       name="financial_year_id"
                       value="<?= (int) $financial_year_id; ?>">

                <button type="submit"
                        class="rounded bg-red-600 px-3 py-1 text-xs text-white hover:bg-red-700">
                    Delete
                </button>

            </form>

        </div>

    <?php else: ?>

        <span class="text-xs text-gray-400">Locked</span>

    <?php endif; ?>

</td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <!-- Calculation Summary -->
            <div class="overflow-x-auto mb-4">
                <h4 class="mb-2 font-semibold text-gray-700">
                    Tax Computation Summary
                    <?php if ($calculation->calculated_at): ?>
                        <span class="ml-2 text-xs text-gray-400 font-normal">
                            Calculated: <?php echo html_escape($calculation->calculated_at); ?>
                        </span>
                    <?php endif; ?>
                </h4>
                <table class="min-w-full border border-gray-200 text-sm">
                    <tbody>
                        <tr>
                            <td class="border px-3 py-2 text-gray-600">Accounting Profit / (Loss)</td>
                            <td class="border px-3 py-2 text-right font-medium">
                                <?php echo number_format((float) $calculation->accounting_profit, 2); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 text-gray-600">+ Total Additions (non-deductible)</td>
                            <td class="border px-3 py-2 text-right text-green-700">
                                <?php echo number_format((float) $calculation->total_additions, 2); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 text-gray-600">− Total Deductions (exempt income)</td>
                            <td class="border px-3 py-2 text-right text-red-600">
                                (<?php echo number_format((float) $calculation->total_deductions, 2); ?>)
                            </td>
                        </tr>
                        <tr class="bg-gray-50 font-semibold">
                            <td class="border px-3 py-2">Taxable Income Before Losses</td>
                            <td class="border px-3 py-2 text-right">
                                <?php echo number_format((float) $calculation->taxable_income_before_losses, 2); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 text-gray-600">− Tax Loss Brought Forward</td>
                            <td class="border px-3 py-2 text-right text-red-600">
                                (<?php echo number_format((float) $calculation->tax_loss_brought_forward, 2); ?>)
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 text-gray-600">Tax Loss Utilised</td>
                            <td class="border px-3 py-2 text-right text-red-600">
                                (<?php echo number_format((float) $calculation->tax_loss_utilised, 2); ?>)
                            </td>
                        </tr>
                        <tr class="bg-gray-50 font-semibold">
                            <td class="border px-3 py-2">Final Taxable Income</td>
                            <td class="border px-3 py-2 text-right">
                                <?php echo number_format((float) $calculation->final_taxable_income, 2); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 text-gray-600">Tax @ 0% (≤ AED 375,000)</td>
                            <td class="border px-3 py-2 text-right">
                                <?php echo number_format((float) $calculation->tax_at_zero_rate, 2); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 text-gray-600">Tax @ 9% (> AED 375,000)</td>
                            <td class="border px-3 py-2 text-right">
                                <?php echo number_format((float) $calculation->tax_at_standard_rate, 2); ?>
                            </td>
                        </tr>
                        <tr class="bg-blue-50 font-bold text-base">
                            <td class="border px-3 py-2 text-blue-800">Corporate Tax Payable</td>
                            <td class="border px-3 py-2 text-right text-blue-800">
                                AED <?php echo number_format((float) $calculation->corporate_tax_payable, 2); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Actions row -->
            <div class="flex flex-wrap items-center gap-3 mt-4">
                <a href="<?php echo base_url('index.php/Accounts/corporate_tax_report/' . (int) $financial_year_id); ?>"
                   class="rounded-md bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                    ⬇ Export CSV Report
                </a>

                <?php if ($calculation->status === 'CALCULATED' && strtolower((string) $this->session->userdata('role')) === 'admin'): ?>
                <form method="post" action="<?php echo base_url('index.php/Accounts/corporate_tax_finalize'); ?>"
                      onsubmit="return confirm('Finalize this Corporate Tax? This action cannot be undone.');">
                    <input type="hidden" name="financial_year_id" value="<?php echo (int) $financial_year_id; ?>">
                    <button class="rounded-md bg-red-600 px-4 py-2 text-sm text-white hover:bg-red-700">
                        🔒 Finalize Corporate Tax
                    </button>
                </form>
                <?php endif; ?>

                <?php if ($calculation->status === 'FINALIZED'): ?>
                    <span class="text-sm text-green-700 font-medium">
                        ✅ Finalized on <?php echo html_escape($calculation->finalized_at ?? '—'); ?>
                    </span>
                <?php endif; ?>
            </div>

        <?php endif; /* $calculation */ ?>
    <?php endif; /* $financial_year_id */ ?>
</div>

<!-- =====================================================================
     Edit Adjustment Modal
     ===================================================================== -->
<div id="editAdjModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40"
     onclick="if(event.target===this) closeEditModal()">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-4 p-6">
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Edit Tax Adjustment</h4>
        <form id="editAdjForm" method="post" action="">
            <input type="hidden" name="financial_year_id" value="<?php echo (int) $financial_year_id; ?>">
            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                <div class="col-span-2">
                    <label class="block text-xs text-gray-500 mb-1">Adjustment Type</label>
                    <input id="edit_adjustment_type" name="adjustment_type" required
                           class="w-full border rounded px-2 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Direction</label>
                    <select id="edit_adjustment_direction" name="adjustment_direction" required
                            class="w-full border rounded px-2 py-2 text-sm">
                        <option value="ADD">ADD (Non-deductible expense)</option>
                        <option value="DEDUCT">DEDUCT (Exempt income)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Source Account (optional)</label>
                    <select id="edit_source_account_id" name="source_account_id"
                            class="w-full border rounded px-2 py-2 text-sm">
                        <option value="">— None —</option>
                        <?php foreach ($ledger_accounts as $acct): ?>
                            <option value="<?php echo (int) $acct->account_id; ?>">
                                <?php echo html_escape($acct->account_name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Accounting Amount</label>
                    <input id="edit_accounting_amount" name="accounting_amount" type="number" step="0.01" required
                           class="w-full border rounded px-2 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Tax Adjustment Amount</label>
                    <input id="edit_tax_adjustment" name="tax_adjustment" type="number" step="0.01" required
                           class="w-full border rounded px-2 py-2 text-sm">
                </div>
                <div class="col-span-2">
                    <label class="block text-xs text-gray-500 mb-1">Description / Notes</label>
                    <textarea id="edit_description" name="description" rows="2"
                              class="w-full border rounded px-2 py-2 text-sm"></textarea>
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()"
                        class="rounded-md border px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">
                    Cancel
                </button>
                <button type="submit"
                        class="rounded-md bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(data) {
    document.getElementById('edit_adjustment_type').value      = data.adjustment_type      || '';
    document.getElementById('edit_description').value          = data.description          || '';
    document.getElementById('edit_accounting_amount').value    = data.accounting_amount    || 0;
    document.getElementById('edit_tax_adjustment').value       = data.tax_adjustment       || 0;
    document.getElementById('edit_adjustment_direction').value = data.adjustment_direction || 'ADD';
    document.getElementById('edit_source_account_id').value    = data.source_account_id   || '';

    const baseUrl = '<?php echo base_url('index.php/Accounts/corporate_tax_update_adjustment/'); ?>';
    document.getElementById('editAdjForm').action = baseUrl + data.id;

    const modal = document.getElementById('editAdjModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('editAdjModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
