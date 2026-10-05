<style>
	/* =========================================
       NORMAL VIEW
       ========================================= */

	#monthlyAttendanceTable {
		width: 100% !important;
		border-collapse: collapse !important;
	}

	#monthlyAttendanceTable th,
	#monthlyAttendanceTable td {
		text-align: center !important;
		vertical-align: middle !important;
	}


	/* =========================================
       PRINT REPORT - HIDDEN ON SCREEN
       ========================================= */

	#monthlyAttendancePrintReport {
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

		html,
		body {
			margin: 0 !important;
			padding: 0 !important;
			background: #fff !important;
		}

		/* Hide entire application */
		body * {
			visibility: hidden !important;
		}

		/* Show only print report */
		#monthlyAttendancePrintReport,
		#monthlyAttendancePrintReport * {
			visibility: visible !important;
		}

		#monthlyAttendancePrintReport {
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

		.attendance-print-header {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 8px;
		}

		.attendance-print-header td {
			border: none !important;
			padding: 5px;
			vertical-align: middle;
		}

		.attendance-logo-cell {
			width: 20%;
			text-align: center;
		}

		.attendance-logo-cell img {
			max-height: 70px;
			max-width: 150px;
		}

		.attendance-company-cell {
			width: 80%;
			text-align: right;
			font-size: 13px;
			line-height: 1.6;
		}


		/* =========================================
           REPORT TITLE
           ========================================= */

		.attendance-title-table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 5px;
		}

		.attendance-title-table td {
			border: none !important;
			padding: 5px;
		}

		.attendance-report-title {
			text-align: center;
			font-size: 17px;
			font-weight: bold;
		}

		.attendance-report-period {
			text-align: right;
		}


		/* =========================================
           REPORT INFORMATION
           ========================================= */

		.attendance-info-table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 5px;
			margin-bottom: 10px;
		}

		.attendance-info-table td {
			border: none !important;
			padding: 4px 0;
		}


		/* =========================================
           PRINT TABLE
           ========================================= */

		.attendance-print-table {
			width: 100% !important;
			border-collapse: collapse !important;
			table-layout: fixed !important;
		}

		.attendance-print-table thead {
			display: table-header-group !important;
		}

		.attendance-print-table tbody {
			display: table-row-group !important;
		}

		.attendance-print-table tr {
			page-break-inside: avoid !important;
			break-inside: avoid !important;
		}

		.attendance-print-table th {
			background: #f5f5f5 !important;
			border: 1px solid #000 !important;
			padding: 6px !important;
			text-align: center !important;
			vertical-align: middle !important;
			font-weight: bold !important;
		}

		.attendance-print-table td {
			border: 1px solid #000 !important;
			padding: 6px !important;
			text-align: center !important;
			vertical-align: middle !important;
			word-break: break-word !important;
		}


		/* =========================================
           COLUMN WIDTHS
           ========================================= */

		.attendance-print-table th:nth-child(1),
		.attendance-print-table td:nth-child(1) {
			width: 6% !important;
		}

		.attendance-print-table th:nth-child(2),
		.attendance-print-table td:nth-child(2) {
			width: 18% !important;
		}

		.attendance-print-table th:nth-child(3),
		.attendance-print-table td:nth-child(3) {
			width: 15% !important;
		}

		.attendance-print-table th:nth-child(4),
		.attendance-print-table td:nth-child(4) {
			width: 15% !important;
		}

		.attendance-print-table th:nth-child(5),
		.attendance-print-table td:nth-child(5) {
			width: 13% !important;
		}

		.attendance-print-table th:nth-child(6),
		.attendance-print-table td:nth-child(6) {
			width: 12% !important;
		}

		.attendance-print-table th:nth-child(7),
		.attendance-print-table td:nth-child(7) {
			width: 10% !important;
		}

		.attendance-print-table th:nth-child(8),
		.attendance-print-table td:nth-child(8) {
			width: 11% !important;
		}
	}
</style>
<div class="bg-white shadow rounded-xl p-6">
	<form method="post" action="<?= base_url('index.php/Reports/monthly_attendance_report') ?>">
		<div class="flex flex-wrap gap-4 mb-4">

			<div class="w-full md:w-60">
				<label class="block text-sm font-medium mb-1">From Date</label>
				<input type="date" name="from_date"
					value="<?= htmlspecialchars($from_date ?? '') ?>"
					required
					class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring focus:ring-blue-200">
			</div>

			<div class="w-full md:w-60">
				<label class="block text-sm font-medium mb-1">To Date</label>
				<input type="date" name="to_date"
					value="<?= htmlspecialchars($to_date ?? '') ?>"
					required
					class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring focus:ring-blue-200">
			</div>

			<div class="w-full md:w-60">
				<label class="block text-sm font-medium mb-1">Department</label>
				<select name="department_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm select2">
					<option value="">All</option>
					<?php foreach ($departments as $dept): ?>
						<option value="<?= $dept->department_id  ?>" <?= ($selected_dept == $dept->department_id) ? 'selected' : '' ?>>
							<?= $dept->department_name ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="flex items-end">
				<button type="submit"
					class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-5 py-2 rounded-lg shadow">
					Generate
				</button>
			</div>

		</div>
	</form>

	<!-- Right Aligned Buttons -->
	<div class="flex justify-end gap-2 mb-4">

		<button type="button"
			onclick="printMonthlyAttendanceReport()"
			class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-2 rounded-lg shadow">
			Print
		</button>

		<button type="button"
			onclick="exportMonthlyAttendanceExcel()"
			class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-lg shadow">
			Export to Excel
		</button>

	</div>


