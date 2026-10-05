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

        <a href="<?= base_url('index.php/insuranceclaim/add_claim'); ?>"
           class="px-4 py-2 bg-green-600 text-white rounded">

            + Add Claim

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

    <table id="claimTable"
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
                    Insured Vehicle
                </th>

                <th class="p-3 text-right">
                    Claim Amount
                </th>

                <th class="p-3 text-left">
                    Claim Status
                </th>

                <th class="p-3 text-center">
                    Actions
                </th>

            </tr>

        </thead>

        <tbody>

            <?php $sl = 1; ?>

            <?php if (!empty($claims)) : ?>

                <?php foreach ($claims as $claim) : ?>

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3">
                            <?= $sl++; ?>
                        </td>

                        <td class="p-3 font-medium">

                            <?= htmlspecialchars(
                                $claim->claim_number ?? '-'
                            ); ?>

                        </td>

                        <td class="p-3">

                            <?= htmlspecialchars(
                                $claim->policy_number ?? '-'
                            ); ?>

                        </td>

                        <td class="p-3">

                            <?= htmlspecialchars(
                                $claim->customer_name ?? '-'
                            ); ?>

                        </td>

                        <td class="p-3">

                            <?php if (!empty($claim->vehicle_brand) || !empty($claim->vehicle_registration_no)) : ?>

                                <?= htmlspecialchars($claim->vehicle_brand ?? '') ?>

                                <?php if (!empty($claim->vehicle_brand) && !empty($claim->vehicle_registration_no)) : ?>
                                    -
                                <?php endif; ?>

                                <?= htmlspecialchars($claim->vehicle_registration_no ?? '') ?>

                            <?php else : ?>

                                -

                            <?php endif; ?>

                        </td>

                        <td class="p-3 text-right">

                            <?= number_format(
                                (float)($claim->claim_amount ?? 0),
                                2
                            ); ?>

                        </td>

                        <td class="p-3">

                            <?php

                            $status =
                                $claim->claim_status
                                ?? 'Submitted';

                            switch ($status) {

                                case 'Submitted':

                                    $status_class =
                                        'text-blue-700 bg-blue-100';

                                    break;

                                case 'Under Review':

                                    $status_class =
                                        'text-yellow-700 bg-yellow-100';

                                    break;

                                case 'Documents Required':

                                    $status_class =
                                        'text-orange-700 bg-orange-100';

                                    break;

                                case 'Under Assessment':

                                    $status_class =
                                        'text-purple-700 bg-purple-100';

                                    break;

                                case 'Approved':

                                    $status_class =
                                        'text-green-700 bg-green-100';

                                    break;

                                case 'Partially Approved':

                                    $status_class =
                                        'text-yellow-700 bg-yellow-100';

                                    break;

                                case 'Rejected':

                                    $status_class =
                                        'text-red-700 bg-red-100';

                                    break;

                                case 'Settled':

                                    $status_class =
                                        'text-green-700 bg-green-100';

                                    break;

                                case 'Closed':

                                    $status_class =
                                        'text-gray-700 bg-gray-100';

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
                                    'index.php/insuranceclaim/view_claim/'
                                    . $claim->claim_id
                                ); ?>"
                                   class="p-2 bg-blue-100
                                          text-blue-700 rounded"
                                   title="View">

                                    👁️

                                </a>

                                <a href="<?= base_url(
                                    'index.php/insuranceclaim/edit_claim/'
                                    . $claim->claim_id
                                ); ?>"
                                   class="p-2 bg-yellow-100
                                          text-yellow-700 rounded"
                                   title="Edit">

                                    ✏️

                                </a>

                                <a href="<?= base_url(
                                    'index.php/insuranceclaim/delete_claim/'
                                    . $claim->claim_id
                                ); ?>"
                                   onclick="return confirm(
                                       'Are you sure you want to delete this claim?'
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

    $('#claimTable').DataTable({

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

            searchPlaceholder: "Search Claims..."

        }

    });

});


</script>



<style>

#claimTable_wrapper .dataTables_filter {

    text-align: right !important;

}


#claimTable_wrapper .dataTables_length label {

    font-size: 0.875rem;

}


#claimTable_wrapper .dataTables_paginate {

    margin-top: 10px;

}


#claimTable tbody td {

    font-size: 0.875rem !important;

}

</style>

