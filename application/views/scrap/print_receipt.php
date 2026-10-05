<?php
$this->load->helper('myopeningbalance_helper.php'); // for convert_number_to_words()

// Company info from logo_details
// $company = $logo_details[0] ?? null;
// $company_name    = $company->company_name ?? '';
// $company_add1    = $company->company_address ?? '';
// $company_city    = $company->company_city ?? '';
// $company_pin     = $company->company_pincode ?? '';
// $company_state   = $company->company_state ?? '';
// $company_website = $company->company_website ?? '';
// $company_email   = $company->company_email_id ?? '';

// Receipt header info
$receipt_no       = $header->voucher_code ?? '';
$receipt_date     = $header->voucher_date ?? '';
$voucher_type     = $header->voucher_type ?? '';
$cust_code        = $header->customer_id ?? '';
$customer_name    = $header->customer_name ?? '';
$total_amount     = $header->amount ?? 0;
$transaction_type = $header->transaction_type ?? '';
$transaction_no   = $header->transaction_no ?? '';
$bank_name        = $header->bank_name ?? '';
$credit_account   = $header->credit_account_name ?? '';
$remark           = $header->narration ?? '';
?>

<style>
	body {
		font-family: Arial, sans-serif;
		font-size: 14px;
	}

	.header-wrapper {
		display: flex;
		align-items: center;
		margin-bottom: 10px;
	}

	.logo {
		width: 120px;
	}

	.logo img {
		width: 100%;
		height: auto;
	}

	.company-info {
		flex-grow: 1;
		text-align: center;
		font-size: 12px;
		line-height: 1.2;
		font-weight: 600;
	}

	.logo-container {
		text-align: center;
		margin-bottom: 10px;
	}

	.logo-container img {
		max-width: 150px;
		height: auto;
		display: inline-block;
	}

	table {
		border-collapse: collapse;
		width: 100%;
	}

	table,
	th,
	td {
		border: 1px solid #ddd;
	}

	th {
		background-color: #f0f0f0;
		text-align: center;
		padding: 8px;
	}

	td {
		padding: 8px;
	}

	.right-align {
		text-align: right;
	}

	.center-align {
		text-align: center;
	}

	.title {
		text-align: center;
		font-weight: bold;
		font-size: 18px;
		margin-top: 10px;
	}

	.footer {
		margin-top: 60px;
	}

	.center-align {
		text-align: center;
	}

	.right-align {
		text-align: right;
	}
</style>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">

	<!-- Logo -->
	<img src="<?= base_url('public/images/logoauto1.png'); ?>" width="30%" style="height:70px;">

	<!-- Company Details -->
	<div style="text-align:right; font-size:13px; line-height:1.5;">
		<strong>Demo Garage Solutions LLC</strong><br>
		Business Bay, Dubai, UAE<br>
		www.demogarage.com<br>
		info@demogarage.com<br>
		Tel: +971 4 123 4567<br>
		TRN: 100000000000000
	</div>

</div>
<h3 align="center"> <?php
					if ($voucher_type == 'R') echo "Receipt Voucher";
					elseif ($voucher_type == 'D') echo "Debit Note";
					elseif ($voucher_type == 'C') echo "Credit Note";
					else echo "Receipt Voucher";
					?></h3>


<table style="margin-top: 10px;">
	<tr>
		<td><strong>No.:</strong> <?= htmlspecialchars($receipt_no); ?></td>
		<td class="right-align"><strong>Dated:</strong> <?= date('d-M-Y', strtotime($receipt_date)); ?></td>
	</tr>
	<tr>
		<td colspan="2"><strong>[<?= htmlspecialchars($cust_code); ?>] <?= htmlspecialchars($customer_name); ?></strong></td>
	</tr>
</table>

<?php
$invoice_groups = [];
$total_amount = 0;

