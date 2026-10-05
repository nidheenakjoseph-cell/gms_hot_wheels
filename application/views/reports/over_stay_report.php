<style>
    /* =========================================
       NORMAL VIEW
       ========================================= */

    #overStayTable {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    #overStayTable th,
    #overStayTable td {
        text-align: center !important;
        vertical-align: middle !important;
    }

    #overStayTable td:last-child {
        text-align: center !important;
    }


    /* =========================================
       PRINT REPORT - HIDDEN ON SCREEN
       ========================================= */

    #overStayPrintReport {
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

        /* Hide complete application */
        body * {
            visibility: hidden !important;
        }

        /* Show only print report */
        #overStayPrintReport,
        #overStayPrintReport * {
            visibility: visible !important;
        }

        #overStayPrintReport {
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

        .overstay-print-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .overstay-print-header td {
            border: none !important;
            padding: 5px;
            vertical-align: middle;
        }

        .overstay-logo-cell {
            width: 20%;
            text-align: center;
        }

        .overstay-logo-cell img {
            max-height: 70px;
            max-width: 150px;
        }

        .overstay-company-cell {
            width: 80%;
            text-align: right;
            font-size: 13px;
            line-height: 1.6;
        }


        /* =========================================
           TITLE
           ========================================= */

        .overstay-title-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .overstay-title-table td {
            border: none !important;
            padding: 5px;
        }

        .overstay-report-title {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
        }

        .overstay-report-period {
            text-align: right;
        }


        /* =========================================
           REPORT INFORMATION
           ========================================= */

        .overstay-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .overstay-info-table td {
            border: none !important;
            padding: 4px 0;
        }


        /* =========================================
           PRINT TABLE
           ========================================= */

        .overstay-print-table {
            width: 100% !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
        }

        .overstay-print-table thead {
            display: table-header-group !important;
        }

        .overstay-print-table tbody {
            display: table-row-group !important;
        }

        .overstay-print-table tr {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .overstay-print-table th {
            background: #f5f5f5 !important;
            border: 1px solid #000 !important;
            padding: 6px !important;
            text-align: center !important;
            vertical-align: middle !important;
            font-weight: bold !important;
        }

        .overstay-print-table td {
            border: 1px solid #000 !important;
            padding: 6px !important;
            text-align: center !important;
            vertical-align: middle !important;
            word-break: break-word !important;
        }


        /* =========================================
           COLUMN WIDTHS
           ========================================= */

        .overstay-print-table th:nth-child(1),
        .overstay-print-table td:nth-child(1) {
            width: 6% !important;
        }

        .overstay-print-table th:nth-child(2),
        .overstay-print-table td:nth-child(2) {
            width: 15% !important;
        }

        .overstay-print-table th:nth-child(3),
        .overstay-print-table td:nth-child(3) {
            width: 12% !important;
        }

        .overstay-print-table th:nth-child(4),
        .overstay-print-table td:nth-child(4) {
            width: 22% !important;
        }

        .overstay-print-table th:nth-child(5),
        .overstay-print-table td:nth-child(5) {
            width: 18% !important;
        }

        .overstay-print-table th:nth-child(6),
        .overstay-print-table td:nth-child(6) {
            width: 15% !important;
        }

        .overstay-print-table th:nth-child(7),
        .overstay-print-table td:nth-child(7) {
            width: 12% !important;
        }
    }
</style>


