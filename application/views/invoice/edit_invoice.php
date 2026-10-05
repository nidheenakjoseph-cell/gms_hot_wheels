<?php
$services = [];
$parts = [];
$sublets = [];

foreach ($items as $it) {
	if ($it->item_type == 'Service') $services[] = $it;
	if ($it->item_type == 'Part') $parts[] = $it;
	if ($it->item_type == 'Sublet') $sublets[] = $it;
}

// Compute the non-part portion of discount (service + sublet discounts).
// Part discounts are auto-computed in JS from part-dis inputs to avoid double-counting.
$part_total_discount = 0;
foreach ($parts as $p) {
	$part_total_discount += floatval($p->disamount ?? 0);
}
$non_part_discount = max(0, floatval($invoice->discount_amount ?? 0) - $part_total_discount);
?>
<div class="w-full mx-auto bg-white shadow-xl rounded-2xl p-6">

	<?php if ($adj_err = $this->session->flashdata('invoice_adjustment_error')): ?>
	<div class="mb-5 flex items-start gap-3 rounded-xl border border-amber-200 bg-amber-50 px-5 py-4 text-amber-800" role="alert">
		<svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
			<path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
		</svg>
		<div>
			<p class="font-semibold text-sm">Advance Adjustment Error</p>
			<p class="text-sm mt-0.5"><?= htmlspecialchars($adj_err) ?></p>
		</div>
	</div>
	<?php endif; ?>

	<h2 class="text-2xl font-bold mb-6">
		Edit Invoice : <?= $invoice->invoice_no ?>
	</h2>

	<!-- HEADER -->
	<div class="grid grid-cols-2 gap-6 bg-gray-50 p-4 rounded mb-6">
		<div>
			<p><b>Customer :</b> <?= $invoice->name ?></p>
			<p><b>Phone :</b> <?= $invoice->phone ?></p>
		</div>

		<div>
			<p><b>Vehicle :</b> <?= $invoice->registration_no ?></p>
			<p><b>Job Card :</b> <?= $invoice->jobcard_no ?></p>
		</div>
	</div>

	<form method="post" action="<?= base_url('index.php/Invoice/update') ?>">

		<input type="hidden" name="invoice_id" value="<?= $invoice->invoice_id ?>">
		<input type="hidden" name="invoice_type" id="invoice_type" value="<?= $invoice->invoice_type  ?>">
		<input type="hidden" name="invoice_no" id="invoice_no" value="<?= $invoice->invoice_no  ?>">
		<input type="hidden" name="jobcard_id" id="jobcard_hidden" value="<?= $invoice->jobcard_id  ?>">
		<input type="hidden" name="quotation_id" id="quotation_hidden" value="<?= $invoice->quotation_id  ?>">
		<input type="hidden" name="customer_id" id="customer_id" value="<?= $invoice->customer_id  ?>">

		<!-- ================= SERVICES ================= -->
		<h3 class="font-semibold mb-2">Invoice Date</h3>
		<input type="date" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" name="invoice_date" id="invoice_date" value="<?= $invoice->invoice_date  ?>">
		<h3 class="font-semibold mb-2">Services</h3>

		<table class="w-full border text-sm mb-6" id="serviceTable">
			<thead class="bg-gray-100">
				<tr>
					<th class="border p-2"></th>
					<th class="border p-2">Service</th>
					<th class="border p-2 text-right">Cost</th>
				</tr>
			</thead>

			<tbody>

				<?php foreach ($services as $k =>  $s): ?>

					<tr>
						<td class="border p-2 text-center">
							<input type="checkbox" name="srv_check_open[<?= $k ?>]]"  class="srv-check" checked>
						</td>

						<td class="border p-2">
							<?= $s->item_name ?>
							<input type="hidden" name="srv_name[]" value="<?= $s->item_name ?>">
						</td>

						<td class="border p-2">
							<input type="number" step="0.01"
								value="<?= $s->total_price ?>"
								class="srv-cost w-full border p-1 rounded"
								name="srv_cost[]">
						</td>

					</tr>

				<?php endforeach; ?>

			</tbody>

			<tfoot class="bg-gray-100 font-bold">
				<tr>
					<td colspan="2" class="text-right p-2">Total Services</td>
					<td class="text-right p-2" id="service_total">0.00</td>
				</tr>
			</tfoot>

		</table>


		<!-- ================= PARTS ================= -->
		<h3 class="font-semibold mb-2">Spare Parts</h3>

		<table class="w-full border text-sm mb-6" id="partsTable">
			<thead class="bg-gray-100">
				<tr>
					<th class="border p-2"></th>
					<th class="border p-2">Part</th>
					<th class="border p-2">Qty</th>
					<th class="border p-2">Unit</th>
					<th class="border p-2">Discount</th>
					<th class="border p-2 text-right">Total</th>
				</tr>
			</thead>

			<tbody>

				<?php foreach ($parts  as $k =>  $p): ?>

					<tr>
						<td class="border p-2 text-center">
							<input type="checkbox" name="part_check_open[<?= $k ?>]" value="1"   class="part-check" checked>
						</td>

						<td class="border p-2">
							<?= $p->item_name ?>
							<input type="hidden" name="part_name[]" value="<?= $p->item_name ?>">
								<input type="hidden" name="part_id[]" value="<?= $p->source_jobcard_item_id ?>">
						</td>

						<td class="border p-2">
							<input type="number" value="<?= $p->quantity ?>"
								class="part-qty w-full border p-1 rounded" name="part_qty[]">
						</td>

						<td class="border p-2">
							<input type="number" value="<?= $p->unit_price ?>"
								class="part-price w-full border p-1 rounded" name="part_price[]">
						</td>

						<td class="border p-2">
							<input type="number" value="<?= $p->disamount ?>"
								class="part-dis w-full border p-1 rounded" name="part_dis[]">
						</td>

						<td class="border p-2">
							<input type="number" value="<?= $p->total_price ?>"
								class="part-total w-full border p-1 rounded" name="part_total[]" readonly>
						</td>

					</tr>

				<?php endforeach; ?>

			</tbody>

			<tfoot class="bg-gray-100 font-bold">
				<tr>
					<td colspan="5" class="text-right p-2">Total Parts</td>
					<td class="text-right p-2" id="parts_total">0.00</td>
				</tr>
			</tfoot>

		</table>


		<!-- ================= SUBLET ================= -->
		<h3 class="font-semibold mb-2">Sublet Service</h3>

		<table class="w-full border text-sm mb-6" id="subletTable">
			<thead class="bg-gray-100">
				<tr>
					<th class="border p-2"></th>
					<th class="border p-2">Description</th>
					<th class="border p-2 text-right">Amount</th>
				</tr>
			</thead>

			<tbody>

				<?php foreach ($sublets as $k => $d): ?>

					<tr>
						<td class="border p-2 text-center">
							<input type="checkbox" name="sub_check_open[<?= $k ?>]]"  class="sub-check" checked>
						</td>

						<td class="border p-2">
							<?= $d->item_name ?>
							<input type="hidden" name="sub_name[]" value="<?= $d->item_name ?>">
						</td>

						<td class="border p-2">
							<input type="number" value="<?= $d->total_price ?>"
								class="sub-cost w-full border p-1 rounded" name="sub_cost[]">
						</td>

					</tr>

				<?php endforeach; ?>

			</tbody>

			<tfoot class="bg-gray-100 font-bold">
				<tr>
					<td colspan="2" class="text-right p-2">Total Description</td>
					<td class="text-right p-2" id="sub_total">0.00</td>
				</tr>
			</tfoot>

		</table>


		<!-- TOTAL PANEL -->
		<div class="grid grid-cols-2 gap-6">

			<textarea name="remarks"
				class="border rounded p-3 w-full"><?= $invoice->remarks ?></textarea>

			<div class="bg-gray-50 p-4 rounded">

				<div class="flex justify-between"><span>Subtotal</span><span id="subtotal">0</span></div>
				<div class="flex justify-between items-center gap-2">
					<span>Discount (Services/Sublet)</span>
					<input type="text" step="0.01" name="discount_amount" id="discount_amount_field"
						value="<?= number_format($non_part_discount, 2, '.', '') ?>"
						class="w-32 border rounded px-2 py-1 text-right">
				</div>
				<div class="flex justify-between text-sm text-gray-500">
					<span>Parts Discount (auto)</span>
					<span id="parts_discount_display">0.00</span>
				</div>
				<div class="flex justify-between"><span>Taxable Amount</span><span id="taxableamt">0</span></div>
				<div class="flex justify-between"><span>VAT</span><span id="vat">0</span></div>
				<div class="flex justify-between font-bold text-lg"><span>Grand</span><span id="grand">0</span></div>

				<div class="flex justify-between font-bold text-lg border-t pt-2 mt-2">
					<span>Advance Payment (if Any)</span>
					<input type="text" name="advance_paid" id="advance_paid" value="<?= $invoice->adv_paid ?>"
						class="advance_paid text-right border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
				</div>
				<?php if (!empty($other_paid) && $other_paid > 0): ?>
				<div class="flex justify-between font-bold text-lg border-t pt-2 mt-2 text-blue-700">
					<span>Receipt / Other Payments</span>
					<span><?= number_format($other_paid, 2) ?></span>
					<input type="hidden" id="other_paid" value="<?= $other_paid ?>">
				</div>
				<?php else: ?>
					<input type="hidden" id="other_paid" value="0">
				<?php endif; ?>
				<div class="flex justify-between font-bold text-lg border-t pt-2 mt-2">
					<span>Balance</span>
					<span id="balance">0.00</span>
				</div>
				<!-- ==================== advance entry====================== -->

				<input type="hidden" name="subtotal" id="subtotal_input">
				<input type="hidden" name="tax_amount" id="tax_input">
				<input type="hidden" name="discount_amount" id="discount_input">
				<input type="hidden" name="grand_total" id="grand_input">

				<input type="hidden" name="adv_paid" id="adv_paid" value="<?= $invoice->adv_paid ?>">
				<input type="hidden" name="balance_total" id="balance_total">

			</div>

		</div>

		<div id="account_entry">
			<br>
			<hr>
			<hr><br>
			<p class="font-semibold mb-3">Sales Invoice Account Entry :</p>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

				<!-- Debit Table -->
				<div>
					<table class="w-full border border-gray-300 text-sm" id="inv_dr_table">
						<thead class="bg-gray-100">
							<tr>
								<th class="border px-2 py-2 text-left">Debit Customer (Dr)</th>
								<th class="border px-2 py-2 text-left">Debit Amount (AED)</th>
								<th class="border px-2 py-2 text-center w-[10%]">
									<!-- <a id="inv_dr_add_row" title="Add"
										class="inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white px-2 py-1 rounded cursor-pointer">
										<span class="fa fa-plus"></span>
									</a> -->
								</th>
							</tr>
						</thead>

						<tbody id="inv_dr_body">
							<tr id="inv_dr_addr0">
								<td class="border px-2 py-2">
									<select class="w-full border rounded px-2 py-1 text-sm select2 select2Width debtor-select"
										id="inv_debtor0" name="inv_debtor[]">
										<option value="">Select</option>
										<?php foreach ($sundry_accounts1 as $row) { ?>
											<option value="<?php echo $row->account_id; ?>">
												<?php echo $row->account_name; ?>
											</option>
										<?php } ?>
									</select>
								</td>

								<td class="border px-2 py-2">
									<input type="number" step="0.01" name="inv_dr_amount[]"
										id="inv_dr_amount0"
										class="w-full border rounded px-2 py-1 text-sm debit_sum"
										min="0">
								</td>

								<td class="border px-2 py-2 text-center">
									<a title="Delete" onclick="remove_row_inv_dr(0)"
										class="inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white px-2 py-1 rounded cursor-pointer">
										<span class="fa fa-trash"></span>
									</a>
								</td>
							</tr>

							<tr id="inv_dr_addr1">
								<td class="border px-2 py-2">
									<select class="w-full border rounded px-2 py-1 text-sm select3"
										id="inv_debtor1" name="inv_debtor[]">
										<option value="">Select</option>
										<?php foreach ($sundry_accounts3 as $row) { ?>
											<option <?php if ($row->account_id == 1122) echo 'selected'; ?>
												value="<?php echo $row->account_id; ?>">
												<?php echo $row->account_name; ?>
											</option>
										<?php } ?>
									</select>
									<label class="text-xs text-gray-500">Discount Allowed (Dr)</label>
								</td>
								<td class="border px-2 py-2">
									<input type="number" step="0.01" name="inv_dr_amount[]"
										id="inv_dr_amount1"
										class="w-full border rounded px-2 py-1 text-sm debit_sum"
										min="0" value="0">
								</td>
								<td class="border px-2 py-2 text-center"></td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- Credit Table -->
				<div>
					<table class="w-full border border-gray-300 text-sm" id="inv_cr_table">
						<thead class="bg-gray-100">
							<tr>
								<th class="border px-2 py-2 text-left">Credit Account (Cr)</th>
								<th class="border px-2 py-2 text-left">Credit Amount (AED)</th>
								<th class="border px-2 py-2 text-center w-[10%]">
									<!-- <a id="inv_cr_add_row" title="Add"
										class="inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white px-2 py-1 rounded cursor-pointer">
										<span class="fa fa-plus"></span>
									</a> -->
								</th>
							</tr>
						</thead>

						<tbody id="inv_cr_body">

							<tr id="inv_cr_addr0">
								<td class="border px-2 py-2">
									<select class="w-full border rounded px-2 py-1 text-sm select2 credit_select"
										id="inv_creditor0" name="inv_creditor[]">
										<option value="">Select</option>
										<?php foreach ($sundry_accounts2 as $row) { ?>
											<option <?php if ($row->account_id == 1125) echo 'selected'; ?>
												value="<?php echo $row->account_id; ?>">
												<?php echo $row->account_name; ?>
											</option>
										<?php } ?>
									</select>
									<label id="set_balanceinv_cr0" class="text-xs text-gray-500">Balance</label>
								</td>

								<td class="border px-2 py-2">
									<input type="number" step="0.01" name="inv_cr_amount[]"
										id="inv_cr_amount0"
										class="w-full border rounded px-2 py-1 text-sm credit_sum"
										min="0">
								</td>

								<td class="border px-2 py-2 text-center">
									<a title="Delete" onclick="remove_row_inv_cr(0)"
										class="inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white px-2 py-1 rounded cursor-pointer">
										<span class="fa fa-trash"></span>
									</a>
								</td>
							</tr>

							<tr id="inv_cr_addr1">
								<td class="border px-2 py-2">
									<select class="w-full border rounded px-2 py-1 text-sm select3"
										id="inv_creditor1" name="inv_creditor[]">
										<option value="">Select</option>
										<?php foreach ($sundry_accounts3 as $row) { ?>
											<option <?php if ($row->account_id == 228) echo 'selected'; ?>
												value="<?php echo $row->account_id; ?>">
												<?php echo $row->account_name; ?>
											</option>
										<?php } ?>
									</select>
									<label class="text-xs text-gray-500">Balance</label>
								</td>

								<td class="border px-2 py-2">
									<input type="number" step="0.01" name="inv_cr_amount[]"
										id="inv_cr_amount1"
										class="w-full border rounded px-2 py-1 text-sm credit_sum"
										min="0">
								</td>

								<td class="border px-2 py-2 text-center">
									<a title="Delete" onclick="remove_row_inv_cr(1)"
										class="inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white px-2 py-1 rounded cursor-pointer">
										<span class="fa fa-trash"></span>
									</a>
								</td>
							</tr>

							<!-- Discount moved to Debit side — hidden placeholder to keep array index stable -->
							<tr id="inv_cr_addr2" style="display:none">
								<td><input type="hidden" name="inv_creditor[]" id="inv_creditor2" value=""></td>
								<td><input type="hidden" name="inv_cr_amount[]" id="inv_cr_amount2" value="0"></td>
								<td></td>
							</tr>

							<tr id="inv_cr_addr3">
								<td class="border px-2 py-2">
									<select class="w-full border rounded px-2 py-1 text-sm select3"
										id="inv_creditor3" name="inv_creditor[]">
										<option value="">Select</option>
										<?php foreach ($sundry_accounts3 as $row) { ?>
											<option value="<?php echo $row->account_id; ?>">
												<?php echo $row->account_name; ?>
											</option>
										<?php } ?>
									</select>
									<label class="text-xs text-gray-500">Balance</label>
								</td>

								<td class="border px-2 py-2">
									<input type="number" step="0.01" name="inv_cr_amount[]"
										id="inv_cr_amount3"
										class="w-full border rounded px-2 py-1 text-sm credit_sum"
										min="0" value="0">
								</td>

								<td class="border px-2 py-2 text-center">
									<a title="Delete" onclick="remove_row_inv_cr(3)"
										class="inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white px-2 py-1 rounded cursor-pointer">
										<span class="fa fa-trash"></span>
									</a>
								</td>
							</tr>

						</tbody>
					</table>
				</div>

			</div>
		</div>

		<a href="<?php echo base_url('index.php/Invoice'); ?>"
			class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-600">
			Cancel
		</a>
		<button class="mt-6 bg-green-600 text-white px-6 py-2 rounded">
			Update Invoice
		</button>

	</form>
