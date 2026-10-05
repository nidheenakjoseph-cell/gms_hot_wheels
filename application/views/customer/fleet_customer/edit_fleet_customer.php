<style>
    option[data-special="true"] {
        font-weight: 600;
        color: #16a34a;
    }
</style>

<div class="w-full bg-white rounded-2xl shadow-md p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Fleet Customer</h2>

    <form method="POST" action="<?= base_url('index.php/Customer/update_fleet'); ?>" onsubmit="return preventDoubleSubmit(this);">

        <input type="hidden" name="customer_id" value="<?= $customer->customer_id ?>">
        <input type="hidden" id="vehicles_to_delete" name="vehicles_to_delete" value="[]">

        <!-- COMPANY DETAILS -->
        <h3 class="text-xl font-semibold mb-3">Company Details</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <div>
                <label class="font-medium">Branch <span class="text-red-500">*</span></label>
                <?= render_branch_select_dropdown('branch_id', isset($customer->branch_id) ? $customer->branch_id : null) ?>
            </div>

            <div>
                <label class="font-medium">Company Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" required class="w-full border p-2 rounded"
                    value="<?= htmlspecialchars($customer->name) ?>">
            </div>

            <div>
                <label class="font-medium">Contact Person</label>
                <input type="text" name="company_contact_person" class="w-full border p-2 rounded"
                    value="<?= htmlspecialchars($customer->company_contact_person ?? '') ?>">
            </div>

            <div>
                <label class="font-medium">Phone</label>
                <input type="number" name="phone" class="w-full border p-2 rounded"
                    value="<?= htmlspecialchars($customer->phone ?? '') ?>">
            </div>

            <div>
                <label class="font-medium">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded"
                    value="<?= htmlspecialchars($customer->email ?? '') ?>">
            </div>

            <div>
                <label class="font-medium">Address</label>
                <textarea name="address" class="w-full border p-2 rounded"><?= htmlspecialchars($customer->address ?? '') ?></textarea>
            </div>

            <div>
                <label class="font-medium">Emirate</label>
                <select name="emirate" class="w-full border p-2 rounded">
                    <option value="">-- Select Emirate --</option>
                    <?php
                    $emirates = ['Abu Dhabi','Dubai','Sharjah','Ajman','Umm Al Quwain','Ras Al Khaimah','Fujairah'];
                    foreach ($emirates as $e): ?>
                        <option value="<?= $e ?>" <?= ($customer->emirates ?? '') === $e ? 'selected' : '' ?>>
                            <?= $e ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="font-medium">TRN</label>
                <input type="text" name="trn" class="w-full border p-2 rounded"
                    value="<?= htmlspecialchars($customer->trn ?? '') ?>">
            </div>

            <div>
                <label class="font-medium">Credit Limit (AED)</label>
                <input type="number" step="0.01" min="0" name="credit_limit" class="w-full border p-2 rounded"
                    value="<?= $customer->credit_limit ?? '0.00' ?>">
            </div>

            <div>
                <label class="font-medium">Payment Terms (Days)</label>
                <input type="number" min="0" name="payment_terms" class="w-full border p-2 rounded"
                    value="<?= $customer->payment_terms ?? '0' ?>">
            </div>

        </div>

        <hr class="my-6">

        <!-- EXISTING VEHICLES -->
        <h3 class="text-xl font-semibold mb-3">Vehicle Details</h3>

        <div id="existingVehicleRows">
            <?php foreach ($vehicles as $v): ?>
                <div class="vehicleRow grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-4 p-4 border rounded-lg bg-gray-50 relative"
                    data-vehicle-id="<?= $v->vehicle_id ?>">

                    <span class="absolute top-2 left-3 text-xs text-gray-400 font-medium">Existing Vehicle</span>

                    <button type="button"
                        onclick="removeExistingRow(this, <?= $v->vehicle_id ?>)"
                        class="absolute top-2 right-2 px-2 py-1 bg-red-600 text-white text-xs rounded">
                        ✖
                    </button>

                    <input type="hidden" name="vehicle_id_existing[]" value="<?= $v->vehicle_id ?>">

                    <div class="mt-4">
                        <label class="font-medium">Registration No</label>
                        <input name="vehicle_registration_no_existing[]" class="border p-2 rounded w-full"
                            value="<?= htmlspecialchars($v->registration_no ?? '') ?>">
                    </div>

                    <div class="mt-4">
                        <label class="font-medium">Brand</label>
                        <select name="brand_id_existing[]" class="brandSelectExisting w-full border p-2 rounded" required
                            data-selected-brand="<?= $v->brand_id ?>"
                            data-selected-model="<?= $v->model_id ?>">
                            <option value="">-- Select Brand --</option>
                            <?php foreach ($brands as $b): ?>
                                <option value="<?= $b->brand_id ?>" <?= $v->brand_id == $b->brand_id ? 'selected' : '' ?>>
                                    <?= $b->brand_name ?>
                                </option>
                            <?php endforeach; ?>
                            <option disabled>────────────────</option>
                            <option value="add_brand" data-special="true">+ Add New Brand</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <label class="font-medium">Model</label>
                        <select name="model_id_existing[]" class="modelSelectExisting w-full border p-2 rounded" required>
                            <option value="<?= $v->model_id ?>"><?= htmlspecialchars($v->model ?? 'Loading...') ?></option>
                            <option disabled>────────────────</option>
                            <option value="add_model" data-special="true">+ Add Model</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <label class="font-medium">Variant</label>
                        <input name="vehicle_variant_existing[]" class="border p-2 rounded w-full"
                            value="<?= htmlspecialchars($v->variant ?? '') ?>">
                    </div>

                    <div>
                        <label class="font-medium">Year</label>
                        <input type="number" name="vehicle_year_existing[]" class="border p-2 rounded w-full"
                            value="<?= $v->year ?? '' ?>">
                    </div>

                    <div>
                        <label class="font-medium">Color</label>
                        <input name="vehicle_color_existing[]" class="border p-2 rounded w-full"
                            value="<?= htmlspecialchars($v->color ?? '') ?>">
                    </div>

                    <div>
                        <label class="font-medium">VIN No</label>
                        <input name="vehicle_chassis_no_existing[]" class="border p-2 rounded w-full" required
                            value="<?= htmlspecialchars($v->chassis_no ?? '') ?>">
                    </div>

                    <div>
                        <label class="font-medium">Engine No</label>
                        <input name="vehicle_engine_no_existing[]" class="border p-2 rounded w-full"
                            value="<?= htmlspecialchars($v->engine_no ?? '') ?>">
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <!-- NEW VEHICLE ROWS -->
        <div id="newVehicleRows"></div>

        <button type="button" onclick="addNewVehicleRow()"
            class="px-4 py-2 bg-green-600 text-white rounded mt-2">
            + Add Another Vehicle
        </button>

        <br><br>

        <a href="<?= base_url('index.php/customer/fleet_list') ?>"
            class="px-6 py-2 bg-gray-400 text-white rounded mr-2">
            Cancel
        </a>

        <button type="submit" id="saveBtn" class="px-6 py-2 bg-blue-600 text-white rounded">
            Update Fleet Customer
        </button>

    </form>
