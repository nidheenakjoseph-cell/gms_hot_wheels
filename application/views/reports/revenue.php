<style>
    /* =========================================
       NORMAL VIEW
       ========================================= */

    #revenueTable th,
    #revenueTable td {
        text-align: center !important;
        vertical-align: middle !important;
    }

    #revenueTable td:last-child {
        text-align: center !important;
    }


    /* =========================================
       PRINT REPORT
       ========================================= */

    #revenuePrintReport {
        display: none;
    }


    @media print {

        /* =========================================
       PAGE SETTINGS
       ========================================= */

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


        /* =========================================
       HIDE ENTIRE APPLICATION
       ========================================= */

        body * {
            visibility: hidden !important;
        }


        /* =========================================
       HIDE NORMAL SCREEN REPORT
       ========================================= */

        #revenueScreenReport {
            display: none !important;
        }


        /* =========================================
       SHOW ONLY PRINT REPORT
       ========================================= */

        #revenuePrintReport,
        #revenuePrintReport * {
            visibility: visible !important;
        }


        #revenuePrintReport {
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

            overflow: visible !important;
        }


        /* =========================================
       BODY
       ========================================= */

        body {
            margin: 0 !important;
            padding: 0 !important;

            background: #fff !important;

            font-family: DejaVu Sans, Arial, sans-serif;

            font-size: 11px;

            color: #000;
        }


        /* =========================================
       COMPANY HEADER
       ========================================= */

        .revenue-print-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .revenue-print-header td {
            border: none !important;
            padding: 5px;
            vertical-align: middle;
        }

        .revenue-logo-cell {
            width: 20%;
            text-align: center;
        }

        .revenue-logo-cell img {
            max-height: 70px;
            max-width: 150px;
        }

        .revenue-company-cell {
            width: 80%;
            text-align: right;
            font-size: 13px;
            line-height: 1.6;
        }


        /* =========================================
       REPORT TITLE
       ========================================= */

        .revenue-title-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .revenue-title-table td {
            border: none !important;
            padding: 5px;
        }

        .revenue-report-title {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
        }

        .revenue-report-period {
            text-align: right;
        }


        /* =========================================
       REPORT INFORMATION
       ========================================= */

        .revenue-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 8px;
        }

        .revenue-info-table td {
            border: none !important;
            padding: 4px 0;
        }


        /* =========================================
       REVENUE TABLE
       ========================================= */

        .revenue-print-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .revenue-print-table thead {
            display: table-header-group;
        }

        .revenue-print-table tbody {
            display: table-row-group;
        }

        .revenue-print-table tr {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .revenue-print-table th {
            background: #f5f5f5 !important;
            border: 1px solid #000 !important;

            padding: 5px 4px;

            text-align: center;
            vertical-align: middle;

            font-weight: bold;
        }

        .revenue-print-table td {
            border: 1px solid #000 !important;

            padding: 5px 4px;

            text-align: center;
            vertical-align: middle;

            word-break: break-word;
        }


        /* =========================================
       AMOUNT COLUMNS
       ========================================= */

        .revenue-print-table .amount {
            text-align: right !important;
            white-space: nowrap;
        }


        /* =========================================
       STATUS
       ========================================= */

        .revenue-print-status {
            font-weight: bold;
            white-space: nowrap;
        }


        /* =========================================
       TOTAL ROW
       ========================================= */

        .revenue-total-row td {
            font-weight: bold !important;
            background: #f5f5f5 !important;
        }
    }
</style>

