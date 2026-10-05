<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<div class="p-6 w-full">
	<!-- Header -->
	<div class="flex flex-wrap justify-between items-center mb-6 gap-4">
		<div>
			<h2 class="text-2xl font-bold text-gray-800 tracking-tight flex items-center gap-2">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
				</svg>
				Bank Reconciliation Records
			</h2>
			<p class="text-xs text-gray-500 mt-1">List of all reconciled bank transactions and statement entries.</p>
		</div>

		<a href="<?= base_url('index.php/Accounts/add_bank_reconciliation') ?>"
			class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-md hover:shadow-lg transition">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
			</svg>
			Perform Reconciliation
		</a>
	</div>

	<?php
	$total_count = count($records);
	$total_amount = 0;
	$bank_accounts = [];

	foreach ($records as $r) {
		$total_amount += floatval($r->amount_no);
		if (!empty($r->bank_name)) {
			$bank_accounts[$r->bank_name] = true;
		}
	}
	?>

	<!-- Summary Stat Cards -->
	<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
		<div class="bg-white rounded-2xl border border-gray-200 p-5 flex items-center gap-4 shadow-sm">
			<div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center font-bold text-xl">
				#
			</div>
			<div>
				<p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Reconciled Records</p>
				<h3 class="text-2xl font-bold text-gray-800 mt-0.5"><?= number_format($total_count) ?></h3>
			</div>
		</div>

		<div class="bg-white rounded-2xl border border-gray-200 p-5 flex items-center gap-4 shadow-sm">
			<div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold text-xl">
				₹
			</div>
			<div>
				<p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Reconciled Value</p>
				<h3 class="text-2xl font-bold text-emerald-700 mt-0.5">₹ <?= number_format($total_amount, 2) ?></h3>
			</div>
		</div>

		<div class="bg-white rounded-2xl border border-gray-200 p-5 flex items-center gap-4 shadow-sm">
			<div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center font-bold text-xl">
				🏦
			</div>
			<div>
				<p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Bank Accounts Covered</p>
				<h3 class="text-2xl font-bold text-purple-900 mt-0.5"><?= count($bank_accounts) > 0 ? count($bank_accounts) : 'All Accounts' ?></h3>
			</div>
		</div>
	</div>

	<!-- Main Records Table Card -->
	<div class="bg-white shadow-sm border border-gray-200 rounded-2xl p-6">
		<div class="overflow-x-auto">
			<table id="datatable" class="min-w-full divide-y divide-gray-200 text-sm">
				<thead class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wider">
					<tr>
						<th class="px-4 py-3 text-left w-12">#</th>
						<th class="px-4 py-3 text-left">Bank Account</th>
						<th class="px-4 py-3 text-left">Instrument No</th>
						<th class="px-4 py-3 text-left">Instrument Date</th>
						<th class="px-4 py-3 text-right">Amount (₹)</th>
						<th class="px-4 py-3 text-left">Type</th>
						<th class="px-4 py-3 text-left">Remarks</th>
						<th class="px-4 py-3 text-left">Reconciled On</th>
						<th class="px-4 py-3 text-center w-24">Action</th>
					</tr>
				</thead>

				<tbody class="divide-y divide-gray-100 bg-white">
					<?php $i = 1; foreach ($records as $row) : ?>
						<tr id="reco_row_<?php echo $row->reconciliation_id; ?>" class="hover:bg-gray-50 transition">
							<!-- # -->
							<td class="px-4 py-3 text-gray-500 font-medium"><?php echo $i++; ?></td>

							<!-- Bank Account -->
							<td class="px-4 py-3 font-semibold text-gray-800">
								<?php echo !empty($row->bank_name) ? $row->bank_name : (!empty($row->bank_account_id) ? ('Account #' . $row->bank_account_id) : 'General Bank'); ?>
							</td>

							<!-- Instrument No -->
							<td class="px-4 py-3 font-medium text-blue-700">
								<?php echo !empty($row->instrument_no) ? $row->instrument_no : '-'; ?>
							</td>

							<!-- Instrument Date -->
							<td class="px-4 py-3 text-gray-600 whitespace-nowrap">
								<?php echo !empty($row->instrument_date) ? date('d-M-Y', strtotime($row->instrument_date)) : '-'; ?>
							</td>

							<!-- Amount -->
							<td class="px-4 py-3 text-right font-bold text-gray-900">
								₹ <?php echo number_format(floatval($row->amount_no), 2); ?>
							</td>

							<!-- Type -->
							<td class="px-4 py-3">
								<span class="px-2.5 py-0.5 text-xs font-bold rounded-full bg-slate-100 text-slate-700 border border-slate-200">
									<?php echo !empty($row->instrument_type) ? $row->instrument_type : 'Dr/Cr'; ?>
								</span>
							</td>

							<!-- Remarks -->
							<td class="px-4 py-3 text-xs text-gray-500 max-w-xs truncate" title="<?php echo htmlspecialchars($row->remark ?? ''); ?>">
								<?php echo !empty($row->remark) ? $row->remark : '-'; ?>
							</td>

							<!-- Reconciled On -->
							<td class="px-4 py-3 text-xs text-gray-500 whitespace-nowrap">
								<?php echo !empty($row->created_date) ? date('d-M-Y H:i', strtotime($row->created_date)) : '-'; ?>
							</td>

							<!-- Action -->
							<td class="px-4 py-3 text-center">
								<button type="button"
									onclick="confirmDeleteReco(<?php echo $row->reconciliation_id; ?>)"
									title="Unreconcile / Delete Record"
									class="inline-flex items-center gap-1 text-xs font-medium text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg border border-rose-200 transition">
									<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
									</svg>
									Unreconcile
								</button>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		if (!$.fn.DataTable.isDataTable('#datatable')) {
			$('#datatable').DataTable({
				pageLength: 25,
				order: [[0, 'asc']]
			});
		}
	});

	function confirmDeleteReco(tid) {
		if (confirm("Are you sure you want to unreconcile this record? This will revert the voucher's reconciliation status.")) {
			$.ajax({
				url: "<?php echo base_url('index.php/Ajax/delete_bank_reconciliation'); ?>",
				type: "POST",
				data: {
					reconciliation_id: tid
				},
				success: function(res) {
					if (res == 1 || res.status === 'success') {
						$('#reco_row_' + tid).addClass('bg-red-50 transition').fadeOut(500, function() {
							$(this).remove();
						});
					} else {
						alert("Failed to unreconcile record. Please try again.");
					}
				},
				error: function() {
					alert("Server error occurred while attempting to unreconcile record.");
				}
			});
		}
	}
</script>
