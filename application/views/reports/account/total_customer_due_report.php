<div class="bg-white shadow-md rounded-xl p-6">
    <div class="text-center mb-5">
        <h2 class="text-2xl font-bold uppercase">Total Customer Due Report</h2>
        <p class="text-sm text-gray-500 mt-1">
            Pending customer ledger balances as of
            <strong><?php echo date('d M Y', strtotime($to)); ?></strong>
        </p>
    </div>

    <form class="no-print flex flex-wrap items-end gap-4" action="<?php echo base_url('index.php/Accounts/search_total_customer_due_report'); ?>" method="post">
        <div>
            <label class="block text-sm font-medium mb-1" for="to">As of date</label>
            <input type="date" name="to" id="to" value="<?php echo htmlspecialchars($to); ?>" class="border border-gray-300 rounded-md px-3 py-2 text-sm" required>
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">Generate</button>
    </form>

    <div class="no-print flex gap-3 mt-4">
        <form method="post" action="<?php echo base_url('index.php/Accounts/total_customer_due_print'); ?>" target="_blank">
            <input type="hidden" name="to" value="<?php echo htmlspecialchars($to, ENT_QUOTES, 'UTF-8'); ?>">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg shadow">
                <i class="fa fa-print mr-1"></i> Print
            </button>
        </form>
        <form method="post" action="<?php echo base_url('index.php/Accounts/total_customer_due_export'); ?>">
            <input type="hidden" name="to" value="<?php echo htmlspecialchars($to, ENT_QUOTES, 'UTF-8'); ?>">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                <i class="fa fa-file-excel-o mr-1"></i> Export to Excel
            </button>
        </form>
    </div>

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full text-sm border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border text-left">S.No</th>
                    <th class="p-3 border text-left">Customer</th>
                    <th class="p-3 border text-left">Ledger</th>
                    <th class="p-3 border text-right">Opening Balance</th>
                    <th class="p-3 border text-right">Debit</th>
                    <th class="p-3 border text-right">Credit</th>
                    <th class="p-3 border text-right">Customer Due</th>
                    <th class="p-3 border text-center">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_due = 0; ?>
                <?php if (!empty($records)) : ?>
                    <?php foreach ($records as $index => $row) : ?>
                        <?php $total_due += (float) $row->due_amount; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border"><?php echo $index + 1; ?></td>
                            <td class="p-3 border"><?php echo htmlspecialchars($row->customer_name); ?></td>
                            <td class="p-3 border"><?php echo htmlspecialchars($row->account_name); ?></td>
                            <td class="p-3 border text-right"><?php echo number_format((float) $row->opening_balance, 2); ?></td>
                            <td class="p-3 border text-right"><?php echo number_format((float) $row->debit, 2); ?></td>
                            <td class="p-3 border text-right"><?php echo number_format((float) $row->credit, 2); ?></td>
                            <td class="p-3 border text-right font-semibold"><?php echo number_format((float) $row->due_amount, 2); ?></td>
                            <td class="p-3 border text-center">
                                <a target="_blank"
                                   href="<?php echo base_url('index.php/Accounts/search_individual_ledger_details/' . (int) $row->account_id . '/01-01-2000/' . date('d-m-Y', strtotime($to))); ?>"
                                   class="text-blue-600 hover:text-blue-800 underline">
                                    View Debit/Credit
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="8" class="p-4 border text-center text-gray-500">No pending customer dues found.</td></tr>
                <?php endif; ?>
            </tbody>
            <tfoot class="bg-gray-100 font-bold">
                <tr>
                    <td colspan="7" class="p-3 border text-right">Total Customer Due</td>
                    <td class="p-3 border text-right"><?php echo number_format($total_due, 2); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>