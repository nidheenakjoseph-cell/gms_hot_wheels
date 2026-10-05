<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold">
                <?= htmlspecialchars($title); ?>
            </h2>
        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Policy Information
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>
            <label class="text-sm text-gray-500">
                Policy Number
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $renewal->new_policy_number
                    ?? $renewal->policy_number
                    ?? '-'
                ); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Insurance Company
            </label>

            <p class="font-medium">

                <?php if (!empty($renewal->company_name)) : ?>

                    <?= htmlspecialchars($renewal->company_name); ?>

                <?php else : ?>

                    -

                <?php endif; ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Type
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $renewal->policy_type_name ?? '-'
                ); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Start Date
            </label>

            <p class="font-medium">

                <?= !empty($renewal->start_date)
                    ? date(
                        'd-m-Y',
                        strtotime($renewal->start_date)
                    )
                    : '-';
                ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Expiry Date
            </label>

            <p class="font-medium">

                <?= !empty($renewal->expiry_date)
                    ? date(
                        'd-m-Y',
                        strtotime($renewal->expiry_date)
                    )
                    : '-';
                ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Customer / Insured
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $renewal->customer_name ?? '-'
                ); ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Vehicle
            </label>

            <p class="font-medium">

                <?php if (!empty($renewal->vehicle_brand) || !empty($renewal->vehicle_registration_no)) : ?>

                    <?= htmlspecialchars($renewal->vehicle_brand ?? ''); ?>

                    <?php if (!empty($renewal->vehicle_registration_no)) : ?>
                        (<?= htmlspecialchars($renewal->vehicle_registration_no); ?>)
                    <?php endif; ?>

                <?php else : ?>

                    -

                <?php endif; ?>

            </p>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Financial Information
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>
            <label class="text-sm text-gray-500">
                Sum Insured / Overall Coverage Amount
            </label>

            <p class="font-medium">

                <?= $renewal->sum_insured !== null
                    && $renewal->sum_insured !== ''
                    ? number_format(
                        (float)$renewal->sum_insured,
                        2
                    )
                    : '-';
                ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Premium Amount
            </label>

            <p class="font-medium">

                <?= $renewal->premium_amount !== null
                    && $renewal->premium_amount !== ''
                    ? number_format(
                        (float)$renewal->premium_amount,
                        2
                    )
                    : '-';
                ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Discount
            </label>

            <p class="font-medium">

                <?= $renewal->discount_amount !== null
                    && $renewal->discount_amount !== ''
                    ? number_format(
                        (float)$renewal->discount_amount,
                        2
                    )
                    : '-';
                ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                VAT Treatment
            </label>

            <p class="font-medium">

                <?= $renewal->vat_treatment !== null
                    && $renewal->vat_treatment !== ''
                    ? $renewal->vat_treatment
                    : '-';
                ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                VAT %
            </label>

            <p class="font-medium">

                <?= $renewal->vat_rate !== null
                    && $renewal->vat_rate !== ''
                    ? number_format(
                        (float)$renewal->vat_rate,
                        2
                    )
                    : '-';
                ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                VAT Amount
            </label>

            <p class="font-medium">

                <?= $renewal->vat_amount !== null
                    && $renewal->vat_amount !== ''
                    ? number_format(
                        (float)$renewal->vat_amount,
                        2
                    )
                    : '-';
                ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Total Premium
            </label>

            <p class="font-medium">

                <?= $renewal->total_premium !== null
                    && $renewal->total_premium !== ''
                    ? number_format(
                        (float)$renewal->total_premium,
                        2
                    )
                    : '-';
                ?>

            </p>
        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Insurance Coverages
    </h3>

    <?php if (!empty($renewal_coverages)) : ?>

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
                            Limit Type
                        </th>

                        <th class="text-left p-3 border-b">
                            Deductible
                        </th>

                        <th class="text-left p-3 border-b">
                            Deductible Type
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php $i = 1; ?>

                    <?php foreach ($renewal_coverages as $coverage) : ?>

                        <tr class="hover:bg-gray-50">

                            <td class="p-3 border-b">
                                <?= $i++; ?>
                            </td>

                            <td class="p-3 border-b">

                                <?= htmlspecialchars(
                                    $coverage->coverage_type_name
                                    ?? '-'
                                ); ?>

                            </td>

                            <td class="p-3 border-b">

                                <?= $coverage->coverage_amount !== null
                                    && $coverage->coverage_amount !== ''
                                    ? number_format(
                                        (float)$coverage->coverage_amount,
                                        2
                                    )
                                    : '-';
                                ?>

                            </td>

                            <td class="p-3 border-b">

                                <?= htmlspecialchars(
                                    $coverage->coverage_limit_type
                                    ?? '-'
                                ); ?>

                            </td>

                            <td class="p-3 border-b">

                                <?= $coverage->deductible_amount !== null
                                    && $coverage->deductible_amount !== ''
                                    ? number_format(
                                        (float)$coverage->deductible_amount,
                                        2
                                    )
                                    : '-';
                                ?>

                            </td>

                            <td class="p-3 border-b">

                                <?= htmlspecialchars(
                                    $coverage->deductible_type
                                    ?? '-'
                                ); ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php else : ?>

        <div class="p-4 bg-gray-50 border rounded text-gray-500 mb-8">

            No coverages added for this renewal.

        </div>

    <?php endif; ?>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Renewal Details
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Remarks
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">

                <?= !empty($renewal->remarks)
                    ? htmlspecialchars($renewal->remarks)
                    : '-';
                ?>

            </div>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Renewal Documents
    </h3>

    <?php if (!empty($renewal_documents)) : ?>

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

                    <?php foreach ($renewal_documents as $document) : ?>

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

                                    <a href="<?= base_url(
                                        $document->file_path
                                    ); ?>"
                                    target="_blank"
                                    class="text-blue-600 hover:underline">

                                        <?= htmlspecialchars(
                                            $document->file_name
                                            ?? 'View Document'
                                        ); ?>

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

                No documents uploaded for this renewal.

            </div>

        <?php endif; ?>

        <div class="mt-8 pt-4 border-t">

            <a href="<?= base_url(
                'index.php/insurancerenewal/edit_renewal/'
                . $renewal->renewal_id
                ); ?>"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">

                Edit Renewal

            </a>

            <a href="<?= base_url(
                'index.php/insurancerenewal/renewals'
            ); ?>"
            class="ml-3 px-6 py-2 bg-gray-300 rounded hover:bg-gray-400">

                Back to Renewals

            </a>

        </div>

    </div>