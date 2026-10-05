<div class="w-full bg-white rounded-2xl shadow-md p-6">
    <h2 class="text-2xl font-bold mb-4"><?= isset($category->id) ? 'Edit Scrap Category' : 'Add Scrap Category' ?></h2>

    <?php if (validation_errors()): ?>
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded">
            <?= validation_errors() ?>
        </div>
    <?php endif; ?>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <form action="<?= base_url('index.php/scrap_category/save') ?>" method="post" autocomplete="off" class="space-y-6">
        <input type="hidden" name="id" value="<?= isset($category->id) ? $category->id : '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <label class="block font-medium mb-1">Category Name <span class="text-red-500">*</span></label>
                <input type="text" name="category_name" required value="<?= set_value('category_name', isset($category->category_name) ? $category->category_name : '') ?>" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Unit <span class="text-red-500">*</span></label>
                <select id="unitSelect" name="unit" required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">-- Select unit --</option>
                    <?php $selectedUnit = set_value('unit', isset($category->unit) ? $category->unit : ''); ?>
                    <?php $selectedOptionFound = false; ?>
                    <?php if (!empty($scrap_units)): ?>
                        <?php foreach ($scrap_units as $unitObj): ?>
                            <?php if ($unitObj->unit_abbr === $selectedUnit): $selectedOptionFound = true; endif; ?>
                            <option value="<?= html_escape($unitObj->unit_abbr) ?>" <?= set_select('unit', $unitObj->unit_abbr, isset($category->unit) && $category->unit == $unitObj->unit_abbr) ?>><?= html_escape($unitObj->unit_name . ' (' . $unitObj->unit_abbr . ')') ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (!empty($selectedUnit) && !$selectedOptionFound): ?>
                        <option value="<?= html_escape($selectedUnit) ?>" selected><?= html_escape($selectedUnit) ?></option>
                    <?php endif; ?>
                </select>
            </div> 

            <div style="display: none;">
                <label class="block font-medium mb-1">Default Rate <span class="text-red-500">*</span></label>
                <input type="number" step="0.01" name="default_rate" value="<?= set_value('default_rate', isset($category->default_rate) ? $category->default_rate : '') ?>" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block font-medium mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"><?= set_value('description', isset($category->description) ? $category->description : '') ?></textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Status <span class="text-red-500">*</span></label>
            <select name="is_active" required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="1" <?= set_select('is_active', '1', isset($category->is_active) && $category->is_active == '1') ?>>Active</option>
                <option value="0" <?= set_select('is_active', '0', isset($category->is_active) && $category->is_active == '0') ?>>Inactive</option>
            </select>
        </div>

        <div class="flex flex-wrap gap-4 pt-4">
            <button type="reset" class="px-6 py-2 border rounded-lg hover:bg-gray-100">Reset</button>
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Submit</button>
        </div>
    </form>

    <div id="addUnitModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold">Add Unit</h3>
                <button type="button" id="closeAddUnitModal" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block font-medium mb-1">Unit Name <span class="text-red-500">*</span></label>
                    <input id="newUnitName" type="text" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="e.g. Kilogram">
                </div>
                <div>
                    <label class="block font-medium mb-1">Unit Abbreviation <span class="text-red-500">*</span></label>
                    <input id="newUnitAbbr" type="text" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="e.g. Kg">
                </div>
                <div id="addUnitError" class="text-sm text-red-600 hidden"></div>
                <div class="flex justify-end gap-3">
                    <button type="button" id="cancelAddUnit" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Cancel</button>
                    <button type="button" id="saveNewUnit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Unit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function closeUnitModal() {
                $('#addUnitModal').addClass('hidden');
                $('#newUnitName').val('');
                $('#newUnitAbbr').val('');
                $('#addUnitError').addClass('hidden').text('');
            }

            var currentUnitResults = [];

            $('#unitSelect').select2({
                placeholder: '-- Select unit --',
                allowClear: true,
                minimumInputLength: 0,
                ajax: {
                    url: '<?= base_url('index.php/scrap_category/unit_search') ?>',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return { q: params.term || '' };
                    },
                    processResults: function(data) {
                        currentUnitResults = data.results || [];
                        return { results: data.results };
                    },
                    cache: true,
                },
                width: '100%',
                tags: true,
                createTag: function(params) {
                    var term = $.trim(params.term);
                    if (term === '') {
                        return null;
                    }

                    var lowerTerm = term.toLowerCase();
                    var alreadyExists = currentUnitResults.some(function(item) {
                        return (item.id && item.id.toLowerCase() === lowerTerm)
                            || (item.text && item.text.toLowerCase().indexOf(lowerTerm) !== -1);
                    });

                    if (alreadyExists) {
                        return null;
                    }

                    return {
                        id: term,
                        text: term,
                        newTag: true,
                        originalTerm: term
                    };
                },
                templateResult: function(data) {
                    if (data.newTag) {
                        return $('<span><strong>+</strong> Add "' + data.text + '"</span>');
                    }
                    return data.text;
                },
                language: {
                    noResults: function() {
                        return 'Type to add a new unit';
                    }
                }
            });

            $('#unitSelect').on('select2:select', function(e) {
                var data = e.params.data;
                if (data.newTag) {
                    var term = data.originalTerm || data.id;
                    $('#newUnitName').val('');
                    $('#newUnitAbbr').val(term);
                    $('#addUnitModal').removeClass('hidden');
                    $('#newUnitName').focus();

                    // remove the temporary tag so the field does not stay selected
                    $('#unitSelect').find('option[value="' + data.id + '"]').remove();
                    $('#unitSelect').val('').trigger('change');
                }
            });

            $('#closeAddUnitModal, #cancelAddUnit').on('click', function() {
                closeUnitModal();
            });

            $('#saveNewUnit').on('click', function() {
                var unitName = $('#newUnitName').val().trim();
                var unitAbbr = $('#newUnitAbbr').val().trim();
                if (!unitName || !unitAbbr) {
                    $('#addUnitError').removeClass('hidden').text('Please enter both unit name and abbreviation.');
                    return;
                }

                $.ajax({
                    url: '<?= base_url('index.php/scrap_category/add_unit_ajax') ?>',
                    method: 'POST',
                    dataType: 'json',
                    data: { unit_name: unitName, unit_abbr: unitAbbr },
                    success: function(response) {
                        if (!response.success) {
                            $('#addUnitError').removeClass('hidden').text(response.message || 'Unable to save unit.');
                            return;
                        }

                        var newOption = new Option(response.text, response.id, true, true);
                        $('#unitSelect').append(newOption).trigger('change');
                        closeUnitModal();
                    },
                    error: function() {
                        $('#addUnitError').removeClass('hidden').text('Unable to save unit. Please try again.');
                    }
                });
            });
        });
    </script>
</div>
