<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$this->load->helper('form');
?>

<div class="bg-white shadow-md rounded-lg p-6">

    <!-- Main Filter Form -->
    <form
        class="space-y-5"
        action="<?php echo base_url('index.php/Accounts/balance_sheet_bsg'); ?>"
        id="balance_sheet_form"
        method="post"
    >

        <!-- Date Filters -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

            <!-- From Date -->
            <div class="md:col-span-2">
                <label for="from_date" class="block text-sm font-medium text-gray-700 mb-1">
                    From <span class="text-red-500">*</span>
                </label>

                <div class="relative">
                    <input
                        type="text"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        id="from_date"
                        name="from_date"
                        value="<?php echo date('d-M-Y', strtotime($from_date)); ?>"
                        required
                        tabindex="1"
                    >

                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fa fa-calendar text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- To Date -->
            <div class="md:col-span-2">
                <label for="to_date" class="block text-sm font-medium text-gray-700 mb-1">
                    To <span class="text-red-500">*</span>
                </label>

                <div class="relative">
                    <input
                        type="text"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        id="to_date"
                        name="to_date"
                        value="<?php echo date('d-M-Y', strtotime($to_date)); ?>"
                        required
                        tabindex="2"
                    >

                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fa fa-calendar text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Group -->
            <div class="md:col-span-3">
                <label for="group_no" class="block text-sm font-medium text-gray-700 mb-1">
                    Group <span class="text-red-500">*</span>
                </label>

                <select
                    name="group_no"
                    id="group_no"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
                    <option value="">Select Group</option>

                    <?php if (!empty($groups)): ?>

                        <?php foreach ($groups as $group): ?>

                            <option
                                value="<?= htmlspecialchars($group->group_no); ?>"
                                <?= (isset($group_no) && $group_no == $group->group_no) ? 'selected' : ''; ?>
                            >
                                <?= htmlspecialchars($group->group_name); ?>
                            </option>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <option value="">No group found</option>

                    <?php endif; ?>

                </select>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap items-center gap-2 pt-2">

            <button
                type="submit"
                name="action"
                value="view"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow-sm transition"
            >
                <i class="fa fa-search mr-2"></i>
                View
            </button>

            <button
                type="button"
                onclick="submitExportForm()"
                class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium px-4 py-2 rounded-md shadow-sm transition"
            >
                <i class="fa fa-file-excel-o mr-2"></i>
                Export to Excel
            </button>

            <button
                type="button"
                onclick="submitPrintForm()"
                class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow-sm transition"
            >
                <i class="fa fa-print mr-2"></i>
                Print
            </button>

        </div>

    </form>


    <!-- Hidden Export Form -->
    <form
        method="post"
        action="<?php echo base_url('index.php/Accounts/balance_sheet_export'); ?>"
        id="export_form"
    >
        <input
            type="hidden"
            name="from_date"
            id="export_from_date"
        >

        <input
            type="hidden"
            name="to_date"
            id="export_to_date"
        >

        <input
            type="hidden"
            name="group_no"
            id="export_group_no"
        >
    </form>


    <!-- Hidden Print Form -->
    <form
        method="post"
        action="<?php echo base_url('index.php/Accounts/balance_sheet_print'); ?>"
        id="print_form"
        target="_blank"
    >
        <input
            type="hidden"
            name="from_date"
            id="print_from_date"
        >

        <input
            type="hidden"
            name="to_date"
            id="print_to_date"
        >

        <input
            type="hidden"
            name="group_no"
            id="print_group_no"
        >
    </form>


    <!-- Balance Sheet Table -->
    <div class="mt-8">

        <div class="flex items-center justify-between mb-3">

            <div>
                <h3 class="text-lg font-semibold text-gray-800">
                    Balance Sheet
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    <?php echo date('d M Y', strtotime($from_date)); ?>
                    -
                    <?php echo date('d M Y', strtotime($to_date)); ?>
                </p>
            </div>

        </div>


        <div class="overflow-x-auto border border-gray-200 rounded-lg">

            <table class="min-w-full text-sm">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="border-b border-gray-300 px-3 py-3 text-left font-semibold text-gray-700">
                            Group
                        </th>

                        <th class="border-b border-gray-300 px-3 py-3 text-left font-semibold text-gray-700">
                            Ledger
                        </th>

                        <th class="border-b border-gray-300 px-3 py-3 text-right font-semibold text-gray-700 whitespace-nowrap">
                            Opening Balance
                        </th>

                        <th class="border-b border-gray-300 px-3 py-3 text-right font-semibold text-gray-700">
                            Debit
                        </th>

                        <th class="border-b border-gray-300 px-3 py-3 text-right font-semibold text-gray-700">
                            Credit
                        </th>

                        <th class="border-b border-gray-300 px-3 py-3 text-right font-semibold text-gray-700 whitespace-nowrap">
                            Closing Balance
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($balances)) : ?>

                        <?php
                        $prev_group = '';
                        ?>

                        <?php foreach ($balances as $row): ?>

                            <?php if ($prev_group !== $row->group_name): ?>

                                <tr class="bg-blue-50">

                                    <td
                                        colspan="6"
                                        class="border-b border-gray-200 px-3 py-2.5 font-semibold text-blue-800"
                                    >
                                        <?php echo htmlspecialchars($row->group_name); ?>
                                    </td>

                                </tr>

                                <?php
                                $prev_group = $row->group_name;
                                ?>

                            <?php endif; ?>


                            <tr class="hover:bg-gray-50 transition">

                                <!-- Group -->
                                <td class="border-b border-gray-200 px-3 py-2.5">
                                </td>

                                <!-- Ledger -->
                                <td class="border-b border-gray-200 px-3 py-2.5 text-gray-800">
                                    <?php echo htmlspecialchars($row->account_name); ?>
                                </td>

                                <!-- Opening -->
                                <td class="border-b border-gray-200 px-3 py-2.5 text-right font-mono whitespace-nowrap">
                                    <?php echo number_format($row->opening_balance, 2); ?>
                                </td>

                                <!-- Debit -->
                                <td class="border-b border-gray-200 px-3 py-2.5 text-right font-mono whitespace-nowrap">
                                    <?php echo number_format($row->debit, 2); ?>
                                </td>

                                <!-- Credit -->
                                <td class="border-b border-gray-200 px-3 py-2.5 text-right font-mono whitespace-nowrap">
                                    <?php echo number_format($row->credit, 2); ?>
                                </td>

                                <!-- Closing -->
                                <td class="border-b border-gray-200 px-3 py-2.5 text-right font-mono font-semibold whitespace-nowrap">
                                    <?php echo number_format($row->closing_balance, 2); ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="6"
                                class="px-3 py-8 text-center text-gray-500"
                            >
                                <div class="flex flex-col items-center">

                                    <i class="fa fa-info-circle text-gray-400 text-2xl mb-2"></i>

                                    <span>
                                        No data available for selected criteria.
                                    </span>

                                </div>
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- jQuery UI Datepicker -->
<link
    rel="stylesheet"
    href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"
