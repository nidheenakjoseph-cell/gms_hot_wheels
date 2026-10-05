<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css"
      rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<div class="bg-white shadow-md rounded-xl p-6">
      
    <div class="bg-white shadow-md rounded-xl p-6">

    <!-- =========================
         REPORT HEADER
    ========================== -->
    <div class="text-center mb-5">

                <!-- <h2 class="text-2xl font-bold uppercase">
                    <?php echo htmlspecialchars($company_records[0]->company_name); ?>
                </h2> -->

        <h2 class="text-2xl font-bold uppercase">
            Outstanding Report
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Period:
            <strong>
                <?php echo !empty($from)
                    ? date('d M Y', strtotime($from))
                    : date('d M Y'); ?>
            </strong>
            to
            <strong>
                <?php echo !empty($to)
                    ? date('d M Y', strtotime($to))
                    : date('d M Y'); ?>
            </strong>
        </p>

    </div>


    <!-- =========================
            FILTER FORM
        ========================== -->
    <form class="grid md:grid-cols-12 gap-4 items-end"
          action="<?php echo base_url('index.php/Accounts/search_outstanding_report'); ?>"
          method="post"
          id="receipt"
          name="receipt"
          autocomplete="off">

        <!-- FROM DATE -->
        <div class="md:col-span-2">

            <label class="block text-sm font-medium mb-1">
                From
            </label>

            <div class="relative">

                <input
                    type="date"
                    class="w-full sm:w-48 border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    name="from"
                    id="from"
                    value="<?php echo !empty($from) ? htmlspecialchars(date('Y-m-d', strtotime($from))) : date('Y-m-01'); ?>"
                    required>

            </div>

        </div>


        <!-- TO DATE -->
        <div class="md:col-span-2">

            <label class="block text-sm font-medium mb-1">
                To
            </label>

            <div class="relative">

                <input
                    type="date"
                    class="w-full sm:w-48 border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    name="to"
                    id="to"
                    value="<?php echo !empty($to) ? htmlspecialchars(date('Y-m-d', strtotime($to))) : date('Y-m-d'); ?>"
                    required>

            </div>

        </div>


        <!-- =========================
             TYPE
        ========================== -->
        <div class="md:col-span-3">
            <label class="block text-sm font-medium mb-1">Type</label>

            <select class="w-full border rounded-lg px-3 py-2 select2 request_type_select"
                    name="request_type"
                    id="request_type">

                <option value="">Please select type</option>

                <option value="Sundry Creditors"
                    <?php echo (isset($request_type) && $request_type == 'Sundry Creditors') ? 'selected' : ''; ?>>
                    Sundry Creditors
                </option>

                <option value="Sundry Debtors"
                    <?php echo (isset($request_type) && $request_type == 'Sundry Debtors') ? 'selected' : ''; ?>>
                    Sundry Debtors
                </option>

            </select>
        </div>


        <!-- =========================
             LEDGER DROPDOWN
        ========================== -->
        <div class="md:col-span-3"
             id="ledgerDropdownContainer"
             style="<?php echo empty($request_type) ? 'display:none;' : ''; ?>">

            <label class="block text-sm font-medium mb-1">
                Select Ledger
            </label>

            <select class="w-full border rounded-lg px-3 py-2 select2 ledger_select"
                    name="ledger_id"
                    id="ledger_id">

                <option value="">Select Ledger</option>

                <?php if (!empty($ledgers)) : ?>

                    <?php foreach ($ledgers as $ledger) : ?>

                        <option value="<?php echo $ledger->account_id; ?>"
                            <?php echo (!empty($ledger_id) &&
                                        (string)$ledger_id === (string)$ledger->account_id)
                                        ? 'selected'
                                        : ''; ?>>

                            <?php echo htmlspecialchars($ledger->account_name); ?>

                        </option>

                    <?php endforeach; ?>

                <?php endif; ?>

            </select>

        </div>


        <!-- =========================
             ACTION BUTTONS
        ========================== -->
        <div class="md:col-span-12 flex gap-3 mt-2">

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                Go
            </button>

            <button type="button"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg shadow"
                    onclick="submitPrint()">
                Print
            </button>

            <button type="button"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow"
                    onclick="submitExport()">
                Export to Excel
            </button>

        </div>

    </form>


    <!-- =========================
         TABLE
    ========================== -->
    <div class="overflow-x-auto mt-6">

        <table class="min-w-full text-sm border border-gray-300 rounded-lg overflow-hidden">

            <thead class="bg-gray-100">

                <tr>
                    <th class="p-3 border text-left">S.No</th>

                    <th class="p-3 border text-left">
                        Date
                    </th>

                    <th class="p-3 border text-left">
                        <?php
                        echo (isset($request_type) && $request_type == 'Sundry Creditors')
                            ? 'Supplier Name'
                            : 'Customer Name';
                        ?>
                    </th>

                    <th class="p-3 border text-left">
                        Ref. No
                    </th>

                    <th class="p-3 border text-right">
                        Total Amount
                    </th>

                    <th class="p-3 border text-right">
                        Amount Paid
                    </th>

                    <th class="p-3 border text-right">
                        Outstanding
                    </th>

                    <th class="p-3 border text-left">
                        Due On
                    </th>

                    <th class="p-3 border text-left">
                        Overdue Days
                    </th>
                </tr>

            </thead>


            <tbody class="divide-y">

                <?php

                $i = 1;

                $total_amt  = 0;
                $total_paid = 0;
                $total_due  = 0;

                if (!empty($records)) {

                    foreach ($records as $row) {

                        /*
                         * =========================
                         * PAYMENT TERM
                         * =========================
                         */

                        $term = strtolower(trim($row->payment_term ?? ''));

                        $days = 0;

                        if (strpos($term, '90') !== false) {

                            $days = 90;

                        } elseif (strpos($term, '60') !== false) {

                            $days = 60;

                        } elseif (strpos($term, '45') !== false) {

                            $days = 45;

                        } elseif (strpos($term, '30') !== false) {

                            $days = 30;

                        }


                        /*
                         * =========================
                         * VOUCHER DATE
                         * =========================
                         */

                        $voucher_date_clean = date(
                            'Y-m-d',
                            strtotime($row->voucher_date)
                        );


                        /*
                         * =========================
                         * DUE DATE
                         * =========================
                         */

                        $due_date_ts = strtotime(
                            $voucher_date_clean . ' +' . $days . ' days'
                        );


                        /*
                         * =========================
                         * TODAY
                         * =========================
                         */

                        $today_ts = strtotime(date('Y-m-d'));


                        /*
                         * =========================
                         * OVERDUE DAYS
                         * =========================
                         */

                        $overdue_days = floor(
                            ($today_ts - $due_date_ts) / 86400
                        );


                        /*
                         * =========================
                         * DUE DATE LABEL
                         * =========================
                         */

                        $due_label = date(
                            'd-M-Y',
                            $due_date_ts
                        );


                        /*
                         * =========================
                         * PAID AMOUNT
                         * =========================
                         */

                        $paid_amount = (float)($row->paid_amount ?? 0);


                        /*
                         * =========================
                         * TOTALS
                         * =========================
                         */

                        $total_amt += (float)$row->sum_amt;

                        $total_paid += (float)$paid_amount;

                        $total_due += (float)$row->sum_due_amt;

                        ?>

                        <tr class="hover:bg-gray-50">

                            <!-- S.NO -->
                            <td class="p-3 border">
                                <?php echo $i++; ?>
                            </td>


                            <!-- DATE -->
                            <td class="p-3 border">
                                <?php
                                echo date(
                                    'd-M-Y',
                                    strtotime($row->voucher_date)
                                );
                                ?>
                            </td>


                            <!-- CUSTOMER / SUPPLIER -->
                            <td class="p-3 border">

                                <?php

                                if (
                                    isset($request_type)
                                    && $request_type == 'Sundry Creditors'
                                ) {

                                    echo !empty($row->account_name)
                                        ? htmlspecialchars($row->account_name)
                                        : 'N/A';

                                } else {

                                    echo !empty($row->cust_name)
                                        ? htmlspecialchars($row->cust_name)
                                        : 'N/A';

                                }

                                ?>

                            </td>


                            <!-- REFERENCE NUMBER -->
                            <td class="p-3 border">

                                <?php
                                echo htmlspecialchars($row->voucher_code);
                                ?>

                                <?php if (!empty($row->po_number)) : ?>

                                    <br>

                                    <small class="text-gray-500">
                                        LPO No:
                                        <?php
                                        echo htmlspecialchars($row->po_number);
                                        ?>
                                    </small>

                                <?php endif; ?>

                            </td>


                            <!-- TOTAL AMOUNT -->
                            <td class="p-3 border text-right font-medium">

                                <?php
                                echo number_format(
                                    $row->sum_amt,
                                    2
                                );
                                ?>

                            </td>


                            <!-- AMOUNT PAID -->
                            <td class="p-3 border text-right">

                                <?php
                                echo number_format(
                                    $paid_amount,
                                    2
                                );
                                ?>

                            </td>


                            <!-- OUTSTANDING -->
                            <td class="p-3 border text-right font-semibold text-red-600">

                                <?php
                                echo number_format(
                                    $row->sum_due_amt,
                                    2
                                );
                                ?>

                            </td>


                            <!-- DUE DATE -->
                            <td class="p-3 border">

                                <?php
                                echo $due_label;
                                ?>

                            </td>


                            <!-- OVERDUE DAYS -->
                            <td class="p-3 border">

                                <?php
                                echo ($overdue_days > 0)
                                    ? $overdue_days
                                    : '-';
                                ?>

                            </td>

                        </tr>

                    <?php

                    }

                } else {

                    ?>

                    <tr>

                        <td colspan="9"
                            class="p-4 text-center text-gray-500">

                            No records found.

                        </td>

                    </tr>

                <?php } ?>

            </tbody>


            <!-- =========================
                 TOTAL
            ========================== -->
            <tfoot>

                <tr class="font-bold bg-gray-100">

                    <td colspan="4"
                        class="p-3 border text-right">

                        TOTAL

                    </td>

                    <td class="p-3 border text-right">

                        <?php
                        echo number_format(
                            $total_amt,
                            2
                        );
                        ?>

                    </td>

                    <td class="p-3 border text-right">

                        <?php
                        echo number_format(
                            $total_paid,
                            2
                        );
                        ?>

                    </td>

                    <td class="p-3 border text-right">

                        <?php
                        echo number_format(
                            $total_due,
                            2
                        );
                        ?>

                    </td>

                    <td colspan="2"
                        class="p-3 border">
                    </td>

                </tr>

            </tfoot>

        </table>

    </div>

