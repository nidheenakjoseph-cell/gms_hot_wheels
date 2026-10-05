<style>
	.report-preview-item {
    position: relative;
}

.report-preview-item img {
    width: 100%;
    height: 128px;
    object-fit: cover;
    border: 1px solid #d1d5db;
    border-radius: 6px;
}

.report-preview-delete {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #dc2626;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.report-preview-delete:hover {
    background: #b91c1c;
}
</style>
<?php
// $totalItems = count($items);
// $half = ceil($totalItems / 2);

// $leftItems  = array_slice($items, 0, $half);
// $rightItems = array_slice($items, $half);
$categoryPercentages = [];

foreach ($grouped_items as $category => $items)
{
    $score = 0;
    $maxScore = count($items) * 100;

    foreach ($items as $item)
    {
        $status = $item_results[$item->item_id] ?? '';

        if ($status == 'A')
            $score += 100;
        elseif ($status == 'C')
            $score += 50;
    }

    $categoryPercentages[$category] = $maxScore > 0
        ? round(($score / $maxScore) * 100)
        : 0;
}
// $categoryPercentages = [];

// foreach ($grouped_items as $category => $items)
// {
//     $total = count($items);
//     $acceptable = 0;

//     foreach ($items as $item)
//     {
//         $status = $item_results[$item->item_id] ?? '';

//         // Count Acceptable items
//         if ($status == 'A')
//         {
//             $acceptable++;
//         }
//     }

//     $categoryPercentages[$category] = $total > 0
//         ? round(($acceptable / $total) * 100)
//         : 0;
// }
$categoryBlocks = [];

foreach ($grouped_items as $category => $items)
{
    $categoryBlocks[] = [
        'type' => 'category',
        'title' => $category
    ];

    foreach ($items as $item)
    {
        $categoryBlocks[] = [
            'type' => 'item',
            'data' => $item
        ];
    }
}
 
$totalItems = count($categoryBlocks);
$half = ceil($totalItems / 2);

$leftItems  = array_slice($categoryBlocks, 0, $half);
$rightItems = array_slice($categoryBlocks, $half);
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<style>
	.modal-overlay {
		position: fixed;
		inset: 0;
		background: rgba(0, 0, 0, 0.6);
		display: none;
		align-items: center;
		justify-content: center;
		z-index: 9999;
	}

	.modal-overlay.show {
		display: flex;
	}

	.modal-box {
		background: white;
		border-radius: 12px;
		padding: 16px;
		position: relative;
	}
</style>

<div class="w-full bg-white rounded-2xl shadow-md p-6">


	<form  method="post" enctype="multipart/form-data" action="<?= base_url('index.php/inspection/save'); ?>" class="p-6 bg-white">
	<?php if ($this->session->flashdata('inspection_upload_error')): ?>

    <div class="mb-5 rounded-lg border border-red-300 bg-red-50 p-4">

        <div class="flex items-start gap-3">

            <div class="flex-shrink-0">
                <div class="w-8 h-8 rounded-full bg-red-100
                            flex items-center justify-center">
                    <span class="text-red-600 font-bold">!</span>
                </div>
            </div>

            <div class="flex-1">

                <h4 class="font-bold text-red-800">
                    Image Upload Failed
                </h4>

                <p class="text-sm text-red-700 mt-1">
                    <?= html_escape(
                        $this->session->flashdata('inspection_upload_error')
                    ) ?>
                </p>

                <p class="text-xs text-red-600 mt-2">
                    Allowed formats: JPG, JPEG, PNG and WEBP.
                    Maximum file size: 5 MB per image.
                </p>

            </div>

        </div>

    </div>

<?php endif; ?>


<?php if ($this->session->flashdata('inspection_success')): ?>

    <div class="mb-5 rounded-lg border border-green-300 bg-green-50 p-4">

        <div class="flex items-center gap-3">

            <div class="w-8 h-8 rounded-full bg-green-100
                        flex items-center justify-center">
                <span class="text-green-600 font-bold">✓</span>
            </div>

            <div>
                <h4 class="font-bold text-green-800">
                    Inspection Saved
                </h4>

                <p class="text-sm text-green-700">
                    <?= html_escape(
                        $this->session->flashdata('inspection_success')
                    ) ?>
                </p>
            </div>

        </div>

    </div>

