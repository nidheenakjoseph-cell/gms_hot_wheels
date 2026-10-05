<?php $this->load->helper('account_helper.php'); ?>

<div class="p-4 bg-white rounded-lg shadow">

<!-- =========================
     REPORT
========================= -->
<div class="mt-8">

    <!-- REPORT HEADER -->
    <div class="text-center mb-5">

        <!-- <h2 class="text-2xl font-bold uppercase">
            <?php echo htmlspecialchars($company_records[0]->company_name); ?>
        </h2> -->

        <h2 class="text-2xl font-bold uppercase">
            Profit &amp; Loss Statement
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Period:
            <strong>
                <?php echo date('d M Y', strtotime($from)); ?>
            </strong>
            to
            <strong>
                <?php echo date('d M Y', strtotime($to)); ?>
            </strong>
        </p>

    </div>


    <!-- =========================
         FILTER FORM
    ========================== -->
    <div class="report-filter mb-6">

        <form id="main"
            method="post"
            action="<?php echo base_url() . 'index.php/Accounts/view_profit_and_loss'; ?>"
            autocomplete="off"
            enctype="multipart/form-data">

            <div class="flex flex-wrap items-end justify-center gap-4">

                <!-- FROM -->
                <div class="w-full sm:w-auto">

                    <label for="from"
                        class="block text-sm font-semibold text-gray-700 mb-1">
                        From <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        class="w-full sm:w-48 border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        id="from"
                        name="from"
                        value="<?php echo htmlspecialchars($from); ?>"
                        required>

                </div>


                <!-- TO -->
                <div class="w-full sm:w-auto">

                    <label for="to"
                        class="block text-sm font-semibold text-gray-700 mb-1">
                        To <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        class="w-full sm:w-48 border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        id="to"
                        name="to"
                        value="<?php echo htmlspecialchars($to); ?>"
                        required>

                </div>


                <!-- BUTTON -->
                <div class="w-full sm:w-auto">

                    <button
                        type="submit"
                        id="view"
                        name="go"
                        class="bg-blue-600 text-white px-5 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">

                        <i class="fa fa-search mr-1"></i>
                        Go

                    </button>

                </div>

            </div>

        </form>

    </div>
        <!-- =========================
             INCOME / EXPENSE
        ========================== -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- =========================
                 INCOME
            ========================== -->
            <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm">

                <div class="bg-green-50 px-4 py-3 border-b border-gray-200">
                    <h4 class="font-bold text-green-800 text-lg">
                        Income
                    </h4>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border-b border-gray-200 px-4 py-3 text-left">
                                    Income
                                </th>

                                <th class="border-b border-gray-200 px-4 py-3 text-right w-40">
                                    Amount
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($income)) { ?>

                                <?php foreach ($income as $i) { ?>

                                    <tr class="hover:bg-gray-50 transition">

                                        <td class="border-b border-gray-100 px-4 py-3">

                                            <a href="javascript:void(0);"
                                                class="open-drilldown text-blue-600 hover:text-blue-800 hover:underline font-medium"
                                                data-id="<?php echo (int) $i->account_id; ?>"
                                                data-name="<?php echo htmlspecialchars($i->account_name, ENT_QUOTES); ?>">

                                                <?php echo htmlspecialchars($i->account_name); ?>

                                            </a>

                                        </td>

                                        <td class="border-b border-gray-100 px-4 py-3 text-right font-medium">

                                            <?php echo number_format(abs($i->total), 2); ?>

                                        </td>

                                    </tr>

                                <?php } ?>

                            <?php } else { ?>

                                <tr>
                                    <td colspan="2"
                                        class="px-4 py-6 text-center text-gray-500">
                                        No income data available.
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>

                        <tfoot>

                            <tr class="bg-gray-50 font-bold">

                                <td class="px-4 py-3">
                                    Total Income
                                </td>

                                <td class="px-4 py-3 text-right text-green-700">
                                    <?php echo number_format($total_income, 2); ?>
                                </td>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>


            <!-- =========================
                 EXPENSE
            ========================== -->
            <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm">

                <div class="bg-red-50 px-4 py-3 border-b border-gray-200">

                    <h4 class="font-bold text-red-800 text-lg">
                        Expenses
                    </h4>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead>

                            <tr class="bg-gray-100">

                                <th class="border-b border-gray-200 px-4 py-3 text-left">
                                    Expense
                                </th>

                                <th class="border-b border-gray-200 px-4 py-3 text-right w-40">
                                    Amount
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($expense)) { ?>

                                <?php foreach ($expense as $e) { ?>

                                    <tr class="hover:bg-gray-50 transition">

                                        <td class="border-b border-gray-100 px-4 py-3">

                                            <a href="javascript:void(0);"
                                                class="open-drilldown text-blue-600 hover:text-blue-800 hover:underline font-medium"
                                                data-id="<?php echo (int) $e->account_id; ?>"
                                                data-name="<?php echo htmlspecialchars($e->account_name, ENT_QUOTES); ?>">

                                                <?php echo htmlspecialchars($e->account_name); ?>

                                            </a>

                                        </td>

                                        <td class="border-b border-gray-100 px-4 py-3 text-right font-medium">

                                            <?php echo number_format(abs($e->total), 2); ?>

                                        </td>

                                    </tr>

                                <?php } ?>

                            <?php } else { ?>

                                <tr>
                                    <td colspan="2"
                                        class="px-4 py-6 text-center text-gray-500">
                                        No expense data available.
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>

                        <tfoot>

                            <tr class="bg-gray-50 font-bold">

                                <td class="px-4 py-3">
                                    Total Expense
                                </td>

                                <td class="px-4 py-3 text-right text-red-700">
                                    <?php echo number_format($total_expense, 2); ?>
                                </td>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

        </div>


        <!-- =========================
             NET PROFIT / LOSS
        ========================== -->
        <div class="mt-6">

            <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm">

                <div class="px-5 py-5 text-right
                    <?php echo ($net_profit >= 0)
                        ? 'bg-green-50'
                        : 'bg-red-50'; ?>">

                    <?php if ($net_profit >= 0) { ?>

                        <span class="text-green-700 text-xl font-bold">

                            <i class="fa fa-arrow-up mr-1"></i>

                            Net Profit :
                            <?php echo number_format($net_profit, 2); ?>

                        </span>

                    <?php } else { ?>

                        <span class="text-red-700 text-xl font-bold">

                            <i class="fa fa-arrow-down mr-1"></i>

                            Net Loss :
                            <?php echo number_format(abs($net_profit), 2); ?>

                        </span>

                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- =========================================================
     LEDGER DRILLDOWN MODAL
========================================================= -->

<div id="drilldownModal"
    class="fixed inset-0 z-[9999] hidden bg-gray-900/60 backdrop-blur-sm overflow-y-auto"
    aria-hidden="true">

    <div class="min-h-screen flex items-center justify-center p-4">

        <div class="w-full max-w-5xl bg-white rounded-xl shadow-2xl overflow-hidden">

            <!-- ================= HEADER ================= -->
            <div class="px-6 py-4 bg-white border-b border-gray-200">

                <div class="flex items-center justify-between gap-4">

                    <!-- LEFT -->
                    <div class="flex items-center gap-3 min-w-0">

                        <div class="w-10 h-10 flex-shrink-0 rounded-lg bg-blue-100
                                    flex items-center justify-center">

                            <i class="fa fa-book text-blue-600 text-lg"></i>

                        </div>

                        <div class="min-w-0">

                            <h5 id="drilldownModalLabel"
                                class="text-lg font-bold text-gray-800 truncate">

                                Ledger Details

                            </h5>

                            <p class="text-xs text-gray-500 mt-0.5">
                                Transaction Details
                            </p>

                        </div>

                    </div>


                    <!-- CLOSE -->
                    <button type="button"
                        class="close-modal flex-shrink-0
                               w-9 h-9 rounded-full
                               flex items-center justify-center
                               text-gray-400 hover:text-gray-700
                               hover:bg-gray-100 transition"
                        aria-label="Close">

                        <i class="fa fa-times text-sm"></i>

                    </button>

                </div>

            </div>


            <!-- ================= BODY ================= -->
            <div class="bg-gray-50 p-5">

                <!-- LOADING -->
                <div id="modal-loading" class="hidden">

                    <div class="bg-white rounded-lg border border-gray-200
                                px-6 py-12 text-center">

                        <div class="w-12 h-12 mx-auto mb-4 rounded-full
                                    bg-blue-50 flex items-center justify-center">

                            <i class="fa fa-spinner fa-spin
                                      text-blue-600 text-xl"></i>

                        </div>

                        <h6 class="font-semibold text-gray-700">
                            Loading transactions
                        </h6>

                        <p class="text-sm text-gray-500 mt-1">
                            Please wait while ledger details are loaded.
                        </p>

                    </div>

                </div>


                <!-- AJAX CONTENT -->
                <div id="modal-content-area">

                </div>

            </div>


            <!-- ================= FOOTER ================= -->
            <div class="px-6 py-4 bg-white border-t border-gray-200
                        flex items-center justify-between gap-4">

                <div class="text-xs text-gray-500">

                    <i class="fa fa-info-circle mr-1"></i>

                    Ledger transaction details

                </div>

                <button type="button"
                    class="close-modal
                           bg-gray-600 hover:bg-gray-700
                           text-white px-5 py-2 rounded-md
                           text-sm font-medium transition">

                    Close

                </button>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     DRILLDOWN TABLE STYLES
========================================================= -->

<style>

/* Main AJAX area */
#modal-content-area {
    width: 100%;
}


/* Table wrapper */
#modal-content-area .ledger-table-wrapper {
    width: 100%;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
}


