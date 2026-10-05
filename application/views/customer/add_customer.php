<style>
	/* Works in most modern browsers */
	option[data-special="true"] {
		font-weight: 600;
		color: #16a34a;
		/* green-600 */
	}

	.vehicleRow {
		transition: all 0.2s ease;
	}

	.vehicleRow:hover {
		box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
	}

	.vehicleRow label {
		color: #374151;
		font-size: 14px;
	}

	.vehicleRow input,
	.vehicleRow select {
		background: #fff;
	}
</style>
<div class="w-full bg-white rounded-2xl shadow-md p-6">
<?php
$form_data = isset($form_data) && is_array($form_data)
	? $form_data
	: [];
?>

<?php
$from = isset($from)
	? $from
	: $this->input->get('from');

$from = $from ?: '';
?>

<!-- <?php if ($this->session->flashdata('error')): ?>
	<div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
		<?= htmlspecialchars($this->session->flashdata('error')) ?>
	</div>
<?php endif; ?> -->

<?php $error_flash = $this->session->flashdata('error'); ?>

<?php if ($error_flash): ?>
    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
        <?= nl2br(htmlspecialchars($error_flash, ENT_QUOTES, 'UTF-8')) ?>
    </div>
<?php endif; ?>

<form method="POST"  id="customerForm"
	action="<?= base_url('index.php/Customer/save'); ?>"
	onsubmit="return preventDoubleSubmit(this);">
	<input type="hidden" name="from" value="<?= htmlspecialchars($this->input->get('from') ?? '') ?>">

	<!-- CUSTOMER SECTION -->
	<!-- <h3 class="text-xl font-semibold mb-3">Customer Details</h3> -->
	<div class="flex items-center justify-between mb-3">
		<h3 class="text-xl font-semibold">
			Customer Details
		</h3>

		<a href="<?= base_url(
			$from === 'vehicle'
				? 'index.php/Vehicle/list'
				: 'index.php/Customer'
		); ?>"
			class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 text-sm">
			List
		</a>
	</div>

	<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

		<!-- Branch -->
		<div>
			<label class="font-medium">
				Branch <span class="text-red-500">*</span>
			</label>

			<?= render_branch_select_dropdown(
				'branch_id',
				$form_data['branch_id'] ?? ($customer->branch_id ?? null)
			) ?>
		</div>


		<!-- Customer Name -->
		<div>
			<label class="font-medium">
				Customer Name <span class="text-red-500">*</span>
			</label>

			<input type="text"
				name="name"
				required
				value="<?= htmlspecialchars($form_data['name'] ?? '') ?>"
				class="w-full border p-2 rounded">
		</div>


		<!-- Phone -->
		<div>
			<label class="font-medium">Phone</label>

			<input type="number"
				name="phone"
				value="<?= htmlspecialchars($form_data['phone'] ?? '') ?>"
				class="w-full border p-2 rounded">
		</div>


		<!-- Email -->
		<div>
			<label class="font-medium">Email</label>

			<!-- <input type="email"
				name="email"
				value="<?= htmlspecialchars($form_data['email'] ?? '') ?>"
				class="w-full border p-2 rounded"> -->

			<input type="email" 
				name="email" 
				id="email" 
				value="<?= htmlspecialchars($form_data['email'] ?? '') ?>" 
				class="w-full border p-2 rounded" 
				placeholder="example@domain.com">
		</div>


		<!-- Address -->
		<div>
			<label class="font-medium">Address</label>

			<textarea name="address"
				class="w-full border p-2 rounded"><?= htmlspecialchars($form_data['address'] ?? '') ?></textarea>
		</div>


		<!-- Emirate -->
		<div>
			<label class="font-medium">Emirate</label>

			<?php
			$emirates = [
				'Abu Dhabi',
				'Dubai',
				'Sharjah',
				'Ajman',
				'Umm Al Quwain',
				'Ras Al Khaimah',
				'Fujairah'
			];
			?>

			<select name="emirate"
				class="w-full border p-2 rounded">

				<option value="">-- Select Emirate --</option>

				<?php foreach ($emirates as $emirate): ?>

					<option value="<?= htmlspecialchars($emirate) ?>"
						<?= (($form_data['emirate'] ?? '') == $emirate) ? 'selected' : '' ?>>
						<?= htmlspecialchars($emirate) ?>
					</option>

				<?php endforeach; ?>

			</select>
		</div>


		<!-- TRN -->
		<div>
			<label class="font-medium">TRN</label>

			<!-- <input type="text"
				name="trn"
				value="<?= htmlspecialchars($form_data['trn'] ?? '') ?>"
				class="w-full border p-2 rounded"> -->

			<input type="text" 
				name="trn" 
				id="trn" 
				value="<?= htmlspecialchars($form_data['trn'] ?? '') ?>" 
				class="w-full border p-2 rounded" 
				placeholder="15-digit TRN" inputmode="numeric">
		</div>

	</div>

	<hr class="my-6">

	<!-- VEHICLE SECTION -->
