<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">

<div class="p-6">
	<div class="bg-white rounded-xl shadow-sm border border-gray-200">

		<!-- Header -->
		<div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
			<h2 class="text-lg font-semibold text-gray-800">Scrap Receipt Voucher List</h2>

			<a href="<?php echo base_url('index.php/scrap/add_receipt'); ?>"
				class="inline-flex items-center rounded-full bg-green-100 text-green-700 text-xs font-medium px-3 py-1 hover:bg-green-200 transition"
				title="Add New Receipt">
				+ Add New Receipt
			</a>
		</div>

		<!-- Flash Messages -->
		<?php if ($this->session->flashdata('success')): ?>
			<div class="mx-6 mt-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded">
				<?= $this->session->flashdata('success') ?>
			</div>
		<?php endif; ?>

		<?php if ($this->session->flashdata('error')): ?>
			<div class="mx-6 mt-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded">
				<?= $this->session->flashdata('error') ?>
			</div>
		<?php endif; ?>

		<!-- Search/Filter Section -->
		<form method="post" class="p-6 border-b border-gray-200 flex gap-4 items-end">
			<div>
				<label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
				<input type="date" name="from" value="<?= $from ?>" class="h-[38px] border rounded px-3 text-sm">
			</div>
			<div>
				<label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
				<input type="date" name="to" value="<?= $to ?>" class="h-[38px] border rounded px-3 text-sm">
			</div>
			<button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
				Search
			</button>
		</form>

		<!-- Table -->
		<div class="overflow-x-auto">
			<table class="min-w-full border-collapse">
				<thead>
					<tr class="bg-gray-50 border-b border-gray-200">
						<th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Voucher Code</th>
						<th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Date</th>
						<th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Invoice No</th>
						<th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Customer</th>
						<th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">Amount</th>
						<th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($receipt_records)): ?>
						<?php foreach ($receipt_records as $record): ?>
							<tr class="border-b border-gray-200 hover:bg-gray-50">
								<td class="px-6 py-3 text-sm text-gray-800">
									<!-- <a href="<?= base_url('index.php/scrap/view_receipt/' . urlencode($record->voucher_code)) ?>" -->
										<!-- class="text-blue-600 hover:underline font-medium"> -->
										<?= htmlspecialchars($record->voucher_code) ?>
									<!-- </a> -->
								</td>
								<td class="px-6 py-3 text-sm text-gray-600">
									<?= date('d-m-Y', strtotime($record->voucher_date)) ?>
								</td>
								<td class="px-6 py-3 text-sm text-gray-600">
									<?= htmlspecialchars($record->invoice_no ?? 'N/A') ?>
								</td>
								<td class="px-6 py-3 text-sm text-gray-600">
									<?= htmlspecialchars($record->customer_name ?? 'N/A') ?>
								</td>
								<td class="px-6 py-3 text-sm text-gray-800 text-right font-medium">
									<?= number_format($record->amount, 2) ?>
								</td>
								<td class="px-6 py-3 text-center">
									<div class="flex justify-center gap-2 flex-wrap">
										
										<?php if ($record->cancel == 1): ?>
											<span class="px-3 py-1 bg-gray-100 text-gray-600 rounded text-xs">
												Cancelled
											</span>
										<?php else: ?>
											<a href="<?= base_url('index.php/scrap/edit_receipt') . '?code=' . urlencode($record->voucher_code) ?>"
											class="px-3 py-1 bg-blue-100 text-blue-600 rounded text-xs hover:bg-blue-200"
											title="Edit Receipt">
											Edit
										</a>
										<a target="_blank" href="<?= base_url('index.php/scrap/print_receipt') . '?code=' . urlencode($record->voucher_code) ?>"
											class="px-3 py-1 bg-purple-100 text-purple-600 rounded text-xs hover:bg-purple-200"
											title="Print">
											Print
										</a>
										<a href="<?= base_url('index.php/scrap/cancel_receipt') . '?code=' . urlencode($record->voucher_code) ?>"
											onclick="return confirm('Are you sure you want to cancel this receipt voucher?');"
											class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded text-xs hover:bg-yellow-200"
											title="Cancel Receipt">
											Cancel
										</a>
										<?php endif; ?>
										<!-- <a href="<?= base_url('index.php/scrap/delete_receipt') . '?code=' . urlencode($record->voucher_code) ?>"
											onclick="return confirm('Are you sure you want to permanently delete this receipt voucher? This action cannot be undone.');"
											class="px-3 py-1 bg-red-100 text-red-600 rounded text-xs hover:bg-red-200"
											title="Delete Receipt">
											Delete
										</a> -->
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="6" class="px-6 py-8 text-center text-gray-500">
								No scrap receipt vouchers found for the selected period
							</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>

	</div>
</div>