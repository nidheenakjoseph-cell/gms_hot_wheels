
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<style>
	#salesScreenReport .report-section {
		border: 1px solid #e5e7eb;
		border-radius: 0.75rem;
		overflow: hidden;
		background: #fff;
	}

	#salesScreenReport .report-section-header {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 1rem;
		padding: 0.9rem 1rem;
		background: #f8fafc;
		border-bottom: 1px solid #e5e7eb;
	}

	#salesScreenReport .report-section-title {
		display: flex;
		align-items: center;
		gap: 0.6rem;
		font-size: 1rem;
		font-weight: 700;
		color: #1f2937;
	}

	#salesScreenReport .report-section-icon {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 2rem;
		height: 2rem;
		border-radius: 0.5rem;
		background: #dbeafe;
		color: #1d4ed8;
	}

	#salesScreenReport .report-section-caption {
		font-size: 0.75rem;
		color: #6b7280;
	}

	#salesScreenReport th,
	#salesScreenReport td {
		text-align: center;
		vertical-align: middle;
		white-space: nowrap;
		padding: 0.75rem 1rem;
	}

	#salesScreenReport tbody tr:hover {
		background: #f8fafc;
	}

	#salesScreenReport .amount-cell {
		text-align: right;
		font-variant-numeric: tabular-nums;
	}

	#salesScreenReport td:nth-child(3),
	#salesScreenReport td:nth-child(4),
	#salesScreenReport td:nth-child(5),
	#salesScreenReport td:nth-child(6),
	#salesScreenReport td:nth-child(7) {
		text-align: right;
	}

	#salesScreenReport .no-print {
		display: inline-flex;
	}

	#salesPrintReport {
		display: none;
	}

	@media print {
		@page {
			size: A4 landscape;
			margin: 10mm;
		}

		html, body {
			background: #fff !important;
			margin: 0 !important;
			padding: 0 !important;
		}

		body * {
			visibility: hidden;
		}

		#salesPrintReport,
		#salesPrintReport * {
			visibility: visible !important;
		}

		#salesPrintReport {
			display: block !important;
			position: absolute;
			left: 0;
			top: 0;
			width: 100%;
			padding: 0;
			margin: 0;
			background: #fff;
		}

		#salesScreenReport {
			display: none !important;
		}

		.no-print,
		.no-print * {
			display: none !important;
		}
	}
</style>

<div id="salesScreenReport" class="w-full bg-white rounded-2xl shadow-md p-6">
	<div class="flex justify-between items-center mb-6 gap-4 flex-wrap">
		<div>
			<h2 class="text-2xl font-bold text-gray-800">Total Sales Report</h2>
			<p class="text-sm text-gray-500">
				Showing sales for
				<span id="report_period" class="font-semibold">
					<?= date('d M Y', strtotime($from_date)) ?>
				</span>
			</p>
		</div>

		<form class="no-print flex flex-wrap items-end gap-2" onsubmit="return false;">
			<div>
				<label for="from_date" class="block text-xs font-semibold text-gray-600 mb-1">From Date</label>
				<input type="date" id="from_date" class="border rounded px-3 py-2 text-sm" value="<?= htmlspecialchars($from_date, ENT_QUOTES, 'UTF-8') ?>">
			</div>
			<div>
				<label for="to_date" class="block text-xs font-semibold text-gray-600 mb-1">To Date</label>
				<input type="date" id="to_date" class="border rounded px-3 py-2 text-sm" value="<?= htmlspecialchars($to_date, ENT_QUOTES, 'UTF-8') ?>">
			</div>
			<div>
				<label for="customer_id" class="block text-xs font-semibold text-gray-600 mb-1">Customer</label>
				<select id="customer_id" class="border rounded px-3 py-2 text-sm w-64">
					<option value="">All Customers</option>
					<?php foreach ($customers as $customer): ?>
						<option value="<?= (int) ($customer->customer_id ?? $customer->id) ?>">
							<?= htmlspecialchars((string) ($customer->name ?? $customer->customer_name ?? ''), ENT_QUOTES, 'UTF-8') ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<div>
				<label for="invoice_no" class="block text-xs font-semibold text-gray-600 mb-1">Invoice No.</label>
				<input type="text" id="invoice_no" class="border rounded px-3 py-2 text-sm" placeholder="Search invoice">
			</div>
			<button type="button" id="filter_btn" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
				Filter
			</button>
			<button type="button" id="reset_btn" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 text-sm">
				Today
			</button>
			<button type="button" id="print_btn" class="px-4 py-2 bg-slate-600 text-white rounded hover:bg-slate-700 text-sm">
				Print
			</button>
			<button type="button" id="export_btn" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
				Export Excel
			</button>
		</form>
	</div>

	<div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
		<div class="bg-blue-50 p-4 rounded-xl">
			<p class="text-sm text-gray-500">Invoices</p>
			<p id="total_invoices" class="text-2xl font-bold text-blue-700">0</p>
		</div>
		<div class="bg-green-50 p-4 rounded-xl">
			<p class="text-sm text-gray-500">Gross Sales</p>
			<p id="gross_sales" class="text-2xl font-bold text-green-700">0.00</p>
		</div>
		<div class="bg-yellow-50 p-4 rounded-xl">
			<p class="text-sm text-gray-500">Discount</p>
			<p id="discount" class="text-2xl font-bold text-yellow-700">0.00</p>
		</div>
		<div class="bg-purple-50 p-4 rounded-xl">
			<p class="text-sm text-gray-500">VAT</p>
			<p id="vat" class="text-2xl font-bold text-purple-700">0.00</p>
		</div>
		<div class="bg-red-50 p-4 rounded-xl">
			<p class="text-sm text-gray-500">Net Sales</p>
			<p id="net_sales" class="text-2xl font-bold text-red-700">0.00</p>
		</div>
	</div>

	<div class="report-section mb-6">
		<div class="report-section-header">
			<div class="report-section-title">
				<span class="report-section-icon"><i class="bi bi-calendar3"></i></span>
				<span>Daily Sales Summary</span>
			</div>
			<span id="daily_sales_count" class="report-section-caption">0 days</span>
		</div>
		<div class="overflow-x-auto">
		<table class="w-full text-sm" id="daily_sales_table">
				<thead class="bg-gray-100 text-gray-600 uppercase text-xs">
					<tr>
						<th>Date</th>
						<th>Invoices</th>
						<th>Gross Sales</th>
						<th>Discount</th>
						<th>VAT</th>
						<th>Net Sales</th>
					</tr>
				</thead>
				<tbody></tbody>
		</table>
	</div>
