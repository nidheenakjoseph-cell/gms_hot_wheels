<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>

<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold">
                <?= htmlspecialchars($title) ?>
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Insurance reports and management information
            </p>
        </div>

        <button
            type="button"
            onclick="printActiveReport()"
            class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">
            Print
        </button>

    </div>

    <div class="border-b border-gray-200 mb-6 overflow-x-auto">

        <div class="flex gap-1 min-w-max">

            <button
                type="button"
                class="report-tab active"
                data-tab="policies">
                Policies
            </button>

            <button
                type="button"
                class="report-tab"
                data-tab="renewals">
                Upcoming Renewals
            </button>

            <button
                type="button"
                class="report-tab"
                data-tab="claims">
                Claims
            </button>

            <button
                type="button"
                class="report-tab"
                data-tab="payments">
                Payments
            </button>

        </div>

    </div>

    <div id="tab-policies" class="report-content">

        <div class="mb-4">
            <h3 class="text-lg font-semibold">
                Policy Report
            </h3>

            <p class="text-sm text-gray-500">
                All insurance policies
            </p>
        </div>

        <div class="overflow-x-auto">

            <table id="policyReportTable"
                   class="display w-full">

                <thead>
                    <tr>
                        <th>Policy No.</th>
                        <th>Insured Vehicle</th>
                        <th>Customer / Policyholder</th>
                        <th>Insurance Company</th>
                        <th>Policy Type</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($policies)) : ?>

                        <?php foreach ($policies as $row) : ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars(
                                        $row->policy_number ?? '-'
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        ($row->brand ?? '-') . ' - ' . ($row->registration_no ?? '-')
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row->name ?? '-') ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $row->company_name ?? '-'
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $row->policy_type_name ?? '-'
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $row->policy_status ?? '-'
                                    ) ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <div id="tab-renewals"
         class="report-content hidden">

        <div class="mb-4 flex justify-between items-center">

            <div>
                <h3 class="text-lg font-semibold">
                    Upcoming Renewals
                </h3>

                <p class="text-sm text-gray-500">
                    Policies expiring within the next 30 days
                </p>
            </div>

        </div>

        <div class="overflow-x-auto">

            <table id="renewalTable"
                   class="display w-full">

                <thead>
                    <tr>
                        <th>Policy No.</th>
                        <th>Insured Vehicle</th>
                        <th>Customer / Policyholder</th>
                        <th>Company</th>
                        <th>Start Date</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($upcoming_renewals as $row) : ?>

                        <tr>

                            <td><?= htmlspecialchars($row->policy_number ?? '-') ?></td>

                            <td>
                                <?= htmlspecialchars(
                                    ($row->brand ?? '-') . ' - ' . ($row->registration_no ?? '-')
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row->name ?? '-') ?>
                            </td>

                            <td><?= htmlspecialchars($row->company_name ?? '-') ?></td>

                            <td>
                                <?= !empty($row->start_date)
                                    ? date('d-m-Y', strtotime($row->start_date))
                                    : '-' ?>
                            </td>

                            <td>
                                <?= !empty($row->expiry_date)
                                    ? date('d-m-Y', strtotime($row->expiry_date))
                                    : '-' ?>
                            </td>

                            <td><?= htmlspecialchars($row->policy_status ?? '-') ?></td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

    <div id="tab-claims"
         class="report-content hidden">

        <div class="mb-4">
            <h3 class="text-lg font-semibold">
                Claims Report
            </h3>

            <p class="text-sm text-gray-500">
                All insurance claims
            </p>
        </div>

        <div class="overflow-x-auto">

            <table id="claimsReportTable"
                   class="display w-full">

                <thead>
                    <tr>
                        <th>Claim No.</th>
                        <th>Policy No.</th>
                        <th>Insured Vehicle</th>
                        <th>Customer / Policyholder</th>
                        <th>Company</th>
                        <th>Claim Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($claims as $row) : ?>

                        <tr>

                            <td><?= htmlspecialchars($row->claim_number ?? '-') ?></td>

                            <td><?= htmlspecialchars($row->policy_number ?? '-') ?></td>

                            <td>
                                <?= htmlspecialchars(
                                    ($row->brand ?? '-') . ' - ' . ($row->registration_no ?? '-')
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row->name ?? '-') ?>
                            </td>

                            <td><?= htmlspecialchars($row->company_name ?? '-') ?></td>

                            <td>
                                <?= number_format(
                                    (float)($row->claim_amount ?? 0),
                                    2
                                ) ?>
                            </td>

                            <td><?= htmlspecialchars($row->claim_status ?? '-') ?></td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

    <div id="tab-payments"
         class="report-content hidden">

        <div class="mb-4">

            <h3 class="text-lg font-semibold">
                Premium & Payment Report
            </h3>

            <p class="text-sm text-gray-500">
                Insurance premium payment history
            </p>

        </div>

        <div class="overflow-x-auto">

            <table id="paymentReportTable"
                   class="display w-full">

                <thead>
                    <tr>
                        <th>Policy No.</th>
                        <th>Policy Term</th>
                        <th>Installment Number</th>
                        <th>Total Premium</th>
                        <th>Paid Amount</th>
                        <th>Balance Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($payments as $row) : ?>

                        <tr>

                            <td><?= htmlspecialchars($row->policy_number ?? '-') ?></td>

                            <td><?= htmlspecialchars($row->policy_term_name ?? '-') ?></td>

                            <td><?= htmlspecialchars($row->installment_number ?? '-') ?></td>

                            <td>
                                <?= number_format(
                                    (float)($row->total_premium ?? 0),
                                    2
                                ) ?>
                            </td>

                            <td>
                                <?= number_format(
                                    (float)($row->paid_amount ?? 0),
                                    2
                                ) ?>
                            </td>

                            <td>
                                <?= number_format(
                                    (float)($row->balance_amount ?? 0),
                                    2
                                ) ?>
                            </td>

                            <td><?= htmlspecialchars($row->payment_status ?? '-') ?></td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<style>

