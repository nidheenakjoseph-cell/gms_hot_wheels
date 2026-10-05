<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<div class="bg-white min-h-screen p-5">

    <!-- PAGE HEADER -->
    <div class="flex items-center justify-between mb-4">

        <h2 class="text-2xl font-semibold text-gray-800">
            Monthly Salary List
        </h2>

        <a href="<?php echo base_url('index.php/Hr/add_monthly_salary'); ?>"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow font-medium">
            + Add Monthly Salary
        </a>

    </div>


    <!-- FILTER CARD -->
    <div class="bg-white shadow-md rounded-2xl p-5 mb-5">

        <div class="flex flex-wrap items-end gap-4">

            <!-- MONTH FILTER -->
            <form id="main"
                method="post"
                action="<?php echo base_url() . 'index.php/Hr/view_emp_monthly_salary'; ?>"
                autocomplete="off"
                enctype="multipart/form-data">

                <div class="flex flex-wrap items-end gap-4">

                    <div>

                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Month Date
                        </label>

                        <div class="flex">

                            <input type="month"
                                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                name="from"
                                value="<?php echo !empty($from) ? date('Y-m', strtotime($from)) : ''; ?>">

                        </div>

                    </div>


                    <div>

                        <input type="submit"
                            value="Go"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow text-sm cursor-pointer">

                    </div>

                </div>

            </form>


            <!-- PRINT / EXPORT -->
            <div class="ml-auto flex gap-3">

                <!-- PRINT MONTHLY RECORD -->
                <form target="_blank"
                    action="<?php echo base_url() . 'index.php/Hr/print_monthly_record/'; ?>"
                    method="post">

                    <input type="hidden"
                        name="from"
                        value="<?php echo $from; ?>">

                    <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow text-sm">
                        Print
                    </button>

                </form>


                <!-- EXPORT EXCEL -->
                <form action="<?php echo base_url() . 'index.php/Hr/export_monthly_record/'; ?>"
                    method="post">

                    <input type="hidden"
                        name="from"
                        value="<?php echo $from; ?>">

                    <button type="submit"
                        class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg shadow text-sm">
                        Export Excel
                    </button>

                </form>

            </div>

        </div>

    </div>


    <!-- TABLE CARD -->
    <div class="bg-white border border-gray-300 rounded-lg overflow-hidden">

        <div class="overflow-x-auto">

            <table id="datatable"
                class="min-w-full text-sm border border-gray-300">

                <thead class="bg-gray-100 text-gray-700">

                    <tr>

                        <th class="px-4 py-3 border">
                            Sr No
                        </th>

                        <th class="px-4 py-3 border">
                            Employee Name
                        </th>

                        <th class="px-4 py-3 border">
                            Salary Month
                        </th>

                        <th class="px-4 py-3 border text-right">
                            Working Days
                        </th>

                        <th class="px-4 py-3 border text-right">
                            Leave
                        </th>

                        <th class="px-4 py-3 border text-right">
                            Present
                        </th>

                        <th class="px-4 py-3 border text-right">
                            Paid Leave
                        </th>

                        <th class="px-4 py-3 border text-right">
                            Payment Days
                        </th>

                        <th class="px-4 py-3 border text-right">
                            Basic
                        </th>

                        <th class="px-4 py-3 border text-right">
                            Allowance
                        </th>

                        <th class="px-4 py-3 border text-right">
                            Deduction
                        </th>

                        <th class="px-4 py-3 border text-right">
                            Gross
                        </th>

                        <th class="px-4 py-3 border text-right">
                            Advance
                        </th>

                        <th class="px-4 py-3 border text-right">
                            Net
                        </th>

                        <th class="px-4 py-3 border">
                            Remarks
                        </th>

                        <th class="px-4 py-3 border text-center">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php

                    $i = 1;

                    foreach ($records as $row) {

                    ?>

                        <tr class="hover:bg-gray-50">

                            <!-- SR NO -->
                            <td class="px-4 py-3 border">
                                <?php echo $i; ?>
                            </td>


                            <!-- EMPLOYEE NAME -->
                            <td class="px-4 py-3 border font-medium">
                                <?php echo $row->employee_name; ?>
                            </td>


                            <!-- SALARY MONTH -->
                            <td class="px-4 py-3 border">

                                <?php
                                echo date(
                                    'M-Y',
                                    strtotime($row->salary_month)
                                );
                                ?>

                            </td>


                            <!-- WORKING DAYS -->
                            <td class="px-4 py-3 border text-right">
                                <?php echo $row->working_days; ?>
                            </td>


                            <!-- LEAVE -->
                            <td class="px-4 py-3 border text-right">
                                <?php echo $row->leave_days; ?>
                            </td>


                            <!-- PRESENT -->
                            <td class="px-4 py-3 border text-right">
                                <?php echo $row->present_days; ?>
                            </td>


                            <!-- PAID LEAVE -->
                            <td class="px-4 py-3 border text-right">
                                <?php echo $row->paid_leave; ?>
                            </td>


                            <!-- PAYMENT DAYS -->
                            <td class="px-4 py-3 border text-right">
                                <?php echo $row->payment_days; ?>
                            </td>


                            <!-- BASIC -->
                            <td class="px-4 py-3 border text-right">

                                <?php
                                echo number_format(
                                    $row->basic_salary,
                                    2
                                );
                                ?>

                            </td>


                            <!-- ALLOWANCE -->
                            <td class="px-4 py-3 border text-right">

                                <?php
                                echo number_format(
                                    $row->total_allowance,
                                    2
                                );
                                ?>

                            </td>


                            <!-- DEDUCTION -->
                            <td class="px-4 py-3 border text-right">

                                <?php
                                echo number_format(
                                    $row->total_deduction,
                                    2
                                );
                                ?>

                            </td>


                            <!-- GROSS -->
                            <td class="px-4 py-3 border text-right font-medium">

                                <?php
                                echo number_format(
                                    $row->gross_salary,
                                    2
                                );
                                ?>

                            </td>


                            <!-- ADVANCE -->
                            <td class="px-4 py-3 border text-right">

                                <?php
                                echo number_format(
                                    $row->salary_advance_taken,
                                    2
                                );
                                ?>

                            </td>


                            <!-- NET -->
                            <td class="px-4 py-3 border text-right font-semibold">

                                <?php
                                echo number_format(
                                    $row->net_salary,
                                    2
                                );
                                ?>

                            </td>


                            <!-- REMARKS -->
                            <td class="px-4 py-3 border">

                                <?php echo $row->remark; ?>

                            </td>


                            <!-- ACTION -->
                            <td class="px-4 py-3 border text-center whitespace-nowrap">

                                <!-- PRINT PAYSLIP -->
                                <a href="<?php echo base_url() . 'index.php/Hr/print_monthly_payslip/' . $row->sid; ?>"
                                    target="_blank"
                                    title="Print Payslip"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">

                                    Print Payslip

                                </a>


                                <!-- DELETE -->
                                <button type="button"
                                    onclick="confirmcancel(<?php echo $row->sid; ?>)"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs ml-2">

                                    Delete

                                </button>

                            </td>

                        </tr>

                    <?php

                        $i++;

                    }

                    ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<script>

    /*
     * DELETE MONTHLY SALARY
     */
    function confirmcancel(sid) {

        var r = confirm(
            "Are you sure you want to Delete Record?"
        );

        if (r == true) {

            $.ajax({

                url: "<?php echo base_url(); ?>index.php/Hr/delete_emp_monthly_salary_record",

                type: "POST",

                data: {
                    sid: sid
                },

                success: function(msg) {

                    /*
                     * Successful deletion
                     */
                    if (msg == 1) {

                        alert("Record deleted");

                        location.reload();

                    } else {

                        alert(
                            "Can't Delete record. Data already exist!!!"
                        );

                    }

                },

                error: function() {

                    alert(
                        "Something went wrong while deleting the record."
                    );

                }

            });

        }

        return false;

    }


    /*
     * DATATABLE
     */
    $(document).ready(function() {

        $('#datatable').DataTable({

            pageLength: 10,

            ordering: true,

            searching: true,

            lengthMenu: [
                10,
                25,
                50,
                100
            ],

            /*
             * Action column is column number 15
             *
             * 0  = Sr No
             * 1  = Employee Name
             * 2  = Salary Month
             * 3  = Working Days
             * 4  = Leave
             * 5  = Present
             * 6  = Paid Leave
             * 7  = Payment Days
             * 8  = Basic
             * 9  = Allowance
             * 10 = Deduction
             * 11 = Gross
             * 12 = Advance
             * 13 = Net
             * 14 = Remarks
             * 15 = Action
             */

            columnDefs: [

                {
                    orderable: false,
                    targets: [15]
                }

            ]

        });

    });

</script>