</div>

	<div class="report-section">
		<div class="report-section-header">
			<div class="report-section-title">
				<span class="report-section-icon"><i class="bi bi-receipt"></i></span>
				<span>Invoice Details</span>
			</div>
			<span id="invoice_count" class="report-section-caption">0 invoices</span>
		</div>
		<div class="overflow-x-auto">
		<table class="w-full text-sm" id="sales_table">
				<thead class="bg-gray-100 text-gray-600 uppercase text-xs">
					<tr>
						<th>Date</th>
						<th>Invoice</th>
						<th>Customer</th>
						<th>Gross</th>
						<th>Discount</th>
						<th>VAT</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody></tbody>
		</table>
	</div>
</div>

</div>

<div id="salesPrintReport" class="text-gray-800"></div>

<script>
function buildPrintReport() {
	const periodText = $('#report_period').text().trim();
	const summary = {
		total_invoices: $('#total_invoices').text().trim(),
		gross_sales: $('#gross_sales').text().trim(),
		discount: $('#discount').text().trim(),
		vat: $('#vat').text().trim(),
		net_sales: $('#net_sales').text().trim()
	};

	const buildDailyRows = () => {
		const rows = $('#daily_sales_table tbody tr');
		if (!rows.length) {
			return '<tr><td colspan="6" style="padding:12px;text-align:center;">No sales found for the selected dates.</td></tr>';
		}

		let html = '';
		rows.each(function () {
			const cells = $(this).find('td');
			if (cells.length === 1 && cells.first().attr('colspan')) {
				return;
			}
			html += '<tr>' +
				'<td style="padding:8px;border:1px solid #d1d5db;">' + cells.eq(0).text().trim() + '</td>' +
				'<td style="padding:8px;border:1px solid #d1d5db;text-align:center;">' + cells.eq(1).text().trim() + '</td>' +
				'<td style="padding:8px;border:1px solid #d1d5db;text-align:right;">' + cells.eq(2).text().trim() + '</td>' +
				'<td style="padding:8px;border:1px solid #d1d5db;text-align:right;">' + cells.eq(3).text().trim() + '</td>' +
				'<td style="padding:8px;border:1px solid #d1d5db;text-align:right;">' + cells.eq(4).text().trim() + '</td>' +
				'<td style="padding:8px;border:1px solid #d1d5db;text-align:right;">' + cells.eq(5).text().trim() + '</td>' +
			'</tr>';
		});
		return html;
	};

	const buildDetailRows = () => {
		const rows = $('#sales_table tbody tr');
		if (!rows.length) {
			return '<tr><td colspan="7" style="padding:12px;text-align:center;">No invoice details found.</td></tr>';
		}

		let html = '';
		rows.each(function () {
			const cells = $(this).find('td');
			if (cells.length === 1 && cells.first().attr('colspan')) {
				return;
			}
			html += '<tr>' +
				'<td style="padding:8px;border:1px solid #d1d5db;">' + cells.eq(0).text().trim() + '</td>' +
				'<td style="padding:8px;border:1px solid #d1d5db;">' + cells.eq(1).text().trim() + '</td>' +
				'<td style="padding:8px;border:1px solid #d1d5db;">' + cells.eq(2).text().trim() + '</td>' +
				'<td style="padding:8px;border:1px solid #d1d5db;text-align:right;">' + cells.eq(3).text().trim() + '</td>' +
				'<td style="padding:8px;border:1px solid #d1d5db;text-align:right;">' + cells.eq(4).text().trim() + '</td>' +
				'<td style="padding:8px;border:1px solid #d1d5db;text-align:right;">' + cells.eq(5).text().trim() + '</td>' +
				'<td style="padding:8px;border:1px solid #d1d5db;text-align:right;">' + cells.eq(6).text().trim() + '</td>' +
			'</tr>';
		});
		return html;
	};

	const printHtml = `
		<div style="padding:20px; font-family: Arial, sans-serif; color:#111827; background:#fff;">
			<div style="margin-bottom:18px; border-bottom:2px solid #e5e7eb; padding-bottom:12px;">
				<h1 style="margin:0 0 8px; font-size:28px; font-weight:700;">Total Sales Report</h1>
				<p style="margin:0; font-size:14px; color:#4b5563;">Showing sales for <strong>${periodText}</strong></p>
			</div>

			<div style="display:grid; grid-template-columns: repeat(5, minmax(120px, 1fr)); gap:12px; margin-bottom:18px;">
				<div style="border:1px solid #dbeafe; background:#eff6ff; padding:12px; border-radius:10px;">
					<div style="font-size:12px; color:#4b5563;">Invoices</div>
					<div style="font-size:24px; font-weight:700; color:#1d4ed8; margin-top:4px;">${summary.total_invoices}</div>
				</div>
				<div style="border:1px solid #bbf7d0; background:#f0fdf4; padding:12px; border-radius:10px;">
					<div style="font-size:12px; color:#4b5563;">Gross Sales</div>
					<div style="font-size:24px; font-weight:700; color:#15803d; margin-top:4px;">${summary.gross_sales}</div>
				</div>
				<div style="border:1px solid #fde68a; background:#fefce8; padding:12px; border-radius:10px;">
					<div style="font-size:12px; color:#4b5563;">Discount</div>
					<div style="font-size:24px; font-weight:700; color:#a16207; margin-top:4px;">${summary.discount}</div>
				</div>
				<div style="border:1px solid #ddd6fe; background:#faf5ff; padding:12px; border-radius:10px;">
					<div style="font-size:12px; color:#4b5563;">VAT</div>
					<div style="font-size:24px; font-weight:700; color:#7c3aed; margin-top:4px;">${summary.vat}</div>
				</div>
				<div style="border:1px solid #fecaca; background:#fef2f2; padding:12px; border-radius:10px;">
					<div style="font-size:12px; color:#4b5563;">Net Sales</div>
					<div style="font-size:24px; font-weight:700; color:#b91c1c; margin-top:4px;">${summary.net_sales}</div>
				</div>
			</div>

			<div style="border:1px solid #e5e7eb; border-radius:12px; overflow:hidden; margin-bottom:18px;">
				<div style="background:#f8fafc; border-bottom:1px solid #e5e7eb; padding:12px 14px; display:flex; justify-content:space-between; align-items:center; font-weight:700;">
					<span>Daily Sales Summary</span>
					<span style="font-size:12px; color:#6b7280;">${$('#daily_sales_count').text().trim()}</span>
				</div>
				<table style="width:100%; border-collapse:collapse; font-size:12px;">
					<thead style="background:#f3f4f6;">
						<tr>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:center;">Date</th>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:center;">Invoices</th>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:right;">Gross Sales</th>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:right;">Discount</th>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:right;">VAT</th>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:right;">Net Sales</th>
						</tr>
					</thead>
					<tbody>
						${buildDailyRows()}
					</tbody>
				</table>
			</div>

			<div style="border:1px solid #e5e7eb; border-radius:12px; overflow:hidden;">
				<div style="background:#f8fafc; border-bottom:1px solid #e5e7eb; padding:12px 14px; display:flex; justify-content:space-between; align-items:center; font-weight:700;">
					<span>Invoice Details</span>
					<span style="font-size:12px; color:#6b7280;">${$('#invoice_count').text().trim()}</span>
				</div>
				<table style="width:100%; border-collapse:collapse; font-size:12px;">
					<thead style="background:#f3f4f6;">
						<tr>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:center;">Date</th>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:center;">Invoice</th>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:center;">Customer</th>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:right;">Gross</th>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:right;">Discount</th>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:right;">VAT</th>
							<th style="padding:10px; border:1px solid #d1d5db; text-align:right;">Total</th>
						</tr>
					</thead>
					<tbody>
						${buildDetailRows()}
					</tbody>
				</table>
			</div>
		</div>
	`;

	$('#salesPrintReport').html(printHtml);
}

