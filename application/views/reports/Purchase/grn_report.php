<?php 
$user = $this->session->userdata('user_id');
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<style>
	.select2-container {
    width: 100% !important;
}

.select2-dropdown {
    width: 420px !important;
}

.select2-results__option {
    white-space: nowrap;
}

.select2-selection__rendered {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Reports/get_grn_report" autocomplete="off" enctype="multipart/form-data">

    <!-- page content -->
    <div class="w-full bg-white" role="main">

        <!-- Title -->
        <div class="mb-4 border-b pb-3">
            <h1 class="text-xl font-semibold text-gray-800">GRN Reports</h1>
            <p class="text-sm text-gray-500">Goods Receipt Note report list and filters</p>
        </div>


        <!-- Filters -->
        <div class="bg-white shadow rounded-lg p-4 mb-4">

            <div class="flex flex-wrap items-end gap-4">

                <!-- Date From -->
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium whitespace-nowrap">Date From:</label>
                    <input type="date"
                        name="from_date"
                        class="border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400"
                        value="<?php echo $from; ?>"/>
                </div>


                <!-- Date To -->
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium whitespace-nowrap">Date To:</label>
                    <input type="date"
                        name="to_date"
                        class="border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400"
                        value="<?php echo $to; ?>"/>
                </div>


                <!-- Supplier -->
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium whitespace-nowrap">Supplier:</label>

                    <select name="supplier_id"
                        id="supplier_id"
                        class="border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400  select2 debtor-select"
                        tabindex="2">

                        <option value="">-select-</option>

                        <?php foreach($supplier_records as $g) { ?>
                            <option <?php if($supplier_id==$g->supplier_id) echo 'selected'; ?>
                                value="<?php echo $g->supplier_id;?>">
                                <?php echo $g->supplier_code.' '.$g->supplier_name; ?>
                            </option>
                        <?php } ?>

                    </select>
                </div>



                <!-- Buttons -->
                <div class="flex items-center gap-3">

                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                        Go
                    </button>


                    <a href="javascript:void(0)"
                        onclick="printgrnReport()"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow flex items-center gap-2">

                        <i class="fa fa-print"></i>
                        Print

</a>

<button type="button"
    onclick="exportGRNExcel()"
    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded shadow flex items-center gap-2">

    <i class="fa fa-file-excel"></i>
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

                        <th class="border px-3 py-2 text-left text-sm font-semibold">
                            Sr. No
                        </th>

                        <th class="border px-3 py-2 text-left text-sm font-semibold">
                            GRN Code
                        </th>

                        <th class="border px-3 py-2 text-left text-sm font-semibold">
                            GRN Date
                        </th>

                        <th class="border px-3 py-2 text-left text-sm font-semibold">
                            Supplier
                        </th>

                        <th class="border px-3 py-2 text-left text-sm font-semibold">
                            Grand Total
                        </th>

                        <th class="border px-3 py-2 text-left text-sm font-semibold">
                            Created By
                        </th>

                    </tr>
                </thead>



                <tbody>

                    <?php $i=1; foreach($records as $row) :?>

                    <tr class="hover:bg-gray-50">

                        <td class="border px-3 py-2">
                            <?php echo  $i; $i++;?>
                        </td>


                        <td class="border px-3 py-2">

                            <a target="_blank"
                               href="<?php echo base_url().'index.php/Purchase/print_grn/'.$row->grn_id.'/1';?>"
                               style="margin-right:10px;"
                               class="text-blue-600 hover:underline">

                               <?php echo $row->grn_code; ?>

                            </a>

                        </td>


                        <td class="border px-3 py-2">
                            <?php echo date('d-M-Y',strtotime($row->grn_date)); ?>
                        </td>


                        <td class="border px-3 py-2">
                            <?php echo $row->supplier_name; ?>
                        </td>


                        <td class="border px-3 py-2">
                            <?php echo $row->grand_total; ?>
                        </td>


                        <td class="border px-3 py-2">
                            <?php echo $row->grn_created_by; ?>
                        </td>


                    </tr>

                    <?php endforeach; ?>

                </tbody>



               

            </table>

        </div>


    </div>

</form>



<script>

function printgrnReport() {

    const fromDate = document.querySelector('input[name="from_date"]').value;
    const toDate = document.querySelector('input[name="to_date"]').value;
    const supplierId = document.querySelector('select[name="supplier_id"]').value;

    const baseUrl = "<?php echo base_url().'index.php/Reports/print_grn_report'; ?>";

    const params = new URLSearchParams({
        from_date: fromDate,
        to_date: toDate,
        supplier_id: supplierId
    });

    const printUrl = `${baseUrl}?${params.toString()}`;

    window.open(printUrl, '_blank');

}
$(document).ready(function() {
		$('.debtor-select').select2({
			width: '100%'
		});


	});

</script>
<script>

function escapeCSV(value) {
    return '"' + String(value ?? '')
        .replace(/"/g, '""')
        .trim() + '"';
}


function exportGRNExcel() {

    const table = document.getElementById('basic-btn');

    if (!table) {
        return;
    }

    const csvRows = [];


    /* =========================================
       REPORT TITLE
       ========================================= */

    csvRows.push([
        escapeCSV('GRN Reports')
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

    const supplierSelect =
        document.getElementById('supplier_id');

    let supplierName = '';

    if (supplierSelect && supplierSelect.value) {

        supplierName =
            supplierSelect.options[
                supplierSelect.selectedIndex
            ].text.trim();
    }

    if (supplierName) {

        csvRows.push([
            escapeCSV('Supplier: ' + supplierName)
        ].join(','));
    }


    /* Empty row */
    csvRows.push('');


    /* =========================================
       TABLE HEADER
       ========================================= */

    csvRows.push([
        escapeCSV('Sr. No'),
        escapeCSV('GRN Code'),
        escapeCSV('GRN Date'),
        escapeCSV('Supplier'),
        escapeCSV('Grand Total'),
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

        if (cells.length < 6) {
            return;
        }

        const serialNo =
            cells[0].innerText.trim();

        const grnCode =
            cells[1].innerText.trim();

        const grnDate =
            cells[2].innerText.trim();

        const supplier =
            cells[3].innerText.trim();

        const grandTotal =
            cells[4].innerText.trim();

        const createdBy =
            cells[5].innerText.trim();


        csvRows.push([
            escapeCSV(serialNo),
            escapeCSV(grnCode),

            /* Preserve date in Excel */
            escapeCSV('="' + grnDate + '"'),

            escapeCSV(supplier),
            escapeCSV(grandTotal),
            escapeCSV(createdBy)

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
        [csvContent],
        {
            type: 'text/csv;charset=utf-8;'
        }
    );

    const link =
        document.createElement('a');

    const url =
        URL.createObjectURL(blob);

    link.href = url;

    link.download =
        'grn_report_' +
        new Date().toISOString().slice(0, 10) +
        '.csv';

    document.body.appendChild(link);

    link.click();

    document.body.removeChild(link);

    URL.revokeObjectURL(url);
}

</script>