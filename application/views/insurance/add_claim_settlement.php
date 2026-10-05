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
        action="<?= base_url('index.php/insuranceclaimsettlement/add_settlement'); ?>">

        <h3 class="text-lg font-semibold mb-4 border-b pb-2">
            Claim Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-2">

                <label class="font-medium">
                    Existing Claim <span class="text-red-500">*</span>
                </label>

                <select name="claim_id"
                        id="claim_id"
                        required
                        class="w-full border p-2 rounded">

                    <option value="">
                        Select Claim
                    </option>

                    <?php if (!empty($claims)) {
                        foreach ($claims as $claim) { ?>

                            <option value="<?= $claim->claim_id ?>">
                                <?= htmlspecialchars($claim->claim_number) ?>
                            </option>

                    <?php }
                    } ?>

                </select>

            </div>

            <div>
                <label class="font-medium">
                    Claim Number
                </label>

                <input type="text"
                       id="claim_number"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">

            </div>

            <div>
                <label class="font-medium">
                    Policy Number
                </label>

                <input type="text"
                       id="policy_number"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">

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
                    Customer / Insured
                </label>

                <input type="text"
                       id="customer_name"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">

                <input type="hidden"
                       name="customer_id"
                       id="customer_id">

            </div>

            <div>
                <label class="font-medium">
                    Claim Date
                </label>

                <input type="text"
                       id="claim_date"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">

            </div>

            <div>
                <label class="font-medium">
                    Claim Status
                </label>

                <input type="text"
                       id="claim_status"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">

            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Claim Amount Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="font-medium">
                    Claim Amount
                </label>

                <input type="number"
                       step="0.01"
                       name="claim_amount"
                       id="claim_amount"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100"
                       placeholder="0.00">

            </div>

            <div>
                <label class="font-medium">
                    Approved Amount
                </label>

                <input type="number"
                       step="0.01"
                       name="approved_amount"
                       id="approved_amount"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100"
                       placeholder="0.00">

            </div>

            <div>
                <label class="font-medium">
                    Deducted Amount
                </label>

                <input type="number"
                       step="0.01"
                       name="deducted_amount"
                       id="deducted_amount"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100"
                       placeholder="0.00">

            </div>

            <div>
                <label class="font-medium">
                    Settlement Amount <span class="text-red-500">*</span>
                </label>

                <input type="number"
                       step="0.01"
                       min="0"
                       name="settlement_amount"
                       id="settlement_amount"
                       required
                       class="w-full border p-2 rounded"
                       placeholder="0.00">

            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Settlement Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="font-medium">
                    Settlement Reference
                </label>

                <input type="text"
                       name="settlement_reference"
                       class="w-full border p-2 rounded"
                       placeholder="Enter settlement reference">

            </div>

            <div>
                <label class="font-medium">
                    Settlement Date <span class="text-red-500">*</span>
                </label>

                <input type="date"
                       name="settlement_date"
                       value="<?= date('Y-m-d') ?>"
                       required
                       class="w-full border p-2 rounded">

            </div>

            <div>
                <label class="font-medium">
                    Settlement Status <span class="text-red-500">*</span>
                </label>

                <select name="settlement_status"
                        id="settlement_status"
                        required
                        class="w-full border p-2 rounded">

                    <option value="Pending">
                        Pending
                    </option>

                    <option value="Approved for Settlement">
                        Approved for Settlement
                    </option>

                    <option value="Partially Settled">
                        Partially Settled
                    </option>

                    <option value="Settled">
                        Settled
                    </option>

                    <option value="Cancelled">
                        Cancelled
                    </option>

                </select>

            </div>

            <div>
                <label class="font-medium">
                    Settlement Method
                </label>

                <select name="settlement_method"
                        class="w-full border p-2 rounded">

                    <option value="">
                        Select Method
                    </option>

                    <option value="Bank Transfer">
                        Bank Transfer
                    </option>

                    <option value="Cheque">
                        Cheque
                    </option>

                    <option value="Direct Payment">
                        Direct Payment
                    </option>

                    <option value="Other">
                        Other
                    </option>

                </select>

            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Payment Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="font-medium">
                    Payment Reference
                </label>

                <input type="text"
                       name="payment_reference"
                       class="w-full border p-2 rounded"
                       placeholder="Enter bank/payment reference">

            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Settlement Details
        </h3>

        <div class="grid grid-cols-1 gap-4">

            <div>

                <label class="font-medium">
                    Settlement Details
                </label>

                <textarea name="settlement_details"
                          rows="4"
                          class="w-full border p-2 rounded"
                          placeholder="Enter settlement details"></textarea>

            </div>

            <div>

                <label class="font-medium">
                    Remarks
                </label>

                <textarea name="remarks"
                          rows="4"
                          class="w-full border p-2 rounded"
                          placeholder="Enter settlement remarks"></textarea>

            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Settlement Documents
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

                        <option value="Settlement Letter">
                            Settlement Letter
                        </option>

                        <option value="Payment Proof">
                            Payment Proof
                        </option>

                        <option value="Bank Transfer Proof">
                            Bank Transfer Proof
                        </option>

                        <option value="Cheque Copy">
                            Cheque Copy
                        </option>

                        <option value="Insurer Document">
                            Insurer Document
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

                Save Settlement

            </button>

            <a href="<?= base_url('index.php/insuranceclaimsettlement/settlements'); ?>"
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

                <option value="Settlement Letter">
                    Settlement Letter
                </option>

                <option value="Payment Proof">
                    Payment Proof
                </option>

                <option value="Bank Transfer Proof">
                    Bank Transfer Proof
                </option>

                <option value="Cheque Copy">
                    Cheque Copy
                </option>

                <option value="Insurer Document">
                    Insurer Document
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

$(document).ready(function () {

    $('#claim_id').change(function () {

        var claim_id = $(this).val();

        if (claim_id === '') {

            $('#claim_number').val('');
            $('#policy_number').val('');
            $('#insurance_company_name').val('');
            $('#policy_type_name').val('');
            $('#customer_name').val('');
            $('#customer_id').val('');
            $('#claim_date').val('');
            $('#claim_status').val('');
            $('#claim_amount').val('');
            $('#approved_amount').val('');
            $('#deducted_amount').val('');
            $('#settlement_amount').val('');

            return;
        }

        $.ajax({

            url: '<?= base_url("index.php/insuranceclaimsettlement/get_claim_for_settlement") ?>',
            type: 'POST',
            data: {
                claim_id: claim_id
            },
            dataType: 'json',

            success: function (response) {

                if (response) {

                    $('#claim_number')
                        .val(response.claim_number);

                    $('#policy_number')
                        .val(response.policy_number);

                    $('#insurance_company_name')
                        .val(response.company_name);

                    $('#policy_type_name')
                        .val(response.policy_type_name);

                    $('#customer_name')
                        .val(response.customer_name);

                    $('#customer_id')
                        .val(response.customer_id);

                    $('#claim_date')
                        .val(response.claim_date);

                    $('#claim_status')
                        .val(response.claim_status);

                    $('#claim_amount')
                        .val(response.claim_amount);

                    $('#approved_amount')
                        .val(response.approved_amount);

                    $('#deducted_amount')
                        .val(response.deducted_amount);

                    $('#settlement_amount')
                        .val(response.approved_amount);

                }

            },

            error: function (xhr, status, error) {

                console.log(xhr.responseText);
                console.log(status);
                console.log(error);

            }

        });

    });

});

</script>