if (!empty($details)) {
	foreach ($details as $index => $detail) {
		$invoice_id = isset($detail->invoice_id) ? (string) $detail->invoice_id : 'invoice-' . ($index + 1);
		$invoice_no = !empty($detail->invoice_no) ? $detail->invoice_no : 'Invoice #' . ($index + 1);

		if (!isset($invoice_groups[$invoice_id])) {
			$invoice_groups[$invoice_id] = [
				'invoice_no' => $invoice_no,
				'customer_name' => isset($detail->customer_name) ? $detail->customer_name : '',
				'paid_amount' => isset($detail->receipt_amount) ? floatval($detail->receipt_amount) : 0,
				'items' => []
			];
		}

		$has_item_details = !empty($detail->category_name) || isset($detail->quantity) || isset($detail->rate) || isset($detail->item_amount);
		$item = [
			'category' => !empty($detail->category_name) ? $detail->category_name : 'Invoice Total',
			'quantity' => isset($detail->quantity) ? floatval($detail->quantity) : '',
			'price' => isset($detail->rate) ? floatval($detail->rate) : '',
			'amount' => isset($detail->item_amount) ? floatval($detail->item_amount) : (isset($detail->receipt_amount) ? floatval($detail->receipt_amount) : 0)
		];

		if ($has_item_details || empty($invoice_groups[$invoice_id]['items'])) {
			$invoice_groups[$invoice_id]['items'][] = $item;
		}
	}
} else {
	$invoice_codes = isset($header->invoice_codes) ? explode(',', $header->invoice_codes) : [];
	$invoice_amounts = isset($header->invoice_amounts) ? explode(',', $header->invoice_amounts) : [];

	foreach ($invoice_codes as $i => $inv_code) {
		$invoice_id = 'fallback-' . ($i + 1);
		$invoice_groups[$invoice_id] = [
			'invoice_no' => trim($inv_code),
			'customer_name' => '',
			'paid_amount' => floatval(trim($invoice_amounts[$i] ?? 0)),
			'items' => [[
				'category' => 'Invoice Total',
				'quantity' => '',
				'price' => '',
				'amount' => floatval(trim($invoice_amounts[$i] ?? 0))
			]]
		];
	}
}

foreach ($invoice_groups as $group) {
	$total_amount += $group['paid_amount'];
}
?>

<?php if (!empty($invoice_groups)) { ?>
	<p style="margin-top: 15px; font-weight: bold;">Linked Invoice / Receipt Items</p>
	<?php foreach ($invoice_groups as $group): ?>
		<div style="margin-top: 10px;">
			<p style="margin: 0 0 6px; font-weight: bold;">Invoice: <?= htmlspecialchars($group['invoice_no']) ?></p>
			<?php if (!empty($group['customer_name'])): ?>
				<p style="margin: 0 0 8px;">Customer: <?= htmlspecialchars($group['customer_name']) ?></p>
			<?php endif; ?>
			<table style="width: 100%; border-collapse: collapse; margin-top: 4px;">
				<thead>
					<tr style="background-color: #f0f0f0; border: 1px solid #ddd;">
						<th style="border: 1px solid #ddd; padding: 8px; text-align: center;">SL.No</th>
						<th style="border: 1px solid #ddd; padding: 8px;">Category</th>
						<th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Qty</th>
						<th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Price (AED)</th>
						<th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Amount (AED)</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($group['items'] as $i => $item): ?>
						<tr>
							<td style="border: 1px solid #ddd; padding: 8px; text-align: center;"><?= $i + 1 ?></td>
							<td style="border: 1px solid #ddd; padding: 8px;"><?= htmlspecialchars($item['category']) ?></td>
							<td style="border: 1px solid #ddd; padding: 8px; text-align: right;">
								<?= $item['quantity'] !== '' ? number_format($item['quantity'], 2) : '-' ?>
							</td>
							<td style="border: 1px solid #ddd; padding: 8px; text-align: right;">
								<?= $item['price'] !== '' ? number_format($item['price'], 2) : '-' ?>
							</td>
							<td style="border: 1px solid #ddd; padding: 8px; text-align: right;">
								<?= number_format($item['amount'], 2) ?>
							</td>
						</tr>
					<?php endforeach; ?>

					<tr style="font-weight: bold; background-color: #eaeaea;">
						<td colspan="4" style="border: 1px solid #ddd; padding: 8px; text-align: right;">Paid Amount</td>
						<td style="border: 1px solid #ddd; padding: 8px; text-align: right;">
							<?= number_format($group['paid_amount'], 2) ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	<?php endforeach; ?>
<?php } else { ?>
	<p>No linked invoices found.</p>
<?php } ?>


<p style="margin-top: 20px;">
	<strong>Through:</strong>
	<?= ucwords(htmlspecialchars($transaction_type)); ?>
	<?= !empty($transaction_no) ? ' - ' . htmlspecialchars($transaction_no) : ''; ?>
	<?= !empty($bank_name) ? ' (' . htmlspecialchars($bank_name) . ')' : ''; ?>
	<?= !empty($credit_account) ? ' via ' . htmlspecialchars($credit_account) : ''; ?>
</p>

<p>
	<strong>Amount in words:</strong>
	<?= function_exists('convert_number_to_words') ? convert_number_to_words($total_amount) : 'Function missing'; ?>
</p>

<p> <strong>Remarks</strong>
	<?php echo $remark; ?></p>

<div class="footer">
	<p>Receiver's Signature: ____________________</p>
	<p class="right-align">Authorised Signatory</p>
</div>

<script>
	window.onload = function() {
		window.print();
	};
</script>
