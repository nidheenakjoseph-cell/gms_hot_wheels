<div class="w-full bg-white rounded-2xl shadow-md p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h2 class="text-2xl font-bold"><?= isset($collection->id) ? 'Edit Scrap Collection' : 'Add Scrap Collection' ?></h2>
        <a href="<?= base_url('index.php/scrap_collection') ?>" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium shadow-sm">
            ← List Collections
        </a>
    </div>

    <?php if (validation_errors()): ?>
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded">
            <?= validation_errors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('index.php/scrap_collection/save') ?>" method="post" autocomplete="off" class="space-y-6">
        <input type="hidden" name="id" value="<?= isset($collection->id) ? $collection->id : '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <label class="block font-medium mb-1">Branch <span class="text-red-500">*</span></label>
                <?= render_branch_select_dropdown('branch_id', isset($collection->branch_id) ? $collection->branch_id : null) ?>
            </div>

            <div>
                <label class="block font-medium mb-1">Collection Date <span class="text-red-500">*</span></label>
                <input type="date" name="collection_date" required value="<?= set_value('collection_date', isset($collection->collection_date) ? date('Y-m-d', strtotime($collection->collection_date)) : '') ?>" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-medium mb-1">Scrap Category <span class="text-red-500">*</span></label>
                <select name="category_id" required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">-- Select category --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat->id ?>" <?= set_select('category_id', $cat->id, isset($collection->category_id) && $collection->category_id == $cat->id) ?>><?= html_escape($cat->category_name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Source</label>
                <input type="text" name="source" value="<?= set_value('source', isset($collection->source) ? $collection->source : 'N/A') ?>" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-medium mb-1">Quantity <span class="text-red-500">*</span></label>
                <input type="number" step="0.01" name="quantity" required value="<?= set_value('quantity', isset($collection->quantity) ? $collection->quantity : '') ?>" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-medium mb-1">Purchase / Processing Cost </label>
                <input type="number" step="0.01" name="purchase_cost" value="<?= set_value('purchase_cost', isset($collection->purchase_cost) ? $collection->purchase_cost : '') ?>" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-medium mb-1">Remarks</label>
                <input type="text" name="remarks" value="<?= set_value('remarks', isset($collection->remarks) ? $collection->remarks : '') ?>" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="flex flex-wrap gap-4 pt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Submit</button>
            <a href="<?= base_url('index.php/scrap_collection') ?>" class="px-6 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">Cancel</a>
        </div>
    </form>
</div>
