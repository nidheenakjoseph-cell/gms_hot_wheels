<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<style>
	.select2-container {
		width: 100% !important;
	}

	.select2-container .select2-selection--single {
		height: 42px !important;
		border: 1px solid #d1d5db !important;
		border-radius: 0.5rem !important;
	}

	.select2-container .select2-selection--single .select2-selection__rendered {
		line-height: 40px !important;
		padding-left: 12px !important;
		font-size: 14px;
	}

	.select2-container .select2-selection--single .select2-selection__arrow {
		height: 40px !important;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
	<div class="text-center mb-5">
		<!-- <h2 class="text-2xl font-bold uppercase">
        <?php echo $company_records[0]->company_name; ?>
    </h2> -->

		<h2 class="text-2xl font-bold uppercase">
			Report-Individual Ledger Details
		</h2>

	</div>
	<!-- FILTER SECTION -->
	<form action="<?php echo base_url() . 'index.php/Accounts/search_individual_ledger_details/' . $account_id; ?>"
		method="post"
		class="space-y-6">

		<div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

			<!-- From Date -->
			<div>
				<label class="block text-sm font-semibold text-gray-700 mb-1">From Date</label>
				<input type="text"
					id="from_date"
					name="from_date"
					value="<?= !empty($from_date) ? date('d-m-Y', strtotime($from_date)) : date('d-m-Y'); ?>"
					required
					autocomplete="off"
					class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm 
    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
			</div>

			<!-- To Date -->
			<div>
				<label class="block text-sm font-semibold text-gray-700 mb-1">To Date</label>
				<input type="text"
					id="to_date"
					name="to_date"
					value="<?= !empty($to_date) ? date('d-m-Y', strtotime($to_date)) : date('d-m-Y'); ?>"
					required
					autocomplete="off"
					class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm 
    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
			</div>

			<!-- Ledger -->
			<div>
				<label class="block text-sm font-semibold text-gray-700 mb-1">Ledger Account</label>
				<select id="account_id"
					name="account_id"
					required
					class="ledger-select w-full">

					<option value="">Select Code</option>

					<?php foreach ($account_ledgers as $s) { ?>
						<option value="<?php echo $s->account_id; ?>"
							<?php echo ($s->account_id == $account_id) ? 'selected' : ''; ?>>
							<?php echo html_escape($s->account_name); ?>
						</option>
					<?php } ?>

				</select>
			</div>

			<!-- Go Button -->
			<div>
				<button type="submit"
					class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white 
                               px-5 py-2 rounded-lg shadow transition">
					Go
				</button>
			</div>
		</div>
	</form>


	<!-- ACTION BUTTONS -->
	<div class="flex flex-wrap gap-3 mt-6">


		<form target="_blank"
			action="<?php echo base_url() . 'index.php/Accounts/print_individual_ledger_account_details'; ?>"
			method="post">
			<input type="hidden" name="from_date" value="<?php echo $from_date; ?>" />
			<input type="hidden" name="to_date" value="<?php echo $to_date; ?>" />
			<input type="hidden" name="account_id" value="<?php echo $account_id; ?>" />
			<?php $is_disabled = empty($account_id) ? 'disabled opacity-50 cursor-not-allowed' : ''; ?>


			<button type="submit"
				class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded-lg shadow <?= $is_disabled; ?>"
				<?= empty($account_id) ? 'disabled' : ''; ?>>
				Print Ledger
			</button>

		</form>

		<form action="<?php echo base_url() . 'index.php/Accounts/export_individual_ledger_account_details'; ?>"
			method="post">
			<input type="hidden" name="from_date" value="<?php echo $from_date; ?>" />
			<input type="hidden" name="to_date" value="<?php echo $to_date; ?>" />
			<input type="hidden" name="account_id" value="<?php echo $account_id; ?>" />
			<?php $is_disabled = empty($account_id) ? 'disabled opacity-50 cursor-not-allowed' : ''; ?>

			<button type="submit"
				class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg shadow <?= $is_disabled; ?>"
				<?= empty($account_id) ? 'disabled' : ''; ?>>
				Export Excel
			</button>
		</form>

		<h1 style="font-size:24px;"><b>Ledger Name: <?php echo $lname; ?></b></h1>
	</div>


	<!-- TABLE SECTION -->
	<div class="mt-6 overflow-x-auto">

		<table class="min-w-full text-sm border border-gray-200 rounded-xl overflow-hidden">

			<!-- HEADER -->
			<thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
				<tr>
					<th class="px-4 py-3 border text-left">Sr.No</th>
					<th class="px-4 py-3 border text-left">Txn Date</th>
					<th class="px-4 py-3 border text-left">Particulars</th>
					<th class="px-4 py-3 border text-left">Voucher Code</th>
					<th class="px-4 py-3 border text-left">Txn Type</th>
					<th class="px-4 py-3 border text-right">Debit</th>
					<th class="px-4 py-3 border text-right">Credit</th>
				</tr>
			</thead>

			<tbody class="divide-y divide-gray-200 bg-white">

				<!-- Opening Balance -->
				<?php
				$this->load->helper('myopeningbalance');
				$opening_bal = calculate_opening_bal($from_date, $account_id);

				if ($opening_bal > 0): ?>
					<tr class="bg-blue-50 font-semibold">
						<td colspan="5" class="px-4 py-2">Dr. Opening Balance</td>
						<td class="px-4 py-2 text-right">
							<?php echo sprintf("%0.2f", $opening_bal) . " Dr"; ?>
						</td>
						<td></td>
					</tr>
				<?php else: ?>
					<tr class="bg-blue-50 font-semibold">
						<td colspan="5" class="px-4 py-2">Cr. Opening Balance</td>
						<td></td>
						<td class="px-4 py-2 text-right">
							<?php echo sprintf("%0.2f", abs($opening_bal ?? 0)) . " Cr"; ?>
						</td>
					</tr>
				<?php endif; ?>

				<!-- Transactions -->
				<?php
				$j = 1;
				$debit_amount = 0;
				$credit_amount = 0;

				if (!empty($ledger_transaction_records)):
					foreach ($ledger_transaction_records as $row):
						$tamount = $row->amount;
				?>

						<tr class="hover:bg-gray-50">
							<td class="px-4 py-2"><?php echo $j++; ?></td>
							<td class="px-4 py-2"><?php echo date('d-M-Y', strtotime($row->voucher_date)); ?></td>
							<td class="px-4 py-2">
								<?php
								$invoice_date = (!empty($row->invoice_date) && $row->invoice_date != '0000-00-00')
									? date('d-M-Y', strtotime($row->invoice_date))
									: '';

								if ($row->voucher_type == 'S') {
									echo 'Ref No: ' . $row->ref_no . '<br>';
									echo 'Invoice Date: ' . $invoice_date . '<br>';
									echo 'Client PO: ' . $row->po_code;
								} elseif ($row->voucher_type == 'G') {
									echo 'Invoice No: ' . $row->ref_no . '<br>';
									echo 'Invoice Date: ' . $invoice_date . '<br>';
									echo 'Ref No: ' . $row->po_code;
								} elseif ($row->voucher_type == 'P') {
									echo 'Invoice No: ' . $row->ref_no . '<br>';
									echo 'Invoice Date: ' . $invoice_date . '<br>';
									echo 'Ref No: ' . $row->po_code . '<br>' . $row->narration;
								} else {
									echo $row->narration;
								}
								?>
							</td>
							<td class="px-4 py-2"><?php echo $row->voucher_code; ?></td>
							<td class="px-4 py-2"><?php

													if ($row->voucher_type == 'S')
														echo 'Sales Invoice';
													if ($row->voucher_type == 'G' && $row->trans_type === 'SRN')
														echo 'SRN';
													if ($row->voucher_type == 'G' && $row->trans_type != 'SRN')
														echo 'PO GRN Invoice';
													if ($row->voucher_type == 'R')
														echo 'Receipt';
													if ($row->voucher_type == 'P')
														echo 'Payment';
													if ($row->voucher_type == 'C')
														echo 'Credit Note';
													if ($row->voucher_type == 'D')
														echo 'Debit Note';
													if ($row->voucher_type == 'J')
														echo 'Journal';
													if ($row->voucher_type == 'N')
														echo 'Contra Entry';
													if ($row->voucher_type == 'PR')
														echo 'Purchase Return';
													if ($row->voucher_type == 'AD')
														echo 'Supplier Advance';
													if ($row->voucher_type == 'PURCHASE_RETURN')
														echo 'Purchase Return';

													// echo $row->voucher_type; 





													?></td>

							<td class="px-4 py-2 text-right text-red-600 font-medium">
								<?php if (strtoupper($row->drcr_type) == "DR") {
									echo sprintf("%0.2f", $tamount);
									$debit_amount += $tamount;
								} ?>
							</td>

							<td class="px-4 py-2 text-right text-green-600 font-medium">
								<?php if (strtoupper($row->drcr_type) == "CR") {
									echo sprintf("%0.2f", $tamount);
									$credit_amount += $tamount;
								} ?>
							</td>
						</tr>

				<?php endforeach;
				endif; ?>
			</tbody>

			<!-- FOOTER -->
			<!--<tfoot class="bg-gray-100 font-semibold">

				<tr>
					<td colspan="5" class="px-4 py-3 text-right">Trans Total</td>
					<td class="px-4 py-3 text-right text-red-600">
						<?php echo sprintf("%0.2f", $debit_amount); ?>
					</td>
					<td class="px-4 py-3 text-right text-green-600">
						<?php echo sprintf("%0.2f", $credit_amount); ?>
					</td>
				</tr>

			</tfoot>-->
			<tfoot>
				<tr bgcolor="#dddddd">
					<td colspan="5" class="px-4 py-3 text-right">Trans Total:</td>
					<?php $display_total_cr = 0;
					if ($opening_bal > 0) {
						$display_total_db = $debit_amount + $opening_bal;
						$display_total_cr = $credit_amount;
					} else {
						$opening_bal = $opening_bal * -1;
						$display_total_cr = $credit_amount + $opening_bal;
						$display_total_db = $debit_amount;
					} ?>

					<?php $display_total = number_format((float)($display_total_db), 2, '.', ''); ?>
					<td class="px-4 py-3 text-right text-red-600"><?php echo sprintf("%0.2f", $debit_amount); ?></td>
					<?php
					if ($display_total_cr < 0)
						$display_total = $display_total_cr * -1;
					else
						$display_total = $display_total_cr;
					?>
					<td class="px-4 py-3 text-right text-green-600"><?php echo sprintf("%0.2f", $credit_amount); ?></td>
				</tr>
				<?php

				if ($display_total_cr < 0)
					$bal = $display_total_db - ($display_total_cr * -1);
				else {
					$bal = $display_total_db - ($display_total_cr);
				}
				?>
				<?php
				if ($bal > 0): ?>
					<tr class="bg-blue-50 font-semibold">
						<td colspan="5" class="px-4 py-2">Dr. Closing Balance</td>
						<?php $display_total = $bal; ?>
						<td align="right" style="font-weight: bold"><?php echo sprintf("%0.2f", ($display_total)) . " Dr"; ?></td>
						<td></td>
					</tr>
				<?php
				else :
				?>
					<tr class="bg-blue-50 font-semibold">
						<td colspan="5" class="px-4 py-2">Cr. Closing Balance</td>
						<?php $display_total = $bal * -1; ?>
						<td></td>
						<td align="right" style="font-weight: bold"><?php echo sprintf("%0.2f", ($display_total)) . " Cr"; ?></td>
					</tr>
				<?php
				endif;

				?>
			</tfoot>
		</table>
	</div>

</div>

<link rel="stylesheet"
	href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
	$(document).ready(function() {

		var i = 1;

		$("#dr_add_row").click(function() {
			$('#dr_addr' + i).html(
				`<td>
                    <select class="form-select form-control-sm select2 select2Width"
                            id="debtor${i}"
                            name="debtor[]"
                            onchange="get_account_balance(${i}, 'dr')"
                            required>
                        <option value="">Select Code</option>

                        <?php if (!empty($sundry_detors_records)) { ?>
                            <?php foreach ($sundry_detors_records as $s) { ?>
                                <option value="<?= $s->account_id; ?>">
                                    <?= $s->account_name; ?>
                                </option>
                            <?php } ?>
                        <?php } else { ?>
                            <option value="">No Records Found</option>
                        <?php } ?>
                    </select>

                    <br>

                    <label id="set_balancedr${i}">Balance</label>
                </td>

                <td>
                    <input type="number"
                           step="0.01"
                           name="dr_amount[]"
                           id="dr_amount${i}"
                           class="form-control form-control-sm debit_sum"
                           min="0"
                           required
                           onkeyup="calculate_grand_total()">
                </td>

                <td>
                    <a onclick="remove_row_dr(${i});"
                       title="Delete"
                       class="btn btn-xs bg-orange remove1">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>`
			);

			$('#dr_body tr:last').after(
				`<tr id="dr_addr${i + 1}"></tr>`
			);

			i++;

			$('.select2').select2({
				width: "220px"
			});
		});


		$("#delete_row1").click(function() {
			if (i > 1) {
				$("#dr_addr" + (i - 1)).html('');
				i--;
			}
		});


		var k = 1;

		$("#cr_add_row").click(function() {

			$('#cr_addr' + k).html(
				`<td>
                    <select class="form-select form-control-sm select2 select2Width"
                            id="debtor${k}"
                            name="debtor[]"
                            onchange="get_account_balance(${k}, 'cr')"
                            required>

                        <option value="">Select Code</option>

                        <?php if (!empty($sundry_detors_records)) { ?>
                            <?php foreach ($sundry_detors_records as $s) { ?>
                                <option value="<?= $s->account_id; ?>">
                                    <?= $s->account_name; ?>
                                </option>
                            <?php } ?>
                        <?php } else { ?>
                            <option value="">No Records Found</option>
                        <?php } ?>

                    </select>

                    <br>

                    <label id="set_balancecr${k}">Balance</label>
                </td>

                <td>
                    <input type="number"
                           step="0.01"
                           name="dr_amount[]"
                           id="dr_amount${k}"
                           class="form-control form-control-sm credit_sum"
                           min="0"
                           required
                           onkeyup="calculate_grand_total()">
                </td>

                <td>
                    <a onclick="remove_row_cr(${k});"
                       title="Delete"
                       class="btn btn-xs bg-orange remove1">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>`
			);

			$('#cr_body tr:last').after(
				`<tr id="cr_addr${k + 1}"></tr>`
			);

			k++;

			$('.select2').select2({
				width: "220px"
			});
		});


		$("#delete_row2").click(function() {
			if (k > 1) {
				$("#cr_addr" + (k - 1)).html('');
				k--;
			}
		});

	});


	/* =========================
	   DATEPICKER
	   ========================= */

	var jq = jQuery.noConflict();

	jq(document).ready(function() {

		jq("#from_date").datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true
		});

		jq("#to_date").datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true
		});

	});


	/* =========================
	   REMOVE DEBIT ROW
	   ========================= */

	function remove_row_dr(id) {
		$('#dr_addr' + id).remove();
	}


	/* =========================
	   REMOVE CREDIT ROW
	   ========================= */

	function remove_row_cr(append_id) {
		$('#cr_addr' + append_id).remove();
	}


	/* =========================
	   ACCOUNT BALANCE
	   ========================= */

	function get_account_balance(append_id, type) {

		var account_id =
			document.getElementById("debtor" + append_id).value;

		var today = "<?php echo date('Y-m-d') ?>";

		$.ajax({
			url: "<?php echo site_url('Accounts/get_account_balance'); ?>",
			type: 'POST',
			data: {
				account_id: account_id,
				today: today
			},
			success: function(msg) {

				if (msg) {

					document.getElementById(
						'set_balance' + type + append_id
					).innerHTML = 'Balance: ' + msg;

				}
			}
		});
	}


	/* =========================
	   CALCULATE TOTAL
	   ========================= */

	function calculate_grand_total() {

		var i_total = 0;

		$('.debit_sum').each(function() {

			var value = $(this).val();

			if (value != '') {
				i_total += parseFloat(value);
			}

		});


		var k_total = 0;

		$('.credit_sum').each(function() {

			var value = $(this).val();

			if (value != '') {
				k_total += parseFloat(value);
			}

		});


		document.getElementById("debit_total").value =
			parseFloat(i_total).toFixed(2);

		document.getElementById("credit_total").value =
			parseFloat(k_total).toFixed(2);
	}


	/* =========================
	   SELECT2
	   ========================= */

	$(document).ready(function() {

		$('.debtor-select').select2({
			width: '100%'
		});

	});
</script>
<script>
	$(document).ready(function() {

		$('#account_id').select2({
			width: '100%',
			placeholder: 'Select Code',
			allowClear: true
		});

	});
</script>