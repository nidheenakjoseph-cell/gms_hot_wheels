<style>
    /* =========================================
       NORMAL VIEW
       ========================================= */

    #inventoryUsageTable {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    #inventoryUsageTable th,
    #inventoryUsageTable td {
        text-align: center !important;
        vertical-align: middle !important;
    }


    /* =========================================
       PRINT REPORT HIDDEN ON SCREEN
       ========================================= */

    #inventoryPrintReport {
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


        /* =====================================
           HIDE EVERYTHING
           ===================================== */

        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            background: #fff !important;
        }

        body * {
            visibility: hidden !important;
        }


        /* =====================================
           SHOW ONLY PRINT REPORT
           ===================================== */

        #inventoryPrintReport,
        #inventoryPrintReport * {
            visibility: visible !important;
        }


        /* =====================================
           FORCE PRINT REPORT TO PAGE TOP
           ===================================== */

        #inventoryPrintReport {
            display: block !important;

            position: absolute !important;

            top: 0 !important;
            left: 0 !important;

            width: 100% !important;

            margin: 0 !important;
            padding: 0 !important;

            background: #fff !important;

            color: #000 !important;

            box-shadow: none !important;

            border: none !important;

            z-index: 999999 !important;
        }


        /* =====================================
           HIDE NORMAL PAGE
           ===================================== */

        #inventoryScreenReport {
            display: none !important;
            visibility: hidden !important;
        }


        /* =====================================
           COMPANY HEADER
           ===================================== */

        .inventory-print-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .inventory-print-header td {
            border: none !important;
            padding: 5px;
            vertical-align: middle;
        }

        .inventory-logo-cell {
            width: 20%;
            text-align: center;
        }

        .inventory-logo-cell img {
            max-height: 70px;
            max-width: 150px;
        }

        .inventory-company-cell {
            width: 80%;
            text-align: right;
            font-size: 13px;
            line-height: 1.6;
        }


        /* =====================================
           REPORT TITLE
           ===================================== */

        .inventory-title-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .inventory-title-table td {
            border: none !important;
            padding: 5px;
        }

        .inventory-report-title {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
        }

        .inventory-report-period {
            text-align: right;
        }


        /* =====================================
           INFO
           ===================================== */

        .inventory-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 8px;
        }

        .inventory-info-table td {
            border: none !important;
            padding: 4px 0;
        }


        /* =====================================
           TABLE
           ===================================== */

        .inventory-print-table {
            width: 100% !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
        }

        .inventory-print-table thead {
            display: table-header-group !important;
        }

        .inventory-print-table tbody {
            display: table-row-group !important;
        }

        .inventory-print-table tr {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .inventory-print-table th {
            background: #f5f5f5 !important;
            border: 1px solid #000 !important;
            padding: 6px 4px !important;
            text-align: center !important;
            vertical-align: middle !important;
            font-weight: bold !important;
        }

        .inventory-print-table td {
            border: 1px solid #000 !important;
            padding: 6px 4px !important;
            text-align: center !important;
            vertical-align: middle !important;
            word-break: break-word !important;
        }


        /* =====================================
           TOTAL
           ===================================== */

        .inventory-total-row td {
            font-weight: bold !important;
            background: #f5f5f5 !important;
        }


        /* =====================================
           COLUMN WIDTHS
           ===================================== */

        .inventory-print-table th:nth-child(1),
        .inventory-print-table td:nth-child(1) {
            width: 6% !important;
        }

        .inventory-print-table th:nth-child(2),
        .inventory-print-table td:nth-child(2) {
            width: 11% !important;
        }

        .inventory-print-table th:nth-child(3),
        .inventory-print-table td:nth-child(3) {
            width: 13% !important;
        }

        .inventory-print-table th:nth-child(4),
        .inventory-print-table td:nth-child(4) {
            width: 19% !important;
        }

        .inventory-print-table th:nth-child(5),
        .inventory-print-table td:nth-child(5) {
            width: 8% !important;
        }

        .inventory-print-table th:nth-child(6),
        .inventory-print-table td:nth-child(6) {
            width: 13% !important;
        }

        .inventory-print-table th:nth-child(7),
        .inventory-print-table td:nth-child(7) {
            width: 20% !important;
        }

        .inventory-print-table th:nth-child(8),
        .inventory-print-table td:nth-child(8) {
            width: 10% !important;
        }
    }
