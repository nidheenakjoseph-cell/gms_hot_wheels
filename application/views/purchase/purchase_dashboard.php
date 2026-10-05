
<div class="min-h-screen bg-gray-50 relative purchase-dashboard">

    <!-- =====================================================
         BACKGROUND
    ====================================================== -->

    <div class="absolute inset-0
                bg-[url('<?= base_url("public/images/car1.png") ?>')]
                bg-center bg-no-repeat bg-contain
                opacity-5 pointer-events-none">
    </div>


    <div class="relative z-10 p-6">


        <!-- =================================================
             HEADER
        ================================================== -->

        <div class="bg-white rounded-2xl shadow-md mb-6 overflow-hidden">

            <div class="px-6 py-5">

                <div class="flex flex-col lg:flex-row
                            lg:items-center
                            lg:justify-between gap-5">

                    <!-- LEFT -->

                    <div>

                        <p class="text-sm text-gray-500">
                            Purchase Management
                        </p>

                        <h1 class="text-2xl font-bold text-gray-800">
                            Purchase Dashboard
                        </h1>

                        <p class="text-sm text-gray-500 mt-1">
                            Procurement, suppliers, purchase orders
                            and payments overview
                        </p>

                    </div>


                    <!-- RIGHT -->

                    <div class="flex flex-wrap gap-3">

                        <!-- Branch -->

                        <div class="bg-gray-50
                                    border border-gray-200
                                    rounded-xl px-4 py-3">

                            <p class="text-xs
                                      text-gray-500
                                      uppercase
                                      font-semibold">

                                Branch

                            </p>

                            <p class="text-sm
                                      font-semibold
                                      text-gray-800 mt-1">

                                <?= htmlspecialchars(
                                    $selected_branch_name
                                ); ?>

                            </p>

                        </div>


                        <!-- Date -->

                        <div class="bg-gray-50
                                    border border-gray-200
                                    rounded-xl px-4 py-3">

                            <p class="text-xs
                                      text-gray-500
                                      uppercase
                                      font-semibold">

                                Today

                            </p>

                            <p class="text-sm
                                      font-semibold
                                      text-gray-800 mt-1">

                                <?= date('d M Y'); ?>

                            </p>

                        </div>

                    </div>

                </div>


                <!-- FILTER -->

                <div class="border-t
                            border-gray-100
                            mt-5 pt-4
                            flex flex-col md:flex-row
                            md:items-center
                            md:justify-between gap-3">

                    <div class="text-sm text-gray-500">

                        Purchase & procurement overview

                    </div>


                    <div>

                        <select
                            id="purchaseFilter"
                            class="border
                                   border-gray-300
                                   rounded-lg
                                   px-4 py-2
                                   text-sm
                                   bg-white">

                            <option
                                value="today"
                                <?= $purchase_filter === 'today'
                                    ? 'selected'
                                    : ''; ?>>

                                Today

                            </option>

                            <option
                                value="this_week"
                                <?= $purchase_filter === 'this_week'
                                    ? 'selected'
                                    : ''; ?>>

                                This Week

                            </option>

                            <option
                                value="this_month"
                                <?= $purchase_filter === 'this_month'
                                    ? 'selected'
                                    : ''; ?>>

                                This Month

                            </option>

                            <option
                                value="6_months"
                                <?= $purchase_filter === '6_months'
                                    ? 'selected'
                                    : ''; ?>>

                                Last 6 Months

                            </option>

                            <option
                                value="12_months"
                                <?= $purchase_filter === '12_months'
                                    ? 'selected'
                                    : ''; ?>>

                                Last 12 Months

                            </option>

                            <option
                                value="full_purchase"
                                <?= $purchase_filter === 'full_purchase'
                                    ? 'selected'
                                    : ''; ?>>

                                Full Purchase

                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             KPI CARDS
        ================================================== -->

        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-4
                    gap-5 mb-6">


            <!-- PURCHASE -->

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

                            Total Purchase

                        </p>

                        <h2 class="text-2xl
                                   font-bold
                                   text-gray-800 mt-2">

                            AED
                            <?= number_format(
                                $purchase_summary['purchase_amount'],
                                2
                            ); ?>

                        </h2>

                    </div>

                    <div class="text-3xl">
                        🛒
                    </div>

                </div>

                <p class="text-xs
                          text-gray-500 mt-3">

                    <?= $purchase_summary['purchase_orders']; ?>
                    Purchase Orders

                </p>

            </div>


            <!-- PENDING PO -->

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        p-5
                        border-l-4
                        border-yellow-500">

                <div class="flex justify-between">

                    <div>

                        <p class="text-xs
                                  text-gray-500
                                  uppercase
                                  font-semibold">

                            Pending POs

                        </p>

                        <h2 class="text-2xl
                                   font-bold
                                   text-yellow-600 mt-2">

                            <?= $po_summary['pending_po']; ?>

                        </h2>

                    </div>

                    <div class="text-3xl">
                        ⏳
                    </div>

                </div>

                <p class="text-xs
                          text-gray-500 mt-3">

                    Awaiting approval

                </p>

            </div>


            <!-- PAYMENTS -->

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

                            Purchase Payments

                        </p>

                        <h2 class="text-2xl
                                   font-bold
                                   text-green-600 mt-2">

                            AED
                            <?= number_format(
                                $payment_summary['paid_amount'],
                                2
                            ); ?>

                        </h2>

                    </div>

                    <div class="text-3xl">
                        💳
                    </div>

                </div>

                <p class="text-xs
                          text-gray-500 mt-3">

                    Payments recorded

                </p>

            </div>


            <!-- RETURNS -->

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

                            Purchase Returns

                        </p>

                        <h2 class="text-2xl
                                   font-bold
                                   text-red-600 mt-2">

                            AED
                            <?= number_format(
                                $purchase_return_summary['return_amount'],
                                2
                            ); ?>

                        </h2>

                    </div>

                    <div class="text-3xl">
                        ↩️
                    </div>

                </div>

                <p class="text-xs
                          text-gray-500 mt-3">

                    <?= $purchase_return_summary['return_count']; ?>
                    Returns

                </p>

            </div>

        </div>


        <!-- =================================================
             SECONDARY SUMMARY
        ================================================== -->

        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-4
                    gap-5 mb-6">


            <!-- SUPPLIERS -->

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    Active Suppliers
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-gray-800 mt-2">

                    <?= $supplier_summary['active_suppliers']; ?>

                </h2>

            </div>


            <!-- GRN -->

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    GRNs Received
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-gray-800 mt-2">

                    <?= $grn_summary['grn_count']; ?>

                </h2>

                <p class="text-xs
                          text-gray-500 mt-1">

                    AED
                    <?= number_format(
                        $grn_summary['grn_amount'],
                        2
                    ); ?>

                </p>

            </div>


            <!-- APPROVED PO -->

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    Approved POs
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-green-600 mt-2">

                    <?= $po_summary['approved_po']; ?>

                </h2>

            </div>


            <!-- CANCELLED -->

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    Cancelled POs
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-red-600 mt-2">

                    <?= $po_summary['cancelled_po']; ?>

                </h2>

            </div>

        </div>


        <!-- =================================================
             PURCHASE TREND
        ================================================== -->

        <div class="bg-white
                    rounded-2xl
                    shadow-md
                    mb-6
                    overflow-hidden">

            <div class="px-6 py-4
                        bg-gray-50
                        border-b">

                <h2 class="text-lg
                           font-semibold
                           text-gray-800">

                    Purchase Trend

                </h2>

                <p class="text-sm
                          text-gray-500">

                    Period-wise purchase analysis

                </p>

            </div>

            <div class="p-6">

                <div style="height:350px;">

                    <canvas id="purchaseTrendChart"></canvas>

                </div>

            </div>

        </div>


        <!-- =================================================
             PO STATUS + PURCHASE TYPE
        ================================================== -->

        <div class="grid grid-cols-1
                    lg:grid-cols-2
                    gap-6 mb-6">


            <!-- PO STATUS -->

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        p-6">

                <h2 class="text-lg
                           font-semibold
                           text-gray-800">

                    Purchase Order Status

                </h2>

                <p class="text-sm
                          text-gray-500 mb-4">

                    Pending, approved and cancelled POs

                </p>

                <div style="height:300px;">

                    <canvas id="poStatusChart"></canvas>

                </div>

            </div>


            <!-- PARTS VS SERVICE -->

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        p-6">

                <h2 class="text-lg
                           font-semibold
                           text-gray-800">

                    Parts vs Service Purchase

                </h2>

                <p class="text-sm
                          text-gray-500 mb-5">

                    Purchase value by purchase type

                </p>


                <div class="grid grid-cols-2 gap-4">


                    <div class="bg-blue-50
                                rounded-xl
                                p-5">

                        <p class="text-xs
                                  text-gray-500
                                  uppercase">

                            Parts

                        </p>

                        <h3 class="text-xl
                                   font-bold
                                   text-blue-700 mt-2">

                            AED
                            <?= number_format(
                                $purchase_type_summary['PARTS']['amount'],
                                2
                            ); ?>

                        </h3>

                        <p class="text-xs
                                  text-gray-500 mt-1">

                            <?= $purchase_type_summary['PARTS']['count']; ?>
                            POs

                        </p>

                    </div>


                    <div class="bg-purple-50
                                rounded-xl
                                p-5">

                        <p class="text-xs
                                  text-gray-500
                                  uppercase">

                            Service

                        </p>

                        <h3 class="text-xl
                                   font-bold
                                   text-purple-700 mt-2">

                            AED
                            <?= number_format(
                                $purchase_type_summary['SERVICE']['amount'],
                                2
                            ); ?>

                        </h3>

                        <p class="text-xs
                                  text-gray-500 mt-1">

                            <?= $purchase_type_summary['SERVICE']['count']; ?>
                            POs

                        </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             TOP SUPPLIERS
        ================================================== -->

        <div class="bg-white
                    rounded-2xl
                    shadow-md
                    mb-6
                    overflow-hidden">

            <div class="px-6 py-4
                        bg-gray-50
                        border-b
                        flex justify-between
                        items-center">

                <div>

                    <h2 class="text-lg
                               font-semibold
                               text-gray-800">

                        Top Suppliers

                    </h2>

                    <p class="text-sm
                              text-gray-500">

                        Suppliers by purchase value

                    </p>

                </div>

                <a href="<?= base_url(
                    'index.php/Supplier'
                ); ?>"
                   class="text-sm
                          text-blue-600
                          hover:underline">

                    View Suppliers

                </a>

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

                            <th class="px-4 py-3 text-center">
                                POs
                            </th>

                            <th class="px-4 py-3 text-right">
                                Purchase Amount
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($top_suppliers)): ?>

                            <?php $i = 1; ?>

                            <?php foreach (
                                $top_suppliers
                                as $supplier
                            ): ?>

                                <tr class="border-t
                                           hover:bg-gray-50">

                                    <td class="px-4 py-3">
                                        <?= $i++; ?>
                                    </td>

                                    <td class="px-4 py-3 font-semibold">

                                        <?= htmlspecialchars(
                                            $supplier->supplier_name
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3 text-center">

                                        <?= $supplier->po_count; ?>

                                    </td>

                                    <td class="px-4 py-3
                                               text-right
                                               font-semibold">

                                        AED
                                        <?= number_format(
                                            $supplier->purchase_amount,
                                            2
                                        ); ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="4"
                                    class="px-4 py-8
                                           text-center
                                           text-gray-500">

                                    No supplier purchase data

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>


        <!-- =================================================
             RECENT PURCHASE ORDERS
        ================================================== -->

        <div class="bg-white
                    rounded-2xl
                    shadow-md
                    mb-6
                    overflow-hidden">

            <div class="px-6 py-4
                        bg-gray-50
                        border-b
                        flex justify-between
                        items-center">

                <h2 class="text-lg
                           font-semibold
                           text-gray-800">

                    Recent Purchase Orders

                </h2>

                <a href="<?= base_url(
                    'index.php/Purchase/purchase_order_list'
                ); ?>"
                   class="text-sm
                          text-blue-600
                          hover:underline">

                    View All

                </a>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full text-sm">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-4 py-3 text-left">
                                PO
                            </th>

                            <th class="px-4 py-3 text-left">
                                Date
                            </th>

                            <th class="px-4 py-3 text-left">
                                Supplier
                            </th>

                            <th class="px-4 py-3 text-center">
                                Type
                            </th>

                            <th class="px-4 py-3 text-right">
                                Amount
                            </th>

                            <th class="px-4 py-3 text-center">
                                Status
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (
                            !empty(
                                $recent_purchase_orders
                            )
                        ): ?>

                            <?php foreach (
                                $recent_purchase_orders
                                as $po
                            ): ?>

                                <tr class="border-t
                                           hover:bg-gray-50">

                                    <td class="px-4 py-3">

                                        <a href="<?= base_url(
                                            'index.php/Purchase/print_po/'
                                            . $po->po_id
                                        ); ?>"
                                           class="font-semibold
                                                  text-blue-600
                                                  hover:underline">

                                            <?= htmlspecialchars(
                                                $po->po_code
                                            ); ?>

                                        </a>

                                    </td>

                                    <td class="px-4 py-3">

                                        <?= !empty($po->po_date)
                                            ? date(
                                                'd M Y',
                                                strtotime(
                                                    $po->po_date
                                                )
                                            )
                                            : '-'; ?>

                                    </td>

                                    <td class="px-4 py-3">

                                        <?= htmlspecialchars(
                                            $po->supplier_name
                                            ?? '-'
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3
                                               text-center">

                                        <span class="px-2 py-1
                                                     rounded-full
                                                     text-xs
                                                     bg-gray-100">

                                            <?= htmlspecialchars(
                                                $po->purchase_type
                                                ?? '-'
                                            ); ?>

                                        </span>

                                    </td>

                                    <td class="px-4 py-3
                                               text-right
                                               font-semibold">

                                        AED
                                        <?= number_format(
                                            $po->grand_total,
                                            2
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3
                                               text-center">

                                        <?php if (
                                            $po->cancelled == 1
                                        ): ?>

                                            <span class="px-2 py-1
                                                         text-xs
                                                         rounded-full
                                                         bg-red-100
                                                         text-red-700">

                                                Cancelled

                                            </span>

                                        <?php elseif (
                                            $po->po_status == 1
                                        ): ?>

                                            <span class="px-2 py-1
                                                         text-xs
                                                         rounded-full
                                                         bg-green-100
                                                         text-green-700">

                                                Approved

                                            </span>

                                        <?php else: ?>

                                            <span class="px-2 py-1
                                                         text-xs
                                                         rounded-full
                                                         bg-yellow-100
                                                         text-yellow-700">

                                                Pending

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="6"
                                    class="px-4 py-8
                                           text-center
                                           text-gray-500">

                                    No purchase orders found.

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>


        <!-- =================================================
             RECENT GRNs + RETURNS
        ================================================== -->

        <div class="grid grid-cols-1
                    xl:grid-cols-2
                    gap-6">


            <!-- GRNs -->

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        overflow-hidden">

                <div class="px-6 py-4
                            bg-gray-50
                            border-b">

                    <h2 class="text-lg
                               font-semibold
                               text-gray-800">

                        Recent GRNs

                    </h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-4 py-3">
                                    GRN
                                </th>

                                <th class="px-4 py-3">
                                    Supplier
                                </th>

                                <th class="px-4 py-3 text-right">
                                    Amount
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (
                                !empty($recent_grns)
                            ): ?>

                                <?php foreach (
                                    $recent_grns
                                    as $grn
                                ): ?>

                                    <tr class="border-t">

                                        <td class="px-4 py-3">

                                            <?= htmlspecialchars(
                                                $grn->grn_code
                                            ); ?>

                                        </td>

                                        <td class="px-4 py-3">

                                            <?= htmlspecialchars(
                                                $grn->supplier_name
                                                ?? '-'
                                            ); ?>

                                        </td>

                                        <td class="px-4 py-3
                                                   text-right">

                                            AED
                                            <?= number_format(
                                                $grn->grand_total,
                                                2
                                            ); ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="3"
                                        class="px-4 py-6
                                               text-center
                                               text-gray-500">

                                        No GRNs found.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- RETURNS -->

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        overflow-hidden">

                <div class="px-6 py-4
                            bg-gray-50
                            border-b">

                    <h2 class="text-lg
                               font-semibold
                               text-gray-800">

                        Recent Purchase Returns

                    </h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-4 py-3">
                                    Return
                                </th>

                                <th class="px-4 py-3">
                                    Supplier
                                </th>

                                <th class="px-4 py-3 text-right">
                                    Amount
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (
                                !empty(
                                    $recent_purchase_returns
                                )
                            ): ?>

                                <?php foreach (
                                    $recent_purchase_returns
                                    as $return
                                ): ?>

                                    <tr class="border-t">

                                        <td class="px-4 py-3">

                                            <?= htmlspecialchars(
                                                $return->return_code
                                            ); ?>

                                        </td>

                                        <td class="px-4 py-3">

                                            <?= htmlspecialchars(
                                                $return->supplier_name
                                                ?? '-'
                                            ); ?>

                                        </td>

                                        <td class="px-4 py-3
                                                   text-right">

                                            AED
                                            <?= number_format(
                                                $return->grand_total,
                                                2
                                            ); ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="3"
                                        class="px-4 py-6
                                               text-center
                                               text-gray-500">

                                        No purchase returns found.

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


<!-- =========================================================
     CHART.JS
========================================================= -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        // =====================================================
        // FILTER
        // =====================================================

        const purchaseFilter =
            document.getElementById(
                'purchaseFilter'
            );

        if (purchaseFilter) {

            purchaseFilter.addEventListener(
                'change',
                function () {

                    const url =
                        new URL(
                            window.location.href
                        );

                    url.searchParams.set(
                        'purchase_filter',
                        this.value
                    );

                    window.location.href =
                        url.toString();

                }
            );
        }


        // =====================================================
        // PURCHASE TREND
        // =====================================================

        const purchaseChartData =
            <?= json_encode(
                $purchase_chart ?? [
                    'labels' => [],
                    'purchase' => []
                ]
            ); ?>;


        const purchaseCanvas =
            document.getElementById(
                'purchaseTrendChart'
            );


        if (
            purchaseCanvas &&
            typeof Chart !== 'undefined'
        ) {

            new Chart(
                purchaseCanvas,
                {
                    type: 'line',

                    data: {

                        labels:
                            purchaseChartData.labels,

                        datasets: [

                            {
                                label:
                                    'Purchase',

                                data:
                                    purchaseChartData.purchase,

                                borderWidth: 2,

                                tension: 0.35,

                                fill: false
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

                                display: true
                            },

                            tooltip: {

                                callbacks: {

                                    label:
                                        function (
                                            context
                                        ) {

                                            return (
                                                'AED ' +
                                                Number(
                                                    context.raw || 0
                                                ).toLocaleString(
                                                    undefined,
                                                    {
                                                        minimumFractionDigits:
                                                            2,

                                                        maximumFractionDigits:
                                                            2
                                                    }
                                                )
                                            );

                                        }

                                }

                            }

                        },

                        scales: {

                            y: {

                                beginAtZero: true,

                                ticks: {

                                    callback:
                                        function (
                                            value
                                        ) {

                                            return (
                                                'AED ' +
                                                Number(
                                                    value
                                                ).toLocaleString()
                                            );

                                        }

                                }

                            }

                        }

                    }

                }
            );
        }


        // =====================================================
        // PO STATUS
        // =====================================================

        const poStatus =
            <?= json_encode(
                $po_status_chart ?? [
                    'pending' => 0,
                    'approved' => 0,
                    'cancelled' => 0
                ]
            ); ?>;


        const poCanvas =
            document.getElementById(
                'poStatusChart'
            );


        if (
            poCanvas &&
            typeof Chart !== 'undefined'
        ) {

            new Chart(
                poCanvas,
                {

                    type: 'doughnut',

                    data: {

                        labels: [
                            'Pending',
                            'Approved',
                            'Cancelled'
                        ],

                        datasets: [

                            {
                                data: [

                                    Number(
                                        poStatus.pending || 0
                                    ),

                                    Number(
                                        poStatus.approved || 0
                                    ),

                                    Number(
                                        poStatus.cancelled || 0
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

    }
);

</script>

