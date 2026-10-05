<style>
	/* =========================================
       NORMAL VIEW
       ========================================= */

	#monthlyLeaveTable {
		width: 100% !important;
		border-collapse: collapse !important;
	}

	#monthlyLeaveTable th,
	#monthlyLeaveTable td {
		text-align: center !important;
		vertical-align: middle !important;
	}


	/* =========================================
       PRINT REPORT - HIDDEN ON SCREEN
       ========================================= */

	#monthlyLeavePrintReport {
		display: none;
	}


	/* =========================================
       PRINT
       ========================================= */

	@media print {

		@page {
			size: A4 landscape;
			margin: 10mm 10mm 20mm 10mm;

			@bottom-right {
				content: "Page " counter(page) " of " counter(pages);
			}

			@bottom-left {
				content: "©<?= date('Y') ?>";
			}
		}


		/* Hide entire application */
		html,
		body {
			margin: 0 !important;
			padding: 0 !important;
			background: #fff !important;
		}

		body * {
			visibility: hidden !important;
		}


		/* Show only print report */
		#monthlyLeavePrintReport,
		#monthlyLeavePrintReport * {
			visibility: visible !important;
		}

		#monthlyLeavePrintReport {
			display: block !important;

			position: absolute !important;
			top: 0 !important;
			left: 0 !important;

			width: 100% !important;

			margin: 0 !important;
			padding: 0 !important;

			background: #fff !important;
			color: #000 !important;

			border: none !important;
			box-shadow: none !important;

			z-index: 999999 !important;
		}


		/* =========================================
           COMPANY HEADER
           ========================================= */

		.leave-print-header {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 8px;
		}

		.leave-print-header td {
			border: none !important;
			padding: 5px;
			vertical-align: middle;
		}

		.leave-logo-cell {
			width: 20%;
			text-align: center;
		}

		.leave-logo-cell img {
			max-height: 70px;
			max-width: 150px;
		}

		.leave-company-cell {
			width: 80%;
			text-align: right;
			font-size: 13px;
			line-height: 1.6;
		}


		/* =========================================
           REPORT TITLE
           ========================================= */

		.leave-title-table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 5px;
		}

		.leave-title-table td {
			border: none !important;
			padding: 5px;
		}

		.leave-report-title {
			text-align: center;
			font-size: 17px;
			font-weight: bold;
		}

		.leave-report-period {
			text-align: right;
		}


		/* =========================================
           REPORT INFO
           ========================================= */

		.leave-info-table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 5px;
			margin-bottom: 10px;
		}

		.leave-info-table td {
			border: none !important;
			padding: 4px 0;
		}


		/* =========================================
           PRINT TABLE
           ========================================= */

		.leave-print-table {
			width: 100% !important;
			border-collapse: collapse !important;
			table-layout: fixed !important;
		}

		.leave-print-table thead {
			display: table-header-group !important;
		}

		.leave-print-table tbody {
			display: table-row-group !important;
		}

		.leave-print-table tr {
			page-break-inside: avoid !important;
			break-inside: avoid !important;
		}

		.leave-print-table th {
			background: #f5f5f5 !important;
			border: 1px solid #000 !important;
			padding: 6px !important;
			text-align: center !important;
			vertical-align: middle !important;
			font-weight: bold !important;
		}

		.leave-print-table td {
			border: 1px solid #000 !important;
			padding: 6px !important;
			text-align: center !important;
			vertical-align: middle !important;
			word-break: break-word !important;
		}


		/* =========================================
           COLUMN WIDTHS
           ========================================= */

		.leave-print-table th:nth-child(1),
		.leave-print-table td:nth-child(1) {
			width: 6% !important;
		}

		.leave-print-table th:nth-child(2),
		.leave-print-table td:nth-child(2) {
			width: 18% !important;
		}

		.leave-print-table th:nth-child(3),
		.leave-print-table td:nth-child(3) {
			width: 16% !important;
		}

		.leave-print-table th:nth-child(4),
		.leave-print-table td:nth-child(4) {
			width: 16% !important;
		}

		.leave-print-table th:nth-child(5),
		.leave-print-table td:nth-child(5) {
			width: 16% !important;
		}

		.leave-print-table th:nth-child(6),
		.leave-print-table td:nth-child(6) {
			width: 12% !important;
		}

		.leave-print-table th:nth-child(7),
		.leave-print-table td:nth-child(7) {
			width: 12% !important;
		}

		.leave-print-table th:nth-child(8),
		.leave-print-table td:nth-child(8) {
			width: 14% !important;
		}
	}