<?php
$form_data = isset($form_data) && is_array($form_data) ? $form_data : [];

$vehicle_registrations = $form_data['vehicle_registration_no'] ?? [''];
$vehicle_brand_ids     = $form_data['brand_id'] ?? [''];
$vehicle_model_ids     = $form_data['model_id'] ?? [''];
$vehicle_variants      = $form_data['vehicle_variant'] ?? [''];
$vehicle_years         = $form_data['vehicle_year'] ?? [''];
$vehicle_colors        = $form_data['vehicle_color'] ?? [''];
$vehicle_chassis       = $form_data['vehicle_chassis_no'] ?? [''];
$vehicle_engines       = $form_data['vehicle_engine_no'] ?? [];
?>

<h3 class="text-xl font-semibold mb-4">Vehicle Details</h3>

<div id="vehicleRows">

	<?php foreach ($vehicle_registrations as $i => $registration): ?>

		<?php
		$selectedBrand = $vehicle_brand_ids[$i] ?? '';
		$selectedModel = $vehicle_model_ids[$i] ?? '';
		$selectedYear  = $vehicle_years[$i] ?? '';
		?>

		<div class="vehicleRow bg-white border border-gray-200 rounded-xl shadow-sm mb-6 overflow-hidden relative">

			<!-- Header -->
			<div class="bg-blue-50 border-b px-4 py-3 flex justify-between items-center">

				<h4 class="font-semibold text-blue-700">
					🚗 Vehicle Information
				</h4>

				<button type="button"
					onclick="removeVehicleRow(this)"
					class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">
					Remove
				</button>

			</div>

			<div class="p-4">

				<!-- Row 1 -->
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">

					<!-- Registration No -->
					<div>
						<label class="block font-medium mb-1">
							Registration No
						</label>

						<input type="text"
							name="vehicle_registration_no[]"
							value="<?= htmlspecialchars($registration) ?>"
							class="w-full border p-2 rounded"
							placeholder="A 12345">
					</div>


					<!-- Brand -->
					<div>
						<label class="block font-medium mb-1">
							Brand
						</label>

						<select name="brand_id[]"
							class="brandSelect w-full border p-2 rounded"
							required>

							<option value="">-- Select Brand --</option>

							<?php foreach ($brands as $b): ?>

								<option value="<?= $b->brand_id ?>"
									<?= ((string)$selectedBrand === (string)$b->brand_id) ? 'selected' : '' ?>>
									<?= htmlspecialchars($b->brand_name) ?>
								</option>

							<?php endforeach; ?>

							<option disabled>────────────────</option>

							<option value="add_brand" data-special="true">
								+ Add New Brand
							</option>

						</select>
					</div>


					<!-- Model -->
					<div>
						<label class="block font-medium mb-1">
							Model
						</label>

						<select name="model_id[]"
							class="modelSelect w-full border p-2 rounded"
							required>

							<option value="">-- Select Model --</option>

							<?php if (!empty($selectedModel)): ?>

								<?php
								$selected_model = $this->Vehicle_model
									->get_model_by_id($selectedModel);
								?>

								<?php if ($selected_model): ?>

									<option value="<?= $selected_model->model_id ?>" selected>
										<?= htmlspecialchars($selected_model->model_name) ?>
									</option>

								<?php endif; ?>

							<?php endif; ?>

							<option disabled>────────────────</option>

							<option value="add_model" data-special="true">
								+ Add Model
							</option>

						</select>
					</div>


					<!-- Variant -->
					<div>
						<label class="block font-medium mb-1">
							Variant
						</label>

						<input type="text"
							name="vehicle_variant[]"
							value="<?= htmlspecialchars($vehicle_variants[$i] ?? '') ?>"
							class="w-full border p-2 rounded"
							placeholder="Diesel / ZX">
					</div>

				</div>


				<!-- Row 2 -->
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

					<!-- Year -->
					<div>
						<label class="block font-medium mb-1">
							Year
						</label>

						<div class="flex gap-2">

							<select name="vehicle_year[]"
								class="yearSelect flex-1 border p-2 rounded">

								<option value="">
									-- Select Year --
								</option>

								<?php for ($y = date('Y'); $y >= 1990; $y--): ?>

									<option value="<?= $y ?>"
										<?= ((string)$selectedYear === (string)$y) ? 'selected' : '' ?>>
										<?= $y ?>
									</option>

								<?php endfor; ?>

								<option value="add_year" data-special="true">
									+ Add New Year
								</option>

							</select>

							<input type="number"
								name="vehicle_year_custom[]"
								class="yearCustomInput hidden border p-2 rounded w-24"
								placeholder="2020"
								min="1990"
								max="2050">

						</div>
					</div>


					<!-- Color -->
					<div>
						<label class="block font-medium mb-1">
							Color
						</label>

						<input type="text"
							name="vehicle_color[]"
							value="<?= htmlspecialchars($vehicle_colors[$i] ?? '') ?>"
							class="w-full border p-2 rounded"
							placeholder="White">
					</div>


					<!-- VIN -->
					<div>
						<label class="block font-medium mb-1">
							VIN No
						</label>

						<input type="text"
							name="vehicle_chassis_no[]"
							value="<?= htmlspecialchars($vehicle_chassis[$i] ?? '') ?>"
							class="w-full border p-2 rounded"
							placeholder="VIN Number"
							required>
					</div>


					<!-- Engine -->
					<div>
						<label class="block font-medium mb-1">
							Engine No
						</label>

						<input type="text"
							name="vehicle_engine_no[]"
							value="<?= htmlspecialchars($vehicle_engines[$i] ?? '') ?>"
							class="w-full border p-2 rounded"
							placeholder="Engine Number">
					</div>

				</div>

			</div>

		</div>

	<?php endforeach; ?>

