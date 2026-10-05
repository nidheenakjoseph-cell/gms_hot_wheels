<?php $this->load->helper('hr_helper'); ?>
<style>

/* =========================================================
   MONTHLY SALARY TABLE
========================================================= */

#datatable {
    width: 100% !important;
    border-collapse: collapse !important;
    table-layout: fixed !important;
}

#datatable th,
#datatable td {
    border: 1px solid #ddd !important;
    padding: 6px 8px !important;
    box-sizing: border-box !important;
    vertical-align: middle !important;
}

#datatable th {
    font-size: 13px;
    background-color: #f2f2f2;
    white-space: normal !important;
    line-height: 1.3;
    text-align: left;
}

#datatable td {
    font-size: 12px;
    white-space: nowrap;
    text-align: left;
}

/* =========================================================
   EMPLOYEE NAME
========================================================= */

#datatable th:nth-child(4),
#datatable td:nth-child(4) {
    width: 220px !important;
    min-width: 220px !important;
    max-width: 220px !important;
}

#datatable td:nth-child(4) {
    white-space: normal !important;
    word-break: break-word !important;
    overflow-wrap: anywhere !important;
    line-height: 1.4;
}

.employee-name-cell {
    width: 220px !important;
    min-width: 220px !important;
    max-width: 220px !important;
}

.employee-name {
    width: 100%;
    white-space: normal !important;
    overflow-wrap: anywhere !important;
    word-break: break-word !important;
    line-height: 1.4;
}

/* =========================================================
   INPUTS
========================================================= */

#datatable input[type="text"],
#datatable input[type="number"] {
    box-sizing: border-box !important;
    padding: 6px !important;
    font-size: 12px !important;
    max-width: 100%;
}

#datatable input[type="number"] {
    width: 100px;
}

#datatable .small-input {
    width: 70px !important;
}

#datatable .medium-input {
    width: 90px !important;
}

#datatable .readonly-input {
    background-color: #f3f4f6;
}

#datatable textarea {
    width: 180px;
    padding: 6px;
    font-size: 12px;
    height: 28px;
    resize: vertical;
    box-sizing: border-box;
}

/* =========================================================
   DATATABLE CONTAINER
========================================================= */

.dataTables_wrapper {
    width: 100% !important;
}

.dataTables_scroll {
    width: 100% !important;
}

.dataTables_scrollHead {
    overflow: hidden !important;
}

.dataTables_scrollBody {
    overflow-x: auto !important;
    overflow-y: auto !important;
}

/*
 * IMPORTANT:
 * Do NOT force widths on DataTables cloned tables.
 */

.dataTables_scrollHeadInner {
    width: auto !important;
}

.dataTables_scrollHead table,
.dataTables_scrollBody table {
    border-collapse: collapse !important;
}

/* =========================================================
   EXTRA DETAILS
========================================================= */

.extra-detail {
    font-size: 11px;
    line-height: 1.4;
}

.extra-detail a {
    color: #2563eb;
    text-decoration: none;
}

.extra-detail a:hover {
    text-decoration: underline;
}

/* =========================================================
   ACCOUNT TABLE
========================================================= */

.account-table {
    width: 100%;
    border-collapse: collapse;
}

.account-table th,
.account-table td {
    border: 1px solid #d1d5db;
    padding: 8px;
}
/* =========================================================
   SELECT2 - ACCOUNT DROPDOWNS
========================================================= */

.account-select2 {
    width: 100% !important;
}

.select2-container {
    width: 100% !important;
}

.select2-container--default .select2-selection--single {
    height: 34px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    padding: 2px 8px !important;
    background-color: #fff !important;
}

.select2-container--default
.select2-selection--single
.select2-selection__rendered {
    line-height: 28px !important;
    font-size: 13px !important;
    color: #374151 !important;
}

.select2-container--default
.select2-selection--single
.select2-selection__arrow {
    height: 32px !important;
}

.select2-dropdown {
    border: 1px solid #d1d5db !important;
}

.select2-container--default
.select2-search--dropdown
.select2-search__field {
    border: 1px solid #d1d5db !important;
    border-radius: 4px !important;
    padding: 5px !important;
}

.select2-results__option {
    font-size: 13px !important;
    padding: 7px 10px !important;
}
</style>

