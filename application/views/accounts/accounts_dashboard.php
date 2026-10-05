<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="min-h-screen bg-gray-50 relative accounts-dashboard">

    <div class="absolute inset-0
                bg-[url('<?= base_url("public/images/car1.png") ?>')]
                bg-center bg-no-repeat bg-contain
                opacity-5 pointer-events-none">
    </div>

    <div class="relative z-10 p-6">

        <div class="bg-white
                    rounded-2xl
                    shadow-md
                    mb-6
                    overflow-hidden">

            <div class="px-6 py-5">

                <div class="flex flex-col
                            lg:flex-row
                            lg:items-center
                            lg:justify-between
                            gap-5">

                    <div>

                        <p class="text-sm text-gray-500">
                            Accounts Management
                        </p>

                        <h1 class="text-2xl
                                   font-bold
                                   text-gray-800">

                            Accounts Dashboard

                        </h1>

                        <p class="text-sm
                                  text-gray-500
                                  mt-1">

                            Financial performance, income, expenses
                            and outstanding balances overview

                        </p>

                    </div>

                    <div class="flex flex-wrap gap-3">

                        <div class="bg-gray-50
                                    border border-gray-200
                                    rounded-xl
                                    px-4
                                    py-3">

                            <p class="text-xs
                                      text-gray-500
                                      uppercase
                                      font-semibold">

                                Filter Branch

                            </p>

                            <select
                                id="branchFilter"
                                class="mt-1
                                       text-sm
                                       font-semibold
                                       text-gray-800
                                       bg-transparent
                                       border-0
                                       focus:ring-0
                                       focus:outline-none
                                       cursor-pointer">

                                <option value="">
                                    All Branches
                                </option>

                                <?php if (!empty($branches)): ?>

                                    <?php foreach ($branches as $branch): ?>

                                        <option
                                            value="<?= (int)$branch->branch_id; ?>"
                                            <?= (string)$selected_branch_id ===
                                                (string)$branch->branch_id
                                                ? 'selected'
                                                : ''; ?>>

                                            <?= htmlspecialchars(
                                                $branch->branch_name
                                            ); ?>

                                        </option>

                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </select>

                        </div>

                        <div class="bg-gray-50
                                    border border-gray-200
                                    rounded-xl
                                    px-4
                                    py-3">

                            <p class="text-xs
                                      text-gray-500
                                      uppercase
                                      font-semibold">

                                From Date

                            </p>

                            <input
                                type="date"
                                id="fromDate"
                                value="<?= htmlspecialchars(
                                    $selected_from_date ?? ''
                                ); ?>"
                                class="mt-1
                                       text-sm
                                       font-semibold
                                       text-gray-800
                                       bg-transparent
                                       border-0
                                       focus:ring-0
                                       focus:outline-none">

                        </div>

                        <div class="bg-gray-50
                                    border border-gray-200
                                    rounded-xl
                                    px-4
                                    py-3">

                            <p class="text-xs
                                      text-gray-500
                                      uppercase
                                      font-semibold">

                                To Date

                            </p>

                            <input
                                type="date"
                                id="toDate"
                                value="<?= htmlspecialchars(
                                    $selected_to_date ?? ''
                                ); ?>"
                                class="mt-1
                                       text-sm
                                       font-semibold
                                       text-gray-800
                                       bg-transparent
                                       border-0
                                       focus:ring-0
                                       focus:outline-none">

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-3
                    gap-5
                    mb-6">

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        p-5
                        border-l-4
                        border-green-600">

                <div class="flex justify-between">

                    <div>

                        <p class="text-xs
                                  text-gray-500
                                  uppercase
                                  font-semibold">

                            Total Income

                        </p>

                        <h2 class="text-2xl
                                   font-bold
                                   text-green-600
                                   mt-2">

                            AED
                            <?= number_format(
                                $accounts_summary['total_income'] ?? 0,
                                2
                            ); ?>

                        </h2>

                    </div>

                    <div class="text-3xl">
                        💰
                    </div>

                </div>

            </div>

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        p-5
                        border-l-4
                        border-red-600">

                <div class="flex justify-between">

                    <div>

                        <p class="text-xs
                                  text-gray-500
                                  uppercase
                                  font-semibold">

                            Total Expenses

                        </p>

                        <h2 class="text-2xl
                                   font-bold
                                   text-red-600
                                   mt-2">

                            AED
                            <?= number_format(
                                $accounts_summary['total_expense'] ?? 0,
                                2
                            ); ?>

                        </h2>

                    </div>

                    <div class="text-3xl">
                        💸
                    </div>

                </div>

            </div>

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        p-5
                        border-l-4
                        border-blue-600">

                <div class="flex justify-between">

                    <div>

                        <p class="text-xs
                                  text-gray-500
                                  uppercase
                                  font-semibold">

                            Net Profit

                        </p>

                        <h2 class="text-2xl
                                   font-bold
                                   text-blue-600
                                   mt-2">

                            AED
                            <?= number_format(
                                $accounts_summary['net_profit'] ?? 0,
                                2
                            ); ?>

                        </h2>

                    </div>

                    <div class="text-3xl">
                        📈
                    </div>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-4
                    gap-5
                    mb-6">

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    Receivables
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-yellow-600
                           mt-2">

                    AED
                    <?= number_format(
                        $accounts_summary['receivables'] ?? 0,
                        2
                    ); ?>

                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Payments awaiting completion
                </p>

            </div>

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    Payables
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-red-600
                           mt-2">

                    AED
                    <?= number_format(
                        $accounts_summary['payables'] ?? 0,
                        2
                    ); ?>

                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Outstanding supplier balance
                </p>

            </div>

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    Cash Balance
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-gray-800
                           mt-2">

                    AED
                    <?= number_format(
                        $accounts_summary['cash_balance'] ?? 0,
                        2
                    ); ?>

                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Available cash balance
                </p>

            </div>

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    Bank Balance
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-gray-800
                           mt-2">

                    AED
                    <?= number_format(
                        $accounts_summary['bank_balance'] ?? 0,
                        2
                    ); ?>

                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Available bank balance
                </p>

            </div>

        </div>

        <div class="grid grid-cols-1
                    lg:grid-cols-2
                    gap-6
                    mb-6">

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        overflow-hidden">

                <div class="px-6
                            py-4
                            bg-gray-50
                            border-b">

                    <h2 class="text-lg
                               font-semibold
                               text-gray-800">

                        Monthly Cash Flow

                    </h2>

                    <p class="text-sm
                              text-gray-500">

                        Monthly cash inflow and cash outflow

                    </p>

                </div>

                <div class="p-6">

                    <div style="height:350px;">

                        <canvas
                            id="monthlyCashFlowChart">
                        </canvas>

                    </div>

                </div>

            </div>

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        overflow-hidden">

                <div class="px-6
                            py-4
                            bg-gray-50
                            border-b">

                    <h2 class="text-lg
                               font-semibold
                               text-gray-800">

                        Income & Expense Trend

                    </h2>

                    <p class="text-sm
                              text-gray-500">

                        Period-wise financial performance

                    </p>

                </div>

                <div class="p-6">

                    <div style="height:350px;">

                        <canvas
                            id="accountsTrendChart">
                        </canvas>

                    </div>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        overflow-hidden">

                <div class="px-6
                            py-4
                            bg-gray-50
                            border-b">

                    <h2 class="text-lg
                            font-semibold
                            text-gray-800">

                        Outstanding Receivables

                    </h2>

                    <p class="text-sm
                            text-gray-500">

                        Customers with pending balances

                    </p>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-4 py-3 text-left">
                                    #
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Customer
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Invoice
                                </th>

                                <th class="px-4 py-3 text-right">
                                    Outstanding
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($outstanding_receivables)): ?>

                                <?php $i = 1; ?>

                                <?php foreach (
                                    $outstanding_receivables
                                    as $receivable
                                ): ?>

                                    <tr class="border-t
                                            hover:bg-yellow-50">

                                        <td class="px-4 py-3">
                                            <?= $i++; ?>
                                        </td>

                                        <td class="px-4 py-3
                                                font-semibold">

                                            <?= htmlspecialchars(
                                                $receivable->name ?? '-'
                                            ); ?>

                                        </td>

                                        <td class="px-4 py-3">

                                            <?= htmlspecialchars(
                                                $receivable->invoice_no ?? '-'
                                            ); ?>

                                        </td>

                                        <td class="px-4 py-3
                                                text-right
                                                font-bold
                                                text-yellow-600">

                                            AED
                                            <?= number_format(
                                                $receivable->outstanding_amount ?? 0,
                                                2
                                            ); ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="4"
                                        class="px-4
                                            py-8
                                            text-center
                                            text-green-600">

                                        No outstanding receivables.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        overflow-hidden">

                <div class="px-6
                            py-4
                            bg-gray-50
                            border-b">

                    <h2 class="text-lg
                            font-semibold
                            text-gray-800">

                        Outstanding Payables

                    </h2>

                    <p class="text-sm
                            text-gray-500">

                        Suppliers with pending payments

                    </p>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-4 py-3 text-left">
                                    #
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Supplier
                                </th>

                                <th class="px-4 py-3 text-left">
                                    GRN
                                </th>

                                <th class="px-4 py-3 text-right">
                                    Outstanding
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($outstanding_payables)): ?>

                                <?php $i = 1; ?>

                                <?php foreach (
                                    $outstanding_payables
                                    as $payable
                                ): ?>

                                    <tr class="border-t
                                            hover:bg-red-50">

                                        <td class="px-4 py-3">
                                            <?= $i++; ?>
                                        </td>

                                        <td class="px-4 py-3
                                                font-semibold">

                                            <?= htmlspecialchars(
                                                $payable->supplier_name ?? '-'
                                            ); ?>

                                        </td>

                                        <td class="px-4 py-3">

                                            <?= htmlspecialchars(
                                                $payable->grn_code ?? '-'
                                            ); ?>

                                        </td>

                                        <td class="px-4 py-3
                                                text-right
                                                font-bold
                                                text-red-600">

                                            AED
                                            <?= number_format(
                                                $payable->outstanding_amount ?? 0,
                                                2
                                            ); ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="4"
                                        class="px-4
                                            py-8
                                            text-center
                                            text-green-600">

                                        No outstanding payables.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mt-6">

            <div class="bg-white rounded-2xl shadow-md overflow-hidden">

                <div class="px-5 py-4 bg-gray-50 border-b">

                    <h2 class="text-lg font-semibold text-gray-800">
                        Recent Receipts
                    </h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-4 py-3 text-left">
                                    Date
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Voucher
                                </th>

                                <th class="px-4 py-3 text-right">
                                    Amount
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($recent_receipts)): ?>

                                <?php foreach (
                                    $recent_receipts
                                    as $recent_receipt
                                ): ?>

                                    <tr class="border-t hover:bg-gray-50">

                                        <td class="px-4 py-3 whitespace-nowrap">

                                            <?= !empty(
                                                $recent_receipt->voucher_date
                                            )
                                                ? date(
                                                    'd-m-Y',
                                                    strtotime(
                                                        $recent_receipt->voucher_date
                                                    )
                                                )
                                                : '-';
                                            ?>

                                        </td>

                                        <td class="px-4 py-3 font-medium">

                                            <?= htmlspecialchars(
                                                $recent_receipt->voucher_code
                                                ?? '-'
                                            ); ?>

                                        </td>

                                        <td class="
                                            px-4
                                            py-3
                                            text-right
                                            font-semibold
                                            text-green-600
                                            whitespace-nowrap
                                        ">

                                            AED
                                            <?= number_format(
                                                (float)(
                                                    $recent_receipt->amount
                                                    ?? 0
                                                ),
                                                2
                                            ); ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="3"
                                        class="
                                            px-4
                                            py-8
                                            text-center
                                            text-gray-500
                                        ">

                                        No recent receipts found.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-md overflow-hidden">

                <div class="px-5 py-4 bg-gray-50 border-b">

                    <h2 class="text-lg font-semibold text-gray-800">
                        Recent Payments
                    </h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-4 py-3 text-left">
                                    Date
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Voucher
                                </th>

                                <th class="px-4 py-3 text-right">
                                    Amount
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($recent_payments)): ?>

                                <?php foreach (
                                    $recent_payments
                                    as $recent_payment
                                ): ?>

                                    <tr class="border-t hover:bg-gray-50">

                                        <td class="
                                            px-4
                                            py-3
                                            whitespace-nowrap
                                        ">

                                            <?= !empty(
                                                $recent_payment->voucher_date
                                            )
                                                ? date(
                                                    'd-m-Y',
                                                    strtotime(
                                                        $recent_payment->voucher_date
                                                    )
                                                )
                                                : '-';
                                            ?>

                                        </td>

                                        <td class="
                                            px-4
                                            py-3
                                            font-medium
                                        ">

                                            <?= htmlspecialchars(
                                                $recent_payment->voucher_code
                                                ?? '-'
                                            ); ?>

                                        </td>

                                        <td class="
                                            px-4
                                            py-3
                                            text-right
                                            font-semibold
                                            text-blue-600
                                            whitespace-nowrap
                                        ">

                                            AED
                                            <?= number_format(
                                                (float)(
                                                    $recent_payment->amount
                                                    ?? 0
                                                ),
                                                2
                                            ); ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="3"
                                        class="
                                            px-4
                                            py-8
                                            text-center
                                            text-gray-500
                                        ">

                                        No recent payments found.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-md overflow-hidden">

                <div class="px-5 py-4 bg-gray-50 border-b">

                    <h2 class="text-lg font-semibold text-gray-800">
                        Recent Expenses
                    </h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-4 py-3 text-left">
                                    Date
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Voucher
                                </th>

                                <th class="px-4 py-3 text-right">
                                    Amount
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($recent_expenses)): ?>

                                <?php foreach (
                                    $recent_expenses
                                    as $recent_expense
                                ): ?>

                                    <tr class="border-t hover:bg-gray-50">

                                        <td class="
                                            px-4
                                            py-3
                                            whitespace-nowrap
                                        ">

                                            <?= !empty(
                                                $recent_expense->voucher_date
                                            )
                                                ? date(
                                                    'd-m-Y',
                                                    strtotime(
                                                        $recent_expense->voucher_date
                                                    )
                                                )
                                                : '-';
                                            ?>

                                        </td>

                                        <td class="
                                            px-4
                                            py-3
                                            font-medium
                                        ">

                                            <?= htmlspecialchars(
                                                $recent_expense->voucher_code
                                                ?? '-'
                                            ); ?>

                                        </td>

                                        <td class="
                                            px-4
                                            py-3
                                            text-right
                                            font-semibold
                                            text-red-600
                                            whitespace-nowrap
                                        ">

                                            AED
                                            <?= number_format(
                                                (float)(
                                                    $recent_expense->amount
                                                    ?? 0
                                                ),
                                                2
                                            ); ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="3"
                                        class="
                                            px-4
                                            py-8
                                            text-center
                                            text-gray-500
                                        ">

                                        No recent expenses found.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const branchFilter =
        document.getElementById('branchFilter');

    const fromDate =
        document.getElementById('fromDate');

    const toDate =
        document.getElementById('toDate');

    function applyDashboardFilters()
    {

        const url =
            new URL(window.location.href);

        if (
            branchFilter &&
            branchFilter.value
        ) {

            url.searchParams.set(
                'branch_id',
                branchFilter.value
            );

        } else {

            url.searchParams.delete(
                'branch_id'
            );

        }

        if (
            fromDate &&
            fromDate.value
        ) {

            url.searchParams.set(
                'from_date',
                fromDate.value
            );

        } else {

            url.searchParams.delete(
                'from_date'
            );

        }

        if (
            toDate &&
            toDate.value
        ) {

            url.searchParams.set(
                'to_date',
                toDate.value
            );

        } else {

            url.searchParams.delete(
                'to_date'
            );

        }

        window.location.href =
            url.toString();

    }

    if (branchFilter) {

        branchFilter.addEventListener(
            'change',
            function () {

                applyDashboardFilters();

            }
        );

    }

    if (fromDate) {

        fromDate.addEventListener(
            'change',
            function () {

                if (
                    toDate &&
                    toDate.value &&
                    this.value > toDate.value
                ) {

                    alert(
                        'From Date cannot be greater than To Date.'
                    );

                    this.value =
                        '<?= htmlspecialchars(
                            $selected_from_date ?? ''
                        ); ?>';

                    return;

                }

                applyDashboardFilters();

            }
        );

    }

    if (toDate) {

        toDate.addEventListener(
            'change',
            function () {

                if (
                    fromDate &&
                    fromDate.value &&
                    this.value < fromDate.value
                ) {

                    alert(
                        'To Date cannot be earlier than From Date.'
                    );

                    this.value =
                        '<?= htmlspecialchars(
                            $selected_to_date ?? ''
                        ); ?>';

                    return;

                }

                applyDashboardFilters();

            }
        );

    }

    const monthlyCashFlowRows =
        <?= json_encode(
            isset($monthly_cash_flow)
                ? $monthly_cash_flow
                : array()
        ); ?>;

    console.log(
        'Monthly Cash Flow:',
        monthlyCashFlowRows
    );

    const cashFlowLabels = [];
    const cashInData = [];
    const cashOutData = [];

    if (
        Array.isArray(
            monthlyCashFlowRows
        )
    ) {

        monthlyCashFlowRows.forEach(
            function (row) {

                cashFlowLabels.push(
                    row.month || ''
                );

                cashInData.push(
                    Number(
                        row.cash_in || 0
                    )
                );

                cashOutData.push(
                    Number(
                        row.cash_out || 0
                    )
                );

            }
        );

    }

    console.log(
        'Cash Flow Labels:',
        cashFlowLabels
    );

    console.log(
        'Cash In:',
        cashInData
    );

    console.log(
        'Cash Out:',
        cashOutData
    );

    const monthlyCashFlowCanvas =
        document.getElementById(
            'monthlyCashFlowChart'
        );

    if (
        monthlyCashFlowCanvas &&
        typeof Chart !== 'undefined'
    ) {

        new Chart(
            monthlyCashFlowCanvas,
            {

                type: 'bar',

                data: {

                    labels:
                        cashFlowLabels,

                    datasets: [

                        {

                            label:
                                'Cash In',

                            data:
                                cashInData,

                            borderWidth: 1,

                            borderRadius: 6,

                            barPercentage: 0.75,

                            categoryPercentage: 0.75

                        },

                        {

                            label:
                                'Cash Out',

                            data:
                                cashOutData,

                            borderWidth: 1,

                            borderRadius: 6,

                            barPercentage: 0.75,

                            categoryPercentage: 0.75

                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    interaction: {

                        mode: 'index',

                        intersect: false

                    },

                    plugins: {

                        legend: {

                            display: true,

                            position: 'top'

                        },

                        tooltip: {

                            callbacks: {

                                label:
                                    function (context) {

                                        const value =
                                            Number(
                                                context.raw || 0
                                            );


                                        return (
                                            context.dataset.label +
                                            ': AED ' +
                                            value.toLocaleString(
                                                'en-AE',
                                                {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }
                                            )
                                        );

                                    }

                            }

                        }

                    },

                    scales: {

                        x: {

                            grid: {

                                display: false

                            }

                        },

                        y: {

                            beginAtZero: true,

                            ticks: {

                                callback:
                                    function (value) {

                                        return (
                                            'AED ' +
                                            Number(value)
                                                .toLocaleString(
                                                    'en-AE'
                                                )
                                        );

                                    }

                            }

                        }

                    }

                }

            }

        );

    }

    const accountsChartData =
        <?= json_encode(
            $accounts_chart ?? array(
                'labels' => array(),
                'income' => array(),
                'expense' => array()
            )
        ); ?>;

    console.log(
        'Income / Expense Chart:',
        accountsChartData
    );

    const accountsLabels =
        Array.isArray(accountsChartData.labels)
            ? accountsChartData.labels
            : [];

    const incomeData =
        Array.isArray(accountsChartData.income)
            ? accountsChartData.income.map(
                function (value) {
                    return Number(value || 0);
                }
            )
            : [];

    const expenseData =
        Array.isArray(accountsChartData.expense)
            ? accountsChartData.expense.map(
                function (value) {
                    return Number(value || 0);
                }
            )
            : [];

    console.log(
        'Trend Labels:',
        accountsLabels
    );

    console.log(
        'Income:',
        incomeData
    );

    console.log(
        'Expense:',
        expenseData
    );

    const accountsCanvas =
        document.getElementById(
            'accountsTrendChart'
        );

    if (
        accountsCanvas &&
        typeof Chart !== 'undefined'
    ) {

        new Chart(
            accountsCanvas,
            {

                type: 'bar',

                data: {

                    labels:
                        accountsLabels,

                    datasets: [

                        {

                            label:
                                'Income',

                            data:
                                incomeData,

                            borderWidth: 1,

                            borderRadius: 6,

                            barPercentage: 0.45,

                            categoryPercentage: 0.70

                        },

                        {

                            label:
                                'Expense',

                            data:
                                expenseData,

                            borderWidth: 1,

                            borderRadius: 6,

                            barPercentage: 0.45,

                            categoryPercentage: 0.70

                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    interaction: {

                        mode: 'index',

                        intersect: false

                    },

                    plugins: {

                        legend: {

                            display: true,

                            position: 'top'

                        },

                        tooltip: {

                            callbacks: {

                                label:
                                    function (context) {

                                        const value =
                                            Number(
                                                context.raw || 0
                                            );

                                        return (
                                            context.dataset.label +
                                            ': AED ' +
                                            value.toLocaleString(
                                                'en-AE',
                                                {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }
                                            )
                                        );

                                    }

                            }

                        }

                    },

                    scales: {

                        x: {

                            stacked: false,

                            grid: {

                                display: false

                            },

                            ticks: {

                                autoSkip: false

                            }

                        },

                        y: {

                            beginAtZero: true,

                            ticks: {

                                callback:
                                    function (value) {

                                        return (
                                            'AED ' +
                                            Number(value)
                                                .toLocaleString(
                                                    'en-AE'
                                                )
                                        );

                                    }

                            }

                        }

                    }

                }

            }

        );

    }

    const paymentStatus =
        <?= json_encode(
            $payment_status_chart ?? array(
                'paid' => 0,
                'partial' => 0,
                'pending' => 0
            )
        ); ?>;

    const paymentCanvas =
        document.getElementById(
            'paymentStatusChart'
        );

    if (
        paymentCanvas &&
        typeof Chart !== 'undefined'
    ) {

        new Chart(
            paymentCanvas,
            {

                type: 'doughnut',

                data: {

                    labels: [

                        'Paid',

                        'Partially Paid',

                        'Pending'

                    ],

                    datasets: [

                        {

                            data: [

                                Number(
                                    paymentStatus.paid || 0
                                ),

                                Number(
                                    paymentStatus.partial || 0
                                ),

                                Number(
                                    paymentStatus.pending || 0
                                )

                            ],

                            borderWidth: 1

                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,


                    plugins: {

                        legend: {

                            position: 'bottom'

                        }

                    }

                }

            }

        );

    }

});

</script>