>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>


<script>

$(document).ready(function () {

    /*
     * Datepicker
     */
    $("#from_date, #to_date").datepicker({

        dateFormat: 'dd-M-yy',

        changeMonth: true,

        changeYear: true

    });


    /*
     * Select2
     *
     * Only initialize if Select2 is loaded.
     */
    if ($.fn.select2) {

        $('#group_no').select2({

            width: '100%',

            placeholder: 'Select Group',

            allowClear: true

        });

    }

});


/*
 * Copy current filter values to Export form
 */
function submitExportForm() {

    var fromDate = $('#from_date').val();
    var toDate   = $('#to_date').val();
    var groupNo  = $('#group_no').val();

    if (!fromDate || !toDate || !groupNo) {

        alert('Please select From date, To date and Group.');

        return false;

    }

    $('#export_from_date').val(fromDate);
    $('#export_to_date').val(toDate);
    $('#export_group_no').val(groupNo);

    $('#export_form').submit();

}


/*
 * Copy current filter values to Print form
 */
function submitPrintForm() {

    var fromDate = $('#from_date').val();
    var toDate   = $('#to_date').val();
    var groupNo  = $('#group_no').val();

    if (!fromDate || !toDate || !groupNo) {

        alert('Please select From date, To date and Group.');

        return false;

    }

    $('#print_from_date').val(fromDate);
    $('#print_to_date').val(toDate);
    $('#print_group_no').val(groupNo);

    $('#print_form').submit();

}

</script>