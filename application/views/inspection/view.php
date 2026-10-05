<?php
$totalItems = count($items);
$half = ceil($totalItems / 2);

$leftItems  = array_slice($items, 0, $half);
$rightItems = array_slice($items, $half);
// echo $inspection_id;
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
<style>
    .vehicle-model-image{
    width:auto;
    max-width:220px;
    max-height:120px;
    display:block;
    margin:auto;
    object-fit:contain;
}

@media print{
    .vehicle-model-image{
        max-width:150px !important;
        max-height:80px !important;
    }
}

.page-section{
    page-break-inside: avoid;
    break-inside: avoid;
}

.page-break{
    page-break-before: always;
    break-before: page;
}

@page{
    size:A4 portrait;
    margin:10mm;
}
.photo-label{
    background:#1f2937;
    color:#fff;
    font-weight:700;
    text-align:center;
    padding:4px;
    border-radius:4px 4px 0 0;
    font-size:12px;
    border:1px solid #d1d5db;
}

@media print{

    .photo-label{
        background:#e5e7eb !important;
        color:#000 !important;
        border:1px solid #000 !important;
        font-size:10px !important;
        font-weight:bold !important;
        padding:3px !important;
        -webkit-print-color-adjust:exact;
        print-color-adjust:exact;
    }

}

.report-photo-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:10px;
}

@media(max-width:768px){

    .report-photo-grid{
        grid-template-columns:repeat(2,1fr);
    }

}

@media print{

    .report-photo-grid{
        display:grid !important;
        grid-template-columns:repeat(4,1fr) !important;
        gap:5px !important;
    }

}
.print-two-cols{
    margin-top:15px;
}

@media print{
    .print-two-cols{
        margin-top:12px !important;
    }
}

@media(max-width:768px){
    .vehicle-header{
        display:block;
    }
}

.photo-label{
    background:#374151;
    color:#fff;
    text-align:center;
    font-weight:600;
    padding:6px;
    font-size:12px;
}

.report-photo-card{
    border:1px solid #d1d5db;
    border-radius:6px;
    overflow:hidden;
    background:#fff;
}

.report-photo{
    width:100%;
    height:160px;
    object-fit:cover;
    display:block;
}

@media print{

    .photo-label{
        background:#e5e7eb !important;
        color:#000 !important;
        border-bottom:1px solid #000 !important;
        -webkit-print-color-adjust:exact;
        print-color-adjust:exact;
    }

    .report-photo{
        height:90px !important;
    }

    .report-photo-card{
        page-break-inside:avoid;
        break-inside:avoid;
    }
}

@media print {

    .inspection-category {
        background:#1e3a8a !important;
        color:#fff !important;
        -webkit-print-color-adjust:exact;
        print-color-adjust:exact;
    }

    .inspection-header {
        background:#2563eb !important;
        color:#fff !important;
        -webkit-print-color-adjust:exact;
        print-color-adjust:exact;
    }

}

.inspection-category{
    background:#1e3a8a;
    color:#fff;
    font-weight:bold;
    border:2px solid #000;
    font-size:13px;
    text-transform:uppercase;
}

@media print{

    .vehicle-model-card{
        border:2px solid #000 !important;
        border-radius:6px !important;
    }

}
@media print{

    .print-two-cols table{
        border:2px solid #000 !important;
    }

    .print-two-cols td,
    .print-two-cols th{
        border:1px solid #000 !important;
    }

}

.inspection-category{
    background:#1e3a8a !important;
    color:#fff !important;
    font-size:13px;
    font-weight:700;
    letter-spacing:.5px;
    border:2px solid #000 !important;
    padding:8px !important;
    text-transform:uppercase;
    -webkit-print-color-adjust:exact;
    print-color-adjust:exact;
}

.photo-multiple-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:5px;
    padding:5px;
}

.photo-multiple-grid .report-photo{
    width:100%;
    height:120px;
    object-fit:cover;
}

@media print{

    .photo-multiple-grid{
        grid-template-columns:repeat(2,1fr);
        gap:3px;
    }

    .photo-multiple-grid .report-photo{
        height:70px !important;
    }
}

.report-photo-container{
    display:flex;
    flex-wrap:wrap;
    gap:5px;
    max-height:250px;
    overflow-y:auto;
}
@media print{
    .report-photo-container{
        overflow:visible;
        max-height:none;
    }
}
</style>

