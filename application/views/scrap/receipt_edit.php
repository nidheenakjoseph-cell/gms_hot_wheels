<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<div class="w-full mx-auto bg-white shadow-xl rounded-2xl p-6">
	<!-- Top Bar / Header -->
	<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 pb-4 mb-6 gap-4">
		<div>
			<h2 class="text-2xl font-bold text-gray-800">
				Edit Scrap Receipt Voucher : <?= htmlspecialchars($voucher_code) ?>
			</h2>
			<p class="text-sm text-gray-500 mt-1">Update payment allocations and ledger accounts for this scrap receipt</p>
		</div>

		<div class="flex gap-2">
			<a href="<?= base_url('index.php/scrap/add_receipt'); ?>"
				class="inline-flex items-center rounded-lg bg-blue-50 text-blue-700 text-xs font-semibold px-4 py-2 hover:bg-blue-100 transition shadow-sm"
				title="Add New Record">
				+ Add New Receipt
			</a>

			<a href="<?= base_url('index.php/scrap/view_receipt_list'); ?>"
				class="inline-flex items-center rounded-lg bg-gray-100 text-gray-700 text-xs font-semibold px-4 py-2 hover:bg-gray-200 transition shadow-sm"
				title="List Records">
				← List Receipts
			</a>
		</div>
	</div>

	<!-- Form -->
	<form action="<?= base_url('index.php/Scrap/update_receipt_details'); ?>"
		id="receipt"
		method="post"
		class="space-y-6">

		<!-- Hidden Voucher Code -->
		<input type="hidden" name="voucher_code" value="<?= htmlspecialchars($voucher_code) ?>">

		<!-- Header Details Summary Card -->
		<div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
			<h3 class="text-base font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Receipt Voucher Header</h3>

			<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

				<!-- Voucher Code (Read-only) -->
				<div>
					<label class="block text-xs font-semibold uppercase text-gray-600 mb-1">
						Voucher Code
					</label>
					<input type="text"
						readonly
						value="<?= htmlspecialchars($voucher_code) ?>"
						class="w-full h-[38px] rounded-lg bg-gray-100 border border-gray-300 px-3 text-sm font-medium text-gray-700">
				</div>

				<!-- Date -->
				<div>
					<label class="block text-xs font-semibold uppercase text-gray-600 mb-1">
						Date <span class="text-red-500">*</span>
					</label>
					<input type="date"
						id="v_date"
						name="v_date"
						value="<?= isset($receipt_header->voucher_date) ? date('Y-m-d', strtotime($receipt_header->voucher_date)) : date('Y-m-d') ?>"
						class="w-full h-[38px] rounded-lg border border-gray-300 px-3 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
				</div>

				<!-- Customer -->
				<div>
					<label class="block text-xs font-semibold uppercase text-gray-600 mb-1">
						Select Customer <span class="text-red-500">*</span>
					</label>
					<select name="customer_name"
						id="customer_name"
						class="w-full h-[38px] rounded-lg border border-gray-300 px-3 text-sm select2"
						onchange="load_scrap_invoices()">

						<option value="">Select Customer</option>

						<?php
							$selected_customer = '';
							if (!empty($receipt_header->customer_name)) {
								$selected_customer = trim($receipt_header->customer_name);
							} elseif (!empty($receipt_details[0]->customer_name)) {
								$selected_customer = trim($receipt_details[0]->customer_name);
							}

							// Get unique customers from scrap invoices
							$customers = $this->db
								->distinct()
								->select('customer_name')
								->from('scrap_sales')
								->where('customer_name IS NOT NULL', null, false)
								->where("TRIM(customer_name) != ''", null, false)
								->where("LOWER(TRIM(customer_name)) != 'null'", null, false)
								->order_by('customer_name')
								->get()
								->result();

							$customer_names = array_map(function ($c) {
								return trim($c->customer_name);
							}, $customers);
						?>

						<?php if ($selected_customer !== '' && !in_array($selected_customer, $customer_names, true)): ?>
							<option value="<?= htmlspecialchars($selected_customer) ?>" selected>
								<?= htmlspecialchars($selected_customer) ?>
							</option>
						<?php endif; ?>

						<?php foreach ($customers as $c): ?>
							<?php $customerValue = trim($c->customer_name); ?>
							<option value="<?= htmlspecialchars($customerValue) ?>"
								<?= ($selected_customer !== '' && $selected_customer === $customerValue) ? 'selected' : '' ?>>
								<?= htmlspecialchars($c->customer_name) ?>
							</option>
						<?php endforeach; ?>
					</select>
					<input type="hidden" name="debtor" id="debtor" value="">
				</div>

				<!-- Transaction Type -->
				<div>
					<label class="block text-xs font-semibold uppercase text-gray-600 mb-1">
						Transaction Type <span class="text-red-500">*</span>
					</label>
					<select name="transaction_type"
						id="transaction_type"
						onchange="toggleTransactionFields()"
						class="w-full h-[38px] rounded-lg border border-gray-300 px-3 text-sm select2">

						<option value="">Select</option>
						<option value="Cash" <?= (isset($receipt_header->transaction_type) && $receipt_header->transaction_type === 'Cash') ? 'selected' : '' ?>>Cash</option>
						<option value="cheque" <?= (isset($receipt_header->transaction_type) && $receipt_header->transaction_type === 'cheque') ? 'selected' : '' ?>>Cheque</option>
						<option value="etransfer" <?= (isset($receipt_header->transaction_type) && $receipt_header->transaction_type === 'etransfer') ? 'selected' : '' ?>>Card/Transfer</option>
						<option value="other" <?= (isset($receipt_header->transaction_type) && $receipt_header->transaction_type === 'other') ? 'selected' : '' ?>>Other</option>
					</select>
				</div>

			</div>

			<!-- Transaction No Field -->
			<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-4">
				<div id="transaction_fields" class="<?= (isset($receipt_header->transaction_type) && in_array($receipt_header->transaction_type, ['cheque', 'etransfer', 'other'])) ? '' : 'hidden' ?>">
					<label class="block text-xs font-semibold uppercase text-gray-600 mb-1" id="transaction_label">
						Transaction No
					</label>

					<input type="text"
						id="transaction_no"
						name="transaction_no"
						value="<?= isset($receipt_header->transaction_no) ? htmlspecialchars($receipt_header->transaction_no) : '' ?>"
						placeholder="Cheque / Txn ID"
						class="w-full h-[38px] rounded-lg border border-gray-300 px-3 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
				</div>
			</div>

		</div>

		<!-- Scrap Invoice Allocation List -->
		<div id="invoice_section" class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
			<div class="flex items-center justify-between mb-3">
				<h3 class="text-base font-semibold text-gray-800">Scrap Invoice Allocation</h3>
				<span class="text-xs text-gray-500">Select invoices and enter payment amounts</span>
			</div>
			
			<div id="scrap_list" class="overflow-x-auto">
				<table class="min-w-full border border-gray-200 rounded-lg text-sm">
					<thead class="bg-gray-100 text-xs uppercase text-gray-700 font-semibold">
						<tr>
							<th class="border p-2 text-center w-[5%]">
								<input type="checkbox" id="select_all_invoices" onchange="select_all_invoices()">
							</th>
							<th class="border p-2 text-left">Invoice No</th>
							<th class="border p-2 text-left">Sale Date</th>
							<th class="border p-2 text-right">Total Amount</th>
							<th class="border p-2 text-right">Paid Amount</th>
							<th class="border p-2 text-right">Pending Amount</th>
							<th class="border p-2 text-right w-[20%]">Amount to Pay</th>
						</tr>
					</thead>
					<tbody id="invoice_body">
						<tr>
							<td colspan="7" class="text-center py-6 text-gray-500">
								Select a customer to load pending scrap invoices
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Payment Accounts Table -->
		<div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
			<div class="flex items-center justify-between mb-3">
				<h3 class="text-base font-semibold text-gray-800">Payment Accounts (Cash / Bank)</h3>
				<span class="text-xs text-gray-500">Credit payment ledger accounts receiving money</span>
			</div>

			<div class="overflow-x-auto">
				<table id="cr_table" class="min-w-full border border-gray-200 rounded-lg text-sm">
					<thead class="bg-gray-100 text-xs uppercase text-gray-700 font-semibold">
						<tr>
							<th class="border p-2 text-left">Credit Account (Cr)</th>
							<th class="border p-2 text-left w-[30%]">Amount (AED)</th>
							<th class="border p-2 text-center w-[10%]">
								<button type="button"
									id="cr_add_row"
									class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm transition">
									+
								</button>
							</th>
						</tr>
					</thead>
					<tbody id="cr_body">
						<?php if (!empty($receipt_credits)): ?>
							<?php foreach ($receipt_credits as $index => $credit): ?>
								<tr id="cr_addr<?= $index ?>">
									<td class="border p-2">
										<select name="creditor[]"
											id="creditor<?= $index ?>"
											onchange="get_account_balance(<?= $index ?>,'cr')"
											class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm select2 credit_select">
											<option value="">Select</option>
											<?php foreach ($receipt_Creditors as $row): ?>
												<option value="<?= $row->account_id ?>" <?= ($row->account_id == $credit->account_id) ? 'selected' : '' ?>>
													<?= htmlspecialchars($row->account_name) ?>
												</option>
											<?php endforeach; ?>
										</select>
										<p class="text-xs text-gray-500 mt-1" id="set_balancecr<?= $index ?>">Balance: 0.00</p>
									</td>
									<td class="border p-2">
										<input type="number"
											step="0.01"
											name="cr_amount[]"
											id="cr_amount<?= $index ?>"
											class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm credit_sum focus:ring-2 focus:ring-blue-500 focus:outline-none"
											onkeyup="calculate_grand_total()"
											oninput="calculate_grand_total()"
											value="<?= number_format($credit->amount, 2, '.', '') ?>"
											placeholder="0.00">
									</td>
									<td class="border p-2 text-center">
										<button type="button"
											onclick="remove_row_cr(<?= $index ?>)"
											class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition">
											🗑
										</button>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr id="cr_addr0">
								<td class="border p-2">
									<select name="creditor[]"
										id="creditor0"
										onchange="get_account_balance(0,'cr')"
										class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm select2 credit_select">
										<option value="">Select</option>
										<?php foreach ($receipt_Creditors as $row): ?>
											<option value="<?= $row->account_id ?>">
												<?= htmlspecialchars($row->account_name) ?>
											</option>
										<?php endforeach; ?>
									</select>
									<p class="text-xs text-gray-500 mt-1" id="set_balancecr0">Balance: 0.00</p>
								</td>
								<td class="border p-2">
									<input type="number"
										step="0.01"
										name="cr_amount[]"
										id="cr_amount0"
										class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm credit_sum focus:ring-2 focus:ring-blue-500 focus:outline-none"
										onkeyup="calculate_grand_total()"
										oninput="calculate_grand_total()"
										placeholder="0.00">
								</td>
								<td class="border p-2 text-center">
									<button type="button"
										onclick="remove_row_cr(0)"
										class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition">
										🗑
									</button>
								</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Narration & Summary Totals -->
		<div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-gray-50 p-5 rounded-xl border border-gray-200">
			<!-- Narration -->
			<div class="md:col-span-1">
				<label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Narration / Remarks</label>
				<textarea name="narration" id="narration"
					class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
					rows="3"
					placeholder="Enter voucher notes or reference..."><?= isset($receipt_header->narration) ? htmlspecialchars($receipt_header->narration) : '' ?></textarea>
			</div>

			<!-- Credit Total (From Scrap) -->
			<div>
				<label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Credit Total (From Scrap)</label>
				<input id="debit_total" readonly
					class="w-full h-[42px] rounded-lg bg-gray-100 border border-gray-300 px-4 text-base font-bold text-gray-800 text-right">
			</div>

			<!-- Debit Total (Payment) -->
			<div>
				<label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Debit Total (Payment)</label>
				<input id="credit_total" readonly
					class="w-full h-[42px] rounded-lg bg-gray-100 border border-gray-300 px-4 text-base font-bold text-gray-800 text-right">
			</div>
		</div>

		<!-- Hidden helper inputs -->
		<input type="hidden" id="vtime" name="vtime" value="<?= date('h:i:s'); ?>">
		<input type="hidden" id="selected_invoice_ids" name="selected_invoice_ids">

		<!-- Action Buttons -->
		<div class="flex justify-center gap-4 pt-4 border-t border-gray-200">
			<button type="submit"
				onclick="return check_total();"
				class="px-8 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition shadow">
				Update Receipt Voucher
			</button>
			<button type="reset"
				class="px-8 py-2.5 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">
				Reset
			</button>
			<a href="<?= base_url('index.php/scrap/view_receipt_list') ?>"
				class="px-8 py-2.5 bg-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-400 transition">
				Cancel
			</a>
		</div>

	</form>