</div>

<!-- Brand Modal -->
<div id="brandModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded w-[90%] max-w-md">
        <h3 class="font-bold mb-3">Add Brand</h3>
        <input type="text" id="newBrandName" class="w-full border p-2 mb-4">
        <button onclick="saveBrand()" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
        <button onclick="closeBrandModal()" class="ml-2 px-4 py-2">Cancel</button>
    </div>
</div>

<!-- Model Modal -->
<div id="modelModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded w-[90%] max-w-md">
        <h3 class="text-lg font-bold mb-4">Add Vehicle Model</h3>

        <label class="font-medium">Brand <span class="text-red-500">*</span></label>
        <select id="modelBrandSelect" class="w-full border p-2 rounded mb-3" required>
            <option value="">-- Select Brand --</option>
            <?php foreach ($brands as $b): ?>
                <option value="<?= $b->brand_id ?>"><?= $b->brand_name ?></option>
            <?php endforeach; ?>
        </select>

        <label class="font-medium">Model Name <span class="text-red-500">*</span></label>
        <input type="text" id="newModelName" class="w-full border p-2 rounded mb-4" placeholder="Eg: Corolla, City, Creta">

        <div class="text-right">
            <button onclick="saveModel()" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
            <button onclick="closeModelModal()" class="ml-2 px-4 py-2">Cancel</button>
        </div>
    </div>
