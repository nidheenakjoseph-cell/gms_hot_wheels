<style>
.vehicleRow{
    transition:all .2s ease;
}

.vehicleRow:hover{
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.vehicleRow label{
    color:#374151;
    font-size:14px;
}

.vehicleRow input,
.vehicleRow select,
.vehicleRow textarea{
    background:#fff;
}

.option-special{
    font-weight:600;
    color:#16a34a;
}
</style>
<div class="w-full bg-white rounded-2xl shadow-md p-6">
	    <?php
		$form_data = $this->session->flashdata('form_data');

		$form_data = is_array($form_data)
			? $form_data
			: [];
		?>

        <?php
        $from = isset($from)
            ? $from
            : $this->input->get('from');

        $from = $from ?: '';
        ?>
	<h2 class="text-2xl font-bold mb-4">Edit Customer & Vehicles</h2>

		<?php if ($this->session->flashdata('error')): ?>

    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
        <?= $this->session->flashdata('error') ?>
    </div>

<?php endif; ?>
	<form id="customerForm" method="POST" action="<?= base_url('index.php/customer/update'); ?>">
 
        <input type="hidden" name="from" value="<?= htmlspecialchars($this->input->get('from') ?? '') ?>">
		<input type="hidden" name="customer_id" value="<?= $customer->customer_id ?>">
		<input type="hidden" id="vehiclesToDelete" name="vehicles_to_delete" value="">

		<!-- CUSTOMER DETAILS -->
		<!-- <h3 class="text-xl font-semibold mb-3">Customer Details</h3> -->
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-xl font-semibold mb-3">
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

			<div>
				<label class="font-medium">Branch <span class="text-red-500">*</span></label>
				<?= render_branch_select_dropdown(
					'branch_id',
					$form_data['branch_id'] ?? ($customer->branch_id ?? null)
				) ?>
			</div>

			<div>
				<label class="font-medium">Customer Name</label>
				<input type="text" name="name" value="<?= htmlspecialchars(
           $form_data['name'] ?? ($customer->name ?? '')
       ) ?>"
					class="w-full border p-2 rounded" required>
			</div>

			<div>
				<label class="font-medium">Phone</label>
				<input type="text" name="phone" value="<?= htmlspecialchars(
           $form_data['phone'] ?? ($customer->phone ?? '')
       ) ?>"
					class="w-full border p-2 rounded">
			</div>

			<div>
				<label class="font-medium">Email</label>
				<input type="email" name="email" value="<?= htmlspecialchars(
           $form_data['email'] ?? ($customer->email ?? '')
       ) ?>"
					class="w-full border p-2 rounded">
			</div>

			<div>
				<label class="font-medium">Address</label>
				<textarea name="address"
					class="w-full border p-2 rounded"><?= htmlspecialchars(
           $form_data['address'] ?? ($customer->address ?? '')
       ) ?></textarea>
			</div>

			<div>
				<label class="font-medium">Emirate</label>
				<select name="emirate" class="w-full border p-2 rounded">
					<option value="">-- Select Emirate --</option>

					<option value="Abu Dhabi"
						<?= ($form_data['emirate'] ?? $customer->emirates) == 'Abu Dhabi' ? 'selected' : '' ?>>
						Abu Dhabi
					</option>

					<option value="Dubai"
						<?= ($form_data['emirate'] ?? $customer->emirates) == 'Dubai' ? 'selected' : '' ?>>
						Dubai
					</option>

					<option value="Sharjah"
						<?= ($form_data['emirate'] ?? $customer->emirates) == 'Sharjah' ? 'selected' : '' ?>>
						Sharjah
					</option>

					<option value="Ajman"
						<?= ($form_data['emirate'] ?? $customer->emirates) == 'Ajman' ? 'selected' : '' ?>>
						Ajman
					</option>

					<option value="Umm Al Quwain"
						<?= ($form_data['emirate'] ?? $customer->emirates) == 'Umm Al Quwain' ? 'selected' : '' ?>>
						Umm Al Quwain
					</option>

					<option value="Ras Al Khaimah"
						<?= ($form_data['emirate'] ?? $customer->emirates) == 'Ras Al Khaimah' ? 'selected' : '' ?>>
						Ras Al Khaimah
					</option>

					<option value="Fujairah"
						<?= ($form_data['emirate'] ?? $customer->emirates) == 'Fujairah' ? 'selected' : '' ?>>
						Fujairah
					</option>
				</select>

			</div>
			<div>
				<label class="font-medium">TRN</label>
				<input type="text" name="trn" class="w-full border p-2 rounded" value="<?= htmlspecialchars(
           $form_data['trn'] ?? ($customer->trn ?? '')
       ) ?>">
			</div>
		</div>

		<hr class="my-6">

		<!-- VEHICLES -->
		<h3 class="text-xl font-semibold mb-3">Vehicles</h3>
