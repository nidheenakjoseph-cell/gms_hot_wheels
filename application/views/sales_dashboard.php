<div class="min-h-screen bg-gray-50 relative dashboard-page">

    <style>

        .dashboard-page .card {
            transition:
                transform .18s ease,
                box-shadow .18s ease;
        }

        .dashboard-page .card:hover {
            transform: translateY(-2px);
            box-shadow:
                0 12px 30px rgba(15, 23, 42, .08);
        }

        .dashboard-page .chart-card {
            min-height: 380px;
        }

        .dashboard-page .scrollbar-thin::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .dashboard-page .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }

        .dashboard-page .dashboard-number {
            letter-spacing: -0.5px;
        }

        .dashboard-page .loading-overlay {
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, .70);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 100;
            backdrop-filter: blur(2px);
        }

        .dashboard-page .loading-box {
            background: white;
            padding: 16px 22px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,.10);
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .dashboard-page .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            display: inline-block;
        }

        @media (max-width: 640px) {

            .dashboard-page .mobile-table {
                min-width: 760px;
            }

        }

        /* =========================================================
   Select2 - Dashboard Customer Filter
========================================================= */

.dashboard-page .select2-container {
    width: 100% !important;
}

.dashboard-page .select2-container--default
.select2-selection--single {
    height: 42px;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    background-color: #fff;
}

.dashboard-page .select2-container--default
.select2-selection--single
.select2-selection__rendered {
    line-height: 40px;
    padding-left: 12px;
    font-size: 0.875rem;
    color: #374151;
}

.dashboard-page .select2-container--default
.select2-selection--single
.select2-selection__arrow {
    height: 40px;
    right: 6px;
}

.dashboard-page .select2-container--default
.select2-selection--single:focus,
.dashboard-page .select2-container--default.select2-container--focus
.select2-selection--single {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.15);
}

.dashboard-page .select2-dropdown {
    border-color: #d1d5db;
}

.dashboard-page .select2-results__option {
    font-size: 0.875rem;
    padding: 8px 12px;
}

    </style>


    <!-- Background -->
    <div
        class="absolute inset-0 bg-[url('<?= base_url("public/images/car1.png"); ?>')] bg-center bg-no-repeat bg-contain opacity-[0.025] pointer-events-none">
    </div>


    <div
        class="relative z-10 p-4 md:p-6 space-y-6"
        id="salesDashboardContainer"
    >

        <!-- Loading -->
        <div
            class="loading-overlay"
            id="loadingOverlay"
        >
            <div class="loading-box">
                Loading dashboard...
            </div>
        </div>


        <!-- =========================================================
             HEADER + FILTERS
        ========================================================== -->

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="p-5 md:p-6">

                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-5 mb-5">

                    <div>

                        <div class="flex items-center gap-3">

                            <div
                                class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-700 text-xl">
                                📈
                            </div>

                            <div>

                                <h1 class="text-xl md:text-2xl font-bold text-gray-900">
                                    Sales Dashboard
                                </h1>

                                <p class="text-sm text-gray-500 mt-1">
                                    Sales, collection and customer performance
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Auto Refresh Status -->

                    <div class="flex items-center gap-2 text-xs text-gray-500">

                        <span
                            class="status-dot bg-green-500"
                            id="dashboardStatusDot">
                        </span>

                        <span id="dashboardStatusText">
                            Live
                        </span>

                    </div>

                </div>


                <!-- =====================================================
                     FILTERS
                ====================================================== -->

                <form
                    id="filterForm"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 pt-4 border-t border-gray-100"
                >

                    <!-- From Date -->

                    <div>

                        <label class="block text-xs font-semibold text-gray-600 mb-1">
                            From Date
                        </label>

                        <input
                            type="date"
                            id="filterStartDate"
                            name="start_date"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-500"
                            value="<?= date('Y-m-01'); ?>"
                        >

                    </div>


                    <!-- To Date -->

                    <div>

                        <label class="block text-xs font-semibold text-gray-600 mb-1">
                            To Date
                        </label>

                        <input
                            type="date"
                            id="filterEndDate"
                            name="end_date"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-500"
                            value="<?= date('Y-m-d'); ?>"
                        >

                    </div>


                    <!-- Branch -->

                    <div>

                        <label class="block text-xs font-semibold text-gray-600 mb-1">
                            Branch
                        </label>

                        <select
                            id="filterBranch"
                            name="branch_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                        >

                            <option value="all">
                                All Branches
                            </option>

                            <?php if (!empty($allowed_branches)): ?>

                                <?php foreach ($allowed_branches as $b): ?>

                                    <option value="<?= (int) $b->branch_id; ?>">
                                        <?= htmlspecialchars(
                                            (string) $b->branch_name,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ); ?>
                                    </option>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </select>

                    </div>