</div>

<script>

let deletedVehicleIds = [];

function removeExistingRow(btn, vehicleId) {
    let rows = document.querySelectorAll('#existingVehicleRows .vehicleRow');
    let newRows = document.querySelectorAll('#newVehicleRows .vehicleRow');
    if (rows.length + newRows.length <= 1) {
        alert("At least one vehicle is required.");
        return;
    }
    deletedVehicleIds.push(vehicleId);
    document.getElementById('vehicles_to_delete').value = JSON.stringify(deletedVehicleIds);
    btn.closest('.vehicleRow').remove();
}

function removeNewRow(btn) {
    let rows = document.querySelectorAll('#existingVehicleRows .vehicleRow');
    let newRows = document.querySelectorAll('#newVehicleRows .vehicleRow');
    if (rows.length + newRows.length <= 1) {
        alert("At least one vehicle is required.");
        return;
    }
    btn.closest('.vehicleRow').remove();
}


function addNewVehicleRow() {
    let brandsHtml = `<option value="">-- Select Brand --</option>`;
    <?php foreach ($brands as $b): ?>
        brandsHtml += `<option value="<?= $b->brand_id ?>"><?= addslashes($b->brand_name) ?></option>`;
    <?php endforeach; ?>
    brandsHtml += `<option disabled>────────────────</option>`;
    brandsHtml += `<option value="add_brand" data-special="true">+ Add New Brand</option>`;

    let html = `
    <div class="vehicleRow grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-4 p-4 border rounded-lg bg-green-50 relative">

        <span class="absolute top-2 left-3 text-xs text-green-600 font-medium">New Vehicle</span>

        <button type="button" onclick="removeNewRow(this)"
            class="absolute top-2 right-2 px-2 py-1 bg-red-600 text-white text-xs rounded">✖</button>

        <div class="mt-4">
            <label class="font-medium">Registration No</label>
            <input name="vehicle_registration_no_new[]" class="border p-2 rounded w-full" placeholder="A 12345">
        </div>

        <div class="mt-4">
            <label class="font-medium">Brand</label>
            <select name="brand_id_new[]" class="brandSelectNew w-full border p-2 rounded" required>
                ${brandsHtml}
            </select>
        </div>

        <div class="mt-4">
            <label class="font-medium">Model</label>
            <select name="model_id_new[]" class="modelSelectNew w-full border p-2 rounded" required>
                <option value="">-- Select Model --</option>
                <option disabled>────────────────</option>
                <option value="add_model" data-special="true">+ Add Model</option>
            </select>
        </div>

        <div class="mt-4">
            <label class="font-medium">Variant</label>
            <input name="vehicle_variant_new[]" class="border p-2 rounded w-full" placeholder="Diesel / ZX">
        </div>

        <div>
            <label class="font-medium">Year</label>
            <input type="number" name="vehicle_year_new[]" class="border p-2 rounded w-full" placeholder="2020">
        </div>

        <div>
            <label class="font-medium">Color</label>
            <input name="vehicle_color_new[]" class="border p-2 rounded w-full" placeholder="White">
        </div>

        <div>
            <label class="font-medium">VIN No</label>
            <input name="vehicle_chassis_no_new[]" class="border p-2 rounded w-full" placeholder="VIN Number" required>
        </div>

        <div>
            <label class="font-medium">Engine No</label>
            <input name="vehicle_engine_no_new[]" class="border p-2 rounded w-full" placeholder="Engine Number">
        </div>
    </div>`;

    document.getElementById('newVehicleRows').insertAdjacentHTML('beforeend', html);
}

