<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-4">
        <?= htmlspecialchars($title) ?>
    </h2>

    <?php if (validation_errors()) { ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <?= validation_errors(); ?>
        </div>
    <?php } ?>

    <form method="POST"
        enctype="multipart/form-data"
        action="<?= base_url('index.php/insuranceclaim/add_claim'); ?>">

        <h3 class="text-lg font-semibold mb-4 border-b pb-2">
            Policy Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-2">

                <label class="font-medium">
                    Existing Policy <span class="text-red-500">*</span>
                </label>

                <select name="policy_id"
                        id="policy_id"
                        required
                        class="w-full border p-2 rounded">

                    <option value="">Select Policy</option>

                    <?php if (!empty($policies)) {
                        foreach ($policies as $policy) { ?>

                            <option value="<?= $policy->policy_id ?>">
                                <?= htmlspecialchars($policy->policy_number) ?>
                            </option>

                    <?php }
                    } ?>

                </select>

            </div>

            <div>
                <label class="font-medium">
                    Insurance Company
                </label>

                <input type="text"
                    id="insurance_company_name"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    Policy Type
                </label>

                <input type="text"
                    id="policy_type_name"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    Insured Vehicle
                </label>

                <input type="text"
                    id="vehicle_name"
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
                    value="<?= !empty($claim_number) ? htmlspecialchars($claim_number) : '' ?>"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    Claim Date <span class="text-red-500">*</span>
                </label>

                <input type="date"
                    name="claim_date"
                    value="<?= date('Y-m-d') ?>"
                    required
                    class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-medium">
                    Incident / Loss Date
                </label>

                <input type="date"
                    name="incident_date"
                    class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-medium">
                    Claim Type <span class="text-red-500">*</span>
                </label>

                <select name="claim_type"
                        required
                        class="w-full border p-2 rounded">

                    <option value="">Select Claim Type</option>

                    <option value="Accident">Accident / Collision</option>
                    <option value="Own Damage">Own Damage</option>
                    <option value="Third Party Property Damage">
                        Third Party Property Damage
                    </option>
                    <option value="Third Party Bodily Injury">
                        Third Party Bodily Injury
                    </option>
                    <option value="Theft">Theft</option>
                    <option value="Fire">Fire</option>
                    <option value="Natural Perils">
                        Natural Perils / Weather Damage
                    </option>
                    <option value="Glass Damage">Glass Damage</option>
                    <option value="Vandalism">Vandalism</option>
                    <option value="Total Loss">Total Loss</option>
                    <option value="Personal Injury">
                        Personal Injury
                    </option>
                    <option value="Other">Other</option>

                </select>
            </div>

            <div>
                <label class="font-medium">
                    Claim Reason
                </label>

                <input type="text"
                    name="claim_reason"
                    class="w-full border p-2 rounded"
                    placeholder="Enter claim reason">
            </div>

            <div>
                <label class="font-medium">
                    Claim Amount
                </label>

                <input type="number"
                    step="0.01"
                    name="claim_amount"
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
                        placeholder="Describe the incident or loss"></textarea>

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

                    <option value="Submitted">Submitted</option>
                    <option value="Under Review">Under Review</option>
                    <option value="Documents Required">Documents Required</option>
                    <option value="Under Assessment">Under Assessment</option>
                    <option value="Approved">Approved</option>
                    <option value="Partially Approved">Partially Approved</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Settled">Settled</option>
                    <option value="Closed">Closed</option>

                </select>

            </div>

            <div>
                <label class="font-medium">
                    Approved Amount
                </label>

                <input type="number" 
                    step="0.01"
                    name="approved_amount"
                    id="approved_amount"
                    class="w-full border p-2 rounded"
                    placeholder="0.00">
            </div>

            <div>
                <label class="font-medium">
                    Deducted / Rejected Amount
                </label>

                <input type="number" 
                    step="0.01"
                    name="deducted_amount"
                    id="deducted_amount"
                    class="w-full border p-2 rounded bg-gray-100"
                    placeholder="0.00"
                    readonly>
            </div>

            <div class="col-span-2">
                <label class="font-medium">
                    Action Taken
                </label>

                <textarea name="action_taken"
                        rows="3"
                        class="w-full border p-2 rounded"
                        placeholder="Enter action taken"></textarea>
            </div>

            <div class="col-span-2">

                <label class="font-medium">
                    Rejection Reason
                </label>

                <textarea name="rejection_reason"
                        rows="3"
                        class="w-full border p-2 rounded"
                        placeholder="Enter rejection reason if applicable"></textarea>

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
                    placeholder="Enter claim remarks"></textarea>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Supporting Documents
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
                Save Claim
            </button>

            <a href="<?= base_url('index.php/insuranceclaim/claims'); ?>"
            class="ml-3 px-6 py-2 bg-gray-300 rounded">
                Cancel
            </a>

        </div>

    </form>

</div>

<script>

function addDocument() {

    let container = document.getElementById('document-container');
    let row = document.createElement('div');

    row.className = 'document-row grid grid-cols-3 gap-4 mb-4';

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
            $('#vehicle_name').val('');

            return;
        }

        $.ajax({

            url: '<?= base_url("index.php/insuranceclaim/get_policy_for_claim") ?>',
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

                    $('#vehicle_name').val(
                        response.vehicle_brand + ' - ' + response.registration_no
                    );

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