</style>
<link rel="stylesheet"
	href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<?php if (!isset($is_generated)) $is_generated = false; ?>

<?php
$status_labels = [
	0 => 'Pending',
	1 => 'Approved',
	2 => 'Rejected'
];
?>

<div class="bg-white shadow rounded-xl p-6">
<div>
            <h2 class="text-2xl font-bold text-gray-800">
                Monthly Leave Report
            </h2>

           
        </div>

	<div>
<br>
		<!-- Filter Form -->
		<form id="main" method="post" action="<?= base_url('index.php/Reports/monthly_leave_report') ?>">

			<div class="flex flex-wrap items-end gap-4 mb-4">

				<!-- Month -->
				<div class="w-full md:w-64">
					<label class="block text-sm font-medium mb-1">Month</label>
					<input type="month"
						name="month"
						required
						value="<?= isset($selected_month) ? $selected_month : '' ?>"
						class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring focus:ring-blue-200">
				</div>

				<!-- Department -->
				<div class="w-full md:w-64">
					<label class="block text-sm font-medium mb-1">Department</label>
					<select name="department_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm select2">
						<option value="">All</option>
						<?php foreach ($departments as $dept): ?>
							<option value="<?= $dept->department_id  ?>" <?= ($selected_dept == $dept->department_id) ? 'selected' : '' ?>>
								<?= htmlspecialchars($dept->department_name) ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<!-- Buttons -->
				<div class="flex-1 flex justify-end items-center gap-2">

					<button type="submit"
						name="action"
						value="Go"
						class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg shadow">
						Generate
					</button>

					<button type="button"
						id="printBtn"
						onclick="printMonthlyLeaveReport()"
						class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-2 rounded-lg shadow">
						Print
					</button>

					<button type="button"
						id="exportBtn"
						onclick="exportMonthlyLeaveExcel()"
						class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-lg shadow">
						Export to Excel
					</button>

				</div>

			</div>

			<input type="hidden" name="is_generated" value="<?= $is_generated ? '1' : '' ?>">

		</form>

		<!-- Data Table -->
		<div class="overflow-x-auto">
			<table id="monthlyLeaveTable" class="min-w-full border border-gray-200 text-sm text-left">
				<thead class="bg-blue-50 text-blue-900">
					<tr>
						<th class="border px-3 py-2">Sr. No</th>
						<!-- <th class="border px-3 py-2">Emp Code</th> -->
						<th class="border px-3 py-2">Employee Name</th>
						<th class="border px-3 py-2">Department</th>
						<th class="border px-3 py-2">Designation</th>
						<th class="border px-3 py-2">Leave Type</th>
						<th class="border px-3 py-2">From</th>
						<th class="border px-3 py-2">To</th>
						<th class="border px-3 py-2">Status</th>
					</tr>
				</thead>

				<tbody class="divide-y divide-gray-100">
					<?php if (!empty($records)): ?>
						<?php $i = 1;
						foreach ($records as $r): ?>
							<tr class="hover:bg-gray-50">
								<td class="border px-3 py-2"><?= $i++ ?></td>
								<!-- <td class="border px-3 py-2"><?= htmlspecialchars($r->employee_code ?? '-') ?></td> -->
								<td class="border px-3 py-2"><?= htmlspecialchars($r->employee_name ?? '-') ?></td>
								<td class="border px-3 py-2"><?= htmlspecialchars($r->department_name ?? '-') ?></td>
								<td class="border px-3 py-2"><?= htmlspecialchars($r->designation_name ?? '-') ?></td>
								<td class="border px-3 py-2"><?= htmlspecialchars($r->leave_type ?? '-') ?></td>
								<td class="border px-3 py-2"><?= !empty($r->start_date) ? date('d-M-Y', strtotime($r->start_date)) : '-' ?></td>
								<td class="border px-3 py-2"><?= !empty($r->end_date) ? date('d-M-Y', strtotime($r->end_date)) : '-' ?></td>
								<td class="border px-3 py-2"><?= $status_labels[$r->leave_status] ?? 'Pending' ?></td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>

			</table>
		</div>


	</div>

