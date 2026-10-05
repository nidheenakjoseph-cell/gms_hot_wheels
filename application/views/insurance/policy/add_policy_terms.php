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
          action="<?= base_url('index.php/insurancepolicy/add_policy_term'); ?>">

        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-2">
                <label class="font-medium">
                    Policy Term Name <span class="text-red-500">*</span>
                </label>

                <input type="text"
                       name="policy_term_name"
                       class="w-full border p-2 rounded"
                       placeholder="Annual Policy" required>
            </div>

            <div>
                <label class="font-medium">
                    Duration <span class="text-red-500">*</span>
                </label>

                <input type="number"
                       name="duration"
                       min="1"
                       class="w-full border p-2 rounded"
                       placeholder="1" required>
            </div>

            <div>
                <label class="font-medium">
                    Duration Unit <span class="text-red-500">*</span>
                </label>

                <select name="duration_unit"
                        class="w-full border p-2 rounded" required>

                    <option value="">Select Duration Unit</option>
                    <option value="Days">Days</option>
                    <option value="Months">Months</option>
                    <option value="Years" selected>Years</option>

                </select>
            </div>

            <div class="col-span-2">
                <label class="font-medium">
                    Description
                </label>

                <textarea name="description"
                          rows="4"
                          class="w-full border p-2 rounded"
                          placeholder="Enter policy term description"></textarea>
            </div>

            <div class="col-span-2">
                <label class="font-medium">
                    Status
                </label>

                <select name="status"
                        class="w-full border p-2 rounded">

                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>

                </select>
            </div>

        </div>

        <br>

        <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded">
            Save Policy Term
        </button>

        <a href="<?= base_url('index.php/insurancepolicy/policy_terms'); ?>"
           class="ml-3 px-6 py-2 bg-gray-300 rounded">
            Cancel
        </a>

    </form>

</div>