$(document).ready(function () {
    $('#existingVehicleRows .brandSelectExisting').each(function () {
        let brandId      = $(this).data('selected-brand');
        let selectedModel = $(this).data('selected-model');
        let modelSelect  = $(this).closest('.vehicleRow').find('.modelSelectExisting');

        if (!brandId) return;

        fetch("<?= base_url('index.php/customer/get_models_by_brand/') ?>" + brandId)
            .then(res => res.json())
            .then(data => {
                let options = '<option value="">-- Select Model --</option>';
                data.forEach(m => {
                    let sel = m.model_id == selectedModel ? 'selected' : '';
                    options += `<option value="${m.model_id}" ${sel}>${m.model_name}</option>`;
                });
                options += '<option disabled>────────────────</option>';
                options += '<option value="add_model" data-special="true">+ Add Model</option>';
                modelSelect.html(options);
            });
    });
});


$(document).on('change', '.brandSelectExisting', function () {
    let val = $(this).val();

    if (val === 'add_brand') {
        $('#brandModal').removeClass('hidden');
        $(this).val('');
        return;
    }

    let modelSelect = $(this).closest('.vehicleRow').find('.modelSelectExisting');
    modelSelect.html('<option value="">Loading...</option>');

    if (!val) {
        modelSelect.html('<option value="">-- Select Model --</option>');
        return;
    }

    fetch("<?= base_url('index.php/customer/get_models_by_brand/') ?>" + val)
        .then(res => res.json())
        .then(data => {
            let options = '<option value="">-- Select Model --</option>';
            data.forEach(m => {
                options += `<option value="${m.model_id}">${m.model_name}</option>`;
            });
            options += '<option disabled>────────────────</option>';
            options += '<option value="add_model" data-special="true">+ Add Model</option>';
            modelSelect.html(options);
        });
});


$(document).on('change', '.brandSelectNew', function () {
    let val = $(this).val();

    if (val === 'add_brand') {
        $('#brandModal').removeClass('hidden');
        $(this).val('');
        return;
    }

    let modelSelect = $(this).closest('.vehicleRow').find('.modelSelectNew');
    modelSelect.html('<option value="">Loading...</option>');

    if (!val) {
        modelSelect.html('<option value="">-- Select Model --</option>');
        return;
    }

    fetch("<?= base_url('index.php/customer/get_models_by_brand/') ?>" + val)
        .then(res => res.json())
        .then(data => {
            let options = '<option value="">-- Select Model --</option>';
            data.forEach(m => {
                options += `<option value="${m.model_id}">${m.model_name}</option>`;
            });
            options += '<option disabled>────────────────</option>';
            options += '<option value="add_model" data-special="true">+ Add Model</option>';
            modelSelect.html(options);
        });
});


$(document).on('change', '.modelSelectExisting, .modelSelectNew', function () {
    if ($(this).val() === 'add_model') {
        $('#modelModal').removeClass('hidden');
        $(this).val('');
    }
});


function saveBrand() {
    $.post('<?= base_url("index.php/SpareParts/save_brand") ?>', { name: $('#newBrandName').val() },
        function () { location.reload(); }
    );
}

function saveModel() {
    let brandId   = $('#modelBrandSelect').val();
    let modelName = $('#newModelName').val();
    if (!brandId || !modelName) { alert('Brand and Model Name are required'); return; }

    $.post('<?= base_url("index.php/SpareParts/save_model") ?>',
        { brand_id: brandId, name: modelName },
        function () {
            closeModelModal();

            $('.brandSelectExisting').last().trigger('change');
            $('.brandSelectNew').last().trigger('change');
        }
    );
}

function closeBrandModal()  { $('#brandModal').addClass('hidden');  }
function closeModelModal()  { $('#modelModal').addClass('hidden');  }


var isSubmitting = false;
function preventDoubleSubmit(form) {
    if (isSubmitting) return false;
    isSubmitting = true;
    document.getElementById('saveBtn').disabled  = true;
    document.getElementById('saveBtn').innerText = 'Saving...';
    return true;
}
</script>