<div class="w-full bg-white rounded-2xl shadow-md p-6">
    <?php $company_profile = get_current_company_details(); ?>
	<table class="w-full mb-4 border-collapse">
		<tr>
			<!-- LOGO (LEFT) -->
			<td class="align-top" style="width:40%;">
                <img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>"
                    alt="Company logo"
					style="height:70px;">
			</td>

			<!-- COMPANY INFO (RIGHT) -->
			<td class="align-top text-right text-sm leading-snug" style="width:65%;">
            <strong><?= htmlspecialchars($company_profile->company_name ?? '', ENT_QUOTES, 'UTF-8') ?></strong><br>
            <?= htmlspecialchars(implode(', ', array_filter([$company_profile->company_address ?? '', $company_profile->company_city ?? '', $company_profile->company_country ?? ''])), ENT_QUOTES, 'UTF-8') ?><br>
            <?= htmlspecialchars($company_profile->company_website ?? '', ENT_QUOTES, 'UTF-8') ?><br>
            <?= htmlspecialchars($company_profile->company_email_id ?? '', ENT_QUOTES, 'UTF-8') ?><br>
            Tel: <?= htmlspecialchars($company_profile->company_telephone ?? '', ENT_QUOTES, 'UTF-8') ?><br>
            TRN: <?= htmlspecialchars($company_profile->company_TRN ?? '', ENT_QUOTES, 'UTF-8') ?>
			</td>
		</tr>
	</table>

	<hr>


	<!-- ============================================================ -->
	<div class="page-header flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">

		<h2 class="text-center text-xl font-bold mb-4">
			VEHICLE HEALTH CHECK (Inventory)
		</h2>
	</div>

	<div>
		<button onclick="window.print()"
			class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded">
			🖨 Print
		</button>
		<!-- <button onclick="sendDocumentEmail('<?= base_url('index.php/Inspection/send_email/' . $inspection_id) ?>', '<?= htmlspecialchars($customer->email ?? '', ENT_QUOTES) ?>')"
			class="w-full sm:w-auto ml-2 px-4 py-2 bg-green-600 text-white rounded print:hidden">
			✉ Send Email
		</button> -->
        <!-- <button onclick="testMailtrapEmail('<?= base_url('index.php/Inspection/send_email/' . $inspection_id) ?>', '<?= htmlspecialchars($customer->email ?? '', ENT_QUOTES) ?>')"
            class="w-full sm:w-auto ml-2 px-4 py-2 bg-amber-500 text-white rounded print:hidden">
            🧪 Test Mailtrap
        </button> -->
		<a href="<?= base_url('index.php/Inspection/edit/' . $inspection_id); ?>"
			class="w-full sm:w-auto  ml-3 px-6 py-2 bg-gray-300 rounded print:hidden">Cancel</a>


	</div>


	<input type="hidden" name="inspection_id" value="<?= $inspection_id ?>">



	<!-- CUSTOMER / VEHICLE INFO -->

    <table class="w-full mb-4">
    <tr>

        <td style="width:82%; vertical-align:top;">

            <table class="w-full border text-sm">

                <tr>
				<td class="border p-1 font-bold w-1/6">Doc. No</td>
				<td class="border p-1 w-2/6">
					<?= $appointment->doc_no ?? ('VIN-' . str_pad($inspection_id, 6, '0', STR_PAD_LEFT)) ?>
				</td>

				<td class="border p-1 font-bold w-1/6">Doc. Date</td>
				<td class="border p-1 w-2/6">
					<?= date('d/M/Y') ?>
				</td>
			</tr>

			<tr>
				<td class="border p-1 font-bold">Customer Name</td>
				<td class="border p-1">
					<?= $appointment->customer_name ?? $customer->name ?>
				</td>

				<td class="border p-1 font-bold">Reg. No.</td>
				<td class="border p-1">
					<?= $appointment->registration_no ?? $vehicle->registration_no ?>
				</td>
			</tr>

			<tr>
				<td class="border p-1 font-bold">Contact No.</td>
				<td class="border p-1">
					<?= $appointment->phone ?? $customer->phone ?>
				</td>

				<td class="border p-1 font-bold">Make</td>
				<td class="border p-1">
					<?= $appointment->model ?? $vehicle->model ?>
				</td>
			</tr>

			<tr>
				<td class="border p-1 font-bold">Driver Name</td>
				<td class="border p-1">
					<?= $inspection->drivername ?>
				</td>

				<td class="border p-1 font-bold">Veh. Type</td>
				<td class="border p-1">
					<?= $appointment->variant ?? $vehicle->variant ?>
				</td>
			</tr>

			<tr>
				<td class="border p-1 font-bold">Driver Mobile</td>
				<td class="border p-1">
					<?= $inspection->driverphno ?>
				</td>

				<td class="border p-1 font-bold">Model</td>
				<td class="border p-1">
					<?= $appointment->year ?? $vehicle->year ?>
				</td>
			</tr>

			<tr>
				<td class="border p-1 font-bold">Service Advisor</td>
				<td class="border p-1">
					<?= $this->session->userdata('username') ?>
				</td>

				<td class="border p-1 font-bold">KM</td>
				<td class="border p-1">
					<?= $inspection->km_reading ?>
				</td>
			</tr>

            </table>

        </td>

        <td style="width:18%; vertical-align:top; padding-left:10px;">

            <?php if (!empty($vehicle->model_image)) : ?>

                <div style="
                        border:1px solid #d1d5db;
                        border-radius:8px;
                        overflow:hidden;
                        background:#fff;
                        box-shadow:0 2px 6px rgba(0,0,0,.08);
                    ">

                    <div style="
    font-weight:bold;
    background:#1e3a8a;
    color:#fff;
    text-align:center;
                    ">
                        Vehicle Model
                    </div>

                    <img
                        src="<?= base_url($vehicle->model_image) ?>"
                        style="
                            width:100%;
                            max-width:120px;
                            height:auto;
                            margin:auto;
                            display:block;
                        ">

                </div>

            <?php endif; ?>

        </td>

    </tr>
