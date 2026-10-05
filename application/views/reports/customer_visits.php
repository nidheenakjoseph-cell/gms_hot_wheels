<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<style>
    /* =========================================
       NORMAL VIEW
       ========================================= */

    #customerVisitTable {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    #customerVisitTable th,
    #customerVisitTable td {
        text-align: center !important;
        vertical-align: middle !important;
    }


    /* =========================================
       PRINT REPORT HIDDEN ON SCREEN
       ========================================= */

    #customerVisitPrintReport {
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


        /* Hide absolutely everything */
        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;
        }

        body * {
            visibility: hidden !important;
        }


        /* Show ONLY dedicated print report */
        #customerVisitPrintReport,
        #customerVisitPrintReport * {
            visibility: visible !important;
        }


        #customerVisitPrintReport {
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

        .customer-visit-print-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .customer-visit-print-header td {
            border: none !important;
            padding: 5px;
            vertical-align: middle;
        }

        .customer-visit-logo-cell {
            width: 20%;
            text-align: center;
        }

        .customer-visit-logo-cell img {
            max-height: 70px;
            max-width: 150px;
        }

        .customer-visit-company-cell {
            width: 80%;
            text-align: right;
            font-size: 13px;
            line-height: 1.6;
        }


        /* =========================================
           REPORT TITLE
           ========================================= */

        .customer-visit-title-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .customer-visit-title-table td {
            border: none !important;
            padding: 5px;
        }

        .customer-visit-title {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
        }

        .customer-visit-period {
            text-align: right;
        }


        /* =========================================
           REPORT INFORMATION
           ========================================= */

        .customer-visit-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 8px;
        }

        .customer-visit-info-table td {
            border: none !important;
            padding: 4px 0;
        }


        /* =========================================
           REPORT TABLE
           ========================================= */

        .customer-visit-print-table {
            width: 100% !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
        }

        .customer-visit-print-table thead {
            display: table-header-group !important;
        }

        .customer-visit-print-table tbody {
            display: table-row-group !important;
        }

        .customer-visit-print-table tr {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .customer-visit-print-table th {
            background: #f5f5f5 !important;
            border: 1px solid #000 !important;
            padding: 6px 4px !important;
            text-align: center !important;
            vertical-align: middle !important;
            font-weight: bold !important;
        }

        .customer-visit-print-table td {
            border: 1px solid #000 !important;
            padding: 6px 4px !important;
            text-align: center !important;
            vertical-align: middle !important;
            word-break: break-word !important;
        }


        /* =========================================
           STATUS
           ========================================= */

        .customer-visit-print-status {
            font-weight: bold;
        }


        /* =========================================
           TOTAL ROW
           ========================================= */

        .customer-visit-total-row td {
            font-weight: bold !important;
            background: #f5f5f5 !important;
        }


        /* =========================================
           COLUMN WIDTHS
           ========================================= */

        .customer-visit-print-table th:nth-child(1),
        .customer-visit-print-table td:nth-child(1) {
            width: 6% !important;
        }

        .customer-visit-print-table th:nth-child(2),
        .customer-visit-print-table td:nth-child(2) {
            width: 12% !important;
        }

        .customer-visit-print-table th:nth-child(3),
        .customer-visit-print-table td:nth-child(3) {
            width: 20% !important;
        }

        .customer-visit-print-table th:nth-child(4),
        .customer-visit-print-table td:nth-child(4) {
            width: 13% !important;
        }

        .customer-visit-print-table th:nth-child(5),
        .customer-visit-print-table td:nth-child(5) {
            width: 20% !important;
        }

        .customer-visit-print-table th:nth-child(6),
        .customer-visit-print-table td:nth-child(6) {
            width: 12% !important;
        }

        .customer-visit-print-table th:nth-child(7),
        .customer-visit-print-table td:nth-child(7) {
            width: 17% !important;
        }
    }
