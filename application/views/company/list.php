<div class="w-full bg-white rounded-2xl shadow-md p-6 mt-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Company Master</h2>
            <p class="text-sm text-gray-500 mt-1">Manage tenant companies, demo expiry, and organizational settings</p>
        </div>

        <a href="<?= base_url('index.php/Admin/add_company') ?>"
            class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm inline-flex items-center gap-2">
            <span class="text-lg leading-none">+</span> Add New Company
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
                    <th class="border px-4 py-3 text-left">Company Name</th>
                    <th class="border px-4 py-3 text-left">Contact / City</th>
                    <th class="border px-4 py-3 text-left">TRN No</th>
                    <th class="border px-4 py-3 text-center">Branches</th>
                    <th class="border px-4 py-3 text-center">Users</th>
                    <th class="border px-4 py-3 text-center">Demo Status</th>
                    <th class="border px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($companies)): ?>
                    <?php foreach ($companies as $c): ?>
                        <?php 
                            $ds = $c->demo_status ?? ['demo_enabled' => false, 'is_expired' => false];
                        ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-4 py-3 font-semibold text-blue-600">
                                <?= htmlspecialchars($c->company_code) ?>
                            </td>
                            <td class="border px-4 py-3 font-medium text-gray-900">
                                <div class="font-bold text-gray-800"><?= htmlspecialchars($c->company_name) ?></div>
                                <div class="text-xs text-gray-500"><?= htmlspecialchars($c->company_email_id ?? '') ?></div>
                            </td>
                            <td class="border px-4 py-3 text-gray-600">
                                <div><?= htmlspecialchars($c->company_telephone ?? 'N/A') ?></div>
                                <div class="text-xs text-gray-500"><?= htmlspecialchars(($c->company_city ?? '') . ($c->company_country ? ', ' . $c->company_country : '')) ?></div>
                            </td>
                            <td class="border px-4 py-3 text-gray-600 text-xs">
                                <?= htmlspecialchars($c->company_TRN ?? 'N/A') ?>
                            </td>
                            <td class="border px-4 py-3 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800">
                                    <?= (int) ($c->branch_count ?? 0) ?> Branches
                                </span>
                            </td>
                            <td class="border px-4 py-3 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    <?= (int) ($c->user_count ?? 0) ?> Users
                                </span>
                            </td>
                            <td class="border px-4 py-3 text-center">
                                <?php if (!empty($ds['demo_enabled'])): ?>
                                    <?php if (!empty($ds['is_expired'])): ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800" title="Expired: <?= htmlspecialchars($c->demo_expiry_date ?? '') ?>">
                                            ● Expired (<?= htmlspecialchars($c->demo_expiry_date ?? '') ?>)
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800" title="Expires: <?= htmlspecialchars($c->demo_expiry_date ?? '') ?>">
                                            ● Active Demo (until <?= htmlspecialchars($c->demo_expiry_date ?? '') ?>)
                                        </span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        Standard / Unlimited
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="border px-4 py-3 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <a href="<?= base_url('index.php/Admin/edit_company/' . $c->company_id) ?>"
                                        class="px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded font-medium text-xs transition"
                                        title="Edit Company">
                                        Edit
                                    </a>
                                    <a href="<?= base_url('index.php/branches/add?company_id=' . $c->company_id) ?>"
                                        class="px-3 py-1 bg-purple-100 text-purple-700 hover:bg-purple-200 rounded font-medium text-xs transition"
                                        title="Add Branch">
                                        + Branch
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-8 text-gray-400">
                            No companies found. Click "+ Add New Company" to get started.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
