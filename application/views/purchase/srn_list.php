<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
<!-- Header -->
<!-- Header -->
<div class="flex items-center justify-between bg-gray-200 px-4 py-3 rounded-t-lg">

    <h1 class="text-xl font-medium text-gray-700">
        SRN List
    </h1>

   

</div>


<!-- page content -->
<?php if ($this->session->flashdata('success')): ?>
        <div class="mb-3 rounded border border-green-300 bg-green-50 px-4 py-3 text-green-800">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-3 rounded border border-red-300 bg-red-50 px-4 py-3 text-red-800">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow rounded-b-lg p-4 overflow-x-auto">

    <div class="overflow-x-auto">

        <table id="datatable"
               class="min-w-full divide-y divide-gray-200 text-sm">

            <thead class="bg-gray-100">

                <tr>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">#</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Sr.No</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">SRN Code</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">SRN Date</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Supplier</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700 text-right">Amount</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Action</th>
                </tr>

            </thead>


            <tbody class="divide-y divide-gray-200 bg-white">

                <?php $i = 1; foreach ($records as $row) : ?>

                    <tr class="hover:bg-gray-50 transition">

                        <!-- DELETE -->
                        <td class="px-4 py-2">
                            <a href="#"
                               class="delete-srn text-red-600 hover:text-red-800"
                               data-srn-id="<?= $row->id; ?>"
                               title="Delete">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>

                        <!-- SR NO -->
                        <td class="px-4 py-2">
                            <?= $i++; ?>
                        </td>

                        <!-- SRN CODE -->
                        <td class="px-4 py-2 font-medium text-gray-800">
                            <?= $row->srn_no ?? '-' ?>
                        </td>

                        <!-- DATE -->
                        <td class="px-4 py-2 text-gray-700">
                            <?= !empty($row->srn_date) ? date('d-M-Y', strtotime($row->srn_date)) : '-' ?>
                        </td>

                        <!-- SUPPLIER -->
                        <td class="px-4 py-2">
                            <a target="_blank"
                               href="<?= base_url('index.php/Supplier/edit_supplier/'.$row->supplier_id); ?>"
                               class="text-blue-600 hover:text-blue-800 hover:underline">

                                <?= $row->supplier_name ?? '-' ?>

                            </a>
                        </td>

                        <!-- AMOUNT -->
                        <td class="px-4 py-2 text-gray-700 font-medium text-right">
                            <?= number_format((float)$row->total_amount, 2) ?>
                        </td>

                        <!-- ACTION -->
                        <td class="px-4 py-2 space-x-3">
                            <?php
                            $in_vat_report = ($row->status ?? '') !== 'cancelled'
                                && ((float) ($row->vatamt ?? 0) > 0 || (float) ($row->subtotal ?? 0) > 0);
                            ?>
                            <?php if ($in_vat_report): ?>
                            <button type="button"
                                    class="edit-srn-date text-yellow-600 hover:text-yellow-800"
                                    data-srn-id="<?= $row->id ?>"
                                    data-srn-date="<?= !empty($row->srn_date) ? date('Y-m-d', strtotime($row->srn_date)) : '' ?>"
                                    data-srn-code="<?= htmlspecialchars($row->srn_no) ?>"
                                    title="Edit SRN Date">
                                <i class="fa fa-calendar"></i>
                            </button>
                            <?php endif; ?>
                            <a href="<?= base_url('index.php/Purchase/print_srn/'.$row->id.'/1'); ?>"
                               class="text-blue-600 hover:text-blue-800"
                               title="Print SRN">
                                <i class="fa fa-print"></i>
                            </a>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>