/* Scroll area */
#modal-content-area .ledger-table-scroll {
    width: 100%;
    max-height: 55vh;
    overflow-x: auto;
    overflow-y: auto;
}


/* Ledger table */
#modal-content-area table {
    width: 100% !important;
    min-width: 1050px;
    border-collapse: collapse !important;
    margin: 0 !important;
    background: #ffffff;
    font-size: 13px;
}


/* Table header */
#modal-content-area table thead th {
    background: #f3f4f6 !important;
    color: #374151 !important;
    font-weight: 600 !important;
    padding: 12px 16px !important;
    border-bottom: 1px solid #d1d5db !important;
    white-space: nowrap;
    text-align: left;
}


/* Date column */
#modal-content-area table thead th:first-child,
#modal-content-area table tbody td:first-child {
    width: 110px;
    white-space: nowrap;
}


/* Ledger name column */
#modal-content-area table thead th:nth-child(2),
#modal-content-area table tbody td:nth-child(2) {
    min-width: 160px;
    max-width: 220px;
    white-space: normal;
    font-weight: 500;
}


/* Voucher / type columns */
#modal-content-area table thead th:nth-child(3),
#modal-content-area table tbody td:nth-child(3),
#modal-content-area table thead th:nth-child(4),
#modal-content-area table tbody td:nth-child(4) {
    white-space: nowrap;
}