<div id="vehicleRows">
<?php
$has_form_data = !empty($form_data);

if ($has_form_data) {

    // EXISTING VEHICLES
    $vehicle_ids =
        $form_data['vehicle_id_existing'] ?? [];

    $vehicle_registrations =
        $form_data['vehicle_registration_no_existing'] ?? [];

    $vehicle_brand_ids =
        $form_data['brand_id_existing'] ?? [];

    $vehicle_model_ids =
        $form_data['model_id_existing'] ?? [];

    $vehicle_variants =
        $form_data['vehicle_variant_existing'] ?? [];

    $vehicle_years =
        $form_data['vehicle_year_existing'] ?? [];

    $vehicle_custom_years =
        $form_data['vehicle_year_custom_existing'] ?? [];

    $vehicle_colors =
        $form_data['vehicle_color_existing'] ?? [];

    $vehicle_chassis_nos =
        $form_data['vehicle_chassis_no_existing'] ?? [];

    $vehicle_engine_nos =
        $form_data['vehicle_engine_no_existing'] ?? [];


    // NEW VEHICLES
    $new_vehicle_registrations =
        $form_data['vehicle_registration_no_new'] ?? [];

    $new_vehicle_brand_ids =
        $form_data['brand_id_new'] ?? [];

    $new_vehicle_model_ids =
        $form_data['model_id_new'] ?? [];

    $new_vehicle_variants =
        $form_data['vehicle_variant_new'] ?? [];

    $new_vehicle_years =
        $form_data['vehicle_year_new'] ?? [];

    $new_vehicle_colors =
        $form_data['vehicle_color_new'] ?? [];

    $new_vehicle_chassis_nos =
        $form_data['vehicle_chassis_no_new'] ?? [];

    $new_vehicle_engine_nos =
        $form_data['vehicle_engine_no_new'] ?? [];

} else {

    // EXISTING
    $vehicle_ids = [];
    $vehicle_registrations = [];
    $vehicle_brand_ids = [];
    $vehicle_model_ids = [];
    $vehicle_variants = [];
    $vehicle_years = [];
    $vehicle_custom_years = [];
    $vehicle_colors = [];
    $vehicle_chassis_nos = [];
    $vehicle_engine_nos = [];

    // NEW
    $new_vehicle_registrations = [];
    $new_vehicle_brand_ids = [];
    $new_vehicle_model_ids = [];
    $new_vehicle_variants = [];
    $new_vehicle_years = [];
    $new_vehicle_colors = [];
    $new_vehicle_chassis_nos = [];
    $new_vehicle_engine_nos = [];
}

?>

<?php foreach ($vehicles as $index => $v): ?>

    <?php

    if ($has_form_data) {

        $registration =
            $vehicle_registrations[$index]
            ?? ($v->registration_no ?? '');

        $brandId =
            $vehicle_brand_ids[$index]
            ?? ($v->brand_id ?? '');

        $modelId =
            $vehicle_model_ids[$index]
            ?? ($v->model_id ?? '');

        $variant =
            $vehicle_variants[$index]
            ?? ($v->variant ?? '');

        $year =
            $vehicle_years[$index]
            ?? ($v->year ?? '');

        $customYear =
            $vehicle_custom_years[$index]
            ?? '';

        $color =
            $vehicle_colors[$index]
            ?? ($v->color ?? '');

        $chassisNo =
            $vehicle_chassis_nos[$index]
            ?? ($v->chassis_no ?? '');

        $engineNo =
            $vehicle_engine_nos[$index]
            ?? ($v->engine_no ?? '');

    } else {

        $registration = $v->registration_no ?? '';
        $brandId = $v->brand_id ?? '';
        $modelId = $v->model_id ?? '';
        $variant = $v->variant ?? '';
        $year = $v->year ?? '';
        $customYear = '';
        $color = $v->color ?? '';
        $chassisNo = $v->chassis_no ?? '';
        $engineNo = $v->engine_no ?? '';

    }

    ?>