<div>

    <label class="block text-xs font-semibold text-gray-600 mb-1">
        Customer
    </label>

    <select
        id="filterCustomer"
        name="customer_id"
        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
    >

        <option value="all">
            All Customers
        </option>

        <?php if (!empty($customers)): ?>

            <?php foreach ($customers as $c): ?>

                <option value="<?= (int) $c->customer_id; ?>">
                    <?= htmlspecialchars(
                        (string) $c->name,
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>
                </option>

            <?php endforeach; ?>

        <?php endif; ?>

    </select>

</div>


                    <!-- Status -->

                    <div>

                        <label class="block text-xs font-semibold text-gray-600 mb-1">
                            Payment Status
                        </label>

                        <select
                            id="filterStatus"
                            name="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                        >

                            <option value="all">
                                All
                            </option>

                            <option value="paid">
                                Paid
                            </option>

                            <option value="partial">
                                Partial
                            </option>

                            <option value="unpaid">
                                Unpaid
                            </option>

                        </select>

                    </div>

                </form>

            </div>

        </div>


        <!-- =========================================================
             KPI CARDS
        ========================================================== -->

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">


            <!-- Today's Sales -->

            <div
                class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5 cursor-pointer"
                onclick="window.location.href='<?= base_url('index.php/invoice'); ?>'"
            >

                <div class="flex justify-between gap-4">

                    <div>

                        <p class="text-xs uppercase font-semibold text-gray-500">
                            Today's Sales
                        </p>

                        <p
                            class="text-2xl font-bold text-gray-900 mt-2 dashboard-number"
                            id="kpiTodaySales"
                        >
                            AED 0.00
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center text-xl">
                        📅
                    </div>

                </div>

            </div>


            <!-- Period Sales -->

            <div class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <div class="flex justify-between gap-4">

                    <div>

                        <p class="text-xs uppercase font-semibold text-gray-500">
                            Period Sales
                        </p>

                        <p
                            class="text-2xl font-bold text-gray-900 mt-2 dashboard-number"
                            id="kpiTotalSales"
                        >
                            AED 0.00
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center text-xl">
                        💰
                    </div>

                </div>

            </div>


            <!-- Collection -->

            <div class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <div class="flex justify-between gap-4">

                    <div>

                        <p class="text-xs uppercase font-semibold text-gray-500">
                            Collection
                        </p>

                        <p
                            class="text-2xl font-bold text-green-600 mt-2 dashboard-number"
                            id="kpiTotalCollection"
                        >
                            AED 0.00
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center text-xl">
                        ✅
                    </div>

                </div>

            </div>


            <!-- Outstanding -->

            <div class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <div class="flex justify-between gap-4">

                    <div>

                        <p class="text-xs uppercase font-semibold text-gray-500">
                            Outstanding
                        </p>

                        <p
                            class="text-2xl font-bold text-red-600 mt-2 dashboard-number"
                            id="kpiOutstanding"
                        >
                            AED 0.00
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center text-xl">
                        ⚠️
                    </div>

                </div>

            </div>


            <!-- Invoices -->

            <div
                class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5 cursor-pointer"
                onclick="window.location.href='<?= base_url('index.php/invoice'); ?>'"
            >

                <div class="flex justify-between gap-4">

                    <div>

                        <p class="text-xs uppercase font-semibold text-gray-500">
                            Total Invoices
                        </p>

                        <p
                            class="text-2xl font-bold text-gray-900 mt-2"
                            id="kpiTotalInvoices"
                        >
                            0
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-purple-100 flex items-center justify-center text-xl">
                        🧾
                    </div>

                </div>

            </div>


            <!-- Total Discounts -->

            <div class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <div class="flex justify-between gap-4">

                    <div>

                        <p class="text-xs uppercase font-semibold text-gray-500">
                            Total Discounts Provided
                        </p>

                        <p
                            class="text-2xl font-bold text-gray-900 mt-2 dashboard-number"
                            id="kpiTotalDiscounts"
                        >
                            AED 0.00
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-yellow-100 flex items-center justify-center text-xl">
                        🎯
                    </div>

                </div>

            </div>


            <!-- Profit Margin -->

            <div class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <div class="flex justify-between gap-4">

                    <div>

                        <p class="text-xs uppercase font-semibold text-gray-500">
                            Profit as % of Sales
                        </p>

                        <p
                            class="text-2xl font-bold text-indigo-600 mt-2"
                            id="kpiProfitPercent"
                        >
                            0.00%
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-indigo-100 flex items-center justify-center text-xl">
                        📈
                    </div>

                </div>

            </div>


            <!-- Average Ticket -->

            <div class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <div class="flex justify-between gap-4">

                    <div>

                        <p class="text-xs uppercase font-semibold text-gray-500">
                            Average Invoice Value
                        </p>

                        <p
                            class="text-2xl font-bold text-gray-900 mt-2"
                            id="kpiAvgTicket"
                        >
                            AED 0.00
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-teal-100 flex items-center justify-center text-xl">
                        🏷️
                    </div>

                </div>

            </div>

        </div>


        <!-- =========================================================
             CHARTS - ROW 1
        ========================================================== -->

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


            <!-- Sales Trend -->

            <div class="chart-card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <div class="flex items-center justify-between mb-4">

                    <div>

                        <h3 class="font-bold text-gray-900">
                            Sales Trend
                        </h3>

                        <p class="text-xs text-gray-500 mt-1">
                            Invoice sales by date
                        </p>

                    </div>

                </div>

                <div class="h-[300px]">

                    <canvas id="salesTrendChart"></canvas>

                </div>

            </div>


            <!-- Collection Trend -->

            <div class="chart-card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <div>

                    <h3 class="font-bold text-gray-900">
                        Collection Trend
                    </h3>

                    <p class="text-xs text-gray-500 mt-1">
                        Cash received by payment date
                    </p>

                </div>

                <div class="h-[300px] mt-4">

                    <canvas id="collectionTrendChart"></canvas>

                </div>

            </div>

        </div>


        <!-- =========================================================
             CHARTS - ROW 2
        ========================================================== -->

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            <!-- Services -->

            <div class="chart-card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <h3 class="font-bold text-gray-900">
                    Top Services
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    Revenue by service
                </p>

                <div class="h-[300px] mt-4">

                    <canvas id="topServicesChart"></canvas>

                </div>

            </div>


            <!-- Parts -->

            <div class="chart-card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <h3 class="font-bold text-gray-900">
                    Top Parts
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    Quantity sold
                </p>

                <div class="h-[300px] mt-4">

                    <canvas id="topPartsChart"></canvas>

                </div>

            </div>


            <!-- Payment Status -->

            <div class="chart-card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <h3 class="font-bold text-gray-900">
                    Invoice Payment Status
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    Paid, partial and unpaid invoices
                </p>

                <div class="h-[300px] mt-4">

                    <canvas id="paymentStatusChart"></canvas>

                </div>

            </div>

        </div>


        <!-- =========================================================
             TABLES
        ========================================================== -->

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">


            <!-- Recent Sales -->

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                <div class="px-5 py-4 bg-gray-50 border-b border-gray-100 flex items-center justify-between">

                    <div>

                        <h3 class="font-bold text-gray-900">
                            Recent Sales
                        </h3>

                        <p class="text-xs text-gray-500 mt-1">
                            Latest invoices
                        </p>

                    </div>

                    <a
                        href="<?= base_url('index.php/invoice'); ?>"
                        class="text-sm text-blue-600 hover:underline"
                    >
                        View All
                    </a>

                </div>


                <div class="overflow-x-auto scrollbar-thin">

                    <table class="min-w-full text-sm mobile-table">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-4 py-3 text-left">
                                    Invoice
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Date
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Customer
                                </th>

                                <th class="px-4 py-3 text-right">
                                    Amount
                                </th>

                                <th class="px-4 py-3 text-center">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody id="tableRecentSales">

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-4 py-8 text-center text-gray-500"
                                >
                                    Loading data...
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- Customer Summary -->

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                <div class="px-5 py-4 bg-gray-50 border-b border-gray-100 flex items-center justify-between">

                    <div>

                        <h3 class="font-bold text-gray-900">
                            Top Customers
                        </h3>

                        <p class="text-xs text-gray-500 mt-1">
                            Customers by sales value
                        </p>

                    </div>

                </div>


                <div class="overflow-x-auto scrollbar-thin">

                    <table class="min-w-full text-sm mobile-table">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-4 py-3 text-left">
                                    Customer
                                </th>

                                <th class="px-4 py-3 text-center">
                                    Invoices
                                </th>

                                <th class="px-4 py-3 text-right">
                                    Sales
                                </th>

                                <th class="px-4 py-3 text-right">
                                    Outstanding
                                </th>

                            </tr>

                        </thead>


                        <tbody id="tableCustomerSummary">

                            <tr>

                                <td
                                    colspan="4"
                                    class="px-4 py-8 text-center text-gray-500"
                                >
                                    Loading data...
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =============================================================
     CHART.JS
============================================================== -->
<link
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
    rel="stylesheet"
/>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const filterForm =
        document.getElementById('filterForm');

    const loadingOverlay =
        document.getElementById('loadingOverlay');

    const dashboardStatusText =
        document.getElementById('dashboardStatusText');

    const dashboardStatusDot =
        document.getElementById('dashboardStatusDot');
/* =========================================================
   Customer Select2
========================================================= */

$('#filterCustomer').select2({
    width: '100%',
    placeholder: 'Select Customer',
    allowClear: true
});

$('#filterCustomer').on('change select2:select select2:clear', function () {
    const start = document.getElementById('filterStartDate').value;
    const end = document.getElementById('filterEndDate').value;

    if (start && end && start > end) {
        alert('From Date cannot be greater than To Date.');
        return;
    }

    loadDashboardData(true);
});

    /*
    |--------------------------------------------------------------------------
    | Chart Objects
    |--------------------------------------------------------------------------
    */

    let salesTrendChartObj = null;

    let collectionTrendChartObj = null;

    let topServicesChartObj = null;

    let topPartsChartObj = null;

    let paymentStatusChartObj = null;


    /*
    |--------------------------------------------------------------------------
    | Prevent Duplicate Requests
    |--------------------------------------------------------------------------
    */

    let requestInProgress = false;


    /*
    |--------------------------------------------------------------------------
    | Money Format
    |--------------------------------------------------------------------------
    */

    function formatMoney(value) {

        return 'AED ' +
            Number(value || 0).toLocaleString(
                undefined,
                {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Escape HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        if (value === null || value === undefined) {
            return '';
        }

        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }


    /*
    |--------------------------------------------------------------------------
    | Loading
    |--------------------------------------------------------------------------
    */

    function setLoading(status) {

        loadingOverlay.style.display =
            status ? 'flex' : 'none';

        if (status) {

            dashboardStatusText.textContent =
                'Updating...';

            dashboardStatusDot.classList.remove(
                'bg-green-500'
            );

            dashboardStatusDot.classList.add(
                'bg-yellow-500'
            );

        } else {

            dashboardStatusText.textContent =
                'Live';

            dashboardStatusDot.classList.remove(
                'bg-yellow-500'
            );

            dashboardStatusDot.classList.add(
                'bg-green-500'
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Load Dashboard
    |--------------------------------------------------------------------------
    */

    function loadDashboardData(showLoader = true) {

        if (requestInProgress) {
            return;
        }

        requestInProgress = true;

        if (showLoader) {
            setLoading(true);
        }


        const formData =
            new FormData(filterForm);


        fetch(
            '<?= base_url("index.php/SalesDashboard/get_data"); ?>',
            {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }
        )

        .then(function (response) {

            if (!response.ok) {

                throw new Error(
                    'Server returned HTTP ' +
                    response.status
                );
            }

            return response.json();
        })

        .then(function (data) {

            if (!data.status) {

                throw new Error(
                    data.message ||
                    'Unable to load dashboard.'
                );
            }

            updateKPIs(
                data.kpis || {}
            );

            updateCharts(
                data.charts || {}
            );

            updateTables(data);

        })

        .catch(function (error) {

            console.error(
                'Sales Dashboard Error:',
                error
            );

            showDashboardError(
                error.message
            );

        })

        .finally(function () {

            requestInProgress = false;

            setLoading(false);

        });
    }


    /*
    |--------------------------------------------------------------------------
    | KPI Update
    |--------------------------------------------------------------------------
    */

    function updateKPIs(kpis) {

        document.getElementById(
            'kpiTodaySales'
        ).textContent =
            formatMoney(kpis.today_sales);


        document.getElementById(
            'kpiTotalSales'
        ).textContent =
            formatMoney(kpis.total_sales);


        document.getElementById(
            'kpiTotalCollection'
        ).textContent =
            formatMoney(kpis.total_collection);


        document.getElementById(
            'kpiOutstanding'
        ).textContent =
            formatMoney(kpis.outstanding);


        document.getElementById(
            'kpiTotalInvoices'
        ).textContent =
            Number(
                kpis.total_invoices || 0
            ).toLocaleString();


        document.getElementById(
            'kpiTotalDiscounts'
        ).textContent =
            formatMoney(kpis.total_discounts);

        document.getElementById(
            'kpiProfitPercent'
        ).textContent =
            Number(
                kpis.profit_percent || 0
            ).toFixed(2) + '%';

        const avgTicket =
            Number(
                kpis.average_ticket || 0
            );


        document.getElementById(
            'kpiAvgTicket'
        ).textContent =
            formatMoney(avgTicket);
    }


    /*
    |--------------------------------------------------------------------------
    | Destroy Chart Safely
    |--------------------------------------------------------------------------
    */

    function destroyChart(chartObject) {

        if (chartObject) {

            try {
                chartObject.destroy();
            } catch (e) {
                console.warn(e);
            }
        }

        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | Charts
    |--------------------------------------------------------------------------
    */

    function updateCharts(charts) {

        /*
        |--------------------------------------------------------------------------
        | Sales Trend
        |--------------------------------------------------------------------------
        */

        const trend =
            charts.trend || {
                labels: [],
                data: []
            };


        salesTrendChartObj =
            destroyChart(
                salesTrendChartObj
            );


        salesTrendChartObj =
            new Chart(
                document.getElementById(
                    'salesTrendChart'
                ),
                {
                    type: 'line',

                    data: {

                        labels: trend.labels,

                        datasets: [{
                            label: 'Sales (AED)',

                            data: trend.data,

                            borderWidth: 2,

                            tension: .35,

                            fill: true
                        }]
                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },

                        plugins: {

                            legend: {
                                display: false
                            },

                            tooltip: {

                                callbacks: {

                                    label: function (context) {

                                        return formatMoney(
                                            context.raw
                                        );

                                    }

                                }

                            }

                        },

                        scales: {

                            y: {

                                beginAtZero: true,

                                ticks: {

                                    callback: function (value) {

                                        return 'AED ' +
                                            Number(value)
                                                .toLocaleString();

                                    }

                                }

                            }

                        }

                    }

                }
            );


        /*
        |--------------------------------------------------------------------------
        | Collection Trend
        |--------------------------------------------------------------------------
        */

        const collection =
            charts.collection_trend || {
                labels: [],
                data: []
            };


        collectionTrendChartObj =
            destroyChart(
                collectionTrendChartObj
            );


        collectionTrendChartObj =
            new Chart(
                document.getElementById(
                    'collectionTrendChart'
                ),
                {
                    type: 'line',

                    data: {

                        labels: collection.labels,

                        datasets: [{
                            label: 'Collection (AED)',

                            data: collection.data,

                            borderWidth: 2,

                            tension: .35,

                            fill: true
                        }]
                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        plugins: {

                            legend: {
                                display: false
                            },

                            tooltip: {

                                callbacks: {

                                    label: function (context) {

                                        return formatMoney(
                                            context.raw
                                        );

                                    }

                                }

                            }

                        },

                        scales: {

                            y: {

                                beginAtZero: true,

                                ticks: {

                                    callback: function (value) {

                                        return 'AED ' +
                                            Number(value)
                                                .toLocaleString();

                                    }

                                }

                            }

                        }

                    }

                }
            );


        /*
        |--------------------------------------------------------------------------
        | Top Services
        |--------------------------------------------------------------------------
        */

        const services =
            charts.top_services || {
                labels: [],
                data: []
            };


        topServicesChartObj =
            destroyChart(
                topServicesChartObj
            );


        topServicesChartObj =
            new Chart(
                document.getElementById(
                    'topServicesChart'
                ),
                {
                    type: 'doughnut',

                    data: {

                        labels: services.labels,

                        datasets: [{

                            data: services.data,

                            borderWidth: 1

                        }]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        plugins: {

                            legend: {
                                position: 'right'
                            },

                            tooltip: {

                                callbacks: {

                                    label: function (context) {

                                        return (
                                            context.label +
                                            ': ' +
                                            formatMoney(
                                                context.raw
                                            )
                                        );

                                    }

                                }

                            }

                        }

                    }

                }
            );


        /*
        |--------------------------------------------------------------------------
        | Top Parts
        |--------------------------------------------------------------------------
        */

        const parts =
            charts.top_parts || {
                labels: [],
                data: []
            };


        topPartsChartObj =
            destroyChart(
                topPartsChartObj
            );


        topPartsChartObj =
            new Chart(
                document.getElementById(
                    'topPartsChart'
                ),
                {
                    type: 'bar',

                    data: {

                        labels: parts.labels,

                        datasets: [{

                            label: 'Quantity Sold',

                            data: parts.data,

                            borderWidth: 1

                        }]

                    },

                    options: {

                        indexAxis: 'y',

                        responsive: true,

                        maintainAspectRatio: false,

                        plugins: {

                            legend: {
                                display: false
                            }

                        },

                        scales: {

                            x: {
                                beginAtZero: true
                            }

                        }

                    }

                }
            );


        /*
        |--------------------------------------------------------------------------
        | Payment Status
        |--------------------------------------------------------------------------
        */

        const paymentStatus =
            charts.payment_status || {
                labels: [],
                data: []
            };


        paymentStatusChartObj =
            destroyChart(
                paymentStatusChartObj
            );


        paymentStatusChartObj =
            new Chart(
                document.getElementById(
                    'paymentStatusChart'
                ),
                {
                    type: 'doughnut',

                    data: {

                        labels: paymentStatus.labels,

                        datasets: [{

                            data: paymentStatus.data,

                            borderWidth: 1

                        }]

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


    /*
    |--------------------------------------------------------------------------
    | Tables
    |--------------------------------------------------------------------------
    */

    function updateTables(data) {

        /*
        |--------------------------------------------------------------------------
        | Recent Sales
        |--------------------------------------------------------------------------
        */

        const tbodySales =
            document.getElementById(
                'tableRecentSales'
            );


        let htmlSales = '';


        if (
            data.recent_sales &&
            data.recent_sales.length > 0
        ) {

            data.recent_sales.forEach(function (row) {

                let statusClass =
                    'bg-red-100 text-red-700';


                if (row.status === 'Paid') {

                    statusClass =
                        'bg-green-100 text-green-700';

                } else if (row.status === 'Partial') {

                    statusClass =
                        'bg-yellow-100 text-yellow-700';
                }


                let dateStr = '';

                if (row.created_at) {

                    const parsedDate =
                        new Date(
                            row.created_at
                        );

                    if (!isNaN(parsedDate)) {

                        dateStr =
                            parsedDate.toLocaleDateString();

                    } else {

                        dateStr =
                            escapeHtml(
                                row.created_at
                            );
                    }
                }


                htmlSales += `

                    <tr
                        class="border-t hover:bg-gray-50 cursor-pointer"
                        onclick="window.location.href='<?= base_url("index.php/invoice/view/"); ?>${encodeURIComponent(row.invoice_id)}'"
                    >

                        <td class="px-4 py-3">

                            <span class="font-semibold text-blue-600">

                                ${escapeHtml(
                                    row.invoice_no || ''
                                )}

                            </span>

                        </td>

                        <td class="px-4 py-3">
                            ${dateStr}
                        </td>

                        <td class="px-4 py-3">

                            ${escapeHtml(
                                row.customer_name ||
                                'N/A'
                            )}

                        </td>

                        <td class="px-4 py-3 text-right font-semibold">

                            ${formatMoney(
                                row.grand_total
                            )}

                        </td>

                        <td class="px-4 py-3 text-center">

                            <span
                                class="px-2 py-1 rounded text-xs font-semibold ${statusClass}"
                            >

                                ${escapeHtml(
                                    row.status
                                )}

                            </span>

                        </td>

                    </tr>

                `;

            });

        } else {

            htmlSales = `

                <tr>

                    <td
                        colspan="5"
                        class="px-4 py-8 text-center text-gray-500"
                    >
                        No sales found for selected criteria.
                    </td>

                </tr>

            `;
        }


        tbodySales.innerHTML =
            htmlSales;


        /*
        |--------------------------------------------------------------------------
        | Customer Summary
        |--------------------------------------------------------------------------
        */

        const tbodyCustomer =
            document.getElementById(
                'tableCustomerSummary'
            );


        let htmlCustomer = '';


        if (
            data.customer_summary &&
            data.customer_summary.length > 0
        ) {

            data.customer_summary.forEach(function (row) {

                htmlCustomer += `

                    <tr class="border-t hover:bg-gray-50">

                        <td class="px-4 py-3 font-medium">

                            ${escapeHtml(
                                row.customer_name ||
                                'N/A'
                            )}

                        </td>

                        <td class="px-4 py-3 text-center">

                            ${Number(
                                row.num_invoices || 0
                            ).toLocaleString()}

                        </td>

                        <td class="px-4 py-3 text-right text-green-600 font-semibold">

                            ${formatMoney(
                                row.total_sales
                            )}

                        </td>

                        <td class="px-4 py-3 text-right text-red-600 font-semibold">

                            ${formatMoney(
                                row.outstanding
                            )}

                        </td>

                    </tr>

                `;

            });

        } else {

            htmlCustomer = `

                <tr>

                    <td
                        colspan="4"
                        class="px-4 py-8 text-center text-gray-500"
                    >
                        No customer data found.
                    </td>

                </tr>

            `;
        }


        tbodyCustomer.innerHTML =
            htmlCustomer;
    }


    /*
    |--------------------------------------------------------------------------
    | Error
    |--------------------------------------------------------------------------
    */

    function showDashboardError(message) {

        dashboardStatusText.textContent =
            'Update failed';

        dashboardStatusDot.classList.remove(
            'bg-green-500',
            'bg-yellow-500'
        );

        dashboardStatusDot.classList.add(
            'bg-red-500'
        );


        console.error(
            'Dashboard:',
            message
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    */

    filterForm.addEventListener(
        'change',
        function (event) {
            const targetId = event.target && event.target.id ? event.target.id : '';

            if (targetId === 'filterCustomer') {
                return;
            }

            const start =
                document.getElementById(
                    'filterStartDate'
                ).value;

            const end =
                document.getElementById(
                    'filterEndDate'
                ).value;

            if (start && end && start > end) {
                alert(
                    'From Date cannot be greater than To Date.'
                );

                return;
            }

            loadDashboardData(true);
        }
    );


    /*
    |--------------------------------------------------------------------------
    | Automatic Refresh
    |--------------------------------------------------------------------------
    |
    | Refresh every 60 seconds.
    |
    */

    setInterval(
        function () {

            loadDashboardData(false);

        },
        60000
    );


    /*
    |--------------------------------------------------------------------------
    | Initial Load
    |--------------------------------------------------------------------------
    */

    loadDashboardData(true);

});

</script>