<?php endif; ?>	
	<input type="hidden" name="inspection_id" value="<?= $inspection_id ?>">

		<div class="page-header flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">


			<h2 class="text-xl font-bold">
				VEHICLE HEALTH CHECK (Inventory)
			</h2>
			<div class="flex flex-col sm:flex-row gap-2">



				<a href="<?= base_url('index.php/Inspection/view/' . $inspection_id) ?>" class="px-6 py-2 bg-gray-400 text-white rounded">
					View & Print
				</a>


				<?php if (!empty($inspection) && !empty($inspection->appointment_id)) { ?>

					<a href="<?= base_url('index.php/Estimation/create/' . $inspection->appointment_id) ?>"
						class="px-6 py-2 bg-green-600 text-white rounded">
						Estimation
					</a>

				<?php } elseif (!empty($inspection) && !empty($inspection->inspection_id)) { ?>

					<a href="<?= base_url('index.php/Estimation/create_inspection/' . $inspection->inspection_id) ?>"
						class="px-6 py-2 bg-green-600 text-white rounded">
						Estimation
					</a>

				<?php } ?>


				<!-- SAVE BUTTON -->
				<button type="button"
					id="editInspectionBtn"
					onclick="enableInspectionEdit()"
					class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded">
					Edit
				</button>
 
				<button type="submit"
					id="updateInspectionBtn"
					class="hidden w-full sm:w-auto px-6 py-2 bg-green-600 text-white rounded">
					Update
				</button>

				<button type="button"
					id="cancelInspectionBtn"
					onclick="cancelInspectionEdit()"
					class="hidden w-full sm:w-auto px-6 py-2 bg-gray-500 text-white rounded">
					Cancel Edit
				</button>

				<a href="<?= base_url('index.php/Inspection'); ?>"
					class="w-full sm:w-auto px-6 py-2 bg-gray-300 rounded">Cancel</a>
			</div>
		</div>
		<hr class="border-gray-300 mb-6">

		<label id="revisionCheckboxWrap"
			class="hidden flex flex-wrap items-center gap-4 mt-3 px-4 py-3 
           bg-yellow-50 border border-yellow-400 rounded-lg
           text-yellow-800 font-semibold shadow-sm">

			<!-- checkbox -->
			<div class="flex items-center gap-2">
				<input type="checkbox"
					name="create_revision"
					value="1"
					class="w-5 h-5 accent-yellow-600 cursor-pointer">

				<span>Create Revision</span>
			</div>

			<!-- Last Revision -->
			<div class="flex items-center gap-2 ml-4">
				<span class="text-sm font-medium text-yellow-900">
					Last Rev:
				</span>

				<input type="text"
					value="<?= isset($inspection->revision_no) ? $inspection->revision_no : 1 ?>"
			readonly
					class="w-16 px-2 py-1 text-center font-bold
                   bg-gray-100 border border-gray-400
                   rounded-md text-gray-800">
			</div>

			<!-- Next Revision -->
			<div class="flex items-center gap-2">
				<span class="text-sm font-medium text-yellow-900">
					Next Rev:
				</span>

				<input type="text"
					name="revision_no"
					value="<?= isset($inspection->revision_no) ? $inspection->revision_no + 1 : 1 ?>"
			readonly
					readonly
					class="w-16 px-2 py-1 text-center font-bold
                   bg-yellow-100 border border-yellow-500
                   rounded-md text-yellow-900">
			</div>

		</label>
		<!-- CUSTOMER / VEHICLE INFO -->
		<div class="overflow-x-auto">

    <table class="w-full border mb-4 text-sm">
        <tr>
            <!-- LEFT SIDE : CUSTOMER INFO -->
            <td style="width:75%; vertical-align:top; padding:0;">

                <table class="w-full">
                    <tr>
                        <td class="border p-1 font-bold">Doc. No</td>
                        <td class="border p-1">
                            <?= $appointment->doc_no ?? ('VIN-' . str_pad($inspection_id, 6, '0', STR_PAD_LEFT)) ?>
                        </td>

                        <td class="border p-1 font-bold">Doc. Date</td>
                        <td class="border p-1"><?= date('d/M/Y') ?></td>
                    </tr>
				<tr>
					<td class="border p-1 font-bold">Branch</td>
					<td class="border p-1" colspan="3">
						<?= render_branch_select_dropdown('branch_id', isset($inspection->branch_id) ? $inspection->branch_id : (isset($appointment->branch_id) ? $appointment->branch_id : null)) ?>
					</td>
				</tr>
                       <td class="border p-1 font-bold">Customer Name</td>
				        <td class="border p-1"><?= $appointment->customer_name ?? $customer->name ?></td>

                        <td class="border p-1 font-bold">Plate No.</td>
                        <td class="border p-1"><?= $appointment->registration_no ?? $vehicle->registration_no ?></td>
                    </tr>

                    <tr>
                        <td class="border p-1 font-bold">Contact No.</td>
                        <td class="border p-1"><?= $appointment->phone ?? $customer->phone ?></td>

                        <td class="border p-1 font-bold">Make</td>
                        <td class="border p-1"><?= $appointment->model ?? $vehicle->model ?></td>
                    </tr>

                    <tr>
                        <td class="border p-1 font-bold">Driver Name</td>
                        <td class="border p-1">
                            <input type="text" name="driver_name"
                                value="<?= $inspection->drivername ?>"
                                class="w-full border px-2 py-1 edit-field">
                        </td>

                        <td class="border p-1 font-bold">Veh. Type</td>
                        <td class="border p-1"><?= $appointment->variant ?? $vehicle->variant ?></td>
                    </tr>

                    <tr>
                        <td class="border p-1 font-bold">Driver Mobile</td>
                        <td class="border p-1">
                            <input type="number" name="driver_mobile"
                                value="<?= $inspection->driverphno ?>"
                                class="w-full border px-2 py-1 edit-field">
                        </td>

                        <td class="border p-1 font-bold">Year</td>
                        <td class="border p-1"><?= $appointment->year ?? $vehicle->year ?></td>
                    </tr>

                    <tr>
                        <td class="border p-1 font-bold">Service Advisor</td>
                        <td class="border p-1"><?= $this->session->userdata('username') ?></td>

                        <td class="border p-1 font-bold">KM</td>
                        <td class="border p-1">
                            <input type="number"
								name="km_reading"
								value="<?= htmlspecialchars($inspection->km_reading ?? '') ?>"
								step="0.01"
								min="0"
								class="w-full border px-2 py-1 edit-field">
                        </td>
                    </tr>

                </table>

            </td>

            <!-- RIGHT SIDE : VEHICLE IMAGE -->
            <td style="width:25%; vertical-align:top;" class="border">

                <div class="p-2 text-center">

                    <div class="font-semibold text-gray-700 mb-2">
                        Vehicle Image
                    </div>

                    <?php if (!empty($vehicle->model_image)) : ?>

                        <img src="<?= base_url($vehicle->model_image) ?>"
                            onclick="openImageModal(this.src)"
                            class="w-full max-h-[220px] object-contain rounded border cursor-pointer hover:shadow-lg">

                    <?php else : ?>

                        <div class="h-[220px] flex items-center justify-center bg-gray-100 rounded border text-gray-400">
                            No Image
                        </div>

                    <?php endif; ?>

                </div>

            </td>
        </tr>
    </table>

