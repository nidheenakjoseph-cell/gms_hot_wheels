<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>

<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex justify-between items-center mb-4">

        <h2 class="text-2xl font-bold">
            <?= htmlspecialchars($title) ?>
        </h2>

        <a href="<?= base_url('index.php/insurancepolicy/add_policy'); ?>"
           class="px-4 py-2 bg-green-600 text-white rounded">
            + Add Policy
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

    <table id="policyTable" class="w-full border rounded">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">SL No</th>
                <th class="p-3 text-left">Policy Number</th>
                <th class="p-3 text-left">Insured Vehicle</th>
                <th class="p-3 text-left">Customer / Insured</th>
                <th class="p-3 text-left">Policy Status</th>
                <th class="p-3 text-center">Actions</th>
            </tr>
        </thead>

        <tbody>

            <?php $sl = 1; ?>

            <?php if (!empty($policies)) : ?>

                <?php foreach ($policies as $policy) : ?>

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3">
                            <?= $sl++; ?>
                        </td>

                        <td class="p-3 font-medium">
                            <?= htmlspecialchars($policy->policy_number); ?>
                        </td>

                        <td class="p-3">
                            <?= htmlspecialchars($policy->brand . ' - ' . $policy->registration_no) ?>
                        </td>

                        <td class="p-3">
                            <?= htmlspecialchars($policy->name ?? '-'); ?>
                        </td>

                        <td class="p-3">

                            <?php
                            $status = $policy->policy_status ?? 'Draft';

                            switch ($status) {

                                case 'Active':
                                    $status_class = 'text-green-700 bg-green-100';
                                    break;

                                case 'Draft':
                                    $status_class = 'text-gray-700 bg-gray-100';
                                    break;

                                case 'Suspended':
                                    $status_class = 'text-yellow-700 bg-yellow-100';
                                    break;

                                case 'Expired':
                                    $status_class = 'text-red-700 bg-red-100';
                                    break;

                                case 'Cancelled':
                                    $status_class = 'text-red-700 bg-red-100';
                                    break;

                                default:
                                    $status_class = 'text-gray-700 bg-gray-100';
                                    break;
                            }
                            ?>

                            <span class="inline-flex items-center
                                        px-3 py-1 text-xs font-semibold
                                        rounded-full <?= $status_class ?>">

                                <?= htmlspecialchars($status); ?>

                            </span>

                        </td>

                        <td class="p-3">

                            <div class="flex justify-center gap-2">

                                <a href="<?= base_url(
                                    'index.php/insurancepolicy/view_policy/'
                                    . $policy->policy_id
                                ); ?>"
                                class="p-2 bg-blue-100 text-blue-700 rounded"
                                title="View">
                                    👁️
                                </a>

                                <a href="<?= base_url(
                                    'index.php/insurancepolicy/edit_policy/'
                                    . $policy->policy_id
                                ); ?>"
                                class="p-2 bg-yellow-100 text-yellow-700 rounded"
                                title="Edit">
                                    ✏️
                                </a>

                                <a href="<?= base_url(
                                    'index.php/insurancepolicy/delete_policy/'
                                    . $policy->policy_id
                                ); ?>"
                                onclick="return confirm(
                                    'Are you sure you want to delete this policy?'
                                );"
                                class="p-2 bg-red-100 text-red-700 rounded"
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

    $('#policyTable').DataTable({

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

            searchPlaceholder: "Search Policies..."

        }

    });

});

</script>

<style>

#policyTable_wrapper .dataTables_filter {
    text-align: right !important;
}

#policyTable_wrapper .dataTables_length label {
    font-size: 0.875rem;
}

#policyTable_wrapper .dataTables_paginate {
    margin-top: 10px;
}

#policyTable tbody td {
    font-size: 0.875rem !important;
}

</style>