<div id="revenueScreenReport" class="w-full bg-white rounded-2xl shadow-md p-6">
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                <?= isset($report_label) ? $report_label : 'Revenue/Sales Report' ?>
            </h2>

            <p class="text-sm text-gray-500">
                From
                <b><?= date('d M Y', strtotime($from)) ?></b>
                to
                <b><?= date('d M Y', strtotime($to)) ?></b>
            </p>
        </div>

        <!-- FILTER + ACTION BUTTONS -->
        <div class="no-print flex flex-wrap items-center gap-2">

            <?php if ($has_revenue_report_access): ?>
            <form method="get" class="flex flex-wrap items-center gap-2">

                <input type="date"
                    name="from"
                    value="<?= $from ?>"
                    class="border rounded px-3 py-2 text-sm">

                <input type="date"
                    name="to"
                    value="<?= $to ?>"
                    class="border rounded px-3 py-2 text-sm">

                <?php if ($can_view_job_card && $can_view_scrap): ?>
                    <select name="report_type" class="border rounded px-3 py-2 text-sm">
                        <option value="job_card" <?= $report_type === 'job_card' ? 'selected' : '' ?>>Job Card Report</option>
                        <option value="scrap" <?= $report_type === 'scrap' ? 'selected' : '' ?>>Scrap Report</option>
                    </select>
                <?php elseif ($can_view_job_card): ?>
                    <input type="hidden" name="report_type" value="job_card">
                    <span class="text-sm text-gray-600">Job Card Report</span>
                <?php elseif ($can_view_scrap): ?>
                    <input type="hidden" name="report_type" value="scrap">
                    <span class="text-sm text-gray-600">Scrap Report</span>
                <?php endif; ?>

                <select name="status" class="border rounded px-3 py-2 text-sm">
                    <option value="" <?= empty($status) ? 'selected' : '' ?>>All Invoices</option>
                    <option value="pending" <?= (!empty($status) && ($status === 'pending' || $status === 'unpaid')) ? 'selected' : '' ?>>Pending / Unpaid</option>
                    <option value="paid" <?= (!empty($status) && $status === 'paid') ? 'selected' : '' ?>>Paid</option>
                </select>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                    Filter
                </button>

            </form>

            <button type="button"
                onclick="window.print()"
                class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 text-sm">
                Print
            </button>

            <button type="button"
                onclick="exportRevenueExcel()"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                Export Excel
            </button>
            <?php else: ?>
                <p class="text-sm text-gray-500">You do not have access to job card or scrap revenue reports.</p>
            <?php endif; ?>

        </div>

    </div>

    <?php if (!empty($show_revenue_summary)): ?>
    <!-- REVENUE BREAKDOWN BY TYPE -->
    <div class="print-hide-summary mb-6 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Revenue Summary</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-3 rounded-lg shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Combined Revenue</p>
                <h4 class="text-xl font-bold text-indigo-700">
                    AED <?= number_format($combined_revenue ?? 0, 2) ?>
                </h4>
            </div>
            <div class="bg-white p-3 rounded-lg shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Job Card Revenue</p>
                <h4 class="text-xl font-bold text-blue-700">
                    AED <?= number_format($job_card_revenue ?? 0, 2) ?>
                </h4>
            </div>
            <div class="bg-white p-3 rounded-lg shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Scrap Revenue</p>
                <h4 class="text-xl font-bold text-green-700">
                    AED <?= number_format($scrap_revenue ?? 0, 2) ?>
                </h4>
            </div>
            <div class="bg-white p-3 rounded-lg shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Combined Tax</p>
                <h4 class="text-xl font-bold text-purple-700">
                    AED <?= number_format(($job_card_tax ?? 0) + ($scrap_tax ?? 0), 2) ?>
                </h4>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($report_type !== null): ?>
    <!-- KPI SUMMARY FOR CURRENT REPORT -->
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Current Report Details</h3>

    <?php


    $invoiceCount = count($reports);
    $paidTotal = 0;
    $unpaidTotal = 0;
    $total_revenue = 0;
    $total_tax = 0;

    foreach ($reports as $r) {

        $paidTotal += $r->paid_amount;

        $total_revenue += $r->grand_total;

        $total_tax += $r->tax_amount;

        $unpaidTotal += ($r->grand_total - $r->paid_amount);
    }

    ?>

    <div class="print-hide-summary grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-blue-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Total Revenue</p>
            <h3 class="text-2xl font-bold text-blue-700">
                AED <?= number_format($total_revenue, 2) ?>
            </h3>
        </div>

        <div class="bg-green-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Paid Amount</p>
            <h3 class="text-2xl font-bold text-green-700">
                AED <?= number_format($paidTotal, 2) ?>
            </h3>
        </div>

        <div class="bg-red-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">Unpaid Amount</p>
            <h3 class="text-2xl font-bold text-red-700">
                AED <?= number_format($unpaidTotal, 2) ?>
            </h3>
        </div>

        <div class="bg-purple-50 p-4 rounded-xl">
            <p class="text-sm text-gray-500">VAT Collected</p>
            <h3 class="text-2xl font-bold text-purple-700">
                AED <?= number_format($total_tax, 2) ?>
            </h3>
        </div>

    </div>

    <!-- REVENUE TABLE -->
    <table id="revenueTable" class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th>#</th>
                <th>Invoice No</th>
                <th>Date</th>
                <th>Subtotal</th>
                <th>VAT</th>
                <th>Discount</th>
                <th>Grand Total</th>
                <?php if (isset($report_type) && $report_type === 'scrap'): ?>
                    <th>Advance Used</th>
                <?php endif; ?>
                <th>Paid Amount</th>
                <th>Balance</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($reports)): ?>
                <?php $i = 1;
                foreach ($reports as $r): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $r->invoice_no ?></td>
                        <td><?= date('d-m-Y', strtotime($r->invoice_date)) ?></td>
                        <td><?= number_format($r->subtotal, 2) ?></td>
                        <td><?= number_format($r->tax_amount, 2) ?></td>
                        <td><?= number_format($r->discount_amount, 2) ?></td>
                        <td class="font-semibold">
                            <?= number_format($r->grand_total, 2) ?>
                        </td>
                        <?php if (isset($report_type) && $report_type === 'scrap'): ?>
                            <td class="text-blue-700 font-semibold">
                                <?= number_format($r->advance_used ?? 0, 2) ?>
                            </td>
                        <?php endif; ?>
                        <td class="text-green-700 font-semibold">
                            <?= number_format($r->paid_amount, 2) ?>
                        </td>
                        <td class="text-red-600 font-semibold">
                            <?php if (isset($report_type) && $report_type === 'scrap'): ?>
                                <?= number_format($r->balance ?? 0, 2) ?>
                            <?php else: ?>
                                <?= number_format($r->grand_total - $r->paid_amount, 2) ?>
                            <?php endif; ?>
                        </td>

                        <td>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
							<?= $r->payment_status == 'Paid' ? 'bg-green-100 text-green-700' : ($r->payment_status == 'Partially Paid' ? 'bg-yellow-100 text-yellow-700' :
                                'bg-red-100 text-red-700') ?>">
                                <?= $r->payment_status ?>
                            </span>
                        </td>
                        <td class="no-print text-center">
                            <div class="flex gap-2 justify-center items-center">

                                <!-- VIEW INVOICE -->
                                <a href="<?= base_url('index.php/' . (isset($report_type) && $report_type === 'scrap' ? 'scrap/view/' : 'invoice/view/') . $r->invoice_id) ?>"
                                    class="p-2 rounded bg-yellow-100 hover:bg-yellow-200"
                                    title="View <?= isset($report_type) && $report_type === 'scrap' ? 'Scrap Sale' : 'View Invoice' ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-4 h-4 text-yellow-700">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 12s3.75-7.5 9.75-7.5
                                         9.75 7.5 9.75 7.5
                                         -3.75 7.5 -9.75 7.5
                                         S2.25 12 2.25 12z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
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
                    <td colspan="<?= ($report_type === 'scrap') ? 12 : 11 ?>"
                        class="text-center py-4 text-gray-500">
                        No invoices found for selected date range
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php endif; ?>

