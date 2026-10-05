<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>

<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex items-center justify-between mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                <?= htmlspecialchars($title) ?>
            </h2>

            <p class="text-gray-500 mt-1">
                Manage insurance expiry and premium payment reminders.
            </p>
        </div>

        <a href="<?= base_url('index.php/insurancereminder/add') ?>"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

            + Add Reminder

        </a>

    </div>

    <?php if ($this->session->flashdata('success')) : ?>

        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">

            <?= $this->session->flashdata('success'); ?>

        </div>

    <?php endif; ?>

    <div class="overflow-x-auto">

        <table id="reminderTable"
               class="min-w-full border border-gray-200">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-4 py-3 text-left">
                        #
                    </th>

                    <th class="px-4 py-3 text-left">
                        Policy Number
                    </th>

                    <th class="px-4 py-3 text-left">
                        Reminder Type
                    </th>

                    <th class="px-4 py-3 text-left">
                        Due Date
                    </th>

                    <th class="px-4 py-3 text-left">
                        Reminder Days Before
                    </th>

                    <th class="px-4 py-3 text-left">
                        Status
                    </th>

                    <th class="px-4 py-3 text-left">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($reminders)) : ?>

                    <?php $i = 1; ?>

                    <?php foreach ($reminders as $row) : ?>

                        <tr class="border-t">

                            <td class="px-4 py-3">
                                <?= $i++; ?>
                            </td>

                            <td class="px-4 py-3 font-medium">
                                <?= htmlspecialchars(
                                    $row->policy_number ?? '-'
                                ) ?>
                            </td>

                            <td class="px-4 py-3">
                                <?= htmlspecialchars(
                                    $row->reminder_type ?? '-'
                                ) ?>
                            </td>

                            <td class="px-4 py-3">
                                <?= !empty($row->due_date)
                                    ? date(
                                        'd-m-Y',
                                        strtotime($row->due_date)
                                    )
                                    : '-'; ?>
                            </td>

                            <td class="px-4 py-3">
                                <?= isset($row->reminder_days_before)
                                    ? htmlspecialchars(
                                        $row->reminder_days_before
                                    )
                                    : '-'; ?>
                            </td>

                            <td class="px-4 py-3">

                                <?php

                                $statusClass =
                                    'bg-gray-100 text-gray-700';

                                if ($row->status == 'Pending') {

                                    $statusClass =
                                        'bg-yellow-100 text-yellow-700';

                                } elseif ($row->status == 'Sent') {

                                    $statusClass =
                                        'bg-blue-100 text-blue-700';

                                } elseif ($row->status == 'Completed') {

                                    $statusClass =
                                        'bg-green-100 text-green-700';

                                } elseif ($row->status == 'Overdue') {

                                    $statusClass =
                                        'bg-red-100 text-red-700';

                                } elseif ($row->status == 'Dismissed') {

                                    $statusClass =
                                        'bg-gray-200 text-gray-700';
                                }

                                ?>

                                <span class="px-2 py-1 rounded text-xs font-medium <?= $statusClass ?>">

                                    <?= htmlspecialchars(
                                        $row->status ?? '-'
                                    ) ?>

                                </span>

                            </td>

                            <td class="p-3">

                                <div class="flex justify-center gap-2">

                                    <a href="<?= base_url( 'index.php/insurancereminder/view/' . $row->reminder_id ); ?>"
                                    class="p-2 bg-blue-100 text-blue-700 rounded
                                        hover:bg-blue-200"
                                    title="View">

                                        👁️

                                    </a>

                                    <?php if ($row->status != 'Completed') : ?>

                                    <a href="<?= base_url( 'index.php/insurancereminder/edit/' . $row->reminder_id ); ?>"
                                    class="p-2 bg-yellow-100 text-yellow-700 rounded
                                        hover:bg-yellow-200"
                                    title="Edit">

                                        ✏️

                                    </a>

                                    <?php endif; ?>

                                    <a href="<?= base_url( 'index.php/insurancereminder/complete/' . $row->reminder_id ); ?>" 
                                    onclick="return confirm( 
                                    'Are you sure you want to mark this renewal as completed?' );" 
                                    class="p-2 bg-green-100 text-green-700 rounded hover:bg-green-200" title="Complete"> 
                                        ✅ 
                                    </a>

                                    <a href="<?= base_url( 'index.php/insurancereminder/delete/' . $row->reminder_id ); ?>"
                                    onclick="return confirm(
                                        'Are you sure you want to delete this Reminder?'
                                    );"
                                    class="p-2 bg-red-100 text-red-700 rounded
                                        hover:bg-red-200"
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

</div>

<script>

$(document).ready(function () {

    $('#reminderTable').DataTable({

        pageLength: 10,

        order: [[5, 'asc']]

    });

});

</script>