</div>
<!-- VEHICLE MODEL IMAGE -->

<!-- <?php if (!empty($vehicle->model_image)): ?>
	<div class="lg:col-span-4">
    <label class="font-medium block mb-2">
        Vehicle Model Image
    </label>

    <?php if (!empty($vehicle->model_image)) : ?>
        <div class="border rounded-xl p-3 bg-white">
            <img src="<?= base_url($vehicle->model_image) ?>"
                class="mx-auto max-h-56 object-contain rounded-lg cursor-pointer"
                onclick="window.open(this.src,'_blank')">
        </div>
    <?php else : ?>
        <div class="border border-dashed rounded-xl p-8 text-center text-gray-500 bg-gray-50">
            No vehicle image available
        </div>
    <?php endif; ?>
</div> -->
<!-- <div class="mt-4 mb-6">

    <h4 class="font-bold mb-2">
        Vehicle Model Image
    </h4>

    <div class="border rounded-lg p-3 inline-block bg-gray-50">

        <img
            src="<?= base_url($vehicle->model_image) ?>"
            alt="<?= $vehicle->model ?>"
            class="max-w-md w-full h-auto rounded shadow cursor-pointer"
            onclick="openImageModal(this.src)">

        <div class="mt-2 text-center text-sm text-gray-600">
            <?= $vehicle->model ?>
        </div>

    </div>

</div> -->
<!-- <?php endif; ?> -->

		<!-- INSPECTION ITEMS -->

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-4 text-sm">


			<!-- LEFT TABLE -->
			<div class="overflow-x-auto">
				<table class="w-full border min-w-[400px]">
					<thead class="bg-gray-100">
						<tr>
							<th class="border p-1">Inspection Items</th>
							<th class="border p-1 w-8">A</th>
							<th class="border p-1 w-8">C</th>
							<th class="border p-1 w-8">S</th>
						</tr>
					</thead>
					<tbody>
						<?php
$slno = 1;

foreach ($leftItems as $row):
static $firstCategory = true;

if($row['type'] == 'category'):

    if(!$firstCategory):
?>
        <tr>
            <td colspan="4" style="height:15px; border:none;"></td>
        </tr>
<?php
    endif;

    $firstCategory = false;
?>
    <tr>
    <td colspan="4"
        class="bg-gray-700 text-white font-bold p-2 text-lg flex justify-between">

        <span><?= strtoupper($row['title']) ?></span>

        <span class="float-right">
            <?= $categoryPercentages[$row['title']] ?? 0 ?>%
        </span>

    </td>
</tr>
<?php
continue;
endif;

$i = $row['data'];
?>
<tr>
    <td class="border p-1">
        <?= $slno++ ?>. <?= $i->item_name ?>
    </td>

    <td class="border text-center">
        <input type="radio"
               class="edit-field"
               name="item_status[<?= $i->item_id ?>]"
               value="A"
               <?= ($item_results[$i->item_id] ?? '') == 'A' ? 'checked' : '' ?>>
    </td>

    <td class="border text-center">
        <input type="radio"
               class="edit-field"
               name="item_status[<?= $i->item_id ?>]"
               value="C"
               <?= ($item_results[$i->item_id] ?? '') == 'C' ? 'checked' : '' ?>>
    </td>

    <td class="border text-center">
        <input type="radio"
               class="edit-field"
               name="item_status[<?= $i->item_id ?>]"
               value="S"
               <?= ($item_results[$i->item_id] ?? '') == 'S' ? 'checked' : '' ?>>
    </td>
</tr>

<?php endforeach; ?>
						
					</tbody>
				</table>
			</div>

			<!-- RIGHT TABLE -->
			<div class="overflow-x-auto">
				<table class="w-full border min-w-[400px]">
					<thead class="bg-gray-100">
						<tr>
							<th class="border p-1">Inspection Items</th>
							<th class="border p-1 w-8">A</th>
							<th class="border p-1 w-8">C</th>
							<th class="border p-1 w-8">S</th>
						</tr>
					</thead>
					<tbody>
						<?php

foreach ($rightItems as $row):

static $firstCategory = true;

if($row['type'] == 'category'):

    if(!$firstCategory):
?>
        <tr>
            <td colspan="4" style="height:15px; border:none;"></td>
        </tr>
<?php
    endif;

    $firstCategory = false;
?>
    <tr>
    <td colspan="4"
        class="bg-gray-700 text-white font-bold p-2 text-lg flex justify-between">

        <span><?= strtoupper($row['title']) ?></span>

        <span class="float-right">
            <?= $categoryPercentages[$row['title']] ?? 0 ?>%
        </span>

    </td>
</tr>
<?php
continue;
endif;

