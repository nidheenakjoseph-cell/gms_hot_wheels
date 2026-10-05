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

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Scrap Categories</h2>

        <a href="<?= base_url('index.php/scrap_category/add') ?>"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            + Add Category
        </a>
    </div>

    <div class="overflow-x-auto">
        <table id="categoryTable" class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th class="text-right" style="display: none;">Default Rate</th>
                    <th>Status</th>
                    <th class="text-right">Collected</th>
                    <th class="text-right">Sold</th>
                    <th class="text-right">Balance</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; foreach ($categories as $category): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td>
                        <details class="group bg-white rounded-lg p-3 border border-gray-200">
                            <summary class="flex items-center justify-between cursor-pointer list-none">
                                <span class="font-semibold text-gray-800"><?= html_escape($category->category_name) ?></span>
                                <span class="text-sm text-blue-600 transition-transform duration-150 group-open:rotate-180">▼</span>
                            </summary>
                            <div class="mt-3 text-sm text-gray-600">
                                <?= nl2br(html_escape($category->description ?: 'No description available')) ?>
                            </div>
                        </details>
                    </td>
                    <td><?= html_escape($category->unit) ?></td>
                    <td class="text-right" style="display: none;"><?= number_format($category->default_rate, 2) ?></td>
                    <td>
                        <?= $category->is_active == 1
                            ? '<span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Active</span>'
                            : '<span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">Inactive</span>' ?>
                    </td>
                    <td class="text-right"><?= number_format($category->collected_qty, 2) ?></td>
                    <td class="text-right"><?= number_format($category->sold_qty, 2) ?></td>
                    <td class="text-right"><?= number_format($category->balance_qty, 2) ?></td>
                    <td class="text-center">
                        <div class="flex justify-center gap-2">
                            <a href="<?= base_url('index.php/scrap_category/edit/' . $category->id) ?>"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                               Edit
                            </a>
                            <a href="<?= base_url('index.php/scrap_category/delete/' . $category->id) ?>"
                               onclick="return confirm('Delete this category?')"
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
    $('#categoryTable').DataTable({
        pageLength: 10,
        responsive: true,
        autoWidth: false,
        language: {
            search: "🔍 Search Categories:",
            lengthMenu: "Show _MENU_ categories",
            info: "Showing _START_ to _END_ of _TOTAL_ categories",
            paginate: {
                previous: "←",
                next: "→"
            }
        }
    });
});
</script>
