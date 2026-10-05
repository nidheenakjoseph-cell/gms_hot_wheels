<style>
    /* =========================================
       NORMAL VIEW
       ========================================= */

    #dailyJobTable th,
    #dailyJobTable td {
        text-align: center !important;
        vertical-align: middle !important;
    }

    #dailyJobTable td:last-child {
        text-align: center !important;
    }

    #dailyJobTable td:last-child>div {
        display: flex;
        justify-content: center;
        align-items: center;
    }


    /* =========================================
       PRINT REPORT - HIDDEN ON SCREEN
       ========================================= */

    #jobPrintReport {
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

        /* Hide normal page */
        #jobScreenReport {
            display: none !important;
        }

        .topbar {
            display: none !important;
        }

        /* Show dedicated print report */
        #jobPrintReport {
            display: block !important;
        }

        body {
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;

            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #000;
        }


        .job-summary-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0 12px;
            table-layout: fixed;
        }

        .job-summary-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }

         .job-company-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .job-company-header td {
            border: 0;
            padding: 2px;
            vertical-align: middle;
        }

        .job-company-logo {
            max-width: 150px;
            max-height: 65px;
            object-fit: contain;
        }

        .job-company-details {
            text-align: right;
            line-height: 1.4;
        }

        .job-print-heading {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 5px 0;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .job-summary-label {
            display: block;
            font-weight: bold;
        }

        .job-summary-value {
            display: block;
            font-size: 15px;
            font-weight: bold;
        }


        /* =========================================
           MAIN REPORT TABLE
           ========================================= */

        .job-print-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .job-print-table thead {
            display: table-header-group;
        }

        .job-print-table tr {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .job-print-table th {
            background: #f5f5f5;
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }

        .job-print-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
            word-break: break-word;
        }


        /* =========================================
           COLUMN WIDTHS
           ========================================= */

        .job-print-table th:nth-child(1),
        .job-print-table td:nth-child(1) {
            width: 6%;
        }

        .job-print-table th:nth-child(2),
        .job-print-table td:nth-child(2) {
            width: 14%;
        }

        .job-print-table th:nth-child(3),
        .job-print-table td:nth-child(3) {
            width: 13%;
        }

        .job-print-table th:nth-child(4),
        .job-print-table td:nth-child(4) {
            width: 21%;
        }

        .job-print-table th:nth-child(5),
        .job-print-table td:nth-child(5) {
            width: 18%;
        }

        .job-print-table th:nth-child(6),
        .job-print-table td:nth-child(6) {
            width: 14%;
        }

        .job-print-table th:nth-child(7),
        .job-print-table td:nth-child(7) {
            width: 14%;
        }


        /* =========================================
           STATUS
           ========================================= */

        .job-print-status {
            font-weight: bold;
        }
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<div id="jobScreenReport" class="w-full bg-white rounded-2xl shadow-md p-6">
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6 gap-4 flex-wrap">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Job Report
            </h2>

            <p class="text-sm text-gray-500">
                Showing job cards for
                <span class="font-semibold">
                    <?= date('d M Y', strtotime($date)) ?>
                </span>
            </p>

            <!-- CUSTOMER NAME -->
            <?php if ($this->input->get('customer_id') && !empty($customer_name)): ?>
                <p class="text-sm text-gray-500 mt-1">
                    Customer:
                    <span class="font-semibold text-gray-800">
                        <?= htmlspecialchars($customer_name) ?>
                    </span>
                </p>
            <?php endif; ?>

        </div>

        <!-- FILTERS - HIDDEN IN PRINT -->
        <form method="get" class="no-print flex flex-wrap items-center gap-2">

            <div>
                <label for="date" class="block text-xs font-semibold text-gray-600 mb-1">Date</label>
                <input type="date" name="date" id="date"
                    value="<?= htmlspecialchars($date, ENT_QUOTES, 'UTF-8') ?>"
                    class="border rounded px-3 py-2 text-sm">
            </div>

            <div>
                <label for="customer_id" class="block text-xs font-semibold text-gray-600 mb-1">Customer</label>
                <select name="customer_id" id="customer_id"
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
            </div>

            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                Filter
            </button>

            <button type="button"
                onclick="window.location.href='<?= site_url('Reports/daily_jobs') ?>'"
                class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 text-sm">
                Today
            </button>

            <button type="button"
                onclick="printJobReport()"
                class="px-4 py-2 bg-slate-600 text-white rounded hover:bg-slate-700 text-sm">
                Print
            </button>

            <button type="button"
                onclick="exportDailyJobsExcel()"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                Export Excel
            </button>

        </form>

    </div>

    <!-- SUMMARY CARDS -->
    <div class="print-hide-summary grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <?php
        $total = count($jobs);
        $completed = 0;
        $pending = 0;
        $inprogress = 0;
        $scheduled = 0;
        foreach ($jobs as $j) {
            if ($j->status == 'Finished' || $j->status == 'Completed') $completed++;
            elseif ($j->status == 'In Progress') $inprogress++;
            elseif ($j->status == 'Scheduled') $scheduled++;
            else $pending++;
        }
        ?>

        <div class="bg-blue-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Total Jobs</p>
            <h3 class="text-2xl font-bold text-blue-700"><?= $total ?></h3>
        </div>

        <div class="bg-green-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Completed</p>
            <h3 class="text-2xl font-bold text-green-700"><?= $completed ?></h3>
        </div>

        <div class="bg-yellow-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">In Progress</p>
            <h3 class="text-2xl font-bold text-yellow-700"><?= $inprogress ?></h3>
        </div>

        <div class="bg-red-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Scheduled</p>
            <h3 class="text-2xl font-bold text-red-700"><?= $scheduled ?></h3>
        </div>

    </div>

    <!-- JOB LIST TABLE -->
    <table id="dailyJobTable" class="w-full text-sm">
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
                <?php $i = 1;
                foreach ($jobs as $job): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $job->jobcard_id ?></td>
                        <td><?= date('d-m-Y', strtotime($job->jobcard_date)) ?></td>
                        <td><?= $job->customer_name ?></td>
                        <td><?= $job->registration_no ?> (<?= $job->brand ?>)</td>
                        <td>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                            <?= $job->status == 'Completed' ? 'bg-green-100 text-green-700' : ($job->status == 'In Progress' ? 'bg-yellow-100 text-yellow-700' :
                                'bg-red-100 text-red-700') ?>">
                                <?= $job->status ?>
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-2 justify-center items-center">
                                <!-- VIEW JOB CARD -->
                                <a href="<?= base_url('index.php/jobcard/view/' . $job->jobcard_id) ?>"
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
                    <td colspan="7" class="text-center py-4 text-gray-500">
                        No job cards found for this date
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<div id="jobPrintReport">

    <?php $company_profile = get_current_company_details(); ?>
    <table class="job-company-header">
        <tr>
            <td style="width: 25%;">
                <img class="job-company-logo"
                    src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>"
                    alt="Company logo">
            </td>
            <td class="job-company-details" style="width: 75%;">
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

    <div class="job-print-heading">
        Daily Jobs Report &nbsp; | &nbsp; <?= date('d M Y', strtotime($date)) ?>
        <?php if (!empty($customer_name)): ?>
            &nbsp; | &nbsp; Customer: <?= htmlspecialchars($customer_name, ENT_QUOTES, 'UTF-8') ?>
        <?php endif; ?>
    </div>

    <!-- SUMMARY -->
    <table class="job-summary-table">
        <tr>
            <td>
                <span class="job-summary-label">Total Jobs</span>
                <span class="job-summary-value"><?= $total ?></span>
            </td>
            <td>
                <span class="job-summary-label">Completed</span>
                <span class="job-summary-value"><?= $completed ?></span>
            </td>
            <td>
                <span class="job-summary-label">In Progress</span>
                <span class="job-summary-value"><?= $inprogress ?></span>
            </td>
            <td>
                <span class="job-summary-label">Scheduled</span>
                <span class="job-summary-value"><?= $scheduled ?></span>
            </td>
        </tr>
    </table>


    <!-- JOB TABLE -->
    <table class="job-print-table">

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

                <?php $printNo = 1; ?>

                <?php foreach ($jobs as $job): ?>

                    <tr>

                        <td>
                            <?= $printNo++ ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($job->jobcard_id) ?>
                        </td>

                        <td>
                            <?= date(
                                'd-m-Y',
                                strtotime($job->jobcard_date)
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($job->customer_name) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($job->registration_no) ?>

                            <?php if (!empty($job->brand)): ?>
                                (<?= htmlspecialchars($job->brand) ?>)
                            <?php endif; ?>
                        </td>

                        <td class="job-print-status">
                            <?= !empty($job->status)
                                ? htmlspecialchars($job->status)
                                : 'Finished' ?>
                        </td>

                        <td>
                            -
                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="7">
                        No job cards found for this date
                    </td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>
<!-- DATATABLE -->
<!-- EXPORT EXCEL -->
<script>
    function escapeCSV(value) {
        return '"' + String(value ?? '')
            .replace(/"/g, '""')
            .trim() + '"';
    }

    function exportDailyJobsExcel() {

        const table = document.getElementById('dailyJobTable');

        if (!table) {
            return;
        }

        const csvRows = [];

        // ==========================================
        // REPORT HEADER
        // ==========================================

        csvRows.push([
            escapeCSV('Job Report')
        ].join(','));

        csvRows.push([
            escapeCSV(
                'Showing job cards for <?= date('d M Y', strtotime($date)) ?>'
            )
        ].join(','));


        // ==========================================
        // CUSTOMER NAME
        // ==========================================

        <?php if ($this->input->get('customer_id') && !empty($customer_name)): ?>

            csvRows.push([
                escapeCSV(
                    'Customer: <?= htmlspecialchars($customer_name, ENT_QUOTES, 'UTF-8') ?>'
                )
            ].join(','));

        <?php endif; ?>


        // ==========================================
        // EMPTY LINE
        // ==========================================

        csvRows.push('');


        // ==========================================
        // TABLE HEADER
        // ==========================================

        csvRows.push([
            escapeCSV('#'),
            escapeCSV('Job Card No'),
            escapeCSV('Date'),
            escapeCSV('Customer'),
            escapeCSV('Vehicle'),
            escapeCSV('Status')
        ].join(','));


        // ==========================================
        // TABLE DATA
        // ==========================================

        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(function(row) {

            const noDataRow = row.querySelector('td[colspan]');

            if (noDataRow) {
                return;
            }

            const cells = row.querySelectorAll('td');

            if (cells.length < 6) {
                return;
            }

            const serialNo = cells[0].innerText.trim();
            const jobCardNo = cells[1].innerText.trim();
            const date = cells[2].innerText.trim();
            const customer = cells[3].innerText.trim();
            const vehicle = cells[4].innerText.trim();
            const status = cells[5].innerText.trim();

            csvRows.push([
                escapeCSV(serialNo),
                escapeCSV(jobCardNo),

                // Force Excel to display the date
                escapeCSV('="' + date + '"'),

                escapeCSV(customer),
                escapeCSV(vehicle),
                escapeCSV(status)

            ].join(','));

        });


        // ==========================================
        // STOP IF NO DATA
        // ==========================================

        if (csvRows.length <= 4) {
            return;
        }


        // ==========================================
        // CREATE CSV
        // ==========================================

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
            'daily_jobs_' +
            new Date().toISOString().slice(0, 10) +
            '.csv';

        document.body.appendChild(link);

        link.click();

        document.body.removeChild(link);

        URL.revokeObjectURL(url);
    }
</script>

<script>
    $(document).ready(function() {

        $('.debtor-select').select2({
            placeholder: 'Select Customer',
            allowClear: true,
            width: '250px'
        });

    });
</script>
<script>
    function printJobReport() {
        window.print();
    }
</script>