<!-- DataTables Initialization -->
<script>
	$(document).ready(function() {


		$('#datatable').DataTable({
			pageLength: 10,
			lengthMenu: [
				[5, 10, 25, -1],
				[5, 10, 25, "All"]
			],
			responsive: true,

			// Move search box to the RIGHT
			dom: "<'flex justify-between items-center mb-3'l<f>>" +
				"t" +
				"<'flex justify-between items-center mt-3'p>",

			language: {
				search: "",
				searchPlaceholder: "Search ..."
			}
		});


		$('.delete-grn').click(function(e) {

			e.preventDefault();

			let grn_id = $(this).data('grn-id');

			if (confirm('Are you sure you want to delete this GRN?')) {

				$.ajax({

					url: "<?php echo base_url() ?>index.php/Purchase/delete_grn",

					type: 'POST',

					data: {
						grn_id: grn_id
					},

					success: function(response) {

						let res = JSON.parse(response);

						if (res.success) {

							alert('GRN deleted successfully.');

							location.reload();

						} else {

							alert('Error: ' + res.message);

						}

					},

					error: function() {

						alert('An error occurred while processing the request.');

					}

				});

			}

		});

		$(document).on('click', '.edit-srn-date', function() {
			var srnId = $(this).data('srn-id');
			var srnDate = $(this).data('srn-date');
			var srnCode = $(this).data('srn-code');

			$('#editSrnId').val(srnId);
			$('#editSrnDate').val(srnDate);
			$('#editSrnCode').text(srnCode);
			$('#editSrnModal').removeClass('hidden');
		});

		$('#editSrnModalClose').click(function() {
			$('#editSrnModal').addClass('hidden');
		});

		$('#editSrnForm').submit(function() {
			var dateValue = $('#editSrnDate').val();
			if (!dateValue) {
				alert('Please enter a valid SRN date.');
				return false;
			}
			return true;
		});
	});

    </script>

    <div id="editSrnModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg">
            <div class="flex items-center justify-between pb-4 border-b">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Edit SRN Date</h2>
                    <p class="text-sm text-gray-600">Update the SRN date for VAT reporting.</p>
                </div>
                <button id="editSrnModalClose" class="text-gray-500 hover:text-gray-800">✕</button>
            </div>

            <form id="editSrnForm" method="post" action="<?= base_url('index.php/Purchase/update_srn_date') ?>" class="mt-4 space-y-4">
                <input type="hidden" name="srn_id" id="editSrnId">

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="editSrnCode">SRN Code</label>
                    <div id="editSrnCode" class="mt-1 text-gray-800"></div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="editSrnDate">SRN Date</label>
                    <input id="editSrnDate" name="srn_date" type="date" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <div class="flex justify-end gap-3 pt-3">
                    <button type="button" id="editSrnModalClose" class="rounded border border-gray-300 bg-white px-4 py-2 text-gray-700 hover:bg-gray-100">Cancel</button>
                    <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
	function handleKeyPress(event, row) {

		var suggestionDiv = $('#display' + row);

		var selected = suggestionDiv.find('.selected');

		var suggestions = suggestionDiv.find('.suggestion');

		if (event.key === "ArrowUp" || event.key === "ArrowDown" || event.key === "Enter") {

			event.preventDefault();

			if (event.key === "ArrowUp") {

				if (selected.length === 0) {

					suggestions.eq(-1).addClass('selected');

				} else {

					var prev = selected.removeClass('selected').prev('.suggestion');

					if (prev.length > 0) {

						prev.addClass('selected');

					} else {

						suggestions.eq(-1).addClass('selected');

					}

				}

			} else if (event.key === "ArrowDown") {

				if (selected.length === 0) {

					suggestions.eq(0).addClass('selected');

				} else {

					var next = selected.removeClass('selected').next('.suggestion');

					if (next.length > 0) {

						next.addClass('selected');

					} else {

						suggestions.eq(0).addClass('selected');

					}

				}

			} else if (event.key === "Enter") {

				if (selected.length > 0) {

					var productName = selected.text();

					var productID = selected.data('productId');

					$('#search' + row).val(productName);

					$('#pro_id' + row).val(productID);

					suggestionDiv.hide();

					get_product_info(row);

				}

			}

		}

	}



	function showsugg(row, event) {

		var name = $('#search' + row).val();

		if (name.length > 4) {

			$.ajax({

				type: "POST",

				url: "<?php echo site_url('Product/ajax_product_search'); ?>",

				dataType: 'json',

				data: {
					search_key: name
				},

				success: function(data) {

					document.getElementById('display' + row).innerHTML = '';

					var parentDiv = document.getElementById('display' + row);

					if (data.length > 0) {

						data.forEach(function(product) {

							var option = document.createElement('div');

							option.textContent = product.product_name;

							option.classList.add('suggestion');

							option.dataset.productId = product.product_id;

							option.addEventListener('click', function() {

								document.getElementById('search' + row).value = product.product_name;

								document.getElementById('pro_id' + row).value = product.product_id;

								parentDiv.innerHTML = '';

								get_product_info(row);

							});

							parentDiv.appendChild(option);

						});

					} else {

						var option = document.createElement('div');

						option.textContent = 'No products found';

						option.classList.add('suggestion');

						parentDiv.appendChild(option);

					}

					$('#display' + row).show();

				}

			});

		} else {

			document.getElementById('display' + row).innerHTML = '';

		}

	}
</script>