$i = $row['data'];
?>
<tr>

    <td class="border p-1">
        <?= $slno++ ?>. <?= $i->item_name ?>
    </td>

    <td class="border text-center">
        <input type="radio"
               class="edit-field"
               name="item_status[<?= $i->item_id ?>]"
               value="A"
               <?= ($item_results[$i->item_id] ?? '') == 'A' ? 'checked' : '' ?>>
    </td>

    <td class="border text-center">
        <input type="radio"
               class="edit-field"
               name="item_status[<?= $i->item_id ?>]"
               value="C"
               <?= ($item_results[$i->item_id] ?? '') == 'C' ? 'checked' : '' ?>>
    </td>

    <td class="border text-center">
        <input type="radio"
               class="edit-field"
               name="item_status[<?= $i->item_id ?>]"
               value="S"
               <?= ($item_results[$i->item_id] ?? '') == 'S' ? 'checked' : '' ?>>
    </td>

</tr>

<?php endforeach; ?>
						<!-- <?php foreach ($rightItems as $index => $i): ?> -->
							<!-- <tr>
								<td class="border p-1">
									<?= ($half + $index + 1) ?>. <?= $i->item_name ?>
								</td>
								<td class="border text-center">
									<input type="radio" class="edit-field"
										name="item_status[<?= $i->item_id ?>]"
										value="A" <?= ($item_results[$i->item_id] ?? '') == 'A' ? 'checked' : '' ?>>
								</td>
								<td class="border text-center">
									<input type="radio" class="edit-field"
										name="item_status[<?= $i->item_id ?>]"
										value="C" <?= ($item_results[$i->item_id] ?? '') == 'C' ? 'checked' : '' ?>>
								</td>
								<td class="border text-center">
									<input type="radio" class="edit-field"
										name="item_status[<?= $i->item_id ?>]"
										value="S" <?= ($item_results[$i->item_id] ?? '') == 'S' ? 'checked' : '' ?>>
								</td>
							</tr> -->
						<!-- <?php endforeach; ?> -->
					</tbody>
				</table>
			</div>





		</div>
		<div class="mt-3 text-sm flex flex-col sm:items-end sm:text-right">

			<p class="font-semibold mb-2">Legend:</p>

			<div class="flex flex-wrap justify-end gap-6">
				<div class="flex items-center gap-2">
					<span class="inline-block w-3 h-3 rounded-full bg-green-500"></span>
					<span><strong>A</strong> – Acceptable</span>
				</div>

				<div class="flex items-center gap-2">
					<span class="inline-block w-3 h-3 rounded-full bg-yellow-500"></span>
					<span><strong>C</strong> – Conditionally Acceptable</span>
				</div>

				<div class="flex items-center gap-2">
					<span class="inline-block w-3 h-3 rounded-full bg-red-500"></span>
					<span><strong>S</strong> – Service Needed</span>
				</div>
			</div>
		</div>

		<div class="bg-white rounded-xl shadow p-4">

			<h3 class="text-lg font-semibold mb-3">Service List</h3>

			<div class="overflow-x-auto">
				<table class="w-full border text-sm min-w-[500px]" id="serviceTable">

					<thead class="bg-blue-500 text-white">
						<tr>
							<th class="border px-2 py-2 w-20 text-center">Sl. No.</th>
							<th class="border px-2 py-2">Description / Service</th>
							<th class="border px-2 py-2 w-16 text-center">Action</th>
						</tr>
					</thead>

					<tbody>
						<!-- dynamic rows -->
						<?php foreach ($saved_services as $index => $srv): ?>
							<tr>
								<td class="border px-2 py-2 w-20 text-center"><?= $index + 1 ?></td>
								<td class="border px-2 py-2">
									<input type="hidden" name="service_id[]"
										value="<?= $srv->service_id ?: 'custom' ?>">
									<?php if (!$srv->service_id): ?>
										<input type="hidden" name="custom_service[]"
											value="<?= html_escape($srv->custom_text) ?>">
									<?php endif; ?>
									<?php if ($srv->service_id): ?>
										<?= $service_map[$srv->service_id] ?>
									<?php else: ?>
										<?= $srv->custom_text ?>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>

					</tbody>
				</table>
			</div>

			<button type="button"
				onclick="if(inspectionEditMode){addServiceRow();}"
				class="w-full sm:w-auto mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg">
				+ Add Service
			</button>
		</div>
		<!-- WORKS REQUESTED -->


		<!-- INVENTORY STATUS -->
		<h4 class="font-bold mb-1">INVENTORY STATUS</h4>
		<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2">
			<?php foreach ($inventory as $inv): ?>
				<label><input type="checkbox" name="inventory_status[]" class="edit-field" value="<?= $inv->inventory_status_id ?>" <?= in_array($inv->inventory_status_id, $selected_inventory) ? 'checked' : '' ?>> <?= $inv->status_name ?></label>
			<?php endforeach; ?>
		</div>

		<!-- FOOTER DETAILS -->
		<div class="border mt-6 p-3 text-sm">

			<div class="grid grid-cols-12 gap-3 mb-3">
				<div class="col-span-12 md:col-span-2">
					<label class="font-bold block">Fuel</label>
					<input name="fuel_level"
						placeholder="1/2" value="<?= $inspection->fuel_level ?>"
						class="border px-2 py-1 w-full edit-field">
				</div>

				<div class="col-span-12 md:col-span-2">
					<label class="font-bold block">Estimated Del. Date</label>
					<input name="delivery_date" type="date"
						placeholder="3.8.22, 14:17" value="<?= $inspection->deliverydate ?>"
						class="border px-2 py-1 w-full edit-field">
				</div>
				<div class="col-span-12 md:col-span-2">
					<label class="font-bold block">Estimated Del. Time</label>
					<input name="delivery_time" type="time"
						placeholder="3.8.22, 14:17" value="<?= $inspection->deliverytime ?>"
						class="border px-2 py-1 w-full edit-field">
				</div>


				<div class="col-span-4">
					<label class="font-bold block">Remarks</label>
					<textarea name="remarks" rows="2" class="border px-2 py-1 w-full edit-field"><?= $inspection->remarks ?></textarea>
				</div>
				<div class="col-span-12">
					<label class="font-bold block">Inspection Package</label>

					<select class="w-full border rounded px-2 py-1 edit-field" name="inspackage">
						<option value="">-- Select Package --</option>

						<?php foreach ($packages as $pkg) : ?>
							<option value="<?= $pkg->id ?>"
								<?= (!empty($inspection) && $inspection->inspackage == $pkg->id) ? 'selected' : '' ?>>
								<?= $pkg->package_name ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<!-- VEHICLE PHOTOS -->
				<div class="col-span-12" hidden>
					<h4 class="font-bold mb-2">Vehicle Photos (Max 12)</h4>

					<!-- Upload new photos -->
					<input type="file"
						name="inspection_photos[]"
						id="photoInput"
						 accept=".jpg,.jpeg,.png,.webp"
						capture="environment"
						multiple
                        class="border p-2 rounded w-full edit-field"
                        disabled>
					<div id="photoPreview"
						class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3 mt-3">


						<!-- EXISTING PHOTOS -->
						<?php foreach ($inspection_photos as $p): ?>
							<div class="relative group" id="photo_<?= $p->photo_id ?>">
								<img src="<?= base_url($p->image_path) ?>"
									onclick="openImageModal(this.src)"
									class="w-full h-24 object-cover rounded cursor-pointer border">

								<button type="button"
									onclick="deletePhoto(<?= $p->photo_id ?>)"
									class="delete-photo-btn absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 text-xs hidden group-hover:flex items-center justify-center"
					disabled>
									✕
								</button>
							</div>
						<?php endforeach; ?>

					</div>
				</div>

			</div>

			<!-- VEHICLE DAMAGE DIAGRAM -->
			<!-- VEHICLE DAMAGE MARKING -->
			<div class="mt-6">
				<h4 class="font-bold mb-2">Vehicle Damage Diagram</h4>

				<div id="damageContainer"
					class="relative inline-block border p-2 cursor-crosshair">

					<img src="<?= base_url('public/images/vehicle-diagram.jpg'); ?>"
						id="vehicleImage"
						class="w-full max-w-xs sm:max-w-sm""
						draggable=" false">

					<!-- Existing marks (edit/view) -->
					<?php if (!empty($damage_marks)): ?>
						<?php foreach ($damage_marks as $m): ?>
							<span class="damage-mark absolute text-red-600 font-bold text-lg cursor-pointer"
								data-id="<?= $m->id ?>"
								style="left:<?= $m->x_coordinate ?>px;
                             top:<?= $m->y_coordinate ?>px;">
								✖
							</span>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

				<p class="text-xs text-gray-500 mt-1">
					Click on vehicle to mark damage. Click ❌ again to remove.
				</p>


				<div class="col-span-3">
					<label class="font-bold block">Technician Remarks</label>
					<input name="tecremarks" value="<?= $inspection->techremarks ?>"
						class="border px-2 py-1 w-full edit-field">
				</div>
			</div>

		</div>
