<?php $this->load->helper('account_helper.php'); ?>
<div class="p-4 bg-white rounded-lg shadow">
	<div class="text-center mb-5">
		<h2 class="text-2xl font-bold uppercase">Daily Income &amp; Expense</h2>
		<p class="text-sm text-gray-500 mt-1">
			For <strong><?php echo date('d M Y', strtotime($from)); ?></strong>
		</p>
	</div>

	<div class="no-print flex justify-center gap-3 mb-5">
		<form method="post" action="<?php echo base_url('index.php/Accounts/expense_income_print'); ?>" target="_blank">
			<input type="hidden" name="from" value="<?php echo htmlspecialchars($from, ENT_QUOTES, 'UTF-8'); ?>">
			<button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-md text-sm font-medium">
			<i class="fa fa-print mr-1"></i> Print
			</button>
		</form>
		<form method="post" action="<?php echo base_url('index.php/Accounts/expense_income_export'); ?>">
			<input type="hidden" name="from" value="<?php echo htmlspecialchars($from, ENT_QUOTES, 'UTF-8'); ?>">
			<button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md text-sm font-medium">
				<i class="fa fa-file-excel-o mr-1"></i> Export to Excel
			</button>
		</form>
	</div>

	<form id="main" method="post" action="<?php echo base_url() . 'index.php/Accounts/expense_income_report'; ?>" class="mb-6" autocomplete="off" enctype="multipart/form-data">
		
		<div class="flex flex-wrap items-end justify-center gap-4">
			
			<div class="w-full sm:w-auto">
				<label for="from" class="block text-sm font-semibold text-gray-700 mb-1">Date</label>
				<input type="date" class="w-full sm:w-48 border border-gray-300 rounded-md px-3 py-2 text-sm" id="from" name="from" value="<?php echo htmlspecialchars($from, ENT_QUOTES, 'UTF-8'); ?>" required>
			</div>

			<div class="w-full sm:w-auto">
				<button type="submit" id="view" name="go" class="bg-blue-600 text-white px-5 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
					<i class="fa fa-search mr-1"></i> Go
				</button>
			</div>

		</div>
	</form>

	<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
		<div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm">
			
			<h3 class="bg-green-50 text-green-800 px-4 py-3 text-lg font-bold border-b border-gray-200">Income</h3>

			<table class="w-full text-sm">
				<tr class="bg-gray-100">
					<th class="border px-3 py-2 text-left">Income</th>
					<th class="border px-3 py-2 text-right">Amount</th>
				</tr>

				<?php if (empty($income)) { ?>
					<tr><td colspan="2" class="border px-3 py-2 text-center text-gray-500">No income recorded for this date.</td></tr>
				<?php } else { foreach ($income as $i) { ?>
					<tr>
						<td class="border px-3 py-2">
							<a href="javascript:void(0);"
								class="open-drilldown text-blue-600 hover:underline"
								data-id="<?php echo (int) $i->account_id; ?>"
								data-name="<?php echo htmlspecialchars($i->account_name, ENT_QUOTES, 'UTF-8'); ?>">
								<?php echo htmlspecialchars($i->account_name, ENT_QUOTES, 'UTF-8'); ?>
							</a>
						</td>
						<td class="border px-3 py-2 text-right"><?= number_format($i->total, 2) ?></td>
					</tr>
				<?php } } ?>

				<tr class="font-semibold bg-gray-50">
					<td class="border px-3 py-2">Total Income</td>
					<td class="border px-3 py-2 text-right"><?= number_format($total_income, 2) ?></td>
				</tr>
			</table>

		</div>

		<div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm">
			<h3 class="bg-red-50 text-red-800 px-4 py-3 text-lg font-bold border-b border-gray-200">Expenses</h3>

			<table class="w-full text-sm">
				<tr class="bg-gray-100">
					<th class="border px-3 py-2 text-left">Expenses</th>
					<th class="border px-3 py-2 text-right">Amount</th>
				</tr>

				<?php if (empty($expense)) { ?>
					<tr><td colspan="2" class="border px-3 py-2 text-center text-gray-500">No expenses recorded for this date.</td></tr>
				<?php } else { foreach ($expense as $e) { ?>
					<tr>
						<td class="border px-3 py-2">
							<a href="javascript:void(0);"
								class="open-drilldown text-blue-600 hover:underline"
								data-id="<?php echo (int) $e->account_id; ?>"
								data-name="<?php echo htmlspecialchars($e->account_name, ENT_QUOTES, 'UTF-8'); ?>">
								<?php echo htmlspecialchars($e->account_name, ENT_QUOTES, 'UTF-8'); ?>
							</a>
						</td>
						<td class="border px-3 py-2 text-right"><?= number_format(abs($e->total), 2) ?></td>
					</tr>
				<?php } } ?>

				<tr class="font-semibold bg-gray-50">
					<td class="border px-3 py-2">Total Expense</td>
					<td class="border px-3 py-2 text-right"><?= number_format($total_expense, 2) ?></td>
				</tr>
			</table>

		</div>
	</div>

	<div class="mt-6 border border-gray-200 rounded-lg overflow-hidden shadow-sm">
		<h3 class="px-5 py-5 text-right text-xl font-bold <?= ($net_profit >= 0) ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700'; ?>">
				<?php if ($net_profit >= 0) { ?>
					Net Profit: <?= number_format($net_profit, 2) ?>
				<?php } else { ?>
					Net Loss: <?= number_format(abs($net_profit), 2) ?>
				<?php } ?>
		</h3>
	</div>