</div>


<!-- ADD VEHICLE BUTTON -->
<div class="mt-4">

	<button type="button"
		onclick="addVehicleRow()"
		class="w-full border-2 border-dashed border-green-500 text-green-600 py-3 rounded-xl hover:bg-green-50 font-semibold">

		+ Add Another Vehicle

	</button>

</div>


<br><br>


<!-- SAVE BUTTON -->
<!-- <button type="submit"
	id="saveBtn"
	class="px-6 py-2 bg-blue-600 text-white rounded">

	Save Customer & Vehicles

</button> -->

<div class="flex items-center gap-3 mt-6">

    <button type="submit"
        id="saveBtn"
        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Save Customer & Vehicles
    </button>

    <a href="<?= base_url(
		$from === 'vehicle'
			? 'index.php/Vehicle/list'
			: 'index.php/Customer'
	); ?>"
		class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 inline-block">
		Cancel
	</a>

</div>

</form>
</div>
<!-- ====================================================== -->


<div id="brandModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">
	<div class="bg-white p-6 rounded w-[90%] max-w-md">
		<h3 class="font-bold mb-3">Add Brand</h3>
		<input type="text" id="newBrandName" class="w-full border p-2 mb-4">
		<button type="button" onclick="saveBrand()" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
		<button type="button" onclick="closeBrandModal()" class="ml-2 px-4 py-2">Cancel</button>
	</div>
</div>

<div id="modelModal"
	class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

	<div class="bg-white p-6 rounded w-[90%] max-w-md">
		<h3 class="text-lg font-bold mb-4">Add Vehicle Model</h3>

		<!-- Brand Select -->
		<label class="font-medium">Brand <span class="text-red-500">*</span></label>
		<select id="modelBrandSelect"
			class="w-full border p-2 rounded mb-3" required>
			<option value="">-- Select Brand --</option>
			<?php foreach ($brands as $b): ?>
				<option value="<?= $b->brand_id ?>">
					<?= $b->brand_name ?>
				</option>
			<?php endforeach; ?>
		</select>

		<!-- Model Name -->
		<label class="font-medium">Model Name <span class="text-red-500">*</span></label>
		<input type="text" id="newModelName"
			class="w-full border p-2 rounded mb-4"
			placeholder="Eg: Corolla, City, Creta">

		<!-- Buttons -->
		<div class="text-right">
			<button type="button" onclick="saveModel()"
				class="bg-blue-600 text-white px-4 py-2 rounded">
				Save
			</button>
			<button type="button" onclick="closeModelModal()"
				class="ml-2 px-4 py-2">
				Cancel
			</button>
		</div>
	</div>