<div class="bg-white shadow rounded-lg p-4">

    <!-- =========================================================
         PAGE HEADER
    ========================================================== -->

    <div class="flex justify-between items-center mb-4">

        <h2 class="text-xl font-semibold text-gray-800">
            Add Monthly Salary
        </h2>

        <a href="<?php echo base_url('index.php/Hr/view_emp_monthly_salary_list'); ?>"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm shadow">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />

            </svg>

            List Basic Salary

        </a>

    </div>


    <!-- =========================================================
         FORM 1 - SELECT MONTH
    ========================================================== -->

    <form id="monthForm"
        method="post"
        action="<?php echo base_url('index.php/Hr/add_monthly_salary_data'); ?>"
        autocomplete="off"
        enctype="multipart/form-data">

        <div class="flex flex-wrap items-center gap-4 mb-5">

            <label class="font-medium text-sm">

                Select Month

                <span class="text-red-500">*</span>

            </label>

            <div class="w-full md:w-48">

                <input type="month"
                    id="effective_date_select"
                    name="effective_date"
                    value="<?php echo date('Y-m', strtotime($effective_date)); ?>"
                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring focus:ring-blue-200">

            </div>

            <div>

                <input type="submit"
                    id="view"
                    name="go"
                    value="Go"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-1 rounded shadow">

            </div>

        </div>

    </form>


    <!-- =========================================================
         FORM 2 - MONTHLY SALARY
    ========================================================== -->

    <form id="salaryForm"
        method="post"
        action="<?php echo base_url('index.php/Hr/add_emp_monthly_salary'); ?>"
        autocomplete="off"
        enctype="multipart/form-data">

        <input type="hidden"
            id="effective_date_hidden"
            name="effective_date_hidden"
            value="<?php echo date('M-Y', strtotime($effective_date)); ?>">


        <!-- =====================================================
             EMPLOYEE TABLE
        ====================================================== -->

        <div class="w-full">

    <table id="datatable"
        class="border border-gray-200 text-sm text-left">

                <thead class="bg-gray-100 text-gray-700">

                    <tr>

                        <th>Sr No</th>

                        <th>
                            <input type="checkbox"
                                id="header-checkbox">
                        </th>

                        <th>Employee Code</th>

                        <th>Employee Name</th>

                        <th>Department</th>

                        <th>Visa Status</th>

                        <th>Basic Salary</th>

                        <th>
                            Working Days<br>
                            (Month)
                        </th>

                        <th>Total Leave</th>

                        <th>
                            Allowed<br>
                            Paid Leave
                        </th>

                        <th>
                            Used Paid<br>
                            Leave
                        </th>

                        <th>Present Days</th>

                        <th>
                            Company<br>
                            Holiday
                        </th>

                        <th>Payment Days</th>

                        <th>Comp Off Days</th>

                        <th>
                            Total Overtime<br>
                            (Hours)
                        </th>

                        <th>
                            Overtime<br>
                            Amount
                        </th>

                        <th>Sales Incentive</th>

                        <th>Monthly Allowances</th>

                        <th>Extra Allowances</th>

                        <th>Gross Pay</th>

                        <th>Monthly Deduction</th>

                        <th>Extra Deduction</th>

                        <th>Advance Taken</th>

                        <th>Net Pay</th>

                        <th>Remarks</th>

                    </tr>

                </thead>


                <tbody class="text-gray-700">

                    <?php if (!empty($records)): ?>

                        <?php

                        $i = 1;

                        foreach ($records as $row):

                            /*
                             * =================================================
                             * EXTRA ALLOWANCES
                             * =================================================
                             */

                            $extra_allowance_total = 0;

                            $extra_allowance =
                                get_extra_alowance(
                                    $row->employee_id,
                                    $start_date,
                                    $end_date
                                );

                            ?>


                            <tr>

                                <!-- =================================================
                                     SR NO
                                ================================================== -->

                                <td>
                                    <?php echo $i; ?>
                                </td>


                                <!-- =================================================
                                     CHECKBOX
                                ================================================== -->

                                <td class="text-center">

                                    <input type="checkbox"
                                        id="checkbox<?php echo $i; ?>"
                                        name="checkbox[]"
                                        class="checkbox"
                                        value="<?php echo $row->employee_id; ?>">

                                </td>


                                <!-- =================================================
                                     EMPLOYEE CODE
                                ================================================== -->

                                <td>
                                    <?php echo $row->employee_code; ?>
                                </td>


                                <!-- =================================================
                                     EMPLOYEE NAME
                                ================================================== -->

                               <td class="employee-name-cell">

    <div class="employee-name">
        <?php echo htmlspecialchars($row->employee_name); ?>
    </div>

    <input type="hidden"
        id="nuser_id<?php echo $i; ?>"
        name="nuser_id[]"
        value="<?php echo $row->employee_id; ?>">