<?php 

		$reportPhotoTypes = [

    'front_view'        => 'Front View',
    'front_right_view'  => 'Front Right View',
    'right_view'        => 'Right View',
    'rear_right_view'   => 'Rear Right View',

    'rear_view'         => 'Rear View',
    'rear_left_view'    => 'Rear Left View',
    'left_view'         => 'Left View',
    'front_left_view'   => 'Front Left View',

    'engine_room'       => 'Engine Room',
    'chassis_plate'     => 'Chassis Plate',

    'front_interior'    => 'Front Interior',
    'rear_interior'     => 'Rear Interior',

    'odo_meter'         => 'ODO Meter',
    'keys_ignition'     => 'Keys & Ignition',

    'trunk_view'        => 'Open Trunk View',
    'toolkit_view'      => 'Tool Kit / Spare Tyre View',

    'additional'        => 'Additional Picture'
];

?>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">

<?php foreach($reportPhotoTypes as $key => $label): ?>

    <div class="border rounded-lg p-3">

        <label class="font-semibold block mb-2">
            <?= $label ?>
        </label>

        <!-- FILE INPUT -->
        <input
            type="file"
            name="report_photos[<?= $key ?>][]"
            multiple
            accept=".jpg,.jpeg,.png,.webp"
            class="edit-field report-photo-input border p-2 rounded w-full"
            data-photo-type="<?= $key ?>"
            onchange="previewReportPhoto(this)"
            disabled>

        <!-- ALL NEW IMAGE PREVIEWS -->
        <div
            class="report-preview-container grid grid-cols-2 gap-2 mt-3"
            data-preview-type="<?= $key ?>">
        </div>

        <!-- EXISTING SAVED IMAGES -->
        <?php if(!empty($report_photos[$key])): ?>

            <div class="grid grid-cols-2 gap-2 mt-3">

                <?php foreach($report_photos[$key] as $img): ?>

                    <div
                        class="relative report-existing-photo"
                        id="report_photo_<?= $img->id ?>">

                        <img
                            src="<?= base_url($img->image_path) ?>"
                            class="w-full h-32 object-cover border rounded cursor-pointer"
                            onclick="openImageModal(this.src)">

                        <!-- DELETE BUTTON -->
                        <button
                            type="button"
                            onclick="deleteReportPhoto(<?= $img->id ?>)"
                            class="report-delete-btn absolute top-1 right-1
                                   bg-red-600 text-white rounded-full
                                   w-7 h-7 text-xs
                                   flex items-center justify-center
                                   hidden"
                            disabled>
                            ✕
                        </button>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div
                class="no-image-message mt-3 h-32 border rounded
                       flex items-center justify-center
                       text-gray-400 text-sm">
                No Image
            </div>

        <?php endif; ?>

    </div>