<div id="overStayScreenReport"
    class="w-full bg-white rounded-2xl shadow-md p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Over Stay Report
            </h2>

            <p class="text-sm text-gray-500">
                As On Date:
                <b>
                    <?= date('d M Y', strtotime($date)) ?>
                </b>
            </p>
        </div>


        <!-- FILTER + ACTIONS -->
        <div class="flex flex-wrap items-center gap-2">

            <form method="get"
                class="flex flex-wrap items-center gap-2">

                <label class="text-sm font-medium text-gray-700">
                    As On Date
                </label>

                <input type="date"
                    name="date"
                    value="<?= $date ?>"
                    class="border rounded px-3 py-2 text-sm">

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                    Filter
                </button>

            </form>


            <button type="button"
                onclick="printOverStayReport()"
                class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 text-sm">
                Print
            </button>


            <button type="button"
                onclick="exportOverStayExcel()"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                Export Excel
            </button>

        </div>

    </div>


    <!-- SUMMARY CARDS -->
    <div class="print-hide-summary grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <?php
        $total = count($jobs);
        $completed = 0;
        $pending = 0;
        $inprogress = 0;
        $Scheduled = 0;

        foreach ($jobs as $j) {

            if ($j->status == 'Finished') {
                $completed++;
            } elseif ($j->status == 'In Progress') {
                $inprogress++;
            } elseif ($j->status == 'Scheduled') {
                $Scheduled++;
            } else {
                $pending++;
            }
        }
        ?>

        <div class="bg-blue-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Total Jobs</p>
            <h3 class="text-2xl font-bold text-blue-700">
                <?= $total ?>
            </h3>
        </div>

        <div class="bg-green-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Completed</p>
            <h3 class="text-2xl font-bold text-green-700">
                <?= $completed ?>
            </h3>
        </div>

        <div class="bg-yellow-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">In Progress</p>
            <h3 class="text-2xl font-bold text-yellow-700">
                <?= $inprogress ?>
            </h3>
        </div>

        <div class="bg-red-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Scheduled</p>
            <h3 class="text-2xl font-bold text-red-700">
                <?= $Scheduled ?>
            </h3>
        </div>

    </div>


    <!-- JOB TABLE -->
    <table id="overStayTable"
        class="w-full text-sm">

        <thead>

            <tr class="bg-gray-100">

                <th>#</th>
                <th>Job Card No</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Vehicle</th>
                <th>Status</th>
                <th>Action</th>

            </tr>

        </thead>


        <tbody>

            <?php if (!empty($jobs)): ?>

                <?php
                $i = 1;

                foreach ($jobs as $job):
                ?>

                    <tr>

                        <td>
                            <?= $i++ ?>
                        </td>

                        <td>
                            <?= $job->jobcard_id ?>
                        </td>

                        <td>
                            <?= date(
                                'd-m-Y',
                                strtotime($job->jobcard_date)
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $job->customer_name ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $job->registration_no ?? '-'
                            ) ?>

                            <?php if (!empty($job->brand)): ?>
                                (<?= htmlspecialchars($job->brand) ?>)
                            <?php endif; ?>
                        </td>

                        <td>

                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                <?= $job->status == 'Completed'
                                    ? 'bg-green-100 text-green-700'
                                    : ($job->status == 'In Progress'
                                        ? 'bg-yellow-100 text-yellow-700'
                                        : 'bg-red-100 text-red-700') ?>">

                                <?= htmlspecialchars(
                                    $job->status ?? '-'
                                ) ?>

                            </span>

                        </td>

                        <td>

                            <div class="flex gap-2 justify-center items-center">

                                <a href="<?= base_url(
                                                'index.php/jobcard/view/' .
                                                    $job->jobcard_id
                                            ) ?>"
                                    class="p-2 rounded bg-yellow-100 hover:bg-yellow-200"
                                    title="View Job Card">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-4 h-4 text-yellow-700">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.25 12s3.75-7.5 9.75-7.5
                                                 9.75 7.5 9.75 7.5
                                                 -3.75 7.5 -9.75 7.5
                                                 S2.25 12 2.25 12z" />

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0
                                                 3 3 0 016 0z" />

                                    </svg>

                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="7"
                        class="text-center py-4 text-gray-500">

                        No over stay jobs found for this date.

                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>


<!-- ==================================================
     PRINT REPORT
     ================================================== -->

<div id="overStayPrintReport">

    <?php $company_profile = get_current_company_details(); ?>
    <!-- COMPANY HEADER -->
    <table class="overstay-print-header">

        <tr>

            <td class="overstay-logo-cell">

                <img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>"
                    alt="Company logo">

            </td>

            <td class="overstay-company-cell">

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
    <table class="overstay-title-table">

        <tr>

            <td width="35%">

                <b>Report:</b>
                Over Stay Report

            </td>

            <td width="30%"
                class="overstay-report-title">

                OVER STAY REPORT

            </td>

            <td width="35%"
                class="overstay-report-period">

                <b>As On:</b>

                <?= date(
                    'd M Y',
                    strtotime($date)
                ) ?>

            </td>

        </tr>

    </table>


    <!-- REPORT INFORMATION -->
    <table class="overstay-info-table">

        <tr>

            <td width="50%">

                <b>Prepared by:</b>
                <?= $this->session->userdata('username') ?? '' ?>

            </td>

            <td width="50%"
                style="text-align:right;">

                <b>Total Jobs:</b>
                <?= count($jobs) ?>

            </td>

        </tr>

    </table>


    <!-- REPORT TABLE -->
    <table class="overstay-print-table">

        <thead>

            <tr>

                <th>#</th>
                <th>Job Card No</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Vehicle</th>
                <th>Status</th>
                <th>Action</th>

            </tr>

        </thead>


        <tbody>

            <?php if (!empty($jobs)): ?>

                <?php
                $printNo = 1;
                ?>

                <?php foreach ($jobs as $job): ?>

                    <tr>

                        <td>
                            <?= $printNo++ ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $job->jobcard_id ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= date(
                                'd-m-Y',
                                strtotime($job->jobcard_date)
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $job->customer_name ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $job->registration_no ?? '-'
                            ) ?>

                            <?php if (!empty($job->brand)): ?>
                                (<?= htmlspecialchars(
                                        $job->brand
                                    ) ?>)
                            <?php endif; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $job->status ?? '-'
                            ) ?>
                        </td>

                        <td>
                            -
                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="7">
                        No over stay jobs found for this date.
                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>


