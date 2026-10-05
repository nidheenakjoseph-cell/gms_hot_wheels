<div class="p-4 bg-white rounded-lg shadow">
	<!-- <div class="mb-4">
		<h3 class="text-xl font-semibold text-gray-700">VAT Report</h3>
		<p class="text-sm text-gray-500 mt-1">
			Report Period:
			<span class="font-medium text-gray-700" id="report_period_text">
				<?php echo isset($from_date) ? date('d-M-Y', strtotime($from_date)) : ''; ?>
				—
				<?php echo isset($to_date) ? date('d-M-Y', strtotime($to_date)) : ''; ?>
			</span>
		</p>
	</div> -->

	<div class="text-center mb-5">
    <!-- <h2 class="text-2xl font-bold uppercase">
        <?php echo $company_records[0]->company_name; ?>
    </h2> -->

    <h2 class="text-2xl font-bold uppercase">
        VAT Report
    </h2>
       <p class="text-sm text-gray-500 mt-1">
			Report Period:
			<span class="font-medium text-gray-700" id="report_period_text">
				<?php echo isset($from_date) ? date('d-M-Y', strtotime($from_date)) : ''; ?>
				—
				<?php echo isset($to_date) ? date('d-M-Y', strtotime($to_date)) : ''; ?>
			</span>
		</p>
</div>

	<form id="ledger_report_form" method="post" action="<?php echo base_url('index.php/Accounts/tax_report_details'); ?>" class="space-y-4" autocomplete="off">
		<div class="flex flex-wrap items-end gap-4">
			<div class="w-full sm:w-48">
				<label class="block text-sm font-medium text-gray-600 mb-1">From Date <span class="text-red-500">*</span></label>
				<input type="date" class="w-full border rounded-md px-3 py-2 text-sm" id="from_date" name="from_date" value="<?php echo date('Y-m-d', strtotime($from_date ?? date('Y-m-01'))); ?>" required>
			</div>

			<div class="w-full sm:w-48">
				<label class="block text-sm font-medium text-gray-600 mb-1">To Date <span class="text-red-500">*</span></label>
				<input type="date" class="w-full border rounded-md px-3 py-2 text-sm" id="to_date" name="to_date" value="<?php echo date('Y-m-d', strtotime($to_date ?? date('Y-m-d'))); ?>" required>
			</div>

			<div class="w-full sm:w-48">
				<label class="block text-sm font-medium text-gray-600 mb-1">Report Type <span class="text-red-500">*</span></label>
				<select name="report_type" id="report_type" class="w-full border rounded-md px-3 py-2 text-sm" required>
					<option value="">Select Type</option>
					<option value="summary" <?php echo (isset($report_type) && $report_type === 'summary') ? 'selected' : ''; ?>>Summary</option>
					<option value="detailed" <?php echo (isset($report_type) && $report_type === 'detailed') ? 'selected' : ''; ?>>Detailed</option>
				</select>
			</div>

			<div class="w-full sm:w-auto">
				<button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm cursor-pointer">
					<i class="fa fa-search mr-1"></i> Generate
				</button>
			</div>

			<div class="w-full sm:w-auto">
				<button type="button" onclick="printReport()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm cursor-pointer">
					<i class="fa fa-print mr-1"></i> Print
				</button>
			</div>

			<div class="w-full sm:w-auto">
				<button type="button" onclick="exportExcel()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm cursor-pointer">
					<i class="fa fa-file-excel-o mr-1"></i> Excel Export
				</button>
			</div>
		</div>
	</form>

	<div id="report_result" class="mt-6"></div>
</div>

