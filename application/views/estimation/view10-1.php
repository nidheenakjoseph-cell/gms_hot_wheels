<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Estimation Print</title>
	<style>
		/* =========================
   PAGE SETUP
========================= */
		@page {
			/* size: A4; */
			margin: 10mm;
		}

		html,
		body {
			background: #ffffff !important;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12px;
			color: #000;
			margin: 0;
			padding: 0;
		}

		/* =========================
   		LAYOUT
		========================= */
		.container {
			width: 100%;
			display: block;
			overflow: visible;
		}

		/* Header (NO FLEX IN PRINT) */
		.header {
			display: block;
			border-bottom: 2px solid #000;
			padding-bottom: 8px;
			margin-bottom: 10px;
		}

		.logo {
			font-weight: bold;
			font-size: 16px;
		}

		.company-info {
			text-align: right;
			font-size: 11px;
		}

		/* Estimation title bar */
		.est-title-line {
			display: block;
			text-align: center;
			font-weight: bold;
			border-top: 2px solid #000;
			border-bottom: 2px solid #000;
			padding: 6px 4px;
			margin: 8px 0;
			font-size: 13px;
		}

		.est-title {
			font-size: 18px;
			letter-spacing: 1px;
		}

		/* =========================
   INFO TABLES
========================= */
		.est-info {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 10px;
		}

		.est-info table {
			width: 100%;
			font-size: 12px;
		}

		.est-info td {
			padding: 2px 4px;
			vertical-align: top;
		}

		.info-left td:first-child,
		.info-right td:first-child {
			width: 90px;
			font-weight: bold;
		}

		.info-left td:nth-child(2),
		.info-right td:nth-child(2) {
			width: 10px;
		}

		/* =========================
   SECTION & DATA TABLES
========================= */
		.section-title {
			font-weight: bold;
			border-bottom: 1px solid #000;
			margin-top: 10px;
			margin-bottom: 5px;
		}

		table.data {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 8px;
		}

		table.data th,
		table.data td {
			border: 1px solid #000;
			padding: 4px;
			font-size: 11px;
		}

		table.data th {
			background: #f5f5f5;
		}

		.text-right {
			text-align: right;
		}

		.text-center {
			text-align: center;
		}

		/* =========================
   TOTALS
========================= */
		.totals {
			width: 100%;
			margin-top: 10px;
			border-collapse: collapse;
		}

		.totals td {
			border: 1px solid #000;
			padding: 5px;
			font-size: 12px;
		}

		/* =========================
   FOOTER / REMARKS
========================= */
		.remarks {
			margin-top: 10px;
			font-size: 11px;
		}

		.footer {
			margin-top: 20px;
			font-size: 10px;
		}

		/* =========================
   PRINT RULES (CRITICAL)
========================= */
		@media print {

			/* Hide app UI */
			.topbar,
			.navbar,
			.sidebar,
			.page-header,
			.page-title,
			.breadcrumb,
			.no-print,
			.hide-on-print {
				display: none !important;
			}

			/* Force real A4 width */
			html,
			body {
				width: 210mm;
				height: auto;
			}

			/* Allow tables to break */
			table {
				page-break-inside: auto;
			}

			tr {
				page-break-inside: avoid;
			}

			thead {
				display: table-header-group;
			}

			/* Page break utility */
			.page-break {
				display: block;
				page-break-after: always;
				break-after: page;
			}
		}


		/* Logo sizing (screen) */
		.print-logo {
			height: 80px;
			/* adjust if needed */
			width: auto;
		}

		/* Print-specific logo fix */
		@media print {
			.print-logo {
				height: 110px !important;
				/* PERFECT for A4 */
				max-height: 120px;
				width: auto !important;
			}
		}

		@media print {
			.brand {
				display: block !important;
				padding: 0 !important;
			}
		}

		@media print {
			.header {
				display: table !important;
				width: 100%;
			}

			.logo,
			.company-info {
				display: table-cell;
				vertical-align: middle;
			}

			.logo {
				width: 40%;
			}

			.company-info {
				width: 60%;
				text-align: right;
			}
		}
	</style>

