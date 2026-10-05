<div class="min-h-screen bg-gray-50 relative dashboard-page">

    <style>
        .dashboard-page .card {
            transition: transform .18s ease, box-shadow .18s ease;
        }
        .dashboard-page .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
        }
        .dashboard-page .scrollbar-thin::-webkit-scrollbar { height: 6px; width: 6px; }
        .dashboard-page .scrollbar-thin::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 999px; }
        @media (max-width: 640px) {
            .dashboard-page .mobile-table { min-width: 760px; }
        }
    </style>

    <div class="absolute inset-0 bg-[url('<?= base_url("public/images/car1.png") ?>')] bg-center bg-no-repeat bg-contain opacity-[0.025] pointer-events-none"></div>

    <div class="relative z-10 p-4 md:p-6 space-y-6">

        <!-- =====================================================
             HEADER
        ====================================================== -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-5 md:p-6">
                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-5">
                    <div>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-700 text-xl">🏢</div>
                            <div>
                                <h1 class="text-xl md:text-2xl font-bold text-gray-900">
                                    <?= !empty($company_name) ? htmlspecialchars($company_name) : 'Garage Management System'; ?>
                                </h1>
                                <p class="text-sm text-gray-500 mt-1">Executive &amp; Operations Dashboard</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-stretch gap-3">
                        <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 min-w-[140px]">
                            <p class="text-[11px] text-gray-500 uppercase font-semibold">Branch</p>
                            <p class="text-sm font-semibold text-gray-800 mt-1">
                                <?= !empty($selected_branch_name) ? htmlspecialchars($selected_branch_name) : 'All Branches'; ?>
                            </p>
                        </div>
                        <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 min-w-[120px]">
                            <p class="text-[11px] text-gray-500 uppercase font-semibold">Today</p>
                            <p class="text-sm font-semibold text-gray-800 mt-1"><?= date('d M Y'); ?></p>
                        </div>
                        <!-- <button type="button" id="dashboardRefreshBtn" onclick="refreshDashboard()"
                                class="inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">
                            <span id="refreshIcon">↻</span><span>Refresh</span>
                        </button> -->
                    </div>
                </div>

                <div class="border-t border-gray-100 mt-5 pt-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                        <span>👤 Welcome, <strong class="text-gray-800"><?= !empty($username) ? htmlspecialchars($username) : 'User'; ?></strong></span>
                        <span>🕒 Last updated: <strong id="dashboardLastUpdated" class="text-gray-700"><?= date('d M Y, h:i A'); ?></strong></span>
                    </div>
                    <!-- <div class="flex items-center gap-2">
                        <label for="dashboardAutoRefresh" class="text-sm text-gray-600">Auto Refresh</label>
                        <select id="dashboardAutoRefresh" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-blue-500">
                            <option value="0">Off</option>
                            <option value="30000">30 Seconds</option>
                            <option value="60000">1 Minute</option>
                            <option value="300000" selected>5 Minutes</option>
                            <option value="900000">15 Minutes</option>
                        </select>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- =====================================================
             EXECUTIVE KPI CARDS
        ====================================================== -->
        <?php if ($can_view_reports || $can_view_purchase || $can_view_customers || $can_view_inventory || $can_view_jobcards || $can_view_accounts): ?>
        <div>
            <div class="flex items-end justify-between mb-4">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Executive Overview</h2>
                    <p class="text-sm text-gray-500 mt-1">Key financial, customer and operational indicators</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
                <?php if ($can_view_reports): ?>
                    <a href="<?= base_url('index.php/Reports/revenue' . (!$can_view_jobcards && !empty($can_view_scrap) ? '?report_type=scrap' : '')); ?>" class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <div class="flex justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase font-semibold text-gray-500">
                                    <?= (!$can_view_jobcards && !empty($can_view_scrap)) ? 'Scrap Revenue' : ((!empty($can_view_jobcards) && empty($can_view_scrap)) ? 'Job Card Revenue' : 'Revenue'); ?>
                                </p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">AED <?= number_format((float)($dashboard_summary->total_revenue ?? 0), 2); ?></p>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center text-xl">💰</div>
                        </div>
                    </a>
                <?php endif; ?>

                <?php if ($can_view_purchase): ?>
                    <a href="<?= base_url('index.php/Purchase/purchase_order_list'); ?>" class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <div class="flex justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase font-semibold text-gray-500">Purchases</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">AED <?= number_format((float)($dashboard_summary->total_purchase ?? 0), 2); ?></p>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-orange-100 flex items-center justify-center text-xl">📦</div>
                        </div>
                    </a>
                <?php endif; ?>

                <?php if ($can_view_accounts): ?>
                    <div class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <div class="flex justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase font-semibold text-gray-500">Cash / Bank</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">AED <?= number_format((float)($dashboard_summary->cash_balance ?? 0), 2); ?></p>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center text-xl">🏦</div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($can_view_customers): ?>
                    <a href="<?= base_url('index.php/customer'); ?>" class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <div class="flex justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase font-semibold text-gray-500">Customers</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2"><?= number_format((int)($dashboard_summary->active_customers ?? 0)); ?></p>
                                <p class="text-xs text-gray-500 mt-2"><?= number_format((int)($dashboard_summary->vehicles ?? 0)); ?> vehicles</p>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-purple-100 flex items-center justify-center text-xl">👥</div>
                        </div>
                    </a>
                <?php endif; ?>

                <?php if ($can_view_reports): ?>
                    <a href="<?= base_url('index.php/Reports/revenue?from=' . date('Y-m-01') . '&to=' . date('Y-m-d') . (!$can_view_jobcards && !empty($can_view_scrap) ? '&report_type=scrap' : '')); ?>" class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5 block">
                        <div class="flex justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase font-semibold text-gray-500">
                                    <?= (!$can_view_jobcards && !empty($can_view_scrap)) ? 'Monthly Scrap Revenue' : ((!empty($can_view_jobcards) && empty($can_view_scrap)) ? 'Monthly Job Revenue' : 'Monthly Revenue'); ?>
                                </p>
                                <p class="text-2xl font-bold text-gray-900 mt-2">AED <?= number_format((float)($dashboard_summary->monthly_revenue ?? 0), 2); ?></p>
                                <p class="text-xs text-green-600 mt-2">Collected: AED <?= number_format((float)($dashboard_summary->monthly_collection ?? 0), 2); ?></p>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-cyan-100 flex items-center justify-center text-xl">📊</div>
                        </div>
                    </a>
                <?php endif; ?>

                <?php if ($can_view_reports): ?>
                    <a href="<?= base_url('index.php/Reports/revenue?from=' . date('Y-m-01') . '&to=' . date('Y-m-d') . '&status=pending' . (!$can_view_jobcards && !empty($can_view_scrap) ? '&report_type=scrap' : '')); ?>" class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5 block">
                        <div class="flex justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase font-semibold text-gray-500">Monthly Pending</p>
                                <p class="text-2xl font-bold text-red-600 mt-2">AED <?= number_format((float)($dashboard_summary->monthly_pending ?? 0), 2); ?></p>
                                <p class="text-xs text-gray-500 mt-2">Collection rate: <?= number_format((float)($dashboard_summary->monthly_collection_rate ?? 0), 2); ?>%</p>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-red-100 flex items-center justify-center text-xl">⏳</div>
                        </div>
                    </a>
                <?php endif; ?>

                <?php if ($can_view_jobcards): ?>
                    <a href="<?= base_url('index.php/Jobcard'); ?>" class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <div class="flex justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase font-semibold text-gray-500">All Job Cards</p>
                                <p class="text-2xl font-bold text-gray-900 mt-2"><?= number_format((int)($dashboard_summary->active_job_cards ?? 0)); ?></p>
                                <p class="text-xs text-gray-500 mt-2">Scheduled + in progress + finished</p>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-indigo-100 flex items-center justify-center text-xl">🔧</div>
                        </div>
                    </a>
                <?php endif; ?>

                <?php if ($can_view_inventory): ?>
                    <a href="<?= base_url('index.php/SpareParts'); ?>" class="card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <div class="flex justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase font-semibold text-gray-500">Inventory Alerts</p>
                                <p class="text-2xl font-bold text-red-600 mt-2"><?= number_format((int)($dashboard_summary->low_stock_count ?? 0)); ?></p>
                                <p class="text-xs text-gray-500 mt-2">At or below minimum stock</p>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-yellow-100 flex items-center justify-center text-xl">⚠️</div>
                        </div>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- =====================================================
             QUICK ACTIONS
        ====================================================== -->
        <?php if (!empty($quick_actions)): ?>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 md:p-6">
            <div class="mb-5">
                <h2 class="text-lg font-bold text-gray-900">Quick Actions</h2>
                <p class="text-sm text-gray-500 mt-1">Frequently used GMS operations</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                <?php foreach (($quick_actions ?? []) as $action): ?>
                    <a href="<?= $action['url']; ?>" class="card border border-gray-200 rounded-xl p-4 text-center hover:border-blue-400 hover:bg-blue-50">
                        <div class="text-2xl mb-2"><?= $action['icon']; ?></div>
                        <div class="text-sm font-semibold text-gray-700"><?= htmlspecialchars($action['title']); ?></div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($can_view_reports): ?>
        <!-- =====================================================
             REVENUE VS COLLECTION
        ====================================================== -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-5 md:px-6 py-5 bg-gray-50 border-b border-gray-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Revenue vs Collection</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        <?= (!$can_view_jobcards && !empty($can_view_scrap)) ? 'Scrap revenue, collections and pending amount' : ((!empty($can_view_jobcards) && empty($can_view_scrap)) ? 'Job card revenue, collections and pending amount' : 'Revenue, collections and pending amount'); ?>
                    </p>
                </div>
                <select id="revenueFilter" class="border border-gray-300 rounded-lg px-4 py-2 text-sm bg-white focus:ring-2 focus:ring-blue-500">
                    <?php
                    $revenueOptions = [
                        'last_week' => 'Last Week',
                        'last_month' => 'Last Month',
                        '6_months' => 'Last 6 Months',
                        '12_months' => 'Last 12 Months',
                        'full_revenue' => 'Full Revenue'
                    ];
                    foreach ($revenueOptions as $value => $label):
                    ?>
                        <option value="<?= $value; ?>" <?= (($revenue_filter ?? '12_months') === $value) ? 'selected' : ''; ?>><?= $label; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php $revChart = $revenue_collection_chart ?? []; $revSummary = $revChart['summary'] ?? []; ?>
            <div class="p-5 md:p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-blue-50 rounded-xl p-4"><p class="text-xs uppercase font-semibold text-gray-500">Revenue</p><p id="summaryRevenue" class="text-xl font-bold text-blue-700 mt-1">AED <?= number_format((float)($revSummary['revenue'] ?? 0), 2); ?></p></div>
                <div class="bg-green-50 rounded-xl p-4"><p class="text-xs uppercase font-semibold text-gray-500">Collected</p><p id="summaryCollection" class="text-xl font-bold text-green-700 mt-1">AED <?= number_format((float)($revSummary['collection'] ?? 0), 2); ?></p></div>
                <div class="bg-red-50 rounded-xl p-4"><p class="text-xs uppercase font-semibold text-gray-500">Pending</p><p id="summaryPending" class="text-xl font-bold text-red-600 mt-1">AED <?= number_format((float)($revSummary['pending'] ?? 0), 2); ?></p></div>
                <div class="bg-purple-50 rounded-xl p-4"><p class="text-xs uppercase font-semibold text-gray-500">Collection Rate</p><p id="summaryPercentage" class="text-xl font-bold text-purple-700 mt-1"><?= number_format((float)($revSummary['percentage'] ?? 0), 2); ?>%</p></div>
            </div>
            <div class="p-5 md:p-6 pt-0"><div class="h-[360px]"><canvas id="revenueCollectionChart"></canvas></div></div>
        </div>
        <?php endif; ?>

        <?php if ($can_view_jobcards || $can_view_accounts): ?>
        <!-- =====================================================
             OPERATIONS + CASH
        ====================================================== -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
                    <div><h3 class="font-bold text-gray-900">Job Card Status</h3><p class="text-xs text-gray-500 mt-1">Workflow and completion</p></div>
                    <select id="jobcardStatusFilter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white">
                        <?php foreach ([
                            'last_week'=>'Last Week','last_month'=>'Last Month','6_months'=>'Last 6 Months','12_months'=>'Last 12 Months','full_jobcards'=>'Full Job Cards'
                        ] as $value=>$label): ?>
                            <option value="<?= $value; ?>" <?= (($jobcard_status_filter ?? '12_months') === $value) ? 'selected' : ''; ?>><?= $label; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="p-5"><div class="h-[300px]"><canvas id="jobcardStatusChart"></canvas></div></div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 bg-gray-50 border-b border-gray-100"><h3 class="font-bold text-gray-900">Cash &amp; Bank Balances</h3><p class="text-xs text-gray-500 mt-1">Selected branch balance by account</p></div>
                <div class="overflow-x-auto scrollbar-thin">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100"><tr><th class="px-4 py-3 text-left">Account</th><th class="px-4 py-3 text-left">Group</th><th class="px-4 py-3 text-right">Balance</th></tr></thead>
                        <tbody>
                        <?php if (!empty($balances)): foreach ($balances as $balance): ?>
                            <tr class="border-t hover:bg-gray-50"><td class="px-4 py-3 font-medium"><?= htmlspecialchars($balance->account_name); ?></td><td class="px-4 py-3 text-gray-500"><?= htmlspecialchars($balance->group_name); ?></td><td class="px-4 py-3 text-right font-semibold">AED <?= number_format((float)$balance->balance, 2); ?></td></tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="3" class="px-4 py-8 text-center text-gray-500">No cash/bank accounts found.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($can_view_inventory || $can_view_jobcards || $can_view_estimations || $can_view_inspections): ?>
        <!-- =====================================================
             ALERTS + NOTIFICATIONS
        ====================================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="flex items-center justify-between mb-4"><div><h3 class="font-bold text-gray-900">Alerts</h3><p class="text-xs text-gray-500 mt-1">Items needing attention</p></div><span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold"><?= count($low_stock_items ?? []); ?> stock</span></div>
                <div class="space-y-3">
                    <?php if (!empty($low_stock_items)): foreach (array_slice($low_stock_items, 0, 5) as $item): ?>
                        <a href="<?= base_url('index.php/SpareParts'); ?>" class="flex items-center justify-between gap-4 p-3 rounded-xl bg-gray-50 hover:bg-red-50">
                            <div><p class="font-semibold text-gray-800"><?= htmlspecialchars($item->part_name); ?></p><p class="text-xs text-gray-500 mt-1">Current stock: <?= number_format((float)$item->current_stock, 2); ?> · Minimum: <?= number_format((float)$item->min_stock, 2); ?></p></div>
                            <span class="shrink-0 px-2 py-1 rounded text-xs font-semibold <?= ((float)$item->current_stock <= 0) ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700'; ?>"><?= ((float)$item->current_stock <= 0) ? 'Out of Stock' : 'Low Stock'; ?></span>
                        </a>
                    <?php endforeach; else: ?>
                        <div class="py-8 text-center text-gray-500">No inventory alerts.</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="mb-4"><h3 class="font-bold text-gray-900">Notifications</h3><p class="text-xs text-gray-500 mt-1">Dashboard events and operational notices</p></div>
                <div class="space-y-3">
                    <?php if (!empty($dashboard_notifications)): foreach ($dashboard_notifications as $notification): ?>
                        <a href="<?= $notification->url; ?>" class="block p-3 rounded-xl border border-gray-100 hover:bg-gray-50">
                            <div class="flex items-start gap-3"><span class="text-lg"><?= ($notification->type === 'warning') ? '⚠️' : 'ℹ️'; ?></span><div><p class="font-semibold text-gray-800"><?= htmlspecialchars($notification->title); ?></p><p class="text-xs text-gray-500 mt-1"><?= htmlspecialchars($notification->message); ?></p></div></div>
                        </a>
                    <?php endforeach; else: ?>
                        <div class="py-8 text-center text-gray-500">No new notifications.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($can_view_jobcards): ?>
        <!-- =====================================================
             JOB PROGRESS
        ====================================================== -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between"><div><h3 class="font-bold text-gray-900">Job Progress</h3><p class="text-xs text-gray-500 mt-1">Latest job-card service completion</p></div><a href="<?= base_url('index.php/jobcard'); ?>" class="text-sm text-blue-600 hover:underline">View All</a></div>
            <div class="overflow-x-auto scrollbar-thin"><table class="min-w-full mobile-table text-sm"><thead class="bg-gray-100"><tr><th class="px-4 py-3 text-left">Job Card</th><th class="px-4 py-3 text-left">Customer</th><th class="px-4 py-3 text-left">Vehicle</th><th class="px-4 py-3 text-center">Jobs</th><th class="px-4 py-3 text-center">Progress</th></tr></thead>
                <tbody>
                <?php if (!empty($jobcardProgress)): foreach ($jobcardProgress as $row): $total = (int)($row->total_jobs ?? 0); $completed = (int)($row->completed_jobs ?? 0); $percent = $total > 0 ? min(100, round(($completed/$total)*100)) : 0; ?>
                    <tr class="border-t hover:bg-gray-50"><td class="px-4 py-3 font-semibold"><?= htmlspecialchars($row->jobcard_no); ?></td><td class="px-4 py-3"><?= htmlspecialchars($row->customer_name ?? '—'); ?></td><td class="px-4 py-3"><?= htmlspecialchars($row->registration_no ?? '—'); ?></td><td class="px-4 py-3 text-center"><?= $completed; ?> / <?= $total; ?></td><td class="px-4 py-3"><div class="flex justify-between text-xs mb-1"><span>Completion</span><span class="font-semibold"><?= $percent; ?>%</span></div><div class="h-2.5 bg-gray-200 rounded-full overflow-hidden"><div class="h-full rounded-full <?= $percent >= 100 ? 'bg-green-500' : ($percent >= 50 ? 'bg-blue-500' : 'bg-yellow-500'); ?>" style="width: <?= $percent; ?>%"></div></div></td></tr>
                <?php endforeach; else: ?><tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No job progress records found.</td></tr><?php endif; ?>
                </tbody></table></div>
        </div>
        <?php endif; ?>

        <?php if ($can_view_jobcards): ?>
        <!-- =====================================================
             ACTIVE JOB CARDS
        ====================================================== -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between"><div><h3 class="font-bold text-gray-900">Active Job Cards</h3><p class="text-xs text-gray-500 mt-1">Pending and in-progress vehicles</p></div><a href="<?= base_url('index.php/jobcard'); ?>" class="text-sm text-blue-600 hover:underline">View All</a></div>
            <div class="overflow-x-auto scrollbar-thin"><table class="min-w-full mobile-table text-sm"><thead class="bg-gray-100"><tr><th class="px-4 py-3 text-left">Job Card No</th><th class="px-4 py-3">Vehicle</th><th class="px-4 py-3">Customer</th><th class="px-4 py-3">Technician</th><th class="px-4 py-3 text-center">Status</th><th class="px-4 py-3 text-center">Expected Delivery</th><th class="px-4 py-3 text-center">Action</th></tr></thead>
                <tbody>
                <?php if (!empty($active_job_cards)): foreach ($active_job_cards as $jc): 
                    $jobCardStatus = trim((string)($jc->normalized_status ?? $jc->status ?? ''));
                    if ($jobCardStatus === '') { $jobCardStatus = 'Finished'; }

                    $jobCardStatusClass = 'bg-blue-100 text-blue-700';
                    if ($jobCardStatus === 'Pending') {
                        $jobCardStatusClass = 'bg-yellow-100 text-yellow-700';
                    } elseif ($jobCardStatus === 'Scheduled') {
                        $jobCardStatusClass = 'bg-slate-100 text-slate-700';
                    } elseif ($jobCardStatus === 'Finished') {
                        $jobCardStatusClass = 'bg-green-100 text-green-700';
                    } elseif ($jobCardStatus === 'In Progress') {
                        $jobCardStatusClass = 'bg-indigo-100 text-indigo-700';
                    }

                    $jobCardTechnician = trim((string)($jc->technician_name ?? ''));
                    if ($jobCardTechnician === '') { $jobCardTechnician = 'Unassigned'; }
                ?>
                    <tr class="border-t hover:bg-gray-50"><td class="px-4 py-3 font-semibold"><?= htmlspecialchars($jc->jobcard_no); ?></td><td class="px-4 py-3 text-center"><?= htmlspecialchars($jc->registration_no); ?></td><td class="px-4 py-3 text-center"><?= htmlspecialchars($jc->customer_name); ?></td><td class="px-4 py-3 text-center"><?= htmlspecialchars($jobCardTechnician); ?></td><td class="px-4 py-3 text-center"><span class="px-2 py-1 rounded text-xs <?= $jobCardStatusClass; ?>"><?= htmlspecialchars($jobCardStatus); ?></span></td>
                  <td class="px-4 py-3 text-center">
    <?php
    $deliveryDate = $jc->expected_delivery_date ?? '';

    if (
        empty($deliveryDate) ||
        strpos($deliveryDate, '0000-00-00') === 0
    ) {
        echo 'N/A';
    } else {
        echo date('d-m-Y', strtotime($deliveryDate));
    }
    ?>
