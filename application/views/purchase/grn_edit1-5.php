<?php $this->load->helper('account_helper.php'); ?>

<?php $grn = $grn ?? null; ?>

<div class="flex justify-between items-center bg-gray-200 px-4 py-3 rounded-t-lg">
	<h1 class="text-lg font-medium">Edit GRN</h1>
	<a href="<?php echo base_url(); ?>index.php/Purchase/purchase_grn_list"
		class="bg-gray-600 text-white px-4 py-2 rounded-lg">List</a>
</div>

<form method="post"
	action="<?php echo base_url(); ?>index.php/Purchase/edit_grn_records"
	autocomplete="off">


	<div class="bg-white rounded-xl p-4 shadow-sm mb-4">

		<div class="grid grid-cols-5 gap-3">

			<div>
				<label class="text-sm font-medium text-gray-600 mb-1 block">Select PO</label>
				<select class="w-full h-9 text-sm border border-gray-300 rounded px-2" name="po_id" id="po_id">
					<!-- <option value="">Select</option> -->
					<?php foreach ($records as $s) {

						if (!is_object($s) || !isset($s->po_id)) continue;
						if ((int)($grn->po_id ?? 0) === (int)$s->po_id) {
					?>
							<option value="<?php echo $s->po_id; ?>"
								<?php echo ((int)($grn->po_id ?? 0) === (int)$s->po_id) ? 'selected' : ''; ?>>
								<?php echo $s->po_code; ?>
							</option>
					<?php }
					} ?>
				</select>
			</div>
			<div>
				<label class="text-sm font-medium text-gray-600 mb-1 block">GRN Code</label>
				<input type="text" class="w-full h-9 text-sm border border-gray-200 bg-gray-100 rounded px-2"
					value="<?php echo $grn->grn_code ?? ''; ?>" readonly>
			</div>

			<div>
				<label class="text-sm font-medium text-gray-600 mb-1 block">GRN Date</label>
				<input type="date" class="w-full h-9 text-sm border border-gray-300 rounded px-2"
					value="<?php echo isset($grn->grn_date) ? date('Y-m-d', strtotime($grn->grn_date)) : ''; ?>">
			</div>

			<div>
				<label class="text-sm font-medium text-gray-600 mb-1 block">Supplier</label>
				<input type="text" class="w-full h-9 text-sm border border-gray-200 bg-gray-100 rounded px-2"
					value="<?php echo $grn->supplier_name ?? ''; ?>" readonly>
				<input type="hidden" name="supplier_id" value="<?php echo $grn->supplier_id ?? ''; ?>">
			</div>

			<div>
				<label class="text-sm font-medium text-gray-600 mb-1 block">Reference</label>
				<input type="text" class="w-full h-9 text-sm border border-gray-300 rounded px-2" name="ref_no">
			</div>

		</div>

	</div>

	<div class="bg-white rounded-xl p-4 shadow-sm mb-4">

		<table class="w-full border border-gray-200 rounded-lg overflow-hidden text-sm">
			<thead class="bg-gray-100 text-gray-700">
				<tr>
					<th class="px-3 py-2 text-left font-semibold">SR.NO</th>
					<th class="px-3 py-2 text-left font-semibold">PRODUCT</th>
					<th class="px-3 py-2 text-left font-semibold">QTY</th>
					<th class="px-3 py-2 text-left font-semibold">PRICE</th>
					<th class="px-3 py-2 text-left font-semibold">TOTAL</th>
				</tr>
			</thead>

			<tbody id="datatable-responsive">

				<?php $i = 1;
				foreach ($grn_tr as $row) { ?>
					<tr class="border-t hover:bg-gray-50">

						<td class="px-3 py-2"><?php echo $i++; ?></td>

						<td class="px-3 py-2">
							<?php echo $row->part_name; ?>
							<input type="hidden" name="product_id[]" value="<?php echo $row->product_id; ?>">
						</td>

						<td class="px-3 py-2">
							Ordered:
							<input type="text" class="w-full h-8 text-sm border border-gray-300 rounded px-2"
								value="<?php echo $row->ord_quantity; ?>" readonly>

							Received:
							<input type="text" name="rec_quantity[]"
								class="w-full h-8 text-sm border border-gray-300 rounded px-2 mt-1"
								value="<?php echo $row->rec_quantity; ?>">
						</td>

						<td class="px-3 py-2">
							<input type="text" name="price[]"
								class="w-full h-8 text-sm border border-gray-300 rounded px-2"
								value="<?php echo $row->price; ?>">
						</td>

						<td class="px-3 py-2">
							<input type="text" class="w-full h-8 text-sm border border-gray-200 bg-gray-100 rounded px-2"
								value="<?php echo $row->total; ?>" readonly>
						</td>

					</tr>
				<?php } ?>

			</tbody>
		</table>

	</div>

	<div class="bg-white rounded-xl p-4 shadow-sm mb-4">

		<div class="grid grid-cols-12 gap-3">

			<div class="col-span-2">
				<label class="text-sm font-medium text-gray-600 mb-1 block">Sub Total</label>
				<input type="text" name="sub_total" id="sub_total"
					class="w-full h-9 text-sm border border-gray-200 bg-gray-100 rounded px-2 text-right"
					value="<?php echo $grn->sub_total; ?>" readonly>
			</div>

			<div class="col-span-2">
				<label class="text-sm font-medium text-gray-600 mb-1 block">Discount %</label>
				<input type="text" name="discount_per" id="discount_per"
					class="w-full h-9 text-sm border border-gray-300 rounded px-2 text-right"
					value="<?php echo $grn->discount_percent ?? ''; ?>">
			</div>

			<div class="col-span-2">
				<label class="text-sm font-medium text-gray-600 mb-1 block">Discount Amt</label>
				<input type="text" name="discount_amt" id="discount_amt"
					class="w-full h-9 text-sm border border-gray-300 rounded px-2 text-right"
					value="<?php echo $grn->discount ?? ''; ?>">
			</div>

			<div class="col-span-2">
				<label class="text-sm font-medium text-gray-600 mb-1 block">VAT %</label>
				<input type="text" name="vat_per" id="vat_per"
					class="w-full h-9 text-sm border border-gray-300 rounded px-2 text-right"
					value="<?php echo $grn->vat_percent ?? ''; ?>">
			</div>

			<div class="col-span-2">
				<label class="text-sm font-medium text-gray-600 mb-1 block">VAT Amt</label>
				<input type="text" name="vat_amount" id="vat_amount"
					class="w-full h-9 text-sm border border-gray-300 rounded px-2 text-right"
					value="<?php echo $grn->vat_amt ?? ''; ?>">
			</div>

			<div class="col-span-2">
				<label class="text-sm font-medium text-gray-600 mb-1 block">Grand Total</label>
				<input type="text" name="grand_total" id="grand_total"
					class="w-full h-9 text-sm border border-gray-300 rounded px-2 text-right font-semibold"
					value="<?php echo $grn->grand_total ?? ''; ?>">
			</div>

		</div>

	</div>

	<div class="bg-white rounded-xl p-4 shadow-sm mb-4">

		<div class="grid grid-cols-12 gap-3">

			<div class="col-span-6">
				<label class="text-sm font-medium text-gray-600 mb-1 block">Remarks</label>
				<textarea class="w-full border border-gray-300 rounded px-2 py-2 text-sm" name="remarks"><?php echo $grn->remark ?? ''; ?></textarea>
			</div>

			<div class="col-span-4">
				<label class="text-sm font-medium text-gray-600 mb-1 block">Prepared By</label>
				<input type="text"
					class="w-full h-9 text-sm border border-gray-200 bg-gray-100 rounded px-2"
					value="<?php echo $this->session->userdata('username'); ?>" readonly>
			</div>

		</div>

		<hr>
		Purchase Invoice Account Entry :
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

			<!-- Debit Table -->
			<div>
				<table class="min-w-full border border-gray-300 rounded-lg text-sm">

					<thead class="bg-gray-100 text-gray-700">
						<tr>
							<th class="border border-gray-300 px-3 py-2 text-left">
								Debit Purchase (Dr)
							</th>
							<th class="border border-gray-300 px-3 py-2 text-left">
								Debit Amount (AED)
							</th>
						</tr>
					</thead>

					<tbody id="inv_dr_body" class="divide-y divide-gray-200">

						<!-- Row 0 -->
						<tr id="inv_dr_addr0" class="hover:bg-gray-50">
							<td class="border border-gray-300 px-3 py-2">
								<select class="w-full border border-gray-300 rounded px-2 py-1 text-sm select2 select2Width" id="inv_debtor0" name="inv_debtor[]" required>
									<option value="">Select <?php echo $grn->grn_id; ?></option>
									<?php foreach ($sundry_accounts1 as $r1) { ?>
										<option <?php if ($r1->account_id == 1120) echo 'selected'; ?> value="<?php echo $r1->account_id; ?>"><?php echo $r1->account_name; ?></option>
									<?php } ?>
								</select>
							</td>
							<td><input type="number" step='0.01' name="inv_dr_amount[]" id="inv_dr_amount0" class="border border-gray-300 px-3 py-2" required min=0 value="<?php echo $grn->sub_total; ?>">
							</td>
							<!--<td><a id='delete_row1' title="Delete" onclick='remove_row_inv_dr(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>-->
						</tr>
						<tr id="inv_dr_addr1" class="hover:bg-gray-50">
							<td class="border border-gray-300 px-3 py-2">
								<select class="w-full border border-gray-300 rounded px-2 py-1 text-sm select2 select2Width" id="inv_debtor1" name="inv_debtor[]" requird>
									<option value="">Select</option>
									<?php foreach ($sundry_accounts3 as $a2) { ?>
										<option <?php if ($a2->account_id == 1122) echo 'selected'; ?> value="<?php echo $a2->account_id; ?>"><?php echo $a2->account_name; ?></option>
									<?php } ?>
								</select>
							</td>
							<td><input type="number" step='0.01' name="inv_dr_amount[]" id="inv_dr_amount1" class="form-control form-control-sm debit_sum" requird min=0 value="<?php echo $grn->discount ?? ''; ?>">
							</td>
							<!--<td><a id='delete_row1' title="Delete" onclick='remove_row_inv_dr(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>-->
						</tr>
						<tr id="inv_dr_addr2" class="hover:bg-gray-50">
							<td class="border border-gray-300 px-3 py-2">
								<select class="w-full border border-gray-300 rounded px-2 py-1 text-sm select2 select2Width" id="inv_debtor2" name="inv_debtor[]" requird>
									<option value="">Select</option>
									<?php foreach ($sundry_accounts3 as $a3) { ?>
										<option <?php if ($a3->account_id == 226) echo 'selected'; ?> value="<?php echo $a3->account_id; ?>"><?php echo $a3->account_name; ?></option>
									<?php } ?>
								</select>
							</td>
							<td><input type="number" step='0.01' name="inv_dr_amount[]" id="inv_dr_amount2" class="form-control form-control-sm debit_sum" requird min=0 value="<?php echo $grn->vat_amt ?? ''; ?>">
							</td>
							<!--<td><a id='delete_row1' title="Delete" onclick='remove_row_inv_dr(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>-->
						</tr>
					</tbody>
				</table>
			</div>
			<div>
				<table class="min-w-full border border-gray-300 rounded-lg text-sm">

					<thead class="bg-gray-100 text-gray-700">
						<tr>
							<th class="border border-gray-300 px-3 py-2 text-left">
								Credit Supplier (Cr)
							</th>
							<th class="border border-gray-300 px-3 py-2 text-left">
								Credit Amount (AED)
							</th>
						</tr>
					</thead>

					<tbody id="inv_cr_body" class="divide-y divide-gray-200">

						<tr id="inv_cr_addr0" class="hover:bg-gray-50">
							<td class="border border-gray-300 px-3 py-2">
								<select class="w-full border border-gray-300 rounded px-2 py-1 text-sm select2Width" id="inv_creditor0" name="inv_creditor[]" required>
									<option value="">Select</option>
									<?php foreach ($sundry_accounts2 as $a4) { ?>
										<option <?php if ($a4->account_id == $grn->account_id) echo 'selected'; ?> value="<?php echo $a4->account_id; ?>"><?php echo $a4->account_name; ?></option>
									<?php } ?>
								</select>
								<!--<label id='set_balanceinv_cr0'>Balance</label>-->
							</td>
							<td><input type="number" step='0.01' name="inv_cr_amount[]" id="inv_cr_amount0" class="form-control form-control-sm credit_sum" required min=0 value="<?php echo get_voucher_by_trans_id($grn->grn_id, 'G', 'Cr', $grn->account_id); ?>">
							</td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>

		<div class="mt-4">
			<button type="submit"
				class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-sm">
				Update
			</button>
			<input type="hidden"  name="po_id" value="<?php echo $grn->po_id;?>" >
			<input type="hidden"  name="supplier_id" value="<?php echo $grn->supplier_id;?>" >
			<input type="hidden"  name="grn_id" value="<?php echo $grn->grn_id;?>" >
		</div>

	</div>