</div>

<script>
	var crRowCount = <?= max(1, isset($receipt_credits) ? count($receipt_credits) : 0) ?>;
	var initialReceiptData = {
		customer: <?= json_encode($selected_customer ?? '') ?>,
		invoiceAmounts: <?= isset($receipt_details) ? json_encode(array_map(function ($d) {
			return [
				'invoice_id' => isset($d->invoice_id) ? (int) $d->invoice_id : null,
				'invoice_no' => $d->invoice_no ?? '',
				'amount' => (float) ($d->receipt_amount ?? 0),
			];
		}, $receipt_details)) : '[]' ?>,
		voucherCode: <?= json_encode($voucher_code) ?>
	};

	$(document).ready(function() {
		$('.select2').select2({
			width: '100%'
		});

		// Credit row add button
		$('#cr_add_row').click(function(e) {
			e.preventDefault();
			add_credit_row();
		});

		toggleTransactionFields();
		
		// Preselect customer and load invoices for edit mode
		if (initialReceiptData.customer) {
			const customerSelect = $('#customer_name');
			const hasCustomerOption = customerSelect.find('option').filter(function () {
				return $(this).val() === initialReceiptData.customer;
			}).length > 0;
			if (!hasCustomerOption) {
				customerSelect.append(new Option(initialReceiptData.customer, initialReceiptData.customer, true, true));
			}
			customerSelect.val(initialReceiptData.customer).trigger('change');
			load_scrap_invoices();
		}

		// Fetch balances for initial credit accounts
		$('.credit_select').each(function(index, el) {
			if ($(el).val()) {
				get_account_balance(index, 'cr');
			}
		});
	});

	function getReceiptPaidAmount(invoice) {
		const byId = initialReceiptData.invoiceAmounts.find(function (d) {
			return d.invoice_id && String(d.invoice_id) === String(invoice.id);
		});
		if (byId) {
			return parseFloat(byId.amount) || 0;
		}
		const byNo = initialReceiptData.invoiceAmounts.find(function (d) {
			return d.invoice_no && d.invoice_no === invoice.invoice_no;
		});
		return byNo ? (parseFloat(byNo.amount) || 0) : 0;
	}

	function load_scrap_invoices() {
		const customer = document.getElementById('customer_name').value;
		if (!customer) {
			document.getElementById('invoice_body').innerHTML = `
				<tr>
					<td colspan="7" class="text-center py-6 text-gray-500">
						Select a customer to load pending scrap invoices
					</td>
				</tr>
			`;
			document.getElementById('debit_total').value = '0.00';
			return;
		}

		$.ajax({
			url: '<?= base_url("index.php/Scrap/get_scrap_invoices") ?>',
			type: 'POST',
			data: {
				customer_name: customer,
				voucher_code: initialReceiptData.voucherCode
			},
			dataType: 'json',
			success: function(invoices) {
				if (!invoices || invoices.length === 0) {
					document.getElementById('invoice_body').innerHTML = `
						<tr>
							<td colspan="7" class="text-center py-6 text-gray-500">
								No pending scrap invoices found for this customer
							</td>
						</tr>
					`;
					document.getElementById('debtor').value = '';
					document.getElementById('debit_total').value = '0.00';
					return;
				}

				if (invoices && invoices.length > 0) {
					document.getElementById('debtor').value = invoices[0].customer_ledger_id || '';
				} else {
					document.getElementById('debtor').value = '';
				}

				let html = '';
				invoices.forEach((invoice) => {
					const paidAmount = getReceiptPaidAmount(invoice);
					const maxPayable = parseFloat(invoice.max_payable ?? invoice.pending_amount) || 0;
					const displayAmount = paidAmount > 0 ? Math.min(paidAmount, maxPayable) : 0;
					const isChecked = displayAmount > 0 ? 'checked' : '';

					html += `
						<tr class="hover:bg-gray-50">
							<td class="border p-2 text-center">
								<input type="checkbox" name="invoiceID[]" value="${invoice.id}" 
									class="invoice-checkbox" 
									${isChecked}
									onchange="onInvoiceCheckboxChange(${invoice.id})">
								<input type="hidden" name="invoice_no[${invoice.id}]" value="${invoice.invoice_no}">
							</td>
							<td class="border p-2 font-medium text-gray-800">${invoice.invoice_no}</td>
							<td class="border p-2 text-gray-600">${invoice.sale_date || 'N/A'}</td>
							<td class="border p-2 text-right font-medium text-gray-700">${parseFloat(invoice.total_amount).toFixed(2)}</td>
							<td class="border p-2 text-right text-gray-600">${parseFloat(invoice.paid_amount || 0).toFixed(2)}</td>
							<td class="border p-2 text-right font-semibold text-orange-600">${parseFloat(invoice.pending_amount).toFixed(2)}</td>
							<td class="border p-2">
								<input type="number" step="0.01" 
									name="dr_amount[${invoice.id}]"
									id="dr_amount_${invoice.id}"
									class="w-full rounded-lg border border-gray-300 px-3 py-1.5 text-right font-medium dr_amount focus:ring-2 focus:ring-blue-500 focus:outline-none"
									data-max-payable="${maxPayable.toFixed(2)}"
									max="${maxPayable.toFixed(2)}"
									value="${displayAmount > 0 ? displayAmount.toFixed(2) : ''}"
									oninput="onInvoiceAmountInput(${invoice.id})"
									placeholder="0.00">
							</td>
						</tr>
					`;
				});

				document.getElementById('invoice_body').innerHTML = html;
				calculate_grand_total();
			},
			error: function() {
				alert('Error loading scrap invoices');
			}
		});
	}

	function select_all_invoices() {
		const checked = document.getElementById('select_all_invoices').checked;
		document.querySelectorAll('input[name="invoiceID[]"]').forEach(cb => {
			cb.checked = checked;
			const invoiceId = cb.value;
			if (!checked) {
				const input = document.getElementById(`dr_amount_${invoiceId}`);
				if (input) input.value = '';
			} else {
				const input = document.getElementById(`dr_amount_${invoiceId}`);
				if (input && (parseFloat(input.value) || 0) === 0) {
					const maxPayable = parseFloat(input.getAttribute('data-max-payable')) || 0;
					if (maxPayable > 0) input.value = maxPayable.toFixed(2);
				}
			}
		});
		calculate_grand_total();
	}

	function onInvoiceAmountInput(invoiceId) {
		const input = document.getElementById(`dr_amount_${invoiceId}`);
		const checkbox = document.querySelector(`.invoice-checkbox[value="${invoiceId}"]`);
		if (input) {
			const val = parseFloat(input.value) || 0;
			if (checkbox) {
				checkbox.checked = (val > 0);
			}
		}
		clampPaymentAmount(invoiceId);
		calculate_grand_total();
	}

	function onInvoiceCheckboxChange(invoiceId) {
		const input = document.getElementById(`dr_amount_${invoiceId}`);
		const checkbox = document.querySelector(`.invoice-checkbox[value="${invoiceId}"]`);
		if (checkbox && input) {
			if (checkbox.checked) {
				const val = parseFloat(input.value) || 0;
				if (val === 0) {
					const maxPayable = parseFloat(input.getAttribute('data-max-payable')) || 0;
					if (maxPayable > 0) input.value = maxPayable.toFixed(2);
				}
			} else {
				input.value = '';
			}
		}
		calculate_grand_total();
	}

	function add_credit_row() {
		const newRow = `
			<tr id="cr_addr${crRowCount}">
				<td class="border p-2">
					<select name="creditor[]"
						id="creditor${crRowCount}"
						onchange="get_account_balance(${crRowCount},'cr')"
						class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm select2 credit_select">
						<option value="">Select</option>
						<?php foreach ($receipt_Creditors as $row): ?>
							<option value="<?= $row->account_id ?>">
								<?= htmlspecialchars($row->account_name) ?>
							</option>
						<?php endforeach; ?>
					</select>
					<p class="text-xs text-gray-500 mt-1" id="set_balancecr${crRowCount}">Balance: 0.00</p>
				</td>
				<td class="border p-2">
					<input type="number" step="0.01"
						name="cr_amount[]"
						id="cr_amount${crRowCount}"
						class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm credit_sum focus:ring-2 focus:ring-blue-500 focus:outline-none"
						onkeyup="calculate_grand_total()"
						oninput="calculate_grand_total()"
						placeholder="0.00">
				</td>
				<td class="border p-2 text-center">
					<button type="button"
						onclick="remove_row_cr(${crRowCount})"
						class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition">
						🗑
					</button>
				</td>
			</tr>
		`;

		document.getElementById('cr_body').insertAdjacentHTML('beforeend', newRow);
		$(`#creditor${crRowCount}`).select2();
		crRowCount++;
	}

	function remove_row_cr(rowId) {
		const row = document.getElementById(`cr_addr${rowId}`);
		if (row) {
			row.remove();
			calculate_grand_total();
		}
	}

	function clampPaymentAmount(invoiceId) {
		const input = document.getElementById(`dr_amount_${invoiceId}`);
		if (!input || input.value === '') {
			return;
		}

		const maxPayable = parseFloat(input.getAttribute('data-max-payable')) || 0;
		const value = parseFloat(input.value);
		if (isNaN(value) || value <= maxPayable) {
			return;
		}

		input.value = maxPayable.toFixed(2);
	}

	function clampAllPaymentAmounts() {
		document.querySelectorAll('.dr_amount').forEach(function (input) {
			const invoiceId = input.id.replace('dr_amount_', '');
			clampPaymentAmount(invoiceId);
		});
	}

	function calculate_grand_total() {
		clampAllPaymentAmounts();

		let debitTotal = 0;
		let creditTotal = 0;

		document.querySelectorAll('.dr_amount').forEach(input => {
			const invoiceId = input.id.replace('dr_amount_', '');
			const checkbox = document.querySelector(`.invoice-checkbox[value="${invoiceId}"]`);
			const amount = parseFloat(input.value) || 0;

			if (amount > 0 && checkbox && !checkbox.checked) {
				checkbox.checked = true;
			}

			if (checkbox && checkbox.checked) {
				debitTotal += amount;
			}
		});

		document.querySelectorAll('input[name="cr_amount[]"]').forEach(input => {
			const amount = parseFloat(input.value) || 0;
			creditTotal += amount;
		});

		document.getElementById('debit_total').value = debitTotal.toFixed(2);
		document.getElementById('credit_total').value = creditTotal.toFixed(2);
	}

	function get_account_balance(rowId, type) {
		const accountSelect = document.getElementById(type === 'cr' ? `creditor${rowId}` : `debtor${rowId}`);
		if (!accountSelect) return;
		const accountId = accountSelect.value;
		if (!accountId) {
			document.getElementById(`set_balance${type}${rowId}`).innerHTML = 'Balance: 0.00';
			return;
		}

		$.ajax({
			url: '<?= base_url("index.php/Accounts/get_account_balance") ?>',
			type: 'POST',
			data: { account_id: accountId, today: document.getElementById('v_date').value },
			success: function(balance) {
				document.getElementById(`set_balance${type}${rowId}`).innerHTML = 'Balance: ' + balance;
			}
		});
	}

	function toggleTransactionFields() {
		const type = document.getElementById("transaction_type").value;
		const transactionFields = document.getElementById("transaction_fields");
		const label = document.getElementById("transaction_label");

		if (type === 'cheque') {
			transactionFields.style.display = 'block';
			label.innerHTML = 'Cheque Number <span class="text-red-500">*</span>';
		} else if (type === 'etransfer') {
			transactionFields.style.display = 'block';
			label.innerHTML = 'Transaction ID / Reference <span class="text-red-500">*</span>';
		} else if (type === 'other') {
			transactionFields.style.display = 'block';
			label.innerHTML = 'Remarks / Reference <span class="text-red-500">*</span>';
		} else {
			transactionFields.style.display = 'none';
			document.getElementById("transaction_no").value = '';
		}
	}

	function check_total() {
		clampAllPaymentAmounts();
		calculate_grand_total();

		const debitTotal = parseFloat(document.getElementById('debit_total').value) || 0;
		const creditTotal = parseFloat(document.getElementById('credit_total').value) || 0;

		if (debitTotal === 0) {
			alert('Please select at least one scrap invoice to pay and enter a valid amount.');
			return false;
		}

		if (creditTotal === 0) {
			alert('Please enter payment amount in the credit payment section.');
			return false;
		}

		if (Math.abs(debitTotal - creditTotal) > 0.01) {
			alert('Credit Total (From Scrap): ' + debitTotal.toFixed(2) + ' and Debit Total (Payment): ' + creditTotal.toFixed(2) + ' must match!');
			return false;
		}

		return true;
	}
</script>