</td>
                    <td class="px-4 py-3 text-center"><a href="<?= base_url('index.php/jobcard/view/' . $jc->jobcard_id); ?>" class="px-3 py-1 rounded bg-green-600 text-white text-xs hover:bg-green-700">View</a></td></tr>
                <?php endforeach; else: ?><tr><td colspan="7" class="px-4 py-8 text-center text-gray-500">No active job cards found.</td></tr><?php endif; ?>
                </tbody></table></div>
        </div>
        <?php endif; ?>

        <?php if ($can_view_estimations || $can_view_inspections): ?>
        <!-- =====================================================
             RECENT ESTIMATIONS + INSPECTIONS
        ====================================================== -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between"><h3 class="font-bold text-gray-900">Recent Estimations</h3><a href="<?= base_url('index.php/estimation'); ?>" class="text-sm text-blue-600 hover:underline">View All</a></div>
                <div class="overflow-x-auto scrollbar-thin"><table class="min-w-full text-sm"><thead class="bg-gray-100"><tr><th class="px-4 py-3 text-left">No</th><th class="px-4 py-3 text-left">Customer</th><th class="px-4 py-3">Vehicle</th><th class="px-4 py-3 text-right">Amount</th><th class="px-4 py-3 text-center">Status</th></tr></thead><tbody>
                <?php if (!empty($recent_estimations)): foreach ($recent_estimations as $e): 
                    $estimationStatus = trim((string)($e->normalized_status ?? $e->status ?? ''));
                    if ($estimationStatus === '') { $estimationStatus = 'Draft'; }

                    $estimationStatusClass = 'bg-gray-100 text-gray-700';
                    if ($estimationStatus === 'Approved') {
                        $estimationStatusClass = 'bg-green-100 text-green-700';
                    } elseif ($estimationStatus === 'Rejected') {
                        $estimationStatusClass = 'bg-red-100 text-red-700';
                    } elseif ($estimationStatus === 'Converted') {
                        $estimationStatusClass = 'bg-indigo-100 text-indigo-700';
                    } elseif ($estimationStatus === 'Pending') {
                        $estimationStatusClass = 'bg-yellow-100 text-yellow-700';
                    }
                ?><tr class="border-t hover:bg-gray-50"><td class="px-4 py-3 font-semibold"><?= htmlspecialchars($e->estimation_no); ?></td><td class="px-4 py-3"><?= htmlspecialchars($e->customer_name); ?></td><td class="px-4 py-3 text-center"><?= htmlspecialchars($e->registration_no); ?></td><td class="px-4 py-3 text-right">AED <?= number_format((float)$e->grand_total, 2); ?></td><td class="px-4 py-3 text-center"><span class="px-2 py-1 rounded text-xs <?= $estimationStatusClass; ?>"><?= htmlspecialchars($estimationStatus); ?></span></td></tr><?php endforeach; else: ?><tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No recent estimations found.</td></tr><?php endif; ?>
                </tbody></table></div>
            </div> 

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between"><h3 class="font-bold text-gray-900">Recent Inspections</h3><a href="<?= base_url('index.php/inspection'); ?>" class="text-sm text-blue-600 hover:underline">View All</a></div>
                <div class="overflow-x-auto scrollbar-thin"><table class="min-w-full text-sm"><thead class="bg-gray-100"><tr><th class="px-4 py-3">Date</th><th class="px-4 py-3 text-left">Customer</th><th class="px-4 py-3">Vehicle</th><th class="px-4 py-3">KM</th><th class="px-4 py-3">Status</th></tr></thead><tbody>
                <?php if (!empty($recent_inspections)): foreach ($recent_inspections as $i): 
                    $inspectionStatus = trim((string)($i->status ?? '')); 
                    $inspectionStatusClass = 'bg-slate-100 text-slate-700'; 
                    if ($inspectionStatus === 'Draft') {
                         $inspectionStatusClass = 'bg-gray-100 text-gray-700'; 
                        } elseif ($inspectionStatus === 'Completed') 
                        { $inspectionStatusClass = 'bg-blue-100 text-blue-700'; } 
                        else
                        {
                            $inspectionStatus = 'Approved';
                             $inspectionStatusClass = 'bg-green-100 text-green-700'; } 
                             ?>
                <tr class="border-t hover:bg-gray-50"><td class="px-4 py-3 text-center"><?= !empty($i->inspection_date) ? date('d-m-Y', strtotime($i->inspection_date)) : '—'; ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($i->customer_name); ?></td>
                <td class="px-4 py-3 text-center"><?= htmlspecialchars($i->registration_no); ?></td>
                <td class="px-4 py-3 text-center"><?= htmlspecialchars($i->km_reading ?? '—'); ?></td>
                <td class="px-4 py-3 text-center"><span class="px-2 py-1 rounded text-xs <?= $inspectionStatusClass; ?>"><?= htmlspecialchars($inspectionStatus !== '' ? $inspectionStatus : '—'); ?></span></td>
            </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No recent inspections found.</td></tr><?php endif; ?>
                </tbody></table></div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function () {
    'use strict';

    const revenueChartData = <?= json_encode($revenue_collection_chart ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;
    const jobcardChartData = <?= json_encode($jobcard_status_chart ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

    let revenueChart = null;
    let jobcardChart = null;
    let dashboardRefreshTimer = null;

    function money(value) {
        return 'AED ' + Number(value || 0).toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function createRevenueChart(data) {
        const canvas = document.getElementById('revenueCollectionChart');
        if (!canvas || typeof Chart === 'undefined') return;
        if (revenueChart) revenueChart.destroy();

        revenueChart = new Chart(canvas.getContext('2d'), {
            type: 'line',
            data: {
                labels: data.labels || [],
                datasets: [
                    { label: 'Revenue', data: data.revenue || [], borderWidth: 3, tension: .35, fill: false },
                    { label: 'Collected', data: data.collection || [], borderWidth: 3, tension: .35, fill: false },
                    { label: 'Pending', data: data.pending || [], borderWidth: 2, borderDash: [6, 5], tension: .35, fill: false }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: { legend: { position: 'top' }, tooltip: { callbacks: { label: ctx => ctx.dataset.label + ': ' + money(ctx.parsed.y) } } },
                scales: { y: { beginAtZero: true, ticks: { callback: value => money(value) } } }
            }
        });
    }

    function createJobcardChart(data) {
        const canvas = document.getElementById('jobcardStatusChart');
        if (!canvas || typeof Chart === 'undefined') return;
        if (jobcardChart) jobcardChart.destroy();

        jobcardChart = new Chart(canvas.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Scheduled', 'In Progress', 'Finished'],
                datasets: [{ data: [Number(data.scheduled || 0), Number(data.in_progress || 0), Number(data.finished || 0)], borderWidth: 2 }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    function redirectWithParam(name, value) {
        const url = new URL(window.location.href);
        url.searchParams.set(name, value);
        window.location.href = url.toString();
    }

    window.refreshDashboard = function () {
        const button = document.getElementById('dashboardRefreshBtn');
        const icon = document.getElementById('refreshIcon');
        if (button) button.disabled = true;
        if (icon) icon.classList.add('animate-spin');
        window.location.reload();
    };

    function updateLastUpdated() {
        const el = document.getElementById('dashboardLastUpdated');
        if (!el) return;
        el.textContent = new Date().toLocaleString(undefined, {
            day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit'
        });
    }

    function configureAutoRefresh() {

        // Silent automatic dashboard refresh every 3 minutes
        const AUTO_REFRESH_INTERVAL = 3 * 60 * 1000;

        if (dashboardRefreshTimer) {
            clearInterval(dashboardRefreshTimer);
        }

        dashboardRefreshTimer = setInterval(function () {
            window.location.reload();
        }, AUTO_REFRESH_INTERVAL);
    }

    document.addEventListener('DOMContentLoaded', function () {
        createRevenueChart(revenueChartData);
        createJobcardChart(jobcardChartData);
        configureAutoRefresh();
        updateLastUpdated();

        const revenueFilter = document.getElementById('revenueFilter');
        if (revenueFilter) revenueFilter.addEventListener('change', function () {
            redirectWithParam('revenue_filter', this.value);
        });

        const jobcardFilter = document.getElementById('jobcardStatusFilter');
        if (jobcardFilter) jobcardFilter.addEventListener('change', function () {
            redirectWithParam('jobcard_status_filter', this.value);
        });
    });
})();
</script>