</div>

<div class="bg-white shadow rounded-xl p-6 mt-4">


	<div class="overflow-x-auto">
		<table id="monthlyAttendanceTable" class="min-w-full border border-gray-200 text-sm text-left">
			<thead class="bg-gray-100 text-gray-700">
				<tr>
					<th class="border px-3 py-2">Sr No</th>
					<!-- <th class="border px-3 py-2">Employee Code</th> -->
					<th class="border px-3 py-2">Employee Name</th>
					<th class="border px-3 py-2">Department</th>
					<th class="border px-3 py-2">Designation</th>
					<th class="border px-3 py-2">Attendance Date</th>
					<th class="border px-3 py-2">Status</th>
					<th class="border px-3 py-2">In-Time</th>
					<th class="border px-3 py-2">Out-Time</th>
				</tr>
			</thead>

			<tbody class="divide-y divide-gray-100">
				<?php if (!empty($records)): $i = 1; ?>
					<?php foreach ($records as $row): ?>
						<tr class="hover:bg-gray-50">
							<td class="border px-3 py-2"><?= $i++ ?></td>
							<!-- <td class="border px-3 py-2"><?= $row->employee_code ?></td> -->
							<td class="border px-3 py-2"><?= $row->employee_name ?></td>
							<td class="border px-3 py-2"><?= $row->department_name ?></td>
							<td class="border px-3 py-2"><?= $row->designation_name ?></td>
							<td class="border px-3 py-2"><?= date('d-M-Y', strtotime($row->Attendance_date)) ?></td>
							<td class="border px-3 py-2">
								<?= ($row->attendence == 'P') ? '<span class="text-green-600 font-semibold">Present</span>' : '<span class="text-red-600 font-semibold">Absent</span>' ?>
							</td>
							<td class="border px-3 py-2"><?= $row->in_time ?? '-' ?></td>
							<td class="border px-3 py-2"><?= $row->out_time ?? '-' ?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>

		</table>
	</div>


</div>