</div>
<?php if ($has_revenue_report_access): ?>
<div id="revenuePrintReport">

    <?php $company_profile = get_current_company_details(); ?>

    <!-- COMPANY HEADER -->
    <table class="revenue-print-header">
        <tr>

            <td class="revenue-logo-cell">
                <img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>"
                    alt="Company logo">
            </td>

            <td class="revenue-company-cell">
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
    <table class="revenue-title-table">

        <tr>

            <td width="35%">
                <b>Report:</b>
                <?= isset($report_label)
                    ? htmlspecialchars($report_label)
                    : 'Revenue/Sales Report' ?>
            </td>

            <td width="30%" class="revenue-report-title">
                REVENUE REPORT
            </td>

            <td width="35%" class="revenue-report-period">
                <b>Period:</b>
                <?= date('d M Y', strtotime($from)) ?>
                to
                <?= date('d M Y', strtotime($to)) ?>
            </td>

        </tr>

    </table>


    <br>


    <!-- REPORT INFORMATION -->
    <table class="revenue-info-table">

        <tr>

            <td width="50%">
                <b>Report Type:</b>

                <?= ($report_type === 'scrap')
                    ? 'Scrap Report'
                    : 'Job Card Report' ?>
                <?php if (!empty($status)): ?>
                    <span style="margin-left: 10px;">(<b>Status:</b> <?= ($status === 'pending' || $status === 'unpaid') ? 'Pending / Unpaid' : 'Paid' ?>)</span>
                <?php endif; ?>
            </td>

            <td width="50%" style="text-align:right;">
                <b>Prepared by:</b>
                <?= $this->session->userdata('username') ?? '' ?>
            </td>

        </tr>

    </table>


    <!-- REVENUE TABLE -->
    <table class="revenue-print-table">

        <thead>

            <tr>

                <th style="width:5%;">Sl No</th>

                <th style="width:12%;">Invoice No</th>

                <th style="width:10%;">Date</th>

                <th style="width:10%;">Subtotal</th>

                <th style="width:8%;">VAT</th>

                <th style="width:9%;">Discount</th>

                <th style="width:11%;">Grand Total</th>

                <?php if (
                    isset($report_type) &&
                    $report_type === 'scrap'
                ): ?>

                    <th style="width:10%;">
                        Advance Used
                    </th>

                <?php endif; ?>

                <th style="width:11%;">
                    Paid Amount
                </th>

                <th style="width:10%;">
                    Balance
                </th>

                <th style="width:10%;">
                    Status
                </th>

            </tr>

        </thead>


        <tbody>

            <?php if (!empty($reports)): ?>

                <?php
                $printNo = 1;

                $printTotalSubtotal = 0;
                $printTotalTax = 0;
                $printTotalDiscount = 0;
                $printTotalGrand = 0;
                $printTotalPaid = 0;
                $printTotalBalance = 0;
                $printTotalAdvance = 0;
                ?>


                <?php foreach ($reports as $r): ?>

                    <?php

                    $balance =
                        ($report_type === 'scrap')
                        ? ($r->balance ?? 0)
                        : ($r->grand_total - $r->paid_amount);

                    $printTotalSubtotal += (float)$r->subtotal;
                    $printTotalTax += (float)$r->tax_amount;
                    $printTotalDiscount += (float)$r->discount_amount;
                    $printTotalGrand += (float)$r->grand_total;
                    $printTotalPaid += (float)$r->paid_amount;
                    $printTotalBalance += (float)$balance;

                    if (
                        isset($report_type) &&
                        $report_type === 'scrap'
                    ) {
                        $printTotalAdvance +=
                            (float)($r->advance_used ?? 0);
                    }

                    ?>

                    <tr>

                        <td>
                            <?= $printNo++ ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($r->invoice_no) ?>
                        </td>

                        <td>
                            <?= date(
                                'd-m-Y',
                                strtotime($r->invoice_date)
                            ) ?>
                        </td>

                        <td class="amount">
                            <?= number_format($r->subtotal, 2) ?>
                        </td>

                        <td class="amount">
                            <?= number_format($r->tax_amount, 2) ?>
                        </td>

                        <td class="amount">
                            <?= number_format($r->discount_amount, 2) ?>
                        </td>

                        <td class="amount">
                            <?= number_format($r->grand_total, 2) ?>
                        </td>

                        <?php if (
                            isset($report_type) &&
                            $report_type === 'scrap'
                        ): ?>

                            <td class="amount">
                                <?= number_format(
                                    $r->advance_used ?? 0,
                                    2
                                ) ?>
                            </td>

                        <?php endif; ?>

                        <td class="amount">
                            <?= number_format(
                                $r->paid_amount,
                                2
                            ) ?>
                        </td>

                        <td class="amount">
                            <?= number_format(
                                $balance,
                                2
                            ) ?>
                        </td>

                        <td class="revenue-print-status">
                            <?= htmlspecialchars(
                                $r->payment_status
                            ) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>


                <!-- TOTAL -->
                <tr class="revenue-total-row">

                    <td
                        colspan="<?= ($report_type === 'scrap') ? 3 : 3 ?>"
                        style="text-align:right;">
                        <strong>Total:</strong>
                    </td>

                    <td class="amount">
                        <?= number_format(
                            $printTotalSubtotal,
                            2
                        ) ?>
                    </td>

                    <td class="amount">
                        <?= number_format(
                            $printTotalTax,
                            2
                        ) ?>
                    </td>

                    <td class="amount">
                        <?= number_format(
                            $printTotalDiscount,
                            2
                        ) ?>
                    </td>

                    <td class="amount">
                        <?= number_format(
                            $printTotalGrand,
                            2
                        ) ?>
                    </td>

                    <?php if (
                        isset($report_type) &&
                        $report_type === 'scrap'
                    ): ?>

                        <td class="amount">
                            <?= number_format(
                                $printTotalAdvance,
                                2
                            ) ?>
                        </td>

                    <?php endif; ?>

                    <td class="amount">
                        <?= number_format(
                            $printTotalPaid,
                            2
                        ) ?>
                    </td>

                    <td class="amount">
                        <?= number_format(
                            $printTotalBalance,
                            2
                        ) ?>
                    </td>

                    <td></td>

                </tr>

            <?php else: ?>

                <tr>

                    <td
                        colspan="<?= ($report_type === 'scrap') ? 11 : 10 ?>"
                        style="text-align:center;">

                        No invoices found for selected date range

                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>