function formatAmount(value) {
	return parseFloat(value || 0).toFixed(2);
}

function escapeCsv(value) {
	return '"' + String(value ?? '').replace(/"/g, '""').trim() + '"';
}

function escapeExcelDate(value) {
	return escapeCsv("'" + String(value ?? '').trim());
}

function exportSalesExcel() {
	const rows = [];
	const periodText = $('#report_period').text().trim();

	rows.push([escapeCsv('Total Sales Report'), escapeCsv(periodText)].join(','));
	rows.push([
		escapeCsv('Invoices'),
		escapeCsv($('#total_invoices').text().trim()),
		escapeCsv('Gross Sales'),
		escapeCsv($('#gross_sales').text().trim()),
		escapeCsv('Discount'),
		escapeCsv($('#discount').text().trim()),
		escapeCsv('VAT'),
		escapeCsv($('#vat').text().trim()),
		escapeCsv('Net Sales'),
		escapeCsv($('#net_sales').text().trim())
	].join(','));
	rows.push('');
	rows.push([
		escapeCsv('Date'),
		escapeCsv('Invoices'),
		escapeCsv('Gross Sales'),
		escapeCsv('Discount'),
		escapeCsv('VAT'),
		escapeCsv('Net Sales')
	].join(','));

	const dailyRows = $('#daily_sales_table tbody tr');
	let hasDailyData = false;
	if (dailyRows.length) {
		dailyRows.each(function () {
			const cells = $(this).find('td');
			if (cells.length === 1 && cells.first().attr('colspan')) {
				return;
			}
			hasDailyData = true;
			rows.push([
				escapeExcelDate(cells.eq(0).text()),
				escapeCsv(cells.eq(1).text().trim()),
				escapeCsv(cells.eq(2).text().trim()),
				escapeCsv(cells.eq(3).text().trim()),
				escapeCsv(cells.eq(4).text().trim()),
				escapeCsv(cells.eq(5).text().trim())
			].join(','));
		});
	}

	if (hasDailyData) {
		rows.push('');
	}
	rows.push([
		escapeCsv('Date'),
		escapeCsv('Invoice'),
		escapeCsv('Customer'),
		escapeCsv('Gross'),
		escapeCsv('Discount'),
		escapeCsv('VAT'),
		escapeCsv('Total')
	].join(','));

	const detailRows = $('#sales_table tbody tr');
	let hasDetailData = false;
	if (detailRows.length) {
		detailRows.each(function () {
			const cells = $(this).find('td');
			if (cells.length === 1 && cells.first().attr('colspan')) {
				return;
			}
			hasDetailData = true;
			rows.push([
				escapeExcelDate(cells.eq(0).text()),
				escapeCsv(cells.eq(1).text().trim()),
				escapeCsv(cells.eq(2).text().trim()),
				escapeCsv(cells.eq(3).text().trim()),
				escapeCsv(cells.eq(4).text().trim()),
				escapeCsv(cells.eq(5).text().trim()),
				escapeCsv(cells.eq(6).text().trim())
			].join(','));
		});
	}

	if (!hasDailyData && !hasDetailData) {
		alert('No data available to export.');
		return;
	}

	const csvContent = '\uFEFF' + rows.join('\r\n');
	const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
	const link = document.createElement('a');
	const url = URL.createObjectURL(blob);
	link.href = url;
	link.download = 'total_sales_' + new Date().toISOString().slice(0, 10) + '.csv';
	document.body.appendChild(link);
	link.click();
	document.body.removeChild(link);
	URL.revokeObjectURL(url);
}

function printSalesReport() {
	buildPrintReport();
	window.print();
}

function updateReportPeriod(fromDate, toDate) {
	const from = new Date(fromDate + 'T00:00:00');
	const to = new Date(toDate + 'T00:00:00');
	const format = { day: '2-digit', month: 'short', year: 'numeric' };
	$('#report_period').text(fromDate === toDate
		? from.toLocaleDateString('en-GB', format)
		: from.toLocaleDateString('en-GB', format) + ' - ' + to.toLocaleDateString('en-GB', format));
}

function loadSalesReport() {
	const fromDate = $('#from_date').val();
	const toDate = $('#to_date').val();

	if (!fromDate || !toDate || fromDate > toDate) {
		alert('Please select a valid date range.');
		return;
	}

	$('#filter_btn').prop('disabled', true).text('Loading...');

	$.ajax({
		url: "<?= site_url('Reports/total_sales_data') ?>",
		type: 'POST',
		dataType: 'json',
		data: {
			from_date: fromDate,
			to_date: toDate,
			customer_id: $('#customer_id').val(),
			invoice_no: $('#invoice_no').val()
		},
		success: function (response) {
			if (!response.status) {
				alert(response.message || 'Unable to load sales report.');
				return;
			}

			const summary = response.summary || {};
			$('#total_invoices').text(summary.total_invoices || 0);
			$('#gross_sales').text(formatAmount(summary.gross_sales));
			$('#discount').text(formatAmount(summary.discount));
			$('#vat').text(formatAmount(summary.vat));
			$('#net_sales').text(formatAmount(summary.net_sales));
			updateReportPeriod(fromDate, toDate);

			let dailyHtml = '';
			$.each(response.daily || [], function (index, row) {
				dailyHtml += '<tr>' +
					'<td>' + row.sale_date + '</td>' +
					'<td>' + row.invoice_count + '</td>' +
					'<td class="amount-cell">' + formatAmount(row.gross_sales) + '</td>' +
					'<td class="amount-cell">' + formatAmount(row.discount) + '</td>' +
					'<td class="amount-cell">' + formatAmount(row.vat) + '</td>' +
					'<td class="amount-cell">' + formatAmount(row.net_sales) + '</td>' +
					'</tr>';
			});
			$('#daily_sales_count').text((response.daily || []).length + ((response.daily || []).length === 1 ? ' day' : ' days'));
			$('#daily_sales_table tbody').html(dailyHtml || '<tr><td colspan="6" class="py-8 text-center text-gray-500"><i class="bi bi-calendar-x text-xl d-block mb-2"></i>No sales found for the selected dates.</td></tr>');

			let detailHtml = '';
			$.each(response.details || [], function (index, row) {
				detailHtml += '<tr>' +
					'<td>' + row.invoice_date + '</td>' +
					'<td>' + row.invoice_no + '</td>' +
					'<td>' + (row.customer_name || '') + '</td>' +
					'<td class="amount-cell">' + formatAmount(row.sub_total) + '</td>' +
					'<td class="amount-cell">' + formatAmount(row.discount) + '</td>' +
					'<td class="amount-cell">' + formatAmount(row.tax_amount) + '</td>' +
					'<td class="amount-cell">' + formatAmount(row.grand_total) + '</td>' +
					'</tr>';
			});
			$('#invoice_count').text((response.details || []).length + ((response.details || []).length === 1 ? ' invoice' : ' invoices'));
			$('#sales_table tbody').html(detailHtml || '<tr><td colspan="7" class="py-8 text-center text-gray-500"><i class="bi bi-receipt text-xl d-block mb-2"></i>No invoice details found.</td></tr>');
			buildPrintReport();
		},
		error: function (xhr) {
			const message = xhr.responseJSON && xhr.responseJSON.message
				? xhr.responseJSON.message
				: 'Unable to load sales report.';
			alert(message);
		},
		complete: function () {
			$('#filter_btn').prop('disabled', false).text('Filter');
		}
	});
}

$('#filter_btn').on('click', loadSalesReport);
$('#reset_btn').on('click', function () {
	const today = '<?= date('Y-m-d') ?>';
	$('#from_date').val(today);
	$('#to_date').val(today);
	$('#customer_id').val('').trigger('change');
	$('#invoice_no').val('');
	loadSalesReport();
});
$('#print_btn').on('click', printSalesReport);
$('#export_btn').on('click', exportSalesExcel);

$(document).ready(function () {
	$('#customer_id').select2({
		placeholder: 'All Customers',
		allowClear: true,
		width: '256px'
	});
	buildPrintReport();
	loadSalesReport();
});
</script>
