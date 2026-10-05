<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-4">
        <?= htmlspecialchars($title) ?>
    </h2>

    <?php if ($this->session->flashdata('error')) { ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <?= htmlspecialchars($this->session->flashdata('error')) ?>
        </div>
    <?php } ?>

    <form method="POST"
          enctype="multipart/form-data"
          action="<?= base_url('index.php/insuranceclaim/edit_claim/' . $claim->claim_id); ?>">

        <input type="hidden"
               name="claim_id"
               value="<?= $claim->claim_id ?>">

        <h3 class="text-lg font-semibold mb-4 border-b pb-2">
            Policy Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-2">

                <label class="font-medium">
                    Policy <span class="text-red-500">*</span>
                </label>

                <input type="text"
                       id="policy_number"
                       value="<?= htmlspecialchars($claim->policy_number) ?>"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">

                    <input type="hidden"
                       id="policy_id"
                       name="policy_id"
                       value="<?= htmlspecialchars($claim->policy_id) ?>"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">

            </div>

            <div>

                <label class="font-medium">
                    Insurance Company
                </label>

                <input type="text"
                       id="insurance_company_name"
                       value="<?= htmlspecialchars($claim->company_name ?? '') ?>"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">

            </div>

            <div>

                <label class="font-medium">
                    Policy Type
                </label>

                <input type="text"
                       id="policy_type_name"
                       value="<?= htmlspecialchars($claim->policy_type_name ?? '') ?>"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">

            </div>

            <div>

                <label class="font-medium">
                    Insured Vehicle
                </label>

                <input type="text"
                    id="vehicle"
                    value="<?= htmlspecialchars(
                        trim(($claim->brand ?? '') . ' - ' . ($claim->registration_no ?? '')),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100"
                    placeholder="Vehicle">

            </div>

            <div>

                <label class="font-medium">
                    Customer / Insured
                </label>

                <input type="text"
                       id="customer_name"
                       value="<?= htmlspecialchars($claim->customer_name ?? '-') ?>"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">

            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Claim Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>

                <label class="font-medium">
                    Claim Number
                </label>

                <input type="text"
                       name="claim_number"
                       value="<?= htmlspecialchars($claim->claim_number) ?>"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">

            </div>

            <div>

                <label class="font-medium">
                    Claim Date <span class="text-red-500">*</span>
                </label>

                <input type="date"
                       name="claim_date"
                       value="<?= htmlspecialchars($claim->claim_date) ?>"
                       required
                       class="w-full border p-2 rounded">

            </div>

            <div>

                <label class="font-medium">
                    Incident / Loss Date
                </label>

                <input type="date"
                       name="incident_date"
                       value="<?= !empty($claim->incident_date)
                            ? htmlspecialchars($claim->incident_date)
                            : '' ?>"
                       class="w-full border p-2 rounded">

            </div>

            <div>

                <label class="font-medium">
                    Claim Type <span class="text-red-500">*</span>
                </label>

                <?php
                $claim_type = trim((string) ($claim->claim_type ?? ''));
                ?>

                <select name="claim_type"
                        id="claim_type"
                        required
                        class="w-full border p-2 rounded">

                    <option value="">Select Claim Type</option>

                    <option value="Accident"
                        <?= $claim_type === 'Accident' ? 'selected' : '' ?>>
                        Accident / Collision
                    </option>

                    <option value="Own Damage"
                        <?= $claim_type === 'Own Damage' ? 'selected' : '' ?>>
                        Own Damage
                    </option>

                    <option value="Third Party Property Damage"
                        <?= $claim_type === 'Third Party Property Damage' ? 'selected' : '' ?>>
                        Third Party Property Damage
                    </option>

                    <option value="Third Party Bodily Injury"
                        <?= $claim_type === 'Third Party Bodily Injury' ? 'selected' : '' ?>>
                        Third Party Bodily Injury
                    </option>

                    <option value="Theft"
                        <?= $claim_type === 'Theft' ? 'selected' : '' ?>>
                        Theft
                    </option>

                    <option value="Fire"
                        <?= $claim_type === 'Fire' ? 'selected' : '' ?>>
                        Fire
                    </option>

                    <option value="Natural Perils"
                        <?= $claim_type === 'Natural Perils' ? 'selected' : '' ?>>
                        Natural Perils / Weather Damage
                    </option>

                    <option value="Glass Damage"
                        <?= $claim_type === 'Glass Damage' ? 'selected' : '' ?>>
                        Glass Damage
                    </option>

                    <option value="Vandalism"
                        <?= $claim_type === 'Vandalism' ? 'selected' : '' ?>>
                        Vandalism
                    </option>

                    <option value="Total Loss"
                        <?= $claim_type === 'Total Loss' ? 'selected' : '' ?>>
                        Total Loss
                    </option>

                    <option value="Personal Injury"
                        <?= $claim_type === 'Personal Injury' ? 'selected' : '' ?>>
                        Personal Injury
                    </option>

                    <option value="Other"
                        <?= $claim_type === 'Other' ? 'selected' : '' ?>>
                        Other
                    </option>

                </select>

            </div>

            <div>

                <label class="font-medium">
                    Claim Reason
                </label>

                <input type="text"
                       name="claim_reason"
                       value="<?= htmlspecialchars($claim->claim_reason ?? '') ?>"
                       class="w-full border p-2 rounded"
                       placeholder="Enter claim reason">

            </div>

            <div>

                <label class="font-medium">
                    Claim Amount
                </label>

                <input type="number"
                       step="0.01"
                       min="0"
                       name="claim_amount"
                       id="claim_amount"
                       value="<?= htmlspecialchars($claim->claim_amount ?? '0.00') ?>"
                       class="w-full border p-2 rounded"
                       placeholder="0.00" required>

            </div>

            <div class="col-span-2">

                <label class="font-medium">
                    Incident Description
                </label>

                <textarea name="incident_description"
                          rows="4"
                          class="w-full border p-2 rounded"
                          placeholder="Describe the incident or loss"><?= htmlspecialchars($claim->incident_description ?? '') ?></textarea>

            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Claim Assessment & Status
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>

                <label class="font-medium">
                    Claim Status <span class="text-red-500">*</span>
                </label>

                <select name="claim_status"
                    id="claim_status"
                    required
                    class="w-full border p-2 rounded">

                    <?php
                    $statuses = array(
                        'Submitted',
                        'Under Review',
                        'Documents Required',
                        'Under Assessment',
                        'Approved',
                        'Partially Approved',
                        'Rejected',
                        'Settled',
                        'Closed'
                    );

                    foreach ($statuses as $status) {
                    ?>

                        <option value="<?= $status ?>"
                            <?= ($claim->claim_status == $status)
                                ? 'selected'
                                : '' ?>>

                            <?= $status ?>

                        </option>

                    <?php } ?>

                </select>

            </div>

            <div>

                <label class="font-medium">
                    Approved Amount
                </label>

                <input type="number"
                       step="0.01"
                       min="0"
                       name="approved_amount"
                       value="<?= htmlspecialchars($claim->approved_amount ?? '0.00') ?>"
                       class="w-full border p-2 rounded"
                       placeholder="0.00">

            </div>

            <div>

                <label class="font-medium">
                    Deducted / Rejected Amount
                </label>

                <input type="number"
                       step="0.01"
                       min="0"
                       name="deducted_amount"
                       value="<?= htmlspecialchars($claim->deducted_amount ?? '0.00') ?>"
                       class="w-full border p-2 rounded bg-gray-100"
                       placeholder="0.00" readonly>

            </div>

            <div class="col-span-2">

                <label class="font-medium">
                    Action Taken
                </label>

                <textarea name="action_taken"
                          rows="3"
                          class="w-full border p-2 rounded"
                          placeholder="Enter action taken"><?= htmlspecialchars($claim->action_taken ?? '') ?></textarea>

            </div>

            <div class="col-span-2">

                <label class="font-medium">
                    Rejection Reason
                </label>

                <textarea name="rejection_reason"
                          rows="3"
                          class="w-full border p-2 rounded"
                          placeholder="Enter rejection reason if applicable"><?= htmlspecialchars($claim->rejection_reason ?? '') ?></textarea>

            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Claim Details
        </h3>

        <div>

            <label class="font-medium">
                Remarks
            </label>

            <textarea name="remarks"
                      rows="4"
                      class="w-full border p-2 rounded"
                      placeholder="Enter claim remarks"><?= htmlspecialchars($claim->remarks ?? '') ?></textarea>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Existing Documents
        </h3>

        <?php if (!empty($claim_documents)) { ?>

            <div class="space-y-3">

                <?php foreach ($claim_documents as $document) { ?>

                    <div class="flex items-center justify-between border p-3 rounded bg-gray-50">

                        <div>

                            <div class="font-medium">
                                <?= htmlspecialchars($document->document_name) ?>
                            </div>

                            <div class="text-sm text-gray-500">
                                <?= htmlspecialchars($document->document_type) ?>
                            </div>

                        </div>

                        <div class="flex gap-2">

                            <a href="<?= base_url($document->document_path) ?>"
                               target="_blank"
                               class="px-3 py-2 bg-blue-600 text-white rounded">

                                View

                            </a>

                            <a href="<?= base_url(
                                'index.php/insuranceclaim/delete_claim_document/'
                                . $document->doc_id
                                . '/'
                                . $claim->claim_id
                            ) ?>"
                               onclick="return confirm('Are you sure you want to delete this document?');"
                               class="px-3 py-2 bg-red-600 text-white rounded">

                                Delete

                            </a>

                        </div>

                    </div>

                <?php } ?>

            </div>

        <?php } else { ?>

            <p class="text-gray-500">
                No documents uploaded.
            </p>

        <?php } ?>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Add New Supporting Documents
        </h3>

        <div id="document-container">

            <div class="document-row grid grid-cols-3 gap-4 mb-4">

                <div>

                    <label class="font-medium">
                        Document Type
                    </label>

                    <select name="document_type[]"
                            class="w-full border p-2 rounded">

                        <option value="">
                            Select Document Type
                        </option>

                        <option value="Claim Form">
                            Claim Form
                        </option>

                        <option value="Police Report">
                            Police Report
                        </option>

                        <option value="Assessment Report">
                            Assessment Report
                        </option>

                        <option value="Medical Report">
                            Medical Report
                        </option>

                        <option value="Damage Photos">
                            Damage Photos
                        </option>

                        <option value="Supporting Document">
                            Supporting Document
                        </option>

                        <option value="Other">
                            Other
                        </option>

                    </select>

                </div>

                <div>

                    <label class="font-medium">
                        Document Name
                    </label>

                    <input type="text"
                           name="document_name[]"
                           class="w-full border p-2 rounded"
                           placeholder="Document name">

                </div>

                <div>

                    <label class="font-medium">
                        Upload Document
                    </label>

                    <input type="file"
                           name="document_file[]"
                           class="w-full border p-2 rounded"
                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">

                </div>

            </div>

        </div>

        <button type="button"
                onclick="addDocument()"
                class="px-4 py-2 bg-green-600 text-white rounded mb-6">

            + Add Document

        </button>

        <div class="mt-4">

            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded">

                Update Claim

            </button>

            <a href="<?= base_url('index.php/insuranceclaim/claims'); ?>"
               class="ml-3 px-6 py-2 bg-gray-300 rounded">

                Cancel

            </a>

        </div>

    </form>