<?php endif; ?>
<!-- DATATABLE -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (!document.querySelector("#revenueTable")) {
            return;
        }

        new simpleDatatables.DataTable("#revenueTable", {
            searchable: true,
            fixedHeight: true,
            perPage: 10,
            labels: {
                placeholder: "Search invoices...",
                noRows: "No invoices found",
                info: "Showing {start} to {end} of {rows} invoices"
            }
        });
    });
</script>
<script>
    function escapeCSV(value) {
        return '"' + String(value ?? '')
            .replace(/"/g, '""')
            .trim() + '"';
    }


    function exportRevenueExcel() {

        const table = document.getElementById('revenueTable');

        if (!table) {
            return;
        }

        const csvRows = [];

        // =========================================
        // REPORT TITLE
        // =========================================

        csvRows.push([
            escapeCSV(
                '<?= isset($report_label)
                        ? htmlspecialchars($report_label, ENT_QUOTES, 'UTF-8')
                        : 'Revenue/Sales Report' ?>'
            )
        ].join(','));


        // =========================================
        // DATE RANGE
        // =========================================

        csvRows.push([
            escapeCSV(
                'From <?= date('d M Y', strtotime($from)) ?> to <?= date('d M Y', strtotime($to)) ?>'
            )
        ].join(','));


        // =========================================
        // REPORT TYPE
        // =========================================

        csvRows.push([
            escapeCSV(
                'Report Type: <?= isset($report_type) && $report_type === 'scrap'
                                    ? 'Scrap Report'
                                    : 'Job Card Report' ?>'
            )
        ].join(','));

        <?php if (!empty($status)): ?>
        csvRows.push([
            escapeCSV(
                'Status: <?= ($status === 'pending' || $status === 'unpaid') ? 'Pending / Unpaid' : 'Paid' ?>'
            )
        ].join(','));
        <?php endif; ?>


        // Empty line
        csvRows.push('');


        // =========================================
        // TABLE HEADER
        // =========================================

        let headerColumns = [
            '#',
            'Invoice No',
            'Date',
            'Subtotal',
            'VAT',
            'Discount',
            'Grand Total'
        ];

        <?php if (isset($report_type) && $report_type === 'scrap'): ?>

            headerColumns.push('Advance Used');

        <?php endif; ?>

        headerColumns.push(
            'Paid Amount',
            'Balance',
            'Status'
        );

        csvRows.push(
            headerColumns
            .map(escapeCSV)
            .join(',')
        );


        // =========================================
        // TABLE DATA
        // =========================================

        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(function(row) {

            const noDataRow =
                row.querySelector('td[colspan]');

            if (noDataRow) {
                return;
            }

            const cells =
                row.querySelectorAll('td');

            let rowData = [];

            // # 
            rowData.push(
                cells[0].innerText.trim()
            );

            // Invoice No
            rowData.push(
                cells[1].innerText.trim()
            );

            // Date
            const reportDate = cells[2].innerText.trim();

            rowData.push(
                '="' + reportDate + '"'
            );
            // Subtotal
            rowData.push(
                cells[3].innerText.trim()
            );

            // VAT
            rowData.push(
                cells[4].innerText.trim()
            );

            // Discount
            rowData.push(
                cells[5].innerText.trim()
            );

            // Grand Total
            rowData.push(
                cells[6].innerText.trim()
            );


            <?php if (isset($report_type) && $report_type === 'scrap'): ?>

                // Advance Used
                rowData.push(
                    cells[7].innerText.trim()
                );

                // Paid
                rowData.push(
                    cells[8].innerText.trim()
                );

                // Balance
                rowData.push(
                    cells[9].innerText.trim()
                );

                // Status
                rowData.push(
                    cells[10].innerText.trim()
                );

            <?php else: ?>

                // Paid
                rowData.push(
                    cells[7].innerText.trim()
                );

                // Balance
                rowData.push(
                    cells[8].innerText.trim()
                );

                // Status
                rowData.push(
                    cells[9].innerText.trim()
                );

            <?php endif; ?>


            csvRows.push(
                rowData.map(escapeCSV).join(',')
            );

        });


        if (csvRows.length <= 4) {
            return;
        }


        // =========================================
        // CREATE CSV
        // =========================================

        const csvContent =
            '\uFEFF' + csvRows.join('\r\n');

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
            'revenue_report_' +
            new Date().toISOString().slice(0, 10) +
            '.csv';

        document.body.appendChild(link);

        link.click();

        document.body.removeChild(link);

        URL.revokeObjectURL(url);
    }
</script>