</div>

<div id="drilldownModal" class="fixed inset-0 z-[9999] hidden bg-gray-900/60 backdrop-blur-sm overflow-y-auto" aria-hidden="true">
	<div class="min-h-screen flex items-center justify-center p-4">
		<div class="w-full max-w-5xl bg-white rounded-xl shadow-2xl overflow-hidden">
			<div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
				<div>
					<h5 id="drilldownModalLabel" class="text-lg font-bold text-gray-800">Ledger Details</h5>
					<p class="text-xs text-gray-500 mt-1">Transaction details</p>
				</div>
				<button type="button" class="close-modal w-9 h-9 rounded-full text-gray-500 hover:bg-gray-100" aria-label="Close"><i class="fa fa-times"></i></button>
			</div>
			<div class="bg-gray-50 p-5">
				<div id="modal-loading" class="hidden text-center py-10 text-gray-500"><i class="fa fa-spinner fa-spin mr-2"></i>Loading transactions...</div>
				<div id="modal-content-area"></div>
			</div>
			<div class="px-6 py-4 border-t border-gray-200 text-right">
				<button type="button" class="close-modal bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-md text-sm">Close</button>
			</div>
		</div>
	</div>
</div>

<style>
#modal-content-area { overflow-x: auto; }
#modal-content-area table { min-width: 950px; width: 100%; background: #fff; }
#modal-content-area th, #modal-content-area td { padding: 10px 12px; white-space: nowrap; }
#modal-content-area td:nth-child(5) { white-space: normal; min-width: 200px; }
@media print { .no-print, #drilldownModal, form { display: none !important; } }
</style>

<script>
$(function () {
	$(document).on('click', '.open-drilldown', function (event) {
		event.preventDefault();
		var accountId = $(this).data('id');
		var accountName = $(this).data('name');
		$('#drilldownModalLabel').text('Ledger Details: ' + accountName);
		$('#modal-content-area').empty();
		$('#modal-loading').removeClass('hidden');
		$('#drilldownModal').removeClass('hidden').attr('aria-hidden', 'false');
		$('body').addClass('overflow-hidden');
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/Accounts/ajax_drilldown',
			type: 'POST',
			data: { account_id: accountId, from: $('#from').val(), to: $('#from').val() },
			success: function (response) {
				$('#modal-loading').addClass('hidden');
				$('#modal-content-area').html('<div class="border border-gray-200 rounded-lg overflow-hidden">' + response + '</div>');
			},
			error: function () {
				$('#modal-loading').addClass('hidden');
				$('#modal-content-area').html('<div class="bg-red-50 text-red-700 border border-red-200 rounded-lg p-4">Failed to load transaction details.</div>');
			}
		});
	});

	function closeDrilldownModal() {
		$('#drilldownModal').addClass('hidden').attr('aria-hidden', 'true');
		$('#modal-content-area').empty();
		$('#modal-loading').addClass('hidden');
		$('body').removeClass('overflow-hidden');
	}
	$(document).on('click', '.close-modal', closeDrilldownModal);
	$('#drilldownModal').on('click', function (event) { if (event.target === this) closeDrilldownModal(); });
	$(document).on('keydown', function (event) { if (event.key === 'Escape') closeDrilldownModal(); });
});
</script>