</table>
<div style="height:15px;"></div>
	<!-- INSPECTION ITEMS -->
	<!-- INSPECTION ITEMS (TWO COLUMN LAYOUT) -->
	<!-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-4 text-sm"> -->

	<?php
$categoryBlocks = [];

foreach ($grouped_items as $category => $catItems)
{
    $categoryBlocks[] = [
        'type'  => 'category',
        'title' => $category
    ];

    foreach ($catItems as $item)
    {
        $categoryBlocks[] = [
            'type' => 'item',
            'data' => $item
        ];
    }
}


?>



   

<div class="inspection-grid">

<?php foreach ($grouped_items as $category => $catItems): ?>

<div class="category-block">
    <table class="w-full border text-sm">

    <table class="w-full border text-sm">

        <thead>
            <tr>
                <th colspan="2"
                    style="
                        background:#1e3a8a;
                        color:#fff;
                        padding:8px;
                        text-align:left;
                        font-weight:bold;
                    ">

                    <?= strtoupper($category) ?>

                    <span style="
                        float:right;
                        background:#fff;
                        color:#1e3a8a;
                        padding:2px 8px;
                        border-radius:12px;
                    ">
                        <?= $categoryPercentages[$category] ?? 0 ?>%
                    </span>

                </th>
            </tr>

            <tr style="background:#e5e7eb;">
                <th class="border p-2 text-left">
                    Inspection Item
                </th>
                <th class="border p-2 text-center" width="80">
                    Status
                </th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($catItems as $item): ?>

            <?php
            $status = $item_results[$item->item_id] ?? '';
            ?>

            <tr>

                <td class="border p-2">
                    <?= $item->item_name ?>
                </td>

                <td class="border text-center">

                    <?php if ($status == 'A'): ?>
                        ✓
                    <?php elseif ($status == 'C'): ?>
                        ⚠
                    <?php elseif ($status == 'S'): ?>
                        ✕
                    <?php else: ?>
                        -
                    <?php endif; ?>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php endforeach; ?>

</div>

   

	<div class="mt-3 text-sm flex flex-col sm:items-end sm:text-right">

		<!-- <p class="font-semibold mb-2">Legend:</p> -->

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
			<!-- <table class="w-full border text-sm min-w-[500px]" id="serviceTable"> -->
			<table class="w-full border" id="serviceTable">
				<thead class="bg-blue-500 text-white">
					<tr>
						<th class="border px-2 py-2 w-20 text-center">Sl. No.</th>
						<th class="border px-2 py-2">Description / Service</th>
						<!-- <th class="border px-2 py-2 w-16 text-center">Action</th> -->
					</tr>
				</thead>

				<tbody>
					<!-- dynamic rows -->
					<?php foreach ($saved_services as $index => $srv): ?>
						<tr>
							<td class="border px-2 py-2 w-20 text-center"><?= $index + 1 ?></td>
							<td class="border  px-2">
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


	</div>





	

	<!-- INVENTORY STATUS -->
	<h4 class="font-bold mb-1 mt-4">INVENTORY STATUS</h4>
	<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2 p-4 mt-1">
		

		<?php foreach ($inventory as $inv): ?>
			<label><span class="px-2 py-1 bg-green-100 rounded border">
    <?= $inv->status_name ?>
