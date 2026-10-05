<div class="w-full bg-white rounded-2xl shadow-md p-6 mt-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Branch Master</h2>
            <p class="text-sm text-gray-500 mt-1">Manage organization branches and locations</p>
        </div>

        <a href="<?= base_url('index.php/branches/add') ?>"
            class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm inline-flex items-center gap-2">
            <span>+</span> Add New Branch
        </a>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            <?= htmlspecialchars($this->session->flashdata('success')) ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <?= htmlspecialchars($this->session->flashdata('error')) ?>
        </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-xl text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                <tr>
                    <th class="border px-4 py-3 text-left">Code</th>
                    <th class="border px-4 py-3 text-left">Branch Name</th>
                    <th class="border px-4 py-3 text-left">Company</th>
                    <th class="border px-4 py-3 text-left">Phone</th>
                    <th class="border px-4 py-3 text-left">Email</th>
                    <th class="border px-4 py-3 text-left">TRN No</th>
                    <th class="border px-4 py-3 text-center">Type</th>
                    <th class="border px-4 py-3 text-center">Status</th>
                    <th class="border px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($branches)): ?>
                    <?php foreach ($branches as $b): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-4 py-3 font-semibold text-gray-800">
                                <?= htmlspecialchars($b->branch_code) ?>
                            </td>
                            <td class="border px-4 py-3 font-medium text-gray-900">
                                <?= htmlspecialchars($b->branch_name) ?>
                            </td>
                            <td class="border px-4 py-3 text-gray-700 font-medium">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-gray-100 text-gray-800 border">
                                    <?= htmlspecialchars($b->company_name ?? ('Company #' . $b->company_id)) ?>
                                </span>
                            </td>
                            <td class="border px-4 py-3 text-gray-600">
                                <?= htmlspecialchars($b->phone ?? 'N/A') ?>
                            </td>
                            <td class="border px-4 py-3 text-gray-600">
                                <?= htmlspecialchars($b->email ?? 'N/A') ?>
                            </td>
                            <td class="border px-4 py-3 text-gray-600">
                                <?= htmlspecialchars($b->trn_no ?? 'N/A') ?>
                            </td>
                            <td class="border px-4 py-3 text-center">
                                <?php if ($b->is_main_branch): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-100 text-purple-800">
                                        Main Branch
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        Sub Branch
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="border px-4 py-3 text-center">
                                <?php if ($b->is_active): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        Active
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="border px-4 py-3 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <a href="<?= base_url('index.php/branches/edit/' . $b->branch_id) ?>"
                                        class="px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded font-medium text-xs transition"
                                        title="Edit Branch">
                                        Edit
                                    </a>

                                    <?php if (!$b->is_main_branch): ?>
                                        <a href="<?= base_url('index.php/branches/toggle_status/' . $b->branch_id) ?>"
                                            onclick="return confirm('Are you sure you want to change branch status?');"
                                            class="px-3 py-1 <?= $b->is_active ? 'bg-orange-100 text-orange-700 hover:bg-orange-200' : 'bg-green-100 text-green-700 hover:bg-green-200' ?> rounded font-medium text-xs transition">
                                            <?= $b->is_active ? 'Deactivate' : 'Activate' ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-6 text-gray-500">
                            No branch records found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
