<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-6">
        <?= htmlspecialchars($title) ?>
    </h2>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Policy Term Information
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div class="col-span-2">
            <label class="text-sm text-gray-500">
                Policy Term Name
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($policy_term->policy_term_name ?? '-'); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Duration
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($policy_term->duration ?? '-'); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Duration Unit
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($policy_term->duration_unit ?? '-'); ?>
            </p>
        </div>

        <div class="col-span-2">
            <label class="text-sm text-gray-500">
                Description
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">
                <?= htmlspecialchars($policy_term->description ?? '-'); ?>
            </div>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Status
            </label>

            <p class="mt-1">

                <?php if ($policy_term->status == 1): ?>

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

        <a href="<?= base_url('index.php/insurancepolicy/edit_policy_term/' . $policy_term->policy_term_id); ?>"
           class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Edit Policy Term
        </a>

        <a href="<?= base_url('index.php/insurancepolicy/policy_terms'); ?>"
           class="ml-3 px-6 py-2 bg-gray-300 rounded hover:bg-gray-400">
            Back to Policy Terms
        </a>

    </div>

</div>