.report-tab {
    padding: 10px 18px;
    font-size: 14px;
    font-weight: 500;
    color: #6b7280;
    border-bottom: 2px solid transparent;
    white-space: nowrap;
}

.report-tab:hover {
    color: #111827;
}

.report-tab.active {
    color: #111827;
    border-bottom-color: #111827;
}

</style>

<script>

$(document).ready(function () {

    $('#policyReportTable').DataTable({
        pageLength: 25,
        order: [[4, 'desc']]
    });

    $('#expiredPoliciesTable').DataTable({
        pageLength: 25,
        order: [[4, 'desc']]
    });

    $('#renewalTable').DataTable({
        pageLength: 25,
        order: [[4, 'asc']]
    });

    $('#claimsReportTable').DataTable({
        pageLength: 25,
        order: [[4, 'desc']]
    });

    $('#pendingClaimsTable').DataTable({
        pageLength: 25,
        order: [[3, 'asc']]
    });

    $('#settlementReportTable').DataTable({
        pageLength: 25,
        order: [[8, 'desc']]
    });

    $('#paymentReportTable').DataTable({
        pageLength: 25,
        order: [[3, 'asc']]
    });

    $('#outstandingPaymentTable').DataTable({
        pageLength: 25,
        order: [[2, 'asc']]
    });

    $('.report-tab').on('click', function (e) {

        e.preventDefault();

        var tab = $(this).attr('data-tab');

        console.log('Clicked tab:', tab);

        $('.report-tab').removeClass('active');

        $(this).addClass('active');

        $('.report-content').addClass('hidden');

        $('#tab-' + tab).removeClass('hidden');

        var table = $('#tab-' + tab).find('table').DataTable();

        if (table) {
            table.columns.adjust();
        }
    });

});

function printActiveReport()
{
    var activeTab = $('.report-content:not(.hidden)').attr('id');

    var reportType = '';

    if (activeTab === 'tab-policies') {
        reportType = 'policies';
    }
    else if (activeTab === 'tab-renewals') {
        reportType = 'renewals';
    }
    else if (activeTab === 'tab-claims') {
        reportType = 'claims';
    }
    else if (activeTab === 'tab-payments') {
        reportType = 'payments';
    }
    else {
        alert('Invalid report selected.');
        return;
    }

    $.ajax({
        url: "<?= base_url('index.php/insurancereport/print_report') ?>",
        type: "POST",
        data: {
            report_type: reportType
        },
        dataType: "html",

        success: function(response) {

            var printWindow = window.open(
                '',
                '_blank'
            );

            printWindow.document.open();

            printWindow.document.write(response);

            printWindow.document.close();

            printWindow.focus();

            setTimeout(function() {
                printWindow.print();
            }, 500);
        },

        error: function(xhr, status, error) {

            console.log(xhr.responseText);

            alert(
                'Unable to generate the print report.'
            );
        }
    });
}
</script>

