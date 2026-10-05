<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold">
                <?= htmlspecialchars($title) ?>
            </h2>
        </div>
    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Payment Information
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>
            <label class="text-sm text-gray-500">
                Policy Number
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($payment->policy_number ?? '-') ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Policy Term
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($payment->policy_term_name ?? '') ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Installment Number
            </label>

            <p class="font-medium">
                <?= !empty($payment->installment_number)
                    ? htmlspecialchars($payment->installment_number)
                    : '-'; ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Total Premium
            </label>

            <p class="font-medium">
                <?= isset($payment->total_premium)
                    ? number_format((float) $payment->total_premium, 2)
                    : '-'; ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Amount Paid
            </label>

            <p class="font-medium">
                <?= isset($payment->amount_paid)
                    ? number_format((float) $payment->amount_paid, 2)
                    : '-'; ?>
            </p>

        </div>

        <div>
            <label class="text-sm text-gray-500">
                Balance Amount
            </label>

            <p class="font-medium">
                <?= isset($payment->balance_amount)
                    ? number_format((float) $payment->balance_amount, 2)
                    : '-'; ?>
            </p>

        </div>

        <div>
            <label class="text-sm text-gray-500">
                Payment Date
            </label>

            <p class="font-medium">
                <?= !empty($payment->payment_date)
                    ? date('d-m-Y', strtotime($payment->payment_date))
                    : '-'; ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Due Date
            </label>

            <p class="font-medium">
                <?= !empty($payment->due_date)
                    ? date('d-m-Y', strtotime($payment->due_date))
                    : '-'; ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Payment Status
            </label>

            <?php
            $payment_status = $payment->payment_status ?? '';

            $payment_class = 'bg-gray-100 text-gray-700';

            if ($payment_status == 'Paid') {

                $payment_class = 'bg-green-100 text-green-700';

            } elseif ($payment_status == 'Partially Paid') {

                $payment_class = 'bg-yellow-100 text-yellow-700';

            } elseif ($payment_status == 'Pending') {

                $payment_class = 'bg-orange-100 text-orange-700';

            } elseif ($payment_status == 'Overdue') {

                $payment_class = 'bg-red-100 text-red-700';
            }
            ?>

            <p>
                <span class="inline-block px-3 py-1 rounded-full text-sm <?= $payment_class; ?>">
                    <?= htmlspecialchars($payment_status ?: '-') ?>
                </span>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Payment Method
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($payment->payment_method ?? '-') ?>
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">
                Payment Reference
            </label>

            <p class="font-medium">
                <?= htmlspecialchars($payment->payment_reference ?? '-') ?>
            </p>
        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Payment Receipt
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>
            <label class="text-sm text-gray-500">
                Receipt
            </label>
        </div>

        <div class="text-right">

            <?php if (!empty($payment->payment_receipt)) : ?>

                <a
                    href="<?= base_url(
                        'uploads/insurance_payments/' .
                        $payment->payment_receipt
                    ); ?>"
                    target="_blank"
                    class="text-blue-600 hover:underline font-medium"
                >
                    View Receipt
                </a>

            <?php else : ?>

                <span class="font-medium">-</span>

            <?php endif; ?>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Remarks
    </h3>

    <div class="mb-8">

        <div class="p-3 bg-gray-50 rounded border whitespace-pre-line">

            <?= !empty($payment->remarks)
                ? htmlspecialchars($payment->remarks)
                : '-'; ?>

        </div>

    </div>

    <div class="mt-8 pt-4 border-t">

        <a
            href="<?= base_url(
                'index.php/insurancepayment/edit_payment/' .
                $payment->payment_id
            ); ?>"
            class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        >
            Edit Payment
        </a>

        <a
            href="<?= base_url(
                'index.php/insurancepayment/payments'
            ); ?>"
            class="ml-3 px-6 py-2 bg-gray-300 rounded hover:bg-gray-400"
        >
            Back to Payments
        </a>

    </div>

</div>