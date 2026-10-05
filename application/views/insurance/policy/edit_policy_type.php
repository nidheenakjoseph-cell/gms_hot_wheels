<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-4">
        <?= htmlspecialchars($title) ?>
    </h2>

    <?php if ($this->session->flashdata('validation_error')) { ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <?= $this->session->flashdata('validation_error'); ?>
        </div>
    <?php } ?>

    <form method="POST"
          action="<?= base_url('index.php/insurancepolicy/edit_policy_type/' . $policy_type->policy_type_id); ?>">

        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-2">

                <label class="font-medium">
                    Policy Type Name
                    <span class="text-red-500">*</span>
                </label>

                <input type="text"
                    name="policy_type_name"
                    value="<?= htmlspecialchars(
                        $this->session->flashdata('policy_type_name')
                        ?? $policy_type->policy_type_name
                    ); ?>"
                    class="w-full border p-2 rounded"
                    placeholder="Motor Insurance" required>

            </div>

            <div class="col-span-2">

                <label class="font-medium">
                    Description
                </label>

                <textarea name="description"
                    rows="4"
                    class="w-full border p-2 rounded"
                    placeholder="Enter policy type description"><?= htmlspecialchars(
                        $this->session->flashdata('description')
                        ?? $policy_type->description
                    ); ?></textarea>

            </div>

            <div class="col-span-2">

                <label class="font-medium">
                    Status
                </label>

                <select name="status"
                        class="w-full border p-2 rounded">

                    <option value="1"
                        <?= (
                            ($this->session->flashdata('status') !== null)
                                ? $this->session->flashdata('status')
                                : $policy_type->status
                        ) == 1 ? 'selected' : ''; ?>>
                        Active
                    </option>

                    <option value="0"
                        <?= (
                            ($this->session->flashdata('status') !== null)
                                ? $this->session->flashdata('status')
                                : $policy_type->status
                        ) == 0 ? 'selected' : ''; ?>>
                        Inactive
                    </option>

                </select>

            </div>

        </div>

        <br>

        <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded">
            Update Policy Type
        </button>

        <a href="<?= base_url('index.php/insurancepolicy/policy_types'); ?>"
           class="ml-3 px-6 py-2 bg-gray-300 rounded">
            Cancel
        </a>

    </form>

</div>