<script>
	<?php $company_profile = get_current_company_details(); ?>
	const vatReportCompany = <?= json_encode([
		'logo' => get_current_company_logo_url('public/images/logoauto1.png', $company_profile),
		'name' => $company_profile->company_name ?? '',
		'address' => implode(', ', array_filter([
			$company_profile->company_address ?? '',
			$company_profile->company_city ?? '',
			$company_profile->company_state ?? '',
			$company_profile->company_pincode ?? '',
			$company_profile->company_country ?? '',
		])),
		'website' => $company_profile->company_website ?? '',
		'email' => $company_profile->company_email_id ?? '',
		'telephone' => $company_profile->company_telephone ?? '',
		'trn' => $company_profile->company_TRN ?? '',
	], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

	function escapeVatPrintHtml(value) {
		return String(value ?? '').replace(/[&<>"']/g, function(character) {
			return {
				'&': '&amp;',
				'<': '&lt;',
				'>': '&gt;',
				'"': '&quot;',
				"'": '&#039;'
			}[character];
		});
	}

	$(document).ready(function() {
		$('#ledger_report_form').on('submit', function(e) {
			e.preventDefault(); // Prevent page reload

			var formData = $(this).serialize(); // Convert form data to string

			// Show a loading message
			$('#report_result').html('<p class="text-center">Loading report...</p>');

			$.ajax({
				url: $(this).attr('action'), // form action
				type: 'POST',
				data: formData,
				success: function(response) {
					// Replace the report container with returned HTML
					$('#report_result').html(response);
				},
				error: function() {
					$('#report_result').html('<p class="text-danger text-center">Error fetching report.</p>');
				}
			});
		});
	});


	function printReport() {

		var reportContent = document.getElementById('report_result').innerHTML;
		if (reportContent.trim() === '') {
			alert('Please generate report first');
			return;
		}

		var w = window.open('', '_blank');
		if (!w) {
			alert('Please allow pop-ups to print the report');
			return;
		}

		var companyContacts = [vatReportCompany.website, vatReportCompany.email, vatReportCompany.telephone, vatReportCompany.trn ? 'TRN: ' + vatReportCompany.trn : '']
			.filter(Boolean)
			.map(escapeVatPrintHtml);

		w.document.write(`
				<html>
				<head>
				<title>VAT Report</title>

				<style>

				body{
					font-family: Arial, sans-serif;
					font-size:12px;
					background:#fff;
				}

				.page{
					width:800px;
					margin:0 auto;
				}

				.header{
					display:flex;
					align-items:center;
				justify-content:space-between;
					gap:20px;
					border-bottom:2px solid #000;
					padding-bottom:10px;
					margin-bottom:15px;
				}

				.logo{
					max-width:150px;
					max-height:70px;
					object-fit:contain;
				}

				.company{
					text-align:right;
					line-height:18px;
				}

				.company b{
					font-size:16px;
				}

				table{
					width:100%;
					border-collapse:collapse;
				}

				th,td{
					border:1px solid #000;
					padding:5px;
				}

				th{
					background:#eee;
				}

				td.text-right{
					text-align:right;
				}

				.footer{
					text-align:center;
					margin-top:40px;
				}

				.footer img{
					width:200px;
					opacity:.9;
				}
					.header{
				display:flex;
				align-items:center;
				justify-content:space-between;
				border-bottom:2px solid #000;
				padding-bottom:10px;
				margin-bottom:15px;
			}

			.company{
				text-align:right;
				line-height:18px;
			}

			.company b{
				font-size:16px;
			}

				@media print{

					@page{
						size:A4;
						margin:20mm;
					}

				}

				</style>

				</head>

				<body>

				<div class="page">

					<div class="header" style="display: flex;
						justify-content: space-between;">
						<img src="${escapeVatPrintHtml(vatReportCompany.logo)}" class="logo" alt="Company logo">

						<div class="company">
							<strong>${escapeVatPrintHtml(vatReportCompany.name)}</strong><br>
							${vatReportCompany.address ? `${escapeVatPrintHtml(vatReportCompany.address)}<br>` : ''}
							${companyContacts.join(' | ')}
						</div>
					</div>

					${reportContent}

					<div class="footer">
						
					</div>

				</div>

				</body>
				</html>
				`);

		w.document.close();

		setTimeout(() => {
			w.print();
			w.close();
		}, 500);

	}

	function exportExcel() {
		var reportDiv = document.getElementById("report_result");


		if (reportDiv.innerHTML.trim() === "") {
			alert("Please generate report first");
			return;
		}

		var content = reportDiv.innerHTML;

		var template = `
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"/>

    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>VAT Report</x:Name>
                    <x:WorksheetOptions>
                        <x:DisplayGridlines/>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->

    <style>
        body{font-family:Arial;font-size:12px;}
        table{border-collapse:collapse;width:100%;margin-bottom:20px;}
        th{background:#d9d9d9;border:1px solid #000;padding:6px;text-align:left;font-weight:bold;}
        td{border:1px solid #000;padding:6px;}
        .text-right{text-align:right;}
        .total{font-weight:bold;background:#f2f2f2;}
    </style>

</head>

<body>

    <h2>VAT Report</h2>
    ${content}

</body>
</html>
`;

		var blob = new Blob([template], {
			type: "application/vnd.ms-excel;charset=utf-8;"
		});

		var link = document.createElement("a");
		document.body.appendChild(link);

		link.href = URL.createObjectURL(blob);
		link.download = "VAT_Report.xls";
		link.click();

		document.body.removeChild(link);


	}


	function exportExcel11() {
		var reportDiv = document.getElementById("report_result");

		if (reportDiv.innerHTML.trim() === "") {
			alert("Please generate report first");
			return;
		}

		var content = reportDiv.innerHTML;

		var excelFile = `
				<html xmlns:o="urn:schemas-microsoft-com:office:office"
				xmlns:x="urn:schemas-microsoft-com:office:excel"
				xmlns="http://www.w3.org/TR/REC-html40">

				<head>
					<meta charset="utf-8">

					<style>
						body{
							font-family: Arial;
							font-size:12px;
						}

						h3{
							margin-top:25px;
							margin-bottom:5px;
						}

						table{
							border-collapse:collapse;
							width:100%;
							margin-bottom:20px;
						}

						th{
							background:#d9d9d9;
							border:1px solid #000;
							padding:6px;
							text-align:left;
							font-weight:bold;
						}

						td{
							border:1px solid #000;
							padding:6px;
						}

						.text-right{
							text-align:right;
						}

						.total{
							font-weight:bold;
							background:#f2f2f2;
						}

					</style>

				</head>

				<body>

					<h2>VAT Report</h2>

					${content}

				</body>
				</html>
				`;

		var blob = new Blob([excelFile], {
			type: "application/vnd.ms-excel"
		});

		var link = document.createElement("a");
		link.href = URL.createObjectURL(blob);
		link.download = "VAT_Report.xls";
		document.body.appendChild(link);
		link.click();
		document.body.removeChild(link);


	}
</script>

<script id="x3fd8k">
	function formatDateForCaption(dateStr) {
		let d = new Date(dateStr);
		let day = String(d.getDate()).padStart(2, '0');
		let month = d.toLocaleString('en-GB', {
			month: 'short'
		});
		let year = d.getFullYear();
		return day + '-' + month + '-' + year;
	}

	function updateReportCaption() {
		let from = document.getElementById('from_date').value;
		let to = document.getElementById('to_date').value;

		if (from && to) {
			document.getElementById('report_period_text').innerText =
				formatDateForCaption(from) + " — " + formatDateForCaption(to);
		}
	}

	document.getElementById('from_date').addEventListener('change', updateReportCaption);
	document.getElementById('to_date').addEventListener('change', updateReportCaption);
</script>
