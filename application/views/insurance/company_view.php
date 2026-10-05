<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-6">
        <?= htmlspecialchars($title) ?>
    </h2>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Insurance Company Information
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>
            <label class="text-sm text-gray-500">
                Company Name
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($company->company_name ?? '-'); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                License / Registration No.
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($company->license_registration_no ?? '-'); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Contact Number
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($company->contact_no ?? '-'); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Email
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($company->email ?? '-'); ?>
            </p>
        </div>

        <div class="col-span-2">
            <label class="text-sm text-gray-500">
                Address
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">
                <?= htmlspecialchars($company->address ?? '-'); ?>
            </div>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Website
            </label>

            <p class="font-medium">
                <?php if (!empty($company->website)): ?>

                    <a href="<?= htmlspecialchars($company->website); ?>"
                       target="_blank"
                       class="text-blue-600 hover:underline">
                        <?= htmlspecialchars($company->website); ?>
                    </a>

                <?php else: ?>

                    -

                <?php endif; ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Status
            </label>

            <p class="mt-1">

                <?php if ($company->status == 1): ?>

                    <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
                        Active
                    </span>

                <?php else: ?>

                    <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-red-700 bg-red-100 rounded-full">
                        Inactive
                    </span>

                <?php endif; ?>

            </p>
        </div>

    </div>

    <div class="mt-8 pt-4 border-t">

        <a href="<?= base_url('index.php/insurancecompany/edit/' . $company->company_id); ?>"
           class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Edit Company
        </a>

        <a href="<?= base_url('index.php/insurancecompany/list'); ?>"
           class="ml-3 px-6 py-2 bg-gray-300 rounded hover:bg-gray-400">
            Back to Companies
        </a>

    </div>

</div>