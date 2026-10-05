<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-5">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Fleet Statement of Account</h2>
            <?php if (!empty($customer)): ?>
                <p class="text-sm text-gray-500 flex flex-wrap gap-2 items-center mt-1">
                    <?php if (!empty($from) && !empty($to)): ?>
                        <span>From <b><?= date('d M Y', strtotime($from)) ?></b> to <b><?= date('d M Y', strtotime($to)) ?></b></span>
                    <?php else: ?>
                        <span>All transactions</span>
                    <?php endif; ?>
                    <?php if (!empty($vehicle_id)): ?>
                        <?php
                            $selected_veh = null;
                            foreach ($customer_vehicles as $cv) {
                                if ($cv->vehicle_id == $vehicle_id) { $selected_veh = $cv; break; }
                            }
                        ?>
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                            🚗 <?= $selected_veh ? htmlspecialchars($selected_veh->registration_no . ' (' . trim($selected_veh->brand . ' ' . $selected_veh->model) . ')') : 'Vehicle #' . $vehicle_id ?>
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($aging_filter)): ?>
                        <span class="px-2 py-0.5 bg-orange-100 text-orange-700 rounded-full text-xs font-semibold">
                            ⏱ Aging: <?= htmlspecialchars($aging_filter) ?> Days
                        </span>
                    <?php endif; ?>
                   <!-- Status filter removed -->
                </p>
            <?php endif; ?>
        </div>
        <?php if (!empty($customer) && !empty($soa)): ?>
        <a href="<?= base_url('index.php/Reports/print_fleet_soa') ?>?customer_id=<?= $customer_id ?>&from=<?= $from ?>&to=<?= $to ?>&vehicle_id=<?= $vehicle_id ?>&aging_filter=<?= urlencode($aging_filter) ?>&payment_filter=<?= urlencode($payment_filter ?? '') ?>"
          target="_blank"
           class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 text-sm flex items-center gap-2">
            Print SOA
        </a>
        <?php endif; ?>
    </div>

    <!-- FILTER FORM -->
    <form method="get" class="flex flex-wrap items-end gap-3 mb-6
                              bg-gray-50 border border-gray-200 rounded-xl p-4">
        <div class="flex flex-col gap-1 flex-1 min-w-[200px]">
            <label class="text-xs text-gray-500 font-medium">Fleet Customer</label>
            <select name="customer_id"
                    class="border rounded px-3 py-2 text-sm bg-white"
                    onchange="this.form.submit()">
                <option value="">-- Select Customer --</option>
                <?php foreach ($fleet_customers as $fc): ?>
                    <option value="<?= $fc->customer_id ?>"
                        <?= ($customer_id == $fc->customer_id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($fc->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if (!empty($customer_vehicles)): ?>
        <div class="flex flex-col gap-1 min-w-[180px]">
            <label class="text-xs text-gray-500 font-medium">Vehicle <span class="text-gray-400">(optional)</span></label>
            <select name="vehicle_id" class="border rounded px-3 py-2 text-sm bg-white">
                <option value="">-- All Vehicles --</option>
                <?php foreach ($customer_vehicles as $veh): ?>
                    <option value="<?= $veh->vehicle_id ?>"
                        <?= ($vehicle_id == $veh->vehicle_id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($veh->registration_no) ?>
                        <?php if (!empty($veh->brand) || !empty($veh->model)): ?>
                            (<?= htmlspecialchars(trim($veh->brand . ' ' . $veh->model)) ?>)
                        <?php endif; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php else: ?>
        <input type="hidden" name="vehicle_id" value="">
        <?php endif; ?>
        <div class="flex flex-col gap-1">
            <label class="text-xs text-gray-500 font-medium">From <span class="text-gray-400">(optional)</span></label>
            <input type="date" name="from" value="<?= $from ?>"
                   class="border rounded px-3 py-2 text-sm">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-xs text-gray-500 font-medium">To <span class="text-gray-400">(optional)</span></label>
            <input type="date" name="to" value="<?= $to ?>"
                   class="border rounded px-3 py-2 text-sm">
        </div>
        <div class="flex flex-col gap-1 min-w-[150px]">
            <label class="text-xs text-gray-500 font-medium">Aging Bucket <span class="text-gray-400">(optional)</span></label>
            <select name="aging_filter" class="border rounded px-3 py-2 text-sm bg-white">
                <option value="">-- All Aging --</option>
                <option value="0-30"   <?= ($aging_filter === '0-30')   ? 'selected' : '' ?>>0–30 Days (Current)</option>
                <option value="31-60"  <?= ($aging_filter === '31-60')  ? 'selected' : '' ?>>31–60 Days</option>
                <option value="61-90"  <?= ($aging_filter === '61-90')  ? 'selected' : '' ?>>61–90 Days</option>
                <option value="91-120" <?= ($aging_filter === '91-120') ? 'selected' : '' ?>>91–120 Days</option>
                <option value="120+"   <?= ($aging_filter === '120+')   ? 'selected' : '' ?>>120+ Days</option>
            </select>
        </div>
        <!-- Status filter removed -->
        <!-- Payment filter removed: fleet customers pay cumulatively via journal -->
        <button type="submit"
                class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm self-end">
            Generate
        </button>
    </form>

    <?php if (!empty($customer)): ?>

        <!-- CUSTOMER INFO STRIP -->
        <div class="flex flex-wrap gap-x-6 gap-y-2 bg-blue-50 border border-blue-100
                    rounded-xl px-4 py-3 mb-5 text-sm">
            <div>
                <span class="text-gray-500">Customer:</span>
                <strong class="ml-1"><?= htmlspecialchars($customer->name) ?></strong>
            </div>
            <?php if (!empty($customer->phone)): ?>
            <div>
                <span class="text-gray-500">Phone:</span>
                <span class="ml-1"><?= htmlspecialchars($customer->phone) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($customer->email)): ?>
            <div>
                <span class="text-gray-500">Email:</span>
                <span class="ml-1"><?= htmlspecialchars($customer->email) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($customer->trn)): ?>
            <div>
                <span class="text-gray-500">TRN:</span>
                <span class="ml-1"><?= htmlspecialchars($customer->trn) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($customer->address)): ?>
            <div>
                <span class="text-gray-500">Address:</span>
                <span class="ml-1"><?= htmlspecialchars($customer->address) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($customer->company_contact_person)): ?>
            <div>
                <span class="text-gray-500">Contact person:</span>
                <span class="ml-1"><?= htmlspecialchars($customer->company_contact_person) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($customer->credit_limit) && $customer->credit_limit > 0): ?>
            <div>
                <span class="text-gray-500">Credit limit:</span>
                <span class="ml-1 font-semibold">AED <?= number_format($customer->credit_limit, 2) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($customer->payment_terms)): ?>
            <div>
                <span class="text-gray-500">Payment terms:</span>
                <span class="ml-1"><?= $customer->payment_terms ?> days</span>
            </div>
            <?php endif; ?>
        </div>

        <!-- ACCOUNT SUMMARY CARDS -->
        <?php
            $s              = $summary;
            $balance_due    = $s['balance_due'];
            $total_invoiced = $s['total_invoiced'];
            $total_paid     = $s['total_paid'];
            $total_vat      = $s['total_vat'];
            $gl_opening_bal = $s['gl_opening_bal'] ?? 0;
            $gl_opening_date = $s['gl_opening_date'] ?? null;
        ?>

        <!-- Opening Balance Card -->
        <?php if ($gl_opening_bal != 0 || !empty($gl_opening_date)): ?>
        <div class="mb-4 bg-yellow-50 border border-yellow-200 rounded-xl px-4 py-3 flex items-center gap-4 text-sm">
            <div class="text-yellow-700 font-semibold text-base">📋 Account Opening Balance</div>
            <div class="text-gray-600">
                <span class="font-bold text-yellow-800">AED <?= number_format($gl_opening_bal, 2) ?></span>
                <?php if ($gl_opening_date): ?>
                    &nbsp;·&nbsp; Opened on <span class="font-medium"><?= $gl_opening_date ?></span>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

       <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4">
            <div class="bg-blue-50 p-4 rounded-xl">
                <p class="text-sm text-gray-500">Total Invoiced</p>
                <h3 class="text-2xl font-bold text-blue-700">AED <?= number_format($total_invoiced, 2) ?></h3>
            </div>
            <div class="bg-green-50 p-4 rounded-xl">
                <p class="text-sm text-gray-500">Total Paid</p>
                <h3 class="text-2xl font-bold text-green-700">AED <?= number_format($total_paid, 2) ?></h3>
            </div>
            <div class="bg-red-50 p-4 rounded-xl">
                <p class="text-sm text-gray-500">Balance</p>
                <h3 class="text-2xl font-bold text-red-700">AED <?= number_format($balance_due, 2) ?></h3>
            </div>
            <div class="bg-orange-50 p-4 rounded-xl">
                <p class="text-sm text-gray-500">Due Amount</p>
                <?php $due_amount = $s['due_amount'] ?? 0; ?>
                <h3 class="text-2xl font-bold text-orange-700">AED <?= number_format($due_amount, 2) ?></h3>
                <?php if (!empty($customer->payment_terms)): ?>
                <p class="text-xs text-gray-400 mt-1">Past <?= $customer->payment_terms ?>-day terms</p>
                <?php endif; ?>
            </div>
            <div class="bg-purple-50 p-4 rounded-xl">
                <p class="text-sm text-gray-500">VAT Collected</p>
                <h3 class="text-2xl font-bold text-purple-700">AED <?= number_format($total_vat, 2) ?></h3>
            </div>
        </div>

        <!-- AGING SUMMARY -->
        <p class="text-xs text-gray-500 mb-2">Outstanding by age — payments applied oldest-first (120+ days cleared first)</p>
        <?php
            $aging_buckets = [
                ['label' => '0–30 Days',    'gross' => $s['bucket_0_30_gross'],    'paid' => $s['bucket_0_30_paid'],    'balance' => $s['bucket_0_30'],    'bg' => 'bg-blue-50 border-blue-200',   'color' => 'text-blue-700'],
                ['label' => '31–60 Days',   'gross' => $s['bucket_31_60_gross'],   'paid' => $s['bucket_31_60_paid'],   'balance' => $s['bucket_31_60'],   'bg' => 'bg-yellow-50 border-yellow-200','color' => 'text-yellow-700'],
                ['label' => '61–90 Days',   'gross' => $s['bucket_61_90_gross'],   'paid' => $s['bucket_61_90_paid'],   'balance' => $s['bucket_61_90'],   'bg' => 'bg-orange-50 border-orange-200','color' => 'text-orange-700'],
                ['label' => '91–120 Days',  'gross' => $s['bucket_91_120_gross'],  'paid' => $s['bucket_91_120_paid'],  'balance' => $s['bucket_91_120'],  'bg' => 'bg-red-50 border-red-200',     'color' => 'text-red-700'],
                ['label' => '120+ Days',    'gross' => $s['bucket_120plus_gross'], 'paid' => $s['bucket_120plus_paid'], 'balance' => $s['bucket_120plus'], 'bg' => 'bg-red-100 border-red-300',    'color' => 'text-red-900'],
            ];
        ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3 mb-6">
            <?php foreach ($aging_buckets as $ab): ?>
            <div class="<?= $ab['bg'] ?> border p-3 rounded-xl">
                <p class="text-xs font-semibold text-gray-600 mb-2 text-center"><?= $ab['label'] ?></p>
                <div class="flex justify-between text-xs text-gray-500 mb-0.5">
                    <span>Invoiced</span>
                    <span class="font-semibold text-gray-700">AED <?= number_format($ab['gross'], 2) ?></span>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mb-0.5">
                    <span>Paid</span>
                    <span class="font-semibold text-green-700">AED <?= number_format($ab['paid'], 2) ?></span>
                </div>
                <div class="flex justify-between text-xs font-bold mt-1 pt-1 border-t border-gray-200">
                    <span class="<?= $ab['color'] ?>">Balance</span>
                    <span class="<?= $ab['color'] ?>">AED <?= number_format($ab['balance'], 2) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- VEHICLE-WISE METRICS (shown when no vehicle filter, summarises per vehicle) -->
        <?php if (empty($vehicle_id) && !empty($soa)): ?>
        <?php
            $veh_metrics = [];
            foreach ($soa as $row) {
                if ($row->txn_type === 'Opening Balance' || empty($row->registration_no)) continue;
                $key = $row->registration_no;
                if (!isset($veh_metrics[$key])) {
                    $veh_metrics[$key] = [
                        'reg'     => $row->registration_no,
                        'vehicle' => trim(($row->brand ?? '') . ' ' . ($row->model ?? '')),
                        'invoiced'=> 0,
                        'paid'    => 0,
                    ];
                }
                $veh_metrics[$key]['invoiced'] += $row->debit;
                $veh_metrics[$key]['paid']     += $row->credit;
            }
        ?>
        <?php if (!empty($veh_metrics)): ?>
        <div class="mb-5">
            <p class="text-sm font-semibold text-gray-600 mb-2">Vehicle-wise Summary</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3">
                <?php foreach ($veh_metrics as $vm): ?>
                <div class="bg-white border border-gray-200 rounded-xl p-3 shadow-sm">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded-full">
                            <?= htmlspecialchars($vm['reg']) ?>
                        </span>
                        <!-- status removed -->
                    </div>
                    <?php if (!empty($vm['vehicle'])): ?>
                    <p class="text-xs text-gray-400 mb-2"><?= htmlspecialchars($vm['vehicle']) ?></p>
                    <?php endif; ?>
                    <div class="flex justify-between text-xs text-gray-500 mb-0.5">
                        <span>Total Invoiced</span>
                        <span class="font-semibold text-gray-700">AED <?= number_format($vm['invoiced'], 2) ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        <!-- LEDGER TABLE -->
        <?php if (!empty($soa)): ?>
            <p class="text-sm font-medium text-gray-600 mb-2">Transaction Ledger</p>
            <table id="soaTable" class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-3 py-2 text-left">#</th>
                        <th class="px-3 py-2 text-left">Date</th>
                        <th class="px-3 py-2 text-left">Type</th>
                        <th class="px-3 py-2 text-left">Reference</th>
                        <th class="px-3 py-2 text-left">Job Card</th>
                        <th class="px-3 py-2 text-left">Vehicle</th>
                        <th class="px-3 py-2 text-right">Debit (AED)</th>
                        <th class="px-3 py-2 text-right">Credit (AED)</th>
                        <th class="px-3 py-2 text-right">Balance (AED)</th>
                        <th class="px-3 py-2 text-center">Aging</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($soa as $row):
                        $is_ob      = ($row->txn_type === 'Opening Balance');
                        if ($is_ob) continue;
                        $is_invoice = ($row->debit > 0);
                        $row_bg     = $is_invoice ? '' : 'bg-gray-50';
                    ?>
                    <tr class="<?= $row_bg ?> border-b border-gray-100">
                        <td class="px-3 py-2"><?= $i++ ?></td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <?= date('d-m-Y', strtotime($row->txn_date)) ?>
                        </td>
                        <td class="px-3 py-2">
                            <?php if ($is_ob): ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Opening Balance</span>
                            <?php elseif ($is_invoice): ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Invoice</span>
                            <?php else: ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    <?= htmlspecialchars($row->txn_type) ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-3 py-2">
                            <?php if ($is_invoice): ?>
                                <a href="<?= base_url('index.php/invoice/view/' . $row->invoice_id) ?>"
                                   class="text-blue-600 hover:underline">
                                    <?= htmlspecialchars($row->invoice_no) ?>
                                </a>
                            <?php elseif ($is_ob && !empty($row->gl_opening_date)): ?>
                                <span class="text-xs text-gray-500">Since <?= date('d M Y', strtotime($row->gl_opening_date)) ?></span>
                            <?php elseif (!$is_invoice && !empty($row->invoice_no)): ?>
                                <span class="text-gray-700 text-xs"><?= htmlspecialchars($row->invoice_no) ?></span>
                            <?php else: ?>
                                <span class="text-gray-400 text-xs">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-3 py-2 text-gray-600"><?= $is_ob ? '—' : htmlspecialchars($row->jobcard_no ?? '—') ?></td>
                        <td class="px-3 py-2 text-gray-600">
                            <?php if ($is_ob): ?>
                                —
                            <?php else: ?>
                                <?php
                                    $veh = trim(($row->brand ?? '') . ' ' . ($row->model ?? ''));
                                    $reg = $row->registration_no ?? '';
                                    echo htmlspecialchars($veh ? "$veh · $reg" : ($reg ?: '—'));
                                ?>
                            <?php endif; ?>
                        </td>
                        <td class="px-3 py-2 text-right font-semibold text-red-700">
                            <?= $row->debit > 0 ? number_format($row->debit, 2) : '—' ?>
                        </td>
                        <td class="px-3 py-2 text-right font-semibold text-green-700">
                            <?= $row->credit > 0 ? number_format($row->credit, 2) : '—' ?>
                        </td>
                        <td class="px-3 py-2 text-right font-semibold <?= $row->balance > 0 ? 'text-red-700' : 'text-green-700' ?>">
                            <?= number_format(abs($row->balance), 2) ?>
                            <?= $row->balance > 0 ? '<span class="text-xs font-normal text-red-400">Dr</span>' : ($row->balance < 0 ? '<span class="text-xs font-normal text-green-400">Cr</span>' : '') ?>
                        </td>
                        <td class="px-3 py-2 text-center">
                            <?= !empty($row->aging_bucket) ? htmlspecialchars($row->aging_bucket) : '—' ?>
                        </td>
                        <!-- status column removed -->
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                   <tr class="bg-gray-100 font-semibold text-sm">
                        <td colspan="6" class="px-3 py-2 text-right text-gray-500">Totals</td>
                        <td class="px-3 py-2 text-right text-red-700"><?= number_format($total_invoiced, 2) ?></td>
                        <td class="px-3 py-2 text-right text-green-700"><?= number_format($total_paid, 2) ?></td>
                        <td class="px-3 py-2 text-right <?= $balance_due > 0 ? 'text-red-700' : 'text-green-700' ?>">
                            <?= number_format(abs($balance_due), 2) ?>
                            <?= $balance_due > 0 ? '<span class="text-xs font-normal">Dr</span>' : '<span class="text-xs font-normal">Cr</span>' ?>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

        <?php else: ?>
            <p class="text-center text-gray-400 py-10 text-sm">No transactions found.</p>
        <?php endif; ?>

    <?php else: ?>
        <?php if (!empty($vehicles_with_inv)): ?>
        <div class="mt-8">
            <p class="text-sm font-semibold text-gray-700 mb-3">Vehicles & Invoice Summary</p>
            <div class="overflow-x-auto">
                <table class="w-full text-sm border border-gray-200 rounded-xl overflow-hidden">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 text-xs uppercase">
                            <th class="px-4 py-2 text-left">Reg No.</th>
                            <th class="px-4 py-2 text-left">Vehicle</th>
                            <th class="px-4 py-2 text-left">Year</th>
                            <th class="px-4 py-2 text-center">Invoices</th>
                            <th class="px-4 py-2 text-right">Total Billed (AED)</th>
                            <th class="px-4 py-2 text-right">Total Paid (AED)</th>
                            <th class="px-4 py-2 text-right">Outstanding (AED)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicles_with_inv as $veh): ?>
                        <tr class="border-t border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-blue-700"><?= htmlspecialchars($veh->registration_no) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars(trim($veh->brand . ' ' . $veh->model)) ?></td>
                            <td class="px-4 py-2 text-gray-500"><?= htmlspecialchars($veh->year ?? '—') ?></td>
                            <td class="px-4 py-2 text-center">
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700"><?= $veh->invoice_count ?></span>
                            </td>
                            <td class="px-4 py-2 text-right"><?= number_format($veh->total_billed, 2) ?></td>
                            <td class="px-4 py-2 text-right text-green-700"><?= number_format($veh->total_paid_v, 2) ?></td>
                            <td class="px-4 py-2 text-right font-semibold <?= $veh->outstanding > 0 ? 'text-red-700' : 'text-green-700' ?>">
                                <?= number_format($veh->outstanding, 2) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <p class="text-center text-gray-400 py-10 text-sm">
            Select a fleet customer to generate the statement.
        </p>

    <?php endif; ?>

</div>

<!-- DATATABLE -->
<?php if (!empty($soa)): ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        new simpleDatatables.DataTable("#soaTable", {
            searchable: true,
            fixedHeight: true,
            perPage: 25,
            labels: {
                placeholder: "Search transactions...",
                noRows: "No transactions found",
                info: "Showing {start} to {end} of {rows} entries"
            }
        });
    });
</script>
<?php endif; ?>