<div class="vehicleRow bg-white border border-gray-200 rounded-xl shadow-sm mb-6 overflow-hidden relative">

    <!-- HEADER -->
    <div class="bg-blue-50 border-b px-4 py-3 flex justify-between items-center">

        <h4 class="font-semibold text-blue-700">
            🚗 Vehicle Information
        </h4>

        <button type="button"
            onclick="removeVehicleRow(this, <?= $v->vehicle_id ?>)"
            class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">
            Remove
        </button>

    </div>

    <div class="p-4">

        <input type="hidden"
            name="vehicle_id_existing[]"
            value="<?= $v->vehicle_id ?>">

        <!-- ROW 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">

            <div>
                <label class="block font-medium mb-1">
                    Registration No
                </label>

                <input type="text"
                    name="vehicle_registration_no_existing[]"
                    value="<?= htmlspecialchars($registration) ?>"
                    class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium mb-1">
                    Brand
                </label>

<select
    name="brand_id_existing[]"
    class="brandSelect w-full border p-2 rounded"
    required>

    <option value="">-- Select Brand --</option>

    <?php foreach ($brands as $b): ?>

        <option value="<?= (int)$b->brand_id ?>"
            <?= ((string)$b->brand_id === (string)$brandId)
                ? 'selected'
                : '' ?>>

            <?= htmlspecialchars($b->brand_name) ?>

        </option>

    <?php endforeach; ?>

</select>

            </div>

            <div>
                <label class="block font-medium mb-1">
                    Model
                </label>

<select
    name="model_id_existing[]"
    class="modelSelect w-full border p-2 rounded"
    data-current-model-id="<?= (int)$modelId ?>"
    required>

    <option value="">-- Select Model --</option>

    <?php if (!empty($modelId)): ?>

        <?php
        $selected_model = $this->Vehicle_model
            ->get_model_by_id($modelId);
        ?>

        <?php if ($selected_model): ?>

            <option value="<?= (int)$modelId ?>" selected>
                <?= htmlspecialchars($selected_model->model_name) ?>
            </option>

        <?php endif; ?>

    <?php endif; ?>

</select>

            </div>

            <div>
                <label class="block font-medium mb-1">
                    Variant
                </label>

                <input type="text"
                    name="vehicle_variant_existing[]"
                    value="<?= htmlspecialchars($variant) ?>"
                    class="w-full border p-2 rounded">
            </div>

        </div>

        <!-- ROW 2 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">



<div>
    <label class="block font-medium mb-1">
        Year
    </label>

    <div class="flex gap-2">

        <select
            name="vehicle_year_existing[]"
            class="yearSelect flex-1 border p-2 rounded"
            data-current-year="<?= htmlspecialchars(
                (string)$year,
                ENT_QUOTES,
                'UTF-8'
            ) ?>">

            <option value="">
                -- Select Year --
            </option>

            <?php if (!empty($year)): ?>

                <option
                    value="<?= htmlspecialchars(
                        $year,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    selected>

                    <?= htmlspecialchars($year) ?>

                </option>

            <?php endif; ?>

            <option disabled>
                ────────────────
            </option>

            <option value="add_year">
                + Add New Year
            </option>

        </select>

        <input
            type="number"
            name="vehicle_year_custom_existing[]"
            class="yearCustomInput hidden border p-2 rounded w-24"
            value="<?= htmlspecialchars($customYear) ?>"
            placeholder="2025"
            min="1990"
            max="2050">

    </div>
</div>

    

            <div>
                <label class="block font-medium mb-1">
                    Color
                </label>

                <input type="text"
       name="vehicle_color_existing[]"
       value="<?= htmlspecialchars($color) ?>"
       class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium mb-1">
                    VIN No
                </label>

                <input type="text"
       name="vehicle_chassis_no_existing[]"
       value="<?= htmlspecialchars($chassisNo) ?>"
       class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium mb-1">
                    Engine No
                </label>

                <input type="text"
       name="vehicle_engine_no_existing[]"
       value="<?= htmlspecialchars($engineNo) ?>"
       class="w-full border p-2 rounded">
            </div>

        </div>

    </div>

</div>

<?php endforeach; ?>