</div>
<div id="monthlyLeavePrintReport">

    <?php $company_profile = get_current_company_details(); ?>
	<!-- COMPANY HEADER -->
	<table class="leave-print-header">

		<tr>

			<td class="leave-logo-cell">
				<img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>"
					alt="Company logo">
			</td>

			<td class="leave-company-cell">
				<strong><?= htmlspecialchars($company_profile->company_name ?? '', ENT_QUOTES, 'UTF-8') ?></strong><br>
				<?= htmlspecialchars(implode(', ', array_filter([
					$company_profile->company_address ?? '',
					$company_profile->company_city ?? '',
					$company_profile->company_state ?? '',
					$company_profile->company_pincode ?? '',
					$company_profile->company_country ?? '',
				])), ENT_QUOTES, 'UTF-8') ?><br>
				<?= htmlspecialchars(implode(' | ', array_filter([
					$company_profile->company_website ?? '',
					$company_profile->company_email_id ?? '',
					$company_profile->company_telephone ?? '',
					!empty($company_profile->company_TRN) ? 'TRN: ' . $company_profile->company_TRN : '',
				])), ENT_QUOTES, 'UTF-8') ?>
			</td>

		</tr>

	</table>


	<!-- REPORT TITLE -->
	<table class="leave-title-table">

		<tr>

			<td width="35%">
				<b>Report:</b>
				Monthly Leave Report
			</td>

			<td width="30%" class="leave-report-title">
				MONTHLY LEAVE REPORT
			</td>

			<td width="35%" class="leave-report-period">

				<b>Month:</b>

				<?php
				if (!empty($selected_month)) {
					echo date('F Y', strtotime($selected_month . '-01'));
				} else {
					echo '-';
				}
				?>

			</td>

		</tr>

	</table>


	<!-- REPORT INFO -->
	<table class="leave-info-table">

		<tr>

			<td width="50%">
				<b>Prepared by:</b>
				<?= $this->session->userdata('username') ?? '' ?>
			</td>

			<td width="50%" style="text-align:right;">
				<b>Total Leave Records:</b>
				<?= count($records) ?>
			</td>

		</tr>

		<?php if (!empty($selected_dept)): ?>

			<?php
			$selectedDepartmentName = '';

			foreach ($departments as $dept) {
				if ($dept->department_id == $selected_dept) {
					$selectedDepartmentName =
						$dept->department_name;
					break;
				}
			}
			?>

			<?php if (!empty($selectedDepartmentName)): ?>

				<tr>

					<td colspan="2">
						<b>Department:</b>
						<?= htmlspecialchars($selectedDepartmentName) ?>
					</td>

				</tr>

			<?php endif; ?>

		<?php endif; ?>

	</table>


	<!-- LEAVE TABLE -->
	<table class="leave-print-table">

		<thead>

			<tr>

				<th>Sr. No</th>
				<th>Employee Name</th>
				<th>Department</th>
				<th>Designation</th>
				<th>Leave Type</th>
				<th>From</th>
				<th>To</th>
				<th>Status</th>

			</tr>

		</thead>


		<tbody>

			<?php if (!empty($records)): ?>

				<?php $printNo = 1; ?>

				<?php foreach ($records as $r): ?>

					<tr>

						<td>
							<?= $printNo++ ?>
						</td>

						<td>
							<?= htmlspecialchars(
								$r->employee_name ?? '-'
							) ?>
						</td>

						<td>
							<?= htmlspecialchars(
								$r->department_name ?? '-'
							) ?>
						</td>

						<td>
							<?= htmlspecialchars(
								$r->designation_name ?? '-'
							) ?>
						</td>

						<td>
							<?= htmlspecialchars(
								$r->leave_type ?? '-'
							) ?>
						</td>

						<td>
							<?= !empty($r->start_date)
								? date('d-M-Y', strtotime($r->start_date))
								: '-' ?>
						</td>

						<td>
							<?= !empty($r->end_date)
								? date('d-M-Y', strtotime($r->end_date))
								: '-' ?>
						</td>

						<td>
							<?= $status_labels[$r->leave_status] ?? 'Pending' ?>
						</td>

					</tr>

				<?php endforeach; ?>

			<?php else: ?>

				<tr>

					<td colspan="8">
						No leave records found.
					</td>

				</tr>

			<?php endif; ?>

		</tbody>

	</table>

