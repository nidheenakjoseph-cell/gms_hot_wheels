<style>
    /* =========================================
       NORMAL RFQ TABLE
       ========================================= */

    #basic-btn {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    #basic-btn th,
    #basic-btn td {
        text-align: center !important;
        vertical-align: middle !important;
    }


    /* =========================================
       PRINT REPORT HIDDEN ON SCREEN
       ========================================= */

    #rfqPrintReport {
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
            width: 100% !important;
            background: #fff !important;
        }

        body * {
            visibility: hidden !important;
        }


        /* Show only RFQ print report */
        #rfqPrintReport,
        #rfqPrintReport * {
            visibility: visible !important;
        }


        #rfqPrintReport {
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

        .rfq-print-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .rfq-print-header td {
            border: none !important;
            padding: 5px;
            vertical-align: middle;
        }

        .rfq-logo-cell {
            width: 20%;
            text-align: center;
        }

        .rfq-logo-cell img {
            max-height: 70px;
            max-width: 150px;
        }

        .rfq-company-cell {
            width: 80%;
            text-align: right;
            font-size: 13px;
            line-height: 1.6;
        }


        /* =========================================
           PRINT TITLE
           ========================================= */

        .rfq-title-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .rfq-title-table td {
            border: none !important;
            padding: 5px;
        }

        .rfq-report-title {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
        }

        .rfq-report-period {
            text-align: right;
        }


        /* =========================================
           REPORT INFORMATION
           ========================================= */

        .rfq-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .rfq-info-table td {
            border: none !important;
            padding: 4px 0;
        }


        /* =========================================
           RFQ PRINT TABLE
           ========================================= */

        .rfq-print-table {
            width: 100% !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
        }

        .rfq-print-table thead {
            display: table-header-group !important;
        }

        .rfq-print-table tbody {
            display: table-row-group !important;
        }

        .rfq-print-table tr {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .rfq-print-table th {
            background: #f5f5f5 !important;
            border: 1px solid #000 !important;
            padding: 6px !important;
            text-align: center !important;
            vertical-align: middle !important;
            font-weight: bold !important;
        }

        .rfq-print-table td {
            border: 1px solid #000 !important;
            padding: 6px !important;
            text-align: center !important;
            vertical-align: middle !important;
            word-break: break-word !important;
        }


        /* =========================================
           COLUMN WIDTHS
           ========================================= */

        .rfq-print-table th:nth-child(1),
        .rfq-print-table td:nth-child(1) {
            width: 8% !important;
        }

        .rfq-print-table th:nth-child(2),
        .rfq-print-table td:nth-child(2) {
            width: 20% !important;
        }

        .rfq-print-table th:nth-child(3),
        .rfq-print-table td:nth-child(3) {
            width: 15% !important;
        }

        .rfq-print-table th:nth-child(4),
        .rfq-print-table td:nth-child(4) {
            width: 32% !important;
        }

        .rfq-print-table th:nth-child(5),
        .rfq-print-table td:nth-child(5) {
            width: 25% !important;
        }
    }
