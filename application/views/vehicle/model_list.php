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
            <h2 class="text-2xl font-bold">Vehicle Model Master</h2>
            <button type="button"
                    onclick="openModelModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold">
                + Add Model
            </button>
        </div>

        <!-- Search & Filter Section -->
        <!-- <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Search & Filter</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                 -->
                <!-- Brand Filter -->
                <!-- <div> -->
                    <!-- <label class="block text-xs font-semibold text-gray-600 mb-1">Brand</label>
                    <select id="filterBrand"
                            onchange="applyFilters()"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- All Brands --</option>
                        <?php foreach($brands as $b): ?>
                            <option value="<?= $b->brand_id ?>"><?= $b->brand_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> -->

                <!-- Model Name Filter -->
                <!-- <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Model Name</label>
                    <input type="text" id="filterModel"
                           onkeyup="applyFilters()"
                           placeholder="Search model..."
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div> -->

                <!-- Year Filter -->
                <!-- <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Year</label>
                    <input type="text" id="filterYear"
                           onkeyup="applyFilters()"
                           placeholder="Search year..."
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div> -->

                <!-- Reset Button -->
                <!-- <div class="flex items-end">
                    <button type="button"
                            onclick="resetFilters()"
                            class="w-full bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm font-semibold">
                        Reset
                    </button>
                </div>

            </div>
        </div> -->

        <!-- Model Table -->
        <div class="overflow-x-auto">
            <table id="modelTable" class="w-full border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-left">#</th>
                        <th class="border px-4 py-3 text-left">Brand</th>
                        <th class="border px-4 py-3 text-left">Model</th>
                        <th class="border px-4 py-3 text-left">Year</th>
                        <th class="border px-4 py-3 text-center">Image</th>
                        <th class="border px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="modelTableBody">
                    <?php $i=1; foreach($models as $m): ?>
                    <tr class="hover:bg-gray-50 model-row" 
                        data-brand="<?= $m->brand_id ?>" 
                        data-model="<?= strtolower($m->model_name) ?>" 
                        data-year="<?= isset($m->model_year) ? strtolower($m->model_year) : '' ?>">
                        <td class="border px-4 py-3"><?= $i++; ?></td>
                        <td class="border px-4 py-3"><?= $m->brand_name ?></td>
                        <td class="border px-4 py-3 font-medium"><?= $m->model_name ?></td>
                        <td class="border px-4 py-3"><?= isset($m->model_year) ? $m->model_year : '-' ?></td>
                        <td class="border px-4 py-3 text-center">
                            <?php if (!empty($m->model_image)): ?>
                                <img src="<?= base_url($m->model_image) ?>"
                                     alt="<?= htmlspecialchars($m->model_name, ENT_QUOTES) ?>"
                                     class="w-16 h-16 object-cover rounded border cursor-pointer hover:opacity-75 transition"
                                     onclick="viewImage(this.src)">
                            <?php else: ?>
                                <span class="text-gray-400 text-xs">No image</span>
                            <?php endif; ?>
                        </td>
                        <td class="border px-4 py-3 text-center">
                            <button type="button"
                                    onclick="editModel(<?= htmlspecialchars(json_encode($m), ENT_QUOTES) ?>)"
                                    class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded text-xs font-semibold transition">
                                    Edit
                            </button>
                            <a href="<?= base_url('index.php/Vehicle/delete_model/'.$m->model_id); ?>"
                               onclick="return confirm('Delete this model?')"
                               class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded text-xs font-semibold transition inline-block ml-2">
                               Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- No Results Message -->
            <!-- <div id="noResults" class="hidden p-8 text-center text-gray-500">
                <p class="text-lg">No models found matching your filters.</p>
            </div> -->
        </div>

    </div>
</div>

<!-- MODEL MODAL -->
<div id="modelModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 flex items-center justify-between rounded-t-2xl">
            <h3 class="text-xl font-bold" id="modalTitle">Add New Model</h3>
            <button type="button"
                    onclick="closeModelModal()"
                    class="text-xl font-bold hover:text-gray-200">
                ✕
            </button>
        </div>

        <!-- Modal Body -->
        <form id="modelForm"
              method="post"
              action="<?= base_url('index.php/Vehicle/save_model'); ?>"
              enctype="multipart/form-data"
              class="p-6">
            
            <input type="hidden" name="model_id" id="model_id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                
                <!-- Brand -->
                <div>
                    <label class="block text-sm font-semibold mb-2">Brand <span class="text-red-500">*</span></label>
                    <select name="brand_id" id="brand_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <option value="">-- Select Brand --</option>
                        <?php foreach($brands as $b): ?>
                            <option value="<?= $b->brand_id ?>"><?= $b->brand_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Model Name -->
                <div>
                    <label class="block text-sm font-semibold mb-2">Model Name <span class="text-red-500">*</span></label>
                    <input type="text" name="model_name" id="model_name" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                           placeholder="e.g., Corolla">
                </div>

                <!-- Model Year -->
                <div>
                    <label class="block text-sm font-semibold mb-2">Model Year</label>
                    <input type="text" name="model_year" id="model_year"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                           placeholder="e.g., 2024">
                </div>

                <!-- Model Image -->
                <div>
                    <label class="block text-sm font-semibold mb-2">Model Image</label>
                    <input type="file" name="model_image" id="model_image"
                           accept="image/*"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <p class="text-xs text-gray-500 mt-1">Supported: JPG, PNG, GIF, WebP (Max 5MB)</p>
                </div>

            </div>

            <!-- Image Preview -->
            <div id="imagePreviewContainer" class="mb-4 hidden">
                <label class="block text-sm font-semibold mb-2">Image Preview</label>
                <img id="imagePreview" src="" alt="Preview" class="w-full max-w-xs h-auto rounded border">
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-300">
                <button type="button"
                        onclick="closeModelModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50">
                    Cancel
                </button>
              <button type="submit" id="saveModelBtn" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold">
    Save Model
