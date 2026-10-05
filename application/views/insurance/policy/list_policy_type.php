<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>

<div class="w-full bg-white rounded-2xl shadow-md p-6">

	<div class="flex justify-between items-center mb-4">
		<h2 class="text-2xl font-bold"><?= htmlspecialchars($title) ?></h2>

		<a href="<?= base_url('index.php/insurancepolicy/add_policy_type'); ?>"
			class="px-4 py-2 bg-green-600 text-white rounded">
			+ Add Policy Type
		</a>
	</div>

	<hr><br>

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

	<table id="policyTable" class="w-full border rounded">
		<thead class="bg-gray-100">
			<tr>
				<th class="p-3 text-left">SL No</th>
				<th class="p-3 text-left">Policy Type</th>
				<th class="p-3 text-left description-column">Description </th>
				<th class="p-3 text-left">Status</th>
				<th class="p-3 text-center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $sl = 1; foreach ($policy_types as $policy_type): ?>
				<tr class="border-b hover:bg-gray-50">
					<td class="p-3"><?= $sl++; ?></td>
					<td class="p-3"><?= $policy_type->policy_type_name ?></td>
					<td class="p-3 description-column">
						<div class="description-text">
							<?= htmlspecialchars($policy_type->description) ?>
						</div>
					</td>
					<td class="p-3">
						<?php if ($policy_type->status == 1): ?>

							<span class="inline-flex items-center px-3 py-1 text-xs font-semibold
										text-green-700 bg-green-100 rounded-full">
								Active
							</span>

						<?php else: ?>

							<span class="inline-flex items-center px-3 py-1 text-xs font-semibold
										text-red-700 bg-red-100 rounded-full">
								Inactive
							</span>

						<?php endif; ?>
					</td>

					<td class="p-3 text-center flex justify-center gap-3">
						
						<a href="<?= base_url('index.php/insurancepolicy/view_policy_type/' . $policy_type->policy_type_id); ?>"
							class="p-2 bg-yellow-100 rounded" title="Edit">👁️</a>

						<a href="<?= base_url('index.php/insurancepolicy/edit_policy_type/' . $policy_type->policy_type_id); ?>"
							class="p-2 bg-yellow-100 rounded" title="Edit">✏️</a>

						<a onclick="return confirm('Delete this Policy Type?');"
							href="<?= base_url('index.php/insurancepolicy/delete_policy_type/' . $policy_type->policy_type_id); ?>"
							class="p-2 bg-red-100 rounded" title="Delete">🗑️</a>

					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<script>
$(document).ready(function() {

    $('#policyTable').DataTable({
        pageLength: 5,

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
            searchPlaceholder: "Search Policy Types..."
        }
    });

});
</script>

<style>

	#policyTable_wrapper .dataTables_filter {
		text-align: right !important;
	}

	#policyTable_wrapper .dataTables_length label {
		font-size: 0.875rem;
	}

	#policyTable_wrapper .dataTables_paginate {
		margin-top: 10px;
	}

	#policyTable tbody td {
		font-size: 0.875rem !important;
	}

	#policyTable {
		width: 100% !important;
		table-layout: fixed;
	}

	#policyTable th,
	#policyTable td {
		word-wrap: break-word;
		overflow-wrap: break-word;
	}

	#policyTable th:nth-child(1),
	#policyTable td:nth-child(1) {
		width: 7% !important;
	}

	#policyTable th:nth-child(2),
	#policyTable td:nth-child(2) {
		width: 18% !important;
		white-space: normal !important;
		overflow-wrap: break-word;
		word-wrap: break-word;
	}

	#policyTable th:nth-child(4),
	#policyTable td:nth-child(4) {
		width: 25% !important;
	}

	#policyTable th:nth-child(5),
	#policyTable td:nth-child(5) {
		width: 10% !important;
	}

	#policyTable .description-text {
		white-space: normal;
		word-break: break-word;
		overflow-wrap: anywhere;
	}

	#policyTable .description-text {
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		word-break: break-word;
	}

</style>
