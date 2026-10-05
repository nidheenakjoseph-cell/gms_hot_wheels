<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold">Scrap Sale Details</h2>
            <p class="text-sm text-gray-500">
                Invoice No: <b><?= $scrap->invoice_no ?></b><br>
                Date: <?= date('d-m-Y', strtotime($scrap->sale_date)) ?>
            </p>
        </div>

        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full text-sm font-semibold <?= ($scrap->balance <= 0) ? 'bg-green-100 text-green-700' : (($scrap->paid_amt > 0) ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') ?>">
                <?= ($scrap->balance <= 0) ? 'Paid' : (($scrap->paid_amt > 0) ? 'Partially Paid' : 'Unpaid') ?>
            </span>

            <a href="<?= base_url('index.php/scrap/print_scrap/' . $scrap->id) ?>" class="p-3 rounded-lg bg-slate-100 hover:bg-slate-200 transition" title="Print Scrap Sale">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V2h12v7M6 18h12v4H6v-4M6 14H5a3 3 0 01-3-3v-1a3 3 0 013-3h14a3 3 0 013 3v1a3 3 0 01-3 3h-1" />
                </svg>
            </a>

            <a href="<?= base_url('index.php/scrap/download_scrap/' . $scrap->id) ?>" class="p-3 rounded-lg bg-red-100 hover:bg-red-200 transition" title="Download PDF">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-8m0 8l-3-3m3 3l3-3M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H8l-2 2H6a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </a>

            <a href="<?= base_url('index.php/scrap') ?>" class="p-3 rounded-lg bg-gray-200 hover:bg-gray-300 transition" title="Back to Scrap List">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-6 bg-gray-50 p-4 rounded text-sm">
        <div>
            <p><b>Customer:</b> <?= html_escape($scrap->customer_name) ?></p>
            <p><b>Invoice:</b> <?= html_escape($scrap->invoice_no) ?></p>
            <p><b>Sale Date:</b> <?= date('d-m-Y', strtotime($scrap->sale_date)) ?></p>
        </div>
        <div>
            <p><b>Total Amount:</b> <?= number_format($scrap->grand_total, 2) ?></p>
            <?php if (!empty($scrap->advance_used) && $scrap->advance_used > 0): ?>
                <p><b>Advance Used:</b> <?= number_format($scrap->advance_used, 2) ?></p>
            <?php endif; ?>
            <?php if (!empty($scrap->receipt_paid_amount) && $scrap->receipt_paid_amount > 0): ?>
                <p><b>Receipts Paid:</b> <?= number_format($scrap->receipt_paid_amount, 2) ?></p>
            <?php endif; ?>
            <p><b>Total Paid:</b> <?= number_format($scrap->paid_amt, 2) ?></p>
            <p><b>Balance:</b> <?= number_format($scrap->balance, 2) ?></p>
        </div>
    </div>

    <h3 class="font-semibold mb-2">Scrap Items</h3>
    <table class="w-full border text-sm mb-6">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2 w-10">#</th>
                <th class="border p-2">Category</th>
                <th class="border p-2 w-20 text-right">Qty</th>
                <th class="border p-2 w-28 text-right">Unit Price</th>
                <th class="border p-2 w-32 text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($scrap->items)): ?>
                <?php $i = 1; foreach ($scrap->items as $item): ?>
                    <tr>
                        <td class="border p-2 text-center"><?= $i++ ?></td>
                        <td class="border p-2"><?= html_escape($item->category_name) ?></td>
                        <td class="border p-2 text-right"><?= number_format($item->quantity, 2) ?></td>
                        <td class="border p-2 text-right"><?= number_format($item->rate, 2) ?></td>
                        <td class="border p-2 text-right"><?= number_format($item->amount, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="border p-3 text-center text-gray-500">No items found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="grid grid-cols-2 gap-4 text-sm mb-6">
        <div>
            <h3 class="font-semibold mb-2">Remarks</h3>
            <div class="p-3 bg-gray-50 border rounded text-sm whitespace-pre-wrap"><?= html_escape($scrap->notes) ?></div>
        </div>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span><?= number_format($scrap->subtotal, 2) ?></span>
            </div>
            <div class="flex justify-between">
                <span>VAT (5%)</span>
                <span><?= number_format($scrap->tax_amount, 2) ?></span>
            </div>
            <div class="flex justify-between">
                <span>Grand Total</span>
                <span class="font-bold"><?= number_format($scrap->grand_total, 2) ?></span>
            </div>
            <?php if (!empty($scrap->advance_used) && $scrap->advance_used > 0): ?>
            <div class="flex justify-between text-blue-700">
                <span>Advance Used</span>
                <span><?= number_format($scrap->advance_used, 2) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($scrap->receipt_paid_amount) && $scrap->receipt_paid_amount > 0): ?>
            <div class="flex justify-between text-green-700">
                <span>Receipts Paid</span>
                <span><?= number_format($scrap->receipt_paid_amount, 2) ?></span>
            </div>
            <?php endif; ?>
            <div class="flex justify-between text-green-700 font-semibold border-t pt-1">
                <span>Total Paid</span>
                <span><?= number_format($scrap->paid_amt, 2) ?></span>
            </div>
            <div class="flex justify-between text-red-700 font-bold border-t pt-1">
                <span>Balance</span>
                <span><?= number_format($scrap->balance, 2) ?></span>
            </div>
        </div>
    </div>
</div>
