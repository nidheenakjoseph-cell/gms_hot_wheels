<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-4">
        <?= htmlspecialchars($title) ?>
    </h2>

    <?php if ($this->session->flashdata('error')) { ?>

        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">

            <?= htmlspecialchars(
                $this->session->flashdata('error')
            ) ?>

        </div>

    <?php } ?>

    <?php if (validation_errors()) { ?>

        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">

            <?= validation_errors(); ?>

        </div>

    <?php } ?>

    <form
        method="POST"
        enctype="multipart/form-data"
        action="<?= base_url(
            'index.php/insuranceclaimsettlement/edit_settlement/'
            . $settlement->settlement_id
        ); ?>"
    >
        <input
            type="hidden"
            name="settlement_id"
            value="<?= $settlement->settlement_id ?>"
        >

        <h3 class="text-lg font-semibold mb-4 border-b pb-2">
            Claim Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>

                <label class="font-medium">
                    Claim Number
                </label>

                <input
                    type="text"
                    id="claim_number"
                    value="<?= htmlspecialchars(
                        $settlement->claim_number ?? ''
                    ) ?>"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100"
                >

                <input
                    type="hidden"
                    id="claim_id"
                    name="claim_id"
                    value="<?= htmlspecialchars(
                        $settlement->claim_id ?? ''
                    ) ?>"
                >

            </div>

            <div>

                <label class="font-medium">
                    Claim Date
                </label>

                <input
                    type="text"
                    id="claim_date"
                    value="<?= !empty(
                        $settlement->claim_date
                    )
                        ? date(
                            'd-m-Y',
                            strtotime(
                                $settlement->claim_date
                            )
                        )
                        : '' ?>"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100"
                >

            </div>

            <div>

                <label class="font-medium">
                    Policy Number
                </label>

                <input
                    type="text"
                    id="policy_number"
                    value="<?= htmlspecialchars(
                        $settlement->policy_number ?? ''
                    ) ?>"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100"
                >

            </div>

            <div>

                <label class="font-medium">
                    Insurance Company
                </label>

                <input
                    type="text"
                    id="insurance_company_name"
                    value="<?= htmlspecialchars(
                        $settlement->company_name ?? ''
                    ) ?>"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100"
                >

            </div>

            <div>

                <label class="font-medium">
                    Policy Type
                </label>

                <input
                    type="text"
                    id="policy_type_name"
                    value="<?= htmlspecialchars(
                        $settlement->policy_type_name ?? ''
                    ) ?>"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100"
                >

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

                <input
                    type="text"
                    name="settlement_reference"
                    value="<?= htmlspecialchars(
                        $settlement->settlement_reference ?? ''
                    ) ?>"
                    class="w-full border p-2 rounded"
                    placeholder="Settlement reference"
                >

            </div>

            <div>

                <label class="font-medium">
                    Settlement Date
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="date"
                    name="settlement_date"
                    value="<?= htmlspecialchars(
                        $settlement->settlement_date ?? ''
                    ) ?>"
                    required
                    class="w-full border p-2 rounded"
                >

            </div>

            <div>

                <label class="font-medium">
                    Settlement Status
                    <span class="text-red-500">*</span>
                </label>

                <select
                    name="settlement_status"
                    required
                    class="w-full border p-2 rounded"
                >

                    <?php

                    $settlement_statuses = array(
                        'Pending',
                        'Approved for Settlement',
                        'Partially Settled',
                        'Settled',
                        'Cancelled'
                    );

                    foreach (
                        $settlement_statuses
                        as $status
                    ) {

                    ?>

                        <option
                            value="<?= $status ?>"
                            <?= (
                                $settlement->settlement_status
                                == $status
                            )
                                ? 'selected'
                                : '' ?>
                        >

                            <?= $status ?>

                        </option>

                    <?php } ?>

                </select>

            </div>

            <div>

                <label class="font-medium">
                    Settlement Method
                </label>

                <select
                    name="settlement_method"
                    class="w-full border p-2 rounded"
                >

                    <option value="">
                        Select Method
                    </option>

                    <?php

                    $methods = array(
                        'Bank Transfer',
                        'Cheque',
                        'Direct Payment',
                        'Other'
                    );

                    foreach ($methods as $method) {

                    ?>

                        <option
                            value="<?= $method ?>"
                            <?= (
                                $settlement->settlement_method
                                == $method
                            )
                                ? 'selected'
                                : '' ?>
                        >

                            <?= $method ?>

                        </option>

                    <?php } ?>

                </select>

            </div>

            <div>

                <label class="font-medium">
                    Payment Reference
                </label>

                <input
                    type="text"
                    name="payment_reference"
                    value="<?= htmlspecialchars(
                        $settlement->payment_reference ?? ''
                    ) ?>"
                    class="w-full border p-2 rounded"
                    placeholder="Payment reference"
                >

            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Settlement Amount Details
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>

                <label class="font-medium">
                    Claim Amount
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="claim_amount"
                    id="claim_amount"
                    value="<?= htmlspecialchars(
                        $settlement->claim_amount ?? '0.00'
                    ) ?>"
                    class="w-full border p-2 rounded"
                >

            </div>

            <div>

                <label class="font-medium">
                    Approved Amount
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="approved_amount"
                    id="approved_amount"
                    value="<?= htmlspecialchars(
                        $settlement->approved_amount ?? '0.00'
                    ) ?>"
                    class="w-full border p-2 rounded"
                >

            </div>

            <div>

                <label class="font-medium">
                    Deducted Amount
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="deducted_amount"
                    id="deducted_amount"
                    value="<?= htmlspecialchars(
                        $settlement->deducted_amount ?? '0.00'
                    ) ?>"
                    class="w-full border p-2 rounded"
                >

            </div>

            <div>

                <label class="font-medium">
                    Settlement Amount
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="settlement_amount"
                    id="settlement_amount"
                    value="<?= htmlspecialchars(
                        $settlement->settlement_amount ?? '0.00'
                    ) ?>"
                    required
                    class="w-full border p-2 rounded"
                >

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

                <textarea
                    name="settlement_details"
                    rows="4"
                    class="w-full border p-2 rounded"
                    placeholder="Enter settlement details"
                ><?= htmlspecialchars(
                    $settlement->settlement_details ?? ''
                ) ?></textarea>

            </div>

            <div>

                <label class="font-medium">
                    Remarks
                </label>

                <textarea
                    name="remarks"
                    rows="4"
                    class="w-full border p-2 rounded"
                    placeholder="Enter settlement remarks"
                ><?= htmlspecialchars(
                    $settlement->remarks ?? ''
                ) ?></textarea>

            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Existing Settlement Documents
        </h3>

        <?php if (!empty($settlement_documents)) { ?>

            <div class="space-y-3">

                <?php foreach (
                    $settlement_documents
                    as $document
                ) { ?>

                    <div
                        class="flex items-center justify-between border p-3 rounded bg-gray-50"
                    >

                        <div>

                            <div class="font-medium">

                                <?= htmlspecialchars(
                                    $document->document_name
                                ) ?>

                            </div>

                            <div class="text-sm text-gray-500">

                                <?= htmlspecialchars(
                                    $document->document_type
                                ) ?>

                            </div>

                        </div>

                        <div class="flex gap-2">

                            <?php if (
                                !empty(
                                    $document->document_file
                                )
                            ) { ?>

                                <a
                                    href="<?= base_url(
                                        $document->document_file
                                    ) ?>"
                                    target="_blank"
                                    class="px-3 py-2 bg-blue-600 text-white rounded"
                                >
                                    View
                                </a>

                            <?php } ?>

                            <a
                                href="<?= base_url(
                                    'index.php/insuranceclaimsettlement/delete_settlement_document/'
                                    . $document->document_id
                                    . '/'
                                    . $settlement->settlement_id
                                ) ?>"
                                onclick="return confirm(
                                    'Are you sure you want to delete this document?'
                                );"
                                class="px-3 py-2 bg-red-600 text-white rounded"
                            >
                                Delete
                            </a>

                        </div>

                    </div>

                <?php } ?>

            </div>

        <?php } else { ?>

            <p class="text-gray-500">
                No settlement documents uploaded.
            </p>

        <?php } ?>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Add New Settlement Documents
        </h3>

        <div id="document-container">

            <div
                class="document-row grid grid-cols-3 gap-4 mb-4"
            >

                <div>

                    <label class="font-medium">
                        Document Type
                    </label>

                    <select
                        name="document_type[]"
                        class="w-full border p-2 rounded"
                    >

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

                    <input
                        type="text"
                        name="document_name[]"
                        class="w-full border p-2 rounded"
                        placeholder="Document name"
                    >

                </div>

                <div>

                    <label class="font-medium">
                        Upload Document
                    </label>

                    <input
                        type="file"
                        name="document_file[]"
                        class="w-full border p-2 rounded"
                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                    >

                </div>

            </div>

        </div>

        <button
            type="button"
            onclick="addDocument()"
            class="px-4 py-2 bg-green-600 text-white rounded mb-6"
        >
            + Add Document
        </button>

        <div class="mt-4">

            <button
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded"
            >
                Update Settlement
            </button>

            <a
                href="<?= base_url(
                    'index.php/insuranceclaimsettlement/settlements'
                ); ?>"
                class="ml-3 px-6 py-2 bg-gray-300 rounded"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