</div>


<script>

$(document).ready(function () {
    /*
     * =========================
     * INITIALIZE TYPE SELECT2
     * =========================
     */

    $('#request_type').select2({
        width: '100%',
        placeholder: 'Please select type'
    });


    /*
     * =========================
     * INITIALIZE LEDGER SELECT2
     * =========================
     */

    $('#ledger_id').select2({
        width: '100%',
        placeholder: 'Select Ledger'
    });


    /*
     * =========================
     * TYPE CHANGE
     * =========================
     */

    $('#request_type').on('change', function () {

        handleRequestTypeChange();

    });


    /*
     * =========================
     * LEDGER CHANGE
     * =========================
     */

    $('#ledger_id').on('change', function () {

        /*
         * Submit only when a ledger
         * is actually selected.
         */

        if ($(this).val() !== '') {

            submitForm();

        }

    });

});


/*
 * ==========================================
 * HANDLE REQUEST TYPE CHANGE
 * ==========================================
 */

function handleRequestTypeChange() {

    var requestType = $('#request_type').val();

    var ledgerDropdown =
        document.getElementById('ledgerDropdownContainer');


    /*
     * =========================
     * NO TYPE SELECTED
     * =========================
     */

    if (
        requestType !== 'Sundry Creditors'
        &&
        requestType !== 'Sundry Debtors'
    ) {

        ledgerDropdown.style.display = 'none';

        $('#ledger_id')
            .empty()
            .append('<option value="">Select Ledger</option>')
            .val('')
            .trigger('change');

        return;
    }


    /*
     * =========================
     * SHOW LEDGER DROPDOWN
     * =========================
     */

    ledgerDropdown.style.display = 'block';


    /*
     * =========================
     * AJAX LOAD LEDGERS
     * =========================
     */

    $.ajax({

        url: "<?php echo base_url('index.php/Accounts/get_ledgers_by_type'); ?>",

        type: "POST",

        data: {
            request_type: requestType
        },

        dataType: "json",

        beforeSend: function () {

            $('#ledger_id')
                .empty()
                .append('<option value="">Loading...</option>')
                .trigger('change');

        },

        success: function (data) {

            var ledgerSelect = $('#ledger_id');

            ledgerSelect.empty();

            ledgerSelect.append(
                '<option value="">Select Ledger</option>'
            );


            /*
             * =========================
             * ADD LEDGERS
             * =========================
             */

            if (data && data.length > 0) {

                $.each(data, function (index, item) {

                    ledgerSelect.append(
                        $('<option>', {
                            value: item.account_id,
                            text: item.account_name
                        })
                    );

                });

            }


            /*
             * =========================
             * RESTORE SELECTED LEDGER
             * =========================
             */

            var selectedLedger =
                "<?php echo isset($ledger_id) ? $ledger_id : ''; ?>";

            if (selectedLedger !== '') {

                ledgerSelect.val(selectedLedger);

            } else {

                ledgerSelect.val('');

            }


            /*
             * REFRESH SELECT2
             */

            ledgerSelect.trigger('change');

        },

        error: function () {

            $('#ledger_id')
                .empty()
                .append(
                    '<option value="">Unable to load ledgers</option>'
                )
                .trigger('change');

        }

    });

}


