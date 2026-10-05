<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>

<div class="w-full bg-white rounded-2xl shadow-md p-6">

	<div class="absolute inset-0 bg-[url('<?= base_url("public/images/car3.png") ?>')]
                bg-center bg-no-repeat bg-contain opacity-5 pointer-events-none"></div>

	<div class="flex justify-between items-center mb-4">
		<h2 class="text-2xl font-bold">Fleet Customer List</h2>

		<a href="<?= base_url('index.php/customer/add_fleet_customer'); ?>"
			class="px-4 py-2 bg-green-600 text-white rounded">
			+ Add Fleet Customer
		</a>
	</div>

	<hr><br>

	<!-- Flash Messages -->
	<?php if ($this->session->flashdata('success')) : ?>
		<div class="p-3 mb-4 bg-green-100 text-green-700 border border-green-300 rounded">
			<?= $this->session->flashdata('success'); ?>
		</div>
	<?php endif; ?>

	<?php if ($this->session->flashdata('error')) : ?>
		<div class="p-3 mb-4 bg-red-100 text-red-700 border border-red-300 rounded">
			<?= $this->session->flashdata('error'); ?>
		</div>
	<?php endif; ?>
 
	<!-- Filters -->
	<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
		<input id="f_phone" name="f_phone" class="border px-3 py-2 rounded text-sm" placeholder="Contact No">
		<input id="f_name"  name="f_name"  class="border px-3 py-2 rounded text-sm" placeholder="Company Name">
		<input id="f_plate" name="f_plate" class="border px-3 py-2 rounded text-sm" placeholder="Plate No">
		<input id="f_vin"   name="f_vin"   class="border px-3 py-2 rounded text-sm" placeholder="VIN No">
	</div>

	<!-- Table -->
	<div class="overflow-x-auto">
		<table class="w-full text-sm border" id="fleetCustomerTable">
			<thead class="bg-gray-100">
				<tr>
					<th class="p-3">SL</th>
					<th class="p-3">Company Name</th>
					<th class="p-3">Contact Person</th>
					<th class="p-3">Phone</th>
					<th class="p-3">Email</th>
					<th class="p-3">Credit Limit</th>
					<th class="p-3">Payment Terms</th>
					<th class="p-3 text-center">Actions</th>
				</tr>
			</thead>

			<tbody id="fleetCustomerBody">
				<?php $this->load->view('customer/fleet_customer/fleet_customer_rows', ['customers' => $customers]); ?>
			</tbody>
		</table>
	</div>

</div>

<script>
	$(document).ready(function() {

		$('#fleetCustomerTable').DataTable({
			pageLength: 10,
			lengthMenu: [
				[5, 10, 25, -1],
				[5, 10, 25, "All"]
			],
			responsive: true,

			dom: "<'flex justify-between items-center mb-3'l<f>>" +
				"t" +
				"<'flex justify-between items-center mt-3'p>",

			language: {
				search: "",
				searchPlaceholder: "Search fleet customers..."
			}
		});

	});
</script>

<script>
	let timer = null;

	function loadFleetCustomers() {
		$.ajax({
			url: "<?= base_url('index.php/Customer/filter_fleet_ajax') ?>",
			type: "POST",
			data: {
				phone: $('#f_phone').val(),
				name:  $('#f_name').val(),
				plate: $('#f_plate').val(),
				vin:   $('#f_vin').val()
			},
			success: function(html) {
				$('#fleetCustomerBody').html(html);
			}
		});
	}

	// Live typing filter
	$('.grid input').on('keyup', function() {
		clearTimeout(timer);
		timer = setTimeout(loadFleetCustomers, 300);
	});
</script>

<style>
	#fleetCustomerTable_wrapper .dataTables_filter {
		text-align: right !important;
	}

	#fleetCustomerTable_wrapper .dataTables_length label {
		font-size: 0.875rem;
	}

	#fleetCustomerTable_wrapper .dataTables_paginate {
		margin-top: 10px;
	}

	#fleetCustomerTable tbody td {
		font-size: 0.875rem !important;
	}
</style>