<script>

function addDocument()
{
    let container =
        document.getElementById(
            'document-container'
        );

    let row =
        document.createElement('div');

    row.className =
        'document-row grid grid-cols-3 gap-4 mb-4';

    row.innerHTML = `

        <div>

            <label class="font-medium">
                Document Type
            </label>

            <select
                name="document_type[]"
                class="w-full border p-2 rounded"
            >

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

            <input
                type="text"
                name="document_name[]"
                class="w-full border p-2 rounded"
                placeholder="Document name"
            >

        </div>

        <div class="flex items-end gap-2">

            <input
                type="file"
                name="document_file[]"
                class="w-full border p-2 rounded"
                accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
            >

            <button
                type="button"
                onclick="this.closest('.document-row').remove()"
                class="px-3 py-2 bg-red-600 text-white rounded"
            >
                Remove
            </button>

        </div>

    `;

    container.appendChild(row);
}

function calculateDeductedAmount()
{
    var claimAmount =
        parseFloat(
            $('#claim_amount').val()
        ) || 0;

    var approvedAmount =
        parseFloat(
            $('#approved_amount').val()
        ) || 0;

    var deductedAmount =
        claimAmount - approvedAmount;

    if (deductedAmount < 0) {
        deductedAmount = 0;
    }

    $('#deducted_amount').val(
        deductedAmount.toFixed(2)
    );
}

