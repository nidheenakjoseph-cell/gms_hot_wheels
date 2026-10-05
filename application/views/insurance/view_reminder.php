<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-2xl font-bold">
                <?= htmlspecialchars($title) ?>
            </h2>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Reminder Information
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div>

            <label class="text-sm text-gray-500">
                Policy Number
            </label>

            <p class="font-medium">

                <?= htmlspecialchars(
                    $reminder->policy_number ?? '-'
                ) ?>

            </p>

        </div>

        <div>

            <label class="text-sm text-gray-500">
                Reminder Type
            </label>

            <p class="font-medium">

                <?= htmlspecialchars(
                    $reminder->reminder_type ?? '-'
                ) ?>

            </p>

        </div>

        <div>

            <label class="text-sm text-gray-500">
                Due Date
            </label>

            <p class="font-medium">

                <?= !empty($reminder->due_date)
                    ? date(
                        'd-m-Y',
                        strtotime(
                            $reminder->due_date
                        )
                    )
                    : '-' ?>

            </p>

        </div>

        <div>

            <label class="text-sm text-gray-500">
                Reminder Days Before
            </label>

            <p class="font-medium">

                <?= $reminder->reminder_days_before !== null
                    && $reminder->reminder_days_before !== ''
                    ? htmlspecialchars(
                        $reminder->reminder_days_before
                    ) . ' Days'
                    : '-' ?>

            </p>

        </div>

        <?php if (
            isset($reminder->reminder_date)
            && !empty($reminder->reminder_date)
        ) : ?>

            <div>

                <label class="text-sm text-gray-500">
                    Reminder Date
                </label>

                <p class="font-medium">

                    <?= date(
                        'd-m-Y',
                        strtotime(
                            $reminder->reminder_date
                        )
                    ) ?>

                </p>

            </div>

        <?php endif; ?>

        <div>

            <label class="text-sm text-gray-500">
                Status
            </label>

            <?php

            $status =
                $reminder->status ?? '';

            $status_class =
                'bg-gray-100 text-gray-700';

            if ($status == 'Pending') {

                $status_class =
                    'bg-yellow-100 text-yellow-700';

            } elseif ($status == 'Sent') {

                $status_class =
                    'bg-blue-100 text-blue-700';

            } elseif ($status == 'Completed') {

                $status_class =
                    'bg-green-100 text-green-700';

            } elseif ($status == 'Dismissed') {

                $status_class =
                    'bg-gray-200 text-gray-700';

            } elseif ($status == 'Overdue') {

                $status_class =
                    'bg-red-100 text-red-700';

            }

            ?>

            <p>

                <span
                    class="inline-block px-3 py-1
                           rounded-full text-sm
                           <?= $status_class ?>"
                >

                    <?= htmlspecialchars(
                        $status ?: '-'
                    ) ?>

                </span>

            </p>

        </div>

    </div>

    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        Reminder Message
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-8">

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Subject
            </label>

            <p class="font-medium">

                <?= htmlspecialchars(
                    $reminder->subject ?? '-'
                ) ?>

            </p>

        </div>

        <div class="col-span-2">

            <label class="text-sm text-gray-500">
                Message
            </label>

            <div
                class="mt-1 p-3 bg-gray-50 rounded border
                       whitespace-pre-line"
            >

                <?= htmlspecialchars(
                    $reminder->message ?? '-'
                ) ?>

            </div>

        </div>

    </div>

    <div class="mt-8 pt-4 border-t">

        <a
            href="<?= base_url(
                'index.php/insurancereminder/edit/'
                . $reminder->reminder_id
            ); ?>"
            class="px-6 py-2 bg-blue-600 text-white
                   rounded hover:bg-blue-700"
        >
            Edit Reminder
        </a>

        <a
            href="<?= base_url(
                'index.php/insurancereminder'
            ); ?>"
            class="ml-3 px-6 py-2 bg-gray-300 rounded
                   hover:bg-gray-400"
        >
            Back to Reminders
        </a>

    </div>

</div>