</span></label>
		<?php endforeach; ?>
	</div>
<div class="page-break"></div>
	<!-- FOOTER DETAILS -->
	<div class="border mt-6 p-3 text-sm">

		<div class="bg-white rounded-xl shadow p-4 mb-4">
			<h3 class="font-bold text-lg mb-3">Inspection Summary</h3>

			<table class="w-full text-sm border border-gray-300">
				<tbody>
					<tr class="border-b">
						<th class="bg-gray-100 px-3 py-2 text-left w-1/4">Fuel Level</th>
						<td class="px-3 py-2"><?= $inspection->fuel_level ?></td>

						<th class="bg-gray-100 px-3 py-2 text-left w-1/4">Inspection Package</th>
						<td class="px-3 py-2">
							<?php foreach ($packages as $pkg): ?>
								<?= ($inspection->inspackage == $pkg->id) ? $pkg->package_name : '' ?>
							<?php endforeach; ?>
						</td>
					</tr>

					<tr class="border-b">
						<th class="bg-gray-100 px-3 py-2 text-left">Est. Delivery Date</th>
						<td class="px-3 py-2"><?= date('d-m-Y', strtotime($inspection->deliverydate)) ?></td>

						<th class="bg-gray-100 px-3 py-2 text-left">Est. Delivery Time</th>
						<td class="px-3 py-2"><?= $inspection->deliverytime ?></td>
					</tr>

					<tr>
						<th class="bg-gray-100 px-3 py-2 text-left align-top">Remarks</th>
						<td colspan="3" class="px-3 py-2">
							<?= $inspection->remarks ?: '-' ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	
	

			

            <div class="bg-white rounded-xl shadow p-4 mt-4">

   <h3 style="
    background:#1e3a8a;
    color:white;
    padding:10px;
    border-radius:6px;
    margin-bottom:15px;
    font-weight:bold;
">
    Inspection Report Photos
</h3>

    <div class="report-photo-grid">

        <?php
        $labels = [

            'front_view'       => 'Front View',
            'front_right_view' => 'Front Right',

            'right_view'       => 'Right View',
            'rear_right_view'  => 'Rear Right',

            'rear_view'        => 'Rear View',
            'rear_left_view'   => 'Rear Left',

            'left_view'        => 'Left View',
            'front_left_view'  => 'Front Left',

            'engine_room'      => 'Engine Room',
            'chassis_plate'    => 'Chassis Plate',

            'front_interior'   => 'Front Interior',
            'rear_interior'    => 'Rear Interior',

            'odo_meter'        => 'Odometer',
            'keys_ignition'    => 'Keys',

            'trunk_view'       => 'Trunk',
            'toolkit_view'     => 'Toolkit',

            'additional'       => 'Additional'
        ];
        ?>

        <?php foreach ($labels as $key => $label): ?>

    <?php if (!empty($report_photos[$key])): ?>

<div class="report-photo-card">

    <div class="photo-label">
        <?= $label ?>
    </div>

    <div class="report-photo-container">
        <?php foreach($report_photos[$key] as $img): ?>
            <div class="report-photo-item">
                <img src="<?= base_url($img->image_path) ?>">
            </div>
        <?php endforeach; ?>
    </div>

</div>

<?php endif; ?>

