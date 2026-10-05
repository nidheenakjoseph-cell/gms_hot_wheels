<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<div class="p-6 bg-gray-100 min-h-screen">

    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="bg-white p-6 rounded-2xl shadow">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Vehicle Brand Master</h2>
            <button type="button"
                    onclick="openBrandModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold">
                + Add Brand
            </button>
        </div>

        <!-- Brand Table -->
        <div class="overflow-x-auto">
            <table id="brandTable" class="w-full border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-left">#</th>
                        <th class="border px-4 py-3 text-left">Brand Name</th>
                        <th class="border px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($brands as $b): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-3"><?= $i++; ?></td>
                        <td class="border px-4 py-3 font-medium"><?= htmlspecialchars($b->brand_name); ?></td>
                        <td class="border px-4 py-3 text-center">
                            <button type="button"
                                    onclick="editBrand(<?= htmlspecialchars(json_encode($b), ENT_QUOTES) ?>)"
                                    class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded text-xs font-semibold transition">
                                    Edit
                            </button>
                            <a href="<?= base_url('index.php/Vehicle/delete_brand/'.$b->brand_id); ?>"
                               onclick="return confirm('Delete this brand?')"
                               class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded text-xs font-semibold transition inline-block ml-2">
                               Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- BRAND MODAL -->
<div id="brandModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md max-h-[90vh] overflow-y-auto">

        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 flex items-center justify-between rounded-t-2xl">
            <h3 class="text-xl font-bold" id="brandModalTitle">Add New Brand</h3>
            <button type="button"
                    onclick="closeBrandModal()"
                    class="text-xl font-bold hover:text-gray-200">
                ✕
            </button>
        </div>

        <!-- Modal Body -->
        <form id="brandForm"
              method="post"
              action="<?= base_url('index.php/Vehicle/save_brand'); ?>"
              class="p-6">

            <input type="hidden" name="brand_id" id="brand_id">

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Brand Name <span class="text-red-500">*</span></label>
                <input type="text" name="brand_name" id="brand_name" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                       placeholder="e.g., Toyota">
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-300">
                <button type="button"
                        onclick="closeBrandModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit" id="saveBrandBtn"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold">
                    Save Brand
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    function openBrandModal() {
        document.getElementById('brandModalTitle').textContent = 'Add New Brand';
        document.getElementById('brandForm').reset();
        document.getElementById('brand_id').value = '';
        document.getElementById('brandModal').classList.remove('hidden');
    }

    function closeBrandModal() {
        document.getElementById('brandModal').classList.add('hidden');
        document.getElementById('brandForm').reset();
    }

    function editBrand(brand) {
        document.getElementById('brandModalTitle').textContent = 'Edit Brand';
        document.getElementById('brand_id').value = brand.brand_id;
        document.getElementById('brand_name').value = brand.brand_name;
        document.getElementById('brandModal').classList.remove('hidden');
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeBrandModal();
        }
    });

    // Close modal when clicking outside
    document.getElementById('brandModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeBrandModal();
        }
    });

    $(document).ready(function () {
        $('#brandTable').DataTable({
            pageLength: 10,
            responsive: true,
            autoWidth: false,
            language: {
                search: "Search Brands:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ brands",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });
    });

    $('#brandForm').on('submit', function () {
        var btn = $('#saveBrandBtn');
        btn.prop('disabled', true);
        btn.html('Saving...');
        btn.removeClass('bg-blue-600 hover:bg-blue-700')
           .addClass('bg-gray-400 cursor-not-allowed');
    });
</script>