/* Particulars column */
#modal-content-area table thead th:nth-child(5),
#modal-content-area table tbody td:nth-child(5) {
    width: auto;
    min-width: 200px;
}


/* Debit / credit columns */
#modal-content-area table thead th:nth-child(6),
#modal-content-area table tbody td:nth-child(6),
#modal-content-area table thead th:nth-child(7),
#modal-content-area table tbody td:nth-child(7) {
    width: 120px;
    text-align: right !important;
    white-space: nowrap;
}


/* Remove legacy 3-column amount styling */
#modal-content-area table thead th:last-child,
#modal-content-area table tbody td:last-child {
    width: 120px;
    text-align: right !important;
    white-space: nowrap;
}


/* Table cells */
#modal-content-area table tbody td {
    padding: 11px 16px !important;
    border-bottom: 1px solid #f1f5f9 !important;
    color: #374151;
    vertical-align: middle;
}


/* Alternate rows */
#modal-content-area table tbody tr:nth-child(even) {
    background: #fafafa;
}


/* Hover */
#modal-content-area table tbody tr:hover {
    background: #f8fafc !important;
}


/* Debit / credit cell emphasis */
#modal-content-area table tbody td:nth-child(6) {
    font-weight: 500;
    color: #15803d;
}

#modal-content-area table tbody td:nth-child(7) {
    font-weight: 500;
    color: #b91c1c;
}


/* Total row */
#modal-content-area table tfoot tr,
#modal-content-area table tbody tr.total-row {
    background: #f3f4f6 !important;
    font-weight: 700;
}


/* Total cells */
#modal-content-area table tfoot td,
#modal-content-area table tbody tr.total-row td {
    padding: 12px 16px !important;
    border-top: 1px solid #d1d5db !important;
    border-bottom: 0 !important;
    color: #374151 !important;
}


