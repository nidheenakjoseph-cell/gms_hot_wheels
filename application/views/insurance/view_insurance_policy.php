<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold">
                <?= htmlspecialchars($title) ?>
            </h2>
        </div>
    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Policy Information
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>
            <label class="text-sm text-gray-500">
                Customer / Insured
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($policy->customer_name ?? '-'); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Vehicle
            </label>

            <p class="font-medium">

                <?php if (!empty($policy->vehicle_name)) : ?>

                    <?= htmlspecialchars($policy->vehicle_name); ?>

                    <?php if (!empty($policy->registration_no)) : ?>
                        (<?= htmlspecialchars($policy->registration_no); ?>)
                    <?php endif; ?>

                <?php elseif (!empty($policy->registration_no)) : ?>

                    <?= htmlspecialchars($policy->registration_no); ?>

                <?php else : ?>

                    -

                <?php endif; ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Number
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($policy->policy_number ?? '-'); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Insurance Company
            </label>

            <p class="font-medium">
                <?= !empty($policy->company_name)
                    ? htmlspecialchars($policy->company_name)
                    : '-'; ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Type
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($policy->policy_type_name ?? '-'); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Term
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($policy->policy_term_name ?? '-'); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Insurance Policy Status
            </label>

            <?php
            $status = $policy->policy_status ?? '';

            $status_class = 'bg-gray-100 text-gray-700';

            if ($status == 'Active') {
                $status_class = 'bg-green-100 text-green-700';
            } elseif ($status == 'Draft') {
                $status_class = 'bg-yellow-100 text-yellow-700';
            } elseif ($status == 'Suspended') {
                $status_class = 'bg-orange-100 text-orange-700';
            } elseif ($status == 'Expired') {
                $status_class = 'bg-red-100 text-red-700';
            } elseif ($status == 'Cancelled') {
                $status_class = 'bg-gray-200 text-gray-700';
            }
            ?>

            <p>
                <span class="inline-block px-3 py-1 rounded-full text-sm <?= $status_class; ?>">
                    <?= htmlspecialchars($status ?: '-'); ?>
                </span>
            </p>

        </div>

        <div>
            <label class="text-sm text-gray-500">
                Start Date
            </label>

            <p class="font-medium">
                <?= !empty($policy->start_date)
                    ? date('d-m-Y', strtotime($policy->start_date))
                    : '-'; ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Expiry Date
            </label>

            <p class="font-medium">
                <?= !empty($policy->expiry_date)
                    ? date('d-m-Y', strtotime($policy->expiry_date))
                    : '-'; ?>
            </p>
        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Policy Coverages
    </h3>

    <?php if (!empty($policy_coverages)) : ?>

        <div class="overflow-x-auto mb-8">

            <table class="w-full border border-gray-200 rounded">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-3 border-b">
                            #
                        </th>

                        <th class="text-left p-3 border-b">
                            Coverage Type
                        </th>

                        <th class="text-left p-3 border-b">
                            Coverage Amount
                        </th>

                        <th class="text-left p-3 border-b">
                            Coverage Limit
                        </th>

                        <th class="text-left p-3 border-b">
                            Deductible / Excess
                        </th>

                        <th class="text-left p-3 border-b">
                            Deductible Type
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php $i = 1; ?>

                    <?php foreach ($policy_coverages as $coverage) : ?>

                        <tr class="hover:bg-gray-50">

                            <td class="p-3 border-b">
                                <?= $i++; ?>
                            </td>

                            <td class="p-3 border-b">

                                <?= htmlspecialchars(
                                    $coverage->coverage_type_name ?? '-'
                                ); ?>

                            </td>

                            <td class="p-3 border-b">

                                <?= isset($coverage->coverage_amount)
                                    ? number_format(
                                        (float)$coverage->coverage_amount,
                                        2
                                    )
                                    : '-'; ?>

                            </td>

                            <td class="p-3 border-b">

                                <?= htmlspecialchars(
                                    $coverage->coverage_limit_type ?? '-'
                                ); ?>

                            </td>

                            <td class="p-3 border-b">

                                <?= isset($coverage->deductible_amount)
                                    ? number_format(
                                        (float)$coverage->deductible_amount,
                                        2
                                    )
                                    : '-'; ?>

                            </td>

                            <td class="p-3 border-b">

                                <?= htmlspecialchars(
                                    $coverage->deductible_type ?? '-'
                                ); ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php else : ?>

        <div class="p-4 bg-gray-50 border rounded text-gray-500 mb-8">
            No coverages added for this policy.
        </div>

    <?php endif; ?>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Financial Information
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>
            <label class="text-sm text-gray-500">
                Sum Insured / Overall Coverage Amount
            </label>

            <p class="font-medium">
                <?= $policy->sum_insured !== null && $policy->sum_insured !== ''
                    ? number_format((float)$policy->sum_insured, 2)
                    : '-'; ?>
            </p>

        </div>

        <div>
            <label class="text-sm text-gray-500">
                Premium Amount
            </label>

            <p class="font-medium">
                <?= $policy->premium_amount !== null && $policy->premium_amount !== ''
                    ? number_format((float)$policy->premium_amount, 2)
                    : '-'; ?>
            </p>

        </div>

        <div>
            <label class="text-sm text-gray-500">
                Discount
            </label>

            <p class="font-medium">
                <?= isset($policy->discount_amount)
                    && $policy->discount_amount !== null
                    && $policy->discount_amount !== ''
                    ? number_format((float)$policy->discount_amount, 2)
                    : (isset($policy->discount)
                        && $policy->discount !== null
                        && $policy->discount !== ''
                        ? number_format((float)$policy->discount, 2)
                        : '-'); ?>
            </p>

        </div>

        <div>
            <label class="text-sm text-gray-500">
                VAT Treatment
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($policy->vat_treatment ?? '-'); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                VAT %
            </label>

            <p class="font-medium">
                <?= $policy->vat_rate !== null && $policy->vat_rate !== ''
                    ? number_format((float)$policy->vat_rate, 2) . ' %'
                    : '-'; ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                VAT Amount
            </label>

            <p class="font-medium">
                <?= $policy->vat_amount !== null && $policy->vat_amount !== ''
                    ? number_format((float)$policy->vat_amount, 2)
                    : '-'; ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Total Premium
            </label>

            <p class="font-medium text-lg">
                <?= $policy->total_premium !== null && $policy->total_premium !== ''
                    ? number_format((float)$policy->total_premium, 2)
                    : '-'; ?>
            </p>
        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Policy Details
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>
            <label class="text-sm text-gray-500">
                Customer / Policyholder
            </label>

            <p class="font-medium">
                <?= !empty($policy->customer_name)
                    ? htmlspecialchars($policy->customer_name)
                    : '-'; ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Beneficiary
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $policy->beneficiary ?? '-'
                ); ?>
            </p>
        </div>

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Policy Description
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">
                <?= htmlspecialchars(
                    $policy->policy_description ?? '-'
                ); ?>
            </div>

        </div>

        <div>

            <label class="text-sm text-gray-500">
                Special Conditions
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">
                <?= htmlspecialchars(
                    $policy->special_conditions ?? '-'
                ); ?>
            </div>

        </div>

        <div>

            <label class="text-sm text-gray-500">
                Exclusions
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">
                <?= htmlspecialchars(
                    $policy->exclusions ?? '-'
                ); ?>
            </div>

        </div>

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Notes
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">
                <?= htmlspecialchars(
                    $policy->notes ?? '-'
                ); ?>
            </div>

        </div>

    </div>

    <?php
    $has_cancellation =
        !empty($policy->cancellation_date) ||
        !empty($policy->cancellation_reason);
    ?>

    <?php if ($has_cancellation) : ?>

        <h3 class="text-lg font-semibold mb-4 border-b pb-2">
            Cancellation Details
        </h3>

        <div class="grid grid-cols-2 gap-4 mb-8">

            <div>

                <label class="text-sm text-gray-500">
                    Cancellation Date
                </label>

                <p class="font-medium">
                    <?= !empty($policy->cancellation_date)
                        ? date(
                            'd-m-Y',
                            strtotime($policy->cancellation_date)
                        )
                        : '-'; ?>
                </p>

            </div>

            <div>

                <label class="text-sm text-gray-500">
                    Cancellation Reason
                </label>

                <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">
                    <?= htmlspecialchars(
                        $policy->cancellation_reason ?? '-'
                    ); ?>
                </div>

            </div>

        </div>

    <?php endif; ?>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Policy Documents
    </h3>

    <?php if (!empty($policy_documents)) : ?>

        <div class="overflow-x-auto">

            <table class="w-full border border-gray-200 rounded">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-3 border-b">
                            #
                        </th>

                        <th class="text-left p-3 border-b">
                            Document Type
                        </th>

                        <th class="text-left p-3 border-b">
                            Document Name
                        </th>

                        <th class="text-left p-3 border-b">
                            File
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php $i = 1; ?>

                    <?php foreach ($policy_documents as $document) : ?>

                        <tr class="hover:bg-gray-50">

                            <td class="p-3 border-b">
                                <?= $i++; ?>
                            </td>

                            <td class="p-3 border-b">

                                <?= htmlspecialchars(
                                    $document->document_type ?? '-'
                                ); ?>

                            </td>

                            <td class="p-3 border-b">

                                <?= htmlspecialchars(
                                    $document->document_name ?? '-'
                                ); ?>

                            </td>

                            <td class="p-3 border-b">

                                <?php if (!empty($document->file_path)) : ?>

                                    <a
                                        href="<?= base_url($document->file_path); ?>"
                                        target="_blank"
                                        class="text-blue-600 hover:underline"
                                    >
                                        View Document
                                    </a>

                                <?php else : ?>

                                    -

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php else : ?>

        <div class="p-4 bg-gray-50 border rounded text-gray-500">
            No documents uploaded for this policy.
        </div>

    <?php endif; ?>

    <div class="mt-8 pt-4 border-t">

        <a
            href="<?= base_url(
                'index.php/insurancepolicy/edit_policy/' . $policy->policy_id
            ); ?>"
            class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        >
            Edit Policy
        </a>

        <a
            href="<?= base_url(
                'index.php/insurancepolicy/policies'
            ); ?>"
            class="ml-3 px-6 py-2 bg-gray-300 rounded hover:bg-gray-400"
        >
            Back to Policies
        </a>

    </div>

</div>