</style>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php
$user = $this->session->userdata('user_id');
?>
<form id="main" method="post" action="<?php echo base_url() . 'index.php/'; ?>Reports/get_rfq_report" autocomplete="off" enctype="multipart/form-data">

    <!-- page content -->
    <div id="rfqReportContainer" class="w-full bg-white" role="main">
        <div class="w-full">
            <!-- Title -->
            <div class="mb-5 border-b border-gray-200 pb-4">

                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3">

                    <!-- LEFT -->
                    <div>

                        <h1 class="text-2xl font-bold text-gray-800">
                            RFQ Reports
                        </h1>

                        <p class="text-sm text-gray-500 mt-1">
                            Request for Quotation report list and filters
                        </p>

                    </div>


                    <!-- RIGHT : DATE RANGE -->
                    <div class="text-sm text-gray-600 md:text-right">

                        <span class="font-medium">
                            From
                        </span>

                        <span class="font-semibold text-gray-800">
                            <?= date('d M Y', strtotime($from)) ?>
                        </span>

                        <span class="mx-1 text-gray-400">
                            to
                        </span>

                        <span class="font-semibold text-gray-800">
                            <?= date('d M Y', strtotime($to)) ?>
                        </span>

                    </div>

                </div>


                <?php
                $selectedSupplierName = '';

                if (!empty($supplier_id)) {

                    foreach ($supplier_records as $s) {

                        if ($s->supplier_id == $supplier_id) {

                            $selectedSupplierName =
                                $s->supplier_code . ' ' . $s->supplier_name;

                            break;
                        }
                    }
                }
                ?>


                <?php if (!empty($selectedSupplierName)): ?>

                    <div class="mt-2 text-sm text-gray-600">

                        <span class="font-medium">
                            Supplier:
                        </span>

                        <span class="font-semibold text-gray-800">
                            <?= htmlspecialchars($selectedSupplierName) ?>
                        </span>

                    </div>

                <?php endif; ?>

            </div>
            <div class="no-print bg-white shadow rounded-lg p-4 mb-4">

                <div class="flex flex-wrap items-end gap-4">

                    <!-- Date From -->
                    <div class="flex items-center gap-2">
                        <label class="text-sm font-medium whitespace-nowrap">Date From:</label>
                        <input type="date" name="from_date"
                            class="border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400"
                            value="<?php echo $from; ?>" />
                    </div>

                    <!-- Date To -->
                    <div class="flex items-center gap-2">
                        <label class="text-sm font-medium whitespace-nowrap">Date To:</label>
                        <input type="date" name="to_date"
                            class="border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400"
                            value="<?php echo $to; ?>" />
                    </div>

                    <!-- Supplier -->
                    <!-- Supplier -->
                    <div class="flex items-center gap-2">
                        <label class="text-sm font-medium whitespace-nowrap">Supplier:</label>

                        <select name="supplier_id"
                            id="supplier_id"
                            class="border border-gray-300 rounded px-3 py-2 select2"
                            style="width: 300px;"
                            tabindex="2">

                            <option value="">-select-</option>

                            <?php foreach ($supplier_records as $g) { ?>
                                <option value="<?php echo $g->supplier_id; ?>"
                                    <?php echo ($supplier_id == $g->supplier_id) ? 'selected' : ''; ?>>
                                    <?php echo $g->supplier_code . ' ' . $g->supplier_name; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-2">

                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                            Go
                        </button>

                        <button type="button"
                            onclick="printRFQReport()"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                            Print
                        </button>

                        <button type="button"
                            onclick="exportRFQExcel()"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded shadow">
                            Export Excel
                        </button>

                    </div>

                </div>

            </div>


            <!-- Table -->
            <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">

                <table id="basic-btn"
                    class="min-w-full border border-gray-200 rounded-lg overflow-hidden">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2 text-left text-sm font-semibold">Sr. No</th>
                            <th class="border px-3 py-2 text-left text-sm font-semibold">RFQ Code</th>
                            <th class="border px-3 py-2 text-left text-sm font-semibold">RFQ Date</th>
                            <th class="border px-3 py-2 text-left text-sm font-semibold">Supplier</th>
                            <th class="border px-3 py-2 text-left text-sm font-semibold">Created By</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1;
                        foreach ($records as $row) : ?>
                            <tr class="hover:bg-gray-50">
                                <td class="border px-3 py-2"><?php echo  $i;
                                                                $i++; ?></td>

                                <td class="border px-3 py-2">
                                    <a target="blank"
                                        title="RFQ Details"
                                        href="<?php echo base_url() . 'index.php/Purchase/edit_rfq/' . $row->rfq_id . '/' . $row->rev_version; ?>"
                                        class="text-blue-600 hover:underline">
                                        <?php echo $row->rfq_code; ?>
                                    </a>
                                </td>

                                <td class="border px-3 py-2">
                                    <?php echo date('d-M-Y', strtotime($row->rfq_date)); ?>
                                </td>

                                <td class="border px-3 py-2">
                                    <?php echo $row->supplier_name; ?>
                                </td>

                                <td class="border px-3 py-2">
                                    <?php echo $row->rfq_created_by; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot class="bg-gray-100">
                        <!-- <tr>
                            <th class="border px-3 py-2 text-left text-sm font-semibold">Sr. No</th>
                            <th class="border px-3 py-2 text-left text-sm font-semibold">RFQ Code</th>
                            <th class="border px-3 py-2 text-left text-sm font-semibold">RFQ Date</th>
                            <th class="border px-3 py-2 text-left text-sm font-semibold">Supplier</th>
                            <th class="border px-3 py-2 text-left text-sm font-semibold">Created By</th>
                        </tr> -->
                    </tfoot>

                </table>

            </div>

        </div>
    </div>

</form>
<div id="rfqPrintReport">

    <!-- COMPANY HEADER -->
    <table class="rfq-print-header">

        <tr>

            <td class="rfq-logo-cell">

                <img src="<?= base_url('public/images/logoauto1.png') ?>"
                    alt="Logo">

            </td>


            <td class="rfq-company-cell">

                <strong>Demo Garage Solutions LLC</strong><br>

                Business Bay, Dubai, UAE<br>

                www.demogarage.com<br>

                info@demogarage.com<br>

                Tel: +971 4 123 4567<br>

                TRN: 100000000000000

            </td>

        </tr>

    </table>


    <!-- REPORT TITLE -->
    <table class="rfq-title-table">

        <tr>

            <td width="35%">
                <b>Report:</b>
                RFQ Report
            </td>

            <td width="30%" class="rfq-report-title">
                RFQ REPORT
            </td>

            <td width="35%" class="rfq-report-period">

                <b>Period:</b>

                <?= date('d M Y', strtotime($from)) ?>

                to

                <?= date('d M Y', strtotime($to)) ?>

            </td>

        </tr>

    </table>


    <br>


    <!-- REPORT INFORMATION -->
    <table class="rfq-info-table">

        <tr>

            <td width="50%">

                <b>Prepared by:</b>

                <?= $this->session->userdata('username') ?? '' ?>

            </td>


            <td width="50%" style="text-align:right;">

                <b>Total RFQs:</b>

                <?= count($records) ?>

            </td>

        </tr>


        <?php if (!empty($selectedSupplierName)): ?>

            <tr>

                <td colspan="2">

                    <b>Supplier:</b>

                    <?= htmlspecialchars($selectedSupplierName) ?>

                </td>

            </tr>

        <?php endif; ?>

    </table>


    <!-- RFQ TABLE -->
    <table class="rfq-print-table">

        <thead>

            <tr>

                <th>Sr. No</th>

                <th>RFQ Code</th>

                <th>RFQ Date</th>

                <th>Supplier</th>

                <th>Created By</th>

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
                                $row->rfq_code ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= date(
                                'd-M-Y',
                                strtotime($row->rfq_date)
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row->supplier_name ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row->rfq_created_by ?? '-'
                            ) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="5">
                        No RFQs found for selected date range
                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>

<script>
    $(document).ready(function() {

        $('#supplier_id').select2({
            placeholder: '-select-',
            allowClear: true,
            width: '300px'
        });

    });
</script>

<script>
    function printRFQReport() {

        window.print();

    }
</script>
<script>
    function escapeCSV(value) {

        return '"' +
            String(value ?? '')
            .replace(/"/g, '""')
            .trim() +
            '"';

    }


    function exportRFQExcel() {

        const table =
            document.getElementById('basic-btn');

        if (!table) {
            return;
        }

        const csvRows = [];


        /* =========================================
           REPORT TITLE
           ========================================= */

        csvRows.push([
            escapeCSV('RFQ Reports')
        ].join(','));


        /* =========================================
           DATE RANGE
           ========================================= */

        csvRows.push([
            escapeCSV(
                'From <?= date('d M Y', strtotime($from)) ?> to <?= date('d M Y', strtotime($to)) ?>'
            )
        ].join(','));


        /* =========================================
           SUPPLIER
           ========================================= */

        <?php if (!empty($selectedSupplierName)): ?>

            csvRows.push([
                escapeCSV(
                    'Supplier: <?= htmlspecialchars($selectedSupplierName, ENT_QUOTES, 'UTF-8') ?>'
                )
            ].join(','));

        <?php endif; ?>


        /* Empty row */
        csvRows.push('');


        /* =========================================
           TABLE HEADER
           ========================================= */

        csvRows.push([
            escapeCSV('Sr. No'),
            escapeCSV('RFQ Code'),
            escapeCSV('RFQ Date'),
            escapeCSV('Supplier'),
            escapeCSV('Created By')
        ].join(','));


        /* =========================================
           TABLE DATA
           ========================================= */

        const rows =
            table.querySelectorAll('tbody tr');

        rows.forEach(function(row) {

            const cells =
                row.querySelectorAll('td');

            if (cells.length < 5) {
                return;
            }


            const serialNo =
                cells[0].innerText.trim();

            const rfqCode =
                cells[1].innerText.trim();

            const rfqDate =
                cells[2].innerText.trim();

            const supplier =
                cells[3].innerText.trim();

            const createdBy =
                cells[4].innerText.trim();


            csvRows.push([

                escapeCSV(serialNo),

                escapeCSV(rfqCode),

                // Keep date visible in Excel
                escapeCSV('="' + rfqDate + '"'),

                escapeCSV(supplier),

                escapeCSV(createdBy)

            ].join(','));

        });


        if (csvRows.length <= 5) {
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


        const link =
            document.createElement('a');


        const url =
            URL.createObjectURL(blob);


        link.href = url;


        link.download =
            'rfq_report_' +
            new Date().toISOString().slice(0, 10) +
            '.csv';


        document.body.appendChild(link);

        link.click();

        document.body.removeChild(link);


        URL.revokeObjectURL(url);

    }
</script>