</button>
            </div>

        </form>
    </div>
</div>

<!-- IMAGE PREVIEW MODAL -->
<div id="imageViewModal" class="fixed inset-0 z-40 hidden bg-black bg-opacity-70 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl max-h-[80vh] overflow-auto">
        <button type="button"
                onclick="closeImageView()"
                class="sticky top-2 right-2 float-right text-xl font-bold text-gray-700 hover:text-black">
            ✕
        </button>
        <img id="viewImage" src="" alt="Vehicle Model" class="w-full rounded-2xl">
    </div>
</div>

<script>
    const brandOptions = <?= json_encode($brands) ?>;

    function openModelModal() {
        document.getElementById('modalTitle').textContent = 'Add New Model';
        document.getElementById('modelForm').reset();
        document.getElementById('model_id').value = '';
        document.getElementById('imagePreviewContainer').classList.add('hidden');
        document.getElementById('modelModal').classList.remove('hidden');
    }

    function closeModelModal() {
        document.getElementById('modelModal').classList.add('hidden');
        document.getElementById('modelForm').reset();
    }

    function editModel(model) {
        document.getElementById('modalTitle').textContent = 'Edit Model';
        document.getElementById('model_id').value = model.model_id;
        document.getElementById('brand_id').value = model.brand_id;
        document.getElementById('model_name').value = model.model_name;
        document.getElementById('model_year').value = model.model_year || '';

        if (model.model_image) {
            document.getElementById('imagePreview').src = '<?= base_url() ?>' + model.model_image;
            document.getElementById('imagePreviewContainer').classList.remove('hidden');
        } else {
            document.getElementById('imagePreviewContainer').classList.add('hidden');
        }

        document.getElementById('modelModal').classList.remove('hidden');
    }

    function viewImage(src) {
        document.getElementById('viewImage').src = src;
        document.getElementById('imageViewModal').classList.remove('hidden');
    }

    function closeImageView() {
        document.getElementById('imageViewModal').classList.add('hidden');
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModelModal();
            closeImageView();
        }
    });

    // Image preview on selection
    document.getElementById('model_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('imagePreview').src = event.target.result;
                document.getElementById('imagePreviewContainer').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Close modals when clicking outside
    document.getElementById('modelModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModelModal();
        }
    });

    document.getElementById('imageViewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageView();
        }
    });

    // ===== FILTER FUNCTIONS =====
    // function applyFilters() {
    //     const filterBrand = document.getElementById('filterBrand').value;
    //     const filterModel = document.getElementById('filterModel').value.toLowerCase();
    //     const filterYear = document.getElementById('filterYear').value.toLowerCase();
        
    //     const rows = document.querySelectorAll('.model-row');
    //     let visibleCount = 0;

    //     rows.forEach(row => {
    //         let show = true;

    //         // Filter by Brand
    //         if (filterBrand && row.getAttribute('data-brand') !== filterBrand) {
    //             show = false;
    //         }

    //         // Filter by Model Name
    //         if (show && filterModel && !row.getAttribute('data-model').includes(filterModel)) {
    //             show = false;
    //         }

    //         // Filter by Year
    //         if (show && filterYear && !row.getAttribute('data-year').includes(filterYear)) {
    //             show = false;
    //         }

    //         row.style.display = show ? '' : 'none';
    //         if (show) visibleCount++;
    //     });

    //     // Show "No Results" message if no rows are visible
    //     const noResults = document.getElementById('noResults');
    //     if (visibleCount === 0) {
    //         noResults.classList.remove('hidden');
    //     } else {
    //         noResults.classList.add('hidden');
    //     }
    // }

    // function resetFilters() {
    //     document.getElementById('filterBrand').value = '';
    //     document.getElementById('filterModel').value = '';
    //     document.getElementById('filterYear').value = '';
    //     applyFilters();
    // }
    $(document).ready(function () {

    $('#modelTable').DataTable({

        pageLength: 10,

        responsive: true,

        autoWidth: false,

        language: {
            search: "Search Models:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ models",
            paginate: {
                previous: "←",
                next: "→"
            }
        }

    });

});
$('#modelForm').on('submit', function () {

    var btn = $('#saveModelBtn');

    // Prevent double click
    btn.prop('disabled', true);

    // Change button text
    btn.html('Saving...');

    // Optional: change button appearance
    btn.removeClass('bg-blue-600 hover:bg-blue-700')
       .addClass('bg-gray-400 cursor-not-allowed');

       

});
</script>