</div>

<script>

function addDocument()
{
    let container =
        document.getElementById('document-container');

    let row =
        document.createElement('div');

    row.className =
        'document-row grid grid-cols-3 gap-4 mb-4';

    row.innerHTML = `

        <div>

            <label class="font-medium">
                Document Type
            </label>

            <select name="document_type[]"
                    class="w-full border p-2 rounded">

                <option value="">
                    Select Document Type
                </option>

                <option value="Claim Form">
                    Claim Form
                </option>

                <option value="Police Report">
                    Police Report
                </option>

                <option value="Assessment Report">
                    Assessment Report
                </option>

                <option value="Medical Report">
                    Medical Report
                </option>

                <option value="Damage Photos">
                    Damage Photos
                </option>

                <option value="Supporting Document">
                    Supporting Document
                </option>

                <option value="Other">
                    Other
                </option>

            </select>

        </div>

        <div>

            <label class="font-medium">
                Document Name
            </label>

            <input type="text"
                   name="document_name[]"
                   class="w-full border p-2 rounded"
                   placeholder="Document name">

        </div>

        <div class="flex items-end gap-2">

            <input type="file"
                   name="document_file[]"
                   class="w-full border p-2 rounded"
                   accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">

            <button type="button"
                    onclick="this.closest('.document-row').remove()"
                    class="px-3 py-2 bg-red-600 text-white rounded">

                Remove

            </button>

        </div>

    `;

    container.appendChild(row);
}