<?php endforeach; ?>

</div>





	</form>

</div>

<div id="imageModal" class="modal-overlay">
	<div class="modal-box max-w-3xl">

		<button onclick="closeImageModal()"
			class="absolute top-2 right-3 text-xl font-bold">
			✕
		</button>

		<img id="modalImage"
			src=""
			class="max-h-[80vh] max-w-full rounded shadow">
	</div>
</div>

<!-- SERVICE MODAL (POPUP) -->
<div id="serviceModal"
	class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">

	<div class="bg-white rounded-xl w-full max-w-md p-4 relative">

		<h3 class="text-lg font-semibold mb-3">Add New Service</h3>

		<div class="mb-3">
			<label class="text-sm font-medium">Service Name</label>
			<input type="text" id="new_service_name"
				class="w-full border rounded px-2 py-1">
		</div>

		<div class="mb-3">
			<label class="text-sm font-medium">Service Type</label>
			<select id="new_service_type"
				class="w-full border rounded px-2 py-1">
				<option value="SERVICE">Service</option>
				<option value="LABOUR">Labour</option>
				<option value="OTHER">Other</option>
			</select>
		</div>

		<div class="mb-3">
			<label class="text-sm font-medium">Estimated Cost</label>
			<input type="number" step="0.01" id="new_service_cost"
				class="w-full border rounded px-2 py-1">
		</div>

		<div class="mb-3">
			<label class="text-sm font-medium">Estimated Time (mins)</label>
			<input type="number" id="new_service_time"
				class="w-full border rounded px-2 py-1">
		</div>

		<div class="flex justify-end gap-2">
			<button type="button"
				onclick="closeServiceModal()"
				class="px-3 py-1 border rounded">
				Cancel
			</button>
			<button type="button"
				onclick="saveNewService()"
				class="px-4 py-1 bg-blue-600 text-white rounded">
				Save
			</button>
		</div>

	</div>
</div>



<style>
	input,
	select,
	textarea,
	table {
		max-width: 100%;
	}
</style>

<script>
	$(document).ready(function() {
		$('.service-select').select2({
			width: '100%'
		});

		if(<?= $type ?> === 2) {
			// Disable all edit fields
			$('.edit-field').prop('disabled', true);
			$('#editInspectionBtn').hide();
			enableInspectionEdit();
		}
	});

	// let serviceCount = 0;
	let serviceCount = $('#serviceTable tbody tr').length;
	// services list from PHP
	const services = <?= json_encode($services); ?>;


	function addServiceRow() {
		serviceCount++;

		let options = `<option value="">-- Select Service --</option>
                   <option value="add_new">-- New Service --</option>`;

		services.forEach(s => {
			options += `<option value="${s.master_service_id}">
                        ${s.service_name}
                    </option>`;
		});

		const row = `
    		<tr id="srv_${serviceCount}">
        <td class="border px-2 py-2 text-center">${serviceCount}</td>

        <td class="border px-2 py-2">
            <select name="service_id[]"
                    class="service-select w-full">
                ${options}
            </select>
        </td>

        <td class="border px-2 py-2 text-center">
            <button type="button"
                    onclick="removeService(${serviceCount})"
                    class="bg-red-500 text-white px-3 py-1 rounded">
                X
            </button>
        </td>
    	</tr>`;

		// ✅ Append row first
		$('#serviceTable tbody').append(row);

		// ✅ NOW define $select (this was missing / misplaced earlier)
		const $select = $('#srv_' + serviceCount + ' .service-select');

		// ✅ Initialize Select2
		$select.select2({
			width: '100%'
		});

		// ✅ Handle "Add New Service"
		$select.on('select2:select', function(e) {
			if (e.params.data.id === 'add_new') {
				$(this).val('').trigger('change');
				openServiceModal(this);
			}
		});
	}

	function removeService(id) {
		document.getElementById('srv_' + id)?.remove();
		renumberRows();
	}

	function renumberRows() {
		let rows = document.querySelectorAll('#serviceTable tbody tr');
		rows.forEach((row, index) => {
			row.querySelector('td').innerText = index + 1;
		});
	}


	// function serviceChanged(select) {
	// 	const customInput = select.closest('td')
	// 		.querySelector('input[name="custom_service[]"]');

	// 	if (select.value === 'add_new') {
	// 		customInput.classList.remove('hidden');
	// 	} else {
	// 		customInput.classList.add('hidden');
	// 		customInput.value = '';
	// 	}
	// }



	let activeServiceSelect = null;

	/* Called when "-- New Service --" is selected */
	function openServiceModal(selectEl) {
		activeServiceSelect = selectEl;
		$('#serviceModal').removeClass('hidden').addClass('flex');
	}

	function closeServiceModal() {
		$('#serviceModal').addClass('hidden').removeClass('flex');

		$('#new_service_name').val('');
		$('#new_service_type').val('SERVICE');
		$('#new_service_cost').val('');
		$('#new_service_time').val('');
	}


	/* SAVE NEW SERVICE */
	function saveNewService() {

		const serviceName = $('#new_service_name').val().trim();
		const serviceType = $('#new_service_type').val();
		const cost = $('#new_service_cost').val();
		const time = $('#new_service_time').val();

		if (serviceName === '') {
			alert('Service name is required');
			return;
		}

		$.ajax({
			url: "<?= base_url('index.php/ServiceMaster/save_ajax') ?>",
			type: "POST",
			dataType: "json",
			data: {
				service_name: serviceName,
				service_type: serviceType,
				estimated_cost: cost,
				estimated_time: time
			},
			success: function(res) {

				if (res.status === 'success') {

					const service = res.service;

					// ✅ Add to global services array
					services.push(service);

					// ✅ Add new option to ALL Select2 dropdowns
					$('.service-select').each(function() {

						const option = new Option(
							service.service_name,
							service.master_service_id,
							false,
							false
						);

						this.append(option);
					});

					// ✅ Auto-select in the active dropdown
					$(activeServiceSelect)
						.val(service.master_service_id)
						.trigger('change');

					closeServiceModal();

				} else {
					alert(res.message);
				}
			},
			error: function() {
				alert('Something went wrong while saving service');
			}
		});
	}