/*
 * ==========================================
 * SUBMIT MAIN FORM
 * ==========================================
 */

function submitForm() {

    document.getElementById('receipt').submit();

}


/*
 * ==========================================
 * PRINT
 * ==========================================
 */

function submitPrint() {

    const form = document.createElement('form');

    form.method = 'post';

    form.action =
        "<?php echo base_url('index.php/Accounts/print_outstanding_report'); ?>";

    form.target = '_blank';


    form.innerHTML = `

        <input type="hidden"
               name="from"
               value="<?php echo isset($from) ? htmlspecialchars($from) : ''; ?>">

        <input type="hidden"
               name="to"
               value="<?php echo isset($to) ? htmlspecialchars($to) : ''; ?>">

        <input type="hidden"
               name="ledger_id"
               value="<?php echo isset($ledger_id) ? htmlspecialchars($ledger_id) : ''; ?>">

        <input type="hidden"
               name="request_type"
               value="<?php echo isset($request_type) ? htmlspecialchars($request_type) : ''; ?>">

    `;


    document.body.appendChild(form);

    form.submit();

    document.body.removeChild(form);

}


/*
 * ==========================================
 * EXPORT TO EXCEL
 * ==========================================
 */

function submitExport() {

    const form = document.createElement('form');

    form.method = 'post';

    form.action =
        "<?php echo base_url('index.php/Accounts/export_outstanding_report_details'); ?>";


    form.innerHTML = `

        <input type="hidden"
               name="from"
               value="<?php echo isset($from) ? htmlspecialchars($from) : ''; ?>">

        <input type="hidden"
               name="to"
               value="<?php echo isset($to) ? htmlspecialchars($to) : ''; ?>">

        <input type="hidden"
               name="ledger_id"
               value="<?php echo isset($ledger_id) ? htmlspecialchars($ledger_id) : ''; ?>">

        <input type="hidden"
               name="request_type"
               value="<?php echo isset($request_type) ? htmlspecialchars($request_type) : ''; ?>">

    `;


    document.body.appendChild(form);

    form.submit();

    document.body.removeChild(form);

}

</script>