</td>


                                <!-- =================================================
                                     DEPARTMENT
                                ================================================== -->

                                <td>
                                    <?php echo $row->department_name; ?>
                                </td>


                                <!-- =================================================
                                     VISA STATUS
                                ================================================== -->

                                <td>
                                    <?php echo $row->posession; ?>
                                </td>


                                <!-- =================================================
                                     BASIC SALARY
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        name="basic_salary[]"
                                        id="basic_salary<?php echo $i; ?>"
                                        class="form-control form-control-sm readonly-input"
                                        value="<?php echo $row->basic_salary; ?>"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     WORKING DAYS
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        name="working_days[]"
                                        id="working_days<?php echo $i; ?>"
                                        class="form-control form-control-sm small-input readonly-input"
                                        value="<?php echo $days_in_month; ?>"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     TOTAL LEAVE
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        name="leave_days[]"
                                        id="leave_days<?php echo $i; ?>"
                                        class="form-control form-control-sm small-input readonly-input"
                                        value="<?php echo $row->absent_count; ?>"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     ALLOWED PAID LEAVE
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        name="paid_leave[]"
                                        id="paid_leave<?php echo $i; ?>"
                                        class="form-control form-control-sm small-input readonly-input"
                                        value="<?php echo $row->paid_days - $row->use_paid_leave; ?>"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     USED PAID LEAVE
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        name="usep_leave[]"
                                        id="usep_leave<?php echo $i; ?>"
                                        class="form-control form-control-sm small-input readonly-input"
                                        value="<?php echo $row->paid_leave_count; ?>"
                                        min="0"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     PRESENT DAYS
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="0.5"
                                        min="0"
                                        name="present_days[]"
                                        id="present_days<?php echo $i; ?>"
                                        class="form-control form-control-sm small-input readonly-input"
                                        value="<?php echo $row->present_count; ?>"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     COMPANY HOLIDAY
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        name="holiday_days[]"
                                        id="holiday_days<?php echo $i; ?>"
                                        class="form-control form-control-sm small-input readonly-input"
                                        value="<?php echo $holiday_count; ?>"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     PAYMENT DAYS
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="0.5"
                                        name="payment_days[]"
                                        id="payment_days<?php echo $i; ?>"
                                        class="form-control form-control-sm medium-input readonly-input"
                                        value="0"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     COMP OFF
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        name="comp_off[]"
                                        id="comp_off<?php echo $i; ?>"
                                        class="form-control form-control-sm medium-input readonly-input"
                                        value="<?php echo $row->compoff_count; ?>"
                                        readonly>

                                    <?php if ($row->compoff_count > 0): ?>

                                        <span class="text-red-500 text-xs">

                                            Comp Off:
                                            <?php echo $row->compoff_count; ?>

                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- =================================================
                                     TOTAL OVERTIME
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        min="0"
                                        name="t_overtime[]"
                                        id="t_overtime<?php echo $i; ?>"
                                        class="form-control form-control-sm medium-input"
                                        value="<?php echo isset($row->total_overtime) ? $row->total_overtime : 0; ?>"
                                        oninput="calculate_amount(<?php echo $i; ?>)">

                                </td>


                                <!-- =================================================
                                     OVERTIME AMOUNT
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        min="0"
                                        name="amt_overtime[]"
                                        id="amt_overtime<?php echo $i; ?>"
                                        class="form-control form-control-sm medium-input"
                                        value="<?php echo isset($row->ot) ? ($row->ot * $row->total_overtime) : 0; ?>"
                                        oninput="calculate_amount(<?php echo $i; ?>)">

                                </td>


                                <!-- =================================================
                                     SALES INCENTIVE
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        min="0"
                                        name="sales_incentive[]"
                                        id="sales_incentive<?php echo $i; ?>"
                                        class="form-control form-control-sm"
                                        value="<?php echo isset($row->sales_incentive) ? $row->sales_incentive : 0; ?>"
                                        oninput="calculate_amount(<?php echo $i; ?>)">

                                </td>


                                <!-- =================================================
                                     MONTHLY ALLOWANCES
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        name="total_allowances[]"
                                        id="total_allowances<?php echo $i; ?>"
                                        class="form-control form-control-sm readonly-input"
                                        value="<?php echo $row->total_allowances; ?>"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     EXTRA ALLOWANCES
                                ================================================== -->

                                <td>

                                    <div class="extra-detail">

                                        <?php

                                        foreach ($extra_allowance as $t):

                                            $extra_allowance_total +=
                                                (float) $t->approved_amount;

                                        ?>

                                            <a href="<?php
                                                        echo base_url(
                                                            'index.php/Hr/view_emp_request_edit/' .
                                                                $t->emp_req_id
                                                        );
                                                        ?>"
                                                title="View Allowance Details"
                                                target="_blank">

                                                <?php echo $t->allowance_name; ?>

                                                :
                                                <?php echo number_format(
                                                    $t->approved_amount,
                                                    2
                                                ); ?>

                                            </a>

                                            <br>

                                        <?php endforeach; ?>

                                    </div>


                                    <input type="hidden"
                                        name="extra_allowances[]"
                                        id="extra_allowances<?php echo $i; ?>"
                                        value="<?php echo $extra_allowance_total; ?>">

                                    <span class="text-xs text-gray-500">

                                        Total:
                                        <?php echo number_format(
                                            $extra_allowance_total,
                                            2
                                        ); ?>

                                    </span>

                                </td>


                                <!-- =================================================
                                     GROSS PAY
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        name="gross_salary[]"
                                        id="gross_salary<?php echo $i; ?>"
                                        class="form-control form-control-sm readonly-input"
                                        value="0"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     MONTHLY DEDUCTION
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        name="total_deduction[]"
                                        id="total_deduction<?php echo $i; ?>"
                                        class="form-control form-control-sm readonly-input"
                                        value="<?php echo $row->total_deductions; ?>"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     EXTRA DEDUCTIONS
                                ================================================== -->

                                <td>

                                    <?php

                                    $extra_deduction_total = 0;

                                    /*
                                     * Loan deduction
                                     */

                                    $extra_deduction =
                                        get_extra_deduction(
                                            $row->employee_id,
                                            $start_date,
                                            $end_date
                                        );

                                    ?>

                                    <div class="extra-detail">

                                        <?php foreach ($extra_deduction as $t): ?>

                                            <?php if ($t->emp_reqtype == 'loan'): ?>

                                                <a href="<?php
                                                            echo base_url(
                                                                'index.php/Hr/view_emp_request_edit/' .
                                                                    $t->emp_req_id
                                                            );
                                                            ?>"
                                                    title="View Deduction Details"
                                                    target="_blank">

                                                    Loan EMI:
                                                    <?php echo number_format(
                                                        $t->approve_emi,
                                                        2
                                                    ); ?>

                                                </a>

                                                <br>

                                                <?php

                                                $extra_deduction_total +=
                                                    (float) $t->approve_emi;

                                                ?>

                                            <?php endif; ?>

                                        <?php endforeach; ?>


                                        <?php

                                        /*
                                         * Advance salary deduction
                                         */

                                        $extra_deduction_salary =
                                            get_extra_deduction_salary(
                                                $row->employee_id,
                                                $start_date,
                                                $end_date
                                            );

                                        ?>


                                        <?php foreach ($extra_deduction_salary as $t): ?>

                                            <?php if ($t->emp_reqtype == 'advance_salary'): ?>

                                                <a href="<?php
                                                            echo base_url(
                                                                'index.php/Hr/view_emp_request_edit/' .
                                                                    $t->emp_req_id
                                                            );
                                                            ?>"
                                                    title="View Deduction Details"
                                                    target="_blank">

                                                    Advance Salary:
                                                    <?php echo number_format(
                                                        $t->approved_amount,
                                                        2
                                                    ); ?>

                                                </a>

                                                <br>

                                                <?php

                                                $extra_deduction_total +=
                                                    (float) $t->approved_amount;

                                                ?>

                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                    </div>


                                    <input type="hidden"
                                        name="extra_deduction[]"
                                        id="extra_deduction<?php echo $i; ?>"
                                        value="<?php echo $extra_deduction_total; ?>">

                                    <span class="text-xs text-gray-500">

                                        Total:
                                        <?php echo number_format(
                                            $extra_deduction_total,
                                            2
                                        ); ?>

                                    </span>

                                </td>


                                <!-- =================================================
                                     ADVANCE TAKEN
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        min="0"
                                        name="salary_advance[]"
                                        id="salary_advance<?php echo $i; ?>"
                                        class="form-control form-control-sm"
                                        value="<?php echo isset($row->advance_taken) ? $row->advance_taken : 0; ?>"
                                        oninput="calculate_amount(<?php echo $i; ?>)">

                                    <input type="hidden"
                                        name="advance_taken[]"
                                        value="<?php echo isset($row->advance_taken) ? $row->advance_taken : 0; ?>">

                                </td>


                                <!-- =================================================
                                     NET PAY
                                ================================================== -->

                                <td>

                                    <input type="number"
                                        step="any"
                                        name="net_pay[]"
                                        id="net_pay<?php echo $i; ?>"
                                        class="form-control form-control-sm readonly-input"
                                        value="0"
                                        readonly>

                                </td>


                                <!-- =================================================
                                     REMARK
                                ================================================== -->

                                <td>

                                    <textarea id="remark<?php echo $i; ?>"
                                        name="remark[]"
                                        rows="1"
                                        placeholder="Remark"></textarea>

                                </td>

                            </tr>


                        <?php

                            $i++;

                        endforeach;

                        ?>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>


        <!-- =========================================================
             ACCOUNT ENTRY
        ========================================================== -->

        <hr class="my-6 border-gray-300">


        <h6 class="bg-blue-50 text-blue-900 px-4 py-2 font-semibold border-l-4 border-blue-600 rounded shadow inline-block">

            Account Entry

        </h6>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">


            <!-- =====================================================
                 DEBIT
            ====================================================== -->

            <table class="account-table">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-blue-800">
                            Debit Entry (Dr)
                        </th>

                        <th class="text-blue-800">
                            Debit Amount (AED)
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td>

                           <select id="inv_debtor0"
    name="inv_debtor[]"
    class="account-select2"
    data-placeholder="Select Debit Account">

                                <option value="">
                                    Select
                                </option>

                                <?php foreach ($sundry_detors_records as $a): ?>

                                    <option value="<?php echo $a->account_id; ?>"
                                        <?php
                                        if ($a->account_id == 2947) {
                                            echo 'selected';
                                        }
                                        ?>>

                                        <?php echo $a->account_name; ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </td>


                        <td>

                            <input type="number"
                                step="any"
                                id="inv_dr_amount0"
                                name="inv_dr_amount[]"
                                readonly
                                class="w-full border border-gray-300 rounded px-2 py-1 bg-gray-100 text-sm">

                        </td>

                    </tr>

                </tbody>

            </table>


            <!-- =====================================================
                 CREDIT
            ====================================================== -->

            <table class="account-table">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-blue-800">
                            Credit Entry (Cr)
                        </th>

                        <th class="text-blue-800">
                            Credit Amount (AED)
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <!-- NET SALARY -->

                    <tr>

                        <td>

                           <select id="inv_creditor0"
    name="inv_creditor[]"
    class="account-select2"
    data-placeholder="Select Credit Account">
                                <option value="">
                                    Select
                                </option>

                                <?php foreach ($credit_records as $d): ?>

                                    <option value="<?php echo $d->account_id; ?>"
                                        <?php
                                        if ($d->account_id == 2946) {
                                            echo 'selected';
                                        }
                                        ?>>

                                        <?php echo $d->account_name; ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </td>


                        <td>

                            <input type="number"
                                step="any"
                                id="inv_cr_amount0"
                                name="inv_cr_amount[]"
                                readonly
                                class="w-full border border-gray-300 rounded px-2 py-1 bg-gray-100 text-sm">

                        </td>

                    </tr>


                    <!-- ADVANCE -->

                    <tr>

                        <td>

                           <select id="inv_creditor1"
    name="inv_creditor[]"
    class="account-select2"
    data-placeholder="Select Credit Account">
                                <option value="">
                                    Select
                                </option>

                                <?php foreach ($credit_records as $d): ?>

                                    <option value="<?php echo $d->account_id; ?>"
                                        <?php
                                        if ($d->account_id == 2952) {
                                            echo 'selected';
                                        }
                                        ?>>

                                        <?php echo $d->account_name; ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </td>


                        <td>

                            <input type="number"
                                step="any"
                                id="inv_cr_amount1"
                                name="inv_cr_amount[]"
                                readonly
                                class="w-full border border-gray-300 rounded px-2 py-1 bg-gray-100 text-sm">

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


        <!-- =========================================================
             HIDDEN VALUES + SUBMIT
        ========================================================== -->

        <div class="mt-6">

            <input type="hidden"
                name="empid"
                id="empid"
                value="<?php echo $user_id; ?>">


            <input type="hidden"
                name="effective_date"
                id="effective_date"
                value="<?php echo $effective_date; ?>">


            <button type="submit"
                id="add"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">

                Generate Monthly Salary

            </button>

        </div>

    </form>

