<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>

<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex justify-between items-center mb-4">

        <h2 class="text-2xl font-bold">
            <?= htmlspecialchars($title) ?>
        </h2>

        <a href="<?= base_url('index.php/insuranceclaimsettlement/add_settlement'); ?>"
           class="px-4 py-2 bg-green-600 text-white rounded">

            + Add Settlement

        </a>

    </div>

    <hr><br>

    <?php if ($this->session->flashdata('success')) : ?>

        <div class="p-3 mb-4 bg-green-100 text-green-700
                    border border-green-300 rounded">

            <?= $this->session->flashdata('success'); ?>

        </div>

    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>

        <div class="p-3 mb-4 bg-red-100 text-red-700
                    border border-red-300 rounded">

            <?= $this->session->flashdata('error'); ?>

        </div>

    <?php endif; ?>

    <table id="settlementTable"
           class="w-full border rounded">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3 text-left">
                    SL No
                </th>

                <th class="p-3 text-left">
                    Claim Number
                </th>

                <th class="p-3 text-left">
                    Policy Number
                </th>

                <th class="p-3 text-left">
                    Customer / Insured
                </th>

                <th class="p-3 text-left">
                    Settlement Date
                </th>

                <th class="p-3 text-left">
                    Status
                </th>

                <th class="p-3 text-center">
                    Actions
                </th>

            </tr>

        </thead>

        <tbody>

            <?php $sl = 1; ?>

            <?php if (!empty($settlements)) : ?>

                <?php foreach ($settlements as $settlement) : ?>

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3">
                            <?= $sl++; ?>
                        </td>

                        <td class="p-3">

                            <?= htmlspecialchars(
                                $settlement->claim_number ?? '-'
                            ); ?>

                        </td>

                        <td class="p-3">

                            <?= htmlspecialchars(
                                $settlement->policy_number ?? '-'
                            ); ?>

                        </td>

                        <td class="p-3">

                            <?= htmlspecialchars(
                                $settlement->name ?? '-'
                            ); ?>

                        </td>

                        <td class="p-3">

                            <?php if (!empty($settlement->settlement_date)) : ?>

                                <?= date(
                                    'd-m-Y',
                                    strtotime($settlement->settlement_date)
                                ); ?>

                            <?php else : ?>

                                -

                            <?php endif; ?>

                        </td>

                        <td class="p-3">

                            <?php

                            $status =
                                $settlement->settlement_status
                                ?? 'Pending';

                            switch ($status) {

                                case 'Pending':

                                    $status_class =
                                        'text-yellow-700 bg-yellow-100';

                                    break;


                                case 'Approved for Settlement':

                                    $status_class =
                                        'text-blue-700 bg-blue-100';

                                    break;


                                case 'Partially Settled':

                                    $status_class =
                                        'text-orange-700 bg-orange-100';

                                    break;


                                case 'Settled':

                                    $status_class =
                                        'text-green-700 bg-green-100';

                                    break;


                                case 'Cancelled':

                                    $status_class =
                                        'text-red-700 bg-red-100';

                                    break;


                                default:

                                    $status_class =
                                        'text-gray-700 bg-gray-100';

                                    break;
                            }

                            ?>

                            <span class="inline-flex items-center
                                         px-3 py-1 text-xs font-semibold
                                         rounded-full
                                         <?= $status_class ?>">

                                <?= htmlspecialchars($status); ?>

                            </span>

                        </td>

                        <td class="p-3">

                            <div class="flex justify-center gap-2">

                                <a href="<?= base_url(
                                    'index.php/insuranceclaimsettlement/view_settlement/'
                                    . $settlement->settlement_id
                                ); ?>"
                                   class="p-2 bg-blue-100
                                          text-blue-700 rounded"
                                   title="View">

                                    👁️

                                </a>

                                <a href="<?= base_url(
                                    'index.php/insuranceclaimsettlement/edit_settlement/'
                                    . $settlement->settlement_id
                                ); ?>"
                                   class="p-2 bg-yellow-100
                                          text-yellow-700 rounded"
                                   title="Edit">

                                    ✏️

                                </a>

                                <a href="<?= base_url(
                                    'index.php/insuranceclaimsettlement/delete_settlement/'
                                    . $settlement->settlement_id
                                ); ?>"
                                   onclick="return confirm(
                                       'Are you sure you want to delete this settlement?'
                                   );"
                                   class="p-2 bg-red-100
                                          text-red-700 rounded"
                                   title="Delete">

                                    🗑️

                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

        </tbody>

    </table>

</div>

<script>

$(document).ready(function() {

    $('#settlementTable').DataTable({

        pageLength: 5,

        lengthMenu: [
            [5, 10, 25, -1],
            [5, 10, 25, "All"]
        ],

        responsive: true,

        dom:
            "<'flex justify-between items-center mb-3'l<f>>" +
            "t" +
            "<'flex justify-between items-center mt-3'p>",

        language: {

            search: "",

            searchPlaceholder: "Search Settlements..."

        }

    });

});

</script>

<style>

#settlementTable_wrapper .dataTables_filter {
    text-align: right !important;
}

#settlementTable_wrapper .dataTables_length label {
    font-size: 0.875rem;
}

#settlementTable_wrapper .dataTables_paginate {
    margin-top: 10px;
}

#settlementTable tbody td {
    font-size: 0.875rem !important;
}

</style>