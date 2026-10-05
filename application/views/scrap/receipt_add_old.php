<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<div class="p-6">
	<div class="bg-white rounded-xl shadow-sm border border-gray-200">

		<!-- Header -->
		<div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
			<h2 class="text-lg font-semibold text-gray-800">Scrap Receipt Voucher</h2>

			<span class="flex gap-2">
				<a href="<?php echo base_url('index.php/scrap/add_receipt'); ?>"
					class="inline-flex items-center rounded-full bg-blue-100 text-blue-700 text-xs font-medium px-3 py-1 hover:bg-blue-200 transition"
					title="Add New Record">
					Add New Record
				</a>

				<a href="<?php echo base_url('index.php/scrap/view_receipt_list'); ?>"
					class="inline-flex items-center rounded-full bg-blue-100 text-blue-700 text-xs font-medium px-3 py-1 hover:bg-blue-200 transition"
					title="List Records">
					List Records
				</a>
			</span>

		</div>

		<!-- Form -->
		<form action="<?= base_url('index.php/Scrap/add_receipt_details'); ?>"
			id="receipt"
			method="post"
			class="p-6 space-y-8">


			<!-- ======================================================================== -->
			<div class="bg-white p-6 rounded-xl shadow">

				<!-- ================= ROW 1 ================= -->
				<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-4">

					<!-- Date -->
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">
							Date <span class="text-red-500">*</span>
						</label>
						<input type="date"
							id="v_date"
							name="v_date"
							value="<?= date('Y-m-d') ?>"
							class="w-full h-[38px] rounded-lg border border-gray-300 px-3 text-sm focus:ring-2 focus:ring-blue-500">
					</div>

					<!-- Customer -->
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">
							Select Customer <span class="text-red-500">*</span>
						</label>
						<select name="customer_name"
							id="customer_name"
							class="w-full h-[38px] rounded-lg border border-gray-300 px-3 text-sm select2"
							onchange="load_scrap_invoices()">

							<option value="">Select Customer</option>

							<?php 
								// Get unique customers from scrap invoices
								$customers = $this->db
									->distinct()
									->select('customer_name')
									->from('scrap_sales')
									->where('payment_status !=', 'Paid')
							->where('customer_name IS NOT NULL', null, false)
							->where("TRIM(customer_name) != ''", null, false)
							->where("LOWER(TRIM(customer_name)) != 'null'", null, false)
							->order_by('customer_name')
							->get()
							->result();
						?>
								<?php foreach ($customers as $c): ?>
							<option value="<?= $c->customer_name ?>">
								<?= $c->customer_name ?>
							</option>
						<?php endforeach; ?>
						<label class="block text-sm font-medium text-gray-700 mb-1">
							Transaction Type <span class="text-red-500">*</span>
						</label>
						<select name="transaction_type"
							id="transaction_type"
							onchange="toggleTransactionFields()"
							class="w-full h-[38px] rounded-lg border border-gray-300 px-3 text-sm select2">

							<option value="">Select</option>
							<option value="Cash">Cash</option>
							<option value="cheque">Cheque</option>
							<option value="etransfer">Card/Transfer</option>
							<option value="other">Other</option>
						</select>
					</div>

					<!-- Transaction No -->
					<div id="transaction_fields" class="hidden">
						<label class="block text-sm font-medium text-gray-700 mb-1" id="transaction_label">
							Transaction No
						</label>

						<input type="text"
							id="transaction_no"
							name="transaction_no"
							placeholder="Cheque / Txn ID"
							class="w-full h-[38px] rounded-lg border border-gray-300 px-3 text-sm focus:ring-2 focus:ring-blue-500">
					</div>

				</div>

			</div>

			<!-- Scrap Invoice List -->
			<div id="invoice_section">
				<h3 class="text-sm font-semibold text-gray-700 mb-2">Scrap Invoice Details</h3>
				<div id="scrap_list" class="overflow-x-auto">
					<table class="min-w-full border border-gray-200 rounded-lg">
						<thead class="bg-gray-50 text-xs uppercase text-gray-600">
							<tr>
								<th class="px-4 py-2 text-left">
									<input type="checkbox" id="select_all_invoices" onchange="select_all_invoices()">
								</th>
								<th class="px-4 py-2 text-left">Invoice No</th>
								<th class="px-4 py-2 text-left">Sale Date</th>
								<th class="px-4 py-2 text-right">Total Amount</th>
								<th class="px-4 py-2 text-right">Paid Amount</th>
								<th class="px-4 py-2 text-right">Pending Amount</th>
								<th class="px-4 py-2 text-right">Amount to Pay</th>
							</tr>
						</thead>
						<tbody id="invoice_body">
							<tr>
								<td colspan="7" class="text-center py-4 text-gray-500">
									Select a customer to load invoices
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<!-- Credit Table -->
			<div>
				<h3 class="text-sm font-semibold text-gray-700 mb-3">Credit Details (Cash/Bank Accounts)</h3>

				<div class="overflow-x-auto">
					<table id="cr_table" class="min-w-full border border-gray-200 rounded-lg">
						<thead class="bg-gray-50 text-xs uppercase text-gray-600">
							<tr>
								<th class="px-4 py-2 text-left">Credit Account (Cr)</th>
								<th class="px-4 py-2 text-left">Amount</th>
								<th class="px-4 py-2 text-center">
									<button type="button"
										id="cr_add_row"
										class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 hover:bg-orange-200">
										+
									</button>
								</th>
							</tr>
						</thead>
						<tbody id="cr_body">
							<tr id="cr_addr0">
								<td class="px-4 py-2">
									<select name="creditor[]"
										id="creditor0"
										onchange="get_account_balance(0,'cr')"
										class="w-full rounded-lg border border-gray-300 px-3 py-2 select2 credit_select">
										<option value="">Select</option>
										<?php foreach ($sundry_detors_records as $row): ?>
											<option value="<?= $row->account_id ?>">
												<?= $row->account_name ?>
											</option>
										<?php endforeach; ?>
									</select>
									<p class="text-xs text-gray-500 mt-1" id="set_balancecr0">Balance</p>
								</td>
								<td class="px-4 py-2">
									<input type="number"
										step="0.01"
										name="cr_amount[]"
										id="cr_amount0"
										class="w-full rounded-lg border border-gray-300 px-3 py-2 credit_sum"
										onkeyup="calculate_grand_total()">
								</td>
								<td class="px-4 py-2 text-center">
									<button type="button"
										onclick="remove_row_cr(0)"
										class="w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-200">
										🗑
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<!-- Totals -->
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6 ">
				<!-- Narration -->
				<div>
					<label class="block text-sm font-medium text-gray-700 mb-1">Narration</label>
					<textarea name="narration" id="narration"
						class="w-full rounded-lg border border-gray-300 px-4 py-2"
						rows="3"></textarea>
				</div>
				<div>
					<label class="block text-sm font-medium text-gray-700 mb-1">Debit Total (From Scrap)</label>
					<input id="debit_total" readonly
						class="w-full rounded-lg bg-gray-100 border border-gray-300 px-4 py-2 font-semibold">
				</div>
				<div>
					<label class="block text-sm font-medium text-gray-700 mb-1">Credit Total (Payment)</label>
					<input id="credit_total" readonly
						class="w-full rounded-lg bg-gray-100 border border-gray-300 px-4 py-2 font-semibold">
				</div>
			</div>

			<!-- Hidden -->
			<input type="hidden" id="vtime" name="vtime" value="<?= date('h:i:s'); ?>">
			<input type="hidden" id="selected_invoice_ids" name="selected_invoice_ids">

			<!-- Actions -->
			<div class="flex justify-center gap-4 pt-6 border-t border-gray-200">
				<button type="submit"
					onclick="return check_total();"
					class="px-8 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
					Save
				</button>
				<button type="reset"
					class="px-8 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
					Reset
				</button>
				<a href="<?= base_url('index.php/scrap') ?>"
					class="px-8 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
					Cancel
				</a>
			</div>

		</form>
	</div>