</div>

<!-- =========================================================
     DATATABLE + SELECT2
========================================================== -->

<link rel="stylesheet"
    href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">


<!-- jQuery MUST load before Select2 -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Select2 MUST load after jQuery -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {

/* =========================================================
   INITIALIZE SELECT2 ACCOUNT DROPDOWNS
========================================================= */

$('.account-select2').select2({
    width: '100%',
    allowClear: true,
    placeholder: function () {
        return $(this).data('placeholder');
    }
});

    if ($.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
    }

    var salaryTable = $('#datatable').DataTable({

        scrollY: '400px',

        scrollX: true,

        scrollCollapse: false,

        paging: false,

        searching: true,

        ordering: false,

        autoWidth: false,

        fixedHeader: false,

        /*
         * IMPORTANT:
         * Explicit width for every column.
         *
         * There are exactly 26 columns.
         */

        columns: [

            { width: '60px' },    // 1  Sr No

            { width: '45px' },    // 2  Checkbox

            { width: '110px' },   // 3  Employee Code

            { width: '220px' },   // 4  Employee Name

            { width: '150px' },   // 5  Department

            { width: '100px' },   // 6  Visa Status

            { width: '110px' },   // 7  Basic Salary

            { width: '110px' },   // 8  Working Days

            { width: '90px' },    // 9  Total Leave

            { width: '110px' },   // 10 Allowed Paid Leave

            { width: '110px' },   // 11 Used Paid Leave

            { width: '100px' },   // 12 Present Days

            { width: '110px' },   // 13 Company Holiday

            { width: '100px' },   // 14 Payment Days

            { width: '100px' },   // 15 Comp Off Days

            { width: '120px' },   // 16 Total Overtime

            { width: '120px' },   // 17 Overtime Amount

            { width: '120px' },   // 18 Sales Incentive

            { width: '130px' },   // 19 Monthly Allowances

            { width: '180px' },   // 20 Extra Allowances

            { width: '110px' },   // 21 Gross Pay

            { width: '130px' },   // 22 Monthly Deduction

            { width: '180px' },   // 23 Extra Deduction

            { width: '110px' },   // 24 Advance Taken

            { width: '110px' },   // 25 Net Pay

            { width: '180px' }    // 26 Remarks

        ],

        columnDefs: [
            {
                targets: '_all',
                className: 'dt-left'
            }
        ],

        initComplete: function () {

            var api = this.api();

            setTimeout(function () {
                api.columns.adjust();
            }, 100);

        }

    });


    /*
     * Recalculate column widths when browser
     * window size changes.
     */

    $(window).on('resize', function () {

        setTimeout(function () {

            salaryTable
                .columns
                .adjust();

        }, 100);

    });


    /*
     * Header checkbox
     */

    $('#header-checkbox').on('change', function () {

        let checked = $(this).prop('checked');

        $('.checkbox').prop(
            'checked',
            checked
        );

        $('.checkbox').each(function () {

            let index = this.id.replace(
                'checkbox',
                ''
            );

            if (checked) {

                calculate_amount(index);

            } else {

                resetCalculation(index);

            }

        });

        updateTotal();

    });


    /*
     * Individual checkbox
     */

    $(document).on(
        'change',
        '.checkbox',
        function () {

            let index = this.id.replace(
                'checkbox',
                ''
            );

            if ($(this).is(':checked')) {

                calculate_amount(index);

            } else {

                resetCalculation(index);

            }

            let total =
                $('.checkbox').length;

            let checked =
                $('.checkbox:checked').length;

            $('#header-checkbox').prop(
                'checked',
                total > 0 &&
                total === checked
            );

            updateTotal();

        }
    );


    /*
     * Calculate values initially.
     */

    $('.checkbox').each(function () {

        let index = this.id.replace(
            'checkbox',
            ''
        );

        calculate_amount(index);

    });

    updateTotal();

});