</script>

<script>
	const container = document.getElementById('damageContainer');
	const inspectionId = <?= $inspection_id ?>;

	// ADD DAMAGE MARK
	container.addEventListener('click', function(e) {

		if (!inspectionEditMode) return;
		// Prevent adding when clicking existing mark
		if (e.target.classList.contains('damage-mark')) return;

		const rect = container.getBoundingClientRect();
		const x = Math.round(e.clientX - rect.left);
		const y = Math.round(e.clientY - rect.top);

		// Create mark visually
		const mark = document.createElement('span');
		mark.innerHTML = '✖';
		mark.className = 'damage-mark absolute text-red-600 font-bold text-lg cursor-pointer';
		mark.style.left = x + 'px';
		mark.style.top = y + 'px';

		container.appendChild(mark);

		// Save to DB
		fetch("<?= base_url('index.php/inspection/saveDamageMark'); ?>", {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					inspection_id: inspectionId,
					x: x,
					y: y
				})
			})
			.then(res => res.json())
			.then(resp => {
				if (resp.id) {
					mark.dataset.id = resp.id;
				}
			});
	});

	// REMOVE DAMAGE MARK
	document.addEventListener('click', function(e) {
		if (!inspectionEditMode) return;
		if (!e.target.classList.contains('damage-mark')) return;

		const markId = e.target.dataset.id;
		e.stopPropagation();

		if (!markId) return;

		fetch("<?= base_url('index.php/inspection/deleteDamageMark'); ?>", {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					id: markId
				})
			})
			.then(res => res.json())
			.then(resp => {
				if (resp.success) {
					e.target.remove();
				}
			});
	});
</script>
<script>
	const photoInput = document.getElementById('photoInput');
	const previewContainer = document.getElementById('photoPreview');
	const imageModal = document.getElementById('imageModal');
	const modalImage = document.getElementById('modalImage');

	let selectedFiles = []; // 🔹 NEW: store newly added images only

	photoInput.addEventListener('change', function() {

		const newFiles = Array.from(this.files);

		// Count existing previews (saved + new)
		const existingCount = previewContainer.querySelectorAll('.preview-item').length;

		if (existingCount + newFiles.length > 50) {
			alert('Maximum 12 photos allowed');
			this.value = '';
			return;
		}

		newFiles.forEach(file => selectedFiles.push(file));
		this.value = ''; // 🔥 allow selecting same file again

		renderNewPreviews();
	});

	function renderNewPreviews() {

		// Remove only NEW previews before re-render
		document.querySelectorAll('.new-photo').forEach(el => el.remove());

		selectedFiles.forEach((file, index) => {
			const reader = new FileReader();

			reader.onload = function(e) {

				const wrap = document.createElement('div');
				wrap.className = 'relative preview-item new-photo group';

				wrap.innerHTML = `
					<img src="${e.target.result}"
						onclick="openImageModal(this.src)"
						class="w-full h-24 object-cover rounded border cursor-pointer hover:scale-105 transition">

					<button type="button"
						onclick="removeNewPhoto(${index})"
						class="absolute top-1 right-1 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded hidden group-hover:block">
						✕
					</button>
				`;

				previewContainer.appendChild(wrap);
			};

			reader.readAsDataURL(file);
		});
	}

	function removeNewPhoto(index) {
		selectedFiles.splice(index, 1);
		renderNewPreviews();
	}

	/* MODAL */
	function openImageModal(src) {
		modalImage.src = src;
		imageModal.classList.add('show');
	}

	function closeImageModal() {
		imageModal.classList.remove('show');
	}


	/* DELETE SAVED PHOTO (DB IMAGE) */
	function deletePhoto(photoId) {

		if (!confirm('Are you sure you want to delete this photo?')) {
			return;
		}

		fetch("<?= base_url('index.php/inspection/deletePhoto'); ?>", {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					photo_id: photoId
				})
			})
			.then(res => res.json())
			.then(resp => {
				if (resp.success) {
					document.getElementById('photo_' + photoId)?.remove();
				} else {
					alert('Failed to delete photo');
				}
			});
	}

	/* 🔥 IMPORTANT: Attach new files before submit */
	// document.querySelector('form').addEventListener('submit', function() {
	// 	const dt = new DataTransfer();
	// 	selectedFiles.forEach(file => dt.items.add(file));
	// 	photoInput.files = dt.files;
	// });
   document.querySelector('form').addEventListener('submit', function()
   {
    document.querySelectorAll('.report-photo-input').forEach(function(input)
    {
        if (!input._selectedFiles || input._selectedFiles.length === 0) {
            return;
        }

        const dataTransfer = new DataTransfer();

        input._selectedFiles.forEach(function(file)
        {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;
    });
});
</script>
<script>
	let inspectionEditMode = false;

	const editFields = document.querySelectorAll('.edit-field');
	const inspectDeleteButtons = document.querySelectorAll('.delete-photo-btn');

	function setInspectionViewMode() {
		document.querySelectorAll('.report-delete-btn').forEach(btn => {
			btn.disabled = true;
			btn.classList.add('hidden');
		});
		editFields.forEach(el => el.disabled = true);
		inspectDeleteButtons.forEach(btn => {
			btn.disabled = true;
			btn.classList.add('hidden');
		});
		inspectionEditMode = false;
	}

	function setInspectionEditMode() {
		document.querySelectorAll('.report-delete-btn').forEach(btn => {
			btn.disabled = false;
			btn.classList.remove('hidden');
		});
		editFields.forEach(el => el.disabled = false);
		inspectDeleteButtons.forEach(btn => {
			btn.disabled = false;
			btn.classList.remove('hidden');
		});
		inspectionEditMode = true;
	}

	// default view mode
	document.addEventListener("DOMContentLoaded", function() {
		setInspectionViewMode();
	});

	function deleteReportPhoto(photoId)
{
    if(!confirm('Delete this image?'))
    {
        return;
    }

    fetch("<?= base_url('index.php/inspection/deleteReportPhoto'); ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            photo_id: photoId
        })
    })
    .then(res => res.json())
    .then(resp => {

        if(resp.success)
        {
            document.getElementById(
                'report_photo_' + photoId
            )?.remove();
        }
        else
        {
            alert('Failed to delete image');
        }

    });
}
</script>