/* Total amount */
#modal-content-area table tfoot td:last-child,
#modal-content-area table tbody tr.total-row td:last-child {
    text-align: right !important;
    color: #111827 !important;
    font-weight: 700 !important;
}


/* Remove old Bootstrap table spacing if returned */
#modal-content-area .table {
    margin-bottom: 0 !important;
}


/* Alert */
#modal-content-area .alert {
    margin: 0 !important;
    border-radius: 8px;
}


/* Empty result */
#modal-content-area .no-data {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 40px 20px;
    text-align: center;
    color: #6b7280;
}


/* Mobile */
@media (max-width: 640px) {

    #drilldownModal > div {
        padding: 10px;
    }

    #drilldownModal .max-w-5xl {
        border-radius: 10px;
    }

    #modal-content-area table {
        min-width: 920px;
    }

}
/* ==========================================
   PRINT
========================================== */

@media print {

    .report-filter {
        display: none !important;
    }

    #drilldownModal {
        display: none !important;
    }

}
</style>


<!-- =========================================================
     DRILLDOWN JAVASCRIPT
========================================================= -->

<script>

$(document).ready(function () {

    /*
     * ==========================================
     * OPEN LEDGER DRILLDOWN
     * ==========================================
     */

    $(document).on('click', '.open-drilldown', function (e) {

        e.preventDefault();

        var accountId = $(this).data('id');
        var accountName = $(this).data('name');

        var fromDate = $('#from').val();
        var toDate = $('#to').val();


        if (!accountId) {
            return;
        }


        /*
         * Set modal title
         */

        $('#drilldownModalLabel').text(
            'Ledger Details: ' + accountName
        );


        /*
         * Clear previous result
         */

        $('#modal-content-area').html('');


        /*
         * Show loading
         */

        $('#modal-loading').removeClass('hidden');


        /*
         * Open custom modal
         */

        $('#drilldownModal')
            .removeClass('hidden')
            .attr('aria-hidden', 'false');


        /*
         * Prevent background scrolling
         */

        $('body').addClass('overflow-hidden');


        /*
         * AJAX
         */

        $.ajax({

            url: "<?php echo base_url(); ?>index.php/Accounts/ajax_drilldown",

            type: "POST", 

            data: {

                account_id: accountId,
                from: fromDate,
                to: toDate

            },

            success: function (response) {

                $('#modal-loading').addClass('hidden');


                /*
                 * Put AJAX response inside styled wrapper
                 */

                $('#modal-content-area').html(
                    '<div class="ledger-table-wrapper">' +
                        '<div class="ledger-table-scroll">' +
                            response +
                        '</div>' +
                    '</div>'
                );

            },

            error: function (xhr, status, error) {

                $('#modal-loading').addClass('hidden');

                $('#modal-content-area').html(

                    '<div class="bg-red-50 border border-red-200 ' +
                    'text-red-700 px-4 py-4 rounded-lg">' +

                        '<div class="flex items-center gap-2">' +

                            '<i class="fa fa-exclamation-circle"></i>' +

                            '<span class="font-medium">' +
                                'Failed to load transaction details.' +
                            '</span>' +

                        '</div>' +

                    '</div>'

                );

                console.error(
                    'Drilldown AJAX Error:',
                    xhr.responseText
                );

            }

        });

    });


    /*
     * ==========================================
     * CLOSE MODAL
     * ==========================================
     */

    function closeDrilldownModal() {

        $('#drilldownModal')
            .addClass('hidden')
            .attr('aria-hidden', 'true');


        $('body').removeClass('overflow-hidden');


        $('#modal-content-area').html('');


        $('#modal-loading').addClass('hidden');

    }


    /*
     * ==========================================
     * CLOSE BUTTON
     * ==========================================
     */

    $(document).on('click', '.close-modal', function (e) {

        e.preventDefault();

        closeDrilldownModal();

    });


    /*
     * ==========================================
     * CLICK OUTSIDE
     * ==========================================
     */

    $('#drilldownModal').on('click', function (e) {

        if (e.target === this) {

            closeDrilldownModal();

        }

    });


    /*
     * ==========================================
     * ESC KEY
     * ==========================================
     */

    $(document).on('keydown', function (e) {

        if (e.key === 'Escape') {

            if (!$('#drilldownModal').hasClass('hidden')) {

                closeDrilldownModal();

            }

        }

    });

});

</script>