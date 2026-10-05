<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex items-center justify-between mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                <?= htmlspecialchars($title) ?>
            </h2>
        </div>

    </div>

    <?php if (validation_errors()) : ?>

        <div class="mb-5 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            <?= validation_errors(); ?>
        </div>

    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>

        <div class="mb-5 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            <?= htmlspecialchars($this->session->flashdata('error')); ?>
        </div>

    <?php endif; ?>

    <form method="post"
          action="<?= base_url(
              'index.php/insurancepayment/edit_payment/' .
              $payment->payment_id
          ); ?>"
          enctype="multipart/form-data">

        <div class="mb-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Policy Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Policy Number
                    </label>

                    <input type="text"
                           id="policy_number"
                           value="<?= htmlspecialchars(
                               $payment->policy_number ?? ''
                           ); ?>"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100"
                           readonly>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Policy Term
                    </label>

                    <input type="text"
                           id="company_name"
                           value="<?= htmlspecialchars(
                               $payment->policy_term_name ?? ''
                           ); ?>"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100"
                           readonly>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Installment Number
                    </label>

                    <input type="text"
                           id="customer_name"
                           value="<?= htmlspecialchars(
                               $payment->installment_number ?? ''
                           ); ?>"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100"
                           readonly required>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Total Premium
                    </label>

                    <input type="text"
                        id="total_premium"
                        value="<?= isset($payment->total_premium)
                        ? number_format((float) $payment->total_premium, 2, '.', '')
                        : '0.00'; ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100"
                        readonly>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Balance Amount
                    </label>

                    <input type="text"
                        name="balance_amount"
                        id="balance_amount"
                        value="<?= isset($payment->balance_amount)
                            ? number_format((float) $payment->balance_amount, 2, '.', '')
                            : '0.00'; ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100"
                        readonly>

                </div>

            </div>

        </div>

        <div class="mb-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Payment Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Amount Paid
                    </label>

                    <input type="number"
                        step="0.01"
                        min="0"
                        name="amount_paid"
                        id="amount_paid"
                        value="<?= isset($payment->amount_paid)
                            ? number_format((float) $payment->amount_paid, 2, '.', '')
                            : '0.00'; ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Payment Date
                    </label>

                    <input type="date"
                           name="payment_date"
                           value="<?= htmlspecialchars(
                               $payment->payment_date ?? ''
                           ); ?>"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Due Date
                    </label>

                    <input type="date"
                           name="due_date"
                           value="<?= htmlspecialchars(
                               $payment->due_date ?? ''
                           ); ?>"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Payment Status <span class="text-red-500">*</span>
                    </label>

                    <select name="payment_status"
                            id="payment_status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2"
                            required>

                        <option value="Pending"
                            <?= ($payment->payment_status == 'Pending')
                                ? 'selected'
                                : ''; ?>>
                            Pending
                        </option>

                        <option value="Partially Paid"
                            <?= ($payment->payment_status == 'Partially Paid')
                                ? 'selected'
                                : ''; ?>>
                            Partially Paid
                        </option>

                        <option value="Paid"
                            <?= ($payment->payment_status == 'Paid')
                                ? 'selected'
                                : ''; ?>>
                            Paid
                        </option>

                        <option value="Overdue"
                            <?= ($payment->payment_status == 'Overdue')
                                ? 'selected'
                                : ''; ?>>
                            Overdue
                        </option>

                    </select>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Payment Method
                    </label>

                    <select name="payment_method"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                        <option value="">
                            Select Payment Method
                        </option>

                        <option value="Bank Transfer"
                            <?= ($payment->payment_method == 'Bank Transfer')
                                ? 'selected'
                                : ''; ?>>
                            Bank Transfer
                        </option>

                        <option value="Cheque"
                            <?= ($payment->payment_method == 'Cheque')
                                ? 'selected'
                                : ''; ?>>
                            Cheque
                        </option>

                        <option value="Direct Payment"
                            <?= ($payment->payment_method == 'Direct Payment')
                                ? 'selected'
                                : ''; ?>>
                            Direct Payment
                        </option>

                        <option value="Other"
                            <?= ($payment->payment_method == 'Other')
                                ? 'selected'
                                : ''; ?>>
                            Other
                        </option>

                    </select>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Payment Reference
                    </label>

                    <input type="text"
                           name="payment_reference"
                           value="<?= htmlspecialchars(
                               $payment->payment_reference ?? ''
                           ); ?>"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2"
                           placeholder="Enter payment reference">

                </div>

            </div>

        </div>

        <div class="mb-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Existing Payment Receipt
            </h3>

            <?php if (!empty($payment->payment_receipt)) : ?>

                <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Receipt
                            </p>

                        </div>

                        <div>

                            <a href="<?= base_url(
                                'uploads/insurance_payments/' .
                                $payment->payment_receipt
                            ); ?>"
                               target="_blank"
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                                View Receipt

                            </a>

                        </div>

                    </div>

                </div>

            <?php else : ?>

                <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg text-gray-500">

                    No payment receipt uploaded.

                </div>

            <?php endif; ?>

        </div>

        <div class="mb-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Replace Payment Receipt
            </h3>

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-1">
                    New Payment Receipt
                </label>

                <input type="file"
                       name="payment_receipt"
                       accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">

                <p class="text-xs text-gray-500 mt-2">
                    Leave empty to keep the existing receipt.
                    Allowed files: PDF, JPG, JPEG, PNG, DOC, DOCX.
                    Maximum size: 5 MB.
                </p>

            </div>

        </div>

        <div class="mb-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Remarks
            </h3>

            <textarea name="remarks"
                      rows="4"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2"
                      placeholder="Enter remarks"><?= htmlspecialchars(
                          $payment->remarks ?? ''
                      ); ?></textarea>

        </div>

        <div class="mt-4">

            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">

                Update Payment

            </button>

            <a href="<?= base_url(
                'index.php/insurancepayment/payments'
            ); ?>"
               class="ml-3 px-6 py-2 bg-gray-300 rounded hover:bg-gray-400">

                Cancel

            </a>

        </div>

    </form>

</div>

<script>

$(document).ready(function () {

    function calculateBalance()
    {
        var totalPremium =
            parseFloat(
                String($('#total_premium').val()).replace(/,/g, '')
            ) || 0;

        var amountPaid =
            parseFloat(
                String($('#amount_paid').val()).replace(/,/g, '')
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

    $('#amount_paid').on('input', function () {
        calculateBalance();
    });

    calculateBalance();

});

</script>