</div>

		<!-- ADD VEHICLE -->
		 <?php if ($has_form_data && !empty($new_vehicle_registrations)): ?>

    <?php foreach ($new_vehicle_registrations as $i => $registration): ?>

        <?php
        $newBrandId =
            $new_vehicle_brand_ids[$i] ?? '';

        $newModelId =
            $new_vehicle_model_ids[$i] ?? '';

        $newVariant =
            $new_vehicle_variants[$i] ?? '';

        $newYear =
            $new_vehicle_years[$i] ?? '';

        $newColor =
            $new_vehicle_colors[$i] ?? '';

        $newChassisNo =
            $new_vehicle_chassis_nos[$i] ?? '';

        $newEngineNo =
            $new_vehicle_engine_nos[$i] ?? '';
        ?>

        <div class="vehicleRow grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-4 p-4 border rounded-lg bg-gray-50 relative">

            <button type="button"
                onclick="this.closest('.vehicleRow').remove()"
                class="absolute top-2 right-2 px-2 py-1 bg-red-600 text-white text-xs rounded">
                ✖
            </button>

            <div>
                <label class="font-medium">
                    Registration No
                </label>

                <input
                    name="vehicle_registration_no_new[]"
                    value="<?= htmlspecialchars($registration) ?>"
                    class="border p-2 rounded w-full">
            </div>


            <div>
                <label class="font-medium">
                    Brand
                </label>

                <select
                    name="brand_id_new[]"
                    class="brandSelect border p-2 rounded w-full"
                    required>

                    <option value="">
                        -- Select Brand --
                    </option>

                    <?php foreach ($brands as $b): ?>

                        <option
                            value="<?= (int)$b->brand_id ?>"
                            <?= ((string)$b->brand_id === (string)$newBrandId)
                                ? 'selected'
                                : '' ?>>

                            <?= htmlspecialchars($b->brand_name) ?>

                        </option>

                    <?php endforeach; ?>

                </select>
            </div>


            <div>
                <label class="font-medium">
                    Model
                </label>

                <select
                    name="model_id_new[]"
                    class="modelSelect border p-2 rounded w-full"
                    data-current-model-id="<?= (int)$newModelId ?>"
                    required>

                    <option value="">
                        -- Select Model --
                    </option>

                    <?php if (!empty($newModelId)): ?>

                        <?php
                        $newSelectedModel =
                            $this->Vehicle_model
                                ->get_model_by_id($newModelId);
                        ?>

                        <?php if ($newSelectedModel): ?>

                            <option
                                value="<?= (int)$newModelId ?>"
                                selected>

                                <?= htmlspecialchars(
                                    $newSelectedModel->model_name
                                ) ?>

                            </option>

                        <?php endif; ?>

                    <?php endif; ?>

                </select>
            </div>


            <div>
                <label class="font-medium">
                    Variant
                </label>

                <input
                    name="vehicle_variant_new[]"
                    value="<?= htmlspecialchars($newVariant) ?>"
                    class="border p-2 rounded w-full">
            </div>


            <div>
                <label class="font-medium">
                    Year
                </label>

                <input
                    name="vehicle_year_new[]"
                    value="<?= htmlspecialchars($newYear) ?>"
                    class="border p-2 rounded w-full">
            </div>


            <div>
                <label class="font-medium">
                    Color
                </label>

                <input
                    name="vehicle_color_new[]"
                    value="<?= htmlspecialchars($newColor) ?>"
                    class="border p-2 rounded w-full">
            </div>


            <div>
                <label class="font-medium">
                    VIN No
                </label>

                <input
                    name="vehicle_chassis_no_new[]"
                    value="<?= htmlspecialchars($newChassisNo) ?>"
                    class="border p-2 rounded w-full">
            </div>


            <div>
                <label class="font-medium">
                    Engine No
                </label>

                <input
                    name="vehicle_engine_no_new[]"
                    value="<?= htmlspecialchars($newEngineNo) ?>"
                    class="border p-2 rounded w-full">
            </div>

        </div>

    <?php endforeach; ?>

<?php endif; ?>
	<div class="mt-4">
    <button type="button"
        onclick="addVehicleRow()"
        class="w-full border-2 border-dashed border-green-500 text-green-600 py-3 rounded-xl hover:bg-green-50 font-semibold">
        + Add Another Vehicle
    </button>