</style>
<div id="customerVisitScreenReport" class="w-full bg-white rounded-2xl shadow-md p-6">
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Customer Visit History
            </h2>

            <p class="text-sm text-gray-500">
                From
                <b><?= date('d M Y', strtotime($from)) ?></b>
                to
                <b><?= date('d M Y', strtotime($to)) ?></b>
            </p>

            <?php
            $selectedCustomerId = $this->input->get('customer_id');
            $selectedCustomerName = '';

            if (!empty($selectedCustomerId)) {
                foreach ($customers as $c) {
                    if ($c->customer_id == $selectedCustomerId) {
                        $selectedCustomerName = $c->name;
                        break;
                    }
                }
            }
            ?>

            <?php if (!empty($selectedCustomerName)): ?>
                <p class="text-sm text-gray-500 mt-1">
                    Customer:
                    <b><?= htmlspecialchars($selectedCustomerName) ?></b>
                </p>
            <?php endif; ?>
        </div>


        <!-- FILTER + ACTIONS -->
        <div class="no-print flex flex-wrap items-center gap-2">

            <form method="get"
                class="flex flex-wrap items-center gap-2">

                <input type="date"
                    name="from"
                    value="<?= $from ?>"
                    class="border rounded px-3 py-2 text-sm">

                <input type="date"
                    name="to"
                    value="<?= $to ?>"
                    class="border rounded px-3 py-2 text-sm">

                <select name="customer_id"
                    class="border rounded px-3 py-2 text-sm select2 debtor-select">

                    <option value="">All Customers</option>

                    <?php foreach ($customers as $c): ?>
                        <option value="<?= $c->customer_id ?>"
                            <?= ($this->input->get('customer_id') == $c->customer_id) ? 'selected' : '' ?>>

                            <?= htmlspecialchars($c->name) ?>
                            (<?= htmlspecialchars($c->phone) ?>)

                        </option>
                    <?php endforeach; ?>

                </select>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                    Filter
                </button>

            </form>


            <button type="button"
                onclick="printCustomerVisitReport()"
                class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 text-sm">
                Print
            </button>

            <button type="button"
                onclick="exportCustomerVisitExcel()"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                Export Excel
            </button>

        </div>

    </div>

    <!-- SUMMARY -->
    <?php
    $visitCount = count($visits);
    $customerVisits = [];

    foreach ($visits as $v) {
        $customerVisits[$v->customer_id][] = $v;
    }
    ?>

    <div class="print-hide-summary grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Total Visits</p>
            <h3 class="text-2xl font-bold text-blue-700"><?= $visitCount ?></h3>
        </div>

        <div class="bg-green-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Unique Customers</p>
            <h3 class="text-2xl font-bold text-green-700">
                <?= count($customerVisits) ?>
            </h3>
        </div>

        <div class="bg-purple-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Repeat Customers</p>
            <h3 class="text-2xl font-bold text-purple-700">
                <?= count(array_filter($customerVisits, fn($v) => count($v) > 1)) ?>
            </h3>
        </div>
    </div>

    <!-- TABLE -->
    <table id="customerVisitTable" class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th>#</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Vehicle</th>
                <th>Job Card</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($visits)): ?>
                <?php $i = 1;
                foreach ($visits as $row): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= date('d-m-Y', strtotime($row->jobcard_date)) ?></td>
                        <td><?= $row->customer_name ?></td>
                        <td><?= $row->phone ?></td>
                        <td>
                            <?= $row->registration_no ?><br>
                            <span class="text-xs text-gray-500">
                                <?= $row->brand ?> <?= $row->model ?>
                            </span>
                        </td>
                        <td><?= $row->jobcard_id ?></td>
                        <td>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
    						<?= (empty($row->status) || $row->status == 'Finished')
                                ? 'bg-green-100 text-green-700'
                                : ($row->status == 'In Progress'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : 'bg-red-100 text-red-700') ?>">

                                <?= empty($row->status) ? 'Finished' : $row->status ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">
                        No customer visits found
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<div id="customerVisitPrintReport">

    <?php $company_profile = get_current_company_details(); ?>
    <!-- COMPANY HEADER -->
    <table class="customer-visit-print-header">
        <tr>

            <td class="customer-visit-logo-cell">
                <img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>"
                    alt="Company logo">
            </td>

            <td class="customer-visit-company-cell">
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
    <table class="customer-visit-title-table">
        <tr>

            <td width="35%">
                <b>Report:</b> Customer Visit History
            </td>

            <td width="30%" class="customer-visit-title">
                CUSTOMER VISIT HISTORY
            </td>

            <td width="35%" class="customer-visit-period">
                <b>Period:</b>
                <?= date('d M Y', strtotime($from)) ?>
                to
                <?= date('d M Y', strtotime($to)) ?>
            </td>

        </tr>
    </table>


    <br>


    <!-- REPORT INFORMATION -->
    <table class="customer-visit-info-table">

        <tr>

            <td width="50%">
                <b>Prepared by:</b>
                <?= $this->session->userdata('username') ?? '' ?>
            </td>

            <td width="50%" style="text-align:right;">
                <b>Total Visits:</b>
                <?= count($visits) ?>
            </td>

        </tr>

        <?php if (!empty($selectedCustomerName)): ?>

            <tr>

                <td colspan="2">
                    <b>Customer:</b>
                    <?= htmlspecialchars($selectedCustomerName) ?>
                </td>

            </tr>

        <?php endif; ?>

    </table>


    <!-- PRINT TABLE -->
    <table class="customer-visit-print-table">

        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Vehicle</th>
                <th>Job Card</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            <?php if (!empty($visits)): ?>

                <?php $printNo = 1; ?>

                <?php foreach ($visits as $row): ?>

                    <tr>

                        <td>
                            <?= $printNo++ ?>
                        </td>

                        <td>
                            <?= date(
                                'd-m-Y',
                                strtotime($row->jobcard_date)
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row->customer_name ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row->phone ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row->registration_no ?? '-'
                            ) ?>

                            <?php if (!empty($row->brand) || !empty($row->model)): ?>
                                <br>
                                <small>
                                    <?= htmlspecialchars(
                                        trim(
                                            ($row->brand ?? '') . ' ' .
                                                ($row->model ?? '')
                                        )
                                    ) ?>
                                </small>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row->jobcard_id ?? '-'
                            ) ?>
                        </td>

                        <td class="customer-visit-print-status">
                            <?= empty($row->status)
                                ? 'Finished'
                                : htmlspecialchars($row->status) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="7">
                        No customer visits found
                    </td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>