</style>
<div id="inventoryScreenReport" class="w-full bg-white rounded-2xl shadow-md p-6">
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Inventory Usage Report
            </h2>

            <p class="text-sm text-gray-500">
                From
                <b><?= date('d M Y', strtotime($from)) ?></b>
                to
                <b><?= date('d M Y', strtotime($to)) ?></b>
            </p>
        </div>

        <!-- FILTER + ACTIONS -->
        <div class="no-print flex flex-wrap items-center gap-2">

            <form method="get" class="flex items-center gap-2">

                <input type="date"
                    name="from"
                    value="<?= $from ?>"
                    class="border rounded px-3 py-2 text-sm">

                <input type="date"
                    name="to"
                    value="<?= $to ?>"
                    class="border rounded px-3 py-2 text-sm">

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                    Filter
                </button>

            </form>

            <button type="button"
                onclick="printInventoryReport()"
                class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 text-sm">
                Print
            </button>

            <button type="button"
                onclick="exportInventoryExcel()"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                Export Excel
            </button>

        </div>

    </div>

    <!-- SUMMARY -->
    <?php
    $totalQty = 0;
    foreach ($items as $i) {
        $totalQty += $i->qty;
    }
    ?>

    <div class="print-hide-summary grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Total Parts Used</p>
            <h3 class="text-2xl font-bold text-blue-700"><?= count($items) ?></h3>
        </div>

        <div class="bg-green-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Total Quantity Used</p>
            <h3 class="text-2xl font-bold text-green-700"><?= $totalQty ?></h3>
        </div>

        <div class="bg-purple-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Date Range</p>
            <h3 class="text-sm font-semibold text-purple-700">
                <?= date('d M', strtotime($from)) ?> – <?= date('d M', strtotime($to)) ?>
            </h3>
        </div>
    </div>

    <!-- TABLE -->
    <table id="inventoryUsageTable" class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th>#</th>
                <th>Date</th>
                <th>Part Code</th>
                <th>Part Name</th>
                <th>Qty Used</th>
                <th>Job Card</th>
                <th>Customer</th>
                <th>Vehicle</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items)): ?>
                <?php $i = 1;
                foreach ($items as $row): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= date('d-m-Y', strtotime($row->jobcard_date)) ?></td>
                        <td><?= $row->part_code ?></td>
                        <td><?= $row->part_name ?></td>
                        <td class="font-semibold text-center"><?= $row->qty ?></td>
                        <td><?= $row->jobcard_no ?></td>
                        <td><?= $row->customer_name ?></td>
                        <td><?= $row->registration_no ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500">
                        No inventory usage found
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<div id="inventoryPrintReport">

    <?php $company_profile = get_current_company_details(); ?>
    <!-- COMPANY HEADER -->
    <table class="inventory-print-header">
        <tr>

            <td class="inventory-logo-cell">
                <img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>"
                    alt="Company logo">
            </td>

            <td class="inventory-company-cell">
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
    <table class="inventory-title-table">

        <tr>

            <td width="35%">
                <b>Report:</b>
                Inventory Usage Report
            </td>

            <td width="30%" class="inventory-report-title">
                INVENTORY USAGE REPORT
            </td>

            <td width="35%" class="inventory-report-period">
                <b>Period:</b>
                <?= date('d M Y', strtotime($from)) ?>
                to
                <?= date('d M Y', strtotime($to)) ?>
            </td>

        </tr>

    </table>


    <!-- REPORT INFORMATION -->
    <table class="inventory-info-table">

        <tr>

            <td width="50%">
                <b>Prepared by:</b>
                <?= $this->session->userdata('username') ?? '' ?>
            </td>

            <td width="50%" style="text-align:right;">
                <b>Total Entries:</b>
                <?= count($items) ?>
            </td>

        </tr>

    </table>


    <!-- INVENTORY TABLE -->
    <table class="inventory-print-table">

        <thead>

            <tr>

                <th>#</th>
                <th>Date</th>
                <th>Part Code</th>
                <th>Part Name</th>
                <th>Qty Used</th>
                <th>Job Card</th>
                <th>Customer</th>
                <th>Vehicle</th>

            </tr>

        </thead>

        <tbody>

            <?php if (!empty($items)): ?>

                <?php
                $printNo = 1;
                $printTotalQty = 0;
                ?>

                <?php foreach ($items as $row): ?>

                    <?php
                    $printTotalQty += (float)$row->qty;
                    ?>

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
                                $row->part_code ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row->part_name ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= number_format(
                                (float)$row->qty,
                                2
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row->jobcard_no ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row->customer_name ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row->registration_no ?? '-'
                            ) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>


                <!-- TOTAL -->
                <tr class="inventory-total-row">

                    <td colspan="4"
                        style="text-align:right !important;">
                        <strong>Total Quantity:</strong>
                    </td>

                    <td>
                        <strong>
                            <?= number_format(
                                $printTotalQty,
                                2
                            ) ?>
                        </strong>
                    </td>

                    <td colspan="3"></td>

                </tr>

            <?php else: ?>

                <tr>

                    <td colspan="8">
                        No inventory usage found
                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>
