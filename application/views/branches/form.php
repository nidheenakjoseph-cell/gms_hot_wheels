<div class="w-full bg-white rounded-2xl shadow-md p-6 mt-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                <?= isset($branch->branch_id) ? 'Edit Branch' : 'Add New Branch' ?>
            </h2>
            <p class="text-sm text-gray-500 mt-1">Configure branch location and organization details</p>
        </div>

        <a href="<?= base_url('index.php/branches') ?>"
            class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition text-sm">
            ← Back to Branch List
        </a>
    </div>

    <?php if (validation_errors()): ?>
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
            <?= validation_errors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('index.php/branches/save') ?>" method="post" class="space-y-6" autocomplete="off">
        <input type="hidden" name="branch_id" value="<?= isset($branch->branch_id) ? $branch->branch_id : '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Company -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Company <span class="text-red-500">*</span>
                </label>
                <select name="company_id" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option value="">Select Company</option>
                    <?php if (!empty($companies)): ?>
                        <?php foreach ($companies as $c): ?>
                            <option value="<?= $c->company_id ?>" <?= (isset($selected_company_id) && (int)$selected_company_id === (int)$c->company_id) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c->company_name . ' (' . $c->company_code . ')') ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Branch Code -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Branch Code <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="branch_code"
                    required
                    value="<?= set_value('branch_code', isset($branch->branch_code) ? $branch->branch_code : $auto_code) ?>"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none uppercase">
            </div>

            <!-- Branch Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Branch Name <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="branch_name"
                    required
                    placeholder="e.g. Dubai Branch / Workshop #2"
                    value="<?= set_value('branch_name', isset($branch->branch_name) ? $branch->branch_name : '') ?>"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number</label>
                <input type="text"
                    name="phone"
                    placeholder="e.g. +971 4 123 4567"
                    value="<?= set_value('phone', isset($branch->phone) ? $branch->phone : '') ?>"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email"
                    name="email"
                    placeholder="e.g. branch@garage.com"
                    value="<?= set_value('email', isset($branch->email) ? $branch->email : '') ?>"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- TRN No -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">TRN (Tax Registration Number)</label>
                <input type="text"
                    name="trn_no"
                    placeholder="15-digit TRN Number"
                    value="<?= set_value('trn_no', isset($branch->trn_no) ? $branch->trn_no : '') ?>"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Branch Address</label>
                <textarea name="address"
                    rows="3"
                    placeholder="Street, Industrial Area, City..."
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"><?= set_value('address', isset($branch->address) ? $branch->address : '') ?></textarea>
            </div>

            <!-- Status Checkboxes -->
            <div class="md:col-span-2 flex flex-wrap gap-6 pt-2 border-t border-gray-200">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox"
                        name="is_active"
                        value="1"
                        <?= (!isset($branch->is_active) || $branch->is_active) ? 'checked' : '' ?>
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-2 text-sm font-medium text-gray-700">Active Branch</span>
                </label>

                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox"
                        name="is_main_branch"
                        value="1"
                        <?= (isset($branch->is_main_branch) && $branch->is_main_branch) ? 'checked' : '' ?>
                        class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
                    <span class="ml-2 text-sm font-medium text-gray-700">Set as Main Branch</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
            <a href="<?= base_url('index.php/branches') ?>"
                class="px-6 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition text-sm">
                Cancel
            </a>
            <button type="submit"
                class="px-8 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition text-sm shadow">
                Save Branch Details
            </button>
        </div>
    </form>
</div>