</div>

<script>
	var crRowCount = 1;

	$(document).ready(function() {
		$('.select2').select2({
			width: '100%'
		});

		// Credit row add button
		$('#cr_add_row').click(function(e) {
			e.preventDefault();
			add_credit_row();
		});
	});

	function load_scrap_invoices() {
		const customer = document.getElementById('customer_name').value;
		if (!customer) {
			document.getElementById('invoice_body').innerHTML = `
				<tr>
					<td colspan="7" class="text-center py-4 text-gray-500">
						Select a customer to load invoices
					</td>
				</tr>
			`;
			document.getElementById('debit_total').value = '';
			return;
		}

		$.ajax({
			url: '<?= base_url("index.php/Scrap/get_scrap_invoices") ?>',
			type: 'POST',
			data: { customer_name: customer },
			dataType: 'json',
			success: function(invoices) {
				if (!invoices || invoices.length === 0) {
					document.getElementById('invoice_body').innerHTML = `
						<tr>
							<td colspan="7" class="text-center py-4 text-gray-500">
								No pending invoices found for this customer
							</td>
						</tr>
					`;
					document.getElementById('debtor').value = '';
					return;
				}

				// Populate the debtor ledger account ID from the first invoice's customer_ledger_id
				if (invoices && invoices.length > 0) {
					document.getElementById('debtor').value = invoices[0].customer_ledger_id || '';
				} else {
					document.getElementById('debtor').value = '';
				}

				let html = '';
				invoices.forEach((invoice, index) => {
					html += `
						<tr>
							<td class="px-4 py-2">
								<input type="checkbox" name="invoiceID[]" value="${invoice.id}" 
									class="invoice-checkbox" 
									onchange="calculate_grand_total()">
								<input type="hidden" name="invoice_no[${invoice.id}]" value="${invoice.invoice_no}">
							</td>
							<td class="px-4 py-2">${invoice.invoice_no}</td>
							<td class="px-4 py-2">${invoice.sale_date || 'N/A'}</td>
							<td class="px-4 py-2 text-right">${parseFloat(invoice.total_amount).toFixed(2)}</td>
							<td class="px-4 py-2 text-right">${parseFloat(invoice.paid_amount || 0).toFixed(2)}</td>
							<td class="px-4 py-2 text-right">${parseFloat(invoice.pending_amount).toFixed(2)}</td>
							<td class="px-4 py-2">
								<input type="number" step="0.01" 
									name="dr_amount[${invoice.id}]"
									id="dr_amount_${invoice.id}"
									class="w-full rounded-lg border border-gray-300 px-3 py-2 dr_amount"
									onkeyup="calculate_grand_total()"
									placeholder="0.00">
							</td>
						</tr>
					`;
				});

				document.getElementById('invoice_body').innerHTML = html;
				calculate_grand_total();
			},
			error: function() {
				alert('Error loading invoices');
			}
		});
	}

	function select_all_invoices() {
		const checked = document.getElementById('select_all_invoices').checked;
		document.querySelectorAll('input[name="invoiceID[]"]').forEach(cb => {
			cb.checked = checked;
		});
		calculate_grand_total();
	}

	function add_credit_row() {
		const newRow = `
			<tr id="cr_addr${crRowCount}">
				<td class="px-4 py-2">
					<select name="creditor[]"
						id="creditor${crRowCount}"
						onchange="get_account_balance(${crRowCount},'cr')"
						class="w-full rounded-lg border border-gray-300 px-3 py-2 select2 credit_select">
						<option value="">Select</option>
						<?php foreach ($sundry_detors_records as $row): ?>
							<option value="<?= $row->account_id ?>">
								<?= $row->account_name ?>
							</option>
						<?php endforeach; ?>
					</select>
					<p class="text-xs text-gray-500 mt-1" id="set_balancecr${crRowCount}">Balance</p>
				</td>
				<td class="px-4 py-2">
					<input type="number" step="0.01"
						name="cr_amount[]"
						id="cr_amount${crRowCount}"
						class="w-full rounded-lg border border-gray-300 px-3 py-2 credit_sum"
						onkeyup="calculate_grand_total()">
				</td>
				<td class="px-4 py-2 text-center">
					<button type="button"
						onclick="remove_row_cr(${crRowCount})"
						class="w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-200">
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

	function calculate_grand_total() {
		let debitTotal = 0;
		let creditTotal = 0;

		// Calculate debit (from selected scrap invoices)
		document.querySelectorAll('.invoice-checkbox:checked').forEach(checkbox => {
			const invoiceId = checkbox.value;
			const amount = parseFloat(document.getElementById(`dr_amount_${invoiceId}`).value) || 0;
			debitTotal += amount;
		});

		// Calculate credit (from payment accounts)
		document.querySelectorAll('input[name="cr_amount[]"]').forEach(input => {
			const amount = parseFloat(input.value) || 0;
			creditTotal += amount;
		});

		document.getElementById('debit_total').value = debitTotal.toFixed(2);
		document.getElementById('credit_total').value = creditTotal.toFixed(2);
	}

	function get_account_balance(rowId, type) {
		const accountId = document.getElementById(type === 'cr' ? `creditor${rowId}` : `debtor${rowId}`).value;
		if (!accountId) return;

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
			transactionFields.style.display = 'flex';
			label.innerHTML = 'Cheque Number <span class="text-red-500">*</span>';
		} else if (type === 'etransfer') {
			transactionFields.style.display = 'flex';
			label.innerHTML = 'Transaction ID <span class="text-red-500">*</span>';
		} else if (type === 'other') {
			transactionFields.style.display = 'flex';
			label.innerHTML = 'Remarks <span class="text-red-500">*</span>';
		} else {
			transactionFields.style.display = 'none';
			document.getElementById("transaction_no").value = '';
		}
	}

	function check_total() {
		const debitTotal = parseFloat(document.getElementById('debit_total').value) || 0;
		const creditTotal = parseFloat(document.getElementById('credit_total').value) || 0;

		if (debitTotal === 0) {
			alert('Please select at least one scrap invoice to pay');
			return false;
		}

		if (creditTotal === 0) {
			alert('Please enter payment amount in credit section');
			return false;
		}

		if (Math.abs(debitTotal - creditTotal) > 0.01) {
			alert('Debit and Credit totals must match!');
			return false;
		}

		return true;
	}
</script>
