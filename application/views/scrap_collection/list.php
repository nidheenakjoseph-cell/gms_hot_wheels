<?php
$page_name = $this->uri->segment(1) . '/' . $this->uri->segment(2);
$user = $this->session->userdata('user_id');
?>

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables Tailwind -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>

<div class="w-full mx-auto bg-white shadow-md rounded-2xl p-6 mt-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <div>
            <h2 class="text-xl font-semibold">Scrap Collection</h2>
        </div>

        <div class="flex items-center gap-4">
            <!-- <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Branch Filter</label>
                <?php $branches = get_user_allowed_branches(); ?>
                <select id="branchFilter" name="branch_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option value="" <?= empty($selected_branch_id) ? 'selected' : '' ?>>All Branches</option>
                    <?php foreach ($branches as $b): ?>
                        <option value="<?= $b->branch_id ?>" <?= isset($selected_branch_id) && $selected_branch_id == $b->branch_id ? 'selected' : '' ?>><?= html_escape($b->branch_name . ($b->is_main_branch ? ' (Main Branch)' : '')) ?></option>
                    <?php endforeach; ?>
                </select>
            </div> -->
            <a href="<?= base_url('index.php/scrap_collection/add') ?>"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                + Add Collection
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table id="collectionTable" class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th>#</th>
                    <th>Collection Date</th>
                    <th>Branch</th>
                    <th>Category</th>
                    <th>Source</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Cost</th>
                    <th>Remarks</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; foreach ($collections as $collection): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= date('Y-m-d', strtotime($collection->collection_date)) ?></td>
                    <td><?= html_escape($collection->branch_name ?: 'N/A') ?></td>
                    <td><?= html_escape($collection->category_name) ?></td>
                    <td><?= isset($collection->source) && $collection->source != "" ? html_escape($collection->source) : 'N/A' ?></td>
                    
                    <td class="text-right"><?= number_format($collection->quantity, 2) ?> <?= html_escape($collection->unit) ?></td>
                    <td class="text-right"><?= number_format($collection->purchase_cost, 2) ?></td>
                    <td><?= html_escape($collection->remarks) ?></td>
                    <td class="text-center">
                        <div class="flex justify-center gap-2">
                            <a href="<?= base_url('index.php/scrap_collection/edit/' . $collection->id) ?>"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                               Edit
                            </a>
                            <a href="<?= base_url('index.php/scrap_collection/delete/' . $collection->id) ?>"
                               onclick="return confirm('Delete this collection entry?')"
                               class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                               Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#collectionTable').DataTable({
        pageLength: 10,
        responsive: true,
        autoWidth: false,
        language: {
            search: "🔍 Search Collections:",
            lengthMenu: "Show _MENU_ collections",
            info: "Showing _START_ to _END_ of _TOTAL_ collections",
            paginate: {
                previous: "←",
                next: "→"
            }
        }
    });
});
</script>
