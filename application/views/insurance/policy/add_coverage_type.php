<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-4">
        <?= htmlspecialchars($title) ?>
    </h2>

    <?php if (validation_errors()) { ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <?= validation_errors(); ?>
        </div>
    <?php } ?>

    <form method="POST"
          action="<?= base_url('index.php/insurancepolicy/add_coverage_type'); ?>">

        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-2">
                <label class="font-medium">
                    Coverage Type Name <span class="text-red-500">*</span>
                </label>

                <input type="text"
                       name="coverage_type_name"
                       value="<?= set_value('coverage_type_name'); ?>"
                       class="w-full border p-2 rounded"
                       placeholder="e.g. Own Vehicle Damage" required>

                <?php if (form_error('coverage_type_name')) { ?>
                    <small class="text-red-500">
                        <?= form_error('coverage_type_name'); ?>
                    </small>
                <?php } ?>
            </div>

            <div class="col-span-2">
                <label class="font-medium">
                    Description
                </label>

                <textarea name="description"
                          rows="4"
                          class="w-full border p-2 rounded"
                          placeholder="Enter coverage type description"><?= set_value('description'); ?></textarea>
            </div>

            <div class="col-span-2">
                <label class="font-medium">
                    Status
                </label>

                <select name="status"
                        class="w-full border p-2 rounded">

                    <option value="1"
                        <?= set_select('status', '1', TRUE); ?>>
                        Active
                    </option>

                    <option value="0"
                        <?= set_select('status', '0'); ?>>
                        Inactive
                    </option>

                </select>
            </div>

        </div>

        <br>

        <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Save Coverage Type
        </button>

        <a href="<?= base_url('index.php/insurancepolicy/coverage_types'); ?>"
           class="ml-3 px-6 py-2 bg-gray-300 rounded hover:bg-gray-400">
            Cancel
        </a>

    </form>

</div>