function calculateDeductedAmount() {

    var claimAmount = parseFloat($('input[name="claim_amount"]').val()) || 0;
    var approvedAmount = parseFloat($('input[name="approved_amount"]').val()) || 0;

    var deductedAmount = claimAmount - approvedAmount;

    if (deductedAmount < 0) {
        deductedAmount = 0;
    }

    $('input[name="deducted_amount"]').val(deductedAmount.toFixed(2));
}

$(document).ready(function () {

    $('#policy_id').change(function () {

        var policy_id = $(this).val();

        if (policy_id === '') {

            $('#coverage_amount').val('');
            $('#insurance_company_name').val('');
            $('#policy_type_name').val('');
            $('#customer_name').val('');

            return;
        }

        $.ajax({

            url:'<?= base_url("index.php/insuranceclaim/get_policy_for_claim") ?>',
            type: 'POST',
            data: {
                policy_id: policy_id
            },
            dataType: 'json',

            success: function (response) {

                if (response) {

                    $('#coverage_amount')
                        .val(response.coverage_amount);

                    $('#insurance_company_name')
                        .val(response.company_name);

                    $('#policy_type_name')
                        .val(response.policy_type_name);

                    $('#customer_name')
                        .val(response.customer_name);

                }

            },

            error: function (xhr, status, error) {

                console.log(xhr.responseText);
                console.log(status);
                console.log(error);

            }

        });

    });

    $('input[name="claim_amount"], input[name="approved_amount"]')
    .on('input', function () {
        calculateDeductedAmount();
    });

});

</script>