<div id="monthlyAttendancePrintReport">

    <?php $company_profile = get_current_company_details(); ?>
	<!-- COMPANY HEADER -->
	<table class="attendance-print-header">

		<tr>

			<td class="attendance-logo-cell">
				<img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>"
					alt="Company logo">
			</td>

			<td class="attendance-company-cell">
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


	<!-- TITLE -->
	<table class="attendance-title-table">

		<tr>

			<td width="35%">
				<b>Report:</b>
				Monthly Attendance Report
			</td>

			<td width="30%" class="attendance-report-title">
				MONTHLY ATTENDANCE REPORT
			</td>

			<td width="35%" class="attendance-report-period">
				<b>Period:</b>
				<?= !empty($from_date)
					? date('d M Y', strtotime($from_date))
					: '-' ?>
				to
				<?= !empty($to_date)
					? date('d M Y', strtotime($to_date))
					: '-' ?>
			</td>

		</tr>

	</table>


	<!-- REPORT INFORMATION -->
	<table class="attendance-info-table">

		<tr>

			<td width="50%">
				<b>Prepared by:</b>
				<?= $this->session->userdata('username') ?? '' ?>
			</td>

			<td width="50%" style="text-align:right;">
				<b>Total Records:</b>
				<?= count($records) ?>
			</td>

		</tr>

		<?php if (!empty($selected_dept)): ?>

			<?php
			$selectedDepartmentName = '';

			foreach ($departments as $dept) {

				if ($dept->department_id == $selected_dept) {
					$selectedDepartmentName = $dept->department_name;
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


	<!-- ATTENDANCE TABLE -->
	<table class="attendance-print-table">

		<thead>

			<tr>
				<th>Sr No</th>
				<th>Employee Name</th>
				<th>Department</th>
				<th>Designation</th>
				<th>Attendance Date</th>
				<th>Status</th>
				<th>In-Time</th>
				<th>Out-Time</th>
			</tr>

		</thead>

		<tbody>

			<?php if (!empty($records)): ?>

				<?php $printNo = 1; ?>

				<?php foreach ($records as $row): ?>

					<tr>

						<td>
							<?= $printNo++ ?>
						</td>

						<td>
							<?= htmlspecialchars(
								$row->employee_name ?? '-'
							) ?>
						</td>

						<td>
							<?= htmlspecialchars(
								$row->department_name ?? '-'
							) ?>
						</td>

						<td>
							<?= htmlspecialchars(
								$row->designation_name ?? '-'
							) ?>
						</td>

						<td>
							<?= !empty($row->Attendance_date)
								? date(
									'd-M-Y',
									strtotime($row->Attendance_date)
								)
								: '-' ?>
						</td>

						<td>
							<?= ($row->attendence == 'P')
								? 'Present'
								: 'Absent' ?>
						</td>

						<td>
							<?= !empty($row->in_time)
								? htmlspecialchars($row->in_time)
								: '-' ?>
						</td>

						<td>
							<?= !empty($row->out_time)
								? htmlspecialchars($row->out_time)
								: '-' ?>
						</td>

					</tr>

				<?php endforeach; ?>

			<?php else: ?>

				<tr>
					<td colspan="8">
						No attendance records found.
					</td>
				</tr>

			<?php endif; ?>

		</tbody>

	</table>

</div>

<script>
	$(document).ready(function() {

		/* Select2 */
		$('.select2').select2({
			width: '100%'
		});


		/* DataTable */
		if ($.fn.DataTable) {

			if ($.fn.DataTable.isDataTable('#monthlyAttendanceTable')) {
				$('#monthlyAttendanceTable').DataTable().destroy();
			}

			$('#monthlyAttendanceTable').DataTable({
				responsive: true,

				language: {
					emptyTable: "No attendance records found.",
					zeroRecords: "No matching attendance records found."
				}
			});
		}

	});


	/* =========================================
	   PRINT
	   ========================================= */

	function printMonthlyAttendanceReport() {

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
	   EXPORT EXCEL
	   ========================================= */

	function exportMonthlyAttendanceExcel() {

		/*
		 * Use the dedicated print table so all
		 * records are exported, not only the
		 * current DataTable page.
		 */
		const table =
			document.querySelector(
				'#monthlyAttendancePrintReport .attendance-print-table'
			);

		if (!table) {
			alert('Attendance report table not found.');
			return;
		}


		const csvRows = [];


		/* =========================================
		   TITLE
		   ========================================= */

		csvRows.push(
			escapeCSV('Monthly Attendance Report')
		);


		/* =========================================
		   DATE RANGE
		   ========================================= */

		csvRows.push(
			escapeCSV(
				'From <?= !empty($from_date)
							? date('d M Y', strtotime($from_date))
							: '-' ?>
				to <?= !empty($to_date)
						? date('d M Y', strtotime($to_date))
						: '-' ?> '
			)
		);


		/* =========================================
		   DEPARTMENT
		   ========================================= */

		<?php
		$selectedDepartmentName = '';

		if (!empty($selected_dept)) {

			foreach ($departments as $dept) {

				if ($dept->department_id == $selected_dept) {

					$selectedDepartmentName =
						$dept->department_name;

					break;
				}
			}
		}
		?>

		<?php if (!empty($selectedDepartmentName)): ?>

			csvRows.push(
				escapeCSV(
					'Department: <?= htmlspecialchars(
										$selectedDepartmentName,
										ENT_QUOTES,
										'UTF-8'
									) ?>'
				)
			);

		<?php endif; ?>


		/* =========================================
		   EMPTY ROW
		   ========================================= */

		csvRows.push('');


		/* =========================================
		   TABLE HEADER
		   ========================================= */

		csvRows.push([

			escapeCSV('Sr No'),
			escapeCSV('Employee Name'),
			escapeCSV('Department'),
			escapeCSV('Designation'),
			escapeCSV('Attendance Date'),
			escapeCSV('Status'),
			escapeCSV('In-Time'),
			escapeCSV('Out-Time')

		].join(','));


		/* =========================================
		   DATA
		   ========================================= */

		const rows =
			table.querySelectorAll('tbody tr');

		let dataCount = 0;


		rows.forEach(function(row) {

			const cells =
				row.querySelectorAll('td');


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

			const attendanceDate =
				cells[4].innerText.trim();

			const status =
				cells[5].innerText.trim();

			const inTime =
				cells[6].innerText.trim();

			const outTime =
				cells[7].innerText.trim();


			csvRows.push([

				escapeCSV(serialNo),

				escapeCSV(employee),

				escapeCSV(department),

				escapeCSV(designation),

				/* Keep date visible in Excel */
				escapeCSV('="' + attendanceDate + '"'),

				escapeCSV(status),

				escapeCSV(inTime),

				escapeCSV(outTime)

			].join(','));


			dataCount++;

		});


		if (dataCount === 0) {

			alert(
				'No attendance records available to export.'
			);

			return;
		}


		/* =========================================
		   CREATE CSV
		   ========================================= */

		const csvContent =
			'\uFEFF' +
			csvRows.join('\r\n');


		const blob =
			new Blob(
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
			'monthly_attendance_report_' +
			new Date().toISOString().slice(0, 10) +
			'.csv';


		document.body.appendChild(link);

		link.click();

		document.body.removeChild(link);


		URL.revokeObjectURL(url);

	}
</script>