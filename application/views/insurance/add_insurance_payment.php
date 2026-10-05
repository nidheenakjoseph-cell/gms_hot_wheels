<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-4">
        <?= htmlspecialchars($title) ?>
    </h2>

    <?php if (validation_errors()) { ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <?= validation_errors(); ?>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('error')) { ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <?= htmlspecialchars($this->session->flashdata('error')); ?>
        </div>
    <?php } ?>

    <form method="POST"
          enctype="multipart/form-data"
          action="<?= base_url('index.php/insurancepayment/add_payment'); ?>">

        <h3 class="text-lg font-semibold mb-4 border-b pb-2">
            Payment Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="font-medium">
                    Insurance Policy <span class="text-red-500">*</span>
                </label>

                <select name="policy_id"
                        id="policy_id"
                        required
                        class="w-full border p-2 rounded">

                    <option value="">
                        Select Insurance Policy
                    </option>

                    <?php if (!empty($policies)) {
                        foreach ($policies as $policy) { ?>

                            <option value="<?= $policy->policy_id ?>"
                                <?= set_select(
                                    'policy_id',
                                    $policy->policy_id
                                ); ?>>

                                <?= htmlspecialchars(
                                    $policy->policy_number
                                ); ?>

                            </option>

                    <?php }
                    } ?>

                </select>

                <?php if (form_error('policy_id')) { ?>
                    <small class="text-red-500">
                        <?= form_error('policy_id'); ?>
                    </small>
                <?php } ?>

            </div>

            <div>

                <label class="font-medium">
                    Policy Term
                </label>

                <input type="text"
                    name="policy_term_name"
                    id="policy_term_name"
                    value="<?= set_value('policy_term_name'); ?>"
                    class="w-full border p-2 rounded bg-gray-100"
                    placeholder="Policy Term"
                    readonly>

            </div>

            <div>
                <label class="font-medium">
                    Installment Number
                </label>

                <input type="number"
                    name="installment_number"
                    id="installment_number"
                    min="1"
                    value="<?= set_value('installment_number'); ?>"
                    class="w-full border p-2 rounded bg-gray-100"
                    placeholder="1" required readonly>

            </div>

            <div>
                <label class="font-medium">
                    Total Premium
                </label>

                <input type="number"
                    step="0.01"
                    name="total_premium"
                    id="total_premium"
                    value="<?= set_value('total_premium'); ?>"
                    class="w-full border p-2 rounded bg-gray-100"
                    placeholder="0.00"
                    readonly>

            </div>

            <div>
                <label class="font-medium">
                    Amount Paid <span class="text-red-500">*</span>
                </label>

                <input type="number"
                    step="0.01"
                    min="0"
                    name="amount_paid"
                    id="amount_paid"
                    value="<?= set_value('amount_paid'); ?>"
                    class="w-full border p-2 rounded"
                    placeholder="0.00"
                    required>

            </div>

            <div>
                <label class="font-medium">
                    Balance Amount
                </label>

                <input type="number"
                    step="0.01"
                    name="balance_amount"
                    id="balance_amount"
                    value="<?= set_value('balance_amount'); ?>"
                    class="w-full border p-2 rounded bg-gray-100"
                    placeholder="0.00"
                    readonly>

            </div>

            <div>
                <label class="font-medium">
                    Payment Date
                </label>

                <input type="date"
                       name="payment_date"
                       value="<?= set_value('payment_date'); ?>"
                       class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="font-medium">
                    Due Date
                </label>

                <input type="date"
                       name="due_date"
                       value="<?= set_value('due_date'); ?>"
                       class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="font-medium">
                    Payment Status <span class="text-red-500">*</span>
                </label>

                <select name="payment_status"
                        required
                        class="w-full border p-2 rounded">

                    <option value="Pending"
                        <?= set_select(
                            'payment_status',
                            'Pending',
                            TRUE
                        ); ?>>
                        Pending
                    </option>

                    <option value="Partially Paid"
                        <?= set_select(
                            'payment_status',
                            'Partially Paid'
                        ); ?>>
                        Partially Paid
                    </option>

                    <option value="Paid"
                        <?= set_select(
                            'payment_status',
                            'Paid'
                        ); ?>>
                        Paid
                    </option>

                    <option value="Overdue"
                        <?= set_select(
                            'payment_status',
                            'Overdue'
                        ); ?>>
                        Overdue
                    </option>

                </select>

            </div>

            <div>
                <label class="font-medium">
                    Payment Method
                </label>

                <select name="payment_method"
                        class="w-full border p-2 rounded" required>

                    <option value="">
                        Select Payment Method
                    </option>

                    <option value="Bank Transfer"
                        <?= set_select(
                            'payment_method',
                            'Bank Transfer'
                        ); ?>>
                        Bank Transfer
                    </option>

                    <option value="Cheque"
                        <?= set_select(
                            'payment_method',
                            'Cheque'
                        ); ?>>
                        Cheque
                    </option>

                    <option value="Direct Payment"
                        <?= set_select(
                            'payment_method',
                            'Direct Payment'
                        ); ?>>
                        Direct Payment
                    </option>

                    <option value="Other"
                        <?= set_select(
                            'payment_method',
                            'Other'
                        ); ?>>
                        Other
                    </option>

                </select>
            </div>

            <div>
                <label class="font-medium">
                    Payment Reference
                </label>

                <input type="text"
                       name="payment_reference"
                       value="<?= set_value('payment_reference'); ?>"
                       class="w-full border p-2 rounded"
                       placeholder="Transaction / cheque / receipt reference">
            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Payment Document
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="font-medium">
                    Payment Receipt
                </label>

                <input type="file"
                       name="payment_receipt"
                       accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-medium">
                    Remarks
                </label>

                <textarea name="remarks"
                          rows="3"
                          class="w-full border p-2 rounded"
                          placeholder="Enter additional remarks"><?= set_value('remarks'); ?></textarea>
            </div>

        </div>

        <div class="mt-6">

            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded">
                Save Payment
            </button>

            <a href="<?= base_url('index.php/insurancepayment/payments'); ?>"
               class="ml-3 px-6 py-2 bg-gray-300 rounded">
                Cancel
            </a>

        </div>

    </form>

</div>

<script>

$(document).ready(function () {

    $('#policy_id').on('change', function () {

        var policy_id = $(this).val();

        $('#policy_term_name').val('');
        $('#total_premium').val('');
        $('#balance_amount').val('');

        if (policy_id === '') {
            return;
        }

        $.ajax({

            url: "<?= base_url('index.php/insurancepayment/get_policy_details'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                policy_id: policy_id
            },

            success: function (response) {

                if (response.status === true) {

                    $('#policy_term_name').val(
                        response.policy_term_name
                    );

                    $('#total_premium').val(
                        parseFloat(
                            response.total_premium
                        ).toFixed(2)
                    );

                    $('#installment_number').val(
                        response.installment_number
                    );

                    calculateBalance();

                } else {

                    alert(
                        response.message ||
                        'Unable to load policy details.'
                    );

                }

            },

            error: function () {

                alert(
                    'Unable to load policy details. Please try again.'
                );

            }

        });

    });

    $('#amount_paid').on('input', function () {

        calculateBalance();

    });

    function calculateBalance()
    {

        var totalPremium =
            parseFloat(
                $('#total_premium').val()
            ) || 0;

        var amountPaid =
            parseFloat(
                $('#amount_paid').val()
            ) || 0;

        var balance =
            totalPremium - amountPaid;

        if (balance < 0) {
            balance = 0;
        }

        $('#balance_amount').val(
            balance.toFixed(2)
        );

    }

});

</script>