<script>
	function enableInspectionEdit() {
		setInspectionEditMode();

		document.getElementById('editInspectionBtn').classList.add('hidden');
		document.getElementById('updateInspectionBtn').classList.remove('hidden');
		document.getElementById('cancelInspectionBtn').classList.remove('hidden');

		document.getElementById('revisionCheckboxWrap').classList.remove('hidden');
	}

	function cancelInspectionEdit() {
		setInspectionViewMode();

		document.getElementById('editInspectionBtn').classList.remove('hidden');
		document.getElementById('updateInspectionBtn').classList.add('hidden');
		document.getElementById('cancelInspectionBtn').classList.add('hidden');

		document.getElementById('revisionCheckboxWrap').classList.add('hidden');
	}
</script>
<script>
function previewReportPhoto(input)
{
    const previewContainer = input.parentElement.querySelector(
        '.report-preview-container'
    );

    if (!previewContainer) {
        return;
    }

    if (!input._selectedFiles) {
        input._selectedFiles = [];
    }

    const allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    const maxFileSize = 5 * 1024 * 1024; // 5 MB

    const newFiles = Array.from(input.files);

    let invalidFiles = [];

    newFiles.forEach(function(file) {

        /*
        |--------------------------------------------------------------------------
        | Check file type
        |--------------------------------------------------------------------------
        */
        if (!allowedTypes.includes(file.type)) {

            invalidFiles.push(
                file.name + ' - unsupported format'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Check file size
        |--------------------------------------------------------------------------
        */
        if (file.size > maxFileSize) {

            invalidFiles.push(
                file.name + ' - larger than 5 MB'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Avoid duplicate files
        |--------------------------------------------------------------------------
        */
        const alreadyExists = input._selectedFiles.some(function(existingFile) {

            return (
                existingFile.name === file.name &&
                existingFile.size === file.size &&
                existingFile.lastModified === file.lastModified
            );

        });


        if (!alreadyExists) {
            input._selectedFiles.push(file);
        }

    });


    /*
    |--------------------------------------------------------------------------
    | Show friendly validation message
    |--------------------------------------------------------------------------
    */
    if (invalidFiles.length > 0) {

        alert(
            'Some images could not be added.\n\n' +
            invalidFiles.join('\n') +
            '\n\nAllowed formats: JPG, JPEG, PNG and WEBP.' +
            '\nMaximum size: 5 MB per image.'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Clear file input
    |--------------------------------------------------------------------------
    */
    input.value = '';


    /*
    |--------------------------------------------------------------------------
    | Render previews
    |--------------------------------------------------------------------------
    */
    renderReportPhotoPreviews(input);
}
function renderReportPhotoPreviews(input)
{
    const previewContainer = input.parentElement.querySelector(
        '.report-preview-container'
    );

    if (!previewContainer) {
        return;
    }

    // Remove only NEW previews
    previewContainer.innerHTML = '';

    if (!input._selectedFiles || input._selectedFiles.length === 0) {
        return;
    }

    input._selectedFiles.forEach(function(file, index) {

        const reader = new FileReader();

        reader.onload = function(e)
        {
            const wrapper = document.createElement('div');

            wrapper.className = 'report-preview-item';

            wrapper.innerHTML = `
                <img
                    src="${e.target.result}"
                    onclick="openImageModal(this.src)"
                    class="cursor-pointer">

                <button
                    type="button"
                    class="report-preview-delete"
                    onclick="removeReportPhoto(this, ${index})">
                    ✕
                </button>
            `;

            previewContainer.appendChild(wrapper);
        };

        reader.readAsDataURL(file);
    });
}
function removeReportPhoto(button, index)
{
    const input = button
        .closest('.border.rounded-lg')
        .querySelector('.report-photo-input');

    if (!input || !input._selectedFiles) {
        return;
    }

    input._selectedFiles.splice(index, 1);

    renderReportPhotoPreviews(input);
}
	
</script>
