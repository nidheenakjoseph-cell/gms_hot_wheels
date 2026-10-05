<div class="min-h-screen bg-gray-50 relative inventory-dashboard">

    <div class="absolute inset-0
                bg-[url('<?= base_url("public/images/car1.png") ?>')]
                bg-center bg-no-repeat bg-contain
                opacity-5 pointer-events-none">
    </div>

    <div class="relative z-10 p-6">

        <div class="bg-white rounded-2xl shadow-md mb-6 overflow-hidden">

            <div class="px-6 py-5">

                <div class="flex flex-col lg:flex-row
                            lg:items-center
                            lg:justify-between gap-5">

                    <div>

                        <p class="text-sm text-gray-500">
                            Inventory Management
                        </p>

                        <h1 class="text-2xl font-bold text-gray-800">
                            Inventory Dashboard
                        </h1>

                        <p class="text-sm text-gray-500 mt-1">
                            Spare parts, stock levels and inventory
                            movement overview
                        </p>

                    </div>

                    <div class="flex flex-wrap gap-3">

                        <div class="bg-gray-50
                                    border border-gray-200
                                    rounded-xl px-4 py-3">

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

                                <option value="">All Branches</option>

                                <?php if (!empty($branches)): ?>

                                    <?php foreach ($branches as $branch): ?>

                                        <option
                                            value="<?= (int)$branch->branch_id; ?>"
                                            <?= (string)$selected_branch_id ===
                                                (string)$branch->branch_id
                                                ? 'selected'
                                                : ''; ?>>

                                            <?= htmlspecialchars($branch->branch_name); ?>

                                        </option>

                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </select>

                        </div>

                        <div class="bg-gray-50
                                    border border-gray-200
                                    rounded-xl px-4 py-3">

                            <p class="text-xs
                                    text-gray-500
                                    uppercase
                                    font-semibold">

                                From Date

                            </p>

                            <input
                                type="date"
                                id="fromDate"
                                value="<?= htmlspecialchars($selected_from_date ?? ''); ?>"
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
                                    rounded-xl px-4 py-3">

                            <p class="text-xs
                                    text-gray-500
                                    uppercase
                                    font-semibold">

                                To Date

                            </p>

                            <input
                                type="date"
                                id="toDate"
                                value="<?= htmlspecialchars($selected_to_date ?? ''); ?>"
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
                    lg:grid-cols-4
                    gap-5 mb-6">

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

                            Inventory Value

                        </p>

                        <h2 class="text-2xl
                                   font-bold
                                   text-gray-800 mt-2">

                            AED
                            <?= number_format(
                                $inventory_summary['inventory_value'] ?? 0,
                                2
                            ); ?>

                        </h2>

                    </div>

                    <div class="text-3xl">
                        📦
                    </div>

                </div>

                <p class="text-xs
                          text-gray-500 mt-3">

                    <?= $inventory_summary['part_count'] ?? 0; ?>
                    Spare Parts

                </p>

            </div>

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

                            Total Stock

                        </p>

                        <h2 class="text-2xl
                                   font-bold
                                   text-green-600 mt-2">

                            <?= number_format(
                                $stock_summary['total_stock'] ?? 0,
                                2
                            ); ?>

                        </h2>

                    </div>

                    <div class="text-3xl">
                        📊
                    </div>

                </div>

                <p class="text-xs
                          text-gray-500 mt-3">

                    <?= $stock_summary['stocked_items'] ?? 0; ?>
                    Items in stock

                </p>

            </div>

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

                            Low Stock

                        </p>

                        <h2 class="text-2xl
                                   font-bold
                                   text-yellow-600 mt-2">

                            <?= $low_stock_summary['low_stock'] ?? 0; ?>

                        </h2>

                    </div>

                    <div class="text-3xl">
                        ⚠️
                    </div>

                </div>

                <p class="text-xs
                          text-gray-500 mt-3">

                    Requires attention

                </p>

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

                            Out of Stock

                        </p>

                        <h2 class="text-2xl
                                   font-bold
                                   text-red-600 mt-2">

                            <?= $out_of_stock_summary['out_of_stock'] ?? 0; ?>

                        </h2>

                    </div>

                    <div class="text-3xl">
                        🚫
                    </div>

                </div>

                <p class="text-xs
                          text-gray-500 mt-3">

                    Stock unavailable

                </p>

            </div>

        </div>

        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-4
                    gap-5 mb-6">

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    New Parts
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-gray-800 mt-2">

                    <?= $part_type_summary['New Parts']['item_count'] ?? 0; ?>

                </h2>

                <p class="text-xs text-gray-500 mt-1">

                    Stock:
                    <?= number_format(
                        $part_type_summary['New Parts']['quantity'] ?? 0,
                        2
                    ); ?>

                </p>

            </div>

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    Aftermarket Parts
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-gray-800 mt-2">

                    <?= $part_type_summary['Aftermarket Parts']['item_count'] ?? 0; ?>

                </h2>

                <p class="text-xs text-gray-500 mt-1">

                    Stock:
                    <?= number_format(
                        $part_type_summary['Aftermarket Parts']['quantity'] ?? 0,
                        2
                    ); ?>

                </p>

            </div>

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    Used Parts
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-gray-800 mt-2">

                    <?= $part_type_summary['Used Parts']['item_count'] ?? 0; ?>

                </h2>

                <p class="text-xs text-gray-500 mt-1">

                    Stock:
                    <?= number_format(
                        $part_type_summary['Used Parts']['quantity'] ?? 0,
                        2
                    ); ?>

                </p>

            </div>

            <div class="bg-white
                        rounded-2xl
                        shadow
                        p-5">

                <p class="text-sm text-gray-500">
                    Brands in Stock
                </p>

                <h2 class="text-2xl
                           font-bold
                           text-gray-800 mt-2">

                    <?= $brand_summary['active_brands'] ?? 0; ?>

                </h2>

            </div>

        </div>

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

                    Stock Movement Trend

                </h2>

                <p class="text-sm
                          text-gray-500">

                    Period-wise stock received

                </p>

            </div>

            <div class="p-6">

                <div style="height:350px;">

                    <canvas id="inventoryTrendChart"></canvas>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1
                    lg:grid-cols-2
                    gap-6 mb-6">

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        p-6">

                <h2 class="text-lg
                           font-semibold
                           text-gray-800">

                    Stock Status

                </h2>

                <p class="text-sm
                          text-gray-500 mb-4">

                    Current inventory availability

                </p>

                <div style="height:300px;">

                    <canvas id="stockStatusChart"></canvas>

                </div>

            </div>

            <div class="bg-white
                        rounded-2xl
                        shadow-md
                        p-6">

                <h2 class="text-lg
                           font-semibold
                           text-gray-800">

                    Inventory by Part Type

                </h2>

                <p class="text-sm
                          text-gray-500 mb-5">

                    Current stock value by part type

                </p>

                <div class="grid grid-cols-1
                            sm:grid-cols-3
                            gap-4">


                    <?php
                    $part_types = array(
                        'New Parts',
                        'Aftermarket Parts',
                        'Used Parts'
                    );
                    ?>

                    <?php foreach ($part_types as $type): ?>

                        <div class="bg-gray-50
                                    rounded-xl
                                    p-5">

                            <p class="text-xs
                                      text-gray-500
                                      uppercase">

                                <?= htmlspecialchars($type); ?>

                            </p>

                            <h3 class="text-lg
                                       font-bold
                                       text-gray-800 mt-2">

                                AED
                                <?= number_format(
                                    $part_type_summary[$type]['stock_value'] ?? 0,
                                    2
                                ); ?>

                            </h3>

                            <p class="text-xs
                                      text-gray-500 mt-1">

                                <?= $part_type_summary[$type]['quantity'] ?? 0; ?>
                                Units

                            </p>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

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

                        Low Stock Alerts

                    </h2>

                    <p class="text-sm
                              text-gray-500">

                        Parts that require replenishment

                    </p>

                </div>

                <a href="<?= base_url(
                    'index.php/SpareParts/low_stock'
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
                                #
                            </th>

                            <th class="px-4 py-3 text-left">
                                Part
                            </th>

                            <th class="px-4 py-3 text-left">
                                Code
                            </th>

                            <th class="px-4 py-3 text-right">
                                Current Stock
                            </th>

                            <th class="px-4 py-3 text-right">
                                Minimum Stock
                            </th>

                            <th class="px-4 py-3 text-right">
                                Unit Price
                            </th>

                            <th class="px-4 py-3 text-center">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($low_stock_parts)): ?>

                            <?php $i = 1; ?>

                            <?php foreach ($low_stock_parts as $part): ?>

                                <tr class="border-t
                                           hover:bg-red-50">

                                    <td class="px-4 py-3">
                                        <?= $i++; ?>
                                    </td>

                                    <td class="px-4 py-3
                                               font-semibold">

                                        <?= htmlspecialchars(
                                            $part->part_name
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3">

                                        <?= htmlspecialchars(
                                            $part->part_code ?: '-'
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3
                                               text-right
                                               font-bold
                                               text-red-600">

                                        <?= number_format(
                                            $part->current_stock,
                                            2
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3
                                               text-right">

                                        <?= number_format(
                                            $part->min_stock,
                                            2
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3
                                               text-right">

                                        AED
                                        <?= number_format(
                                            $part->unit_price,
                                            2
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3
                                               text-center">

                                        <a href="<?= base_url(
                                            'index.php/SpareParts/stock_in_form/'
                                            . $part->part_id
                                        ); ?>"
                                           class="px-3 py-1
                                                  bg-blue-100
                                                  text-blue-700
                                                  rounded-lg
                                                  text-xs">

                                            Add Stock

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="7"
                                    class="px-4 py-8
                                           text-center
                                           text-green-600">

                                    All spare parts have sufficient stock. 👍

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
                    mb-6
                    overflow-hidden">

            <div class="px-6 py-4
                        bg-gray-50
                        border-b">

                <h2 class="text-lg
                           font-semibold
                           text-gray-800">

                    Top Inventory Items

                </h2>

                <p class="text-sm
                          text-gray-500">

                    Parts with highest inventory value

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
                                Part
                            </th>

                            <th class="px-4 py-3 text-left">
                                Code
                            </th>

                            <th class="px-4 py-3 text-right">
                                Stock
                            </th>

                            <th class="px-4 py-3 text-right">
                                Unit Price
                            </th>

                            <th class="px-4 py-3 text-right">
                                Stock Value
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($top_inventory_items)): ?>

                            <?php $i = 1; ?>

                            <?php foreach (
                                $top_inventory_items
                                as $item
                            ): ?>

                                <tr class="border-t
                                           hover:bg-gray-50">

                                    <td class="px-4 py-3">

                                        <?= $i++; ?>

                                    </td>

                                    <td class="px-4 py-3
                                               font-semibold">

                                        <?= htmlspecialchars(
                                            $item->part_name
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3">

                                        <?= htmlspecialchars(
                                            $item->part_code ?: '-'
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3
                                               text-right">

                                        <?= number_format(
                                            $item->current_stock,
                                            2
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3
                                               text-right">

                                        AED
                                        <?= number_format(
                                            $item->unit_price,
                                            2
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3
                                               text-right
                                               font-semibold">

                                        AED
                                        <?= number_format(
                                            $item->stock_value,
                                            2
                                        ); ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="6"
                                    class="px-4 py-8
                                           text-center
                                           text-gray-500">

                                    No inventory data found.

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

            <div class="px-6 py-4
                        bg-gray-50
                        border-b">

                <div>

                    <h2 class="text-lg
                               font-semibold
                               text-gray-800">

                        Recent Stock In

                    </h2>

                    <p class="text-sm
                              text-gray-500">

                        Latest inventory receipts

                    </p>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-4 py-3 text-left">
                                Part
                            </th>

                            <th class="px-4 py-3 text-left">
                                Code
                            </th>

                            <th class="px-4 py-3 text-right">
                                Quantity
                            </th>

                            <th class="px-4 py-3 text-left">
                                Date
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($recent_stock_in)): ?>

                            <?php foreach (
                                $recent_stock_in
                                as $stock
                            ): ?>

                                <tr class="border-t
                                           hover:bg-gray-50">

                                    <td class="px-4 py-3
                                               font-semibold">

                                        <?= htmlspecialchars(
                                            $stock->part_name ?? '-'
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3">

                                        <?= htmlspecialchars(
                                            $stock->part_code ?? '-'
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3
                                               text-right
                                               font-semibold
                                               text-green-600">

                                        <?= number_format(
                                            $stock->qty ?? 0,
                                            2
                                        ); ?>

                                    </td>

                                    <td class="px-4 py-3">

                                        <?= !empty($stock->date_in)
                                        ? date(
                                            'd M Y',
                                            strtotime($stock->date_in)
                                        )
                                        : '-'; ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="4"
                                    class="px-4 py-8
                                           text-center
                                           text-gray-500">

                                    No recent stock entries found.

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const branchFilter = document.getElementById('branchFilter');
        const fromDate     = document.getElementById('fromDate');
        const toDate       = document.getElementById('toDate');

        function applyDashboardFilters()
        {
            const url = new URL(window.location.href);

            if (branchFilter && branchFilter.value) {

                url.searchParams.set(
                    'branch_id',
                    branchFilter.value
                );

            } else {

                url.searchParams.delete('branch_id');

            }

            if (fromDate && fromDate.value) {

                url.searchParams.set(
                    'from_date',
                    fromDate.value
                );

            } else {

                url.searchParams.delete('from_date');

            }

            if (toDate && toDate.value) {

                url.searchParams.set(
                    'to_date',
                    toDate.value
                );

            } else {

                url.searchParams.delete('to_date');

            }

            window.location.href = url.toString();
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

        const inventoryChartData =
            <?= json_encode(
                $inventory_chart ?? array(
                    'labels' => array(),
                    'stock_in' => array()
                )
            ); ?>;

        const inventoryCanvas =
            document.getElementById(
                'inventoryTrendChart'
            );

        if (
            inventoryCanvas &&
            typeof Chart !== 'undefined'
        ) {

            new Chart(
                inventoryCanvas,
                {

                    type: 'line',

                    data: {

                        labels:
                            inventoryChartData.labels,

                        datasets: [

                            {

                                label:
                                    'Stock In',

                                data:
                                    inventoryChartData.stock_in,

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
                                        function (context) {

                                            return (
                                                'Quantity: ' +
                                                Number(
                                                    context.raw || 0
                                                ).toLocaleString(
                                                    undefined,
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

                            y: {

                                beginAtZero: true,

                                ticks: {

                                    callback:
                                        function (value) {

                                            return Number(
                                                value
                                            ).toLocaleString();

                                        }

                                }

                            }

                        }

                    }

                }
            );

        }

        const stockStatus =
            <?= json_encode(
                $stock_status_chart ?? array(
                    'out_of_stock' => 0,
                    'low_stock' => 0,
                    'sufficient_stock' => 0
                )
            ); ?>;

        const stockStatusCanvas =
            document.getElementById(
                'stockStatusChart'
            );

        if (
            stockStatusCanvas &&
            typeof Chart !== 'undefined'
        ) {

            new Chart(
                stockStatusCanvas,
                {

                    type: 'doughnut',

                    data: {

                        labels: [

                            'Out of Stock',
                            'Low Stock',
                            'Sufficient Stock'

                        ],

                        datasets: [

                            {

                                data: [

                                    Number(
                                        stockStatus.out_of_stock || 0
                                    ),

                                    Number(
                                        stockStatus.low_stock || 0
                                    ),

                                    Number(
                                        stockStatus.sufficient_stock || 0
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