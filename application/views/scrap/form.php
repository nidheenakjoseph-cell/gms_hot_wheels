    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<div class="w-full bg-white rounded-2xl shadow-md p-6 mt-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h2 class="text-2xl font-semibold"><?= isset($scrap->id) ? 'Edit Scrap Sale' : 'Add Scrap Sale' ?></h2>

        <a href="<?= base_url('index.php/scrap') ?>" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium shadow-sm">
            ← List Scrap Sales
        </a>
    </div>

    <?php if (validation_errors()): ?>
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded">
            <?= validation_errors() ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($balance_errors)): ?>
        <div class="mb-4 p-4 bg-orange-50 border border-orange-300 text-orange-700 rounded">
            <strong>Stock Balance Alert:</strong>
            <ul class="mt-2 ml-4 list-disc">
                <?php foreach ($balance_errors as $error): ?>
                    <li><?= html_escape($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="scrapForm" action="<?= base_url('index.php/scrap/save') ?>" method="post" autocomplete="off" class="space-y-6">
        <input type="hidden" name="scrap_id" value="<?= set_value('scrap_id', isset($scrap->id) ? $scrap->id : (isset($scrap->scrap_id) ? $scrap->scrap_id : '')) ?>">
        <input type="hidden" name="invoice_no" value="<?= set_value('invoice_no', isset($scrap->invoice_no) ? $scrap->invoice_no : (isset($scrap->invoice_no) ? $scrap->invoice_no : '')) ?>">
            <input type="hidden" name="customer_ledger_id" id="customer_ledger_id" value="<?= set_value('customer_ledger_id', isset($scrap->customer_ledger_id) ? $scrap->customer_ledger_id : '') ?>">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Sale Date</label>
                <input type="date" name="sale_date" value="<?= set_value('sale_date', isset($scrap->sale_date) ? date('Y-m-d', strtotime($scrap->sale_date)) : '') ?>" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Branch <span class="text-red-500">*</span></label>
                <?= render_branch_select_dropdown('branch_id', isset($scrap->branch_id) ? $scrap->branch_id : null) ?>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Invoice Number</label>
                <input type="text" class="w-full border rounded px-3 py-2 bg-gray-50" value="<?= set_value('invoice_no', isset($scrap->invoice_no) ? $scrap->invoice_no : 'Auto generated') ?>" readonly>
            </div>
          
             <div>
                <label class="block font-medium mb-1">Customer / Buyer Name <span class="text-red-500">*</span></label>
                <select id="unitSelect" name="customer_name" required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">-- Select customer --</option>
                    <?php $selectedCustomer = set_value('customer_name', isset($scrap->customer_name) ? $scrap->customer_name : ''); ?>
                    <?php if (!empty($selectedCustomer)): ?>
                        <option value="<?= html_escape($selectedCustomer) ?>" selected><?= html_escape($selectedCustomer) ?></option>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border text-sm" id="scrapItemsTable">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Category</th>
                        <th class="border p-2 text-center">Available</th>
                        <th class="border p-2">Quantity</th>
                        <th class="border p-2">Rate</th>
                        <th class="border p-2">Amount</th>
                        <th class="border p-2">Action</th>
                    </tr>
                </thead>
                <tbody id="scrapItemsBody">
                    <?php
                    $item_rows = [];
                    if (!empty($scrap_items) && is_array($scrap_items)) {
                        $item_rows = $scrap_items;
                    } elseif (isset($scrap->items) && is_array($scrap->items)) {
                        $item_rows = $scrap->items;
                    } else {
                        $item_rows = [ ['category_id' => '', 'quantity' => '', 'rate' => '', 'amount' => ''] ];
                    }
                    foreach ($item_rows as $index => $item):
                        $item_category_id = is_array($item) ? ($item['category_id'] ?? '') : ($item->category_id ?? '');
                        $item_quantity = is_array($item) ? ($item['quantity'] ?? '') : ($item->quantity ?? '');
                        $item_rate = is_array($item) ? ($item['rate'] ?? '') : ($item->rate ?? '');
                        $item_amount = is_array($item) ? ($item['amount'] ?? '') : ($item->amount ?? '');
                        $available_balance = isset($category_balances[$item_category_id]) ? $category_balances[$item_category_id] : 0;
                    ?>
                        <tr class="item-row">
                            <td class="border p-2">
                                <select name="category_id[]" class="w-full border rounded px-3 py-2 category-select" data-balances="<?= htmlspecialchars(json_encode($category_balances)) ?>">
                                    <option value="">-- Select category --</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category->id ?>" <?= $category->id == $item_category_id ? 'selected' : '' ?>><?= html_escape($category->category_name) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="border p-2 text-center bg-blue-50 font-semibold available-balance">
                                <?= number_format($available_balance, 2) ?>
                            </td>
                            <td class="border p-2">
                                <input type="number" step="0.01" name="quantity[]" class="w-full border rounded px-3 py-2 item-quantity" value="<?= html_escape($item_quantity) ?>" required>
                            </td>
                            <td class="border p-2">
                                <input type="number" step="0.01" name="rate[]" class="w-full border rounded px-3 py-2 item-rate" value="<?= html_escape($item_rate) ?>" required>
                            </td>
                            <td class="border p-2">
                                <input type="text" name="amount[]" class="w-full border rounded px-3 py-2 item-amount bg-gray-50" value="<?= html_escape($item_amount) ?>" readonly>
                            </td>
                            <td class="border p-2 text-center">
                                <button type="button" class="remove-item inline-flex items-center justify-center w-10 h-10 bg-red-600 text-white rounded hover:bg-red-700">×</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-3">
            <button type="button" id="addItemRow" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">+ Add Item</button>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Total Amount</label>
                <input type="text" id="total_amount" class="w-full border rounded px-3 py-2 bg-gray-50" value="<?= set_value('total_amount', isset($scrap->total_amount) ? number_format($scrap->total_amount, 2) : '0.00') ?>" readonly>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Taxable Amount</label>
                <input type="text" id="scrap_taxable" class="w-full border rounded px-3 py-2 bg-gray-50" value="0.00" readonly>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">VAT (5%)</label>
                <input type="text" id="scrap_tax" class="w-full border rounded px-3 py-2 bg-gray-50" value="0.00" readonly>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3 mt-3">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Grand Total</label>
                <input type="text" id="scrap_grand" class="w-full border rounded px-3 py-2 bg-gray-50" value="0.00" readonly>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Advance Payment (if any)</label>
                <input type="number" step="0.01" name="advance_paid" id="scrap_advance" class="w-full border rounded px-3 py-2" value="<?= set_value('advance_paid', isset($scrap->advance_used) ? $scrap->advance_used : '0.00') ?>">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Balance</label>
                <div id="scrap_balance" class="w-full border rounded px-3 py-2 bg-gray-50"><?= isset($scrap->balance) ? number_format($scrap->balance, 2) : '0.00' ?></div>
            </div>
            <div style="display: none;">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Payment Status</label>
                <select name="payment_status" class="w-full border rounded px-3 py-2" required>
                    <?php $status = set_value('payment_status', isset($scrap->payment_status) ? $scrap->payment_status : 'Unpaid'); ?>
                    <option value="Unpaid" <?= $status === 'Unpaid' ? 'selected' : '' ?>>Unpaid</option>
                    <option value="Paid" <?= $status === 'Paid' ? 'selected' : '' ?>>Paid</option>
                    <option value="Credit" <?= $status === 'Credit' ? 'selected' : '' ?>>Credit</option>
                </select>
            </div>
            <div></div>
        </div>

        <div class="bg-white border rounded p-4 mt-4">
            <p class="font-semibold mb-4">Sales Invoice Account Entry</p>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <table class="w-full border text-sm" id="inv_dr_table">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-2 py-2 text-left">Debit Customer (Dr)</th>
                                <th class="border px-2 py-2 text-left">Debit Amount (AED)</th>
                                <th class="border px-2 py-2 text-center w-[10%]"></th>
                            </tr>
                        </thead>
                        <tbody id="inv_dr_body">
                            <tr id="inv_dr_addr0">
                                <td class="border px-2 py-2">
                                    <select class="w-full border rounded px-2 py-1 text-sm select2 debtor-select" id="inv_debtor0" name="inv_debtor[]">
                                        <option value="">Select</option>
                                        <?php foreach ($sundry_accounts1 as $row): ?>
                                            <option value="<?= $row->account_id ?>" <?= isset($scrap->inv_debtor[0]) && $scrap->inv_debtor[0] == $row->account_id ? 'selected' : '' ?>><?= html_escape($row->account_name) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td class="border px-2 py-2">
                                    <input type="number" step="0.01" name="inv_dr_amount[]" id="inv_dr_amount0" class="w-full border rounded px-2 py-1 text-sm" min="0" value="<?= isset($scrap->inv_dr_amount[0]) ? number_format($scrap->inv_dr_amount[0], 2) : (isset($scrap->total_amount) ? number_format($scrap->total_amount, 2) : '0.00') ?>">
                                </td>
                                <td class="border px-2 py-2 text-center"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <table class="w-full border text-sm" id="inv_cr_table">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-2 py-2 text-left">Credit Account (Cr)</th>
                                <th class="border px-2 py-2 text-left">Credit Amount (AED)</th>
                                <th class="border px-2 py-2 text-center w-[10%]"></th>
                            </tr>
                        </thead>
                        <tbody id="inv_cr_body">
                            <tr id="inv_cr_addr0">
                                <td class="border px-2 py-2">
                                    <select class="w-full border rounded px-2 py-1 text-sm select2 credit_select" id="inv_creditor0" name="inv_creditor[]">
                                        <option value="">Select</option>
                                        <?php foreach ($sundry_accounts2 as $row): ?>
                                            <option <?php if ($row->account_id == 1125) echo 'selected'; ?> value="<?= $row->account_id ?>" <?= isset($scrap->revenue_account_id) && $scrap->revenue_account_id == $row->account_id ? 'selected' : '' ?>><?= html_escape($row->account_name) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label id="set_balanceinv_cr0" class="text-xs text-gray-500">Balance</label>
                                </td>
                                <td class="border px-2 py-2">
                                    <input type="number" step="0.01" name="inv_cr_amount[]" id="inv_cr_amount0" class="w-full border rounded px-2 py-1 text-sm" min="0" value="<?= isset($scrap->total_amount) ? number_format($scrap->total_amount, 2) : '0.00' ?>">
                                </td>
                                <td class="border px-2 py-2 text-center"></td>
                            </tr>
                            <tr id="inv_cr_addr1">
                                <td class="border px-2 py-2">
                                   <?php
                                        $selectedCreditor1 = isset($scrap->inv_creditor[1])
                                            ? $scrap->inv_creditor[1]
                                            : 228; // default account id
                                        ?>
                                        <select class="w-full border rounded px-2 py-1 text-sm select2"
                                                id="inv_creditor1"
                                                name="inv_creditor[]">
                                            <option value="">Select</option>
                                            <?php foreach ($sundry_accounts3 as $row): ?>
                                                <option value="<?= $row->account_id ?>"
                                                    <?= ($selectedCreditor1 == $row->account_id) ? 'selected' : '' ?>>
                                                    <?= html_escape($row->account_name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    <label class="text-xs text-gray-500">Balance</label>
                                </td>
                                <td class="border px-2 py-2">
                                    <input type="number" step="0.01" name="inv_cr_amount[]" id="inv_cr_amount1" class="w-full border rounded px-2 py-1 text-sm" min="0" value="<?= isset($scrap->inv_cr_amount[1]) ? number_format($scrap->inv_cr_amount[1], 2) : '0.00' ?>">
                                </td>
                                <td class="border px-2 py-2 text-center"></td>
                            </tr>
                            <tr id="inv_cr_addr2">
                                <td class="border px-2 py-2">
                                    <select class="w-full border rounded px-2 py-1 text-sm select2" id="inv_creditor2" name="inv_creditor[]">
                                        <option value="">Select</option>
                                        <?php foreach ($sundry_accounts3 as $row): ?>
                                            <option value="<?= $row->account_id ?>" <?= isset($scrap->inv_creditor[2]) && $scrap->inv_creditor[2] == $row->account_id ? 'selected' : '' ?>><?= html_escape($row->account_name) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label class="text-xs text-gray-500">Balance</label>
                                </td>
                                <td class="border px-2 py-2">
                                    <input type="number" step="0.01" name="inv_cr_amount[]" id="inv_cr_amount2" class="w-full border rounded px-2 py-1 text-sm" min="0" value="<?= isset($scrap->inv_cr_amount[2]) ? number_format($scrap->inv_cr_amount[2], 2) : '0.00' ?>">
                                </td>
                                <td class="border px-2 py-2 text-center"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <p class="text-sm text-gray-500 mt-3">This scrap sale will be recorded as an invoice entry; separate invoice creation is not required.</p>
        </div>

        <input type="hidden" name="cash_account_id" value="<?= set_value('cash_account_id', isset($scrap->cash_account_id) ? $scrap->cash_account_id : '') ?>">

        <!-- Hidden fields for tax/advance posting -->
        <input type="hidden" name="subtotal" id="scrap_subtotal" value="0.00">
        <input type="hidden" name="taxable_amount" id="scrap_taxable_input" valu
        e="0.00">
        <input type="hidden" name="tax_amount" id="scrap_tax_input" value="0.00">
        <input type="hidden" name="grand_total" id="scrap_grand_input" value="0.00">
        <input type="hidden" name="advance_used" id="scrap_advance_input" value="<?= isset($scrap->advance_used) ? $scrap->advance_used : '0.00' ?>">
        <input type="hidden" name="balance" id="scrap_balance_input" value="<?= isset($scrap->balance) ? $scrap->balance : '0.00' ?>">

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Notes</label>
            <textarea name="notes" rows="4" class="w-full border rounded px-3 py-2"><?= set_value('notes', isset($scrap->notes) ? $scrap->notes : '') ?></textarea>
        </div>

        <div class="flex justify-end gap-4 pt-4">
            <!-- <button type="reset" class="px-6 py-2 border rounded-lg hover:bg-gray-100">Reset</button> -->
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"><?= isset($scrap->id) ? 'Update Scrap Invoice' : 'Create Scrap Invoice' ?></button>

            <a href="<?= base_url('index.php/scrap') ?>" class="px-6 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">Cancel</a>
        </div>
    </form>
</div>

<div id="customerModal" class="hidden fixed inset-0 z-50 bg-black/40 flex items-center justify-center px-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold">Add New Customer</h3>
            <button type="button" id="closeCustomerModal" class="text-gray-500 hover:text-gray-800">✕</button>
        </div>

        <div id="customerFormErrors" class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded hidden">
            <ul class="list-disc ml-5" id="errorList"></ul>
        </div>

        <form id="scrapNewCustomerForm" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-medium">Customer Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                    <span class="text-xs text-red-600 hidden" id="nameError"></span>
                </div>
                <div>
                    <label class="font-medium">Phone</label>
                    <input type="text" name="phone" class="w-full border rounded px-3 py-2" placeholder="e.g., +971501234567">
                    <span class="text-xs text-red-600 hidden" id="phoneError"></span>
                </div>
                <div>
                    <label class="font-medium">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2">
                    <span class="text-xs text-red-600 hidden" id="emailError"></span>
                </div>
                <div>
                    <label class="font-medium">Emirate</label>
                    <select name="emirate" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Emirate --</option>
                        <option value="Abu Dhabi">Abu Dhabi</option>
                        <option value="Dubai">Dubai</option>
                        <option value="Sharjah">Sharjah</option>
                        <option value="Ajman">Ajman</option>
                        <option value="Umm Al Quwain">Umm Al Quwain</option>
                        <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                        <option value="Fujairah">Fujairah</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="font-medium">Address</label>
                    <textarea name="address" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="font-medium">TRN</label>
                    <input type="text" name="trn" class="w-full border rounded px-3 py-2" placeholder="e.g., 100012345600003">
                    <span class="text-xs text-red-600 hidden" id="trnError"></span>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-3">
                <button type="button" id="cancelCustomerModal" class="px-4 py-2 bg-gray-200 rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Save Customer</button>
            </div>
        </form>
    </div>
</div>

<script>
    let categoryBalances = <?= json_encode($category_balances ?? []) ?>;

    function createItemRow(categoryId = '', quantity = '', rate = '', amount = '') {
        const row = document.createElement('tr');
        row.className = 'item-row';
        const balance = categoryId && categoryBalances[categoryId] ? categoryBalances[categoryId] : 0;
        row.innerHTML = `
            <td class="border p-2">
                <select name="category_id[]" class="w-full border rounded px-3 py-2 category-select">
                    <option value="">-- Select category --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id ?>" ${categoryId == <?= $category->id ?> ? 'selected' : ''}><?= html_escape($category->category_name) ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td class="border p-2 text-center bg-blue-50 font-semibold available-balance">${balance.toFixed(2)}</td>
            <td class="border p-2"><input type="number" step="0.01" name="quantity[]" class="w-full border rounded px-3 py-2 item-quantity" value="${quantity}" required></td>
            <td class="border p-2"><input type="number" step="0.01" name="rate[]" class="w-full border rounded px-3 py-2 item-rate" value="${rate}" required></td>
            <td class="border p-2"><input type="text" name="amount[]" class="w-full border rounded px-3 py-2 item-amount bg-gray-50" value="${amount}" readonly></td>
            <td class="border p-2 text-center"><button type="button" class="remove-item inline-flex items-center justify-center w-10 h-10 bg-red-600 text-white rounded hover:bg-red-700">×</button></td>
        `;
        attachItemEvents(row);
        return row;
    }

    function updateLineAmount(row) {
        const qty = parseFloat(row.querySelector('.item-quantity').value) || 0;
        const rate = parseFloat(row.querySelector('.item-rate').value) || 0;
        row.querySelector('.item-amount').value = (qty * rate).toFixed(2);
    }

    function updateTotalAmount() {
        const amounts = document.querySelectorAll('.item-amount');
        let total = 0;
        amounts.forEach(el => {
            total += parseFloat(el.value) || 0;
        });
        document.getElementById('total_amount').value = total.toFixed(2);

        // TAX CALC
        const subtotal = total;
        const discount = 0.00;
        const taxable = Math.max(0, subtotal - discount);
        const tax = parseFloat((taxable * 0.05).toFixed(2));
        const grand = parseFloat((taxable + tax).toFixed(2));

        document.getElementById('scrap_taxable').value = taxable.toFixed(2);
        document.getElementById('scrap_tax').value = tax.toFixed(2);
        if (document.getElementById('scrap_grand')) document.getElementById('scrap_grand').value = grand.toFixed(2);

        const totalStr = grand.toFixed(2);
        const debitEl = document.getElementById('inv_dr_amount0');
        const creditEl = document.getElementById('inv_cr_amount0');
        if (debitEl) debitEl.value = totalStr;
        if (creditEl) creditEl.value = subtotal.toFixed(2);

        // put tax into second credit row if present
        const taxEl = document.getElementById('inv_cr_amount1');
        if (taxEl) taxEl.value = tax.toFixed(2);

        // update hidden fields
        document.getElementById('scrap_subtotal').value = subtotal.toFixed(2);
        document.getElementById('scrap_taxable_input').value = taxable.toFixed(2);
        document.getElementById('scrap_tax_input').value = tax.toFixed(2);
        document.getElementById('scrap_grand_input').value = grand.toFixed(2);

        // advance & balance sync
        const advField = document.getElementById('scrap_advance') || document.getElementById('advance_paid');
        let adv = parseFloat(advField ? advField.value : 0) || 0;
        if (adv > grand) adv = grand;
        const balance = parseFloat((grand - adv).toFixed(2));
        document.getElementById('scrap_balance_input').value = balance.toFixed(2);
        if (document.getElementById('scrap_balance')) document.getElementById('scrap_balance').innerText = balance.toFixed(2);
        if (document.getElementById('scrap_advance')) {
            document.getElementById('scrap_advance_input').value = adv.toFixed(2);
        }
    }

    // Update when advance input changes
    const advInputEl = document.getElementById('scrap_advance');
    if (advInputEl) {
        advInputEl.addEventListener('input', function() {
            updateTotalAmount();
        });
    }

    function attachItemEvents(row) {
        const categorySelect = row.querySelector('.category-select');
        const qtyInput = row.querySelector('.item-quantity');
        const rateInput = row.querySelector('.item-rate');
        const removeButton = row.querySelector('.remove-item');
        const balanceCell = row.querySelector('.available-balance');

        if (categorySelect) {
            categorySelect.addEventListener('change', () => {
                const categoryId = categorySelect.value;
                const balance = categoryId && categoryBalances[categoryId] ? categoryBalances[categoryId] : 0;
                if (balanceCell) {
                    balanceCell.textContent = balance.toFixed(2);
                }
            });
        }

        if (qtyInput) qtyInput.addEventListener('input', () => {
            updateLineAmount(row);
            updateTotalAmount();
        });
        if (rateInput) rateInput.addEventListener('input', () => {
            updateLineAmount(row);
            updateTotalAmount();
        });
        if (removeButton) removeButton.addEventListener('click', () => {
            const rows = document.querySelectorAll('#scrapItemsBody .item-row');
            if (rows.length > 1) {
                row.remove();
                updateTotalAmount();
            }
        });
    }

    function addItemRow() {
        const newRow = createItemRow('', '', '', '0.00');
        document.getElementById('scrapItemsBody').appendChild(newRow);
    }

    document.getElementById('addItemRow').addEventListener('click', addItemRow);

    document.querySelectorAll('#scrapItemsBody .item-row').forEach(row => attachItemEvents(row));
    updateTotalAmount();

    const branchSelect = document.getElementById('branch_id');
    function refreshCategoryBalances(branchId) {
        if (!branchId) {
            return;
        }

        fetch('<?= base_url('index.php/scrap/get_category_balances_by_branch') ?>?branch_id=' + encodeURIComponent(branchId))
            .then(response => response.json())
            .then(result => {
                if (result && result.balances) {
                    categoryBalances = result.balances;
                    document.querySelectorAll('#scrapItemsBody .item-row').forEach(row => {
                        const select = row.querySelector('.category-select');
                        const balanceCell = row.querySelector('.available-balance');
                        const categoryId = select.value;
                        const balance = categoryId && categoryBalances[categoryId] ? categoryBalances[categoryId] : 0;
                        if (balanceCell) {
                            balanceCell.textContent = balance.toFixed(2);
                        }
                    });
                }
            })
            .catch(() => {
                // ignore failure, keep existing balances
            });
    }

    if (branchSelect) {
        branchSelect.addEventListener('change', function() {
            refreshCategoryBalances(this.value);
        });
    }

    const scrapForm = document.getElementById('scrapForm');
    const initialItemRows = Array.from(document.querySelectorAll('#scrapItemsBody .item-row')).map(row => row.cloneNode(true));

    // scrapForm.addEventListener('reset', () => {
    //     setTimeout(() => {
    //         const body = document.getElementById('scrapItemsBody');
    //         body.innerHTML = '';
    //         initialItemRows.forEach(row => {
    //             const clone = row.cloneNode(true);
    //             body.appendChild(clone);
    //             attachItemEvents(clone);
    //         });
    //         updateTotalAmount();
    //     }, 0);
    // });
</script>
<script>
    $(document).ready(function() {
        const $cust = $('#unitSelect');
        const $customerModal = $('#customerModal');
        const $customerForm = $('#scrapNewCustomerForm');
        let pendingCustomerName = null;

        $cust.select2({
            theme: 'classic',
            tags: true,
            placeholder: '-- Select customer --',
            ajax: {
                url: '<?= base_url('index.php/scrap/customer_search') ?>',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { q: params.term };
                },
                processResults: function (data) {
                    return { results: data.results };
                }
            },
            createTag: function (params) {
                if (!params.term) {
                    return null;
                }
                return {
                    id: params.term,
                    text: params.term,
                    newTag: true
                };
            },
            templateResult: function (item) {
                if (item.loading) {
                    return item.text;
                }
                if (item.newTag) {
                    return $('<span><strong>+ Add new customer</strong> <span class="text-gray-500">' + item.text + '</span></span>');
                }
                return item.text;
            }
        });

        $cust.on('select2:select', function (e) {
            const data = e.params.data;
            if (data.newTag) {
                pendingCustomerName = data.text;
                $cust.find('option[value="' + data.id + '"]').remove();
                $cust.val(null).trigger('change');
                // Clear errors when opening modal
                $('#customerFormErrors').addClass('hidden');
                $('#errorList').html('');
                $('#nameError, #phoneError, #emailError, #trnError').addClass('hidden').text('');
                $customerModal.removeClass('hidden');
                $customerForm[0].reset();
                $customerForm.find('[name="name"]').val(data.text).focus();
            } else {
                const ledgerId = data.ledger_id || '';
                $('#customer_ledger_id').val(ledgerId);
                // Ensure debtor select has this ledger option, then select it
                if (ledgerId) {
                    const $deb = $('#inv_debtor0');
                    if ($deb.find('option[value="' + ledgerId + '"]').length === 0) {
                        // use customer name as option text if ledger name not available
                        const optText = data.text || 'Customer Ledger ' + ledgerId;
                        $deb.append(new Option(optText, ledgerId));
                    }
                    $deb.val(ledgerId).trigger('change');
                }
            }
        });

        $('#closeCustomerModal, #cancelCustomerModal').on('click', function() {
            $customerModal.addClass('hidden');
            // Clear errors when closing modal
            $('#customerFormErrors').addClass('hidden');
            $('#errorList').html('');
            $('#nameError, #phoneError, #emailError, #trnError').addClass('hidden').text('');
        });

        $customerForm.on('submit', function (e) {
            e.preventDefault();
            
            // Clear previous errors
            $('#customerFormErrors').addClass('hidden');
            $('#errorList').html('');
            $('#nameError, #phoneError, #emailError, #trnError').addClass('hidden').text('');
            
            const errors = [];
            const name = $customerForm.find('[name="name"]').val().trim();
            const phone = $customerForm.find('[name="phone"]').val().trim();
            const email = $customerForm.find('[name="email"]').val().trim();
            const trn = $customerForm.find('[name="trn"]').val().trim();
            
            // Validation rules
            if (!name) {
                errors.push('Customer name is required');
                $('#nameError').removeClass('hidden').text('Customer name is required');
            } else if (name.length < 3) {
                errors.push('Customer name must be at least 3 characters');
                $('#nameError').removeClass('hidden').text('Customer name must be at least 3 characters');
            }
            
            if (phone) {
                // Phone number format check: allow digits, +, spaces, and hyphens (7-15 digits total)
                const phoneRegex = /^[\d\s\-\+]{7,}$/;
                const digitsOnly = phone.replace(/\D/g, '');
                if (!phoneRegex.test(phone) || digitsOnly.length < 7) {
                    errors.push('Phone must be a valid number format (at least 7 digits)');
                    $('#phoneError').removeClass('hidden').text('Phone must be a valid number format (at least 7 digits)');
                }
            }
            
            if (email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    errors.push('Email format is invalid');
                    $('#emailError').removeClass('hidden').text('Invalid email format');
                }
            }
            
            if (trn) {
                // UAE TRN format: 15 digits
                const trnRegex = /^[0-9]{15}$/;
                if (!trnRegex.test(trn)) {
                    errors.push('TRN must be 15 digits (e.g., 100012345600003)');
                    $('#trnError').removeClass('hidden').text('TRN must be 15 digits');
                }
            }
            
            if (errors.length > 0) {
                errors.forEach(error => {
                    $('#errorList').append('<li>' + error + '</li>');
                });
                $('#customerFormErrors').removeClass('hidden');
                return;
            }
            
            const payload = $(this).serialize();
            $.post('<?= base_url('index.php/scrap/create_customer_ajax') ?>', payload, function(resp) {
                const res = (typeof resp === 'string') ? JSON.parse(resp) : resp;
                if (res.error) {
                    errors.push(res.error);
                    $('#errorList').html('<li>' + res.error + '</li>');
                    $('#customerFormErrors').removeClass('hidden');
                    return;
                }

                const newOpt = new Option(res.name, res.name, true, true);
                $cust.append(newOpt).trigger('change');

                const ledgerAccountId = res.ledger && res.ledger.account_id ? res.ledger.account_id : null;
                const ledgerAccountName = res.ledger && res.ledger.account_name ? res.ledger.account_name : res.name;
                if (ledgerAccountId) {
                    $('#customer_ledger_id').val(ledgerAccountId);
                    // Ensure debtor select has this ledger option, then select it
                    const $deb = $('#inv_debtor0');
                    if ($deb.find('option[value="' + ledgerAccountId + '"]').length === 0) {
                        $deb.append(new Option(ledgerAccountName, ledgerAccountId));
                    }
                    $deb.val(ledgerAccountId).trigger('change');
                }
                $customerModal.addClass('hidden');
            }, 'json').fail(function() {
                errors.push('Failed to save customer. Please try again.');
                $('#errorList').html('<li>Failed to save customer. Please try again.</li>');
                $('#customerFormErrors').removeClass('hidden');
            });
        });

        function refreshAccounts(selectAccountId) {
            // The scrap invoice entry uses fixed debit/credit rows.
            // We only need the customer ledger id to track the selected debtor.
            if (selectAccountId) {
                $('#customer_ledger_id').val(selectAccountId);
            }
        }
    });
</script>
