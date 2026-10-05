<div class="w-full  mx-auto bg-white p-6 rounded-2xl shadow-md">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        Edit Inspection Item
    </h2>

    <form method="post" class="space-y-5">

        <div>
            <label class="block text-sm font-semibold mb-1">
                Inspection Item
            </label>
            <input type="text" name="item_name" required
                   value="<?= html_escape($item->item_name); ?>"
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">
                Category
            </label>
                <select name="category" id="category" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 select2">
                    <option value="__new__">+ Add new category</option>
                <option value="">Select category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= html_escape($category->category); ?>"
                        <?= ($item->category ?? '') === $category->category ? 'selected' : ''; ?>>
                        <?= html_escape($category->category); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="new_category" id="newCategory" required disabled
                   placeholder="Enter new category"
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 mt-2 hidden">
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">
                Status
            </label>
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1"
                       <?= (int) $item->is_active === 1 ? 'checked' : ''; ?>
                       class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                <span>Active</span>
            </label>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('index.php/inspection_master'); ?>"
               class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                Cancel
            </a>

            <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Update
            </button>
        </div>

    </form>
</div>
<script>
$('#category').select2({
    width: '100%',
    placeholder: 'Select category'
});

function toggleNewCategory() {
    const isNewCategory = $('#category').val() === '__new__';
    const newCategory = document.getElementById('newCategory');
    newCategory.disabled = !isNewCategory;
    newCategory.classList.toggle('hidden', !isNewCategory);
    newCategory.required = isNewCategory;

    if (isNewCategory) {
        newCategory.focus();
    } else {
        newCategory.value = '';
    }
}

$('#category').on('change', toggleNewCategory);
toggleNewCategory();
</script>
