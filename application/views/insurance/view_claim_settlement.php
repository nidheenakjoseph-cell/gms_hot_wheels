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
                Policy Number
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $settlement->policy_number ?? '-'
                ) ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Insurance Company
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $settlement->company_name ?? '-'
                ) ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Type
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $settlement->policy_type_name ?? '-'
                ) ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Start Date
            </label>

            <p class="font-medium">

                <?= !empty($settlement->start_date)
                    ? date(
                        'd-m-Y',
                        strtotime(
                            $settlement->start_date
                        )
                    )
                    : '-' ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Expiry Date
            </label>

            <p class="font-medium">

                <?= !empty($settlement->expiry_date)
                    ? date(
                        'd-m-Y',
                        strtotime(
                            $settlement->expiry_date
                        )
                    )
                    : '-' ?>

            </p>
        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Claim Information
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>
            <label class="text-sm text-gray-500">
                Claim Number
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $settlement->claim_number ?? '-'
                ) ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Claim Date
            </label>

            <p class="font-medium">

                <?= !empty($settlement->claim_date)
                    ? date(
                        'd-m-Y',
                        strtotime(
                            $settlement->claim_date
                        )
                    )
                    : '-' ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Incident / Loss Date
            </label>

            <p class="font-medium">

                <?= !empty($settlement->incident_date)
                    ? date(
                        'd-m-Y',
                        strtotime(
                            $settlement->incident_date
                        )
                    )
                    : '-' ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Claim Type
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $settlement->claim_type ?? '-'
                ) ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Claim Reason
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $settlement->claim_reason ?? '-'
                ) ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Original Claim Amount
            </label>

            <p class="font-medium text-lg">

                <?= $settlement->original_claim_amount !== null
                    && $settlement->original_claim_amount !== ''
                    ? number_format(
                        (float)$settlement->original_claim_amount,
                        2
                    )
                    : '-' ?>

            </p>
        </div>

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Incident Description
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">

                <?= htmlspecialchars(
                    $settlement->incident_description ?? '-'
                ) ?>

            </div>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Settlement Information
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>
            <label class="text-sm text-gray-500">
                Settlement Reference
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $settlement->settlement_reference ?? '-'
                ) ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Settlement Date
            </label>

            <p class="font-medium">

                <?= !empty($settlement->settlement_date)
                    ? date(
                        'd-m-Y',
                        strtotime(
                            $settlement->settlement_date
                        )
                    )
                    : '-' ?>

            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Settlement Method
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $settlement->settlement_method ?? '-'
                ) ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Payment Reference
            </label>

            <p class="font-medium">
                <?= htmlspecialchars(
                    $settlement->payment_reference ?? '-'
                ) ?>
            </p>
        </div>

        <div>

            <label class="text-sm text-gray-500">
                Settlement Status
            </label>

            <?php

            $settlement_status =
                $settlement->settlement_status ?? '';

            $status_class =
                'bg-gray-100 text-gray-700';

            if ($settlement_status == 'Pending') {

                $status_class =
                    'bg-yellow-100 text-yellow-700';

            } elseif (
                $settlement_status ==
                'Approved for Settlement'
            ) {

                $status_class =
                    'bg-blue-100 text-blue-700';

            } elseif (
                $settlement_status ==
                'Partially Settled'
            ) {

                $status_class =
                    'bg-orange-100 text-orange-700';

            } elseif (
                $settlement_status ==
                'Settled'
            ) {

                $status_class =
                    'bg-green-100 text-green-700';

            } elseif (
                $settlement_status ==
                'Cancelled'
            ) {

                $status_class =
                    'bg-red-100 text-red-700';

            }

            ?>

            <p>

                <span class="inline-block px-3 py-1 rounded-full text-sm <?= $status_class ?>">

                    <?= htmlspecialchars(
                        $settlement_status ?: '-'
                    ) ?>

                </span>

            </p>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Settlement Amount Details
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>

            <label class="text-sm text-gray-500">
                Claim Amount
            </label>

            <p class="font-medium text-lg">

                <?= $settlement->claim_amount !== null
                    && $settlement->claim_amount !== ''
                    ? number_format(
                        (float)$settlement->claim_amount,
                        2
                    )
                    : '-' ?>

            </p>

        </div>

        <div>

            <label class="text-sm text-gray-500">
                Approved Amount
            </label>

            <p class="font-medium text-lg">

                <?= $settlement->approved_amount !== null
                    && $settlement->approved_amount !== ''
                    ? number_format(
                        (float)$settlement->approved_amount,
                        2
                    )
                    : '-' ?>

            </p>

        </div>

        <div>

            <label class="text-sm text-gray-500">
                Deducted Amount
            </label>

            <p class="font-medium text-lg">

                <?= $settlement->deducted_amount !== null
                    && $settlement->deducted_amount !== ''
                    ? number_format(
                        (float)$settlement->deducted_amount,
                        2
                    )
                    : '-' ?>

            </p>

        </div>

        <div>

            <label class="text-sm text-gray-500">
                Settlement Amount
            </label>

            <p class="font-medium text-lg">

                <?= $settlement->settlement_amount !== null
                    && $settlement->settlement_amount !== ''
                    ? number_format(
                        (float)$settlement->settlement_amount,
                        2
                    )
                    : '-' ?>

            </p>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Settlement Details
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Settlement Details
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">

                <?= htmlspecialchars(
                    $settlement->settlement_details ?? '-'
                ) ?>

            </div>

        </div>

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Remarks
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">

                <?= htmlspecialchars(
                    $settlement->remarks ?? '-'
                ) ?>

            </div>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Settlement Documents
    </h3>

    <?php if (!empty($settlement_documents)) : ?>

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

                    <?php foreach (
                        $settlement_documents
                        as $document
                    ) : ?>

                        <tr class="hover:bg-gray-50">

                            <td class="p-3 border-b">
                                <?= $i++ ?>
                            </td>

                            <td class="p-3 border-b">

                                <?= htmlspecialchars(
                                    $document->document_type ?? '-'
                                ) ?>

                            </td>

                            <td class="p-3 border-b">

                                <?= htmlspecialchars(
                                    $document->document_name ?? '-'
                                ) ?>

                            </td>

                            <td class="p-3 border-b">

                                <?php if (
                                    !empty(
                                        $document->document_file
                                    )
                                ) : ?>

                                    <a
                                        href="<?= base_url(
                                            $document->document_file
                                        ) ?>"
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

            No settlement documents uploaded.

        </div>

    <?php endif; ?>

    <div class="mt-8 pt-4 border-t">

        <a
            href="<?= base_url(
                'index.php/insuranceclaimsettlement/edit_settlement/'
                . $settlement->settlement_id
            ); ?>"
            class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        >
            Edit Settlement
        </a>

        <a
            href="<?= base_url(
                'index.php/insuranceclaimsettlement/settlements'
            ); ?>"
            class="ml-3 px-6 py-2 bg-gray-300 rounded hover:bg-gray-400"
        >
            Back to Settlements
        </a>

    </div>

</div>