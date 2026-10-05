<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-6">
        <?= htmlspecialchars($title) ?>
    </h2>

    <?php if (validation_errors()) : ?>

        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">

            <?= validation_errors(); ?>

        </div>

    <?php endif; ?>

    <form method="POST"
          action="<?= base_url(
              'index.php/insurancereminder/edit/'
              . $reminder->reminder_id
          ) ?>">

        <div class="grid grid-cols-2 gap-4">

            <div class="mb-4">

                <label class="block font-medium mb-1">

                    Policy
                    <span class="text-red-500">*</span>

                </label>

                <select name="policy_id"
                        id="policy_id"
                        class="w-full border p-2 rounded
                              bg-gray-100"
                       readonly>

                    <option value="">
                        Select Policy
                    </option>

                    <?php foreach ($policies as $policy) : ?>

                        <option
                            value="<?= $policy->policy_id ?>"
                            <?= (
                                $policy->policy_id ==
                                $reminder->policy_id
                            )
                                ? 'selected'
                                : ''
                            ?>
                        >

                            <?= htmlspecialchars(
                                $policy->policy_number
                            ) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="mb-4">

                <label class="block font-medium mb-1">

                    Reminder Type
                    <span class="text-red-500">*</span>

                </label>

                <select name="reminder_type"
                        id="reminder_type"
                        class="w-full border p-2 rounded"
                        required>

                    <option value="">
                        Select Reminder Type
                    </option>

                    <option
                        value="Policy Expiry"
                        <?= (
                            $reminder->reminder_type ==
                            'Policy Expiry'
                        )
                            ? 'selected'
                            : ''
                        ?>
                    >

                        Policy Expiry

                    </option>

                    <option
                        value="Premium Payment Due"
                        <?= (
                            $reminder->reminder_type ==
                            'Premium Payment Due'
                        )
                            ? 'selected'
                            : ''
                        ?>
                    >

                        Premium Payment Due

                    </option>

                </select>

            </div>

        </div>

        <div class="grid grid-cols-2 gap-4">

            <div>

                <label class="block font-medium mb-1">
                    Due Date
                </label>

                <input type="date"
                       name="due_date"
                       id="due_date"
                       value="<?= htmlspecialchars(
                           $reminder->due_date ?? ''
                       ) ?>"
                       class="w-full border p-2 rounded
                              bg-gray-100"
                       readonly>

            </div>

            <div>

                <label class="block font-medium mb-1">

                    Reminder Days Before

                </label>

                <input type="number"
                       name="reminder_days_before"
                       min="0"
                       value="<?= htmlspecialchars(
                           $reminder->reminder_days_before ?? ''
                       ) ?>"
                       class="w-full border p-2 rounded"
                       placeholder="Example: 30" required>

            </div>

            <div>

                <label class="block font-medium mb-1">

                    Status

                </label>

                <select name="status"
                        class="w-full border p-2 rounded">

                    <option
                        value="Pending"
                        <?= (
                            ($reminder->status ?? '') ==
                            'Pending'
                        )
                            ? 'selected'
                            : ''
                        ?>
                    >

                        Pending

                    </option>

                    <option
                        value="Sent"
                        <?= (
                            ($reminder->status ?? '') ==
                            'Sent'
                        )
                            ? 'selected'
                            : ''
                        ?>
                    >

                        Sent

                    </option>

                    <option
                        value="Completed"
                        <?= (
                            ($reminder->status ?? '') ==
                            'Completed'
                        )
                            ? 'selected'
                            : ''
                        ?>
                    >

                        Completed

                    </option>

                    <option
                        value="Dismissed"
                        <?= (
                            ($reminder->status ?? '') ==
                            'Dismissed'
                        )
                            ? 'selected'
                            : ''
                        ?>
                    >

                        Dismissed

                    </option>

                    <option
                        value="Overdue"
                        <?= (
                            ($reminder->status ?? '') ==
                            'Overdue'
                        )
                            ? 'selected'
                            : ''
                        ?>
                    >

                        Overdue

                    </option>

                </select>

            </div>

            <div>

                <label class="block font-medium mb-1">

                    Subject

                </label>

                <input type="text"
                       name="subject"
                       maxlength="255"
                       value="<?= htmlspecialchars(
                           $reminder->subject ?? ''
                       ) ?>"
                       class="w-full border p-2 rounded">

            </div>

        </div>

        <div class="mt-4">

            <label class="block font-medium mb-1">

                Message

            </label>

            <textarea
                name="message"
                rows="4"
                class="w-full border p-2 rounded"
                placeholder="Enter reminder message"
            ><?= htmlspecialchars(
                $reminder->message ?? ''
            ) ?></textarea>

        </div>

        <div class="mt-6 flex gap-3">

            <button type="submit"
                    class="px-5 py-2 bg-blue-600
                           text-white rounded-lg
                           hover:bg-blue-700">

                Update Reminder

            </button>

            <a href="<?= base_url(
                'index.php/insurancereminder'
            ) ?>"
               class="px-5 py-2 bg-gray-500
                      text-white rounded-lg
                      hover:bg-gray-600">

                Cancel

            </a>

        </div>

    </form>

</div>

<script>

$(document).ready(function () {

    $('#policy_id, #reminder_type').on(
        'change',
        function () {

            var policy_id =
                $('#policy_id').val();

            var reminder_type =
                $('#reminder_type').val();

            $('#due_date').val('');

            if (
                policy_id === '' ||
                reminder_type === ''
            ) {

                return;

            }

            $.ajax({

                url:
                    "<?= base_url(
                        'index.php/insurancereminder/get_due_date'
                    ); ?>",

                type: "POST",

                dataType: "json",

                data: {

                    policy_id:
                        policy_id,

                    reminder_type:
                        reminder_type

                },

                success: function (response) {

                    if (
                        response.status === true
                    ) {

                        $('#due_date').val(
                            response.due_date
                        );

                    } else {

                        alert(
                            response.message ||
                            'Due date not found.'
                        );

                    }

                },

                error: function () {

                    alert(
                        'Unable to get due date. Please try again.'
                    );

                }

            });

        }

    );


});

</script>