</div>

<!-- ================================================= -->

<script>
$('#customerForm').on('keydown', function(e) {

    if (e.key === 'Enter' && !$(e.target).is('textarea')) {
        e.preventDefault();
        return false;
    }

});


$('#customerForm').on('submit', function(e) {

    if ($(this).data('submitted') === true) {
        e.preventDefault();
        return false;
    }

    if (!this.checkValidity()) {
        return;
    }

    $(this).data('submitted', true);

    $('#saveBtn')
        .prop('disabled', true)
        .removeClass('bg-blue-600 hover:bg-blue-700')
        .addClass('bg-gray-400 cursor-not-allowed')
        .text('Saving...');

});
	function addVehicleRow() {
		let html = `
      
			<div class="vehicleRow grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-4 p-4 border rounded-lg bg-gray-50 relative">

            <button type="button"
                onclick="removeVehicleRow(this)"
                class="absolute top-2 right-2 px-2 py-1 bg-red-600 text-white text-xs rounded">
                ✖
            </button>

            <div>
                <label class="font-medium">Registration No</label>
                <input name="vehicle_registration_no[]" class="border p-2 rounded w-full" placeholder="A 12345">
			
            </div>

            <div>
                <label class="font-medium">Brand</label>
             
					<select name="brand_id[]" 
						class="brandSelect w-full border p-2 rounded" required>
						<option value="">-- Select Brand --</option>
						<?php foreach ($brands as $b): ?>
							<option value="<?= $b->brand_id ?>">
								<?= $b->brand_name ?>
							</option>
						<?php endforeach; ?>
						<option disabled>────────────────</option>
						<option value="add_brand" data-special="true">+ Add New Brand</option>
					</select>
            </div>

            <div>
                <label class="font-medium">Model</label>
               
				<select name="model_id[]"
						class="modelSelect w-full border p-2 rounded" required>
						<option value="">-- Select Model --</option>
						<option disabled>────────────────</option>
						<option value="add_model" data-special="true">+ Add Model</option>
					</select>
            </div>

            <div>
                <label class="font-medium">Variant</label>
                <input name="vehicle_variant[]" class="border p-2 rounded w-full" placeholder="Diesel / ZX">
            </div>

            <div>
                <label class="font-medium">Year</label>
               	<div class="flex gap-2">
               		<select name="vehicle_year[]" class="yearSelect flex-1 border p-2 rounded" disabled>
               			<option value="">-- Select Year --</option>
               			<option value="add_year" data-special="true">+ Add New Year</option>
               		</select>
					<input type="number" name="vehicle_year_custom[]" class="yearCustomInput hidden border p-2 rounded w-20" placeholder="2020" min="1990" max="2050">
               	</div>
            </div>

            <div>
                <label class="font-medium">VIN No</label>
                <input name="vehicle_chassis_no[]" class="border p-2 rounded w-full" placeholder="VIN Number" required>
            </div>

            <div>
                <label class="font-medium">Engine No</label>
                <input name="vehicle_engine_no[]" class="border p-2 rounded w-full" placeholder="Engine Number">
            </div>

        </div>
    `;

		document.getElementById('vehicleRows').insertAdjacentHTML('beforeend', html);
	}

	function removeVehicleRow(btn) {

		let rows = document.querySelectorAll('.vehicleRow');

		// Keep at least one vehicle
		if (rows.length <= 1) {
			alert("At least one vehicle is required.");
			return;
		}

		// Find the complete vehicle row
		let vehicleRow = btn.closest('.vehicleRow');

		if (vehicleRow) {
			vehicleRow.remove();
		}
	}
	// <input name="vehicle_brand[]" class="border p-2 rounded w-full" placeholder="Toyota">
	// <input name="vehicle_model[]" class="border p-2 rounded w-full" placeholder="Innova">
	// =================================================6-1-26======================

	// $('#brandSelect').on('change', function() {

	// 	let brandId = $(this).val();
	// 	$('#modelSelect').html('<option value="">Loading...</option>');

	// 	if (!brandId) {
	// 		$('#modelSelect').html('<option value="">-- Select Model --</option>');
	// 		return;
	// 	}

	// 	fetch("<?= base_url('index.php/customer/get_models_by_brand/'); ?>" + brandId)
	// 		.then(res => res.json())
	// 		.then(data => {

	// 			let options = '<option value="">-- Select Model --</option>';

	// 			data.forEach(m => {
	// 				options += `<option value="${m.model_id}">
	//                             ${m.model_name}
	//                         </option>`;
	// 			});

	// 			$('#modelSelect').html(options);
	// 		});
	// });
	$(document).on('change', '.brandSelect', function() {

		let brandId = $(this).val();
		let val = $(this).val();

		if (val === 'add_brand') {
			$('#brandModal').removeClass('hidden');
			$(this).val('').trigger('change');
			return;
		}


		let row = $(this).closest('.vehicleRow');
		let modelSelect = row.find('.modelSelect');

		modelSelect.html('<option value="">Loading...</option>');

		if (!brandId) {
			modelSelect.html('<option value="">-- Select Model --</option>');
			return;
		}

		fetch("<?= base_url('index.php/customer/get_models_by_brand/'); ?>" + brandId)
			.then(res => res.json())
			.then(data => {

				let options = '<option value="">-- Select Model --</option>';

				data.forEach(m => {
					options += `<option value="${m.model_id}">
                                ${m.model_name}
                            </option>`;
				});

				modelSelect.html(options);
			});
	});
	// ============================================================
	// MODEL -> YEAR HANDLING
	// ============================================================
	var activeModelRow = null;
	// Store year selection separately for each vehicle row + model
	$(document).on('change', '.modelSelect', function() {

		var modelSelect = $(this);
		var row = modelSelect.closest('.vehicleRow');

		var yearSelect = row.find('.yearSelect');
		var customInput = row.find('.yearCustomInput');

		var modelId = modelSelect.val();

		// ----------------------------------------------------------
		// ADD MODEL
		// ----------------------------------------------------------

		if (modelId === 'add_model') {

			var brandId = row.find('.brandSelect').val();

			if (!brandId) {
				alert('Please select a Brand first.');
				modelSelect.val('');
				return;
			}

			activeModelRow = row;

			$('#modelBrandSelect').val(brandId);
			$('#modelModal').removeClass('hidden');

			modelSelect.val('');
			return;
		}

		// ----------------------------------------------------------
		// NO MODEL
		// ----------------------------------------------------------

		if (!modelId) {

			yearSelect
				.prop('disabled', true)
				.removeClass('hidden')
				.html('<option value="">-- Select Year --</option>');

			customInput
				.addClass('hidden')
				.val('');

			return;
		}

		// ----------------------------------------------------------
		// CREATE YEAR STORAGE FOR THIS ROW
		// ----------------------------------------------------------

		var yearMemory = row.data('year-memory');

		if (!yearMemory) {
			yearMemory = {};
			row.data('year-memory', yearMemory);
		}

		// ----------------------------------------------------------
		// IF THIS MODEL WAS ALREADY LOADED
		// RESTORE ITS PREVIOUS YEAR
		// ----------------------------------------------------------

		if (yearMemory[modelId]) {

			console.log(
				'Restoring previous year for model:',
				modelId,
				yearMemory[modelId]
			);

			yearSelect
				.removeClass('hidden')
				.prop('disabled', false)
				.html(yearMemory[modelId].html);

			// Restore selected year
			if (yearMemory[modelId].year) {

				yearSelect.val(yearMemory[modelId].year);

				// If saved year exists in select
				if (yearSelect.val() == yearMemory[modelId].year) {

					customInput
						.addClass('hidden')
						.val('');

				} else {

					// Custom year
					yearSelect.addClass('hidden');

					customInput
						.removeClass('hidden')
						.val(yearMemory[modelId].year);
				}

			} else {

				yearSelect.val('');

				customInput
					.addClass('hidden')
					.val('');
			}

			return;
		}

		// ----------------------------------------------------------
		// FIRST TIME SELECTING THIS MODEL
		// ----------------------------------------------------------

		yearSelect
			.removeClass('hidden')
			.prop('disabled', false)
			.html('<option value="">Loading...</option>');

		customInput
			.addClass('hidden')
			.val('');

		var url =
			"<?= base_url('index.php/customer/get_years_by_model/'); ?>" +
			encodeURIComponent(modelId);

		console.log('Loading years for model:', modelId);

		fetch(url, {
				method: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'Accept': 'application/json'
				}
			})
			.then(function(response) {

				if (!response.ok) {
					throw new Error('HTTP Error ' + response.status);
				}

				return response.json();
			})
			.then(function(data) {

				console.log('Years received:', data);

				if (!Array.isArray(data)) {

					if (data && Array.isArray(data.data)) {
						data = data.data;
					} else {
						throw new Error('Invalid year data format');
					}
				}

				// ------------------------------------------------------
				// NO YEARS AVAILABLE
				// ------------------------------------------------------

				if (data.length === 0) {

					yearSelect
						.addClass('hidden')
						.html('<option value="">-- Select Year --</option>');

					customInput
						.removeClass('hidden')
						.val('');

					// Remember that this model has no predefined years
					yearMemory[modelId] = {
						html: '<option value="">-- Select Year --</option>',
						year: ''
					};

					return;
				}

				// ------------------------------------------------------
				// BUILD YEAR OPTIONS
				// ------------------------------------------------------

				var options =
					'<option value="">-- Select Year --</option>';

				data.forEach(function(y) {

					if (
						y.model_year !== undefined &&
						y.model_year !== null &&
						y.model_year !== ''
					) {

						options +=
							'<option value="' + y.model_year + '">' +
							y.model_year +
							'</option>';
					}
				});

				options +=
					'<option disabled>────────────────</option>';

				options +=
					'<option value="add_year" data-special="true">' +
					'+ Add New Year' +
					'</option>';

				// ------------------------------------------------------
				// SAVE MODEL YEARS IN MEMORY
				// ------------------------------------------------------

				yearMemory[modelId] = {
					html: options,
					year: ''
				};

				// ------------------------------------------------------
				// DISPLAY
				// ------------------------------------------------------

				yearSelect
					.removeClass('hidden')
					.prop('disabled', false)
					.html(options);

				customInput
					.addClass('hidden')
					.val('');

			})
			.catch(function(error) {

				console.error('Year loading error:', error);

				yearSelect
					.prop('disabled', false)
					.html(
						'<option value="">Error loading years</option>'
					);
			});

	});


	// ============================================================
	// YEAR CHANGE
	// ============================================================

	$(document).on('change', '.yearSelect', function() {

		var yearSelect = $(this);
		var row = yearSelect.closest('.vehicleRow');

		var modelId = row.find('.modelSelect').val();
		var customInput = row.find('.yearCustomInput');

		var yearValue = yearSelect.val();

		// ----------------------------------------------------------
		// ADD NEW YEAR
		// ----------------------------------------------------------

		if (yearValue === 'add_year') {

			yearSelect
				.addClass('hidden')
				.val('');

			customInput
				.removeClass('hidden')
				.focus();

			return;
		}

		// ----------------------------------------------------------
		// NORMAL YEAR
		// ----------------------------------------------------------

		if (yearValue) {

			customInput
				.addClass('hidden')
				.val('');

			// Remember selected year for this model
			var yearMemory = row.data('year-memory');

			if (!yearMemory) {
				yearMemory = {};
				row.data('year-memory', yearMemory);
			}

			if (!yearMemory[modelId]) {
				yearMemory[modelId] = {};
			}

			yearMemory[modelId].year = yearValue;

			console.log(
				'Saved year:',
				yearValue,
				'for model:',
				modelId
			);
		}
	});


	// ============================================================
	// CUSTOM YEAR
	// ============================================================

	$(document).on('blur', '.yearCustomInput', function() {

		var customInput = $(this);
		var row = customInput.closest('.vehicleRow');

		var yearSelect = row.find('.yearSelect');
		var modelId = row.find('.modelSelect').val();

		var value = customInput.val().trim();

		var yearMemory = row.data('year-memory');

		if (!yearMemory) {
			yearMemory = {};
			row.data('year-memory', yearMemory);
		}

		// ----------------------------------------------------------
		// VALID CUSTOM YEAR
		// ----------------------------------------------------------

		if (value && value.length === 4) {

			yearSelect.addClass('hidden');

			if (!yearMemory[modelId]) {
				yearMemory[modelId] = {};
			}

			yearMemory[modelId].year = value;

			console.log(
				'Saved custom year:',
				value,
				'for model:',
				modelId
			);

		}

		// ----------------------------------------------------------
		// EMPTY CUSTOM YEAR
		// ----------------------------------------------------------
		else if (!value) {

			yearSelect
				.removeClass('hidden')
				.val('');

			customInput.addClass('hidden');

			if (yearMemory[modelId]) {
				yearMemory[modelId].year = '';
			}
		}
	});


	// ============================================================
	// ENTER KEY IN CUSTOM YEAR
	// ============================================================

	$(document).on('keypress', '.yearCustomInput', function(e) {

		if (e.which === 13) {
			e.preventDefault();
			$(this).blur();
		}

	});

	$(document).on('change', '.yearSelect', function() {

		var yearSelect = $(this);
		var row = yearSelect.closest('.vehicleRow');

		var customInput = row.find('.yearCustomInput');

		var yearValue = yearSelect.val();

		// Add New Year
		if (yearValue === 'add_year') {

			yearSelect
				.addClass('hidden')
				.val('');

			customInput
				.removeClass('hidden')
				.focus();

			return;
		}

		// Normal year selected
		if (yearValue) {

			customInput
				.addClass('hidden')
				.val('');
		}

	});

	$(document).on('blur', '.yearCustomInput', function() {
		let row = $(this).closest('.vehicleRow');
		let yearSelect = row.find('.yearSelect');
		let value = $(this).val().trim();

		if (value && value.length === 4) {
			// Valid year - keep custom input visible and hide select
			yearSelect.addClass('hidden');
		} else if (!value) {
			// Empty - switch back to select
			yearSelect.removeClass('hidden').val('');
			$(this).addClass('hidden');
		}
	});

	$(document).on('keypress', '.yearCustomInput', function(e) {
		if (e.which === 13) {
			$(this).blur();
		}
	});

	function saveBrand() {
		$.post('<?= base_url("index.php/SpareParts/save_brand") ?>', {
				name: $('#newBrandName').val()
			},
			function() {
				location.reload();
			}
		);
	}

	function saveModel() {

		let brandId = $('#modelBrandSelect').val();
		let modelName = $('#newModelName').val().trim();

		if (!brandId || !modelName) {
			alert('Brand and Model Name are required');
			return;
		}

		$.post(
			'<?= base_url("index.php/SpareParts/save_model") ?>', {
				brand_id: brandId,
				name: modelName
			},
			function(response) {

				closeModelModal();

				$('#newModelName').val('');

				// Use the exact vehicle row
				if (activeModelRow && activeModelRow.length) {

					let modelSelect =
						activeModelRow.find('.modelSelect');

					// Reload models for this exact row
					activeModelRow
						.find('.brandSelect')
						.trigger('change');

					// After models load, select newly created model
					setTimeout(function() {

						// If your API response contains model_id,
						// use that ID here instead.
						console.log('Model saved successfully');

					}, 500);
				}

			}
		).fail(function(xhr) {

			console.error(
				'Save model error:',
				xhr.responseText
			);

			alert('Unable to save model.');
		});
	}


	function closeBrandModal() {
		$('#brandModal').addClass('hidden');
	}

	function closeModelModal() {
		$('#modelModal').addClass('hidden');
	}
</script>
<script>
	document.getElementById('saveBtn').addEventListener('click', function() {

		this.disabled = true;
		this.innerText = 'Saving...';

		this.form.submit();

	});
</script>
<script>
	var isSubmitting = false;

	function preventDoubleSubmit(form) {
		if (isSubmitting) {
			return false;
		}

		// Consolidate year values before submit
		document.querySelectorAll('.vehicleRow').forEach((row) => {
			let yearSelect = row.querySelector('.yearSelect');
			let customInput = row.querySelector('.yearCustomInput');

			if (customInput && customInput.offsetParent !== null && customInput.value) {
				// Custom input is visible and has value - use it
				yearSelect.value = customInput.value;
			}
		});

		isSubmitting = true;

		document.getElementById('saveBtn').disabled = true;
		document.getElementById('saveBtn').innerText = 'Saving...';

		return true;
	}
</script>