$(document).ready(function () {

    $('#approved_amount').on(
        'input',
        function () {
            calculateDeductedAmount();
        }
    );

    $('#claim_id').change(function () {

        var claim_id =
            $(this).val();

        if (claim_id === '') {

            $('#claim_number').val('');
            $('#claim_date').val('');
            $('#policy_number').val('');
            $('#insurance_company_name').val('');
            $('#policy_type_name').val('');
            $('#customer_name').val('');
            $('#claim_amount').val('0.00');

            return;
        }

        $.ajax({

            url:
                '<?= base_url(
                    "index.php/insuranceclaimsettlement/get_claim_for_settlement"
                ) ?>',
            type: 'POST',
            data: {
                claim_id: claim_id
            },
            dataType: 'json',

            success: function (response) {

                console.log(
                    'Claim Settlement Response:',
                    response
                );

                if (
                    response.status === false
                ) {

                    console.log(
                        response.message
                    );

                    return;

                }

                $('#claim_number').val(
                    response.claim_number || ''
                );

                $('#claim_date').val(
                    response.claim_date || ''
                );

                $('#policy_number').val(
                    response.policy_number || ''
                );

                $('#insurance_company_name').val(
                    response.company_name || ''
                );

                $('#policy_type_name').val(
                    response.policy_type_name || ''
                );

                $('#customer_name').val(
                    response.customer_name || ''
                );

                $('#claim_amount').val(
                    parseFloat(
                        response.claim_amount || 0
                    ).toFixed(2)
                );

                $('#approved_amount').val(
                    parseFloat(
                        response.approved_amount || 0
                    ).toFixed(2)
                );

                $('#deducted_amount').val(
                    parseFloat(
                        response.deducted_amount || 0
                    ).toFixed(2)
                );

                $('#settlement_amount').val(
                    parseFloat(
                        response.settlement_amount || 0
                    ).toFixed(2)
                );

            },

            error: function (
                xhr,
                status,
                error
            ) {

                console.log(
                    xhr.responseText
                );

                console.log(status);
                console.log(error);

            }

        });

    });

});

</script>