<?php endforeach; ?>

    </div>


		</div>
		<!-- ======================================== -->



		<!-- VEHICLE DAMAGE DIAGRAM -->
		<!-- VEHICLE DAMAGE MARKING -->
		<div class="mt-6">
			<h4 class="font-bold mb-2">Vehicle Damage Diagram</h4>

			<div id="damageContainer"
				class="relative inline-block border p-2 cursor-crosshair">

				<img src="<?= base_url('public/images/vehicle-diagram.jpg'); ?>"
					id="vehicleImage"
					class="w-full max-w-xs sm:max-w-sm"
					draggable="false">

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

			<p class="text-sm text-gray-600 mt-2">
                  Vehicle damage locations recorded during inspection.
            </p>

			<div class="col-span-3">
				<label class="font-bold block">Technician Remarks</label>
				<div class="border rounded p-3 bg-gray-50">
                    <?= nl2br($inspection->techremarks ?: '-') ?>
                </div>
			</div>
		</div>

	</div>
	<p>Printed By : <?php echo $username; ?></p>
	<!-- SAVE BUTTON -->






</div>




<style>
	@media print {
		.print\:hidden {
			display: none !important;
		}

		button,
		.print\:hidden {
			display: none !important;
		}

		.topbar {
			display: none;
		}

		html,
		body {
			height: auto !important;
			overflow: visible !important;
		}

		* {
			overflow: visible !important;
		}

		body {
			background: white;
		}

		div {
			box-shadow: none !important;
		}

		.page-break {
			page-break-before: always;
			/* legacy */
			break-before: page;
			/* modern */
		}
	}
</style>
<style>
.print-two-cols{
    column-count:2;
    column-gap:12px;
    column-fill:auto;
}

.category-block{
    display:inline-block;
    width:100%;
    margin-bottom:10px;
    break-inside:avoid;
    page-break-inside:avoid;
}

.category-block table{
    width:100%;
    border-collapse:collapse;
}

/* Mobile */
@media(max-width:768px){
    .print-two-cols{
        column-count:1;
    }
}

/* Print */
@media print{
    .print-two-cols{
        column-count:2 !important;
        column-gap:12px !important;
    }
}


.category-block{
    background:#fff;
    border-radius:8px;
    overflow:hidden;
    box-shadow:0 1px 4px rgba(0,0,0,.08);
}

.category-block table{
    margin-bottom:0;
}

.category-block th{
    font-size:12px;
}

.category-block td{
    font-size:11px;
}

.inspection-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:12px;
}

@media(max-width:768px){
    .inspection-grid{
        grid-template-columns:1fr;
    }
}

@media print{
    .inspection-grid{
        display:grid !important;
        grid-template-columns:repeat(2,1fr) !important;
        gap:10px !important;
    }
}
</style>
<style>
@media print {

    /* Reduce overall font size */
    body {
        font-size: 10px !important;
        line-height: 1.2 !important;
    }

    /* Reduce heading sizes */
    h1 { font-size: 16px !important; }
    h2 { font-size: 14px !important; }
    h3 { font-size: 12px !important; }
    h4 { font-size: 11px !important; }

    /* Reduce table font and padding */
    table {
        font-size: 10px !important;
    }

    th, td {
        padding: 2px 4px !important;
    }

    /* Reduce section spacing */
    .mb-4 { margin-bottom: 6px !important; }
    .mb-3 { margin-bottom: 4px !important; }
    .mt-6 { margin-top: 6px !important; }
    .p-4  { padding: 6px !important; }
    .p-3  { padding: 4px !important; }
    .p-2  { padding: 2px !important; }
    .p-1  { padding: 1px !important; }

    /* Reduce grid gaps */
    .gap-6 { gap: 6px !important; }
    .gap-3 { gap: 4px !important; }
    .gap-2 { gap: 3px !important; }

    /* Reduce logo size */
    /* img {
        max-height: 55px !important;
    } */

    /* Reduce page margins */
    @page {
        size: A4;
        margin: 8mm !important;
    }

}
</style>

<script>
function sendDocumentEmail(url, defaultEmail) {
	var email = window.prompt('Customer email address:', defaultEmail);
	if (email === null) return;
	fetch(url, {method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: 'email=' + encodeURIComponent(email)})
		.then(function(response) { return response.json(); })
		.then(function(result) { window.alert(result.message); })
		.catch(function() { window.alert('Unable to send email.'); });
}

function testMailtrapEmail(url, defaultEmail) {
    var email = window.prompt('Mailtrap test email address:', defaultEmail || '');
    if (email === null) return;
    fetch(url, {method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: 'email=' + encodeURIComponent(email) + '&test_mailtrap=1'})
        .then(function(response) { return response.json(); })
        .then(function(result) { window.alert(result.message || 'Mailtrap test completed.'); })
        .catch(function() { window.alert('Unable to send Mailtrap test email.'); });
}
</script>