</div>
<script>
	$(document).ready(function() {

		/* =========================================
		   SELECT2
		   ========================================= */

		$('.select2').select2({
			width: '100%'
		});


	});


	/* =========================================
	   PRINT
	   ========================================= */

	function printMonthlyLeaveReport() {
		window.print();
	}


	/* =========================================
	   CSV ESCAPE
	   ========================================= */

	function escapeCSV(value) {

		return '"' +
			String(value ?? '')
			.replace(/"/g, '""')
			.trim() +
			'"';

	}


	/* =========================================
	   EXPORT EXCEL / CSV
	   ========================================= */

	function exportMonthlyLeaveExcel() {

		/*
		 * Use the dedicated print table.
		 * This contains ALL records, not just
		 * the current DataTable page.
		 */
		const table = document.querySelector(
			'#monthlyLeavePrintReport .leave-print-table'
		);

		if (!table) {
			alert('Leave report table not found.');
			return;
		}


		const csvRows = [];


		/* =========================================
		   REPORT TITLE
		   ========================================= */

		csvRows.push(
			escapeCSV('Monthly Leave Report')
		);


		/* =========================================
		   MONTH
		   ========================================= */

		const selectedMonth =
			<?= json_encode(
				!empty($selected_month)
					? date('F Y', strtotime($selected_month . '-01'))
					: '-'
			) ?>;

		csvRows.push(
			escapeCSV('Month: ' + selectedMonth)
		);


		/* =========================================
		   DEPARTMENT
		   ========================================= */

		const selectedDepartment =
			<?= json_encode(
				!empty($selectedDepartmentName)
					? $selectedDepartmentName
					: ''
			) ?>;

		if (selectedDepartment) {

			csvRows.push(
				escapeCSV(
					'Department: ' + selectedDepartment
				)
			);

		}


		/* =========================================
		   PREPARED BY
		   ========================================= */

		const preparedBy =
			<?= json_encode(
				$this->session->userdata('username') ?? ''
			) ?>;

		if (preparedBy) {

			csvRows.push(
				escapeCSV(
					'Prepared by: ' + preparedBy
				)
			);

		}


		/* Empty line */
		csvRows.push('');


		/* =========================================
		   TABLE HEADER
		   ========================================= */

		csvRows.push([
			escapeCSV('Sr. No'),
			escapeCSV('Employee Name'),
			escapeCSV('Department'),
			escapeCSV('Designation'),
			escapeCSV('Leave Type'),
			escapeCSV('From'),
			escapeCSV('To'),
			escapeCSV('Status')
		].join(','));


		/* =========================================
		   TABLE DATA
		   ========================================= */

		const rows = table.querySelectorAll(
			'tbody tr'
		);

		let dataCount = 0;

		rows.forEach(function(row) {

			const cells = row.querySelectorAll('td');

			/*
			 * Ignore "No leave records found"
			 */
			if (
				cells.length === 1 ||
				row.querySelector('[colspan]')
			) {
				return;
			}

			if (cells.length < 8) {
				return;
			}


			const serialNo =
				cells[0].innerText.trim();

			const employee =
				cells[1].innerText.trim();

			const department =
				cells[2].innerText.trim();

			const designation =
				cells[3].innerText.trim();

			const leaveType =
				cells[4].innerText.trim();

			const fromDate =
				cells[5].innerText.trim();

			const toDate =
				cells[6].innerText.trim();

			const status =
				cells[7].innerText.trim();


			csvRows.push([
				escapeCSV(serialNo),
				escapeCSV(employee),
				escapeCSV(department),
				escapeCSV(designation),
				escapeCSV(leaveType),

				/* Keep date visible in Excel */
				escapeCSV('="' + fromDate + '"'),
				escapeCSV('="' + toDate + '"'),

				escapeCSV(status)

			].join(','));

			dataCount++;

		});


		/* =========================================
		   CHECK DATA
		   ========================================= */

		if (dataCount === 0) {
			alert('No leave records available to export.');
			return;
		}


		/* =========================================
		   CREATE CSV
		   ========================================= */

		const csvContent =
			'\uFEFF' +
			csvRows.join('\r\n');


		const blob = new Blob(
			[csvContent], {
				type: 'text/csv;charset=utf-8;'
			}
		);


		const url =
			URL.createObjectURL(blob);


		const link =
			document.createElement('a');


		link.href = url;


		link.download =
			'monthly_leave_report_' +
			new Date().toISOString().slice(0, 10) +
			'.csv';


		document.body.appendChild(link);

		link.click();

		document.body.removeChild(link);

		URL.revokeObjectURL(url);

	}
	$(document).ready(function() {

		$('.select2').select2({
			width: '100%'
		});

		if ($.fn.DataTable) {

			$('#monthlyLeaveTable').DataTable({
				responsive: true,
				language: {
					emptyTable: "No leave records found.",
					zeroRecords: "No matching records found."
				}
			});

		}

	});
</script>