</div>

		<br><br>

		<div class="flex flex-wrap gap-3 mt-6">

    <button type="submit"
        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold">
        Update Customer & Vehicles
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
<script>

		$('#customerForm').on('keydown', function(e) {

    if (e.key === 'Enter') {

        // Allow Enter inside textarea
        if ($(e.target).is('textarea')) {
            return;
        }

        // Prevent form submission
        e.preventDefault();

        return false;
    }

});
	let vehiclesToDelete = [];

	function removeVehicleRow(btn, vehicleId = null) {
		if (vehicleId !== null) {
			vehiclesToDelete.push(vehicleId);
		}
		$('#vehiclesToDelete').val(JSON.stringify(vehiclesToDelete));
		btn.closest('.vehicleRow').remove();
	}

	// ADD NEW VEHICLE ROW
	function addVehicleRow() {
		let html = `
    
			<div class="vehicleRow grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-4 p-4 border rounded-lg bg-gray-50 relative">

        <button type="button"
                onclick="this.closest('.vehicleRow').remove()"
                class="absolute top-2 right-2 px-2 py-1 bg-red-600 text-white text-xs rounded">
            ✖
        </button>

        <div>
            <label class="font-medium">Registration No</label>
            <input name="vehicle_registration_no_new[]" class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="font-medium">Brand</label>
            <select name="brand_id_new[]" class="brandSelect border p-2 rounded w-full" required>
                <option value="">-- Select Brand --</option>
                <?php foreach ($brands as $b): ?>
                    <option value="<?= $b->brand_id ?>"><?= $b->brand_name ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="font-medium">Model</label>
            <select name="model_id_new[]" class="modelSelect border p-2 rounded w-full" required>
                <option value="">-- Select Model --</option>
            </select>
        </div>

        <div>
            <label class="font-medium">Variant</label>
            <input name="vehicle_variant_new[]" class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="font-medium">Year</label>
            <input name="vehicle_year_new[]" class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="font-medium">Color</label>
            <input name="vehicle_color_new[]" class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="font-medium">Vin No</label>
            <input name="vehicle_chassis_no_new[]" class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="font-medium">Engine No</label>
            <input name="vehicle_engine_no_new[]" class="border p-2 rounded w-full">
        </div>

    </div>`;
		$('#vehicleRows').append(html);
	}

	// BRAND → MODEL (EVENT DELEGATION)
	$(document).on('change', '.brandSelect', function() {

    let brandId = $(this).val();
    let row = $(this).closest('.vehicleRow');
    let modelSelect = row.find('.modelSelect');
    let yearSelect = row.find('.yearSelect');
    let customInput = row.find('.yearCustomInput');

    // Brand changed — clear stale model + year immediately
    modelSelect.attr('data-current-model-id', '');
    yearSelect.attr('data-current-year', '');
    customInput.val('').addClass('hidden');
    yearSelect.val('').removeClass('hidden')
        .html('<option value="">-- Select Year --</option>');

		modelSelect.html('<option>Loading...</option>');

		if (!brandId) {
			modelSelect.html('<option value="">-- Select Model --</option>');
			return;
		}

    fetch("<?= base_url('index.php/customer/get_models_by_brand/'); ?>" + brandId)
        .then(res => res.json())
        .then(data => {
            let options = '<option value="">-- Select Model --</option>';
            data.forEach(m => {
                options += `<option value="${m.model_id}">${m.model_name}</option>`;
            });
            modelSelect.html(options); // no old model re-selected — user picks fresh
        });
});

	function getSavedYear(row) {

    let yearSelect = row.find('.yearSelect');
    let customInput = row.find('.yearCustomInput');

    let saved =
        customInput.val() ||
        yearSelect.attr('data-current-year') ||
        yearSelect.val() ||
        '';

    return String(saved).trim();
}

	function setYearValue(yearSelect, year) {
		if (!year) {
			yearSelect.val('');
			return false;
		}

		let matched = yearSelect.find('option').filter(function() {
			return String($(this).val()) === String(year);
		});

		if (matched.length) {
			matched.prop('selected', true);
			yearSelect.val(year);
			return true;
		}

		yearSelect.append($('<option>', {
			value: year,
			text: year,
			selected: true
		}));
		yearSelect.val(year);
		return true;
	}

	function applyYearDisplay(row, selectedYear) {
		let yearSelect = row.find('.yearSelect');
		let customInput = row.find('.yearCustomInput');

		if (!selectedYear) {
			yearSelect.removeClass('hidden').prop('disabled', false);
			customInput.addClass('hidden').val('');
			return;
		}

		if (setYearValue(yearSelect, selectedYear)) {
			yearSelect.removeClass('hidden').prop('disabled', false);
			customInput.addClass('hidden').val('');
		} else {
			yearSelect.addClass('hidden').val('').prop('disabled', false);
			customInput.removeClass('hidden').val(selectedYear);
		}
	}

	function loadYearsForRow(row, selectedYear, keepExisting) {
		let modelId = row.find('.modelSelect').val();
		let yearSelect = row.find('.yearSelect');

		selectedYear = selectedYear || getSavedYear(row);

		if (!modelId) {
			applyYearDisplay(row, selectedYear);
			return;
		}

		if (!keepExisting) {
			yearSelect.prop('disabled', true).html('<option value="">Loading...</option>');
		}

        fetch("<?= base_url('index.php/customer/get_years_by_model/'); ?>" + encodeURIComponent(String(modelId)), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(function (res) {
                if (!res.ok) throw new Error('HTTP ' + res.status);
                return res.json();
            })
            .then(data => {
				let options = '<option value="">-- Select Year --</option>';
				let yearFound = false;

                // Support different response shapes
                if (Array.isArray(data) && data.length) {
                    data.forEach(y => {
                        if (!y.model_year && y.model_year !== 0) return;

                        let isSelected = String(selectedYear) === String(y.model_year);
                        if (isSelected) yearFound = true;

                        options += `<option value="${y.model_year}"${isSelected ? ' selected' : ''}>${y.model_year}</option>`;
                    });
                } else if (data && Array.isArray(data.data) && data.data.length) {
                    data.data.forEach(y => {
                        if (!y.model_year && y.model_year !== 0) return;

                        let isSelected = String(selectedYear) === String(y.model_year);
                        if (isSelected) yearFound = true;

                        options += `<option value="${y.model_year}"${isSelected ? ' selected' : ''}>${y.model_year}</option>`;
                    });
                }

				if (selectedYear && !yearFound) {
					options += `<option value="${selectedYear}" selected>${selectedYear}</option>`;
				}

				options += '<option disabled>──────────────</option>';
				options += '<option value="add_year">+ Add New Year</option>';

				yearSelect.prop('disabled', false).removeClass('hidden').html(options);
				applyYearDisplay(row, selectedYear);
			})
			.catch(() => {
				if (!keepExisting) {
					yearSelect.html('<option value="">-- Select Year --</option>');
				}
				applyYearDisplay(row, selectedYear);
			});
	}

	$(document).ready(function() {
		$('.vehicleRow').each(function() {
			loadYearsForRow($(this), getSavedYear($(this)), true);
		});
	});

	$(document).on('change', '.modelSelect', function() {

    let row = $(this).closest('.vehicleRow');
    let modelId = $(this).val();
    let yearSelect = row.find('.yearSelect');
    let customInput = row.find('.yearCustomInput');

    row.find('.modelSelect').attr('data-current-model-id', modelId);

    // Model changed — clear previous year, never carry it over
    yearSelect.attr('data-current-year', '');
    customInput.val('').addClass('hidden');
    yearSelect.val('').removeClass('hidden')
        .html('<option value="">-- Select Year --</option>');

    loadYearsForRow(row, '', false);
});

	$(document).on('change', '.yearSelect', function() {
		let row = $(this).closest('.vehicleRow');
		let customInput = row.find('.yearCustomInput');
		let yearSelect = $(this);

		if (yearSelect.val() === 'add_year') {
			yearSelect.addClass('hidden').val('');
			customInput.removeClass('hidden').focus().val('');
		} else if (yearSelect.val()) {
			yearSelect.attr('data-current-year', yearSelect.val());
			customInput.val('').addClass('hidden');
			yearSelect.removeClass('hidden');
		}
	});

	$(document).on('blur', '.yearCustomInput', function() {
		let row = $(this).closest('.vehicleRow');
		let yearSelect = row.find('.yearSelect');
		let value = $(this).val().trim();

		if (value && value.length === 4) {
			row.find('.yearSelect').attr('data-current-year', value);
			yearSelect.addClass('hidden');
		} else if (!value) {
			yearSelect.removeClass('hidden').val('');
			$(this).addClass('hidden');
		}
	});

	$(document).on('keypress', '.yearCustomInput', function(e) {
		if (e.which === 13) {
			$(this).blur();
		}
	});

	$('form').on('submit', function() {
		$('.vehicleRow').each(function() {
			let customInput = $(this).find('.yearCustomInput');
			let yearSelect = $(this).find('.yearSelect');

			if (customInput.length && !customInput.hasClass('hidden') && customInput.val()) {
				let year = customInput.val().trim();
				yearSelect.attr('data-current-year', year);
				if (!yearSelect.find('option[value="' + year + '"]').length) {
					yearSelect.append(`<option value="${year}">${year}</option>`);
				}
				yearSelect.val(year);
			}
		});
	});
</script>