</form>


<script>
	//$(document).ready(function() {
	//	setTimeout(function() {
	//		calculateAll();
	//	}, 300);
	//});
</script>


<script>
	$(document).ready(function() {


		function triggerWhenReady() {

			let inputs = document.querySelectorAll('.rec_quantity');

			if (inputs.length > 0) {
				calculateAll();
			} else {
				setTimeout(triggerWhenReady, 200);
			}
		}

		// triggerWhenReady();

		function calculateRow($row) {
			// alert("ld");
			// ordered qty (class .qty)
			const orderedQty = parseFloat($row.find('.qty').val()) || 0;

			// received qty (class .rec_quantity) - use received if provided, else ordered
			const recInput = $row.find('.rec_quantity');
			const recVal = parseFloat(recInput.val());
			const receivedQty = !isNaN(recVal) ? recVal : 0;

			const qty = (receivedQty > 0) ? receivedQty : orderedQty;

			// price
			const price = parseFloat($row.find('.unit_price').val()) || 0;

			// per-row discount (optional)
			let disPer = parseFloat($row.find('.dis_percentage').val()) || 0;
			let disAmt = parseFloat($row.find('.dis_amount').val()) || 0;

			// locate the error small element - prefer id="error_msg{index}" if present (your markup has that)
			let errorMsgElem = null;
			// look for a small with id error_msg{data-index}
			const dataIndex = recInput.attr('data-index');
			if (typeof dataIndex !== 'undefined') {
				const idSel = '#error_msg' + dataIndex;
				if ($(idSel).length) errorMsgElem = $(idSel);
			}
			// fallback: element with class .error-msg inside row
			if (!errorMsgElem || errorMsgElem.length === 0) {
				errorMsgElem = $row.find('.error-msg');
			}

			// Validation: received should not exceed ordered
			if (!isNaN(recVal) && recVal > orderedQty) {
				// show error message
				if (errorMsgElem.length) {
					errorMsgElem.text('❌ Received quantity cannot exceed ordered quantity.').show();
				} else {
					// insert dynamic small after rec input if no place exists
					if ($row.find('.error-msg-dyn').length === 0) {
						recInput.after('<small class="text-danger error-msg-dyn" style="display:block;">❌ Received quantity cannot exceed ordered quantity.</small>');
					} else {
						$row.find('.error-msg-dyn').show();
					}
				}
				// mark invalid visually
				recInput.addClass('is-invalid');
				return 0;
			} else {
				// hide any error messages
				if (errorMsgElem.length) errorMsgElem.hide();
				$row.find('.error-msg-dyn').hide();
				recInput.removeClass('is-invalid');
			}

			// compute row total (before per-row discount)
			const rowBase = qty * price;

			// Determine whether user is editing percent or amount (if fields present)
			const isEditingPer = $row.find('.dis_percentage').is(':focus');
			const isEditingAmt = $row.find('.dis_amount').is(':focus');

			if ($row.find('.dis_percentage').length === 0 && $row.find('.dis_amount').length === 0) {
				// no per-row discount fields -> disPer/disAmt = 0
				disPer = 0;
				disAmt = 0;
			} else {
				// if percent field exists but amount empty, compute amount
				if ($row.find('.dis_percentage').length && !isEditingAmt) {
					disAmt = (rowBase * (disPer || 0)) / 100;
					$row.find('.dis_amount').val(disAmt.toFixed(2));
				} else if ($row.find('.dis_amount').length && !isEditingPer) {
					// percent based on amount
					disPer = (rowBase === 0) ? 0 : ((disAmt || 0) / rowBase) * 100;
					$row.find('.dis_percentage').val(disPer.toFixed(2));
				}
			}

			const finalRowTotal = Math.max(0, rowBase - (disAmt || 0)); // avoid negative
			// update UI
			$row.find('.total_price').val(finalRowTotal.toFixed(2));

			return finalRowTotal;
		}

		function calculateAll() {
			let rowSubtotal = 0;

			// iterate only rows in tbody of your items table
			$('#datatable-responsive tbody tr').each(function() {
				const rowTotal = calculateRow($(this)) || 0;
				rowSubtotal += rowTotal;
			});

			// update subtotal field
			$('#sub_total').val(rowSubtotal.toFixed(2));

			// Global discount handling (either percent or amount)
			const isGlobalPerEditing = $('#discount_per').is(':focus');
			const isGlobalAmtEditing = $('#discount_amt').is(':focus');

			let globalDiscountPer = parseFloat($('#discount_per').val()) || 0;
			let globalDiscountAmt = parseFloat($('#discount_amt').val()) || 0;

			if (isGlobalPerEditing) {
				globalDiscountAmt = (rowSubtotal * globalDiscountPer) / 100;
				$('#discount_amt').val(globalDiscountAmt.toFixed(2));
			} else if (isGlobalAmtEditing) {
				globalDiscountPer = (rowSubtotal === 0) ? 0 : (globalDiscountAmt / rowSubtotal) * 100;
				$('#discount_per').val(globalDiscountPer.toFixed(2));
			} else {
				// neither focused: keep consistency (compute amount from percent)
				globalDiscountAmt = (rowSubtotal * globalDiscountPer) / 100;
				$('#discount_amt').val(globalDiscountAmt.toFixed(2));
			}

			const afterDiscount = Math.max(0, rowSubtotal - (globalDiscountAmt || 0));

			// VAT
			const vatPer = parseFloat($('#vat_per').val()) || 0;
			const vatAmt = (afterDiscount * vatPer) / 100;
			$('#vat_amount').val(vatAmt.toFixed(2));

			const grandTotal = afterDiscount + vatAmt;
			$('#grand_total').val(grandTotal.toFixed(2));

			// ====================accounts entry=====================
			var po_id = document.getElementById("po_id").value;

			$.ajax({
				type: "POST",
				url: "<?php echo base_url() ?>index.php/Ajax/ajax_get_supplier_accountId_from_po",
				data: {
					po_id: po_id
				},
				success: function(accid) {

					document.getElementById('inv_creditor0').value = accid;
					var grand_total = document.getElementById("grand_total").value;
					var sub_total = document.getElementById("sub_total").value;
					var discount_amt = document.getElementById("discount_amt").value;
					var vat_amt = document.getElementById("vat_amount").value;
					// alert(grand_total);

					var x = grand_total;
					// alert(x);
					document.getElementById("inv_cr_amount0").value = x;
					document.getElementById("inv_dr_amount0").value = sub_total;
					document.getElementById("inv_dr_amount1").value = discount_amt;
					document.getElementById("inv_dr_amount2").value = vat_amt;
				}
			});


		}

		// Bind events on relevant inputs (use event delegation to support dynamic rows)
		$(document).on('input change', '#datatable-responsive tbody .rec_quantity, #datatable-responsive tbody .qty, #datatable-responsive tbody .unit_price, #datatable-responsive tbody .dis_per, #datatable-responsive tbody .dis_amt', function() {
			// calculate only that row first (for responsiveness), then totals

			const $row = $(this).closest('tr');
			calculateRow($row);
			calculateAll();
		});

		// Global discount and VAT handlers
		$(document).on('input change', '#discount_per, #discount_amt, #vat_per', function() {
			calculateAll();
		});

		// Also recalc all on page load
		// calculateAll();

	});
	$(document).ready(function() {

		document.addEventListener('DOMContentLoaded', function() {
			document.querySelectorAll('.rec_quantity').forEach(function(recInput) {
				recInput.addEventListener('keyup', function() {
					const idSuffix = this.id.replace('rec_quantity', '');
					const orderedInput = document.getElementById('item_quantity' + idSuffix);
					const errorMsg = document.getElementById('error_msg' + idSuffix);

					const orderedQty = parseFloat(orderedInput?.value) || 0;
					const receivedQty = parseFloat(this.value) || 0;

					if (receivedQty > orderedQty) {
						errorMsg.textContent = "❌ Received quantity cannot be more than ordered.";
						errorMsg.style.display = "block";
						this.classList.add('is-invalid'); // Optional Bootstrap styling
					} else {
						errorMsg.textContent = "";
						errorMsg.style.display = "none";
						this.classList.remove('is-invalid');
					}
				});
			});
		});
	});

	// function test(event) {
	// 	var input = event.target;
	// 	var qty = parseInt(input.value);
	// 	var index = input.getAttribute('data-index');
	// 	var container = document.getElementById('serial_container' + index);

	// 	console.log("Generating", qty, "serial fields for index", index);

	// 	if (!container) {
	// 		console.error('Serial container not found for index', index);
	// 		return;
	// 	}

	// 	container.innerHTML = ''; // Clear previous inputs

	// 	if (!isNaN(qty) && qty > 0) {
	// 		for (let i = 0; i < qty; i++) {
	// 			const inputEl = document.createElement('input');
	// 			inputEl.type = 'text';
	// 			inputEl.name = `serial[${i}][]`;
	// 			inputEl.className = 'form-control serial-input mt-1';
	// 			inputEl.placeholder = `Serial ${i + 1}`;
	// 			inputEl.autocomplete = 'off';
	// 			container.appendChild(inputEl);
	// 		}

	// 		// Focus on the first serial input
	// 		const firstInput = container.querySelector('.serial-input');
	// 		if (firstInput) firstInput.focus();
	// 	}
	// }

	// Handle Enter key navigation
</script>