<!-- DATATABLE -->
<!-- <script>
	document.addEventListener("DOMContentLoaded", function() {
		new simpleDatatables.DataTable("#customerVisitTable", {
			searchable: true,
			fixedHeight: true,
			perPage: 10,
			labels: {
				placeholder: "Search customer, vehicle, job card...",
				noRows: "No visits found",
				info: "Showing {start} to {end} of {rows} visits"
			}
		});
	});

	$(document).ready(function() {
		$('.debtor-select').select2({
			width: '100%'
		});
		

	});
</script> -->
<script>
    let customerVisitDataTable = null;

    function initCustomerVisitDataTable() {

        if (customerVisitDataTable) {
            return;
        }

        customerVisitDataTable = new simpleDatatables.DataTable(
            "#customerVisitTable", {
                searchable: true,
                fixedHeight: true,
                perPage: 10,
                labels: {
                    placeholder: "Search customer, vehicle, job card...",
                    noRows: "No visits found",
                    info: "Showing {start} to {end} of {rows} visits"
                }
            }
        );
    }

    document.addEventListener("DOMContentLoaded", function() {

        initCustomerVisitDataTable();

        $('.debtor-select').select2({
            width: '100%'
        });

    });
</script>
<script>
    function printCustomerVisitReport() {
        window.print();
    }
</script>
<script>
    function escapeCSV(value) {
        return '"' + String(value ?? '')
            .replace(/"/g, '""')
            .trim() + '"';
    }

    function exportCustomerVisitExcel() {

        const table = document.getElementById('customerVisitTable');

        if (!table) {
            return;
        }

        const csvRows = [];

        /* =====================================
           REPORT TITLE
           ===================================== */

        csvRows.push([
            escapeCSV('Customer Visit History')
        ].join(','));


        /* =====================================
           DATE RANGE
           ===================================== */

        csvRows.push([
            escapeCSV(
                'From <?= date('d M Y', strtotime($from)) ?> to <?= date('d M Y', strtotime($to)) ?>'
            )
        ].join(','));


        /* =====================================
           CUSTOMER
           ===================================== */

        <?php if (!empty($selectedCustomerName)): ?>

            csvRows.push([
                escapeCSV(
                    'Customer: <?= htmlspecialchars($selectedCustomerName, ENT_QUOTES, 'UTF-8') ?>'
                )
            ].join(','));

        <?php endif; ?>


        /* Empty row */
        csvRows.push('');


        /* =====================================
           TABLE HEADER
           ===================================== */

        csvRows.push([
            escapeCSV('#'),
            escapeCSV('Date'),
            escapeCSV('Customer'),
            escapeCSV('Phone'),
            escapeCSV('Vehicle'),
            escapeCSV('Job Card'),
            escapeCSV('Status')
        ].join(','));


        /* =====================================
           TABLE DATA
           ===================================== */

        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(function(row) {

            const noDataRow = row.querySelector('td[colspan]');

            if (noDataRow) {
                return;
            }

            const cells = row.querySelectorAll('td');

            if (cells.length < 7) {
                return;
            }

            const serialNo = cells[0].innerText.trim();
            const date = cells[1].innerText.trim();
            const customer = cells[2].innerText.trim();
            const phone = cells[3].innerText.trim();
            const vehicle = cells[4].innerText
                .replace(/\s+/g, ' ')
                .trim();
            const jobCard = cells[5].innerText.trim();
            const status = cells[6].innerText.trim();

            csvRows.push([
                escapeCSV(serialNo),

                /* Preserve dd-mm-yyyy in Excel */
                escapeCSV('="' + date + '"'),

                escapeCSV(customer),
                escapeCSV(phone),
                escapeCSV(vehicle),
                escapeCSV(jobCard),
                escapeCSV(status)

            ].join(','));

        });


        if (csvRows.length <= 5) {
            return;
        }


        /* =====================================
           CREATE CSV
           ===================================== */

        const csvContent =
            '\uFEFF' + csvRows.join('\r\n');

        const blob = new Blob(
            [csvContent], {
                type: 'text/csv;charset=utf-8;'
            }
        );

        const link = document.createElement('a');

        const url = URL.createObjectURL(blob);

        link.href = url;

        link.download =
            'customer_visit_history_' +
            new Date().toISOString().slice(0, 10) +
            '.csv';

        document.body.appendChild(link);

        link.click();

        document.body.removeChild(link);

        URL.revokeObjectURL(url);
    }
</script>