<!-- ==================================================
     DATATABLE
     ================================================== -->

<script>
    let overStayDataTable = null;

    function initOverStayDataTable() {

        if (overStayDataTable) {
            return;
        }

        if (typeof simpleDatatables === 'undefined') {
            return;
        }

        overStayDataTable =
            new simpleDatatables.DataTable(
                "#overStayTable", {
                    searchable: true,
                    fixedHeight: true,
                    perPage: 10,

                    labels: {
                        placeholder: "Search jobs...",
                        noRows: "No over stay jobs found",
                        info: "Showing {start} to {end} of {rows} jobs"
                    }
                }
            );
    }


    document.addEventListener(
        "DOMContentLoaded",
        function() {
            initOverStayDataTable();
        }
    );


    /* =========================================
       PRINT
       ========================================= */

    function printOverStayReport() {

        /*
         * Destroy DataTable temporarily.
         * This ensures search/pagination/count
         * do not appear while printing.
         */

        if (overStayDataTable) {

            overStayDataTable.destroy();

            overStayDataTable = null;
        }

        window.print();

        window.onafterprint = function() {

            initOverStayDataTable();

            window.onafterprint = null;
        };
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

    function exportOverStayExcel() {

        const table =
            document.querySelector(
                '#overStayPrintReport .overstay-print-table'
            );

        if (!table) {

            alert(
                'Over Stay report table not found.'
            );

            return;
        }


        const csvRows = [];


        /* =========================================
           REPORT TITLE
           ========================================= */

        csvRows.push(
            escapeCSV('Over Stay Report')
        );


        /* =========================================
           AS ON DATE
           ========================================= */

        csvRows.push(
            escapeCSV(
                'As On Date: <?= date(
                                    'd M Y',
                                    strtotime($date)
                                ) ?>'
            )
        );


        /* =========================================
           EMPTY ROW
           ========================================= */

        csvRows.push('');


        /* =========================================
           TABLE HEADER
           ========================================= */

        csvRows.push([

            escapeCSV('#'),
            escapeCSV('Job Card No'),
            escapeCSV('Date'),
            escapeCSV('Customer'),
            escapeCSV('Vehicle'),
            escapeCSV('Status')

        ].join(','));


        /* =========================================
           TABLE DATA
           ========================================= */

        const rows =
            table.querySelectorAll(
                'tbody tr'
            );

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


            if (cells.length < 7) {
                return;
            }


            const serialNo =
                cells[0].innerText.trim();

            const jobCardNo =
                cells[1].innerText.trim();

            const reportDate =
                cells[2].innerText.trim();

            const customer =
                cells[3].innerText.trim();

            const vehicle =
                cells[4].innerText
                .replace(/\s+/g, ' ')
                .trim();

            const status =
                cells[5].innerText.trim();


            csvRows.push([

                escapeCSV(serialNo),

                escapeCSV(jobCardNo),

                escapeCSV('="' + reportDate + '"'),

                escapeCSV(customer),

                escapeCSV(vehicle),

                escapeCSV(status)

            ].join(','));


            dataCount++;

        });


        if (dataCount === 0) {

            alert(
                'No over stay jobs available to export.'
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
            'over_stay_report_' +
            new Date()
            .toISOString()
            .slice(0, 10) +
            '.csv';


        document.body.appendChild(link);

        link.click();

        document.body.removeChild(link);


        URL.revokeObjectURL(url);

    }
</script>