</head>

<body>
	<!-- onload="window.print()" -->
	<div class="container">

		<div>


			<button type="button"
				onclick="window.print()"
				class="px-4 py-2 bg-blue-600 text-white rounded hide-on-print">
				🖨 Print
			</button>

			<a href="<?= base_url('index.php/estimation/edit/' . $estimation->estimation_id); ?>"
				class="ml-3 px-6 py-2 bg-gray-300 rounded hide-on-print">
				Cancel
			</a>




		</div>

		<!-- HEADER -->
		<div class="header">
			<div class="logo">
				<div class="brand flex items-center gap-3 px-4 py-3">
					<img src="<?= base_url('public/images/logoauto1.png') ?>"
						alt="GMS Logo"
						class="print-logo">


				</div>
			</div>
			<div class="company-info">
				Cool Runnings Garage Co LLC<br>
				7 St, Al Quoz 3, Dubai, UAE<br>
				www.coolrunningsgarage.com<br>
				info@coolrunningsgarage.com<br>
				Tel: +971 4 265 4887<br>
				TRN: 104026094300003
			</div>
		</div>

		<div class="est-title-line">
			<span>Est # : <?= $estimation->estimation_no ?></span>
			<span class="est-title">ESTIMATION</span>
			<span>Date : <?= date('d/m/Y', strtotime($estimation->estimation_date)) ?></span>
		</div>


		<!-- CUSTOMER & VEHICLE INFO -->
		<table class="est-info">
			<tr>
				<!-- LEFT SIDE : CUSTOMER -->
				<td width="50%" class="info-left">
					<table>
						<tr>
							<td>Name</td>
							<td>:</td>
							<td><?= $appointment->name ?></td>
						</tr>
						<tr>
							<td>Contact</td>
							<td>:</td>
							<td><?= $appointment->phone ?></td>
						</tr>
						<tr>
							<td>Address</td>
							<td>:</td>
							<td><?= $appointment->address ?></td>
						</tr>
						<tr>
							<td>TRN No</td>
							<td>:</td>
							<td><?= $appointment->trn_no ?? '' ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><?= $appointment->email ?? '' ?></td>
						</tr>
					</table>
				</td>

				<!-- RIGHT SIDE : VEHICLE -->
				<td width="50%" class="info-right">
					<table>
						<tr>
							<td>Brand</td>
							<td>:</td>
							<td><?= $appointment->brand ?></td>
						</tr>
						<tr>
							<td>Model</td>
							<td>:</td>
							<td><?= $appointment->model ?></td>
						</tr>
						<tr>
							<td>Vin No</td>
							<td>:</td>
							<td><?= $appointment->chassis_no ?></td>
						</tr>
						<tr>
							<td>Plate No</td>
							<td>:</td>
							<td><?= $appointment->registration_no ?></td>
						</tr>
						<tr>
							<td>Colour</td>
							<td>:</td>
							<td><?= $appointment->color ?? '' ?></td>
						</tr>
						<tr>
							<td>Mileage</td>
							<td>:</td>
							<td><?= $appointment->mileage ?? '' ?></td>
						</tr>
						<tr>
							<td>Year</td>
							<td>:</td>
							<td><?= $appointment->year ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<!-- SERVICES -->
		<div class="section-title">Services</div>
		<table class="data">
			<tr>
				<th width="5%">#</th>
				<th>Work Description</th>
				<th width="20%" class="text-right">Amount</th>
			</tr>
			<?php $i = 1;
			$service_total = 0;
			foreach ($services_used as $s): $service_total += $s->total_cost; ?>
				<tr>
					<td class="text-center"><?= $i++ ?></td>
					<td><?= $s->service_name ?></td>
					<td class="text-right"><?= number_format($s->total_cost, 2) ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="2" class="text-right"><strong>Total Services</strong></td>
				<td class="text-right"><strong><?= number_format($service_total, 2) ?></strong></td>
			</tr>
		</table>
		<div class="page-break"></div>
		<!-- SPARE PARTS -->
		<!-- <div class="section-title">Spare Parts</div> -->
		<?php
		$new_total = 0;
		$i = 1;
		?>

		<div class="section-title">New Spare Parts</div>
		<table class="data">
			<tr>
				<th>#</th>
				<th>Parts Description</th>
				<th>Unit Price</th>
				<th>Qty</th>
				<th>Dis Amt</th>
				<th class="text-right">Amount</th>
			</tr>

			<?php foreach ($parts_used_new as $p):
				$new_total += $p->total_price; ?>
				<tr>
					<td class="text-center"><?= $i++ ?></td>
					<td><?= $p->part_name ?></td>
					<td class="text-right"><?= number_format($p->selling_price, 2) ?></td>
					<td class="text-center"><?= $p->qty ?></td>
					<td class="text-center"><?= number_format($p->dis_amount, 2) ?></td>
					<td class="text-right"><?= number_format($p->total_price, 2) ?></td>
				</tr>
			<?php endforeach; ?>

			<tr>
				<td colspan="5" class="text-right"><strong>Total New Parts</strong></td>
				<td class="text-right"><strong><?= number_format($new_total, 2) ?></strong></td>
			</tr>
		</table>
		<?php
		$after_total = 0;
		$i = 1;
		?>

		<div class="section-title">Aftermarket Spare Parts</div>
		<table class="data">
			<tr>
				<th>#</th>
				<th>Parts Description</th>
				<th>Unit Price</th>
				<th>Qty</th>
				<th>Dis Amt</th>
				<th class="text-right">Amount</th>
			</tr>

			<?php foreach ($parts_used_after as $p):
				$after_total += $p->total_price; ?>
				<tr>
					<td class="text-center"><?= $i++ ?></td>
					<td><?= $p->part_name ?></td>
					<td class="text-right"><?= number_format($p->selling_price, 2) ?></td>
					<td class="text-center"><?= $p->qty ?></td>
					<td class="text-center"><?= number_format($p->dis_amount, 2) ?></td>
					<td class="text-right"><?= number_format($p->total_price, 2) ?></td>
				</tr>
			<?php endforeach; ?>

			<tr>
				<td colspan="5" class="text-right"><strong>Total Aftermarket Parts</strong></td>
				<td class="text-right"><strong><?= number_format($after_total, 2) ?></strong></td>
			</tr>
		</table>
		<?php
		$used_total = 0;
		$i = 1;
		?>

		<div class="section-title">Used Spare Parts</div>
		<table class="data">
			<tr>
				<th>#</th>
				<th>Parts Description</th>
				<th>Unit Price</th>
				<th>Qty</th>
				<th>Dis Amt</th>
				<th class="text-right">Amount</th>
			</tr>

			<?php foreach ($parts_used_used as $p):
				$used_total += $p->total_price; ?>
				<tr>
					<td class="text-center"><?= $i++ ?></td>
					<td><?= $p->part_name ?></td>
					<td class="text-right"><?= number_format($p->selling_price, 2) ?></td>
					<td class="text-center"><?= $p->qty ?></td>
					<td class="text-center"><?= number_format($p->dis_amount, 2) ?></td>
					<td class="text-right"><?= number_format($p->total_price, 2) ?></td>
				</tr>
			<?php endforeach; ?>

			<tr>
				<td colspan="5" class="text-right"><strong>Total Used Parts</strong></td>
				<td class="text-right"><strong><?= number_format($used_total, 2) ?></strong></td>
			</tr>
		</table>

		<div class="page-break"></div>
		<!-- Sublet services -->
		<div class="section-title">Sublet Services</div>
		<table class="data">
			<tr>
				<th width="5%">#</th>
				<th>Work Description</th>
				<th width="20%" class="text-right">Amount</th>
			</tr>
			<?php $i = 1;
			$jd_total = 0;
			foreach ($job_descriptions as $s): $jd_total += $s->amount; ?>
				<tr>
					<td class="text-center"><?= $i++ ?></td>
					<td><?= $s->description ?></td>
					<td class="text-right"><?= number_format($s->amount, 2) ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="2" class="text-right"><strong>Total Services</strong></td>
				<td class="text-right"><strong><?= number_format($jd_total, 2) ?></strong></td>
			</tr>
		</table>


		<div class="page-break"></div>
		<!-- TOTALS -->
		<table class="totals">
			<tr>
				<td>Amount AED</td>
				<td class="text-right"><?= number_format($estimation->subtotal, 2) ?></td>
			</tr>
			<tr>
				<td>Discount AED</td>
				<td class="text-right"><?= number_format($estimation->discount, 2) ?></td>
			</tr>
			<tr>
				<td>VAT 5%</td>
				<td class="text-right"><?= number_format($estimation->tax_amount, 2) ?></td>
			</tr>
			<tr>
				<td><strong>Net Total AED</strong></td>
				<td class="text-right"><strong><?= number_format($estimation->grand_total, 2) ?></strong></td>
			</tr>
		</table>

		<div style="clear:both"></div>

		<!-- REMARKS -->
		<div class="remarks">
			<strong>Remarks:</strong><br>
			<?= nl2br($estimation->remarks) ?>
		</div>
		<div class="page-break"></div>
		<!-- FOOTER -->
		<div class="footer">

			<p>
				<strong>Total Amount in Words:</strong><br>
				<strong><?= $amount_in_words ?></strong>
			</p>

			<br>

			<strong>Conditions :</strong>

			<ul class="terms-list">
				<li>After dismantling, if any additional work or spare parts not covered in this estimate are required, a supplementary estimate will be provided.</li>
				<li>All deliveries are subject to availability of spare parts.</li>
				<li>Spare parts prices are subject to change without prior notice. Prices prevailing at the time of actual delivery shall be charged.</li>
				<li>This estimate is valid for <strong>15 days</strong> from the date of issue.</li>
				<li>Payment can only be made by cash or card. Cheque payments are not accepted.</li>
				<li>Used parts are not covered under warranty.</li>
				<li>Brand new electronic parts are not covered under warranty.</li>
				<li>The client authorizes Cool Runnings Garage to test drive the serviced vehicle.</li>
				<li>The company will not be held liable for any missing items inside the client’s vehicle.</li>
				<li>The client is responsible for removing all personal belongings from the vehicle before service or repair.</li>
				<li>A minimum of <strong>50%</strong> of the total estimate value is required as a down payment for any service.</li>
				<li>Once the client approves and confirms the estimate, it cannot be withdrawn.</li>
				<li>All approved estimates are subject to change or revision as per specialist advice during the course of work.</li>
				<li>The company will not be responsible for damage to other vehicle parts due to brittleness or friability.</li>
				<li>Free parking for <strong>7 days</strong> will be provided after completion of repairs. Thereafter, parking will be charged at <strong>AED 100 per day</strong>.</li>
				<li>The company is not liable for any loss or damage to vehicles parked outside the garage.</li>
				<li>The vehicle will not be released until full payment is received.</li>
				<li>Replaced parts must be collected by the client within <strong>2–3 days</strong>, failing which they will be treated as scrap.</li>
				<li>The company may take photographs of the vehicle and repair process for marketing purposes only.</li>
			</ul>

			<br>

			<p>
				<strong>I / We hereby accept the above terms and conditions.</strong>
			</p>

			<br>

			<table width="100%" style="margin-top:15px;">
				<tr>
					<td width="50%">
						Name: _______________________________
					</td>
					<td width="50%" class="text-right">
						Signature: _______________________________
					</td>
				</tr>
			</table>

		</div>


	</div>
</body>

</html>
<style>
	.terms-list {
    font-size: 11px;
    padding-left: 18px;
    margin-top: 6px;
}

.terms-list li {
    margin-bottom: 4px;
    line-height: 1.4;
}

.footer {
    page-break-inside: avoid;
}

</style>
