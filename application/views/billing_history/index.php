	<!-- DataTables -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

	<div class="w-full bg-white rounded-2xl shadow-md p-6">

		<div class="bg-white rounded-xl shadow-sm p-4 mb-4">



			<!-- Title -->
			<div class="flex items-center gap-2 mb-4">
				<span class="text-xl">📜</span>
				<h2 class="text-xl font-semibold">
					Billing History & System Invoices
				</h2>
			</div>
			<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
				<!-- Filters -->
				<form method="get" action="<?= base_url('index.php/billing_history') ?>"
					class="flex flex-wrap items-end gap-3">

					<input type="text" name="customer_name"
						value="<?= $_GET['customer_name'] ?? '' ?>"
						placeholder="Customer Name"
						class="border rounded-lg h-[43px] px-3 w-48">

					<input type="text" name="customer_phone"
						value="<?= $_GET['customer_phone'] ?? '' ?>"
						placeholder="Mobile No"
						class="border rounded-lg h-[43px] px-3 w-40">

					<input type="text" name="vin_no"
						value="<?= $_GET['vin_no'] ?? '' ?>"
						placeholder="Chassis / VIN No"
						class="border rounded-lg h-[43px] px-3 w-56">

					<input type="text" name="plate_no"
						value="<?= $_GET['plate_no'] ?? '' ?>"
						placeholder="Plate No"
						class="border rounded-lg h-[43px] px-3 w-40">

					<button type="submit"
						class="bg-blue-600 text-white px-5 h-[38px] rounded-lg">
						Filter
					</button>

					<button class="bg-green-600 text-white px-5 h-[38px] rounded-lg"><a href="<?= base_url('index.php/billing_history/export_excel?' . http_build_query($_GET)) ?>">
						⬇ Excel
					</a></button>

					<button class="bg-gray-500 text-white px-5 h-[38px] rounded-lg"><a href="<?= base_url('index.php/billing_history') ?>">
						Reset
					</a></button>
				</form>

			</div>
		</div>



		<table id="allInvoicesTable" class="w-full text-sm">
			<thead>
				<tr class="bg-gray-100 text-gray-700">
    				<th class="p-3">S.No</th>
    				<th class="p-3">Type</th>
					<th class="p-3">Invoice No</th>
					<th class="p-3">Date</th>
					<th class="p-3">Customer</th>
					<th class="p-3">Mobile</th>
					<th class="p-3">Vehicle</th>
					<th class="p-3 text-right">Total</th>
					<th class="p-3 text-right">Paid</th>
					<th class="p-3 text-right">Balance</th>
					<th class="p-3">Status</th>
					<th class="p-3">Action</th>
				</tr>
			</thead>
			<tbody>
    			<!-- Billing History Invoices -->
   				 <?php foreach ($invoices as $inv): ?>
					<tr class="border-b hover:bg-blue-50">
    						<td class="p-3"></td>
    					<td class="p-3">
       						 <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs font-semibold">Billing</span>
   						 </td>
						<td class="p-3 font-medium text-blue-600">
							<a href="<?= base_url('index.php/billing_history/view/' . $inv->invoice_id) ?>"
								class="hover:underline">
								<?= $inv->billing_no ?>
							</a>
						</td>
						<td class="p-3">
							<?= date('d-m-Y', strtotime($inv->billing_date)) ?>
						</td>
						<td class="p-3"><?= $inv->customer_name ?></td>
						<td class="p-3"><?= $inv->customer_phone ?></td>
						<td class="p-3"><?= $inv->plate_no ?></td>
						<td class="p-3 text-right font-semibold">
							<?= number_format($inv->total_amount, 2) ?>
						</td>
						<td class="p-3 text-right">-</td>
						<td class="p-3 text-right">-</td>
						<td class="p-3">-</td>
						<td class="p-3">
							<a href="<?= base_url('index.php/billing_history/view/' . $inv->invoice_id) ?>"
								class="text-blue-600 hover:underline">View</a>
						</td>
					</tr>
				<?php endforeach; ?>

				<!-- System Invoices -->
				<?php foreach ($system_invoices as $inv):
					$balance = max(0, $inv->grand_total - $inv->paid_amount);
				?>
					<tr class="border-b hover:bg-green-50">
    						<td class="p-3"></td>
    					<td class="p-3">
       						 <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-semibold">System</span>
   						 </td>
						<td class="p-3 font-medium text-blue-600">
							<a href="<?= base_url('index.php/invoice/view/' . $inv->invoice_id) ?>"
								class="hover:underline">
								<?= $inv->invoice_no ?>
							</a>
						</td>
						<td class="p-3"><?= date('d-m-Y', strtotime($inv->invoice_date)) ?></td>
						<td class="p-3"><?= $inv->customer_name ?></td>
						<td class="p-3"><?= $inv->customer_phone ?? '-' ?></td>
						<td class="p-3"><?= $inv->registration_no ?></td>
						<td class="p-3 text-right font-semibold"><?= number_format($inv->grand_total, 2) ?></td>
						<td class="p-3 text-right"><?= number_format($inv->paid_amount, 2) ?></td>
						<td class="p-3 text-right"><?= number_format($balance, 2) ?></td>
						<td class="p-3"><?= $inv->status ?></td>
						<td class="p-3">
							<a href="<?= base_url('index.php/invoice/view/' . $inv->invoice_id) ?>"
								class="text-blue-600 hover:underline">View</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	</div>

	<script>
		$(document).ready(function() {
			$('#allInvoicesTable').DataTable({
				pageLength: 15,
				order: [
					[2, 'desc']
				],
				drawCallback: function() {
					var api = this.api();
					var pageInfo = api.page.info();

					api.rows({ page: 'current' }).nodes().each(function(row, index) {
						$('td:first', row).text(pageInfo.start + index + 1);
					});
				},
				language: {
					search: "Search:",
					lengthMenu: "Show _MENU_ entries"
				}
			});

			// ✅ Select2 init
			$('#customer_id').select2({
				width: '100%',
				placeholder: 'Select Customer',
				allowClear: true
			});
		});
	</script>
	<style>
		.select2-container .select2-selection--single {
			height: 38px;
		}

		.select2-selection__rendered {
			line-height: 38px !important;
		}

		.select2-selection__arrow {
			height: 38px;
		}
	</style>