</div>


<script>
	function calc() {

		let serviceTotal = 0;
		document.querySelectorAll('.srv-check:checked').forEach(c => {
			serviceTotal += parseFloat(c.closest('tr').querySelector('.srv-cost').value) || 0;
		});

		let partsTotal = 0;
		let partDiscount = 0;
		document.querySelectorAll('#partsTable tbody tr').forEach(r => {
			const chk = r.querySelector('.part-check');
			if (chk && chk.checked) {

				let qty   = parseFloat(r.querySelector('.part-qty').value)   || 0;
				let price = parseFloat(r.querySelector('.part-price').value) || 0;
				let dis   = parseFloat(r.querySelector('.part-dis').value)   || 0;

				let net = (qty * price) - dis;
				r.querySelector('.part-total').value = net.toFixed(2); // display net per row

				partsTotal   += (qty * price); // add GROSS to subtotal (discount handled separately)
				partDiscount += dis;           // collect part-level discount
			}
		});

		let subTotal = 0;
		document.querySelectorAll('.sub-check:checked').forEach(c => {
			subTotal += parseFloat(c.closest('tr').querySelector('.sub-cost').value) || 0;
		});

		document.getElementById('service_total').innerText = serviceTotal.toFixed(2);
		document.getElementById('parts_total').innerText = partsTotal.toFixed(2);
		document.getElementById('sub_total').innerText = subTotal.toFixed(2);

		// Total discount = auto-computed part discounts + manually entered service/sublet discount
		let manualDiscount = parseFloat(document.getElementById('discount_amount_field').value || 0);
		if (isNaN(manualDiscount)) manualDiscount = 0;
		let totaldisamt = partDiscount + manualDiscount;

		// Show auto-computed part discount for visibility
		const pdDisplay = document.getElementById('parts_discount_display');
		if (pdDisplay) pdDisplay.innerText = partDiscount.toFixed(2);

		let subtotal = serviceTotal + partsTotal + subTotal;
		let taxableamt = subtotal - totaldisamt;
		if (taxableamt < 0) taxableamt = 0;
		let vat = taxableamt * 0.05;
		let grand = taxableamt + vat;

		/* ========= advance & payment calculation ========= */
		let advpaid   = parseFloat(document.getElementById('advance_paid').value) || 0;
		let otherpaid = parseFloat(document.getElementById('other_paid')?.value  || 0);

		let totalPaid = advpaid + otherpaid;

		// prevent overpayment
		if (totalPaid > grand) {
			if (advpaid > grand - otherpaid) {
				advpaid = Math.max(0, grand - otherpaid);
				document.getElementById('advance_paid').value = advpaid.toFixed(2);
			}
			totalPaid = advpaid + otherpaid;
		}

		let baltot = Math.round((grand - totalPaid) * 100) / 100;
		if (baltot < 0) baltot = 0;

		document.getElementById('balance').innerText    = baltot.toFixed(2);
		document.getElementById('balance_total').value  = baltot.toFixed(2);

		/* ========= DISPLAY ========= */

		document.getElementById('subtotal').innerText = subtotal.toFixed(2);
		document.getElementById('vat').innerText = vat.toFixed(2);
		document.getElementById('grand').innerText = grand.toFixed(2);
		// document.getElementById('discount_amount_field').value = totaldisamt.toFixed(2);

		document.getElementById('taxableamt').innerText = taxableamt.toFixed(2);
		// ===================== Accounting journal entries ===================
		// Dr: Customer AR  = grand total
		document.getElementById("inv_dr_amount0").value = grand.toFixed(2);
		// Dr: Discount Allowed = total discount (moved from Cr to Dr side)
		document.getElementById("inv_dr_amount1").value = totaldisamt.toFixed(2);
		// Cr: Sales Revenue = subtotal (gross before discount)
		document.getElementById("inv_cr_amount0").value = subtotal.toFixed(2);
		// Cr: Output VAT
		document.getElementById("inv_cr_amount1").value = vat.toFixed(2);
		// Cr: zeroed — discount is on Dr side
		document.getElementById("inv_cr_amount2").value = "0";
		/* ========= HIDDEN INPUTS ========= */
		document.getElementById('subtotal_input').value  = subtotal.toFixed(2);
		document.getElementById('tax_input').value       = vat.toFixed(2);
		document.getElementById('discount_input').value  = totaldisamt.toFixed(2);
		document.getElementById('grand_input').value     = grand.toFixed(2);
		document.getElementById('adv_paid').value        = advpaid.toFixed(2);
		document.getElementById('balance_total').value   = baltot.toFixed(2);

	}

	document.querySelectorAll('input').forEach(i => i.addEventListener('input', calc));
	calc();

	$(document).ready(function() {

		var qid = document.getElementById('quotation_hidden').value;

		$.ajax({
			async: false,
			type: "POST",
			url: BASE_URL + "Ajax/ajax_get_cust_accountId_from_dc",
			data: {
				qid: qid
			},
			dataType: "json",
			success: function(data) {

				console.log("Account AJAX response:", data);

				if (!data || !data.accountId) {
					console.error("Invalid account data", data);
					return;
				}

				$('#inv_debtor0').val(data.accountId).trigger('change');

				var grand_total = parseFloat(
					document.getElementById('grand_input').value || 0
				);

				var sub_total = parseFloat(
					document.getElementById('subtotal_input').value || 0
				);

				var discount_amt = parseFloat(
					document.getElementById('discount_input').value || 0
				);

				var vat_amt = parseFloat(
					document.getElementById('tax_input').value || 0
				);

				// Dr: Customer AR = grand total
				document.getElementById("inv_dr_amount0").value = grand_total.toFixed(2);
				// Dr: Discount Allowed = total discount (Dr side)
				document.getElementById("inv_dr_amount1").value = discount_amt.toFixed(2);
				// Cr: Sales Revenue = subtotal (gross)
				document.getElementById("inv_cr_amount0").value = sub_total.toFixed(2);
				// Cr: Output VAT
				document.getElementById("inv_cr_amount1").value = vat_amt.toFixed(2);
				// Cr: zeroed — discount on Dr side
				document.getElementById("inv_cr_amount2").value = "0";

			},
			error: function(xhr) {
				console.error("Account AJAX error:", xhr.responseText);
			}
		});

	});

	// Advance Payment input listener — updates adv_paid hidden & recalculates balance
	document.getElementById('advance_paid').addEventListener('input', function() {
		let grand    = parseFloat(document.getElementById('grand_input')?.value ||
		               document.getElementById('grand')?.innerText) || 0;
		let advpaid  = parseFloat(this.value) || 0;
		let otherpaid = parseFloat(document.getElementById('other_paid')?.value || 0);

		let totalPaid = advpaid + otherpaid;
		if (totalPaid > grand) {
			advpaid = Math.max(0, grand - otherpaid);
			this.value = advpaid.toFixed(2);
			totalPaid  = advpaid + otherpaid;
		}

		let balance = Math.round((grand - totalPaid) * 100) / 100;
		if (balance < 0) balance = 0;

		document.getElementById('balance').innerText    = balance.toFixed(2);
		document.getElementById('adv_paid').value       = advpaid.toFixed(2);
		document.getElementById('balance_total').value  = balance.toFixed(2);
	});
</script>