/*
=========================================================
 GET NUMERIC VALUE
=========================================================
*/

function gv(id) {

    let element =
        document.getElementById(id);


    if (!element) {

        return 0;

    }


    let value =
        parseFloat(element.value);


    return isNaN(value)
        ? 0
        : value;

}


/*
=========================================================
 SET VALUE
=========================================================
*/

function setValue(id, value) {

    let element =
        document.getElementById(id);


    if (!element) {

        return;

    }


    element.value =
        parseFloat(value || 0).toFixed(2);

}


/*
=========================================================
 CALCULATE SALARY
=========================================================
*/

function calculate_amount(i) {

    /*
     * Basic values
     */

    let working_days =
        gv("working_days" + i);


    let present_days =
        gv("present_days" + i);


    let comp_off =
        gv("comp_off" + i);


    let holiday_days =
        gv("holiday_days" + i);


    let usep_leave =
        gv("usep_leave" + i);


    let basic_salary =
        gv("basic_salary" + i);


    /*
     * Overtime
     */

    let overtime_amount =
        gv("amt_overtime" + i);


    /*
     * Allowances
     */

    let total_allowances =
        gv("total_allowances" + i);


    let extra_allowances =
        gv("extra_allowances" + i);


    /*
     * Sales incentive
     */

    let sales_incentive =
        gv("sales_incentive" + i);


    /*
     * Deductions
     */

    let total_deduction =
        gv("total_deduction" + i);


    let extra_deduction =
        gv("extra_deduction" + i);


    /*
     * Advance recovery
     */

    let salary_advance =
        gv("salary_advance" + i);


    /*
     =====================================================
     PAYMENT DAYS
     =====================================================
     */

    let payment_days =
        present_days
        + usep_leave
        + holiday_days
        + comp_off;


    /*
     * Payment days cannot exceed
     * working days.
     */

    if (
        working_days > 0 &&
        payment_days > working_days
    ) {

        payment_days =
            working_days;

    }


    setValue(
        "payment_days" + i,
        payment_days
    );


    /*
     =====================================================
     ZERO WORKING DAYS
     =====================================================
     */

    if (working_days <= 0) {

        setValue(
            "earn_salary" + i,
            0
        );

        setValue(
            "gross_salary" + i,
            0
        );

        setValue(
            "net_pay" + i,
            0
        );

        updateTotal();

        return;

    }


    /*
     =====================================================
     EARNED BASIC SALARY
     =====================================================
     */

    let per_day_salary =
        basic_salary /
        working_days;


    let earned_salary =
        per_day_salary *
        payment_days;


    /*
     =====================================================
     GROSS PAY
     =====================================================

     Earned Basic
     + Overtime
     + Monthly Allowance
     + Extra Allowance
     + Sales Incentive
     */

    let gross_salary =
        earned_salary
        + overtime_amount
        + total_allowances
        + extra_allowances
        + sales_incentive;


    /*
     =====================================================
     NET PAY
     =====================================================

     Gross
     - Monthly Deduction
     - Extra Deduction
     - Advance Recovery
     */

    let net_pay =
        gross_salary
        - total_deduction
        - extra_deduction
        - salary_advance;


    /*
     * Do not allow negative net salary.
     */

    if (net_pay < 0) {

        net_pay = 0;

    }


    /*
     =====================================================
     SET VALUES
     =====================================================
     */

    setValue(
        "earn_salary" + i,
        earned_salary
    );


    setValue(
        "gross_salary" + i,
        gross_salary
    );


    setValue(
        "net_pay" + i,
        net_pay
    );


    /*
     * Update accounting.
     */

    updateTotal();

}