<!-- DATATABLE -->
<script>
    let inventoryDataTable = null;

    function initInventoryDataTable() {

        if (inventoryDataTable) {
            return;
        }

        inventoryDataTable = new simpleDatatables.DataTable(
            "#inventoryUsageTable", {
                searchable: true,
                fixedHeight: true,
                perPage: 10,
                labels: {
                    placeholder: "Search parts, job card, vehicle...",
                    noRows: "No inventory usage found",
                    info: "Showing {start} to {end} of {rows} entries"
                }
            }
        );
    }

    document.addEventListener("DOMContentLoaded", function() {
        initInventoryDataTable();
    });
</script>
<script>
    function escapeCSV(value) {
        return '"' + String(value ?? '')
            .replace(/"/g, '""')
            .trim() + '"';
    }

    function exportInventoryExcel() {

        const table = document.getElementById('inventoryUsageTable');

        if (!table) {
            return;
        }

        const csvRows = [];

        /* =========================================
           REPORT TITLE
           ========================================= */

        csvRows.push([
            escapeCSV('Inventory Usage Report')
        ].join(','));

        /* =========================================
           DATE RANGE
           ========================================= */

        csvRows.push([
            escapeCSV(
                'From <?= date('d M Y', strtotime($from)) ?> to <?= date('d M Y', strtotime($to)) ?>'
            )
        ].join(','));

        /* Empty row */
        csvRows.push('');

        /* =========================================
           TABLE HEADER
           ========================================= */

        csvRows.push([
            escapeCSV('#'),
            escapeCSV('Date'),
            escapeCSV('Part Code'),
            escapeCSV('Part Name'),
            escapeCSV('Qty Used'),
            escapeCSV('Job Card'),
            escapeCSV('Customer'),
            escapeCSV('Vehicle')
        ].join(','));

        /* =========================================
           TABLE DATA
           ========================================= */

        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(function(row) {

            const noDataRow = row.querySelector('td[colspan]');

            if (noDataRow) {
                return;
            }

            const cells = row.querySelectorAll('td');

            if (cells.length < 8) {
                return;
            }

            const serialNo = cells[0].innerText.trim();
            const date = cells[1].innerText.trim();
            const partCode = cells[2].innerText.trim();
            const partName = cells[3].innerText.trim();
            const qty = cells[4].innerText.trim();
            const jobCard = cells[5].innerText.trim();
            const customer = cells[6].innerText.trim();
            const vehicle = cells[7].innerText.trim();

            csvRows.push([
                escapeCSV(serialNo),

                // Force Excel to display dd-mm-yyyy
                escapeCSV('="' + date + '"'),

                escapeCSV(partCode),
                escapeCSV(partName),
                escapeCSV(qty),
                escapeCSV(jobCard),
                escapeCSV(customer),
                escapeCSV(vehicle)

            ].join(','));

        });

        if (csvRows.length <= 4) {
            return;
        }

        /* =========================================
           CREATE CSV
           ========================================= */

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
            'inventory_usage_report_' +
            new Date().toISOString().slice(0, 10) +
            '.csv';

        document.body.appendChild(link);

        link.click();

        document.body.removeChild(link);

        URL.revokeObjectURL(url);
    }
</script>
<script>
    function printInventoryReport() {
        window.print();
    }
</script>