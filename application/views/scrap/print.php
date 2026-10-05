<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Scrap Sale <?= html_escape($scrap->invoice_no) ?></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #000; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        .right { text-align: right; }
        .center { text-align: center; }
        .no-border td { border: none; }
        .header-line-thin { border-top: 2px solid #000; }
        .caption { font-size: 18px; font-weight: bold; }
        .status { position: fixed; top: 40%; left: 25%; font-size: 60px; color: rgba(200, 0, 0, 0.15); transform: rotate(-30deg); }
        .remark-box { padding: 5px; }
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body onload="window.print()">
    <?php if ($scrap->balance <= 0): ?>
        <div class="status">PAID</div>
    <?php endif; ?>

    <div class="no-print" style="margin-bottom: 16px;">
        <button onclick="window.print()" style="padding: 10px 16px; background:#2563eb; color:#fff; border:none; border-radius:6px; cursor:pointer;">🖨 Print</button>
        <a href="<?= base_url('index.php/scrap') ?>" style="margin-left:10px; display:inline-block; padding:10px 16px; background:#d1d5db; color:#111; border-radius:6px; text-decoration:none;">Back</a>
    </div>
	<!-- COMPANY HEADER -->
	<table class="no-border">
		<tr>

			<td width="20%">
				<img src="<?= base_url('public/images/logoauto1.png') ?>" height="70">
			</td>

			<td width="80%" class="right">
				<strong>Demo Garage Solutions LLC</strong><br>
		Business Bay, Dubai, UAE<br>
		www.demogarage.com<br>
		info@demogarage.com<br>
		Tel: +971 4 123 4567<br>
		TRN: 100000000000000
			</td>

		</tr>
	</table>
		<!-- HEADER DOUBLE LINE -->
	<!-- <div class="header-line-thick"></div> -->
	<div class="header-line-thin"></div>
	
    <table class="no-border">
        <tr>
            <td width="50%">
                <b>Scrap Sale Invoice</b><br>
                Invoice No: <?= html_escape($scrap->invoice_no) ?><br>
                Date: <?= date('d/m/Y', strtotime($scrap->sale_date)) ?>
            </td>
            <td width="50%" class="right caption">SCRAP SALE</td>
        </tr>
    </table>

    <div class="header-line-thin"></div>

    <table style="margin-top:10px;" class="no-border">
        <tr>
            <td width="50%">
                <b>Customer Details</b><br>
                <?= html_escape($scrap->customer_name) ?><br>
            </td>
            <td width="50%">
                <b>Summary</b><br>
                Total: <?= number_format($scrap->grand_total, 2) ?><br>
                Paid: <?= number_format($scrap->paid_amt, 2) ?><br>
                Balance: <?= number_format($scrap->balance, 2) ?><br>
            </td>
        </tr>
    </table>

    <table style="margin-top:10px;">
        <tr>
            <th width="5%">#</th>
            <th>Description</th>
            <th width="15%" class="right">Qty</th>
            <th width="20%" class="right">Unit Price</th>
            <th width="20%" class="right">Amount</th>
        </tr>
        <?php if (!empty($scrap->items)): ?>
            <?php $i = 1; foreach ($scrap->items as $item): ?>
                <tr>
                    <td class="center"><?= $i++ ?></td>
                    <td><?= html_escape($item->category_name) ?></td>
                    <td class="right"><?= number_format($item->quantity, 2) ?></td>
                    <td class="right"><?= number_format($item->rate, 2) ?></td>
                    <td class="right"><?= number_format($item->amount, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="center">No items found</td>
            </tr>
        <?php endif; ?>
    </table>

    <table style="margin-top:10px;" class="no-border">
        <tr>
            <td width="60%" class="remark-box">
                <b>Remarks</b><br>
                <?= nl2br(html_escape($scrap->notes)) ?>
            </td>
            <td width="40%" style="vertical-align: top;">
                <table>
                    <tr>
                        <td>Subtotal</td>
                        <td class="right"><?= number_format($scrap->subtotal, 2) ?></td>
                    </tr>
                    <tr>
                        <td>VAT (5%)</td>
                        <td class="right"><?= number_format($scrap->tax_amount, 2) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        <td class="right"><strong><?= number_format($scrap->grand_total, 2) ?></strong></td>
                    </tr>
                    <?php if (!empty($scrap->advance_used) && $scrap->advance_used > 0): ?>
                    <tr>
                        <td>Advance Used</td>
                        <td class="right"><?= number_format($scrap->advance_used, 2) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if (!empty($scrap->receipt_paid_amount) && $scrap->receipt_paid_amount > 0): ?>
                    <tr>
                        <td>Receipts Paid</td>
                        <td class="right"><?= number_format($scrap->receipt_paid_amount, 2) ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td><strong>Total Paid</strong></td>
                        <td class="right"><strong><?= number_format($scrap->paid_amt, 2) ?></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Balance</strong></td>
                        <td class="right"><strong><?= number_format($scrap->balance, 2) ?></strong></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    
	<table width="100%" style="border-collapse:collapse; margin-top:20px;">
		<tr>

			<!-- BANK DETAILS -->
			<td width="60%" style="border:none; vertical-align:top;">

				<table width="100%" style="border-collapse:collapse;">
					<tr>
						<td style="border:none; padding:2px;">
							<b>Bank:</b> DEMO NATIONAL BANK
						</td>
					</tr>

					<tr>
						<td style="border:none; padding:2px;">
							<b>Account Name:</b> DEMO GARAGE SOLUTIONS LLC
						</td>
					</tr>

					<tr>
						<td style="border:none; padding:2px;">
							<b>Account No:</b> 123456789012345
						</td>
					</tr>

					<tr>
						<td style="border:none; padding:2px;">
							<b>IBAN No:</b> AE001234567890123456789
						</td>
					</tr>
				</table>

			</td>


			<!-- SIGNATURE / STAMP -->
			<td width="40%" style="border:none; text-align:center; vertical-align:top;">

				<div style="height:80px;"></div>

				<div style="border-top:1px solid #000; width:80%; margin:auto; padding-top:5px;">
					<!-- Authorized Signatory / Company Stamp -->
					Demo Garage Solutions LLC
				</div>

			</td>

		</tr>
	</table>
</body>
</html>