/*
=========================================================
 RESET UNSELECTED EMPLOYEE
=========================================================
*/

function resetCalculation(i) {

    setValue(
        "payment_days" + i,
        0
    );


    setValue(
        "earn_salary" + i,
        0
    );


    setValue(
        "gross_salary" + i,
        0
    );


    setValue(
        "net_pay" + i,
        0
    );

}


/*
=========================================================
 UPDATE ACCOUNTING TOTALS
=========================================================
*/

function updateTotal() {

    let totalGross =
        0;


    let totalNet =
        0;


    let totalAdvance =
        0;


    /*
     * Determine selected employees.
     */

    let anyChecked =
        $('.checkbox:checked').length > 0;


    $('.checkbox').each(function () {

        let checkbox =
            this;


        let id =
            checkbox.id.replace(
                'checkbox',
                ''
            );


        /*
         * If employees are selected,
         * only selected employees count.
         */

        if (
            anyChecked &&
            !checkbox.checked
        ) {

            return;

        }


        /*
         * Gross
         */

        totalGross +=
            gv("gross_salary" + id);


        /*
         * Net
         */

        totalNet +=
            gv("net_pay" + id);


        /*
         * Advance
         */

        totalAdvance +=
            gv("salary_advance" + id);


    });


    /*
     * Salary payable is the balancing credit. Monthly and extra deductions
     * are already reflected in Net Pay, so do not add them twice. If total
     * deductions exceed Gross Pay, the row-level Net Pay is zero; using the
     * residual keeps the two sides balanced in that case as well.
     */

    let creditAdvance =
        Math.min(totalAdvance, totalGross);


    let creditSalaryPayable =
        totalGross - creditAdvance;


    /*
     =====================================================
     DEBIT
     =====================================================
     */

    $('#inv_dr_amount0').val(
        totalGross.toFixed(2)
    );


    /*
     =====================================================
     CREDIT - NET SALARY
     =====================================================
     */

    $('#inv_cr_amount0').val(
        creditSalaryPayable.toFixed(2)
    );


    /*
     =====================================================
     CREDIT - ADVANCE
     =====================================================
     */

    $('#inv_cr_amount1').val(
        creditAdvance.toFixed(2)
    );


    console.log(
        "Gross:",
        totalGross,
        "Net:",
        totalNet,
        "Advance:",
        totalAdvance
    );

}


