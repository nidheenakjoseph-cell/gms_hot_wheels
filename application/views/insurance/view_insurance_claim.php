<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold">
                <?= htmlspecialchars($title) ?>
            </h2>
            <!-- <div class="mt-3 flex gap-2">
                <button type="button"
                        onclick="testInsuranceMailtrap('<?= base_url('index.php/insuranceclaim/send_email/' . $claim->claim_id) ?>', '<?= htmlspecialchars($claim->customer_email ?? '', ENT_QUOTES, 'UTF-8') ?>')"
                        class="px-3 py-2 bg-amber-500 text-white rounded">
                    Test Mailtrap
                </button>
            </div> -->
        </div>

    </div>

<script>
function testInsuranceMailtrap(url, defaultEmail) {
    var email = window.prompt('Mailtrap test email address:', defaultEmail || '');
    if (email === null) return;
    fetch(url, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'email=' + encodeURIComponent(email) + '&test_mailtrap=1'
    })
        .then(function(response) { return response.json(); })
        .then(function(result) { window.alert(result.message || 'Mailtrap test completed.'); })
        .catch(function() { window.alert('Unable to send Mailtrap test email.'); });
}
</script>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Policy Information
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>
            <label class="text-sm text-gray-500">
                Policy Number
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($claim->policy_number ?? '-') ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Insurance Company
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($claim->company_name ?? '-') ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Type
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($claim->policy_type_name ?? '-') ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Customer / Insured
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($claim->customer_name ?? '-') ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Term
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($claim->policy_term_name ?? '') ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Start Date
            </label>

            <p class="font-medium">
                <?= !empty($claim->start_date)
                    ? date('d-m-Y', strtotime($claim->start_date))
                    : '-' ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Expiry Date
            </label>

            <p class="font-medium">
                <?= !empty($claim->expiry_date)
                    ? date('d-m-Y', strtotime($claim->expiry_date))
                    : '-' ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Vehicle
            </label>

            <p class="font-medium">
                <?php if (!empty($claim->brand) && !empty($claim->registration_no)) : ?>

                    <?= htmlspecialchars($claim->brand) ?>
                    -
                    <?= htmlspecialchars($claim->registration_no) ?>

                <?php elseif (!empty($claim->brand)) : ?>

                    <?= htmlspecialchars($claim->brand) ?>

                <?php elseif (!empty($claim->registration_no)) : ?>

                    <?= htmlspecialchars($claim->registration_no) ?>

                <?php else : ?>

                    -

                <?php endif; ?>
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
                <?= htmlspecialchars($claim->claim_number ?? '-') ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Claim Date
            </label>

            <p class="font-medium">
                <?= !empty($claim->claim_date)
                    ? date('d-m-Y', strtotime($claim->claim_date))
                    : '-' ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Incident / Loss Date
            </label>

            <p class="font-medium">
                <?= !empty($claim->incident_date)
                    ? date('d-m-Y', strtotime($claim->incident_date))
                    : '-' ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Claim Type
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($claim->claim_type ?? '-') ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Claim Reason
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($claim->claim_reason ?? '-') ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Claim Amount
            </label>

            <p class="font-medium text-lg">

                <?= $claim->claim_amount !== null &&
                    $claim->claim_amount !== ''
                    ? number_format((float)$claim->claim_amount, 2)
                    : '-' ?>

            </p>

        </div>

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Incident Description
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">

                <?= htmlspecialchars(
                    $claim->incident_description ?? '-'
                ) ?>

            </div>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Claim Assessment & Status
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>

            <label class="text-sm text-gray-500">
                Claim Status
            </label>

            <?php

            $claim_status = $claim->claim_status ?? '';

            $status_class = 'bg-gray-100 text-gray-700';

            if ($claim_status == 'Submitted') {

                $status_class = 'bg-blue-100 text-blue-700';

            } elseif ($claim_status == 'Under Review') {

                $status_class = 'bg-yellow-100 text-yellow-700';

            } elseif ($claim_status == 'Documents Required') {

                $status_class = 'bg-orange-100 text-orange-700';

            } elseif ($claim_status == 'Under Assessment') {

                $status_class = 'bg-purple-100 text-purple-700';

            } elseif ($claim_status == 'Approved') {

                $status_class = 'bg-green-100 text-green-700';

            } elseif ($claim_status == 'Partially Approved') {

                $status_class = 'bg-yellow-100 text-yellow-700';

            } elseif ($claim_status == 'Rejected') {

                $status_class = 'bg-red-100 text-red-700';

            } elseif ($claim_status == 'Settled') {

                $status_class = 'bg-green-100 text-green-700';

            } elseif ($claim_status == 'Closed') {

                $status_class = 'bg-gray-200 text-gray-700';

            }

            ?>

            <p>

                <span class="inline-block px-3 py-1 rounded-full text-sm <?= $status_class ?>">

                    <?= htmlspecialchars($claim_status ?: '-') ?>

                </span>

            </p>

        </div>

        <div>

            <label class="text-sm text-gray-500">
                Approved Amount
            </label>

            <p class="font-medium">

                <?= $claim->approved_amount !== null &&
                    $claim->approved_amount !== ''
                    ? number_format((float)$claim->approved_amount, 2)
                    : '-' ?>

            </p>

        </div>

        <div>

            <label class="text-sm text-gray-500">
                Deducted / Rejected Amount
            </label>

            <p class="font-medium">

                <?= $claim->deducted_amount !== null &&
                    $claim->deducted_amount !== ''
                    ? number_format((float)$claim->deducted_amount, 2)
                    : '-' ?>

            </p>

        </div>

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Action Taken
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">

                <?= htmlspecialchars(
                    $claim->action_taken ?? '-'
                ) ?>

            </div>

        </div>

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Rejection Reason
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">

                <?= htmlspecialchars(
                    $claim->rejection_reason ?? '-'
                ) ?>

            </div>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Claim Details
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Remarks
            </label>

            <div class="mt-1 p-3 bg-gray-50 rounded border whitespace-pre-line">

                <?= htmlspecialchars(
                    $claim->remarks ?? '-'
                ) ?>

            </div>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Supporting Documents
    </h3>

    <?php if (!empty($claim_documents)) : ?>

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

                    <?php foreach ($claim_documents as $document) : ?>

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

                                <?php if (!empty($document->document_path)) : ?>

                                    <a href="<?= base_url($document->document_path) ?>"
                                       target="_blank"
                                       class="text-blue-600 hover:underline">

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

            No supporting documents uploaded for this claim.

        </div>

    <?php endif; ?>

    <div class="mt-8 pt-4 border-t">

        <a href="<?= base_url(
            'index.php/insuranceclaim/edit_claim/' . $claim->claim_id
        ); ?>"
           class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">

            Edit Claim

        </a>

        <a href="<?= base_url(
            'index.php/insuranceclaim/claims'
        ); ?>"
           class="ml-3 px-6 py-2 bg-gray-300 rounded hover:bg-gray-400">

            Back to Claims

        </a>

    </div>

</div>