/*
=========================================================
 VALIDATE PAID LEAVE
=========================================================
*/

function validateInput(
    absentCount,
    index
) {

    let inputField =
        document.getElementById(
            "usep_leave" + index
        );


    if (!inputField) {

        return;

    }


    let userValue =
        parseFloat(
            inputField.value
        ) || 0;


    if (
        userValue >
        absentCount
    ) {

        alert(
            "Please insert a value less than or equal to "
            + absentCount
        );


        inputField.value =
            0;


        calculate_amount(index);

    }

}


/*
=========================================================
 SEARCH TABLE
=========================================================
*/

function searchTable() {

    let input =
        document.getElementById(
            'searchInput'
        );


    if (!input) {

        return;

    }


    let filter =
        input.value.toLowerCase();


    let table =
        document.getElementById(
            'datatable'
        );


    let rows =
        table.getElementsByTagName(
            'tr'
        );


    for (
        let i = 1;
        i < rows.length;
        i++
    ) {

        let cells =
            rows[i].getElementsByTagName(
                'td'
            );


        let found =
            false;


        for (
            let j = 0;
            j < cells.length;
            j++
        ) {

            if (
                cells[j]
                    .innerText
                    .toLowerCase()
                    .indexOf(filter) > -1
            ) {

                found =
                    true;

                break;

            }

        }


        rows[i].style.display =
            found
                ? ''
                : 'none';

    }

}


/*
=========================================================
 FORM VALIDATION
=========================================================
*/

$('#salaryForm').on(
    'submit',
    function (e) {

        let selected =
            $('.checkbox:checked').length;


        if (selected === 0) {

            e.preventDefault();

            alert(
                'Please select at least one employee.'
            );

            return false;

        }


        /*
         * Recalculate selected employees
         * before submission.
         */

        $('.checkbox:checked').each(
            function () {

                let index =
                    this.id.replace(
                        'checkbox',
                        ''
                    );


                calculate_amount(index);

            }
        );


        updateTotal();

    }
);

</script>
